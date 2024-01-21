<!-- Page de résultat du quiz -->
<?php
session_start();
include '../modeles/ConnexionBD.php';

use Modeles\ConnexionBD;

$nb_bonnes_reponses = 0;
$nb_mauvaises_reponses = 0;

$bdd = new ConnexionBD();
$connexion = $bdd->get_connexion();

$requete = "SELECT * FROM QUESTION WHERE id_quiz = {$_POST['id_quiz']}";
$resultat = $connexion->query($requete);
$questions = $resultat->fetchAll(PDO::FETCH_ASSOC);
$resultat->closeCursor();


$tab = array();

foreach ($questions as $question) {
    $requete = "SELECT * FROM OPTIONS WHERE id_question = {$question['id_question']}";
    $resultat = $connexion->query($requete);
    $reponses = $resultat->fetchAll(PDO::FETCH_ASSOC);
    $resultat->closeCursor();

    $tab[$question['id_question']] = array();
    foreach ($reponses as $reponse) {
        if (isset($_POST[$question['id_question']]) && is_array($_POST[$question['id_question']])) {
            if (in_array($reponse['id_option'], $_POST[$question['id_question']])) {
                array_push($tab[$question['id_question']], $reponse['id_option']);
            }
        } elseif (isset($_POST[$question['id_question']]) && $_POST[$question['id_question']] == $reponse['id_option']) {
            array_push($tab[$question['id_question']], $reponse['id_option']);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Vos résultats</title>
    <link rel="stylesheet" href="./css/resultat.css">
</head>

<body>

    <header>
        <h1>Vos résultats</h1>
    </header>
    
    <section>
        <table>
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Réponse(s) donnée(s)</th>
                    <th>Réponse(s) correcte(s)</th>
                    <th>Résultat</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($questions as $question) {
                    echo "<tr>" . PHP_EOL;
                    // QUESTIONS
                    echo "<td>{$question['description']}</td>" . PHP_EOL;

                    // REPONSES DONNEES
                    echo "<td>";
                    $reponseDonnee = "";
                    if ($question['id_type'] == 1 && isset($_POST[$question['id_question']])) {
                        $reponseDonnee = $_POST[$question['id_question']];
                        echo $reponseDonnee;
                    } elseif ($question['id_type'] == 3 && isset($_POST[$question['id_question']])) {
                        $reponseDonnee = $_POST[$question['id_question']];
                        echo $reponseDonnee;
                    }
                    echo "</td>" . PHP_EOL;

                    // REPONSES CORRECTES
                    echo "<td>";
                    $requete = "SELECT * FROM QUESTION WHERE id_question = {$question['id_question']}";
                    $resultat = $connexion->query($requete);
                    $reponses = $resultat->fetchAll(PDO::FETCH_ASSOC);
                    $resultat->closeCursor();
                    foreach ($reponses as $reponse) {
                        echo "{$reponse['reponse']}<br>" . PHP_EOL;
                    }
                    echo "</td>" . PHP_EOL;

                    // RESULTAT
                    echo "<td>";
                    if ($question['id_type'] == 1 && isset($_POST['question' . $question['id_question']])) {
                        if (strtolower($reponseDonnee) == strtolower($reponse['reponse'])) {
                            echo "Bonne réponse";
                            $nb_bonnes_reponses++;
                        } else {
                            echo "Mauvaise réponse";
                            $nb_mauvaises_reponses++;
                        }
                    } elseif (isset($_POST[$question['id_question']]) && $reponseDonnee != "") {
                        if (strtolower($reponseDonnee) == strtolower($reponse['reponse'])) {
                            echo "Bonne réponse";
                            $nb_bonnes_reponses++;
                        } else {
                            echo "Mauvaise réponse";
                            $nb_mauvaises_reponses++;
                        }
                    } else {
                        echo "Aucune réponse";
                    }
                    echo "</td>" . PHP_EOL;
                }

                ?>
            </tbody>
        </table>

        <?php
        if ($nb_bonnes_reponses > 3) {
            echo "<p><strong>" . $_SESSION['username'] . "</strong>, vous avez obtenu $nb_bonnes_reponses bonne(s) réponse(s) sur " . count($questions) . ". Bravo!</p>";
        } else {
            echo "<p><strong>" . $_SESSION['username'] . "</strong>, vous avez obtenu $nb_bonnes_reponses bonne(s) réponse(s) sur " . count($questions) . ". Vous pouvez faire mieux!</p>";
        }
        ?>
        <button class="retour"><a href="PageAccueil.php">Retour à l'accueil</a></button>