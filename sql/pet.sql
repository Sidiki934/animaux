USE petgame;

DROP TABLE IF EXISTS pet;

CREATE TABLE IF NOT EXISTS pet(
	pet_id INTEGER AUTO_INCREMENT PRIMARY KEY,
	fname VARCHAR(30) NOT NULL,
	age INTEGER,
	owner VARCHAR(50),
	race VARCHAR(100),
	gender ENUM('F', 'M'),
	dob DATE,
    id_owners MEDIUMINT(9),
    id_generique MEDIUMINT(9),
	photo LONGBLOB
	
)ENGINE =InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO pet (fname, race, owner, age, gender, id_generique, id_owners)
VALUES ('Félix', 'chat', 'jean luke', 6, 'M', 3, 1);

INSERT INTO pet (fname, race, owner, age, gender, id_generique, id_owners)
VALUES ('Jolly Jumper', 'cheval', 'LUKA', 9, 'F', 5, 1);

INSERT INTO pet (fname, race, owner, age, gender, id_generique, id_owners)
VALUES ('Rantanplan', 'chien', 'luke cage', 4, 'M', 6, 3);

INSERT INTO pet (fname, race, owner, age, gender, id_generique, id_owners)
VALUES ('Garfield', 'chat', 'Théo', 7, 'M', 2, 2);

SHOW VARIABLES LIKE "secure_file_priv";
use petgame;
SELECT * FROM petgame.pet;
LOAD DATA INFILE 'C:/wamp64/tmp/departments_regions_france_2016.csv'
	INTO TABLE pet
    FIELDS TERMINATED BY ';'
    ENCLOSED BY ''
    LINES TERMINATED BY '\n'
    IGNORE 1 ROWS
;

