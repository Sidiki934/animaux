-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema petgame
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema petgame
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `petgame` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `petgame` ;

-- -----------------------------------------------------
-- Table `petgame`.`region`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `petgame`.`region` (
  `reg_id` INT NOT NULL AUTO_INCREMENT,
  `regionName` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`reg_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
;


-- -----------------------------------------------------
-- Table `petgame`.`contacts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `petgame`.`contacts` (
  `cli_id` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(30) NOT NULL,
  `gender` ENUM('F', 'M', 'N') NULL DEFAULT NULL,
  `dob` DATE NULL DEFAULT NULL,
  `type` ENUM('0', '1') NOT NULL,
  `mail` VARCHAR(100) NOT NULL,
  `pass` VARCHAR(50) NOT NULL,
  `reg_id` INT NOT NULL,
  PRIMARY KEY (`cli_id`),
  UNIQUE INDEX `mail` (`mail` ASC),
  INDEX `fk_contacts_region1_idx` (`reg_id` ASC),
  CONSTRAINT `fk_contacts_region1`
    FOREIGN KEY (`reg_id`)
    REFERENCES `petgame`.`region` (`reg_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
;

INSERT INTO `contacts` (`cli_id`, `fname`, `gender`, `dob`, `type`, `mail`, `pass`, `reg_id` ) VALUES
(1, 'FJack', 'M', '1997-04-17', '1', 'test@outlook.fr', 'Toto', 3);
-- -----------------------------------------------------
-- Table `petgame`.`generique`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `petgame`.`generique` (
  `gen_id` INT NOT NULL AUTO_INCREMENT,
  `nom` CHAR(30) NULL DEFAULT NULL,
  PRIMARY KEY (`gen_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
;


INSERT INTO generique (nom) VALUES ('Chien');
INSERT INTO generique (nom) VALUES ('Chat');
INSERT INTO generique (nom) VALUES ('Perroquet');
INSERT INTO generique (nom) VALUES ('Souris');
INSERT INTO generique (nom) VALUES ('Lapin');
INSERT INTO generique (nom) VALUES ('Hamster');
INSERT INTO generique (nom) VALUES ('Ecureuil');


-- -----------------------------------------------------
-- Table `petgame`.`pet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `petgame`.`pet` (
  `pet_id` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(30) NOT NULL,
  `race` VARCHAR(100) NULL DEFAULT NULL,
  `gender` ENUM('F', 'M') NULL DEFAULT NULL,
  `photo` LONGBLOB NULL DEFAULT NULL,
  `description` LONGTEXT NULL DEFAULT NULL,
  `gen_id` INT NOT NULL,
  `cli_id` INT NOT NULL,
  `reg_id` INT NOT NULL,
  PRIMARY KEY (`pet_id`),
  INDEX `fk_pet_generique_idx` (`gen_id` ASC),
  INDEX `fk_pet_contacts1_idx` (`cli_id` ASC),
  INDEX `fk_pet_region1_idx` (`reg_id` ASC),
  CONSTRAINT `fk_pet_contacts1`
    FOREIGN KEY (`cli_id`)
    REFERENCES `petgame`.`contacts` (`cli_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pet_generique`
    FOREIGN KEY (`gen_id`)
    REFERENCES `petgame`.`generique` (`gen_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pet_region1`
    FOREIGN KEY (`reg_id`)
    REFERENCES `petgame`.`region` (`reg_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
;
INSERT INTO `pet` (`pet_id`, `fname`,  `gen_id`, `cli_id`,  `race`, `gender`, `photo`,`description`, `reg_id`) VALUES
(1, 'Felix', '5', '1', 'Labrador', 'M', NULL, NULL, 4);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
