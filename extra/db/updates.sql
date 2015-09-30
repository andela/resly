ALTER TABLE `resly`.`Restaurant`
ADD (`opening_time` TIME NOT NULL,
    `closing_time` TIME NOT NULL,
    `telephone` VARCHAR(20) NOT NULL,
    `email` VARCHAR(20) NOT NULL,
    `address` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT '2000-01-01 00:00:00',
    `updated_at` TIMESTAMP NOT NULL DEFAULT '2000-01-01 00:00:00'
);

-- -----------------------------------------------------
-- Table `resly`.`Menu_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `resly`.`Menu_item` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  `description` VARCHAR(200) NULL COMMENT '',
  `price` VARCHAR(45) NULL COMMENT '',
  `cat_id` INT NULL COMMENT '',
  `restaurant_id` INT NOT NULL COMMENT '',
  `created_at` TIMESTAMP NOT NULL DEFAULT '2000-01-01 00:00:00',
  `updated_at` TIMESTAMP NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)  COMMENT '',
  FOREIGN KEY (`restaurant_id`) REFERENCES Restaurant(`id`),
  FOREIGN KEY (`cat_id`) REFERENCES Category(`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `resly`.`Menu_item_tag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `resly`.`Menu_item_tag` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `menu_item_id` VARCHAR(45) NOT NULL COMMENT '',
  `tag_id` VARCHAR(45) NOT NULL COMMENT '',
  `created_at` TIMESTAMP NOT NULL DEFAULT '2000-01-01 00:00:00',
  `updated_at` TIMESTAMP NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)  COMMENT '',
  FOREIGN KEY (`menu_item_id`) REFERENCES Menu_item(`id`),
  FOREIGN KEY (`tag_id`) REFERENCES Tag(`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `resly`.`Tag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `resly`.`Tag` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT 'E.g vegetarian, chinese',
  `created_at` TIMESTAMP NOT NULL DEFAULT '2000-01-01 00:00:00',
  `updated_at` TIMESTAMP NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `name_UNIQUE` (`name` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `resly`.`Category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `resly`.`Category` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT 'e.g soups, breads, juices',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;