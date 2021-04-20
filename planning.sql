CREATE TABLE IF NOT EXISTS `planning`(
    `id` int(11) NOT NULL,
    `game` varchar(255) NOT NULL,
    `time` TIME NOT NULL,
    `duration` TIME NOT NULL,
    `host` text NOT NULL,
    `players` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

