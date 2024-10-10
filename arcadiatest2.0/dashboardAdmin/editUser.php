<?php
require '../config/db.php';
// Inclure le fichier de configuration de la base de données

$pdo = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    try {
        $sql = "UPDATE utilisateurs SET email = :email, role = :role WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email, ':role' => $role, ':id' => $userId]);
        echo "Utilisateur modifié";
    } catch (PDOException $e) {
        echo "Erreur lors de la modification de l'utilisateur: " . $e->getMessage();
    }
}
?>