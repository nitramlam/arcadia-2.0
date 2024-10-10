<?php
require_once(__DIR__ . '/db.php'); // Connexion à la base de données

// Le nouvel email de l'utilisateur et le nouveau mot de passe
$email = 'josearcadia33@gmail.com';
$nouveauMotDePasse = 'JoseZOO33';

// Hashage du nouveau mot de passe
$hashedPassword = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);

try {
    // Préparation de la requête pour mettre à jour le mot de passe
    $stmt = $conn->prepare("UPDATE utilisateurs SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashedPassword, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Mot de passe modifié avec succès pour $email.";
    } else {
        echo "Aucun utilisateur trouvé avec cet email ou aucune modification nécessaire.";
    }
    
    $stmt->close();
} catch (Exception $e) {
    echo "Erreur lors de la modification du mot de passe : " . $e->getMessage();
}

$conn->close();
?>