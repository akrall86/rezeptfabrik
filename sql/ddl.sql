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
       ('USER'),
       ('Chefkoch'),
       ('Hobbykoch');

CREATE TABLE rezeptfabrik.user_has_role
(
    user_id   INTEGER     NOT NULL,
    role_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (user_id, role_name),
    CONSTRAINT fk_uhr_uid FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_uhr_rid FOREIGN KEY (role_name) REFERENCES role (name) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE rezeptfabrik.recipe
(
    id             INTEGER AUTO_INCREMENT,
    title          VARCHAR(30) NOT NULL,
    content        TEXT        NOT NULL,
    slug           VARCHAR(50) NOT NULL,
    user_id        INTEGER     NOT NULL,
    category_id    INTEGER     NOT NULL,
    type_id        INTEGER     NOT NULL,
    photo_url      TEXT,
    published_date DATETIME    NOT NULL,
    rating_count   INTEGER     NOT NULL,
    rating         FLOAT       NOT NULL,
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
       ('Stück'),
       ('TL'),
       ('EL'),
       ('Prise'),
       ('Schuss'),
       ('Pkg');

CREATE TABLE rezeptfabrik.recipe_has_ingredient_has_unit_of_measurement
(
    recipe_id              INTEGER NOT NULL,
    ingredient_id          INTEGER NOT NULL,
    unit_of_measurement_id INTEGER NOT NULL,
    amount                 FLOAT   NOT NULL,
    CONSTRAINT fk_riuom_rid FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_riuom_iid FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_riuom_uomid FOREIGN KEY (unit_of_measurement_id) REFERENCES unit_of_measurement (id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE rezeptfabrik.category
(
    id   INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(30),
    PRIMARY KEY (id)
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
    id   INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(30),
    PRIMARY KEY (id)
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

CREATE TABLE rezeptfabrik.messages
(
    id              INTEGER      NOT NULL AUTO_INCREMENT,
    from_user_id    INTEGER      NOT NULL,
    to_user_id      INTEGER      NOT NULL,
    message_content VARCHAR(250) NOT NULL,
    sent_time       DATETIME     NOT NULL,
    seen            BOOLEAN,
    PRIMARY KEY (id)
);
