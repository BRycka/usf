-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2014 at 12:15 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `PayPeriod`
--

CREATE TABLE IF NOT EXISTS `PayPeriod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fourWeeks` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

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
