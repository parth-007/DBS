-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2019 at 02:20 PM
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
-- Table structure for table `tbladmin`
--

DROP TABLE IF EXISTS `tbladmin`;
CREATE TABLE IF NOT EXISTS `tbladmin` (
  `adminid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `link` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`adminid`, `username`, `email`, `password`, `phone`, `link`) VALUES
(1, 'admin', 'admin_booking@daiict.ac.in', 'admin', '89611616', 'ItSBOdbJm3zy2EcWVYRe8v57aNiCnPQh16gHMjDKLATp0lZ9UGsofrxq4Fku');

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
  `requesttime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `purpose` varchar(300) NOT NULL,
  `expected_audience` int(11) NOT NULL,
  `status` enum('Booked','Requested','Cancelled','Denied') NOT NULL,
  PRIMARY KEY (`bookingid`),
  KEY `con11` (`useremail`),
  KEY `con15` (`resourceid`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`bookingid`, `starttime`, `endtime`, `useremail`, `resourceid`, `requesttime`, `purpose`, `expected_audience`, `status`) VALUES
(10, '2019-04-16 21:30:00', '2019-04-17 00:30:00', '201812108@daiict.ac.in', 1, '2019-04-12 07:19:21', 'Jokes', 150, 'Cancelled'),
(12, '2019-04-14 18:30:00', '2019-04-15 17:30:00', '201812108@daiict.ac.in', 20, '2019-04-13 14:28:07', 'Orientation', 290, 'Booked'),
(25, '2019-04-20 14:30:00', '2019-04-20 16:30:00', '201812108@daiict.ac.in', 26, '2019-04-14 19:06:05', 'Nodejs Seminar', 60, 'Cancelled'),
(26, '2019-04-20 15:30:00', '2019-04-20 17:30:00', 'mithil_panchal@daiict.ac.in', 26, '2019-04-14 19:08:21', 'Placement Preparation', 40, 'Booked'),
(27, '2019-04-16 03:30:00', '2019-04-16 05:30:00', '201812108@daiict.ac.in', 2, '2019-04-15 07:36:05', 'Mail Testing', 100, 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `tblbuilding`
--

DROP TABLE IF EXISTS `tblbuilding`;
CREATE TABLE IF NOT EXISTS `tblbuilding` (
  `buildingid` int(11) NOT NULL AUTO_INCREMENT,
  `buildingname` varchar(10) NOT NULL,
  PRIMARY KEY (`buildingid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
  `mic` int(11) NOT NULL DEFAULT '0',
  `projector` int(11) DEFAULT '0',
  PRIMARY KEY (`facilityid`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfacility`
--

INSERT INTO `tblfacility` (`facilityid`, `ac`, `computers`, `podium`, `mic`, `projector`) VALUES
(1, 1, 0, 1, 1, 1),
(2, 0, 0, 1, 1, 1),
(3, 0, 0, 0, 1, 1),
(4, 0, 0, 0, 0, 0),
(5, 1, 1, 0, 0, 1),
(6, 1, 0, 0, 0, 0),
(7, 0, 0, 0, 0, 1),
(8, 0, 0, 0, 1, 0),
(9, 0, 0, 1, 0, 0),
(10, 0, 0, 1, 0, 1),
(11, 0, 0, 1, 1, 0),
(12, 0, 1, 0, 0, 0),
(13, 0, 1, 0, 0, 1),
(14, 0, 1, 0, 1, 0),
(15, 0, 1, 0, 1, 1),
(16, 0, 1, 1, 0, 0),
(17, 0, 1, 1, 0, 1),
(18, 0, 1, 1, 1, 0),
(19, 0, 1, 1, 1, 1),
(20, 1, 0, 0, 0, 1),
(21, 1, 0, 0, 1, 0),
(22, 1, 0, 0, 1, 1),
(23, 1, 0, 1, 0, 0),
(24, 1, 0, 1, 0, 1),
(25, 1, 0, 1, 1, 0),
(26, 1, 1, 0, 0, 0),
(27, 1, 1, 0, 1, 0),
(28, 1, 1, 0, 1, 1),
(29, 1, 1, 1, 0, 0),
(30, 1, 1, 1, 0, 1),
(31, 1, 1, 1, 1, 0),
(32, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblinquiry`
--

DROP TABLE IF EXISTS `tblinquiry`;
CREATE TABLE IF NOT EXISTS `tblinquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `replay` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblprogramme`
--

DROP TABLE IF EXISTS `tblprogramme`;
CREATE TABLE IF NOT EXISTS `tblprogramme` (
  `programmeid` int(11) NOT NULL AUTO_INCREMENT,
  `programmename` varchar(20) NOT NULL,
  PRIMARY KEY (`programmeid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblprogramme`
--

INSERT INTO `tblprogramme` (`programmeid`, `programmename`) VALUES
(1, 'BTECH'),
(2, 'MSCIT'),
(3, 'MTECH');

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
  KEY `k4` (`facilityid`),
  KEY `k30` (`buildingid`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

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
(26, 'Lab 005', 67, 3, 5, 1),
(27, 'Lab 007', 68, 3, 5, 1),
(28, 'Lab 008', 68, 3, 5, 1),
(29, 'Lab 011', 64, 3, 5, 1),
(30, 'Lab 101 - EL', 34, 3, 5, 1),
(31, 'Lab 102 - NT/EL', 55, 3, 5, 1),
(32, 'Lab 104 - EL', 34, 3, 5, 1),
(33, 'Lab 105', 0, 3, 6, 0),
(34, 'Lab 107 - EL', 34, 3, 5, 1),
(35, 'Lab 108 - DSP', 39, 3, 5, 1),
(36, 'Lab 110 - RF', 14, 3, 5, 1),
(37, 'Lab 201 - MTECH', 46, 3, 5, 1),
(38, 'Lab 203 - VLSI', 10, 3, 5, 1),
(39, 'Lab 204 - MTECH', 0, 3, 6, 0),
(40, 'Lab 205 - VLSI', 32, 3, 5, 1),
(41, 'Lab 206 - RL', 4, 3, 5, 1),
(42, 'Lab 207 - CS / HPC', 36, 3, 5, 1),
(43, 'Lab 208 - Research', 0, 3, 6, 0),
(44, 'Lab 209', 67, 3, 5, 1),
(45, 'Lab 211 - IOT', 0, 3, 6, 0),
(46, 'Lab 213 - RL', 7, 3, 6, 0),
(47, 'Lab 004', 67, 3, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbltimetable_child`
--

DROP TABLE IF EXISTS `tbltimetable_child`;
CREATE TABLE IF NOT EXISTS `tbltimetable_child` (
  `timetable_childid` int(11) NOT NULL AUTO_INCREMENT,
  `masterid` int(11) NOT NULL,
  `dayofweek` varchar(10) NOT NULL,
  `timestart` time NOT NULL,
  `timeend` time NOT NULL,
  `resourceid` int(11) NOT NULL,
  `courseid` varchar(11) NOT NULL,
  `faculty_email` varchar(100) NOT NULL,
  PRIMARY KEY (`timetable_childid`),
  KEY `con8` (`masterid`) USING BTREE,
  KEY `k79` (`resourceid`),
  KEY `k45` (`faculty_email`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltimetable_child`
--

INSERT INTO `tbltimetable_child` (`timetable_childid`, `masterid`, `dayofweek`, `timestart`, `timeend`, `resourceid`, `courseid`, `faculty_email`) VALUES
(7, 5, 'monday', '09:00:00', '09:55:00', 14, 'IT632', 'lavneet_singh@daiict.ac.in'),
(8, 5, 'monday', '11:00:00', '11:55:00', 14, 'IT602', 'lavneet_singh@daiict.ac.in'),
(9, 5, 'monday', '12:00:00', '12:55:00', 14, 'IT632', 'asim_banerjee_1@daiict.ac.in'),
(10, 5, 'monday', '14:00:00', '16:00:00', 26, 'IT602', 'lavneet_singh@daiict.ac.in'),
(11, 5, 'tuesday', '09:00:00', '09:55:00', 14, 'IT628', 'amit_mankodi@daiict.ac.in'),
(12, 5, 'tuesday', '10:00:00', '10:55:00', 14, 'IT694', 'pskalyan@daiict.ac.in'),
(13, 5, 'tuesday', '11:00:00', '11:55:00', 14, 'IT632', 'asim_banerjee_1@daiict.ac.in'),
(14, 5, 'tuesday', '14:00:00', '16:00:00', 26, 'IT632', 'asim_banerjee_1@daiict.ac.in'),
(15, 5, 'wednesday', '09:00:00', '09:55:00', 14, 'IT629', 'lavneet_singh@daiict.ac.in'),
(16, 5, 'wednesday', '10:00:00', '10:55:00', 14, 'IT694', 'pskalyan@daiict.ac.in'),
(17, 5, 'wednesday', '11:00:00', '11:55:00', 14, 'IT602', 'lavneet_singh@daiict.ac.in'),
(18, 5, 'wednesday', '12:00:00', '12:55:00', 14, 'IT628', 'amit_mankodi@daiict.ac.in'),
(19, 5, 'wednesday', '14:00:00', '16:00:00', 26, 'IT694', 'pskalyan@daiict.ac.in'),
(20, 5, 'thursday', '10:00:00', '10:55:00', 14, 'IT629', 'lavneet_singh@daiict.ac.in'),
(21, 5, 'thursday', '12:00:00', '12:55:00', 14, 'IT602', 'lavneet_singh@daiict.ac.in'),
(22, 5, 'thursday', '14:00:00', '16:00:00', 26, 'IT628', 'amit_mankodi@daiict.ac.in'),
(23, 5, 'friday', '09:00:00', '09:55:00', 14, 'IT632', 'asim_banerjee_1@daiict.ac.in'),
(24, 5, 'friday', '11:00:00', '11:55:00', 14, 'IT694', 'pskalyan@daiict.ac.in'),
(25, 5, 'friday', '12:00:00', '12:55:00', 14, 'IT628', 'amit_mankodi@daiict.ac.in'),
(26, 5, 'friday', '14:00:00', '16:00:00', 26, 'IT629', 'lavneet_singh@daiict.ac.in');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltimetable_master`
--

INSERT INTO `tbltimetable_master` (`timetablemasterid`, `programmeid`, `semester`) VALUES
(1, 1, 2),
(2, 1, 4),
(3, 1, 6),
(5, 2, 2),
(7, 1, 1),
(8, 1, 3),
(9, 1, 5),
(10, 1, 7),
(11, 2, 1),
(12, 2, 3),
(13, 3, 1),
(14, 3, 2),
(15, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE IF NOT EXISTS `tbluser` (
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `usertypeid` int(11) NOT NULL,
  `phonenumber` varchar(14) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_verified` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`email`),
  KEY `con3` (`usertypeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`email`, `username`, `usertypeid`, `phonenumber`, `password`, `is_verified`, `is_active`) VALUES
('201812108@daiict.ac.in', 'Vivek MVC', 2, '8758979310', '676767##', 1, 1),
('alviskaka@daiict.ac.in', 'Alvis Patel', 2, '8545745230', 'alvispatel123', 1, 1),
('amit_mankodi@daiict.ac.in', 'Amit Mankodi', 3, '7891110003', 'spspspsp', 1, 1),
('asim_banerjee_1@daiict.ac.in', 'Prof. Asim Banerjee', 3, '8238120001', 'software123', 1, 1),
('club1@da.com', 'club1', 5, '5204106307', '745896', 1, 1),
('jayvirrathi@gmail.com', 'jayvir', 2, '8908908900', '89898989', 1, 1),
('lavneet_singh@daiict.ac.in', 'Lavneet Singh', 3, '9032902391', 'indiaismine', 1, 1),
('mithil_panchal@daiict.ac.in', 'Mithil Panchal', 3, '7778889990', '74108520', 1, 1),
('music@daiict.ac.in', 'Raja', 5, '9023093211', 'vYDJfdU0', 1, 1),
('pskalyan@daiict.ac.in', 'PS Kalyan Singh', 3, '7890123411', 'pskalyan123@', 1, 1),
('vaidyavishal39@gmail.com', 'Vaidya Vishal', 2, '9879879876', 'vishal123', 0, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser_type`
--

INSERT INTO `tbluser_type` (`usertypeid`, `usertype`, `priority`) VALUES
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(40) NOT NULL,
  `link` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `k9` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblverify_linkes`
--

INSERT INTO `tblverify_linkes` (`id`, `userid`, `link`) VALUES
(16, 'vaidyavishal39@gmail.com', 'G6rI9HDesvPqtYZx7UBk5EKzo1LdRC0pFOAbNami3jTc8y2nQWwuJgS4fVlX'),
(29, '201812108@daiict.ac.in', 'eUObrExyBPsmlj6C3VNz2dfK7kGn5YgAHc0Z94q8IFLMihDSuXT1tRapJvWo'),
(33, '201812108@daiict.ac.in', 'jTAl4G8INd12qphW56gkXCfmJ3bLwacnO9sitzHuFYSe7ZKBVxDEy0QMvoPR');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD CONSTRAINT `k1` FOREIGN KEY (`resourceid`) REFERENCES `tblresource` (`resource_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `k2` FOREIGN KEY (`useremail`) REFERENCES `tbluser` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblresource`
--
ALTER TABLE `tblresource`
  ADD CONSTRAINT `k30` FOREIGN KEY (`buildingid`) REFERENCES `tblbuilding` (`buildingid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `k4` FOREIGN KEY (`facilityid`) REFERENCES `tblfacility` (`facilityid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbltimetable_child`
--
ALTER TABLE `tbltimetable_child`
  ADD CONSTRAINT `k45` FOREIGN KEY (`faculty_email`) REFERENCES `tbluser` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `k78` FOREIGN KEY (`masterid`) REFERENCES `tbltimetable_master` (`timetablemasterid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `k79` FOREIGN KEY (`resourceid`) REFERENCES `tblresource` (`resource_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbltimetable_master`
--
ALTER TABLE `tbltimetable_master`
  ADD CONSTRAINT `k12` FOREIGN KEY (`programmeid`) REFERENCES `tblprogramme` (`programmeid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD CONSTRAINT `k11` FOREIGN KEY (`usertypeid`) REFERENCES `tbluser_type` (`usertypeid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblverify_linkes`
--
ALTER TABLE `tblverify_linkes`
  ADD CONSTRAINT `k9` FOREIGN KEY (`userid`) REFERENCES `tbluser` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
