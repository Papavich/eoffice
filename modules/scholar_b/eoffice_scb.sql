-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2018 at 10:32 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eoffice_scb`
--

-- --------------------------------------------------------

--
-- Table structure for table `scb_activity_main`
--

CREATE TABLE `scb_activity_main` (
  `act_main_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `act_main_name` varchar(45) DEFAULT NULL,
  `act_main_location` varchar(45) DEFAULT NULL,
  `act_main_date_start` datetime DEFAULT NULL,
  `act_main_date_end` datetime DEFAULT NULL,
  `act_main_detail` varchar(200) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_address_candidate`
--

CREATE TABLE `scb_address_candidate` (
  `address_type` varchar(15) NOT NULL,
  `scb_candidate_id_card` varchar(17) NOT NULL,
  `address` varchar(60) DEFAULT NULL,
  `tumbon` varchar(15) DEFAULT NULL,
  `amphor` varchar(15) DEFAULT NULL,
  `province` varchar(15) DEFAULT NULL,
  `country` varchar(15) DEFAULT NULL,
  `zipcode` varchar(5) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scb_address_candidate`
--

INSERT INTO `scb_address_candidate` (`address_type`, `scb_candidate_id_card`, `address`, `tumbon`, `amphor`, `province`, `country`, `zipcode`, `crby`, `crtime`, `udby`, `udtime`) VALUES
('test', '1111111111111', 'test', 'test', 'test', 'test', 'test', '44444', NULL, NULL, NULL, NULL),
('หน้าเมือง', '1111111111112', '270 ถ.เทพคุณากร', NULL, 'เมือง', 'ฉะเชิงเทรา', NULL, '24000', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scb_address_parent`
--

CREATE TABLE `scb_address_parent` (
  `scb_parents_id_card_parent` varchar(17) NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  `tumbon` varchar(15) DEFAULT NULL,
  `amphor` varchar(15) DEFAULT NULL,
  `province` varchar(15) DEFAULT NULL,
  `country` varchar(15) DEFAULT NULL,
  `zipcode` varchar(5) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_branch`
--

CREATE TABLE `scb_branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_calendar`
--

CREATE TABLE `scb_calendar` (
  `calendar_id` int(11) NOT NULL,
  `staff_id_card` varchar(13) NOT NULL,
  `calendar_topic` varchar(45) DEFAULT NULL,
  `calendar_detail` varchar(100) DEFAULT NULL,
  `calendar_date_start` datetime DEFAULT NULL,
  `calendar_date_end` datetime DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_candidate`
--

CREATE TABLE `scb_candidate` (
  `id_card` varchar(17) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `prefix` varchar(6) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `blood_type` varchar(2) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `origin` varchar(15) DEFAULT NULL,
  `nationality` varchar(15) DEFAULT NULL,
  `religion` varchar(15) DEFAULT NULL,
  `place_of_birth` varchar(30) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `schoolname` varchar(50) DEFAULT NULL,
  `school_status` varchar(10) DEFAULT NULL,
  `total_brethren` int(11) DEFAULT NULL,
  `number_of_sister` int(11) DEFAULT NULL,
  `number_of_brother` int(11) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scb_candidate`
--

INSERT INTO `scb_candidate` (`id_card`, `password`, `prefix`, `firstname`, `lastname`, `blood_type`, `birth_date`, `origin`, `nationality`, `religion`, `place_of_birth`, `email`, `mobile`, `status`, `schoolname`, `school_status`, `total_brethren`, `number_of_sister`, `number_of_brother`, `crby`, `crtime`, `udby`, `udtime`) VALUES
('1-2097-00620-25-1', NULL, 'นางสาว', 'dsfdsf', 'sdfdsf', 'B', '2018-02-13', 'dsfd', 'sfdsf', 'dsfsdf', 'df', 'delightzxy@gmail.com', '0824637888', NULL, 'เบญจมราชรังสฤษฎิ์', 'รัฐบาล', 2, 2, 2, 1, '2018-02-08 08:50:56', 1, '2018-02-08 08:50:56'),
('1-2197-00620-25-1', NULL, 'นางสาว', 'dsfdsf', 'sdfdsf', 'B', '2018-02-13', 'dsfd', 'sfdsf', 'dsfsdf', 'df', 'delightzxy@gmail.com', '0824637888', NULL, 'เบญจมราชรังสฤษฎิ์', 'รัฐบาล', 2, 2, 2, 1, '2018-02-08 08:51:24', 1, '2018-02-08 08:51:24'),
('1-2345-55677-77-7', NULL, 'นางสาว', 'dsfdsf', 'sdfdsf', 'B', '2018-02-13', 'dsfd', 'sfdsf', 'dsfsdf', 'df', 'delightzxy@gmail.com', '0824637888', NULL, 'เบญจมราชรังสฤษฎิ์', 'รัฐบาล', 2, 2, 2, 1, '2018-02-08 08:48:49', 1, '2018-02-08 08:48:49'),
('1111111111111', '1234', 'นาย', 'ศุภวิชญ์', 'ภารจินดา', 'B', '2017-11-22', 'พุทธ', 'ไทย', 'พุทธ', 'ขอนแก่น', 'dd@gmail.com', '0822222222', 'รอ', 'อนุกูลนารี', 'รัฐบาล', 2, 0, 1, 1, '2018-01-25 00:55:36', 1, '2018-01-19 00:55:39'),
('1111111111112', NULL, 'นาย', 'นารีนารถ', 'เนรัญชร', 'B', '1995-08-02', 'ไทย', 'ไทย', 'พุทธ', 'ชลบุรี', 'delightzxy@gmail.com', '0824637888', NULL, 'เบญจมราชรังสฤษฎิ์', 'รัฐบาล', 2, 1, 0, 1, '2018-01-23 10:24:07', 1, '2018-01-23 10:24:07'),
('1111111111114', NULL, 'นางสาว', 'นารีนารถ', 'เนรัญชร', 'B', '1995-08-02', 'ไทย', 'ไทย', 'พุทธ', 'ชลบุรี', 'delightzxy@gmail.com', '0824637888', NULL, 'เบญจมราชรังสฤษฎิ์', 'รัฐบาล', 2, 1, 0, 1, '2018-02-03 14:35:18', 1, '2018-02-03 14:35:18'),
('1111111111115', NULL, 'นางสาว', 'นารีนารถ', 'เนรัญชร', 'B', '1995-08-02', 'ไทย', 'ไทย', 'พุทธ', 'ชลบุรี', 'delightzxy@gmail.com', '0824637888', NULL, 'เบญจมราชรังสฤษฎิ์', 'รัฐบาล', 2, 1, 0, 1, '2018-02-03 14:35:46', 1, '2018-02-03 14:35:46'),
('1111111111117', NULL, 'นางสาว', 'นารีนารถ', 'เนรัญชร', 'B', '1995-08-02', 'ไทย', 'ไทย', 'พุทธ', 'ชลบุรี', 'delightzxy@gmail.com', '0824637888', NULL, 'เบญจมราชรังสฤษฎิ์', 'รัฐบาล', 2, 1, 0, 1, '2018-02-03 14:38:07', 1, '2018-02-03 14:38:07'),
('1111111111119', NULL, 'null', '', '', 'B', NULL, '', '', '', '', '', '', NULL, '', 'null', NULL, NULL, NULL, 1, '2018-02-01 15:27:54', 1, '2018-02-01 15:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `scb_candidate_has_parents`
--

CREATE TABLE `scb_candidate_has_parents` (
  `scb_candidate_id_card` varchar(17) NOT NULL,
  `scb_parents_id_card_parent` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_cand_portfolio`
--

CREATE TABLE `scb_cand_portfolio` (
  `port_no` int(11) NOT NULL,
  `candidate_id_card` varchar(17) NOT NULL,
  `scholarship_id` varchar(5) NOT NULL,
  `scholarship_year` int(11) NOT NULL,
  `port_type_id` int(11) NOT NULL,
  `port_name` varchar(50) DEFAULT NULL,
  `port_level` varchar(10) DEFAULT NULL,
  `port_date` datetime DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_comment_project`
--

CREATE TABLE `scb_comment_project` (
  `project_code` varchar(7) NOT NULL,
  `teacher_id_card` varchar(13) NOT NULL,
  `teacher_type` varchar(10) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `comment` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_earn`
--

CREATE TABLE `scb_earn` (
  `student_id` varchar(11) NOT NULL,
  `earn_type_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `earn_date` datetime NOT NULL,
  `earn_amount` double(9,2) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_earn_type`
--

CREATE TABLE `scb_earn_type` (
  `earn_type_id` int(11) NOT NULL,
  `eern_type_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_enroll_scholarship`
--

CREATE TABLE `scb_enroll_scholarship` (
  `candidate_id_card` varchar(17) NOT NULL,
  `scholarship_id` varchar(5) NOT NULL,
  `scholarship_year` int(11) NOT NULL,
  `gpax_4to5` decimal(4,2) DEFAULT NULL,
  `gpa_math4` decimal(4,2) DEFAULT NULL,
  `gpa_math4to5` decimal(4,2) DEFAULT NULL,
  `gpa_chem4` decimal(4,2) DEFAULT NULL,
  `gpa_chem5` decimal(4,2) DEFAULT NULL,
  `gpa_math5` decimal(4,2) DEFAULT NULL,
  `gpa_physic4` decimal(4,2) DEFAULT NULL,
  `gpa_physic5` decimal(4,2) DEFAULT NULL,
  `gpa_sum_chem_physic_math_4to5` decimal(4,2) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_evidence_file`
--

CREATE TABLE `scb_evidence_file` (
  `candidate_id_card` varchar(17) NOT NULL,
  `scholarship_id` varchar(5) NOT NULL,
  `scholarship_year` int(11) NOT NULL,
  `evidence_type_id` int(11) NOT NULL,
  `file_name` varchar(45) DEFAULT NULL,
  `file_status` int(11) DEFAULT NULL,
  `file_comment` varchar(50) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_evidence_type`
--

CREATE TABLE `scb_evidence_type` (
  `evidence_type_id` int(11) NOT NULL,
  `file_type_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_gantt_chart`
--

CREATE TABLE `scb_gantt_chart` (
  `gantt_id` int(11) NOT NULL,
  `student_id` varchar(11) NOT NULL,
  `gantt_name` varchar(45) DEFAULT NULL,
  `gantt_detail` varchar(100) DEFAULT NULL,
  `gantt_date_start` datetime DEFAULT NULL,
  `gantt_date_end` datetime DEFAULT NULL,
  `gantt_deadline` datetime DEFAULT NULL,
  `gantt_status` int(11) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_news`
--

CREATE TABLE `scb_news` (
  `news_id` int(11) NOT NULL,
  `staff_id_card` varchar(13) NOT NULL,
  `news_name` varchar(50) DEFAULT NULL,
  `news_detail` varchar(300) DEFAULT NULL,
  `news_date` datetime DEFAULT NULL,
  `news_ref` varchar(45) DEFAULT NULL,
  `news_image` varchar(45) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_parents`
--

CREATE TABLE `scb_parents` (
  `id_card_parent` varchar(17) NOT NULL,
  `parent_type` varchar(10) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `birth_year` int(11) DEFAULT NULL,
  `highest_education` varchar(10) DEFAULT NULL,
  `occupation` varchar(30) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scb_parents`
--

INSERT INTO `scb_parents` (`id_card_parent`, `parent_type`, `firstname`, `lastname`, `status`, `birth_year`, `highest_education`, `occupation`, `mobile`, `crby`, `crtime`, `udby`, `udtime`) VALUES
('1111111110114', 'นาง', 'test', 'test', '1', NULL, NULL, 'test', '0124444444', NULL, NULL, NULL, NULL),
('1111111111110', 'นาย', 'test', 'test', '1', NULL, NULL, 'test', '0821111111', NULL, NULL, NULL, NULL),
('1111111111111', 'tet', 'tet', 'tete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1111111111112', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1111111111113', 'นาย', 'test', 'test', '1', NULL, NULL, 'test', '0821111111', NULL, NULL, NULL, NULL),
('1111111111114', 'นาง', 'test', 'test', '1', NULL, NULL, 'test', '0124444444', NULL, NULL, NULL, NULL),
('1231211111111', 'null', '', '', '', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
('1231231241241', 'null', '', '', '', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
('1232332222222', 'นาย', 'test', 'test', '1', NULL, NULL, 'test', '12312321', NULL, NULL, NULL, NULL),
('1232333333333', 'นาย', 'test', 'test', '1', NULL, NULL, 'test', '12312321', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scb_port_type`
--

CREATE TABLE `scb_port_type` (
  `port_type_id` int(11) NOT NULL,
  `port_type_name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_progress_report`
--

CREATE TABLE `scb_progress_report` (
  `student_id` varchar(11) NOT NULL,
  `project_code` varchar(7) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `proj_summary` varchar(300) DEFAULT NULL,
  `proj_activity` varchar(300) DEFAULT NULL,
  `proj_factual` varchar(300) DEFAULT NULL,
  `proj_problem` varchar(300) DEFAULT NULL,
  `proj_plan_next_year` varchar(300) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_project`
--

CREATE TABLE `scb_project` (
  `project_code` varchar(7) NOT NULL,
  `project_type_id` int(11) NOT NULL,
  `project_name` varchar(50) DEFAULT NULL,
  `project_level` varchar(10) DEFAULT NULL,
  `project_detail` varchar(300) DEFAULT NULL,
  `project_date` date DEFAULT NULL,
  `project_status` int(11) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_project_has_scb_teacher`
--

CREATE TABLE `scb_project_has_scb_teacher` (
  `project_code` varchar(7) NOT NULL,
  `teacher_id_card` varchar(13) NOT NULL,
  `teacher_type` varchar(10) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_project_type`
--

CREATE TABLE `scb_project_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_scholarship_type`
--

CREATE TABLE `scb_scholarship_type` (
  `scholarship_id` varchar(5) NOT NULL,
  `scholarship_name` varchar(100) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_scholarship_type_has_year`
--

CREATE TABLE `scb_scholarship_type_has_year` (
  `scholarship_id` varchar(5) NOT NULL,
  `scholarship_year` int(11) NOT NULL,
  `scholarship_condition` text,
  `scholarship_file` varchar(255) DEFAULT NULL,
  `scholarship_image` varchar(255) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_scholarship_year`
--

CREATE TABLE `scb_scholarship_year` (
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_select_branch`
--

CREATE TABLE `scb_select_branch` (
  `candidate_id_card` varchar(17) NOT NULL,
  `scholarship_id` varchar(5) NOT NULL,
  `scholarship_year` int(11) NOT NULL,
  `scb_branch_id` int(11) NOT NULL,
  `branch_seq` int(11) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_semester`
--

CREATE TABLE `scb_semester` (
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_staff`
--

CREATE TABLE `scb_staff` (
  `staff_id_card` varchar(13) NOT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_student`
--

CREATE TABLE `scb_student` (
  `student_id` varchar(11) NOT NULL,
  `scholarship_type_id` int(11) DEFAULT NULL,
  `scholarship_year` int(11) DEFAULT NULL,
  `status_edu` int(11) DEFAULT NULL,
  `out_of_scb_status` int(11) DEFAULT NULL,
  `out_of_scb_debt` decimal(8,2) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_student_has_activity_main`
--

CREATE TABLE `scb_student_has_activity_main` (
  `student_id` varchar(11) NOT NULL,
  `activity_main_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `select_activity_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_student_has_project`
--

CREATE TABLE `scb_student_has_project` (
  `student_id` varchar(11) NOT NULL,
  `project_code` varchar(7) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_teacher`
--

CREATE TABLE `scb_teacher` (
  `id_card` varchar(13) NOT NULL,
  `teacher_type` varchar(10) NOT NULL,
  `year` int(11) NOT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_timeline`
--
-- Error reading structure for table eoffice_scb.scb_timeline: #1932 - Table 'eoffice_scb.scb_timeline' doesn't exist in engine
-- Error reading data for table eoffice_scb.scb_timeline: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `eoffice_scb`.`scb_timeline`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `scb_year`
--

CREATE TABLE `scb_year` (
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scb_year_has_semester`
--

CREATE TABLE `scb_year_has_semester` (
  `scb_year_year` int(11) NOT NULL,
  `scb_semester_semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scb_activity_main`
--
ALTER TABLE `scb_activity_main`
  ADD PRIMARY KEY (`act_main_id`,`year`),
  ADD KEY `fk_scb_activity_main_scb_year1_idx` (`year`);

--
-- Indexes for table `scb_address_candidate`
--
ALTER TABLE `scb_address_candidate`
  ADD PRIMARY KEY (`address_type`,`scb_candidate_id_card`),
  ADD KEY `fk_scb_address_candidate_scb_candidate_idx` (`scb_candidate_id_card`);

--
-- Indexes for table `scb_address_parent`
--
ALTER TABLE `scb_address_parent`
  ADD PRIMARY KEY (`scb_parents_id_card_parent`);

--
-- Indexes for table `scb_branch`
--
ALTER TABLE `scb_branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `scb_calendar`
--
ALTER TABLE `scb_calendar`
  ADD PRIMARY KEY (`calendar_id`),
  ADD KEY `fk_scb_calendar_scb_staff1_idx` (`staff_id_card`);

--
-- Indexes for table `scb_candidate`
--
ALTER TABLE `scb_candidate`
  ADD PRIMARY KEY (`id_card`);

--
-- Indexes for table `scb_candidate_has_parents`
--
ALTER TABLE `scb_candidate_has_parents`
  ADD PRIMARY KEY (`scb_candidate_id_card`,`scb_parents_id_card_parent`),
  ADD KEY `fk_scb_candidate_has_scb_parents_scb_parents1_idx` (`scb_parents_id_card_parent`),
  ADD KEY `fk_scb_candidate_has_scb_parents_scb_candidate1_idx` (`scb_candidate_id_card`);

--
-- Indexes for table `scb_cand_portfolio`
--
ALTER TABLE `scb_cand_portfolio`
  ADD PRIMARY KEY (`port_no`,`candidate_id_card`,`scholarship_id`,`scholarship_year`),
  ADD KEY `fk_scb_cand_portfolio_scb_port_type1_idx` (`port_type_id`),
  ADD KEY `fk_scb_cand_portfolio_scb_enroll_scholarship1_idx` (`candidate_id_card`,`scholarship_id`,`scholarship_year`);

--
-- Indexes for table `scb_comment_project`
--
ALTER TABLE `scb_comment_project`
  ADD PRIMARY KEY (`project_code`,`teacher_id_card`,`teacher_type`,`year`,`semester`);

--
-- Indexes for table `scb_earn`
--
ALTER TABLE `scb_earn`
  ADD PRIMARY KEY (`student_id`,`earn_type_id`,`year`,`semester`,`earn_date`),
  ADD KEY `fk_scb_student_has_scb_earn_type_scb_earn_type1_idx` (`earn_type_id`),
  ADD KEY `fk_scb_student_has_scb_earn_type_scb_student1_idx` (`student_id`),
  ADD KEY `fk_scb_earn_scb_year_has_semester1_idx` (`year`,`semester`);

--
-- Indexes for table `scb_earn_type`
--
ALTER TABLE `scb_earn_type`
  ADD PRIMARY KEY (`earn_type_id`);

--
-- Indexes for table `scb_enroll_scholarship`
--
ALTER TABLE `scb_enroll_scholarship`
  ADD PRIMARY KEY (`candidate_id_card`,`scholarship_id`,`scholarship_year`),
  ADD KEY `fk_scb_enroll_scholarship_scb_candidate1_idx` (`candidate_id_card`),
  ADD KEY `fk_scb_enroll_scholarship_scb_scholarship_type_has_year1_idx` (`scholarship_id`,`scholarship_year`);

--
-- Indexes for table `scb_evidence_file`
--
ALTER TABLE `scb_evidence_file`
  ADD PRIMARY KEY (`candidate_id_card`,`scholarship_id`,`scholarship_year`,`evidence_type_id`),
  ADD KEY `fk_scb_evidence_file_scb_evidence_type1_idx` (`evidence_type_id`),
  ADD KEY `fk_scb_evidence_file_scb_enroll_scholarship1_idx` (`candidate_id_card`,`scholarship_id`,`scholarship_year`);

--
-- Indexes for table `scb_evidence_type`
--
ALTER TABLE `scb_evidence_type`
  ADD PRIMARY KEY (`evidence_type_id`);

--
-- Indexes for table `scb_gantt_chart`
--
ALTER TABLE `scb_gantt_chart`
  ADD PRIMARY KEY (`gantt_id`),
  ADD KEY `fk_scb_gantt_chart_scb_student1_idx` (`student_id`);

--
-- Indexes for table `scb_news`
--
ALTER TABLE `scb_news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `fk_scb_news_scb_staff1_idx` (`staff_id_card`);

--
-- Indexes for table `scb_parents`
--
ALTER TABLE `scb_parents`
  ADD PRIMARY KEY (`id_card_parent`);

--
-- Indexes for table `scb_port_type`
--
ALTER TABLE `scb_port_type`
  ADD PRIMARY KEY (`port_type_id`);

--
-- Indexes for table `scb_progress_report`
--
ALTER TABLE `scb_progress_report`
  ADD PRIMARY KEY (`student_id`,`project_code`,`year`,`semester`);

--
-- Indexes for table `scb_project`
--
ALTER TABLE `scb_project`
  ADD PRIMARY KEY (`project_code`),
  ADD KEY `fk_scb_project_scb_project_type1_idx` (`project_type_id`);

--
-- Indexes for table `scb_project_has_scb_teacher`
--
ALTER TABLE `scb_project_has_scb_teacher`
  ADD PRIMARY KEY (`project_code`,`teacher_id_card`,`teacher_type`,`year`,`semester`),
  ADD KEY `fk_scb_project_has_scb_teacher_scb_teacher1_idx` (`teacher_id_card`,`teacher_type`),
  ADD KEY `fk_scb_project_has_scb_teacher_scb_project1_idx` (`project_code`),
  ADD KEY `fk_scb_project_has_scb_teacher_scb_year_has_semester1_idx` (`year`,`semester`);

--
-- Indexes for table `scb_project_type`
--
ALTER TABLE `scb_project_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `scb_scholarship_type`
--
ALTER TABLE `scb_scholarship_type`
  ADD PRIMARY KEY (`scholarship_id`);

--
-- Indexes for table `scb_scholarship_type_has_year`
--
ALTER TABLE `scb_scholarship_type_has_year`
  ADD PRIMARY KEY (`scholarship_id`,`scholarship_year`),
  ADD KEY `fk_scb_scholarship_type_has_scb_scholarship_year_scb_schola_idx` (`scholarship_year`),
  ADD KEY `fk_scb_scholarship_type_has_year_scb_scholarship_type1_idx` (`scholarship_id`);

--
-- Indexes for table `scb_scholarship_year`
--
ALTER TABLE `scb_scholarship_year`
  ADD PRIMARY KEY (`year`);

--
-- Indexes for table `scb_select_branch`
--
ALTER TABLE `scb_select_branch`
  ADD PRIMARY KEY (`candidate_id_card`,`scholarship_id`,`scholarship_year`,`scb_branch_id`),
  ADD KEY `fk_scb_select_branch_scb_branch1_idx` (`scb_branch_id`),
  ADD KEY `fk_scb_select_branch_scb_enroll_scholarship1_idx` (`candidate_id_card`,`scholarship_id`,`scholarship_year`);

--
-- Indexes for table `scb_semester`
--
ALTER TABLE `scb_semester`
  ADD PRIMARY KEY (`semester`);

--
-- Indexes for table `scb_staff`
--
ALTER TABLE `scb_staff`
  ADD PRIMARY KEY (`staff_id_card`);

--
-- Indexes for table `scb_student`
--
ALTER TABLE `scb_student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `scb_student_has_activity_main`
--
ALTER TABLE `scb_student_has_activity_main`
  ADD PRIMARY KEY (`student_id`,`activity_main_id`,`year`),
  ADD KEY `fk_scb_student_has_scb_activity_main_scb_activity_main1_idx` (`activity_main_id`,`year`),
  ADD KEY `fk_scb_student_has_scb_activity_main_scb_student1_idx` (`student_id`);

--
-- Indexes for table `scb_student_has_project`
--
ALTER TABLE `scb_student_has_project`
  ADD PRIMARY KEY (`student_id`,`project_code`,`year`,`semester`),
  ADD KEY `fk_scb_student_has_scb_project_scb_project1_idx` (`project_code`),
  ADD KEY `fk_scb_student_has_scb_project_scb_student1_idx` (`student_id`),
  ADD KEY `fk_scb_student_has_project_scb_year_has_semester1_idx` (`year`,`semester`);

--
-- Indexes for table `scb_teacher`
--
ALTER TABLE `scb_teacher`
  ADD PRIMARY KEY (`id_card`,`teacher_type`),
  ADD KEY `fk_scb_teacher_scb_year1_idx` (`year`);

--
-- Indexes for table `scb_year`
--
ALTER TABLE `scb_year`
  ADD PRIMARY KEY (`year`);

--
-- Indexes for table `scb_year_has_semester`
--
ALTER TABLE `scb_year_has_semester`
  ADD PRIMARY KEY (`scb_year_year`,`scb_semester_semester`),
  ADD KEY `fk_scb_year_has_scb_semester_scb_semester1_idx` (`scb_semester_semester`),
  ADD KEY `fk_scb_year_has_scb_semester_scb_year1_idx` (`scb_year_year`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `scb_activity_main`
--
ALTER TABLE `scb_activity_main`
  ADD CONSTRAINT `fk_scb_activity_main_scb_year1` FOREIGN KEY (`year`) REFERENCES `scb_year` (`year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_address_candidate`
--
ALTER TABLE `scb_address_candidate`
  ADD CONSTRAINT `fk_scb_address_candidate_scb_candidate` FOREIGN KEY (`scb_candidate_id_card`) REFERENCES `scb_candidate` (`id_card`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_address_parent`
--
ALTER TABLE `scb_address_parent`
  ADD CONSTRAINT `fk_scb_address_parent_scb_parents1` FOREIGN KEY (`scb_parents_id_card_parent`) REFERENCES `scb_parents` (`id_card_parent`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_calendar`
--
ALTER TABLE `scb_calendar`
  ADD CONSTRAINT `fk_scb_calendar_scb_staff1` FOREIGN KEY (`staff_id_card`) REFERENCES `scb_staff` (`staff_id_card`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_candidate_has_parents`
--
ALTER TABLE `scb_candidate_has_parents`
  ADD CONSTRAINT `fk_scb_candidate_has_scb_parents_scb_candidate1` FOREIGN KEY (`scb_candidate_id_card`) REFERENCES `scb_candidate` (`id_card`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_candidate_has_scb_parents_scb_parents1` FOREIGN KEY (`scb_parents_id_card_parent`) REFERENCES `scb_parents` (`id_card_parent`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_cand_portfolio`
--
ALTER TABLE `scb_cand_portfolio`
  ADD CONSTRAINT `fk_scb_cand_portfolio_scb_enroll_scholarship1` FOREIGN KEY (`candidate_id_card`,`scholarship_id`,`scholarship_year`) REFERENCES `scb_enroll_scholarship` (`candidate_id_card`, `scholarship_id`, `scholarship_year`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_cand_portfolio_scb_port_type1` FOREIGN KEY (`port_type_id`) REFERENCES `scb_port_type` (`port_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_comment_project`
--
ALTER TABLE `scb_comment_project`
  ADD CONSTRAINT `fk_scb_comment_project_scb_project_has_scb_teacher1` FOREIGN KEY (`project_code`,`teacher_id_card`,`teacher_type`,`year`,`semester`) REFERENCES `scb_project_has_scb_teacher` (`project_code`, `teacher_id_card`, `teacher_type`, `year`, `semester`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_earn`
--
ALTER TABLE `scb_earn`
  ADD CONSTRAINT `fk_scb_earn_scb_year_has_semester1` FOREIGN KEY (`year`,`semester`) REFERENCES `scb_year_has_semester` (`scb_year_year`, `scb_semester_semester`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_student_has_scb_earn_type_scb_earn_type1` FOREIGN KEY (`earn_type_id`) REFERENCES `scb_earn_type` (`earn_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_student_has_scb_earn_type_scb_student1` FOREIGN KEY (`student_id`) REFERENCES `scb_student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_enroll_scholarship`
--
ALTER TABLE `scb_enroll_scholarship`
  ADD CONSTRAINT `fk_scb_enroll_scholarship_scb_candidate1` FOREIGN KEY (`candidate_id_card`) REFERENCES `scb_candidate` (`id_card`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_enroll_scholarship_scb_scholarship_type_has_year1` FOREIGN KEY (`scholarship_id`,`scholarship_year`) REFERENCES `scb_scholarship_type_has_year` (`scholarship_id`, `scholarship_year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_evidence_file`
--
ALTER TABLE `scb_evidence_file`
  ADD CONSTRAINT `fk_scb_evidence_file_scb_enroll_scholarship1` FOREIGN KEY (`candidate_id_card`,`scholarship_id`,`scholarship_year`) REFERENCES `scb_enroll_scholarship` (`candidate_id_card`, `scholarship_id`, `scholarship_year`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_evidence_file_scb_evidence_type1` FOREIGN KEY (`evidence_type_id`) REFERENCES `scb_evidence_type` (`evidence_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_gantt_chart`
--
ALTER TABLE `scb_gantt_chart`
  ADD CONSTRAINT `fk_scb_gantt_chart_scb_student1` FOREIGN KEY (`student_id`) REFERENCES `scb_student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_news`
--
ALTER TABLE `scb_news`
  ADD CONSTRAINT `fk_scb_news_scb_staff1` FOREIGN KEY (`staff_id_card`) REFERENCES `scb_staff` (`staff_id_card`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_progress_report`
--
ALTER TABLE `scb_progress_report`
  ADD CONSTRAINT `fk_scb_progress_report_scb_student_has_project1` FOREIGN KEY (`student_id`,`project_code`,`year`,`semester`) REFERENCES `scb_student_has_project` (`student_id`, `project_code`, `year`, `semester`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_project`
--
ALTER TABLE `scb_project`
  ADD CONSTRAINT `fk_scb_project_scb_project_type1` FOREIGN KEY (`project_type_id`) REFERENCES `scb_project_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_project_has_scb_teacher`
--
ALTER TABLE `scb_project_has_scb_teacher`
  ADD CONSTRAINT `fk_scb_project_has_scb_teacher_scb_project1` FOREIGN KEY (`project_code`) REFERENCES `scb_project` (`project_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_project_has_scb_teacher_scb_teacher1` FOREIGN KEY (`teacher_id_card`,`teacher_type`) REFERENCES `scb_teacher` (`id_card`, `teacher_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_project_has_scb_teacher_scb_year_has_semester1` FOREIGN KEY (`year`,`semester`) REFERENCES `scb_year_has_semester` (`scb_year_year`, `scb_semester_semester`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_scholarship_type_has_year`
--
ALTER TABLE `scb_scholarship_type_has_year`
  ADD CONSTRAINT `fk_scb_scholarship_type_has_scb_scholarship_year_scb_scholars2` FOREIGN KEY (`scholarship_year`) REFERENCES `scb_scholarship_year` (`year`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_scholarship_type_has_year_scb_scholarship_type1` FOREIGN KEY (`scholarship_id`) REFERENCES `scb_scholarship_type` (`scholarship_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_select_branch`
--
ALTER TABLE `scb_select_branch`
  ADD CONSTRAINT `fk_scb_select_branch_scb_branch1` FOREIGN KEY (`scb_branch_id`) REFERENCES `scb_branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_select_branch_scb_enroll_scholarship1` FOREIGN KEY (`candidate_id_card`,`scholarship_id`,`scholarship_year`) REFERENCES `scb_enroll_scholarship` (`candidate_id_card`, `scholarship_id`, `scholarship_year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_student_has_activity_main`
--
ALTER TABLE `scb_student_has_activity_main`
  ADD CONSTRAINT `fk_scb_student_has_scb_activity_main_scb_activity_main1` FOREIGN KEY (`activity_main_id`,`year`) REFERENCES `scb_activity_main` (`act_main_id`, `year`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_student_has_scb_activity_main_scb_student1` FOREIGN KEY (`student_id`) REFERENCES `scb_student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_student_has_project`
--
ALTER TABLE `scb_student_has_project`
  ADD CONSTRAINT `fk_scb_student_has_project_scb_year_has_semester1` FOREIGN KEY (`year`,`semester`) REFERENCES `scb_year_has_semester` (`scb_year_year`, `scb_semester_semester`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_student_has_scb_project_scb_project1` FOREIGN KEY (`project_code`) REFERENCES `scb_project` (`project_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_student_has_scb_project_scb_student1` FOREIGN KEY (`student_id`) REFERENCES `scb_student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_teacher`
--
ALTER TABLE `scb_teacher`
  ADD CONSTRAINT `fk_scb_teacher_scb_year1` FOREIGN KEY (`year`) REFERENCES `scb_year` (`year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scb_year_has_semester`
--
ALTER TABLE `scb_year_has_semester`
  ADD CONSTRAINT `fk_scb_year_has_scb_semester_scb_semester1` FOREIGN KEY (`scb_semester_semester`) REFERENCES `scb_semester` (`semester`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_scb_year_has_scb_semester_scb_year1` FOREIGN KEY (`scb_year_year`) REFERENCES `scb_year` (`year`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
