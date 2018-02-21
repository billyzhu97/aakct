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
-- Table structure for table `Portfolios`
--

CREATE TABLE `Portfolios` (
  `portfolioID` int(11) NOT NULL,
  `portfolio_title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Portfolios`
--

INSERT INTO `Portfolios` (`portfolioID`, `portfolio_title`, `description`) VALUES
(12, 'Portraits', ''),
(13, 'Love & Friendship', ''),
(14, 'Family', ''),
(15, 'Engagement', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Portfolios`
--
ALTER TABLE `Portfolios`
  ADD PRIMARY KEY (`portfolioID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Portfolios`
--
ALTER TABLE `Portfolios`
  MODIFY `portfolioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;