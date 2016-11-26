<?php
require_once('dao/DaoPersonne.php');
require_once('dao/DaoCommente.php');
require_once('dao/DaoEquipe.php');


$daoPersonne = new DaoPersonne();
$daoCommente = new DaoCommente();
$daoEquipe = new DaoEquipe();


if (isset($_POST["valider"])) {

    $daoPersonne->checkExisting();

    if ($daoPersonne->checkExisting() == 2) {
        $daoPers = new DaoPersonne();
        $daoPersonne->bean->setNom($_POST["nom"]);
        $daoPersonne->bean->setPrenom($_POST["prenom"]);
        $daoPersonne->bean->setPseudo($_POST["pseudo"]);
        $daoPersonne->bean->setMDP($_POST["mdp"]);
        $daoPersonne->bean->setStatut($_POST["statut"]);
        $daoPersonne->bean->setTag($_POST["tag"]);

        $daoEquipe->find($_POST["nom"]);
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