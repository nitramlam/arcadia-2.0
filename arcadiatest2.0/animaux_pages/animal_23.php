<?php require_once (__DIR__ . '/../includes/header.php'); ?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Narsil - Page Personnalisée</title>
    <link rel='stylesheet' href='animauxPage.css'>
</head>
<body>
    <div class="animal-main">
        <h1 class="animal-title">Narsil</h1>
        <img class="animal-photo" src="/animaux/heron1.png" alt="Narsil">
        <div class="info-section">
            <h2>Informations Générales</h2>
            <div class="general-info">
                <p class="species-info"><strong>Espèce:</strong> héron cendré des Everglades</p>
                <p class="description-info"><strong>Description:</strong> Le héron cendré des Everglades, connu sous son nom scientifique Ardea herodias, est une espèce emblématique des marais et des zones humides de Floride. Reconnaissable à son plumage cendré, à son long cou et à ses pattes jaunes, il se nourrit principalement de poissons, de grenouilles et d’insectes qu’il chasse avec agilité dans les eaux peu profondes. Ce héron joue un rôle crucial dans l’écosystème en régulant les populations de poissons et en contribuant à la biodiversité des habitats aquatiques.</p>
                <p class="weight-info"><strong>Poids:</strong> 10.00 kg</p>
                <p class="sex-info"><strong>Sexe:</strong> M</p>
                <p class="origin-continent-info"><strong>Continent d'origine:</strong> Amérique du Nord</p>
                <p class="habitat-info"><strong>Habitat:</strong> marais</p>
            </div>
        </div>

        <div class="medical-section">
            <h2>Données Médicales</h2>
            <div class="medical-info">
                <p class="diet-info"><strong>Régime:</strong> poisson</p>
                <p class="last-visit-info"><strong>Dernière visite:</strong> 2024-07-19</p>
                <p class="general-state-info"><strong>État général:</strong> en bonne santé</p>
                <p class="weight-info"><strong>Grammage:</strong> 4.00 kg</p>
                <p class="comment-info"><strong>Commentaire:</strong> RAS</p>
            </div>
        </div>
    </div>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>