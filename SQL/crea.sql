DROP TABLE IF EXISTS REPONSE;
DROP TABLE IF EXISTS QUESTION;
DROP TABLE IF EXISTS QUIZ;

CREATE TABLE QUIZ
(
    id_quiz int not null,
    title varchar(255),
    description TEXT,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_quiz)
);

CREATE TABLE QUESTION
(
    id_question int not null,
    description TEXT,
    id_quiz int not null,
    PRIMARY KEY (id_question),
    FOREIGN KEY (id_quiz) REFERENCES QUIZ(id_quiz)
);

CREATE TABLE REPONSE
(
    id_reponse int not null,
    description TEXT,
    is_correct boolean,
    id_question int not null,
    PRIMARY KEY (id_reponse),
    FOREIGN KEY (id_question) REFERENCES QUESTION(id_question)
);


