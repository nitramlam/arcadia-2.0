<?php
session_start();
require_once(__DIR__ . '/../includes/auth.php'); 
require_once(__DIR__ . '/../includes/header.php'); 
require_once(__DIR__ . '/../db.php'); // Connexion à la base de données

// Vérification du rôle de l'utilisateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'administrateur') {
    header("Location: /connexion/connexion.php");
    exit();
}

// Générer un token CSRF s'il n'existe pas déjà dans la session
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Fonction pour gérer l'upload d'image
function uploadImage($file) {
    if (isset($file) && $file['error'] == 0) {
        $uploadDir = __DIR__ . '/../images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $uploadFile = $uploadDir . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            return '/images/' . basename($file['name']);
        }
    }
    return null;
}

// Gestion des soumissions des formulaires
if ($conn && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification du token CSRF
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Échec de la validation CSRF.');
    }

    if (isset($_POST['add_habitat'])) {
        // Ajouter un nouvel habitat
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $commentaire_habitat = $_POST['commentaire_habitat'];

        // Gestion du téléchargement de l'image
        $imagePath = uploadImage($_FILES['image']);
        $stmt = $conn->prepare("INSERT INTO habitat (nom, description, commentaire_habitat, image_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nom, $description, $commentaire_habitat, $imagePath);
        $stmt->execute();

    } elseif (isset($_POST['edit_habitat'])) {
        // Modifier un habitat
        $habitat_id = $_POST['habitat_id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $commentaire_habitat = isset($_POST['commentaire_habitat']) ? $_POST['commentaire_habitat'] : null; 
        

        // Vérifier s'il y a une nouvelle image téléchargée
        $imagePath = uploadImage($_FILES['image']);
        if ($imagePath) {
            $stmt = $conn->prepare("UPDATE habitat SET nom = ?, description = ?, commentaire_habitat = ?, image_path = ? WHERE habitat_id = ?");
            $stmt->bind_param("ssssi", $nom, $description, $commentaire_habitat, $imagePath, $habitat_id);
            $stmt->execute();
        } else {
            $stmt = $conn->prepare("UPDATE habitat SET nom = ?, description = ?, commentaire_habitat = ? WHERE habitat_id = ?");
            $stmt->bind_param("sssi", $nom, $description, $commentaire_habitat, $habitat_id);
            $stmt->execute();
        }
    } elseif (isset($_POST['delete_habitat'])) {
        // Supprimer un habitat
        $habitat_id = $_POST['habitat_id'];
        $stmt = $conn->prepare("DELETE FROM habitat WHERE habitat_id = ?");
        $stmt->bind_param("i", $habitat_id);
        $stmt->execute();
    }
}

// Récupérer les données des habitats
$habitatQuery = $conn->query("SELECT * FROM habitat");
$habitats = $habitatQuery->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Habitats</title>
    <link rel="stylesheet" href="modifierHabitats.css">
</head>
<body>
    <main>
        <section class="intro">
            <h2>Nos Habitats</h2>
            <p>Explorez les différents habitats soigneusement recréés pour offrir un environnement sûr et confortable à nos animaux.</p>
        </section>
        <section class="habitat-list">
            <?php foreach ($habitats as $habitat): ?>
                <div class="habitat-card">
                    <h3><?php echo htmlspecialchars($habitat['nom'] ?? ''); ?></h3>
                    <img src="<?php echo htmlspecialchars($habitat['image_path'] ?? '/images/default.jpg'); ?>" alt="<?php echo htmlspecialchars($habitat['nom'] ?? ''); ?>">
                    <p><?php echo htmlspecialchars($habitat['description'] ?? ''); ?></p>
                    <button class="view-comment-btn" data-id="<?php echo htmlspecialchars($habitat['habitat_id']); ?>">Afficher le commentaire</button>
                    <div class="commentaire-habitat" id="commentaire-<?php echo htmlspecialchars($habitat['habitat_id']); ?>" style="display: none;">
                        <p><em><?php echo htmlspecialchars($habitat['commentaire_habitat'] ?? ''); ?></em></p>
                    </div>

                    <button class="edit-toggle" data-id="<?php echo htmlspecialchars($habitat['habitat_id']); ?>">✏️ Modifier</button>
                    <form method="POST" class="habitat-form" id="edit-form-<?php echo htmlspecialchars($habitat['habitat_id']); ?>" style="display: none;" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="habitat_id" value="<?php echo htmlspecialchars($habitat['habitat_id']); ?>">
                        <label>Nom: <input type="text" name="nom" value="<?php echo htmlspecialchars($habitat['nom']); ?>" required></label>
                        <label>Description: <textarea name="description" required><?php echo htmlspecialchars($habitat['description']); ?></textarea></label>
                        <label>Image: <input type="file" name="image" accept="image/*"></label>
                        <button type="submit" name="edit_habitat" class="edit-btn">Modifier</button>
                    </form>
                    <form method="POST" class="delete-form" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet habitat ?');">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="habitat_id" value="<?php echo htmlspecialchars($habitat['habitat_id']); ?>">
                        <button type="submit" name="delete_habitat" class="delete-btn">Supprimer</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </section>

        <!-- Formulaire d'ajout d'un nouvel habitat -->
        <button class="add-habitat" onclick="openAddForm()">Ajouter un habitat</button>
        <form method="POST" class="add-habitat-form" id="add-habitat-form" style="display: none;" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
            <label>Nom: <input type="text" name="nom" required></label>
            <label>Description: <textarea name="description" required></textarea></label>
            <label>Image: <input type="file" name="image" accept="image/*"></label>
            <button type="submit" name="add_habitat">Ajouter</button>
            <button type="button" onclick="closeAddForm()">Annuler</button>
        </form>
    </main>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.view-comment-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const habitatId = button.getAttribute('data-id');
                    const commentDiv = document.getElementById('commentaire-' + habitatId);
                    commentDiv.style.display = commentDiv.style.display === 'block' ? 'none' : 'block';
                });
            });

            document.querySelectorAll('.edit-toggle').forEach(button => {
                button.addEventListener('click', () => {
                    const habitatId = button.getAttribute('data-id');
                    const form = document.getElementById('edit-form-' + habitatId);
                    form.style.display = form.style.display === 'block' ? 'none' : 'block';
                });
            });

            document.querySelector('.add-habitat').addEventListener('click', () => {
                document.getElementById('add-habitat-form').style.display = 'block';
            });
        });

        function closeAddForm() {
            document.getElementById('add-habitat-form').style.display = 'none';
        }
    </script>
</body>
</html>