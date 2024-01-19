<?php
include '../SQL/ConnexionBD.php';
$bdd = new ConnexionBD();
$connexion = $bdd->get_connexion();
if ($_GET['id'] != null) {
    $quiz = $connexion->query("SELECT * FROM QUIZ WHERE id_quiz = {$_GET['id']}");
    $requete = "SELECT * FROM QUESTION WHERE id_quiz = {$_GET['id']}";
} else {
    header('Location: accueil.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
    <link rel="stylesheet" href="./css/quiz.css">
</head>

<body>
    <header>
        <h1><?php echo $quiz->fetch(PDO::FETCH_ASSOC)['title'] ?></h1>
    </header>
    <button class='retour'><a href="PageAccueil.php">Retour</a></button>
    <?php
    $resultat = $connexion->query($requete);
    $questions = $resultat->fetchAll(PDO::FETCH_ASSOC);
    $resultat->closeCursor();
    $bdd->deconnecter();

    if (count($questions) == 0) {
        header('Location: PageAccueil.php');
    }

    $i = 1;

    echo "<form action='PageResultat.php' method='post'>" . PHP_EOL;
    echo "<input type='hidden' name='id_quiz' value='{$_GET['id']}'>" . PHP_EOL;
    foreach ($questions as $question) {
        echo "<fieldset>" . PHP_EOL;
        echo "<legend>Question {$i}</legend>" . PHP_EOL;
        echo "<p>{$question['description']}</p>" . PHP_EOL;
        $requete = "SELECT * FROM OPTIONS WHERE id_question = {$question['id_question']}";
        $resultat = $connexion->query($requete);
        $reponses = $resultat->fetchAll(PDO::FETCH_ASSOC);
        $resultat->closeCursor();
        if ($reponses == null) {
            echo "<input class='input' type='text' name='{$question['id_question']}' placeholder='Votre réponse'><br>" . PHP_EOL;
        } else {
            foreach ($reponses as $reponse) {
                if ($question['id_type'] == 2) {
                    echo "<input type='checkbox' name='{$question['id_question']}' value='{$reponse['id_option']}'>{$reponse['description']}<br>" . PHP_EOL;
                } else {
                    echo "<input type='radio' name='{$question['id_question']}' value='{$reponse['description']}'>{$reponse['description']}<br>" . PHP_EOL;
                }
            }
        }
        echo "</fieldset>" . PHP_EOL;
        $i++;
    }

    echo "<input type='submit' value='Valider'>" . PHP_EOL;
    echo "</form>" . PHP_EOL;


    ?>