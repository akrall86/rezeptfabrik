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

CREATE TABLE rezeptfabrik.recipe
(
    id             INTEGER AUTO_INCREMENT,
    title          VARCHAR(30) NOT NULL,
    content        TEXT        NOT NULL,
    slug           VARCHAR(15) NOT NULL,
    user_id        INTEGER     NOT NULL,
    category_id    INTEGER     NOT NULL,
    article_id     INTEGER     NOT NULL,
    type_id        INTEGER     NOT NULL,
    photo_url      TEXT,
    published_date DATETIME    NOT NULL,
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
    name VARCHAR(5),
    PRIMARY KEY (name)
);

CREATE TABLE rezeptfabrik.category
(
    name VARCHAR(30),
    PRIMARY KEY (name)
);

CREATE TABLE rezeptfabrik.type
(
    name VARCHAR(30),
    PRIMARY KEY (name)
);

CREATE TABLE rezeptfabrik.favorites
(
    user_id   INTEGER NOT NULL,
    recipe_id INTEGER NOT NULL,
    PRIMARY KEY (user_id, recipe_id),
    CONSTRAINT fk_ufr_uid FOREIGN KEY (user_id) REFERENCES user (id),
    CONSTRAINT fk_ufr_rid FOREIGN KEY (recipe_id) REFERENCES recipe (id)
);