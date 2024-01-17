<?php

class ConnexionBD
{
    private $connexion;

    public function __construct()
    {
        try {
            $this->connexion = new PDO('sqlite:../DBquiz.sqlite3');
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function get_connexion(): PDO
    {
        if ($this->connexion === null) {
            throw new Exception('Connection failed');
        }

        return $this->connexion;
    }
    
    public function deconnecter(): void
    {
        $this->connexion = null;
    }

    public function drop_all(): void
    {
        $this->connexion->exec('DROP TABLE IF EXISTS QUESTION');
        $this->connexion->exec('DROP TABLE IF EXISTS TYPE');
        $this->connexion->exec('DROP TABLE IF EXISTS QUIZ');
    }
}
