<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    error_log("Redirection vers connexion.php : utilisateur non authentifié");
    header("Location: /connexion/connexion.php");
    exit();
} else {
    error_log("Utilisateur authentifié : " . $_SESSION['email'] . " avec le rôle " . $_SESSION['role']);
}
?>