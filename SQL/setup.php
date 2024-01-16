<?php
include 'ConnexionBD.php';

$coco = new ConnexionBD();
$connexion = $coco->get_connexion();

$coco->drop_all();

$connexion->exec('CREATE TABLE if not exists QUIZ
(
    id_quiz int not null,
    title varchar(255),
    description TEXT,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_quiz)
);');

$connexion->exec('CREATE TABLE IF NOT EXISTS TYPE
(
    id_type int not null,
    description TEXT,
    multiple_choice boolean,
    PRIMARY KEY (id_type)
);');

$connexion->exec('CREATE TABLE IF NOT EXISTS QUESTION
(
    id_question int not null,
    description TEXT,
    id_quiz int not null,
    id_type int not null,
    PRIMARY KEY (id_question),
    FOREIGN KEY (id_quiz) REFERENCES QUIZ(id_quiz)
);');

// Ajout des quizs dans la base de données

$quizs = array(
    array(
        'id_quiz' =>1,
        'title' => 'Quiz sur les animaux',
        'description' => 'Quiz sur les animaux',
    ),
    array(
        'id_quiz' => 2,
        'title' => 'Quiz sur les capitales',
        'description' => 'Quiz sur les capitales',
    ),
    array(
        'id_quiz' => 3,
        'title' => 'Quiz sur les planètes',
        'description' => 'Quiz sur les planètes',
    ),
);



// Ajout des types de questions

$types = array(
    array(
        'id_type' => 1,
        'description' => 'Choix unique',
        'multiple_choice' => false
    ),
    array(
        'id_type' => 2,
        'description' => 'Choix multiple',
        'multiple_choice' => true,
    ),
    array(
        'id_type' => 3,
        'description' => 'Réponse libre',
        'multiple_choice' => false,
    ),
);

$questions = array(
    array(
        'id_question' => 1,
        'description' => 'Quel est le plus grand animal du monde ?',
        'id_quiz' => 1,
        'id_type' => 1,
    ),
    array(
        'id_question' => 2,
        'description' => 'Quel est le plus petit animal du monde ?',
        'id_quiz' => 1,
        'id_type' => 1,
    ),
    array(
        'id_question' => 3,
        'description' => 'Quel est le plus grand animal terrestre ?',
        'id_quiz' => 1,
        'id_type' => 1,
    ),
    array(
        'id_question' => 4,
        'description' => 'Quel est le plus grand animal marin ?',
        'id_quiz' => 1,
        'id_type' => 1,
    ),
    array(
        'id_question' => 5,
        'description' => 'Quel est le plus petit animal marin ?',
        'id_quiz' => 1,
        'id_type' => 1,
    ),
    array(
        'id_question' => 6,
        'description' => 'Quel est le plus petit animal terrestre ?',
        'id_quiz' => 1,
        'id_type' => 3,
    ),
    array(
        'id_question' => 7,
        'description' => 'Quelle est la capitale de la France ?',
        'id_quiz' => 2,
        'id_type' => 3,
    ),
    array(
        'id_question' => 8,
        'description' => 'Quelle est la capitale de l\'Espagne ?',
        'id_quiz' => 2,
        'id_type' => 3,
    ),
    array(
        'id_question' => 9,
        'description' => 'Quelle est la capitale de l\'Italie ?',
        'id_quiz' => 2,
        'id_type' => 3,
    ),
    array(
        'id_question' => 10,
        'description' => 'Quelle est la capitale de l\'Allemagne ?',
        'id_quiz' => 2,
        'id_type' => 3,
    ),
    array(
        'id_question' => 11,
        'description' => 'Quelle est la capitale de la Belgique ?',
        'id_quiz' => 2,
        'id_type' => 3,
    ),
    array(
        'id_question' => 12,
        'description' => 'Quelle est la capitale de la Suisse ?',
        'id_quiz' => 2,
        'id_type' => 3,
    ),
);

$insert = 'INSERT INTO QUIZ(id_quiz, title, description) VALUES (:id_quiz,:title,:description)';

$statement = $connexion->prepare($insert);

$statement->bindParam(':id_quiz',$id_quiz);
$statement->bindParam(':title',$title);
$statement->bindParam(':description',$description);

foreach ($quizs as $ligne ){
    $id_quiz = $ligne['id_quiz'];
    $title = $ligne['title'];
    $description = $ligne['description'];
    $statement->execute();
}


$insert = 'INSERT INTO TYPE(id_type, description, multiple_choice) VALUES (:id_type,:description,:multiple_choice)';
$statement = $connexion->prepare($insert);
$statement->bindParam(':id_type',$id_type);
$statement->bindParam(':description',$description);
$statement->bindParam(':multiple_choice',$multiple_choice);

foreach ($types as $ligne ){
    $id_type = $ligne['id_type'];
    $description = $ligne['description'];
    $multiple_choice = $ligne['multiple_choice'];
    $statement->execute();
}

$insert = 'INSERT INTO QUESTION(id_question, description, id_quiz, id_type) VALUES (:id_question,:description,:id_quiz,:id_type)';
$statement = $connexion->prepare($insert);
$statement->bindParam(':id_question',$id_question);
$statement->bindParam(':description',$description);
$statement->bindParam(':id_quiz',$id_quiz);
$statement->bindParam(':id_type',$id_type);

foreach ($questions as $ligne ){
    $id_question = $ligne['id_question'];
    $description = $ligne['description'];
    $id_quiz = $ligne['id_quiz'];
    $id_type = $ligne['id_type'];
    $statement->execute();
}

$resultat = $connexion->query('SELECT * FROM QUIZ');
foreach ($resultat as $ligne){
    echo $ligne['id_quiz'].PHP_EOL;
}

$coco->deconnecter();
?>
