<?php 
session_start();
require_once(__DIR__ . '/../includes/auth.php'); 
require_once(__DIR__ . '/../includes/header.php'); 
require_once(__DIR__ . '/../db.php'); // Inclure le fichier de configuration de la base de données

// Vérification du rôle de l'utilisateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'veterinaire') {
    header("Location: /connexion/connexion.php");
    exit();
}

// Générer un token CSRF s'il n'existe pas déjà dans la session
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Gestion des soumissions des formulaires
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification du token CSRF
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Échec de la validation CSRF.');
    }

    if (isset($_POST['update_habitat'])) {
        // Mettre à jour le commentaire de propreté de l'habitat
        $habitat_id = $_POST['habitat_id'];
        $commentaire_habitat = $_POST['commentaire_habitat'];
        $stmt = $conn->prepare("UPDATE habitat SET commentaire_habitat = ? WHERE habitat_id = ?");
        $stmt->bind_param("si", $commentaire_habitat, $habitat_id);
        $stmt->execute();
    }
}

// Récupérer les données des habitats
$habitatQuery = $conn->query("SELECT * FROM habitat");
$habitats = $habitatQuery->fetch_all(MYSQLI_ASSOC);

// Récupérer les données des animaux
$animalQuery = $conn->query("SELECT * FROM animal");
$animals = $animalQuery->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page Vétérinaire - Habitats</title>
    <link rel="stylesheet" href="habitats.css">
</head>
<body>
    <main>
        <section class="intro">
            <h2>Gestion de la Propreté des Habitats</h2>
            <p>Cette page permet au vétérinaire de mettre à jour les commentaires sur la propreté des habitats et de visualiser les animaux qui y vivent.</p>
        </section>
        <section class="habitat-list">
            <?php foreach ($habitats as $habitat): ?>
                <div class="habitat-card">
                    <h3><?php echo htmlspecialchars($habitat['nom'] ?? ''); ?></h3>
                    <img src="<?php echo htmlspecialchars($habitat['image_path'] ?? ''); ?>" alt="Image de <?php echo htmlspecialchars($habitat['nom'] ?? ''); ?>" class="habitat-image">
                    <p><?php echo htmlspecialchars($habitat['description'] ?? ''); ?></p>
                    <p><strong>Commentaire sur la propreté:</strong> <?php echo htmlspecialchars($habitat['commentaire_habitat'] ?? ''); ?></p>
                    
                    <h4>Animaux dans cet habitat :</h4>
                    <ul>
                        <?php foreach ($animals as $animal): ?>
                            <?php if ($animal['habitat'] === $habitat['nom']): ?>
                                <li><?php echo htmlspecialchars($animal['nom'] ?? '') . ' (' . htmlspecialchars($animal['espece'] ?? '') . ')'; ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    
                    <button class="edit-toggle">✏️</button>
                    <form method="POST" class="habitat-form" style="display: none;">
                        <!-- Ajout du token CSRF -->
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="habitat_id" value="<?php echo htmlspecialchars($habitat['habitat_id'] ?? ''); ?>">
                        <label>Commentaire sur la propreté: <textarea name="commentaire_habitat" required><?php echo htmlspecialchars($habitat['commentaire_habitat'] ?? ''); ?></textarea></label>
                        <button type="submit" name="update_habitat" class="edit-btn">Mettre à jour</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editToggles = document.querySelectorAll('.edit-toggle');
            editToggles.forEach(button => {
                button.addEventListener('click', () => {
                    const form = button.nextElementSibling;
                    form.style.display = form.style.display === 'block' ? 'none' : 'block';
                });
            });
        });
    </script>
</body>
</html>