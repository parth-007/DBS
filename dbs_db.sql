-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 05, 2019 at 11:58 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbuilding`
--

INSERT INTO `tblbuilding` (`buildingid`, `buildingname`) VALUES
(1, 'CEP'),
(2, 'LT'),
(3, 'Lab'),
(4, 'OAT');

-- --------------------------------------------------------

--
-- Table structure for table `tblfacility`
--

DROP TABLE IF EXISTS `tblfacility`;
CREATE TABLE IF NOT EXISTS `tblfacility` (
  `facilityid` int(11) NOT NULL AUTO_INCREMENT,
  `ac` int(11) NOT NULL DEFAULT '0',
  `computers` int(11) NOT NULL DEFAULT '0',
  `podium` int(11) NOT NULL DEFAULT '0',
  `mike` int(11) NOT NULL DEFAULT '0',
  `projector` int(11) DEFAULT '0',
  PRIMARY KEY (`facilityid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfacility`
--

INSERT INTO `tblfacility` (`facilityid`, `ac`, `computers`, `podium`, `mike`, `projector`) VALUES
(1, 1, 0, 1, 1, 1),
(2, 0, 0, 1, 1, 1),
(3, 0, 0, 0, 1, 1),
(4, 0, 0, 0, 0, 0),
(5, 1, 1, 0, 0, 1),
(6, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblprogramme`
--

DROP TABLE IF EXISTS `tblprogramme`;
CREATE TABLE IF NOT EXISTS `tblprogramme` (
  `programmeid` int(11) NOT NULL AUTO_INCREMENT,
  `programmename` varchar(20) NOT NULL,
  PRIMARY KEY (`programmeid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblprogramme`
--

INSERT INTO `tblprogramme` (`programmeid`, `programmename`) VALUES
(1, 'BTECH'),
(2, 'MSCIT');

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
  `facilityid` int(11) NOT NULL,
  `isAllocate` int(11) NOT NULL,
  PRIMARY KEY (`resource_id`),
  KEY `con2` (`buildingid`),
  KEY `ckp44` (`facilityid`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblresource`
--

INSERT INTO `tblresource` (`resource_id`, `resourcename`, `capacity`, `buildingid`, `facilityid`, `isAllocate`) VALUES
(1, 'CEP 102', 190, 1, 1, 1),
(2, 'CEP 103', 110, 1, 3, 1),
(3, 'CEP 104', 48, 1, 3, 1),
(4, 'CEP 105', 48, 1, 3, 1),
(5, 'CEP 106', 120, 1, 3, 1),
(6, 'CEP 107', 30, 1, 3, 1),
(7, 'CEP 110', 182, 1, 2, 1),
(8, 'CEP 201', -1, 1, 4, 0),
(9, 'CEP 202', 80, 1, 3, 1),
(10, 'CEP 203', 80, 1, 3, 1),
(11, 'CEP 204', -1, 1, 4, 0),
(12, 'CEP 205', -1, 1, 4, 0),
(13, 'CEP 206', 40, 1, 3, 1),
(14, 'CEP 207', 120, 1, 3, 1),
(15, 'CEP 208', -1, 1, 4, 0),
(16, 'CEP 209', 120, 1, 3, 1),
(17, 'CEP 210', 30, 1, 3, 1),
(18, 'CEP 211', 30, 1, 3, 1),
(19, 'CEP 212', 30, 1, 3, 1),
(20, 'LT 1', 300, 2, 1, 1),
(21, 'LT 2', 300, 2, 1, 1),
(22, 'LT 3', 300, 2, 1, 1),
(23, 'OAT', 900, 4, 4, 1),
(24, 'Lab 001', 70, 3, 5, 1),
(25, 'Lab 002', 77, 3, 5, 1),
(26, 'Lab 005', 67, 5, 3, 1),
(27, 'Lab 007', 68, 5, 3, 1),
(28, 'Lab 008', 68, 5, 3, 1),
(29, 'Lab 011', 64, 5, 3, 1),
(30, 'Lab 101 - EL', 34, 5, 3, 1),
(31, 'Lab 102 - NT/EL', 55, 5, 3, 1),
(32, 'Lab 104 - EL', 34, 5, 3, 1),
(33, 'Lab 105', 0, 5, 6, 0),
(34, 'Lab 107 - EL', 34, 5, 3, 1),
(35, 'Lab 108 - DSP', 39, 5, 3, 1),
(36, 'Lab 110 - RF', 14, 5, 3, 1),
(37, 'Lab 201 - MTECH', 46, 5, 3, 1),
(38, 'Lab 203 - VLSI', 10, 5, 3, 1),
(39, 'Lab 204 - MTECH', 0, 5, 6, 0),
(40, 'Lab 205 - VLSI', 32, 5, 3, 1),
(41, 'Lab 206 - RL', 4, 5, 3, 1),
(42, 'Lab 207 - CS / HPC', 36, 5, 3, 1),
(43, 'Lab 208 - Research', 0, 5, 6, 0),
(44, 'Lab 209', 67, 5, 3, 1),
(45, 'Lab 211 - IOT', 0, 5, 6, 0),
(46, 'Lab 213 - RL', 7, 5, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbltimetable_child`
--

DROP TABLE IF EXISTS `tbltimetable_child`;
CREATE TABLE IF NOT EXISTS `tbltimetable_child` (
  `timetable_childid` int(11) NOT NULL AUTO_INCREMENT,
  `programmeid` int(11) NOT NULL,
  `dayofweek` varchar(10) NOT NULL,
  `timestart` time NOT NULL,
  `timeend` time NOT NULL,
  `resourceid` int(11) NOT NULL,
  `courseid` varchar(11) NOT NULL,
  PRIMARY KEY (`timetable_childid`),
  KEY `ttbl_COURSE` (`courseid`),
  KEY `con8` (`programmeid`),
  KEY `ckh4` (`resourceid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltimetable_child`
--

INSERT INTO `tbltimetable_child` (`timetable_childid`, `programmeid`, `dayofweek`, `timestart`, `timeend`, `resourceid`, `courseid`) VALUES
(1, 1, 'Monday', '09:00:00', '09:55:00', 2, 'CS302'),
(2, 1, 'Monday', '09:00:00', '09:55:00', 4, 'SC332'),
(3, 1, 'Monday', '09:00:00', '09:55:00', 5, 'EL321');

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltimetable_master`
--

INSERT INTO `tbltimetable_master` (`timetablemasterid`, `programmeid`, `semester`) VALUES
(1, 1, 2),
(2, 1, 4),
(3, 1, 6),
(4, 1, 8),
(5, 2, 2),
(6, 2, 4);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser_type`
--

INSERT INTO `tbluser_type` (`usertypeid`, `usertype`, `priority`) VALUES
(1, 'admin', -1),
(2, 'student', 3),
(3, 'faculty', 1),
(4, 'committee', 2),
(5, 'club', 2);

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
