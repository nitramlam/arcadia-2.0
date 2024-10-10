<?php
session_start();
require_once(__DIR__ . '/../includes/auth.php'); 
require_once(__DIR__ . '/../includes/header.php'); 
require_once(__DIR__ . '/../db.php'); // Connexion à la base de données
require_once(__DIR__ . '/mailUser.php');

$error_message = '';
$success_message = '';

// Vérification que l'utilisateur est connecté et qu'il a le rôle d'administrateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'administrateur') {
    header("Location: /connexion/connexion.php");
    exit();
}

// Gestion des requêtes POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_user'])) {
        // Suppression d'un utilisateur
        $user_id = intval($_POST['user_id']);
        $stmt = $conn->prepare("DELETE FROM utilisateurs WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $success_message = "Utilisateur supprimé avec succès.";
        } else {
            $error_message = "Erreur lors de la suppression de l'utilisateur: " . $conn->error;
        }
    } elseif (isset($_POST['edit_user'])) {
        // Modification d'un utilisateur
        $user_id = intval($_POST['user_id']);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $role = isset($_POST['role']) ? $_POST['role'] : '';
        $new_password = trim($_POST['new_password']);
        $confirm_new_password = trim($_POST['confirm_new_password']);
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Adresse e-mail invalide.";
        } elseif (empty($role)) {
            $error_message = "Veuillez sélectionner un rôle.";
        } elseif (!empty($new_password) || !empty($confirm_new_password)) {
            $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
            if (!preg_match($password_regex, $new_password)) {
                $error_message = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.";
            } elseif ($new_password !== $confirm_new_password) {
                $error_message = "Les mots de passe ne correspondent pas.";
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE utilisateurs SET email = ?, role = ?, password = ? WHERE id = ?");
                $stmt->bind_param("sssi", $email, $role, $hashed_password, $user_id);
                if ($stmt->execute()) {
                    $success_message = "Utilisateur modifié avec succès.";
                } else {
                    $error_message = "Erreur lors de la modification de l'utilisateur: " . $conn->error;
                }
            }
        } else {
            $stmt = $conn->prepare("UPDATE utilisateurs SET email = ?, role = ? WHERE id = ?");
            $stmt->bind_param("ssi", $email, $role, $user_id);
            if ($stmt->execute()) {
                $success_message = "Utilisateur modifié avec succès.";
            } else {
                $error_message = "Erreur lors de la modification de l'utilisateur: " . $conn->error;
            }
        }
    } else {
        // Création d'un utilisateur
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm-password']);
        $role = isset($_POST['role']) ? $_POST['role'] : '';

        $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Adresse e-mail invalide.";
        } elseif (!preg_match($password_regex, $password)) {
            $error_message = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.";
        } elseif ($password !== $confirm_password) {
            $error_message = "Les mots de passe ne correspondent pas.";
        } elseif (empty($role)) {
            $error_message = "Veuillez sélectionner un rôle.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO utilisateurs (email, password, role) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $hashed_password, $role);
            if ($stmt->execute()) {
                $success_message = "Utilisateur créé avec succès.";

                // Envoi de l'email avec PHPMailer
                $to = $email;
                $subject = "Votre compte Arcadia";
                $message = "Votre compte utilisateur a été créé avec succès. Veuillez contacter l'administrateur pour obtenir votre mot de passe.";

                sendEmail($to, $subject, $message);
            } else {
                $error_message = "Erreur lors de la création de l'utilisateur: " . $conn->error;
            }
        }
    }
}

// Récupérer les utilisateurs
$users = [];
$result = $conn->query("SELECT * FROM utilisateurs");
if ($result) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $error_message = "Erreur lors de la récupération des utilisateurs: " . $conn->error;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte utilisateur</title>
    <link rel="stylesheet" href="creerCompte.css">
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm-password").value;
            var passwordError = "";

            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

            if (!regex.test(password)) {
                passwordError = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.";
                document.getElementById("password-error").textContent = passwordError;
                return false;
            }

            if (password !== confirmPassword) {
                passwordError = "Les mots de passe ne correspondent pas.";
                document.getElementById("password-error").textContent = passwordError;
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h1>Créer un compte utilisateur</h1>
    <?php if ($error_message): ?>
        <p class="error-message"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>
    <?php if ($success_message): ?>
        <p class="success-message"><?= htmlspecialchars($success_message) ?></p>
    <?php endif; ?>

    <form method="post" action="" onsubmit="return validateForm();">
        <div class="form-group">
            <label for="role">Créer un compte:</label>
            <div class="role-options">
                <label><input type="radio" name="role" value="veterinaire"> Vétérinaire</label>
                <label><input type="radio" name="role" value="employe"> Employé</label>
            </div>
        </div>
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
        <div class="form-group">
            <label for="confirm-password">Confirmer le mot de passe:</label>
            <div class="password-container">
                <input type="password" id="confirm-password" name="confirm-password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility('confirm-password')">👁️</span>
            </div>
        </div>
        <p id="password-error" class="error-message"></p>
        <button type="submit" class="btn-submit">Valider</button>
    </form>

    <h2>Liste des utilisateurs</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                            <input type="hidden" name="edit_user" value="1">
                            <input type="text" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                            <select name="role" required>
                                <option value="veterinaire" <?= $user['role'] == 'veterinaire' ? 'selected' : '' ?>>Vétérinaire</option>
                                <option value="employe" <?= $user['role'] == 'employe' ? 'selected' : '' ?>>Employé</option>
                                <option value="administrateur" <?= $user['role'] == 'administrateur' ? 'selected' : '' ?>>Administrateur</option>
                            </select>
                            <input type="password" name="new_password" placeholder="Nouveau mot de passe">
                            <input type="password" name="confirm_new_password" placeholder="Confirmer le nouveau mot de passe">
                            <button type="submit">Modifier</button>
                        </form>
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                            <input type="hidden" name="delete_user" value="1">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php require_once(__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>