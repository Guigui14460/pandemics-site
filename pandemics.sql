DROP TABLE IF EXISTS `pandemics`;

CREATE TABLE `pandemics` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `discoveryYear` int(11) NOT NULL,
    `description` TEXT NOT NULL,
    'creator' VARCHAR(255) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
