<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailsController extends ControllerBase
{
    /**
     * Gère la récupération des adresses et du message et lance la fonction d'envoi de mails
     * @return false|string
     * @throws Exception
     */
    public function envoiMailsAction()
    {
        $mailTab = json_decode($this->request->getPost("mails"));
        $message = $this->request->getPost("message");

        $messagesRetour = [];
        $bool = true;
        foreach ($mailTab as $adresseMail) {
            if (!$this->phpMailer($adresseMail, $message)){
                $bool = false;
            }
        }

        if (!$bool) {
            return $this->response([
                'Erreurs' => $messagesRetour
            ]);
        }
        array_push($messagesRetour, [
            'Type' => 'Reussite',
            'Message' => 'Les e-mails ont correctement été envoyés'
        ]);
        return $this->response([
            'Success' => $messagesRetour
        ]);
    }

    /**
     * Envoi les mails
     * @param $adresseMail
     * @param $message
     * @return bool
     * @throws Exception
     */
    public function phpMailer($adresseMail, $message)
    {
        $mail = new PHPMailer(true);

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
            return false;
        }
        return true;
    }
}
