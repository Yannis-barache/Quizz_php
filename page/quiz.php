<?php
include '../ConnexionBD.php';

$connexionbd = new ConnexionBD('localhost', 'root', 'barachou', 'DBquiz');
$connexion = $connexionbd->connecter();


if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM QUESTION WHERE id_quiz = $id";
    $result = $connexion->query($sql);
    $quiz = $result->fetchall(PDO::FETCH_ASSOC);
    echo json_encode($quiz);
    $result->closeCursor();
    $connexionbd->deconnecter();
} else {
    $sql = "SELECT * FROM quiz";
    $result = $connexion->query($sql);
    $quizzes = $result->fetchAll(PDO::FETCH_ASSOC);
    $result->closeCursor();
    $connexionbd->deconnecter();
    echo json_encode($quizzes);
}
?>