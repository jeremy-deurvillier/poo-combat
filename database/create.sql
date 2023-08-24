CREATE DATABASE poocombat;

USE poocombat;

CREATE TABLE heroes (
    id_hero INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(40) NOT NULL UNIQUE,
    class VARCHAR(40) NOT NULL DEFAULT 'guerrier',
    hp INT NOT NULL DEFAULT 100,
    energy INT NOT NULL DEFAULT 100,
    last_summon DATETIME
);
