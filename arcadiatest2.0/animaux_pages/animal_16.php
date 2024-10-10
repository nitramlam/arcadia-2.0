<?php require_once (__DIR__ . '/../includes/header.php'); ?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Léonard - Page Personnalisée</title>
    <link rel='stylesheet' href='animauxPage.css'>
</head>
<body>
    <div class="animal-main">
        <h1 class="animal-title">Léonard</h1>
        <img class="animal-photo" src="/animaux/elephant1.png" alt="Léonard">
        <div class="info-section">
            <h2>Informations Générales</h2>
            <div class="general-info">
                <p class="species-info"><strong>Espèce:</strong> éléphant d'Afrique</p>
                <p class="description-info"><strong>Description:</strong> : L’éléphant d’Afrique, emblème des savanes et des forêts subsahariennes, est vital pour l’écosystème en tant qu’ingénieur du paysage et disperseur de graines. Malheureusement menacé par le braconnage et la perte d’habitat, sa conservation est essentielle pour préserver la biodiversité africaine.</p>
                <p class="weight-info"><strong>Poids:</strong> 1500.00 kg</p>
                <p class="sex-info"><strong>Sexe:</strong> M</p>
                <p class="origin-continent-info"><strong>Continent d'origine:</strong> Afrique</p>
                <p class="habitat-info"><strong>Habitat:</strong> savane</p>
            </div>
        </div>

        <div class="medical-section">
            <h2>Données Médicales</h2>
            <div class="medical-info">
                <p class="diet-info"><strong>Régime:</strong> feuille</p>
                <p class="last-visit-info"><strong>Dernière visite:</strong> 2024-07-19</p>
                <p class="general-state-info"><strong>État général:</strong> en bonne santé </p>
                <p class="weight-info"><strong>Grammage:</strong> 60.00 kg</p>
                <p class="comment-info"><strong>Commentaire:</strong> RAS</p>
            </div>
        </div>
    </div>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>