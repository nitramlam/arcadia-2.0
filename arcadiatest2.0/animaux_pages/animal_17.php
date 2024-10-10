<?php require_once (__DIR__ . '/../includes/header.php'); ?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Mariette - Page Personnalisée</title>
    <link rel='stylesheet' href='animauxPage.css'>
</head>
<body>
    <div class="animal-main">
        <h1 class="animal-title">Mariette</h1>
        <img class="animal-photo" src="/animaux/lamantin1.png" alt="Mariette">
        <div class="info-section">
            <h2>Informations Générales</h2>
            <div class="general-info">
                <p class="species-info"><strong>Espèce:</strong>  lamantin des Everglades</p>
                <p class="description-info"><strong>Description:</strong> Le lamantin des Everglades (Trichechus manatus latirostris) est une sous-espèce de lamantin qui vit exclusivement dans les eaux douces et les marais des Everglades en Floride. Reconnaissable à sa taille imposante et ses nageoires larges, il joue un rôle crucial dans l’écosystème de cet habitat unique, mais il est gravement menacé par la perte d’habitat et d’autres menaces. Des mesures de conservation sont essentielles pour assurer sa survie.</p>
                <p class="weight-info"><strong>Poids:</strong> 300.00 kg</p>
                <p class="sex-info"><strong>Sexe:</strong> F</p>
                <p class="origin-continent-info"><strong>Continent d'origine:</strong> Amérique du Nord</p>
                <p class="habitat-info"><strong>Habitat:</strong> marais</p>
            </div>
        </div>

        <div class="medical-section">
            <h2>Données Médicales</h2>
            <div class="medical-info">
                <p class="diet-info"><strong>Régime:</strong> herbe marines</p>
                <p class="last-visit-info"><strong>Dernière visite:</strong> 2024-07-19</p>
                <p class="general-state-info"><strong>État général:</strong> en bonne santé</p>
                <p class="weight-info"><strong>Grammage:</strong> 30.00 kg</p>
                <p class="comment-info"><strong>Commentaire:</strong> RAS</p>
            </div>
        </div>
    </div>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>