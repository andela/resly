ALTER TABLE `resly`.`Restaurateur`
ADD (`opening_time` TIME NOT NULL,
    `closing_time` TIME NOT NULL,
    `telephone` VARCHAR NOT NULL,
    `address1` VARCHAR NOT NULL,
    `address2` VARCHAR NULL
    );