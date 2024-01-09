DROP TABLE IF EXISTS REPONSE;
DROP TABLE IF EXISTS QUESTION;
DROP TABLE IF EXISTS QUIZ;

CREATE TABLE QUIZ
(
    id_quizz int not null,
    description varchar(255),
    PRIMARY KEY (id_quizz)
);

CREATE TABLE QUESTION
(
    id_question int not null,
    description varchar(255),
    id_quizz int not null,
    PRIMARY KEY (id_question),
    FOREIGN KEY (id_quizz) REFERENCES QUIZ(id_quizz)
);

CREATE TABLE REPONSE
(
    id_reponse int not null,
    description varchar(255),
    id_question int not null,
    PRIMARY KEY (id_reponse),
    FOREIGN KEY (id_question) REFERENCES QUESTION(id_question)
);

