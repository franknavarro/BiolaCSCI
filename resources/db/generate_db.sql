-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema cscidb
-- -----------------------------------------------------

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
  `activeCookie` VARCHAR(45) NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`log_login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`log_login` (
  `loginID` INT NOT NULL AUTO_INCREMENT,
  `timestamp` DATETIME NOT NULL,
  `incorrectIP` VARCHAR(45) NOT NULL,
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
  `professorID` INT UNSIGNED NOT NULL,
  `className` VARCHAR(45) NULL,
  `lastSessionID` INT NOT NULL,
  `syllabusURL` VARCHAR(45) NULL,
  `classTime` VARCHAR(45) NULL,
  `room` VARCHAR(45) NULL,
  `taHours` VARCHAR(45) NULL,
  `instructorHours` VARCHAR(45) NULL,
  `classcol` VARCHAR(45) NULL,
  PRIMARY KEY (`classID`),
  INDEX `fk_class_session1_idx` (`lastSessionID` ASC),
  CONSTRAINT `fk_class_session1`
    FOREIGN KEY (`lastSessionID`)
    REFERENCES `cscidb`.`session` (`sessionID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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
-- Table `cscidb`.`files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`files` (
  `FileName` VARCHAR(45) NOT NULL,
  `FileText` BLOB NULL,
  `UpdateTime` DATETIME NULL,
  `FileSize` INT NULL,
  `ParentFolderID` VARCHAR(45) NULL,
  `user_email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`FileName`),
  INDEX `fk_Files_user1_idx` (`user_email` ASC),
  CONSTRAINT `fk_Files_user1`
    FOREIGN KEY (`user_email`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`folder`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`folder` (
  `FolderID` INT NOT NULL,
  `FolderName` VARCHAR(45) NULL,
  `ParentFolderID` VARCHAR(45) NULL,
  `ChildFolderID` VARCHAR(45) NULL,
  `ChildFileID` VARCHAR(45) NULL,
  `Files_FileName` VARCHAR(45) NOT NULL,
  `user_email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`FolderID`),
  INDEX `fk_Folder_Files1_idx` (`Files_FileName` ASC),
  INDEX `fk_Folder_user1_idx` (`user_email` ASC),
  CONSTRAINT `fk_Folder_Files1`
    FOREIGN KEY (`Files_FileName`)
    REFERENCES `cscidb`.`files` (`FileName`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Folder_user1`
    FOREIGN KEY (`user_email`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`Folder_has_Folder`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`Folder_has_Folder` (
  `Folder_FolderID1` INT NOT NULL,
  PRIMARY KEY (`Folder_FolderID1`),
  INDEX `fk_Folder_has_Folder_Folder2_idx` (`Folder_FolderID1` ASC),
  CONSTRAINT `fk_Folder_has_Folder_Folder2`
    FOREIGN KEY (`Folder_FolderID1`)
    REFERENCES `cscidb`.`folder` (`FolderID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`Folder_has_Files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`Folder_has_Files` (
  `Folder_FolderID` INT NOT NULL,
  `Files_FileName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Folder_FolderID`, `Files_FileName`),
  INDEX `fk_Folder_has_Files_Files1_idx` (`Files_FileName` ASC),
  INDEX `fk_Folder_has_Files_Folder1_idx` (`Folder_FolderID` ASC),
  CONSTRAINT `fk_Folder_has_Files_Folder1`
    FOREIGN KEY (`Folder_FolderID`)
    REFERENCES `cscidb`.`folder` (`FolderID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Folder_has_Files_Files1`
    FOREIGN KEY (`Files_FileName`)
    REFERENCES `cscidb`.`files` (`FileName`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`channels`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`channels` (
  `ChannelID` INT NOT NULL,
  `MessageID` INT NULL,
  `CreatorID` INT NULL,
  `user_email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ChannelID`),
  INDEX `fk_Channels_user1_idx` (`user_email` ASC),
  CONSTRAINT `fk_Channels_user1`
    FOREIGN KEY (`user_email`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`messages` (
  `MessageID` INT NOT NULL,
  `postTime` DATETIME NULL,
  `Message` LONGTEXT NULL,
  `Channels_ChannelID` INT NOT NULL,
  `posterID` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`MessageID`),
  INDEX `fk_Messages_Channels1_idx` (`Channels_ChannelID` ASC),
  INDEX `fk_Messages_user1_idx` (`posterID` ASC),
  CONSTRAINT `fk_Messages_Channels1`
    FOREIGN KEY (`Channels_ChannelID`)
    REFERENCES `cscidb`.`channels` (`ChannelID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Messages_user1`
    FOREIGN KEY (`posterID`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`user_class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`user_class` (
  `iduser_class` INT NOT NULL,
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
  `name` INT NOT NULL,
  `description` VARCHAR(45) NULL,
  `postTime` VARCHAR(45) NULL,
  `class_classID` INT NOT NULL,
  `user_email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`name`),
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


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
