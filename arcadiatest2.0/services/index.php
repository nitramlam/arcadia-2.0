<?php
require_once (__DIR__ . '/../includes/header.php');
require_once (__DIR__ . '/../db.php'); // Connexion à la base de données

// Vérifier si la connexion à la base de données est établie
if (!$conn) {
    die("Erreur de connexion à la base de données");
}

// Sélection et affichage des données des services
$sql = "SELECT * FROM service";
$result = $conn->query($sql);
$services = $result->fetch_all(MYSQLI_ASSOC);

// Sélection et affichage des horaires d'ouverture
$sqlHoraires = "SELECT * FROM horaires LIMIT 1";
$resultHoraires = $conn->query($sqlHoraires);
$horaires = $resultHoraires->fetch_assoc();
?>

<link rel="stylesheet" href="services.css">

<main>
    <div class="services">
        <div class="introServices">
            <h1 class="titreServices">NOS SERVICES</h1>
            <p class="paragrapheServices">
                Découvrez notre zoo de manière enrichissante avec un restaurant proposant des produits locaux et biologiques, des visites guidées interactives gratuites qui vous plongent dans l'univers captivant de nos animaux, et des circuits en petit train électrique respectueux de notre écosystème.
            </p>
            <img src="assets/restaurant-services.png" alt="Zoo Map" class="zoo-map">
        </div>
        <div class="icons-services">
            <img src="assets/icons-services.png" alt="Icons Services">
        </div>
        <div class="opening-hours">
            <h2>HORAIRES D'OUVERTURE</h2>
            <?php if ($horaires): ?>
                <p>Ouvert tous les jours de <?= htmlspecialchars($horaires['ouverture']) ?> à <?= htmlspecialchars($horaires['fermeture']) ?></p>
            <?php else: ?>
                <p>Horaires non disponibles</p>
            <?php endif; ?>
        </div>
        <div class="services-list">
            <?php foreach ($services as $service): ?>
                <div class="service-item">
                    <h3 class="service-titre"><?= htmlspecialchars($service['nom']) ?></h3>
                    <img src="<?= htmlspecialchars($service['icons_path'] ?? '/imageServices/default.jpg') ?>" alt="<?= htmlspecialchars($service['nom']) ?>" class="service-image">
                    <p class="service-description"><?= nl2br(htmlspecialchars($service['description'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php require_once (__DIR__ . '/../includes/footer.php'); ?> 