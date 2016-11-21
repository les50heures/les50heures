<?php
class Defis
{
    private $id = 0;
    private $titre = null;
    private $description = null;
    private $delais = null;
    private $type = null;

    private $lesEquipes = null;
    private $lesNotes = null;

    // le constructeur
    public function Defis($id = 0, $titre = null, $description = null, $delais = null, $type = null)
{
    $this->id = $id;
    $this->titre = $titre;
    $this->description = $description;
    $this->delais = $delais;
    $this->type = $type;
}

    // --- Les getters

    public function getId()
    {
        return $this->id;
    }


    public function getTitre()
    {
        return $this->titre;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function getDelais()
    {
        return $this->delais;
    }


    public function getType()
    {
        return $this->type;
    }


    public function getLesEquipes()
    {
        return $this->lesEquipes;
    }


    public function getLesNotes()
    {
        return $this->lesNotes;
    }


    // --- Les setters


    public function setId($id)
    {
        $this->id = $id;
    }


    public function setTitre($titre)
    {
        $this->titre = $titre;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function setDelais($delais)
    {
        $this->delais = $delais;
    }


    public function setType($type)
    {
        $this->type = $type;
    }


    public function setLesEquipes($lesEquipes)
    {
        $this->lesEquipes = $lesEquipes;
    }


    public function setLesNotes($lesNotes)
    {
        $this->lesNotes = $lesNotes;
    }

}