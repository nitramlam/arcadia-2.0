<?php require_once (__DIR__ . '/../includes/header.php'); ?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Gurky - Page Personnalisée</title>
    <link rel='stylesheet' href='animauxPage.css'>
</head>
<body>
    <div class="animal-main">
        <h1 class="animal-title">Gurky</h1>
        <img class="animal-photo" src="/animaux/toucan1.png" alt="Gurky">
        <div class="info-section">
            <h2>Informations Générales</h2>
            <div class="general-info">
                <p class="species-info"><strong>Espèce:</strong> toucan toco</p>
                <p class="description-info"><strong>Description:</strong> : Les toucans d’Amazonie, connus sous le nom scientifique Ramphastos toco, contribuent à la richesse de la biodiversité amazonienne en jouant un rôle crucial dans la dispersion des graines des fruits qu’ils consomment. Leur présence dans les canopées des forêts tropicales favorise la régénération des espèces végétales et soutient la diversité des habitats. En tant qu’indicateurs de l’état de santé des écosystèmes, ils sont essentiels pour la conservation des vastes réseaux écologiques de l’Amazonie.</p>
                <p class="weight-info"><strong>Poids:</strong> 4.00 kg</p>
                <p class="sex-info"><strong>Sexe:</strong> M</p>
                <p class="origin-continent-info"><strong>Continent d'origine:</strong> Amérique du Sud</p>
                <p class="habitat-info"><strong>Habitat:</strong> jungle</p>
            </div>
        </div>

        <div class="medical-section">
            <h2>Données Médicales</h2>
            <div class="medical-info">
                <p class="diet-info"><strong>Régime:</strong> graines</p>
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