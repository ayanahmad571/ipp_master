-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2020 at 01:58 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipp`
--
CREATE DATABASE IF NOT EXISTS `ipp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ipp`;

-- --------------------------------------------------------

--
-- Table structure for table `clients_main`
--

CREATE TABLE `clients_main` (
  `client_id` int(255) NOT NULL,
  `client_code` varchar(698) NOT NULL,
  `client_name` varchar(698) NOT NULL,
  `client_dnt` varchar(698) NOT NULL,
  `client_lum_id` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients_main`
--

INSERT INTO `clients_main` (`client_id`, `client_code`, `client_name`, `client_dnt`, `client_lum_id`) VALUES
(1, 'EK', 'Emirates', '1445555555', 1),
(2, 'CARF', 'Carrefour', '123129841289', 1),
(3, 'STWL', 'StileWell', '1415184858', 1),
(12, 'P001', 'Purchase Star', '1599138980', 2),
(11, 'NY', 'New Yorkers', '1598910124', 1),
(10, 'AA', 'Architecture Assoc', '1598908551', 1),
(13, 'KI1', 'KINOKUNYA', '1599851411', 12),
(14, 'M1', 'Merric Trading', '1599852874', 7);

-- --------------------------------------------------------

--
-- Table structure for table `complaints_main`
--

CREATE TABLE `complaints_main` (
  `complaint_id` int(255) NOT NULL,
  `complaint_wo_ref` int(255) NOT NULL,
  `complaint_text` text NOT NULL,
  `complaint_lum_id` int(255) NOT NULL,
  `complaint_dnt` varchar(698) NOT NULL,
  `complaint_status` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints_main`
--

INSERT INTO `complaints_main` (`complaint_id`, `complaint_wo_ref`, `complaint_text`, `complaint_lum_id`, `complaint_dnt`, `complaint_status`) VALUES
(1, 1, 'NONE', 5, '1599941395', 1),
(2, 1, 'NONE', 8, '1599941420', 1),
(3, 4, 'ABCNJKE', 8, '1600016633', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logcat_main`
--

CREATE TABLE `logcat_main` (
  `logcat_id` int(255) NOT NULL,
  `logcat_lum_id` int(255) NOT NULL,
  `logcat_page` varchar(698) NOT NULL,
  `logcat_session_hash` varchar(698) NOT NULL,
  `logcat_ip` varchar(698) NOT NULL,
  `logcat_text` varchar(698) NOT NULL,
  `logcat_dnt` varchar(698) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logcat_main`
--

INSERT INTO `logcat_main` (`logcat_id`, `logcat_lum_id`, `logcat_page`, `logcat_session_hash`, `logcat_ip`, `logcat_text`, `logcat_dnt`) VALUES
(1, 1, 'home.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599917004'),
(2, 1, 'admin_users.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931051'),
(3, 1, 'admin_users.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931187'),
(4, 1, 'admin_users.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931192'),
(5, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931583'),
(6, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'User : A01 has been added by MD-1', '1599931583'),
(7, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931659'),
(8, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'User : S-03 has been added by MD-1', '1599931659'),
(9, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931689'),
(10, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'User : FM-01 has been added by MD-1', '1599931689'),
(11, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931711'),
(12, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'User : PL-01 has been added by MD-1', '1599931711'),
(13, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931768'),
(14, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'User : PC-01 has been added by MD-1', '1599931768'),
(15, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931792'),
(16, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'User : PP-01 has been added by MD-1', '1599931792'),
(17, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931818'),
(18, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'User : Q-01 has been added by MD-1', '1599931818'),
(19, 1, 'admin_users.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931820'),
(20, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931868'),
(21, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'User : S-01 has been added by MD-1', '1599931868'),
(22, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931890'),
(23, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'User : S-10 has been added by MD-1', '1599931890'),
(24, 1, 'admin_users.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599931892'),
(25, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599939030'),
(26, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599939042'),
(27, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'Password for User : Q-01 has been reset by MD-1', '1599939042'),
(28, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599939046'),
(29, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'Password for User : A01 has been reset by MD-1', '1599939046'),
(30, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599939067'),
(31, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'User : S-111 has been added by MD-1', '1599939067'),
(32, 1, 'admin_users.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599939069'),
(33, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599939080'),
(34, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'User : S-111 has been de-activated by MD-1', '1599939080'),
(35, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599939110'),
(36, 1, 'AdminController.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'User : ADMIN-1 has been added by MD-1', '1599939110'),
(37, 1, 'admin_users.php', 'IPPSESSID5f5ccbcbc7929', '127.0.0.1', 'This login protected page has been accessed', '1599939126'),
(38, 10, 'home.php', 'IPPSESSID5f5d224b7e0be', '127.0.0.1', 'This login protected page has been accessed', '1599939147'),
(39, 1, 'home.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599939281'),
(40, 1, 'admin_logs.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599939290'),
(41, 1, 'admin_logs.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599939540'),
(42, 9, 'home.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939579'),
(43, 9, 'complaints.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939622'),
(44, 9, 'work_order_sales.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939625'),
(45, 9, 'work_order_sales_generate.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939630'),
(46, 9, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939729'),
(47, 9, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'S-01 added a new draft with ID: 1', '1599939729'),
(48, 9, 'work_order_sales.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939731'),
(49, 1, 'admin_logs.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599939735'),
(50, 9, 'work_order_sales_generate.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939742'),
(51, 9, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939789'),
(52, 9, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'S-01 edited draft with ID: 1', '1599939789'),
(53, 9, 'work_order_sales.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939791'),
(54, 10, 'work_order_sales_generate.php', 'IPPSESSID5f5d224b7e0be', '127.0.0.1', 'This login protected page has been accessed', '1599939795'),
(55, 10, 'work_order_sales.php', 'IPPSESSID5f5d224b7e0be', '127.0.0.1', 'This login protected page has been accessed', '1599939796'),
(56, 9, 'attach.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939804'),
(57, 9, 'AttachController.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939809'),
(58, 9, 'AttachController.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'User: S-01 has authorized USER_ID : 10 to use their code ', '1599939809'),
(59, 10, 'work_order_sales.php', 'IPPSESSID5f5d224b7e0be', '127.0.0.1', 'This login protected page has been accessed', '1599939813'),
(60, 9, 'attach.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939960'),
(61, 9, 'AttachController.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939964'),
(62, 9, 'AttachController.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'S-01 de-authrozied S-10 for using their sales Code', '1599939964'),
(63, 9, 'attach.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939967'),
(64, 9, 'AttachController.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939970'),
(65, 9, 'AttachController.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'User: S-01 has authorized USER_ID : 3 to use their code ', '1599939970'),
(66, 9, 'attach.php', 'IPPSESSID5f5d23fb2921b', '127.0.0.1', 'This login protected page has been accessed', '1599939971'),
(67, 3, 'home.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'This login protected page has been accessed', '1599939989'),
(68, 3, 'attach.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'This login protected page has been accessed', '1599939991'),
(69, 3, 'AttachController.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'This login protected page has been accessed', '1599939995'),
(70, 3, 'AttachController.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'User: S-03 has authorized USER_ID : 10 to use their code ', '1599939995'),
(71, 3, 'attach.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'This login protected page has been accessed', '1599939998'),
(72, 10, 'home.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940012'),
(73, 10, 'work_order_sales.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940040'),
(74, 10, 'work_order_sales_generate.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940046'),
(75, 10, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940084'),
(76, 10, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'S-10 added a new draft with ID: 2', '1599940084'),
(77, 10, 'work_order_sales.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940085'),
(78, 3, 'work_order_sales_generate.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'This login protected page has been accessed', '1599940090'),
(79, 3, 'work_order_sales.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'This login protected page has been accessed', '1599940090'),
(80, 10, 'work_order_sales_generate.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940104'),
(81, 10, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940108'),
(82, 10, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'S-10 edited draft with ID: 2', '1599940108'),
(83, 10, 'work_order_sales_generate.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940109'),
(84, 3, 'work_order_sales.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'This login protected page has been accessed', '1599940119'),
(85, 10, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940125'),
(86, 10, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'S-10 edited draft with ID: 2', '1599940125'),
(87, 3, 'work_order_sales.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'This login protected page has been accessed', '1599940126'),
(88, 3, 'work_order_sales_generate.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'This login protected page has been accessed', '1599940134'),
(89, 3, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'This login protected page has been accessed', '1599940141'),
(90, 3, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'S-03 edited draft with ID: 2', '1599940141'),
(91, 3, 'work_order_sales_generate.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'This login protected page has been accessed', '1599940145'),
(92, 3, 'work_order_sales.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'This login protected page has been accessed', '1599940145'),
(93, 3, 'work_order_sales.php', 'IPPSESSID5f5d2595a4821', '127.0.0.1', 'This login protected page has been accessed', '1599940150'),
(94, 10, 'work_order_sales_generate.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940154'),
(95, 10, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940158'),
(96, 10, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'S-10 edited draft with ID: 2', '1599940158'),
(97, 10, 'work_order_sales.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940332'),
(98, 10, 'MainWorkOrderSubmit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940337'),
(99, 10, 'MainWorkOrderSubmit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'S-10 has publised draft ID 2  to WO ID 1', '1599940337'),
(100, 10, 'work_order_sales.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940339'),
(101, 1, 'admin_users.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599940357'),
(102, 1, 'AdminController.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599940368'),
(103, 1, 'AdminController.php', 'IPPSESSID5f5d22d17b179', '::1', 'Password for User : Q-01 has been reset by MD-1', '1599940368'),
(104, 8, 'home.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940371'),
(105, 8, 'work_order_quality.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940376'),
(106, 8, 'work_order_main_edit.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940385'),
(107, 8, 'work_order_tracker.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940388'),
(108, 8, 'work_order_tracker.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940391'),
(109, 8, 'work_order_main_edit.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940442'),
(110, 8, 'work_order_main_edit.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940622'),
(111, 8, 'WorkOrderControllerEdit.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940660'),
(112, 8, 'WorkOrderControllerEdit.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940703'),
(113, 8, 'WorkOrderControllerEdit.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'Q-01 edited WO: 1 with subID: 1', '1599940703'),
(114, 8, 'work_order_quality.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940705'),
(115, 8, 'work_order_main_edit.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940708'),
(116, 8, 'work_order_quality.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940719'),
(117, 8, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940722'),
(118, 8, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'Q-01 published WORK ORDER: 1 to bring to ID: 2', '1599940722'),
(119, 10, 'work_order_sales_generate.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940726'),
(120, 10, 'complaints.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940726'),
(121, 10, 'work_order_sales.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940726'),
(122, 10, 'work_order_main_edit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940729'),
(123, 10, 'WorkOrderControllerEdit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940736'),
(124, 10, 'WorkOrderControllerEdit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'S-10 edited WO: 1 with subID: 2', '1599940736'),
(125, 10, 'work_order_main_edit.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940737'),
(126, 10, 'work_order_sales.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940747'),
(127, 10, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940749'),
(128, 10, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'S-10 published WORK ORDER: 1 to bring to ID: 3', '1599940749'),
(129, 10, 'work_order_sales.php', 'IPPSESSID5f5d25ac3c365', '127.0.0.1', 'This login protected page has been accessed', '1599940751'),
(130, 8, 'work_order_quality.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940753'),
(131, 8, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940756'),
(132, 8, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'Q-01 published WORK ORDER: 1 to bring to ID: 4', '1599940756'),
(133, 8, 'work_order_quality.php', 'IPPSESSID5f5d27130ac0b', '127.0.0.1', 'This login protected page has been accessed', '1599940759'),
(134, 4, 'home.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'This login protected page has been accessed', '1599940768'),
(135, 4, 'work_order_tracker.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'This login protected page has been accessed', '1599940770'),
(136, 4, 'work_order_tracker.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'This login protected page has been accessed', '1599940771'),
(137, 4, 'work_order_factory.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'This login protected page has been accessed', '1599940774'),
(138, 4, 'work_order_main_edit.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'This login protected page has been accessed', '1599940799'),
(139, 4, 'work_order_main_edit.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'This login protected page has been accessed', '1599940930'),
(140, 4, 'WorkOrderControllerEdit.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'This login protected page has been accessed', '1599940933'),
(141, 4, 'WorkOrderControllerEdit.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'FM-01 edited WO: 1 with subID: 4', '1599940933'),
(142, 4, 'work_order_factory.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'This login protected page has been accessed', '1599940935'),
(143, 4, 'work_order_main_edit.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'This login protected page has been accessed', '1599940937'),
(144, 4, 'work_order_factory.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'This login protected page has been accessed', '1599940939'),
(145, 4, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'This login protected page has been accessed', '1599940946'),
(146, 4, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'FM-01 published WORK ORDER: 1 to bring to ID: 5', '1599940946'),
(147, 4, 'complaints.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'This login protected page has been accessed', '1599940948'),
(148, 4, 'work_order_factory.php', 'IPPSESSID5f5d289fed06d', '127.0.0.1', 'This login protected page has been accessed', '1599941051'),
(149, 6, 'home.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941165'),
(150, 6, 'work_order_pre_costing.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941167'),
(151, 6, 'work_order_view_print.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941169'),
(152, 6, 'work_order_pre_costing.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941184'),
(153, 6, 'work_order_tracker.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941185'),
(154, 6, 'work_order_tracker.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941187'),
(155, 6, 'work_order_tracker.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941189'),
(156, 6, 'work_order_tracker.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941190'),
(157, 6, 'work_order_pre_costing.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941194'),
(158, 6, 'PreCostController.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941265'),
(159, 6, 'PreCostController.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941276'),
(160, 6, 'PreCostController.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'PC-01 updated the PO on Work Order: 1', '1599941276'),
(161, 6, 'work_order_view_print.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941279'),
(162, 6, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941282'),
(163, 6, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'PC-01 published WORK ORDER: 1 to bring to ID: 6', '1599941282'),
(164, 6, 'work_order_pre_costing.php', 'IPPSESSID5f5d2a2dd80df', '127.0.0.1', 'This login protected page has been accessed', '1599941290'),
(165, 2, 'home.php', 'IPPSESSID5f5d2ab65f792', '127.0.0.1', 'This login protected page has been accessed', '1599941302'),
(166, 2, 'work_order_accounts.php', 'IPPSESSID5f5d2ab65f792', '127.0.0.1', 'This login protected page has been accessed', '1599941333'),
(167, 2, 'work_order_view_print.php', 'IPPSESSID5f5d2ab65f792', '127.0.0.1', 'This login protected page has been accessed', '1599941335'),
(168, 2, 'work_order_view_print.php', 'IPPSESSID5f5d2ab65f792', '127.0.0.1', 'This login protected page has been accessed', '1599941340'),
(169, 2, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d2ab65f792', '127.0.0.1', 'This login protected page has been accessed', '1599941346'),
(170, 2, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d2ab65f792', '127.0.0.1', 'A01 published WORK ORDER: 1 to bring to ID: 7', '1599941346'),
(171, 2, 'work_order_accounts.php', 'IPPSESSID5f5d2ab65f792', '127.0.0.1', 'This login protected page has been accessed', '1599941347'),
(172, 7, 'home.php', 'IPPSESSID5f5d2aee829a3', '127.0.0.1', 'This login protected page has been accessed', '1599941358'),
(173, 7, 'work_order_pre_press.php', 'IPPSESSID5f5d2aee829a3', '127.0.0.1', 'This login protected page has been accessed', '1599941359'),
(174, 7, 'PrePressController.php', 'IPPSESSID5f5d2aee829a3', '127.0.0.1', 'This login protected page has been accessed', '1599941362'),
(175, 7, 'work_order_view_print.php', 'IPPSESSID5f5d2aee829a3', '127.0.0.1', 'This login protected page has been accessed', '1599941367'),
(176, 7, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d2aee829a3', '127.0.0.1', 'This login protected page has been accessed', '1599941371'),
(177, 7, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d2aee829a3', '127.0.0.1', 'PP-01 published WORK ORDER: 1 to bring to ID: 8', '1599941371'),
(178, 5, 'home.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941381'),
(179, 5, 'work_order_planning.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941382'),
(180, 5, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941384'),
(181, 5, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'PL-01 published WORK ORDER: 1 to bring to ID: 9', '1599941384'),
(182, 5, 'work_order_planning.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941386'),
(183, 5, 'work_order_tracker.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941390'),
(184, 5, 'complaints.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941391'),
(185, 5, 'complaints.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941392'),
(186, 5, 'ComplaintsController.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941395'),
(187, 5, 'ComplaintsController.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'PL-01 added complaint with ID :1', '1599941395'),
(188, 5, 'complaints.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941397'),
(189, 5, 'complaints.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941399'),
(190, 5, 'work_order_planning.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941401'),
(191, 5, 'complaints.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941402'),
(192, 5, 'complaints.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941403'),
(193, 5, 'complaints.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941404'),
(194, 5, 'work_order_planning.php', 'IPPSESSID5f5d2b055e454', '127.0.0.1', 'This login protected page has been accessed', '1599941405'),
(195, 8, 'home.php', 'IPPSESSID5f5d2b2585512', '127.0.0.1', 'This login protected page has been accessed', '1599941413'),
(196, 8, 'work_order_quality.php', 'IPPSESSID5f5d2b2585512', '127.0.0.1', 'This login protected page has been accessed', '1599941414'),
(197, 8, 'complaints.php', 'IPPSESSID5f5d2b2585512', '127.0.0.1', 'This login protected page has been accessed', '1599941415'),
(198, 8, 'complaints.php', 'IPPSESSID5f5d2b2585512', '127.0.0.1', 'This login protected page has been accessed', '1599941416'),
(199, 8, 'ComplaintsController.php', 'IPPSESSID5f5d2b2585512', '127.0.0.1', 'This login protected page has been accessed', '1599941420'),
(200, 8, 'ComplaintsController.php', 'IPPSESSID5f5d2b2585512', '127.0.0.1', 'Q-01 added complaint with ID :2', '1599941420'),
(201, 1, 'admin_logs.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941427'),
(202, 1, 'admin_logs.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941451'),
(203, 8, 'work_order_tracker.php', 'IPPSESSID5f5d2b2585512', '127.0.0.1', 'This login protected page has been accessed', '1599941463'),
(204, 8, 'work_order_quality.php', 'IPPSESSID5f5d2b2585512', '127.0.0.1', 'This login protected page has been accessed', '1599941463'),
(205, 8, 'complaints.php', 'IPPSESSID5f5d2b2585512', '127.0.0.1', 'This login protected page has been accessed', '1599941517'),
(206, 1, 'work_order_sales.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941527'),
(207, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941531'),
(208, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID5f5d22d17b179', '::1', 'MD-1 has publised draft ID 1  to WO ID 2', '1599941531'),
(209, 1, 'work_order_quality.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941532'),
(210, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941534'),
(211, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d22d17b179', '::1', 'MD-1 published WORK ORDER: 2 to bring to ID: 11', '1599941534'),
(212, 1, 'work_order_factory.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941538'),
(213, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941540'),
(214, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d22d17b179', '::1', 'MD-1 published WORK ORDER: 2 to bring to ID: 12', '1599941540'),
(215, 1, 'work_order_pre_costing.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941543'),
(216, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941545'),
(217, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d22d17b179', '::1', 'MD-1 published WORK ORDER: 2 to bring to ID: 13', '1599941545'),
(218, 1, 'work_order_accounts.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941547'),
(219, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941550'),
(220, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5d22d17b179', '::1', 'MD-1 published WORK ORDER: 2 to bring to ID: 14', '1599941550'),
(221, 1, 'work_order_pre_costing.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941552'),
(222, 1, 'work_order_pre_press.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941553'),
(223, 7, 'home.php', 'IPPSESSID5f5d2bb698117', '127.0.0.1', 'This login protected page has been accessed', '1599941558'),
(224, 7, 'work_order_pre_press.php', 'IPPSESSID5f5d2bb698117', '127.0.0.1', 'This login protected page has been accessed', '1599941560'),
(225, 7, 'PrePressController.php', 'IPPSESSID5f5d2bb698117', '127.0.0.1', 'This login protected page has been accessed', '1599941561'),
(226, 1, 'work_order_tracker.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941570'),
(227, 1, 'work_order_tracker.php', 'IPPSESSID5f5d22d17b179', '::1', 'This login protected page has been accessed', '1599941571'),
(228, 1, 'home.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997521'),
(229, 1, 'work_order_sales.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997523'),
(230, 1, 'work_order_sales.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997524'),
(231, 1, 'work_order_sales_generate.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997524'),
(232, 1, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997580'),
(233, 1, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'MD-1 added a new draft with ID: 3', '1599997580'),
(234, 1, 'work_order_sales.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997582'),
(235, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997584'),
(236, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'MD-1 has publised draft ID 3  to WO ID 3', '1599997584'),
(237, 1, 'work_order_quality.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997586'),
(238, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997589'),
(239, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'MD-1 published WORK ORDER: 3 to bring to ID: 16', '1599997589'),
(240, 1, 'work_order_factory.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997590'),
(241, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997592'),
(242, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'MD-1 published WORK ORDER: 3 to bring to ID: 17', '1599997592'),
(243, 1, 'work_order_pre_costing.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997595'),
(244, 1, 'PreCostController.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997601'),
(245, 6, 'home.php', 'IPPSESSID5f5e06ac3609a', '::1', 'This login protected page has been accessed', '1599997612'),
(246, 6, 'work_order_pre_costing.php', 'IPPSESSID5f5e06ac3609a', '::1', 'This login protected page has been accessed', '1599997613'),
(247, 6, 'PreCostController.php', 'IPPSESSID5f5e06ac3609a', '::1', 'This login protected page has been accessed', '1599997614'),
(248, 6, 'PreCostController.php', 'IPPSESSID5f5e06ac3609a', '::1', 'This login protected page has been accessed', '1599997625'),
(249, 6, 'PreCostController.php', 'IPPSESSID5f5e06ac3609a', '::1', 'PC-01 updated the PO on Work Order: 3', '1599997625'),
(250, 6, 'PreCostController.php', 'IPPSESSID5f5e06ac3609a', '::1', 'This login protected page has been accessed', '1599997627'),
(251, 6, 'work_order_pre_costing.php', 'IPPSESSID5f5e06ac3609a', '::1', 'This login protected page has been accessed', '1599997633'),
(252, 6, 'PreCostController.php', 'IPPSESSID5f5e06ac3609a', '::1', 'This login protected page has been accessed', '1599997634'),
(253, 6, 'work_order_pre_costing.php', 'IPPSESSID5f5e06ac3609a', '::1', 'This login protected page has been accessed', '1599997637'),
(254, 6, 'PreCostController.php', 'IPPSESSID5f5e06ac3609a', '::1', 'This login protected page has been accessed', '1599997638'),
(255, 6, 'work_order_view_print.php', 'IPPSESSID5f5e06ac3609a', '::1', 'This login protected page has been accessed', '1599997640'),
(256, 6, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e06ac3609a', '::1', 'This login protected page has been accessed', '1599997656'),
(257, 6, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e06ac3609a', '::1', 'PC-01 published WORK ORDER: 3 to bring to ID: 18', '1599997656'),
(258, 1, 'work_order_accounts.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997658'),
(259, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'This login protected page has been accessed', '1599997661'),
(260, 1, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e065115aba', '127.0.0.1', 'MD-1 published WORK ORDER: 3 to bring to ID: 19', '1599997661'),
(261, 1, 'home.php', 'IPPSESSID5f5e06e60b505', '::1', 'This login protected page has been accessed', '1599997670'),
(262, 7, 'home.php', 'IPPSESSID5f5e06fa4cecf', '127.0.0.1', 'This login protected page has been accessed', '1599997690'),
(263, 7, 'work_order_pre_press.php', 'IPPSESSID5f5e06fa4cecf', '127.0.0.1', 'This login protected page has been accessed', '1599997691'),
(264, 7, 'PrePressController.php', 'IPPSESSID5f5e06fa4cecf', '127.0.0.1', 'This login protected page has been accessed', '1599997694'),
(265, 7, 'PrePressController.php', 'IPPSESSID5f5e06fa4cecf', '127.0.0.1', 'This login protected page has been accessed', '1599997695'),
(266, 7, 'PrePressController.php', 'IPPSESSID5f5e06fa4cecf', '127.0.0.1', 'This login protected page has been accessed', '1599997718'),
(267, 7, 'PrePressController.php', 'IPPSESSID5f5e06fa4cecf', '127.0.0.1', 'This login protected page has been accessed', '1599997730'),
(268, 7, 'PrePressController.php', 'IPPSESSID5f5e06fa4cecf', '127.0.0.1', 'PP-01 edited the printing section for WO: 3', '1599997730'),
(269, 7, 'work_order_view_print.php', 'IPPSESSID5f5e06fa4cecf', '127.0.0.1', 'This login protected page has been accessed', '1599997732'),
(270, 7, 'work_order_pre_press.php', 'IPPSESSID5f5e06fa4cecf', '127.0.0.1', 'This login protected page has been accessed', '1599997741'),
(271, 7, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e06fa4cecf', '127.0.0.1', 'This login protected page has been accessed', '1599997744'),
(272, 7, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e06fa4cecf', '127.0.0.1', 'PP-01 published WORK ORDER: 3 to bring to ID: 20', '1599997744'),
(273, 3, 'home.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016314'),
(274, 3, 'work_order_tracker.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016315'),
(275, 3, 'home.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016316'),
(276, 3, 'work_order_sales_generate.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016326'),
(277, 1, 'admin_logs.php', 'IPPSESSID5f5e06e60b505', '::1', 'This login protected page has been accessed', '1600016335'),
(278, 1, 'admin_logs.php', 'IPPSESSID5f5e06e60b505', '::1', 'This login protected page has been accessed', '1600016344'),
(279, 3, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016369'),
(280, 3, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016391'),
(281, 3, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'S-03 added a new draft with ID: 4', '1600016391'),
(282, 3, 'work_order_sales.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016394'),
(283, 3, 'work_order_sales_generate.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016400'),
(284, 3, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016404'),
(285, 3, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'S-03 edited draft with ID: 4', '1600016404'),
(286, 3, 'work_order_sales.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016407'),
(287, 3, 'MainWorkOrderSubmit.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016413'),
(288, 3, 'MainWorkOrderSubmit.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'S-03 has publised draft ID 4  to WO ID 4', '1600016413'),
(289, 8, 'home.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'This login protected page has been accessed', '1600016426'),
(290, 8, 'work_order_quality.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'This login protected page has been accessed', '1600016427'),
(291, 8, 'work_order_main_edit.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'This login protected page has been accessed', '1600016430'),
(292, 8, 'WorkOrderControllerEdit.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'This login protected page has been accessed', '1600016436'),
(293, 8, 'WorkOrderControllerEdit.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'Q-01 edited WO: 4 with subID: 21', '1600016436'),
(294, 8, 'work_order_main_edit.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'This login protected page has been accessed', '1600016437'),
(295, 8, 'work_order_quality.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'This login protected page has been accessed', '1600016442'),
(296, 8, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'This login protected page has been accessed', '1600016445'),
(297, 8, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'Q-01 published WORK ORDER: 4 to bring to ID: 22', '1600016445'),
(298, 8, 'work_order_quality.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'This login protected page has been accessed', '1600016449'),
(299, 3, 'work_order_sales.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016452'),
(300, 3, 'work_order_main_edit.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016455'),
(301, 3, 'WorkOrderControllerEdit.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016467'),
(302, 3, 'WorkOrderControllerEdit.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'S-03 edited WO: 4 with subID: 22', '1600016467'),
(303, 3, 'work_order_sales.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016468'),
(304, 3, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016473'),
(305, 3, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'S-03 published WORK ORDER: 4 to bring to ID: 23', '1600016473'),
(306, 8, 'work_order_quality.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'This login protected page has been accessed', '1600016476'),
(307, 8, 'work_order_quality.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'This login protected page has been accessed', '1600016480'),
(308, 8, 'work_order_quality.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'This login protected page has been accessed', '1600016488'),
(309, 8, 'work_order_main_edit.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'This login protected page has been accessed', '1600016492'),
(310, 8, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'This login protected page has been accessed', '1600016500'),
(311, 8, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e502a88622', '127.0.0.1', 'Q-01 published WORK ORDER: 4 to bring to ID: 24', '1600016500'),
(312, 4, 'home.php', 'IPPSESSID5f5e507d4777a', '127.0.0.1', 'This login protected page has been accessed', '1600016509'),
(313, 4, 'work_order_factory.php', 'IPPSESSID5f5e507d4777a', '127.0.0.1', 'This login protected page has been accessed', '1600016511'),
(314, 4, 'work_order_main_edit.php', 'IPPSESSID5f5e507d4777a', '127.0.0.1', 'This login protected page has been accessed', '1600016512'),
(315, 4, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e507d4777a', '127.0.0.1', 'This login protected page has been accessed', '1600016516'),
(316, 4, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e507d4777a', '127.0.0.1', 'FM-01 published WORK ORDER: 4 to bring to ID: 25', '1600016516'),
(317, 6, 'home.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'This login protected page has been accessed', '1600016524'),
(318, 6, 'work_order_pre_costing.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'This login protected page has been accessed', '1600016526'),
(319, 6, 'work_order_view_print.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'This login protected page has been accessed', '1600016528'),
(320, 6, 'complaints.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'This login protected page has been accessed', '1600016536'),
(321, 6, 'work_order_pre_costing.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'This login protected page has been accessed', '1600016536'),
(322, 6, 'PreCostController.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'This login protected page has been accessed', '1600016538'),
(323, 6, 'work_order_view_print.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'This login protected page has been accessed', '1600016541'),
(324, 6, 'PreCostController.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'This login protected page has been accessed', '1600016546'),
(325, 6, 'PreCostController.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'This login protected page has been accessed', '1600016550'),
(326, 6, 'PreCostController.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'PC-01 updated the PO on Work Order: 4', '1600016550'),
(327, 6, 'work_order_view_print.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'This login protected page has been accessed', '1600016551'),
(328, 6, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'This login protected page has been accessed', '1600016557'),
(329, 6, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'PC-01 published WORK ORDER: 4 to bring to ID: 26', '1600016557'),
(330, 6, 'work_order_pre_costing.php', 'IPPSESSID5f5e508cbde87', '127.0.0.1', 'This login protected page has been accessed', '1600016559'),
(331, 2, 'home.php', 'IPPSESSID5f5e50bae979d', '127.0.0.1', 'This login protected page has been accessed', '1600016571'),
(332, 2, 'work_order_accounts.php', 'IPPSESSID5f5e50bae979d', '127.0.0.1', 'This login protected page has been accessed', '1600016572'),
(333, 2, 'work_order_view_print.php', 'IPPSESSID5f5e50bae979d', '127.0.0.1', 'This login protected page has been accessed', '1600016574'),
(334, 2, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e50bae979d', '127.0.0.1', 'This login protected page has been accessed', '1600016577'),
(335, 2, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e50bae979d', '127.0.0.1', 'A01 published WORK ORDER: 4 to bring to ID: 27', '1600016577'),
(336, 7, 'home.php', 'IPPSESSID5f5e50c81050c', '127.0.0.1', 'This login protected page has been accessed', '1600016584'),
(337, 7, 'work_order_pre_press.php', 'IPPSESSID5f5e50c81050c', '127.0.0.1', 'This login protected page has been accessed', '1600016585'),
(338, 7, 'PrePressController.php', 'IPPSESSID5f5e50c81050c', '127.0.0.1', 'This login protected page has been accessed', '1600016595'),
(339, 7, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e50c81050c', '127.0.0.1', 'This login protected page has been accessed', '1600016599'),
(340, 7, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e50c81050c', '127.0.0.1', 'PP-01 published WORK ORDER: 4 to bring to ID: 28', '1600016599'),
(341, 5, 'home.php', 'IPPSESSID5f5e50e135b4c', '127.0.0.1', 'This login protected page has been accessed', '1600016609'),
(342, 5, 'work_order_planning.php', 'IPPSESSID5f5e50e135b4c', '127.0.0.1', 'This login protected page has been accessed', '1600016610'),
(343, 5, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e50e135b4c', '127.0.0.1', 'This login protected page has been accessed', '1600016613'),
(344, 5, 'MainWorkOrderSubmitAll.php', 'IPPSESSID5f5e50e135b4c', '127.0.0.1', 'PL-01 published WORK ORDER: 4 to bring to ID: 29', '1600016613'),
(345, 5, 'work_order_planning.php', 'IPPSESSID5f5e50e135b4c', '127.0.0.1', 'This login protected page has been accessed', '1600016614'),
(346, 8, 'home.php', 'IPPSESSID5f5e50ef3e3a7', '127.0.0.1', 'This login protected page has been accessed', '1600016623'),
(347, 8, 'work_order_quality.php', 'IPPSESSID5f5e50ef3e3a7', '127.0.0.1', 'This login protected page has been accessed', '1600016624'),
(348, 8, 'complaints.php', 'IPPSESSID5f5e50ef3e3a7', '127.0.0.1', 'This login protected page has been accessed', '1600016628'),
(349, 8, 'complaints.php', 'IPPSESSID5f5e50ef3e3a7', '127.0.0.1', 'This login protected page has been accessed', '1600016630'),
(350, 8, 'ComplaintsController.php', 'IPPSESSID5f5e50ef3e3a7', '127.0.0.1', 'This login protected page has been accessed', '1600016633'),
(351, 8, 'ComplaintsController.php', 'IPPSESSID5f5e50ef3e3a7', '127.0.0.1', 'Q-01 added complaint with ID :3', '1600016633'),
(352, 8, 'complaints.php', 'IPPSESSID5f5e50ef3e3a7', '127.0.0.1', 'This login protected page has been accessed', '1600016634'),
(353, 8, 'work_order_tracker.php', 'IPPSESSID5f5e50ef3e3a7', '127.0.0.1', 'This login protected page has been accessed', '1600016635'),
(354, 8, 'work_order_tracker.php', 'IPPSESSID5f5e50ef3e3a7', '127.0.0.1', 'This login protected page has been accessed', '1600016640'),
(355, 8, 'work_order_view_print.php', 'IPPSESSID5f5e50ef3e3a7', '127.0.0.1', 'This login protected page has been accessed', '1600016651'),
(356, 8, 'complaints.php', 'IPPSESSID5f5e50ef3e3a7', '127.0.0.1', 'This login protected page has been accessed', '1600016653'),
(357, 3, 'home.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016740'),
(358, 3, 'work_order_sales_generate.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016743'),
(359, 3, 'work_order_sales_generate.php', 'IPPSESSID5f5e4fba576ec', '127.0.0.1', 'This login protected page has been accessed', '1600016896'),
(360, 1, 'home.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696427'),
(361, 1, 'admin_users.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696430'),
(362, 1, 'admin_logs.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696455'),
(363, 1, 'complaints.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696492'),
(364, 1, 'work_order_sales.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696497'),
(365, 1, 'work_order_sales_generate.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696498'),
(366, 1, 'work_order_sales.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696506'),
(367, 1, 'work_order_quality.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696513'),
(368, 1, 'work_order_pre_press.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696514'),
(369, 1, 'work_order_pre_costing.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696514'),
(370, 1, 'work_order_planning.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696515'),
(371, 1, 'work_order_factory.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696515'),
(372, 1, 'work_order_accounts.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696516'),
(373, 1, 'complaints.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696516'),
(374, 1, 'work_order_planning.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696517'),
(375, 1, 'work_order_quality.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696517'),
(376, 1, 'work_order_sales_generate.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696517'),
(377, 1, 'attach.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696518'),
(378, 1, 'form_manager.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696519');
INSERT INTO `logcat_main` (`logcat_id`, `logcat_lum_id`, `logcat_page`, `logcat_session_hash`, `logcat_ip`, `logcat_text`, `logcat_dnt`) VALUES
(379, 1, 'attach.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696520'),
(380, 1, 'home.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696530'),
(381, 1, 'complaints.php', 'IPPSESSID5f68b06b7245e', '127.0.0.1', 'This login protected page has been accessed', '1600696533');

-- --------------------------------------------------------

--
-- Table structure for table `master_work_order_main`
--

CREATE TABLE `master_work_order_main` (
  `master_wo_id` int(255) NOT NULL,
  `master_wo_lum_id` int(255) NOT NULL,
  `master_wo_ref` int(255) NOT NULL,
  `master_wo_design_id` varchar(500) DEFAULT NULL,
  `master_wo_po` varchar(698) DEFAULT NULL,
  `master_wo_client_id` int(255) NOT NULL,
  `master_wo_delivery_date` varchar(698) DEFAULT NULL,
  `master_wo_lwo` varchar(698) DEFAULT NULL,
  `master_wo_structure` varchar(698) NOT NULL,
  `master_wo_final_qty` varchar(698) DEFAULT NULL,
  `master_wo_qty_unit` varchar(698) DEFAULT NULL,
  `master_wo_tolerance_1` varchar(698) DEFAULT NULL,
  `master_wo_tolerance_2` varchar(698) DEFAULT NULL,
  `master_wo_ply` int(5) DEFAULT NULL,
  `master_wo_application_id` int(255) DEFAULT NULL,
  `master_wo_layer_1_micron` varchar(698) DEFAULT NULL,
  `master_wo_layer_1_structure` varchar(698) DEFAULT NULL,
  `master_wo_layer_2_micron` varchar(698) DEFAULT NULL,
  `master_wo_layer_2_structure` varchar(698) DEFAULT NULL,
  `master_wo_layer_3_micron` varchar(698) DEFAULT NULL,
  `master_wo_layer_3_structure` varchar(698) DEFAULT NULL,
  `master_wo_layer_4_micron` varchar(698) DEFAULT NULL,
  `master_wo_layer_4_structure` varchar(698) DEFAULT NULL,
  `master_wo_layer_5_micron` varchar(698) DEFAULT NULL,
  `master_wo_layer_5_structure` varchar(698) DEFAULT NULL,
  `master_wo_printed_question` int(2) NOT NULL,
  `master_wo_inhouse_pe_question` int(2) NOT NULL,
  `master_wo_ex_pe_re` varchar(698) DEFAULT NULL,
  `master_wo_ex_antistatic` int(10) DEFAULT NULL,
  `master_wo_ex_layer` int(10) DEFAULT NULL,
  `master_wo_ex_pack_size` varchar(500) DEFAULT NULL,
  `master_wo_ex_pkg_speed` varchar(500) DEFAULT NULL,
  `master_wo_ex_qty_kgs` varchar(500) DEFAULT NULL,
  `master_wo_ex_mtr` varchar(500) DEFAULT NULL,
  `master_wo_ex_options` varchar(698) DEFAULT NULL,
  `master_wo_ex_thickness` varchar(500) DEFAULT NULL,
  `master_wo_ex_treatment` int(5) DEFAULT NULL,
  `master_wo_ex_roll_od` varchar(500) DEFAULT NULL,
  `master_wo_ex_extrude_in` int(5) DEFAULT NULL,
  `master_wo_ex_film_width` varchar(500) DEFAULT NULL,
  `master_wo_ex_film_color` varchar(500) DEFAULT NULL,
  `master_wo_ex_cof` int(5) DEFAULT NULL,
  `master_wo_print_type` int(5) DEFAULT NULL,
  `master_wo_print_design` varchar(698) DEFAULT NULL,
  `master_wo_print_qtykgs` varchar(698) DEFAULT NULL,
  `master_wo_print_mtr` varchar(698) DEFAULT NULL,
  `master_wo_print_type_2` int(5) DEFAULT NULL,
  `master_wo_print_type_3` int(5) DEFAULT NULL,
  `master_wo_print_substrate` varchar(698) DEFAULT NULL,
  `master_wo_print_ups` varchar(698) DEFAULT NULL,
  `master_wo_print_repeat` varchar(698) DEFAULT NULL,
  `master_wo_print_shade_card_req` int(5) DEFAULT NULL,
  `master_wo_print_col_ref_type` int(5) DEFAULT NULL,
  `master_wo_print_col_print_repeat` varchar(500) DEFAULT NULL,
  `master_wo_print_eyemark_col` varchar(500) DEFAULT NULL,
  `master_wo_print_size` varchar(500) DEFAULT NULL,
  `master_wo_print_eyemark_side` varchar(500) DEFAULT NULL,
  `master_wo_print_approval_by` varchar(500) DEFAULT NULL,
  `master_wo_print_plate_cyl` varchar(500) DEFAULT NULL,
  `master_wo_print_ink_sys` varchar(500) DEFAULT NULL,
  `master_wo_print_b_code` varchar(500) DEFAULT NULL,
  `master_wo_print_color` varchar(500) DEFAULT NULL,
  `master_wo_print_ink_gsm` varchar(500) DEFAULT NULL,
  `master_wo_print_pantone_1` varchar(500) DEFAULT NULL,
  `master_wo_print_pantone_2` varchar(500) DEFAULT NULL,
  `master_wo_print_pantone_3` varchar(500) DEFAULT NULL,
  `master_wo_print_pantone_4` varchar(500) DEFAULT NULL,
  `master_wo_print_pantone_5` varchar(500) DEFAULT NULL,
  `master_wo_print_pantone_6` varchar(500) DEFAULT NULL,
  `master_wo_print_pantone_7` varchar(500) DEFAULT NULL,
  `master_wo_print_pantone_8` varchar(500) DEFAULT NULL,
  `master_wo_print_end_options` varchar(698) DEFAULT NULL,
  `master_wo_lam_lam_sleeve` varchar(698) DEFAULT NULL,
  `master_wo_lam_f1_width` varchar(500) DEFAULT NULL,
  `master_wo_lam_f1_kgs` varchar(500) DEFAULT NULL,
  `master_wo_lam_f1_mtr` varchar(500) DEFAULT NULL,
  `master_wo_lam_p1_desc_1` varchar(500) DEFAULT NULL,
  `master_wo_lam_p1_desc_2` varchar(500) DEFAULT NULL,
  `master_wo_lam_f2_width` varchar(500) DEFAULT NULL,
  `master_wo_lam_f2_kgs` varchar(500) DEFAULT NULL,
  `master_wo_lam_f2_mtr` varchar(500) DEFAULT NULL,
  `master_wo_lam_p2_desc_1` varchar(500) DEFAULT NULL,
  `master_wo_lam_p2_desc_2` varchar(500) DEFAULT NULL,
  `master_wo_lam_f3_width` varchar(500) DEFAULT NULL,
  `master_wo_lam_f3_kgs` varchar(500) DEFAULT NULL,
  `master_wo_lam_f3_mtr` varchar(500) DEFAULT NULL,
  `master_wo_lam_p3_desc_1` varchar(500) DEFAULT NULL,
  `master_wo_lam_p3_desc_2` varchar(500) DEFAULT NULL,
  `master_wo_lam_f4_width` varchar(500) DEFAULT NULL,
  `master_wo_lam_f4_kgs` varchar(500) DEFAULT NULL,
  `master_wo_lam_f4_mtr` varchar(500) DEFAULT NULL,
  `master_wo_lam_p4_desc_1` varchar(500) DEFAULT NULL,
  `master_wo_lam_p4_desc_2` varchar(500) DEFAULT NULL,
  `master_wo_lam_f5_width` varchar(500) DEFAULT NULL,
  `master_wo_lam_f5_kgs` varchar(500) DEFAULT NULL,
  `master_wo_lam_f5_mtr` varchar(500) DEFAULT NULL,
  `master_wo_lam_options` varchar(500) DEFAULT NULL,
  `master_wo_bag_qty_kg` varchar(500) DEFAULT NULL,
  `master_wo_bag_nos` varchar(500) DEFAULT NULL,
  `master_wo_bag_width` varchar(500) DEFAULT NULL,
  `master_wo_bag_length` varchar(500) DEFAULT NULL,
  `master_wo_bag_width_2` varchar(500) DEFAULT NULL,
  `master_wo_bag_length_2` varchar(500) DEFAULT NULL,
  `master_wo_bag_thick` varchar(500) DEFAULT NULL,
  `master_wo_bag_guset_side` varchar(500) DEFAULT NULL,
  `master_wo_bag_guset_bottom` varchar(500) DEFAULT NULL,
  `master_wo_bag_guset_top_fold` varchar(500) DEFAULT NULL,
  `master_wo_bag_guset_flap` varchar(500) DEFAULT NULL,
  `master_wo_bag_guset_lip` varchar(500) DEFAULT NULL,
  `master_wo_bag_handle` int(5) DEFAULT NULL,
  `master_wo_bag_vest_handle` int(5) DEFAULT NULL,
  `master_wo_bag_sealing` varchar(500) DEFAULT NULL,
  `master_wo_bag_spl_dia` varchar(500) DEFAULT NULL,
  `master_wo_bag_punch` varchar(500) DEFAULT NULL,
  `master_wo_pouch_qty_kg` varchar(500) DEFAULT NULL,
  `master_wo_pouch_nos` varchar(500) DEFAULT NULL,
  `master_wo_pouch_width` varchar(500) DEFAULT NULL,
  `master_wo_pouch_length` varchar(500) DEFAULT NULL,
  `master_wo_pouch_guset_side` varchar(500) DEFAULT NULL,
  `master_wo_pouch_bot` varchar(500) DEFAULT NULL,
  `master_wo_pouch_sealing` int(5) DEFAULT NULL,
  `master_wo_pouch_width_2` varchar(500) DEFAULT NULL,
  `master_wo_pouch_seal_type` int(5) DEFAULT NULL,
  `master_wo_pouch_euro_punch` int(5) DEFAULT NULL,
  `master_wo_pouch_type` varchar(500) DEFAULT NULL,
  `master_wo_pouch_pouch_open` int(5) DEFAULT NULL,
  `master_wo_pouch_seal` int(5) DEFAULT NULL,
  `master_wo_pouch_closure_type` varchar(500) DEFAULT NULL,
  `master_wo_pouch_dist` varchar(500) DEFAULT NULL,
  `master_wo_pouch_pouch_type` int(5) DEFAULT NULL,
  `master_wo_slit_s_width` varchar(500) DEFAULT NULL,
  `master_wo_slit_wind_dir` int(5) DEFAULT NULL,
  `master_wo_slit_roll_od` varchar(500) DEFAULT NULL,
  `master_wo_slit_wt` varchar(500) DEFAULT NULL,
  `master_wo_slit_mtr` varchar(500) DEFAULT NULL,
  `master_wo_slit_customer` varchar(500) DEFAULT NULL,
  `master_wo_slit_pallet` int(5) DEFAULT NULL,
  `master_wo_slit_packing` varchar(500) DEFAULT NULL,
  `master_wo_slit_packing_5ply` int(5) DEFAULT NULL,
  `master_wo_slit_sticker` int(5) DEFAULT NULL,
  `master_wo_slit_sticker_type` varchar(500) DEFAULT NULL,
  `master_wo_slit_core_id` int(5) DEFAULT NULL,
  `master_wo_slit_core_type` int(5) DEFAULT NULL,
  `master_wo_slit_qc_ins` varchar(500) DEFAULT NULL,
  `master_wo_slit_qc_max_jointrolls` varchar(100) DEFAULT NULL,
  `master_wo_gen_dnt` varchar(698) NOT NULL,
  `master_wo_gen_lum_id` int(255) NOT NULL,
  `master_wo_status` int(5) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_work_order_main`
--

INSERT INTO `master_work_order_main` (`master_wo_id`, `master_wo_lum_id`, `master_wo_ref`, `master_wo_design_id`, `master_wo_po`, `master_wo_client_id`, `master_wo_delivery_date`, `master_wo_lwo`, `master_wo_structure`, `master_wo_final_qty`, `master_wo_qty_unit`, `master_wo_tolerance_1`, `master_wo_tolerance_2`, `master_wo_ply`, `master_wo_application_id`, `master_wo_layer_1_micron`, `master_wo_layer_1_structure`, `master_wo_layer_2_micron`, `master_wo_layer_2_structure`, `master_wo_layer_3_micron`, `master_wo_layer_3_structure`, `master_wo_layer_4_micron`, `master_wo_layer_4_structure`, `master_wo_layer_5_micron`, `master_wo_layer_5_structure`, `master_wo_printed_question`, `master_wo_inhouse_pe_question`, `master_wo_ex_pe_re`, `master_wo_ex_antistatic`, `master_wo_ex_layer`, `master_wo_ex_pack_size`, `master_wo_ex_pkg_speed`, `master_wo_ex_qty_kgs`, `master_wo_ex_mtr`, `master_wo_ex_options`, `master_wo_ex_thickness`, `master_wo_ex_treatment`, `master_wo_ex_roll_od`, `master_wo_ex_extrude_in`, `master_wo_ex_film_width`, `master_wo_ex_film_color`, `master_wo_ex_cof`, `master_wo_print_type`, `master_wo_print_design`, `master_wo_print_qtykgs`, `master_wo_print_mtr`, `master_wo_print_type_2`, `master_wo_print_type_3`, `master_wo_print_substrate`, `master_wo_print_ups`, `master_wo_print_repeat`, `master_wo_print_shade_card_req`, `master_wo_print_col_ref_type`, `master_wo_print_col_print_repeat`, `master_wo_print_eyemark_col`, `master_wo_print_size`, `master_wo_print_eyemark_side`, `master_wo_print_approval_by`, `master_wo_print_plate_cyl`, `master_wo_print_ink_sys`, `master_wo_print_b_code`, `master_wo_print_color`, `master_wo_print_ink_gsm`, `master_wo_print_pantone_1`, `master_wo_print_pantone_2`, `master_wo_print_pantone_3`, `master_wo_print_pantone_4`, `master_wo_print_pantone_5`, `master_wo_print_pantone_6`, `master_wo_print_pantone_7`, `master_wo_print_pantone_8`, `master_wo_print_end_options`, `master_wo_lam_lam_sleeve`, `master_wo_lam_f1_width`, `master_wo_lam_f1_kgs`, `master_wo_lam_f1_mtr`, `master_wo_lam_p1_desc_1`, `master_wo_lam_p1_desc_2`, `master_wo_lam_f2_width`, `master_wo_lam_f2_kgs`, `master_wo_lam_f2_mtr`, `master_wo_lam_p2_desc_1`, `master_wo_lam_p2_desc_2`, `master_wo_lam_f3_width`, `master_wo_lam_f3_kgs`, `master_wo_lam_f3_mtr`, `master_wo_lam_p3_desc_1`, `master_wo_lam_p3_desc_2`, `master_wo_lam_f4_width`, `master_wo_lam_f4_kgs`, `master_wo_lam_f4_mtr`, `master_wo_lam_p4_desc_1`, `master_wo_lam_p4_desc_2`, `master_wo_lam_f5_width`, `master_wo_lam_f5_kgs`, `master_wo_lam_f5_mtr`, `master_wo_lam_options`, `master_wo_bag_qty_kg`, `master_wo_bag_nos`, `master_wo_bag_width`, `master_wo_bag_length`, `master_wo_bag_width_2`, `master_wo_bag_length_2`, `master_wo_bag_thick`, `master_wo_bag_guset_side`, `master_wo_bag_guset_bottom`, `master_wo_bag_guset_top_fold`, `master_wo_bag_guset_flap`, `master_wo_bag_guset_lip`, `master_wo_bag_handle`, `master_wo_bag_vest_handle`, `master_wo_bag_sealing`, `master_wo_bag_spl_dia`, `master_wo_bag_punch`, `master_wo_pouch_qty_kg`, `master_wo_pouch_nos`, `master_wo_pouch_width`, `master_wo_pouch_length`, `master_wo_pouch_guset_side`, `master_wo_pouch_bot`, `master_wo_pouch_sealing`, `master_wo_pouch_width_2`, `master_wo_pouch_seal_type`, `master_wo_pouch_euro_punch`, `master_wo_pouch_type`, `master_wo_pouch_pouch_open`, `master_wo_pouch_seal`, `master_wo_pouch_closure_type`, `master_wo_pouch_dist`, `master_wo_pouch_pouch_type`, `master_wo_slit_s_width`, `master_wo_slit_wind_dir`, `master_wo_slit_roll_od`, `master_wo_slit_wt`, `master_wo_slit_mtr`, `master_wo_slit_customer`, `master_wo_slit_pallet`, `master_wo_slit_packing`, `master_wo_slit_packing_5ply`, `master_wo_slit_sticker`, `master_wo_slit_sticker_type`, `master_wo_slit_core_id`, `master_wo_slit_core_type`, `master_wo_slit_qc_ins`, `master_wo_slit_qc_max_jointrolls`, `master_wo_gen_dnt`, `master_wo_gen_lum_id`, `master_wo_status`) VALUES
(1, 3, 1, 'D06402', 'OLD PO', 10, '1607803103', '12', '3', '1', '1', '1', '1', 2, 6, '1', '7', '32', '17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '4', '5', '', '45', '1', '5', '1', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3,4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, '1', '1', '1', '1,3', 1, '1,2,4,5', 2, 1, '1,2', 4, 1, '1,3,4', '', '1599940337', 10, 1),
(2, 3, 1, 'D06402', 'OLD PO', 10, '1607803136', '12', '3', '1', '1', '1', '1', 2, 6, '1', '7', '32', '17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11312', '4', '5', '', '45', '1', '5', '1', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2,3,4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, '1', '1', '1', '1,3', 1, '1,2,4,5', 2, 1, '1,2', 4, 1, '1,3,4', '', '1599940722', 10, 2),
(3, 3, 1, 'D06402', 'OLD PO', 10, '1607803136', '12', '3', '1', '1', '1', '1', 2, 6, '1', '7', '32', '17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11312', '4', '5', '', '45', '1', '5', '1', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2,3,4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, '1', '1', '1', '1,3', 1, '1,2,4,5', 2, 1, '1,2', 4, 1, '1,3,4', '', '1599940749', 10, 1),
(4, 3, 1, 'D06402', 'FACTORY MANAGER VERSION', 10, '1607716933', '12', '3', '1', '1', '1', '1', 2, 6, '1', '7', '32', '17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11312', '4', '5', '', '45', '1', '5', '1', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2,3,4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, '1', '1', '1', '1,3', 1, '1,2,4,5', 2, 1, '1,2', 4, 1, '1,3,4', '', '1599940756', 10, 3),
(5, 3, 1, 'D06402', 'THIS IS THE NEW PO', 10, '1607716933', '12', '3', '1', '1', '1', '1', 2, 6, '1', '7', '32', '17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11312', '4', '5', '', '45', '1', '5', '1', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2,3,4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, '1', '1', '1', '1,3', 1, '1,2,4,5', 2, 1, '1,2', 4, 1, '1,3,4', '', '1599940946', 10, 5),
(6, 3, 1, 'D06402', 'THIS IS THE NEW PO', 10, '1607716933', '12', '3', '1', '1', '1', '1', 2, 6, '1', '7', '32', '17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11312', '4', '5', '', '45', '1', '5', '1', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2,3,4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, '1', '1', '1', '1,3', 1, '1,2,4,5', 2, 1, '1,2', 4, 1, '1,3,4', '', '1599941282', 10, 6),
(7, 3, 1, 'D06402', 'THIS IS THE NEW PO', 10, '1607716933', '12', '3', '1', '1', '1', '1', 2, 6, '1', '7', '32', '17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11312', '4', '5', '', '45', '1', '5', '1', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2,3,4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, '1', '1', '1', '1,3', 1, '1,2,4,5', 2, 1, '1,2', 4, 1, '1,3,4', '', '1599941346', 10, 7),
(8, 3, 1, 'D06402', 'THIS IS THE NEW PO', 10, '1607716933', '12', '3', '1', '1', '1', '1', 2, 6, '1', '7', '32', '17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11312', '4', '5', '', '45', '1', '5', '1', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2,3,4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, '1', '1', '1', '1,3', 1, '1,2,4,5', 2, 1, '1,2', 4, 1, '1,3,4', '', '1599941371', 10, 8),
(9, 3, 1, 'D06402', 'THIS IS THE NEW PO', 10, '1607716933', '12', '3', '1', '1', '1', '1', 2, 6, '1', '7', '32', '17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11312', '4', '5', '', '45', '1', '5', '1', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2,3,4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, '1', '1', '1', '1,3', 1, '1,2,4,5', 2, 1, '1,2', 4, 1, '1,3,4', '', '1599941384', 10, 9),
(10, 9, 2, 'D06402', '', 1, '1607802189', '', '1', '50000', '2', '1', '2', 1, 1, '4.3', '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', '8', '7', '6', '5', '4', '3', '2', '1', '999', '888', '777', 3, 2, '4,5', '90', '2,3,5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 3, '2', '3', '4', '1,2,3', 1, '4,5', 2, 1, '1,2', 3, 1, '1,2,3,4,5', '56', '1599941531', 9, 1),
(11, 9, 2, 'D06402', '', 1, '1607802189', '', '1', '50000', '2', '1', '2', 1, 1, '4.3', '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', '8', '7', '6', '5', '4', '3', '2', '1', '999', '888', '777', 3, 2, '4,5', '90', '2,3,5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 3, '2', '3', '4', '1,2,3', 1, '4,5', 2, 1, '1,2', 3, 1, '1,2,3,4,5', '56', '1599941534', 9, 3),
(12, 9, 2, 'D06402', '', 1, '1607802189', '', '1', '50000', '2', '1', '2', 1, 1, '4.3', '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', '8', '7', '6', '5', '4', '3', '2', '1', '999', '888', '777', 3, 2, '4,5', '90', '2,3,5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 3, '2', '3', '4', '1,2,3', 1, '4,5', 2, 1, '1,2', 3, 1, '1,2,3,4,5', '56', '1599941540', 9, 5),
(13, 9, 2, 'D06402', '', 1, '1607802189', '', '1', '50000', '2', '1', '2', 1, 1, '4.3', '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', '8', '7', '6', '5', '4', '3', '2', '1', '999', '888', '777', 3, 2, '4,5', '90', '2,3,5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 3, '2', '3', '4', '1,2,3', 1, '4,5', 2, 1, '1,2', 3, 1, '1,2,3,4,5', '56', '1599941545', 9, 6),
(14, 9, 2, 'D06402', '', 1, '1607802189', '', '1', '50000', '2', '1', '2', 1, 1, '4.3', '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', '8', '7', '6', '5', '4', '3', '2', '1', '999', '888', '777', 3, 2, '4,5', '90', '2,3,5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 3, '2', '3', '4', '1,2,3', 1, '4,5', 2, 1, '1,2', 3, 1, '1,2,3,4,5', '56', '1599941550', 9, 7),
(15, 1, 3, 'DPRINT', 'PO', 13, '1607773580', 'LWO', '3', '134', '1', '1', '4', 1, 2, '5455', '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '', '', '', 1, 1, '', '0x0', '(0x0)+0', 1, 1, '0+0', '', '0x0', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '1,9,10,11,12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234', 2, '5', '6', '7', '1', 1, '1,4', 2, 1, '1,2', 4, 1, '1,5', '13', '1599997584', 1, 1),
(16, 1, 3, 'DPRINT', 'PO', 13, '1607773580', 'LWO', '3', '134', '1', '1', '4', 1, 2, '5455', '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '', '', '', 1, 1, '', '0x0', '(0x0)+0', 1, 1, '0+0', '', '0x0', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '1,9,10,11,12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234', 2, '5', '6', '7', '1', 1, '1,4', 2, 1, '1,2', 4, 1, '1,5', '13', '1599997589', 1, 3),
(17, 1, 3, 'DPRINT', 'PCPO', 13, '1607773580', 'LWO', '3', '134', '1', '1', '4', 1, 2, '5455', '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '', '', '', 1, 1, '', '0x0', '(0x0)+0', 1, 1, '0+0', '', '0x0', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '1,9,10,11,12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234', 2, '5', '6', '7', '1', 1, '1,4', 2, 1, '1,2', 4, 1, '1,5', '13', '1599997592', 1, 5),
(18, 1, 3, 'DPRINT', 'PCPO', 13, '1607773580', 'LWO', '3', '134', '1', '1', '4', 1, 2, '5455', '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '', '', '', 1, 1, '', '0x0', '(0x0)+0', 1, 1, '0+0', '', '0x0', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '1,9,10,11,12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234', 2, '5', '6', '7', '1', 1, '1,4', 2, 1, '1,2', 4, 1, '1,5', '13', '1599997656', 1, 6),
(19, 1, 3, 'DPRINT', 'PCPO', 13, '1607773580', 'LWO', '3', '134', '1', '1', '4', 1, 2, '5455', '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5', '123', '5', 1, 2, '543', '0x0', '(0x0)+0', 2, 2, '0+0', '1234', '0x0', '1', '1,2,3', '5', '1', '23', '124', '5', '5', '1', '4', '5', '54terf', 'ef', 'wef', 'ffwwef', '1,2,8,9,10,11,12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234', 2, '5', '6', '7', '1', 1, '1,4', 2, 1, '1,2', 4, 1, '1,5', '13', '1599997661', 1, 7),
(20, 1, 3, 'DPRINT', 'PCPO', 13, '1607773580', 'LWO', '3', '134', '1', '1', '4', 1, 2, '5455', '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5', '123', '5', 1, 2, '543', '0x0', '(0x0)+0', 2, 2, '0+0', '1234', '0x0', '1', '1,2,3', '5', '1', '23', '124', '5', '5', '1', '4', '5', '54terf', 'ef', 'wef', 'ffwwef', '1,2,8,9,10,11,12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234', 2, '5', '6', '7', '1', 1, '1,4', 2, 1, '1,2', 4, 1, '1,5', '13', '1599997744', 1, 8),
(21, 9, 4, 'D14124234', '13r2r13r', 13, '1607792436', 'q23fr2wgfewrsgbesrgh', '3', '14124', '2', '12', '5', 2, 2, '1.2', '3', '1', '3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', '', '1', 1, '1', NULL, 1, '1', 1, 1, '1', '', '1600016413', 3, 1),
(22, 9, 4, 'D14124234', '13r2r13r', 13, '1607792467', 'q23fr2wgfewrsgbesrgh', '3', '14124', '2', '12', '5', 2, 2, '1.18', '3', '1.04', '3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '3r24t5t4rhytjutyhtegrwe', 'egsrdhgnfhmbm,', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', '', '1', 1, '1', NULL, 1, '1', 1, 1, '1', '', '1600016445', 3, 2),
(23, 9, 4, 'D14124234', '13r2r13r', 13, '1607792467', 'q23fr2wgfewrsgbesrgh', '3', '14124', '2', '12', '5', 2, 2, '1.18', '3', '1.04', '3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '3r24t5t4rhytjutyhtegrwe', 'egsrdhgnfhmbm,', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', '', '1', 1, '1', NULL, 1, '1', 1, 1, '1', '', '1600016473', 3, 1),
(24, 9, 4, 'D14124234', '13r2r13r', 13, '1607792467', 'q23fr2wgfewrsgbesrgh', '3', '14124', '2', '12', '5', 2, 2, '1.18', '3', '1.04', '3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '3r24t5t4rhytjutyhtegrwe', 'egsrdhgnfhmbm,', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', '', '1', 1, '1', NULL, 1, '1', 1, 1, '1', '', '1600016500', 3, 3),
(25, 9, 4, 'D14124234', '13', 13, '1607792467', 'q23fr2wgfewrsgbesrgh', '3', '14124', '2', '12', '5', 2, 2, '1.18', '3', '1.04', '3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '3r24t5t4rhytjutyhtegrwe', 'egsrdhgnfhmbm,', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', '', '1', 1, '1', NULL, 1, '1', 1, 1, '1', '', '1600016516', 3, 5),
(26, 9, 4, 'D14124234', '13', 13, '1607792467', 'q23fr2wgfewrsgbesrgh', '3', '14124', '2', '12', '5', 2, 2, '1.18', '3', '1.04', '3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '3r24t5t4rhytjutyhtegrwe', 'egsrdhgnfhmbm,', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', '', '1', 1, '1', NULL, 1, '1', 1, 1, '1', '', '1600016557', 3, 6),
(27, 9, 4, 'D14124234', '13', 13, '1607792467', 'q23fr2wgfewrsgbesrgh', '3', '14124', '2', '12', '5', 2, 2, '1.18', '3', '1.04', '3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '3r24t5t4rhytjutyhtegrwe', 'egsrdhgnfhmbm,', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', '', '1', 1, '1', NULL, 1, '1', 1, 1, '1', '', '1600016577', 3, 7),
(28, 9, 4, 'D14124234', '13', 13, '1607792467', 'q23fr2wgfewrsgbesrgh', '3', '14124', '2', '12', '5', 2, 2, '1.18', '3', '1.04', '3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '3r24t5t4rhytjutyhtegrwe', 'egsrdhgnfhmbm,', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', '', '1', 1, '1', NULL, 1, '1', 1, 1, '1', '', '1600016599', 3, 8),
(29, 9, 4, 'D14124234', '13', 13, '1607792467', 'q23fr2wgfewrsgbesrgh', '3', '14124', '2', '12', '5', 2, 2, '1.18', '3', '1.04', '3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '3r24t5t4rhytjutyhtegrwe', 'egsrdhgnfhmbm,', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', '', '1', 1, '1', NULL, 1, '1', 1, 1, '1', '', '1600016613', 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `master_work_order_main_identitiy`
--

CREATE TABLE `master_work_order_main_identitiy` (
  `mwoid_id` int(100) NOT NULL,
  `mwoid_desc1` varchar(500) NOT NULL,
  `mwoid_desc2` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_work_order_main_identitiy`
--

INSERT INTO `master_work_order_main_identitiy` (`mwoid_id`, `mwoid_desc1`, `mwoid_desc2`) VALUES
(1, 'Sales- Published', 'Awaiting Quality Approval'),
(2, 'Quality - Returned', 'Work Order Returned from Quality'),
(3, 'Quality - Published', 'Awaiting Factory Manager Approval'),
(4, 'Factory Manager - Returned', 'Work Order Returned from Factory Manager'),
(5, 'Factory Manager - Published', 'Awaiting Pre Costing Approval'),
(6, 'Pre Cost - Published', 'Awaiting Accounts Approval'),
(7, 'Accounts - Published', 'Awaiting Pre Press Approval'),
(8, 'Pre Press - Published', 'Awaiting Planning Approval'),
(9, 'Planning - Published', 'Chain Complete'),
(10, 'Overwritten', 'Old Version'),
(23, 'Q - Override', 'Overridden by Quality'),
(45, 'FM - Override', 'Overridden by Factory Manager');

-- --------------------------------------------------------

--
-- Table structure for table `master_work_order_reference_number`
--

CREATE TABLE `master_work_order_reference_number` (
  `mwo_ref_id` int(255) NOT NULL,
  `mwo_dnt` varchar(698) NOT NULL,
  `mwo_repeat_wo_id` int(255) DEFAULT NULL,
  `mwo_gen_on_behalf_lum_id` int(255) NOT NULL,
  `mwo_gen_lum_id` int(255) NOT NULL,
  `mwo_sales_wo_id` int(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_work_order_reference_number`
--

INSERT INTO `master_work_order_reference_number` (`mwo_ref_id`, `mwo_dnt`, `mwo_repeat_wo_id`, `mwo_gen_on_behalf_lum_id`, `mwo_gen_lum_id`, `mwo_sales_wo_id`) VALUES
(1, '1599940337', NULL, 3, 10, 2),
(2, '1599941531', NULL, 9, 9, 1),
(3, '1599997584', NULL, 1, 1, 3),
(4, '1600016413', NULL, 9, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `materials_main`
--

CREATE TABLE `materials_main` (
  `material_id` int(50) NOT NULL,
  `material_value` varchar(698) NOT NULL,
  `material_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials_main`
--

INSERT INTO `materials_main` (`material_id`, `material_value`, `material_show`) VALUES
(1, 'PET', 1),
(2, 'METTALIZED PET', 1),
(3, 'ALUMINUM FOIL', 1),
(4, 'TPE', 1),
(5, 'WPE', 1),
(6, 'TOPP', 1),
(7, 'MATTEE OPP', 1),
(8, 'MOPP', 1),
(9, 'PEARLISED BOPP', 1),
(10, 'PBOPP LABEL GRADE', 1),
(11, 'MPOPP', 1),
(12, 'NYLON', 1),
(13, 'TCPP', 1),
(14, 'METALLIZED CPP', 1),
(15, 'PAPER', 1),
(16, 'PAPER FEEL POLY', 1),
(17, 'BUTTER FOIL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules_groups`
--

CREATE TABLE `modules_groups` (
  `mg_id` int(255) NOT NULL,
  `mg_name` varchar(698) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules_groups`
--

INSERT INTO `modules_groups` (`mg_id`, `mg_name`) VALUES
(1, 'Work Order '),
(2, 'Dependencies'),
(3, 'Sales Attach'),
(4, 'Customer'),
(5, 'Main'),
(6, 'Logs');

-- --------------------------------------------------------

--
-- Table structure for table `modules_main`
--

CREATE TABLE `modules_main` (
  `mod_id` int(255) NOT NULL,
  `mod_mg_id` int(255) NOT NULL,
  `mod_name` varchar(155) NOT NULL,
  `mod_href` varchar(155) NOT NULL,
  `mod_icon` varchar(155) NOT NULL,
  `mod_visible` int(2) NOT NULL DEFAULT '1',
  `mod_valid` int(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules_main`
--

INSERT INTO `modules_main` (`mod_id`, `mod_mg_id`, `mod_name`, `mod_href`, `mod_icon`, `mod_visible`, `mod_valid`) VALUES
(1, 5, 'Dashboard', 'home', 'fas fa-table', 1, 1),
(9, 1, 'Work Order Make - S', 'work_order_sales_generate', 'fas fa-clipboard-list', 1, 1),
(2, 1, 'Work Order - S', 'work_order_sales', 'fas fa-clipboard-list', 1, 1),
(10, 1, 'Sales Work Order Generate Controller', 'SalesWorkOrderSubmit', 'fa fa-home', 0, 1),
(11, 1, 'Sales Work Order Backend Viewer Getter', 'WorkOrderSalesViewGetter', 'fa fa-home', 0, 1),
(12, 2, 'Form Manager', 'form_manager', 'fas fa-clipboard-list', 1, 1),
(13, 2, 'Form Manager Controller', 'FormManagerController', 'fa fa-home', 0, 1),
(14, 1, 'Main Work Order Backend Generate', 'MainWorkOrderSubmit', 'fa fa-home', 0, 1),
(15, 1, 'Work Order - Q', 'work_order_quality', 'fas fa-clipboard-list', 1, 1),
(16, 1, 'Work Order - FM', 'work_order_factory', 'fas fa-clipboard-list', 1, 1),
(17, 1, 'Work Order - PC', 'work_order_pre_costing', 'fas fa-clipboard-list', 1, 1),
(18, 1, 'Work Order - A', 'work_order_accounts', 'fas fa-clipboard-list', 1, 1),
(19, 1, 'Work Order - PP', 'work_order_pre_press', 'fas fa-clipboard-list', 1, 1),
(20, 1, 'Work Order - P', 'work_order_planning', 'fas fa-clipboard-list', 1, 1),
(21, 1, 'Main Work Order Backend Generate All', 'MainWorkOrderSubmitAll', 'fa fa-home', 0, 1),
(22, 1, 'Sales Work Order Controller', 'SalesWorkOrderController', 'fa fa-home', 0, 1),
(23, 1, 'Work Order View Print', 'work_order_view_print', 'fas fa-clipboard-list', 0, 1),
(25, 1, 'Work Order Controller Main Edit', 'WorkOrderControllerEdit', 'fa fa-home', 0, 1),
(26, 1, 'Work Order Main Edit', 'work_order_main_edit', 'fas fa-clipboard-list', 0, 1),
(27, 2, 'Work Order Version Control', 'work_order_tracker', 'fas fa-clipboard-list', 1, 1),
(28, 1, 'Pre Costing Controller', 'PreCostController', 'fa fa-home', 0, 1),
(29, 1, 'Complaints', 'complaints', 'fas fa-clipboard-list', 1, 1),
(30, 1, 'Complaints Controller', 'ComplaintsController', 'fa fa-home', 0, 1),
(31, 2, 'Attach', 'attach', 'fas fa-table', 1, 1),
(32, 2, 'Attach Controller', 'AttachController', 'fa fa-home', 0, 1),
(33, 2, 'Users', 'admin_users', 'fas fa-users', 1, 1),
(34, 2, 'Admin Controller', 'AdminController', 'fa fa-home', 0, 1),
(35, 5, 'Profile', 'profile', 'fas fa-user', 1, 1),
(36, 1, 'Pre Press Controller', 'PrePressController', 'fa fa-home', 0, 1),
(37, 6, 'Admin Logs', 'admin_logs', 'fas fa-clipboard-list', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `remarks_identity`
--

CREATE TABLE `remarks_identity` (
  `remarkiden_id` int(15) NOT NULL,
  `remarkiden_vale` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remarks_identity`
--

INSERT INTO `remarks_identity` (`remarkiden_id`, `remarkiden_vale`) VALUES
(1, 'Overall'),
(2, 'Extrusion'),
(3, 'Printing'),
(4, 'Lamination'),
(5, 'Pouch'),
(6, 'Bags'),
(7, 'Slitting');

-- --------------------------------------------------------

--
-- Table structure for table `remarks_wo`
--

CREATE TABLE `remarks_wo` (
  `remark_id` int(255) NOT NULL,
  `remark_lum_id` int(255) NOT NULL,
  `remark_text` text NOT NULL,
  `remark_master_wo_id` int(255) NOT NULL,
  `remark_dnt` varchar(698) NOT NULL,
  `remark_type` int(5) NOT NULL,
  `remark_status` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remarks_wo`
--

INSERT INTO `remarks_wo` (`remark_id`, `remark_lum_id`, `remark_text`, `remark_master_wo_id`, `remark_dnt`, `remark_type`, `remark_status`) VALUES
(1, 10, 'O', 1, '1599940337', 1, 1),
(2, 10, 'S', 1, '1599940337', 7, 1),
(3, 8, 'OK O', 1, '1599940703', 1, 1),
(4, 8, 'LAM REM', 1, '1599940703', 4, 1),
(5, 8, 'OK S', 1, '1599940703', 7, 1),
(6, 6, 'UPDATED PO SHEET', 1, '1599941276', 1, 1),
(7, 1, 'SHORT WO', 2, '1599941531', 1, 1),
(8, 1, 'SHORT BAG', 2, '1599941531', 6, 1),
(9, 1, 'Short Piece Slit', 2, '1599941531', 7, 1),
(10, 6, 'New PO Issued`', 3, '1599997625', 1, 1),
(11, 7, 'NEWLY ENTERED', 3, '1599997730', 3, 1),
(12, 6, 'OIERJNGKFM', 4, '1600016550', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_work_order_main`
--

CREATE TABLE `sales_work_order_main` (
  `s_wo_id` int(255) NOT NULL,
  `s_wo_lum_id` int(255) NOT NULL,
  `s_wo_design_id` varchar(500) DEFAULT NULL,
  `s_wo_po` varchar(698) DEFAULT NULL,
  `s_wo_client_id` int(255) NOT NULL,
  `s_wo_delivery_date` varchar(698) DEFAULT NULL,
  `s_wo_lwo` varchar(698) DEFAULT NULL,
  `s_wo_structure` varchar(698) NOT NULL,
  `s_wo_final_qty` varchar(698) DEFAULT NULL,
  `s_wo_qty_unit` varchar(698) DEFAULT NULL,
  `s_wo_tolerance_1` varchar(698) DEFAULT NULL,
  `s_wo_tolerance_2` varchar(698) DEFAULT NULL,
  `s_wo_ply` int(5) DEFAULT NULL,
  `s_wo_application_id` int(255) DEFAULT NULL,
  `s_wo_layer_1_micron` varchar(698) DEFAULT NULL,
  `s_wo_layer_1_structure` varchar(698) DEFAULT NULL,
  `s_wo_layer_2_micron` varchar(698) DEFAULT NULL,
  `s_wo_layer_2_structure` varchar(698) DEFAULT NULL,
  `s_wo_layer_3_micron` varchar(698) DEFAULT NULL,
  `s_wo_layer_3_structure` varchar(698) DEFAULT NULL,
  `s_wo_layer_4_micron` varchar(698) DEFAULT NULL,
  `s_wo_layer_4_structure` varchar(698) DEFAULT NULL,
  `s_wo_layer_5_micron` varchar(698) DEFAULT NULL,
  `s_wo_layer_5_structure` varchar(698) DEFAULT NULL,
  `s_wo_printed_question` int(2) NOT NULL,
  `s_wo_inhouse_pe_question` int(2) NOT NULL,
  `s_wo_ex_pe_re` varchar(698) DEFAULT NULL,
  `s_wo_ex_antistatic` int(10) DEFAULT NULL,
  `s_wo_ex_layer` int(10) DEFAULT NULL,
  `s_wo_ex_pack_size` varchar(500) DEFAULT NULL,
  `s_wo_ex_pkg_speed` varchar(500) DEFAULT NULL,
  `s_wo_ex_qty_kgs` varchar(500) DEFAULT NULL,
  `s_wo_ex_mtr` varchar(500) DEFAULT NULL,
  `s_wo_ex_options` varchar(698) DEFAULT NULL,
  `s_wo_ex_thickness` varchar(500) DEFAULT NULL,
  `s_wo_ex_treatment` int(5) DEFAULT NULL,
  `s_wo_ex_roll_od` varchar(500) DEFAULT NULL,
  `s_wo_ex_extrude_in` int(5) DEFAULT NULL,
  `s_wo_ex_film_width` varchar(500) DEFAULT NULL,
  `s_wo_ex_film_color` varchar(500) DEFAULT NULL,
  `s_wo_ex_cof` int(5) DEFAULT NULL,
  `s_wo_print_type` int(5) DEFAULT NULL,
  `s_wo_print_design` varchar(698) DEFAULT NULL,
  `s_wo_print_qtykgs` varchar(698) DEFAULT NULL,
  `s_wo_print_mtr` varchar(698) DEFAULT NULL,
  `s_wo_print_type_2` int(5) DEFAULT NULL,
  `s_wo_print_type_3` int(5) DEFAULT NULL,
  `s_wo_print_substrate` varchar(698) DEFAULT NULL,
  `s_wo_print_ups` varchar(698) DEFAULT NULL,
  `s_wo_print_repeat` varchar(698) DEFAULT NULL,
  `s_wo_print_shade_card_req` int(5) DEFAULT NULL,
  `s_wo_print_col_ref_type` int(5) DEFAULT NULL,
  `s_wo_print_col_print_repeat` varchar(500) DEFAULT NULL,
  `s_wo_print_eyemark_col` varchar(500) DEFAULT NULL,
  `s_wo_print_size` varchar(500) DEFAULT NULL,
  `s_wo_print_eyemark_side` varchar(500) DEFAULT NULL,
  `s_wo_print_approval_by` varchar(500) DEFAULT NULL,
  `s_wo_print_plate_cyl` varchar(500) DEFAULT NULL,
  `s_wo_print_ink_sys` varchar(500) DEFAULT NULL,
  `s_wo_print_b_code` varchar(500) DEFAULT NULL,
  `s_wo_print_color` varchar(500) DEFAULT NULL,
  `s_wo_print_ink_gsm` varchar(500) DEFAULT NULL,
  `s_wo_print_pantone_1` varchar(500) DEFAULT NULL,
  `s_wo_print_pantone_2` varchar(500) DEFAULT NULL,
  `s_wo_print_pantone_3` varchar(500) DEFAULT NULL,
  `s_wo_print_pantone_4` varchar(500) DEFAULT NULL,
  `s_wo_print_pantone_5` varchar(500) DEFAULT NULL,
  `s_wo_print_pantone_6` varchar(500) DEFAULT NULL,
  `s_wo_print_pantone_7` varchar(500) DEFAULT NULL,
  `s_wo_print_pantone_8` varchar(500) DEFAULT NULL,
  `s_wo_print_end_options` varchar(698) DEFAULT NULL,
  `s_wo_lam_lam_sleeve` varchar(698) DEFAULT NULL,
  `s_wo_lam_f1_width` varchar(500) DEFAULT NULL,
  `s_wo_lam_f1_kgs` varchar(500) DEFAULT NULL,
  `s_wo_lam_f1_mtr` varchar(500) DEFAULT NULL,
  `s_wo_lam_p1_desc_1` varchar(500) DEFAULT NULL,
  `s_wo_lam_p1_desc_2` varchar(500) DEFAULT NULL,
  `s_wo_lam_f2_width` varchar(500) DEFAULT NULL,
  `s_wo_lam_f2_kgs` varchar(500) DEFAULT NULL,
  `s_wo_lam_f2_mtr` varchar(500) DEFAULT NULL,
  `s_wo_lam_p2_desc_1` varchar(500) DEFAULT NULL,
  `s_wo_lam_p2_desc_2` varchar(500) DEFAULT NULL,
  `s_wo_lam_f3_width` varchar(500) DEFAULT NULL,
  `s_wo_lam_f3_kgs` varchar(500) DEFAULT NULL,
  `s_wo_lam_f3_mtr` varchar(500) DEFAULT NULL,
  `s_wo_lam_p3_desc_1` varchar(500) DEFAULT NULL,
  `s_wo_lam_p3_desc_2` varchar(500) DEFAULT NULL,
  `s_wo_lam_f4_width` varchar(500) DEFAULT NULL,
  `s_wo_lam_f4_kgs` varchar(500) DEFAULT NULL,
  `s_wo_lam_f4_mtr` varchar(500) DEFAULT NULL,
  `s_wo_lam_p4_desc_1` varchar(500) DEFAULT NULL,
  `s_wo_lam_p4_desc_2` varchar(500) DEFAULT NULL,
  `s_wo_lam_f5_width` varchar(500) DEFAULT NULL,
  `s_wo_lam_f5_kgs` varchar(500) DEFAULT NULL,
  `s_wo_lam_f5_mtr` varchar(500) DEFAULT NULL,
  `s_wo_lam_options` varchar(500) DEFAULT NULL,
  `s_wo_bag_qty_kg` varchar(500) DEFAULT NULL,
  `s_wo_bag_nos` varchar(500) DEFAULT NULL,
  `s_wo_bag_width` varchar(500) DEFAULT NULL,
  `s_wo_bag_length` varchar(500) DEFAULT NULL,
  `s_wo_bag_width_2` varchar(500) DEFAULT NULL,
  `s_wo_bag_length_2` varchar(500) DEFAULT NULL,
  `s_wo_bag_thick` varchar(500) DEFAULT NULL,
  `s_wo_bag_guset_side` varchar(500) DEFAULT NULL,
  `s_wo_bag_guset_bottom` varchar(500) DEFAULT NULL,
  `s_wo_bag_guset_top_fold` varchar(500) DEFAULT NULL,
  `s_wo_bag_guset_flap` varchar(500) DEFAULT NULL,
  `s_wo_bag_guset_lip` varchar(500) DEFAULT NULL,
  `s_wo_bag_handle` int(5) DEFAULT NULL,
  `s_wo_bag_vest_handle` int(5) DEFAULT NULL,
  `s_wo_bag_sealing` varchar(500) DEFAULT NULL,
  `s_wo_bag_spl_dia` varchar(500) DEFAULT NULL,
  `s_wo_bag_punch` varchar(500) DEFAULT NULL,
  `s_wo_pouch_qty_kg` varchar(500) DEFAULT NULL,
  `s_wo_pouch_nos` varchar(500) DEFAULT NULL,
  `s_wo_pouch_width` varchar(500) DEFAULT NULL,
  `s_wo_pouch_length` varchar(500) DEFAULT NULL,
  `s_wo_pouch_guset_side` varchar(500) DEFAULT NULL,
  `s_wo_pouch_bot` varchar(500) DEFAULT NULL,
  `s_wo_pouch_sealing` int(5) DEFAULT NULL,
  `s_wo_pouch_width_2` varchar(500) DEFAULT NULL,
  `s_wo_pouch_seal_type` int(5) DEFAULT NULL,
  `s_wo_pouch_euro_punch` int(5) DEFAULT NULL,
  `s_wo_pouch_type` varchar(500) DEFAULT NULL,
  `s_wo_pouch_pouch_open` int(5) DEFAULT NULL,
  `s_wo_pouch_seal` int(5) DEFAULT NULL,
  `s_wo_pouch_closure_type` varchar(500) DEFAULT NULL,
  `s_wo_pouch_dist` varchar(500) DEFAULT NULL,
  `s_wo_pouch_pouch_type` int(5) DEFAULT NULL,
  `s_wo_slit_s_width` varchar(500) DEFAULT NULL,
  `s_wo_slit_wind_dir` int(5) DEFAULT NULL,
  `s_wo_slit_roll_od` varchar(500) DEFAULT NULL,
  `s_wo_slit_wt` varchar(500) DEFAULT NULL,
  `s_wo_slit_mtr` varchar(500) DEFAULT NULL,
  `s_wo_slit_customer` varchar(500) DEFAULT NULL,
  `s_wo_slit_pallet` int(5) DEFAULT NULL,
  `s_wo_slit_packing` varchar(500) DEFAULT NULL,
  `s_wo_slit_packing_5ply` int(5) DEFAULT NULL,
  `s_wo_slit_sticker` int(5) DEFAULT NULL,
  `s_wo_slit_sticker_type` varchar(500) DEFAULT NULL,
  `s_wo_slit_core_id` int(5) DEFAULT NULL,
  `s_wo_slit_core_type` int(5) DEFAULT NULL,
  `s_wo_slit_qc_ins` varchar(500) DEFAULT NULL,
  `s_wo_slit_qc_max_jointrolls` varchar(100) DEFAULT NULL,
  `s_wo_remarks_overall` text,
  `s_wo_remarks_ext` text,
  `s_wo_remarks_print` text,
  `s_wo_remarks_lam` text,
  `s_wo_remarks_pouch` text,
  `s_wo_remarks_bag` text,
  `s_wo_remarks_slit` text,
  `s_wo_gen_dnt` varchar(698) NOT NULL,
  `s_wo_gen_lum_id` int(255) NOT NULL,
  `s_wo_status` int(5) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_work_order_main`
--

INSERT INTO `sales_work_order_main` (`s_wo_id`, `s_wo_lum_id`, `s_wo_design_id`, `s_wo_po`, `s_wo_client_id`, `s_wo_delivery_date`, `s_wo_lwo`, `s_wo_structure`, `s_wo_final_qty`, `s_wo_qty_unit`, `s_wo_tolerance_1`, `s_wo_tolerance_2`, `s_wo_ply`, `s_wo_application_id`, `s_wo_layer_1_micron`, `s_wo_layer_1_structure`, `s_wo_layer_2_micron`, `s_wo_layer_2_structure`, `s_wo_layer_3_micron`, `s_wo_layer_3_structure`, `s_wo_layer_4_micron`, `s_wo_layer_4_structure`, `s_wo_layer_5_micron`, `s_wo_layer_5_structure`, `s_wo_printed_question`, `s_wo_inhouse_pe_question`, `s_wo_ex_pe_re`, `s_wo_ex_antistatic`, `s_wo_ex_layer`, `s_wo_ex_pack_size`, `s_wo_ex_pkg_speed`, `s_wo_ex_qty_kgs`, `s_wo_ex_mtr`, `s_wo_ex_options`, `s_wo_ex_thickness`, `s_wo_ex_treatment`, `s_wo_ex_roll_od`, `s_wo_ex_extrude_in`, `s_wo_ex_film_width`, `s_wo_ex_film_color`, `s_wo_ex_cof`, `s_wo_print_type`, `s_wo_print_design`, `s_wo_print_qtykgs`, `s_wo_print_mtr`, `s_wo_print_type_2`, `s_wo_print_type_3`, `s_wo_print_substrate`, `s_wo_print_ups`, `s_wo_print_repeat`, `s_wo_print_shade_card_req`, `s_wo_print_col_ref_type`, `s_wo_print_col_print_repeat`, `s_wo_print_eyemark_col`, `s_wo_print_size`, `s_wo_print_eyemark_side`, `s_wo_print_approval_by`, `s_wo_print_plate_cyl`, `s_wo_print_ink_sys`, `s_wo_print_b_code`, `s_wo_print_color`, `s_wo_print_ink_gsm`, `s_wo_print_pantone_1`, `s_wo_print_pantone_2`, `s_wo_print_pantone_3`, `s_wo_print_pantone_4`, `s_wo_print_pantone_5`, `s_wo_print_pantone_6`, `s_wo_print_pantone_7`, `s_wo_print_pantone_8`, `s_wo_print_end_options`, `s_wo_lam_lam_sleeve`, `s_wo_lam_f1_width`, `s_wo_lam_f1_kgs`, `s_wo_lam_f1_mtr`, `s_wo_lam_p1_desc_1`, `s_wo_lam_p1_desc_2`, `s_wo_lam_f2_width`, `s_wo_lam_f2_kgs`, `s_wo_lam_f2_mtr`, `s_wo_lam_p2_desc_1`, `s_wo_lam_p2_desc_2`, `s_wo_lam_f3_width`, `s_wo_lam_f3_kgs`, `s_wo_lam_f3_mtr`, `s_wo_lam_p3_desc_1`, `s_wo_lam_p3_desc_2`, `s_wo_lam_f4_width`, `s_wo_lam_f4_kgs`, `s_wo_lam_f4_mtr`, `s_wo_lam_p4_desc_1`, `s_wo_lam_p4_desc_2`, `s_wo_lam_f5_width`, `s_wo_lam_f5_kgs`, `s_wo_lam_f5_mtr`, `s_wo_lam_options`, `s_wo_bag_qty_kg`, `s_wo_bag_nos`, `s_wo_bag_width`, `s_wo_bag_length`, `s_wo_bag_width_2`, `s_wo_bag_length_2`, `s_wo_bag_thick`, `s_wo_bag_guset_side`, `s_wo_bag_guset_bottom`, `s_wo_bag_guset_top_fold`, `s_wo_bag_guset_flap`, `s_wo_bag_guset_lip`, `s_wo_bag_handle`, `s_wo_bag_vest_handle`, `s_wo_bag_sealing`, `s_wo_bag_spl_dia`, `s_wo_bag_punch`, `s_wo_pouch_qty_kg`, `s_wo_pouch_nos`, `s_wo_pouch_width`, `s_wo_pouch_length`, `s_wo_pouch_guset_side`, `s_wo_pouch_bot`, `s_wo_pouch_sealing`, `s_wo_pouch_width_2`, `s_wo_pouch_seal_type`, `s_wo_pouch_euro_punch`, `s_wo_pouch_type`, `s_wo_pouch_pouch_open`, `s_wo_pouch_seal`, `s_wo_pouch_closure_type`, `s_wo_pouch_dist`, `s_wo_pouch_pouch_type`, `s_wo_slit_s_width`, `s_wo_slit_wind_dir`, `s_wo_slit_roll_od`, `s_wo_slit_wt`, `s_wo_slit_mtr`, `s_wo_slit_customer`, `s_wo_slit_pallet`, `s_wo_slit_packing`, `s_wo_slit_packing_5ply`, `s_wo_slit_sticker`, `s_wo_slit_sticker_type`, `s_wo_slit_core_id`, `s_wo_slit_core_type`, `s_wo_slit_qc_ins`, `s_wo_slit_qc_max_jointrolls`, `s_wo_remarks_overall`, `s_wo_remarks_ext`, `s_wo_remarks_print`, `s_wo_remarks_lam`, `s_wo_remarks_pouch`, `s_wo_remarks_bag`, `s_wo_remarks_slit`, `s_wo_gen_dnt`, `s_wo_gen_lum_id`, `s_wo_status`) VALUES
(1, 9, 'D06402', '', 1, '1607802189', '', '1', '50000', '2', '1', '2', 1, 1, '4.3', '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', '8', '7', '6', '5', '4', '3', '2', '1', '999', '888', '777', 3, 2, '4,5', '90', '2,3,5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 3, '2', '3', '4', '1,2,3', 1, '4,5', 2, 1, '1,2', 3, 1, '1,2,3,4,5', '56', 'SHORT WO', NULL, NULL, NULL, NULL, 'SHORT BAG', 'Short Piece Slit', '1599939729', 9, 3),
(2, 3, 'D06402', '1', 10, '1607802558', '12', '3', '1', '1', '1', '1', 1, 6, '1', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, '1', '1', '1', '1,3', 1, '1,2,4,5', 2, 1, '1,2', 4, 1, '1,3,4', '', 'O', NULL, NULL, NULL, NULL, NULL, 'S', '1599940084', 10, 3),
(3, 1, 'DPRINT', 'PO', 13, '1607773580', 'LWO', '3', '134', '1', '1', '4', 1, 2, '5455', '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '', '', '', 1, 1, '', '0x0', '(0x0)+0', 1, 1, '0+0', '', '0x0', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '1,9,10,11,12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234', 2, '5', '6', '7', '1', 1, '1,4', 2, 1, '1,2', 4, 1, '1,5', '13', '', NULL, '', NULL, NULL, NULL, '', '1599997580', 1, 3),
(4, 9, 'D14124234', '13r2r13r', 13, '1607792404', 'q23fr2wgfewrsgbesrgh', '3', '14124', '2', '12', '5', 2, 2, '1', '3', '1', '3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', '', '1', 1, '1', NULL, 1, '1', 1, 1, '1', '', '', NULL, NULL, '', NULL, NULL, '', '1600016391', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sales_work_order_main_identitiy`
--

CREATE TABLE `sales_work_order_main_identitiy` (
  `woi_id` int(10) NOT NULL,
  `woi_value` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_work_order_main_identitiy`
--

INSERT INTO `sales_work_order_main_identitiy` (`woi_id`, `woi_value`) VALUES
(1, 'Sales Draft'),
(2, 'Sales Discard Draft'),
(3, 'Sales Published');

-- --------------------------------------------------------

--
-- Table structure for table `session_tracker`
--

CREATE TABLE `session_tracker` (
  `sess_id` int(255) NOT NULL,
  `sess_lum_id` int(255) NOT NULL,
  `sess_hash` varchar(698) NOT NULL,
  `sess_dnt` varchar(698) NOT NULL,
  `sess_ip` varchar(698) NOT NULL,
  `sess_valid` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_tracker`
--

INSERT INTO `session_tracker` (`sess_id`, `sess_lum_id`, `sess_hash`, `sess_dnt`, `sess_ip`, `sess_valid`) VALUES
(1, 1, 'IPPSESSID5f5ccbcbc7929', '1599917003', '127.0.0.1', 0),
(2, 10, 'IPPSESSID5f5d224b7e0be', '1599939147', '127.0.0.1', 0),
(3, 1, 'IPPSESSID5f5d22d17b179', '1599939281', '::1', 0),
(4, 9, 'IPPSESSID5f5d23fb2921b', '1599939579', '127.0.0.1', 1),
(5, 3, 'IPPSESSID5f5d2595a4821', '1599939989', '127.0.0.1', 0),
(6, 10, 'IPPSESSID5f5d25ac3c365', '1599940012', '127.0.0.1', 1),
(7, 8, 'IPPSESSID5f5d27130ac0b', '1599940371', '127.0.0.1', 0),
(8, 4, 'IPPSESSID5f5d289fed06d', '1599940767', '127.0.0.1', 0),
(9, 6, 'IPPSESSID5f5d2a2dd80df', '1599941165', '127.0.0.1', 0),
(10, 2, 'IPPSESSID5f5d2ab65f792', '1599941302', '127.0.0.1', 0),
(11, 7, 'IPPSESSID5f5d2aee829a3', '1599941358', '127.0.0.1', 0),
(12, 5, 'IPPSESSID5f5d2b055e454', '1599941381', '127.0.0.1', 0),
(13, 8, 'IPPSESSID5f5d2b2585512', '1599941413', '127.0.0.1', 0),
(14, 7, 'IPPSESSID5f5d2bb698117', '1599941558', '127.0.0.1', 0),
(15, 1, 'IPPSESSID5f5e065115aba', '1599997521', '127.0.0.1', 0),
(16, 6, 'IPPSESSID5f5e06ac3609a', '1599997612', '::1', 0),
(17, 1, 'IPPSESSID5f5e06e60b505', '1599997670', '::1', 0),
(18, 7, 'IPPSESSID5f5e06fa4cecf', '1599997690', '127.0.0.1', 0),
(19, 3, 'IPPSESSID5f5e4fba576ec', '1600016314', '127.0.0.1', 1),
(20, 8, 'IPPSESSID5f5e502a88622', '1600016426', '127.0.0.1', 0),
(21, 4, 'IPPSESSID5f5e507d4777a', '1600016509', '127.0.0.1', 1),
(22, 6, 'IPPSESSID5f5e508cbde87', '1600016524', '127.0.0.1', 1),
(23, 2, 'IPPSESSID5f5e50bae979d', '1600016570', '127.0.0.1', 1),
(24, 7, 'IPPSESSID5f5e50c81050c', '1600016584', '127.0.0.1', 1),
(25, 5, 'IPPSESSID5f5e50e135b4c', '1600016609', '127.0.0.1', 1),
(26, 8, 'IPPSESSID5f5e50ef3e3a7', '1600016623', '127.0.0.1', 1),
(27, 1, 'IPPSESSID5f68b06b7245e', '1600696427', '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_pending`
--

CREATE TABLE `users_pending` (
  `pending_id` int(255) NOT NULL,
  `pending_name` varchar(698) NOT NULL,
  `pending_email` varchar(698) NOT NULL,
  `pending_hash` varchar(698) NOT NULL,
  `pending_code` varchar(50) NOT NULL,
  `pending_type` int(255) NOT NULL,
  `pending_dnt` varchar(698) NOT NULL,
  `pending_valid` int(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_pending`
--

INSERT INTO `users_pending` (`pending_id`, `pending_name`, `pending_email`, `pending_hash`, `pending_code`, `pending_type`, `pending_dnt`, `pending_valid`) VALUES
(1, 'MDUSER', 'md@gmail.com', '98a86ba82a5cdf4641a07641d2d68c4c', 'MD-1', 2, '1599916912', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_main`
--

CREATE TABLE `user_main` (
  `lum_id` int(255) NOT NULL,
  `lum_user_type` int(25) NOT NULL,
  `lum_code` varchar(698) NOT NULL,
  `lum_email` varchar(698) NOT NULL,
  `lum_hash` varchar(698) NOT NULL,
  `lum_name` varchar(698) NOT NULL,
  `lum_dnt` varchar(698) NOT NULL,
  `lum_deact` varchar(698) DEFAULT NULL,
  `lum_valid` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_main`
--

INSERT INTO `user_main` (`lum_id`, `lum_user_type`, `lum_code`, `lum_email`, `lum_hash`, `lum_name`, `lum_dnt`, `lum_deact`, `lum_valid`) VALUES
(1, 2, 'MD-1', 'md@gmail.com', '98a86ba82a5cdf4641a07641d2d68c4c', 'MDUSER', '1599916912', NULL, 1),
(2, 15, 'A01', 'accounts@gmail.com', '0040c63b091b73a2b5555e263d12fa8e', 'AccountUser', '1599931583', NULL, 1),
(3, 16, 'S-03', 'sales_a@gmail.com', 'aa5d735efa731b7a0174ae2c89660fc0', 'SalesAssistant', '1599931659', NULL, 1),
(4, 7, 'FM-01', 'factory@gmail.com', '6c53b5454c6ca36a3d6877bf903ef344', 'FactoryManager', '1599931689', NULL, 1),
(5, 17, 'PL-01', 'planning@gmail.com', 'b9fe6c7fed9d27b663cb5816454f1622', 'PlanningAgent', '1599931711', NULL, 1),
(6, 14, 'PC-01', 'precost@gmail.com', '21e672830cf52eac2afd0727b0372b0c', 'PreCostPerson', '1599931768', NULL, 1),
(7, 11, 'PP-01', 'prepress@gmail.com', 'e1209f4956fe69e9ac3d380f910527b0', 'PrePressAgent', '1599931792', NULL, 1),
(8, 12, 'Q-01', 'quality@gmail.com', '7e5fe60f758c6909c1e2d2a164db8eef', 'QualityAgent', '1599931818', NULL, 1),
(9, 4, 'S-01', 'sales_m@gmail.com', '718b6430ccb0f2cbf62ae7863615207c', 'SalesMan', '1599931868', NULL, 1),
(10, 10, 'S-10', 'sales_c@gmail.com', '2f0cf2979471a2bfc30beb951e063715', 'SalesCoordinator', '1599931890', NULL, 1),
(11, 10, 'S-111', 'failed@gmail.com', '44bd151ab5c048454e6fd505e177686d', 'Failed User', '1599939067', 'This user has left', 0),
(12, 3, 'ADMIN-1', 'admin@gmail.com', 'a0708c5a93374ec93240c1d654be78b5', 'ITADMIN', '1599939110', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_sales_attach`
--

CREATE TABLE `user_sales_attach` (
  `attach_id` int(255) NOT NULL,
  `attach_parent_lum` int(255) NOT NULL,
  `attach_child_lum` int(255) NOT NULL,
  `attach_dnt` varchar(698) NOT NULL,
  `attach_valid` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sales_attach`
--

INSERT INTO `user_sales_attach` (`attach_id`, `attach_parent_lum`, `attach_child_lum`, `attach_dnt`, `attach_valid`) VALUES
(1, 10, 9, '1599939809', 0),
(2, 3, 9, '1599939970', 1),
(3, 10, 3, '1599939995', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `user_type_id` int(255) NOT NULL,
  `user_type_name` varchar(255) NOT NULL,
  `user_type_access` varchar(698) NOT NULL,
  `user_type_landing` varchar(698) NOT NULL,
  `user_type_mod_id` varchar(698) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`user_type_id`, `user_type_name`, `user_type_access`, `user_type_landing`, `user_type_mod_id`) VALUES
(1, 'Master Admin', '-', 'home', '*'),
(2, 'Managing Director', '1', 'home', '*'),
(3, 'IT Admin', '2,1', 'home', '1,12,13,33,34,35,27,23'),
(4, 'Sales Manager', '3,2,1', 'home', '1,35,2,9,10,11,14,21,22,23,25,26,27,29,30,31,32'),
(5, 'Pre Press Manager', '3,2,1', 'home', '1,35,29,30,21,27,23,19,36'),
(6, 'Quality Manager', '3,2,1', 'home', '1,35,29,30,14,21,26,27,23,15,25'),
(7, 'Factory Manager', '3,2,1', 'home', '1,35,29,30,14,21,26,27,23,16,25'),
(8, 'Pre Costing Manager', '3,2,1', 'home', '1,35,29,30,21,27,23,17,28'),
(9, 'Accounts Manager', '3,2,1', 'home', '1,35,29,30,21,26,27,23,18'),
(10, 'Sales Coordinator', '16,4,3,2,1', 'home', '1,35,2,9,10,11,14,21,22,23,25,26,27,29,30,31,32'),
(11, 'Pre Press Agent', '5,3,2,1', 'home', '1,35,29,30,21,27,23,19,36'),
(12, 'Quality Agent', '6,3,2,1', 'home', '1,35,29,30,14,21,26,27,23,15,25'),
(13, 'Factory Agent', '7,3,2,1', 'home', '1,35,29,30,14,21,26,27,23,16,25'),
(14, 'Pre Costing Agent', '8,3,2,1', 'home', '1,35,29,30,21,27,23,17,28'),
(15, 'Accounts Agent', '9,3,2,1', 'home', '1,35,29,30,21,27,23,18'),
(16, 'Assistant Sales Manager', '4,3,2,1', 'home', '1,35,2,9,10,11,14,21,22,23,25,26,27,29,30,31,32'),
(17, 'Planning Agent', '-', 'home', '1,35,29,30,21,27,23,20');

-- --------------------------------------------------------

--
-- Table structure for table `work_order_applications`
--

CREATE TABLE `work_order_applications` (
  `application_id` int(255) NOT NULL,
  `application_value` varchar(698) NOT NULL,
  `application_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_applications`
--

INSERT INTO `work_order_applications` (`application_id`, `application_value`, `application_show`) VALUES
(1, 'Ketchup', 1),
(2, 'Canned Food', 1),
(3, 'MOBILE PHONE', 1),
(4, 'Water Bottle', 1),
(5, 'Food Bag', 1),
(6, 'Laptops', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_qty_units`
--

CREATE TABLE `work_order_qty_units` (
  `unit_id` int(50) NOT NULL,
  `unit_value` varchar(698) NOT NULL,
  `unit_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_qty_units`
--

INSERT INTO `work_order_qty_units` (`unit_id`, `unit_value`, `unit_show`) VALUES
(1, 'KGS', 1),
(2, 'KMS', 1),
(3, 'PCS', 1),
(4, 'CMS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_bag_handle`
--

CREATE TABLE `work_order_ui_bag_handle` (
  `bag_handle_id` int(5) NOT NULL,
  `bag_handle_value` varchar(100) NOT NULL,
  `bag_handle_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_bag_handle`
--

INSERT INTO `work_order_ui_bag_handle` (`bag_handle_id`, `bag_handle_value`, `bag_handle_show`) VALUES
(1, 'Patch', 1),
(2, 'Loop', 1),
(3, 'Draw String', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_bag_punch_opts`
--

CREATE TABLE `work_order_ui_bag_punch_opts` (
  `bag_punch_opts_id` int(5) NOT NULL,
  `bag_punch_opts_value` varchar(100) NOT NULL,
  `bag_punch_opts_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_bag_punch_opts`
--

INSERT INTO `work_order_ui_bag_punch_opts` (`bag_punch_opts_id`, `bag_punch_opts_value`, `bag_punch_opts_show`) VALUES
(1, 'Straight', 1),
(2, 'Banana', 1),
(3, 'Half Cut', 1),
(4, 'Perforated', 1),
(5, 'PERFPR 2', 1),
(6, 'New Value 5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_bag_sealing_opts`
--

CREATE TABLE `work_order_ui_bag_sealing_opts` (
  `bag_sealing_opts_id` int(5) NOT NULL,
  `bag_sealing_opts_value` varchar(100) NOT NULL,
  `bag_sealing_opts_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_bag_sealing_opts`
--

INSERT INTO `work_order_ui_bag_sealing_opts` (`bag_sealing_opts_id`, `bag_sealing_opts_value`, `bag_sealing_opts_show`) VALUES
(1, 'BOT.WELD', 1),
(2, 'Single Side Weld', 1),
(3, 'Double Side Weld', 1),
(4, 'SPL Hole.', 1),
(5, 'Testing 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_bag_vest_handle`
--

CREATE TABLE `work_order_ui_bag_vest_handle` (
  `bag_vest_handle_id` int(5) NOT NULL,
  `bag_vest_handle_value` varchar(100) NOT NULL,
  `bag_vest_handle_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_bag_vest_handle`
--

INSERT INTO `work_order_ui_bag_vest_handle` (`bag_vest_handle_id`, `bag_vest_handle_value`, `bag_vest_handle_show`) VALUES
(1, 'S', 1),
(2, 'M', 1),
(3, 'L', 1),
(4, 'XXS', 0),
(5, 'CCCSS', 0),
(6, 'XCSSC', 0),
(7, 'XSL', 0);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_ext_antistatic`
--

CREATE TABLE `work_order_ui_ext_antistatic` (
  `anti_id` int(5) NOT NULL,
  `anti_value` varchar(400) NOT NULL,
  `anti_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_ext_antistatic`
--

INSERT INTO `work_order_ui_ext_antistatic` (`anti_id`, `anti_value`, `anti_show`) VALUES
(1, 'Yes', 1),
(2, 'No', 1),
(3, 'Maybe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_ext_cof`
--

CREATE TABLE `work_order_ui_ext_cof` (
  `cof_id` int(5) NOT NULL,
  `cof_value` varchar(100) NOT NULL,
  `cof_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_ext_cof`
--

INSERT INTO `work_order_ui_ext_cof` (`cof_id`, `cof_value`, `cof_show`) VALUES
(1, 'Normal', 1),
(2, 'H.Slip', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_ext_extrude_in`
--

CREATE TABLE `work_order_ui_ext_extrude_in` (
  `extrude_in_id` int(5) NOT NULL,
  `extrude_in_value` varchar(100) NOT NULL,
  `extrude_in_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_ext_extrude_in`
--

INSERT INTO `work_order_ui_ext_extrude_in` (`extrude_in_id`, `extrude_in_value`, `extrude_in_show`) VALUES
(1, 'Tube', 1),
(2, 'Sheet', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_ext_layer_type`
--

CREATE TABLE `work_order_ui_ext_layer_type` (
  `layer_type_id` int(5) NOT NULL,
  `layer_type_value` varchar(100) NOT NULL,
  `layer_type_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_ext_layer_type`
--

INSERT INTO `work_order_ui_ext_layer_type` (`layer_type_id`, `layer_type_value`, `layer_type_show`) VALUES
(1, 'MultiLayer', 1),
(2, 'MonoLayer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_ext_options`
--

CREATE TABLE `work_order_ui_ext_options` (
  `ext_options_id` int(5) NOT NULL,
  `ext_options_value` varchar(100) NOT NULL,
  `ext_options_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_ext_options`
--

INSERT INTO `work_order_ui_ext_options` (`ext_options_id`, `ext_options_value`, `ext_options_show`) VALUES
(1, 'Lap Seal (In/Out)', 1),
(2, 'Fin Seal (In/Out)', 1),
(3, 'High Clarity', 1),
(4, 'Natural', 1),
(5, 'Black', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_ext_treatment`
--

CREATE TABLE `work_order_ui_ext_treatment` (
  `treat_id` int(5) NOT NULL,
  `treat_value` varchar(100) NOT NULL,
  `treat_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_ext_treatment`
--

INSERT INTO `work_order_ui_ext_treatment` (`treat_id`, `treat_value`, `treat_show`) VALUES
(1, 'Yes', 1),
(2, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_lam_end_options`
--

CREATE TABLE `work_order_ui_lam_end_options` (
  `lam_end_options_id` int(5) NOT NULL,
  `lam_end_options_value` varchar(100) NOT NULL,
  `lam_end_options_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_lam_end_options`
--

INSERT INTO `work_order_ui_lam_end_options` (`lam_end_options_id`, `lam_end_options_value`, `lam_end_options_show`) VALUES
(1, 'S.Less', 1),
(2, 'S.Base', 1),
(3, 'Combi', 1),
(4, 'High Perf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_closure_type`
--

CREATE TABLE `work_order_ui_pouch_closure_type` (
  `pouch_closure_type_id` int(5) NOT NULL,
  `pouch_closure_type_value` varchar(100) NOT NULL,
  `pouch_closure_type_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_closure_type`
--

INSERT INTO `work_order_ui_pouch_closure_type` (`pouch_closure_type_id`, `pouch_closure_type_value`, `pouch_closure_type_show`) VALUES
(1, 'Ziplock Open', 1),
(2, 'Ziplock Close', 1),
(3, 'Notch 1 Side', 1),
(4, 'Notch 2 Side', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_euro_punch`
--

CREATE TABLE `work_order_ui_pouch_euro_punch` (
  `pouch_euro_punch_id` int(5) NOT NULL,
  `pouch_euro_punch_value` varchar(100) NOT NULL,
  `pouch_euro_punch_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_euro_punch`
--

INSERT INTO `work_order_ui_pouch_euro_punch` (`pouch_euro_punch_id`, `pouch_euro_punch_value`, `pouch_euro_punch_show`) VALUES
(1, 'S', 1),
(2, 'M', 1),
(3, 'L', 1),
(4, 'XL TEST', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_pouch_open`
--

CREATE TABLE `work_order_ui_pouch_pouch_open` (
  `pouch_open_id` int(5) NOT NULL,
  `pouch_open_value` varchar(100) NOT NULL,
  `pouch_open_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_pouch_open`
--

INSERT INTO `work_order_ui_pouch_pouch_open` (`pouch_open_id`, `pouch_open_value`, `pouch_open_show`) VALUES
(1, 'TOP', 1),
(2, 'Bottom', 1),
(3, 'Round Corner', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_pouch_type`
--

CREATE TABLE `work_order_ui_pouch_pouch_type` (
  `pouch_pouch_type_id` int(5) NOT NULL,
  `pouch_pouch_type_value` varchar(100) NOT NULL,
  `pouch_pouch_type_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_pouch_type`
--

INSERT INTO `work_order_ui_pouch_pouch_type` (`pouch_pouch_type_id`, `pouch_pouch_type_value`, `pouch_pouch_type_show`) VALUES
(1, 'Stand-Up', 1),
(2, 'Pillow', 1),
(3, 'Needle Punch', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_seal`
--

CREATE TABLE `work_order_ui_pouch_seal` (
  `pouch_seal_id` int(5) NOT NULL,
  `pouch_seal_value` varchar(100) NOT NULL,
  `pouch_seal_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_seal`
--

INSERT INTO `work_order_ui_pouch_seal` (`pouch_seal_id`, `pouch_seal_value`, `pouch_seal_show`) VALUES
(1, 'K Seal', 1),
(2, 'Arc Seal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_sealing`
--

CREATE TABLE `work_order_ui_pouch_sealing` (
  `pouch_sealing_id` int(5) NOT NULL,
  `pouch_sealing_value` varchar(100) NOT NULL,
  `pouch_sealing_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_sealing`
--

INSERT INTO `work_order_ui_pouch_sealing` (`pouch_sealing_id`, `pouch_sealing_value`, `pouch_sealing_show`) VALUES
(1, 'INCL', 1),
(2, 'EXCL.s', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_seal_type`
--

CREATE TABLE `work_order_ui_pouch_seal_type` (
  `pouch_seal_type_id` int(5) NOT NULL,
  `pouch_seal_type_value` varchar(100) NOT NULL,
  `pouch_seal_type_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_seal_type`
--

INSERT INTO `work_order_ui_pouch_seal_type` (`pouch_seal_type_id`, `pouch_seal_type_value`, `pouch_seal_type_show`) VALUES
(1, '2 SIDE', 1),
(2, '3 SIDE', 1),
(3, 'OFF Center', 1),
(4, 'Center', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_type`
--

CREATE TABLE `work_order_ui_pouch_type` (
  `pouch_type_id` int(5) NOT NULL,
  `pouch_type_value` varchar(100) NOT NULL,
  `pouch_type_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_type`
--

INSERT INTO `work_order_ui_pouch_type` (`pouch_type_id`, `pouch_type_value`, `pouch_type_show`) VALUES
(1, 'Groove', 1),
(2, 'Plain Seat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_end_options`
--

CREATE TABLE `work_order_ui_print_end_options` (
  `print_end_options_id` int(5) NOT NULL,
  `print_end_options_value` varchar(100) NOT NULL,
  `print_end_options_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_end_options`
--

INSERT INTO `work_order_ui_print_end_options` (`print_end_options_id`, `print_end_options_value`, `print_end_options_show`) VALUES
(1, 'Light Fast', 1),
(2, 'Scratch Resistant', 1),
(3, 'Heat Resist', 1),
(4, 'Varnish', 1),
(5, 'AR/SR ink', 1),
(6, 'Cold Seal', 1),
(7, 'High Gloss', 1),
(8, 'Scuff Resist', 1),
(9, 'Primer', 1),
(10, 'Top Laqor', 1),
(11, 'Matt Lacquer Single Component ', 1),
(12, 'Matt Lacquer Double Component ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_eyemark_da`
--

CREATE TABLE `work_order_ui_print_eyemark_da` (
  `eyemark_da_id` int(5) NOT NULL,
  `eyemark_da_value` varchar(100) NOT NULL,
  `eyemark_da_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_eyemark_da`
--

INSERT INTO `work_order_ui_print_eyemark_da` (`eyemark_da_id`, `eyemark_da_value`, `eyemark_da_show`) VALUES
(1, 'Left', 1),
(2, 'Right', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_options`
--

CREATE TABLE `work_order_ui_print_options` (
  `print_options_id` int(5) NOT NULL,
  `print_options_value` varchar(100) NOT NULL,
  `print_options_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_options`
--

INSERT INTO `work_order_ui_print_options` (`print_options_id`, `print_options_value`, `print_options_show`) VALUES
(1, 'Customer', 1),
(2, 'QC', 1),
(3, 'Sales', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_shadecardreq`
--

CREATE TABLE `work_order_ui_print_shadecardreq` (
  `shadecardreq_id` int(5) NOT NULL,
  `shadecardreq_value` varchar(100) NOT NULL,
  `shadecardreq_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_shadecardreq`
--

INSERT INTO `work_order_ui_print_shadecardreq` (`shadecardreq_id`, `shadecardreq_value`, `shadecardreq_show`) VALUES
(1, 'Yes', 1),
(2, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_shadecard_ref_type`
--

CREATE TABLE `work_order_ui_print_shadecard_ref_type` (
  `shadecard_ref_type_id` int(5) NOT NULL,
  `shadecard_ref_type_value` varchar(100) NOT NULL,
  `shadecard_ref_type_show` int(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_shadecard_ref_type`
--

INSERT INTO `work_order_ui_print_shadecard_ref_type` (`shadecard_ref_type_id`, `shadecard_ref_type_value`, `shadecard_ref_type_show`) VALUES
(1, 'D.A or Chromolin', 1),
(2, 'Cust.Sample', 1),
(3, 'Shade Card (Customer Approval)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_surfrev`
--

CREATE TABLE `work_order_ui_print_surfrev` (
  `surfrev_id` int(6) NOT NULL,
  `surfrev_value` varchar(100) NOT NULL,
  `surfrev_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_surfrev`
--

INSERT INTO `work_order_ui_print_surfrev` (`surfrev_id`, `surfrev_value`, `surfrev_show`) VALUES
(1, 'Surface', 1),
(2, 'Reverse', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_tubesheet`
--

CREATE TABLE `work_order_ui_print_tubesheet` (
  `tubesheet_id` int(5) NOT NULL,
  `tubesheet_value` varchar(100) NOT NULL,
  `tubesheet_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_tubesheet`
--

INSERT INTO `work_order_ui_print_tubesheet` (`tubesheet_id`, `tubesheet_value`, `tubesheet_show`) VALUES
(1, 'Tube', 1),
(2, 'Sheet', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_type`
--

CREATE TABLE `work_order_ui_print_type` (
  `print_type_id` int(5) NOT NULL,
  `print_type_value` varchar(100) NOT NULL,
  `print_type_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_type`
--

INSERT INTO `work_order_ui_print_type` (`print_type_id`, `print_type_value`, `print_type_show`) VALUES
(1, 'Stack', 1),
(2, 'CI', 1),
(3, 'Roto', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_5ply_packing_options`
--

CREATE TABLE `work_order_ui_slitting_5ply_packing_options` (
  `slitting_5ply_packing_options_id` int(5) NOT NULL,
  `slitting_5ply_packing_options_value` varchar(100) NOT NULL,
  `slitting_5ply_packing_options_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_5ply_packing_options`
--

INSERT INTO `work_order_ui_slitting_5ply_packing_options` (`slitting_5ply_packing_options_id`, `slitting_5ply_packing_options_value`, `slitting_5ply_packing_options_show`) VALUES
(1, 'PTD', 1),
(2, 'UNPTD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_core_id_length`
--

CREATE TABLE `work_order_ui_slitting_core_id_length` (
  `slitting_core_id_length_id` int(5) NOT NULL,
  `slitting_core_id_length_value` varchar(100) NOT NULL,
  `slitting_core_id_length_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_core_id_length`
--

INSERT INTO `work_order_ui_slitting_core_id_length` (`slitting_core_id_length_id`, `slitting_core_id_length_value`, `slitting_core_id_length_show`) VALUES
(1, '70mm', 1),
(2, '76mm', 1),
(3, '152mm', 1),
(4, '190mm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_core_id_type`
--

CREATE TABLE `work_order_ui_slitting_core_id_type` (
  `slitting_core_id_type_id` int(5) NOT NULL,
  `slitting_core_id_type_value` varchar(100) NOT NULL,
  `slitting_core_id_type_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_core_id_type`
--

INSERT INTO `work_order_ui_slitting_core_id_type` (`slitting_core_id_type_id`, `slitting_core_id_type_value`, `slitting_core_id_type_show`) VALUES
(1, 'Paper', 1),
(2, 'PVC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_customer`
--

CREATE TABLE `work_order_ui_slitting_customer` (
  `slitting_customer_id` int(5) NOT NULL,
  `slitting_customer_value` varchar(100) NOT NULL,
  `slitting_customer_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_customer`
--

INSERT INTO `work_order_ui_slitting_customer` (`slitting_customer_id`, `slitting_customer_value`, `slitting_customer_show`) VALUES
(1, 'Local', 1),
(2, 'GCC', 1),
(3, 'Export', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_packing_opts`
--

CREATE TABLE `work_order_ui_slitting_packing_opts` (
  `slitting_packing_opts_id` int(5) NOT NULL,
  `slitting_packing_opts_value` varchar(100) NOT NULL,
  `slitting_packing_opts_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_packing_opts`
--

INSERT INTO `work_order_ui_slitting_packing_opts` (`slitting_packing_opts_id`, `slitting_packing_opts_value`, `slitting_packing_opts_show`) VALUES
(1, 'KGS', 1),
(2, 'NOS', 1),
(3, 'Polybag', 1),
(4, '5PLY', 1),
(5, 'TESTING 89', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_pallet`
--

CREATE TABLE `work_order_ui_slitting_pallet` (
  `slitting_pallet_id` int(5) NOT NULL,
  `slitting_pallet_value` varchar(100) NOT NULL,
  `slitting_pallet_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_pallet`
--

INSERT INTO `work_order_ui_slitting_pallet` (`slitting_pallet_id`, `slitting_pallet_value`, `slitting_pallet_show`) VALUES
(1, 'Wooden', 1),
(2, 'Plastic', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_qc_ins`
--

CREATE TABLE `work_order_ui_slitting_qc_ins` (
  `slitting_qc_ins_id` int(5) NOT NULL,
  `slitting_qc_ins_value` varchar(100) NOT NULL,
  `slitting_qc_ins_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_qc_ins`
--

INSERT INTO `work_order_ui_slitting_qc_ins` (`slitting_qc_ins_id`, `slitting_qc_ins_value`, `slitting_qc_ins_show`) VALUES
(1, 'Red Tag on Join', 1),
(2, 'Flush/Smooth Winding', 1),
(3, 'Registered Joint', 1),
(4, 'Smooth Edges/ No Micro Cuts', 1),
(5, 'QA Certificate of Analysis', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_sticker`
--

CREATE TABLE `work_order_ui_slitting_sticker` (
  `slitting_sticker_id` int(5) NOT NULL,
  `slitting_sticker_value` varchar(100) NOT NULL,
  `slitting_sticker_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_sticker`
--

INSERT INTO `work_order_ui_slitting_sticker` (`slitting_sticker_id`, `slitting_sticker_value`, `slitting_sticker_show`) VALUES
(1, 'Printed', 1),
(2, 'Unprinted', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_sticker_opts`
--

CREATE TABLE `work_order_ui_slitting_sticker_opts` (
  `slitting_sticker_opts_id` int(5) NOT NULL,
  `slitting_sticker_opts_value` varchar(100) NOT NULL,
  `slitting_sticker_opts_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_sticker_opts`
--

INSERT INTO `work_order_ui_slitting_sticker_opts` (`slitting_sticker_opts_id`, `slitting_sticker_opts_value`, `slitting_sticker_opts_show`) VALUES
(1, 'Collective', 1),
(2, 'Individual', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_structure`
--

CREATE TABLE `work_order_ui_structure` (
  `structure_id` int(50) NOT NULL,
  `structure_value` varchar(698) NOT NULL,
  `structure_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_structure`
--

INSERT INTO `work_order_ui_structure` (`structure_id`, `structure_value`, `structure_show`) VALUES
(1, 'Bag', 1),
(2, 'Pouch', 1),
(3, 'Roll', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_wind_dir`
--

CREATE TABLE `work_order_wind_dir` (
  `wind_id` int(50) NOT NULL,
  `wind_value` varchar(255) NOT NULL,
  `wind_show` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_wind_dir`
--

INSERT INTO `work_order_wind_dir` (`wind_id`, `wind_value`, `wind_show`) VALUES
(1, '1A', 1),
(2, '1B', 1),
(3, '2A', 1),
(4, '2B', 1),
(5, '3A', 1),
(6, '3B', 1),
(7, '4A', 1),
(8, '4B', 1),
(9, '5A', 1),
(10, '5B', 1),
(11, '6A', 1),
(12, '6B', 1),
(13, '7A', 1),
(14, '7B', 1),
(15, '8A', 1),
(16, '8B', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients_main`
--
ALTER TABLE `clients_main`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `complaints_main`
--
ALTER TABLE `complaints_main`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `logcat_main`
--
ALTER TABLE `logcat_main`
  ADD PRIMARY KEY (`logcat_id`);

--
-- Indexes for table `master_work_order_main`
--
ALTER TABLE `master_work_order_main`
  ADD PRIMARY KEY (`master_wo_id`);

--
-- Indexes for table `master_work_order_main_identitiy`
--
ALTER TABLE `master_work_order_main_identitiy`
  ADD PRIMARY KEY (`mwoid_id`);

--
-- Indexes for table `master_work_order_reference_number`
--
ALTER TABLE `master_work_order_reference_number`
  ADD PRIMARY KEY (`mwo_ref_id`);

--
-- Indexes for table `materials_main`
--
ALTER TABLE `materials_main`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `modules_groups`
--
ALTER TABLE `modules_groups`
  ADD PRIMARY KEY (`mg_id`);

--
-- Indexes for table `modules_main`
--
ALTER TABLE `modules_main`
  ADD PRIMARY KEY (`mod_id`);

--
-- Indexes for table `remarks_identity`
--
ALTER TABLE `remarks_identity`
  ADD PRIMARY KEY (`remarkiden_id`);

--
-- Indexes for table `remarks_wo`
--
ALTER TABLE `remarks_wo`
  ADD PRIMARY KEY (`remark_id`);

--
-- Indexes for table `sales_work_order_main`
--
ALTER TABLE `sales_work_order_main`
  ADD PRIMARY KEY (`s_wo_id`);

--
-- Indexes for table `sales_work_order_main_identitiy`
--
ALTER TABLE `sales_work_order_main_identitiy`
  ADD PRIMARY KEY (`woi_id`);

--
-- Indexes for table `session_tracker`
--
ALTER TABLE `session_tracker`
  ADD PRIMARY KEY (`sess_id`);

--
-- Indexes for table `users_pending`
--
ALTER TABLE `users_pending`
  ADD PRIMARY KEY (`pending_id`);

--
-- Indexes for table `user_main`
--
ALTER TABLE `user_main`
  ADD PRIMARY KEY (`lum_id`);

--
-- Indexes for table `user_sales_attach`
--
ALTER TABLE `user_sales_attach`
  ADD PRIMARY KEY (`attach_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Indexes for table `work_order_applications`
--
ALTER TABLE `work_order_applications`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `work_order_qty_units`
--
ALTER TABLE `work_order_qty_units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `work_order_ui_bag_handle`
--
ALTER TABLE `work_order_ui_bag_handle`
  ADD PRIMARY KEY (`bag_handle_id`);

--
-- Indexes for table `work_order_ui_bag_punch_opts`
--
ALTER TABLE `work_order_ui_bag_punch_opts`
  ADD PRIMARY KEY (`bag_punch_opts_id`);

--
-- Indexes for table `work_order_ui_bag_sealing_opts`
--
ALTER TABLE `work_order_ui_bag_sealing_opts`
  ADD PRIMARY KEY (`bag_sealing_opts_id`);

--
-- Indexes for table `work_order_ui_bag_vest_handle`
--
ALTER TABLE `work_order_ui_bag_vest_handle`
  ADD PRIMARY KEY (`bag_vest_handle_id`);

--
-- Indexes for table `work_order_ui_ext_antistatic`
--
ALTER TABLE `work_order_ui_ext_antistatic`
  ADD PRIMARY KEY (`anti_id`);

--
-- Indexes for table `work_order_ui_ext_cof`
--
ALTER TABLE `work_order_ui_ext_cof`
  ADD PRIMARY KEY (`cof_id`);

--
-- Indexes for table `work_order_ui_ext_extrude_in`
--
ALTER TABLE `work_order_ui_ext_extrude_in`
  ADD PRIMARY KEY (`extrude_in_id`);

--
-- Indexes for table `work_order_ui_ext_layer_type`
--
ALTER TABLE `work_order_ui_ext_layer_type`
  ADD PRIMARY KEY (`layer_type_id`);

--
-- Indexes for table `work_order_ui_ext_options`
--
ALTER TABLE `work_order_ui_ext_options`
  ADD PRIMARY KEY (`ext_options_id`);

--
-- Indexes for table `work_order_ui_ext_treatment`
--
ALTER TABLE `work_order_ui_ext_treatment`
  ADD PRIMARY KEY (`treat_id`);

--
-- Indexes for table `work_order_ui_lam_end_options`
--
ALTER TABLE `work_order_ui_lam_end_options`
  ADD PRIMARY KEY (`lam_end_options_id`);

--
-- Indexes for table `work_order_ui_pouch_closure_type`
--
ALTER TABLE `work_order_ui_pouch_closure_type`
  ADD PRIMARY KEY (`pouch_closure_type_id`);

--
-- Indexes for table `work_order_ui_pouch_euro_punch`
--
ALTER TABLE `work_order_ui_pouch_euro_punch`
  ADD PRIMARY KEY (`pouch_euro_punch_id`);

--
-- Indexes for table `work_order_ui_pouch_pouch_open`
--
ALTER TABLE `work_order_ui_pouch_pouch_open`
  ADD PRIMARY KEY (`pouch_open_id`);

--
-- Indexes for table `work_order_ui_pouch_pouch_type`
--
ALTER TABLE `work_order_ui_pouch_pouch_type`
  ADD PRIMARY KEY (`pouch_pouch_type_id`);

--
-- Indexes for table `work_order_ui_pouch_seal`
--
ALTER TABLE `work_order_ui_pouch_seal`
  ADD PRIMARY KEY (`pouch_seal_id`);

--
-- Indexes for table `work_order_ui_pouch_sealing`
--
ALTER TABLE `work_order_ui_pouch_sealing`
  ADD PRIMARY KEY (`pouch_sealing_id`);

--
-- Indexes for table `work_order_ui_pouch_seal_type`
--
ALTER TABLE `work_order_ui_pouch_seal_type`
  ADD PRIMARY KEY (`pouch_seal_type_id`);

--
-- Indexes for table `work_order_ui_pouch_type`
--
ALTER TABLE `work_order_ui_pouch_type`
  ADD PRIMARY KEY (`pouch_type_id`);

--
-- Indexes for table `work_order_ui_print_end_options`
--
ALTER TABLE `work_order_ui_print_end_options`
  ADD PRIMARY KEY (`print_end_options_id`);

--
-- Indexes for table `work_order_ui_print_eyemark_da`
--
ALTER TABLE `work_order_ui_print_eyemark_da`
  ADD PRIMARY KEY (`eyemark_da_id`);

--
-- Indexes for table `work_order_ui_print_options`
--
ALTER TABLE `work_order_ui_print_options`
  ADD PRIMARY KEY (`print_options_id`);

--
-- Indexes for table `work_order_ui_print_shadecardreq`
--
ALTER TABLE `work_order_ui_print_shadecardreq`
  ADD PRIMARY KEY (`shadecardreq_id`);

--
-- Indexes for table `work_order_ui_print_shadecard_ref_type`
--
ALTER TABLE `work_order_ui_print_shadecard_ref_type`
  ADD PRIMARY KEY (`shadecard_ref_type_id`);

--
-- Indexes for table `work_order_ui_print_surfrev`
--
ALTER TABLE `work_order_ui_print_surfrev`
  ADD PRIMARY KEY (`surfrev_id`);

--
-- Indexes for table `work_order_ui_print_tubesheet`
--
ALTER TABLE `work_order_ui_print_tubesheet`
  ADD PRIMARY KEY (`tubesheet_id`);

--
-- Indexes for table `work_order_ui_print_type`
--
ALTER TABLE `work_order_ui_print_type`
  ADD PRIMARY KEY (`print_type_id`);

--
-- Indexes for table `work_order_ui_slitting_5ply_packing_options`
--
ALTER TABLE `work_order_ui_slitting_5ply_packing_options`
  ADD PRIMARY KEY (`slitting_5ply_packing_options_id`);

--
-- Indexes for table `work_order_ui_slitting_core_id_length`
--
ALTER TABLE `work_order_ui_slitting_core_id_length`
  ADD PRIMARY KEY (`slitting_core_id_length_id`);

--
-- Indexes for table `work_order_ui_slitting_core_id_type`
--
ALTER TABLE `work_order_ui_slitting_core_id_type`
  ADD PRIMARY KEY (`slitting_core_id_type_id`);

--
-- Indexes for table `work_order_ui_slitting_customer`
--
ALTER TABLE `work_order_ui_slitting_customer`
  ADD PRIMARY KEY (`slitting_customer_id`);

--
-- Indexes for table `work_order_ui_slitting_packing_opts`
--
ALTER TABLE `work_order_ui_slitting_packing_opts`
  ADD PRIMARY KEY (`slitting_packing_opts_id`);

--
-- Indexes for table `work_order_ui_slitting_pallet`
--
ALTER TABLE `work_order_ui_slitting_pallet`
  ADD PRIMARY KEY (`slitting_pallet_id`);

--
-- Indexes for table `work_order_ui_slitting_qc_ins`
--
ALTER TABLE `work_order_ui_slitting_qc_ins`
  ADD PRIMARY KEY (`slitting_qc_ins_id`);

--
-- Indexes for table `work_order_ui_slitting_sticker`
--
ALTER TABLE `work_order_ui_slitting_sticker`
  ADD PRIMARY KEY (`slitting_sticker_id`);

--
-- Indexes for table `work_order_ui_slitting_sticker_opts`
--
ALTER TABLE `work_order_ui_slitting_sticker_opts`
  ADD PRIMARY KEY (`slitting_sticker_opts_id`);

--
-- Indexes for table `work_order_ui_structure`
--
ALTER TABLE `work_order_ui_structure`
  ADD PRIMARY KEY (`structure_id`);

--
-- Indexes for table `work_order_wind_dir`
--
ALTER TABLE `work_order_wind_dir`
  ADD PRIMARY KEY (`wind_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients_main`
--
ALTER TABLE `clients_main`
  MODIFY `client_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `complaints_main`
--
ALTER TABLE `complaints_main`
  MODIFY `complaint_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `logcat_main`
--
ALTER TABLE `logcat_main`
  MODIFY `logcat_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=382;
--
-- AUTO_INCREMENT for table `master_work_order_main`
--
ALTER TABLE `master_work_order_main`
  MODIFY `master_wo_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `master_work_order_main_identitiy`
--
ALTER TABLE `master_work_order_main_identitiy`
  MODIFY `mwoid_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `master_work_order_reference_number`
--
ALTER TABLE `master_work_order_reference_number`
  MODIFY `mwo_ref_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `materials_main`
--
ALTER TABLE `materials_main`
  MODIFY `material_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `modules_groups`
--
ALTER TABLE `modules_groups`
  MODIFY `mg_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `modules_main`
--
ALTER TABLE `modules_main`
  MODIFY `mod_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `remarks_identity`
--
ALTER TABLE `remarks_identity`
  MODIFY `remarkiden_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `remarks_wo`
--
ALTER TABLE `remarks_wo`
  MODIFY `remark_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sales_work_order_main`
--
ALTER TABLE `sales_work_order_main`
  MODIFY `s_wo_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sales_work_order_main_identitiy`
--
ALTER TABLE `sales_work_order_main_identitiy`
  MODIFY `woi_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `session_tracker`
--
ALTER TABLE `session_tracker`
  MODIFY `sess_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `users_pending`
--
ALTER TABLE `users_pending`
  MODIFY `pending_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_main`
--
ALTER TABLE `user_main`
  MODIFY `lum_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user_sales_attach`
--
ALTER TABLE `user_sales_attach`
  MODIFY `attach_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `user_type_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `work_order_applications`
--
ALTER TABLE `work_order_applications`
  MODIFY `application_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `work_order_qty_units`
--
ALTER TABLE `work_order_qty_units`
  MODIFY `unit_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `work_order_ui_bag_handle`
--
ALTER TABLE `work_order_ui_bag_handle`
  MODIFY `bag_handle_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `work_order_ui_bag_punch_opts`
--
ALTER TABLE `work_order_ui_bag_punch_opts`
  MODIFY `bag_punch_opts_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `work_order_ui_bag_sealing_opts`
--
ALTER TABLE `work_order_ui_bag_sealing_opts`
  MODIFY `bag_sealing_opts_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `work_order_ui_bag_vest_handle`
--
ALTER TABLE `work_order_ui_bag_vest_handle`
  MODIFY `bag_vest_handle_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `work_order_ui_ext_antistatic`
--
ALTER TABLE `work_order_ui_ext_antistatic`
  MODIFY `anti_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `work_order_ui_ext_cof`
--
ALTER TABLE `work_order_ui_ext_cof`
  MODIFY `cof_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_ext_extrude_in`
--
ALTER TABLE `work_order_ui_ext_extrude_in`
  MODIFY `extrude_in_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_ext_layer_type`
--
ALTER TABLE `work_order_ui_ext_layer_type`
  MODIFY `layer_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_ext_options`
--
ALTER TABLE `work_order_ui_ext_options`
  MODIFY `ext_options_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `work_order_ui_ext_treatment`
--
ALTER TABLE `work_order_ui_ext_treatment`
  MODIFY `treat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_lam_end_options`
--
ALTER TABLE `work_order_ui_lam_end_options`
  MODIFY `lam_end_options_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `work_order_ui_pouch_closure_type`
--
ALTER TABLE `work_order_ui_pouch_closure_type`
  MODIFY `pouch_closure_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `work_order_ui_pouch_euro_punch`
--
ALTER TABLE `work_order_ui_pouch_euro_punch`
  MODIFY `pouch_euro_punch_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `work_order_ui_pouch_pouch_open`
--
ALTER TABLE `work_order_ui_pouch_pouch_open`
  MODIFY `pouch_open_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `work_order_ui_pouch_pouch_type`
--
ALTER TABLE `work_order_ui_pouch_pouch_type`
  MODIFY `pouch_pouch_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `work_order_ui_pouch_seal`
--
ALTER TABLE `work_order_ui_pouch_seal`
  MODIFY `pouch_seal_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_pouch_sealing`
--
ALTER TABLE `work_order_ui_pouch_sealing`
  MODIFY `pouch_sealing_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_pouch_seal_type`
--
ALTER TABLE `work_order_ui_pouch_seal_type`
  MODIFY `pouch_seal_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `work_order_ui_pouch_type`
--
ALTER TABLE `work_order_ui_pouch_type`
  MODIFY `pouch_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_print_end_options`
--
ALTER TABLE `work_order_ui_print_end_options`
  MODIFY `print_end_options_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `work_order_ui_print_eyemark_da`
--
ALTER TABLE `work_order_ui_print_eyemark_da`
  MODIFY `eyemark_da_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_print_options`
--
ALTER TABLE `work_order_ui_print_options`
  MODIFY `print_options_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `work_order_ui_print_shadecardreq`
--
ALTER TABLE `work_order_ui_print_shadecardreq`
  MODIFY `shadecardreq_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_print_shadecard_ref_type`
--
ALTER TABLE `work_order_ui_print_shadecard_ref_type`
  MODIFY `shadecard_ref_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `work_order_ui_print_surfrev`
--
ALTER TABLE `work_order_ui_print_surfrev`
  MODIFY `surfrev_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_print_tubesheet`
--
ALTER TABLE `work_order_ui_print_tubesheet`
  MODIFY `tubesheet_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_print_type`
--
ALTER TABLE `work_order_ui_print_type`
  MODIFY `print_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `work_order_ui_slitting_5ply_packing_options`
--
ALTER TABLE `work_order_ui_slitting_5ply_packing_options`
  MODIFY `slitting_5ply_packing_options_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_slitting_core_id_length`
--
ALTER TABLE `work_order_ui_slitting_core_id_length`
  MODIFY `slitting_core_id_length_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `work_order_ui_slitting_core_id_type`
--
ALTER TABLE `work_order_ui_slitting_core_id_type`
  MODIFY `slitting_core_id_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_slitting_customer`
--
ALTER TABLE `work_order_ui_slitting_customer`
  MODIFY `slitting_customer_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `work_order_ui_slitting_packing_opts`
--
ALTER TABLE `work_order_ui_slitting_packing_opts`
  MODIFY `slitting_packing_opts_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `work_order_ui_slitting_pallet`
--
ALTER TABLE `work_order_ui_slitting_pallet`
  MODIFY `slitting_pallet_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_slitting_qc_ins`
--
ALTER TABLE `work_order_ui_slitting_qc_ins`
  MODIFY `slitting_qc_ins_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `work_order_ui_slitting_sticker`
--
ALTER TABLE `work_order_ui_slitting_sticker`
  MODIFY `slitting_sticker_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_slitting_sticker_opts`
--
ALTER TABLE `work_order_ui_slitting_sticker_opts`
  MODIFY `slitting_sticker_opts_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_order_ui_structure`
--
ALTER TABLE `work_order_ui_structure`
  MODIFY `structure_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `work_order_wind_dir`
--
ALTER TABLE `work_order_wind_dir`
  MODIFY `wind_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
