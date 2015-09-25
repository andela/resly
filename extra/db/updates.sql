ALTER TABLE `resly`.`Restaurateur`
ADD (`opening_time` TIME NOT NULL,
    `closing_time` TIME NOT NULL,
    `telephone` VARCHAR(20) NOT NULL,
    `email` VARCHAR(20) NOT NULL,
    `address1` VARCHAR(50) NOT NULL
);
