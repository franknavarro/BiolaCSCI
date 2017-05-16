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
  `lastSessionID` INT NOT NULL,
  `syllabusURL` VARCHAR(45) NULL,
  `classTime` VARCHAR(45) NULL,
  `room` VARCHAR(45) NULL,
  `taHours` VARCHAR(45) NULL,
  `instructorHours` VARCHAR(45) NULL,
  `classDescription` MEDIUMTEXT NULL,
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
-- Table `cscidb`.`folder`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`folder` (
  `folderID` INT NOT NULL,
  `folderName` VARCHAR(45) NULL,
  `parentFolderID` VARCHAR(45) NULL,
  `childFileID` VARCHAR(45) NULL,
  `user_email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`folderID`),
  INDEX `fk_Folder_user1_idx` (`user_email` ASC),
  CONSTRAINT `fk_Folder_user1`
    FOREIGN KEY (`user_email`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`files` (
  `fileName` VARCHAR(45) NOT NULL,
  `fileBody` BLOB NULL,
  `updateTime` DATETIME NULL,
  `fileSize` FLOAT NULL,
  `fileOwner` VARCHAR(45) NOT NULL,
  `folder_folderID` INT NOT NULL,
  PRIMARY KEY (`fileName`),
  INDEX `fk_Files_user1_idx` (`fileOwner` ASC),
  INDEX `fk_files_folder1_idx` (`folder_folderID` ASC),
  CONSTRAINT `fk_Files_user1`
    FOREIGN KEY (`fileOwner`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_files_folder1`
    FOREIGN KEY (`folder_folderID`)
    REFERENCES `cscidb`.`folder` (`folderID`)
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
    REFERENCES `cscidb`.`folder` (`folderID`)
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
    REFERENCES `cscidb`.`folder` (`folderID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Folder_has_Files_Files1`
    FOREIGN KEY (`Files_FileName`)
    REFERENCES `cscidb`.`files` (`fileName`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`channels`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`channels` (
  `channelID` INT NOT NULL,
  `channel_name` VARCHAR(45) NULL,
  `creatorID` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`channelID`),
  INDEX `fk_Channels_user1_idx` (`creatorID` ASC),
  CONSTRAINT `fk_Channels_user1`
    FOREIGN KEY (`creatorID`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cscidb`.`messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cscidb`.`messages` (
  `messageID` INT NOT NULL,
  `postTime` DATETIME NULL,
  `message` LONGTEXT NULL,
  `posterID` VARCHAR(45) NOT NULL,
  `channels_channelID` INT NOT NULL,
  PRIMARY KEY (`messageID`),
  INDEX `fk_Messages_user1_idx` (`posterID` ASC),
  INDEX `fk_messages_channels1_idx` (`channels_channelID` ASC),
  CONSTRAINT `fk_Messages_user1`
    FOREIGN KEY (`posterID`)
    REFERENCES `cscidb`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_channels1`
    FOREIGN KEY (`channels_channelID`)
    REFERENCES `cscidb`.`channels` (`channelID`)
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

INSERT INTO `cscidb`.`user` (`email`, `firstName`, `lastName`, `password`, `user_perm`) VALUES ('mark.a.gong-guy@biola.edu', 'Mark', 'Gong-Guy', 'password', '4');
INSERT INTO `cscidb`.`user` (`email`, `firstName`, `lastName`, `password`, `user_perm`) VALUES ('peter.a.alford@biola.edu', 'Pedro', 'Wilson', 'password', '5');
INSERT INTO `cscidb`.`user` (`email`, `firstName`, `lastName`, `password`, `user_perm`) VALUES ('peteralford13@gmail.com', 'Peter', 'Alford', 'password', '6');


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
