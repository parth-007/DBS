-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 01, 2019 at 05:21 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

DROP TABLE IF EXISTS `tblbooking`;
CREATE TABLE IF NOT EXISTS `tblbooking` (
  `bookingid` int(11) NOT NULL AUTO_INCREMENT,
  `starttime` timestamp NOT NULL,
  `endtime` timestamp NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `resourceid` int(11) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `purpose` int(11) NOT NULL,
  `expected_audience` int(11) NOT NULL,
  `status` enum('Booked','Requested','Cancelled','') NOT NULL,
  PRIMARY KEY (`bookingid`),
  KEY `con11` (`useremail`),
  KEY `con15` (`resourceid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblbuilding`
--

DROP TABLE IF EXISTS `tblbuilding`;
CREATE TABLE IF NOT EXISTS `tblbuilding` (
  `buildingid` int(11) NOT NULL AUTO_INCREMENT,
  `buildingname` varchar(10) NOT NULL,
  PRIMARY KEY (`buildingid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblfacility`
--

DROP TABLE IF EXISTS `tblfacility`;
CREATE TABLE IF NOT EXISTS `tblfacility` (
  `facilityid` int(11) NOT NULL,
  `ac` bit(11) NOT NULL DEFAULT b'0',
  `computers` bit(11) NOT NULL DEFAULT b'0',
  `podium` bit(11) NOT NULL DEFAULT b'0',
  `mike` bit(11) NOT NULL DEFAULT b'0',
  `projector` bit(11) DEFAULT b'0',
  PRIMARY KEY (`facilityid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblprogramme`
--

DROP TABLE IF EXISTS `tblprogramme`;
CREATE TABLE IF NOT EXISTS `tblprogramme` (
  `programmeid` int(11) NOT NULL AUTO_INCREMENT,
  `programmename` varchar(20) NOT NULL,
  PRIMARY KEY (`programmeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblreport`
--

DROP TABLE IF EXISTS `tblreport`;
CREATE TABLE IF NOT EXISTS `tblreport` (
  `bookingid` int(11) NOT NULL,
  `report` varchar(4000) NOT NULL,
  `report_file` varchar(200) NOT NULL,
  PRIMARY KEY (`bookingid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblresource`
--

DROP TABLE IF EXISTS `tblresource`;
CREATE TABLE IF NOT EXISTS `tblresource` (
  `resource_id` int(11) NOT NULL AUTO_INCREMENT,
  `resourcename` varchar(20) NOT NULL,
  `capacity` int(11) NOT NULL,
  `buildingid` int(11) NOT NULL,
  PRIMARY KEY (`resource_id`),
  KEY `con2` (`buildingid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltimetable_child`
--

DROP TABLE IF EXISTS `tbltimetable_child`;
CREATE TABLE IF NOT EXISTS `tbltimetable_child` (
  `timetable_childid` int(11) NOT NULL AUTO_INCREMENT,
  `programmeid` int(11) NOT NULL,
  `dayofweek` varchar(10) NOT NULL,
  `timestart` timestamp NOT NULL,
  `timeend` timestamp NOT NULL,
  `buildingid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  PRIMARY KEY (`timetable_childid`),
  KEY `ttbl_build` (`buildingid`),
  KEY `ttbl_COURSE` (`courseid`),
  KEY `con8` (`programmeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltimetable_master`
--

DROP TABLE IF EXISTS `tbltimetable_master`;
CREATE TABLE IF NOT EXISTS `tbltimetable_master` (
  `timetablemasterid` int(11) NOT NULL AUTO_INCREMENT,
  `programmeid` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`timetablemasterid`),
  KEY `con11` (`programmeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE IF NOT EXISTS `tbluser` (
  `email` varchar(255) NOT NULL,
  `usertypeid` int(11) NOT NULL,
  `phonenumber` varchar(14) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_verified` int(11) NOT NULL,
  PRIMARY KEY (`email`),
  KEY `con3` (`usertypeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser_type`
--

DROP TABLE IF EXISTS `tbluser_type`;
CREATE TABLE IF NOT EXISTS `tbluser_type` (
  `usertypeid` int(11) NOT NULL AUTO_INCREMENT,
  `usertype` varchar(10) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`usertypeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblverify_linkes`
--

DROP TABLE IF EXISTS `tblverify_linkes`;
CREATE TABLE IF NOT EXISTS `tblverify_linkes` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(200) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
