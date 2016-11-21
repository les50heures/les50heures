<?php
class Type
{
    private $id = 0;
    private $nom_type = null;

    private $lesFichiers = null;

    // Le constructeur

    public function Type($id = 0, $nom_type = null)
    {
        $this->id = $id;
        $this->nom_type = $nom_type;
    }

   // Les getters

    public function getId()
    {
        return $this->id;
    }


    public function getNomType()
    {
        return $this->nom_type;
    }


    public function getLesFichiers()
    {
        return $this->lesFichiers;
    }


    // Les setters


    public function setId($id)
    {
        $this->id = $id;
    }


    public function setNomType($nom_type)
    {
        $this->nom_type = $nom_type;
    }


    public function setLesFichiers($lesFichiers)
    {
        $this->lesFichiers = $lesFichiers;
    }



}