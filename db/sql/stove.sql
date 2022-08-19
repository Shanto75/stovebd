-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 11, 2022 at 04:55 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cakezone`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `name` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `name`, `password`) VALUES
(1, 'shanto@gmail.com', 'shanto', '123');

-- --------------------------------------------------------

--
-- Table structure for table `confirmorders`
--

CREATE TABLE IF NOT EXISTS `confirmorders` (
  `orderId` int(11) NOT NULL,
  `userEmail` varchar(40) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `itemName` varchar(40) NOT NULL,
  `quantity` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `userAddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `confirmorders`
--

INSERT INTO `confirmorders` (`orderId`, `userEmail`, `userName`, `itemName`, `quantity`, `phone`, `userAddress`) VALUES
(1, 'shanto@gmail.com', 'shanto', 'chocolate cake', 5, 1756487912, 'dhaka'),
(2, 'rakib@gmail.com', 'Rakib', 'chocolate cake', 2, 19898945, 'tongi'),
(5, 'shanto@gmail.com', 'shanto', 'chocolate cake', 2, 1756487912, 'uttara dhaka'),
(9, 'pranto@gmail.com', 'pranto', 'chocolate cake', 3, 1756487912, 'uttara dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `about` longtext NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `menuPhoto` longblob NOT NULL,
  `logo` longblob NOT NULL,
  `aboutpic` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info`
--

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`itemId` int(11) NOT NULL,
  `itemName` varchar(40) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `photo` longblob NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
`id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'shanto', 'shanto@gmail.com', 'order cake', 'order cake'),
(4, 'pranto', 'pranto@gmail.com', 'cake', 'made cake for me'),
(5, 'Rakib', 'rakib@gmail.com', 'cake', 'cake');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
`orderId` int(11) NOT NULL,
  `userEmail` varchar(40) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `itemName` varchar(40) NOT NULL,
  `quantity` int(11) NOT NULL,
  `phone` decimal(15,0) NOT NULL,
  `userAddress` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderId`, `userEmail`, `userName`, `itemName`, `quantity`, `phone`, `userAddress`) VALUES
(6, 'pranto@gmail.com', 'pranto', 'chocolate cake', 2, '1756487912', 'uttara dhaka'),
(7, 'pranto@gmail.com', 'pranto', 'chocolate cake', 5, '1756487912', 'uttara dhaka'),
(8, 'pranto@gmail.com', 'rafid pranto', 'chocolate cake', 2, '1756487912', 'gazipur'),
(9, 'shanto@gmail.com', 'Rakib sharkar', 'chocolate cake', 3, '1612622555', 'Nikunjo-2'),
(10, 'rakib@gmail.com', 'Rakib', 'chocolate cake', 2, '1612622555', 'Nikunjo-2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`,`email`), ADD UNIQUE KEY `id` (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `confirmorders`
--
ALTER TABLE `confirmorders`
 ADD PRIMARY KEY (`orderId`), ADD UNIQUE KEY `orderId` (`orderId`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
 ADD PRIMARY KEY (`email`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`orderId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
