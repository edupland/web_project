-- MySQL Script generated by MySQL Workbench
-- Mon Jan 29 11:54:47 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `user_id` INT NOT NULL,
  `user_firstname` VARCHAR(255) NULL,
  `user_lastname` VARCHAR(255) NULL,
  `user_password` VARCHAR(255) NULL,
  `user_mail` VARCHAR(255) NULL,
  `user_telephone` VARCHAR(255) NULL,
  `user_token` VARCHAR(255) NULL,
  `user_valid` INT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `id` (`user_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`category` (
  `category_id` INT NOT NULL,
  `category_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`category_id`));


-- -----------------------------------------------------
-- Table `mydb`.`accesright`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`accesright` (
  `accesright_id` INT NOT NULL,
  `user_id` INT NULL,
  `category_id` INT NULL,
  PRIMARY KEY (`accesright_id`),
  UNIQUE INDEX `id` (`user_id` ASC),
  INDEX (),
  INDEX `catego_idx` (`category_id` ASC),
  CONSTRAINT `userid`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `catego`
    FOREIGN KEY (`category_id`)
    REFERENCES `mydb`.`category` (`category_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`annonce_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`annonce_user` (
  `annonce_user_id` INT NOT NULL,
  `annonce_user_writer` INT NULL,
  `annonce_user_title` VARCHAR(255) NULL,
  `annonce_user_content` VARCHAR(255) NULL,
  `annonce_user_address` VARCHAR(255) NULL,
  `annonce_user_image` VARCHAR(255) NULL,
  PRIMARY KEY (`annonce_user_id`),
  INDEX `userid_idx` (`annonce_user_writer` ASC),
  CONSTRAINT `userid`
    FOREIGN KEY (`annonce_user_writer`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`messagerie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`messagerie` (
  `messagerie_id` INT NOT NULL,
  `messagerie_from` INT NULL,
  `messagerie_to` INT NULL,
  `messagerie_titre` VARCHAR(255) NULL,
  `messagerie_contenue` TEXT NULL,
  `messagerie_timestamp` TIMESTAMP(255) NULL,
  PRIMARY KEY (`messagerie_id`),
  INDEX `from_idx` (`messagerie_from` ASC),
  INDEX `to_idx` (`messagerie_to` ASC),
  CONSTRAINT `from`
    FOREIGN KEY (`messagerie_from`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `to`
    FOREIGN KEY (`messagerie_to`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`service_name`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`service_name` (
  `service_name_id` INT NOT NULL,
  `service_name_text` VARCHAR(45) NULL,
  PRIMARY KEY (`service_name_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`service`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`service` (
  `service_id` INT NOT NULL,
  `service_type` INT NULL,
  `service_title` VARCHAR(255) NULL,
  `service_address` VARCHAR(255) NULL,
  `service_tph` VARCHAR(255) NULL,
  `service_description` VARCHAR(255) NULL,
  `service_photo` VARCHAR(255) NULL,
  `service_by` INT NULL,
  PRIMARY KEY (`service_id`),
  INDEX `serviceuser_idx` (`service_by` ASC),
  INDEX `service_name_idx` (`service_type` ASC),
  CONSTRAINT `serviceuser`
    FOREIGN KEY (`service_by`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `service_name`
    FOREIGN KEY (`service_type`)
    REFERENCES `mydb`.`service_name` (`service_name_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`post` (
  `post_id` INT NOT NULL,
  `post_questions` TEXT NULL,
  `post_answers` TEXT NULL,
  `post_iduserpost` INT NULL,
  `post_iduserresponse` INT NULL,
  `post_timestamp` INT NULL,
  PRIMARY KEY (`post_id`),
  INDEX `userpost_idx` (`post_iduserpost` ASC),
  INDEX `userreply_idx` (`post_iduserresponse` ASC),
  CONSTRAINT `userpost`
    FOREIGN KEY (`post_iduserpost`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `userreply`
    FOREIGN KEY (`post_iduserresponse`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`faq`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`faq` (
  `faq_id` INT NOT NULL,
  `faq_questions` TEXT NULL,
  `faq_answers` TEXT NULL,
  `faq_userpost` INT NULL,
  PRIMARY KEY (`faq_id`),
  INDEX `userpost_idx` (`faq_userpost` ASC),
  CONSTRAINT `userpost`
    FOREIGN KEY (`faq_userpost`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
