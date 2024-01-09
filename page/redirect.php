<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>
<h1>Accueil</h1>
<p>Vous êtes sur la page d'accueil ici, vous pourrez retrouver plusieurs quiz pour tester vos connaissances sur différents sujets.</p>

<?php
include '../ConnexionBD.php';

$bdd = new ConnexionBD('localhost', 'root', 'barachou', 'DBQuiz');
$connexion = $bdd->connecter();

$requete = "SELECT * FROM quiz";
$resultat = $connexion->query($requete);
$quizzes = $resultat->fetchAll(PDO::FETCH_ASSOC);
$resultat->closeCursor();
$bdd->deconnecter();

foreach ($quizzes as $quiz) {
    echo "<a href='quiz.php?id={$quiz['id_quiz']}'>{$quiz['title']}</a><br>".PHP_EOL;
}
?>



