-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 09, 2019 at 05:23 PM
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
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`adminid`, `username`, `email`, `password`, `phone`) VALUES
(1, 'admin', 'admin_booking@daiict.ac.in', 'admin', '89611616');

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
  `purpose` varchar(300) NOT NULL,
  `expected_audience` int(11) NOT NULL,
  `status` enum('Booked','Requested','Cancelled','') NOT NULL,
  PRIMARY KEY (`bookingid`),
  KEY `con11` (`useremail`),
  KEY `con15` (`resourceid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`bookingid`, `starttime`, `endtime`, `useremail`, `resourceid`, `requesttime`, `purpose`, `expected_audience`, `status`) VALUES
(1, '2019-04-06 15:30:00', '2019-04-06 17:30:00', 'alviskaka@daiict.ac.in', 14, '2019-04-06 14:28:15', 'Drama Discussion', 10, 'Booked'),
(2, '2019-04-06 17:31:00', '2019-04-06 18:25:00', '201812108@daiict.ac.in', 14, '2019-04-06 14:28:15', 'Academic Discussion', 20, 'Booked');

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
-- Table structure for table `tblprogramme`
--

DROP TABLE IF EXISTS `tblprogramme`;
CREATE TABLE IF NOT EXISTS `tblprogramme` (
  `programmeid` int(11) NOT NULL AUTO_INCREMENT,
  `programmename` varchar(20) NOT NULL,
  PRIMARY KEY (`programmeid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

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
(46, 'Lab 213 - RL', 7, 3, 6, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltimetable_child`
--

INSERT INTO `tbltimetable_child` (`timetable_childid`, `masterid`, `dayofweek`, `timestart`, `timeend`, `resourceid`, `courseid`, `faculty_email`) VALUES
(1, 5, 'saturday', '14:36:00', '16:00:00', 12, 'SC332', 'club1@da.com'),
(2, 5, 'saturday', '19:55:00', '21:00:00', 19, 'IT515', 'alviskaka@daiict.ac.in'),
(3, 5, 'saturday', '08:00:00', '10:00:00', 14, 'SE206', 'asim_bhai@daiict.ac.in');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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
('201812014@daiict.ac.in', 'Parth', 3, '9090909090', 'PbRJxC2d', 1, 1),
('201812026@daiict.ac.in', 'Bansi', 3, '8989898989', 'Jxro7R9U', 0, 0),
('201812046@daiict.ac.in', 'Alvis', 2, '1234567890', '123', 1, 0),
('201812097@daiict.ac.in', 'Ishan Mehta', 2, '1234567890', 'ishan', 0, 1),
('201812108@daiict.ac.in', 'Vivek MVC', 2, '8758979310', 'nicepicture', 1, 1),
('alviskaka@daiict.ac.in', 'Alvis Patel', 2, '8545745230', 'alvispatel123', 1, 1),
('asim_bhai@daiict.ac.in', 'Asim Banerjee', 3, '7778889990', '74108520', 1, 1),
('club1@da.com', 'club1', 5, '5204106307', '745896', 1, 1),
('ishanmehta.im28@gmail.com', 'Ishan Mehta', 3, '8160819878', 'MxUgwyQd', 1, 1),
('parth7897@gmail.com', 'Parth Patel', 2, '6546546543', 'ssaassdd', 1, 1),
('surajshah2503@gmail.com', 'Suraj Shah', 2, '9876543210', '1234567890', 0, 1),
('vaidyavishal39@gmail.com', 'Vaidya Vishal', 2, '9879879876', 'vishal123', 0, 1),
('viru@gmail.com', 'Viru', 2, '7777775553', 'asdasdasd', 0, 1);

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(40) NOT NULL,
  `link` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `k9` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblverify_linkes`
--

INSERT INTO `tblverify_linkes` (`id`, `userid`, `link`) VALUES
(10, '201812097@daiict.ac.in', 'vBGxMVKOI4y09tuXCdLEYUfZp26q7NDSQwbAHiFj1olnJh5TsaRkem3c8rgW'),
(11, '201812046@daiict.ac.in', 'JUpfBDVPdNvTgbilS1Q05rn2ACROKYehxEkGq8s963aoZX7IwzHMcWLjumF4'),
(13, '201812026@daiict.ac.in', 'MvJGUOaYkdA1KtwRr5B0h8XPxVuoCf'),
(15, 'surajshah2503@gmail.com', 'nAluKct5RwpTGydQHCNhJ1ak2Zqb93EVLUMPDYSBgf47mix8Ie0s6rzojXWO'),
(16, 'vaidyavishal39@gmail.com', 'G6rI9HDesvPqtYZx7UBk5EKzo1LdRC0pFOAbNami3jTc8y2nQWwuJgS4fVlX'),
(17, 'viru@gmail.com', 'wGyT6mIveafxtNRjVOF8s5zMQ4uP1kUX9dhJE0b3AKHlWcZ7LpqCSYiBgorn');

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
-- Constraints for table `tblreport`
--
ALTER TABLE `tblreport`
  ADD CONSTRAINT `k3` FOREIGN KEY (`bookingid`) REFERENCES `tblbooking` (`bookingid`) ON DELETE CASCADE ON UPDATE CASCADE;

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
