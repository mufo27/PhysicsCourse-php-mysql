-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 04:50 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `physics`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `pkname` varchar(250) DEFAULT NULL,
  `fname` varchar(250) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `del_status` int(11) NOT NULL,
  `save_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `pkname`, `fname`, `lname`, `username`, `password`, `email`, `phone`, `photo`, `status`, `del_status`, `save_time`, `update_time`) VALUES
(1, 'นาย', 'วัชรพงศ์', 'แก้วพิลา', 'admin', '123', 'admin@admin.com', '0123456789', 'ph_1667901474.png', 2, 0, '2022-09-09 17:00:00', '2023-11-11 17:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `class_room`
--

CREATE TABLE `class_room` (
  `cr_id` int(11) NOT NULL,
  `cr_level` int(11) NOT NULL,
  `cr_room` int(11) NOT NULL,
  `cr_year` int(11) NOT NULL,
  `del_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_room`
--

INSERT INTO `class_room` (`cr_id`, `cr_level`, `cr_room`, `cr_year`, `del_status`) VALUES
(11, 4, 1, 2565, 0),
(12, 4, 2, 2565, 0),
(13, 5, 1, 2565, 0),
(14, 5, 2, 2565, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `cs_id` int(11) NOT NULL,
  `cs_code` varchar(50) NOT NULL,
  `cs_name` varchar(500) NOT NULL,
  `cs_detail` varchar(2000) DEFAULT NULL,
  `k_hour` int(10) DEFAULT NULL,
  `k_minute` int(10) DEFAULT NULL,
  `cs_for` int(11) NOT NULL,
  `cs_img` varchar(1000) DEFAULT NULL,
  `cs_pay_status` int(11) NOT NULL,
  `cs_pay_num` varchar(250) DEFAULT NULL,
  `cs_status` int(11) NOT NULL,
  `cs_cer` varchar(250) DEFAULT NULL,
  `rcm_status` int(11) DEFAULT NULL,
  `save_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cs_id`, `cs_code`, `cs_name`, `cs_detail`, `k_hour`, `k_minute`, `cs_for`, `cs_img`, `cs_pay_status`, `cs_pay_num`, `cs_status`, `cs_cer`, `rcm_status`, `save_time`, `update_time`) VALUES
(65, 'ว30202', 'คอร์สฟิสิกส์', '<p>AA</p>', 8, 0, 3, 'img_1693375041.png', 0, '', 1, 'cer_1693375041.png', NULL, '2023-11-11 17:35:23', '2023-11-12 20:18:12'),
(66, '01', 'คอร์สฟิสิกส์ 1', '<p>BB</p>', 12, 0, 5, 'img_1693375061.png', 0, '', 1, 'cer_1693375061.png', NULL, '2023-11-11 17:35:23', '2023-11-12 20:18:28');

-- --------------------------------------------------------

--
-- Table structure for table `course_lesson`
--

CREATE TABLE `course_lesson` (
  `csl_id` int(11) NOT NULL,
  `cs_id` int(11) NOT NULL,
  `ls_id` int(11) NOT NULL,
  `save_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_lesson`
--

INSERT INTO `course_lesson` (`csl_id`, `cs_id`, `ls_id`, `save_time`) VALUES
(50, 65, 52, '2023-11-12 17:29:38'),
(51, 65, 53, '2023-11-12 17:29:38'),
(55, 66, 52, '2023-11-13 02:09:09'),
(56, 66, 53, '2023-11-13 02:09:09'),
(57, 66, 57, '2023-11-13 02:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `course_register`
--

CREATE TABLE `course_register` (
  `rs_id` int(11) NOT NULL,
  `cs_id` int(11) NOT NULL,
  `cr_id` int(11) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `save_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `approve_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_register`
--

INSERT INTO `course_register` (`rs_id`, `cs_id`, `cr_id`, `u_id`, `save_time`, `approve_status`) VALUES
(38, 65, 12, NULL, '0000-00-00 00:00:00', 1),
(39, 65, 11, NULL, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `ex_id` int(11) NOT NULL,
  `ex_name` varchar(500) NOT NULL,
  `ex_detail` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`ex_id`, `ex_name`, `ex_detail`) VALUES
(54, '0101ธรรมชาติของฟิสิกส์', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(55, '0102ระบบหน่วยระหว่างชาติ', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(56, '0103การเปลี่ยนหน่วย', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(57, '0104การเปลี่ยนหน่วยพื้นที่', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(58, '0105การเปลี่ยนหน่วยปริมาตร', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(59, '0106การเปลี่ยนหน่วยอนุพันธ์', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(60, '0107การเปลี่ยนหน่วยที่ไม่มีคำอุปสรรค', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(61, '0108ความไม่แน่นอนในการวัด', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(62, '0109เลขนัยสำคัญ', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(63, '0110การบวก ลบ คูณและหารเลขนัยสำคัญ', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(64, '0111เครื่องมือวัดและการวัด (เวอร์เนียร์คาร์ลิปเปอร์)', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(65, '0112เครื่องมือวัดและการวัด (ไมโครมิเตอร์)', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(66, '0113การวิเคราะห์ผลการทดลอง', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(67, '1301ธรรมชาติของไฟฟ้าสถิต', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(68, '1302การเหนี่ยวนำไฟฟ้าสถิต', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(69, '1303กฎของคูลอมบ์', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(70, '1304สนามไฟฟ้า', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(71, '1305จุดสะเทิน', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(73, '1306ศักย์ไฟฟ้าเนื่องจากจุดประจุ', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(74, '1307สนามไฟฟ้าและศักย์ไฟฟ้าเนื่องจากประจุบนตัวนำทรงกลม', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(75, '1308ความสัมพันธ์ระหว่างศักย์ไฟฟ้าและสนามไฟฟ้าสม่ำเสมอ', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(76, '1309ตัวเก็บประจุ', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(77, '1310การต่อตัวเก็บประจุ', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(78, '1311การนำความรู้เกี่ยวกับไฟฟ้าสถิตไปใช้ประโยชน์', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)'),
(79, '0508เครื่องกล', 'ให้นักเรียนเลือกคำตอบที่ถูกต้องที่สุด หรือกรอกคำตอบที่ถูกต้อง (กรณีคำตอบเป็นเลขทศนิยมให้นักเรียนตอบเป็นทศนิยม 2 ตำแหน่ง)');

-- --------------------------------------------------------

--
-- Table structure for table `ex_question`
--

CREATE TABLE `ex_question` (
  `exq_id` int(11) NOT NULL,
  `ex_id` int(11) NOT NULL,
  `tyq_id` int(11) NOT NULL,
  `tya_id` int(11) NOT NULL,
  `exq_name` varchar(500) NOT NULL,
  `exq_image` varchar(500) DEFAULT NULL,
  `exq_answer` varchar(1000) NOT NULL,
  `opt_1` varchar(1000) DEFAULT NULL,
  `opt_2` varchar(1000) DEFAULT NULL,
  `opt_3` varchar(1000) DEFAULT NULL,
  `opt_4` varchar(1000) DEFAULT NULL,
  `opt_5` varchar(1000) DEFAULT NULL,
  `exq_sheet` varchar(250) DEFAULT NULL,
  `exq_youtube` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ex_question`
--

INSERT INTO `ex_question` (`exq_id`, `ex_id`, `tyq_id`, `tya_id`, `exq_name`, `exq_image`, `exq_answer`, `opt_1`, `opt_2`, `opt_3`, `opt_4`, `opt_5`, `exq_sheet`, `exq_youtube`) VALUES
(55, 79, 2, 2, '<p>5 + 5 = ?</p>', 'ex_1678890802.png', '<p>10</p>', '', '', '', '', '', 'sh_1678890802.docx', 'fCmXpLncQSc'),
(56, 79, 2, 2, '<p><sub>10+10=?</sub></p>', '', '<p>20</p>', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ex_status`
--

CREATE TABLE `ex_status` (
  `exa_id` int(11) NOT NULL,
  `sls_id` int(11) NOT NULL,
  `ex_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ex_status`
--

INSERT INTO `ex_status` (`exa_id`, `sls_id`, `ex_id`, `u_id`) VALUES
(41, 74, 79, 3389),
(38, 74, 79, 3397),
(36, 74, 79, 3415),
(37, 74, 79, 3419),
(40, 74, 79, 3425),
(39, 74, 79, 3427);

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `ls_id` int(11) NOT NULL,
  `ls_name` varchar(500) NOT NULL,
  `ls_detail` varchar(2000) DEFAULT NULL,
  `save_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`ls_id`, `ls_name`, `ls_detail`, `save_time`, `update_time`) VALUES
(52, 'ธรรมชาติของฟิสิกส์', '<p class=\"MsoNormal\" style=\"text-indent:.5in;\"><span style=\"background-color:rgba(80,80,80,0.02);color:rgb(33,37,41);font-family:Kanit, sans-serif;font-size:13px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:0.1px;orphans:2;text-align:left;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ศึกษาการค้นหาความรู้ทางฟิสิกส์ ประวัติความเป็นมารวมทั้งพัฒนาการของหลักการแนะแนวคิดทางฟิสิกส์ที่มีผลต่อการแสวงหาความรู้ใหม่และการพัฒนาเทคโนโลยี การวัดและการรายงานผลการวัดปริมาณทางฟิสิกส์ หลักการของกลศาสตร์ในเรื่องการเคลื่อนที่ของวัตถุในแนวตรง แรง การหาแรงลัพธ์ของแรงสองแรงที่ทำมุมต่อกัน การเขียนแผนภาพวัตถุอิสระ กฎการเคลื่อนที่ของนิวตัน กฎแรงโน้มถ่วงสากล แรงเสียดทานระหว่างผิวสัมผัสของวัตถุคู่หนึ่ง ๆ ในกรณีที่วัตถุหยุดนิ่งและวัตถุเคลื่อนที่โดยใช้กระบวนการทางวิทยาศาสตร์การสืบเสาะหาความรู้ การสืบค้นข้อมูลการสังเกตวิเคราะห์เปรียบเทียบอธิบายอภิปรายและสรุปเพื่อให้เกิดความรู้ความเข้าใจมีความสามารถในการตัดสินใจมีทักษะกระบวนการทางวิทยาศาสตร์รวมทั้งทักษะแห่งศตวรรษที่ 21 ในด้านการใช้เทคโนโลยีสารสนเทศด้านการคิดและการแก้ปัญหา ด้านการสื่อสารสามารถสื่อสารสิ่งที่เรียนรู้และนำความรู้ไปใช้ในชีวิตของตนเอง มีจิตวิทยาศาสตร์ จริยธรรม คุณธรรมและค่านิยมที่เหมาะสม</span></span></p>', '2023-11-13 02:10:43', '2023-11-13 02:17:45'),
(53, 'ธรรมชาติของฟิสิกส์ 1', '<p><span style=\"background-color:rgba(80,80,80,0.02);color:rgb(33,37,41);font-family:Kanit, sans-serif;font-size:13px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:0.1px;orphans:2;text-align:left;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ศึกษาการค้นหาความรู้ทางฟิสิกส์ ประวัติความเป็นมารวมทั้งพัฒนาการของหลักการแนะแนวคิดทางฟิสิกส์ที่มีผลต่อการแสวงหาความรู้ใหม่และการพัฒนาเทคโนโลยี การวัดและการรายงานผลการวัดปริมาณทางฟิสิกส์ หลักการของกลศาสตร์ในเรื่องการเคลื่อนที่ของวัตถุในแนวตรง แรง การหาแรงลัพธ์ของแรงสองแรงที่ทำมุมต่อกัน การเขียนแผนภาพวัตถุอิสระ กฎการเคลื่อนที่ของนิวตัน กฎแรงโน้มถ่วงสากล แรงเสียดทานระหว่างผิวสัมผัสของวัตถุคู่หนึ่ง ๆ ในกรณีที่วัตถุหยุดนิ่งและวัตถุเคลื่อนที่โดยใช้กระบวนการทางวิทยาศาสตร์การสืบเสาะหาความรู้ การสืบค้นข้อมูลการสังเกตวิเคราะห์เปรียบเทียบอธิบายอภิปรายและสรุปเพื่อให้เกิดความรู้ความเข้าใจมีความสามารถในการตัดสินใจมีทักษะกระบวนการทางวิทยาศาสตร์รวมทั้งทักษะแห่งศตวรรษที่ 21 ในด้านการใช้เทคโนโลยีสารสนเทศด้านการคิดและการแก้ปัญหา ด้านการสื่อสารสามารถสื่อสารสิ่งที่เรียนรู้และนำความรู้ไปใช้ในชีวิตของตนเอง มีจิตวิทยาศาสตร์ จริยธรรม คุณธรรมและค่านิยมที่เหมาะสม xxx</span></span></p>', '2023-11-13 02:10:43', '2023-11-13 02:18:28'),
(57, 'ธรรมชาติของฟิสิกส์ 2', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ศึกษาการค้นหาความรู้ทางฟิสิกส์ ประวัติความเป็นมารวมทั้งพัฒนาการของหลักการแนะแนวคิดทางฟิสิกส์ที่มีผลต่อการแสวงหาความรู้ใหม่และการพัฒนาเทคโนโลยี การวัดและการรายงานผลการวัดปริมาณทางฟิสิกส์ หลักการของกลศาสตร์ในเรื่องการเคลื่อนที่ของวัตถุในแนวตรง แรง การหาแรงลัพธ์ของแรงสองแรงที่ทำมุมต่อกัน การเขียนแผนภาพวัตถุอิสระ กฎการเคลื่อนที่ของนิวตัน กฎแรงโน้มถ่วงสากล แรงเสียดทานระหว่างผิวสัมผัสของวัตถุคู่หนึ่ง ๆ ในกรณีที่วัตถุหยุดนิ่งและวัตถุเคลื่อนที่โดยใช้กระบวนการทางวิทยาศาสตร์การสืบเสาะหาความรู้ การสืบค้นข้อมูลการสังเกตวิเคราะห์เปรียบเทียบอธิบายอภิปรายและสรุปเพื่อให้เกิดความรู้ความเข้าใจมีความสามารถในการตัดสินใจมีทักษะกระบวนการทางวิทยาศาสตร์รวมทั้งทักษะแห่งศตวรรษที่ 21 ในด้านการใช้เทคโนโลยีสารสนเทศด้านการคิดและการแก้ปัญหา ด้านการสื่อสารสามารถสื่อสารสิ่งที่เรียนรู้และนำความรู้ไปใช้ในชีวิตของตนเอง มีจิตวิทยาศาสตร์ จริยธรรม คุณธรรมและค่านิยมที่เหมาะสม<o:p></o:p></p>', '2023-11-13 02:10:43', '2023-11-13 02:10:43'),
(58, 'ธรรมชาติของฟิสิกส์ 3', '<p><span style=\"background-color:rgba(80,80,80,0.02);color:rgb(33,37,41);font-family:Kanit, sans-serif;font-size:13px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:0.1px;orphans:2;text-align:left;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">ศึกษาการค้นหาความรู้ทางฟิสิกส์ ประวัติความเป็นมารวมทั้งพัฒนาการของหลักการแนะแนวคิดทางฟิสิกส์ที่มีผลต่อการแสวงหาความรู้ใหม่และการพัฒนาเทคโนโลยี การวัดและการรายงานผลการวัดปริมาณทางฟิสิกส์ หลักการของกลศาสตร์ในเรื่องการเคลื่อนที่ของวัตถุในแนวตรง แรง การหาแรงลัพธ์ของแรงสองแรงที่ทำมุมต่อกัน การเขียนแผนภาพวัตถุอิสระ กฎการเคลื่อนที่ของนิวตัน กฎแรงโน้มถ่วงสากล แรงเสียดทานระหว่างผิวสัมผัสของวัตถุคู่หนึ่ง ๆ ในกรณีที่วัตถุหยุดนิ่งและวัตถุเคลื่อนที่โดยใช้กระบวนการทางวิทยาศาสตร์การสืบเสาะหาความรู้ การสืบค้นข้อมูลการสังเกตวิเคราะห์เปรียบเทียบอธิบายอภิปรายและสรุปเพื่อให้เกิดความรู้ความเข้าใจมีความสามารถในการตัดสินใจมีทักษะกระบวนการทางวิทยาศาสตร์รวมทั้งทักษะแห่งศตวรรษที่ 21 ในด้านการใช้เทคโนโลยีสารสนเทศด้านการคิดและการแก้ปัญหา ด้านการสื่อสารสามารถสื่อสารสิ่งที่เรียนรู้และนำความรู้ไปใช้ในชีวิตของตนเอง มีจิตวิทยาศาสตร์ จริยธรรม คุณธรรมและค่านิยมที่เหมาะสม</span></span></p>', '2023-11-13 02:10:43', '2023-11-13 02:10:43'),
(59, 'ธรรมชาติของฟิสิกส์ 5', '<p><span style=\"background-color:rgba(80,80,80,0.02);color:rgb(33,37,41);font-family:Kanit, sans-serif;font-size:13px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:0.1px;orphans:2;text-align:left;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ศึกษาการค้นหาความรู้ทางฟิสิกส์ ประวัติความเป็นมารวมทั้งพัฒนาการของหลักการแนะแนวคิดทางฟิสิกส์ที่มีผลต่อการแสวงหาความรู้ใหม่และการพัฒนาเทคโนโลยี การวัดและการรายงานผลการวัดปริมาณทางฟิสิกส์ หลักการของกลศาสตร์ในเรื่องการเคลื่อนที่ของวัตถุในแนวตรง แรง การหาแรงลัพธ์ของแรงสองแรงที่ทำมุมต่อกัน การเขียนแผนภาพวัตถุอิสระ กฎการเคลื่อนที่ของนิวตัน กฎแรงโน้มถ่วงสากล แรงเสียดทานระหว่างผิวสัมผัสของวัตถุคู่หนึ่ง ๆ ในกรณีที่วัตถุหยุดนิ่งและวัตถุเคลื่อนที่โดยใช้กระบวนการทางวิทยาศาสตร์การสืบเสาะหาความรู้ การสืบค้นข้อมูลการสังเกตวิเคราะห์เปรียบเทียบอธิบายอภิปรายและสรุปเพื่อให้เกิดความรู้ความเข้าใจมีความสามารถในการตัดสินใจมีทักษะกระบวนการทางวิทยาศาสตร์รวมทั้งทักษะแห่งศตวรรษที่ 21 ในด้านการใช้เทคโนโลยีสารสนเทศด้านการคิดและการแก้ปัญหา ด้านการสื่อสารสามารถสื่อสารสิ่งที่เรียนรู้และนำความรู้ไปใช้ในชีวิตของตนเอง มีจิตวิทยาศาสตร์ จริยธรรม คุณธรรมและค่านิยมที่เหมาะสม</span></span></p>', '2023-11-13 02:10:43', '2023-11-13 02:18:51'),
(60, 'ธรรมชาติของฟิสิกส์ 6', '<p><span style=\"background-color:rgba(80,80,80,0.02);color:rgb(33,37,41);font-family:Kanit, sans-serif;font-size:13px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:0.1px;orphans:2;text-align:left;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ศึกษาการค้นหาความรู้ทางฟิสิกส์ ประวัติความเป็นมารวมทั้งพัฒนาการของหลักการแนะแนวคิดทางฟิสิกส์ที่มีผลต่อการแสวงหาความรู้ใหม่และการพัฒนาเทคโนโลยี การวัดและการรายงานผลการวัดปริมาณทางฟิสิกส์ หลักการของกลศาสตร์ในเรื่องการเคลื่อนที่ของวัตถุในแนวตรง แรง การหาแรงลัพธ์ของแรงสองแรงที่ทำมุมต่อกัน การเขียนแผนภาพวัตถุอิสระ กฎการเคลื่อนที่ของนิวตัน กฎแรงโน้มถ่วงสากล แรงเสียดทานระหว่างผิวสัมผัสของวัตถุคู่หนึ่ง ๆ ในกรณีที่วัตถุหยุดนิ่งและวัตถุเคลื่อนที่โดยใช้กระบวนการทางวิทยาศาสตร์การสืบเสาะหาความรู้ การสืบค้นข้อมูลการสังเกตวิเคราะห์เปรียบเทียบอธิบายอภิปรายและสรุปเพื่อให้เกิดความรู้ความเข้าใจมีความสามารถในการตัดสินใจมีทักษะกระบวนการทางวิทยาศาสตร์รวมทั้งทักษะแห่งศตวรรษที่ 21 ในด้านการใช้เทคโนโลยีสารสนเทศด้านการคิดและการแก้ปัญหา ด้านการสื่อสารสามารถสื่อสารสิ่งที่เรียนรู้และนำความรู้ไปใช้ในชีวิตของตนเอง มีจิตวิทยาศาสตร์ จริยธรรม คุณธรรมและค่านิยมที่เหมาะสม</span></span></p>', '2023-11-13 02:19:56', '2023-11-13 02:19:56'),
(61, 'ธรรมชาติของฟิสิกส์ 7', '<p><span style=\"background-color:rgba(80,80,80,0.02);color:rgb(33,37,41);font-family:Kanit, sans-serif;font-size:13px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:0.1px;orphans:2;text-align:left;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ศึกษาการค้นหาความรู้ทางฟิสิกส์ ประวัติความเป็นมารวมทั้งพัฒนาการของหลักการแนะแนวคิดทางฟิสิกส์ที่มีผลต่อการแสวงหาความรู้ใหม่และการพัฒนาเทคโนโลยี การวัดและการรายงานผลการวัดปริมาณทางฟิสิกส์ หลักการของกลศาสตร์ในเรื่องการเคลื่อนที่ของวัตถุในแนวตรง แรง การหาแรงลัพธ์ของแรงสองแรงที่ทำมุมต่อกัน การเขียนแผนภาพวัตถุอิสระ กฎการเคลื่อนที่ของนิวตัน กฎแรงโน้มถ่วงสากล แรงเสียดทานระหว่างผิวสัมผัสของวัตถุคู่หนึ่ง ๆ ในกรณีที่วัตถุหยุดนิ่งและวัตถุเคลื่อนที่โดยใช้กระบวนการทางวิทยาศาสตร์การสืบเสาะหาความรู้ การสืบค้นข้อมูลการสังเกตวิเคราะห์เปรียบเทียบอธิบายอภิปรายและสรุปเพื่อให้เกิดความรู้ความเข้าใจมีความสามารถในการตัดสินใจมีทักษะกระบวนการทางวิทยาศาสตร์รวมทั้งทักษะแห่งศตวรรษที่ 21 ในด้านการใช้เทคโนโลยีสารสนเทศด้านการคิดและการแก้ปัญหา ด้านการสื่อสารสามารถสื่อสารสิ่งที่เรียนรู้และนำความรู้ไปใช้ในชีวิตของตนเอง มีจิตวิทยาศาสตร์ จริยธรรม คุณธรรมและค่านิยมที่เหมาะสม</span></span></p>', '2023-11-13 02:20:49', '2023-11-13 02:20:49'),
(62, 'ธรรมชาติของฟิสิกส์ 8', '<p><span style=\"background-color:rgba(80,80,80,0.02);color:rgb(33,37,41);font-family:Kanit, sans-serif;font-size:13px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:0.1px;orphans:2;text-align:left;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ศึกษาการค้นหาความรู้ทางฟิสิกส์ ประวัติความเป็นมารวมทั้งพัฒนาการของหลักการแนะแนวคิดทางฟิสิกส์ที่มีผลต่อการแสวงหาความรู้ใหม่และการพัฒนาเทคโนโลยี การวัดและการรายงานผลการวัดปริมาณทางฟิสิกส์ หลักการของกลศาสตร์ในเรื่องการเคลื่อนที่ของวัตถุในแนวตรง แรง การหาแรงลัพธ์ของแรงสองแรงที่ทำมุมต่อกัน การเขียนแผนภาพวัตถุอิสระ กฎการเคลื่อนที่ของนิวตัน กฎแรงโน้มถ่วงสากล แรงเสียดทานระหว่างผิวสัมผัสของวัตถุคู่หนึ่ง ๆ ในกรณีที่วัตถุหยุดนิ่งและวัตถุเคลื่อนที่โดยใช้กระบวนการทางวิทยาศาสตร์การสืบเสาะหาความรู้ การสืบค้นข้อมูลการสังเกตวิเคราะห์เปรียบเทียบอธิบายอภิปรายและสรุปเพื่อให้เกิดความรู้ความเข้าใจมีความสามารถในการตัดสินใจมีทักษะกระบวนการทางวิทยาศาสตร์รวมทั้งทักษะแห่งศตวรรษที่ 21 ในด้านการใช้เทคโนโลยีสารสนเทศด้านการคิดและการแก้ปัญหา ด้านการสื่อสารสามารถสื่อสารสิ่งที่เรียนรู้และนำความรู้ไปใช้ในชีวิตของตนเอง มีจิตวิทยาศาสตร์ จริยธรรม คุณธรรมและค่านิยมที่เหมาะสม</span></span></p>', '2023-11-13 02:20:59', '2023-11-13 02:20:59'),
(63, 'ธรรมชาติของฟิสิกส์ 9', '<p><span style=\"background-color:rgba(80,80,80,0.02);color:rgb(33,37,41);font-family:Kanit, sans-serif;font-size:13px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:0.1px;orphans:2;text-align:left;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ศึกษาการค้นหาความรู้ทางฟิสิกส์ ประวัติความเป็นมารวมทั้งพัฒนาการของหลักการแนะแนวคิดทางฟิสิกส์ที่มีผลต่อการแสวงหาความรู้ใหม่และการพัฒนาเทคโนโลยี การวัดและการรายงานผลการวัดปริมาณทางฟิสิกส์ หลักการของกลศาสตร์ในเรื่องการเคลื่อนที่ของวัตถุในแนวตรง แรง การหาแรงลัพธ์ของแรงสองแรงที่ทำมุมต่อกัน การเขียนแผนภาพวัตถุอิสระ กฎการเคลื่อนที่ของนิวตัน กฎแรงโน้มถ่วงสากล แรงเสียดทานระหว่างผิวสัมผัสของวัตถุคู่หนึ่ง ๆ ในกรณีที่วัตถุหยุดนิ่งและวัตถุเคลื่อนที่โดยใช้กระบวนการทางวิทยาศาสตร์การสืบเสาะหาความรู้ การสืบค้นข้อมูลการสังเกตวิเคราะห์เปรียบเทียบอธิบายอภิปรายและสรุปเพื่อให้เกิดความรู้ความเข้าใจมีความสามารถในการตัดสินใจมีทักษะกระบวนการทางวิทยาศาสตร์รวมทั้งทักษะแห่งศตวรรษที่ 21 ในด้านการใช้เทคโนโลยีสารสนเทศด้านการคิดและการแก้ปัญหา ด้านการสื่อสารสามารถสื่อสารสิ่งที่เรียนรู้และนำความรู้ไปใช้ในชีวิตของตนเอง มีจิตวิทยาศาสตร์ จริยธรรม คุณธรรมและค่านิยมที่เหมาะสม</span></span></p>', '2023-11-13 02:21:09', '2023-11-13 02:21:09'),
(64, 'ธรรมชาติของฟิสิกส์ 10', '<p><span style=\"background-color:rgba(80,80,80,0.02);color:rgb(33,37,41);font-family:Kanit, sans-serif;font-size:13px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:0.1px;orphans:2;text-align:left;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ศึกษาการค้นหาความรู้ทางฟิสิกส์ ประวัติความเป็นมารวมทั้งพัฒนาการของหลักการแนะแนวคิดทางฟิสิกส์ที่มีผลต่อการแสวงหาความรู้ใหม่และการพัฒนาเทคโนโลยี การวัดและการรายงานผลการวัดปริมาณทางฟิสิกส์ หลักการของกลศาสตร์ในเรื่องการเคลื่อนที่ของวัตถุในแนวตรง แรง การหาแรงลัพธ์ของแรงสองแรงที่ทำมุมต่อกัน การเขียนแผนภาพวัตถุอิสระ กฎการเคลื่อนที่ของนิวตัน กฎแรงโน้มถ่วงสากล แรงเสียดทานระหว่างผิวสัมผัสของวัตถุคู่หนึ่ง ๆ ในกรณีที่วัตถุหยุดนิ่งและวัตถุเคลื่อนที่โดยใช้กระบวนการทางวิทยาศาสตร์การสืบเสาะหาความรู้ การสืบค้นข้อมูลการสังเกตวิเคราะห์เปรียบเทียบอธิบายอภิปรายและสรุปเพื่อให้เกิดความรู้ความเข้าใจมีความสามารถในการตัดสินใจมีทักษะกระบวนการทางวิทยาศาสตร์รวมทั้งทักษะแห่งศตวรรษที่ 21 ในด้านการใช้เทคโนโลยีสารสนเทศด้านการคิดและการแก้ปัญหา ด้านการสื่อสารสามารถสื่อสารสิ่งที่เรียนรู้และนำความรู้ไปใช้ในชีวิตของตนเอง มีจิตวิทยาศาสตร์ จริยธรรม คุณธรรมและค่านิยมที่เหมาะสม</span></span></p>', '2023-11-13 02:21:19', '2023-11-13 02:21:19'),
(65, 'ธรรมชาติของฟิสิกส์ 11', '<p><span style=\"background-color:rgba(80,80,80,0.02);color:rgb(33,37,41);font-family:Kanit, sans-serif;font-size:13px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:0.1px;orphans:2;text-align:left;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ศึกษาการค้นหาความรู้ทางฟิสิกส์ ประวัติความเป็นมารวมทั้งพัฒนาการของหลักการแนะแนวคิดทางฟิสิกส์ที่มีผลต่อการแสวงหาความรู้ใหม่และการพัฒนาเทคโนโลยี การวัดและการรายงานผลการวัดปริมาณทางฟิสิกส์ หลักการของกลศาสตร์ในเรื่องการเคลื่อนที่ของวัตถุในแนวตรง แรง การหาแรงลัพธ์ของแรงสองแรงที่ทำมุมต่อกัน การเขียนแผนภาพวัตถุอิสระ กฎการเคลื่อนที่ของนิวตัน กฎแรงโน้มถ่วงสากล แรงเสียดทานระหว่างผิวสัมผัสของวัตถุคู่หนึ่ง ๆ ในกรณีที่วัตถุหยุดนิ่งและวัตถุเคลื่อนที่โดยใช้กระบวนการทางวิทยาศาสตร์การสืบเสาะหาความรู้ การสืบค้นข้อมูลการสังเกตวิเคราะห์เปรียบเทียบอธิบายอภิปรายและสรุปเพื่อให้เกิดความรู้ความเข้าใจมีความสามารถในการตัดสินใจมีทักษะกระบวนการทางวิทยาศาสตร์รวมทั้งทักษะแห่งศตวรรษที่ 21 ในด้านการใช้เทคโนโลยีสารสนเทศด้านการคิดและการแก้ปัญหา ด้านการสื่อสารสามารถสื่อสารสิ่งที่เรียนรู้และนำความรู้ไปใช้ในชีวิตของตนเอง มีจิตวิทยาศาสตร์ จริยธรรม คุณธรรมและค่านิยมที่เหมาะสม</span></span></p>', '2023-11-13 02:21:33', '2023-11-13 02:21:33'),
(66, 'ธรรมชาติของฟิสิกส์ 12', '<p><span style=\"background-color:rgba(80,80,80,0.02);color:rgb(33,37,41);font-family:Kanit, sans-serif;font-size:13px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:0.1px;orphans:2;text-align:left;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ศึกษาการค้นหาความรู้ทางฟิสิกส์ ประวัติความเป็นมารวมทั้งพัฒนาการของหลักการแนะแนวคิดทางฟิสิกส์ที่มีผลต่อการแสวงหาความรู้ใหม่และการพัฒนาเทคโนโลยี การวัดและการรายงานผลการวัดปริมาณทางฟิสิกส์ หลักการของกลศาสตร์ในเรื่องการเคลื่อนที่ของวัตถุในแนวตรง แรง การหาแรงลัพธ์ของแรงสองแรงที่ทำมุมต่อกัน การเขียนแผนภาพวัตถุอิสระ กฎการเคลื่อนที่ของนิวตัน กฎแรงโน้มถ่วงสากล แรงเสียดทานระหว่างผิวสัมผัสของวัตถุคู่หนึ่ง ๆ ในกรณีที่วัตถุหยุดนิ่งและวัตถุเคลื่อนที่โดยใช้กระบวนการทางวิทยาศาสตร์การสืบเสาะหาความรู้ การสืบค้นข้อมูลการสังเกตวิเคราะห์เปรียบเทียบอธิบายอภิปรายและสรุปเพื่อให้เกิดความรู้ความเข้าใจมีความสามารถในการตัดสินใจมีทักษะกระบวนการทางวิทยาศาสตร์รวมทั้งทักษะแห่งศตวรรษที่ 21 ในด้านการใช้เทคโนโลยีสารสนเทศด้านการคิดและการแก้ปัญหา ด้านการสื่อสารสามารถสื่อสารสิ่งที่เรียนรู้และนำความรู้ไปใช้ในชีวิตของตนเอง มีจิตวิทยาศาสตร์ จริยธรรม คุณธรรมและค่านิยมที่เหมาะสม</span></span></p>', '2023-11-13 02:21:59', '2023-11-13 02:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `n_id` int(11) NOT NULL,
  `n_top` varchar(250) NOT NULL,
  `n_detail` varchar(1000) NOT NULL,
  `n_img` varchar(250) DEFAULT NULL,
  `n_date` date DEFAULT current_timestamp(),
  `n_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `non_id` int(11) NOT NULL,
  `tyn_id` int(11) NOT NULL,
  `st_u_id` int(11) NOT NULL,
  `sd_u_id` int(11) NOT NULL,
  `non_detail` varchar(500) NOT NULL,
  `non_date` date NOT NULL,
  `non_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pass_new`
--

CREATE TABLE `pass_new` (
  `e_id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `press_heart`
--

CREATE TABLE `press_heart` (
  `ph_id` int(11) NOT NULL,
  `cs_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `save_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `press_heart`
--

INSERT INTO `press_heart` (`ph_id`, `cs_id`, `u_id`, `save_date`) VALUES
(68, 65, 3389, '2023-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `pg_id` int(11) NOT NULL,
  `cs_id` int(11) NOT NULL,
  `sls_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `save_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`pg_id`, `cs_id`, `sls_id`, `u_id`, `save_date`) VALUES
(40, 65, 74, 3389, '2023-01-23 05:56:15'),
(41, 65, 74, 3397, '2023-01-23 06:41:18'),
(42, 65, 74, 3427, '2023-01-23 06:41:25'),
(43, 65, 74, 3408, '2023-01-23 06:41:32'),
(44, 65, 74, 3415, '2023-01-23 06:41:40'),
(45, 65, 74, 3398, '2023-01-23 06:42:13'),
(46, 65, 74, 3404, '2023-01-23 06:42:18'),
(47, 65, 74, 3419, '2023-01-23 06:43:29'),
(48, 65, 74, 3414, '2023-01-23 06:44:07'),
(49, 65, 74, 3423, '2023-01-23 06:44:43'),
(50, 65, 74, 3422, '2023-01-23 06:45:08'),
(51, 65, 74, 3417, '2023-01-23 06:45:37'),
(52, 65, 74, 3425, '2023-01-23 06:45:43'),
(53, 65, 74, 3393, '2023-01-23 06:46:26'),
(54, 65, 74, 3395, '2023-01-23 06:46:55'),
(55, 65, 74, 3392, '2023-01-23 06:46:58'),
(56, 65, 74, 3421, '2023-01-23 06:46:58'),
(57, 65, 74, 3410, '2023-01-23 06:47:09'),
(58, 65, 74, 3391, '2023-01-23 06:47:28'),
(59, 65, 74, 3399, '2023-01-23 06:47:53'),
(60, 65, 74, 3413, '2023-01-23 06:48:04'),
(61, 65, 74, 3396, '2023-01-23 06:48:17'),
(62, 65, 74, 3411, '2023-01-23 06:48:56'),
(63, 65, 74, 3406, '2023-01-23 06:49:00'),
(64, 65, 74, 3409, '2023-01-23 06:51:03'),
(65, 65, 73, 3389, '2023-02-05 12:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `z_id` int(11) NOT NULL,
  `z_name` varchar(500) NOT NULL,
  `z_detail` varchar(1000) NOT NULL,
  `z_criteria` int(11) NOT NULL,
  `k_hour` int(11) NOT NULL,
  `k_minute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`z_id`, `z_name`, `z_detail`, `z_criteria`, `k_hour`, `k_minute`) VALUES
(45, '0101ธรรมชาติของฟิสิกส์', '', 60, 0, 5),
(46, '0102ระบบหน่วยระหว่างชาติ', '', 60, 0, 10),
(47, '0103การเปลี่ยนหน่วย', '', 60, 0, 10),
(48, '0104การเปลี่ยนหน่วยพื้นที่ ', '', 60, 0, 5),
(49, '0105การเปลี่ยนหน่วยปริมาตร ', '', 60, 0, 5),
(50, '0106การเปลี่ยนหน่วยอนุพันธ์ ', '', 60, 0, 5),
(51, '0107การเปลี่ยนหน่วยที่ไม่มีคำอุปสรรค', '', 60, 0, 10),
(52, '0108ความไม่แน่นอนในการวัด     		 	', '', 60, 0, 10),
(53, '0109เลขนัยสำคัญ ', '', 60, 0, 5),
(54, '0110การบวก ลบ คูณและหารเลขนัยสำคัญ', '', 60, 0, 5),
(55, '0111เครื่องมือวัดและการวัด(เวอร์เนียร์คาร์ลิปเปอร์)', '', 60, 0, 10),
(56, '0112เครื่องมือวัดและการวัด (ไมโครมิเตอร์) ', '', 60, 0, 10),
(57, '0113การวิเคราะห์ผลการทดลอง', '', 60, 0, 5),
(58, '1301ธรรมชาติของไฟฟ้าสถิต', '', 60, 0, 5),
(59, '1302การเหนี่ยวนำไฟฟ้าสถิต', '', 60, 0, 5),
(60, '1303กฎของคูลอมบ์', '', 60, 0, 10),
(61, '1304สนามไฟฟ้า', '', 60, 0, 10),
(62, '1305จุดสะเทิน', '', 60, 0, 10),
(63, '1306ศักย์ไฟฟ้าเนื่องจากจุดประจุ', '', 60, 0, 10),
(64, '1307สนามไฟฟ้าและศักย์ไฟฟ้าเนื่องจากประจุบนตัวนำทรงกลม', '', 60, 0, 10),
(65, '1308ความสัมพันธ์ระหว่างศักย์ไฟฟ้าและสนามไฟฟ้าสม่ำเสมอ', '', 60, 0, 10),
(66, '1309ตัวเก็บประจุ', '', 60, 0, 10),
(67, '1310การต่อตัวเก็บประจุ', '', 60, 0, 10),
(68, '1311การนำความรู้เกี่ยวกับไฟฟ้าสถิตไปใช้ประโยชน์', '', 60, 0, 10),
(69, '0508เครื่องกล', '                                                                                                    ', 60, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `qz_answer`
--

CREATE TABLE `qz_answer` (
  `qza_id` int(11) NOT NULL,
  `sls_id` int(11) NOT NULL,
  `qzq_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `qza_answer` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qz_point`
--

CREATE TABLE `qz_point` (
  `qzp_id` int(11) NOT NULL,
  `sls_id` int(11) NOT NULL,
  `z_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_point` float NOT NULL,
  `k_point` float NOT NULL,
  `qz_use` int(11) DEFAULT NULL,
  `save_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qz_point`
--

INSERT INTO `qz_point` (`qzp_id`, `sls_id`, `z_id`, `u_id`, `p_point`, `k_point`, `qz_use`, `save_date`) VALUES
(67, 74, 69, 3397, 0, 0, 1, '2023-01-23 06:42:01'),
(68, 74, 69, 3408, 0, 0, 1, '2023-01-23 06:42:28'),
(69, 74, 69, 3404, 0, 0, NULL, '2023-01-23 06:46:55'),
(70, 74, 69, 3398, 0, 0, NULL, '2023-01-23 06:46:56'),
(71, 74, 69, 3427, 0, 0, NULL, '2023-01-23 06:46:57'),
(72, 74, 69, 3414, 100, 0, 1, '2023-01-23 06:47:04'),
(73, 74, 69, 3427, 0, 0, NULL, '2023-01-23 06:47:53'),
(74, 74, 69, 3404, 100, 0, NULL, '2023-01-23 06:48:04'),
(75, 74, 69, 3398, 100, 0, NULL, '2023-01-23 06:48:26'),
(76, 74, 69, 3404, 100, 0, NULL, '2023-01-23 06:48:33'),
(77, 74, 69, 3427, 100, 0, NULL, '2023-01-23 06:48:53'),
(78, 74, 69, 3392, 100, 0, NULL, '2023-01-23 06:49:08'),
(79, 74, 69, 3427, 100, 0, NULL, '2023-01-23 06:49:12'),
(80, 74, 69, 3404, 100, 0, NULL, '2023-01-23 06:49:12'),
(81, 74, 69, 3391, 100, 0, NULL, '2023-01-23 06:49:13'),
(82, 74, 69, 3398, 100, 0, NULL, '2023-01-23 06:49:26'),
(83, 74, 69, 3396, 0, 0, NULL, '2023-01-23 06:49:27'),
(84, 74, 69, 3427, 100, 0, NULL, '2023-01-23 06:49:48'),
(85, 74, 69, 3419, 100, 0, NULL, '2023-01-23 06:50:08'),
(86, 74, 69, 3398, 100, 0, NULL, '2023-01-23 06:50:12'),
(87, 74, 69, 3425, 100, 0, NULL, '2023-01-23 06:50:14'),
(88, 74, 69, 3427, 100, 0, NULL, '2023-01-23 06:50:21'),
(89, 74, 69, 3391, 100, 0, NULL, '2023-01-23 06:50:25'),
(90, 74, 69, 3419, 100, 0, NULL, '2023-01-23 06:50:33'),
(91, 74, 69, 3425, 100, 0, 1, '2023-01-23 06:50:35'),
(92, 74, 69, 3395, 100, 0, NULL, '2023-01-23 06:51:05'),
(93, 74, 69, 3393, 100, 0, NULL, '2023-01-23 06:51:10'),
(94, 74, 69, 3411, 0, 100, 1, '2023-01-23 06:51:11'),
(95, 74, 69, 3391, 100, 0, NULL, '2023-01-23 06:51:42'),
(96, 74, 69, 3393, 100, 0, NULL, '2023-01-23 06:51:50'),
(97, 74, 69, 3395, 100, 0, NULL, '2023-01-23 06:51:51'),
(98, 74, 69, 3413, 100, 0, NULL, '2023-01-23 06:51:58'),
(99, 74, 69, 3423, 100, 0, NULL, '2023-01-23 06:51:59'),
(100, 74, 69, 3399, 100, 0, NULL, '2023-01-23 06:52:02'),
(101, 74, 69, 3409, 100, 0, 1, '2023-01-23 06:52:06'),
(102, 74, 69, 3406, 100, 0, 1, '2023-01-23 06:52:14'),
(103, 74, 69, 3395, 100, 0, NULL, '2023-01-23 06:52:18'),
(104, 74, 69, 3411, 0, 100, NULL, '2023-01-23 06:52:25'),
(105, 74, 69, 3395, 100, 0, NULL, '2023-01-23 06:52:33'),
(106, 74, 69, 3395, 0, 0, NULL, '2023-01-23 06:52:44'),
(107, 74, 69, 3395, 0, 0, NULL, '2023-01-23 06:52:53'),
(108, 74, 69, 3395, 0, 0, NULL, '2023-01-23 06:53:04'),
(109, 74, 69, 3393, 0, 0, NULL, '2023-01-23 06:53:15'),
(110, 74, 69, 3395, 0, 0, NULL, '2023-01-23 06:53:18'),
(111, 74, 69, 3395, 0, 0, NULL, '2023-01-23 06:53:29'),
(112, 74, 69, 3393, 0, 0, NULL, '2023-01-23 06:54:29'),
(113, 74, 69, 3389, 0, 0, NULL, '2023-03-15 15:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `qz_question`
--

CREATE TABLE `qz_question` (
  `qzq_id` int(11) NOT NULL,
  `z_id` int(11) NOT NULL,
  `tyz_id` int(11) NOT NULL,
  `tyq_id` int(11) NOT NULL,
  `tya_id` int(11) NOT NULL,
  `qzq_name` varchar(1000) NOT NULL,
  `qzq_image` varchar(500) DEFAULT NULL,
  `opt_1` varchar(1000) DEFAULT NULL,
  `opt_2` varchar(1000) DEFAULT NULL,
  `opt_3` varchar(1000) DEFAULT NULL,
  `opt_4` varchar(1000) DEFAULT NULL,
  `opt_5` varchar(1000) DEFAULT NULL,
  `qzq_answer` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qz_question`
--

INSERT INTO `qz_question` (`qzq_id`, `z_id`, `tyz_id`, `tyq_id`, `tya_id`, `qzq_name`, `qzq_image`, `opt_1`, `opt_2`, `opt_3`, `opt_4`, `opt_5`, `qzq_answer`) VALUES
(47, 69, 2, 2, 2, '<p>ถ้าออกแรงที่ปลายด้ามค้อน 60 N ซึ่งอยู่ห่างจากจุดหมุน 25 cm แล้วสามารถถอนตะปูที่อยู่ห่างจากจุดหมุน 6 cm ได้พอดี จงหาว่า ตะปูมีแรงยึดเท่าใด&nbsp;</p>', 'qz_1674449940.png', '', '', '', '', '', '250'),
(48, 69, 1, 2, 2, '<p>จากข้อที่ผ่านมา จงหาการได้เปรียบเชิงกลของค้อน<br>&nbsp;</p>', '', '', '', '', '', '', '4.17'),
(49, 61, 1, 1, 1, '<p>จงหาความเข้มสนามไฟฟ้าที่ระยะ 50 เซนติเมตร จากประจุ +10<sup>–4 </sup>คูลอมบ์ ว่าจะมีความเข้มกี่ นิวตัน/คูลอมบ์</p>', '', '<p>2.3 x 10<sup>6</sup> นิวตัน/คูลอมบ์&nbsp;</p>', '<p>5.6 x 10<sup>6</sup> นิวตัน/คูลอมบ์</p>', '<p>1.2 x 10<sup>6</sup> นิวตัน/คูลอมบ์</p>', '<p>&nbsp;3.6 x 10<sup>6</sup> นิวตัน/คูลอมบ์</p>', '<p>&nbsp;1.6 x 10<sup>6 </sup>นิวตัน/คูลอมบ์</p>', '4'),
(50, 61, 2, 1, 1, '<p>วางประจุ 3 x 10<sup>–3</sup> คูลอมบ์ , 2 x 10<sup>–3 </sup>คูลอมบ์ และ 8 x 10<sup>–3</sup> คูลอมบ์ ที่ตำแหน่ง A ,B และ C ตามลำดับ จงหาสนามไฟฟ้าที่ตำแหน่ง<br>B ในหน่วยของนิวตัน/ คูลอมบ์ AB = 3 เมตร , BC = 2 เมตร</p>', 'qz_1674702992.png', '<p>21 x 10<sup>6</sup></p>', '<p>15 x 10<sup>6</sup></p>', '<p>30 x 10<sup>6</sup></p>', '<p>42 x 10<sup>6</sup></p>', '', '1'),
(51, 58, 2, 1, 1, '<p>(แนว มช) เมื่อนำสาร ก. มาถูกับสาร ข. พบว่าสาร ก. มีประจุไฟฟ้าเกิดขึ้น สาร ก. ต้อง เป็นสาร<br>&nbsp;</p>', '', '<p>ตัวนำ&nbsp;</p>', '<p>ฉนวน</p>', '<p>&nbsp;กึ่งตัวนำ</p>', '<p>&nbsp;โลหะ</p>', '<p>ตัวนำยิ่งยวด</p>', '2'),
(52, 58, 2, 1, 1, '<p>ทรงกลมโลหะ A และ B วางสัมผัสกัน โดยยึดไว้ด้วยฉนวน เมื่อนาแท่งอิโบไนท์ซึ่งมีประจุลบเข้าใกล้ทรงกลม A ดังรูป จะมีประจุไฟฟ้า<br>ชนิดใด เกิดขึ้นที่ตัวนาทรงกลมทั้งสอง<br>&nbsp;</p>', 'qz_1675424544.png', '<p>ทรงกลมทั้งสองจะมีประจุบวก<br>&nbsp;</p>', '<p>ทรงกลมทั้งสองจะมีประจุลบ<br>&nbsp;</p>', '<p>ทรงกลม A จะมีประจุบวกและทรงกลม B มีประจุลบ<br>&nbsp;</p>', '<p>ทรงกลม A จะมีประจุลบและทรงกลม B มีประจุบวก</p>', '', '3'),
(53, 58, 2, 1, 1, '<p>เมื่อเรานำแท่งแก้วที่มีประจุไฟฟ้าบวกสะสมอยู่ไปจ่อใกล้เม็ดโฟมที่เป็นกลางทางไฟฟ้า แท่ง แก้วจะมีแรงดึงดูดเม็ดโฟมได้ หากเปลี่ยนแท่งแก้วเป็นแท่งพีวีซีที่มีประจุไฟฟ้าลบสะสมอยู่ ไปจ่อใกล้เม็ดโฟมแทน แท่งพีวีซีจะมีแรงดูดหรือแรงผลักเม็ดโฟม<br>&nbsp;</p>', '', '<p>ดูด&nbsp;</p>', '<p>ผลัก&nbsp;</p>', '<p>ดูดแล้วผลัก&nbsp;</p>', '<p>ผลักแล้วดูด</p>', '', '1'),
(54, 69, 1, 2, 2, '<p>(มช 41) ถ้าใช้พื้นเอียงผิวเกลี้ยงดังรูป เป็นเครื่องกลอันหนึ่งประสิทธิภาพของเครื่องกลอันนี้ มีค่าเท่าใด</p>', 'qz_1675425701.png', '', '', '', '', '', '75'),
(55, 69, 2, 2, 2, '<p>เครื่องกลแบบสกรูมีแขนหมุนยาว 50 เซนติเมตร และมีระยะเกลียว 3 มิลลิเมตร ถ้าออกแรงหมุนสกรู 3 นิวตัน จะสามารถยกน้ำหนักได้มากที่สุด 2200 นิวตัน จงหาประสิทธิภาพ ของเครื่องกลนี้</p>', '', '', '', '', '', '', '4.4'),
(56, 45, 2, 1, 1, '<p>วิชาฟิสิกส์ เป็นการศึกษาเกี่ยวกับอะไร<br>&nbsp;</p>', '', '<p>ศึกษาเกี่ยวกับสารเคมี<br>&nbsp;</p>', '<p>ศึกษาเกี่ยวกับเซลล์พืช<br>&nbsp;</p>', '<p>ศึกษาเกี่ยวกับปรากฏการณ์ธรรมชาติ<br>&nbsp;</p>', '<p>ถูกทุกข้อ</p>', '', '3'),
(57, 45, 2, 1, 1, '<p>ความรู้ใด ไม่ใช่ความรู้ในวิชาฟิสิกส์<br>&nbsp;</p>', '', '<p>กฎการเคลื่อนที่ของนิวตัน<br>&nbsp;</p>', '<p>เซลล์พืชและเซลล์สัตว์<br>&nbsp;</p>', '<p>แม่เหล็กไฟฟ้า<br>&nbsp;</p>', '<p>ฟิสิกส์อะตอม</p>', '', '2'),
(58, 45, 1, 1, 1, '<p>สิ่งใดต่อไปนี้ที่นักเรียนควรใช้พิจารณาความน่าเชื่อถือของข้อมูล<br>&nbsp;</p>', '', '<p>วิธีการสังเกต และเครื่องมือที่ใช้&nbsp;</p>', '<p>วิธีการสังเกต และทฤษฎีที่อ้างอิง<br>&nbsp;</p>', '<p>ทฤษฎีที่อ้างอิง และบุคคลที่สังเกต</p>', '<p>เวลาที่ใช้สังเกต และเครื่องมือที่ใช้</p>', '', '1'),
(59, 45, 1, 1, 1, '<p>&nbsp;พิจารณาข้อความต่อไปนี้<br>&nbsp;(1) &nbsp;อาวุธสงคราม &nbsp;(2) &nbsp;เทคโนโลยีการขนส่ง<br>&nbsp;(3) &nbsp;โรงงานอุตสาหกรรม &nbsp;(4) &nbsp;เทคโนโลยีการสื่อสาร<br>ข้อใดบ้างที่มีความสัมพันธ์กับความรู้ในวิชาฟิสิกส์โดยตรง<br>&nbsp;</p>', '', '<p>ข้อ (2) และ (4)&nbsp;</p>', '<p>ข้อ (1) และ (2)&nbsp;</p>', '<p>ข้อ (3) และ (4) &nbsp;</p>', '<p>ถูกทุกข้อ</p>', '', '4'),
(60, 46, 2, 1, 1, '<p>จงพิจารณาขอความต่อไปนี้<br>ก. มวล เวลา ความยาว เป็นปริมาณฐานทั้งหมด&nbsp;<br>ข. ความเร่ง ความดัน พลังงาน เป็นปริมาณอนุพันธ์ทั้งหมด&nbsp;<br>ค. ความเร็ว ความถี่ อุณหภูมิ เป็นปริมาณฐานทั้งหมด &nbsp;<br>คำตอบที่ถูกคือ&nbsp;<br>&nbsp;</p>', '', '<p>ข้อ ก และ ข &nbsp;&nbsp;</p>', '<p>ข้อ ข และ ค &nbsp;&nbsp;</p>', '<p>ข้อ ก และ ค &nbsp;</p>', '<p>&nbsp;ข้อ ก ข และ ค&nbsp;</p>', '', '1'),
(61, 46, 2, 1, 1, '<p><strong>ข้อใดเป็นปริมาณสเกลาร์ทั้งหมด&nbsp;</strong><br>&nbsp;</p>', '', '<p><strong>น้ำหนัก , ความดัน , ความเร่ง&nbsp;</strong></p>', '<p><strong>ระยะทาง , เวลา , อัตราเร็ว&nbsp;</strong><br>&nbsp;</p>', '<p><strong>ระยะทาง , อัตราเร็ว , ความเร็ว &nbsp;&nbsp;</strong></p>', '<p><strong>ระยะทาง , อัตราเร็ว , การกระจัด</strong></p>', '', '2'),
(62, 46, 1, 1, 1, '<p>ข้อใดต่อไปนี้เป็น หน่วยอนุพัทธ์ทั้งหมด</p><p><o:p></o:p></p>', '', '<p>เมตร องศาเซลเซียส เรเดียน คูลอมบ์ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>', '<p>นิวตัน กิโลกรัม วินาที โวลต์</p><p>&nbsp;</p>', '<p>เฮริตซ์ &nbsp;นิวตัน เมตร/วินาที &nbsp;พาสคาล &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '<p>กิโลกรัม โอห์ม วัตต์ พาสคาล</p>', '', '3'),
(63, 46, 1, 1, 1, '<p>หน่วยที่เป็นมาตรฐานสากลของปริมาณต่อไปนี้คือหน่วยอะไร ความยาว มวล เวลา กระแสไฟฟ้า</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p class=\"MsoNormal\">&nbsp;</p>', '', '<p>เซนติเมตร, กิโลกรัม&nbsp;, ชั่วโมง&nbsp;,แอมแปร์ &nbsp; &nbsp; &nbsp;&nbsp;<br>&nbsp;</p>', '<p>เมตร&nbsp;,กิโลกรัม&nbsp;, วินาที, แอมแปร์</p><p>&nbsp;</p>', '<p>กิโลเมตร, กิโลกรัม&nbsp;,วินาที,แอมแปร์ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '<p>มิลลิเมตร,กิโลกรัม&nbsp;,วินาที,แอมแปร์</p>', '', '2'),
(64, 47, 2, 1, 1, '<p>ปริมาณในข้อใดต่อไปนี้มีขนาดเล็กที่สุด&nbsp;<br>&nbsp;</p>', '', '<p>1 cm &nbsp;</p>', '<p>1 mm &nbsp;</p>', '<p>1 pm &nbsp;</p>', '<p>1 µm&nbsp;</p>', '<p>1 nm</p>', '3'),
(65, 47, 2, 1, 1, '<p>ปริมาณในข้อใดต่อไปนี้มีขนาดใหญ่ที่สุด&nbsp;<br>&nbsp;</p>', '', '<p>8 cg &nbsp;</p>', '<p>8 pg &nbsp;</p>', '<p>8 ng &nbsp;&nbsp;</p>', '<p>8 µg&nbsp;</p>', '<p>8 mg</p>', '1'),
(66, 47, 1, 1, 1, '<p>จงเปลี่ยนหน่วยมวลของโปรตอน 1.6 x10<sup>–27</sup> กิโลกรัม เป็นพิโคกรัม<br>&nbsp;</p>', '', '<p>1.6 x10<sup>–39 &nbsp;</sup></p>', '<p>1.6 x10<sup>–36 &nbsp;</sup>&nbsp;</p>', '<p>1.6 x10<sup>–15&nbsp;</sup>&nbsp;</p>', '<p>1.6 x10<sup>–12</sup></p>', '<p>1.6 x10<sup>–9</sup></p>', '3'),
(67, 47, 1, 1, 1, '<p>แสงเลเซอร์ชนิดฮีเลียม – นีออน ให้แสงสีแดงความยาวคลื่น 632.8 นาโนเมตร หรือเท่ากับ<br>&nbsp;</p>', '', '<p>6.328 x10<sup>–3 </sup>มิลลิเมตร &nbsp;&nbsp;</p>', '<p>6.328 x10<sup>–5</sup> เซนติเมตร<br>&nbsp;</p>', '<p>6.328 x10<sup>–18</sup> เมตร &nbsp; &nbsp;</p>', '<p>6.328 x10<sup>–12</sup> กิโลเมตร</p>', '<p>6.328 x10<sup>–2</sup> นาโนเมตร</p>', '2'),
(68, 48, 1, 2, 2, '<p><strong>พื้นที่ 2.5x10<sup>-5</sup> ตารางเมตร คิดเป็นกี่ตารางเซนติเมตร&nbsp;</strong><br><br>&nbsp;</p>', '', '', '', '', '', '', '   0.25'),
(69, 48, 2, 1, 1, '<p>ข้อใดคือขนาดของพื้นที่ ที่เล็กที่สุด<br>&nbsp;</p>', '', '<p>45000 &nbsp;ตารางมิลลิเมตร<br>&nbsp;</p>', '<p>4500 &nbsp; ตารางเซนติเมตร<br>&nbsp;</p>', '<p>45 &nbsp; &nbsp;ตารางเดคาเมตร<br>&nbsp;</p>', '<p>4.5 &nbsp; ตารางเดซิเมตร</p>', '', '3'),
(70, 49, 2, 1, 1, '<p>น้ำมีปริมาตร 120x10<sup>5</sup> &nbsp; ลูกบาศก์นาโนเมตร นำไปเทแบ่งใส่แก้วขนาดตามข้อใดจึงจะได้จำนวนแก้วมากที่สุด<br>&nbsp;</p>', '', '<p>500 ลูกบาศก์นาโนเมตร&nbsp;</p>', '<p>50 ลูกบาศก์เซนติเมตร<br>&nbsp;</p>', '<p>150 ลูกบาศก์มิลลิเมตร &nbsp;</p>', '<p>5 ลูกบาศก์ไมโครเมตร</p>', '', '1'),
(71, 49, 1, 1, 1, '<p>จงเปลี่ยน 120x10<sup>5</sup> ลูกบาศก์เซนติเมตร (cm<sup>3</sup>) ให้เป็นลูกบาศก์เมตร (m<sup>3</sup>)&nbsp;<br>&nbsp;</p>', '', '<p>1.2 x 10 <sup>-2&nbsp;</sup></p>', '<p>1.2 x 10<sup> -4&nbsp;</sup></p>', '<p>1.2 x 10<sup> 1</sup></p>', '<p>1.2 x 10 <sup>-2</sup></p>', '<p>1.2 x 10 <sup>-1</sup></p>', '3'),
(72, 49, 1, 1, 1, '<p>&nbsp;จงเปลี่ยน 120x10<sup>5</sup> ลูกบาศก์เมตร (m<sup>3</sup>) ให้เป็นลูกบาศก์เซนติเมตร (cm<sup>3</sup>)&nbsp;<br>&nbsp;</p>', '', '<p>1.2 x 10<sup> 11&nbsp;</sup></p>', '<p>1.2 x 10<sup> 12&nbsp;</sup></p>', '<p>1.2 x 10 <sup>13 &nbsp;</sup></p>', '<p>1.2 x 10<sup> 14</sup></p>', '<p>1.2 x 10<sup> 1</sup></p>', '3'),
(73, 50, 2, 1, 1, '<p>ความหนาแน่นของทองแดงคือ 8.93 g/m<sup>2</sup> คิดเป็น เท่าไรในหน่วย kg/m<sup>2&nbsp;</sup><br>&nbsp;</p>', '', '<p>8.93x10<sup> 4&nbsp;</sup></p>', '<p>8.93 x10<sup> 3&nbsp;</sup></p>', '<p>8.93 x10<sup> -4 &nbsp;</sup></p>', '<p>8.93 x10<sup> -3</sup></p>', '', '2'),
(74, 50, 1, 1, 1, '<p>รถยนต์คันหนึ่งวิ่งด้วยอัตราเร็ว 54 กิโลเมตรต่อชั่วโมง เท่ากับกี่เมตรต่อวินาที<br>&nbsp;</p>', '', '<p>10 m/s &nbsp;</p>', '<p>15 m /s &nbsp;</p>', '<p>20 m /s &nbsp;</p>', '<p>25 m /s</p>', '', '2'),
(75, 50, 1, 1, 1, '<p>จงเปลี่ยน 36 กิโลเมตรต่อชั่วโมงให้อยู่ในรูป เมตรต่อวินาที<br>&nbsp;</p>', '', '<p>10 เมตร/วินาที &nbsp;</p>', '<p>20 เมตร/วินาที&nbsp;</p>', '<p>30 เมตร/วินาที &nbsp;</p>', '<p>40 เมตร/วินาที</p>', '', '1'),
(76, 51, 1, 1, 1, '<p>ปูนซีเมนต์ 2 ตัน เท่ากับข้อใดต่อไปนี้ (1 ตัน คือ 1000 กิโลกรัม)<br>&nbsp;</p>', '', '<p>2 Gg&nbsp;</p>', '<p>2 Mg &nbsp;</p>', '<p>2 mg &nbsp;</p>', '<p>2 µg</p>', '', '2'),
(77, 51, 1, 1, 1, '<p>น้ำ 100 ลิตร เทียบได้เท่าใดในหน่วยลูกบาศก์เมตร ( 1000 ลิตร = 1 เมตร<sup>3</sup> )&nbsp;<br>&nbsp;</p>', '', '<p>10<sup>–4&nbsp;</sup>&nbsp;</p>', '<p>10<sup>–3 &nbsp;</sup>&nbsp;</p>', '<p>10<sup>–2&nbsp;</sup></p>', '<p>&nbsp;10<sup>–1</sup></p>', '', '4'),
(78, 52, 2, 1, 1, '<p>(4.7 ± 0.5) + (3.2 ± 0.3) มีผลลัพธ์เท่ากับข้อใด<br><o:p></o:p></p>', '', '<p>1.5 ± 0.2 &nbsp;&nbsp;</p>', '<p>1.5 ± 0.8 &nbsp;&nbsp;</p>', '<p>7.9 ± 0.2<br>&nbsp;</p>', '<p>4. 7.9 ± 0.8 &nbsp;</p>', '<p>ไม่มีข้อถูก</p>', '4'),
(79, 52, 1, 1, 1, '<p>วงกลมหนึ่งมีรัศมียาว 7.0 ± 0.7 เซนติเมตร ควรบันทึกพื้นที่วงกลมเป็น<br>&nbsp;</p>', '', '<p>49 ± 20 &nbsp;</p>', '<p>154 ± 20 &nbsp;</p>', '<p>49 ± 20%&nbsp;</p>', '<p>154 ± 20%&nbsp;</p>', '<p>ไม่มีข้อถูก</p>', '5');

-- --------------------------------------------------------

--
-- Table structure for table `reply_questionnaire`
--

CREATE TABLE `reply_questionnaire` (
  `ry_id` int(11) NOT NULL,
  `tp_id` int(11) NOT NULL,
  `cs_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `ry_number` int(11) NOT NULL,
  `save_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reply_questionnaire`
--

INSERT INTO `reply_questionnaire` (`ry_id`, `tp_id`, `cs_id`, `u_id`, `ry_number`, `save_date`) VALUES
(212, 1, 65, 3397, 5, '2023-01-23 06:41:11'),
(213, 2, 65, 3397, 5, '2023-01-23 06:41:11'),
(214, 3, 65, 3397, 5, '2023-01-23 06:41:11'),
(215, 4, 65, 3397, 5, '2023-01-23 06:41:11'),
(216, 5, 65, 3397, 5, '2023-01-23 06:41:11'),
(217, 6, 65, 3397, 5, '2023-01-23 06:41:11'),
(218, 7, 65, 3397, 5, '2023-01-23 06:41:11'),
(219, 8, 65, 3397, 5, '2023-01-23 06:41:11'),
(220, 9, 65, 3397, 5, '2023-01-23 06:41:11'),
(221, 10, 65, 3397, 5, '2023-01-23 06:41:11'),
(222, 1, 65, 3415, 4, '2023-01-23 06:41:17'),
(223, 2, 65, 3415, 4, '2023-01-23 06:41:17'),
(224, 3, 65, 3415, 3, '2023-01-23 06:41:17'),
(225, 4, 65, 3415, 4, '2023-01-23 06:41:17'),
(226, 5, 65, 3415, 5, '2023-01-23 06:41:17'),
(227, 6, 65, 3415, 4, '2023-01-23 06:41:17'),
(228, 7, 65, 3415, 5, '2023-01-23 06:41:17'),
(229, 8, 65, 3415, 4, '2023-01-23 06:41:17'),
(230, 9, 65, 3415, 4, '2023-01-23 06:41:17'),
(231, 10, 65, 3415, 4, '2023-01-23 06:41:17'),
(232, 1, 65, 3408, 5, '2023-01-23 06:41:18'),
(233, 2, 65, 3408, 5, '2023-01-23 06:41:18'),
(234, 3, 65, 3408, 5, '2023-01-23 06:41:18'),
(235, 4, 65, 3408, 5, '2023-01-23 06:41:18'),
(236, 5, 65, 3408, 5, '2023-01-23 06:41:18'),
(237, 6, 65, 3408, 5, '2023-01-23 06:41:18'),
(238, 7, 65, 3408, 5, '2023-01-23 06:41:18'),
(239, 8, 65, 3408, 5, '2023-01-23 06:41:18'),
(240, 9, 65, 3408, 5, '2023-01-23 06:41:18'),
(241, 10, 65, 3408, 5, '2023-01-23 06:41:18'),
(242, 1, 65, 3419, 4, '2023-01-23 06:43:19'),
(243, 2, 65, 3419, 3, '2023-01-23 06:43:19'),
(244, 3, 65, 3419, 3, '2023-01-23 06:43:19'),
(245, 4, 65, 3419, 3, '2023-01-23 06:43:19'),
(246, 5, 65, 3419, 3, '2023-01-23 06:43:19'),
(247, 6, 65, 3419, 4, '2023-01-23 06:43:19'),
(248, 7, 65, 3419, 3, '2023-01-23 06:43:19'),
(249, 8, 65, 3419, 3, '2023-01-23 06:43:19'),
(250, 9, 65, 3419, 3, '2023-01-23 06:43:19'),
(251, 10, 65, 3419, 3, '2023-01-23 06:43:19'),
(252, 1, 65, 3423, 5, '2023-01-23 06:44:26'),
(253, 2, 65, 3423, 5, '2023-01-23 06:44:26'),
(254, 3, 65, 3423, 4, '2023-01-23 06:44:26'),
(255, 4, 65, 3423, 5, '2023-01-23 06:44:26'),
(256, 5, 65, 3423, 5, '2023-01-23 06:44:26'),
(257, 6, 65, 3423, 4, '2023-01-23 06:44:26'),
(258, 7, 65, 3423, 5, '2023-01-23 06:44:26'),
(259, 8, 65, 3423, 3, '2023-01-23 06:44:26'),
(260, 9, 65, 3423, 3, '2023-01-23 06:44:26'),
(261, 10, 65, 3423, 5, '2023-01-23 06:44:26'),
(262, 1, 65, 3422, 3, '2023-01-23 06:44:58'),
(263, 2, 65, 3422, 4, '2023-01-23 06:44:58'),
(264, 3, 65, 3422, 3, '2023-01-23 06:44:58'),
(265, 4, 65, 3422, 3, '2023-01-23 06:44:58'),
(266, 5, 65, 3422, 3, '2023-01-23 06:44:58'),
(267, 6, 65, 3422, 4, '2023-01-23 06:44:58'),
(268, 7, 65, 3422, 4, '2023-01-23 06:44:58'),
(269, 8, 65, 3422, 3, '2023-01-23 06:44:58'),
(270, 9, 65, 3422, 2, '2023-01-23 06:44:58'),
(271, 10, 65, 3422, 3, '2023-01-23 06:44:58'),
(272, 1, 65, 3417, 4, '2023-01-23 06:45:24'),
(273, 2, 65, 3417, 3, '2023-01-23 06:45:24'),
(274, 3, 65, 3417, 5, '2023-01-23 06:45:24'),
(275, 4, 65, 3417, 3, '2023-01-23 06:45:24'),
(276, 5, 65, 3417, 3, '2023-01-23 06:45:24'),
(277, 6, 65, 3417, 5, '2023-01-23 06:45:24'),
(278, 7, 65, 3417, 3, '2023-01-23 06:45:24'),
(279, 8, 65, 3417, 3, '2023-01-23 06:45:24'),
(280, 9, 65, 3417, 4, '2023-01-23 06:45:24'),
(281, 10, 65, 3417, 4, '2023-01-23 06:45:24'),
(282, 1, 65, 3425, 3, '2023-01-23 06:45:30'),
(283, 2, 65, 3425, 3, '2023-01-23 06:45:30'),
(284, 3, 65, 3425, 3, '2023-01-23 06:45:30'),
(285, 4, 65, 3425, 2, '2023-01-23 06:45:30'),
(286, 5, 65, 3425, 4, '2023-01-23 06:45:30'),
(287, 6, 65, 3425, 3, '2023-01-23 06:45:30'),
(288, 7, 65, 3425, 4, '2023-01-23 06:45:30'),
(289, 8, 65, 3425, 3, '2023-01-23 06:45:30'),
(290, 9, 65, 3425, 3, '2023-01-23 06:45:30'),
(291, 10, 65, 3425, 5, '2023-01-23 06:45:30'),
(292, 1, 65, 3410, 3, '2023-01-23 06:48:08'),
(293, 2, 65, 3410, 4, '2023-01-23 06:48:08'),
(294, 3, 65, 3410, 3, '2023-01-23 06:48:08'),
(295, 4, 65, 3410, 4, '2023-01-23 06:48:08'),
(296, 5, 65, 3410, 4, '2023-01-23 06:48:08'),
(297, 6, 65, 3410, 5, '2023-01-23 06:48:08'),
(298, 7, 65, 3410, 5, '2023-01-23 06:48:08'),
(299, 8, 65, 3410, 4, '2023-01-23 06:48:08'),
(300, 9, 65, 3410, 4, '2023-01-23 06:48:08'),
(301, 10, 65, 3410, 4, '2023-01-23 06:48:08'),
(302, 1, 65, 3389, 4, '2023-02-05 12:15:00'),
(303, 2, 65, 3389, 5, '2023-02-05 12:15:00'),
(304, 3, 65, 3389, 4, '2023-02-05 12:15:00'),
(305, 4, 65, 3389, 5, '2023-02-05 12:15:00'),
(306, 5, 65, 3389, 5, '2023-02-05 12:15:00'),
(307, 6, 65, 3389, 4, '2023-02-05 12:15:00'),
(308, 7, 65, 3389, 5, '2023-02-05 12:15:00'),
(309, 8, 65, 3389, 4, '2023-02-05 12:15:00'),
(310, 9, 65, 3389, 5, '2023-02-05 12:15:00'),
(311, 10, 65, 3389, 5, '2023-02-05 12:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `sl_id` int(11) NOT NULL,
  `cr_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `save_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`sl_id`, `cr_id`, `u_id`, `save_date`) VALUES
(19, 12, 3389, '0000-00-00'),
(20, 12, 3390, '0000-00-00'),
(21, 12, 3391, '0000-00-00'),
(22, 12, 3392, '0000-00-00'),
(23, 12, 3393, '0000-00-00'),
(24, 12, 3394, '0000-00-00'),
(25, 12, 3395, '0000-00-00'),
(26, 12, 3396, '0000-00-00'),
(27, 12, 3397, '0000-00-00'),
(28, 12, 3398, '0000-00-00'),
(29, 12, 3399, '0000-00-00'),
(30, 12, 3400, '0000-00-00'),
(31, 12, 3401, '0000-00-00'),
(32, 12, 3402, '0000-00-00'),
(33, 12, 3403, '0000-00-00'),
(34, 12, 3404, '0000-00-00'),
(35, 12, 3405, '0000-00-00'),
(36, 12, 3406, '0000-00-00'),
(37, 12, 3407, '0000-00-00'),
(38, 12, 3408, '0000-00-00'),
(39, 12, 3409, '0000-00-00'),
(40, 12, 3410, '0000-00-00'),
(41, 12, 3411, '0000-00-00'),
(42, 12, 3371, '0000-00-00'),
(43, 12, 3413, '0000-00-00'),
(44, 12, 3414, '0000-00-00'),
(45, 12, 3415, '0000-00-00'),
(46, 12, 3416, '0000-00-00'),
(47, 12, 3417, '0000-00-00'),
(48, 12, 3418, '0000-00-00'),
(49, 12, 3419, '0000-00-00'),
(50, 12, 3420, '0000-00-00'),
(51, 12, 3421, '0000-00-00'),
(52, 12, 3422, '0000-00-00'),
(53, 12, 3423, '0000-00-00'),
(54, 12, 3424, '0000-00-00'),
(55, 12, 3425, '0000-00-00'),
(56, 12, 3426, '0000-00-00'),
(57, 12, 3427, '0000-00-00'),
(58, 12, 3428, '0000-00-00'),
(59, 13, 3429, '0000-00-00'),
(60, 13, 3430, '0000-00-00'),
(61, 13, 3431, '0000-00-00'),
(62, 13, 3432, '0000-00-00'),
(63, 13, 3433, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `sub_lesson`
--

CREATE TABLE `sub_lesson` (
  `sls_id` int(11) NOT NULL,
  `sls_name` varchar(500) NOT NULL,
  `sls_detail` varchar(1000) DEFAULT NULL,
  `sls_youtube` varchar(250) DEFAULT NULL,
  `sls_sheet` varchar(250) DEFAULT NULL,
  `sls_answer` varchar(250) DEFAULT NULL,
  `sls_refer` varchar(2000) DEFAULT NULL,
  `sls_img` varchar(250) DEFAULT NULL,
  `ls_id` int(11) NOT NULL,
  `ex_id` int(11) NOT NULL,
  `z_id` int(11) NOT NULL,
  `save_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_lesson`
--

INSERT INTO `sub_lesson` (`sls_id`, `sls_name`, `sls_detail`, `sls_youtube`, `sls_sheet`, `sls_answer`, `sls_refer`, `sls_img`, `ls_id`, `ex_id`, `z_id`, `save_time`, `update_time`) VALUES
(73, 'ธรรมชาติของฟิสิกส์', '', 'SFGzp5TZuRE', '', '', '', 'img_1675598644.png', 52, 54, 45, '2023-11-13 02:12:19', '2023-11-13 02:12:19'),
(74, 'เครื่องกล', '', 'Z8C8XZU3yIQ', '', '', '<p><ytd-channel-name class=\"style-scope ytd-video-owner-renderer\" style=\"-webkit-text-stroke-width:0px;align-self:flex-start;background-color:rgb(255, 255, 255);color:rgb(15, 15, 15);display:flex;flex-direction:row;font-family:Roboto, Arial, sans-serif;font-size:1.6rem;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:500;letter-spacing:normal;line-height:2.2rem;max-width:100%;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;z-index:300;\" id=\"channel-name\"></ytd-channel-name></p><div class=\"style-scope ytd-channel-name\" style=\"background-color:transparent;border-width:0px;display:var(--ytd-channel-name-container-display,inline-block);margin:0px;max-width:100%;overflow:hidden;padding:0px;\" id=\"container\"><div class=\"style-scope ytd-channel-name\" style=\"background-color:transparent;border-width:0px;display:var(--ytd-channel-name-text-container-display,block);margin:0px;padding:0px;\" id=\"text-container\"><yt-formatted-string class=\"style-scope ytd-channel-name complex-string\" style=\"-webkit-box-orient:vertical;-webkit-line-clamp:var(--ytd-channel-name-text-line-clamp,inherit);display:var(--ytd-channel-name-text-complex-display);flex-direction:row;font-size:var(--ytd-channel-name-text-font-size);font-weight:var(--ytd-channel-name-text-font-weight);line-height:var(--ytd-channel-name-text-line-height);overflow:hidden;text-overflow:ellipsis;white-space:pre;word-break:break-word;\" id=\"text\" link-inherit-color=\"\" title=\"\" ellipsis-truncate=\"\" ellipsis-truncate-styling=\"\" has-link-only_=\"\"></yt-formatted-string></div></div>', 'img_1674448983.png', 53, 79, 69, '2023-11-13 02:12:19', '2023-11-13 02:12:19');

-- --------------------------------------------------------

--
-- Table structure for table `top_questionnaire`
--

CREATE TABLE `top_questionnaire` (
  `tp_id` int(11) NOT NULL,
  `tp_name` varchar(500) NOT NULL,
  `del_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `top_questionnaire`
--

INSERT INTO `top_questionnaire` (`tp_id`, `tp_name`, `del_status`) VALUES
(1, 'บทเรียนได้รับการออกแบบให้ผู้เรียนค้นหาเนื้อหาได้ง่ายและตรงตามความต้องการ                                ', 0),
(2, 'คำแนะนำในการเรียนรู้เหมาะสม เข้าใจง่าย เหมาะสมกับกลุ่มนักเรียน', 0),
(3, 'บทเรียนออนไลน์ ช่วยให้นักเรียนเอาใจใส่ต่อการเรียนมากขึ้น', 0),
(4, 'บทเรียนออนไลน์ ช่วยให้นักเรียนมีความคิดสร้างสรรค์มากขึ้น', 0),
(5, 'การลงทะเบียนเรียนและการเข้าเรียน', 0),
(6, 'นักเรียนทราบคะแนนเป็นรายบุคคลได้ทันที', 0),
(7, 'ความเหมาะสมของการใช้สี ภาพ และตัวอักษร', 0),
(8, 'ความน่าสนใจและดึงดูดความสนใจ', 0),
(9, 'ภาษาที่ใช้ในบทเรียนออนไลน์ เข้าใจง่าย', 0),
(10, 'เนื้อหามีความถูกต้องและทันสมัย', 0);

-- --------------------------------------------------------

--
-- Table structure for table `type_answer`
--

CREATE TABLE `type_answer` (
  `tya_id` int(11) NOT NULL,
  `tya_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_answer`
--

INSERT INTO `type_answer` (`tya_id`, `tya_name`) VALUES
(1, 'แบบปรนัย'),
(2, 'แบบอัตรนัย'),
(3, 'แบบใช่หรือไม่');

-- --------------------------------------------------------

--
-- Table structure for table `type_notification`
--

CREATE TABLE `type_notification` (
  `tyn_id` int(11) NOT NULL,
  `tyn_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_question`
--

CREATE TABLE `type_question` (
  `tyq_id` int(11) NOT NULL,
  `tyq_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_question`
--

INSERT INTO `type_question` (`tyq_id`, `tyq_name`) VALUES
(1, 'แบบปรนัย'),
(2, 'แบบอัตรนัย'),
(3, 'แบบใช่หรือไม่');

-- --------------------------------------------------------

--
-- Table structure for table `type_quiz`
--

CREATE TABLE `type_quiz` (
  `tyz_id` int(11) NOT NULL,
  `tyz_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_quiz`
--

INSERT INTO `type_quiz` (`tyz_id`, `tyz_name`) VALUES
(1, 'P'),
(2, 'K');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `std_code` varchar(50) DEFAULT NULL,
  `pkname` varchar(50) NOT NULL,
  `fname` varchar(500) NOT NULL,
  `lname` varchar(500) NOT NULL,
  `nkname` varchar(250) DEFAULT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `accept` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `age` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `school` varchar(500) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `save_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `std_code`, `pkname`, `fname`, `lname`, `nkname`, `username`, `password`, `email`, `phone`, `accept`, `status`, `age`, `level`, `school`, `city`, `photo`, `save_date`) VALUES
(3349, '654101', 'นาย', 'วราเชล', 'สังกิจ', NULL, 'up654101', '654101', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3350, '654102', 'นาย', 'กันตพงศ์', 'วดีศิริศักดิ์', NULL, 'up654102', '654102', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3351, '654103', 'นาย', 'ธรรมรัตน์', 'ศรีสร้อย', NULL, 'up654103', '654103', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3352, '654104', 'นาย', 'ธีรดล', 'เปี้ยมั่น', NULL, 'up654104', '654104', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3353, '654105', 'นาย', 'พงษ์พญา', 'คำหา', NULL, 'up654105', '654105', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3354, '654106', 'นาย', 'ภัทรพล', 'ยะภักดี', NULL, 'up654106', '654106', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3355, '654107', 'นาย', 'ชนะชัย', 'มาตชัยเคน', NULL, 'up654107', '654107', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3356, '654108', 'นาย', 'วชิรวิชญ์', 'มณีปกรณ์', NULL, 'up654108', '654108', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3357, '654109', 'นาย', 'ถิรวัฒน์', 'ชัยปัญหา', NULL, 'up654109', '654109', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3358, '654110', 'นาย', 'ธนวัฒน์', 'นาสิงเตา', NULL, 'up654110', '654110', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3359, '654111', 'นางสาว', 'กวินทิพย์', 'นาโควงค์', NULL, 'up654111', '654111', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3360, '654112', 'นางสาว', 'ญาณิดา', 'วะชุม', NULL, 'up654112', '654112', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3361, '654113', 'นางสาว', 'นวรัตน์', 'ไชยมงค์', NULL, 'up654113', '654113', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3362, '654114', 'นางสาว', 'นันท์นภัส', 'วรรณธุ', NULL, 'up654114', '654114', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3363, '654115', 'นางสาว', 'ปรายตะวัน', 'อ้อยรักษา', NULL, 'up654115', '654115', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3364, '654116', 'นางสาว', 'วรัญญา', 'วะไพลุน', NULL, 'up654116', '654116', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3365, '654117', 'นางสาว', 'จันทราทิพย์', 'วะชุม', NULL, 'up654117', '654117', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3366, '654118', 'นางสาว', 'ญาดาวดี', 'ไชยมงค์', NULL, 'up654118', '654118', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3367, '654119', 'นางสาว', 'ปนัดดา', 'เสียวคำ', NULL, 'up654119', '654119', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3368, '654120', 'นางสาว', 'ปริญญากร', 'ชีแพง', NULL, 'up654120', '654120', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3369, '654121', 'นางสาว', 'สิรินดา', 'ดีแสง', NULL, 'up654121', '654121', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3370, '654122', 'นางสาว', 'สมัชญา', 'วะชุม', NULL, 'up654122', '654122', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3371, '654123', 'นางสาว', 'กัลยารัตน์', 'ลาสุด', NULL, 'up654123', '654123', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3372, '654124', 'นางสาว', 'อธิชา', 'สถิตบรรจง', NULL, 'up654124', '654124', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3373, '654125', 'นางสาว', 'กัลยกร', 'จันทร', NULL, 'up654125', '654125', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3374, '654126', 'นางสาว', 'ขวัญจิรา', 'ชัยปัญหา', NULL, 'up654126', '654126', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3375, '654127', 'นางสาว', 'ฉัตริน', 'เตรียมตัว', NULL, 'up654127', '654127', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3376, '654128', 'นางสาว', 'ณัฐนิชา', 'ป้องปาน', NULL, 'up654128', '654128', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3377, '654129', 'นางสาว', 'ธนัญญา', 'วงค์แก้ว', NULL, 'up654129', '654129', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3378, '654130', 'นางสาว', 'ปรินดา', 'แมดมิ่งเหง้า', NULL, 'up654130', '654130', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3379, '654131', 'นางสาว', 'ปาริฉัตร', 'คำชนะ', NULL, 'up654131', '654131', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3380, '654132', 'นางสาว', 'ปาลิตา', 'ไอยสุริยสมบัติ', NULL, 'up654132', '654132', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3381, '654133', 'นางสาว', 'พรพูนทรัพย์', 'ชัยมุงคุณ', NULL, 'up654133', '654133', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3382, '654134', 'นางสาว', 'พีระนันท์', 'ยงกุล', NULL, 'up654134', '654134', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3383, '654135', 'นางสาว', 'ภัทรภร', 'โม้ลาย', NULL, 'up654135', '654135', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3384, '654136', 'นางสาว', 'เมวษ์ดี', 'มาตชัยเคน', NULL, 'up654136', '654136', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3385, '654137', 'นางสาว', 'ศิริรัตน์', 'มาตชัยเคน', NULL, 'up654137', '654137', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3386, '654138', 'นางสาว', 'สาวิกา', 'เกษกิ่งวรรณ์', NULL, 'up654138', '654138', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3387, '654139', 'นางสาว', 'สุภัทรา', 'กงภูธร', NULL, 'up654139', '654139', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3388, '654140', 'นางสาว', 'สุริวิภา', 'แก้วอินธิ', NULL, 'up654140', '654140', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3389, '654201', 'นาย', 'จารุวัต', 'เปาวะนา', NULL, 'up654201', '654201', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3390, '654202', 'นาย', 'กรวิทย์', 'จามะลา', NULL, 'up654202', '654202', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3391, '654203', 'นาย', 'นรสิงห์', 'สุวรรณมาโจ', NULL, 'up654203', '654203', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3392, '654204', 'นาย', 'นันทกร', 'บุษบา', NULL, 'up654204', '654204', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3393, '654205', 'นาย', 'พุทธิเมธ', 'อุสาพรหม', NULL, 'up654205', '654205', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3394, '654206', 'นาย', 'ภูริพันธ์', 'ผานคำ', NULL, 'up654206', '654206', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3395, '654207', 'นาย', 'ศุภกร', 'พวงพั้ว', NULL, 'up654207', '654207', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3396, '654208', 'นาย', 'ชรัลวิทย์', 'บุพศิริ', NULL, 'up654208', '654208', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3397, '654209', 'นาย', 'กันตพงษ์', 'วะชุม', NULL, 'up654209', '654209', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3398, '654210', 'นาย', 'ฐิติพงษ์', 'สาดี', NULL, 'up654210', '654210', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3399, '654211', 'นาย', 'ธีรโชติ', 'ปัญญาสาร', NULL, 'up654211', '654211', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3400, '654212', 'นาย', 'ทักษิณ', 'ชาสงวน', NULL, 'up654212', '654212', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3401, '654213', 'นาย', 'จักรินทร์', 'วะลับ', NULL, 'up654213', '654213', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3402, '654214', 'นาย', 'รัชชานนท์', 'วะชุม', NULL, 'up654214', '654214', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3403, '654215', 'นาย', 'วีรวิชญ์', 'ครึกครื้นจิตร', NULL, 'up654215', '654215', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3404, '654216', 'นาย', 'ศรายุทธ์', 'ไชยกา', NULL, 'up654216', '654216', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3405, '654217', 'นาย', 'เสฎฐวุฒิ', 'โพธิ์ศรี', NULL, 'up654217', '654217', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3406, '654218', 'นาย', 'ไกรวิทย์', 'เปาวะนา', NULL, 'up654218', '654218', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3407, '654219', 'นาย', 'ณัฐกิตต์', 'วะสาร', NULL, 'up654219', '654219', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3408, '654220', 'นาย', 'ณัฐวุฒิ', 'ชัยบิน', NULL, 'up654220', '654220', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3409, '654221', 'นาย', 'ตรีเพชร', 'อ้อยรักษา', NULL, 'up654221', '654221', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3410, '654222', 'นาย', 'รชานนท์', 'ประกิ่ง', NULL, 'up654222', '654222', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3411, '654223', 'นาย', 'สุวรรณภูมิ', 'ไชยหมื่น', NULL, 'up654223', '654223', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3412, '654224', 'นางสาว', 'กัลยารัตน์', 'ลิภา', NULL, 'up654224', '654224', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3413, '654225', 'นางสาว', 'ณิชกานต์', 'วงศรีชู', NULL, 'up654225', '654225', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3414, '654226', 'นางสาว', 'อรัญญา', 'เลื่อมนาค', NULL, 'up654226', '654226', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3415, '654227', 'นางสาว', 'ธันยกานต์', 'มูลตีเสาร์', NULL, 'up654227', '654227', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3416, '654228', 'นางสาว', 'บุณยาพร', 'โพธิ์งาม', NULL, 'up654228', '654228', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3417, '654229', 'นางสาว', 'ลิสา', 'นาขะมิน', NULL, 'up654229', '654229', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3418, '654230', 'นางสาว', 'สุธาสินี', 'บุพศิริ', NULL, 'up654230', '654230', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3419, '654231', 'นางสาว', 'อิงดาว', 'เจ๊ะอาแว', NULL, 'up654231', '654231', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3420, '654232', 'นางสาว', 'กรรณิกา', 'ภูเกิดพิมพ์', NULL, 'up654232', '654232', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3421, '654233', 'นางสาว', 'ชลธิดา', 'จันทฤาไชย', NULL, 'up654233', '654233', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3422, '654234', 'นางสาว', 'ณัฏฐณิชา', 'ปัญญาสาร', NULL, 'up654234', '654234', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3423, '654235', 'นางสาว', 'ณัฐฐาวรนุช', 'ชัยบิน', NULL, 'up654235', '654235', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3424, '654236', 'นางสาว', 'เพ็ญพิชชา', 'มีไกรลาศ', NULL, 'up654236', '654236', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3425, '654237', 'นางสาว', 'รัญชิดา', 'ไชยตา', NULL, 'up654237', '654237', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3426, '654238', 'นางสาว', 'ศญาณินท์', 'รัตนไพบูลย์', NULL, 'up654238', '654238', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3427, '654239', 'นางสาว', 'อรชพร', 'สมพร', NULL, 'up654239', '654239', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3428, '654240', 'นาย', 'ก้องกมล', 'ศรีอุทัย', NULL, 'up654240', '654240', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3429, '655101', 'นาย', 'พีรพัฒน์', 'หาทำ', NULL, 'up655101', '655101', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3430, '655102', 'นาย', 'ภัทรดนัย', 'น้อยนาง', NULL, 'up655102', '655102', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3431, '655103', 'นาย', 'รัชพล', 'ลิภา', NULL, 'up655103', '655103', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3432, '655104', 'นาย', 'สุรนาท', 'คำหอม', NULL, 'up655104', '655104', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3433, '655105', 'นาย', 'ชำนาญวิทย์', 'รักษาเคน', NULL, 'up655105', '655105', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3434, '655106', 'นาย', 'ภควัต', 'ภูกองไชย', NULL, 'up655106', '655106', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3435, '655107', 'นาย', 'ศิริชัย', 'ประกิ่ง', NULL, 'up655107', '655107', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3436, '655108', 'นาย', 'เจษฎา', 'บุญเรืองศรี', NULL, 'up655108', '655108', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3437, '655109', 'นางสาว', 'ธิดารัตน์', 'ราชพงษ์', NULL, 'up655109', '655109', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3438, '655110', 'นางสาว', 'ภูริษาร์', 'มั่นธง', NULL, 'up655110', '655110', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3439, '655111', 'นางสาว', 'วรนุช', 'ดีแสง', NULL, 'up655111', '655111', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3440, '655112', 'นางสาว', 'สุจิรา', 'วะชุม', NULL, 'up655112', '655112', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3441, '655113', 'นางสาว', 'ณัฐริกา', 'อ้อยรักษา', NULL, 'up655113', '655113', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3442, '655114', 'นางสาว', 'ทักษพร', 'โคตบิน', NULL, 'up655114', '655114', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3443, '655115', 'นางสาว', 'สุชาดา', 'สิงหเสนี', NULL, 'up655115', '655115', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3444, '655116', 'นางสาว', 'นุจิฬา', 'วงษาเนาว์', NULL, 'up655116', '655116', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3445, '655117', 'นางสาว', 'วริศรา', 'เสนสุข', NULL, 'up655117', '655117', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3446, '655118', 'นางสาว', 'อรปรียา', 'ชาทิพย์ฮด', NULL, 'up655118', '655118', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3447, '655119', 'นางสาว', 'เณรัญชลา', 'กัณสินธุ์', NULL, 'up655119', '655119', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3448, '655120', 'นางสาว', 'เมวารินทร์', 'นาโควงค์', NULL, 'up655120', '655120', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3449, '655121', 'นางสาว', 'อภิสรา', 'คะมุง', NULL, 'up655121', '655121', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3450, '655122', 'นางสาว', 'รัชนีกร', 'เสนสุข', NULL, 'up655122', '655122', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3451, '655123', 'นางสาว', 'จิตรทิวา', 'น้องนาง', NULL, 'up655123', '655123', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3452, '655124', 'นางสาว', 'จุฑารัตน์', 'ชินโคตร', NULL, 'up655124', '655124', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3453, '655125', 'นางสาว', 'ณัฐติยา', 'ขันทะชา', NULL, 'up655125', '655125', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3454, '655126', 'นางสาว', 'นภาพร', 'อรสินธุ์', NULL, 'up655126', '655126', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3455, '655127', 'นางสาว', 'บัณฑิตา', 'วงค์วีรัตน์', NULL, 'up655127', '655127', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3456, '655128', 'นางสาว', 'ปรางมณี', 'ค่องค้อย', NULL, 'up655128', '655128', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3457, '655129', 'นาย', 'กันตยศ', 'แพงษา', NULL, 'up655129', '655129', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3458, '655130', 'นาย', 'ภูมิพัฒน์', 'ไชยมงค์', NULL, 'up655130', '655130', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3459, '655131', 'นางสาว', 'ปัทมาภรณ์', 'วะลับ', NULL, 'up655131', '655131', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3460, '655201', 'นาย', 'พรชัย', 'โคมทอง', NULL, 'up655201', '655201', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3461, '655202', 'นาย', 'วรายุทธ', 'ปิลอง', NULL, 'up655202', '655202', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3462, '655203', 'นาย', 'ธนวัฒน์', 'พรมทอง', NULL, 'up655203', '655203', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3463, '655204', 'นาย', 'จักริน', 'ศรีภู', NULL, 'up655204', '655204', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3464, '655205', 'นาย', 'ณัฐพล', 'วะเกิดเป้ม', NULL, 'up655205', '655205', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3465, '655206', 'นาย', 'ณัฐพงศ์', 'ผาสีดา', NULL, 'up655206', '655206', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3466, '655207', 'นาย', 'ธนนท์', 'ศิริวุธ', NULL, 'up655207', '655207', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3467, '655208', 'นาย', 'จักรี', 'เสนสุข', NULL, 'up655208', '655208', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3468, '655209', 'นาย', 'จิรภัทร', 'อินอุเทน', NULL, 'up655209', '655209', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3469, '655210', 'นาย', 'สุทธิภัทร', 'ปิลอง', NULL, 'up655210', '655210', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3470, '655211', 'นาย', 'ธีรพัฒน์', 'โคตะบิน', NULL, 'up655211', '655211', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3471, '655212', 'นางสาว', 'นวนันท์', 'วะเศษสร้อย', NULL, 'up655212', '655212', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3472, '655213', 'นางสาว', 'ประกายกาญจน์', 'คูลิน', NULL, 'up655213', '655213', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3473, '655214', 'นางสาว', 'ภัทรียา', 'วะชุม', NULL, 'up655214', '655214', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3474, '655215', 'นางสาว', 'จรรยพร', 'โคตะพรม', NULL, 'up655215', '655215', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3475, '655216', 'นางสาว', 'บุษรินทร์', 'โคตบิน', NULL, 'up655216', '655216', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3476, '655217', 'นางสาว', 'วรัญญา', 'อุสาพรหม', NULL, 'up655217', '655217', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3477, '655218', 'นางสาว', 'เนตรปรียา', 'สุวรรณมาโจ', NULL, 'up655218', '655218', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3478, '655219', 'นางสาว', 'มลฤดี', 'คะสุดใจ', NULL, 'up655219', '655219', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3479, '655220', 'นางสาว', 'วัชราภรณ์', 'บุตรจันทร์', NULL, 'up655220', '655220', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3480, '655221', 'นางสาว', 'ณัฐธิดา', 'ลิภา', NULL, 'up655221', '655221', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3481, '655222', 'นางสาว', 'ปิยมาศ', 'ก้อนทอง', NULL, 'up655222', '655222', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3482, '655223', 'นางสาว', 'ศศิวิภา', 'ตุธิรัตน์', NULL, 'up655223', '655223', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3483, '655224', 'นางสาว', 'ศิริขวัญ', 'ลาโม', NULL, 'up655224', '655224', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3484, '655225', 'นางสาว', 'สิริกร', 'แสงสุวรรณดี', NULL, 'up655225', '655225', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3485, '655226', 'นางสาว', 'อารยา', 'สวนหลวง', NULL, 'up655226', '655226', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3486, '655227', 'นางสาว', 'อินทิรา', 'นาสิงเตา', NULL, 'up655227', '655227', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3487, '655228', 'นางสาว', 'ธิวารัตน์', 'วะชุม', NULL, 'up655228', '655228', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3488, '655229', 'นางสาว', 'สุธาวัลย์', 'คะสุดใจ', NULL, 'up655229', '655229', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3489, '655230', 'นางสาว', 'สุทธิดา', 'แดงสีสุก', NULL, 'up655230', '655230', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02'),
(3490, '655231', 'นาย', 'วัชรินทร์', 'เปี้ยมั่น', NULL, 'up655231', '655231', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 12:33:02');

-- --------------------------------------------------------

--
-- Table structure for table `web_banner`
--

CREATE TABLE `web_banner` (
  `id` int(11) NOT NULL,
  `bn_name` varchar(250) NOT NULL,
  `bn_img` varchar(250) NOT NULL,
  `bn_status` int(11) NOT NULL DEFAULT 0,
  `save_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `web_banner`
--

INSERT INTO `web_banner` (`id`, `bn_name`, `bn_img`, `bn_status`, `save_date`) VALUES
(6, 'สไลด์1', 'img_1674184747.jpg', 1, '2023-01-20 03:19:07'),
(7, 'สไลด์2', 'img_1674184775.jpg', 1, '2023-01-20 03:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `web_contact`
--

CREATE TABLE `web_contact` (
  `id` int(11) NOT NULL,
  `ct_name` varchar(500) NOT NULL,
  `save_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `web_contact`
--

INSERT INTO `web_contact` (`id`, `ct_name`, `save_date`) VALUES
(1, 'เบอร์โทร :  062-989-6698', '2022-12-09 08:03:59'),
(3, 'Email : croonaii911@gmail.com', '2022-12-09 08:04:51'),
(4, 'Facebook : ไน๋ไน๋ก็ไน๋ไน๋', '2022-12-09 08:05:01'),
(5, 'Line ID : croonaii', '2022-12-09 08:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `web_data`
--

CREATE TABLE `web_data` (
  `id` int(11) NOT NULL,
  `wn_name` varchar(250) NOT NULL,
  `wn_logo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `web_data`
--

INSERT INTO `web_data` (`id`, `wn_name`, `wn_logo`) VALUES
(1, 'คอร์สเรียนฟิสิกส์ออนไลน์', 'img_1670492375.png');

-- --------------------------------------------------------

--
-- Table structure for table `web_obj`
--

CREATE TABLE `web_obj` (
  `id` int(11) NOT NULL,
  `obj_name` varchar(500) NOT NULL,
  `save_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `web_obj`
--

INSERT INTO `web_obj` (`id`, `obj_name`, `save_date`) VALUES
(1, 'เพื่อสร้างแหล่งเรียนรู้ที่นักเรียนสามารถ เข้าถึงได้ทุกที่ทุกเวลา', '2022-12-09 07:53:43'),
(3, 'เพื่อสร้างแหล่งเรียนรู้ที่นักเรียนสามารถศึกษา ทบทวนและฝึกทักษะต่าง ๆ ในการแก้โจทย์ปัญหาในรายวิชาฟิสิกส์', '2022-12-09 08:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `web_page`
--

CREATE TABLE `web_page` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `img` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `web_page`
--

INSERT INTO `web_page` (`id`, `name`, `img`) VALUES
(1, 'เกี่ยวกับเรา', 'img_1674186512.png'),
(2, 'คำถามที่พบบ่อย', 'img_1674186529.png'),
(3, 'ช่วยเหลือ', 'img_1674186589.png');

-- --------------------------------------------------------

--
-- Table structure for table `web_view`
--

CREATE TABLE `web_view` (
  `w_id` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_view`
--

INSERT INTO `web_view` (`w_id`, `number`) VALUES
(1, 738);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_room`
--
ALTER TABLE `class_room`
  ADD PRIMARY KEY (`cr_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cs_id`);

--
-- Indexes for table `course_lesson`
--
ALTER TABLE `course_lesson`
  ADD PRIMARY KEY (`csl_id`),
  ADD KEY `cs_id` (`cs_id`,`ls_id`),
  ADD KEY `ls_id` (`ls_id`);

--
-- Indexes for table `course_register`
--
ALTER TABLE `course_register`
  ADD PRIMARY KEY (`rs_id`),
  ADD KEY `cs_id` (`cs_id`,`cr_id`,`u_id`),
  ADD KEY `cr_id` (`cr_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`ex_id`);

--
-- Indexes for table `ex_question`
--
ALTER TABLE `ex_question`
  ADD PRIMARY KEY (`exq_id`),
  ADD KEY `ex_id` (`ex_id`,`tyq_id`,`tya_id`),
  ADD KEY `tyq_id` (`tyq_id`),
  ADD KEY `tya_id` (`tya_id`);

--
-- Indexes for table `ex_status`
--
ALTER TABLE `ex_status`
  ADD PRIMARY KEY (`exa_id`),
  ADD KEY `sls_id` (`sls_id`,`ex_id`,`u_id`),
  ADD KEY `ex_id` (`ex_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`ls_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`non_id`),
  ADD KEY `tyn_id` (`tyn_id`);

--
-- Indexes for table `pass_new`
--
ALTER TABLE `pass_new`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `press_heart`
--
ALTER TABLE `press_heart`
  ADD PRIMARY KEY (`ph_id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`pg_id`),
  ADD KEY `sls_id` (`sls_id`,`u_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `cs_id` (`cs_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`z_id`);

--
-- Indexes for table `qz_answer`
--
ALTER TABLE `qz_answer`
  ADD PRIMARY KEY (`qza_id`),
  ADD KEY `qzq_id` (`qzq_id`,`u_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `sls_id` (`sls_id`);

--
-- Indexes for table `qz_point`
--
ALTER TABLE `qz_point`
  ADD PRIMARY KEY (`qzp_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `sls_id` (`sls_id`),
  ADD KEY `z_id` (`z_id`);

--
-- Indexes for table `qz_question`
--
ALTER TABLE `qz_question`
  ADD PRIMARY KEY (`qzq_id`),
  ADD KEY `z_id` (`z_id`,`tyq_id`,`tya_id`),
  ADD KEY `tyq_id` (`tyq_id`),
  ADD KEY `tya_id` (`tya_id`),
  ADD KEY `tyz_id` (`tyz_id`);

--
-- Indexes for table `reply_questionnaire`
--
ALTER TABLE `reply_questionnaire`
  ADD PRIMARY KEY (`ry_id`),
  ADD KEY `tp_id` (`tp_id`,`cs_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `cs_id` (`cs_id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`sl_id`),
  ADD KEY `cr_id` (`cr_id`,`u_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `sub_lesson`
--
ALTER TABLE `sub_lesson`
  ADD PRIMARY KEY (`sls_id`),
  ADD KEY `ls_id` (`ls_id`),
  ADD KEY `ex_id` (`ex_id`);

--
-- Indexes for table `top_questionnaire`
--
ALTER TABLE `top_questionnaire`
  ADD PRIMARY KEY (`tp_id`);

--
-- Indexes for table `type_answer`
--
ALTER TABLE `type_answer`
  ADD PRIMARY KEY (`tya_id`);

--
-- Indexes for table `type_notification`
--
ALTER TABLE `type_notification`
  ADD PRIMARY KEY (`tyn_id`);

--
-- Indexes for table `type_question`
--
ALTER TABLE `type_question`
  ADD PRIMARY KEY (`tyq_id`);

--
-- Indexes for table `type_quiz`
--
ALTER TABLE `type_quiz`
  ADD PRIMARY KEY (`tyz_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_banner`
--
ALTER TABLE `web_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_contact`
--
ALTER TABLE `web_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_data`
--
ALTER TABLE `web_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_obj`
--
ALTER TABLE `web_obj`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_page`
--
ALTER TABLE `web_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_view`
--
ALTER TABLE `web_view`
  ADD PRIMARY KEY (`w_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class_room`
--
ALTER TABLE `class_room`
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `cs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `course_lesson`
--
ALTER TABLE `course_lesson`
  MODIFY `csl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `course_register`
--
ALTER TABLE `course_register`
  MODIFY `rs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `ex_question`
--
ALTER TABLE `ex_question`
  MODIFY `exq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `ex_status`
--
ALTER TABLE `ex_status`
  MODIFY `exa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `ls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `non_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pass_new`
--
ALTER TABLE `pass_new`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `press_heart`
--
ALTER TABLE `press_heart`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `z_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `qz_answer`
--
ALTER TABLE `qz_answer`
  MODIFY `qza_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qz_point`
--
ALTER TABLE `qz_point`
  MODIFY `qzp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `qz_question`
--
ALTER TABLE `qz_question`
  MODIFY `qzq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `reply_questionnaire`
--
ALTER TABLE `reply_questionnaire`
  MODIFY `ry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `sl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `sub_lesson`
--
ALTER TABLE `sub_lesson`
  MODIFY `sls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `top_questionnaire`
--
ALTER TABLE `top_questionnaire`
  MODIFY `tp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `type_answer`
--
ALTER TABLE `type_answer`
  MODIFY `tya_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_notification`
--
ALTER TABLE `type_notification`
  MODIFY `tyn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_question`
--
ALTER TABLE `type_question`
  MODIFY `tyq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_quiz`
--
ALTER TABLE `type_quiz`
  MODIFY `tyz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3491;

--
-- AUTO_INCREMENT for table `web_banner`
--
ALTER TABLE `web_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `web_contact`
--
ALTER TABLE `web_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `web_data`
--
ALTER TABLE `web_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `web_obj`
--
ALTER TABLE `web_obj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `web_page`
--
ALTER TABLE `web_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `web_view`
--
ALTER TABLE `web_view`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_lesson`
--
ALTER TABLE `course_lesson`
  ADD CONSTRAINT `course_lesson_ibfk_1` FOREIGN KEY (`cs_id`) REFERENCES `course` (`cs_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `course_lesson_ibfk_2` FOREIGN KEY (`ls_id`) REFERENCES `lesson` (`ls_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `course_register`
--
ALTER TABLE `course_register`
  ADD CONSTRAINT `course_register_ibfk_1` FOREIGN KEY (`cs_id`) REFERENCES `course` (`cs_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `course_register_ibfk_2` FOREIGN KEY (`cr_id`) REFERENCES `class_room` (`cr_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `course_register_ibfk_3` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `ex_question`
--
ALTER TABLE `ex_question`
  ADD CONSTRAINT `ex_question_ibfk_1` FOREIGN KEY (`ex_id`) REFERENCES `exercises` (`ex_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ex_question_ibfk_2` FOREIGN KEY (`tyq_id`) REFERENCES `type_question` (`tyq_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ex_question_ibfk_3` FOREIGN KEY (`tya_id`) REFERENCES `type_answer` (`tya_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `ex_status`
--
ALTER TABLE `ex_status`
  ADD CONSTRAINT `ex_status_ibfk_1` FOREIGN KEY (`sls_id`) REFERENCES `sub_lesson` (`sls_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ex_status_ibfk_2` FOREIGN KEY (`ex_id`) REFERENCES `exercises` (`ex_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ex_status_ibfk_3` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`tyn_id`) REFERENCES `type_notification` (`tyn_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `progress_ibfk_1` FOREIGN KEY (`sls_id`) REFERENCES `sub_lesson` (`sls_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `progress_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `progress_ibfk_3` FOREIGN KEY (`cs_id`) REFERENCES `course` (`cs_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `qz_answer`
--
ALTER TABLE `qz_answer`
  ADD CONSTRAINT `qz_answer_ibfk_1` FOREIGN KEY (`qzq_id`) REFERENCES `qz_question` (`qzq_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `qz_answer_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `qz_answer_ibfk_3` FOREIGN KEY (`sls_id`) REFERENCES `sub_lesson` (`sls_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `qz_point`
--
ALTER TABLE `qz_point`
  ADD CONSTRAINT `qz_point_ibfk_1` FOREIGN KEY (`sls_id`) REFERENCES `sub_lesson` (`sls_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `qz_point_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `qz_point_ibfk_3` FOREIGN KEY (`z_id`) REFERENCES `quiz` (`z_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `qz_question`
--
ALTER TABLE `qz_question`
  ADD CONSTRAINT `qz_question_ibfk_1` FOREIGN KEY (`z_id`) REFERENCES `quiz` (`z_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `qz_question_ibfk_2` FOREIGN KEY (`tyq_id`) REFERENCES `type_question` (`tyq_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `qz_question_ibfk_3` FOREIGN KEY (`tya_id`) REFERENCES `type_answer` (`tya_id`),
  ADD CONSTRAINT `qz_question_ibfk_4` FOREIGN KEY (`tyz_id`) REFERENCES `type_quiz` (`tyz_id`);

--
-- Constraints for table `reply_questionnaire`
--
ALTER TABLE `reply_questionnaire`
  ADD CONSTRAINT `reply_questionnaire_ibfk_1` FOREIGN KEY (`tp_id`) REFERENCES `top_questionnaire` (`tp_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `reply_questionnaire_ibfk_2` FOREIGN KEY (`cs_id`) REFERENCES `course` (`cs_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `reply_questionnaire_ibfk_3` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `student_list`
--
ALTER TABLE `student_list`
  ADD CONSTRAINT `student_list_ibfk_1` FOREIGN KEY (`cr_id`) REFERENCES `class_room` (`cr_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `student_list_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `sub_lesson`
--
ALTER TABLE `sub_lesson`
  ADD CONSTRAINT `sub_lesson_ibfk_1` FOREIGN KEY (`ls_id`) REFERENCES `lesson` (`ls_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_lesson_ibfk_2` FOREIGN KEY (`ex_id`) REFERENCES `exercises` (`ex_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
