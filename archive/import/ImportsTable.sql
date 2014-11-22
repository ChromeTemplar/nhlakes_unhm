-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2014 at 11:29 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cis730`
--

-- --------------------------------------------------------

--
-- Table structure for table `imports`
--

CREATE TABLE IF NOT EXISTS `imports` (
  `RecordID` int(11) NOT NULL AUTO_INCREMENT,
  `TownName` varchar(50) NOT NULL,
  `Date` varchar(10) NOT NULL,
  `InspectionTotal` int(11) DEFAULT NULL,
  `NH` int(11) DEFAULT NULL,
  `MA` int(11) DEFAULT NULL,
  `ME` int(11) DEFAULT NULL,
  `VT` int(11) DEFAULT NULL,
  `CT` int(11) DEFAULT NULL,
  `RI` int(11) DEFAULT NULL,
  `NY` int(11) DEFAULT NULL,
  `Other` int(11) DEFAULT NULL,
  `BoatType_InOut` int(11) DEFAULT NULL,
  `BoatType_PWCJET` int(11) DEFAULT NULL,
  `BoatType_Sail` int(11) DEFAULT NULL,
  `BoatType_CanoeCayak` int(11) DEFAULT NULL,
  `BoatType_Other` int(11) DEFAULT NULL,
  `PreviousInteraction_Yes` int(11) DEFAULT NULL,
  `PreviousInteract_No` int(11) DEFAULT NULL,
  `Drained_Yes` int(11) DEFAULT NULL,
  `Drained_No` int(11) DEFAULT NULL,
  `Rinsed_Yes` int(11) DEFAULT NULL,
  `Rinsed_No` int(11) DEFAULT NULL,
  `DryFiveDays_Yes` int(11) DEFAULT NULL,
  `DryFiveDays_No` int(11) DEFAULT NULL,
  `AISLevel_Low` int(11) DEFAULT NULL,
  `AISLevel_Medium` int(11) DEFAULT NULL,
  `AISLevel_High` int(11) DEFAULT NULL,
  `SpeciesFound_Yes` int(11) DEFAULT NULL,
  `SpeciesFound_No` int(11) DEFAULT NULL,
  `DES_Yes` int(11) DEFAULT NULL,
  `DES_No` int(11) DEFAULT NULL,
  PRIMARY KEY (`RecordID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=639 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
