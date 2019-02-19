-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 19, 2019 at 07:31 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatbot`
--

-- --------------------------------------------------------

--
-- Table structure for table `kysymykset`
--

DROP TABLE IF EXISTS `kysymykset`;
CREATE TABLE IF NOT EXISTS `kysymykset` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Kysymys` text NOT NULL,
  `vID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kysymykset`
--

INSERT INTO `kysymykset` (`ID`, `Kysymys`, `vID`) VALUES
(5, 'fkodkfo', 1),
(2, 'perkele', 15),
(3, 'mitÃ¤ ruokaa koulussa', 14),
(6, 'paljon kanan kilohinta', 14),
(7, 'kukkakaali', 5),
(8, 'kanan hinta', 1),
(9, 'kaalin hinta', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$R.OkFmxsOBTUgyjGC/Yj9uLREfD3lf6dRTfGfMiHsdwt8bTZKtAcG');

-- --------------------------------------------------------

--
-- Table structure for table `vastaukset`
--

DROP TABLE IF EXISTS `vastaukset`;
CREATE TABLE IF NOT EXISTS `vastaukset` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Vastaus` varchar(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vastaukset`
--

INSERT INTO `vastaukset` (`ID`, `Vastaus`) VALUES
(1, 'kogfk'),
(2, 'fffff'),
(3, 'kkkkk'),
(18, ''),
(6, 'fgfdgf'),
(7, 'gffgfgfg'),
(9, 'ertert');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
