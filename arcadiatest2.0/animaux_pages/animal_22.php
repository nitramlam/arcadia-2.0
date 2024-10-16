<?php
require_once (__DIR__ . '/../includes/header.php');

// Connexion à MongoDB pour incrémenter le compteur de vues
$manager = new MongoDB\Driver\Manager("mongodb+srv://martinlamalle:456123Fx37!@arcadia.t7ei6.mongodb.net/?retryWrites=true&w=majority&appName=arcadia");

// Incrémentation du view_count dans MongoDB
$bulk = new MongoDB\Driver\BulkWrite;
$filter = ['animal_id' => "22"];
$update = [
    '$inc' => ['view_count' => 1]  // Incrémenter de 1 à chaque accès
];
$bulk->update($filter, $update);
$manager->executeBulkWrite('arcadia.animal_views', $bulk);

?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Dorothee - Page Personnalisée</title>
    <link rel='stylesheet' href='animauxPage.css'>
</head>
<body>
    <div class="animal-main">
        <h1 class="animal-title">Dorothee</h1>
        <img class="animal-photo" src="/animaux/autruche1.png" alt="Dorothee">
        <div class="info-section">
            <h2>Informations Générales</h2>
            <div class="general-info">
                <p class="species-info"><strong>Espèce:</strong> 0</p>
                <p class="description-info"><strong>Description:</strong>  Les autruches d’Afrique, Struthio camelus, sont les plus grands oiseaux terrestres, parfaitement adaptés aux vastes savanes arides. Leur plumage brun-gris les aide à se fondre dans leur environnement, et elles se nourrissent principalement de végétation et de graines.</p>
                <p class="weight-info"><strong>Poids:</strong> 50.00 kg</p>
                <p class="sex-info"><strong>Sexe:</strong> F</p>
                <p class="origin-continent-info"><strong>Continent d'origine:</strong> 0</p>
                <p class="habitat-info"><strong>Habitat:</strong> savane</p>
            </div>
        </div>

        <div class="medical-section">
            <h2>Données Médicales</h2>
            <div class="medical-info">
                <p class="diet-info"><strong>Régime:</strong> graines</p>
                <p class="last-visit-info"><strong>Dernière visite:</strong> 2024-07-19</p>
                <p class="general-state-info"><strong>État général:</strong> en bonne santé</p>
                <p class="weight-info"><strong>Grammage:</strong> 10.00 kg</p>
                <p class="comment-info"><strong>Commentaire:</strong> RAS</p>
            </div>
        </div>
    </div>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>