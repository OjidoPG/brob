<?php

use Phalcon\Filter;
use Phalcon\Http\Response\StatusCode;

class ClientsController extends ControllerBase
{

    public function getClientsAction()
    {
        return $this->response([
            'liste' => Clients::find()
        ]);
    }

    public function postClientsAction()
    {
        $messagesRetour = [];

        /** @var Clients $client */
        $client = new Clients;
        $client->setNom($this->request->getPost('nom', Filter::FILTER_TRIM, null));
        $client->setPrenom($this->request->getPost('prenom', Filter::FILTER_TRIM, null));
        $client->setTelephone($_POST['telephone']);
        $client->setMail($_POST['mail']);
        $client->setAdresse($_POST['adresse']);
        $client->setCodepostal($_POST['codepostal']);
        $client->setVille($_POST['ville']);
        $client->setEmplacementsId($_POST['emplacements_id']);

        if (!$client->save()) {
            $messages = $client->getMessages();
            foreach ($messages as $message) {
                array_push($messagesRetour, [
                    'Field' => $message->getField(),
                    'Message' => $message->getMessage(),
                    "Type" => $message->getType(),
                ]);
            }

            return $this->response([
                'erreurs' => $messagesRetour
            ], StatusCode::BAD_REQUEST);
        }

        return $this->response([
            'Message' => 'Vous êtes bien enregistré',
            'Field' => 'Reussite'
        ], StatusCode::CREATED);
    }
}

