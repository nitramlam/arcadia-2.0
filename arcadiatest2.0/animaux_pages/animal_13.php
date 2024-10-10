<?php require_once (__DIR__ . '/../includes/header.php'); ?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>oscar - Page Personnalisée</title>
    <link rel='stylesheet' href='animauxPage.css'>
</head>
<body>
    <div class="animal-main">
        <h1 class="animal-title">oscar</h1>
        <img class="animal-photo" src="/animaux/lion1.png" alt="oscar">
        <div class="info-section">
            <h2>Informations Générales</h2>
            <div class="general-info">
                <p class="species-info"><strong>Espèce:</strong> lion d'Afrique</p>
                <p class="description-info"><strong>Description:</strong> Le lion d’Afrique (Panthera leo) règne sur les vastes étendues de la savane africaine. Connu pour sa majestueuse crinière et sa puissante stature, ce prédateur social vit en groupes appelés fiertés. Les lions de la savane chassent en coopération, ciblant des proies telles que les zèbres, les gnous et les antilopes. Symbole de force et de courage, le lion joue un rôle crucial dans l’écosystème en régulant les populations d’herbivores.</p>
                <p class="weight-info"><strong>Poids:</strong> 300.00 kg</p>
                <p class="sex-info"><strong>Sexe:</strong> M</p>
                <p class="origin-continent-info"><strong>Continent d'origine:</strong> Afrique</p>
                <p class="habitat-info"><strong>Habitat:</strong> savane</p>
            </div>
        </div>

        <div class="medical-section">
            <h2>Données Médicales</h2>
            <div class="medical-info">
                <p class="diet-info"><strong>Régime:</strong> protéines</p>
                <p class="last-visit-info"><strong>Dernière visite:</strong> 2024-07-19</p>
                <p class="general-state-info"><strong>État général:</strong> en bonne santé</p>
                <p class="weight-info"><strong>Grammage:</strong> 50.00 kg</p>
                <p class="comment-info"><strong>Commentaire:</strong> 0</p>
            </div>
        </div>
    </div>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>