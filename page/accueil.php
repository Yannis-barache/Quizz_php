<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="./css/accueil.css">
</head>
<body>
<h1>Bienvenue sur le site de QuizIUT'O</h1>
<h2>Vous êtes sur la page d'accueil ici, vous pourrez retrouver plusieurs quiz pour tester vos connaissances sur différents sujets.</h2>
<section id="carte">
<?php
include '../SQL/ConnexionBD.php';

$bdd = new ConnexionBD();
$connexion = $bdd->get_connexion();

$requete = "SELECT * FROM QUIZ";
$resultat = $connexion->query($requete);

$quizzes = $resultat->fetchAll(PDO::FETCH_ASSOC);
$resultat->closeCursor();
$bdd->deconnecter();

foreach ($quizzes as $quiz) {
    $nb_questions = $connexion->query("SELECT COUNT(*) FROM QUESTION WHERE id_quiz = {$quiz['id_quiz']}");
    $nb_questions = $nb_questions->fetch(PDO::FETCH_ASSOC);
    $nb_questions = $nb_questions['COUNT(*)'];
    echo "<div class='quiz'>".PHP_EOL;
    echo "<h3>{$quiz['title']}</h3>".PHP_EOL;
    echo "<p>{$quiz['description']}</p>".PHP_EOL;
    echo "<p>Nombre de questions : {$nb_questions}</p>".PHP_EOL;
    if ($nb_questions == 0) {
        echo "<p>Vous ne pouvez pas répondre à ce quiz car il n'y a pas de questions</p>".PHP_EOL;
    }
    else {
        echo "<a href='quiz.php?id={$quiz['id_quiz']}'>Répondre au quiz</a>".PHP_EOL;
    }

    echo "</div>".PHP_EOL;

}




?>
</section>
</body>
</html>
