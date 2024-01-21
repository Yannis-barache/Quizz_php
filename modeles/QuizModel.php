<?php
namespace Modeles;
include 'ConnexionBD.php';

use PDO;


class QuizModel {
    private $connexion;

    public function __construct() {
        $bdd = new ConnexionBD();
        $this->connexion = $bdd->get_connexion();
    }

    public function getQuiz($id) {
        return $this->connexion->query("SELECT * FROM QUIZ WHERE id_quiz = {$id}");
    }

    public function getQuestions($id) {
        $requete = "SELECT * FROM QUESTION WHERE id_quiz = {$id}";
        $resultat = $this->connexion->query($requete);
        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOptions($id_question) {
        $requete = "SELECT * FROM OPTIONS WHERE id_question = {$id_question}";
        return $this->connexion->query($requete);
    }
}