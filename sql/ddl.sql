CREATE SCHEMA IF NOT EXISTS rezeptfabrik;

CREATE TABLE rezeptfabrik.user
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

CREATE TABLE rezeptfabrik.role
(
    name VARCHAR(30),
    PRIMARY KEY (name)
);

INSERT INTO rezeptfabrik.role (name)
VALUES ('ADMIN'),
       ('USER');

CREATE TABLE rezeptfabrik.user_has_role
(
    user_id INTEGER     NOT NULL,
    role_id VARCHAR(30) NOT NULL,
    PRIMARY KEY (user_id, role_id),
    CONSTRAINT fk_uhr_uid FOREIGN KEY (user_id) REFERENCES user (id),
    CONSTRAINT fk_uhr_rid FOREIGN KEY (role_id) REFERENCES role (name)
);

CREATE TABLE rezeptfabrik.recipe
(
    id             INTEGER AUTO_INCREMENT,
    title          VARCHAR(30) NOT NULL,
    content        TEXT        NOT NULL,
    slug           VARCHAR(15) NOT NULL,
    user_id        INTEGER     NOT NULL,
    category_name  VARCHAR(30) NOT NULL,
    type_name      VARCHAR(30) NOT NULL,
    photo_url      TEXT,
    published_date DATETIME    NOT NULL,
    rating         INTEGER     not null,
    PRIMARY KEY (id),
    UNIQUE (title),
    UNIQUE (slug)
);

CREATE TABLE rezeptfabrik.ingredient
(
    id   INTEGER AUTO_INCREMENT,
    name VARCHAR(30),
    PRIMARY KEY (id)
);

CREATE TABLE rezeptfabrik.unit_of_measurement
(
    id   INTEGER AUTO_INCREMENT,
    name VARCHAR(15),
    PRIMARY KEY (id)
);

INSERT INTO rezeptfabrik.unit_of_measurement (name)
VALUES ('g'),
       ('dag'),
       ('kg'),
       ('ml'),
       ('cl'),
       ('l'),
       ('Teelöffel'),
       ('Esslöffel'),
       ('Prise'),
       ('Schuss');

CREATE TABLE rezeptfabrik.recipe_has_ingredient_has_unit_of_measurement
(
    recipe_id              INTEGER NOT NULL,
    ingredient_id          INTEGER NOT NULL,
    unit_of_measurement_id INTEGER NOT NULL,
    CONSTRAINT fk_riuom_rid FOREIGN KEY (recipe_id) REFERENCES recipe (id),
    CONSTRAINT fk_riuom_iid FOREIGN KEY (ingredient_id) REFERENCES ingredient (id),
    CONSTRAINT fk_riuom_uomid FOREIGN KEY (unit_of_measurement_id) REFERENCES unit_of_measurement (id)
);

CREATE TABLE rezeptfabrik.category
(
    name VARCHAR(30),
    PRIMARY KEY (name)
);

INSERT INTO rezeptfabrik.category (name)
VALUES ('Frühstück'),
       ('Vorspeise'),
       ('Dessert'),
       ('Hauptspeise'),
       ('Getränk'),
       ('Suppe'),
       ('Abendessen');

CREATE TABLE rezeptfabrik.type
(
    name VARCHAR(30),
    PRIMARY KEY (name)
);

INSERT INTO rezeptfabrik.type (name)
VALUES ('mit Fleisch'),
       ('vegetarisch'),
       ('vegan');

CREATE TABLE rezeptfabrik.user_has_favorites
(
    user_id   INTEGER NOT NULL,
    recipe_id INTEGER NOT NULL,
    PRIMARY KEY (user_id, recipe_id),
    CONSTRAINT fk_ufr_uid FOREIGN KEY (user_id) REFERENCES user (id),
    CONSTRAINT fk_ufr_rid FOREIGN KEY (recipe_id) REFERENCES recipe (id)
);
