
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: localhost
-- Χρόνος δημιουργίας: 16 Νοε 2014 στις 11:23:21
-- Έκδοση διακομιστή: 5.1.61
-- Έκδοση PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση: `u992803791_offer`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `Makes`
--

CREATE TABLE IF NOT EXISTS `Makes` (
  `Name` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `ID_ProductOffers` int(11) NOT NULL,
  PRIMARY KEY (`Name`,`Password`,`ID_ProductOffers`),
  FULLTEXT KEY `Name` (`Name`),
  FULLTEXT KEY `Password` (`Password`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `ProductOffers`
--

CREATE TABLE IF NOT EXISTS `ProductOffers` (
  `ID_ProductOffers` int(11) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `Offer` int(11) NOT NULL,
  PRIMARY KEY (`ID_ProductOffers`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `Shops`
--

CREATE TABLE IF NOT EXISTS `Shops` (
  `Name` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `Street` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `X` float NOT NULL,
  `Y` float NOT NULL,
  PRIMARY KEY (`Name`,`Password`),
  FULLTEXT KEY `Name` (`Name`),
  FULLTEXT KEY `Password` (`Password`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
