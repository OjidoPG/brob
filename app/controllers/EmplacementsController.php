<?php

class EmplacementsController extends ControllerBase
{
    /**
     * Renvoi la liste des emplacements non occupés
     * @return false|string
     */
    public function getEmplacementsNonOccupeAction()
    {
        return $this->response([
            'liste' => Emplacements::getEmplacementsNonOccupeToString()
        ]);
    }

    /**
     * Renvoi la liste de tous les emplacements
     * @return false|string
     */
    public function getAllEmplacementsAction()
    {
        return $this->response([
           'liste' => Emplacements::find()
        ]);
    }

    /**
     * Enregistre un emplacement
     */
    public function postEmplacementsAction()
    {

    }

    /**
     * Supprime l'emplacement séléctionné
     * @return false|string
     */
    public function postDeleteEmplacementsAction(){
        $messagesRetour = [];
        /** @var Emplacements $emplacementDelete */
        $emplacementDelete = Emplacements::findFirstById($this->request->getPost('idEmplacement'));
        if ($emplacementDelete->delete()){
            array_push($messagesRetour, [
                'Type' => 'Reussite',
                'Message' => 'L\'emplacement a été supprimé'
            ]);
            return $this->response([
                'Success' => $messagesRetour
            ]);
        }
        return $this->response([
            'Erreurs' => $messagesRetour
        ]);
    }
}