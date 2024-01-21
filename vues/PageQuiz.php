<!-- vues/QuizView.php -->
<?php
// Incluez le modèle QuizModel
include '../modeles/QuizModel.php';

use Modeles\QuizModel;
// Instanciez le modèle
$quizModel = new QuizModel();

// Obtenez l'ID du quiz à partir des paramètres de l'URL
$quiz_id = $_GET['id'];

// Utilisez les méthodes du modèle pour récupérer le quiz et les questions
$quiz = $quizModel->getQuiz($quiz_id)->fetch(PDO::FETCH_ASSOC);
$questions = $quizModel->getQuestions($quiz_id);

// Pour chaque question, récupérez les options
foreach ($questions as &$question) {
    $question['options'] = $quizModel->getOptions($question['id_question'])->fetchAll(PDO::FETCH_ASSOC);
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
        <h1><?php echo $quiz['title'] ?></h1>
    </header>
    <button class='retour'><a href="PageAccueil.php">Retour</a></button>
    <?php
    if ($questions === null || count($questions) == 0) {
        header('Location: PageAccueil.php');
        exit;
    }

    $i = 1;

    echo "<form action='PageResultat.php' method='post'>" . PHP_EOL;
    echo "<input type='hidden' name='id_quiz' value='{$quiz['id_quiz']}'>" . PHP_EOL;
    foreach ($questions as $question) {
        echo "<fieldset>" . PHP_EOL;
        echo "<legend>Question {$i}</legend>" . PHP_EOL;
        echo "<p>{$question['description']}</p>" . PHP_EOL;
        if ($question['options'] == null) {
            echo "<input class='input' type='text' name='{$question['id_question']}' placeholder='Votre réponse'><br>" . PHP_EOL;
        } else {
            foreach ($question['options'] as $option) {
                if ($question['id_type'] == 2) {
                    echo "<input type='checkbox' name='{$question['id_question']}[]' value='{$option['id_option']}'>{$option['description']}<br>" . PHP_EOL;
                } else {
                    echo "<input type='radio' name='{$question['id_question']}' value='{$option['description']}'>{$option['description']}<br>" . PHP_EOL;
                }
            }
        }
        echo "</fieldset>" . PHP_EOL;
        $i++;
    }

    echo "<input type='submit' value='Valider'>" . PHP_EOL;
    echo "</form>" . PHP_EOL;
    ?>
</body>
</html>