<?php

use Phalcon\Filter;

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
     * Enregistre une emplacement
     * @return false|string
     */
    public function postEmplacementsAction()
    {       
        $messagesRetour = [];
        if(Emplacements::findFirstById($this->request->getPost('id'))){
            /** @var Emplacements $emplacement */
            $emplacement = Emplacements::findFirstById($this->request->getPost('id'));
        }else{
            /** @var Emplacements $emplacement */
            $emplacement = new Emplacements;
            $emplacement->setPaye(0);
            $emplacement->setOccupe(0);
        }        

        $emplacement->setNumero($this->request->getPost('numero', Filter::FILTER_TRIM, null));
        $emplacement->setTaille($this->request->getPost('taille', Filter::FILTER_TRIM, null));
        $emplacement->setPrix($this->request->getPost('prix', Filter::FILTER_TRIM, null));


        if(!$emplacement->save()){

            die(var_dump($emplacement->getMessages()));
            array_push($messagesRetour, [
                'Field' => 'Erreur',
                'Message' => 'Erreur lors de la modification de l\'emplacement',
                'Type' => 'Erreur insertion'    
            ]);
            return $this->response([
                'Erreurs' => $messagesRetour    
            ]);
        }
        array_push($messagesRetour, [
            'Type' => 'Reussite',
            'Message' => 'L\'emplacement a bien été enregistré'
        ]);
        return $this->response([
            'Success' => $messagesRetour
        ]);
    }

    /**
     * Supprime l'emplacement sélectionné
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

    public function postPayeEmplacementsAction(){
        $paye = "0";
        if($this->request->getPost('paye') === "oui"){
            $paye = "1";
        }        
        $messagesRetour = [];
        /** @var Emplacements $emplacement */
        $emplacement = Emplacements::findFirstById($this->request->getPost('idEmplacement'));
        $emplacement->setPaye($paye);
        if($emplacement->save()){
            array_push($messagesRetour, [
                'Type' => 'Reussite',
                'Message' => 'Le statut de l\'emplacement a été modifié'
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