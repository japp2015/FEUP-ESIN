
CREATE TABLE person (
    person_id INTEGER PRIMARY KEY,
    username VARCHAR,
    password VARCHAR NOT NULL,
    fullname VARCHAR(128),
    responsability VARCHAR NOT NULL,
    squad VARCHAR NOT NULL
);

CREATE TABLE occurrence (
    occurrence_id INTEGER PRIMARY KEY,
    person_id VARCHAR NOT NULL,
    type VARCHAR NOT NULL,
    state VARCHAR NOT NULL,
    date date NOT NULL,
    local VARCHAR NOT NULL,
    description VARCHAR NOT NULL 
);

  
CREATE TABLE comment (
    comment_id INTEGER PRIMARY KEY,
    person_id VARCHAR NOT NULL,
    occurrence_id VARCHAR,
    text VARCHAR NOT NULL,
    date date NOT NULL 
);


INSERT INTO person (person_id, username, password, responsability, squad) VALUES (1, 'Maria', '201506196', 'Cabo','Porto Norte');
INSERT INTO person (person_id, username, password, responsability, squad) VALUES (2, 'João', '201504834', 'Cabo','Porto Norte');

INSERT INTO occurrence  (occurrence_id, person_id, type, state, date,local, description) VALUES (1, 1, 'furto', 'Em investigação' , '2017-11-18','Cedofeita','Carteirista rouba bolsa com grandes quantias de dinheiro');

INSERT INTO comment (comment_id, person_id, occurrence_id, text, date) VALUES (1, 2 ,1, 'Têm acontecido muitos assaltos nesta zona','2017-11-19');
