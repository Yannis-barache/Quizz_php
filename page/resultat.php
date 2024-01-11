<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vos résultats</title>
    <link rel="stylesheet" href="./css/resultat.css">
</head>
<body>
<h1>Vos résultats</h1>
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
        include '../SQL/ConnexionBD.php';
        $nb_bonnes_reponses = 0;
        $nb_mauvaises_reponses = 0;

        $bdd = new ConnexionBD();
        $connexion = $bdd->get_connexion();

        $requete = "SELECT * FROM QUESTION WHERE id_quiz = {$_POST['id_quiz']}";
        $resultat = $connexion->query($requete);
        $questions = $resultat->fetchAll(PDO::FETCH_ASSOC);
        $resultat->closeCursor();



        $tab = array();

        foreach ($_POST as $key => $value) {
            $ligne = array();
            $ligne['id_question'] = $key;
            $ligne['reponse'] = $value;
            $tab[] = $ligne;
            var_dump($tab);
            if ($key == 'id_quiz') {
                continue;
            }
            $ligne = array();
            $ligne['id_question'] = $key;
            $ligne['reponse'] = $value;
            $tab[] = $ligne;
            if ($key != 'question') {
                if (!$value) {
                    $value = 'Aucune';
                }
                else {

                    if (is_array($value)) {
                        $value = implode(',', $value);
                    }
                    $requete = "SELECT * FROM ANSWER WHERE description = '$value' and id_question = $key";
                    $resultat = $connexion->query($requete);
                    $reponse = $resultat->fetch(PDO::FETCH_ASSOC);
                    if (!array($reponse)) {
                        if ($reponse['is_correct']) {
                            $nb_bonnes_reponses++;
                        }
                        else {
                            $nb_mauvaises_reponses++;
                        }
                    }
                    else {
                        $nb_mauvaises_reponses++;
                    }
                    $resultat->closeCursor();
                    $reponses_donnees[] = $reponse;
                }

            }
        }
        foreach ($questions as $question) {
            $reponses_correctes = $connexion->query("SELECT * FROM ANSWER WHERE id_question = {$question['id_question']} AND is_correct = 1");
            $reponses_correctes = $reponses_correctes->fetchAll(PDO::FETCH_ASSOC);
            $reponses_correctes = array_column($reponses_correctes, 'description');
            $reponses_correctes = implode(',', $reponses_correctes);
            $reponses_donnees = implode(',', $reponses_donnees);
            $resultat = 'Mauvaise réponse';
            if ($reponses_correctes == $reponses_donnees) {
                $resultat = 'Bonne réponse';
            }
            echo "<tr>".PHP_EOL;
            echo "<td>{$question['description']}</td>".PHP_EOL;
            echo "<td>{$reponses_donnees}</td>".PHP_EOL;
            echo "<td>{$reponses_correctes}</td>".PHP_EOL;
            echo "<td>{$resultat}</td>".PHP_EOL;
            echo "</tr>".PHP_EOL;
        }


        ?>
        </tbody>



