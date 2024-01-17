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

        foreach ($questions as $question) {
            $requete = "SELECT * FROM OPTIONS WHERE id_question = {$question['id_question']}";
            $resultat = $connexion->query($requete);
            $reponses = $resultat->fetchAll(PDO::FETCH_ASSOC);
            $resultat->closeCursor();

            $tab[$question['id_question']] = array();
            foreach ($reponses as $reponse) {
                if (isset($_POST[$question['id_question']]) && is_array($_POST[$question['id_question']])) {
                    if (in_array($reponse['id_option'], $_GET[$question['id_question']])) {
                        array_push($tab[$question['id_question']], $reponse['id_option']);
                    }
                }
                elseif (isset($_POST[$question['id_question']]) && $_POST[$question['id_question']] == $reponse['id_option']) {
                    array_push($tab[$question['id_question']], $reponse['id_option']);
                }
            }
        }
        var_dump($tab);

        foreach ($questions as $question){
            echo "<tr>".PHP_EOL;
            echo "<td>{$question['description']}</td>".PHP_EOL;
            echo "<td>";
            if (isset($_POST[$question['id_question']]) && is_array($_POST[$question['id_question']])) {
                foreach ($_POST[$question['id_question']] as $reponse) {
                    $requete = "SELECT * FROM OPTIONS WHERE id_option = {$reponse}";
                    $resultat = $connexion->query($requete);
                    $reponse = $resultat->fetch(PDO::FETCH_ASSOC);
                    $resultat->closeCursor();
                    echo "{$reponse['description']}<br>".PHP_EOL;
                }
            }
            elseif (isset($_POST[$question['id_question']])) {
                try {
                    $requete = "SELECT * FROM OPTIONS WHERE id_option = {$_POST[$question['id_question']]}";
                    $resultat = $connexion->query($requete);
                    $reponse = $resultat->fetch(PDO::FETCH_ASSOC);
                    $resultat->closeCursor();
                    echo "{$reponse['description']}<br>".PHP_EOL;
                }
                catch (Exception $e) {
                    echo "Erreur(s) dans la rentrée<br>".PHP_EOL;
                }
            }
            echo "</td>".PHP_EOL;
            echo "<td>";
            $requete = "SELECT * FROM QUESTION WHERE id_question = {$question['id_question']}";
            $resultat = $connexion->query($requete);
            $reponses = $resultat->fetchAll(PDO::FETCH_ASSOC);
            $resultat->closeCursor();
            foreach ($reponses as $reponse) {
                echo "{$reponse['reponse']}<br>".PHP_EOL;
            }
            echo "</td>".PHP_EOL;
            echo "<td>";
            if (isset($_POST[$question['id_question']]) && is_array($_POST[$question['id_question']])) {
                if ($_POST[$question['id_question']] == $reponse['reponse']) {
                    echo "Bonne réponse";
                    $nb_bonnes_reponses++;
                }
                else {
                    echo "Mauvaise réponse";
                    $nb_mauvaises_reponses++;
                }
            }
            elseif (isset($_POST[$question['id_question']])) {
                if ($_POST[$question['id_question']] == $reponse['reponse']) {
                    echo "Bonne réponse";
                    $nb_bonnes_reponses++;
                }
                else {
                    echo "Mauvaise réponse";
                    $nb_mauvaises_reponses++;
                }
            }
            else {
                echo "Aucune réponse";
            }
            echo "</td>".PHP_EOL;



            }
        }



        ?>
        </tbody>



