<?php
require_once(__DIR__ . '/../includes/auth.php'); 
require_once(__DIR__ . '/../includes/header.php');   
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Employé</title>
    <link rel="stylesheet" href="dashboardEmploye.css">
</head>
<body>
    <main>
        <section class="employee-space">
            <h1>ESPACE EMPLOYÉ</h1>
            <div class="grid-container">
                <div class="grid-item green">
                    <a href="/dashboardEmploye/alimentation.php">ALIMENTATION ANIMAUX</a>
                </div>
                <div class="grid-item blue">
                    <a href="/dashboardAdmin/modifierServices.php">MODIFIER LES SERVICES</a>
                </div>
                <div class="grid-item brown">
                    <a href="/avis/validation.php">ESPACE COMMENTAIRE</a>
                </div>
            </div>
        </section>
    </main>
    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>