<?php

class ConnexionBD {
    private $connexion;

    public function __construct() {
        $this->connexion = new PDO('sqlite:../DBquiz.sqlite3');
        $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($this->connexion == null){
            echo 'Erreur de la connexion à la base de données';
        }

    }

    public function get_connexion(): PDO
    {
        return $this->connexion;

    }
    public function deconnecter(): void
    {
        $this->connexion = null;
    }

    public function drop_all() : void
    {
        $this->connexion->exec('DROP TABLE IF EXISTS QUIZ');
        $this->connexion->exec('DROP TABLE IF EXISTS ANSWER');
        $this->connexion->exec('DROP TABLE IF EXISTS TYPE');
        $this->connexion->exec('DROP TABLE IF EXISTS QUESTION');
    }

}




?>
