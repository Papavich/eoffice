-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2018 at 01:06 PM
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
-- Database: `eoffice_ta`
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
('01', '2/2560', '2560', '322437', 1, 20, '2', 2, NULL, 20, NULL, NULL, NULL, NULL),
('01', '2/2560', '2560', '342131', 1, 60, '2', 2, NULL, 60, NULL, NULL, NULL, NULL),
('01', '2/2560', '2560', '342233', 1, 37, '2', 2, NULL, 36, NULL, NULL, NULL, NULL),
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
('1224500006600', '01', '2/2560', '2560', '322131', 1),
('1224500006600', '01', '2/2560', '2560', '342131', 1),
('1224500006600', '02', '2/2560', '2560', '342131', 1),
('1224500006600', '03', '2/2560', '2560', '322131', 1),
('1224500006600', '03', '2/2560', '2560', '342131', 1),
('1224500006600', '04', '2/2560', '2560', '342131', 1),
('1224500006655', '01', '2/2560', '2560', '342233', 1),
('1224500006655', '02', '2/2560', '2560', '342233', 1),
('1224500006655', '03', '2/2560', '2560', '342233', 1),
('1234500006654', '01', '2/2560', '2560', '322437', 1),
('1234500006654', '02', '2/2560', '2560', '322437', 1);

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
('1224500006600', '', 'อ.ดร.', 'สุมณฑา', 'เกษมวิลาศ', NULL, NULL, NULL, NULL, 'LV3', 1),
('1224500006655', '', 'อ.ดร.', 'มัลลิกา', 'วัฒนะ', NULL, NULL, NULL, NULL, 'LV3', 1),
('1234500006654', '', 'ผศ.ดร.', 'ธีระยุทธ', 'ทองเครือ', NULL, NULL, NULL, NULL, 'LV3', 1),
('1433333233456', '', 'นางสาว', 'วทัชชา', 'สุริสาน', NULL, NULL, NULL, NULL, 'LV1', 3),
('1479900299285', '', 'นางสาว', 'ธัญญาภรณ์', 'สุขขาว', NULL, NULL, NULL, NULL, 'LV1', 3),
('1487799564230', '', 'นางสาว', 'ดุจนภา', 'ชื่นปรีชา', NULL, NULL, NULL, NULL, 'LV1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ta_assess`
--

CREATE TABLE `ta_assess` (
  `assess_person` varchar(15) NOT NULL,
  `ta_id` varchar(15) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `term` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `assessment_id` varchar(30) NOT NULL,
  `section` varchar(10) DEFAULT NULL,
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
  `assessment_id` varchar(30) NOT NULL,
  `assess_person` varchar(15) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `ta_id` varchar(15) NOT NULL,
  `section` varchar(10) DEFAULT NULL,
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
(15, 'Wload', NULL, 'main', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ta_comment`
--

CREATE TABLE `ta_comment` (
  `ta_comment_id` int(11) NOT NULL,
  `ta_comment_text` varchar(1000) DEFAULT NULL,
  `ta_comment_feeling` varchar(200) DEFAULT NULL,
  `person_id` varchar(15) DEFAULT NULL,
  `subject` varchar(10) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL,
  `ta_status_id` varchar(15) DEFAULT NULL,
  `term` varchar(10) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
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
-- Table structure for table `ta_inbox`
--

CREATE TABLE `ta_inbox` (
  `ta_inbox_ta_inbox` int(11) NOT NULL,
  `ta_inbox_title` varchar(500) DEFAULT NULL,
  `ta_inbox_massage` varchar(1000) DEFAULT NULL,
  `ta_inbox_url` varchar(200) DEFAULT NULL,
  `type_user` int(11) DEFAULT NULL,
  `ta_status_id` varchar(15) DEFAULT NULL,
  `subject` varchar(10) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_inbox_files`
--

CREATE TABLE `ta_inbox_files` (
  `ta_inbox_file_id` int(11) NOT NULL,
  `ta_inbox_id` int(11) DEFAULT NULL,
  `ta_files_path` varchar(200) DEFAULT NULL,
  `ta_status_id` varchar(15) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_inbox_user`
--

CREATE TABLE `ta_inbox_user` (
  `ta_inbox_user_id` int(11) NOT NULL,
  `ta_inbox_id` int(11) DEFAULT NULL,
  `ta_status_id` varchar(15) DEFAULT NULL,
  `person_id` varchar(15) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_language_ability`
--

CREATE TABLE `ta_language_ability` (
  `ta_language_abi_id` int(11) NOT NULL,
  `person_id` varchar(15) DEFAULT NULL,
  `ta_type_language_id` int(11) DEFAULT NULL,
  `listen` varchar(45) DEFAULT NULL,
  `speaking` varchar(45) DEFAULT NULL,
  `writing` varchar(45) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `type_id` int(11) DEFAULT NULL,
  `ta_status` varchar(15) DEFAULT NULL,
  `crby` int(11) DEFAULT NULL,
  `crtime` datetime DEFAULT NULL,
  `udby` int(11) DEFAULT NULL,
  `udtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_news`
--

INSERT INTO `ta_news` (`ta_news_id`, `ta_news_name`, `ta_news_detail`, `ta_news_img`, `ta_news_imgs`, `ta_news_url`, `ta_documents_id`, `type_id`, `ta_status`, `crby`, `crtime`, `udby`, `udtime`) VALUES
(6, 'แจ้งผู้ช่วยสอนฯ ทุกท่าน', 'รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียดรายละเอียดรายละเอียดรายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียดรายละเอียดรายละเอียดรายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียดรายละเอียดรายละเอียดรายละเอียด', 'bnk48.jpg', 'IMG_399422.jpg', '', 2, 3, 'RG-CH', NULL, NULL, NULL, NULL),
(12, 'ประกาศ2', 'รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด', 'zomo.jpg', 'amazing-hd-city-image.jpg', '', 2, 2, 'RG-CH', NULL, NULL, NULL, NULL),
(13, 'เริ่มปฏิบัติงานได้ตั้วแต่วันที่ 31 กรกฏาคม 2560 และจัดทำแบบบันทึกการปฏิบัติงาน (TA-06)', '  รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด', 'Pink48.jpg', 'amazing-hd-city-image.jpg', '', 1, 2, 'PROP-FAIL', NULL, NULL, NULL, NULL),
(14, 'เริ่มปฏิบัติงานได้ตั้วแต่วันที่ 31 กรกฏาคม 2560 และจัดทำแบบบันทึกการปฏิบัติงาน (TA-06)', 'รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด', '1274-thewallpaper.jpg', 'maxresdefault (1).jpg', '', 1, 1, 'RG-FCH', NULL, NULL, NULL, NULL),
(15, 'เริ่มปฏิบัติงานได้ตั้วแต่วันที่ 31 กรกฏาคม 2560  และจัดทำแบบบันทึกการปฏิบัติงาน (TA-06) ', 'รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด', 'wpnature.com-natural-force-going-city-mini-town-toys-street-car-nature-leaves-holiday-full-hd-wallpaper.jpg', '761147_rain-desktop-backgrounds-wallpapers-nature-wallpapers-ngantukan-com_2560x1920_h.jpg,autumn_river_sky_nature_91356_1920x1080.jpg', '', 5, 4, 'RG-FCH', NULL, NULL, NULL, NULL),
(16, 'เริ่มปฏิบัติงานได้ตั้วแต่วันที่ 31 กรกฏาคม 2560 และจัดทำแบบบันทึกการปฏิบัติงาน (TA-06)', 'รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด', 'maxresdefault.jpg', 'maxresdefault.jpg', '', 1, 1, 'PROP-FAIL', NULL, NULL, NULL, NULL),
(17, 'ประกาศ2', 'รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด รายละเอียด', 'Pink48.jpg', 'aplli.png,Barbie-Pink-Folder-Work.png', '', 2, 5, 'RG-TA', NULL, NULL, NULL, NULL);

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
(' ', 'ว่าง', '1 space', NULL, NULL, NULL, NULL, NULL),
('%', 'ร้อยละ', NULL, NULL, NULL, NULL, NULL, NULL),
('(', 'วงเล็บเปิด', '', NULL, NULL, NULL, NULL, NULL),
(')', 'วงเล็บปิด', '', NULL, NULL, NULL, NULL, NULL),
('*', 'คูณ', 'รวมค่าหลายเท่า', NULL, NULL, NULL, NULL, NULL),
('+', 'บวก', 'รวมค่า', NULL, NULL, NULL, NULL, NULL),
('-', 'ลบ', 'ผลต่าง', NULL, NULL, NULL, NULL, NULL),
('/', 'หาร', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ta_payment`
--

CREATE TABLE `ta_payment` (
  `subject_id` varchar(10) NOT NULL,
  `person_id` varchar(15) NOT NULL,
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
('342131', '1479900299285', '2/2560', '2560', 'RG-TA', '', '5555555555', '', '', 10, '2018-01-19 10:22:53', NULL, NULL),
('342233', '1479900299285', '2/2560', '2560', 'RG-CH', '55555555555555555555', '', '', '', NULL, NULL, NULL, NULL),
('342233', '1487799564230', '2/2560', '2560', 'RG-TA', '55555555555555555555', '', '', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ta_register_section`
--

CREATE TABLE `ta_register_section` (
  `section` varchar(10) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `person_id` varchar(15) NOT NULL,
  `term_id` varchar(10) NOT NULL,
  `year_id` varchar(10) NOT NULL,
  `ta_payment_sec` decimal(9,2) DEFAULT NULL,
  `ta_pay_max_sec` decimal(9,2) DEFAULT NULL,
  `ta_status_id` varchar(15) DEFAULT NULL,
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
  `person_id` varchar(15) NOT NULL,
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

INSERT INTO `ta_request` (`person_id`, `subject_id`, `term_id`, `year`, `degree_bachelor`, `degree_master`, `degree_doctorate`, `amount_ta_all`, `request_note`, `property_grade`, `property_text`, `ta_type_work_id`, `ta_status_id`, `crby`, `crtime`, `udby`, `udtime`) VALUES
('1224500006600', '342131', '2/2560', '2560', 9, NULL, NULL, NULL, '', 'B', '', 'C&L', 'RQ-TA', NULL, '2018-01-24 08:39:10', NULL, NULL),
('1224500006655', '342233', '2/2560', '2560', 4, 0, 0, NULL, '', '2', '', 'L', 'RQ-TA', 14, '2018-01-30 11:15:01', NULL, NULL);

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
(1, 'หาภาระงาน', 'หาภาระงานของปี2560', 1, NULL, NULL, NULL, NULL, NULL),
(2, 'คิดหน่วยกิต', 'คิดหน่วยกิตของปี2560', 2, '1', NULL, NULL, NULL, NULL);

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
(12, '/cs-e-office/web/eoffice_ta/teacher/choose-ta', 'คัดเลือกผู้ช่วยสอน8', '2018-02-01 00:00:00', '2018-02-21 00:00:00', '', 'CHO-TA', '1/2560', '2560', '1', NULL, NULL, NULL, NULL);

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
-- Table structure for table `ta_type_language`
--

CREATE TABLE `ta_type_language` (
  `ta_type_language_id` int(11) NOT NULL,
  `ta_type_language_name_th` varchar(50) DEFAULT NULL,
  `ta_type_language_name_en` varchar(50) DEFAULT NULL,
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
(2, 'หน่วยกิต', NULL, NULL, NULL, NULL, NULL);

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
  `term_id` varchar(10) NOT NULL,
  `year_id` varchar(10) NOT NULL,
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
  ADD KEY `fk_teacher_st01` (`teacher_id`),
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
  ADD PRIMARY KEY (`assess_person`,`ta_id`,`subject_id`,`term`,`year`,`assessment_id`),
  ADD KEY `fk_assessment_ass2_idx` (`assessment_id`),
  ADD KEY `fk_person_ass2_idx` (`assess_person`),
  ADD KEY `fk_subj_ass2_idx` (`subject_id`),
  ADD KEY `fk_sec_ass2_idx` (`section`),
  ADD KEY `fk_ta_id_ass2_idx` (`ta_id`),
  ADD KEY `fk_term_ass2_idx` (`term`),
  ADD KEY `fk_year_ass2_idx` (`year`);

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
  ADD PRIMARY KEY (`topic_ass_id`,`assessment_id`,`assess_person`,`ta_id`,`term`,`year`,`subject_id`),
  ADD KEY `fk_topic_ass3_idx` (`topic_ass_id`),
  ADD KEY `fk_assessment_ass3_idx` (`assessment_id`),
  ADD KEY `fk_assess_person_ass3_idx` (`assess_person`),
  ADD KEY `fk_ta_ass3_idx` (`ta_id`),
  ADD KEY `fk_sec_ass3_idx` (`section`),
  ADD KEY `fk_subj_ass3_idx` (`subject_id`),
  ADD KEY `fk_term_ass3_idx` (`term`),
  ADD KEY `fk_year_ass3_idx` (`year`);

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
  ADD KEY `fk_section_comment1_idx` (`section`),
  ADD KEY `fk_per_comment1_idx` (`person_id`),
  ADD KEY `fk_term_comment1_idx` (`term`),
  ADD KEY `fk_year_comment1_idx` (`year`),
  ADD KEY `fk_subj_comment1_idx` (`subject`);

--
-- Indexes for table `ta_comparison_grade`
--
ALTER TABLE `ta_comparison_grade`
  ADD PRIMARY KEY (`person_id`,`subject_id`,`term`,`year`),
  ADD KEY `fk_status_cg1_idx` (`ta_status_id`),
  ADD KEY `fk_subj_cg1_idx` (`subject_id`),
  ADD KEY `fk_term_cg1_idx` (`term`),
  ADD KEY `fk_year_cg1_idx` (`year`);

--
-- Indexes for table `ta_documents`
--
ALTER TABLE `ta_documents`
  ADD PRIMARY KEY (`ta_documents_id`);

--
-- Indexes for table `ta_inbox`
--
ALTER TABLE `ta_inbox`
  ADD PRIMARY KEY (`ta_inbox_ta_inbox`),
  ADD KEY `fk_type_user_inb1_idx` (`type_user`),
  ADD KEY `fk_status_inb1_idx` (`ta_status_id`),
  ADD KEY `fk_subj_inb1_idx` (`subject`);

--
-- Indexes for table `ta_inbox_files`
--
ALTER TABLE `ta_inbox_files`
  ADD PRIMARY KEY (`ta_inbox_file_id`),
  ADD KEY `fk_ta_inbox_inb3_idx` (`ta_inbox_id`),
  ADD KEY `fk_status_inb3_idx` (`ta_status_id`);

--
-- Indexes for table `ta_inbox_user`
--
ALTER TABLE `ta_inbox_user`
  ADD PRIMARY KEY (`ta_inbox_user_id`),
  ADD KEY `fk_person_inb2_idx` (`person_id`),
  ADD KEY `fk_status_inb2_idx` (`ta_status_id`),
  ADD KEY `fk_ta_inbox_inb2_idx` (`ta_inbox_id`);

--
-- Indexes for table `ta_language_ability`
--
ALTER TABLE `ta_language_ability`
  ADD PRIMARY KEY (`ta_language_abi_id`),
  ADD KEY `fk_person_langu1_idx` (`person_id`),
  ADD KEY `fk_ta_type_language1_idx` (`ta_type_language_id`);

--
-- Indexes for table `ta_news`
--
ALTER TABLE `ta_news`
  ADD PRIMARY KEY (`ta_news_id`),
  ADD KEY `fk_type_news1_idx` (`type_id`),
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
  ADD KEY `fk_ta_status_bud1_idx` (`ta_status_id`),
  ADD KEY `fk_term_bud1_idx` (`term`),
  ADD KEY `fk_year_bud1_idx` (`year`),
  ADD KEY `fk_person_bud1` (`person_id`);

--
-- Indexes for table `ta_property`
--
ALTER TABLE `ta_property`
  ADD PRIMARY KEY (`ta_property_id`),
  ADD KEY `fk_level_property_idx` (`level_degree`);

--
-- Indexes for table `ta_register`
--
ALTER TABLE `ta_register`
  ADD PRIMARY KEY (`subject_id`,`person_id`,`term`,`year`),
  ADD KEY `fk_person_regis1_idx` (`person_id`),
  ADD KEY `fk_ta_status_regis1_idx` (`ta_status_id`),
  ADD KEY `fk_term_regis1_idx` (`term`),
  ADD KEY `fk_year_regis1_idx` (`year`);

--
-- Indexes for table `ta_register_section`
--
ALTER TABLE `ta_register_section`
  ADD PRIMARY KEY (`subject_id`,`person_id`,`term_id`,`year_id`,`section`),
  ADD KEY `fk_ta_status_regis2_idx` (`ta_status_id`),
  ADD KEY `fk_term_regis2_idx` (`term_id`),
  ADD KEY `fk_subj_regis2_idx` (`section`),
  ADD KEY `fk_year_regis2_idx` (`year_id`),
  ADD KEY `fk_per_regist2` (`person_id`);

--
-- Indexes for table `ta_request`
--
ALTER TABLE `ta_request`
  ADD PRIMARY KEY (`person_id`,`subject_id`,`term_id`,`year`),
  ADD KEY `fk_ta_type_work_req1_idx` (`ta_type_work_id`),
  ADD KEY `fk_ta_status_req1_idx` (`ta_status_id`),
  ADD KEY `fk_person_req1_idx` (`person_id`),
  ADD KEY `fk_term_req1_idx` (`term_id`),
  ADD KEY `fk_year_req1_idx` (`year`),
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
-- Indexes for table `ta_type_language`
--
ALTER TABLE `ta_type_language`
  ADD PRIMARY KEY (`ta_type_language_id`);

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
  ADD PRIMARY KEY (`person_id`,`subject_id`,`term_id`,`year_id`,`ta_type_work_id`),
  ADD KEY `fk_typework_wL1_idx` (`ta_type_work_id`);

--
-- Indexes for table `ta_work_plan`
--
ALTER TABLE `ta_work_plan`
  ADD PRIMARY KEY (`ta_work_plan_id`),
  ADD KEY `fk_status_wp1_idx` (`ta_status_id`),
  ADD KEY `fk_person_wp1_idx` (`person_id`,`subject_id`,`term_id`,`year_id`,`ta_type_work_id`);

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
  MODIFY `ta_calculate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ta_comment`
--
ALTER TABLE `ta_comment`
  MODIFY `ta_comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_documents`
--
ALTER TABLE `ta_documents`
  MODIFY `ta_documents_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ta_inbox`
--
ALTER TABLE `ta_inbox`
  MODIFY `ta_inbox_ta_inbox` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_inbox_files`
--
ALTER TABLE `ta_inbox_files`
  MODIFY `ta_inbox_file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_inbox_user`
--
ALTER TABLE `ta_inbox_user`
  MODIFY `ta_inbox_user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_language_ability`
--
ALTER TABLE `ta_language_ability`
  MODIFY `ta_language_abi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_news`
--
ALTER TABLE `ta_news`
  MODIFY `ta_news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `ta_rule_approach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ta_schedule`
--
ALTER TABLE `ta_schedule`
  MODIFY `ta_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ta_topic_assessment`
--
ALTER TABLE `ta_topic_assessment`
  MODIFY `topic_ass_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_type_language`
--
ALTER TABLE `ta_type_language`
  MODIFY `ta_type_language_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_type_rule`
--
ALTER TABLE `ta_type_rule`
  MODIFY `ta_type_rule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `fk_section_no_st01` FOREIGN KEY (`section_no`,`term_id`,`year_id`,`subject_id`,`subject_version`) REFERENCES `kku30_section` (`section_no`, `term_id`, `year_id`, `subject_id`, `subject_version`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teacher_st01` FOREIGN KEY (`teacher_id`) REFERENCES `person` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_assessment_ass2` FOREIGN KEY (`assessment_id`) REFERENCES `ta_assessment` (`ta_assessment_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_person_ass2` FOREIGN KEY (`assess_person`) REFERENCES `person` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sec_ass2` FOREIGN KEY (`section`) REFERENCES `kku30_section` (`section_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subj_ass2` FOREIGN KEY (`subject_id`) REFERENCES `ta_register` (`subject_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_id_ass2` FOREIGN KEY (`ta_id`) REFERENCES `ta_register` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_term_ass2` FOREIGN KEY (`term`) REFERENCES `ta_register` (`term`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_year_ass2` FOREIGN KEY (`year`) REFERENCES `ta_register` (`year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_assess_person_ass3` FOREIGN KEY (`assess_person`) REFERENCES `ta_assess` (`assess_person`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assessment_ass3` FOREIGN KEY (`assessment_id`) REFERENCES `ta_assess` (`assessment_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sec_ass3` FOREIGN KEY (`section`) REFERENCES `ta_assess` (`section`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subj_ass3` FOREIGN KEY (`subject_id`) REFERENCES `ta_assess` (`subject_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_ass3` FOREIGN KEY (`ta_id`) REFERENCES `ta_assess` (`ta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_term_ass3` FOREIGN KEY (`term`) REFERENCES `ta_assess` (`term`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_topic_ass3` FOREIGN KEY (`topic_ass_id`) REFERENCES `ta_topic_assessment` (`topic_ass_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_year_ass3` FOREIGN KEY (`year`) REFERENCES `ta_assess` (`year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_calculation`
--
ALTER TABLE `ta_calculation`
  ADD CONSTRAINT `fk_rule_by_cal1` FOREIGN KEY (`ta_rule_id`) REFERENCES `ta_rule_approach` (`ta_rule_approach_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_comment`
--
ALTER TABLE `ta_comment`
  ADD CONSTRAINT `fk_per_term_year_comment1` FOREIGN KEY (`person_id`) REFERENCES `ta_register` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_section_comment1` FOREIGN KEY (`section`) REFERENCES `kku30_section` (`section_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_status_comment1` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subj_comment1` FOREIGN KEY (`subject`) REFERENCES `ta_register` (`subject_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_term_comment1` FOREIGN KEY (`term`) REFERENCES `ta_register` (`term`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_year_comment1` FOREIGN KEY (`year`) REFERENCES `ta_register` (`year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_comparison_grade`
--
ALTER TABLE `ta_comparison_grade`
  ADD CONSTRAINT `fk_person_cg1` FOREIGN KEY (`person_id`) REFERENCES `ta_register` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_status_cg1` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subj_cg1` FOREIGN KEY (`subject_id`) REFERENCES `ta_register` (`subject_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_term_cg1` FOREIGN KEY (`term`) REFERENCES `ta_register` (`term`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_year_cg1` FOREIGN KEY (`year`) REFERENCES `ta_register` (`year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_inbox`
--
ALTER TABLE `ta_inbox`
  ADD CONSTRAINT `fk_status_inb1` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subj_inb1` FOREIGN KEY (`subject`) REFERENCES `kku30_subject_open` (`subject_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_type_user_inb1` FOREIGN KEY (`type_user`) REFERENCES `type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_inbox_files`
--
ALTER TABLE `ta_inbox_files`
  ADD CONSTRAINT `fk_status_inb3` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_inbox_inb3` FOREIGN KEY (`ta_inbox_id`) REFERENCES `ta_inbox` (`ta_inbox_ta_inbox`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_inbox_user`
--
ALTER TABLE `ta_inbox_user`
  ADD CONSTRAINT `fk_person_inb2` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_status_inb2` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_inbox_inb2` FOREIGN KEY (`ta_inbox_id`) REFERENCES `ta_inbox` (`ta_inbox_ta_inbox`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_language_ability`
--
ALTER TABLE `ta_language_ability`
  ADD CONSTRAINT `fk_person_langu1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_type_language1` FOREIGN KEY (`ta_type_language_id`) REFERENCES `ta_type_language` (`ta_type_language_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_news`
--
ALTER TABLE `ta_news`
  ADD CONSTRAINT `fk_ta_documents_news1` FOREIGN KEY (`ta_documents_id`) REFERENCES `ta_documents` (`ta_documents_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_status_news1` FOREIGN KEY (`ta_status`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_type_news1` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_person_bud1` FOREIGN KEY (`person_id`) REFERENCES `ta_request` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_status_bud1` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_term_bud1` FOREIGN KEY (`term`) REFERENCES `ta_request` (`term_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_year_bud1` FOREIGN KEY (`year`) REFERENCES `ta_request` (`year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_property`
--
ALTER TABLE `ta_property`
  ADD CONSTRAINT `fk_level_property` FOREIGN KEY (`level_degree`) REFERENCES `level` (`level_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_register`
--
ALTER TABLE `ta_register`
  ADD CONSTRAINT `fk_person_regis1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subject_regis1` FOREIGN KEY (`subject_id`) REFERENCES `kku30_subject_open` (`subject_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_status_regis1` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_term_regis1` FOREIGN KEY (`term`) REFERENCES `kku30_subject_open` (`subopen_semester`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_year_regis1` FOREIGN KEY (`year`) REFERENCES `kku30_subject_open` (`subopen_year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_register_section`
--
ALTER TABLE `ta_register_section`
  ADD CONSTRAINT `fk_per_regist2` FOREIGN KEY (`person_id`) REFERENCES `ta_register` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sec_regis2` FOREIGN KEY (`section`) REFERENCES `kku30_section` (`section_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subj_regis2` FOREIGN KEY (`subject_id`) REFERENCES `kku30_section` (`subject_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_status_regis2` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_term_regis2` FOREIGN KEY (`term_id`) REFERENCES `ta_register` (`term`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_year_regis2` FOREIGN KEY (`year_id`) REFERENCES `ta_register` (`year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_request`
--
ALTER TABLE `ta_request`
  ADD CONSTRAINT `fk_person_req1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subj_req1` FOREIGN KEY (`subject_id`) REFERENCES `kku30_subject_open` (`subject_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_status_req1` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_type_work_req1` FOREIGN KEY (`ta_type_work_id`) REFERENCES `ta_type_work` (`ta_type_work_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_term_req1` FOREIGN KEY (`term_id`) REFERENCES `kku30_subject_open` (`subopen_semester`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_year_req1` FOREIGN KEY (`year`) REFERENCES `kku30_subject_open` (`subopen_year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Constraints for table `ta_work_atone`
--
ALTER TABLE `ta_work_atone`
  ADD CONSTRAINT `fk_status_watone` FOREIGN KEY (`ta_status_id`) REFERENCES `ta_status` (`ta_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ta_wplan_watone` FOREIGN KEY (`ta_work_plan_id`) REFERENCES `ta_work_plan` (`ta_work_plan_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_work_load`
--
ALTER TABLE `ta_work_load`
  ADD CONSTRAINT `fk_person_wL1` FOREIGN KEY (`person_id`,`subject_id`,`term_id`,`year_id`) REFERENCES `ta_register` (`person_id`, `subject_id`, `term`, `year`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_typework_wL1` FOREIGN KEY (`ta_type_work_id`) REFERENCES `ta_type_work` (`ta_type_work_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ta_work_plan`
--
ALTER TABLE `ta_work_plan`
  ADD CONSTRAINT `fk_person_wp1` FOREIGN KEY (`person_id`,`subject_id`,`term_id`,`year_id`,`ta_type_work_id`) REFERENCES `ta_work_load` (`person_id`, `subject_id`, `term_id`, `year_id`, `ta_type_work_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
