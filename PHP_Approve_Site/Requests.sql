CREATE TABLE `Requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto-Increment id',
  `Courses` varchar(255) DEFAULT NULL COMMENT 'Course Name for wavier',
  `MajorConcentration` varchar(255) DEFAULT NULL COMMENT 'Concentration for waiver',
  `StudentId` varchar(255) DEFAULT NULL COMMENT '900 number of student',
  `StudentFirstName` varchar(255) DEFAULT NULL COMMENT 'Student first name. Who wavier is for',
  `StudentLastName` varchar(255) DEFAULT NULL COMMENT 'Student last name. Who wavier is for',
  `SubmittedById` int(11) DEFAULT NULL COMMENT 'Links the user id to request',
  `StatusId` int(11) DEFAULT NULL COMMENT 'Links the status id to change status',
  `ApprovedForCRN` varchar(255) DEFAULT NULL COMMENT 'provides the CRN for course approved',
  `Notes` varchar(255) DEFAULT NULL COMMENT 'notes for the reason for status',
  PRIMARY KEY (`id`),
  KEY `SubmittedById` (`SubmittedById`),
  KEY `StatusId` (`StatusId`),
  CONSTRAINT `Requests_status_id` FOREIGN KEY (`StatusId`) REFERENCES `Statuses` (`id`),
  CONSTRAINT `Requests_user_id` FOREIGN KEY (`SubmittedById`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COMMENT='Holds information about student and the request they want that links to Status and Users tables';
