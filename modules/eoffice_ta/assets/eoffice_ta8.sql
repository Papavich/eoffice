-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2018 at 01:49 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eoffice_ta8`
--

-- --------------------------------------------------------

--
-- Table structure for table `kku30_section`
--

CREATE TABLE `kku30_section` (
  `section_no` varchar(10) NOT NULL,
  `term_id` varchar(10) NOT NULL,
  `year_id` varchar(10) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `subject_version` int(11) NOT NULL,
  `section_size` int(11) DEFAULT NULL,
  `section_hour` varchar(5) DEFAULT NULL,
  `section_type` int(11) DEFAULT NULL,
  `section_programs_type` varchar(45) DEFAULT NULL,
  `amount_student` int(11) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kku30_section`
--

INSERT INTO `kku30_section` (`section_no`, `term_id`, `year_id`, `subject_id`, `subject_version`, `section_size`, `section_hour`, `section_type`, `section_programs_type`, `amount_student`, `crby`, `crtime`, `udby`, `udtime`) VALUES
('01', '2/2560', '2560', '322131', 1, 62, '2', 2, NULL, 56, NULL, NULL, NULL, NULL),
('01', '2/2560', '2560', '322352', 1, 82, '3', 2, NULL, 75, NULL, NULL, NULL, NULL),
('01', '2/2560', '2560', '322437', 1, 20, '2', 2, NULL, 20, NULL, NULL, NULL, NULL),
('01', '2/2560', '2560', '342131', 1, 60, '2', 2, NULL, 60, NULL, NULL, NULL, NULL),
('01', '2/2560', '2560', '342233', 1, 37, '2', 2, NULL, 36, NULL, NULL, NULL, NULL),
('02', '2/2560', '2560', '322352', 1, 45, '3', 2, NULL, 37, NULL, NULL, NULL, NULL),
('02', '2/2560', '2560', '322437', 1, 20, '2', 2, NULL, 20, NULL, NULL, NULL, NULL),
('02', '2/2560', '2560', '342131', 1, 60, '2', 2, NULL, 52, NULL, NULL, NULL, NULL),
('02', '2/2560', '2560', '342233', 1, 37, '2', 2, NULL, 35, NULL, NULL, NULL, NULL),
('03', '2/2560', '2560', '322131', 1, 55, '2', 2, NULL, 50, NULL, NULL, NULL, NULL),
('03', '2/2560', '2560', '342131', 1, 40, '2', 2, NULL, 38, NULL, NULL, NULL, NULL),
('03', '2/2560', '2560', '342233', 1, 55, '2', 2, NULL, 53, NULL, NULL, NULL, NULL),
('04', '2/2560', '2560', '342131', 1, 40, '2', 2, NULL, 37, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kku30_section_teacher`
--

CREATE TABLE `kku30_section_teacher` (
  `teacher_id` varchar(15) NOT NULL,
  `section_no` varchar(10) NOT NULL,
  `term_id` varchar(10) NOT NULL,
  `year_id` varchar(10) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `subject_version` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kku30_section_teacher`
--

INSERT INTO `kku30_section_teacher` (`teacher_id`, `section_no`, `term_id`, `year_id`, `subject_id`, `subject_version`) VALUES
('1', '01', '2/2560', '2560', '322437', 1),
('1', '02', '2/2560', '2560', '322437', 1),
('1224500006600', '01', '2/2560', '2560', '322131', 1),
('1224500006600', '01', '2/2560', '2560', '342131', 1),
('1224500006600', '02', '2/2560', '2560', '342131', 1),
('1224500006600', '03', '2/2560', '2560', '322131', 1),
('1224500006600', '03', '2/2560', '2560', '342131', 1),
('1224500006600', '04', '2/2560', '2560', '342131', 1),
('1224500006655', '01', '2/2560', '2560', '342233', 1),
('1224500006655', '02', '2/2560', '2560', '342233', 1),
('1224500006655', '03', '2/2560', '2560', '342233', 1),
('6', '01', '2/2560', '2560', '322352', 1),
('6', '02', '2/2560', '2560', '322352', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kku30_subject`
--

CREATE TABLE `kku30_subject` (
  `subject_id` varchar(10) NOT NULL,
  `subject_version` int(11) NOT NULL,
  `subject_namethai` varchar(100) DEFAULT NULL,
  `subject_nameeng` varchar(100) DEFAULT NULL,
  `subject_credit` int(11) DEFAULT NULL,
  `subject_time` varchar(6) DEFAULT NULL,
  `subject_description` mediumtext,
  `subject_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kku30_subject`
--

INSERT INTO `kku30_subject` (`subject_id`, `subject_version`, `subject_namethai`, `subject_nameeng`, `subject_credit`, `subject_time`, `subject_description`, `subject_status`) VALUES
('322131', 1, 'การโต้ตอบระหว่างมนุษย์กับคอมพิวเตอร์', 'HUMAN-COMPUTER INTERACTION', 3, '2-2-5', NULL, 1),
('322352', 1, 'การวิเคราะห์ขั้นตอนวิธี', 'ANALYSIS OF ALGORITHMS', 3, '3-0-6', NULL, 1),
('322437', 1, 'การพัฒนาโปรแกรมประยุกต์บนเว็บด้วยภาษาจาวา', 'JAVA WEB APPLICATION DEVELOPMENT', 3, '2-2-5', NULL, 1),
('342131', 1, 'การโต้ตอบระหว่างมนุษย์กับคอมพิวเตอร์', 'HUMAN-COMPUTER INTERACTION', 3, '2-2-5', NULL, 1),
('342233', 1, 'การวิเคราะห์และออกแบบฐานข้อมูล', 'DATABASE ANALYSIS AND DESIGN', 3, '2-2-5', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kku30_subject_open`
--

CREATE TABLE `kku30_subject_open` (
  `subject_id` varchar(10) NOT NULL,
  `subject_version` int(11) NOT NULL,
  `subopen_semester` varchar(10) NOT NULL,
  `subopen_year` varchar(10) NOT NULL,
  `amount_sec` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kku30_subject_open`
--

INSERT INTO `kku30_subject_open` (`subject_id`, `subject_version`, `subopen_semester`, `subopen_year`, `amount_sec`) VALUES
('322131', 1, '2/2560', '2560', 2),
('322352', 1, '2/2560', '2560', 2),
('322437', 1, '2/2560', '2560', 2),
('342131', 1, '2/2560', '2560', 4),
('342233', 1, '2/2560', '2560', 3);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level_id` varchar(10) NOT NULL,
  `level_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level_id`, `level_name`) VALUES
('LV1', 'ปริญญาตรี'),
('LV2', 'ปริญญาโท'),
('LV3', 'ปริญญาเอก');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` varchar(15) NOT NULL,
  `personcode` varchar(15) NOT NULL,
  `prefix` varchar(15) DEFAULT NULL,
  `fname_th` varchar(45) NOT NULL,
  `lname_th` varchar(45) NOT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `E-mail` varchar(30) DEFAULT NULL,
  `branch_id` varchar(10) DEFAULT NULL,
  `level_id` varchar(10) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `personcode`, `prefix`, `fname_th`, `lname_th`, `gender`, `username`, `E-mail`, `branch_id`, `level_id`, `type_id`) VALUES
('1', '', 'ผศ.ดร.', 'ธีระยุทธ', 'ทองเครือ', NULL, NULL, NULL, NULL, 'LV3', 1),
('1224500006600', '', 'อ.ดร.', 'สุมณฑา', 'เกษมวิลาศ', NULL, NULL, NULL, NULL, 'LV3', 1),
('1224500006655', '', 'อ.ดร.', 'มัลลิกา', 'วัฒนะ', NULL, NULL, NULL, NULL, 'LV3', 1),
('1234500006654', '', 'ผศ.ดร.', 'ธีระยุทธ', 'ทองเครือ', NULL, NULL, NULL, NULL, 'LV3', 1),
('1433333233456', '', 'นางสาว', 'วทัชชา', 'สุริสาน', NULL, NULL, NULL, NULL, 'LV1', 3),
('1479900299285', '', 'นางสาว', 'ธัญญาภรณ์', 'สุขขาว', NULL, NULL, NULL, NULL, 'LV1', 3),
('1487799564230', '', 'นางสาว', 'ดุจนภา', 'ชื่นปรีชา', NULL, NULL, NULL, NULL, 'LV1', 2),
('573020749', '', 'นางสาว', 'เกษศิริ', 'เที่ยงโยธา', NULL, NULL, NULL, NULL, 'LV1', 3),
('6', '', 'ผศ.ดร.', 'สันติ', 'ทินตะนัย', NULL, NULL, NULL, NULL, 'LV3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ta_assess`
--

CREATE TABLE `ta_assess` (
  `assess_person` varchar(15) NOT NULL,
  `ta_assessment_id` varchar(30) NOT NULL,
  `ta_id` varchar(15) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `section` varchar(10) NOT NULL,
  `term` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `assess_comment` varchar(500) DEFAULT NULL,
  `assess_gpa` varchar(50) DEFAULT NULL,
  `amount_absent` varchar(45) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_assessment`
--

CREATE TABLE `ta_assessment` (
  `ta_assessment_id` varchar(30) NOT NULL,
  `ta_assessment_name` varchar(400) DEFAULT NULL,
  `ta_assessment_detail` varchar(500) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `ta_assessment_note` varchar(200) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_assessment_open`
--

CREATE TABLE `ta_assessment_open` (
  `ta_assessment_id` varchar(30) NOT NULL,
  `term` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `active` enum('0','1') DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_assess_detail`
--

CREATE TABLE `ta_assess_detail` (
  `topic_ass_id` int(11) NOT NULL,
  `ta_assessment_id` varchar(30) NOT NULL,
  `assess_person` varchar(15) NOT NULL,
  `ta_id` varchar(15) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `section` varchar(10) NOT NULL,
  `term` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `rating` varchar(45) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_calculation`
--

CREATE TABLE `ta_calculation` (
  `ta_calculate_id` int(11) NOT NULL,
  `symbol` varchar(10) DEFAULT NULL,
  `symbol_value` decimal(9,2) DEFAULT NULL,
  `status_symbol` enum('main','var','op') DEFAULT NULL,
  `ta_rule_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_calculation`
--

INSERT INTO `ta_calculation` (`ta_calculate_id`, `symbol`, `symbol_value`, `status_symbol`, `ta_rule_id`, `order`) VALUES
(1, 'X', NULL, 'main', 2, 1),
(3, '(', NULL, 'op', 2, 1),
(4, '1', '1.00', 'var', 2, 2),
(5, '*', NULL, 'op', 2, 3),
(6, 'A', NULL, 'var', 2, 4),
(7, ')', NULL, 'op', 2, 5),
(8, '+', NULL, 'op', 2, 6),
(9, '(', NULL, 'op', 2, 7),
(10, '0.5', '0.50', 'var', 2, 8),
(11, 'B', NULL, 'var', 2, 10),
(12, ')', NULL, 'op', 2, 11),
(13, '*', NULL, 'op', 2, 9),
(14, '2', NULL, '', NULL, NULL),
(15, 'Wload', NULL, 'main', 1, 1),
(16, 'AmountTA', NULL, 'main', 3, 1),
(17, 'studentAll', NULL, 'var', 3, 2),
(18, 'L', '30.00', 'var', 3, 4),
(19, 'C', '60.00', 'var', 3, 4),
(20, '/', '60.00', 'op', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ta_comment`
--

CREATE TABLE `ta_comment` (
  `ta_comment_id` int(11) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `section` varchar(10) NOT NULL,
  `ta_id` varchar(15) NOT NULL,
  `term` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `ta_comment_text` varchar(1000) DEFAULT NULL,
  `ta_comment_feeling` varchar(200) DEFAULT NULL,
  `ta_status_id` varchar(15) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_comparison_grade`
--

CREATE TABLE `ta_comparison_grade` (
  `ta_comparison_grade_id` int(11) NOT NULL,
  `person_id` varchar(15) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `term` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `ta_status_id` varchar(15) DEFAULT NULL,
  `grade_name` varchar(10) DEFAULT NULL,
  `grade_value` decimal(5,2) DEFAULT NULL,
  `doc_ref` varchar(200) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_documents`
--

CREATE TABLE `ta_documents` (
  `ta_documents_id` int(11) NOT NULL,
  `ta_documents_name` varchar(100) DEFAULT NULL,
  `ta_doc_detail` varchar(500) DEFAULT NULL,
  `ta_documents_path` varchar(200) DEFAULT NULL,
  `ta_doc_status` enum('0','1','2','3') DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_documents`
--

INSERT INTO `ta_documents` (`ta_documents_id`, `ta_documents_name`, `ta_doc_detail`, `ta_documents_path`, `ta_doc_status`, `crby`, `crtime`, `udby`, `udtime`) VALUES
(1, 'TA-01', 'ฟอร์มเอกสารสมัครTA', 'Scope.docx', '2', NULL, NULL, NULL, NULL),
(2, 'TA-02', '   รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'TA-03', '', 'ตารางเรียน ระบบTA.docx', '1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ta_news`
--

CREATE TABLE `ta_news` (
  `ta_news_id` int(11) NOT NULL,
  `ta_news_name` varchar(100) DEFAULT NULL,
  `ta_news_detail` varchar(1000) DEFAULT NULL,
  `ta_news_img` varchar(200) DEFAULT NULL,
  `ta_news_imgs` text,
  `ta_news_url` varchar(200) DEFAULT NULL,
  `ta_documents_id` int(11) DEFAULT NULL,
  `ta_status` varchar(15) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_news_comment`
--

CREATE TABLE `ta_news_comment` (
  `ta_news_comment_id` int(11) NOT NULL,
  `ta_news_comment_text` varchar(1000) DEFAULT NULL,
  `ta_news_comment_img` varchar(200) DEFAULT NULL,
  `ta_news_id` int(11) DEFAULT NULL,
  `ta_status` varchar(15) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_operator`
--

CREATE TABLE `ta_operator` (
  `ta_operator_id` varchar(10) NOT NULL,
  `ta_operator_name` varchar(15) DEFAULT NULL,
  `ta_operator_mean` varchar(200) DEFAULT NULL,
  `ta_operator_detail` varchar(500) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_operator`
--

INSERT INTO `ta_operator` (`ta_operator_id`, `ta_operator_name`, `ta_operator_mean`, `ta_operator_detail`, `crby`, `crtime`, `udby`, `udtime`) VALUES
('%', 'ร้อยละ', NULL, NULL, NULL, NULL, NULL, NULL),
('(', 'วงเล็บเปิด', '', NULL, NULL, NULL, NULL, NULL),
(')', 'วงเล็บปิด', '', NULL, NULL, NULL, NULL, NULL),
('*', 'คูณ', 'รวมค่าหลายเท่า', NULL, NULL, NULL, NULL, NULL),
('+', 'บวก', 'รวมค่า', NULL, NULL, NULL, NULL, NULL),
('-', 'ลบ', 'ผลต่าง', NULL, NULL, NULL, NULL, NULL),
('/', 'หาร', NULL, NULL, NULL, NULL, NULL, NULL),
('NULL', 'ว่าง', '1 space', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ta_payment`
--

CREATE TABLE `ta_payment` (
  `subject_id` varchar(10) NOT NULL,
  `term` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `workload_value` decimal(5,2) DEFAULT NULL,
  `ta_payment` decimal(9,2) DEFAULT NULL,
  `ta_payment_max` decimal(9,2) DEFAULT NULL,
  `ta_course_id` varchar(45) DEFAULT NULL,
  `ta_status_id` varchar(15) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_property`
--

CREATE TABLE `ta_property` (
  `ta_property_id` int(11) NOT NULL,
  `ta_property_name` varchar(5) DEFAULT NULL,
  `ta_property_value` decimal(5,2) DEFAULT NULL,
  `level_degree` varchar(10) DEFAULT NULL,
  `property_detail` varchar(300) DEFAULT NULL,
  `property_gpa` decimal(5,2) DEFAULT NULL,
  `active_status` enum('0','1') DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_property`
--

INSERT INTO `ta_property` (`ta_property_id`, `ta_property_name`, `ta_property_value`, `level_degree`, `property_detail`, `property_gpa`, `active_status`, `crby`, `crtime`, `udby`, `udtime`) VALUES
(5, 'B', '3.00', 'LV3', 'จะต้องมีความประพฤติที่เหมาะสม', '3.00', '1', NULL, '2018-01-17 11:22:22', NULL, '2018-01-17 12:44:09'),
(6, 'C', '2.00', 'LV2', '', '2.50', '1', NULL, '2018-01-17 11:22:48', NULL, '2018-01-17 11:25:49'),
(7, 'A', '4.00', 'LV3', 'เป็นคนดี เป็นคนดี เป็นคนดี เป็นคนดี เป็นคนดี เป็นคนดี เป็นคนดี เป็นคนดี เป็นคนดี', '4.00', '0', NULL, '2018-01-17 11:29:05', NULL, '2018-01-17 11:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `ta_register`
--

CREATE TABLE `ta_register` (
  `subject_id` varchar(10) NOT NULL,
  `person_id` varchar(15) NOT NULL,
  `term` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `ta_status_id` varchar(15) DEFAULT NULL,
  `doc_ref01` varchar(200) DEFAULT NULL,
  `doc_ref02` varchar(200) DEFAULT NULL,
  `doc_ref03` varchar(200) DEFAULT NULL,
  `doc_ref04` varchar(200) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_register`
--

INSERT INTO `ta_register` (`subject_id`, `person_id`, `term`, `year`, `ta_status_id`, `doc_ref01`, `doc_ref02`, `doc_ref03`, `doc_ref04`, `crby`, `crtime`, `udby`, `udtime`) VALUES
('322352', '563020957', '2/2560', '2560', 'RG-TA', '', '', '', '', NULL, '2018-02-16 10:01:44', NULL, '2018-02-16 13:48:06'),
('322352', '573020749', '2/2560', '2560', 'RG-CH', '', '', '', '', NULL, '2018-02-16 10:04:31', NULL, NULL),
('322437', '563020957', '2/2560', '2560', 'RG-TA', '', '', '', '', NULL, '2018-02-16 13:48:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ta_register_section`
--

CREATE TABLE `ta_register_section` (
  `section` varchar(10) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `person_id` varchar(15) NOT NULL,
  `term` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `ta_status` varchar(15) NOT NULL,
  `ta_payment_sec` decimal(9,2) DEFAULT NULL,
  `ta_pay_max_sec` decimal(9,2) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_request`
--

CREATE TABLE `ta_request` (
  `subject_id` varchar(10) NOT NULL,
  `term_id` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `degree_bachelor` int(11) DEFAULT NULL,
  `degree_master` int(11) DEFAULT NULL,
  `degree_doctorate` int(11) DEFAULT NULL,
  `amount_ta_all` int(11) DEFAULT NULL,
  `request_note` varchar(200) DEFAULT NULL,
  `property_grade` varchar(2) DEFAULT NULL,
  `property_text` varchar(200) DEFAULT NULL,
  `ta_type_work_id` varchar(10) DEFAULT NULL,
  `ta_status_id` varchar(15) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_request`
--

INSERT INTO `ta_request` (`subject_id`, `term_id`, `year`, `degree_bachelor`, `degree_master`, `degree_doctorate`, `amount_ta_all`, `request_note`, `property_grade`, `property_text`, `ta_type_work_id`, `ta_status_id`, `crby`, `crtime`, `udby`, `udtime`) VALUES
('322131', '2/2560', '2560', 8, NULL, NULL, NULL, '', 'C', '', 'C&L', 'RQ-TA', 12, '2018-02-12 18:06:23', NULL, NULL),
('322352', '2/2560', '2560', 1, NULL, NULL, NULL, '', '2', 'มีความรับผิดชอบสูง', 'C', 'RQ-TA', 15, '2018-02-15 17:58:28', 15, '2018-02-15 18:09:21'),
('342233', '2/2560', '2560', NULL, NULL, NULL, 4, NULL, NULL, NULL, 'L', 'RQ-TA', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ta_rule_approach`
--

CREATE TABLE `ta_rule_approach` (
  `ta_rule_approach_id` int(11) NOT NULL,
  `ta_rule_approach_name` varchar(200) DEFAULT NULL,
  `ta_rule_approach_detail` varchar(500) DEFAULT NULL,
  `ta_type_rule_id` int(11) DEFAULT NULL,
  `active_statuss` enum('0','1') DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_rule_approach`
--

INSERT INTO `ta_rule_approach` (`ta_rule_approach_id`, `ta_rule_approach_name`, `ta_rule_approach_detail`, `ta_type_rule_id`, `active_statuss`, `crby`, `crtime`, `udby`, `udtime`) VALUES
(1, 'หาภาระงาน', 'หาภาระงานของปี2560', 1, '0', NULL, NULL, NULL, NULL),
(2, 'คิดหน่วยกิต', 'คิดหน่วยกิตของปี2560', 2, '1', NULL, NULL, NULL, NULL),
(3, 'คิดประมาณการจำนวนผู้ช่วยสอน', 'คิดประมาณการจำนวนผู้ช่วยสอน 2560', 3, '1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ta_schedule`
--

CREATE TABLE `ta_schedule` (
  `ta_schedule_id` int(11) NOT NULL,
  `ta_schedule_url` varchar(200) DEFAULT NULL,
  `ta_schedule_title` varchar(500) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `time_end` datetime DEFAULT NULL,
  `ta_schedule_detail` varchar(500) DEFAULT NULL,
  `ta_schedule_type` enum('REQ','REGIS','CHO-TA','CONFIRM-REQ','CONFIRM-TA','WLOAD-TA','WORKING-TA','CHECK-HR','ASSESS-TA','PAYMENT-TA','OTHER') NOT NULL,
  `term` varchar(10) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `active_status` enum('0','1','2') NOT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_schedule`
--

INSERT INTO `ta_schedule` (`ta_schedule_id`, `ta_schedule_url`, `ta_schedule_title`, `time_start`, `time_end`, `ta_schedule_detail`, `ta_schedule_type`, `term`, `year`, `active_status`, `crby`, `crtime`, `udby`, `udtime`) VALUES
(2, '/cs-e-office/web/eoffice_ta/teacher/request-ta', 'ร้องขอผู้ช่วยสอน', '2018-02-01 00:00:00', '2018-02-28 00:00:00', '', 'REQ', '1/2560', '2560', '1', NULL, NULL, NULL, NULL),
(3, '/cs-e-office/web/eoffice_ta/ta-register/index', 'รับสมัครผู้ช่วยสอน', '2018-01-01 00:00:00', '2018-02-28 00:00:00', '', 'REGIS', '1/2560', '2560', '1', NULL, NULL, NULL, NULL),
(4, '/cs-e-office/web/eoffice_ta/ta-work-load/index', 'แจ้งภาระงาน', '0000-00-00 00:00:00', '2018-02-14 00:00:00', '', 'WLOAD-TA', '1/2560', '2560', '1', NULL, NULL, NULL, NULL),
(5, '/cs-e-office/web/eoffice_ta/teacher/choose-ta', 'คัดเลือกผู้ช่วยสอน', '2018-02-01 00:00:00', '2018-02-21 00:00:00', '', 'CHO-TA', '1/2560', '2560', '2', NULL, NULL, NULL, NULL),
(6, '/cs-e-office/web/eoffice_ta/teacher/choose-ta', 'คัดเลือกผู้ช่วยสอน2', '2018-02-01 00:00:00', '2018-02-21 00:00:00', '', 'CHO-TA', '1/2560', '2560', '2', NULL, NULL, NULL, NULL),
(7, '/cs-e-office/web/eoffice_ta/teacher/choose-ta', 'คัดเลือกผู้ช่วยสอน3', '2018-02-01 00:00:00', '2018-02-21 00:00:00', '', 'CHO-TA', '1/2560', '2560', '2', NULL, NULL, NULL, NULL),
(8, '/cs-e-office/web/eoffice_ta/teacher/choose-ta', 'คัดเลือกผู้ช่วยสอน4', '2018-02-01 00:00:00', '2018-02-21 00:00:00', '', 'CHO-TA', '1/2560', '2560', '2', NULL, NULL, NULL, NULL),
(9, '/cs-e-office/web/eoffice_ta/teacher/choose-ta', 'คัดเลือกผู้ช่วยสอน5', '2018-02-01 00:00:00', '2018-02-21 00:00:00', '', 'CHO-TA', '1/2560', '2560', '2', NULL, NULL, NULL, NULL),
(10, '/cs-e-office/web/eoffice_ta/teacher/choose-ta', 'คัดเลือกผู้ช่วยสอน6', '2018-02-01 00:00:00', '2018-02-21 00:00:00', '', 'CHO-TA', '1/2560', '2560', '2', NULL, NULL, NULL, NULL),
(11, '/cs-e-office/web/eoffice_ta/teacher/choose-ta', 'คัดเลือกผู้ช่วยสอน7', '2018-02-01 00:00:00', '2018-02-21 00:00:00', '', 'CHO-TA', '1/2560', '2560', '2', NULL, NULL, NULL, NULL),
(12, '/cs-e-office/web/eoffice_ta/teacher/choose-ta', 'คัดเลือกผู้ช่วยสอน8', '2018-02-01 00:00:00', '2018-02-21 00:00:00', '', 'CHO-TA', '1/2560', '2560', '1', NULL, NULL, NULL, NULL),
(13, '/cs-e-office/web/eoffice_ta/teacher/request-ta1', 'ร้องขอผู้ช่วยสอน', '2018-02-01 00:00:00', '2018-02-28 00:00:00', '', 'REQ', '1/2560', '2560', '1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ta_status`
--

CREATE TABLE `ta_status` (
  `ta_status_id` varchar(15) NOT NULL,
  `ta_status_name` varchar(200) DEFAULT NULL,
  `ta_status_icon` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_status`
--

INSERT INTO `ta_status` (`ta_status_id`, `ta_status_name`, `ta_status_icon`) VALUES
('PROP-FAIL', 'คุณสมบัติไม่ผ่าน', NULL),
('RG-CH', 'ผ่านการคัดเลือก', NULL),
('RG-FCH', 'ไม่ผ่านการคัดเลือก', NULL),
('RG-TA', 'สมัครผู้ช่วยสอน', NULL),
('RQ-FAIL', 'ร้องขอผู้ช่วยสอนไม่ผ่าน', NULL),
('RQ-PASS', 'ร้องขอผู้ช่วยสอนผ่าน', NULL),
('RQ-TA', 'ร้องขอผู้ช่วยสอน', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ta_topic_assessment`
--

CREATE TABLE `ta_topic_assessment` (
  `topic_ass_id` int(11) NOT NULL,
  `topic_ass_name` varchar(400) DEFAULT NULL,
  `assessment_id` varchar(30) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_type_rule`
--

CREATE TABLE `ta_type_rule` (
  `ta_type_rule_id` int(11) NOT NULL,
  `ta_type_rule_name` varchar(300) DEFAULT NULL,
  `ta_type_detail` varchar(500) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_type_rule`
--

INSERT INTO `ta_type_rule` (`ta_type_rule_id`, `ta_type_rule_name`, `ta_type_detail`, `crby`, `crtime`, `udby`, `udtime`) VALUES
(1, 'ภาระงาน', NULL, NULL, NULL, NULL, NULL),
(2, 'หน่วยกิต', NULL, NULL, NULL, NULL, NULL),
(3, 'ประมาณการจำนวนTA', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ta_type_work`
--

CREATE TABLE `ta_type_work` (
  `ta_type_work_id` varchar(10) NOT NULL,
  `ta_type_work_name` varchar(20) DEFAULT NULL,
  `ta_type_work_fullname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_type_work`
--

INSERT INTO `ta_type_work` (`ta_type_work_id`, `ta_type_work_name`, `ta_type_work_fullname`) VALUES
('C', 'Lec', 'บรรยาย'),
('C&L', 'Lec&Lab', 'บรรยายและปฏิบัติการ'),
('L', 'Lab', 'ปฏิบัติการ');

-- --------------------------------------------------------

--
-- Table structure for table `ta_variable`
--

CREATE TABLE `ta_variable` (
  `ta_variable_id` int(11) NOT NULL,
  `ta_variable_name` varchar(45) DEFAULT NULL,
  `ta_variable_mean` varchar(500) DEFAULT NULL,
  `ta_variable_value` decimal(9,2) DEFAULT NULL,
  `ta_variable_detail` varchar(500) DEFAULT NULL,
  `ta_rule_id` int(11) DEFAULT NULL,
  `status_var` enum('var','main') DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_variable`
--

INSERT INTO `ta_variable` (`ta_variable_id`, `ta_variable_name`, `ta_variable_mean`, `ta_variable_value`, `ta_variable_detail`, `ta_rule_id`, `status_var`, `crby`, `crtime`, `udby`, `udtime`) VALUES
(3, 'x', 'จำนวนหน่วยกิตรวม', NULL, NULL, 2, 'main', NULL, NULL, NULL, NULL),
(4, '1', '', '1.00', NULL, 2, 'var', NULL, NULL, NULL, NULL),
(5, 'A', 'บรรยาย', NULL, NULL, 2, 'var', NULL, NULL, NULL, NULL),
(6, '0.5', NULL, '0.50', NULL, 2, 'var', NULL, NULL, NULL, NULL),
(7, 'B', NULL, NULL, NULL, 2, 'var', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ta_workload_teacher`
--

CREATE TABLE `ta_workload_teacher` (
  `ta_wload_teacher_id` varchar(20) NOT NULL,
  `section` varchar(10) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `term` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `ta_type_work_id` varchar(10) NOT NULL,
  `ta_status_id` varchar(15) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `lec_inspect` decimal(5,1) DEFAULT NULL,
  `lect_check_list_std` decimal(5,1) DEFAULT NULL,
  `lec_other` decimal(5,1) DEFAULT NULL,
  `lab_hr` decimal(5,1) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_workload_teacher`
--

INSERT INTO `ta_workload_teacher` (`ta_wload_teacher_id`, `section`, `subject_id`, `term`, `year`, `ta_type_work_id`, `ta_status_id`, `time_start`, `time_end`, `lec_inspect`, `lect_check_list_std`, `lec_other`, `lab_hr`, `crby`, `crtime`, `udby`, `udtime`) VALUES
('W-S01-322352-2/2560', '01', '322352', '2/2560', '2560', 'C', 'RQ-TA', '14:00:00', '17:00:00', '1.0', '1.0', NULL, NULL, NULL, NULL, NULL, NULL),
('W-S01-342233-2/2560', '01', '342233', '2/2560', '2560', 'L', 'RQ-TA', '17:00:00', '19:00:00', NULL, NULL, NULL, '2.0', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ta_work_atone`
--

CREATE TABLE `ta_work_atone` (
  `ta_work_atone_id` int(11) NOT NULL,
  `ta_work_plan_id` int(11) DEFAULT NULL,
  `atone_date` datetime DEFAULT NULL,
  `atone_note` varchar(500) DEFAULT NULL,
  `ta_status_id` varchar(15) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_work_load`
--

CREATE TABLE `ta_work_load` (
  `person_id` varchar(15) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `section` varchar(10) NOT NULL,
  `term` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `ta_type_work_id` varchar(10) NOT NULL,
  `activity_work` varchar(500) DEFAULT NULL,
  `hr_per_week` decimal(5,1) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_work_plan`
--

CREATE TABLE `ta_work_plan` (
  `ta_work_plan_id` int(11) NOT NULL,
  `person_id` varchar(15) DEFAULT NULL,
  `subject_id` varchar(10) DEFAULT NULL,
  `term_id` varchar(10) DEFAULT NULL,
  `year_id` varchar(10) DEFAULT NULL,
  `ta_type_work_id` varchar(10) DEFAULT NULL,
  `ta_work_title` varchar(500) DEFAULT NULL,
  `ta_work_role` varchar(500) DEFAULT NULL,
  `ta_plan_date` datetime DEFAULT NULL,
  `week_name` int(11) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `time_end` datetime DEFAULT NULL,
  `hr_working` decimal(5,2) DEFAULT NULL,
  `ta_working_note` varchar(500) DEFAULT NULL,
  `working_date` datetime DEFAULT NULL,
  `ta_status_id` varchar(15) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `term_id` varchar(10) NOT NULL,
  `term_name` varchar(45) DEFAULT NULL,
  `year` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`term_id`, `term_name`, `year`) VALUES
('1/2560', NULL, '2560'),
('1/2561', NULL, '2561'),
('2/2560', NULL, '2560'),
('3/2560', NULL, '2560');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`) VALUES
(1, 'TEACHER'),
(2, 'STUDENT'),
(3, 'TA'),
(4, 'TEACHER2'),
(5, 'STAFF'),
(6, 'TEACHER3');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_kku30_section`
-- (See below for the actual view)
--
CREATE TABLE `view_kku30_section` (
`section_no` varchar(10)
,`term_id` varchar(10)
,`year_id` varchar(10)
,`subject_id` varchar(10)
,`subject_version` int(11)
,`section_size` int(11)
,`section_hour` varchar(5)
,`section_type` int(11)
,`section_programs_type` varchar(45)
,`amount_student` int(11)
,`crby` int(11)
,`crtime` datetime
,`udby` int(11)
,`udtime` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_kku30_section_teacher`
-- (See below for the actual view)
--
CREATE TABLE `view_kku30_section_teacher` (
`teacher_id` varchar(15)
,`section_no` varchar(10)
,`term_id` varchar(10)
,`year_id` varchar(10)
,`subject_id` varchar(10)
,`subject_version` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_kku30_subject`
-- (See below for the actual view)
--
CREATE TABLE `view_kku30_subject` (
`subject_id` varchar(10)
,`subject_version` int(11)
,`subject_namethai` varchar(100)
,`subject_nameeng` varchar(100)
,`subject_credit` int(11)
,`subject_time` varchar(6)
,`subject_description` mediumtext
,`subject_status` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_kku30_subject_open`
-- (See below for the actual view)
--
CREATE TABLE `view_kku30_subject_open` (
`subject_id` varchar(10)
,`subject_version` int(11)
,`subopen_semester` varchar(10)
,`subopen_year` varchar(10)
,`amount_sec` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `year_id` varchar(10) NOT NULL,
  `year_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`year_id`, `year_name`) VALUES
('2558', NULL),
('2559', NULL),
('2560', NULL),
('2561', NULL);

-- --------------------------------------------------------

--
-- Structure for view `view_kku30_section`
--
DROP TABLE IF EXISTS `view_kku30_section`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kku30_section`  AS  select `kku30_section`.`section_no` AS `section_no`,`kku30_section`.`term_id` AS `term_id`,`kku30_section`.`year_id` AS `year_id`,`kku30_section`.`subject_id` AS `subject_id`,`kku30_section`.`subject_version` AS `subject_version`,`kku30_section`.`section_size` AS `section_size`,`kku30_section`.`section_hour` AS `section_hour`,`kku30_section`.`section_type` AS `section_type`,`kku30_section`.`section_programs_type` AS `section_programs_type`,`kku30_section`.`amount_student` AS `amount_student`,`kku30_section`.`crby` AS `crby`,`kku30_section`.`crtime` AS `crtime`,`kku30_section`.`udby` AS `udby`,`kku30_section`.`udtime` AS `udtime` from `kku30_section` ;

-- --------------------------------------------------------

--
-- Structure for view `view_kku30_section_teacher`
--
DROP TABLE IF EXISTS `view_kku30_section_teacher`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kku30_section_teacher`  AS  select `kku30_section_teacher`.`teacher_id` AS `teacher_id`,`kku30_section_teacher`.`section_no` AS `section_no`,`kku30_section_teacher`.`term_id` AS `term_id`,`kku30_section_teacher`.`year_id` AS `year_id`,`kku30_section_teacher`.`subject_id` AS `subject_id`,`kku30_section_teacher`.`subject_version` AS `subject_version` from `kku30_section_teacher` ;

-- --------------------------------------------------------

--
-- Structure for view `view_kku30_subject`
--
DROP TABLE IF EXISTS `view_kku30_subject`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kku30_subject`  AS  select `kku30_subject`.`subject_id` AS `subject_id`,`kku30_subject`.`subject_version` AS `subject_version`,`kku30_subject`.`subject_namethai` AS `subject_namethai`,`kku30_subject`.`subject_nameeng` AS `subject_nameeng`,`kku30_subject`.`subject_credit` AS `subject_credit`,`kku30_subject`.`subject_time` AS `subject_time`,`kku30_subject`.`subject_description` AS `subject_description`,`kku30_subject`.`subject_status` AS `subject_status` from `kku30_subject` ;

-- --------------------------------------------------------

--
-- Structure for view `view_kku30_subject_open`
--
DROP TABLE IF EXISTS `view_kku30_subject_open`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kku30_subject_open`  AS  select `kku30_subject_open`.`subject_id` AS `subject_id`,`kku30_subject_open`.`subject_version` AS `subject_version`,`kku30_subject_open`.`subopen_semester` AS `subopen_semester`,`kku30_subject_open`.`subopen_year` AS `subopen_year`,`kku30_subject_open`.`amount_sec` AS `amount_sec` from `kku30_subject_open` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kku30_section`
--
ALTER TABLE `kku30_section`
  ADD PRIMARY KEY (`section_no`,`term_id`,`year_id`,`subject_id`,`subject_version`),
  ADD KEY `fk_subject_sec1_idx` (`subject_id`,`subject_version`,`term_id`,`year_id`);

--
-- Indexes for table `kku30_section_teacher`
--
ALTER TABLE `kku30_section_teacher`
  ADD PRIMARY KEY (`teacher_id`,`section_no`,`term_id`,`year_id`,`subject_id`,`subject_version`),
  ADD KEY `fk_section_no_st01_idx` (`section_no`,`term_id`,`year_id`,`subject_id`,`subject_version`);

--
-- Indexes for table `kku30_subject`
--
ALTER TABLE `kku30_subject`
  ADD PRIMARY KEY (`subject_id`,`subject_version`);

--
-- Indexes for table `kku30_subject_open`
--
ALTER TABLE `kku30_subject_open`
  ADD PRIMARY KEY (`subject_id`,`subopen_semester`,`subopen_year`,`subject_version`),
  ADD KEY `fk_term_subj_idx` (`subopen_semester`),
  ADD KEY `fk_year_subj_idx` (`subopen_year`),
  ADD KEY `fk_subject_subopen_idx` (`subject_id`,`subject_version`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`,`personcode`),
  ADD KEY `level_fk_person1_idx` (`level_id`),
  ADD KEY `type_fk_per1_idx` (`type_id`);

--
-- Indexes for table `ta_assess`
--
ALTER TABLE `ta_assess`
  ADD PRIMARY KEY (`assess_person`,`ta_assessment_id`,`ta_id`,`subject_id`,`section`,`term`,`year`),
  ADD KEY `fk_person_ass2_idx` (`assess_person`),
  ADD KEY `fk_ta_assess_ta_register_section1_idx` (`section`,`subject_id`,`ta_id`,`term`,`year`),
  ADD KEY `fk_ta_assess_ta_assessment1_idx` (`ta_assessment_id`);

--
-- Indexes for table `ta_assessment`
--
ALTER TABLE `ta_assessment`
  ADD PRIMARY KEY (`ta_assessment_id`),
  ADD KEY `fk_type_assm1_idx` (`type_id`);

--
-- Indexes for table `ta_assessment_open`
--
ALTER TABLE `ta_assessment_open`
  ADD PRIMARY KEY (`ta_assessment_id`,`term`,`year`),
  ADD KEY `fk_ta_assessment_open_ass_idx` (`ta_assessment_id`),
  ADD KEY `fk_term_oass_idx` (`term`,`year`);

--
-- Indexes for table `ta_assess_detail`
--
ALTER TABLE `ta_assess_detail`
  ADD PRIMARY KEY (`topic_ass_id`,`ta_assessment_id`,`assess_person`,`ta_id`,`subject_id`,`section`,`term`,`year`),
  ADD KEY `fk_topic_ass3_idx` (`topic_ass_id`),
  ADD KEY `fk_ta_assess_detail_ta_assess1_idx` (`assess_person`,`ta_assessment_id`,`ta_id`,`subject_id`,`section`,`term`,`year`);

--
-- Indexes for table `ta_calculation`
--
ALTER TABLE `ta_calculation`
  ADD PRIMARY KEY (`ta_calculate_id`),
  ADD KEY `fk_rule_by_cal1_idx` (`ta_rule_id`);

--
-- Indexes for table `ta_comment`
--
ALTER TABLE `ta_comment`
  ADD PRIMARY KEY (`ta_comment_id`),
  ADD KEY `fk_status_comment1_idx` (`ta_status_id`),
  ADD KEY `fk_ta_comment_ta_register_section1_idx` (`section`,`ta_id`,`term`,`year`,`subject_id`);

--
-- Indexes for table `ta_comparison_grade`
--
ALTER TABLE `ta_comparison_grade`
  ADD PRIMARY KEY (`ta_comparison_grade_id`),
  ADD KEY `fk_status_cg1_idx` (`ta_status_id`),
  ADD KEY `fk_ta_comparison_grade_ta_register1` (`subject_id`,`term`,`year`,`person_id`);

--
-- Indexes for table `ta_documents`
--
ALTER TABLE `ta_documents`
  ADD PRIMARY KEY (`ta_documents_id`);

--
-- Indexes for table `ta_news`
--
ALTER TABLE `ta_news`
  ADD PRIMARY KEY (`ta_news_id`),
  ADD KEY `fk_ta_documents_news1_idx` (`ta_documents_id`),
  ADD KEY `fk_ta_status_news1_idx` (`ta_status`);

--
-- Indexes for table `ta_news_comment`
--
ALTER TABLE `ta_news_comment`
  ADD PRIMARY KEY (`ta_news_comment_id`),
  ADD KEY `fk_ta_news_news2_idx` (`ta_news_id`),
  ADD KEY `fk_status_new2_idx` (`ta_status`);

--
-- Indexes for table `ta_operator`
--
ALTER TABLE `ta_operator`
  ADD PRIMARY KEY (`ta_operator_id`);

--
-- Indexes for table `ta_payment`
--
ALTER TABLE `ta_payment`
  ADD PRIMARY KEY (`subject_id`,`term`,`year`),
  ADD KEY `fk_ta_status_bud1_idx` (`ta_status_id`);

--
-- Indexes for table `ta_property`
--
ALTER TABLE `ta_property`
  ADD PRIMARY KEY (`ta_property_id`);

--
-- Indexes for table `ta_register`
--
ALTER TABLE `ta_register`
  ADD PRIMARY KEY (`subject_id`,`term`,`year`,`person_id`),
  ADD KEY `fk_ta_status_regis19_idx` (`ta_status_id`);

--
-- Indexes for table `ta_register_section`
--
ALTER TABLE `ta_register_section`
  ADD PRIMARY KEY (`section`,`subject_id`,`person_id`,`term`,`year`),
  ADD KEY `fk_ta_register_section_ta_status1_idx` (`ta_status`),
  ADD KEY `fk_ta_register_section_ta_register2_idx` (`subject_id`,`term`,`year`,`person_id`);

--
-- Indexes for table `ta_request`
--
ALTER TABLE `ta_request`
  ADD PRIMARY KEY (`subject_id`,`term_id`,`year`),
  ADD KEY `fk_ta_type_work_req1_idx` (`ta_type_work_id`),
  ADD KEY `fk_ta_status_req1_idx` (`ta_status_id`),
  ADD KEY `fk_subj_req1_idx` (`subject_id`);

--
-- Indexes for table `ta_rule_approach`
--
ALTER TABLE `ta_rule_approach`
  ADD PRIMARY KEY (`ta_rule_approach_id`),
  ADD KEY `fk_ta_job_rule_rule1_idx` (`ta_type_rule_id`);

--
-- Indexes for table `ta_schedule`
--
ALTER TABLE `ta_schedule`
  ADD PRIMARY KEY (`ta_schedule_id`),
  ADD KEY `fk_term_scd_idx` (`term`),
  ADD KEY `fk_year_scd_idx` (`year`);

--
-- Indexes for table `ta_status`
--
ALTER TABLE `ta_status`
  ADD PRIMARY KEY (`ta_status_id`);

--
-- Indexes for table `ta_topic_assessment`
--
ALTER TABLE `ta_topic_assessment`
  ADD PRIMARY KEY (`topic_ass_id`),
  ADD KEY `fk_assessment_topic1_idx` (`assessment_id`);

--
-- Indexes for table `ta_type_rule`
--
ALTER TABLE `ta_type_rule`
  ADD PRIMARY KEY (`ta_type_rule_id`);

--
-- Indexes for table `ta_type_work`
--
ALTER TABLE `ta_type_work`
  ADD PRIMARY KEY (`ta_type_work_id`);

--
-- Indexes for table `ta_variable`
--
ALTER TABLE `ta_variable`
  ADD PRIMARY KEY (`ta_variable_id`),
  ADD KEY `fk_rule_by_var1_idx` (`ta_rule_id`);

--
-- Indexes for table `ta_workload_teacher`
--
ALTER TABLE `ta_workload_teacher`
  ADD PRIMARY KEY (`subject_id`,`term`,`year`,`ta_wload_teacher_id`,`section`),
  ADD KEY `fk_ta_workload_teacher_ta_type_work1_idx` (`ta_type_work_id`),
  ADD KEY `fk_ta_workload_teacher_ta_status1_idx` (`ta_status_id`);

--
-- Indexes for table `ta_work_atone`
--
ALTER TABLE `ta_work_atone`
  ADD PRIMARY KEY (`ta_work_atone_id`),
  ADD KEY `fk_ta_wplan_watone_idx` (`ta_work_plan_id`),
  ADD KEY `fk_status_watone_idx` (`ta_status_id`);

--
-- Indexes for table `ta_work_load`
--
ALTER TABLE `ta_work_load`
  ADD PRIMARY KEY (`person_id`,`subject_id`,`section`,`term`,`year`),
  ADD KEY `fk_ta_work_load_ta_type_work1_idx` (`ta_type_work_id`),
  ADD KEY `fk_ta_work_load_ta_register_section1` (`section`);

--
-- Indexes for table `ta_work_plan`
--
ALTER TABLE `ta_work_plan`
  ADD PRIMARY KEY (`ta_work_plan_id`),
  ADD KEY `fk_status_wp1_idx` (`ta_status_id`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`term_id`,`year`),
  ADD KEY `fk_year_term1_idx` (`year`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ta_calculation`
--
ALTER TABLE `ta_calculation`
  MODIFY `ta_calculate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ta_comment`
--
ALTER TABLE `ta_comment`
  MODIFY `ta_comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_comparison_grade`
--
ALTER TABLE `ta_comparison_grade`
  MODIFY `ta_comparison_grade_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_documents`
--
ALTER TABLE `ta_documents`
  MODIFY `ta_documents_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ta_news`
--
ALTER TABLE `ta_news`
  MODIFY `ta_news_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_news_comment`
--
ALTER TABLE `ta_news_comment`
  MODIFY `ta_news_comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_property`
--
ALTER TABLE `ta_property`
  MODIFY `ta_property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ta_rule_approach`
--
ALTER TABLE `ta_rule_approach`
  MODIFY `ta_rule_approach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ta_schedule`
--
ALTER TABLE `ta_schedule`
  MODIFY `ta_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ta_topic_assessment`
--
ALTER TABLE `ta_topic_assessment`
  MODIFY `topic_ass_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_type_rule`
--
ALTER TABLE `ta_type_rule`
  MODIFY `ta_type_rule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ta_variable`
--
ALTER TABLE `ta_variable`
  MODIFY `ta_variable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ta_work_atone`
--
ALTER TABLE `ta_work_atone`
  MODIFY `ta_work_atone_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_work_plan`
--
ALTER TABLE `ta_work_plan`
  MODIFY `ta_work_plan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kku30_section`
--
ALTER TABLE `kku30_section`
  ADD CONSTRAINT `fk_subject_sec1` FOREIGN KEY (`subject_id`,`subject_version`,`term_id`,`year_id`) REFERENCES `kku30_subject_open` (`subject_id`, `subject_version`, `subopen_semester`, `subopen_year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kku30_section_teacher`
--
ALTER TABLE `kku30_section_teacher`
  ADD CONSTRAINT `fk_section_no_st01` FOREIGN KEY (`section_no`,`term_id`,`year_id`,`subject_id`,`subject_version`) REFERENCES `kku30_section` (`section_no`, `term_id`, `year_id`, `subject_id`, `subject_version`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kku30_subject_open`
--
ALTER TABLE `kku30_subject_open`
  ADD CONSTRAINT `fk_subject_subopen` FOREIGN KEY (`subject_id`,`subject_version`) REFERENCES `kku30_subject` (`subject_id`, `subject_version`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_term_subj` FOREIGN KEY (`subopen_semester`) REFERENCES `term` (`term_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_year_subj` FOREIGN KEY (`subopen_year`) REFERENCES `year` (`year_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `level_fk_person` FOREIGN KEY (`level_id`) REFERENCES `level` (`level_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `type_fk_per1` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_assess`
--
ALTER TABLE `ta_assess`
  ADD CONSTRAINT `fk_ta_assess_ta_assessment1` FOREIGN KEY (`ta_assessment_id`) REFERENCES `ta_assessment` (`ta_assessment_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_assess_ta_register_section1` FOREIGN KEY (`section`,`subject_id`,`ta_id`,`term`,`year`) REFERENCES `ta_register_section` (`section`, `subject_id`, `person_id`, `term`, `year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_assessment`
--
ALTER TABLE `ta_assessment`
  ADD CONSTRAINT `fk_type_assm1` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_assessment_open`
--
ALTER TABLE `ta_assessment_open`
  ADD CONSTRAINT `fk_ta_assessment_oass` FOREIGN KEY (`ta_assessment_id`) REFERENCES `ta_assessment` (`ta_assessment_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_term_oass` FOREIGN KEY (`term`,`year`) REFERENCES `term` (`term_id`, `year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_assess_detail`
--
ALTER TABLE `ta_assess_detail`
  ADD CONSTRAINT `fk_ta_assess_detail_ta_assess1` FOREIGN KEY (`assess_person`,`ta_assessment_id`,`ta_id`,`subject_id`,`section`,`term`,`year`) REFERENCES `ta_assess` (`assess_person`, `ta_assessment_id`, `ta_id`, `subject_id`, `section`, `term`, `year`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_topic_ass3` FOREIGN KEY (`topic_ass_id`) REFERENCES `ta_topic_assessment` (`topic_ass_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_calculation`
--
ALTER TABLE `ta_calculation`
  ADD CONSTRAINT `fk_rule_by_cal1` FOREIGN KEY (`ta_rule_id`) REFERENCES `ta_rule_approach` (`ta_rule_approach_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_comment`
--
ALTER TABLE `ta_comment`
  ADD CONSTRAINT `fk_status_comment1` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_comment_ta_register_section1` FOREIGN KEY (`section`) REFERENCES `ta_register_section` (`section`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_comparison_grade`
--
ALTER TABLE `ta_comparison_grade`
  ADD CONSTRAINT `fk_status_cg1` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_comparison_grade_ta_register1` FOREIGN KEY (`subject_id`,`term`,`year`,`person_id`) REFERENCES `ta_register` (`subject_id`, `term`, `year`, `person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_news`
--
ALTER TABLE `ta_news`
  ADD CONSTRAINT `fk_ta_documents_news1` FOREIGN KEY (`ta_documents_id`) REFERENCES `ta_documents` (`ta_documents_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_status_news1` FOREIGN KEY (`ta_status`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_news_comment`
--
ALTER TABLE `ta_news_comment`
  ADD CONSTRAINT `fk_status_new2` FOREIGN KEY (`ta_status`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_news_news2` FOREIGN KEY (`ta_news_id`) REFERENCES `ta_news` (`ta_news_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_payment`
--
ALTER TABLE `ta_payment`
  ADD CONSTRAINT `fk_ta_payment_ta_request1` FOREIGN KEY (`subject_id`,`term`,`year`) REFERENCES `ta_request` (`subject_id`, `term_id`, `year`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_status_bud1` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_register`
--
ALTER TABLE `ta_register`
  ADD CONSTRAINT `fk_ta_status_regis19` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_register_section`
--
ALTER TABLE `ta_register_section`
  ADD CONSTRAINT `fk_ta_register_section_ta_register2` FOREIGN KEY (`subject_id`,`term`,`year`,`person_id`) REFERENCES `ta_register` (`subject_id`, `term`, `year`, `person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_register_section_ta_status1` FOREIGN KEY (`ta_status`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_request`
--
ALTER TABLE `ta_request`
  ADD CONSTRAINT `fk_ta_status_req1` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_type_work_req1` FOREIGN KEY (`ta_type_work_id`) REFERENCES `ta_type_work` (`ta_type_work_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_rule_approach`
--
ALTER TABLE `ta_rule_approach`
  ADD CONSTRAINT `fk_ta_type_rule_rule1` FOREIGN KEY (`ta_type_rule_id`) REFERENCES `ta_type_rule` (`ta_type_rule_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_schedule`
--
ALTER TABLE `ta_schedule`
  ADD CONSTRAINT `fk_term_scd` FOREIGN KEY (`term`) REFERENCES `term` (`term_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_year_scd` FOREIGN KEY (`year`) REFERENCES `term` (`year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_topic_assessment`
--
ALTER TABLE `ta_topic_assessment`
  ADD CONSTRAINT `fk_assessment_topic1` FOREIGN KEY (`assessment_id`) REFERENCES `ta_assessment` (`ta_assessment_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_variable`
--
ALTER TABLE `ta_variable`
  ADD CONSTRAINT `fk_rule_by_var1` FOREIGN KEY (`ta_rule_id`) REFERENCES `ta_rule_approach` (`ta_rule_approach_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_workload_teacher`
--
ALTER TABLE `ta_workload_teacher`
  ADD CONSTRAINT `fk_ta_workload_teacher_ta_request1` FOREIGN KEY (`subject_id`,`term`,`year`) REFERENCES `ta_request` (`subject_id`, `term_id`, `year`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_workload_teacher_ta_status1` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_workload_teacher_ta_type_work1` FOREIGN KEY (`ta_type_work_id`) REFERENCES `ta_type_work` (`ta_type_work_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_work_atone`
--
ALTER TABLE `ta_work_atone`
  ADD CONSTRAINT `fk_status_watone` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_wplan_watone` FOREIGN KEY (`ta_work_plan_id`) REFERENCES `ta_work_plan` (`ta_work_plan_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_work_load`
--
ALTER TABLE `ta_work_load`
  ADD CONSTRAINT `fk_ta_work_load_ta_register_section1` FOREIGN KEY (`section`) REFERENCES `ta_register_section` (`section`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_work_load_ta_type_work1` FOREIGN KEY (`ta_type_work_id`) REFERENCES `ta_type_work` (`ta_type_work_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_work_plan`
--
ALTER TABLE `ta_work_plan`
  ADD CONSTRAINT `fk_status_wp1` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `term`
--
ALTER TABLE `term`
  ADD CONSTRAINT `fk_year_term1` FOREIGN KEY (`year`) REFERENCES `year` (`year_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
