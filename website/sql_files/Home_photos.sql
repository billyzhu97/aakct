-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 08, 2017 at 12:05 AM
-- Server version: 5.6.34
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `info230_SP17_fp_aackt`
--

-- --------------------------------------------------------

--
-- Table structure for table `Home_photos`
--

CREATE TABLE `Home_photos` (
  `position` int(11) NOT NULL,
  `photoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Home_photos`
--

INSERT INTO `Home_photos` (`position`, `photoID`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(9, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Home_photos`
--
ALTER TABLE `Home_photos`
  ADD PRIMARY KEY (`position`);