-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: sql3.freesqldatabase.com
-- Generation Time: Jul 14, 2013 at 07:20 AM
-- Server version: 5.5.31-0ubuntu0.12.04.2
-- PHP Version: 5.3.26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sql313690`
--

-- --------------------------------------------------------

--
-- Table structure for table `akamai`
--

CREATE TABLE IF NOT EXISTS `akamai` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sessionid` varchar(20) NOT NULL,
  `resultcode` int(11) NOT NULL,
  `uri` longtext NOT NULL,
  `opt` longtext NOT NULL,
  `additional` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Request Monitoring table' AUTO_INCREMENT=1 ;
