<?php
require_once("dao/DaoPersonne.php");

$daoClient = new DaoPersonne();

if (isset($_POST["val_cnx"])) {
    $daoClient->cnx($_POST['login'], $_POST['mdp']);
    if ($daoClient->bean->getLogin() != null) {
        $_SESSION ['login'] = array();
        $_SESSION ['login']['prenom'] = $daoClient->bean->getPrenom();
        $_SESSION ['login']['admin'] = $daoClient->bean->getStatut();

    }
    if (isset($_SESSION['login'])) {
        header("Location:index.php?page=defis");
    } else {
        $_SESSION['login'] = "null";
    }

}

if (isset($_POST["dcnx"])) {
    session_unset();
    header("Location:index.php?page=index");
}