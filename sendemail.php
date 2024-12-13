<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // PHPMailer einbinden

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formularwerte abrufen
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // PHPMailer-Instanz erstellen
    $mail = new PHPMailer(true);

    try {
        // SMTP-Konfiguration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP-Server (z. B. Gmail)
        $mail->SMTPAuth = true;
        $mail->Username = 'piasimpulse@gmail.com'; // Deine Gmail-Adresse
        $mail->Password = 'vdic jxey zttc pvqg'; // App-Passwort
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Absender und Empfänger
        $mail->setFrom($email, $name); // Absender: Formular-Eingabe
        $mail->addAddress('piasimpulse@gmail.com'); // Deine E-Mail-Adresse

        // E-Mail-Inhalt
        $mail->isHTML(true);
        $mail->Subject = 'Neue Nachricht vom Kontaktformular';
        $mail->Body = "
            <h2>Neue Nachricht</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>E-Mail:</strong> $email</p>
            <p><strong>Nachricht:</strong><br>$message</p>
        ";

        // Senden
        $mail->send();
        echo 'Nachricht wurde gesendet.';
    } catch (Exception $e) {
        echo "Fehler beim Senden der Nachricht: {$mail->ErrorInfo}";
    }
} else {
    echo 'Ungültige Anfrage.';
}