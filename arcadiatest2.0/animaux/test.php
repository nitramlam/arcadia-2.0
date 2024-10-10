<?php
require '../config/db.php'; // Inclure le fichier de configuration de la base de données

// Obtenir une connexion à la base de données
$pdo = getDatabaseConnection();

// Vérifier si la connexion à la base de données est établie avec succès
if ($pdo) {
    // Requête SQL pour sélectionner les animaux de l'habitat 'Jungle'
    $sql = "SELECT * FROM animal WHERE habitat_id = 0"; // Remplacez 0 par l'ID correspondant à l'habitat 'Jungle'

    try {
        // Exécution de la requête
        $stmt = $pdo->query($sql);
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer tous les résultats comme un tableau associatif
    } catch (PDOException $e) {
        die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
    }
}
?>
<?php require_once (__DIR__ . '/../includes/header.php'); ?>

<head>
    <title>Liste des animaux de la Jungle</title>
    <style>
        /* Vos styles CSS ici */
    </style>
</head>
<body>
    <main>
        <div class="animaux">
            <h1>Liste des animaux de la Jungle</h1>
            <div class="row">
                <?php foreach ($animaux as $animal): ?>
                    <div class="col-md-4">
                        <div class="animal-card">
                            <h3><?= htmlspecialchars($animal['nom']) ?></h3>
                            <p><strong>Espèce:</strong> <?= htmlspecialchars($animal['espece']) ?></p>
                            <p><strong>État général:</strong> <?= htmlspecialchars($animal['etat_general']) ?></p>
                            <p><strong>Régime:</strong> <?= htmlspecialchars($animal['regime']) ?></p>
                            <p><strong>Poids:</strong> <?= $animal['poids'] ?> kg</p>
                            <p><strong>Sexe:</strong> <?= htmlspecialchars($animal['sexe']) ?></p>
                            <p><strong>Dernière visite:</strong> <?= $animal['derniere_visite'] ?></p>
                            <?php if (isset($animal['commentaire'])): ?>
                                <p><strong>Commentaire:</strong> <?= htmlspecialchars($animal['commentaire']) ?></p>
                            <?php else: ?>
                                <p><strong>Commentaire:</strong> Aucun commentaire disponible</p>
                            <?php endif; ?>
                            <p><strong>Continent d'origine:</strong> <?= htmlspecialchars($animal['continent_origine']) ?></p>
                            <p><strong>Âge:</strong> <?= $animal['age'] ?> ans</p>
                            <p><strong>Habitat:</strong> <?= htmlspecialchars($animal['habitat']) ?></p>
                            <p><strong>Grammage:</strong> <?= $animal['grammage'] ?> kg</p>
                            <p><strong>Description:</strong> <?= htmlspecialchars($animal['description']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>