CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto-Increment id',
  `FirstName` varchar(255) DEFAULT NULL COMMENT 'First Name of User',
  `LastName` varchar(255) DEFAULT NULL COMMENT 'Last Name of User',
  `UserName` varchar(255) DEFAULT NULL COMMENT 'Chosen UserName of person',
  `Password` varchar(255) DEFAULT NULL COMMENT 'Password for User',
  `Email` varchar(255) DEFAULT NULL COMMENT 'Email of User',
  `roleId` int(11) DEFAULT NULL COMMENT 'Linkes the users premissions',
  PRIMARY KEY (`id`),
  KEY `roleId` (`roleId`),
  CONSTRAINT `Users_roles_id` FOREIGN KEY (`roleId`) REFERENCES `Roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COMMENT='Holds information about all the users';
