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

// Traitement des actions de formulaire POST
if ($conn && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && isset($_POST['avis_id'])) {
    $avis_id = $_POST['avis_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        // Approuver l'avis
        $sql_approve = "UPDATE AVIS SET isApproved = 1, isVisible = 1 WHERE avis_id = ?";
        $stmt_approve = $conn->prepare($sql_approve);
        $stmt_approve->bind_param('i', $avis_id);
        $stmt_approve->execute();
    } elseif ($action === 'delete') {
        // Supprimer l'avis
        $sql_delete = "DELETE FROM AVIS WHERE avis_id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param('i', $avis_id);
        $stmt_delete->execute();
    }
}

// Récupérer tous les avis (approuvés et non approuvés)
$sql_all_avis = "SELECT * FROM AVIS";
$result_all_avis = $conn->query($sql_all_avis);
$all_avis = $result_all_avis->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Avis</title>
    <link rel="stylesheet" href="../avis/validation.css">
    <style>
        .avis {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .avis .actions {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<main>
    <div class="validation">
        <h1>Gestion des Avis</h1>

        <?php if (empty($all_avis)) : ?>
            <p>Aucun avis trouvé.</p>
        <?php else : ?>
            <?php foreach ($all_avis as $avis) : ?>
                <div class="avis">
                    <p><strong>Pseudo:</strong> <?= htmlspecialchars($avis['pseudo']); ?></p>
                    <p><strong>Commentaire:</strong> <?= htmlspecialchars($avis['commentaire']); ?></p>
                    <div class="actions">
                        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="avis_id" value="<?= $avis['avis_id']; ?>">
                            <?php if (!$avis['isApproved'] || !$avis['isVisible']) : ?>
                                <!-- Boutons pour les avis en attente de validation -->
                                <button type="submit" name="action" value="approve">Approuver</button>
                                <button type="submit" name="action" value="delete">Supprimer</button>
                            <?php else : ?>
                                <!-- Bouton uniquement pour les avis approuvés -->
                                <button type="submit" name="action" value="delete">Supprimer</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<?php require_once(__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>