SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema cscidb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cscidb` DEFAULT CHARACTER SET utf8 ;
USE `cscidb` ;

-- -----------------------------------------------------
-- Table `cscidb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`user` (
  `email` VARCHAR(45) NOT NULL,
  `firstName` VARCHAR(45) NOT NULL,
  `lastName` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NULL,
  `lastsignin` DATETIME NULL,
  `lastipaddress` VARCHAR(45) NULL,
  `user_perm` INT NOT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`log_login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`log_login` (
  `loginID` INT NOT NULL AUTO_INCREMENT,
  `timestamp` DATETIME NOT NULL,
  `ipAddress` VARCHAR(45) NOT NULL,
  `user_email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`loginID`),
  INDEX `fk_log_login_user1_idx` (`user_email` ASC),
  CONSTRAINT `fk_log_login_user1`
    FOREIGN KEY (`user_email`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`session`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`session` (
  `sessionID` INT NOT NULL AUTO_INCREMENT,
  `hostID` INT UNSIGNED NOT NULL,
  `sessionName` VARCHAR(45) NOT NULL,
  `sessionExpired` TINYINT(1) NOT NULL,
  `sessionKey` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`sessionID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`class` (
  `classID` INT NOT NULL AUTO_INCREMENT,
  `classCode` VARCHAR(45) NULL,
  `professorEmail` VARCHAR (45) NULL,
  `taEmail` VARCHAR (45) NULL,
  `className` VARCHAR(45) NULL,
  `activeSession` INT DEFAULT '0',
  `syllabusURL` VARCHAR(45) NULL,
  `classTime` VARCHAR(45) NULL,
  `room` VARCHAR(45) NULL,
  `taHours` VARCHAR(45) NULL,
  `instructorHours` VARCHAR(45) NULL,
  `classDescription` MEDIUMTEXT NULL,
  PRIMARY KEY (`classID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`question`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`question` (
  `questionID` INT NOT NULL AUTO_INCREMENT,
  `sessionID` INT NOT NULL,
  `questionBody` TEXT NOT NULL,
  `user_email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`questionID`),
  INDEX `fk_question_session1_idx` (`sessionID` ASC),
  INDEX `fk_question_user1_idx` (`user_email` ASC),
  CONSTRAINT `fk_question_session1`
    FOREIGN KEY (`sessionID`)
    REFERENCES `cscidb`.`session` (`sessionID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_question_user1`
    FOREIGN KEY (`user_email`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`answer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`answer` (
  `answerID` INT NOT NULL AUTO_INCREMENT,
  `questionID` INT NOT NULL,
  `sessionID` INT NOT NULL,
  `answerBody` TEXT NULL,
  `correct` TINYINT(1) NULL,
  `user_email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`answerID`, `sessionID`),
  INDEX `fk_answer_question1_idx` (`questionID` ASC),
  INDEX `fk_answer_session1_idx` (`sessionID` ASC),
  INDEX `fk_answer_user1_idx` (`user_email` ASC),
  CONSTRAINT `fk_answer_question1`
    FOREIGN KEY (`questionID`)
    REFERENCES `cscidb`.`question` (`questionID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_answer_session1`
    FOREIGN KEY (`sessionID`)
    REFERENCES `cscidb`.`session` (`sessionID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_answer_user1`
    FOREIGN KEY (`user_email`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`attendance`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`attendance` (
  `attendanceID` INT NOT NULL AUTO_INCREMENT,
  `sessionID` INT NOT NULL,
  `state` TINYINT(1) NOT NULL,
  `user_email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`attendanceID`),
  INDEX `fk_attendance_session1_idx` (`sessionID` ASC),
  INDEX `fk_attendance_user1_idx` (`user_email` ASC),
  CONSTRAINT `fk_attendance_session1`
    FOREIGN KEY (`sessionID`)
    REFERENCES `cscidb`.`session` (`sessionID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_attendance_user1`
    FOREIGN KEY (`user_email`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `cscidb`.`user_class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`user_class` (
  `iduser_class` INT NOT NULL AUTO_INCREMENT,
  `role` VARCHAR(45) NULL,
  `user_email` VARCHAR(45) NOT NULL,
  `class_classID` INT NOT NULL,
  PRIMARY KEY (`iduser_class`),
  INDEX `fk_user_class_user1_idx` (`user_email` ASC),
  INDEX `fk_user_class_class1_idx` (`class_classID` ASC),
  CONSTRAINT `fk_user_class_user1`
    FOREIGN KEY (`user_email`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_class_class1`
    FOREIGN KEY (`class_classID`)
    REFERENCES `cscidb`.`class` (`classID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`assignment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`assignment` (
  `name` INT NOT NULL,
  `title` VARCHAR(45) NULL,
  `description` LONGTEXT NULL,
  `dueDate` DATETIME NULL,
  `isLive` TINYINT(1) NULL,
  `url` VARCHAR(45) NULL,
  `classID` VARCHAR(45) NULL,
  `postTime` DATETIME NULL,
  `class_classID` INT NOT NULL,
  PRIMARY KEY (`name`),
  INDEX `fk_assignment_class1_idx` (`class_classID` ASC),
  CONSTRAINT `fk_assignment_class1`
    FOREIGN KEY (`class_classID`)
    REFERENCES `cscidb`.`class` (`classID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`announcement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`announcement` (
  `classID` VARCHAR(45) NULL,
  `title` VARCHAR(45) NULL,
  `annID` INT NOT NULL AUTO_INCREMENT,
  `description` LONGTEXT NULL,
  `postTime` VARCHAR(45) NULL,
  `class_classID` INT NOT NULL,
  `user_email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`annID`),
  INDEX `fk_announcement_class1_idx` (`class_classID` ASC),
  INDEX `fk_announcement_user1_idx` (`user_email` ASC),
  CONSTRAINT `fk_announcement_class1`
    FOREIGN KEY (`class_classID`)
    REFERENCES `cscidb`.`class` (`classID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_announcement_user1`
    FOREIGN KEY (`user_email`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- Inserts Base Users
INSERT INTO `cscidb`.`user` (`email`, `firstName`, `lastName`, `password`, `user_perm`) VALUES ('mark.a.gong-guy@biola.edu', 'Mark', 'Gong-Guy', 'password', '4');
INSERT INTO `cscidb`.`user` (`email`, `firstName`, `lastName`, `password`, `user_perm`) VALUES ('peter.a.alford@biola.edu', 'Pedro', 'Wilson', 'password', '3');
INSERT INTO `cscidb`.`user` (`email`, `firstName`, `lastName`, `password`, `user_perm`) VALUES ('peteralford13@gmail.com', 'Peter', 'Alford', 'password', '2');

-- Inserts class
INSERT INTO `cscidb`.`class` (`classID`, `classCode`, `className`, `syllabusURL`, `classTime`, `room`) VALUES ('1', 'CSCI 101', 'Introduction to Computer Science', 'http://csci.biola.edu/csci105Lin/index.htm', '10:00 am - 11:00 am', 'Library 101');
INSERT INTO `cscidb`.`class` (`classID`, `classCode`, `className`, `syllabusURL`, `classTime`, `room`) VALUES ('2', 'CSCI 102', 'Data Structures', 'http://csci.biola.edu/csci105Lin/index.htm', '10:00 am - 11:00 am', 'Library 101');

-- Inserts user in class
INSERT INTO `cscidb`.`user_class` (`role`, `user_email`, `class_classID`) VALUES ('1', 'mark.a.gong-guy@biola.edu', '1');


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
