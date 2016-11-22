<?php

require_once ('class.Defis.php');
require_once ('class.Equipe.php');

class Note
{
    private $id = 0;
    private $note = null;

    private $lesDefis = null;
    private $lesEquipes = null;

    // Le constructeur
    public function Note($id = 0, $note = null)
    {
        $this->id = $id;
        $this->note = $note;
    }


    // --- Les Getters

    public function getId()
    {
        return $this->id;
    }


    public function getNote()
    {
        return $this->note;
    }


    public function getLesDefis()
    {
        return $this->lesDefis;
    }


    public function getLesEquipes()
    {
        return $this->lesEquipes;
    }



    // --- Les Setters

    public function setId($id)
    {
        $this->id = $id;
    }


    public function setNote($note)
    {
        $this->note = $note;
    }


    public function setLesDefis($lesDefis)
    {
        $this->lesDefis = $lesDefis;
    }


    public function setLesEquipes($lesEquipes)
    {
        $this->lesEquipes = $lesEquipes;
    }




}