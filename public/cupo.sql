-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 03:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cupo`
--
CREATE DATABASE IF NOT EXISTS `cupo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cupo`;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--
-- Creation: Jun 06, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`itemID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `items`:
--

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemID`, `name`) VALUES
(1, 'Item1'),
(2, 'Item2'),
(3, 'paine'),
(4, 'paine'),
(5, 'oua'),
(6, 'oua'),
(7, 'hey'),
(8, 'Heineken'),
(9, 'haplea'),
(10, 'Rice'),
(11, 'Chicken'),
(12, 'Eggplant'),
(13, 'mare'),
(14, 'haplea mare'),
(15, 'Fanta Lite'),
(16, 'Lays salt'),
(17, 'afine'),
(18, 'pufuleti'),
(19, 'asdasdasda'),
(20, 'agas'),
(21, 'estera'),
(22, 'sfdhsdf'),
(23, 'Nutella'),
(24, 'Unknown Product'),
(25, 'Danonino afine banane4×50г.'),
(26, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `listitems`
--
-- Creation: Jun 06, 2024 at 02:07 PM
-- Last update: Jun 21, 2024 at 01:53 PM
--

DROP TABLE IF EXISTS `listitems`;
CREATE TABLE IF NOT EXISTS `listitems` (
  `listItemID` int(11) NOT NULL AUTO_INCREMENT,
  `listID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `count` int(11) DEFAULT 1,
  `checked` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`listItemID`),
  KEY `listID` (`listID`),
  KEY `itemID` (`itemID`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `listitems`:
--   `listID`
--       `lists` -> `listID`
--   `itemID`
--       `items` -> `itemID`
--

--
-- Dumping data for table `listitems`
--

INSERT INTO `listitems` (`listItemID`, `listID`, `itemID`, `count`, `checked`) VALUES
(16, 13, 15, 4, 1),
(17, 13, 16, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--
-- Creation: Jun 20, 2024 at 12:30 PM
-- Last update: Jun 21, 2024 at 01:53 PM
--

DROP TABLE IF EXISTS `lists`;
CREATE TABLE IF NOT EXISTS `lists` (
  `listID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `listName` varchar(255) DEFAULT NULL,
  `finished` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`listID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `lists`:
--   `userID`
--       `users` -> `userID`
--

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`listID`, `userID`, `listName`, `finished`, `created_at`, `updated_at`) VALUES
(13, 3, 'Daily List', 1, '2024-06-20 13:43:35', '2024-06-20 13:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Jun 06, 2024 at 02:07 PM
-- Last update: Jun 21, 2024 at 01:53 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`) VALUES
(1, 'ticu', '$2y$10$DYLNucsiN0/wIxaL.sk51OBanLb5RIbQDtvYQH5/7L7IIpJ9Q2gaW', 'ticu@gmail.com'),
(2, 'Gabriel Martisca', '$2y$10$mlfuuVmA0PMBQDIavDaOt.z2joOYvkRBJAynst.6fFSZK1jrzc6Lq', 'gabrielmartisca111@gmail.com'),
(3, 'Andrei', '$2y$10$KIDU7bdCLwdDkftisdgyb.EtJcyBxypEpIK9Ue6QXrUIbR/P6x9y.', 'andreimoisa@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `listitems`
--
ALTER TABLE `listitems`
  ADD CONSTRAINT `listitems_ibfk_1` FOREIGN KEY (`listID`) REFERENCES `lists` (`listID`),
  ADD CONSTRAINT `listitems_ibfk_2` FOREIGN KEY (`itemID`) REFERENCES `items` (`itemID`);

--
-- Constraints for table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
