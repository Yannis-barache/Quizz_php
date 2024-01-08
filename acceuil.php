<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>
<h1>Accueil</h1>
<p>Vous êtes sur la page d'accueil ici, vous pourrez retrouver plusieurs quiz pour tester vos connaissances sur différents sujets.</p>
<form>
<?php
include 'data/data.php';
include 'Input/InputText.php';
include 'Input/InputCheckbox.php';
include 'Input/InputRadio.php';

$fichier = lis_questions_json('data/questions_facile.json');
$questions = $fichier['quizz'];
$index = 0;
foreach ($questions as $question) {
    echo "<h2>{$question['question']}</h2>".PHP_EOL;
    if ($question['type'] === 'checkbox') {
        foreach ($question['options'] as $option) {
            echo "<label for='{$question['name']}'>{$option['label']}</label>";
            $input = new InputCheckbox($question['name'], $index, $option['value']);
            echo $input->render();
        }
   }
    elseif ($question['type'] === 'text') {
        $input = new InputText($question['name'], $index, 'Votre réponse', '');
        echo $input->render();
    }
    elseif ($question['type'] === 'radio') {
        foreach ($question['options'] as $option) {
            echo "<label for='{$question['name']}'>{$option['label']}</label>";
            $input = new InputRadio($question['name'], $index,'', $option['value']);
            echo $input->render();
        }
    }
    $index++;
    echo PHP_EOL;

}

?>
</form>
</body>
</html>

