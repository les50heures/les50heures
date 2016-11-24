<?php
require_once("dao/DaoPersonne.php");

$daoClient = new DaoPersonne();

if (isset($_POST["val_cnx"])) {
    $daoClient->cnx($_POST['login'], $_POST['mdp']);
    if ($daoClient->bean->getLogin() != null) {
        $_SESSION ['logincnx'] = array();
        $_SESSION ['logincnx']['prenom'] = $daoClient->bean->getPrenom();
        $_SESSION ['logincnx']['admin'] = $daoClient->bean->getAdmin();

    }
    if (isset($_SESSION['logincnx'])) {
        header("Location:index.php?page=mesVideos");
    } else {
        $_SESSION['logincnx'] = "null";
    }

}
if (isset($_POST["valCreer"])) {
}

if (isset($_POST["dcnx"])) {
    session_unset();
    header("Location:index.php?page=index");
}