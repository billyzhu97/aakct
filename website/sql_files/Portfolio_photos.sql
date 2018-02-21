-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 16, 2017 at 05:06 AM
-- Server version: 5.6.34
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `info230_SP17_fp_aackt`
--

-- --------------------------------------------------------

--
-- Table structure for table `Portfolio_photos`
--

CREATE TABLE `Portfolio_photos` (
  `photoID` int(11) NOT NULL,
  `portfolioID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Portfolio_photos`
--

INSERT INTO `Portfolio_photos` (`photoID`, `portfolioID`) VALUES
(1, 12),
(2, 12),
(4, 12),
(7, 12),
(9, 12),
(71, 12),
(72, 12),
(73, 12),
(74, 12),
(75, 12),
(76, 12),
(77, 12),
(78, 12),
(79, 12),
(80, 12),
(6, 13),
(39, 13),
(40, 13),
(41, 13),
(42, 13),
(43, 13),
(45, 13),
(46, 13),
(47, 13),
(48, 13),
(49, 13),
(50, 13),
(51, 13),
(52, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Portfolio_photos`
--
ALTER TABLE `Portfolio_photos`
  ADD PRIMARY KEY (`photoID`,`portfolioID`),
  ADD KEY `portfolios constraint` (`portfolioID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Portfolio_photos`
--
ALTER TABLE `Portfolio_photos`
  ADD CONSTRAINT `photos constraint` FOREIGN KEY (`photoID`) REFERENCES `Photos` (`photoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `portfolios constraint` FOREIGN KEY (`portfolioID`) REFERENCES `Portfolios` (`portfolioID`) ON DELETE CASCADE ON UPDATE CASCADE;
