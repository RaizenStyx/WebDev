CREATE TABLE `Statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto-Increment id',
  `Description` varchar(255) DEFAULT NULL COMMENT 'Name of statuses',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='Holds names for statuses';
