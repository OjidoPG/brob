<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailsController extends ControllerBase
{
    public function envoiMailsAction()
    {
        $mailTab = json_decode($this->request->getPost("mails"));
        $message = $this->request->getPost("message");

        $messagesRetour=[];

        if (!$this->mailerPHP($mailTab, $message)) {
            return $this->response([
                'Erreurs' => $messagesRetour
            ]);
        }

        array_push($messagesRetour, [
            'Type' => 'Reussite',
            'Message' => 'Les mails ont bien été envoyés !'
        ]);
        return $this->response([
            'Success' => $messagesRetour
        ]);
    }

    public function mailerPHP($mailTab, $message)
    {
        $mail = new PHPMailer();
        try {
            //$mail->SMTPDebug = 2;
            //$mail->isSMTP();  
            $mail->Host = 'localhost';
            //$mail->Username = null;
            //$mail->Password = null;
            //$mail->SMTPSecure = null;
            $mail->Port = 1025;

            $mail->setFrom('from@example.com', 'Mailer');

            foreach($mailTab as $mails){
                $mail->addAddress($mails);
            }
            $mail->Subject = 'Message administrateur de la brocante d\'Eulmont';
            $mail->Body = $message;
            $mail->send();

            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
