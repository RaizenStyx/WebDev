CREATE TABLE `Roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto-Increment id',
  `Description` varchar(255) DEFAULT NULL COMMENT 'Name of roles',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Holds the names and descriptions for the roles ';
