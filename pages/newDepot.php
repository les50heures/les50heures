<?php
require_once('dao/DaoFichier.php');
require_once('dao/DaoPersonne.php');
require_once('dao/DaoEquipe.php');
require_once('dao/DaoType.php');


$daoType = new DaoType();
$daoPersonne = new DaoPersonne();
$daoEquipe = new DaoEquipe();

if (isset($_POST["valider"])) {

    $daoFichier = new DaoFichier();

    $daoFichier->bean->setNom($_POST["nom_fichier"]);
    $daoFichier->bean->setDescription($_POST["desc_fichier"]);
    $daoFichier->bean->setValidation($_POST["validation"]);



    $daoType->find($_POST["lib"]);
    $daoFichier->bean->setlesTypes($daoType->bean);

    $daoPersonne->find($_POST["nom"]);
    $daoFichier->bean->setlesPersonnes($daoPersonne->bean);

    $daoEquipe->find($_POST["nom"]);
    $daoFichier->bean->setlesEquipes($daoEquipe->bean);

    $image = $_FILES['fichier']['name'];

    if (move_uploaded_file($_FILES['fichier']['tmp_name'], "image-annonce/". $image)) {
        $daoFichier->bean->setFichier($image);
        $daoFichier->create();


    }

    header('Location: index.php?page=galerie');
    exit();
}

$listeType = $daoType->getListe();
$listePersonne = $daoPersonne->getListe();
$listeEquipe = $daoEquipe->getListe();


$pageTwig = 'depot.twig.html';
$param = array(
    "listeType" => $listeType,
    "listePersonne" => $listePersonne,
    "listeEquipe" => $listeEquipe
);
