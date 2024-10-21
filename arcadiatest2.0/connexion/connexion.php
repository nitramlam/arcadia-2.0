<?php
ob_start();
require_once(__DIR__ . '/../includes/header.php'); // Inclure le fichier de header
require_once(__DIR__ . '/../db.php'); // Inclure le fichier de configuration de la base de données

$error_message = '';

// Fonction pour générer un token unique
function generateToken() {
    return bin2hex(random_bytes(32)); // Token de 64 caractères (32 octets)
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Adresse e-mail invalide.";
    } else {
        // Vérifier si la connexion à la base de données est établie
        if ($conn) {
            try {
                $sql = "SELECT * FROM utilisateurs WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();

                if ($user && password_verify($password, $user['password'])) {
                    // Stocker les informations de l'utilisateur dans la session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['LAST_ACTIVITY'] = time(); // Initialiser LAST_ACTIVITY

                    // Générer et stocker le token dans la session
                    $_SESSION['token'] = generateToken();

                    // Envoyer le token au client via un cookie sécurisé (HTTP only et sécurisé)
                    setcookie('user_token', $_SESSION['token'], time() + 3600, '/', '', true, false);

                    error_log("Rôle de l'utilisateur : " . $user['role']); // Débogage

                    // Rediriger l'utilisateur en fonction de son rôle
                    switch ($user['role']) {
                        case 'administrateur':
                            header("Location: /dashboardAdmin/dashboardAdmin.php");
                            exit();
                        case 'veterinaire':
                            header("Location: /dashboardVeto/dashboardVeto.php");
                            exit();
                        case 'employe':
                            header("Location: /dashboardEmploye/dashboardEmploye.php");
                            exit();
                        default:
                            $error_message = "Rôle d'utilisateur inconnu.";
                            error_log($error_message); // Débogage
                    }
                } else {
                    $error_message = "Identifiants incorrects.";
                    error_log($error_message); // Débogage
                }
            } catch (Exception $e) {
                $error_message = "Erreur lors de la connexion : " . $e->getMessage();
                error_log($error_message); // Débogage
            }
        } else {
            $error_message = "Erreur : Impossible de se connecter à la base de données.";
            error_log($error_message); // Débogage
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="connexion.css"> 
</head>
<body>
    <h1>Connexion</h1>
    <?php if ($error_message): ?>
        <p class="error-message"><?= $error_message ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <div class="form-group">
            <label for="email">Adresse mail:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility('password')">👁️</span>
            </div>
        </div>
        <button type="submit" class="btn-submit">Se connecter</button>
    </form>

    <script>
        function togglePasswordVisibility(id) {
            var input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
    <?php require_once(__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>

<?php
ob_end_flush();
?>