-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema infantil_education_mch
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema infantil_education_mch
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `infantil_education_mch` DEFAULT CHARACTER SET utf8 ;
USE `infantil_education_mch` ;

-- -----------------------------------------------------
-- Table `infantil_education_mch`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `infantil_education_mch`.`users` ;

CREATE TABLE IF NOT EXISTS `infantil_education_mch`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `admin` TINYINT(3) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `infantil_education_mch`.`units`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `infantil_education_mch`.`units` ;

CREATE TABLE IF NOT EXISTS `infantil_education_mch`.`units` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `users_id` INT(11) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_units_users1_idx` (`users_id` ASC),
  UNIQUE INDEX `users_id_UNIQUE` (`users_id` ASC),
  CONSTRAINT `fk_units_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `infantil_education_mch`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `infantil_education_mch`.`parents`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `infantil_education_mch`.`parents` ;

CREATE TABLE IF NOT EXISTS `infantil_education_mch`.`parents` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `mother` VARCHAR(255) NOT NULL,
  `father` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `infantil_education_mch`.`candidates`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `infantil_education_mch`.`candidates` ;

CREATE TABLE IF NOT EXISTS `infantil_education_mch`.`candidates` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `birth_date` DATE NOT NULL,
  `tel1` BIGINT(12) NOT NULL,
  `tel2` BIGINT(12) NULL,
  `inscription_date` DATE NOT NULL,
  `situation` VARCHAR(45) NOT NULL,
  `units_id` INT(11) NOT NULL,
  `parents_id` INT NOT NULL,
  PRIMARY KEY (`id`, `units_id`, `parents_id`),
  INDEX `fk_candidates_units_idx` (`units_id` ASC),
  INDEX `fk_candidates_parents1_idx` (`parents_id` ASC),
  CONSTRAINT `fk_candidates_units`
    FOREIGN KEY (`units_id`)
    REFERENCES `infantil_education_mch`.`units` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_candidates_parents1`
    FOREIGN KEY (`parents_id`)
    REFERENCES `infantil_education_mch`.`parents` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `infantil_education_mch`.`address`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `infantil_education_mch`.`address` ;

CREATE TABLE IF NOT EXISTS `infantil_education_mch`.`address` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `address` VARCHAR(255) NOT NULL,
  `number` INT NOT NULL,
  `neighborhood` VARCHAR(255) NOT NULL,
  `candidates_id` INT(11) NOT NULL,
  `candidates_units_id` INT(11) NOT NULL,
  `candidates_parents_id` INT NOT NULL,
  PRIMARY KEY (`id`, `candidates_id`, `candidates_units_id`, `candidates_parents_id`),
  INDEX `fk_address_candidates1_idx` (`candidates_id` ASC, `candidates_units_id` ASC, `candidates_parents_id` ASC),
  CONSTRAINT `fk_address_candidates1`
    FOREIGN KEY (`candidates_id` , `candidates_units_id` , `candidates_parents_id`)
    REFERENCES `infantil_education_mch`.`candidates` (`id` , `units_id` , `parents_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
