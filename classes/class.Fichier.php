<?php

require_once('class.Personne.php');
require_once('class.Equipe.php');
require_once('class.Type.php');
class Fichier
{
    private $id = 0;
    private $nom = null;
    private $description = null;
    private $fichier = null;
    private $validation = null;

    private $lesPersonnes = null;
    private $lesEquipes = null;
    private $lesTypes;


    // --- Le constructeur
    public function Fichier($id = 0, $nom = null, $description = null, $fichier = null, $validation = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->fichier = $fichier;
        $this->validation = $validation;

    }

    // --- Les Getters


    public function getId()
    {
        return $this->id;
    }


    public function getNom()
    {
        return $this->nom;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function getFichier()
    {
        return $this->fichier;
    }


    public function getValidation()
    {
        return $this->validation;
    }


    public function getLesPersonnes()
    {
        return $this->lesPersonnes;
    }


    public function getLesEquipes()
    {
        return $this->lesEquipes;
    }


    public function getLesTypes()
    {
        return $this->lesTypes;
    }


    // Les setters

    public function setId($id)
    {
        $this->id = $id;
    }


    public function setNom($nom)
    {
        $this->nom = $nom;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function setFichier($fichier)
    {
        $this->fichier = $fichier;
    }


    public function setValidation($validation)
    {
        $this->validation = $validation;
    }


    public function setLesPersonnes($lesPersonnes)
    {
        $this->lesPersonnes = $lesPersonnes;
    }


    public function setLesEquipes($lesEquipes)
    {
        $this->lesEquipes = $lesEquipes;
    }


    public function setLesTypes($lesTypes)
    {
        $this->lesTypes = $lesTypes;
    }
}
