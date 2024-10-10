<?php require_once (__DIR__ . '/../includes/header.php'); ?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Weasley - Page Personnalisée</title>
    <link rel='stylesheet' href='animauxPage.css'>
</head>
<body>
    <div class="animal-main">
        <h1 class="animal-title">Weasley</h1>
        <img class="animal-photo" src="/animaux/paresseux1.png" alt="Weasley">
        <div class="info-section">
            <h2>Informations Générales</h2>
            <div class="general-info">
                <p class="species-info"><strong>Espèce:</strong> paresseux</p>
                <p class="description-info"><strong>Description:</strong> Le paresseux à trois doigts est un mammifère des forêts tropicales d’Amérique centrale et du Sud. Connus pour leur lenteur et leur régime à base de feuilles, ils sont essentiels à la dispersion des graines et à la biodiversité, symbolisant la conservation des habitats fragiles.</p>
                <p class="weight-info"><strong>Poids:</strong> 5.00 kg</p>
                <p class="sex-info"><strong>Sexe:</strong> M</p>
                <p class="origin-continent-info"><strong>Continent d'origine:</strong> Amérique du sud</p>
                <p class="habitat-info"><strong>Habitat:</strong> jungle</p>
            </div>
        </div>

        <div class="medical-section">
            <h2>Données Médicales</h2>
            <div class="medical-info">
                <p class="diet-info"><strong>Régime:</strong> feuilles</p>
                <p class="last-visit-info"><strong>Dernière visite:</strong> 2024-07-19</p>
                <p class="general-state-info"><strong>État général:</strong> malade</p>
                <p class="weight-info"><strong>Grammage:</strong> 2.00 kg</p>
                <p class="comment-info"><strong>Commentaire:</strong> a surveiller</p>
            </div>
        </div>
    </div>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>