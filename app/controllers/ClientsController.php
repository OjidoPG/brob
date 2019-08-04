<?php

use Phalcon\Mvc\Controller;

class ClientsController extends Controller
{

    public function getClientsAction()
    {
        return json_encode(Clients::find());
    }
    /**
     * @return false|string
     */
    public function postClientsAction()
    {
        $messagesRetour = [];
        /** @var Clients $client */
        $client = new Clients();
        $client->setNom($_POST['nom']);
        $client->setPrenom($_POST['prenom']);
        $client->setTelephone($_POST['telephone']);
        $client->setMail($_POST['mail']);
        $client->setAdresse($_POST['adresse']);
        $client->setCodepostal($_POST['codepostal']);
        $client->setVille($_POST['ville']);
        $client->setEmplacementsId($_POST['emplacements_id']);
        if (!$client->save()) {
            $messages = $client->getMessages();
            foreach ($messages as $message) {
                $erreur = [
                    'Field' => $message->getField(),
                    'Message' => $message->getMessage(),
                    "Type" => $message->getType(),
                ];
                array_push($messagesRetour, $erreur);
            }
        } else {
            $messagesRetour = [
                'Message' => 'Vous êtes bien enregistré',
                'Field' => 'Reussite'
            ];
        }
        return json_encode($messagesRetour);
    }

}

