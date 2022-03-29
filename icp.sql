-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 29, 2022 at 07:04 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icp_assignment`
--
CREATE DATABASE IF NOT EXISTS `icp_assignment` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `icp_assignment`;

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

DROP TABLE IF EXISTS `coordinator`;
CREATE TABLE IF NOT EXISTS `coordinator` (
  `unique_id` bigint NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`unique_id`, `name`) VALUES
(1065133050, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_topic_id` int NOT NULL,
  `unique_id` bigint NOT NULL,
  `category` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `parent_topic_id`, `unique_id`, `category`, `post`, `date`) VALUES
(38, 0, 1284975145, 'FYP1', 'I got a question on FYP1', '2022-03-18 10:16:05'),
(37, 0, 1284975145, 'FYP2', 'asdadsada', '2022-03-03 13:36:14'),
(36, 33, 1284975145, 'FYP1', 'asdsads', '2022-03-03 13:36:00'),
(35, 33, 1284975145, 'FYP1', 'sadsad', '2022-03-03 13:35:55'),
(34, 33, 1284975145, 'FYP1', 'here is the solution', '2022-03-03 13:35:48'),
(33, 0, 633302598, 'FYP1', 'Asking a question\n', '2022-03-03 13:35:14'),
(32, 31, 1026991736, 'FYP1', 'hi buddy\n', '2022-02-28 10:30:54'),
(31, 0, 633302598, 'FYP1', 'I got a question', '2022-02-28 10:29:40'),
(30, 0, 633302598, 'FYP2', 'help', '2022-02-24 19:49:33'),
(29, 28, 633302598, 'FYP1', 'test', '2022-02-24 19:49:02'),
(28, 0, 1531325764, 'FYP1', 'a', '2022-02-24 19:48:10'),
(39, 38, 1284975145, 'FYP1', 'thi sis the solution', '2022-03-18 10:16:19'),
(40, 0, 633302598, 'FYP1', 'abc', '2022-03-29 15:00:48'),
(41, 40, 633302598, 'FYP1', 'test', '2022-03-29 15:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_unique_id` bigint NOT NULL,
  `pro_stmt` int NOT NULL,
  `pro_stmt_comment` varchar(255) NOT NULL,
  `lit_review` int NOT NULL,
  `lit_review_comment` varchar(255) NOT NULL,
  `analysis_design` int NOT NULL,
  `analysis_design_comment` varchar(255) NOT NULL,
  `imple_test` int NOT NULL,
  `imple_test_comment` varchar(255) NOT NULL,
  `pro_mange` int NOT NULL,
  `pro_mange_comment` varchar(255) NOT NULL,
  `conclusion` int NOT NULL,
  `conclusion_comment` varchar(255) NOT NULL,
  `doc_viva` int NOT NULL,
  `doc_viva_comment` varchar(255) NOT NULL,
  `sec_marker_comment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `student_unique_id`, `pro_stmt`, `pro_stmt_comment`, `lit_review`, `lit_review_comment`, `analysis_design`, `analysis_design_comment`, `imple_test`, `imple_test_comment`, `pro_mange`, `pro_mange_comment`, `conclusion`, `conclusion_comment`, `doc_viva`, `doc_viva_comment`, `sec_marker_comment`) VALUES
(2, 633302598, 12, 'asd', 3, 'asd', 4, 'sadad', 12, 'asd', 12, 'asd', 12, 'asd', 10, 'asd', 'test2');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

DROP TABLE IF EXISTS `lecturer`;
CREATE TABLE IF NOT EXISTS `lecturer` (
  `unique_id` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `research` varchar(255) NOT NULL,
  PRIMARY KEY (`unique_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`unique_id`, `name`, `email`, `position`, `major`, `research`) VALUES
(1330931688, 'Mr.Phua Yeong Tsann', 'phua@mail.com', 'lecturer', 'Computer Science', 'Machine LearningPattern RecognitionMobile Development'),
(1149044994, 'Ms.Siti Fazilah Shamsudin', 'siti@mail.com', 'lecturer', 'Software Engineering Computer Engineering', 'HCI/Usability/User Experience\r\nMobile App Development\r\nE-Learning/M-Learning\r\nSoftware Engineering\r\nIOT\r\nData Science\r\nMachine Learning'),
(1345107734, 'Mr. Chua Hiang Kiat', 'chua@mail.com', 'lecturer', 'Computer Science Information System', 'Computer Science Education Systems\r\nHCI/Usability/User Experience\r\nMobile App Development\r\nE-Learing/M-Learning\r\nEnterprise Information Systems\r\nWeb Development'),
(1294863147, 'lecturer', 'lecturer@gmail.com', 'lecturer', 'Computer Science', 'IoT\r\nMobile Application Development'),
(1210018596, 'lecturer2', 'lecturer2@mail.com', 'senior lecturer', 'Computer Science', 'IoT\r\nWeb Development\r\nMachine Learning'),
(1460317158, 'lecturer3', 'lecturer3@mail.com', 'lecturer', 'Computer Science', 'Iot\r\nAi\r\nMachine Learning'),
(1173222173, 'ku', 'ku@mail.com', 'ku', 'ku', 'ku');

-- --------------------------------------------------------

--
-- Table structure for table `logbook`
--

DROP TABLE IF EXISTS `logbook`;
CREATE TABLE IF NOT EXISTS `logbook` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_unique_id` bigint NOT NULL,
  `week` int NOT NULL,
  `content` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `logbook`
--

INSERT INTO `logbook` (`id`, `student_unique_id`, `week`, `content`, `comment`) VALUES
(1, 1476116590, 2, '0', ''),
(2, 1476116590, 1, 'asdf', ''),
(3, 1476116590, 4, 'Analysis task done', ''),
(4, 1476116590, 5, 'yr', ''),
(5, 1476116590, 6, 'test', ''),
(6, 114516046, 1, 'Complete design', ''),
(7, 114516046, 2, 'Complete Questionnaire\r\n', ''),
(8, 114516046, 3, 'Complete Diagram', ''),
(9, 1531325764, 1, 'asd', 'good job\r\n'),
(10, 1531325764, 2, 'test', 'dsa'),
(11, 1531325764, 3, 'asd', 'asd good\r\n'),
(12, 633302598, 1, 'week1 task completed', 'received logbbok1'),
(13, 633302598, 2, 'week 2 task completed', 'Week2 good progress'),
(14, 633302598, 3, 'week 3 task completed', 'asd'),
(15, 633302598, 4, 'Task 4 complete', 'NIce job'),
(16, 1587412174, 1, 'sadsad', 'nice progress'),
(17, 1587412174, 2, 'sadad', 'test'),
(18, 1284975145, 1, 'proposal preparation completed', ''),
(19, 633302598, 5, 'Task 5 Completed', 'abc'),
(20, 633302598, 6, 'Task 6 Completed', 'dsafsfsafafa');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

DROP TABLE IF EXISTS `meeting`;
CREATE TABLE IF NOT EXISTS `meeting` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `student_unique_id` bigint NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`id`, `title`, `student_unique_id`, `start_event`, `end_event`) VALUES
(18, 'sad', 633302598, '2022-03-04 13:00:00', '2022-03-04 14:00:00'),
(19, 'Meeting', 633302598, '2022-03-18 17:00:00', '2022-03-18 18:00:00'),
(14, 'Meeting', 633302598, '2022-03-02 13:00:00', '2022-03-02 14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `msg` varchar(255) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 1400248344, 1065133050, 'a'),
(2, 1331006149, 1065133050, 'hi'),
(3, 1560817926, 1065133050, 'test'),
(4, 1149044994, 633302598, 'Hi Miss'),
(5, 1149044994, 1065133050, 'hi'),
(6, 1065133050, 1149044994, 'hi admin'),
(7, 1284975145, 1065133050, 'Halo student5'),
(8, 1065133050, 1284975145, 'halo admin'),
(9, 1149044994, 1065133050, 'halo'),
(10, 1173222173, 1587412174, 'hi'),
(11, 1587412174, 1173222173, 'sohai'),
(12, 1173222173, 1587412174, ':\'('),
(13, 1587412174, 1173222173, ':D'),
(14, 1587412174, 1173222173, 'worr sohai'),
(15, 1173222173, 1587412174, 'u so noob'),
(16, 1587412174, 1173222173, 'oiii sohai'),
(17, 1587412174, 1173222173, '??????????'),
(18, 1173222173, 1587412174, '???????????????????'),
(19, 1210018596, 1065133050, 'HI Lecturer 2'),
(20, 1065133050, 1210018596, 'hi admin'),
(21, 1065133050, 1284975145, 'asdsad'),
(22, 1210018596, 1065133050, 'hi'),
(23, 1065133050, 633302598, 'admi'),
(24, 1065133050, 1210018596, 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unique_id` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `programme` varchar(255) NOT NULL,
  `year` int NOT NULL,
  `cgpa` double NOT NULL,
  `phone_num` varchar(255) NOT NULL,
  `fyp_title` varchar(255) NOT NULL,
  `supervisor_unique_id` bigint NOT NULL,
  `second_marker_unique_id` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `unique_id`, `name`, `email`, `programme`, `year`, `cgpa`, `phone_num`, `fyp_title`, `supervisor_unique_id`, `second_marker_unique_id`) VALUES
(8, 633302598, 'student1', 'student1@mail.com', 'Computer Science', 1, 3.3, '0123456789', 'testing', 1210018596, 1294863147),
(7, 1531325764, 'student3', 'student3@student3.com', 'student3', 2, 3, '123', 'student3', 1294863147, 1210018596),
(9, 1026991736, 'student2', 'student2@mail.com', 'Computer Sceince', 2, 2, '0213', 'student2', 1330931688, 1294863147),
(10, 623778952, 'student4', 'student4@mail.com', 'Computer', 3, 3.2, '213213', 'student4', 1210018596, 1149044994),
(11, 1284975145, 'student5', 'student5@mail.com', 'bachelor of CS', 2, 3.1, '0102131321', 'test Title', 1330931688, 1210018596);

-- --------------------------------------------------------

--
-- Table structure for table `submission_archive`
--

DROP TABLE IF EXISTS `submission_archive`;
CREATE TABLE IF NOT EXISTS `submission_archive` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_unique_id` bigint NOT NULL,
  `filesName` varchar(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `submission_archive`
--

INSERT INTO `submission_archive` (`id`, `student_unique_id`, `filesName`, `status`, `date`) VALUES
(8, 633302598, 'OSAD_GanttChart.pdf', 'Archived', '2022-03-02 18:03:22'),
(10, 1284975145, 'TaxInvoice_MY220213-15371378.pdf', 'Archived', '2022-03-03 13:25:45'),
(11, 1587412174, 'AssignmentER_Diagram.pdf', 'Pending', '2022-03-06 22:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `sys_dev_schedule`
--

DROP TABLE IF EXISTS `sys_dev_schedule`;
CREATE TABLE IF NOT EXISTS `sys_dev_schedule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `week` int NOT NULL,
  `task` varchar(255) NOT NULL,
  `fyp_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sys_dev_schedule`
--

INSERT INTO `sys_dev_schedule` (`id`, `week`, `task`, `fyp_type`, `remark`) VALUES
(1, 1, '-', 'fyp1', ''),
(2, 2, 'Submit Supervisor Form*\r\nPresentation on project overview\r\n', 'fyp1', 'Submission'),
(6, 3, '-', 'fyp1', ''),
(7, 4, 'Update progress on Chapter 1\r\nLatest week to Submit Supervisor Form*\r\nNo meeting with CS & EIS students\r\n', 'fyp1', ''),
(8, 5, 'Update progress on Chapter 2 (LR)', 'fyp1', ''),
(9, 6, 'Update progress on Chapter 3', 'fyp1', ''),
(10, 1, '-\r\n', 'fyp2', ''),
(11, 7, 'Update progress on Chapter 4', 'fyp1', ''),
(12, 8, 'Update progress on Chapter 5 Or \r\nChapter 6 ( Implementation)\r\n', 'fyp1', ''),
(13, 9, 'Update progress SRS/SDS\r\n•	Submission of SRS/SDS ONLY SE', 'fyp1', ''),
(14, 10, 'Final Submission of (Online Submission in OL):\r\n•	FYP1 Documentation\r\n•	Poster Presentation\r\n', 'fyp1', 'Submission'),
(15, 11, 'Colloquium', 'fyp1', ''),
(16, 12, 'Colloquium', 'fyp1', ''),
(17, 13, 'Colloquium', 'fyp1', ''),
(18, 2, 'Schedule Presentation\r\nUpdate progress on Chapter 1 & 3 ( If Any)\r\n', 'fyp2', ''),
(19, 3, '-', 'fyp2', ''),
(20, 4, 'Schedule Presentation\r\nUpdate progress on Chapter 1 & 3 ( If Any)\r\n', 'fyp2', ''),
(21, 5, 'Update progress on Chapter 6 &7\r\nComplete Chapter 4 & 5\r\n', 'fyp2', ''),
(22, 6, 'Update progress on Chapter 6 &7\r\nComplete Chapter 4 & 5\r\n', 'fyp2', ''),
(23, 7, 'Self Study /  Chapter 7', 'fyp2', ''),
(24, 8, 'Self Study /  Chapter 7', 'fyp2', 'Submission'),
(25, 9, 'Submission of SRS/SDS/STP', 'fyp2', ''),
(26, 10, 'Self Study', 'fyp2', ''),
(27, 11, 'Final Submission of (Online Submission in OL):\r\n•	FYP2 Documentation( Chap1 -8) in pdf format\r\n•	Poster Presentation\r\n•	Video presentation (SLIDE & product Demonstration)**', 'fyp2', ''),
(28, 12, 'VIVA', 'fyp2', ''),
(29, 13, 'VIVA', 'fyp2', ''),
(39, 14, 'new mweek', 'fyp1', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

DROP TABLE IF EXISTS `userlogin`;
CREATE TABLE IF NOT EXISTS `userlogin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `unique_id` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `login_id`, `password`, `roles`, `unique_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 1065133050),
(25, 'ST_student3', '8e4947690532bc44a8e41e9fb365b76a', 'Student', 1531325764),
(26, 'Mr.Phua Yeong Tsann', 'b06febcfbc00db4f67aed9234e3e52b0', 'Lecturer', 1330931688),
(27, 'Ms.Siti Fazilah Shamsudin', 'b06febcfbc00db4f67aed9234e3e52b0', 'Lecturer', 1149044994),
(31, 'lecturer2', 'b06febcfbc00db4f67aed9234e3e52b0', 'Lecturer', 1210018596),
(29, 'ST_student1', 'cd73502828457d15655bbd7a63fb0bc8', 'Student', 633302598),
(30, 'lecturer', 'b06febcfbc00db4f67aed9234e3e52b0', 'Lecturer', 1294863147),
(28, 'Mr. Chua Hiang Kiat', 'b06febcfbc00db4f67aed9234e3e52b0', 'Lecturer', 1345107734),
(32, 'ST_student2', '213ee683360d88249109c2f92789dbc3', 'Student', 1026991736),
(33, 'ST_student4', 'cd73502828457d15655bbd7a63fb0bc8', 'Student', 623778952),
(34, 'lecturer3', 'b06febcfbc00db4f67aed9234e3e52b0', 'Lecturer', 1460317158),
(35, 'ST_student5', 'cd73502828457d15655bbd7a63fb0bc8', 'Student', 1284975145),
(37, 'ku', '19e2adc1d3d62258a2e756cc95311b79', 'Lecturer', 1173222173);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
