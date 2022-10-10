-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 05:29 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `seedlink`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `seed_id` int(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zip` int(6) NOT NULL,
  `cardname` varchar(50) NOT NULL,
  `cardnumber` bigint(16) NOT NULL,
  `expmonth` varchar(20) NOT NULL,
  `expyear` tinyint(4) NOT NULL,
  `cvv` tinyint(3) NOT NULL,
  `sameadr` tinyint(1) NOT NULL DEFAULT '0',
  `subtotal` decimal(10,2) NOT NULL,
  `gst` decimal(10,2) NOT NULL,
  `totalAmount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `name`, `email`, `address`, `city`, `state`, `zip`, `cardname`, `cardnumber`, `expmonth`, `expyear`, `cvv`, `sameadr`, `subtotal`, `gst`, `totalAmount`) VALUES
(4, 1, 'Aditya Bohade', 'aditya@gmail.com', 'sasdfsaSDZXFCGNVMB', 'Malegaon', 'ASDFGHJ', 123564, 'zsxdcfvgbhnjm', 1235689145564654, 'SDZFdbd', 127, 127, 1, '385.00', '19.25', '404.25'),
(5, 1, 'Aditya Bohade', 'aditya@gmail.com', 'sasdfsaSDZXFCGNVMB', 'Malegaon', 'ASDFGHJ', 123564, 'zsxdcfvgbhnjm', 123456789741, 'zwsxdcfvgbhnj', 127, 127, 1, '398.00', '19.90', '417.90'),
(6, 1, 'Aditya Bohade', 'aditya@gmail.com', 'sasdfsaSDZXFCGNVMB', 'Malegaon', 'ASDFGHJ', 123564, 'asdfghj', 12345678, 'zesxdrcfvgbhnj', 127, 127, 1, '199.00', '9.95', '208.95'),
(7, 1, 'Aditya Bohade', 'aditya@gmail.com', 'sasdfsaSDZXFCGNVMB', 'Malegaon', 'ASDFGHJ', 123564, 'fafafasf', 12345678910215, 'safaf', 0, 0, 1, '398.00', '19.90', '417.90'),
(8, 1, 'Aditya Bohade', 'aditya@gmail.com', 'sasdfsaSDZXFCGNVMB', 'Malegaon', 'ASDFGHJ', 123564, 'dfsafsdgsg', 1234567891573698, 'Sept', 127, 12, 1, '3158.00', '157.90', '3315.90'),
(9, 1, '', '', '', '', '', 0, '', 0, '', 0, 0, 1, '398.00', '19.90', '417.90'),
(11, 1, '', '', '', '', '', 0, '', 0, '', 0, 0, 1, '199.00', '9.95', '208.95'),
(12, 4, 'Om', 'om@gmail.com', 'HDFC Bank', 'Mumbai', 'MAHARASHTRA', 423100, 'Om Tulaskar', 6522478310891452, 'December', 127, 127, 1, '822.00', '41.10', '863.10'),
(13, 5, 'abcd', 'abcd@gmail.com', 'HDFC Bank, Dadar', 'Mumbai', 'MH', 423100, 'abcd', 25417896364785415, 'December', 127, 127, 1, '3243.00', '162.15', '3405.15'),
(14, 6, 'Aditya Bohade', 'aditya@gmail.com', 'sasdfsaSDZXFCGNVMB', 'Malegaon', 'ASDFGHJ', 123564, '363435', 0, '', 0, 0, 1, '796.00', '39.80', '835.80');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `seed_id` int(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `user_id`, `order_id`, `seed_id`, `price`, `quantity`) VALUES
(5, 1, 4, 2, '75.00', 3),
(6, 1, 4, 3, '80.00', 2),
(7, 1, 5, 1, '199.00', 2),
(8, 1, 6, 1, '199.00', 1),
(9, 1, 7, 1, '199.00', 2),
(10, 1, 8, 1, '199.00', 2),
(11, 1, 8, 2, '75.00', 2),
(12, 1, 8, 3, '80.00', 2),
(13, 1, 8, 4, '1000.00', 2),
(14, 1, 8, 5, '225.00', 2),
(15, 1, 9, 1, '199.00', 2),
(16, 3, 10, 1, '199.00', 3),
(17, 3, 10, 2, '75.00', 2),
(18, 1, 11, 1, '199.00', 1),
(19, 4, 12, 1, '199.00', 3),
(20, 4, 12, 2, '75.00', 3),
(21, 5, 13, 1, '199.00', 2),
(22, 5, 13, 2, '75.00', 1),
(23, 5, 13, 3, '80.00', 4),
(24, 5, 13, 4, '1000.00', 2),
(25, 5, 13, 5, '225.00', 2),
(26, 6, 14, 1, '199.00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `seeds`
--

CREATE TABLE IF NOT EXISTS `seeds` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `seeds`
--

INSERT INTO `seeds` (`id`, `name`, `image`, `price`, `location`) VALUES
(1, 'Natural Apple Seeds', 'apple.jpg', '199.00', 'Mumbai'),
(2, 'Natural Fenugreek Seeds', 'fenugreek.jpg', '75.00', 'Mumbai'),
(3, 'Natural Maize Seeds', 'maize.jpg', '80.00', 'Mumbai'),
(4, 'Natural Mustard Seeds', 'mustard.jpg', '1000.00', 'Mumbai'),
(5, 'Natural Sunflower Seeds', 'sunflower.jpg', '225.00', 'Mumbai');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`) VALUES
(1, 'Aditya Bohade', 1234567891, 'aditya@gmail.com', '123456'),
(2, 'prarthana', 1234567895, 'prarthana@gmail.com', 'prarthana'),
(4, 'Om', 7689651247, 'om@gmail.com', 'om123'),
(5, 'abcd', 9874561235, 'abcd@gmail.com', 'abcd123'),
(6, 'sdasf', 1234, 'afaf@gmail.com', 'abcd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
