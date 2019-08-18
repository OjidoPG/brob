<?php

use Phalcon\Filter;

class ClientsController extends ControllerBase
{

    /**
     * Renvoi la liste des emplacements disponibles
     * @return false|string
     */
    public function getClientsAction()
    {
        $query = $this->modelsManager->createQuery(
            "SELECT * FROM Clients as c
            INNER JOIN Emplacements AS e
            ON c.emplacements_id = e.id"
        );

        $query->execute();

        /*
                $clients = Clients::query()
                    ->columns('Clients', 'e')
                    ->join('Emplacements', 'e.id= Clients.emplacements_id','e', 'INNER')
                    ->execute();


        $clients = $this->modelsManager->createBuilder()
            ->from('Clients')
            ->join('Emplacements', 'Clients.emplacements_id=e.id', 'e', 'INNER')
            ->getQuery()
            ->execute();
*/

        return $this->response([
            'liste' => $query
        ]);
    }

    /**
     * Vérifie, enregistre ou refuse l'inscripion d'un nouveau brocanteur
     * @return false|string
     */
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
                'Erreurs' => $messagesRetour
            ]);
        }

        array_push($messagesRetour, [
            'Type' => 'Reussite',
            'Message' => 'Vous êtes bien enregistré'
        ]);
        return $this->response([
            'Success' => $messagesRetour
        ]);
    }
}

