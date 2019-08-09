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
        $client->setTelephone($this->request->getPost('telephone', Filter::FILTER_INT, null));
        $client->setMail($this->request->getPost('mail', Filter::FILTER_EMAIL, null));
        $client->setAdresse($this->request->getPost('adresse', Filter::FILTER_TRIM, null));
        $client->setCodepostal($this->request->getPost('codepostal', Filter::FILTER_INT, null));
        $client->setVille($this->request->getPost('ville', Filter::FILTER_TRIM, null));
        $client->setEmplacementsId($this->request->getPost('emplacements_id', Filter::FILTER_INT, null));

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

