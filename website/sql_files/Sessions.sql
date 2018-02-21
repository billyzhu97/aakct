-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 16, 2017 at 03:49 PM
-- Server version: 5.6.34
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `info230_SP17_fp_aackt`
--

-- --------------------------------------------------------

--
-- Table structure for table `Sessions`
--

CREATE TABLE `Sessions` (
  `sessionID` int(11) NOT NULL,
  `session_title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Sessions`
--

INSERT INTO `Sessions` (`sessionID`, `session_title`, `description`, `price`, `date_created`) VALUES
(1, 'Individual Portrait or Headshot', 'You will get a 30-45-minute photo session with Maddie, with edited photos emailed to you within 1 week.', '$100', '2017-05-10 14:44:34'),
(2, 'Pairs or Small Groups ', 'You will get a 45-50-minute photo session with Maddie, with edited photos emailed to you within 1 week.', '$150', '2017-05-10 14:44:34'),
(3, 'Family Portrait', 'You will get a 60-minute photo session with Maddie, with edited photos emailed to you within 1 week.', '$200', '2017-05-10 14:44:34'),
(5, 'Engagement', 'You will get a photo session with Maddie in your choice of a few different locations and outfits, with edited photos emailed to you within 2 weeks.', '$300', '2017-05-16 00:22:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Sessions`
--
ALTER TABLE `Sessions`
  ADD PRIMARY KEY (`sessionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Sessions`
--
ALTER TABLE `Sessions`
  MODIFY `sessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;