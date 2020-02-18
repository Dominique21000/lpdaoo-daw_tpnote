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
    function __construct($base = "dam-cochon", $user = "us_dam-cochon", $password = "cochon", $host = "localhost")
    {
        $this->baseName = $base;
        $this->baseUser = $user;
        $this->userPassW = $password;
        $this->hostName = $host;
    }

    // stockage de la connexion
    function makeConnect()
    {
        $dsn = 'mysql:host=localhost;dbname=' . $this->baseName . ";charset=UTF8";
        try {
            $this->connection = new PDO($dsn, $this->baseUser, $this->userPassW);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
        return $this->connection;
    }
}