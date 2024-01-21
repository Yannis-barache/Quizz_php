<!-- Page d'accueil du site -->
<?php 
session_start();

include '../modeles/Quiz.php';

use Modeles\Quiz;

// Si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Stocker le nom de l'utilisateur dans la session
    $_SESSION['username'] = $_POST['username'];
}
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
    <section>
        <form method="post">
            <label for="username">Entrez votre nom :</label>
            <input type="text" id="username" name="username">
            <input type="submit" value="Envoyer">
        </form>
    </section>
    <section id="carte">
        <?php 
            $quiz = new Quiz();
            $quiz->displayQuizzes();
        ?>
    </section>
</body>

</html>