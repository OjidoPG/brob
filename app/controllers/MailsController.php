<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailsController extends ControllerBase
{

    public function envoiMailsAction()
    {
        $mailTab = json_decode($this->request->getPost("mails"));
        $message = $this->request->getPost("message");

        foreach ($mailTab as $adresseMail) {
            Mails::phpMailer($adresseMail, $message);
        }
    }

    public function phpMailer($adresseMail, $message)
    {
        $mail = new PHPMailer(true);

        $messagesRetour = [];

        //Server settings
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host       = self::SMTP_OUTLOOK_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = self::SENDER;
        $mail->Password   = self::MDP;
        $mail->SMTPSecure = self::SMTP_SECURITE;
        $mail->Port       = self::SMTP_PORT;

        //Recipients
        $mail->setFrom(self::SENDER);
        $mail->addAddress($adresseMail);

        // Content
        $mail->isHTML(false);                                  // Set email format to HTML
        $mail->Subject = self::SUJET;
        $mail->AltBody = $message;

        if (!$mail->send()) {
            return $this->response([
                'Erreurs' => $messagesRetour
            ]);
        }
        array_push($messagesRetour, [
            'Type' => 'Reussite',
            'Message' => 'Le statut de l\'emplacement a été modifié'
        ]);
        return $this->response([
            'Success' => $messagesRetour
        ]);
    }
}
