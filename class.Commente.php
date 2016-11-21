<?php
class Commente
{
    private $id = 0;
    private $commentaire = null;

    private $lesPersonnes = null;
    private $lesFichier = null;

    // --- Le constructeur
    public function Commente($id = 0, $commentaire = null)
    {
        $this->id = $id;
        $this->commentaire = $commentaire;
    }

   // Les Getters
    public function getId()
    {
        return $this->id;
    }


    public function getCommentaire()
    {
        return $this->commentaire;
    }


    public function getLesPersonnes()
    {
        return $this->lesPersonnes;
    }


    public function getLesFichier()
    {
        return $this->lesFichier;
    }

   // Les Setters

    public function setId($id)
    {
        $this->id = $id;
    }


    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }


    public function setLesPersonnes($lesPersonnes)
    {
        $this->lesPersonnes = $lesPersonnes;
    }


    public function setLesFichier($lesFichier)
    {
        $this->lesFichier = $lesFichier;
    }





}