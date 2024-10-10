<?php require_once (__DIR__ . '/../includes/header.php'); ?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Richard - Page Personnalisée</title>
    <link rel='stylesheet' href='animauxPage.css'>
</head>
<body>
    <div class="animal-main">
        <h1 class="animal-title">Richard</h1>
        <img class="animal-photo" src="/animaux/lezard1.png" alt="Richard">
        <div class="info-section">
            <h2>Informations Générales</h2>
            <div class="general-info">
                <p class="species-info"><strong>Espèce:</strong> lézard à crête du désert</p>
                <p class="description-info"><strong>Description:</strong> Le lézard à crête du désert (Stellagama stellio) est une espèce répandue dans les régions semi-arides et les savanes d’Afrique du Nord, du Moyen-Orient et de l’Asie. Reconnaissable par sa crête d’épines et ses couleurs variant du gris au brun, il se nourrit d’insectes et de petits mammifères. Ce lézard est connu pour sa capacité à grimper habilement sur les surfaces rocheuses et à se fondre dans son environnement pour se camoufler des prédateurs.
</p>
                <p class="weight-info"><strong>Poids:</strong> 0.70 kg</p>
                <p class="sex-info"><strong>Sexe:</strong> M</p>
                <p class="origin-continent-info"><strong>Continent d'origine:</strong> Afrique</p>
                <p class="habitat-info"><strong>Habitat:</strong> savane</p>
            </div>
        </div>

        <div class="medical-section">
            <h2>Données Médicales</h2>
            <div class="medical-info">
                <p class="diet-info"><strong>Régime:</strong> insectes</p>
                <p class="last-visit-info"><strong>Dernière visite:</strong> 2024-07-19</p>
                <p class="general-state-info"><strong>État général:</strong> en bonne santé</p>
                <p class="weight-info"><strong>Grammage:</strong> 0.30 kg</p>
                <p class="comment-info"><strong>Commentaire:</strong> RAS</p>
            </div>
        </div>
    </div>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>