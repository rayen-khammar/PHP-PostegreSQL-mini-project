
-- if we gonna verify, we use:
-- SELECT * FROM utilisateur
-- WHERE name = $1 AND password = crypt($2, password);
-- where $1 is the guess for username and $2 for password

CREATE TYPE  role AS  ENUM ('normal','admin');

CREATE TABLE IF NOT EXISTS users(
    id SERIAL,
    name VARCHAR(100) NOT NULL,
    password TEXT NOT NULL,
    role role,
    CONSTRAINT pk_user PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS section(
    id SERIAL PRIMARY KEY,
    des TEXT
);

CREATE TABLE IF NOT EXISTS students(
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    date_de_naiss DATE NOT NULL,
    img VARCHAR(256) NOT NULL,
    section INTEGER,
    CONSTRAINT fk_section FOREIGN KEY(section) REFERENCES SECTION(id)
);



-- Un user normal n’a le droit qu’à la consultation
-- 7. Vous allez avoir une table etudiant avec un nom, une
-- image, une date de naissance et une section
-- 8. La table section devra avoir une designation et une
