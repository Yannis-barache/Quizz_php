<?php

class ConnexionBD {
    private $serveur;
    private $utilisateur;
    private $motDePasse;
    private $baseDeDonnees;
    private $connexion;

    public function __construct($serveur, $utilisateur, $motDePasse, $baseDeDonnees) {
        $this->serveur = $serveur;
        $this->utilisateur = $utilisateur;
        $this->motDePasse = $motDePasse;
        $this->baseDeDonnees = $baseDeDonnees;
    }

    public function connecter() {
        try {
            $this->connexion = new PDO("mysql:host={$this->serveur};dbname={$this->baseDeDonnees}", $this->utilisateur, $this->motDePasse);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion à la base de données réussie !".PHP_EOL;
            return $this->connexion;
        } catch (PDOException $e) {
            die("Échec de la connexion à la base de données : " . $e->getMessage());
        }
    }

    public function deconnecter() {
        $this->connexion = null;
    }
}

//


?>
