<?php

require_once 'classes/class.Equipe.php';
require_once 'classes/class.A_obtenu.php';
require_once 'classes/class.Defis.php';
require_once 'classes/class.Personne.php';
require_once 'classes/class.Fichier.php';


require_once 'Dao.php';

class DaoEquipe extends Dao
{
    public function DaoEquipe()
    {
        parent::__construt();
        $this->bean = new Equipe();
    }

    public function find($id)
    {
        $donnees = $this->findById("equipe", "ID_EQUIPE", $id);
        $this->bean->setId($donnees['ID_EQUIPE']);
        $this->bean->setNom($donnees['NOM_EQUIPE']);
        $this->bean->setAvatar($donnees['AVATAR_EQUIPE']);
        $this->bean->setPoints($donnees['POINTS_EQUIPE']);

    }


    public function findByName($nom)
    {
        $sql = "SELECT * FROM equipe
                WHERE NOM_EQUIPE = '" . $nom . "'
                ORDER BY NOM_EQUIPE";
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $equipe = new Equipe(
                    $donnees['ID_EQUIPE'],
                    $donnees['NOM_EQUIPE'],
                    $donnees['AVATAR_EQUIPE'],
                    $donnees['POINTS_EQUIPE']
                );
                $this->bean = $equipe;
            }
        }
    }


    public function getListe()
    {
        $sql = "SELECT * FROM equipe ORDER BY NOM_EQUIPE";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->excecute()) {
            while ($donnees = $requete->fetch()) {
                $equipe = new Equipe(
                    $donnees['ID_EQUIPE'],
                    $donnees['NOM_EQUIPE'],
                    $donnees['AVATAR_EQUIPE'],
                    $donnees['POINTS_EQUIPE']
                );
                $liste[] = $equipe;
            }
        }

        return $liste;
    }

    public function create()
    {
        $sql = "INSERT INTO equipe(ID_PERSONNE, ID_DEFI, ID_FICHIER, ID_NOTE, NOM_EQUIPE, NOM_EQUIPE, AVATAR_EQUIPE,
                                POINTS_EQUIPE)
                                VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getLesPersonnes()->getId());
        $requete->bindValue(2, $this->bean->getLesFichiers()->getId());
        $requete->bindValue(3, $this->bean->getLesDefis()->getId());
        $requete->bindValue(4, $this->bean->getLesNotes()->getId());
        $requete->bindValue(5, $this->bean->getNom());
        $requete->bindValue(6, $this->bean->getAvatar());
        $requete->bindValue(7, $this->bean->getPoints());
        $requete->execute();
    }

    public function update()
    {

    }


    public function delete()
    {
        $this->deleteById("equipe", "ID_EQUIPE", $this->bean->getId());
    }

    public function setLesPersonnes()
    {
        $sql = "SELECT * FROM personne, equipe
                WHERE
                personne.ID_PERSONNE = equipe.ID_PERSONNE
                AND equipe.ID_EQUIPE = " . $this->bean->getId();
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


    public function setLesFichiers()
    {
        $sql = "SELECT * FROM fichier , equipe
                WHERE
                fichier.ID_FICHIER = equipe.ID_FICHIER
                AND equipe.ID_EQUIPE = " . $this->bean->getId();
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
            $this->bean->setLesFichiers($fichier);
        }
    }

    public function setLesDefis()
    {
        $sql = "SELECT * FROM defis , equipe
                WHERE
                defis.ID_DEFI = equipe.ID_DEFI
                AND equipe.ID_EQUIPE = " . $this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            $defis = new Defis();
            if ($donnees = $requete->fetch()) {
                $defis= new Defis(
                    $donnees['ID_DEFI'],
                    $donnees['TITRE_DEFI'],
                    $donnees['DESCRIPTION_DEFI'],
                    $donnees['DELAIS_DEFI'],
                    $donnees['TYPE_DEFI']
                );
            }
            $this->bean->setLesDefis($defis);
        }
    }


    public function setLesNotes()
    {
        $sql = "SELECT * FROM a_obtenu , equipe
                WHERE
                a_otbenu.NOTE = equipe.NOTE
                AND equipe.ID_EQUIPE = " . $this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            $note = new Note();
            if ($donnees = $requete->fetch()) {
                $note = new Note(
                    $donnees['NOTE']
                );
            }
            $this->bean->setLesNotes($note);
        }
    }


}

