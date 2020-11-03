DROP TABLE IF EXISTS `pandemics`;

CREATE TABLE `pandemics` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `species` VARCHAR(255) NOT NULL,
    `age` int(11) NOT NULL,
    `text` TEXT(255) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
