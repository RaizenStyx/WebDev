-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2015 at 08:02 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbpdo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `first_name`, `last_name`, `email_id`, `contact_no`) VALUES
(1, 'John', 'McMeen', 'johnmcmeen@gmail.com', 9659856325),
(2, 'Dominick', 'Bold', 'bold@yahoo.com', 6658665996),
(3, 'Elva', 'Birdwell', 'birdwell@gmail.com', 2356233987),
(4, 'Jenna', 'Leopold', 'leo@gmail.com', 7369542356),
(5, 'Shanta', 'Savory', 'shanta@hotmail.com', 9596563524),
(6, 'Cecilia', 'Calhoun', 'cece@gmail.com', 9485236325),
(7, 'Ardis', 'Kalis', 'ardy@gmail.com', 4562586578),
(8, 'Vickey', 'Buhr', 'vickey1980@mail.com', 9523699874),
(9, 'Al', 'Lerner', 'albertl@gmail.com', 9876543210),
(10, 'Loralee', 'Kober', 'koberz@yahoo.com', 2365478966),
(11, 'Judith', 'Stoneham', 'judgejudy@gmail.com', 3362256685),
(12, 'Denise', 'Raney', 'raneyd@aol.com', 4456699852);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


























