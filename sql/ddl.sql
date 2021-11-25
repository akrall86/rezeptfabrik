CREATE SCHEMA IF NOT EXISTS rezeptefabrik;

CREATE TABLE user
(
    id        INTEGER AUTO_INCREMENT,
    firstname VARCHAR(30)  NOT NULL,
    lastname  VARCHAR(30)  NOT NULL,
    user_name VARCHAR(30)  NOT NULL,
    email     VARCHAR(255) NOT NULL,
    password  TEXT         NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (user_name),
    UNIQUE KEY (email)
);
CREATE TABLE role(
    name VARCHAR(30),
    PRIMARY KEY (name)
);
create table blabla(id int);
CREATE TABLE recipe
(
    id          INTEGER AUTO_INCREMENT,
    title       VARCHAR(30) NOT NULL,
    content     TEXT        NOT NULL,
    slug        VARCHAR(15) NOT NULL ,
    user_id     INTEGER     NOT NULL,
    category_id INTEGER     NOT NULL,
    article_id  INTEGER     NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (title),
    UNIQUE (slug)
);



CREATE TABLE ingredient
(

);

CREATE TABLE unit_of_measurement
(

);
CREATE TABLE categorie
(
);

CREATE TABLE typ
(
);

CREATE TABLE favour
(
);

CREATE TABLE besichtigung
(
    user_id       INTEGER,
    immobilien_id INTEGER,
    termin        DATETIME,
    PRIMARY KEY (user_id, immobilien_id, termin),
    CONSTRAINT fk_bes_uid FOREIGN KEY (user_id) REFERENCES users (id),
    CONSTRAINT fk_bes_iid FOREIGN KEY (immobilien_id) REFERENCES immobilie (id)
);
CREATE TABLE kontaktformular
(
    id    INTEGER AUTO_INCREMENT,
    name  VARCHAR(30) NOT NULL,
    grund VARCHAR(30) NOT NULL,
    text  TEXT        NOT NULL,
    PRIMARY KEY (id)
);

