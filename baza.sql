-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2015 at 06:35 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `baza`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE IF NOT EXISTS `korisnici` (
  `korisnik` varchar(32) NOT NULL,
  `lozinka` varchar(16) NOT NULL,
  `tip` enum('gost','rukovodilac','admin') NOT NULL DEFAULT 'gost',
  PRIMARY KEY (`korisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`korisnik`, `lozinka`, `tip`) VALUES
('goran1', 'pass1234', 'admin'),
('gost1', 'pass1234', 'gost'),
('mitarm', 'pass1234', 'rukovodilac');

-- --------------------------------------------------------

--
-- Table structure for table `projekti`
--

CREATE TABLE IF NOT EXISTS `projekti` (
  `idbr` int(11) NOT NULL,
  `id_projekta` int(11) NOT NULL,
  `naziv` varchar(60) NOT NULL,
  `broj_sati` int(11) NOT NULL,
  PRIMARY KEY (`idbr`,`id_projekta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projekti`
--

INSERT INTO `projekti` (`idbr`, `id_projekta`, `naziv`, `broj_sati`) VALUES
(1001, 100, 'NETREL', 45),
(1001, 200, 'PRISVS', 90),
(1006, 100, 'NETREL', 160),
(1011, 200, 'PRISVS', 75);

-- --------------------------------------------------------

--
-- Table structure for table `zaposleni`
--

CREATE TABLE IF NOT EXISTS `zaposleni` (
  `idbr` int(11) NOT NULL,
  `ime_prezime` varchar(60) NOT NULL,
  `odeljenje` varchar(30) NOT NULL,
  `pozicija` enum('stažista','radnik','rukovodilac') NOT NULL DEFAULT 'stažista',
  `datum_zaposlenja` date DEFAULT NULL,
  `plata` double NOT NULL,
  PRIMARY KEY (`idbr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zaposleni`
--

INSERT INTO `zaposleni` (`idbr`, `ime_prezime`, `odeljenje`, `pozicija`, `datum_zaposlenja`, `plata`) VALUES
(1000, 'Milutin Mirković', 'tehnička podrška', 'rukovodilac', '2014-05-07', 40000),
(1001, 'Marko Marković', 'razvojni centar', 'radnik', '2001-03-13', 60000),
(1002, 'Marija Mitic', 'razvojni centar', 'stažista', NULL, 26000),
(1003, 'Petar Erić', 'računovodstvo', 'stažista', NULL, 15000),
(1004, 'Marina Mikić', 'tehnička podrška', 'stažista', NULL, 20000),
(1006, 'Mirko Mirić', 'razvojni centar', 'rukovodilac', '2000-06-11', 80000),
(1009, 'Mitar Mitrović', 'tehnička podrška', 'radnik', '2002-08-11', 40000),
(1011, 'Petar Ilić', 'tehnička podrška', 'rukovodilac', '2002-08-11', 55000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
