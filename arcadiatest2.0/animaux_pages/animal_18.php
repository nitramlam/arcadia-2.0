<?php
require_once (__DIR__ . '/../includes/header.php');

// Connexion à MongoDB pour incrémenter le compteur de vues
$manager = new MongoDB\Driver\Manager("mongodb+srv://martinlamalle:456123Fx37!@arcadia.t7ei6.mongodb.net/?retryWrites=true&w=majority&appName=arcadia");

// Incrémentation du view_count dans MongoDB
$bulk = new MongoDB\Driver\BulkWrite;
$filter = ['animal_id' => "18"];
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
    <title>Euridice - Page Personnalisée</title>
    <link rel='stylesheet' href='animauxPage.css'>
</head>
<body>
    <div class="animal-main">
        <h1 class="animal-title">Euridice</h1>
        <img class="animal-photo" src="/animaux/anaconda1.png" alt="Euridice">
        <div class="info-section">
            <h2>Informations Générales</h2>
            <div class="general-info">
                <p class="species-info"><strong>Espèce:</strong> 0</p>
                <p class="description-info"><strong>Description:</strong> L’anaconda vert (Eunectes murinus) est un serpent géant de l’Amazonie, célèbre pour sa taille impressionnante et son régime alimentaire principalement composé de poissons, d’oiseaux et parfois de petits mammifères. Essentiel à l’équilibre écologique des marécages et des rivières, il joue un rôle crucial dans la régulation des populations de ses proies.</p>
                <p class="weight-info"><strong>Poids:</strong> 3.00 kg</p>
                <p class="sex-info"><strong>Sexe:</strong> F</p>
                <p class="origin-continent-info"><strong>Continent d'origine:</strong> 0</p>
                <p class="habitat-info"><strong>Habitat:</strong> jungle</p>
            </div>
        </div>

        <div class="medical-section">
            <h2>Données Médicales</h2>
            <div class="medical-info">
                <p class="diet-info"><strong>Régime:</strong> protéines</p>
                <p class="last-visit-info"><strong>Dernière visite:</strong> 2024-07-19</p>
                <p class="general-state-info"><strong>État général:</strong> en bonne santé</p>
                <p class="weight-info"><strong>Grammage:</strong> 2.00 kg</p>
                <p class="comment-info"><strong>Commentaire:</strong> RAS</p>
            </div>
        </div>
    </div>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>