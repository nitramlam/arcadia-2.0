<?php
require_once(__DIR__ . '/../includes/header.php');
require_once(__DIR__ . '/../db.php');
?>

<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
    

<main>
    <!-- Intro section -->
    <div class="intro">
        <h1 class="parc">parc animalier arcadia</h1>
        <div class="sousTitre">
            <h3 class="eco">éco-responsable</h3>
        </div>
        <p class="lorem">Depuis 1960, le Zoo Écologique de la Forêt de Brocéliande s'inscrit dans le respect de la
            nature de la légendaire forêt de Brocéliande en Bretagne. Venez explorer nos habitats naturels et
            découvrir notre engagement en faveur de la conservation environnementale.</p>
        <img src="assets/lion-accueil.png" alt="Image d'un lion" class="lion">
    </div>
    <!-- End of intro section -->

    <!-- Icons section -->
    <div class="icons">
        <img src="assets/icons-accueil.png" alt="Icônes d'accueil">
    </div>
    <div class="services">
        <h2 class="servicesTitre">LES SERVICES</h2>
        <p class="servicesLorem">Découvrez notre restaurant, notre petit train et bénéficiez d'un guide gratuit pour enrichir votre expérience au Zoo Écologique de la Forêt de Brocéliande.</p>
        <img  class="autruche"  src="assets/autruche-accueil.png" alt="autruche">
       <a href="/services/index.php" class="flecheServices"> <img  src="assets/fleches-accueil.png" alt="Fleche pour voir les animaux"></a>

    </div>
    <!-- End of icons section -->

    <!-- Grid section -->
    <div class="grid-section">
        <div class="gridEnergie">
            <h3>Le premier zoo au monde 100% autonome en energie<h3>
        </div>
        <div class="gridHabitats">
            <h3  class="titreHabitats" >LES HABITATS</h3>
            <p class="loremHabitats">Explorez notre variété d'animaux dans des habitats reconstitués : la jungle luxuriante, les marais préservés et la savane durablement aménagée.</p>
            <img class="toucan"  src="assets/toucan-accueil.png" alt="Image d'un toucan">
            <a href="/habitats/index.php" class="flecheHabitats"><img src="assets/fleches-accueil.png" alt="Fleche pour voir les habitats"></a>
        </div>
        <div class="gridAnimaux">
            <h3 class="animauxTitre">LES ANIMAUX</h3>
            <p class="animauxLorem">Rencontrez nos résidents exceptionnels, élevés dans un environnement respectueux de leur bien-être et de la nature.</p>
            <img class="paresseux" src="assets/paresseux-accueil.png" alt="Image d'un paresseux">
            <a href="/animaux/index.php" class="flecheAnimaux"><img src="assets/fleches-accueil.png" alt="Fleche pour voir les animaux"></a>
        </div>
        <div class="gridImage">
            <img src="assets/zoo.png" alt="Image du zoo">
        </div>
    </div>
    <!-- End of grid section -->

    <!-- Avis section -->
 
        <?php require_once (__DIR__ . '/../avis/index.php'); ?>
    
    <!-- End of avis section -->
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>

<?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>