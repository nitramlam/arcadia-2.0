<?php
require_once '../mongo_connect.php';
require '../config/db.php'; // Assurez-vous que le chemin est correct selon votre structure de fichiers

// Récupérer l'ID de l'animal depuis l'URL
if (isset($_GET['id'])) {
    $animalId = (int) $_GET['id'];
    echo "ID de l'animal : " . htmlspecialchars($animalId) . "<br>";

    // Connexion à MongoDB
    $db = getMongoConnection();
    $collection = $db->animal_views;

    // Incrémenter le compteur de vues
    $updateResult = $collection->updateOne(
        ['animal_id' => $animalId],
        ['$inc' => ['views' => 1]],
        ['upsert' => true]
    );

    // Vérifiez que la mise à jour s'est effectuée
    if ($updateResult->getModifiedCount() || $updateResult->getUpsertedCount()) {
        echo "Compteur de vues incrémenté.<br>";
    } else {
        echo "Erreur lors de l'incrémentation du compteur de vues.<br>";
    }

    // Récupérer le nombre de vues mis à jour
    $viewData = $collection->findOne(['animal_id' => $animalId]);
    $views = $viewData['views'] ?? 0;
    echo "Nombre de vues mis à jour : " . htmlspecialchars($views) . "<br>";

    // Connexion à MySQL pour récupérer les informations de l'animal
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT * FROM animal WHERE id = ?");
    $stmt->execute([$animalId]);
    $animal = $stmt->fetch();

    if ($animal) {
        // Affichage des informations de l'animal et du compteur de vues
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= htmlspecialchars($animal['nom']) ?></title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <h1><?= htmlspecialchars($animal['nom']) ?></h1>
            <p><?= htmlspecialchars($animal['espece']) ?></p>
            <img src="<?= htmlspecialchars($animal['image_path'] ?? '/animaux/default.jpg') ?>" alt="<?= htmlspecialchars($animal['nom']) ?>" style="max-width: 200px;">
            <p>Nombre de vues : <?= htmlspecialchars($views) ?></p>
        </body>
        </html>
        <?php
    } else {
        echo "Animal non trouvé.";
    }
} else {
    echo "ID de l'animal non fourni.";
}
?>