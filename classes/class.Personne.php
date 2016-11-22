<?php

require_once('class.Commente.php');
require_once('class.Equipe.php');

class Personne
{
    private $id = 0;
    private $nom = null;
    private $prenom = null;
    private $pseudo = null;
    private $mot_de_passe = null;
    private $photo = null;
    private $statut = null;
    private $tag = null;

    private $lesCommentaires = null;
    private $lesEquipes = null;


    // --- Le constructeur

    public function Personne($id = 0, $nom = null, $prenom = null, $pseudo = null, $mot_de_passe = null,
                             $photo = null, $statut = null, $tag = null){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->pseudo = $pseudo;
        $this->mot_de_passe = $mot_de_passe;
        $this->photo = $photo;
        $this->statut = $statut;
        $this->tag  = $tag;

    }

    //Les getters & setters

    public function getId()                         {return $this->id;}
    public function setId($id)                      {$this->id = $id;}
    public function getNom()                        {return $this->nom;}
    public function setNom($nom)                    {$this->nom = $nom;}
    public function getPrenom()                     {return $this->prenom;}
    public function setPrenom($prenom)              {$this->prenom = $prenom;}
    public function getPseudo()                     {return $this->pseudo;}
    public function setPseudo($pseudo)              {$this->pseudo = $pseudo;}
    public function getMotDePasse()                 {return $this->mot_de_passe;}
    public function setMotDePasse($mot_de_passe)    {$this->mot_de_passe = $mot_de_passe;}
    public function getPhoto()                      {return $this->photo;}
    public function setPhoto($photo)                {$this->photo = $photo;}
    public function getStatut()                     {return $this->statut;}
    public function setStatut($statut)              {$this->statut = $statut;}
    public function getTag()                        {return $this->tag;}
    public function setTag($tag)                    {$this->tag = $tag;}
    public function getLesCommentaires()            {return $this->lesCommentaires;}
    public function setLesCommentaires($lesCommentaires){$this->lesCommentaires = $lesCommentaires;}
    public function getLesEquipes()                 {return $this->lesEquipes;}
    public function setLesEquipes($lesEquipes)      {$this->lesEquipes = $lesEquipes;}


}
