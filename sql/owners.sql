USE petgame;

DROP TABLE IF EXISTS owners;

CREATE TABLE IF NOT EXISTS owners(
	own_id INTEGER AUTO_INCREMENT PRIMARY KEY,
	fname VARCHAR(30) NOT NULL,
	mail VARCHAR(100) NOT NULL UNIQUE,
	phone INTEGER UNIQUE,
	pet VARCHAR(40),
	age INTEGER,
	civility ENUM('MME', 'M', 'MLLE'),
	dob DATE,
	photo LONGBLOB
)ENGINE =InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 -- DELETE FROM `owners` WHERE `owners`.`own_id` = 1;
INSERT INTO owners(titre, nom, prenom, mail, phone)
VALUES (0, 'Blanc-sec', 'Adèle', 'adeleB@outlook.fr', '0654604030');

INSERT INTO owners(titre, nom, prenom, mail, phone)
VALUES (1, 'Castafiore', 'Bianca', 'BiancaC@outlook.fr', '0654604560');

INSERT INTO owners(titre, nom, prenom, mail, phone)
VALUES (2, 'Luke', 'Lucky', 'LuckyL@outlook.fr', '0666604560');

INSERT INTO owners(titre, nom, prenom, mail, phone)
VALUES (3, 'Talon', 'Achille', 'AchilleT@outlook.fr', '0659804560');
