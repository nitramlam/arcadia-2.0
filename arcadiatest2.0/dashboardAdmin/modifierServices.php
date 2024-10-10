<?php 
session_start();
require_once(__DIR__ . '/../includes/auth.php'); 
require_once(__DIR__ . '/../includes/header.php'); 
require_once(__DIR__ . '/../db.php'); // Connexion à la base de données

// Vérification que l'utilisateur est connecté
if (!isset($_SESSION['role'])) {
    header("Location: /connexion/connexion.php");
    exit();
}

// Gestion des soumissions des formulaires
if ($conn && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_service'])) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];

        // Gestion du téléchargement de l'image
        $imagePath = uploadImage($_FILES['image']);
        if ($imagePath === null) {
            $imagePath = '/imageServices/default.jpg';
        }

        $stmt = $conn->prepare("INSERT INTO service (nom, description, icons_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nom, $description, $imagePath);
        $stmt->execute();
    } elseif (isset($_POST['update_service'])) {
        $service_id = $_POST['service_id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $imagePath = uploadImage($_FILES['image']);

        if ($imagePath) {
            $stmt = $conn->prepare("UPDATE service SET nom = ?, description = ?, icons_path = ? WHERE service_id = ?");
            $stmt->bind_param("sssi", $nom, $description, $imagePath, $service_id);
        } else {
            $stmt = $conn->prepare("UPDATE service SET nom = ?, description = ? WHERE service_id = ?");
            $stmt->bind_param("ssi", $nom, $description, $service_id);
        }
        $stmt->execute();
    } elseif (isset($_POST['delete_service'])) {
        $service_id = $_POST['service_id'];
        $stmt = $conn->prepare("DELETE FROM service WHERE service_id = ?");
        $stmt->bind_param("i", $service_id);
        $stmt->execute();
    } elseif (isset($_POST['update_horaire'])) {
        $ouverture = $_POST['ouverture'];
        $fermeture = $_POST['fermeture'];
        $stmt = $conn->prepare("UPDATE horaires SET ouverture = ?, fermeture = ? WHERE horaire_id = 1");
        $stmt->bind_param("ss", $ouverture, $fermeture);
        $stmt->execute();
    }
}

// Récupérer les données des services
$serviceQuery = $conn->query("SELECT * FROM service");
$services = $serviceQuery->fetch_all(MYSQLI_ASSOC);

// Récupérer les données des horaires
$horaireQuery = $conn->query("SELECT * FROM horaires");
$horaires = $horaireQuery->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Services et Horaires</title>
    <link rel="stylesheet" href="modifierServices.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
    <script>
        function toggleForm(id) {
            var form = document.getElementById(id);
            form.classList.toggle('hidden');
        }
    </script>
</head>
<body>
<div class="services">
    <h2>Nos Services</h2>
    <?php foreach ($services as $service): ?>
        <div class="service">
            <h3><?= htmlspecialchars($service['nom'], ENT_QUOTES, 'UTF-8'); ?></h3>
            <img src="<?= htmlspecialchars($service['icons_path'] ?? '/imageServices/default.jpg'); ?>" alt="<?= htmlspecialchars($service['nom'] ?? ''); ?>">
            <p><?= nl2br(htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8')); ?></p>

            <form id="form-<?= $service['service_id']; ?>" class="hidden" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="service_id" value="<?= htmlspecialchars($service['service_id'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="text" name="nom" value="<?= htmlspecialchars($service['nom'], ENT_QUOTES, 'UTF-8'); ?>" required>
                <textarea name="description" required><?= htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                <label>Image: <input type="file" name="image" accept="image/*"></label>
                <button type="submit" name="update_service">Modifier</button>
                <button type="submit" name="delete_service" class="delete">Supprimer</button>
            </form>
        </div>
    <?php endforeach; ?>

    <h2>Ajouter un Service</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nom" placeholder="Nom" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <label>Image: <input type="file" name="image" accept="image/*"></label>
        <button type="submit" name="add_service">Ajouter</button>
    </form>
</div>

<div class="horaires">
    <h2>Horaires d'ouverture</h2>
    <form method="POST">
        <label for="ouverture">Ouverture :</label>
        <input type="time" id="ouverture" name="ouverture" value="<?= htmlspecialchars($horaires['ouverture'], ENT_QUOTES, 'UTF-8'); ?>" required>
        <label for="fermeture">Fermeture :</label>
        <input type="time" id="fermeture" name="fermeture" value="<?= htmlspecialchars($horaires['fermeture'], ENT_QUOTES, 'UTF-8'); ?>" required>
        <button type="submit" name="update_horaire">Modifier les horaires</button>
    </form>
</div>

<?php require_once(__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>