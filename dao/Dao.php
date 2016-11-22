<?php

class Dao
{

    public $bean = null;
    public $pdo = null;

    public function Dao()
    {
        // Instanciation pdo
        $parametres = parse_ini_file("param/param.ini");
        // connexion à la bdd avec fichier de paramètres
        $this->pdo = new PDO(
            $parametres['dsn'],
            $parametres['user'],
            $parametres['psw'],
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
    }
}