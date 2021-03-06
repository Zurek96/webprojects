-- MySQL Script generated by MySQL Workbench
-- Sat May 26 23:46:39 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema pizzeria
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema pizzeria
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Pizzeria` DEFAULT CHARACTER SET utf8 ;
USE `Pizzeria` ;

-- -----------------------------------------------------
-- Table `pizzeria`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Pizzeria`.`users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `last_name` VARCHAR(45) NULL,
  `first_name` VARCHAR(45) NULL,
  `role` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `phone` INT NULL,
  `created_at` DATETIME NULL COMMENT '\n',
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pizzeria`.`addresses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Pizzeria`.`addresses` (
  `address_id` INT NOT NULL AUTO_INCREMENT,
  `city` VARCHAR(45) NULL,
  `zip_code` VARCHAR(45) NULL,
  `address` VARCHAR(45) NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`address_id`, `user_id`),
  CONSTRAINT `fk_addresses_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `Pizzeria`.`users` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pizzeria`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Pizzeria`.`orders` (
  `order_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `completed_at` DATETIME NULL,
  `order_status` VARCHAR(45) NULL,
  PRIMARY KEY (`order_id`, `user_id`),
  INDEX `fk_orders_customers1_idx` (`user_id` ASC),
  CONSTRAINT `fk_orders_customers1`
    FOREIGN KEY (`user_id`)
    REFERENCES `Pizzeria`.`users` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pizzeria`.`pizzas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Pizzeria`.`pizzas` (
  `pizza_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `price` DECIMAL(5,2) NULL,
  PRIMARY KEY (`pizza_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pizzeria`.`pizza_orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Pizzeria`.`pizza_orders` (
  `order_id` INT NOT NULL,
  `pizza_id` INT NOT NULL,
  `quantity` INT NULL,
  PRIMARY KEY (`order_id`, `pizza_id`),
  INDEX `fk_pizza_orders_orders1_idx` (`order_id` ASC),
  CONSTRAINT `fk_pizza_orders_pizzas1`
    FOREIGN KEY (`pizza_id`)
    REFERENCES `Pizzeria`.`pizzas` (`pizza_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pizza_orders_orders1`
    FOREIGN KEY (`order_id`)
    REFERENCES `Pizzeria`.`orders` (`order_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pizzeria`.`components`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Pizzeria`.`components` (
  `comp_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `price` DECIMAL(5,2) NULL,
  PRIMARY KEY (`comp_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pizzeria`.`drinks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Pizzeria`.`drinks` (
  `drink_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `price` DECIMAL(5,2) NULL,
  `capacity` DECIMAL(5,2) NULL,
  PRIMARY KEY (`drink_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pizzeria`.`drink_orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Pizzeria`.`drink_orders` (
  `order_id` INT NOT NULL,
  `drink_id` INT NOT NULL,
  `quantity` INT NULL,
  PRIMARY KEY (`order_id`, `drink_id`),
  INDEX `fk_drink_orders_drinks1_idx` (`drink_id` ASC),
  CONSTRAINT `fk_drink_orders_orders1`
    FOREIGN KEY (`order_id`)
    REFERENCES `Pizzeria`.`orders` (`order_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_drink_orders_drinks1`
    FOREIGN KEY (`drink_id`)
    REFERENCES `Pizzeria`.`drinks` (`drink_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pizzeria`.`pizza_components`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Pizzeria`.`pizza_components` (
  `pizza_id` INT NOT NULL,
  `comp_id` INT NOT NULL,
  PRIMARY KEY (`pizza_id`, `comp_id`),
  INDEX `fk_pizza_components_pizzas1_idx` (`pizza_id` ASC),
  CONSTRAINT `fk_table1_components1`
    FOREIGN KEY (`comp_id`)
    REFERENCES `Pizzeria`.`components` (`comp_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pizza_components_pizzas1`
    FOREIGN KEY (`pizza_id`)
    REFERENCES `Pizzeria`.`pizzas` (`pizza_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
