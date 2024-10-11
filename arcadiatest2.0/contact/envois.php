<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$autoload_path = '../vendor/autoload.php';

if (file_exists($autoload_path)) {
    require $autoload_path;
} else {
    echo json_encode(['status' => 'error', 'message' => "Autoload file not found at: " . $autoload_path]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_POST['email']; // Adresse e-mail de l'utilisateur
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $recipient_email = 'employearcadia33@gmail.com'; // Adresse e-mail fixe pour le destinataire

    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'employearcadia33@gmail.com'; // Adresse e-mail utilisée pour l'authentification SMTP
        $mail->Password   = 'innv jslk sqfd ovjb'; // Mot de passe d'application pour Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Configuration des destinataires
        $mail->setFrom($user_email, 'Utilisateur du formulaire'); // L'adresse e-mail de l'utilisateur est définie comme expéditeur
        $mail->addAddress($recipient_email); // L'adresse e-mail du destinataire est fixe
        $mail->addReplyTo($user_email); // Permettre au destinataire de répondre directement à l'utilisateur

        // Contenu de l'e-mail
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "Adresse e-mail de l'utilisateur : " . htmlspecialchars($user_email) . "<br><br>" . nl2br(htmlspecialchars($message));
        $mail->AltBody = "Adresse e-mail de l'utilisateur : " . htmlspecialchars($user_email) . "\n\n" . htmlspecialchars($message);

        // Envoi de l'e-mail
        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Message envoyé avec succès']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => "Le message n'a pas pu être envoyé. Erreur de Mailer : {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Méthode de requête invalide.']);
}