-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2013 at 12:52 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `volcanostorage`
--
CREATE DATABASE IF NOT EXISTS `volcanostorage` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `volcanostorage`;

-- --------------------------------------------------------

--
-- Table structure for table `accountinfo`
--

CREATE TABLE IF NOT EXISTS `accountinfo` (
  `idaccountInfo` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` date NOT NULL,
  `monthlyPayment` decimal(6,2) NOT NULL,
  `lastPaymentDate` date NOT NULL,
  `nextPaymentDate` date NOT NULL,
  `userId` int(11) NOT NULL,
  `numberOfStorageUnits` int(11) DEFAULT NULL,
  `previousBalance` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idaccountInfo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `accountinfo`
--

INSERT INTO `accountinfo` (`idaccountInfo`, `startDate`, `monthlyPayment`, `lastPaymentDate`, `nextPaymentDate`, `userId`, `numberOfStorageUnits`, `previousBalance`) VALUES
(1, '2012-09-12', '90.00', '2013-12-13', '2014-01-13', 1, 2, '180.00'),
(2, '2011-10-16', '50.00', '2013-11-16', '2013-12-16', 2, 1, '0.00'),
(3, '2013-05-25', '50.00', '2013-11-25', '2013-12-25', 3, 1, '0.00'),
(4, '2012-06-13', '120.00', '2013-11-13', '2013-12-13', 4, 3, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`mid`, `userName`, `password`) VALUES
(1, 'test', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `storageunits`
--

CREATE TABLE IF NOT EXISTS `storageunits` (
  `unitNumber` int(11) NOT NULL,
  `custId` int(11) DEFAULT NULL,
  `unitCost` decimal(10,2) NOT NULL,
  `unitSize` varchar(30) NOT NULL,
  PRIMARY KEY (`unitNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storageunits`
--

INSERT INTO `storageunits` (`unitNumber`, `custId`, `unitCost`, `unitSize`) VALUES
(1, 1, '45.00', 'M'),
(2, 1, '45.00', 'M'),
(3, 2, '45.00', 'M'),
(4, 3, '45.00', 'M'),
(5, 4, '45.00', 'M'),
(6, 4, '45.00', 'M'),
(7, 4, '45.00', 'M'),
(8, NULL, '45.00', 'M'),
(9, 24, '45.00', 'M'),
(10, NULL, '45.00', 'M'),
(11, NULL, '45.00', 'M'),
(12, NULL, '45.00', 'M'),
(13, NULL, '45.00', 'M'),
(14, NULL, '45.00', 'M'),
(15, NULL, '45.00', 'M'),
(16, NULL, '65.00', 'L'),
(17, NULL, '65.00', 'L'),
(18, NULL, '65.00', 'L'),
(19, NULL, '65.00', 'L'),
(20, NULL, '65.00', 'L'),
(21, NULL, '65.00', 'L'),
(22, NULL, '65.00', 'L'),
(23, NULL, '65.00', 'L'),
(24, NULL, '65.00', 'L'),
(25, NULL, '65.00', 'L'),
(26, NULL, '65.00', 'L'),
(27, NULL, '95.00', 'XL'),
(28, NULL, '95.00', 'XL'),
(29, NULL, '95.00', 'XL'),
(30, NULL, '95.00', 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `transactionlist`
--

CREATE TABLE IF NOT EXISTS `transactionlist` (
  `uid` int(11) NOT NULL,
  `amountPaid` decimal(10,2) NOT NULL,
  `lastPayment` varchar(100) NOT NULL,
  `nextPayment` varchar(100) NOT NULL,
  `card` int(11) NOT NULL,
  `cardType` varchar(100) NOT NULL,
  `paidInFull` varchar(20) NOT NULL,
  `remainingBalance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactionlist`
--

INSERT INTO `transactionlist` (`uid`, `amountPaid`, `lastPayment`, `nextPayment`, `card`, `cardType`, `paidInFull`, `remainingBalance`) VALUES
(1, '90.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'yes', '0.00'),
(1, '45.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'partial', '45.00'),
(1, '45.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'partial', '45.00'),
(1, '45.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'partial', '45.00'),
(1, '45.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'partial', '45.00'),
(1, '45.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'partial', '45.00'),
(1, '45.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'partial', '45.00'),
(1, '45.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'partial', '45.00'),
(1, '45.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'partial', '45.00'),
(1, '45.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'partial', '45.00'),
(1, '45.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'partial', '45.00'),
(1, '45.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'partial', '45.00'),
(1, '45.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'partial', '45.00'),
(1, '45.00', '2013-12-08', '2014-01-08', 1234565, 'Master Card', 'partial', '45.00'),
(1, '90.00', '2013-12-13', '2014-01-13', 1234565, 'Master Card', 'partial', '90.00'),
(22, '90.00', '2013-12-13', '2014-01-13', 1234565, 'Master Card', 'yes', '0.00'),
(1, '90.00', '2013-12-13', '2014-01-13', 1234565, 'Master Card', 'partial', '180.00'),
(23, '90.00', '2013-12-13', '2014-01-13', 1234565, 'Master Card', 'yes', '0.00'),
(0, '90.00', '2013-12-13', '2014-01-13', 1234565, 'Master Card', 'yes', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `iduserInfo` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(1000) NOT NULL,
  `lastName` varchar(1000) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `state` varchar(1000) NOT NULL,
  `zip` varchar(1000) NOT NULL,
  `phoneNumber` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  PRIMARY KEY (`iduserInfo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`iduserInfo`, `firstName`, `lastName`, `address`, `city`, `state`, `zip`, `phoneNumber`, `email`) VALUES
(1, 'test', 'tester', '3110  fake st', 'albuquerque', 'NM', '87102', '2225559999', 'test@yahoo.com'),
(2, 'user', 'mcuser', '1234 J st', 'albuquerque', 'NM', '87102', '3333333333', 'cheee@gmail.com'),
(3, 'homer', 'camacho', '1234 M St', 'San Antonio', 'TX', '78227', '2106668888', 'videoninja210@gmail.com'),
(4, 'erica', 'camacho', '2313 X st', 'San Antonio', 'TX', '78227', '5557874646', 'erica@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `userName`, `password`) VALUES
(1, 'test', 'password'),
(2, 'user', 'cheese'),
(3, 'homer', 'ca209413'),
(4, 'erica', 'jiggers12'),
(33, 'max', 'password'),
(34, 'jack', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `iduserInfo` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(1000) NOT NULL,
  `lastName` varchar(1000) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `state` varchar(1000) NOT NULL,
  `zip` varchar(1000) NOT NULL,
  `phoneNumber` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  PRIMARY KEY (`iduserInfo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`iduserInfo`, `firstName`, `lastName`, `address`, `city`, `state`, `zip`, `phoneNumber`, `email`) VALUES
(1, 'test', 'tester', '3110  fake st', 'albuquerque', 'NM', '87102', '2225559999', 'test@yahoo.com'),
(2, 'user', 'mcuser', '1234 J st', 'albuquerque', 'NM', '87102', '3333333333', 'cheee@gmail.com'),
(3, 'homer', 'camacho', '1234 M St', 'San Antonio', 'TX', '78227', '2106668888', 'videoninja210@gmail.com'),
(4, 'erica', 'camacho', '2313 X st', 'San Antonio', 'TX', '78227', '5557874646', 'erica@gmail.com'),
(23, 'max', 'power', '1212 opop', 'San Antonio', 'TX', '78227', '2108525900', 'videoninja210@gmail.com'),
(24, 'jack', 'bean', '22333 mat', 'mix', 'NM', '87113', '5124878656', 'meh@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `userId` FOREIGN KEY (`iduserInfo`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
