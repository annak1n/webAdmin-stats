-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2012 at 06:24 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `was_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `was_browsers`
--

CREATE TABLE IF NOT EXISTS `was_browsers` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT 'unknown',
  `family` varchar(50) NOT NULL DEFAULT 'unknown',
  `engine` varchar(25) NOT NULL DEFAULT 'unknown',
  `counter` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Browsers of your website visitors' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `was_languages`
--

CREATE TABLE IF NOT EXISTS `was_languages` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `language` varchar(25) NOT NULL DEFAULT 'unknown',
  `abbreviation` varchar(3) NOT NULL DEFAULT 'unk',
  `counter` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Languages of your website visitors' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `was_oss`
--

CREATE TABLE IF NOT EXISTS `was_oss` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT 'unknown',
  `family` varchar(50) NOT NULL DEFAULT 'unknown',
  `kernel` varchar(25) NOT NULL DEFAULT 'unknown',
  `counter` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Operating Systems of your website visitors' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `was_visits`
--

CREATE TABLE IF NOT EXISTS `was_visits` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `ip` varchar(25) NOT NULL DEFAULT '',
  `os` varchar(50) NOT NULL DEFAULT 'unknown',
  `browser` varchar(50) NOT NULL DEFAULT 'unknown',
  `language` varchar(25) NOT NULL DEFAULT 'unknown',
  `host` varchar(50) NOT NULL DEFAULT '',
  `port` int(1) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='User visits at your website' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
