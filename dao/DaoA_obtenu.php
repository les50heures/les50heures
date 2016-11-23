<?php

require_once 'classes/class.A_obtenu.php';
require_once 'classes/class.Defis.php';

require_once 'Dao.php';

class DaoNote extends Dao
{
    public function DaoNote()
    {
        parent::__construt();
        $this->bean = new Note();
    }

    public function find($id)
    {
        $donnees = $this->findById("a_obtenu", "NOTE", $id);
        $this->bean->setNote($donnees['NOTE']);
    }

    /*Test modification*/

    public function findByName($note)
    {
        $sql = "SELECT * FROM a_obtenu
                WHERE NOTE = '" . $note . "'
                ORDER BY NOTE";
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $note = new Note(
                    $donnees['NOTE']
                );
                $this->bean = $note;
            }
        }
    }


    public function getListe()
    {
        $sql = "SELECT * FROM a_obtenu ORDER BY NOTE";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $note = new Note(
                    $donnees['NOTE']
                );
                $liste[] = $note;
            }
        }

        return $liste;
    }

    public function create()
    {
        $sql = "INSERT INTO a_obtenu(ID_EQUIPE, ID_DEFI, NOTE)
                                VALUES(?, ?, ?)";
        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getLesDefis()->getId());
        $requete->bindValue(2, $this->bean->getLesEquipes()->getId());
        $requete->bindValue(3, $this->bean->getNote());
        $requete->execute();
    }

    public function update()
    {

    }


    public function setLesEquipes()
    {
        $sql = "SELECT * FROM equipe, a_obtenu
                WHERE
                equipe.ID_EQUIPE = a_obtenu.ID_EQUIPE
                AND a_obtenu.Note = " . $this->bean->getId();
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

    public function setLesDefis()
    {
        $sql = "SELECT * FROM defis, a_obtenu
                WHERE
                defis.ID_DEFI = a_obtenu.ID_DEFI
                AND a_obtenu.NOTE = " . $this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            $defi = new Defis();
            if ($donnees = $requete->fetch()) {
                $defi = new Defis(
                    $donnees['ID_DEFI'],
                    $donnees['TITRE_DEFI'],
                    $donnees['DESCRIPTION_DEFI'],
                    $donnees['DELAIS_DEFI'],
                    $donnees['TYPE_DEFI']
                );
            }
            $this->bean->setLesDefis($defi);
        }
    }



}
