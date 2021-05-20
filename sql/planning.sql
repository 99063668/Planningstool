CREATE TABLE IF NOT EXISTS `plannings`(
    `id` int(11) NOT NULL,
    `game` int(11) NOT NULL,
    `time` TIME NOT NULL,
    `duration` TIME NOT NULL,
    `host` varchar(255) NOT NULL,
    `players` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

