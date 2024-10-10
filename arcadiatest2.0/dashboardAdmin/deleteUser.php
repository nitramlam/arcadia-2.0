<?php
require '../config/db.php';
 // Inclure le fichier de configuration de la base de données

$pdo = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    try {
        $sql = "DELETE FROM utilisateurs WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $userId]);
        echo "Utilisateur supprimé";
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression de l'utilisateur: " . $e->getMessage();
    }
}
?>