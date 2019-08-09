<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\ResultInterface;
use Phalcon\Mvc\Model\ResultSetInterface;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("brocante");
        $this->setSource("clients");
        $this->hasMany('id', 'Administrateurs', 'clients_id', ['alias' => 'Administrateurs']);
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
     * @return Clients[]|Clients|ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Clients|ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * @return mixed
     */
    protected function beforeSave()
    {
        $validation = new Validation();
        $validation->add(
            'nom',
            new Uniqueness(
                [
                    "message" => "Vous êtes déjà enregistré",
                    "type" => "Uniqueness",
                    "model" => $this,
                ]
            )
        );
        $validation->add(
            'emplacements_id',
            new Regex(
                [
                    "pattern" =>"/^[1-9]+[0-9]?$/",
                    "message" => "Vous n'avez pas choisi d'emplacement",
                ]
            )
        );
        $validation->add(
            'nom',
            new Alpha(
                [
                    "message" => "Ne peut contenir que des lettres",
                ]
            )
        );
        $validation->add(
            'prenom',
            new Alpha(
                [
                    "message" => "Ne peut contenir que des lettres",
                ]
            )
        );
        $validation->add(
            'ville',
            new Alpha(
                [
                    "message" => "Ne peut contenir que des lettres",
                ]
            )
        );
        $validation->add(
            'telephone',
            new Regex(
                [
                    "pattern" => "/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/",
                    "message" => "Numéro de téléphone non valide",
                ]
            )
        );
        $validation->add(
            'mail',
            new Email(
                [
                    "message" => "Email non valide",
                ]
            )
        );
        $validation->add(
            'codepostal',
            new Regex(
                [
                    "pattern" => "/^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/",
                    "message" => "Code postal non valide"
                ]
            )
        );
        return $this->validate($validation);
    }
    /**
     * @return bool
     */
    protected function afterSave()
    {
        $emplacement = Emplacements::findFirst("idemplacements = " . $this->getEmplacementsId());
        $emplacement->setOccupe(1);
        if (!$emplacement->save()) {
            return false;
        }
        return true;
    }
}
