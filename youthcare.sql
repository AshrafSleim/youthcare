-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 03, 2018 at 02:21 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youthcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `name`) VALUES
(9, 'ابداع'),
(3, 'حفل ثقافى'),
(7, 'دوره تدريبيه'),
(6, 'مراكز الفنون'),
(2, 'مسابقه ادبيه'),
(10, 'مسابقه اعلاميه'),
(8, 'مسابقه دينيه'),
(5, 'معرض'),
(4, 'نجوم الجامعه');

-- --------------------------------------------------------

--
-- Table structure for table `activity2`
--

DROP TABLE IF EXISTS `activity2`;
CREATE TABLE IF NOT EXISTS `activity2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `start_trining` date NOT NULL,
  `end_trining` date NOT NULL,
  `address` text NOT NULL,
  `supervisors` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity2`
--

INSERT INTO `activity2` (`id`, `type`, `start_trining`, `end_trining`, `address`, `supervisors`) VALUES
(3, 'مهرجان', '2018-06-16', '2018-06-17', 'بورسعيد', 'اشرف'),
(4, 'مهرجان', '2018-07-31', '2018-08-03', 'بورسعيد', 'اشرف'),
(5, 'مهرجان', '2018-07-28', '2018-07-29', 'بورسعيد', 'اشرف');

-- --------------------------------------------------------

--
-- Table structure for table `fieldartist`
--

DROP TABLE IF EXISTS `fieldartist`;
CREATE TABLE IF NOT EXISTS `fieldartist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `Activity_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `type` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `start_trining` date DEFAULT NULL,
  `end_trining` date DEFAULT NULL,
  `supervisors` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `Activity_id_UNIQUE` (`Activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fieldartist`
--

INSERT INTO `fieldartist` (`id`, `name`, `Activity_id`, `data`, `type`, `address`, `start_trining`, `end_trining`, `supervisors`) VALUES
(14, 'عزف', 4, '2018-06-02', 'فردى', 'القاهره', '2018-06-07', '2018-06-08', 'اشرف');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

DROP TABLE IF EXISTS `fields`;
CREATE TABLE IF NOT EXISTS `fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `Activity_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `execution_area` varchar(45) NOT NULL,
  `execution_type` varchar(45) NOT NULL,
  `address` text NOT NULL,
  `montors` text NOT NULL,
  `execution_members` text NOT NULL,
  `budget` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `Field_to_Activity_idx` (`Activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `name`, `Activity_id`, `date`, `execution_area`, `execution_type`, `address`, `montors`, `execution_members`, `budget`) VALUES
(1, 'شعر عامى', 2, '2018-05-19', 'داخلى', 'اسبوع الفتيات', 'بورسعيد', 'محمود', 'ابراهيم', 555),
(2, 'قصه قصيره', 2, '2018-05-05', 'داخلى', 'اسبوع الفتيات', 'بورسعيد', 'محمود', 'ابراهيم', 5555),
(3, 'تقديم مواهب', 3, '2018-05-03', 'خارجى', 'مهرجان الاسر', 'بورسعيد', 'اسماء', 'محممدين', 14),
(4, 'شعر فصيح', 2, '2018-05-18', 'داخلى', 'مهرجان الاسر', 'القاهره', 'محمد', 'ابراهيم', 896),
(5, 'مراسل', 2, '2018-05-05', 'خارجى', 'اسبوع الفتيات', 'القاهره', 'محمد', 'ابراهيم', 5522),
(6, 'دينيه', 7, '2018-06-06', 'داخلى', 'اسبوع الفتيات', 'اسكندريه', 'محمد', 'محمود', 125),
(10, 'ثقافه اسلاميه', 2, '2018-07-15', 'داخلى', 'اسبوع الشباب', 'بورسعيد', 'محمود', 'ابراهيم', 856),
(13, 'قرأن كريم', 8, '2018-07-31', 'داخلى', 'اسبوع الفتيات', 'بورسعيد', 'محمد', 'محممدين', 1299),
(14, 'اربعون نوويه', 2, '2018-07-14', 'داخلى', 'اسبوع الشباب', 'بورسعيد', 'محمود', 'اسماعيل', 12458),
(16, 'روايه', 2, '2018-07-10', 'خارجى', 'اسبوع الشباب', 'اسكندرية', 'قارون', 'اشرف', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `checked` int(11) NOT NULL DEFAULT '0',
  `department` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `password`, `checked`, `department`) VALUES
(1, 'admin', 'admin', 0, 'manager'),
(2, 'اشرف', '123456', 0, 'اداره النشاط الثقافى'),
(4, 'اسماء', '123456', 0, 'اداره الفن'),
(5, 'احمد', '123456', 0, 'اداره الجواله'),
(6, 'حمو', '123456', 0, 'اداره النشاط الاجتماعى');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_field_id` int(11) NOT NULL,
  `fields_id` int(11) DEFAULT NULL,
  `result` varchar(45) DEFAULT 'لم يشترك',
  `fieldArtist_id` int(11) DEFAULT NULL,
  `flag` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_register_1_idx` (`student_field_id`),
  KEY `fk_register_2_idx` (`fields_id`),
  KEY `fk_register_3_idx` (`fieldArtist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `student_field_id`, `fields_id`, `result`, `fieldArtist_id`, `flag`) VALUES
(1, 3, 4, 'مركز اول', NULL, 1),
(2, 5, 4, 'مركز ثانى', NULL, 1),
(3, 7, NULL, 'مركز رابع', 14, 2),
(4, 23, 10, 'مركز اول', NULL, 1),
(5, 13, 13, 'لم يشترك', NULL, 1),
(6, 26, 13, 'مركز رابع', NULL, 1),
(7, 31, 14, 'مركز اول', NULL, 1),
(8, 2, 16, 'اول', NULL, 1),
(9, 17, 16, 'لم يشترك', NULL, 1),
(10, 18, 16, 'لم يشترك', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '	',
  `card_id` varchar(45) NOT NULL,
  `Faculty` varchar(45) NOT NULL,
  `level` varchar(45) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` text NOT NULL,
  `superTeam` int(11) DEFAULT '0',
  `flag` int(11) NOT NULL DEFAULT '0',
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `card_id`, `Faculty`, `level`, `phone`, `address`, `superTeam`, `flag`, `type`) VALUES
(1, 'اشرف', '23456789123456', 'حاسبات', 'اولى', 1258746, 'بورسعيد', 0, 1, 'ذكر'),
(2, 'محمود', '12345678912456', 'كليه الحاسبات', 'الثانيه', 12578963, 'بورسعيد', 0, 0, NULL),
(3, 'اسماء', '12345678913456', 'كليه التمريض', 'الاولى', 14789, 'بورسعيد', 0, 0, NULL),
(4, 'مجمود محمد محمد سادات', '12456789123456', 'كليه الزراعه', 'الرابعه', 1288501654, 'بورسعيد', 0, 0, NULL),
(5, 'ابراهيم', '15897632514896', 'كليه تجاره', 'الثانيه', 15789651, 'بورسعيد', 0, 0, NULL),
(6, 'على', '14785214785214', 'كليه الحاسبات', 'الرابعه', 128551650, 'القاهره', 1, 1, NULL),
(7, 'حمو', '95123687412345', 'كلية الحاسبات', 'الاولى ', 1288501654, 'بورسعيد', 0, 0, 'ذكر'),
(8, 'مهند', '98741256312345', 'كليه العلوم', 'الاولى', 1288501654, 'بورسعيد', 0, 1, NULL),
(9, 'اسماعيل ', '85236974112345', 'كليه الزراعه', 'الاولى', 1288501654, 'القاهره', 0, 0, NULL),
(10, 'اسماعيل ', '35795126841234', 'كليه الزراعه', 'الثالثه', 1288501654, 'ؤس', 0, 1, NULL),
(11, 'مهند', '74589612312345', 'كليه التمريض', 'الاولى', 1288501654, 'بورسعيد', 0, 0, NULL),
(12, 'مهند', '14253612312345', 'كليه تجاره', 'الثانيه', 1258746, 'بورسعيد', 0, 0, NULL),
(15, 'مهند', '75315968421234', 'كليه التمريض', 'الرابعه', 1288501654, 'القاهره', 0, 1, NULL),
(16, 'جودى', '98765432198765', 'كليه الحاسبات', 'الاولى', 1298765345, 'بورسعيد', 0, 0, NULL),
(17, 'ابراهيم', '98745632112345', 'كليه اداب', 'الاولى', 1258746, 'القاهره', 0, 0, NULL),
(18, 'شهد', '11223344556677', 'كليه طب بشرى', 'الاولى', 1298765345, 'بورسعيد', 0, 0, NULL),
(19, 'هيدى', '99887766554433', 'كليه صيدله', 'الثانيه', 1298765345, 'القاهره', 0, 0, NULL),
(20, 'ساره', '12345678912345', 'كلية الحاسبات', 'الاولى ', 1298765345, 'بورسعيد', 0, 0, 'انثى'),
(23, 'شيكو', '77553366998844', 'كليه تجاره', 'الرابعه', 1288501654, 'القاهره', 0, 0, NULL),
(24, 'محمود', '33112244557766', 'كليه التمريض', 'الاولى', 128551654, 'بورسعيد', 0, 1, NULL),
(26, 'اشرف', '12121212121212', 'كليه الحاسبات', 'الرابعه', 1288501654, 'بورسعيد', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_field`
--

DROP TABLE IF EXISTS `student_field`;
CREATE TABLE IF NOT EXISTS `student_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `field_name` varchar(45) NOT NULL,
  `flag` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_field_1_idx` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_field`
--

INSERT INTO `student_field` (`id`, `student_id`, `field_name`, `flag`) VALUES
(2, 2, 'روايه', 1),
(3, 3, 'شعر فصيح', 1),
(4, 4, 'شعر عامى', 1),
(5, 4, 'شعر فصيح', 1),
(6, 4, 'مراسل', 1),
(7, 1, 'عزف', 2),
(8, 1, 'انشاد دينى', 2),
(9, 5, 'غناء', 2),
(10, 5, 'فنون شعبيه', 2),
(11, 8, 'شعر عامى', 1),
(12, 8, 'مجلات حائط', 1),
(13, 8, 'قرأن كريم', 1),
(14, 8, 'فنون شعبيه', 2),
(15, 9, 'غناء', 2),
(16, 9, 'مسرح', 2),
(17, 10, 'روايه', 1),
(18, 11, 'روايه', 1),
(19, 12, 'فنون شعبيه', 2),
(22, 16, 'شعر عامى', 1),
(23, 17, 'ثقافه اسلاميه', 1),
(24, 18, 'مناسبات وطنيه', 1),
(25, 18, 'تقديم مواهب', 1),
(26, 19, 'قرأن كريم', 1),
(31, 23, 'اربعون نوويه', 1),
(35, 26, 'شعر فصيح', 1),
(36, 26, 'غناء', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student_social`
--

DROP TABLE IF EXISTS `student_social`;
CREATE TABLE IF NOT EXISTS `student_social` (
  `Studentid` int(11) NOT NULL AUTO_INCREMENT,
  `budget` float DEFAULT '0',
  `school_year` int(11) NOT NULL,
  KEY `fk_student_social_1_idx` (`Studentid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_social`
--

INSERT INTO `student_social` (`Studentid`, `budget`, `school_year`) VALUES
(7, 500, 2018),
(20, 1200, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Faculty` varchar(45) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_team_1_idx` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `team_result`
--

DROP TABLE IF EXISTS `team_result`;
CREATE TABLE IF NOT EXISTS `team_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `result` varchar(45) NOT NULL,
  `activity2_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activity2toteam_idx` (`activity2_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team_result`
--

INSERT INTO `team_result` (`id`, `name`, `result`, `activity2_id`) VALUES
(1, 'كليه الحاسبات', 'مركز اول', 3),
(2, 'كليه الهندسه', 'لم تشترك', 3),
(3, 'كليه العلوم', 'لم تشترك', 3),
(4, 'كليه طب بشرى', 'لم تشترك', 3),
(5, 'كليه طب اسنان', 'لم تشترك', 3),
(6, 'كليه طب بيطرى', 'كليه الحاسبات', 3),
(7, 'كليه صيدله', 'لم تشترك', 3),
(8, 'كليه اداب', 'لم تشترك', 3),
(9, 'كليه تربيه', 'لم تشترك', 3),
(10, 'كليه السياحه', 'لم تشترك', 3),
(11, 'كليه تجاره', 'لم تشترك', 3),
(12, 'كليه التمريض', 'لم تشترك', 3),
(13, 'كليه الزراعه', 'لم تشترك', 3),
(14, 'كليه الحاسبات', 'مركز الاول', 4),
(15, 'كليه الهندسه', 'لم تشترك', 4),
(16, 'كليه العلوم', 'لم تشترك', 4),
(17, 'كليه طب بشرى', 'لم تشترك', 4),
(18, 'كليه طب اسنان', 'لم تشترك', 4),
(19, 'كليه طب بيطرى', 'لم تشترك', 4),
(20, 'كليه صيدله', 'لم تشترك', 4),
(21, 'كليه اداب', 'لم تشترك', 4),
(22, 'كليه تربيه', 'لم تشترك', 4),
(23, 'كليه السياحه', 'لم تشترك', 4),
(24, 'كليه تجاره', 'لم تشترك', 4),
(25, 'كليه التمريض', 'لم تشترك', 4),
(26, 'كليه الزراعه', 'لم تشترك', 4),
(27, 'كليه الحاسبات', 'مركز رابع', 5),
(28, 'كليه الهندسه', 'مركز اول', 5),
(29, 'كليه العلوم', 'لم تشترك', 5),
(30, 'كليه طب بشرى', 'لم تشترك', 5),
(31, 'كليه طب اسنان', 'لم تشترك', 5),
(32, 'كليه طب بيطرى', 'لم تشترك', 5),
(33, 'كليه صيدله', 'لم تشترك', 5),
(34, 'كليه اداب', 'لم تشترك', 5),
(35, 'كليه تربيه', 'لم تشترك', 5),
(36, 'كليه السياحه', 'لم تشترك', 5),
(37, 'كليه تجاره', 'لم تشترك', 5),
(38, 'كليه التمريض', 'لم تشترك', 5),
(39, 'كليه الزراعه', 'لم تشترك', 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fieldartist`
--
ALTER TABLE `fieldartist`
  ADD CONSTRAINT `FieldartisttToActivity` FOREIGN KEY (`Activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fields`
--
ALTER TABLE `fields`
  ADD CONSTRAINT `Field_to_Activity` FOREIGN KEY (`Activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `fk_register_1` FOREIGN KEY (`student_field_id`) REFERENCES `student_field` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_register_2` FOREIGN KEY (`fields_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_register_3` FOREIGN KEY (`fieldArtist_id`) REFERENCES `fieldartist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_field`
--
ALTER TABLE `student_field`
  ADD CONSTRAINT `fk_student_field_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_social`
--
ALTER TABLE `student_social`
  ADD CONSTRAINT `fk_student_social_1` FOREIGN KEY (`Studentid`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `fk_team_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team_result`
--
ALTER TABLE `team_result`
  ADD CONSTRAINT `activity2toteam` FOREIGN KEY (`activity2_id`) REFERENCES `activity2` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
