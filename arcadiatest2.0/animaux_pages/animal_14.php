<?php require_once (__DIR__ . '/../includes/header.php'); ?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Hinata - Page Personnalisée</title>
    <link rel='stylesheet' href='animauxPage.css'>
</head>
<body>
    <div class="animal-main">
        <h1 class="animal-title">Hinata</h1>
        <img class="animal-photo" src="/animaux/panthere1.png" alt="Hinata">
        <div class="info-section">
            <h2>Informations Générales</h2>
            <div class="general-info">
                <p class="species-info"><strong>Espèce:</strong>  panthère de Floride</p>
                <p class="description-info"><strong>Description:</strong> La panthère de Floride (Puma concolor coryi) est une sous-espèce rare et protégée du puma, reconnaissable à sa robe beige et à ses taches. Adaptée à son habitat marécageux unique, elle se nourrit principalement de cerfs, de sangliers et d’autres petits mammifères. La panthère de Floride est un symbole de conservation, représentant les efforts pour protéger les espèces en danger et leurs habitats fragiles.</p>
                <p class="weight-info"><strong>Poids:</strong> 110.00 kg</p>
                <p class="sex-info"><strong>Sexe:</strong> F</p>
                <p class="origin-continent-info"><strong>Continent d'origine:</strong>  Amérique du Nord</p>
                <p class="habitat-info"><strong>Habitat:</strong> Marais</p>
            </div>
        </div>

        <div class="medical-section">
            <h2>Données Médicales</h2>
            <div class="medical-info">
                <p class="diet-info"><strong>Régime:</strong> protéines</p>
                <p class="last-visit-info"><strong>Dernière visite:</strong> 2024-07-19</p>
                <p class="general-state-info"><strong>État général:</strong> malade</p>
                <p class="weight-info"><strong>Grammage:</strong> 20.00 kg</p>
                <p class="comment-info"><strong>Commentaire:</strong> a surveiller</p>
            </div>
        </div>
    </div>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>