<?php
include 'ConnexionBD.php';
use Modeles\ConnexionBD;
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
    reponse TEXT,
    id_quiz int not null,
    id_type int not null,
    PRIMARY KEY (id_question),
    FOREIGN KEY (id_quiz) REFERENCES QUIZ(id_quiz)
);');

$connexion->exec('CREATE TABLE IF NOT EXISTS OPTIONS
(
    id_option int not null,
    description TEXT,
    id_question int not null,
    PRIMARY KEY (id_option),
    FOREIGN KEY (id_question) REFERENCES QUESTION(id_question)
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
        'reponse' => 'La baleine bleue',
        'id_quiz' => 1,
        'id_type' => 1,
    ),
    array(
        'id_question' => 2,
        'description' => 'Quel est le plus petit animal du monde ?',
        'reponse' => 'Le colibri abeille',
        'id_quiz' => 1,
        'id_type' => 1,
    ),
    array(
        'id_question' => 3,
        'description' => 'Quel est le plus grand animal terrestre ?',
        'reponse' => 'L\'éléphant d\'Afrique',
        'id_quiz' => 1,
        'id_type' => 1,
    ),
    array(
        'id_question' => 4,
        'description' => 'Quel est le plus grand animal marin ?',
        'reponse' => 'La baleine bleue',
        'id_quiz' => 1,
        'id_type' => 1,
    ),
    array(
        'id_question' => 5,
        'description' => 'Quel est le plus petit animal marin ?',
        'reponse' => 'Le colibri abeille',
        'id_quiz' => 1,
        'id_type' => 1,
    ),
    array(
        'id_question' => 6,
        'description' => 'Quel est le plus petit animal terrestre ?',
        'reponse' => 'Le colibri abeille',
        'id_quiz' => 1,
        'id_type' => 3,
    ),
    array(
        'id_question' => 7,
        'description' => 'Quelle est la capitale de la France ?',
        'reponse' => 'Paris',
        'id_quiz' => 2,
        'id_type' => 3,
    ),
    array(
        'id_question' => 8,
        'description' => 'Quelle est la capitale de l\'Espagne ?',
        'reponse' => 'Madrid',
        'id_quiz' => 2,
        'id_type' => 3,
    ),
    array(
        'id_question' => 9,
        'description' => 'Quelle est la capitale de l\'Italie ?',
        'reponse' => 'Rome',
        'id_quiz' => 2,
        'id_type' => 3,
    ),
    array(
        'id_question' => 10,
        'description' => 'Quelle est la capitale de l\'Allemagne ?',
        'reponse' => 'Berlin',
        'id_quiz' => 2,
        'id_type' => 3,
    ),
    array(
        'id_question' => 11,
        'description' => 'Quelle est la capitale de la Belgique ?',
        'reponse' => 'Bruxelles',
        'id_quiz' => 2,
        'id_type' => 3,
    ),
    array(
        'id_question' => 12,
        'description' => 'Quelle est la capitale de la Suisse ?',
        'reponse' => 'Berne',
        'id_quiz' => 2,
        'id_type' => 3,
    ),
);

$options = array(
    array(
        'id_option' => 1,
        'description' => 'La baleine bleue',
        'id_question' => 1,
    ),
    array(
        'id_option' => 2,
        'description' => 'Le requin baleine',
        'id_question' => 1,
    ),
    array(
        'id_option' => 3,
        'description' => 'Le calmar géant',
        'id_question' => 1,
    ),
    array(
        'id_option' => 4,
        'description' => 'Le colibri abeille',
        'id_question' => 2,
    ),
    array(
        'id_option' => 5,
        'description' => 'Le colibri à gorge rubis',
        'id_question' => 2,
    ),
    array(
        'id_option' => 6,
        'description' => 'Le colibri d\'Elena',
        'id_question' => 2,
    ),
    array(
        'id_option' => 7,
        'description' => 'L\'éléphant d\'Afrique',
        'id_question' => 3,
    ),
    array(
        'id_option' => 8,
        'description' => 'Le rhinocéros blanc',
        'id_question' => 3,
    ),
    array(
        'id_option' => 9,
        'description' => 'La girafe',
        'id_question' => 3,
    ),
    array(
        'id_option' => 10,
        'description' => 'La baleine bleue',
        'id_question' => 4,
    ),
    array(
        'id_option' => 11,
        'description' => 'Le requin baleine',
        'id_question' => 4,
    ),
    array(
        'id_option' => 12,
        'description' => 'Le calmar géant',
        'id_question' => 4,
    ),
    array(
        'id_option' => 13,
        'description' => 'Le colibri abeille',
        'id_question' => 5,
    ),
    array(
        'id_option' => 14,
        'description' => 'Le colibri à gorge rubis',
        'id_question' => 5,
    ),
    array(
        'id_option' => 15,
        'description' => 'Le colibri d\'Elena',
        'id_question' => 5,
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

$insert = 'INSERT INTO QUESTION(id_question, description, reponse, id_quiz, id_type) VALUES (:id_question,:description,:reponse,:id_quiz,:id_type)';
$statement = $connexion->prepare($insert);
$statement->bindParam(':id_question',$id_question);
$statement->bindParam(':description',$description);
$statement->bindParam(':reponse',$reponse);
$statement->bindParam(':id_quiz',$id_quiz);
$statement->bindParam(':id_type',$id_type);

foreach ($questions as $ligne ){
    var_dump($ligne);
    $id_question = $ligne['id_question'];
    $description = $ligne['description'];
    $reponse = $ligne['reponse'];
    $id_quiz = $ligne['id_quiz'];
    $id_type = $ligne['id_type'];
    var_dump($reponse);
    $statement->execute();
}

$insert = 'INSERT INTO OPTIONS(id_option, description, id_question) VALUES (:id_option,:description,:id_question)';
$statement = $connexion->prepare($insert);
$statement->bindParam(':id_option',$id_option);
$statement->bindParam(':description',$description);
$statement->bindParam(':id_question',$id_question);
$connexion->exec('DELETE FROM OPTIONS');
foreach ($options as $ligne ){
    $id_option = $ligne['id_option'];
    $description = $ligne['description'];
    $id_question = $ligne['id_question'];
    $statement->execute();
}



$resultat = $connexion->query('SELECT * FROM QUIZ');
foreach ($resultat as $ligne){
    echo $ligne['id_quiz'].PHP_EOL;
}

$coco->deconnecter();
?>
