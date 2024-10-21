<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier que l'utilisateur est authentifié et que le token est présent
if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || !isset($_SESSION['token']) || !isset($_COOKIE['user_token'])) {
    error_log("Redirection vers connexion.php : utilisateur non authentifié ou token manquant");
    header("Location: /connexion/connexion.php");
    exit();
}

// Vérifier que le token envoyé par le client correspond à celui de la session
if (!hash_equals($_SESSION['token'], $_COOKIE['user_token'])) {
    error_log("Token invalide, redirection vers connexion.php");
    session_unset();  // Détruire la session
    session_destroy();
    header("Location: /connexion/connexion.php");
    exit();
}

// Générer un token CSRF si ce n'est pas déjà fait dans la session
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Génère un token unique de 64 caractères
}

// Si l'utilisateur est authentifié et que le token est valide
error_log("Utilisateur authentifié : " . $_SESSION['email'] . " avec le rôle " . $_SESSION['role']);
?>