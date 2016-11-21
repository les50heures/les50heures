<?php

class Equipe
{
    private $id = 0;
    private $nom = null;
    private $avatar = null;
    private $points = null;

    private $lesPersonnes = null;
    private $lesFichiers = null;
    private $lesDefis = null;
    private $lesNotes = null;

    // --- Le constructeur
    public function Equipe($id = 0, $nom = null, $avatar = null, $points = null){

        $this->id = $id;
        $this->nom = $nom;
        $this->avatar = $avatar;
        $this->points = $points;
    }


    // --- Les Getters & Setters

    public function getId()                 {return $this->id;}

    public function getNom()                {return $this->nom;}

    public function getAvatar()             {return $this->avatar;}

    public function getPoints()             {return $this->points;}

    public function getLesPersonnes()       {return $this->lesPersonnes;}

    public function getLesFichiers()        {return $this->lesFichiers;}

    public function getLesDefis()           {return $this->lesDefis;}

    public function getLesNotes()           {return $this->lesNotes;}

    // --- Les Setters

    public function setId($id)              {$this->id = $id;}


    public function setNom($nom)            {$this->nom = $nom;}


    public function setAvatar($avatar)      {$this->avatar = $avatar;}


    public function setPoints($points)      {$this->points = $points;}


    public function setLesPersonnes($lesPersonnes){$this->lesPersonnes = $lesPersonnes;}


    public function setLesFichiers($lesFichiers){$this->lesFichiers = $lesFichiers;}


    public function setLesDefis($lesDefis){$this->lesDefis = $lesDefis;}


    public function setLesNotes($lesNotes){$this->lesNotes = $lesNotes;}
}