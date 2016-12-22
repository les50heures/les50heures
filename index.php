<?php
// Appel de la classe de chargement du moteur
include_once('Twig/Autoloader.php');

ini_set('display_errors','on');
error_reporting(E_ALL);

define("RACINE", __DIR__);

// registration de Twig
Twig_Autoloader::register();

// Definition du repertoire des templates
$loader = new Twig_Loader_Filesystem('templates'); // Dossier contenant les templates

// Utilisation du repertoire des tamplates sans cache
$twig = new Twig_Environment($loader, array(!'cache' => false));

// routage des pages, par défaut index.php

$template   = 'index.html.twig';
$page       = "";
$param      = array();

// Démarrage des sessions
session_start();

//    $template="";
// Si une page est demandée
if(isset($_GET["page"])){
    // Ouverture du fichier des routes
    $routes = parse_ini_file("param/routes.ini", true);
    $page = $routes[$_GET["page"]]["page"];
    $template = $routes[$_GET["page"]]["template"];

    include($page);
}

// Chargement du template
$template = $twig->loadTemplate($template);

// Ajout de la session au tableau de paramètre
$param["session"] = $_SESSION;

// Affichage de la page concernee et paramètres passés
echo $template->render($param);

?>