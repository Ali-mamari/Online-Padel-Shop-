-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2024 at 05:35 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gmodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` int NOT NULL,
  `password` int NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
(0, 123);

-- --------------------------------------------------------

--
-- Table structure for table `customertbl`
--

DROP TABLE IF EXISTS `customertbl`;
CREATE TABLE IF NOT EXISTS `customertbl` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(8) NOT NULL,
  `city` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customertbl`
--

INSERT INTO `customertbl` (`cid`, `name`, `email`, `phone`, `city`, `country`, `address`, `username`) VALUES
(25, '', '', '', '', '', '', 'ali'),
(26, 'salim', '', '', '', '', '', 'nour'),
(27, 'ali', 'adadwe9@hotmail.com', '0980709', 'muscat', 'Oman', 'cfafadfd', 'salim'),
(28, 'jaifar', '16j19243@gmail.com', '97974236', 'seeb', 'oman', 'hvkuyt', '16j19243'),
(29, 'ali', '16J2051@utas.edu.om', '0980709', 'muscat', 'Oman', 'cfafadfd', 'm3th'),
(30, 'ali', '16J2051@utas.edu.om', '0980709', 'muscat', 'india', 'cfafadfd', 'mm'),
(31, 'ali', '16J2051@utas.edu.om', '0980709', 'muscat', 'india', 'cfafadfd', 'mm1'),
(32, 'ruta', '16J2051@utas.edu.om', '0980709', 'muscat', 'india', 'cfafadfd', 'ruta123');

-- --------------------------------------------------------

--
-- Table structure for table `ordertbl`
--

DROP TABLE IF EXISTS `ordertbl`;
CREATE TABLE IF NOT EXISTS `ordertbl` (
  `oid` int NOT NULL AUTO_INCREMENT,
  `cid` int NOT NULL,
  `pid` int NOT NULL,
  `oprice` double(10,0) NOT NULL,
  `quantity` int NOT NULL,
  `totalbill` decimal(10,0) NOT NULL,
  `odate` date NOT NULL,
  `ccno` varchar(24) NOT NULL,
  `cvc` int NOT NULL,
  `expdate` date NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `producttbl`
--

DROP TABLE IF EXISTS `producttbl`;
CREATE TABLE IF NOT EXISTS `producttbl` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `pname` varchar(100) NOT NULL,
  `pprice` int NOT NULL,
  `pic` varchar(500) NOT NULL DEFAULT '0',
  `qty` int NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `producttbl`
--

INSERT INTO `producttbl` (`pid`, `pname`, `pprice`, `pic`, `qty`) VALUES
(17, 'padel racket 1', 20, 'pics/32d489dc202a9312270046736555c34b_675x.progressive.webp', 1111);

-- --------------------------------------------------------

--
-- Table structure for table `usertbl`
--

DROP TABLE IF EXISTS `usertbl`;
CREATE TABLE IF NOT EXISTS `usertbl` (
  `username` varchar(50) NOT NULL,
  `usertype` varchar(50) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usertbl`
--

INSERT INTO `usertbl` (`username`, `usertype`, `password`) VALUES
('16j19243', 'cust', '123'),
('m3th', 'cust', '123'),
('mm', 'cust', '11'),
('mm1', 'cust', '111'),
('nour', 'cust', '123'),
('ruta123', 'cust', '123'),
('salim', 'cust', '123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
