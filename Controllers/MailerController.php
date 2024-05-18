<?php

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailerController
{

    public function sendMail($to, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            // Paramètres du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'abdelmoumen.mallem@gmail.com';
            $mail->Password = 'eebdpnjcfitkajhr';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

            // Destinataire
            $mail->setFrom('abdelmoumen.mallem@gmail.com', 'Mallem');
            $mail->addAddress($to);

            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            // Envoyer l'e-mail
            $mail->send();
            return $mail;
        } catch (Exception $e) {
            return 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->$e;
        }
    }
}
