<?php 
require_once (__DIR__ . '/../includes/header.php');
require_once (__DIR__ . '/../db.php'); // Inclure db.php pour la connexion à la base de données

// Vérifier si la connexion à la base de données est établie
if (!$conn) {
    die("Erreur de connexion à la base de données");
}

// Requête SQL pour sélectionner tous les animaux
$sql = "SELECT * FROM animal";
$result = $conn->query($sql);
$animaux = $result->fetch_all(MYSQLI_ASSOC);

// Requête SQL pour sélectionner tous les habitats
$sql = "SELECT * FROM habitat";
$result = $conn->query($sql);
$habitats = $result->fetch_all(MYSQLI_ASSOC);

// Récupérer les animaux par habitat
$animalsByHabitat = [];
foreach ($habitats as $habitat) {
    $stmt = $conn->prepare("SELECT * FROM animal WHERE habitat = ?");
    $stmt->bind_param("s", $habitat['nom']);
    $stmt->execute();
    $result = $stmt->get_result();
    $animalsByHabitat[$habitat['nom']] = $result->fetch_all(MYSQLI_ASSOC);
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Animaux</title>
    <link rel="stylesheet" href="animaux.css"> 
</head>
<body>

<main>
    <div class="intro">
        <h1>Nos Animaux</h1>
        <p>Au Zoo Écologique de la Forêt de Brocéliande, nous créons des habitats fidèles aux milieux naturels de nos animaux, assurant  leur bien-être et contribuant à la préservation des écosystèmes. Rencontrez nos majestueux lions, éléphants, alligators et bien d'autres résidents fascinants au cœur de notre zoo.</p>
    </div>
    <div class="animaux">
        <?php foreach ($animaux as $animal): ?>
            <div class="animal">
                <h3><?= htmlspecialchars($animal['nom']) ?></h3>
                <p><?= htmlspecialchars($animal['espece']) ?></p>
                <a href="<?= htmlspecialchars($animal['page_personnalisee_url']) ?>">
                    <img src="<?= htmlspecialchars($animal['image_path'] ?? '/animaux/default.jpg') ?>" alt="<?= htmlspecialchars($animal['nom']) ?>" style="max-width: 200px;">
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="habitats">
        <h2>Habitats</h2>
        <?php foreach ($habitats as $habitat): ?>
            <div class="habitat">
                <h3><?= htmlspecialchars($habitat['nom']) ?></h3>
             
                <div class="animals-in-habitat">
                    <?php foreach ($animalsByHabitat[$habitat['nom']] as $animal): ?>
                        <div class="animal-in-habitat">
                            <a href="<?= htmlspecialchars($animal['page_personnalisee_url']) ?>">
                                <img src="<?= htmlspecialchars($animal['image_path'] ?? '/animaux/default.jpg') ?>" alt="<?= htmlspecialchars($animal['nom']) ?>">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>