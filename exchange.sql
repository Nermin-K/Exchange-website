-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2015 at 07:59 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `exchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE IF NOT EXISTS `accessories` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Date_time` datetime NOT NULL,
  `Price` float DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Description` text,
  `Availability` int(1) NOT NULL DEFAULT '1',
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`Id`, `Name`, `Date_time`, `Price`, `image`, `Description`, `Availability`, `User_id`) VALUES
(1, 'bracelet', '2015-12-05 14:11:57', 50, '', 'this is a hand made accessory', 1, 1),
(4, 'Necklace', '2015-12-05 19:34:03', 20, 'img/12065557_1203606899656066_3375854081680356136_n.jpg', 'gold necklace for sale', 1, 1),
(5, 'handmade necklace', '2015-12-25 03:28:55', 15, 'img/12436021_1695521320668023_1517206207_n.jpg', '', 1, 19),
(6, 'ring', '2015-12-25 03:43:52', 0, 'img/12435585_1695521010668054_882648205_n.jpg', '', 1, 2),
(7, 'bracelet', '2015-12-25 04:03:18', 0, 'img/12435612_1695520240668131_832629470_n.jpg', '', 1, 3),
(8, 'bracelet', '2015-12-25 04:03:53', 0, 'img/12431445_1695520250668130_1641282037_n.jpg', '', 1, 3),
(9, 'necklace', '2015-12-25 04:04:29', 40, 'img/12399120_1695521014001387_621368112_n.jpg', '', 1, 3),
(10, 'bracelet', '2015-12-25 04:04:51', 15, 'img/12388275_1695520414001447_1849033991_n.jpg', '', 1, 3),
(11, 'bracelet', '2015-12-25 04:20:19', 50, 'img/turquoise_coral_and_brass_handmade_bracelet_-_silk_road_888928da.jpg', '', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `accessories_wish`
--

CREATE TABLE IF NOT EXISTS `accessories_wish` (
  `Item_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Date_time` datetime NOT NULL,
  PRIMARY KEY (`Item_id`,`User_id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Date_time` datetime NOT NULL,
  `Price` float DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Description` text,
  `Category_name` varchar(50) NOT NULL,
  `Subcategory_name` varchar(50) NOT NULL,
  `Availability` int(1) NOT NULL DEFAULT '1',
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Subcategory_name` (`Subcategory_name`,`Category_name`),
  KEY `User_id` (`User_id`),
  KEY `fk_bookcat` (`Category_name`),
  FULLTEXT KEY `Subcategory_name_2` (`Subcategory_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`Id`, `Name`, `Date_time`, `Price`, `image`, `Description`, `Category_name`, `Subcategory_name`, `Availability`, `User_id`) VALUES
(1, 'Harry Potter', '2015-12-05 19:36:09', 0, 'img/harry-potter-hd-wallpapers-beautiful-desktop-background-pictures-widescreen.jpg', 'brand new series f harry potter books', 'Novels', 'Fictional', 1, 1),
(2, 'alice in the wonderland', '2015-12-25 03:13:38', 0, 'img/12432572_1695520427334779_1791619851_o.jpg', 'Description', 'Novels', 'fiction', 1, 19),
(3, 'Ø§Ù†Ø³ØªØ§ Ø­ÙŠØ§Ø©', '2015-12-25 03:39:37', 0, 'img/12421577_1695521300668025_1518972289_n.jpg', '', 'Novels', 'drama', 1, 2),
(4, 'pride and prejudice', '2015-12-25 03:45:40', 0, 'img/12431422_1695520394001449_1389294512_n.jpg', '', 'Novels', 'romance', 1, 2),
(5, 'Ø§Ù„Ù‡ÙˆÙ„', '2015-12-25 03:47:51', 0, 'img/12431530_1695520257334796_1467246479_n.jpg', '', 'Novels', 'horror', 1, 2),
(6, '2 Ø¸Ø¨Ø§Ø·', '2015-12-25 03:54:48', 0, 'img/12395136_1695520397334782_165201609_n.jpg', '', 'Novels', 'action', 1, 3),
(7, 'Ø§Ù„Ù„ÙŠÙ„Ø© Ø§Ù„Ø«Ø§Ù„Ø«Ø© Ùˆ Ø§Ù„Ø¹Ø´Ø±ÙˆÙ†', '2015-12-25 03:57:23', 0, 'img/12434490_1695521280668027_471663555_n.jpg', '', 'Novels', 'horror', 1, 3),
(8, 'red riding hood', '2015-12-25 04:16:58', 0, 'img/images (9).jpg', '', 'Novels', 'fiction', 1, 4),
(9, 'myBook', '2015-12-25 18:57:09', 0, 'img/items2.jpg', '', 'Comic Books', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE IF NOT EXISTS `book_category` (
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`Name`) VALUES
('Biographies'),
('Comic Books'),
('Educational'),
('History'),
('Novels'),
('Other'),
('Refernces');

-- --------------------------------------------------------

--
-- Table structure for table `book_wish`
--

CREATE TABLE IF NOT EXISTS `book_wish` (
  `Item_id` int(11) NOT NULL,
  `Date_time` datetime NOT NULL,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`Item_id`,`User_id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_wish`
--

INSERT INTO `book_wish` (`Item_id`, `Date_time`, `User_id`) VALUES
(2, '2015-12-25 15:29:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `Name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`Name`) VALUES
('Aerospace'),
('Architecture'),
('Chemistry'),
('Civil'),
('Communication'),
('Computer'),
('Mechanical'),
('Power');

-- --------------------------------------------------------

--
-- Table structure for table `electronic_components`
--

CREATE TABLE IF NOT EXISTS `electronic_components` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Date_time` datetime NOT NULL,
  `Price` float DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Description` text,
  `Availability` int(1) NOT NULL DEFAULT '1',
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `electronic_components`
--

INSERT INTO `electronic_components` (`Id`, `Name`, `Date_time`, `Price`, `image`, `Description`, `Availability`, `User_id`) VALUES
(1, 'Avo meter', '2015-12-05 15:26:17', 0, 'img/items2.jpg', 'used avo meter for lending', 1, 1),
(2, 'Resistor', '2015-12-05 15:28:04', 5, '', '320 ohm resistance', 1, 1),
(3, 'h-bridge', '2015-12-25 03:24:43', 0, 'img/12434456_1695521340668021_382008277_n.jpg', 'Description', 1, 19),
(4, 'lcd', '2015-12-25 03:41:14', 0, 'img/12399343_1695520390668116_1934709720_n.jpg', '', 1, 2),
(5, 'ldr', '2015-12-25 04:11:50', 0, 'img/ldr_large_large_404ef181-2db8-42e1-ac3d-1e370603240c_1024x1024.jpg', '', 1, 4),
(6, 'keypad', '2015-12-25 04:12:58', 0, 'img/images (8).jpg', '', 1, 4),
(7, 'pir', '2015-12-25 04:14:11', 0, 'img/download (7).jpg', '', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `electronic_components_wish`
--

CREATE TABLE IF NOT EXISTS `electronic_components_wish` (
  `Item_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Date_time` datetime NOT NULL,
  PRIMARY KEY (`Item_id`,`User_id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hardware_component`
--

CREATE TABLE IF NOT EXISTS `hardware_component` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `Date_time` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Description` text,
  `Price` float DEFAULT NULL,
  `User_id` int(11) NOT NULL,
  `Availability` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hardware_component`
--

INSERT INTO `hardware_component` (`Id`, `Name`, `Date_time`, `image`, `Description`, `Price`, `User_id`, `Availability`) VALUES
(1, 'RAM', '2015-12-05 15:43:55', '', '2 GB RAM', 100, 1, 1),
(2, 'hard', '2015-12-25 03:30:49', 'img/12436145_1695521017334720_1212140665_n.jpg', '500gb', 300, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hardware_component_wish`
--

CREATE TABLE IF NOT EXISTS `hardware_component_wish` (
  `Item_id` int(11) NOT NULL,
  `Date_time` datetime NOT NULL,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`Item_id`,`User_id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `musical_instruments`
--

CREATE TABLE IF NOT EXISTS `musical_instruments` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Date_time` datetime DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Description` text,
  `Availability` int(1) NOT NULL DEFAULT '1',
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `musical_instruments`
--

INSERT INTO `musical_instruments` (`Id`, `Name`, `Date_time`, `Price`, `image`, `Description`, `Availability`, `User_id`) VALUES
(1, 'Guitar', '2015-12-05 15:51:06', 200, '', 'Brand new acoustic guitar', 1, 1),
(2, 'piano', '2015-12-25 04:10:38', 0, 'img/images (7).jpg', '', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `musical_instruments_wish`
--

CREATE TABLE IF NOT EXISTS `musical_instruments_wish` (
  `Item_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Date_time` datetime NOT NULL,
  PRIMARY KEY (`Item_id`,`User_id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE IF NOT EXISTS `others` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Date_time` datetime NOT NULL,
  `Price` float DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Description` text,
  `Availability` int(1) NOT NULL DEFAULT '1',
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`Id`, `Name`, `Date_time`, `Price`, `image`, `Description`, `Availability`, `User_id`) VALUES
(1, 'Tshirt', '2015-12-05 16:01:34', 0, '', '50 t-shirts for charity', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `others_wish`
--

CREATE TABLE IF NOT EXISTS `others_wish` (
  `Item_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Date_time` datetime NOT NULL,
  PRIMARY KEY (`Item_id`,`User_id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sheet`
--

CREATE TABLE IF NOT EXISTS `sheet` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `Date_time` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Description` text,
  `User_id` int(11) NOT NULL,
  `Subject_name` varchar(50) DEFAULT NULL,
  `Subject_year` int(8) DEFAULT NULL,
  `Subject_semester` int(1) DEFAULT NULL,
  `Availability` int(1) NOT NULL DEFAULT '1',
  `Dept_name` varchar(50) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `User_id` (`User_id`),
  KEY `Dept_name` (`Dept_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sheet`
--

INSERT INTO `sheet` (`Id`, `Name`, `Date_time`, `image`, `Description`, `User_id`, `Subject_name`, `Subject_year`, `Subject_semester`, `Availability`, `Dept_name`, `Price`) VALUES
(1, 'maths sheet', '2015-12-25 03:26:28', 'img/items2.jpg', 'Description', 19, 'maths', 1, 1, 1, 'Communication', 0),
(2, 'electronics', '2015-12-25 03:48:46', 'img/items2.jpg', '', 2, 'electronics', 2, 1, 1, 'Computer', 0),
(3, 'power', '2015-12-25 03:49:54', 'img/items2.jpg', '', 2, 'power', 2, 1, 1, 'Power', 0),
(4, 'structure', '2015-12-25 03:58:22', 'img/items2.jpg', '', 3, 'Ø®Ø±Ø³Ø§Ù†Ø©', 4, 1, 1, 'Civil', 0),
(5, 'Ø®Ø±Ø³Ø§Ù†Ø©', '2015-12-25 04:00:39', 'img/items2.jpg', '', 3, 'Ø®Ø±Ø³Ø§Ù†Ø©', 3, 2, 1, 'Civil', 0),
(6, 'sheet1', '2015-12-25 19:44:33', 'img/sheet1.jpg', '', 21, 'Databases', 2, 1, 1, 'Computer', 0),
(7, 'sheet2', '2015-12-25 19:46:11', 'img/sheet2.PNG', '', 21, 'Databases', 2, 1, 1, 'Computer', 0),
(8, 'sheet3', '2015-12-25 19:48:26', 'img/sheet3.PNG', '', 21, 'Databases', 2, 1, 1, 'Computer', 0),
(9, 'sheet4', '2015-12-25 19:49:16', 'img/sheet4.PNG', '', 21, 'Databases', 2, 1, 1, 'Computer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sheet_wish`
--

CREATE TABLE IF NOT EXISTS `sheet_wish` (
  `Item_id` int(11) NOT NULL,
  `Date_time` datetime NOT NULL,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`Item_id`,`User_id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sheet_wish`
--

INSERT INTO `sheet_wish` (`Item_id`, `Date_time`, `User_id`) VALUES
(1, '2015-12-25 15:50:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sport_equipment`
--

CREATE TABLE IF NOT EXISTS `sport_equipment` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Date_time` datetime NOT NULL,
  `Price` float DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Description` text,
  `Availability` int(1) NOT NULL DEFAULT '1',
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sport_equipment`
--

INSERT INTO `sport_equipment` (`Id`, `Name`, `Date_time`, `Price`, `image`, `Description`, `Availability`, `User_id`) VALUES
(1, 'Tennis Shoes', '2015-12-05 16:07:35', 150, '', 'used Nike tennis shoes for sale', 1, 1),
(2, 'cycling helmet', '2015-12-25 03:32:08', 0, 'img/12434271_1695520387334783_1615262127_n.jpg', '', 1, 19),
(3, 'belt', '2015-12-25 03:36:15', 0, 'img/12404400_1695520247334797_1854996016_n.jpg', '', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sport_equipment_wish`
--

CREATE TABLE IF NOT EXISTS `sport_equipment_wish` (
  `Item_id` int(11) NOT NULL,
  `Date_time` datetime NOT NULL,
  `User_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Item_id`,`User_id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `Date_time` datetime NOT NULL,
  `Price` float DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Description` text,
  `Category_name` varchar(50) DEFAULT NULL,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Category_name` (`Category_name`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`Id`, `Name`, `Date_time`, `Price`, `image`, `Description`, `Category_name`, `User_id`) VALUES
(1, 'mohamed monir concert', '2015-12-25 04:18:11', 200, 'img/items2.jpg', '', 'Concert', 4),
(2, 'mission impossible cinema ticket', '2015-12-25 04:19:09', 20, 'img/items2.jpg', '', 'Cinema', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_category`
--

CREATE TABLE IF NOT EXISTS `ticket_category` (
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_category`
--

INSERT INTO `ticket_category` (`Name`) VALUES
('Cinema'),
('Concert'),
('Event'),
('Match'),
('Other');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_wish`
--

CREATE TABLE IF NOT EXISTS `ticket_wish` (
  `Item_id` int(11) NOT NULL,
  `Date_time` varchar(50) NOT NULL,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`Item_id`,`User_id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tool`
--

CREATE TABLE IF NOT EXISTS `tool` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Date_time` datetime NOT NULL,
  `Category_name` varchar(50) NOT NULL,
  `Price` float DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Description` text,
  `User_id` int(11) NOT NULL,
  `Availability` int(1) NOT NULL DEFAULT '1',
  `Name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Category_name` (`Category_name`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tool`
--

INSERT INTO `tool` (`Id`, `Date_time`, `Category_name`, `Price`, `image`, `Description`, `User_id`, `Availability`, `Name`) VALUES
(1, '2015-12-25 03:27:30', 'Home-repair', 0, 'img/12404459_1695520410668114_1547501952_n.jpg', '', 19, 1, 'hammer');

-- --------------------------------------------------------

--
-- Table structure for table `tool_category`
--

CREATE TABLE IF NOT EXISTS `tool_category` (
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tool_category`
--

INSERT INTO `tool_category` (`Name`) VALUES
('Car-repair'),
('Drwaing tools'),
('Home-appliances'),
('Home-repair'),
('Other');

-- --------------------------------------------------------

--
-- Table structure for table `tool_wish`
--

CREATE TABLE IF NOT EXISTS `tool_wish` (
  `Item_id` int(11) NOT NULL,
  `Date_time` datetime NOT NULL,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`Item_id`,`User_id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `F_name` varchar(50) NOT NULL,
  `L_name` varchar(50) DEFAULT NULL,
  `Picture` varchar(255) DEFAULT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `FB_account` varchar(100) DEFAULT NULL,
  `Phone_no` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `F_name`, `L_name`, `Picture`, `Password`, `Email`, `FB_account`, `Phone_no`) VALUES
(1, 'mayar', 'hefny', NULL, '12345', 'mayarrf95@gmail.com', 'facebook.com/mayarrf', '1002869439'),
(2, 'yomna', 'ismail', 'img/12434844_1695521104001378_925405283_o.jpg', 'yomna', 'yomnaismail58@yahoo.com', 'www.facebook.com/yomna', '1007142991'),
(3, 'aya', 'ismail', 'img/10449661_1695525800667575_518012607_n (1).jpg', 'hhhf', 'yomnaismail95@gmail.com', 'www.facebook.com/aya', '1150712853'),
(4, 'marwa', 'essam', 'uploads/IMG-20141004-WA0005.jpg', 'fdgf', 'marwaessam@yahoo.com', 'www.facebook.com/marwa', '1007142991'),
(5, 'nermin', 'khaled', 'img/12265636_1205761802782263_2776963461702458973_o.jpg', 'nermin', 'nermin@gmail.com', 'www.facebook.com/nermin', '1002869439'),
(6, 'nadine', 'moahmed', 'img/IMG_20150730_174208.jpg', '0dgdff', 'nadine@yahoo.com', 'www.facebook.com/nadine', '1007142991'),
(8, 'maryam', 'abdelmoem', '', 'maryam', 'maryam@gmail.com', 'www.facebook.com/yooomna', '1002869439'),
(9, 'mohamed', 'sherif ', 'uploads/10338480_883396785058746_1947825652449356558_o.jpg', 'mohamed', 'mohame@2yahoo.com', 'facebook.com/mohamed', '2390482'),
(10, 'mena', 'lotfy', 'uploads/fish_farm.jpg', 'mena', 'menna@gmail.com', 'www.facebook.com/menna', '49534943'),
(11, 'lamiaa', 'mahmoud', 'uploads/images (3).jpg', 'lamiaa', 'laimiaa@gmail.com', 'facebook.com/lamiaa', '3209583'),
(12, 'amal', 'ebdelnafey', 'uploads/new.jpg', 'ama', 'amal@gmail.com', 'facebook.com/amal', '4398739'),
(13, 'ismail', 'mohamed', 'uploads/new2.jpg', 'ismail', 'ismail@yahoo.com', 'facebook.com/ismail', '32095834'),
(14, 'amira', 'fekry', 'uploads/jj.jpg', 'amira', 'amira@gmail.com', 'facebook.com/amira', '1007142991'),
(15, 'mahmoud', 'essam', 'uploads/dd.jpg', 'mahmoud', 'mahmoud@yahoo.com', 'facebook.com/mahmoud', '34933908'),
(16, 'hanan', 'mahmoud', 'uploads/dg.jpg', '9385', 'hanan@yahoo.com', 'facebook.com/hanan', '1007142991'),
(17, 'rania', 'alaa', 'uploads/jjk.jpg', '04353', 'rania@yahoo.com', 'facebook.com/rania', '1007142991'),
(18, 'hager ', 'abohadima', 'uploads/fj.jpg', '04343', 'hager@gmail.com', 'facebook.com/hager', '1007142991'),
(19, 'yomna', 'tarek', 'img/profile.png', '03444', 'yomnatarek@gmail.com', 'facebook.com/yomnatarek', '1002869439'),
(20, 'yasen', 'osama', 'uploads/profile.png', 'kjgr;dk', 'osama@yahoo.com', 'facebook.com/yasen', '01007142991'),
(21, 'Mai', 'Mohamed', 'uploads/profile.png', 'mai', 'maimohamed@gmail.com', 'facebook.com/maimohamed', '01123498732');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessories`
--
ALTER TABLE `accessories`
  ADD CONSTRAINT `accessories_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `accessories_wish`
--
ALTER TABLE `accessories_wish`
  ADD CONSTRAINT `accessories_wish_ibfk_1` FOREIGN KEY (`Item_id`) REFERENCES `accessories` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accessories_wish_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bookcat` FOREIGN KEY (`Category_name`) REFERENCES `book_category` (`Name`);

--
-- Constraints for table `book_wish`
--
ALTER TABLE `book_wish`
  ADD CONSTRAINT `book_wish_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_wish_ibfk_2` FOREIGN KEY (`Item_id`) REFERENCES `book` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `electronic_components`
--
ALTER TABLE `electronic_components`
  ADD CONSTRAINT `electronic_components_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `electronic_components_wish`
--
ALTER TABLE `electronic_components_wish`
  ADD CONSTRAINT `electronic_components_wish_ibfk_1` FOREIGN KEY (`Item_id`) REFERENCES `electronic_components` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `electronic_components_wish_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hardware_component`
--
ALTER TABLE `hardware_component`
  ADD CONSTRAINT `hardware_component_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hardware_component_wish`
--
ALTER TABLE `hardware_component_wish`
  ADD CONSTRAINT `hardware_component_wish_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hardware_component_wish_ibfk_2` FOREIGN KEY (`Item_id`) REFERENCES `hardware_component` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `musical_instruments`
--
ALTER TABLE `musical_instruments`
  ADD CONSTRAINT `musical_instruments_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `musical_instruments_wish`
--
ALTER TABLE `musical_instruments_wish`
  ADD CONSTRAINT `musical_instruments_wish_ibfk_1` FOREIGN KEY (`Item_id`) REFERENCES `electronic_components` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `musical_instruments_wish_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `others`
--
ALTER TABLE `others`
  ADD CONSTRAINT `others_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `others_wish`
--
ALTER TABLE `others_wish`
  ADD CONSTRAINT `others_wish_ibfk_1` FOREIGN KEY (`Item_id`) REFERENCES `electronic_components` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `others_wish_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sheet`
--
ALTER TABLE `sheet`
  ADD CONSTRAINT `sheet_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sheet_ibfk_3` FOREIGN KEY (`Dept_name`) REFERENCES `department` (`Name`);

--
-- Constraints for table `sheet_wish`
--
ALTER TABLE `sheet_wish`
  ADD CONSTRAINT `sheet_wish_ibfk_1` FOREIGN KEY (`Item_id`) REFERENCES `sheet` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sheet_wish_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sport_equipment`
--
ALTER TABLE `sport_equipment`
  ADD CONSTRAINT `sport_equipment_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sport_equipment_wish`
--
ALTER TABLE `sport_equipment_wish`
  ADD CONSTRAINT `sport_equipment_wish_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sport_equipment_wish_ibfk_2` FOREIGN KEY (`Item_id`) REFERENCES `sport_equipment` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`Category_name`) REFERENCES `ticket_category` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_wish`
--
ALTER TABLE `ticket_wish`
  ADD CONSTRAINT `ticket_wish_ibfk_1` FOREIGN KEY (`Item_id`) REFERENCES `ticket` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_wish_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tool`
--
ALTER TABLE `tool`
  ADD CONSTRAINT `tool_ibfk_1` FOREIGN KEY (`Category_name`) REFERENCES `tool_category` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tool_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tool_wish`
--
ALTER TABLE `tool_wish`
  ADD CONSTRAINT `tool_wish_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tool_wish_ibfk_2` FOREIGN KEY (`Item_id`) REFERENCES `tool` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
