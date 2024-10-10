<?php require_once (__DIR__ . '/../includes/header.php'); ?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Renee - Page Personnalisée</title>
    <link rel='stylesheet' href='animauxPage.css'>
</head>
<body>
    <div class="animal-main">
        <h1 class="animal-title">Renee</h1>
        <img class="animal-photo" src="/animaux/alligator1.png" alt="Renee">
        <div class="info-section">
            <h2>Informations Générales</h2>
            <div class="general-info">
                <p class="species-info"><strong>Espèce:</strong> alligator des Everglades</p>
                <p class="description-info"><strong>Description:</strong> Les alligators des Everglades (Alligator mississippiensis) sont des prédateurs emblématiques des marécages de Floride. Ils se distinguent par leur peau écailleuse et leurs puissantes mâchoires, adaptées à la chasse de poissons, de reptiles et de petits mammifères. Jouant un rôle crucial dans l’écosystème. Leur conservation est essentielle face aux menaces croissantes de perte d’habitat et de conflits avec les humains.</p>
                <p class="weight-info"><strong>Poids:</strong> 300.00 kg</p>
                <p class="sex-info"><strong>Sexe:</strong> M</p>
                <p class="origin-continent-info"><strong>Continent d'origine:</strong> Amérique du Nord</p>
                <p class="habitat-info"><strong>Habitat:</strong> marais</p>
            </div>
        </div>

        <div class="medical-section">
            <h2>Données Médicales</h2>
            <div class="medical-info">
                <p class="diet-info"><strong>Régime:</strong> protéines</p>
                <p class="last-visit-info"><strong>Dernière visite:</strong> 2024-07-19</p>
                <p class="general-state-info"><strong>État général:</strong> malade</p>
                <p class="weight-info"><strong>Grammage:</strong> 30.00 kg</p>
                <p class="comment-info"><strong>Commentaire:</strong> RAS</p>
            </div>
        </div>
    </div>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>