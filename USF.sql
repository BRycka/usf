-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2014 at 10:41 AM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `USF`
--

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE IF NOT EXISTS `Employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `Lastname` varchar(15) NOT NULL,
  `hourlyRate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hourlyRate` (`hourlyRate`),
  KEY `name` (`name`),
  KEY `Lastname` (`Lastname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`id`, `name`, `Lastname`, `hourlyRate`) VALUES
(1, 'Darbuotojas', 'Aaaaaa', 6),
(2, 'NaujasDarbuotoj', 'Eeeeee', 4),
(3, 'Darbuotoja', 'Dddddd', 5),
(4, 'NaujaDarbuotoja', 'Bbbbbb', 4),
(101, 'Operatorius', 'Cccccc', 6);

-- --------------------------------------------------------

--
-- Table structure for table `HoursWorked`
--

CREATE TABLE IF NOT EXISTS `HoursWorked` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeId` int(11) NOT NULL,
  `payPeriodId` int(11) NOT NULL,
  `hoursWorked` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employeeId` (`employeeId`,`payPeriodId`),
  KEY `payPeriodId` (`payPeriodId`),
  KEY `hoursWorked` (`hoursWorked`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `HoursWorked`
--

INSERT INTO `HoursWorked` (`id`, `employeeId`, `payPeriodId`, `hoursWorked`) VALUES
(3, 1, 1, 0),
(4, 2, 1, 0),
(5, 3, 2, 0),
(6, 4, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `PayPeriod`
--

CREATE TABLE IF NOT EXISTS `PayPeriod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fourWeeks` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `PayPeriod`
--

INSERT INTO `PayPeriod` (`id`, `fourWeeks`) VALUES
(1, '2014-12');

-- --------------------------------------------------------

--
-- Table structure for table `Position`
--

CREATE TABLE IF NOT EXISTS `Position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `weightingFactor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `weighting` (`weightingFactor`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Position`
--

INSERT INTO `Position` (`id`, `name`, `weightingFactor`) VALUES
(1, 'Operator', 5),
(2, 'Supervisor', 5),
(3, 'quality', 5),
(4, 'designer', 5);

-- --------------------------------------------------------

--
-- Table structure for table `Schedule`
--

CREATE TABLE IF NOT EXISTS `Schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeId` int(11) NOT NULL,
  `shiftId` int(11) NOT NULL,
  `week` varchar(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employeeId` (`employeeId`),
  KEY `shiftId` (`shiftId`),
  KEY `week` (`week`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Schedule`
--

INSERT INTO `Schedule` (`id`, `employeeId`, `shiftId`, `week`) VALUES
(1, 1, 1, '2014-13'),
(2, 2, 3, '2014-15'),
(3, 3, 4, '2014-14');

-- --------------------------------------------------------

--
-- Table structure for table `Shift`
--

CREATE TABLE IF NOT EXISTS `Shift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `positionId` int(11) NOT NULL,
  `employeeId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `positionId` (`positionId`,`employeeId`),
  KEY `employeeId` (`employeeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Shift`
--

INSERT INTO `Shift` (`id`, `positionId`, `employeeId`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 3, 4),
(4, 4, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `HoursWorked`
--
ALTER TABLE `HoursWorked`
  ADD CONSTRAINT `HoursWorked_ibfk_1` FOREIGN KEY (`employeeId`) REFERENCES `Employee` (`id`);

--
-- Constraints for table `PayPeriod`
--
ALTER TABLE `PayPeriod`
  ADD CONSTRAINT `PayPeriod_ibfk_1` FOREIGN KEY (`id`) REFERENCES `HoursWorked` (`payPeriodId`);

--
-- Constraints for table `Schedule`
--
ALTER TABLE `Schedule`
  ADD CONSTRAINT `Schedule_ibfk_1` FOREIGN KEY (`employeeId`) REFERENCES `Employee` (`id`),
  ADD CONSTRAINT `Schedule_ibfk_2` FOREIGN KEY (`shiftId`) REFERENCES `Shift` (`id`);

--
-- Constraints for table `Shift`
--
ALTER TABLE `Shift`
  ADD CONSTRAINT `Shift_ibfk_1` FOREIGN KEY (`employeeId`) REFERENCES `Employee` (`id`),
  ADD CONSTRAINT `Shift_ibfk_2` FOREIGN KEY (`positionId`) REFERENCES `Position` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
