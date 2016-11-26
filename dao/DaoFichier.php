<?php

require_once 'classes/class.Fichier.php';
require_once 'classes/class.Type.php';
require_once 'classes/class.Equipe.php';
require_once 'classes/class.Personne.php';

require_once 'Dao.php';

class DaoFichier extends Dao
{
    public function DaoFichier()
    {
        parent::__construt();
        $this->bean = new Fichier();
    }

    public function find($id)
    {
        $donnees = $this->findById("fichier", "ID_FICHIER", $id);
        $this->bean->setId($donnees['ID_FICHIER']);
        $this->bean->setNom($donnees['NOM_FICHIER']);
        $this->bean->setDescription($donnees['DESCRIPTION_FICHIER']);
        $this->bean->setFichier($donnees['FICHIER']);
        $this->bean->setValidation($donnees['VALIDATION_FICHIER']);
    }


    public function findByName($nom)
    {
        $sql = "SELECT * FROM fichier
                WHERE NOM_FICHIER = '" . $nom . "'
                ORDER BY NOM_FICHIER";
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $fichier = new Fichier(
                    $donnees['ID_FICHIER'],
                    $donnees['NOM_FICHIER'],
                    $donnees['DESCRIPTION_FICHIER'],
                    $donnees['FICHIER'],
                    $donnees['VALIDATION_FICHIER']
                );
                $this->bean = $fichier;
            }
        }
    }


    public function getListe()
    {
        $sql = "SELECT * FROM fichier ORDER BY NOM_FICHIER";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $fichier = new Fichier(
                    $donnees['ID_FICHIER'],
                    $donnees['NOM_FICHIER'],
                    $donnees['DESCRIPTION_FICHIER'],
                    $donnees['FICHIER'],
                    $donnees['VALIDATION_FICHIER']
                );
                $liste[] = $fichier;
            }
        }

        return $liste;
    }

    public function create()
    {
        $sql = "INSERT INTO fichier(ID_PERSONNE, ID_EQUIPE, ID_TYPE, NOM_FICHIER, DESCRIPTION_FICHIER, FICHIER,
                                VALIDATION_FICHIER)
                                VALUES(?, ?, ?, ?, ?, ?, ?)";
        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getLesPersonnes()->getId());
        $requete->bindValue(2, $this->bean->getLesEquipes()->getId());
        $requete->bindValue(3, $this->bean->getLesTypes()->getId());
        $requete->bindValue(4, $this->bean->getNom());
        $requete->bindValue(5, $this->bean->getDescription());
        $requete->bindValue(6, $this->bean->getFichier());
        $requete->bindValue(7, $this->bean->getValidation());
        $requete->execute();
    }

    public function update()
    {

    }


    public function delete()
    {
        $this->deleteById("fichier", "ID_FICHIER", $this->bean->getId());
    }

    public function setLesPersonnes()
    {
        $sql = "SELECT * FROM personne, fichier
                WHERE
                personne.ID_PERSONNE = fichier.ID_PERSONNE
                AND fichier.ID_FICHIER = " . $this->bean->getId();
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


    public function setLesEquipes()
    {
        $sql = "SELECT * FROM equipes , fichier
                WHERE
                equipes.ID_EQUIPE = fichier.ID_EQUIPE
                AND fichier.ID_FICHIER = " . $this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            $equipe = new Equipe();
            if ($donnees = $requete->fetch()) {
                $equipe = new Equipe(
                    $donnees['ID_EQUIPE'],
                    $donnees['NOM_EQUIPE'],
                    $donnees['AVATAR_EQUIPE'],
                    $donnees['POINTS_EQUIPE']
                );
            }
            $this->bean->setLesEquipes($equipe);
        }
    }

    public function setLesTypes()
    {
        $sql = "SELECT * FROM type , fichier
                WHERE
                type.ID_TYPE = fichier.ID_TYPE
                AND fichier.ID_FICHIER = " . $this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            $type = new Type();
            if ($donnees = $requete->fetch()) {
                $type = new Type(
                    $donnees['ID_TYPE'],
                    $donnees['NOM_TYPE']

                );
            }
            $this->bean->setLesTypes($type);
        }
    }


    public function addFichier($ficher)
    {
        $sql = "INSERT INTO peut(ID_FICHIER, ID_TYPE, ID_PERSONNE, ID_EQUIPE) VALUES(? , ?, ?,?)";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $ficher->getId());
        $requete->bindValue(2, $this->bean->getId());
        $requete->bindValue(3, 1);
        $requete->execute();
    }
}