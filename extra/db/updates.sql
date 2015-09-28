ALTER TABLE `resly`.`Restaurant`
ADD (`opening_time` TIME NOT NULL,
    `closing_time` TIME NOT NULL,
    `telephone` VARCHAR(20) NOT NULL,
    `email` VARCHAR(20) NOT NULL,
    `address` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT '2000-01-01 00:00:00',
    `updated_at` TIMESTAMP NOT NULL DEFAULT '2000-01-01 00:00:00'
);
