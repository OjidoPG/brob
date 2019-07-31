<?php

use Phalcon\Mvc\Model;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("brocante");
        $this->setSource("emplacements");
        $this->hasMany('id', 'Clients', 'emplacements_id', ['alias' => 'Clients']);
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
     * @return Emplacements[]|Emplacements|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Emplacements|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
