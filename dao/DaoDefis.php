<?php

require_once 'classes/class.Defis.php';
require_once 'classes/class.Equipe.php';
require_once 'classes/class.A_obtenu.php';

require_once 'Dao.php';

class DaoDefis extends Dao
{
    public function DaoDefis()
    {
        parent::__construt();
        $this->bean = new Defis();
    }

    public function find($id)
    {
        $donnees = $this->findById("defis", "ID_DEFI", $id);
        $this->bean->setId($donnees['ID_DEFI']);
        $this->bean->setTitre($donnees['TITRE_DEFI']);
        $this->bean->setDescription($donnees['DESCRIPTION_DEFI']);
        $this->bean->setDelais($donnees['DELAIS_DEFI']);
        $this->bean->setType($donnees['TYPE_DEFI']);

    }


    public function findByName($titre)
    {
        $sql = "SELECT * FROM defis
                WHERE TITRE_DEFI = '" . $titre . "'
                ORDER BY TITRE_DEFI";
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $defi = new Defis(
                    $donnees['ID_DEFI'],
                    $donnees['TITRE_DEFI'],
                    $donnees['DESCRIPTION_DEFI'],
                    $donnees['DELAIS_DEFI'],
                    $donnees['TYPE_DEFI']
                );
                $this->bean = $defi;
            }
        }
    }


    public function getListe()
    {
        $sql = "SELECT * FROM defis ORDER BY TITRE_DEFI";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $defi = new Defis(
                    $donnees['ID_DEFI'],
                    $donnees['TITRE_DEFI'],
                    $donnees['DESCRIPTION_DEFI'],
                    $donnees['DELAIS_DEFI'],
                    $donnees['TYPE_DEFI']
                );
                $liste[] = $defi;
            }
        }

        return $liste;
    }

    public function create()
    {
        $sql = "INSERT INTO defis(ID_EQUIPE, ID_NOTE, TITRE_DEFI, DESCRIPTION_DEFI, DELAIS_DEFI,
                                TYPE_DEFI)
                                VALUES(?, ?, ?, ?, ?, ?)";
        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getLesEquipes()->getId());
        $requete->bindValue(2, $this->bean->getLesNotes()->getId());
        $requete->bindValue(3, $this->bean->getTitre());
        $requete->bindValue(4, $this->bean->getDescription());
        $requete->bindValue(5, $this->bean->getDelais());
        $requete->bindValue(6, $this->bean->getType());
        $requete->execute();
    }

    public function update()
    {

    }


    public function delete()
    {
        $this->deleteById("defis", "ID_DEFI", $this->bean->getId());
    }

    public function setLesEquipes()
    {
        $sql = "SELECT * FROM equipe, defis
                WHERE
                equipe_ID_EQUIPE = defis.ID_EQUIPE
                AND defis.ID_DEFI = " . $this->bean->getId();
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


    public function setLesNotes()
    {
        $sql = "SELECT * FROM a_obtenu , defis
                WHERE
                a_obtenu.ID_NOTE = defis.NOTE
                AND defis.ID_DEFI = " . $this->bean->getId();
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


