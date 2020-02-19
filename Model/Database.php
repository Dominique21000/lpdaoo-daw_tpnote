<?php
//namespace Model;

// class_database.php
class Database
{
    var $baseName = "";
    var $baseUser = "";
    var $userPassW = "";
    var $hostName = "";
    var $connection = "";

    // paramètres passée : valeur par défaut
    function __construct($base = "daw-cochon", $user = "pierre", $password = "pierre", $host = "127.0.0.1")
    {
        $this->baseName = $base;
        $this->baseUser = $user;
        $this->userPassW = $password;
        $this->hostName = $host;
    }

    // stockage de la connexion
    function makeConnect()
    {
        $dsn = 'mysql:host='. $this->host.';dbname=' . $this->baseName . ";charset=UTF8";
        try {
            $this->connection = new PDO($dsn, $this->baseUser, $this->userPassW);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
        return $this->connection;
    }
}