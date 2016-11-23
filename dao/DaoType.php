<?php

require_once 'classes/class.Type.php';
require_once 'classes/class.Fichier.php';

require_once 'Dao.php';

class DaoType extends Dao
{
    public function DaoType()
    {
        parent::__construt();
        $this->bean = new Type();
    }

    public function find($id)
    {
        $donnees = $this->findById("type", "ID_TYPE", $id);
        $this->bean->setId($donnees['ID_TYPE']);
        $this->bean->setNomType($donnees['NOM_TYPE']);
    }


    public function findByName($nom_type)
    {
        $sql = "SELECT * FROM type
                WHERE NOM_TYPE = '" . $nom_type . "'
                ORDER BY NOM_TYPE";
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $type = new Type(
                    $donnees['ID_TYPE'],
                    $donnees['NOM_TYPE']
                );
                $this->bean = $type;
            }
        }
    }


    public function getListe()
    {
        $sql = "SELECT * FROM type ORDER BY NOM_TYPE";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $type = new Type(
                    $donnees['ID_TYPE'],
                    $donnees['NOM_TYPE']
                );
                $liste[] = $type;
            }
        }

        return $liste;
    }

    public function create()
    {
        $sql = "INSERT INTO type(ID_FICHIER, NOM_TYPE)
                                VALUES(?, ?)";
        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getLesFichiers()->getId());
        $requete->bindValue(2, $this->bean->getNomType());
        $requete->execute();
    }

    public function update()
    {

    }
    public function setLesFichiers()
    {
        $sql = "SELECT * FROM fichier, type
                WHERE
                fichier.ID_FICHIER = type.ID_FICHIER
                AND type.ID_TYPE = " . $this->bean->getId();
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
}
