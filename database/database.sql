CREATE TABLE personnel (
    username VARCHAR PRIMARY KEY,
    password VARCHAR NOT NULL,
    email VARCHAR(320) NOT NULL, -- 64 characters for local part + @ + 255 for domain name
    fullname VARCHAR(128),
    gender VARCHAR NOT NULL,
    birthdate date NOT NULL,
    naturality VARCHAR NOT NULL,
    start_service date NOT NULL,
    school VARCHAR REFERENCES school NOT NULL,
    position VARCHAR REFERENCES position NOT NULL,
    station VARCHAR NOT NULL
);

CREATE TABLE person (
    id INTEGER PRIMARY KEY,
    name VARCHAR NOT NULL,
    gender VARCHAR NOT NULL,
    birthdate date NOT NULL,
    naturality VARCHAR NOT NULL,
    adress VARCHAR,
    physical description VARCHAR,
    weight INTEGER,
    height INTEGER
);

CREATE TABLE occurrences (
    id INTEGER PRIMARY KEY,
    type VARCHAR REFERENCES occ_type NOT NULL,
    title VARCHAR NOT NULL,
    chief_detective VARCHAR REFERENCES personnel,
    state VARCHAR NOT NULL,
    oppening_date date NOT NULL,
    location VARCHAR NOT NULL,
    description VARCHAR NOT NULL 
);

CREATE TABLE stations (
    id INTEGER PRIMARY KEY,
    name VARCHAR NOT NULL,
    city VARCHAR NOT NULL,
    adress VARCHAR NOT NULL,
    chief VARCHAR REFERENCES personnel NOT NULL
);

CREATE TABLE updates (
    id INTEGER PRIMARY KEY,
    title VARCHAR NOT NULL,
    text VARCHAR NOT NULL,
    id_personnel VARCHAR REFERENCES personnel NOT NULL,
    id_occurrence VARCHAR REFERENCES occurrence NOT NULL,
    date_hour datetime NOT NULL
);

CREATE TABLE notes (
    id INTEGER PRIMARY KEY,
    personnel_id VARCHAR REFERENCES personnel NOT NULL,
    title VARCHAR NOT NULL,
    text VARCHAR  
);

CREATE TABLE occ_type (
    name VARCHAR NOT NULL
);

CREATE TABLE positions (
    name VARCHAR NOT NULL
);

CREATE TABLE schools (
    name VARCHAR NOT NULL
);

CREATE TABLE works (
    username_personnel INTEGER REFERENCES personnel,
    id_occurrence INTEGER REFERENCES occurence,
    PRIMARY KEY (username_personnel, id_occurrence)
);

CREATE TABLE referenced (
    id_person INTEGER REFERENCES personnel,
    id_occurrence INTEGER REFERENCES occurence,
    PRIMARY KEY (id_person, id_occurrence)
);

CREATE TABLE referenced_type (
    name VARCHAR NOT NULL

);

INSERT INTO occ_type VALUES ('Homicídio');
INSERT INTO occ_type VALUES ('Abuso Físico');
INSERT INTO occ_type VALUES ('Ofensa à Integridade Psicológica');
INSERT INTO occ_type VALUES ('Furto');
INSERT INTO occ_type VALUES ('Vandalismo');
INSERT INTO occ_type VALUES ('Extorção');
INSERT INTO occ_type VALUES ('Abuso Sexual');
INSERT INTO occ_type VALUES ('Fraude');
INSERT INTO occ_type VALUES ('Sequestro');
INSERT INTO occ_type VALUES ('Sinistro Rodoviário');
INSERT INTO occ_type VALUES ('Crime Ambiental');
INSERT INTO occ_type VALUES ('Desaparecimento');

INSERT INTO positions VALUES ('Polícia');
INSERT INTO positions VALUES ('Detetive');
INSERT INTO positions VALUES ('Chefe de Esquadra');
INSERT INTO positions VALUES ('Diretor Nacional');

INSERT INTO schools VALUES ('Escola Prática de Polícia');

INSERT INTO referenced_type VALUES ('Testemunha');
INSERT INTO referenced_type VALUES ('Vítima');
INSERT INTO referenced_type VALUES ('Suspeito');
INSERT INTO referenced_type VALUES ('Queixoso');
INSERT INTO referenced_type VALUES ('Acusado');

INSERT INTO personnel (username, password, email, fullname, gender, birthdate, naturality, start_service, school, position, station) VALUES ('japp', 'feup2015', 'joao@gmail.com', 'João Afonso Pereira', 'Masculino', '1997-12-06', 'Portuguesa','2016-02-11', 'Escola Prática de Polícia', 'Diretor Nacional', 'Porto');
INSERT INTO personnel (username, password, email, fullname, gender, birthdate, naturality, start_service, school, position, station) VALUES ('mariajmribeiro', 'feup2015', 'maria@gmail.com', 'Maria João Ribeiro', 'Feminino', '1997-11-02', 'Portuguesa','2016-02-11', 'Escola Prática de Polícia', 'Chefe de Esquadra','Porto');
INSERT INTO personnel (username, password, email, fullname, gender, birthdate, naturality, start_service, school, position, station) VALUES ('patricia', 'feup2015', 'patricia@gmail.com', 'Patricia Rocha', 'Feminino', '1997-08-20', 'Portuguesa','2016-02-11', 'Escola Prática de Polícia', 'Detetive', 'Porto');

INSERT INTO occurrences (id, type, title, chief_detective, state, oppening_date, location, description) VALUES (1, 'Homicídio', 'Morreu em Salgueiros' ,'patricia', 'Aberto', '2017-02-11','Salgueiro','Ontem morreu um homem em Salgueiros');

INSERT INTO works (username_personnel, id_occurrence) VALUES ('japp', 1);