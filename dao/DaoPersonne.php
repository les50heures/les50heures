<?php

require_once 'classes/class.Personne.php';
require_once 'classes/class.Equipe.php';
require_once 'classes/class.Commente.php';

require_once 'Dao.php';

class DaoPersonne extends Dao
{
    public function DaoPersonne()
    {
        parent::__construt();
        $this->bean = new Personne();
    }

    public function find($id)
    {
        $donnees = $this->findById("personne", "ID_PERSONNE", $id);
        $this->bean->setId($donnees['ID_PERSONNE']);
        $this->bean->setNom($donnees['NOM_PERSONNE']);
        $this->bean->setPrenom($donnees['PRENOM_PERSONNE']);
        $this->bean->setPseudo($donnees['PSEUDO_PERSONNE']);
        $this->bean->setMDP($donnees['MDP']);
        $this->bean->setPhoto($donnees['PHOTO_PERSONNE']);
        $this->bean->setStatut($donnees['STATUT_PERSONNE']);
        $this->bean->setTag($donnees['TAG_PERSONNE']);
    }


    public function findByName($nom)
    {
        $sql = "SELECT * FROM personne
                WHERE NOM_PERSONNE = '" . $nom . "'
                ORDER BY NOM_PERSONNE";
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $personne = new Personne(
                    $donnees['ID_PERSONNE'],
                    $donnees['NOM_PERSONNE'],
                    $donnees['PRENOM_PERSONNE'],
                    $donnees['PSEUDO_PERSONNE'],
                    $donnees['MDP'],
                    $donnees['PHOTO_PERSONNE'],
                    $donnees['STATUT_PERSONNE'],
                    $donnees['TAG_PERSONNE']
                );
                $this->bean = $personne;
            }
        }
    }


    public function getListe()
    {
        $sql = "SELECT * FROM personne ORDER BY NOM_PERSONNE";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $personne = new Personne(
                    $donnees['ID_PERSONNE'],
                    $donnees['NOM_PERSONNE'],
                    $donnees['PRENOM_PERSONNE'],
                    $donnees['PSEUDO_PERSONNE'],
                    $donnees['MDP'],
                    $donnees['PHOTO_PERSONNE'],
                    $donnees['STATUT_PERSONNE'],
                    $donnees['TAG_PERSONNE']
                );
                $liste[] = $personne;
            }
        }

        return $liste;
    }

    public function create()
    {
        $sql = "INSERT INTO personne(ID_COMMENTAIRE, ID_EQUIPE, NOM_PERSONNE, PRENOM_PERSONNE, PSEUDO_PERSONNE,
                                MOT_DE_PASSE, PHOTO_PERSONNE, STATUT_PERSONNE, TAG_PERSONNE)
                                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getlesCommentaires()->getId());
        $requete->bindValue(2, $this->bean->getlesEquipes()->getId());
        $requete->bindValue(3, $this->bean->getNom());
        $requete->bindValue(4, $this->bean->getPrenom());
        $requete->bindValue(5, $this->bean->getPseudo());
        $requete->bindValue(6, $this->bean->getMDP());
        $requete->bindValue(7, $this->bean->getPhoto());
        $requete->bindValue(8, $this->bean->getStatut());
        $requete->bindValue(9, $this->bean->getTag());

        $requete->execute();
    }

    public function update()
    {

    }


    public function delete()
    {
        $this->deleteById("personnes", "ID_PERSONNE", $this->bean->getId());
    }

    public function cnx($pseudo, $mdp)
    {
        $sql = "SELECT *
                FROM personne
                WHERE
                personne.LOGIN = '" . $pseudo . "'
                AND personne.MDP = '" . $mdp . "' ";
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $this->bean->setId($donnees['ID_PERSONNE']);
                $this->bean->setNom($donnees['NOM_PERSONNE']);
                $this->bean->setPrenom($donnees['PRENOM_PERSONNE']);
                $this->bean->setPseudo($donnees['PSEUDO_PERSONNE']);
                $this->bean->setMDP($donnees['MDP']);
                $this->bean->setPhoto($donnees['PHOTO_PERSONNE']);
                $this->bean->setStatut($donnees['STATUT_PERSONNE']);
                $this->bean->setTag($donnees['TAG_PERSONNE']);
            }
        }
    }

    public function checkExisting()
    {
        $requete = $this->pdo->prepare("SELECT PSEUDO FROM personne WHERE PSEUDO = ?");
        $requete->bindValue(1, $_POST["pseudo"]);
        $requete->execute();

        if ($requete->rowCount() > 0) {
            return (1);
        } else {
            return (2);
        }
    }


    public function setLesCommentaires()
    {
        $sql = "SELECT * FROM commente, personne
                WHERE
                commente.ID_COMMENTE = personne.ID_COMMENTE
                AND personne.ID_PERSONNE = " . $this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            $commente = new Commente();
            if ($donnees = $requete->fetch()) {
                $commente = new Commente(
                    $donnees['ID_COMMENTAIRE'],
                    $donnees['COMMENTAIRE']
                );
            }
            $this->bean->setLesCommentaires($commente);
        }
    }


    public function setLesEquipes()
    {
        $sql = "SELECT * FROM equipe, personne
                WHERE
                equipe.ID_EQUIPE = personne.ID_EQUIPE
                AND personne.ID_PERSONNE = " . $this->bean->getId();
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


}