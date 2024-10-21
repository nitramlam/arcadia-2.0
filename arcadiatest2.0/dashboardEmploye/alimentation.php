<?php 
session_start();
require_once(__DIR__ . '/../includes/auth.php'); 
require_once(__DIR__ . '/../includes/header.php'); 
require_once(__DIR__ . '/../db.php'); // Connexion à la base de données

// Vérification du rôle de l'utilisateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'employe') {
    header("Location: /connexion/connexion.php");
    exit();
}

// Générer un token CSRF s'il n'existe pas déjà dans la session
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Gestion des soumissions des formulaires
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification du token CSRF
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Échec de la validation CSRF.');
    }

    if (isset($_POST['update_animal'])) {
        // Mettre à jour les informations de passage de l'employé
        $animal_id = $_POST['animal_id'];
        $date_heure_passage_employe = $_POST['date_heure_passage_employe'];
        $grammage_donne = $_POST['grammage_donne'];
        $nourriture_donnee = $_POST['nourriture_donnee'];
        $stmt = $conn->prepare("UPDATE animal SET date_heure_passage_employe = ?, grammage_donne = ?, nourriture_donnee = ? WHERE animal_id = ?");
        $stmt->bind_param("sdsi", $date_heure_passage_employe, $grammage_donne, $nourriture_donnee, $animal_id);
        $stmt->execute();
    }
}

// Récupérer les données des animaux
$animalQuery = $conn->query("SELECT * FROM animal");
$animals = $animalQuery->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page Employé</title>
    <link rel="stylesheet" href="alim.css">
</head>
<body>
    <main>
        <section class="intro">
            <h2>Gestion des Passages des Employés</h2>
          
        </section>
        <section class="animal-list">
            <?php foreach ($animals as $animal): ?>
                <div class="animal-card">
                    <h3><?php echo htmlspecialchars($animal['nom'] ?? ''); ?></h3>
                    <button class="edit-toggle">✏️</button>
                    <form method="POST" class="animal-form" style="display: none;">
                        <!-- Ajout du token CSRF -->
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="animal_id" value="<?php echo htmlspecialchars($animal['animal_id'] ?? ''); ?>">
                        <label>Date et Heure de Passage: <input type="datetime-local" name="date_heure_passage_employe" value="<?php echo htmlspecialchars($animal['date_heure_passage_employe'] ?? ''); ?>" required></label>
                        <label>Grammage Donné: <input type="number" step="0.01" name="grammage_donne" value="<?php echo htmlspecialchars($animal['grammage_donne'] ?? ''); ?>" required></label>
                        <label>Nourriture Donnée: <input type="text" name="nourriture_donnee" value="<?php echo htmlspecialchars($animal['nourriture_donnee'] ?? ''); ?>" required></label>
                        <button type="submit" name="update_animal" class="edit-btn">Mettre à jour</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editToggles = document.querySelectorAll('.edit-toggle');
            editToggles.forEach(button => {
                button.addEventListener('click', () => {
                    const form = button.nextElementSibling;
                    form.style.display = form.style.display === 'block' ? 'none' : 'block';
                });
            });
        });
    </script>
</body>
</html>