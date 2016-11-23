<?php

require_once 'classes/class.Commente.php';
require_once 'classes/class.Personne.php';
require_once 'classes/class.Fichier.php';

require_once 'Dao.php';

class DaoCommente extends Dao
{
    public function DaoCommente()
    {
        parent::__construt();
        $this->bean = new Commente();
    }

    public function find($id)
    {
        $donnees = $this->findById("commente", "ID_COMMENTAIRE", $id);
        $this->bean->setId($donnees['ID_COMMENTAIRE']);
        $this->bean->setCommentaire($donnees['COMMENTAIRE']);
    }


    public function findByName($commentaire)
    {
        $sql = "SELECT * FROM commente
                WHERE COMMENTAIRE = '" . $commentaire . "'
                ORDER BY COMMENTAIRE";
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $commentaire = new Commente(
                    $donnees['ID_COMMENTAIRE'],
                    $donnees['COMMENTAIRE']
                );
                $this->bean = $commentaire;
            }
        }
    }


    public function getListe()
    {
        $sql = "SELECT * FROM commente ORDER BY COMMENTAIRE";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $commentaire = new Commente(
                    $donnees['ID_COMMENTAIRE'],
                    $donnees['COMMENTAIRE']
                );
                $liste[] = $commentaire;
            }
        }

        return $liste;
    }

    public function create()
    {
        $sql = "INSERT INTO commente(ID_PERSONNE, ID_FICHIER, COMMENTAIRE)
                                VALUES(?, ?, ?)";
        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getLesPersonnes()->getId());
        $requete->bindValue(2, $this->bean->getLesFichier()->getId());
        $requete->bindValue(3, $this->bean->getCommentaire());
        $requete->execute();
    }

    public function update()
    {

    }


    public function setLesPersonnes()
    {
        $sql = "SELECT * FROM personne, commente
                WHERE
                personne.ID_PERSONNE = commente.ID_PERSONNE
                AND commente.ID_COMMENTAIRE  = " . $this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            $personne = new Personne();
            if ($donnees = $requete->fetch()) {
                $personne = new Personne(
                    $donnees['ID_PERSONNE'],
                    $donnees['NOM_PERSONNE'],
                    $donnees['PRENOM_PERSONNE'],
                    $donnees['PSEUDO_PERSONNE'],
                    $donnees['MOT_DE_PASSE'],
                    $donnees['PHOTO_PERSONNE'],
                    $donnees['STATUT_PERSONNE'],
                    $donnees['TAG_PERSONNE']
                );
            }
            $this->bean->setLesPersonnes($personne);
        }
    }

    public function setLesFichier()
    {
        $sql = "SELECT * FROM fichier, commente
                WHERE
                fichier.ID_FICHIER = commente.ID_FICHIER
                AND commente.ID_COMMENTAIRE = " . $this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            $fichier = new Fichier();
            if ($donnees = $requete->fetch()) {
                $fichier = new Fichier(
                    $donnees['ID_FICHIER'],
                    $donnees['NOM_FICHIER'],
                    $donnees['DESCRIPTION_FICHIER'],
                    $donnees['FICHIER'],
                    $donnees['VALIDATION_FICHIER']
                );
            }
            $this->bean->setLesFichier($fichier);
        }
    }



}
