<?php
require_once"dao/DaoPersonne.php";

$daoPersonne = new DaoPersonne();

if (isset($_POST["val_cnx"])) {
    $daoPersonne->cnx($_POST['pseudo'], $_POST['mdp']);
    if ($daoPersonne->bean->getPseudo() !=null){
    $_SESSION ['pseudo'] = array();
    $_SESSION ['pseudo']['prenom'] = $daoPersonne->bean->getPrenom();
        $_SESSION ['pseudo']['statut'] = $daoPersonne->bean->getStatut();

    }
    /*
}


    $_SESSION['id'] = $daoPersonne->bean->getId();
    $_SESSION['nom'] = $daoPersonne->bean->getNom();
    $_SESSION['prenom'] = $daoPersonne->bean->getPrenom();
    $_SESSION['pseudo'] = $daoPersonne->bean->getPseudo();
    $_SESSION['mdp'] = $daoPersonne->bean->getMDP();
    $_SESSION['photo'] = $daoPersonne->bean->getPhoto();
    $_SESSION['statut'] = ($daoPersonne->bean->getStatut() === '1');
    $_SESSION['tag'] = $daoPersonne->bean->getTag();*/

}
if (isset($_SESSION['pseudo'])) {
    header("Location:index.php?page=defis");
} else {
    $_SESSION['pseudo'] = "null";


}

if (isset($_POST["dcnx"])) {
    session_unset();
    header("Location:index.php?page=index");
}
