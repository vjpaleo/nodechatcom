-- phpMyAdmin SQL Dump
-- version 3.3.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2014 at 08:38 AM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nodeChat`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(45) NOT NULL,
  `password` varchar(40) NOT NULL,
  `userDob` date NOT NULL,
  `createDatatime` datetime NOT NULL,
  PRIMARY KEY (`uId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_fullname` varchar(255) NOT NULL,
  `u_username` varchar(45) NOT NULL,
  `u_password` varchar(40) NOT NULL,
  `u_email` varchar(150) NOT NULL COMMENT 'Every user should have an unique user id.',
  `u_dob` date NOT NULL,
  `u_is_active` tinyint(1) NOT NULL,
  `u_create_datatime` datetime NOT NULL,
  `u_app_uid` varchar(30) NOT NULL COMMENT 'Application generated unique id.',
  `u_zipcode` int(6) unsigned NOT NULL,
  `u_country` varchar(50) NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_username` (`u_username`),
  UNIQUE KEY `u_app_id` (`u_app_uid`),
  UNIQUE KEY `u_email` (`u_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_fullname`, `u_username`, `u_password`, `u_email`, `u_dob`, `u_is_active`, `u_create_datatime`, `u_app_uid`, `u_zipcode`, `u_country`) VALUES
(1, 'Vijay Singh', '', 'dd6968585d99e86f0a4837846403bc5f', 'vjpaleo@gmail.com', '0000-00-00', 1, '0000-00-00 00:00:00', '1393859147127001', 11050, ''),
(3, 'Sasha Singh', 'singh.sasha00', 'dd6968585d99e86f0a4837846403bc5f', 'singh.sasha00@gmail.com', '2000-11-14', 1, '0000-00-00 00:00:00', '1393863025127001', 11050, ''),
(4, 'Akhand Singh', 'ak', '3ad792bc6907f41cc4bf3229f5e88a6b', 'ak@gmail.com', '1972-03-08', 1, '0000-00-00 00:00:00', '1394297786127001', 11050, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_log`
--

CREATE TABLE IF NOT EXISTS `user_activity_log` (
  `ual_id` int(11) NOT NULL AUTO_INCREMENT,
  `ual_action` varchar(50) NOT NULL,
  `ual_datetime` datetime NOT NULL,
  PRIMARY KEY (`ual_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_activity_log`
--

