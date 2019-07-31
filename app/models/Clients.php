<?php

use Phalcon\Mvc\Model;

class Clients extends Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $nom;

    /**
     *
     * @var string
     */
    protected $prenom;

    /**
     *
     * @var string
     */
    protected $telephone;

    /**
     *
     * @var string
     */
    protected $mail;

    /**
     *
     * @var string
     */
    protected $adresse;

    /**
     *
     * @var integer
     */
    protected $codepostal;

    /**
     *
     * @var string
     */
    protected $ville;

    /**
     *
     * @var integer
     */
    protected $emplacements_id;

    /**
     *
     * @var integer
     */
    protected $administrateurs_id;

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
     * Method to set the value of field nom
     *
     * @param string $nom
     * @return $this
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Method to set the value of field prenom
     *
     * @param string $prenom
     * @return $this
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Method to set the value of field telephone
     *
     * @param string $telephone
     * @return $this
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Method to set the value of field mail
     *
     * @param string $mail
     * @return $this
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Method to set the value of field adresse
     *
     * @param string $adresse
     * @return $this
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Method to set the value of field codepostal
     *
     * @param integer $codepostal
     * @return $this
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Method to set the value of field ville
     *
     * @param string $ville
     * @return $this
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Method to set the value of field emplacements_id
     *
     * @param integer $emplacements_id
     * @return $this
     */
    public function setEmplacementsId($emplacements_id)
    {
        $this->emplacements_id = $emplacements_id;

        return $this;
    }

    /**
     * Method to set the value of field administrateurs_id
     *
     * @param integer $administrateurs_id
     * @return $this
     */
    public function setAdministrateursId($administrateurs_id)
    {
        $this->administrateurs_id = $administrateurs_id;

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
     * Returns the value of field nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Returns the value of field prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Returns the value of field telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Returns the value of field mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Returns the value of field adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Returns the value of field codepostal
     *
     * @return integer
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * Returns the value of field ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Returns the value of field emplacements_id
     *
     * @return integer
     */
    public function getEmplacementsId()
    {
        return $this->emplacements_id;
    }

    /**
     * Returns the value of field administrateurs_id
     *
     * @return integer
     */
    public function getAdministrateursId()
    {
        return $this->administrateurs_id;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("brocante");
        $this->setSource("clients");
        $this->belongsTo('administrateurs_id', 'Administrateurs', 'id', ['alias' => 'Administrateurs']);
        $this->belongsTo('emplacements_id', 'Emplacements', 'id', ['alias' => 'Emplacements']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'clients';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Clients[]|Clients|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Clients|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
