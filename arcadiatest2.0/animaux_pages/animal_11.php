<?php require_once (__DIR__ . '/../includes/header.php'); ?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>fez - Page Personnalisée</title>
    <link rel='stylesheet' href='animauxPage.css'>
</head>
<body>
    <div class="animal-main">
        <h1 class="animal-title">fez</h1>
        <img class="animal-photo" src="/animaux/heron-services.png" alt="fez">

        <div class="info-section">
            <h2>Informations Générales</h2>
            <div class="general-info">
                <p class="species-info"><strong>Espèce:</strong> ferfer</p>
                <p class="description-info"><strong>Description:</strong> fez</p>
                <p class="weight-info"><strong>Poids:</strong> 45 kg</p>
                <p class="sex-info"><strong>Sexe:</strong> F</p>
                <p class="origin-continent-info"><strong>Continent d'origine:</strong> a</p>
                <p class="habitat-info"><strong>Habitat:</strong> fer</p>
            </div>
        </div>

        <div class="medical-section">
            <h2>Données Médicales</h2>
            <div class="medical-info">
                <p class="diet-info"><strong>Régime:</strong> </p>
                <p class="last-visit-info"><strong>Dernière visite:</strong> </p>
                <p class="general-state-info"><strong>État général:</strong> </p>
                <p class="weight-info"><strong>Grammage:</strong> 0 kg</p>
                <p class="comment-info"><strong>Commentaire:</strong> </p>
            </div>
        </div>
    </div>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>