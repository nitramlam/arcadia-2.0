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
    $recipient_email = 'employearcadia33@gmail.com'; // Adresse e-mail fixe pour tous les destinataires

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                      // Disable verbose debug output
        $mail->isSMTP();                                           // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                      // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                  // Enable SMTP authentication
        $mail->Username   = 'employearcadia33@gmail.com';             // SMTP username
        $mail->Password   = 'rvjk rcrm kfwp jtbd';                 // SMTP password (mot de passe d'application)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                   // TCP port to connect to

        //Recipients
        $mail->setFrom('josearcadia33@gmail.com', 'Mailer');       // Adresse e-mail de l'expéditeur
        $mail->addAddress($recipient_email);                       // Adresse e-mail de destination (toujours josearcadia33@gmail.com)
        $mail->addReplyTo($user_email);                            // Adresse e-mail de l'utilisateur pour la réponse

        // Content
        $mail->isHTML(true);                                       // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "Adresse e-mail de l'utilisateur: " . $user_email . "<br><br>" . $message;
        $mail->AltBody = "Adresse e-mail de l'utilisateur: " . $user_email . "\n\n" . strip_tags($message);

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Message has been sent']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>