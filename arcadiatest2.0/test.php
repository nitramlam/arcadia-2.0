<?php
// Inclure le fichier db.php pour établir la connexion
require_once 'db.php';

// Requête SQL pour récupérer les animaux
$sql = "SELECT * FROM animal";
$result = $conn->query($sql);

// Vérifier s'il y a des résultats
if ($result && $result->num_rows > 0) {
    echo "<h1>Liste des animaux</h1>";
    echo "<ul>";
    // Afficher les données de chaque ligne
    while ($row = $result->fetch_assoc()) {
        echo "<li><strong>Nom :</strong> " . htmlspecialchars($row['nom']) . " - <strong>Espèce :</strong> " . htmlspecialchars($row['espece']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "Aucun animal trouvé dans la base de données.";
}

// Fermer la connexion
$conn->close();
?>