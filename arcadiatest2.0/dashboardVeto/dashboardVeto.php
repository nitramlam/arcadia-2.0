<?php 
require_once(__DIR__ . '/../includes/auth.php'); 
require_once(__DIR__ . '/../includes/header.php'); 
; ?>


<head>
 
    <link rel="stylesheet" href="dashboardVeto.css">
</head>
<body>
    <main>
        <section class="employee-space">
            <h1>ESPACE VETERINAIRE</h1>
            <div class="grid-container">
                <div class="grid-item green">
                    <a href="/dashboardVeto/habitats.php">HABITAT</a>
                </div>
                <div class="grid-item blue">
                    <a href="/dashboardVeto/employe.php">passage employé</a>
                </div>
                <div class="grid-item brown">
                    <a href="/dashboardVeto/compteRendu.php">COMPTE RENDU</a>
                </div>
        </section>
    </main>
    


<?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>

