<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\ResultInterface;
use Phalcon\Mvc\Model\ResultSetInterface;

class Emplacements extends Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $numero;

    /**
     *
     * @var string
     */
    protected $taille;

    /**
     *
     * @var integer
     */
    protected $prix;

    /**
     *
     * @var integer
     */
    protected $paye;

    /**
     *
     * @var integer
     */
    protected $occupe;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field numero
     *
     * @param integer $numero
     * @return $this
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Method to set the value of field taille
     *
     * @param string $taille
     * @return $this
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Method to set the value of field prix
     *
     * @param integer $prix
     * @return $this
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Method to set the value of field paye
     *
     * @param integer $paye
     * @return $this
     */
    public function setPaye($paye)
    {
        $this->paye = $paye;

        return $this;
    }

    /**
     * Method to set the value of field occupe
     *
     * @param integer $occupe
     * @return $this
     */
    public function setOccupe($occupe)
    {
        $this->occupe = $occupe;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Returns the value of field taille
     *
     * @return string
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Returns the value of field prix
     *
     * @return integer
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Returns the value of field paye
     *
     * @return integer
     */
    public function getPaye()
    {
        return $this->paye;
    }

    /**
     * Returns the value of field occupe
     *
     * @return integer
     */
    public function getOccupe()
    {
        return $this->occupe;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("brocante");
        $this->setSource("emplacements");
//        $this->hasOne('id', 'Clients', 'emplacements_id', ['alias' => 'Clients']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'emplacements';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Emplacements[]|Emplacements|ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Emplacements|ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Retourne un string contenant la liste des emplacments non occupés
     * @return array
     */
    public static function getEmplacementsNonOccupeToString()
    {
        $result = [];
        foreach (Emplacements::find("occupe = 0") as $emplacement) {
            array_push($result,
                [
                    'texte' => "Numéro : " . $emplacement->getNumero() . " - taille : " . $emplacement->getTaille() . " - prix : " . $emplacement->getPrix() . " euros",
                    'id' => $emplacement->getId()
                ]
            );
        }
        return $result;
    }

    /**
     * Retourne un string contenant les informations de l'emplacement d'un client
     * @param Clients $client
     * @return string
     */
    public static function getEmplacementClientToString(Clients $client)
    {
        $emplacement = Emplacements::findFirstById($client->getEmplacementsId());
        return "Numéro : " . $emplacement->getNumero() . " - taille : " . $emplacement->getTaille() . " - prix : " . $emplacement->getPrix() . " euros";
    }

    /**
     * Ajoute l'emplamcement selectionné par le client et supprime l'ancien s'il en avait un
     * @param $ancienEmplacementid
     * @param $nouvelEmplacementId
     * @return void
     */
    public static function ajoutEmplacement($ancienEmplacementid, $nouvelEmplacementId)
    {
        if (Emplacements::findFirstById($ancienEmplacementid)) {
            $ancienEmplacement = Emplacements::findFirstById($ancienEmplacementid);
            $ancienEmplacement->setOccupe(0);
            $ancienEmplacement->save();
        }

        $nouvelEmplacement = Emplacements::findFirstById($nouvelEmplacementId);
        $nouvelEmplacement->setOccupe(1);
        $nouvelEmplacement->save();
    }
}
