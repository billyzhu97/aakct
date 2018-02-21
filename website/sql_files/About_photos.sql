-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 30, 2017 at 10:01 PM
-- Server version: 5.6.34
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `info230_SP17_fp_aackt`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_photos`
--

CREATE TABLE `about_photos` (
  `about_id` int(11) NOT NULL,
  `photoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `about_photos`
--

INSERT INTO `about_photos` (`about_id`, `photoID`) VALUES
(1, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_photos`
--
ALTER TABLE `about_photos`
  ADD PRIMARY KEY (`about_id`),
  ADD KEY `photo_id` (`photoID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_photos`
--
ALTER TABLE `about_photos`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `about_photos`
--
ALTER TABLE `about_photos`
  ADD CONSTRAINT `about_photos_ibfk_1` FOREIGN KEY (`photoID`) REFERENCES `photos` (`photoID`) ON DELETE CASCADE ON UPDATE CASCADE;
