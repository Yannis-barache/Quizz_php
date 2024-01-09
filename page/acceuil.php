<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>
<h1>Accueil</h1>
<p>Vous êtes sur la page d'accueil ici, vous pourrez retrouver plusieurs quiz pour tester vos connaissances sur différents sujets.</p>
<form method="get">
<?php
include 'data/data.php';
include 'Input/Form.php';
include 'Input/Input.php';
include 'Input/InputCheckbox.php';
include 'Input/InputRadio.php';
include 'Input/InputText.php';
include 'Input/InputSubmit.php';

$fichier = lis_questions_json('data/questions_facile.json');
$questions = $fichier['quiz'];
$index = 0;
$form = new Form([]);
foreach ($questions as $question) {
    echo "<h2>{$question['question']}</h2>".PHP_EOL;
    if ($question['type'] === 'checkbox') {
        foreach ($question['options'] as $option) {
            $input = new InputCheckbox($question['name'], $index, $option['value'],$option['label']);
            $form->addInput($input);
        }
   }
    elseif ($question['type'] === 'text') {
        $input = new InputText($question['name'], $index, 'Votre réponse', '', 'Votre réponse');
        $form->addInput($input);
    }
    elseif ($question['type'] === 'radio') {
        foreach ($question['options'] as $option) {
            $input = new InputRadio($question['name'], $index,'', $option['value'],$option['label']);
            $form->addInput($input);
        }
    }
    $index++;
    echo PHP_EOL;

}



$envoi= new InputSubmit('envoi', 'envoi', 'envoi', 'Envoi');
$form->addInput($envoi);
echo $form->render();


?>
</form>
</body>
</html>

