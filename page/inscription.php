<?php
require_once('dao/DaoPersonne.php');
require_once('dao/DaoCommente.php');
require_once('dao/DaoEquipe.php');

require_once('dao/Dao.php');


$daoPersonne = new DaoPersonne();
$daoCommente = new DaoCommente();
$daoEquipe = new DaoEquipe();


if (isset($_POST["valider"])) {

    $daoPersonne->checkExisting();

    if ($daoPersonne->checkExisting() == 2) {
        $daoPersonne = new DaoPersonne();
        $daoPersonne->bean->setNom($_POST["NOM_PERSONNE"]);
        $daoPersonne->bean->setPrenom($_POST["PRENOM_PERSONNE"]);
        $daoPersonne->bean->setPseudo($_POST["PSEUDO_PERSONNE"]);
        $daoPersonne->bean->setMDP($_POST["MDP"]);
        $daoPersonne->bean->setStatut($_POST["STATUT_PERSONNE"]);
        $daoPersonne->bean->setTag($_POST["TAG_PERSONNE"]);

        $daoPersonne->create();

        var_dump($daoPersonne);
        die();

        $daoEquipe->find($_POST["NOM_EQUIPE"]);
        $daoPersonne->bean->setLesEquipes($daoEquipe->bean);

        $photo = $_FILES['photo']['name'];

        if (move_uploaded_file($_FILES['photo']['tmp_name'], "image_inscrit/" . $photo)) {
            $daoPersonne->bean->setPhoto($photo);
            $daoPersonne->create();
        }
        header('Location:index.php?page=defis');
    } else {
        header('Location:index.php');
    }
}

$listeEquipe = $daoEquipe->getListe();
$listeCommente = $daoCommente->getListe();


$pageTwig = 'inscription.twig.html';
$param = array(
    "listeCommente<"=>$listeCommente,
    "listeEquipe" => $listeEquipe
);