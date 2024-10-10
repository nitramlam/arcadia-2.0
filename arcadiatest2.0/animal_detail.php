<?php
require 'vendor/autoload.php'; // Assurez-vous d'avoir installé MongoDB avec Composer
require __DIR__ . '/config/db.php'; // Ajustez le chemin en fonction de votre structure de répertoires

// ID de l'animal à partir de l'URL ou d'une autre source
$animalId = $_GET['animal_id'] ?? 1;

try {
    // Connexion à MongoDB
    $client = new MongoDB\Client("mongodb://mongodb:27017");
    $collection = $client->arcadia->animal_views;

    // Incrémenter le compteur de consultations pour cet animal
    $collection->updateOne(
        ['animal_id' => (int)$animalId],
        ['$inc' => ['views' => 1]],
        ['upsert' => true]
    );

    // Récupérer le compteur de vues
    $viewDocument = $collection->findOne(['animal_id' => (int)$animalId]);
    $views = $viewDocument['views'] ?? 0;

    // Récupérer les informations de l'animal depuis la base de données relationnelle
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT nom FROM animal WHERE animal_id = ?");
    $stmt->execute([$animalId]);
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Erreur de connexion à MongoDB : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($animal['nom']); ?> - Page Personnalisée</title>
    <link rel="stylesheet" href="../styles/animal_page.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($animal['nom']); ?></h1>
    <p>Nombre de vues : <?php echo htmlspecialchars($views); ?></p>
</body>
</html>