-- MySQL Script generated by MySQL Workbench
-- Fri Mar 30 14:45:03 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

DROP DATABASE IF EXISTS `cop4331`;
CREATE DATABASE `cop4331`;
USE `cop4331`;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE TABLE IF NOT EXISTS `users` (
  `userID` INT NOT NULL auto_increment,
  `fName` VARCHAR(45) NULL,
  `lName` VARCHAR(45) NULL,
  `userName` VARCHAR(45) NULL UNIQUE,
  `email` VARCHAR(45) NULL UNIQUE,
  `password` VARCHAR(64) NULL,
  `phone` VARCHAR(12) NULL,
  `description` VARCHAR(256) NULL,
  `picture_path` VARCHAR(64),
  PRIMARY KEY (`userID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `events`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `events` ;

CREATE TABLE IF NOT EXISTS `events` (
  `eventID` INT NOT NULL auto_increment,
  `name` VARCHAR(45) NULL,
  `start` DATETIME,
  `end` DATETIME,
  `location` VARCHAR(45) NULL,
  `description` VARCHAR(256) NULL,
  `category` VARCHAR(256) NULL,
  PRIMARY KEY (`eventID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `teams`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `teams` ;

CREATE TABLE IF NOT EXISTS `teams` (
  `teamID` INT NOT NULL auto_increment,
  `team_name` VARCHAR(45) NULL,
  `picture_path` VARCHAR(64),  
  PRIMARY KEY (`teamID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users_has_teams`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users_has_teams` ;

CREATE TABLE IF NOT EXISTS `users_has_teams` (
  `users_userID` INT NOT NULL,
  `teams_teamID` INT NOT NULL,
  `isUserAdmin` TINYINT NULL,
  PRIMARY KEY (`users_userID`, `teams_teamID`),
  INDEX `fk_users_has_teams_teams1_idx` (`teams_teamID` ASC),
  INDEX `fk_users_has_teams_users_idx` (`users_userID` ASC),
  CONSTRAINT `fk_users_has_teams_users`
    FOREIGN KEY (`users_userID`)
    REFERENCES `users` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_teams_teams1`
    FOREIGN KEY (`teams_teamID`)
    REFERENCES `teams` (`teamID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users_has_events`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users_has_events` ;

CREATE TABLE IF NOT EXISTS `users_has_events` (
  `users_userID` INT NOT NULL,
  `events_eventID` INT NOT NULL,
  PRIMARY KEY (`users_userID`, `events_eventID`),
  INDEX `fk_users_has_events_events1_idx` (`events_eventID` ASC),
  INDEX `fk_users_has_events_users1_idx` (`users_userID` ASC),
  CONSTRAINT `fk_users_has_events_users1`
    FOREIGN KEY (`users_userID`)
    REFERENCES `users` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_events_events1`
    FOREIGN KEY (`events_eventID`)
    REFERENCES `events` (`eventID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `events_has_teams`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `events_has_teams` ;

CREATE TABLE IF NOT EXISTS `events_has_teams` (
  `eventID` INT NOT NULL,
  `teamID` INT NOT NULL,
  PRIMARY KEY (`eventID`, `teamID`),
  INDEX `fk_events_has_teams_teams1_idx` (`teamID` ASC),
  INDEX `fk_events_has_teams_events1_idx` (`eventID` ASC),
  CONSTRAINT `fk_events_has_teams_events1`
    FOREIGN KEY (`eventID`)
    REFERENCES `events` (`eventID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_events_has_teams_teams1`
    FOREIGN KEY (`teamID`)
    REFERENCES `teams` (`teamID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
