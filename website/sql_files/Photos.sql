-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 16, 2017 at 05:05 AM
-- Server version: 5.6.34
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `info230_SP17_fp_aackt`
--

-- --------------------------------------------------------

--
-- Table structure for table `Photos`
--

CREATE TABLE `Photos` (
  `photoID` int(11) NOT NULL,
  `photo_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Photos`
--

INSERT INTO `Photos` (`photoID`, `photo_name`, `file_path`, `date_created`) VALUES
(1, 'Bill', 'Bill.jpg', '2017-05-07 18:00:55'),
(2, 'Jenn', 'Jenn.jpg', '2017-05-07 18:00:55'),
(3, 'David', 'David.jpg', '2017-05-07 18:00:55'),
(4, 'Tom', 'Tom.jpg', '2017-05-07 18:00:55'),
(5, 'maddie', 'maddie.jpg', '2017-04-30 16:07:50'),
(6, 'Jenn and Matt', 'JennMatt.jpg', '2017-05-07 18:00:55'),
(7, 'Clara', 'Clara.jpg', '2017-05-07 18:00:55'),
(8, 'Sage', 'Sage.jpg', '2017-05-07 18:00:55'),
(9, 'Linda', 'Linda.jpg', '2017-05-07 18:00:55'),
(10, 'Jenna', 'Jenna.jpg', '2017-05-07 18:00:55'),
(39, 'L&F1', '12063516_347087432081599_585014292021971342_n.jpg', '2017-05-16 00:00:00'),
(40, 'L&F2', '12670345_347087385414937_2168031324534103379_n.jpg', '2017-05-16 00:00:00'),
(41, 'L&F3', '12718100_347087615414914_4794736406387523153_n.jpg', '2017-05-16 00:00:00'),
(42, 'L&F4', '12919685_347087532081589_363392992819789326_n.jpg', '2017-05-16 00:00:00'),
(43, 'L&F5', '12928296_347087508748258_4255810670726828908_n.jpg', '2017-05-16 00:00:00'),
(45, 'L&F6', '12931054_347087358748273_5739058708389154525_n.jpg', '2017-05-16 00:00:00'),
(46, 'L&F7', '12931269_347087455414930_2266800903514512219_n.jpg', '2017-05-16 00:00:00'),
(47, 'L&F8', '12932689_347087595414916_7578115298921821988_n.jpg', '2017-05-16 00:00:00'),
(48, 'L&F9', '13938334_3204352947693_8149593660367566883_n.jpg', '2017-05-16 00:00:00'),
(49, 'L&F10', 'IMG_0820.jpg', '2017-05-16 00:00:00'),
(50, 'L&F11', 'IMG_2676.JPG', '2017-05-16 00:00:00'),
(51, 'L&F12', 'IMG_7996.JPG', '2017-05-16 00:00:00'),
(52, 'L&F13', 'IMG_8352.jpg', '2017-05-16 00:00:00'),
(71, 'portrati1', '10391876_347085705415105_3110756090971370645_n.jpg', '2017-05-16 00:00:00'),
(72, 'portrait2', '12920329_347084932081849_6211460997750003247_n.jpg', '2017-05-16 00:00:00'),
(73, 'portrait3', '12932624_347084728748536_1106287334158643182_n.jpg', '2017-05-16 00:00:00'),
(74, 'portrait4', '12936529_347084828748526_7664994826156252224_n.jpg', '2017-05-16 00:00:00'),
(75, 'portrait5', '12938288_347084368748572_8938326362249159452_n.jpg', '2017-05-16 00:00:00'),
(76, 'potrait6', '13567313_367078840082458_7550501405793308049_n.jpg', '2017-05-16 00:00:00'),
(77, 'potrait7', '13938505_3204350107622_7197814411108158452_n.jpg', '2017-05-16 00:00:00'),
(78, 'portrait8', '14650052_404775772979431_7250957104125994878_n.jpg', '2017-05-16 00:00:00'),
(79, 'portrait9', 'DavidBW.jpg', '2017-05-16 00:00:00'),
(80, 'portrait10', 'IMG_0744.JPG', '2017-05-16 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Photos`
--
ALTER TABLE `Photos`
  ADD PRIMARY KEY (`photoID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Photos`
--
ALTER TABLE `Photos`
  MODIFY `photoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;