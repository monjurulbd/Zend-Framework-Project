-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 18, 2011 at 12:05 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zend-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `employeeId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `certificate` varchar(12) NOT NULL,
  `employerName` varchar(200) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `birthDate` date NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `annualEarning` int(10) unsigned NOT NULL,
  `lifeInsuranceClass` enum('A','B','C') NOT NULL,
  `lifeInsuranceCoverage` int(10) unsigned NOT NULL,
  `lifeInsurancePremium` decimal(2,0) NOT NULL,
  `beneficiary` varchar(200) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `activeDate` date NOT NULL,
  PRIMARY KEY (`employeeId`),
  UNIQUE KEY `certificateNumber` (`certificate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `employees`
--

