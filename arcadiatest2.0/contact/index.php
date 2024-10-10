<?php require_once(__DIR__ . '/../includes/header.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire de Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="form-container">
        <div class="image">
            <img src="/animaux/ostrich-4828594_640.jpg" alt="Ostrich">
        </div>
     
        <form id="contactForm">
            <div class="form-group">
                <label for="email">Votre mail:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="subject">Sujet:</label>
                <input type="text" id="subject" name="subject" required>
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" cols="50" required></textarea>
            </div>

            <button type="submit" class="btn">Envoyer</button>
        </form>
    </div>

    <?php require_once(__DIR__ . '/../includes/footer.php'); ?>   

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            var formData = new FormData(this);

            fetch('envois.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                } else {
                    alert('Erreur: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de l\'envoi du message.');
            });
        });
    </script>
</body>
</html>