<?php 
require "../modele/quiz.php"
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="./css/accueil.css">
</head>

<body>
    <header>
        <h1>Bienvenue sur le site de QuizIUT'O</h1>
        <h2>L'envie vous prend de vous challenger jusqu'à devenir un monstre en culture générale ? 
            <br> Vous êtes au bon endroit !
            <br> Choisissez un quiz et répondez aux questions qui vous sont posées.
            <br> Puis découvrez si vous êtes le meilleur !
        </h2>
    </header>
        <section id="carte">
            <?php 
                $quiz = new Quiz();
                $quiz->displayQuizzes();
            ?>
        </section>
</body>

</html>