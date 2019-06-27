-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2017 at 04:29 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2usrbac`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('center_index', '1', 1501443267),
('center_index', '4', 1501445268),
('center_index', '5', 1501444578),
('editTest', '2', 1501145044),
('editTest', '3', 1499582847),
('person_Add_System', '1', 1501443218),
('person_Add_System', '4', 1501445260),
('person_Edit_System', '1', 1501443220),
('person_Edit_System', '5', 1501445080),
('ta_system_admin', '1', 1501442461),
('ta_system_student', '4', 1501445263),
('ta_system_teacher', '5', 1501445180),
('viewTest', '2', 1500358079),
('viewTest', '3', 1501145059);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/menu/menu', 2, NULL, NULL, NULL, 1500003677, 1500003677),
('/personsystem/*', 2, NULL, NULL, NULL, 1500955153, 1500955153),
('/personsystem/default/*', 2, NULL, NULL, NULL, 1501440593, 1501440593),
('/personsystem/default/index', 2, NULL, NULL, NULL, 1500966799, 1500966799),
('/personsystem/person/*', 2, NULL, NULL, NULL, 1500966761, 1500966761),
('/personsystem/person/admin_add_staff', 2, NULL, NULL, NULL, 1500966746, 1500966746),
('/personsystem/person/admin_add_student', 2, NULL, NULL, NULL, 1500966746, 1500966746),
('/personsystem/person/admin_add_teacher', 2, NULL, NULL, NULL, 1500966746, 1500966746),
('/personsystem/person/admin_edit_staff', 2, NULL, NULL, NULL, 1500966746, 1500966746),
('/personsystem/person/admin_edit_staff_list', 2, NULL, NULL, NULL, 1500966746, 1500966746),
('/personsystem/person/admin_edit_student', 2, NULL, NULL, NULL, 1500966746, 1500966746),
('/personsystem/person/admin_edit_student_list', 2, NULL, NULL, NULL, 1500966743, 1500966743),
('/personsystem/person/admin_edit_teacher', 2, NULL, NULL, NULL, 1500966746, 1500966746),
('/personsystem/person/admin_edit_teacher_list', 2, NULL, NULL, NULL, 1500966746, 1500966746),
('/personsystem/person/index', 2, NULL, NULL, NULL, 1500966748, 1500966748),
('/tasystem/*', 2, NULL, NULL, NULL, 1501440594, 1501440594),
('/tasystem/default/*', 2, NULL, NULL, NULL, 1501440593, 1501440593),
('/tasystem/default/index', 2, NULL, NULL, NULL, 1501440593, 1501440593),
('/tasystem/ta/*', 2, NULL, NULL, NULL, 1501440593, 1501440593),
('/tasystem/ta/assessment', 2, NULL, NULL, NULL, 1501440593, 1501440593),
('/tasystem/ta/index', 2, NULL, NULL, NULL, 1501440593, 1501440593),
('/tasystem/ta/regista', 2, NULL, NULL, NULL, 1501440593, 1501440593),
('/tasystem/ta/request', 2, NULL, NULL, NULL, 1501440593, 1501440593),
('/test/*', 2, NULL, NULL, NULL, 1499582517, 1499582517),
('/test/create', 2, 'สร้าง', NULL, NULL, 1499582517, 1500277284),
('/test/delete', 2, NULL, NULL, NULL, 1499582517, 1499582517),
('/test/index', 2, NULL, NULL, NULL, 1499582517, 1499582517),
('/test/index2', 2, NULL, NULL, NULL, 1500955484, 1500955484),
('/test/update', 2, NULL, NULL, NULL, 1499582517, 1499582517),
('/test/view', 2, NULL, NULL, NULL, 1499582517, 1499582517),
('admin', 1, 'แอดมิน', NULL, NULL, 1501465794, 1501465794),
('center_index', 2, 'หน้าระบบกลาง', NULL, NULL, 1501227806, 1501443320),
('editTest', 2, '', NULL, NULL, 1499582563, 1500605879),
('person_Add_System', 2, 'ระบบข้อมูลบุคคล', NULL, NULL, 1500955417, 1500966889),
('person_Edit_System', 2, NULL, NULL, NULL, 1500966929, 1500966929),
('ta_system_admin', 2, 'แอดเมี้ยว', NULL, NULL, 1501442434, 1501442434),
('ta_system_student', 2, 'ระบบทีเอ', NULL, NULL, 1501440525, 1501441643),
('ta_system_teacher', 2, 'อาจารย์', NULL, NULL, 1501442334, 1501442334),
('viewTest', 2, NULL, NULL, NULL, 1499582536, 1499582964);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('center_index', '/test/index2'),
('editTest', '/menu/menu'),
('editTest', '/test/create'),
('editTest', '/test/index'),
('editTest', '/test/update'),
('editTest', '/test/view'),
('person_Add_System', '/personsystem/person/admin_add_staff'),
('person_Add_System', '/personsystem/person/admin_add_student'),
('person_Add_System', '/personsystem/person/admin_add_teacher'),
('person_Add_System', '/personsystem/person/index'),
('person_Edit_System', '/menu/menu'),
('person_Edit_System', '/personsystem/person/admin_edit_staff'),
('person_Edit_System', '/personsystem/person/admin_edit_staff_list'),
('person_Edit_System', '/personsystem/person/admin_edit_student'),
('person_Edit_System', '/personsystem/person/admin_edit_student_list'),
('person_Edit_System', '/personsystem/person/admin_edit_teacher'),
('person_Edit_System', '/personsystem/person/admin_edit_teacher_list'),
('person_Edit_System', '/personsystem/person/index'),
('ta_system_admin', '/tasystem/ta/assessment'),
('ta_system_admin', '/tasystem/ta/index'),
('ta_system_admin', '/tasystem/ta/regista'),
('ta_system_admin', '/tasystem/ta/request'),
('ta_system_student', '/tasystem/ta/assessment'),
('ta_system_student', '/tasystem/ta/index'),
('ta_system_student', '/tasystem/ta/regista'),
('ta_system_teacher', '/tasystem/ta/assessment'),
('ta_system_teacher', '/tasystem/ta/index'),
('ta_system_teacher', '/tasystem/ta/request'),
('viewTest', '/menu/menu'),
('viewTest', '/test/index'),
('viewTest', '/test/view');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
(1, 'Person System', NULL, '/personsystem/person/index', 0, 0x666867666a),
(4, 'TA System', NULL, '/tasystem/ta/index', NULL, NULL),
(5, 'สมัคร TA', 4, '/tasystem/ta/regista', NULL, NULL),
(6, 'ประเมิณ TA', 4, '/tasystem/ta/assessment', NULL, NULL),
(7, 'ร้องขอ TA', 4, '/tasystem/ta/request', NULL, NULL),
(8, 'แก้ไขข้อมูลนักศึกษา', 1, '/personsystem/person/admin_edit_student_list', NULL, NULL),
(9, 'แก้ไขข้อมูลอาจารย์', 1, '/personsystem/person/admin_edit_teacher_list', NULL, NULL),
(10, 'แก้ไขข้อมูลบุคลากร', 1, '/personsystem/person/admin_edit_staff_list', NULL, NULL),
(11, 'เพิ่มอาจารย์', 1, '/personsystem/person/admin_add_teacher', NULL, NULL),
(12, 'เพิ่มนักเรียน', 1, '/personsystem/person/admin_add_student', NULL, NULL),
(13, 'เพิ่มบุคลากร', 1, '/personsystem/person/admin_add_staff', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1499431766),
('m140209_132017_init', 1499431787),
('m140403_174025_create_account_table', 1499431787),
('m140504_113157_update_tables', 1499431787),
('m140504_130429_create_token_table', 1499431787),
('m140506_102106_rbac_init', 1499433678),
('m140602_111327_create_menu_table', 1499530995),
('m140830_171933_fix_ip_field', 1499431788),
('m140830_172703_change_account_table_name', 1499431788),
('m141222_110026_update_ip_field', 1499431788),
('m141222_135246_alter_username_length', 1499431788),
('m150614_103145_update_social_account_table', 1499431788),
('m150623_212711_fix_username_notnull', 1499431788),
('m151218_234654_add_timezone_to_profile', 1499431788),
('m160312_050000_create_user', 1499530995),
('m160929_103127_add_last_login_at_to_user_table', 1499431788);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_account`
--

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
(1, 'Aj-QcHY8V1l4vKLr1F5Mh8f61MXKgVe0', 1499432099, 0),
(4, 'xEwLGoVvOjmbPHH4sJeakMwmPZ6eay3Z', 1500359063, 0),
(5, 'caX5MzVm7XHOpDCIYM7BEYBb1yjF56QT', 1500359158, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`, `status`, `password_reset_token`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$12$pGjdsJJmy6cPdyp5Vy3J3.L.LrCCnJPOZAsliPCk0BxRb/mWMCp6i', 'hQtcoF_F4MLBEPrgFif16Y8ZkwKw87x8', NULL, NULL, NULL, '::1', 1499432099, 1499432099, 0, 1501464493, 10, NULL),
(2, 'aaa', 'aaa@gmail.com', '$2y$12$Dc89x.ANiIzwcPgKO6e//OgP4hSmLp.eraAfhmhZapLmOyVft0Qha', 'TQKSxgUhTzy7y_wZVdDDdhIlkLeEo11a', 1499582309, NULL, NULL, '::1', 1499582309, 1499582309, 0, 1500003741, NULL, NULL),
(3, 'bbb', 'bbb@gmail.com', '$2y$12$wjttukSn.jfY4zxfmtPWLeYZxNSHCW6GcCXKmdg3EPOLNj3Xot7k2', 'RqS2SzYVFbr9zoyuYN-lezBftGV-xIdM', 1499582325, NULL, NULL, '::1', 1499582325, 1499582325, 0, 1500003554, NULL, NULL),
(4, 'ccc', 'ccc@mail.com', '$2y$12$7cc5iIm.RIsVFYv4QICjhu.BcQYp.pXEQq.o4DChsV8wT.RGdsO4y', '1gSGUGm5GJOSqQMfcmFGyQIgOjLxNmC4', 1500632263, NULL, NULL, '::1', 1500359063, 1500359063, 0, 1501467579, NULL, NULL),
(5, 'ddd', 'ellouked@gmail.com', '$2y$12$y5MXnlC.J6EQzd0/POjmhOY9AXzLyfpkKlZVnP8OTrjVKVKiJTir.', 'vRrFsKq8ScmBHBvQj-nBiqMN1RrNGmSv', NULL, NULL, NULL, '::1', 1500359103, 1500359103, 0, 1501464953, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_username` (`username`),
  ADD UNIQUE KEY `user_unique_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
