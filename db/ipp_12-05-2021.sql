-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2021 at 09:25 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipp`
--

-- --------------------------------------------------------

--
-- Table structure for table `amendment_form_identity`
--

DROP TABLE IF EXISTS `amendment_form_identity`;
CREATE TABLE IF NOT EXISTS `amendment_form_identity` (
  `afi_id` int(10) NOT NULL AUTO_INCREMENT,
  `afi_text` varchar(50) NOT NULL,
  PRIMARY KEY (`afi_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amendment_form_identity`
--

INSERT INTO `amendment_form_identity` (`afi_id`, `afi_text`) VALUES
(1, 'Generated Amendment Form'),
(2, 'Requesting Sale Verification'),
(3, 'Sales Verifier Rejected Amendment'),
(4, 'Requesting Accounts Approval'),
(5, 'Accounts Rejected Amendment'),
(6, 'Requesting Technical Verification'),
(7, 'Technical Rejected Verification'),
(8, 'Requesting Planning Verification'),
(9, 'Planning Rejected Verification'),
(10, 'Amendment Accepted'),
(99, 'Discarded');

-- --------------------------------------------------------

--
-- Table structure for table `amendment_form_main`
--

DROP TABLE IF EXISTS `amendment_form_main`;
CREATE TABLE IF NOT EXISTS `amendment_form_main` (
  `afm_id` int(10) NOT NULL AUTO_INCREMENT,
  `afm_rel_wo_ref` int(10) NOT NULL,
  `afm_reason` text,
  `afm_mod_1` text,
  `afm_mod_2` text,
  `afm_mod_3` text,
  `afm_notes` text,
  `afm_reject_text` text,
  `afm_reject_lum_id` int(25) DEFAULT NULL,
  `afm_gen_lum_id` int(10) NOT NULL,
  `afm_gen_dnt` varchar(25) NOT NULL,
  `afm_status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`afm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amendment_form_main`
--

INSERT INTO `amendment_form_main` (`afm_id`, `afm_rel_wo_ref`, `afm_reason`, `afm_mod_1`, `afm_mod_2`, `afm_mod_3`, `afm_notes`, `afm_reject_text`, `afm_reject_lum_id`, `afm_gen_lum_id`, `afm_gen_dnt`, `afm_status`) VALUES
(1, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', 'Please see above<br>', NULL, NULL, 1, '1620767676', 1),
(2, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', 'Please see above<br>', NULL, NULL, 1, '1620767712', 2),
(3, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', '<b>Please see above</b><br>', 'Please make notes bold', 1, 1, '1620767739', 3),
(4, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', '<b>Please see above</b><br>', NULL, NULL, 1, '1620767767', 2),
(5, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', '<b>Please see above</b><br>', NULL, NULL, 1, '1620767776', 4),
(6, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', '<b>Please see above</b><br>', 'CLIENT Material also changed, please reference here', 1, 1, '1620767798', 5),
(7, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', '<b>Please see above</b><br>', NULL, NULL, 1, '1620767806', 2),
(8, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', '<b>Please see above</b><br>', NULL, NULL, 1, '1620767811', 4),
(9, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', '<b>Please see above</b><br>', NULL, NULL, 1, '1620767816', 6),
(10, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', '<b>Please see above</b><br>', 'Paint only 10mm', 1, 1, '1620767826', 7),
(11, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', '<b>Please see above</b><br>', NULL, NULL, 1, '1620767830', 2),
(12, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', '<b>Please see above</b><br>', NULL, NULL, 1, '1620767832', 4),
(13, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', '<b>Please see above</b><br>', NULL, NULL, 1, '1620767835', 6),
(14, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', '<b>Please see above</b><br>', NULL, NULL, 1, '1620767838', 8),
(15, 8015, 'New Paint job to be done', 'Change paint from 6mm to 8mm', '', '', '<b>Please see above</b><br>', NULL, NULL, 1, '1620767847', 10),
(16, 8010, 'This is not very important', 'Remove all color', '', '', '', NULL, NULL, 1, '1620768791', 1),
(17, 8010, 'This is not very important', 'Remove all color', '', '', '', NULL, NULL, 1, '1620768798', 2),
(18, 8010, 'This is not very important', 'Remove all color', '', '', '', NULL, NULL, 1, '1620770043', 4),
(19, 8010, 'This is not very important', 'Remove all color', '', '', '', NULL, NULL, 1, '1620770061', 6),
(20, 8010, 'This is not very important', 'Remove all color', '', '', '', NULL, NULL, 1, '1620770198', 8),
(21, 8010, 'This is not very important', 'Remove all color', '', '', '', 'k', 1, 1, '1620770225', 9),
(22, 8010, 'This is not very important', 'Remove all color', '', '', '', NULL, NULL, 1, '1620770256', 2),
(23, 8010, 'This is not very important', 'Remove all color', '', '', '', NULL, NULL, 1, '1620770265', 4),
(24, 8010, 'This is not very important', 'Remove all color', '', '', '', NULL, NULL, 1, '1620770278', 6),
(25, 8010, 'This is not very important', 'Remove all color', '', '', '', NULL, NULL, 1, '1620770285', 8),
(26, 8010, 'This is not very important', 'Remove all color', '', '', '', 'nm', 1, 1, '1620770372', 9),
(27, 8011, 'BLA', '2', '3', '', '', NULL, NULL, 1, '1620771191', 1),
(28, 8011, 'BLA', '2', '3', '', '', NULL, NULL, 1, '1620771222', 2),
(29, 8011, 'BLA', '2', '3', '', '', 'NONONO', 1, 1, '1620771342', 3),
(30, 8010, 'This is not very important', 'Remove all color', '', '', '', NULL, NULL, 1, '1620771356', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bag_digital_master`
--

DROP TABLE IF EXISTS `bag_digital_master`;
CREATE TABLE IF NOT EXISTS `bag_digital_master` (
  `bdm_id` int(50) NOT NULL AUTO_INCREMENT,
  `bdm_url` varchar(100) NOT NULL,
  `bdm_name` varchar(100) NOT NULL,
  `bdm_valid` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`bdm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bag_digital_master`
--

INSERT INTO `bag_digital_master` (`bdm_id`, `bdm_url`, `bdm_name`, `bdm_valid`) VALUES
(1, 'assets/wo/bag/2_1.jpg', 'Bag Single Weld & Bottom Fold', 1),
(2, 'assets/wo/bag/2_2.jpg', 'Bag Double Weld & Bottom Fold', 1),
(3, 'assets/wo/bag/2_3.jpg', 'Bag Single Weld & Bottom Gusset', 1),
(4, 'assets/wo/bag/2_4.jpg', 'Bag Double Weld & Bottom Gusset', 1),
(5, 'assets/wo/bag/2_5.jpg', 'Bag Side Gusset & Weldom Weld', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bag_digital_params`
--

DROP TABLE IF EXISTS `bag_digital_params`;
CREATE TABLE IF NOT EXISTS `bag_digital_params` (
  `bdp_id` int(10) NOT NULL AUTO_INCREMENT,
  `bdp_bdm_id` int(10) NOT NULL,
  `bdp_title` varchar(25) NOT NULL,
  PRIMARY KEY (`bdp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bag_digital_params`
--

INSERT INTO `bag_digital_params` (`bdp_id`, `bdp_bdm_id`, `bdp_title`) VALUES
(1, 1, 'Length'),
(2, 1, 'Width'),
(3, 2, 'Length'),
(4, 2, 'Width'),
(5, 3, 'Length'),
(6, 3, 'Width'),
(7, 3, 'A - Bottom Gusset'),
(8, 4, 'Length'),
(9, 4, 'Width'),
(10, 4, 'A - Bottom Gusset'),
(11, 5, 'Length'),
(12, 5, 'Width'),
(13, 5, 'A - Side Gusset');

-- --------------------------------------------------------

--
-- Table structure for table `clients_main`
--

DROP TABLE IF EXISTS `clients_main`;
CREATE TABLE IF NOT EXISTS `clients_main` (
  `client_id` int(80) NOT NULL AUTO_INCREMENT,
  `client_code` varchar(80) NOT NULL,
  `client_name` varchar(80) NOT NULL,
  `client_dnt` varchar(80) NOT NULL DEFAULT '14444444',
  `client_lum_id` int(80) NOT NULL DEFAULT '1',
  `client_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=684 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients_main`
--

INSERT INTO `clients_main` (`client_id`, `client_code`, `client_name`, `client_dnt`, `client_lum_id`, `client_show`) VALUES
(1, 'A003', 'Al Khan Foodstuff LLC', '14444444', 1, 1),
(2, 'A004', 'Al Madina Dates - Tamoor', '14444444', 1, 1),
(3, 'A005', 'Akbar Brothers (Pvt.) Ltd.', '14444444', 1, 1),
(4, 'A006', 'Al Nauras Factory for Juice', '14444444', 1, 1),
(5, 'A007', 'Kerry Foods - Ali & Abdul Karim Trading Co. AATCO', '14444444', 1, 1),
(6, 'A008', 'Al Hilwine Factory', '14444444', 1, 1),
(7, 'A009', 'Aarax Foods', '14444444', 1, 1),
(8, 'A010', 'Alwan Dubai Mills', '14444444', 1, 1),
(9, 'A011', 'Al Shihhe Ind. - Build Well Plastics Co. LLC', '14444444', 1, 1),
(10, 'A012', 'Al Jadeed Bakery', '14444444', 1, 1),
(11, 'A013', 'Al Amjaad Est. for Coffee (BARNIE\'S)', '14444444', 1, 1),
(12, 'A016', 'Firdous Flour Mill', '14444444', 1, 1),
(13, 'A017', 'Al Jazeera Company', '14444444', 1, 1),
(14, 'A018', 'Al Duhayan Deluxe Dates', '14444444', 1, 1),
(15, 'A019', 'Atyab Bakery L.L.C', '14444444', 1, 1),
(16, 'A020', 'Al Seef Gate Trading Co. W.L.L', '14444444', 1, 1),
(17, 'A021', 'Al Halees Group Trading Co. Ltd.', '14444444', 1, 1),
(18, 'A029', 'Al Bustan Factory', '14444444', 1, 1),
(19, 'A022', 'Abreen Factory Foodstuff', '14444444', 1, 1),
(20, 'A023', 'Abu Dhabi Refreshment', '14444444', 1, 1),
(21, 'A024', 'Al Janob Store General Trading', '14444444', 1, 1),
(22, 'A025', 'Al Samir Plastic', '14444444', 1, 1),
(23, 'A026', 'Al Hasna for Cosmetics', '14444444', 1, 1),
(24, 'A027', 'Arab Factory for Confectionary & Chocolate Co.', '14444444', 1, 1),
(25, 'A028', 'Al Marai Co.', '14444444', 1, 1),
(26, 'A030', 'Al Wazzan Foodstuffs Factory', '14444444', 1, 1),
(27, 'A032', 'Anorka Food Ind. - Al Hamwi Co. Ltd.', '14444444', 1, 1),
(28, 'A033', 'Qahwat Al Shayoukh Coffee Est.', '14444444', 1, 1),
(29, 'A034', 'Al Maraya Adv.', '14444444', 1, 1),
(30, 'A035', 'Arabian Beverage Co. Ltd. - ABC', '14444444', 1, 1),
(31, 'A036', 'Abu Harira Food Industry', '14444444', 1, 1),
(32, 'A037', 'Alokozay', '14444444', 1, 1),
(33, 'A038', 'Al Korat Ardiya Perfume', '14444444', 1, 1),
(34, 'A039', 'Al Gudari Inst. Corp.', '14444444', 1, 1),
(35, 'A040', 'Al Waha Filling & Packing Est.', '14444444', 1, 1),
(36, 'A041', 'Arabica Int\'l', '14444444', 1, 1),
(37, 'A042', 'Ali Bin Ali - Pepsi Qatar', '14444444', 1, 1),
(38, 'A043', 'Atiq Abdulla Flour Mill', '14444444', 1, 1),
(39, 'A044', 'ADA Food Complex', '14444444', 1, 1),
(40, 'A045', 'Al SalemTrading', '14444444', 1, 1),
(41, 'A046', 'Al Barakah Dates Factory', '14444444', 1, 1),
(42, 'A047', 'Arab Ind. Complex for Foodstuff & Poultry - YAFCO', '14444444', 1, 1),
(43, 'A048', 'Al Falah Poultry Farms', '14444444', 1, 1),
(44, 'A049', 'Azeema Multi Industries Ltd.', '14444444', 1, 1),
(45, 'A049-SAB', 'Sab Products L.D.A', '14444444', 1, 1),
(46, 'A050', 'Al Jawhara Co. for Food', '14444444', 1, 1),
(47, 'A051', 'Ali Al Rashid Al Amin Co. B.S.C', '14444444', 1, 1),
(48, 'A052', 'Addis Dallas Industries PLC.', '14444444', 1, 1),
(49, 'A053', 'ATM Enterprises', '14444444', 1, 1),
(50, 'A054', 'Al Sahel Omani Sweet', '14444444', 1, 1),
(51, 'A055', 'Alrode South Distributors - Zoomarati Beverages', '14444444', 1, 1),
(52, 'A056', 'Al Adil General Trading', '14444444', 1, 1),
(53, 'A057', 'Ahadukes Food Products Company', '14444444', 1, 1),
(54, 'A058', 'Al Adil Trading', '14444444', 1, 1),
(55, 'A060', 'Ammar Jordan Co. for Food Industry', '14444444', 1, 1),
(56, 'A061', 'Abu Rayan & Brothers for Trade & Import', '14444444', 1, 1),
(57, 'A062', 'Arab Biscuits Factory', '14444444', 1, 1),
(58, 'A063', 'Al Kbous Trading Corporation', '14444444', 1, 1),
(59, 'A064', 'Al Wadaq Industry FZC', '14444444', 1, 1),
(60, 'A065', 'Al Ragawi Trading Corp.', '14444444', 1, 1),
(61, 'A066', 'Al Sallan Food Ind. Co. SAOG', '14444444', 1, 1),
(62, 'A067', 'Al Muhr Al Arabi Foods', '14444444', 1, 1),
(63, 'A068', 'Oman Foodstuff Trading - Amis Food Ind.', '14444444', 1, 1),
(64, 'A069', 'Al Mashwi Flour Mill', '14444444', 1, 1),
(65, 'A071', 'Al Wefag Factory', '14444444', 1, 1),
(66, 'A072', 'Ayan Trading LDA', '14444444', 1, 1),
(67, 'A073', 'Mani Foods Industry', '14444444', 1, 1),
(68, 'A015', 'Al Homaizi Foodstuff', '14444444', 1, 1),
(69, 'A074', 'Al Mulla Trading', '14444444', 1, 1),
(70, 'A075', 'Al Seedawi Sweets', '14444444', 1, 1),
(71, 'A076', 'Al Mahasen General Trading', '14444444', 1, 1),
(72, 'A077', 'Al Foah Company LLC', '14444444', 1, 1),
(73, 'A078', 'Abdul Karim Alwan', '14444444', 1, 1),
(74, 'A079', 'Al Shami Sugar', '14444444', 1, 1),
(75, 'A080', 'Al Rai Meat - Al Gousi', '14444444', 1, 1),
(76, 'A081', 'Al Kawakeb Property', '14444444', 1, 1),
(77, 'A082', 'Abeba Flour & Biscuits Factory', '14444444', 1, 1),
(78, 'A083', 'Alwan for Manufacturing & Trading', '14444444', 1, 1),
(79, 'A084', 'Al Saiee Spices', '14444444', 1, 1),
(80, 'A085', 'Al Taher Spices Mills LLC', '14444444', 1, 1),
(81, 'A086', 'Al Wathbah Food', '14444444', 1, 1),
(82, 'A087', 'Anwar Flour Mills', '14444444', 1, 1),
(83, 'A088', 'AMS Baeshan - Rabea', '14444444', 1, 1),
(84, 'A089', 'Al Karamah Dough', '14444444', 1, 1),
(85, 'A090', 'Al Zawaq Foods', '14444444', 1, 1),
(86, 'A091', 'Areej Vegetable Oils & Derivatives S.A.O.G', '14444444', 1, 1),
(87, 'A092', 'Adventures Coffee', '14444444', 1, 1),
(88, 'A093', 'Al Kazemi Int\'l', '14444444', 1, 1),
(89, 'A094', 'Al Fathimiya Trading', '14444444', 1, 1),
(90, 'A095', 'Ahmed Foods International', '14444444', 1, 1),
(91, 'A096', 'Al Hashim Company', '14444444', 1, 1),
(92, 'A097', 'AMIMZA - Amir Hamza (T) Limited', '14444444', 1, 1),
(93, 'A098', 'Al Otair Factory for Sweets', '14444444', 1, 1),
(94, 'A099', 'Al Bedey Management Ltd.', '14444444', 1, 1),
(95, 'A100', 'Al Hakimi Supermarket', '14444444', 1, 1),
(96, 'A101', 'Al Adel Foodstuff Trading', '14444444', 1, 1),
(97, 'A102', 'Awafi Foodstuff Ind. Co. LLC', '14444444', 1, 1),
(98, 'A103', 'Al Barajoub Group', '14444444', 1, 1),
(99, 'A104', 'Al Zariki Co. for Food Snack', '14444444', 1, 1),
(100, 'A105', 'Al Ajji for Trdg.-Light Food Ind.', '14444444', 1, 1),
(101, 'A106', 'Aujan Soft Drink Ind.', '14444444', 1, 1),
(102, 'A108', 'Al Nusari For Industry & Trade Co. Ltd.', '14444444', 1, 1),
(103, 'A109', 'Al Rasa Trading', '14444444', 1, 1),
(104, 'A110', 'Al Ain Vegegtable Processing & Canning', '14444444', 1, 1),
(105, 'A111', 'Al Yami Trading Company', '14444444', 1, 1),
(106, 'A112', 'Abdullah Essa for Soap Production', '14444444', 1, 1),
(107, 'A113', 'Mohd. Al Mansour Coffee Est.', '14444444', 1, 1),
(108, 'A114', 'Adamji Multi Supplier Ltd.', '14444444', 1, 1),
(109, 'A115', 'Arafat Coffee Mills Co.', '14444444', 1, 1),
(110, 'A116', 'Al Jufair Food Industry Co. - Al Shaihani', '14444444', 1, 1),
(111, 'A117', 'Anwar Abha Company for Import & Export', '14444444', 1, 1),
(112, 'A118', 'Al Msouti Company', '14444444', 1, 1),
(113, 'A119', 'Al Durra For General Trading & Investment Co. Ltd.', '14444444', 1, 1),
(114, 'A119-B', 'Al Durra Food Products Co.', '14444444', 1, 1),
(115, 'A120', 'ABC Foods Pty. Ltd.', '14444444', 1, 1),
(116, 'A121', 'Al Rai Food Industries', '14444444', 1, 1),
(117, 'A122', 'Akma Packaging Industries LLC', '14444444', 1, 1),
(118, 'A123', 'Al Mannai Hospitality', '14444444', 1, 1),
(119, 'A124', 'Athraa General Trading LLC - Natrocuticals Health Food Trading LLC', '14444444', 1, 1),
(120, 'A125', 'Al Shareef Biscuits Factory', '14444444', 1, 1),
(121, 'A126', 'Aroom Company', '14444444', 1, 1),
(122, 'A127', 'Al Hamawi Co. Ltd. - Akram H. Hamawi Sons Co.', '14444444', 1, 1),
(123, 'A128', 'Al Douri Group', '14444444', 1, 1),
(124, 'A129', 'Ahlia Group Co. W.L.L for Foodstuff and Consumer Products', '14444444', 1, 1),
(125, 'A130', 'Aloqab Roasters & Mills', '14444444', 1, 1),
(126, 'A131', 'Africa PLC - Africa Food Complex - Afre Star General Trading LLC', '14444444', 1, 1),
(127, 'A132', 'Al Rashed Food Company Limited', '14444444', 1, 1),
(128, 'A133', 'Al Mugarmesh First Group', '14444444', 1, 1),
(129, 'A134', 'Arab Beverages Establishment', '14444444', 1, 1),
(130, 'A135', 'Al Wafi Food Products Factory LLC - B.R.F Foods GmbH', '14444444', 1, 1),
(131, 'A136', 'Arabian Wet Wipes FZC', '14444444', 1, 1),
(132, 'A137', 'Al Sham Food Factory', '14444444', 1, 1),
(133, 'A138', 'Al Haif Trading Co. LLC', '14444444', 1, 1),
(134, 'A139', 'Al Setour Foodstuff Trading', '14444444', 1, 1),
(135, 'A140', 'AAC Global Food Industries', '14444444', 1, 1),
(136, 'A141', 'Abela & Co.', '14444444', 1, 1),
(137, 'A142', 'Al Khaleej Sugar Co LLC', '14444444', 1, 1),
(138, 'A143', 'Al Fakhamah Tobacco Company', '14444444', 1, 1),
(139, 'A144', 'Asif Rafiq Plastic Industry - Bladex', '14444444', 1, 1),
(140, 'A145', 'Al Rahi Meat Supply Factory LLC - Sweden Foods General Trading', '14444444', 1, 1),
(141, 'A146', 'ALLDEE Foods& Beverages Industries LLC', '14444444', 1, 1),
(142, 'B001', 'Bonite Bottlers Limited', '14444444', 1, 1),
(143, 'B002', 'Bakery & Co. / Dr. Café', '14444444', 1, 1),
(144, 'B003', 'Baraka International Co. for Foodstuff', '14444444', 1, 1),
(145, 'B004', 'Blooming Foods FZCO', '14444444', 1, 1),
(146, 'B005', 'Ballyrashane', '14444444', 1, 1),
(147, 'B006', 'Bahadi Trading Est.', '14444444', 1, 1),
(148, 'B007', 'Blue Pages', '14444444', 1, 1),
(149, 'B008', 'Black Tulip Flowers', '14444444', 1, 1),
(150, 'B009', 'Bahrain Flour Mills Company B.S.C', '14444444', 1, 1),
(151, 'B010', 'Bullseye Advertisement', '14444444', 1, 1),
(152, 'B012', 'Bon Café', '14444444', 1, 1),
(153, 'B013', 'Baniyas Spike', '14444444', 1, 1),
(154, 'B014', 'Baba Foodstuff', '14444444', 1, 1),
(155, 'B015', 'Bacchus Treasures', '14444444', 1, 1),
(156, 'B016', 'Bridges Int\'l', '14444444', 1, 1),
(157, 'B017', 'Bin Ablan Food', '14444444', 1, 1),
(158, 'B018', 'Bustan Macaroni', '14444444', 1, 1),
(159, 'B019', 'Best Choice Industries L.L.C', '14444444', 1, 1),
(160, 'B020', 'Babel Factory for Trdg.', '14444444', 1, 1),
(161, 'B021', 'Bio Amla - Forvil Cosmetics', '14444444', 1, 1),
(162, 'B022', 'Bin Menqash Marketing', '14444444', 1, 1),
(163, 'B023', 'Barna For Food Ind. & Investment', '14444444', 1, 1),
(164, 'B024', 'Best Food Company LLC', '14444444', 1, 1),
(165, 'B025', 'Brothers Co. For Food Products', '14444444', 1, 1),
(166, 'B026', 'Bliss Brands Pty.', '14444444', 1, 1),
(167, 'B027', 'Baja Food Industries Company', '14444444', 1, 1),
(168, 'B028', 'Buono Foodz FZC', '14444444', 1, 1),
(169, 'C001', 'Co-Op Islamic - Fresh Chiken Restaurant', '14444444', 1, 1),
(170, 'C002', 'Cold Alex for Food Processing', '14444444', 1, 1),
(171, 'C003', 'Carawan Sweets', '14444444', 1, 1),
(172, 'C004', 'Coca Cola - Al Ahlia', '14444444', 1, 1),
(173, 'C005', 'Castle Dairies', '14444444', 1, 1),
(174, 'C006', 'Cascade Marine Foods - SAHAR', '14444444', 1, 1),
(175, 'C007', 'Caspian Int\'l', '14444444', 1, 1),
(176, 'C008', 'Eastern Co. of Manuf. Sweet & Chocolate - COVERTINA', '14444444', 1, 1),
(177, 'C009', 'Chilalo Food Complex', '14444444', 1, 1),
(178, 'C010', 'Chequer Foods', '14444444', 1, 1),
(179, 'C011', 'Caretecs Int\'l', '14444444', 1, 1),
(180, 'C012', 'Country Side Food Factory', '14444444', 1, 1),
(181, 'C013', 'Conserve Food - Khazan', '14444444', 1, 1),
(182, 'C014', 'Cendhurr Telecom LLC', '14444444', 1, 1),
(183, 'C015', 'Commodities Intertrade', '14444444', 1, 1),
(184, 'C016', 'Cofftea', '14444444', 1, 1),
(185, 'C017', 'Caviar Classic', '14444444', 1, 1),
(186, 'C018', 'Concept FZE', '14444444', 1, 1),
(187, 'C019', 'Charlotte Trading & Cont.', '14444444', 1, 1),
(188, 'C020', 'Candelite LLC', '14444444', 1, 1),
(189, 'C021', 'Crescent Company for Milk Products', '14444444', 1, 1),
(190, 'C022', 'Cape Cookies', '14444444', 1, 1),
(191, 'C023', 'Spa Cevital Bejaia', '14444444', 1, 1),
(192, 'C024', 'Commubiz General Trading LLC - Sahara', '14444444', 1, 1),
(193, 'C025', 'Clear Ice LLC', '14444444', 1, 1),
(194, 'D001', 'Delta Food Industries FZE', '14444444', 1, 1),
(195, 'D009', 'Delta Food Processing & Packing Co. Ltd.', '14444444', 1, 1),
(196, 'D002', 'Detpak Middle East FZE', '14444444', 1, 1),
(197, 'D003', 'Digital World Group', '14444444', 1, 1),
(198, 'D004', 'Dubai Petroleum', '14444444', 1, 1),
(199, 'D005', 'Dubai Refreshments', '14444444', 1, 1),
(200, 'D006', 'Dubai Shopping Festival', '14444444', 1, 1),
(201, 'D007', 'DSGS Trade & Marketing', '14444444', 1, 1),
(202, 'D008', 'Defaf Al Nahrayn for Food Industries & Drinks', '14444444', 1, 1),
(203, 'D010', 'Ditra/Scitra Soap & Chemicals', '14444444', 1, 1),
(204, 'D011', 'Dabur Int\'l Ltd. / Redrock Int\'l.', '14444444', 1, 1),
(205, 'D012', 'Diamond Star General Trading', '14444444', 1, 1),
(206, 'D013', 'Dario Pro Pty. Ltd. - Yummy Snacks', '14444444', 1, 1),
(207, 'D014', 'Dar Al Ibdaa Gift', '14444444', 1, 1),
(208, 'D015', 'Dalmaza Snack Foods', '14444444', 1, 1),
(209, 'D016', 'Dal Food Ind.', '14444444', 1, 1),
(210, 'D017', 'Dubai Factories with Raw Material & Packaging Material', '14444444', 1, 1),
(211, 'D018', 'Do Freeze', '14444444', 1, 1),
(212, 'D019', 'Dhamma Perfumes', '14444444', 1, 1),
(213, 'D020', 'Dawliya Factory Co. Ltd.', '14444444', 1, 1),
(214, 'D021', 'Datar & Sons Limited', '14444444', 1, 1),
(215, 'D022', 'Durur Al Naqwa Trading Est.', '14444444', 1, 1),
(216, 'D023', 'Dental Film FZCO', '14444444', 1, 1),
(217, 'D024', 'Delmonte Foods', '14444444', 1, 1),
(218, 'D024-A', 'Delmonte Foods K.S.A', '14444444', 1, 1),
(219, 'D025', 'Diamond Meat Processing LLC - Siniora Food', '14444444', 1, 1),
(220, 'D026', 'DETCO E&T', '14444444', 1, 1),
(221, 'D027', 'Diwa Factory', '14444444', 1, 1),
(222, 'D028', 'Dishaka LLC', '14444444', 1, 1),
(223, 'D029', 'Darsot Food Corporation - A.H Vest Limited T/A - All Joy Foods', '14444444', 1, 1),
(224, 'D030', 'Desert Turfcare General Trading LLC - Desert Energy', '14444444', 1, 1),
(225, 'D031', 'Dawit Teshome Tilahun - Gonde Food Complex', '14444444', 1, 1),
(226, 'D032', 'Dumont Perfumes Factory LLC', '14444444', 1, 1),
(227, 'D033', 'De-Lite No Sugar Added Sweets Trading', '14444444', 1, 1),
(228, 'D034', 'Doner & Gyros', '14444444', 1, 1),
(229, 'E001', 'Al Barda for Soft Drinks & Natural Juices', '14444444', 1, 1),
(230, 'E002', 'Emirates Wet Wipes FZCO', '14444444', 1, 1),
(231, 'E003', 'Excel Plastics', '14444444', 1, 1),
(232, 'E004', 'Emirates Refining Company - ERCO', '14444444', 1, 1),
(233, 'E012', 'Egypt Foods Group', '14444444', 1, 1),
(234, 'E005', 'Emirates Grain - Emigrain', '14444444', 1, 1),
(235, 'E006', 'Mamoun Elberier Group of Co.', '14444444', 1, 1),
(236, 'E007', 'Emirates - DNATA', '14444444', 1, 1),
(237, 'E008', 'Emirates Explosives', '14444444', 1, 1),
(238, 'E009', 'Europack Trading', '14444444', 1, 1),
(239, 'E010', 'Elnasr Industrial Trading Co. Ltd.', '14444444', 1, 1),
(240, 'E011', 'El Maleka for Food Industries', '14444444', 1, 1),
(241, 'E013', 'Emirates Danish - Edam', '14444444', 1, 1),
(242, 'E014', 'Emirates Modern Poultry', '14444444', 1, 1),
(243, 'E015', 'East African Agri Business', '14444444', 1, 1),
(244, 'E016', 'Emstar International', '14444444', 1, 1),
(245, 'E017', 'East African Tiger Brands', '14444444', 1, 1),
(246, 'E018', 'ETMCO - Layalina', '14444444', 1, 1),
(247, 'E019', 'Ethiopian Spice Extraction Factory PLC', '14444444', 1, 1),
(248, 'E020', 'El Rehab Foodstuffs', '14444444', 1, 1),
(249, 'E021', 'El Doha Group for Foodstuff Co.', '14444444', 1, 1),
(250, 'E022', 'ECO', '14444444', 1, 1),
(251, 'E023', 'Emirates Color Services', '14444444', 1, 1),
(252, 'E024', 'Eco Pack Packaging Material', '14444444', 1, 1),
(253, 'E025', 'Emirates Macaroni', '14444444', 1, 1),
(254, 'E026', 'Emirates Printing Press', '14444444', 1, 1),
(255, 'E027', 'Essco Foods', '14444444', 1, 1),
(256, 'E028', 'Emirates Delight Foods', '14444444', 1, 1),
(257, 'E029', 'Emirates Pure Spring', '14444444', 1, 1),
(258, 'E030', 'Emirates Refreshments P.J.S.C - JEEMA', '14444444', 1, 1),
(259, 'E031', 'Energy & Industrial Solution', '14444444', 1, 1),
(260, 'E032', 'Evergreen Plastics', '14444444', 1, 1),
(261, 'E033', 'Equal General Trading - UAE - Ronnani Industria LDA - ANGOLA', '14444444', 1, 1),
(262, 'E034', 'ECS General Trading (Emirates Cooperative)', '14444444', 1, 1),
(263, 'E035', 'Euro Star Communication', '14444444', 1, 1),
(264, 'E036', 'Esnad Food Co. Ltd.', '14444444', 1, 1),
(265, 'E037', 'Enercon International FZE', '14444444', 1, 1),
(266, 'E038', 'Export Trading Group (E.T.G)', '14444444', 1, 1),
(267, 'E039', 'Emiru Oljira Food Complex', '14444444', 1, 1),
(268, 'E040', 'Ember Snacks', '14444444', 1, 1),
(269, 'E041', 'El Manar for Food Ind. Co. + El Yousr for Foor Ind. Co.', '14444444', 1, 1),
(270, 'F001', 'Fanar Group', '14444444', 1, 1),
(271, 'F002', 'Village Valley Foodstuff', '14444444', 1, 1),
(272, 'F003', 'National Food Industries Company - Luna', '14444444', 1, 1),
(273, 'F004', 'Star Food Industry', '14444444', 1, 1),
(274, 'F005', 'Fayaz Bakers Limited', '14444444', 1, 1),
(275, 'F006', 'General Food Processing LLC - Al Maya Lsl\'s', '14444444', 1, 1),
(276, 'F007', 'Forsan Foods & Consumer Products Co. Ltd.', '14444444', 1, 1),
(277, 'F008', 'Freezerlink Frozen Foods', '14444444', 1, 1),
(278, 'F009', 'Farma Food - Kuwait', '14444444', 1, 1),
(279, 'F010', 'Freeze Pops - Chilly Willy', '14444444', 1, 1),
(280, 'F011', 'Freshly Frozen', '14444444', 1, 1),
(281, 'F012', 'Flahavan Trading', '14444444', 1, 1),
(282, 'F014', 'Falcon Chemicals', '14444444', 1, 1),
(283, 'F015', 'Faragalla Food Industries', '14444444', 1, 1),
(284, 'F016', 'Food Industries Co. - FICO', '14444444', 1, 1),
(285, 'F017', 'Fatima Trading Co.', '14444444', 1, 1),
(286, 'F018', 'Fine Hygiene - Dubai', '14444444', 1, 1),
(287, 'F013', 'Al Bardi Paper Mill Co.', '14444444', 1, 1),
(288, 'F019', 'Farm Frites - Int\'l Co.', '14444444', 1, 1),
(289, 'F020', 'Fairway Gen. Trading', '14444444', 1, 1),
(290, 'F021', 'Frimax Foods', '14444444', 1, 1),
(291, 'F022', 'Fibertex Industries FZC', '14444444', 1, 1),
(292, 'F023', 'Faisal Brothers', '14444444', 1, 1),
(293, 'F024', 'Farm Fresh', '14444444', 1, 1),
(294, 'F025', 'Famico - SARL BTL BILLEL', '14444444', 1, 1),
(295, 'F026', 'Fawakhe', '14444444', 1, 1),
(296, 'F027', 'Fajr Al Tatweer General Contracting - Al Fajr Water', '14444444', 1, 1),
(297, 'G001', 'Guts Agro Industries PLC', '14444444', 1, 1),
(298, 'G002', 'Gonas Best Ltd.', '14444444', 1, 1),
(299, 'G019', 'Gulf Manufacturing Est.', '14444444', 1, 1),
(300, 'G003', 'Giant Group', '14444444', 1, 1),
(301, 'G004', 'Goldline Limitada', '14444444', 1, 1),
(302, 'G005', 'Galaxy Plastic', '14444444', 1, 1),
(303, 'G006', 'Gulf Sea Food', '14444444', 1, 1),
(304, 'G007', 'Green Asia Trading LLC', '14444444', 1, 1),
(305, 'G008', 'Gautam General Trading', '14444444', 1, 1),
(306, 'G009', 'Gourmet Foods FZC', '14444444', 1, 1),
(307, 'G010', 'Gift Media Advertising', '14444444', 1, 1),
(308, 'G011 A', 'Global Foods Ind. - Seafood Division', '14444444', 1, 1),
(309, 'G011 B', 'Global Foods Ind. - Snacks Division', '14444444', 1, 1),
(310, 'G012', 'Gargash Enterprises', '14444444', 1, 1),
(311, 'G014', 'Groupe Labelle - SPA Tomoca (Bonal Café)', '14444444', 1, 1),
(312, 'G015', 'Gulfa Mineral Water', '14444444', 1, 1),
(313, 'G016', 'Gulf Food - California G.', '14444444', 1, 1),
(314, 'G017', 'Golden Beans', '14444444', 1, 1),
(315, 'G018', 'Ghadeer Mineral Water', '14444444', 1, 1),
(316, 'G020', 'Gyma Food Ind. - Bayara', '14444444', 1, 1),
(317, 'G021', 'Golf In Dubai', '14444444', 1, 1),
(318, 'G022', 'Gulfar Foodstuff', '14444444', 1, 1),
(319, 'G023', 'Gulf Processing Ind.', '14444444', 1, 1),
(320, 'G024', 'Gulf Greetings', '14444444', 1, 1),
(321, 'G026', 'Sharif Pound', '14444444', 1, 1),
(322, 'G025', 'Golden Harvest - Dawn', '14444444', 1, 1),
(323, 'G027', 'Gulf Rice Factory', '14444444', 1, 1),
(324, 'G028', 'Gold Crown Foods', '14444444', 1, 1),
(325, 'G029', 'Genpack - General Industries & Packages', '14444444', 1, 1),
(326, 'G030', 'Galletas Asinez, S.A.', '14444444', 1, 1),
(327, 'G031', 'Golden Rise Processing & Pack', '14444444', 1, 1),
(328, 'G032', 'Green Planet Industries LLC', '14444444', 1, 1),
(329, 'G033', 'Green Season Company', '14444444', 1, 1),
(330, 'G034', 'Global Catering Services - Meera Al Sham Global Kitchen & Sweet LLC', '14444444', 1, 1),
(331, 'G035', 'Glamour Beauty Concepts DMCC', '14444444', 1, 1),
(332, 'H001', 'Hot Rest Sugar', '14444444', 1, 1),
(333, 'H007', 'High Grade Cashew Ltd.', '14444444', 1, 1),
(334, 'H002', 'Hassani Group', '14444444', 1, 1),
(335, 'H004', 'Harvest Foods', '14444444', 1, 1),
(336, 'H005', 'Household Cleaning Products Co. - Clorox', '14444444', 1, 1),
(337, 'H006', 'Bedo Factory for Food - Bedo Bakery', '14444444', 1, 1),
(338, 'H008', 'Heinz - Egypt', '14444444', 1, 1),
(339, 'H009', 'Halwani Bros. Co. - Saudi', '14444444', 1, 1),
(340, 'H003', 'Halwani Bros. Co. - Egypt', '14444444', 1, 1),
(341, 'H010', 'Hussain and Qaisar', '14444444', 1, 1),
(342, 'H011', 'Hunter Foods', '14444444', 1, 1),
(343, 'H012', 'Hassan Saqer Flour', '14444444', 1, 1),
(344, 'H013', 'Halwani & Tahhan', '14444444', 1, 1),
(345, 'H014', 'Herfy Food Services Co.', '14444444', 1, 1),
(346, 'H015', 'Horizon Adhesive Label', '14444444', 1, 1),
(347, 'H016', 'Hayat Commodities Industries (Pvt.) Ltd.', '14444444', 1, 1),
(348, 'H017', 'Herbion Pakistan', '14444444', 1, 1),
(349, 'H018', 'Hourani Foods and Nutrition LLC (Lightwhey)', '14444444', 1, 1),
(350, 'H019', 'Hill Group - Hill Packaging', '14444444', 1, 1),
(351, 'H020', 'Heritage Touch Trading LLC', '14444444', 1, 1),
(352, 'H021', 'Healthy Snacks Food Manufacturing LLC - Munchbox', '14444444', 1, 1),
(353, 'H022', 'H.F.C PPC', '14444444', 1, 1),
(354, 'H023', 'Hot N Fresh Pastry Factory - Al Nameer Group', '14444444', 1, 1),
(355, 'I001', 'Ibson General Trading', '14444444', 1, 1),
(356, 'I002', 'Indus Pharma (Private) Limited', '14444444', 1, 1),
(357, 'I003', 'IKA Trading LLC', '14444444', 1, 1),
(358, 'I004', 'International Foods Co.', '14444444', 1, 1),
(359, 'I005', 'Interplast Co. Ltd.', '14444444', 1, 1),
(360, 'I006', 'Ileys Detergent Industry Corp.', '14444444', 1, 1),
(361, 'I007', 'Icepac Limited', '14444444', 1, 1),
(362, 'I008', 'Indhadeero Detergent', '14444444', 1, 1),
(363, 'I009', 'Innoplastic Ltd.', '14444444', 1, 1),
(364, 'I010', 'Ibn Al Qayyim Group', '14444444', 1, 1),
(365, 'I011', 'Imaginered Models', '14444444', 1, 1),
(366, 'I012', 'Ikaf Arabian Co. (Makkah Dates)', '14444444', 1, 1),
(367, 'I013', 'Ice Lab Company L.L.C', '14444444', 1, 1),
(368, 'I014', 'Ideal Sweet & Pastry LLC - ID Fresh Food', '14444444', 1, 1),
(369, 'J001', 'Jalap Brother Company', '14444444', 1, 1),
(370, 'J002', 'Jerry Snacks LDA', '14444444', 1, 1),
(371, 'J003', 'Jawad Fashion', '14444444', 1, 1),
(372, 'J004', 'Jaynee Foodstuff', '14444444', 1, 1),
(373, 'J005', 'Jawharat Perfume Est', '14444444', 1, 1),
(374, 'J006', 'Joofri\'s', '14444444', 1, 1),
(375, 'J007', 'Jaleel General Trading', '14444444', 1, 1),
(376, 'J008', 'Jercy Foodstuff Inc.', '14444444', 1, 1),
(377, 'J009', 'Jigsaw Foods Limited', '14444444', 1, 1),
(378, 'J010', 'J.B.S Foods (SEARA)', '14444444', 1, 1),
(379, 'K001', 'Kenana Sugar Company Ltd.', '14444444', 1, 1),
(380, 'K002', 'Krikab Food Industries Co. Ltd.', '14444444', 1, 1),
(381, 'K003', 'Kuwait Indo Trdg. - Kitco', '14444444', 1, 1),
(382, 'K004', 'Mondelez - Kraft Foods M.E', '14444444', 1, 1),
(383, 'K005', 'Kinapharma Ltd.', '14444444', 1, 1),
(384, 'K006', 'Kuwait Food Company - Americana', '14444444', 1, 1),
(385, 'K007', 'Komanco Foods', '14444444', 1, 1),
(386, 'K008', 'Khushi Trading', '14444444', 1, 1),
(387, 'K009', 'Khazan Meat', '14444444', 1, 1),
(388, 'K010', 'Kuwaiti Danish Dairy', '14444444', 1, 1),
(389, 'K011', 'Kings Food - Hilal', '14444444', 1, 1),
(390, 'K012', 'Kesava General Trading', '14444444', 1, 1),
(391, 'K013', 'Kaliti Foods - Romel Holding Co.', '14444444', 1, 1),
(392, 'K014', 'Ketley International FZE', '14444444', 1, 1),
(393, 'K015', 'K.R.C Food Industries', '14444444', 1, 1),
(394, 'K016', 'Khaltat Al Gharbi Factory', '14444444', 1, 1),
(395, 'K017', 'Al Khadlaj Perfumes Industries LLC', '14444444', 1, 1),
(396, 'K018', 'Koch & Ali FZ. LLC', '14444444', 1, 1),
(397, 'K019', 'Khalid Derea Al Derea Partner & Co. - Cotto Food Ind.', '14444444', 1, 1),
(398, 'L001', 'La Ronda Emirates', '14444444', 1, 1),
(399, 'L002', 'Lutfi Trading', '14444444', 1, 1),
(400, 'L003', 'Lutfi Opticals', '14444444', 1, 1),
(401, 'L004', 'Mobarak Group - Latif Gostar Diba Co.', '14444444', 1, 1),
(402, 'L005', 'Laziza Int\'l - Convenience Foods Ind. Pvt. Ltd.', '14444444', 1, 1),
(403, 'L006', 'Latifullah', '14444444', 1, 1),
(404, 'L007', 'Leemar Food Industries', '14444444', 1, 1),
(405, 'L008', 'Law Print & Packaging', '14444444', 1, 1),
(406, 'L009', 'Lumiglass Ind.', '14444444', 1, 1),
(407, 'L010', 'Leader - Senyorita Foods', '14444444', 1, 1),
(408, 'L011', 'Lifco Group', '14444444', 1, 1),
(409, 'L012', 'Lulu Hyper Market LLC', '14444444', 1, 1),
(410, 'L014', 'Leminar Air Conditioning Ind. - Shirawi Group', '14444444', 1, 1),
(411, 'L015', 'Let\'s Popcorn', '14444444', 1, 1),
(412, 'L016', 'Lacto Foods FZE', '14444444', 1, 1),
(413, 'L017', 'Le Chocolat LLC', '14444444', 1, 1),
(414, 'L018', 'Liwa Dates for Food Industries LLC', '14444444', 1, 1),
(415, 'M001', 'Momin Oil Ind.', '14444444', 1, 1),
(416, 'M002', 'Matco Rice Processing (Pvt.) Ltd.', '14444444', 1, 1),
(417, 'M003', 'Multirange Ltd.', '14444444', 1, 1),
(418, 'M004', 'Maatouk 1960 Factory L.L.C - Maison Du Café', '14444444', 1, 1),
(419, 'M005', 'Modern Oman Bakery', '14444444', 1, 1),
(420, 'M006', 'Mersi Trading', '14444444', 1, 1),
(421, 'M007', '3M Gulf Ltd.', '14444444', 1, 1),
(422, 'M008', 'Madhoor LLC', '14444444', 1, 1),
(423, 'M009', 'Mega Market', '14444444', 1, 1),
(424, 'M010', 'Metropolic Papers', '14444444', 1, 1),
(425, 'M011', 'Metro Printing Press', '14444444', 1, 1),
(426, 'M012', 'Manzoor Food Ind.', '14444444', 1, 1),
(427, 'M013', 'Al Manama Group', '14444444', 1, 1),
(428, 'M014', 'Majan Printing', '14444444', 1, 1),
(429, 'M015', 'Brothers Flour & Biscuit Factory', '14444444', 1, 1),
(430, 'M016', 'Meltan Food Industries', '14444444', 1, 1),
(431, 'M017', 'Momair Trading LLC - Fresh Start Meals', '14444444', 1, 1),
(432, 'M018', 'Mujezat Al Shifa', '14444444', 1, 1),
(433, 'M019', 'Mega Carpets', '14444444', 1, 1),
(434, 'M020', 'Masdar Al Hayat Food Ind. Co.', '14444444', 1, 1),
(435, 'M021', 'M.R.S (FZE)', '14444444', 1, 1),
(436, 'M022', 'Blossom Trading', '14444444', 1, 1),
(437, 'M023', 'Makelit Food Complex', '14444444', 1, 1),
(438, 'M024', 'Malsons Trading', '14444444', 1, 1),
(439, 'M025', 'My Perfurmes', '14444444', 1, 1),
(440, 'M026', 'Saudi Master Bakers', '14444444', 1, 1),
(441, 'M027', 'Majid Spices', '14444444', 1, 1),
(442, 'M028', 'Majdi Food Company', '14444444', 1, 1),
(443, 'M029', 'Mohd. Bin Ghlaitha Trading', '14444444', 1, 1),
(444, 'M030', 'Margarine Industries', '14444444', 1, 1),
(445, 'M031', 'Magenta Fish & Seafood Supply', '14444444', 1, 1),
(446, 'M032', 'Mimo Meat Factory', '14444444', 1, 1),
(447, 'M034', 'Mehdi Foods', '14444444', 1, 1),
(448, 'M035', 'Merec Industries', '14444444', 1, 1),
(449, 'M036', 'Mai Dubai LLC', '14444444', 1, 1),
(450, 'M037', 'Maple Home Linen Industries LLC - Safetex Group', '14444444', 1, 1),
(451, 'M038', 'Modern Plastic Industry LLC', '14444444', 1, 1),
(452, 'M039', 'Markable General Trading LLC', '14444444', 1, 1),
(453, 'N001', 'National Food Ind. - NFI', '14444444', 1, 1),
(454, 'N002', 'National Detergent Co.', '14444444', 1, 1),
(455, 'N003', 'National Food Company - Americana', '14444444', 1, 1),
(456, 'N004', 'National Canned Food Products', '14444444', 1, 1),
(457, 'N005', 'Nas Foods PLC', '14444444', 1, 1),
(458, 'N006', 'Nuplas Ind.', '14444444', 1, 1),
(459, 'N007', 'Noorani Cosmetics', '14444444', 1, 1),
(460, 'N008', 'Nabil / A\'Nabil Biscuits', '14444444', 1, 1),
(461, 'N009', 'National Foodstuff Corporation', '14444444', 1, 1),
(462, 'N010-A', 'Nestle Middle East', '14444444', 1, 1),
(463, 'N010-B', 'Nestle Waters Factory H&O LLC', '14444444', 1, 1),
(464, 'N011', 'National Cables Industry', '14444444', 1, 1),
(465, 'N012', 'Nile Soft Drinks Bottling Factory', '14444444', 1, 1),
(466, 'N013', 'National Foodstuff - Zadi', '14444444', 1, 1),
(467, 'N014', 'National Supreme Co. for Icecream - Al Amal', '14444444', 1, 1),
(468, 'N015', 'Nuts Island', '14444444', 1, 1),
(469, 'N016', 'National Tea Co.', '14444444', 1, 1),
(470, 'N017', 'Nasma Foods', '14444444', 1, 1),
(471, 'N018', 'New Style Foodstuff Trading', '14444444', 1, 1),
(472, 'N019', 'National Biscuits & Confectionary (N.B.C.C)', '14444444', 1, 1),
(473, 'N020', 'Nazeer Ahmed G. M. Factory', '14444444', 1, 1),
(474, 'N021', 'Niki Manufacturing Co. Ltd.', '14444444', 1, 1),
(475, 'N022', 'National Flexible Ltd.', '14444444', 1, 1),
(476, 'N023', 'Nuts Valley', '14444444', 1, 1),
(477, 'N024', 'Natural Way Snacks', '14444444', 1, 1),
(478, 'N025', 'National Q for Molasses Production Co.', '14444444', 1, 1),
(479, 'N026', 'NAFCO Industries Limitada', '14444444', 1, 1),
(480, 'N027', 'N. R. INVESTMENTS LTD.', '14444444', 1, 1),
(481, 'N028', 'National Industries Company', '14444444', 1, 1),
(482, 'O001', 'Oman Foodstuff Factory', '14444444', 1, 1),
(483, 'O001-A', 'Munar Food Ind. LLC', '14444444', 1, 1),
(484, 'O002', 'Oasis Water', '14444444', 1, 1),
(485, 'O003', 'Oasis Star General Trading LLC', '14444444', 1, 1),
(486, 'O004', 'Omar Kasem Al Esayi', '14444444', 1, 1),
(487, 'O005', 'Otto Cosmetic', '14444444', 1, 1),
(488, 'O006', 'Ommdurman / Sulphonia Soap', '14444444', 1, 1),
(489, 'O007', 'Original Coffee', '14444444', 1, 1),
(490, 'O008', 'Oman Agro Ind. LLC', '14444444', 1, 1),
(491, 'O009', 'Optimum Savour Food Industries LLC', '14444444', 1, 1),
(492, 'P001', 'Panesar Foods - Global Choice Foods Ltd.', '14444444', 1, 1),
(493, 'P002', 'Parisvally Perfumes', '14444444', 1, 1),
(494, 'P003', 'Pan Industries', '14444444', 1, 1),
(495, 'P004', 'Pastalini Foods', '14444444', 1, 1),
(496, 'P005', 'Paradise Est.', '14444444', 1, 1),
(497, 'P006', 'Petra Foof Manufacturing Co.', '14444444', 1, 1),
(498, 'P007', 'Polybit', '14444444', 1, 1),
(499, 'P008', 'Pinhal Conpany SPC', '14444444', 1, 1),
(500, 'P009', 'Purefoods', '14444444', 1, 1),
(501, 'P010', 'Propack Ltd.', '14444444', 1, 1),
(502, 'P011', 'Phoenix Middle East FZCO - Roya Foods Inc. (U.S.A)', '14444444', 1, 1),
(503, 'P011-B', 'Ispice Foods Inc. (U.S.A)', '14444444', 1, 1),
(504, 'P012', 'Pwc Global Logistics', '14444444', 1, 1),
(505, 'P013', 'Parkinsons Clarke', '14444444', 1, 1),
(506, 'P014', 'Prince Foods Industries', '14444444', 1, 1),
(507, 'P015', 'Packages Limited', '14444444', 1, 1),
(508, 'P016', 'Pac Technology', '14444444', 1, 1),
(509, 'P017', 'Packit Industries', '14444444', 1, 1),
(510, 'P018', 'Pure Icecream Co.', '14444444', 1, 1),
(511, 'P019', 'Pavilion Foods', '14444444', 1, 1),
(512, 'P020', 'Property Shop Investment', '14444444', 1, 1),
(513, 'P021', 'Palmary Food - SARL SOBCO', '14444444', 1, 1),
(514, 'P022', 'Premium Food Products (Pvt.) Ltd.', '14444444', 1, 1),
(515, 'P023', 'Power Wrap Industries M.E', '14444444', 1, 1),
(516, 'P024', 'Plastix Plus Industries', '14444444', 1, 1),
(517, 'P025', 'Promasidor', '14444444', 1, 1),
(518, 'P026', 'P.V.M Products (Pty.) Ltd.', '14444444', 1, 1),
(519, 'P027', 'Pulsar Foodstuff Trading', '14444444', 1, 1),
(520, 'P028', 'Prime Bite Limited - Hunter\'s Biltong', '14444444', 1, 1),
(521, 'P029', 'Ultra Prime for Packaging', '14444444', 1, 1),
(522, 'Q001', 'Qatari German Medical Devices QSC.', '14444444', 1, 1),
(523, 'Q002', 'Qatafat Trading Est.', '14444444', 1, 1),
(524, 'Q003', 'Q Home Décor LLC', '14444444', 1, 1),
(525, 'Q004', 'Qatar Flour Mills Co.', '14444444', 1, 1),
(526, 'Q005', 'Qatar Food Factories Co.', '14444444', 1, 1),
(527, 'Q006', 'Delight Food Industries', '14444444', 1, 1),
(528, 'R001', 'Regina Co. for Pasta and Food Processing', '14444444', 1, 1),
(529, 'R002', 'Real Marketing Solutions', '14444444', 1, 1),
(530, 'R003', 'Royal Cotton Product', '14444444', 1, 1),
(531, 'R004', 'Rasasi Perfumes Industry', '14444444', 1, 1),
(532, 'R005', 'Fares - Rawabit Int\'l', '14444444', 1, 1),
(533, 'R006', 'Rotana Laundry', '14444444', 1, 1),
(534, 'R007', 'Regal\'s', '14444444', 1, 1),
(535, 'R008', 'Rawabi Al Furat Trading & Cont.', '14444444', 1, 1),
(536, 'R009', 'Rawoot Foods', '14444444', 1, 1),
(537, 'R010', 'Rio International', '14444444', 1, 1),
(538, 'R012', 'Robough Al Hofuf Trading', '14444444', 1, 1),
(539, 'R013', 'Riyadh Food Ind. Co.', '14444444', 1, 1),
(540, 'R014', 'Riz Industria Lda.', '14444444', 1, 1),
(541, 'R015', 'Royal Fisheries', '14444444', 1, 1),
(542, 'R016', 'Royal Meat Industry', '14444444', 1, 1),
(543, 'R017', 'Royal Crown Food Man.', '14444444', 1, 1),
(544, 'R018', 'Rayyan Mineral Water', '14444444', 1, 1),
(545, 'R019', 'RAG Foodstuff Trading', '14444444', 1, 1),
(546, 'R020', 'Refreshment Trading Company', '14444444', 1, 1),
(547, 'R021', 'Ralph Blackie & Associates', '14444444', 1, 1),
(548, 'R022', 'Repi Soap & Detergents S.C', '14444444', 1, 1),
(549, 'R023', 'Reckitt Benckiser', '14444444', 1, 1),
(550, 'R024', 'Reef Bakery', '14444444', 1, 1),
(551, 'R025', 'RTE Snacks cc - On the Go Fusion Snack', '14444444', 1, 1),
(552, 'R026', 'Rediet Food Complex', '14444444', 1, 1),
(553, 'R027', 'Rice Experts Enterprises', '14444444', 1, 1),
(554, 'S001', 'Sweets of Oman', '14444444', 1, 1),
(555, 'S002', 'Switz Int\'l Limited', '14444444', 1, 1),
(556, 'S003', 'Speciality Eng. - Spec', '14444444', 1, 1),
(557, 'S004', 'Salam Kazim Trading Establishment', '14444444', 1, 1),
(558, 'S005', 'Saadeddin Group', '14444444', 1, 1),
(559, 'S006', 'Saigol & Gulf Ltd.', '14444444', 1, 1),
(560, 'S007 - CH', 'IFFCO - Seville Products Co. - Chocolate', '14444444', 1, 1),
(561, 'S007 - PS', 'IFFCO - Seville Products Co. - Pasta', '14444444', 1, 1),
(562, 'S020 - FZ', 'IFFCO - Seville Products Co. - Frozen + Seafood', '14444444', 1, 1),
(563, 'S053 - SP', 'IFFCO - Seville Products Co. - Soap', '14444444', 1, 1),
(564, 'S053 - BV', 'IFFCO - Beverage Solutions', '14444444', 1, 1),
(565, 'S022', 'IFFCO - Shama Food Ind. - Spices', '14444444', 1, 1),
(566, 'S008', 'Star Foodstuff Manufacturing Company LLC', '14444444', 1, 1),
(567, 'S008-C', 'Classic Food Industries', '14444444', 1, 1),
(568, 'S009', 'Sopack / Inpackmo', '14444444', 1, 1),
(569, 'S010', 'Sayga Flour Mills - Celebrus Trading', '14444444', 1, 1),
(570, 'S011', 'Shahi Foods & Spices', '14444444', 1, 1),
(571, 'S012', 'Star Line Seeds', '14444444', 1, 1),
(572, 'S013', 'Siriana Foodstuff Manufacturing Co.LLC', '14444444', 1, 1),
(573, 'S014', 'Star Soap & Detergent Industries PLC.', '14444444', 1, 1),
(574, 'S015', 'Starcup Coffee Co.', '14444444', 1, 1),
(575, 'S016', 'Sharjah Dates Factory', '14444444', 1, 1),
(576, 'S017', 'Suliman Saleh Al Rasheed Co.', '14444444', 1, 1),
(577, 'S018', 'Saif Foodstuff Import & Export Est.', '14444444', 1, 1),
(578, 'S019', 'Seen Development Co.', '14444444', 1, 1),
(579, 'S021', 'Sweet Factory - Zakaria', '14444444', 1, 1),
(580, 'S023', 'Speciality Printers (Pvt.) Ltd.', '14444444', 1, 1),
(581, 'S024', 'Al Sahaba Int\'l Co. Ltd.', '14444444', 1, 1),
(582, 'S025', 'Al Sunbulah Group', '14444444', 1, 1),
(583, 'S026', 'Signature Snacks Company', '14444444', 1, 1),
(584, 'S027', 'Spectrum Int\'l Fzc.', '14444444', 1, 1),
(585, 'S028', 'Sweetos L.D.A', '14444444', 1, 1),
(586, 'S029', 'Les Moulins Sosemie', '14444444', 1, 1),
(587, 'S030', 'Safeer Group', '14444444', 1, 1),
(588, 'S031', 'Super Snacks - Super Chicken', '14444444', 1, 1),
(589, 'S032', 'SUZ International Food Brands', '14444444', 1, 1),
(590, 'S033', 'Sixth Element', '14444444', 1, 1),
(591, 'S034', 'Silver Plate Factory', '14444444', 1, 1),
(592, 'S035', 'S.I.P.A', '14444444', 1, 1),
(593, 'S036', 'Societe Sibed SARL', '14444444', 1, 1),
(594, 'S037', 'Sky Packing', '14444444', 1, 1),
(595, 'S038', 'Sultan Triveni', '14444444', 1, 1),
(596, 'S039', 'Behshahr Industrial Co. Savola Group', '14444444', 1, 1),
(597, 'S040', 'Star Line', '14444444', 1, 1),
(598, 'S041', 'Salim Saleh Abdulla', '14444444', 1, 1),
(599, 'S042', 'United Sugar Company - Savola Group', '14444444', 1, 1),
(600, 'S043', 'Safa Food Trading', '14444444', 1, 1),
(601, 'S044', '7D Food Factory PLC', '14444444', 1, 1),
(602, 'S045', 'Shurook Factory for W.&J.', '14444444', 1, 1),
(603, 'S046', 'Sharjah Co-op Society', '14444444', 1, 1),
(604, 'S047', 'Shahrazad Foodstuff Co.', '14444444', 1, 1),
(605, 'S048', 'Safitex General Trading', '14444444', 1, 1),
(606, 'S049', 'Shangrila Pvt. Ltd.', '14444444', 1, 1),
(607, 'S050', 'Strategic Food Int\'l', '14444444', 1, 1),
(608, 'S051', 'Savola Edible Oil', '14444444', 1, 1),
(609, 'S052', 'Saravana Foodstuff', '14444444', 1, 1),
(610, 'S053', 'Star Food Industries FZC', '14444444', 1, 1),
(611, 'S056', 'Sardoba Food Industries', '14444444', 1, 1),
(612, 'S057', 'Salalah Macaroni Co. SAOG', '14444444', 1, 1),
(613, 'S058', 'Sarwana & Sohzshim', '14444444', 1, 1),
(614, 'S059', 'The Searle Company Limited', '14444444', 1, 1),
(615, 'S060', 'Sharmeen Foods Pvt. Ltd.', '14444444', 1, 1),
(616, 'S061', 'Sona Roastery', '14444444', 1, 1),
(617, 'S062', 'Sintayehu Mulatu Flour & Biscuit Factory - Sayem Food Complex', '14444444', 1, 1),
(618, 'S063', 'Simply Fresh Roastery LLC', '14444444', 1, 1),
(619, 'S064', 'Shawaf Group for Industry & Commerce Ltd.', '14444444', 1, 1),
(620, 'T001', 'IFFCO - Tiffany Foods Ltd. - Biscuits', '14444444', 1, 1),
(621, 'T002', 'The Saudi Ice Cream Factory Co. Kwality', '14444444', 1, 1),
(622, 'T003', 'Trempak Trading (Pty.) Ltd.', '14444444', 1, 1),
(623, 'T004', 'Tyler Packaging Ltd.', '14444444', 1, 1),
(624, 'T005', 'Talal Hassan Foodstuff', '14444444', 1, 1),
(625, 'T007', 'Tasty Foods PLC', '14444444', 1, 1),
(626, 'T008', 'Trade Synergies LLC', '14444444', 1, 1),
(627, 'T009', 'Tag El Melouk Food Ind.', '14444444', 1, 1),
(628, 'T010', 'Talal Supermarket', '14444444', 1, 1),
(629, 'T011', 'Trofina Foods Middle East', '14444444', 1, 1),
(630, 'T012', 'Tulip of Yemen Int\'l Trdg. Co', '14444444', 1, 1),
(631, 'T013', 'SARL Traveps', '14444444', 1, 1),
(632, 'T014', 'Tayseer Arar Industry of Dairy Products LLC', '14444444', 1, 1),
(633, 'T015', 'The Himalaya Drug Company FZCO', '14444444', 1, 1),
(634, 'T016', 'Quality Wipes LLC', '14444444', 1, 1),
(635, 'T017', 'Tendaybelt General Trading P.L.C', '14444444', 1, 1),
(636, 'T018', 'The Oromia Coffee Farmers Co-Operative Union', '14444444', 1, 1),
(637, 'U001', 'United Food Ind. Corp.- PRIDE', '14444444', 1, 1),
(638, 'U002', 'United Kaipara - Unikai', '14444444', 1, 1),
(639, 'U002-B', 'United Foods Company PJSC', '14444444', 1, 1),
(640, 'U003', 'IFFCO - Unipex Dairy Product - Dry Grains', '14444444', 1, 1),
(641, 'U004', 'United Coffee - Mochachino Est.', '14444444', 1, 1),
(642, 'U005', 'United Fisheries of Kuwait', '14444444', 1, 1),
(643, 'U006', 'United Food - Aseel', '14444444', 1, 1),
(644, 'U007', 'Uniline Trading', '14444444', 1, 1),
(645, 'U008', 'Ultra Care', '14444444', 1, 1),
(646, 'U009', 'United Packaging Factory', '14444444', 1, 1),
(647, 'U010', 'Universal Islamic Meat / Flexibles', '14444444', 1, 1),
(648, 'U011', 'United Snack Foods Co. (Al Rahabi)', '14444444', 1, 1),
(649, 'U012', 'Unipack (Fzc)', '14444444', 1, 1),
(650, 'U013', 'Union Beverages', '14444444', 1, 1),
(651, 'U014', 'United Food Ind.Corp. - Deemah', '14444444', 1, 1),
(652, 'U015', 'United Int\'l Trdg. - Qatar', '14444444', 1, 1),
(653, 'U016', 'United Product - Sweetex', '14444444', 1, 1),
(654, 'U017', 'United Foodstuff Ind. Group', '14444444', 1, 1),
(655, 'U018', 'Unilever Gulf FZE', '14444444', 1, 1),
(656, 'U019', 'Universal Cold Store for Food Products - Meat Factory', '14444444', 1, 1),
(657, 'U020', 'Unibisco Biscuit S.A. (Pty.) Ltd.', '14444444', 1, 1),
(658, 'V001', 'Pan Gulf Food Co. - Vita Food', '14444444', 1, 1),
(659, 'V002', 'Pasgianos Food & Beverage Co. Ltd.', '14444444', 1, 1),
(660, 'V003', 'Visions Corporation FZC', '14444444', 1, 1),
(661, 'W001', 'West Zone Group', '14444444', 1, 1),
(662, 'W002', 'White House Perfume', '14444444', 1, 1),
(663, 'W003', 'Wafra International', '14444444', 1, 1),
(664, 'W004', 'Wardat Store', '14444444', 1, 1),
(665, 'W005', 'Walid Commercial Project', '14444444', 1, 1),
(666, 'W006', 'Windsor Foodstuff', '14444444', 1, 1),
(667, 'W007', 'Wilsons Pet Food', '14444444', 1, 1),
(668, 'X001', 'X-Calibur Construction', '14444444', 1, 1),
(669, 'Y001', 'Yoyo Foods Ltd.', '14444444', 1, 1),
(670, 'Y002', 'Yemen Company For Industry & Commerce - Y.C.I.C', '14444444', 1, 1),
(671, 'Y003', 'Young\'s Private Ltd.', '14444444', 1, 1),
(672, 'Y004', 'Yemen Company For Ghee & Soap Industry - Y.C.G.S.I', '14444444', 1, 1),
(673, 'Y005', 'Yemen Snacks Foods Co. (Al Aqil Group)', '14444444', 1, 1),
(674, 'Y006', 'Yatooq Trading Est.', '14444444', 1, 1),
(675, 'Y007', 'Yank Snacks (Pty.) Ltd/', '14444444', 1, 1),
(676, 'Y008', 'Yaumi International Bakeries', '14444444', 1, 1),
(677, 'Z001', 'Zowayed Plastic', '14444444', 1, 1),
(678, 'Z002', 'Zest Restaurant', '14444444', 1, 1),
(679, 'Z003', 'Zilgo Int\'l', '14444444', 1, 1),
(680, 'Z004', 'Zarouni Foods', '14444444', 1, 1),
(681, 'Z005', 'Zood Foods', '14444444', 1, 1),
(682, 'Z006', 'Zamil Food Industries Co. Ltd.', '14444444', 1, 1),
(683, 'Z007', 'Ziwa Wet Wipes FZCO', '14444444', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `conditional_release_identity`
--

DROP TABLE IF EXISTS `conditional_release_identity`;
CREATE TABLE IF NOT EXISTS `conditional_release_identity` (
  `crd_id` int(4) NOT NULL AUTO_INCREMENT,
  `crd_text` varchar(40) NOT NULL,
  PRIMARY KEY (`crd_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conditional_release_identity`
--

INSERT INTO `conditional_release_identity` (`crd_id`, `crd_text`) VALUES
(1, 'Requesting Conditional Release'),
(2, 'Conditional Release Approved'),
(3, 'Conditional Release Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `conditional_release_reason`
--

DROP TABLE IF EXISTS `conditional_release_reason`;
CREATE TABLE IF NOT EXISTS `conditional_release_reason` (
  `crr_id` int(10) NOT NULL AUTO_INCREMENT,
  `crr_value` varchar(50) NOT NULL,
  `crr_show` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`crr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conditional_release_reason`
--

INSERT INTO `conditional_release_reason` (`crr_id`, `crr_value`, `crr_show`) VALUES
(1, 'Advance not recieved', 1),
(2, 'LC Not Recieved', 1),
(3, 'Bank Contract', 1),
(4, 'Credit Note', 1),
(5, 'Overdue Pending', 1),
(6, 'Overdue Short Payment', 1),
(7, 'Credit Limit Exceeded', 1),
(8, 'Purcahse Order Missing Information', 1),
(9, 'Pre-Costing not approved', 1),
(10, 'RFP  Details Missing', 1),
(11, 'Missing Company Legal Document', 1),
(12, 'Trim Loss / Cylinder Re-Engraving / Tool Cost', 1),
(13, 'Freight Loss / Revised PO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `conditional_release_wo`
--

DROP TABLE IF EXISTS `conditional_release_wo`;
CREATE TABLE IF NOT EXISTS `conditional_release_wo` (
  `crw_id` int(50) NOT NULL AUTO_INCREMENT,
  `crw_wo_ref` int(50) NOT NULL,
  `crw_crr_id` int(50) DEFAULT NULL,
  `crw_reason` varchar(50) NOT NULL,
  `crw_ncr` varchar(50) DEFAULT NULL,
  `crw_lum_id` int(50) NOT NULL,
  `crw_dnt` varchar(100) NOT NULL,
  `crw_status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`crw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logcat_main`
--

DROP TABLE IF EXISTS `logcat_main`;
CREATE TABLE IF NOT EXISTS `logcat_main` (
  `logcat_id` int(15) NOT NULL AUTO_INCREMENT,
  `logcat_lum_id` int(15) NOT NULL,
  `logcat_page` varchar(36) NOT NULL,
  `logcat_session_hash` varchar(36) NOT NULL,
  `logcat_ip` varchar(100) NOT NULL,
  `logcat_text` text NOT NULL,
  `logcat_dnt` varchar(100) NOT NULL,
  PRIMARY KEY (`logcat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logcat_main`
--

INSERT INTO `logcat_main` (`logcat_id`, `logcat_lum_id`, `logcat_page`, `logcat_session_hash`, `logcat_ip`, `logcat_text`, `logcat_dnt`) VALUES
(1, 1, 'SalesWorkOrderSubmit.php', 'IPPSESSID6093b00536be3', '127.0.0.1', 'SU-1 added sales order with REF: 8000 ID: 1', '1620291611'),
(2, 1, 'SalesWorkOrderSubmit.php', 'IPPSESSID6093b00536be3', '127.0.0.1', 'SU-1 edited sales order with REF: 8000 ID: 2', '1620292389'),
(3, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID6093b00536be3', '127.0.0.1', 'SU-1 published sales order with REF: 8000 ID: NA to sales verification', '1620306460'),
(4, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID6093b00536be3', '127.0.0.1', 'SU-1 verified sales order with REF: 8000 ID: NA and sent it to accounts', '1620306466'),
(5, 1, 'SalesWorkOrderSubmit.php', 'IPPSESSID6093b00536be3', '127.0.0.1', 'SU-1 added sales order with REF: 8001 ID: 5', '1620307108'),
(6, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID6093b00536be3', '127.0.0.1', 'SU-1 published sales order with REF: 8001 ID: NA to sales verification', '1620307114'),
(7, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID6093b00536be3', '127.0.0.1', 'SU-1 verified sales order with REF: 8001 ID: NA and sent it to accounts', '1620307120'),
(8, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID6093b00536be3', '127.0.0.1', 'SU-1 published sales order with REF: 8001 ID: NA to Technical', '1620307130'),
(9, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID6093b00536be3', '127.0.0.1', 'SU-1 published work order with REF: 8001 ID: NA to technical VERIFICATION', '1620307143'),
(10, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID6093b00536be3', '127.0.0.1', 'SU-1 verified and published a work order with REF: 8001 ID: NA for all to view', '1620307150'),
(11, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID6093b00536be3', '127.0.0.1', 'SU-1 marked work order with REF: 8001 ID: NA as complete ', '1620307176'),
(12, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID6099182f57532', '127.0.0.1', 'SU-1 verified sales order with REF: 8001 ID: NA and sent it to accounts', '1620651524'),
(13, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID6099182f57532', '127.0.0.1', 'SU-1 published sales order with REF: 8005 ID: NA to sales verification', '1620733827'),
(14, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID6099182f57532', '127.0.0.1', 'SU-1 published work order with REF: 8011 ID: NA to technical VERIFICATION', '1620758903'),
(15, 1, 'AmendmentSalesController.php', 'IPPSESSID609af8b3ccbe2', '127.0.0.1', 'Amendment form for REF: 8011 with ID: 27 has been generated by SU-1', '1620771191'),
(16, 1, 'AmendmentSalesController.php', 'IPPSESSID609af8b3ccbe2', '127.0.0.1', 'Amendment form for REF: 8011 with ID: 27 has been edited by SU-1', '1620771213'),
(17, 1, 'AmendmentFormController.php', 'IPPSESSID609af8b3ccbe2', '127.0.0.1', 'SU-1 - SUPERUSER has published amendment form with ID: 27 and REF:8011', '1620771222'),
(18, 1, 'AmendmentFormController.php', 'IPPSESSID609af8b3ccbe2', '127.0.0.1', 'SU-1 - SUPERUSER rejected amendment form with ID: 28 and REF:8011 reason :NONONO STATUS (2, 3)', '1620771342'),
(19, 1, 'AmendmentFormController.php', 'IPPSESSID609af8b3ccbe2', '127.0.0.1', 'SU-1 - SUPERUSER has published amendment form with ID: 26 and REF:8010 STATUS (9, 2)', '1620771356');

-- --------------------------------------------------------

--
-- Table structure for table `master_work_order_main`
--

DROP TABLE IF EXISTS `master_work_order_main`;
CREATE TABLE IF NOT EXISTS `master_work_order_main` (
  `master_wo_id` int(11) NOT NULL AUTO_INCREMENT,
  `master_wo_ref` int(11) NOT NULL,
  `master_wo_2_client_id` varchar(100) DEFAULT NULL,
  `master_wo_m_lwo` varchar(10) DEFAULT NULL,
  `master_wo_extra_ccr` varchar(50) DEFAULT NULL,
  `master_wo_extra_ncr` varchar(50) DEFAULT NULL,
  `master_wo_extra_print_end_ops` varchar(50) DEFAULT NULL,
  `master_wo_2_partial_delivery` int(3) DEFAULT NULL,
  `master_wo_rfp_no` varchar(15) DEFAULT NULL,
  `master_wo_rfp_date` varchar(10) DEFAULT NULL,
  `master_wo_customer_design_name` varchar(100) DEFAULT NULL,
  `master_wo_customer_item_code` varchar(100) DEFAULT NULL,
  `master_wo_customer_po` varchar(100) DEFAULT NULL,
  `master_wo_po_date` varchar(100) DEFAULT NULL,
  `master_wo_delivery_date` varchar(100) DEFAULT NULL,
  `master_wo_3_customer_loc` varchar(100) DEFAULT NULL,
  `master_wo_2_sales_id` varchar(100) DEFAULT NULL,
  `master_wo_2_structure` varchar(100) DEFAULT NULL,
  `master_wo_2_type_printed` varchar(100) DEFAULT NULL,
  `master_wo_2_lsd_required` int(3) DEFAULT NULL,
  `master_wo_lsd_copies` varchar(10) DEFAULT NULL,
  `master_wo_ink_gsm_pre_c` varchar(100) DEFAULT NULL,
  `master_wo_2_application` varchar(100) DEFAULT NULL,
  `master_wo_2_roll_fill_opts` varchar(100) DEFAULT NULL,
  `master_wo_2_pouchbag_fillops` varchar(100) DEFAULT NULL,
  `master_wo_2_fill_temp` varchar(100) DEFAULT NULL,
  `master_wo_submersion_duration` varchar(100) DEFAULT NULL,
  `master_wo_submersion_temp` varchar(20) DEFAULT NULL,
  `master_wo_fill_temp` varchar(100) DEFAULT NULL,
  `master_wo_line_speed` varchar(100) DEFAULT NULL,
  `master_wo_dwell_time` varchar(100) DEFAULT NULL,
  `master_wo_seal_temp` varchar(100) DEFAULT NULL,
  `master_wo_design_id` varchar(100) DEFAULT NULL,
  `master_wo_rev_no` varchar(100) DEFAULT NULL,
  `master_wo_2_coating_options` varchar(50) DEFAULT NULL,
  `master_wo_coating_gsm` varchar(50) DEFAULT NULL,
  `master_wo_approved_sample_wo_no` varchar(100) DEFAULT NULL,
  `master_wo_pack_weight` varchar(100) DEFAULT NULL,
  `master_wo_2_pack_weight_unit` varchar(100) DEFAULT NULL,
  `master_wo_quantity` varchar(100) DEFAULT NULL,
  `master_wo_2_units` varchar(100) DEFAULT NULL,
  `master_wo_quantity_tolerance` varchar(100) DEFAULT NULL,
  `master_wo_2_laser_config` varchar(100) DEFAULT NULL,
  `master_wo_layer_1_micron` varchar(20) DEFAULT NULL,
  `master_wo_layer_1_structure` varchar(20) DEFAULT NULL,
  `master_wo_layer_2_micron` varchar(20) DEFAULT NULL,
  `master_wo_layer_2_structure` varchar(20) DEFAULT NULL,
  `master_wo_layer_3_micron` varchar(20) DEFAULT NULL,
  `master_wo_layer_3_structure` varchar(20) DEFAULT NULL,
  `master_wo_layer_4_micron` varchar(20) DEFAULT NULL,
  `master_wo_layer_4_structure` varchar(20) DEFAULT NULL,
  `master_wo_layer_5_micron` varchar(20) DEFAULT NULL,
  `master_wo_layer_5_structure` varchar(20) DEFAULT NULL,
  `master_wo_adh1` varchar(20) DEFAULT NULL,
  `master_wo_adh2` varchar(20) DEFAULT NULL,
  `master_wo_adh3` varchar(20) DEFAULT NULL,
  `master_wo_adh4` varchar(20) DEFAULT NULL,
  `master_wo_ply` varchar(100) DEFAULT NULL,
  `master_wo_cof_val` varchar(20) DEFAULT NULL,
  `master_wo_total_gsm` varchar(100) DEFAULT NULL,
  `master_wo_total_gsm_tolerance` varchar(100) DEFAULT NULL,
  `master_wo_2_wind_dir` varchar(100) DEFAULT NULL,
  `master_wo_roll_od` varchar(100) DEFAULT NULL,
  `master_wo_roll_width` varchar(100) DEFAULT NULL,
  `master_wo_roll_cutoff_len` varchar(100) DEFAULT NULL,
  `master_wo_max_w_p_r` varchar(100) DEFAULT NULL,
  `master_wo_max_lmtr_p_r` varchar(100) DEFAULT NULL,
  `master_wo_max_imps_p_r` varchar(100) DEFAULT NULL,
  `master_wo_2_slitting_core_id` varchar(100) DEFAULT NULL,
  `master_wo_2_slitting_core_material` varchar(100) DEFAULT NULL,
  `master_wo_2_slitting_core_plugs` varchar(100) DEFAULT NULL,
  `master_wo_2_slitting_qc_ins` varchar(100) DEFAULT NULL,
  `master_wo_max_joints` varchar(100) DEFAULT NULL,
  `master_wo_remarks_roll` varchar(100) DEFAULT NULL,
  `master_wo_2_pouch_master` int(12) DEFAULT NULL,
  `master_wo_2_pouch_perforation` int(3) DEFAULT NULL,
  `master_wo_pouch_perforation_distance_top` varchar(10) DEFAULT NULL,
  `master_wo_pouch_distance_top_extra` varchar(10) DEFAULT NULL,
  `master_wo_2_pouch_punch_type` int(15) DEFAULT NULL,
  `master_wo_2_pouch_euro_punch` int(2) DEFAULT NULL,
  `master_wo_2_pouch_round_corner` int(2) DEFAULT NULL,
  `master_wo_2_pouch_zipper` int(2) DEFAULT NULL,
  `master_wo_2_pouch_zipper_opc` int(2) DEFAULT NULL,
  `master_wo_pouch_top_dist` varchar(25) DEFAULT NULL,
  `master_wo_2_pouch_pestrip` int(2) DEFAULT NULL,
  `master_wo_2_pouch_tear_notch` int(2) DEFAULT NULL,
  `master_wo_2_pouch_tear_notch_qty` int(2) DEFAULT NULL,
  `master_wo_2_pouch_tear_notch_side` int(2) DEFAULT NULL,
  `master_wo_pouch_values` varchar(500) DEFAULT NULL,
  `master_wo_3_pouch_lap_fin` varchar(100) DEFAULT NULL,
  `master_wo_remarks_pouch` varchar(100) DEFAULT NULL,
  `master_wo_2_bag_type` int(12) DEFAULT NULL,
  `master_wo_bags_distance_top_extra` varchar(10) DEFAULT NULL,
  `master_wo_2_bags_handle` int(2) DEFAULT NULL,
  `master_wo_bags_top_fold` varchar(155) DEFAULT NULL,
  `master_wo_bags_flap` varchar(155) DEFAULT NULL,
  `master_wo_bags_lip` varchar(155) DEFAULT NULL,
  `master_wo_bags_values` varchar(500) DEFAULT NULL,
  `master_wo_remarks_bags` varchar(100) DEFAULT NULL,
  `master_wo_2_foil_print_side` varchar(100) DEFAULT NULL,
  `master_wo_2_printing_method` varchar(100) DEFAULT NULL,
  `master_wo_2_printing_shade_card_needed` varchar(100) DEFAULT NULL,
  `master_wo_2_printing_color_ref_type` varchar(100) DEFAULT NULL,
  `master_wo_2_printing_approvalby` varchar(100) DEFAULT NULL,
  `master_wo_2_roll_pack_ins` varchar(100) DEFAULT NULL,
  `master_wo_2_carton_pack_ins` varchar(100) DEFAULT NULL,
  `master_wo_2_pallet_mark_ins` varchar(100) DEFAULT NULL,
  `master_wo_pouch_per_bund` varchar(100) DEFAULT NULL,
  `master_wo_bund_per_box` varchar(100) DEFAULT NULL,
  `master_wo_2_pallet_type` varchar(100) DEFAULT NULL,
  `master_wo_2_cont_stuff` varchar(100) DEFAULT NULL,
  `master_wo_max_gross_pallet_weight` varchar(100) DEFAULT NULL,
  `master_wo_2_pallet_dim` varchar(100) DEFAULT NULL,
  `master_wo_2_freight_type` varchar(100) DEFAULT NULL,
  `master_wo_ship_port_name` varchar(25) DEFAULT NULL,
  `master_wo_cart_thick` varchar(100) DEFAULT NULL,
  `master_wo_3_docs` varchar(100) DEFAULT NULL,
  `master_wo_gen_dnt` varchar(100) NOT NULL,
  `master_wo_gen_lum_id` varchar(100) NOT NULL,
  `master_reject_text` text,
  `master_wo_status` int(1) DEFAULT '1',
  PRIMARY KEY (`master_wo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_work_order_main`
--

INSERT INTO `master_work_order_main` (`master_wo_id`, `master_wo_ref`, `master_wo_2_client_id`, `master_wo_m_lwo`, `master_wo_extra_ccr`, `master_wo_extra_ncr`, `master_wo_extra_print_end_ops`, `master_wo_2_partial_delivery`, `master_wo_rfp_no`, `master_wo_rfp_date`, `master_wo_customer_design_name`, `master_wo_customer_item_code`, `master_wo_customer_po`, `master_wo_po_date`, `master_wo_delivery_date`, `master_wo_3_customer_loc`, `master_wo_2_sales_id`, `master_wo_2_structure`, `master_wo_2_type_printed`, `master_wo_2_lsd_required`, `master_wo_lsd_copies`, `master_wo_ink_gsm_pre_c`, `master_wo_2_application`, `master_wo_2_roll_fill_opts`, `master_wo_2_pouchbag_fillops`, `master_wo_2_fill_temp`, `master_wo_submersion_duration`, `master_wo_submersion_temp`, `master_wo_fill_temp`, `master_wo_line_speed`, `master_wo_dwell_time`, `master_wo_seal_temp`, `master_wo_design_id`, `master_wo_rev_no`, `master_wo_2_coating_options`, `master_wo_coating_gsm`, `master_wo_approved_sample_wo_no`, `master_wo_pack_weight`, `master_wo_2_pack_weight_unit`, `master_wo_quantity`, `master_wo_2_units`, `master_wo_quantity_tolerance`, `master_wo_2_laser_config`, `master_wo_layer_1_micron`, `master_wo_layer_1_structure`, `master_wo_layer_2_micron`, `master_wo_layer_2_structure`, `master_wo_layer_3_micron`, `master_wo_layer_3_structure`, `master_wo_layer_4_micron`, `master_wo_layer_4_structure`, `master_wo_layer_5_micron`, `master_wo_layer_5_structure`, `master_wo_adh1`, `master_wo_adh2`, `master_wo_adh3`, `master_wo_adh4`, `master_wo_ply`, `master_wo_cof_val`, `master_wo_total_gsm`, `master_wo_total_gsm_tolerance`, `master_wo_2_wind_dir`, `master_wo_roll_od`, `master_wo_roll_width`, `master_wo_roll_cutoff_len`, `master_wo_max_w_p_r`, `master_wo_max_lmtr_p_r`, `master_wo_max_imps_p_r`, `master_wo_2_slitting_core_id`, `master_wo_2_slitting_core_material`, `master_wo_2_slitting_core_plugs`, `master_wo_2_slitting_qc_ins`, `master_wo_max_joints`, `master_wo_remarks_roll`, `master_wo_2_pouch_master`, `master_wo_2_pouch_perforation`, `master_wo_pouch_perforation_distance_top`, `master_wo_pouch_distance_top_extra`, `master_wo_2_pouch_punch_type`, `master_wo_2_pouch_euro_punch`, `master_wo_2_pouch_round_corner`, `master_wo_2_pouch_zipper`, `master_wo_2_pouch_zipper_opc`, `master_wo_pouch_top_dist`, `master_wo_2_pouch_pestrip`, `master_wo_2_pouch_tear_notch`, `master_wo_2_pouch_tear_notch_qty`, `master_wo_2_pouch_tear_notch_side`, `master_wo_pouch_values`, `master_wo_3_pouch_lap_fin`, `master_wo_remarks_pouch`, `master_wo_2_bag_type`, `master_wo_bags_distance_top_extra`, `master_wo_2_bags_handle`, `master_wo_bags_top_fold`, `master_wo_bags_flap`, `master_wo_bags_lip`, `master_wo_bags_values`, `master_wo_remarks_bags`, `master_wo_2_foil_print_side`, `master_wo_2_printing_method`, `master_wo_2_printing_shade_card_needed`, `master_wo_2_printing_color_ref_type`, `master_wo_2_printing_approvalby`, `master_wo_2_roll_pack_ins`, `master_wo_2_carton_pack_ins`, `master_wo_2_pallet_mark_ins`, `master_wo_pouch_per_bund`, `master_wo_bund_per_box`, `master_wo_2_pallet_type`, `master_wo_2_cont_stuff`, `master_wo_max_gross_pallet_weight`, `master_wo_2_pallet_dim`, `master_wo_2_freight_type`, `master_wo_ship_port_name`, `master_wo_cart_thick`, `master_wo_3_docs`, `master_wo_gen_dnt`, `master_wo_gen_lum_id`, `master_reject_text`, `master_wo_status`) VALUES
(1, 8000, '381', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KITCO BITES CHEDDAR CHEESE BALLS POLYBAG BLUE BG', '4960210040000007', '26-2231', '1618906200', '1622362200', '1,2', '11', '1', '1', NULL, NULL, '2.80', '27', NULL, NULL, '2', NULL, NULL, '25', '15', '', '', 'D04371', '0', '6', '0', '31593', '', '1', '1000', '1', '10', NULL, '65', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '67.20', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 6, '', '50', '', '{\"5\":\"565\",\"6\":\"450\",\"7\":\"120\"}', NULL, NULL, '2', '2', '3', '7', NULL, '4', '4', '', '', '1', '2', '1000', '1', '1', NULL, '3', '2,3,4,6,12', '1619438579', '11', NULL, 1),
(2, 8000, '381', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KITCO BITES CHEDDAR CHEESE BALLS POLYBAG BLUE BG', '4960210040000007', '26-2231', '1618906200', '1622362200', '1,2', '11', '1', '1', NULL, NULL, '2.80', '27', NULL, NULL, '2', NULL, NULL, '25', '15', '', '', 'D04371', '0', '6', '0', '31593', '', '1', '1000', '1', '10', NULL, '65', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '67.20', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 6, '', '50', '', '{\"5\":\"565\",\"6\":\"450\",\"7\":\"120\"}', NULL, NULL, '2', '2', '3', '7', NULL, '4', '4', '', '', '1', '2', '1000', '1', '1', NULL, '3', '2,3,4,6,12', '1619438596', '11', NULL, 2),
(3, 8001, '655', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Shrink Fil 680mm TSM DOVE SH-CD', '32713161', '4520453485', '1618387800', '1620807000', '1', '12', '3', '2', NULL, NULL, NULL, '27', '1', NULL, '2', NULL, NULL, '', '20', '', '', '', '0', '6', '', 'N/A', '500', '2', '2000', '1', '10', '9', '50', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '46', '5', '1', '600', '680', 'N/A', '', '', '', '2', '1', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2', '1', '1', NULL, '4', NULL, NULL, '4', '1', '400', '1', '5', NULL, '3', '2,3,4,11', '1619438777', '12', NULL, 1),
(4, 8002, '585', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sweetos Coconut Candy Inner', '', '02-2021', '1618042200', '1622362200', '1,3', '13', '3', '1', NULL, NULL, '1.9', '24', '10', NULL, '1', NULL, NULL, '', '', '', '', '1844', '0', '6', '', '', '', '1', '1000', '1', '0', '9', '12', '1', '20', '40', NULL, NULL, NULL, NULL, NULL, NULL, '2.2', NULL, NULL, NULL, '2', '', '', '', '5', '', '75', '54', '5', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '1', NULL, '3', '2,3,6', '1619438788', '13', NULL, 1),
(5, 8001, '655', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Shrink Fil 680mm TSM DOVE SH-CD', '32713161', '4520453485', '1618387800', '1620807000', '1', '12', '3', '2', NULL, NULL, NULL, '27', '1', NULL, '2', NULL, NULL, '', '20', '', '', '', '0', '6', '', 'N/A', '500', '2', '2000', '1', '10', '9', '50', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '46', '5', '1', '600', '680', 'N/A', '', '', '', '2', '1', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2', '1', '1', NULL, '4', NULL, NULL, '4', '1', '400', '1', '5', NULL, '3', '2,3,4,11', '1619438892', '12', NULL, 2),
(6, 8002, '585', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sweetos Coconut Candy Inner', '', '02-2021', '1618042200', '1622362200', '1,3', '13', '3', '1', NULL, NULL, '1.9', '24', '10', NULL, '1', NULL, NULL, '', '', '', '', '1844', '0', '6', '', '', '', '1', '1000', '1', '0', '9', '12', '1', '20', '40', NULL, NULL, NULL, NULL, NULL, NULL, '2.2', NULL, NULL, NULL, '2', '', '', '', '5', '', '75', '54', '5', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '1', NULL, '3', '2,3,6', '1619439017', '13', NULL, 1),
(7, 8002, '585', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sweetos Coconut Candy Inner', '', '02-2021', '1618042200', '1622362200', '1,3', '13', '3', '1', NULL, NULL, '1.9', '24', '10', NULL, '1', NULL, NULL, '', '', '', '', '1844', '0', '6', '', '', '', '1', '1000', '1', '0', '9', '12', '1', '20', '40', NULL, NULL, NULL, NULL, NULL, NULL, '2.2', NULL, NULL, NULL, '2', '', '', '', '5', '', '75', '54', '5', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '1', NULL, '3', '2,3,6', '1619439028', '13', NULL, 2),
(8, 8003, '482', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SENORAH NACHOS CORN TORTILLA CHIPS TRIANGLES 200GM', 'NIL', '5255', '1619251800', '1621930200', '1,2', '10', '3', '1', NULL, NULL, '2.4', '28', '2', NULL, '2', NULL, NULL, '25', '38', '1.5 SECONDS', '130', 'D05758', '0', '2', '0', '47530', '200', '2', '3200', '1', '5', '9', '20', '6', '12', '2', '40', '4', NULL, NULL, NULL, NULL, '1.8', '1.5', NULL, NULL, '3', '', '78.22', '2', '10', '', '460', '330', '20', '', '', '2', '1', '2', '9', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '2', '1000', '1', '1', NULL, '3', '2,3,4,6', '1619439205', '10', NULL, 1),
(9, 8003, '482', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SENORAH NACHOS CORN TORTILLA CHIPS TRIANGLES 200GM', 'NIL', '5255', '1619251800', '1621930200', '1,2', '10', '3', '1', NULL, NULL, '2.4', '28', '2', NULL, '2', NULL, NULL, '25', '38', '1.5 SECONDS', '130', 'D05758', '0', '2', '0', '47530', '200', '2', '3200', '1', '5', '9', '20', '6', '12', '2', '40', '4', NULL, NULL, NULL, NULL, '1.8', '1.5', NULL, NULL, '3', '', '78.22', '2', '10', '', '460', '330', '20', '', '', '2', '1', '2', '9', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '2', '1000', '1', '1', NULL, '3', '2,3,4,6', '1619439218', '10', NULL, 2),
(10, 8000, '381', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KITCO BITES CHEDDAR CHEESE BALLS POLYBAG BLUE BG', '4960210040000007', '26-2231', '1618906200', '1622362200', '1,2', '11', '1', '1', NULL, NULL, '2.80', '27', NULL, NULL, '2', NULL, NULL, '25', '15', '', '', 'D04371', '0', '6', '0', '31593', '', '1', '1000', '1', '10', NULL, '65', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '67.20', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 6, '', '50', '', '{\"5\":\"565\",\"6\":\"450\",\"7\":\"120\"}', NULL, NULL, '2', '2', '3', '7', NULL, '4', '4', '', '', '1', '2', '1000', '1', '1', NULL, '3', '2,3,4,6,12', '1619439283', '11', NULL, 4),
(11, 8004, '316', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW BAYARA 410X255MM - GREEN', 'PMFI0158', 'PO 038715-1', '1618474200', '1619683800', '1', '3', '3', '1', NULL, NULL, '1.9', '28', '10', NULL, '1', NULL, NULL, '', '', '', '', 'D05590', '0', '6', '', '', '', '1', '1000', '1', '0.1', '9', '12', '1', '100', '4', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2', '', '2', '0', '3', '', '410', '255', '22', '', '', '2', '1', '2', '6', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '2', '7', '1', NULL, '3', NULL, NULL, '1', '2', '', '1', '4', NULL, '3', '2,3,11', '1619439582', '6', NULL, 1),
(12, 8005, '273', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Raja Vegetable 15gm', '', 'SF-PO-21-00050', '1610698200', '1621066200', '2', '8', '3', '1', NULL, NULL, '1.8', '28', '10', NULL, '2', NULL, NULL, '', '', '', '', '7777', '1', '6', '', '', '', '1', '1000', '1', '10', '9', '30', '6', '25', '14', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2', '', '44.25', '', '3', '', '300', '180', '20', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '4', NULL, '3', '2,4,6', '1619510617', '8', NULL, 1),
(13, 8006, '683', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Unprinted Laminated 360mm Roll', '', 'Sample', '1619424600', '1620115800', '1', '5', '3', '2', NULL, NULL, NULL, '25', '10', NULL, '1', NULL, NULL, '', '', '', '', '', '0', '6', '', '', '', '1', '10', '1', '0', '9', '20', '7', '12', '21', '40', '21', NULL, NULL, NULL, NULL, '2', '1.6', NULL, NULL, '3', '', '', '', '1', '', '', '', '10', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2', '1', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '5', NULL, '3', '2', '1619518371', '6', NULL, 1),
(14, 8007, '253', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MACARONI VERDA PASTA 400GM ROLL WITH ALERGEN WARNING - UN ROLL', '', 'PO 09125', '1619338200', '1620375000', '1', '5', '3', '1', NULL, NULL, '1.6', '28', '10', NULL, '1', NULL, NULL, '', '', '', '', 'D04026', '0', '6', '', '46212', '', '1', '1000', '1', '10', '9', '20', '6', '30', '13', NULL, NULL, NULL, NULL, NULL, NULL, '1.6', NULL, NULL, NULL, '2', '', '48.9', '5', '4', '', '345', '250', '20', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '2', '', '1', '5', NULL, '3', '3', '1619520015', '6', NULL, 1),
(15, 8007, '253', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MACARONI VERDA PASTA 400GM ROLL WITH ALERGEN WARNING - UN ROLL', '', 'PO 09125', '1619338200', '1620375000', '1', '5', '3', '1', NULL, NULL, '1.6', '28', '10', NULL, '1', NULL, NULL, '', '', '', '', 'D04026', '0', '6', '', '46212', '', '1', '1000', '1', '10', '9', '20', '6', '30', '13', NULL, NULL, NULL, NULL, NULL, NULL, '1.6', NULL, NULL, NULL, '2', '', '48.9', '5', '4', '', '345', '250', '20', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '2', '', '1', '5', NULL, '3', '3', '1619520056', '6', NULL, 2),
(16, 8008, '61', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BRITANNIA  MARIE GOLD X 6 PACK 176GM', '324247', '61000104', '1619424600', '1620634200', '1', '3', '3', '1', NULL, NULL, '2', '28', '10', NULL, '1', NULL, NULL, '', '', '', '', 'D05287', '0', '6', '', '48799', '', '1', '900', '1', '10', '9', '20', '6', '20', '21', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2', '', '40.70', '5', '3', '', '590', '480', '18', '', '', '2', '1', '2', '6', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '1', NULL, '3', '2,3,11', '1619521272', '6', NULL, 1),
(17, 8004, '316', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW BAYARA 410X255MM - GREEN', 'PMFI0158', 'PO 038715-1', '1618474200', '1619683800', '1', '3', '3', '1', NULL, NULL, '1.9', '28', '10', NULL, '1', NULL, NULL, '', '', '', '', 'D05590', '0', '6', '', '47984', '', '1', '1000', '1', '10', '9', '12', '1', '100', '4', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2', '', '115.90', '5', '3', '', '410', '255', '22', '', '', '2', '1', '2', '6', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '2', '', '1', '4', NULL, '3', '2,3,11', '1619521490', '6', NULL, 1),
(18, 8008, '61', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BRITANNIA  MARIE GOLD X 6 PACK 176GM', '324247', '61000104', '1619424600', '1620634200', '1', '3', '3', '1', NULL, NULL, '2', '28', '10', NULL, '1', NULL, NULL, '', '', '', '', 'D05287', '0', '6', '', '48799', '', '1', '900', '1', '10', '9', '20', '6', '20', '21', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2', '', '40.70', '5', '3', '', '590', '480', '18', '', '', '2', '1', '2', '6', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '2', '', '1', '5', NULL, '3', '2,3,11', '1619521534', '6', NULL, 1),
(19, 8008, '61', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BRITANNIA  MARIE GOLD X 6 PACK 176GM', '324247', '61000104', '1619424600', '1620634200', '2', '3', '3', '1', NULL, NULL, '2', '28', '1', NULL, '3', NULL, NULL, '', '', '', '', 'D05287', '0', '6', '', '48799', '176', '2', '900', '1', '10', '9', '20', '6', '20', '40', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2', '', '40.70', '5', '3', '', '590', '480', '18', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '2', '', '1', '1', NULL, '3', '2,3,11', '1619522024', '6', NULL, 1),
(20, 8008, '61', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BRITANNIA  MARIE GOLD X 6 PACK 176GM', '324247', '61000104', '1619424600', '1620634200', '2', '3', '3', '1', NULL, NULL, '2', '28', '1', NULL, '3', NULL, NULL, '', '', '', '', 'D05287', '0', '6', '', '48799', '176', '2', '900', '1', '10', '9', '20', '6', '20', '40', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2', '', '40.70', '5', '3', '', '590', '480', '18', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '2', '', '1', '1', NULL, '3', '2,3,11', '1619522035', '6', NULL, 2),
(21, 8008, '61', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BRITANNIA  MARIE GOLD X 6 PACK 176GM', '324247', '61000104', '1619424600', '1620634200', '2', '3', '3', '1', NULL, NULL, '2', '28', '1', NULL, '3', NULL, NULL, '', '', '', '', 'D05287', '0', '6', '', '48799', '176', '2', '900', '1', '10', '9', '20', '6', '20', '40', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2', '', '40.70', '5', '3', '', '590', '480', '18', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '2', '', '1', '1', NULL, '3', '2,3,11', '1619522202', '3', NULL, 4),
(22, 8009, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MC DONALDS TOMATO KETCHUP 9GM OMAN', '02338032B', 'FPO-2104000351', '1619511000', '1621498200', '1,2', '11', '3', '1', NULL, NULL, '2.40', '2', '5', NULL, '3', NULL, NULL, '', '', '', '', 'D07080', '0', '6', '', '47416', '9', '2', '5000', '1', '10', '9', '10', '22', '7', '3', '10', '22', '40', '4', NULL, NULL, '3.2', '3.2', '3.2', NULL, '4', '0.20-0.28', '93.5', '7', '3', '320', '840', '88', '', '', '', '2', '1', '2', '6', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '4', NULL, NULL, '1', '2', '1000', '1', '1', NULL, '3', '2,3,4,6,11', '1619522676', '11', NULL, 1),
(23, 8009, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MC DONALDS TOMATO KETCHUP 9GM OMAN', '02338032B', 'FPO-2104000351', '1619511000', '1621498200', '1,2', '11', '3', '1', NULL, NULL, '2.40', '2', '5', NULL, '3', NULL, NULL, '', '', '', '', 'D07080', '0', '6', '', '47416', '9', '2', '5000', '1', '10', '9', '10', '22', '7', '3', '10', '22', '40', '4', NULL, NULL, '3.2', '3.2', '3.2', NULL, '4', '0.20-0.28', '93.5', '7', '3', '320', '840', '88', '', '', '', '2', '1', '2', '6', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '4', NULL, NULL, '1', '2', '1000', '1', '1', NULL, '3', '2,3,4,6,11', '1619522685', '11', NULL, 2),
(24, 8009, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MC DONALDS TOMATO KETCHUP 9GM OMAN', '02338032B', 'FPO-2104000351', '1619511000', '1621498200', '1,2', '11', '3', '1', NULL, NULL, '2.40', '2', '5', NULL, '3', NULL, NULL, '', '', '', '', 'D07080', '0', '6', '', '47416', '9', '2', '5000', '1', '10', '9', '10', '22', '7', '3', '10', '22', '40', '4', NULL, NULL, '3.2', '3.2', '3.2', NULL, '4', '0.20-0.28', '93.5', '7', '3', '320', '840', '88', '', '', '', '2', '1', '2', '6', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '4', NULL, NULL, '1', '2', '1000', '1', '1', NULL, '3', '2,3,4,6,11', '1619522720', '11', NULL, 4),
(25, 8010, '460', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NABIL-CREMORE ORANGE CREAM BISCUITS 82G', '41102238', '011867', '1619511000', '1621066200', '1,2', '11', '3', '1', NULL, NULL, '2.2', '28', '10', NULL, '2', NULL, NULL, '23', '', '', '', 'D06678', '0', '6', '', '44228', '', '1', '1000', '1', '10', '9', '20', '6', '20', '40', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2', '', '', '5', '5', '', '170', '220', '12', '', '', '2', '1', '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '2', '1000', '1', '1', NULL, '3', '2', '1619591026', '10', NULL, 1),
(26, 8010, '460', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NABIL-CREMORE ORANGE CREAM BISCUITS 82G', '41102238', '011867', '1619511000', '1621066200', '1,2', '11', '3', '1', NULL, NULL, '2.2', '28', '10', NULL, '2', NULL, NULL, '23', '', '', '', 'D06678', '0', '6', '', '44228', '', '1', '1000', '1', '10', '9', '20', '6', '20', '40', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2', '', '', '5', '5', '', '170', '220', '12', '', '', '2', '1', '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '2', '1000', '1', '1', NULL, '3', '2', '1619591032', '10', NULL, 2),
(27, 8011, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SADIA 20 PCS CHICKEN BURGER POUCH 1000GM', '674537', '103462480', '1618128600', '1622621400', '1', '4', '2', '1', NULL, NULL, '1.2', '1', NULL, NULL, '1', NULL, NULL, '', '', '', '', 'D06685', '0', '6', '', '47574 - LWO No.', '1', '3', '150000', '3', '10', NULL, '12', '1', '80', '5', NULL, NULL, NULL, NULL, NULL, NULL, '1.8', NULL, NULL, NULL, '2', '', '95.40', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL, 7, NULL, 2, 2, NULL, NULL, NULL, 2, NULL, NULL, '{\"70\":\"220\",\"71\":\"300\",\"72\":\"5\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', NULL, NULL, '3', '', '', '1', '2', '', '1', '1', NULL, '3', '3,11', '1619694436', '6', NULL, 1),
(28, 8010, '460', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NABIL-CREMORE ORANGE CREAM BISCUITS 82G', '41102238', '011867', '1619511000', '1621066200', '1,2', '11', '3', '1', NULL, NULL, '2.2', '28', '10', NULL, '2', NULL, NULL, '23', '', '', '', 'D06678', '0', '6', '', '44228', '', '1', '1000', '1', '10', '9', '20', '6', '20', '40', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2', '', '', '5', '5', '', '170', '220', '12', '', '', '2', '1', '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '2', '1000', '1', '1', NULL, '3', '2', '1619951102', '11', NULL, 4),
(29, 8012, '419', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Modern Bakery 540mm', '', '4100090286', '1619338200', '1621066200', '1', '16', '3', '1', NULL, NULL, '1.2', '36', '1', NULL, '2', NULL, NULL, '', '', '', '', 'D06066', '1', '6', '', '', '', '2', '520', '1', '10', '9', '30', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '5', '', '540', '600', '25', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '1', NULL, '3', '2,4', '1619952361', '7', NULL, 1),
(30, 8012, '419', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Modern Bakery 540mm', '', '4100090286', '1619338200', '1621066200', '1', '16', '3', '1', NULL, NULL, '1.2', '36', '1', NULL, '2', NULL, NULL, '', '', '', '', 'D06066', '1', '6', '', '', '', '2', '520', '1', '10', '9', '30', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '5', '', '540', '600', '25', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '1', NULL, '3', '2,4', '1619953924', '7', NULL, 2),
(31, 8013, '190', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CAPE COOKIES DOUBLE DELIGHT - 500 G', 'RE029', '03-2021', '1619683800', '1623312600', '3', '14', '3', '1', NULL, NULL, '2.0', '28', '11', NULL, '2', NULL, NULL, '', '', '', '', '2675', '0', '6', '', '47158', '500', '2', '2000', '1', '10', '1', '20', '6', '12', '2', '70', '4', NULL, NULL, NULL, NULL, '2', '1.8', NULL, NULL, '3', '', '', '', '18', '', '452', '275', '25', '', '', '2', '1', '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '6', '7', '1', NULL, '3', NULL, NULL, '1', '2', '', '1', '1', NULL, '3', '2,3,6', '1620032245', '13', NULL, 1),
(32, 8013, '190', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CAPE COOKIES DOUBLE DELIGHT - 500 G', 'RE029', '03-2021', '1619683800', '1623312600', '3', '14', '3', '1', NULL, NULL, '2.0', '28', '11', NULL, '2', NULL, NULL, '', '', '', '', '2675', '0', '6', '', '47158', '500', '2', '2000', '1', '10', '1', '20', '6', '12', '2', '70', '4', NULL, NULL, NULL, NULL, '2', '1.8', NULL, NULL, '3', '', '', '', '18', '', '452', '275', '25', '', '', '2', '1', '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '6', '7', '1', NULL, '3', NULL, NULL, '1', '2', '', '1', '1', NULL, '3', '2,3,6', '1620032313', '13', NULL, 2),
(33, 8011, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SADIA 20 PCS CHICKEN BURGER POUCH 1000GM', '674537', '103462480', '1618128600', '1622621400', '1', '4', '2', '1', NULL, NULL, '1.2', '1', NULL, NULL, '1', NULL, NULL, '', '', '', '', 'D06685', '0', '6', '', '47574 - LWO No.', '1', '3', '150000', '3', '10', NULL, '12', '1', '80', '5', NULL, NULL, NULL, NULL, NULL, NULL, '1.8', NULL, NULL, NULL, '2', '', '95.40', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL, 7, NULL, 2, 2, NULL, NULL, NULL, 2, NULL, NULL, '{\"70\":\"220\",\"71\":\"300\",\"72\":\"5\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '6', '7', NULL, NULL, '3', '100', '15', '1', '2', '', '1', '5', NULL, '5', '3,11', '1620209827', '6', NULL, 1),
(34, 8011, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SADIA 20 PCS CHICKEN BURGER POUCH 1000GM', '674537', '103462480', '1618128600', '1622621400', '1', '4', '2', '1', NULL, NULL, '1.2', '1', NULL, NULL, '1', NULL, NULL, '', '', '', '', 'D06685', '0', '6', '', '47574 - LWO No.', '1', '3', '150000', '3', '10', NULL, '12', '1', '80', '5', NULL, NULL, NULL, NULL, NULL, NULL, '1.8', NULL, NULL, NULL, '2', '', '95.40', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL, 7, NULL, 2, 2, NULL, NULL, NULL, 2, NULL, NULL, '{\"70\":\"220\",\"71\":\"300\",\"72\":\"5\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '6', '7', NULL, NULL, '3', '100', '15', '1', '2', '', '1', '5', NULL, '5', '3,11', '1620209837', '6', NULL, 2),
(35, 8006, '683', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FINE GUARD ULTRA WIPES - 30 WIPES ROLL', 'PMPW001FG', 'PM/0144/2021', '1618733400', '1620634200', '1', '5', '3', '1', NULL, NULL, '2.2', '25', '1', NULL, '1', NULL, NULL, '', '', '', '', 'D07615', '0', '6', '', 'NEW', '30', '7', '1000', '1', '10', '1', '20', '7', '12', '21', '40', '4', NULL, NULL, NULL, NULL, '1.8', '2', NULL, NULL, '3', '', '77.92', '5', '5', '', '360', '280', '30', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '1', '3', '1', '1', NULL, '3', NULL, NULL, '1', '2', '', '1', '5', NULL, '3', '2,3,11', '1620211311', '6', NULL, 1),
(36, 8006, '683', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FINE GUARD ULTRA WIPES - 30 WIPES ROLL', 'PMPW001FG', 'PM/0144/2021', '1618733400', '1620634200', '1', '5', '3', '1', NULL, NULL, '2.2', '25', '1', NULL, '1', NULL, NULL, '', '', '', '', 'D07615', '0', '6', '', 'NEW', '30', '7', '1000', '1', '10', '1', '20', '7', '12', '21', '40', '4', NULL, NULL, NULL, NULL, '1.8', '2', NULL, NULL, '3', '', '77.92', '5', '5', '', '360', '280', '30', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '1', '3', '1', '1', NULL, '3', NULL, NULL, '1', '2', '', '1', '5', NULL, '3', '2,3,11', '1620211317', '6', NULL, 2),
(37, 8011, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SADIA 20 PCS CHICKEN BURGER POUCH 1000GM', '674537', '103462480', '1618128600', '1622621400', '1', '4', '2', '1', NULL, NULL, '1.2', '1', NULL, NULL, '1', NULL, NULL, '', '', '', '', 'D06685', '0', '6', '', '47574 - LWO No.', '1', '3', '150000', '3', '10', NULL, '12', '1', '80', '5', NULL, NULL, NULL, NULL, NULL, NULL, '1.8', NULL, NULL, NULL, '2', '', '95.40', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL, 7, NULL, 2, 2, NULL, NULL, NULL, 2, NULL, NULL, '{\"70\":\"220\",\"71\":\"300\",\"72\":\"5\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '6', '7', NULL, NULL, '3', '100', '15', '1', '2', '', '1', '5', NULL, '5', '3,11', '1620211550', '4', 'COA required', 3),
(38, 8011, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SADIA 20 PCS CHICKEN BURGER POUCH 1000GM', '674537', '103462480', '1618128600', '1622621400', '1', '4', '2', '1', NULL, NULL, '1.2', '1', NULL, NULL, '1', NULL, NULL, '', '', '', '', 'D06685', '0', '6', '', '47574 - LWO No.', '1', '3', '150000', '3', '10', NULL, '12', '1', '80', '5', NULL, NULL, NULL, NULL, NULL, NULL, '1.8', NULL, NULL, NULL, '2', '', '95.40', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL, 7, NULL, 2, 2, NULL, NULL, NULL, 2, NULL, NULL, '{\"70\":\"220\",\"71\":\"300\",\"72\":\"5\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '6', '7', NULL, NULL, '3', '100', '15', '1', '2', '', '1', '5', NULL, '5', '2,3,11', '1620211695', '6', NULL, 3),
(39, 8011, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SADIA 20 PCS CHICKEN BURGER POUCH 1000GM', '674537', '103462480', '1618128600', '1622621400', '1', '4', '2', '1', NULL, NULL, '1.2', '1', NULL, NULL, '1', NULL, NULL, '', '', '', '', 'D06685', '0', '6', '', '47574 - LWO No.', '1', '3', '150000', '3', '10', NULL, '12', '1', '80', '5', NULL, NULL, NULL, NULL, NULL, NULL, '1.8', NULL, NULL, NULL, '2', '', '95.40', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL, 7, NULL, 2, 2, NULL, NULL, NULL, 2, NULL, NULL, '{\"70\":\"220\",\"71\":\"300\",\"72\":\"5\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '6', '7', NULL, NULL, '3', '100', '15', '1', '2', '', '1', '5', NULL, '5', '2,3,11', '1620211703', '6', NULL, 2),
(40, 8011, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SADIA 20 PCS CHICKEN BURGER POUCH 1000GM', '674537', '103462480', '1618128600', '1622621400', '1', '4', '2', '1', NULL, NULL, '1.2', '1', NULL, NULL, '1', NULL, NULL, '', '', '', '', 'D06685', '0', '6', '', '47574 - LWO No.', '1', '3', '150000', '3', '10', NULL, '12', '1', '80', '5', NULL, NULL, NULL, NULL, NULL, NULL, '1.8', NULL, NULL, NULL, '2', '', '95.40', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL, 7, NULL, 2, 2, NULL, NULL, NULL, 2, NULL, NULL, '{\"70\":\"220\",\"71\":\"300\",\"72\":\"5\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '6', '7', NULL, NULL, '3', '100', '15', '1', '2', '', '1', '5', NULL, '5', '2,3,11', '1620211795', '4', NULL, 4),
(41, 8014, '421', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '1639296600', '1670832600', '1', '2', '3', '1', NULL, NULL, '', '27', '10', NULL, '1', NULL, NULL, '', '', '', '', '', '0', '1', '', '', '', '1', '', '1', '', '2', '1', '21', '2', '21', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, '2', '', '', '', '1', '4', '', '', '4', '', '', '1', '1', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2', '1', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '1', NULL, '3', '4', '1620215964', '1', NULL, 1),
(42, 8015, '222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Value', '78080', '794749', '1628237400', '1639555800', '1', '18', '3', '1', NULL, NULL, '2', '27', '10', NULL, '1', NULL, NULL, '', '', '', '', '', '0', '1', '', '', '', '1', '1000', '1', '10', '1', '30', '40', '30', '21', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, '2', '', '', '', '2', '', '', '', '', '', '', '1', '1', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2', '1', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '1', NULL, '3', '4', '1620221599', '18', NULL, 1),
(43, 8015, '222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Value', '78080', '794749', '1628237400', '1639555800', '1', '18', '3', '1', NULL, NULL, '2', '27', '10', NULL, '1', NULL, NULL, '', '', '', '', '', '0', '1', '', '', '', '1', '1000', '1', '10', '1', '30', '40', '30', '21', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, '2', '', '', '', '2', '', '', '', '', '', '', '1', '1', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2', '1', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '1', NULL, '3', '4', '1620221611', '18', NULL, 2),
(44, 8015, '222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Value', '78080', '794749', '1628237400', '1639555800', '1', '18', '3', '1', NULL, NULL, '2', '27', '10', NULL, '1', NULL, NULL, '', '', '', '', '', '0', '1', '', '', '', '1', '1000', '1', '10', '1', '30', '40', '30', '21', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, '2', '', '', '', '2', '', '', '', '', '', '', '1', '1', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2', '1', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '1', NULL, '3', '4', '1620221887', '2', 'as discussed', 3),
(45, 8015, '222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Value', '78080', '794749', '1628237400', '1639555800', '1', '18', '3', '1', NULL, NULL, '2', '36', '10', NULL, '1', NULL, NULL, '', '', '', '', '', '0', '1', '', '', '', '1', '1000', '1', '10', '1', '30', '40', '30', '21', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, '2', '', '', '', '2', '', '', '', '', '', '', '1', '1', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2', '1', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '1', NULL, '3', '4', '1620221959', '18', NULL, 3),
(46, 8015, '222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Value', '78080', '794749', '1628237400', '1639555800', '1', '18', '3', '1', NULL, NULL, '2', '36', '10', NULL, '1', NULL, NULL, '', '', '', '', '', '0', '1', '', '', '', '1', '1000', '1', '10', '1', '30', '40', '30', '21', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, '2', '', '', '', '2', '', '', '', '', '', '', '1', '1', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2', '1', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '1', NULL, '3', '4', '1620221965', '18', NULL, 2),
(47, 8015, '222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Value', '78080', '794749', '1628237400', '1639555800', '1', '18', '3', '1', NULL, NULL, '2', '36', '10', NULL, '1', NULL, NULL, '', '', '', '', '', '0', '1', '', '', '', '1', '1000', '1', '10', '1', '30', '40', '30', '21', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, '2', '', '', '', '2', '', '', '', '', '', '', '1', '1', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2', '1', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '1', NULL, '3', '4', '1620223023', '2', NULL, 4),
(48, 8008, '61', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BRITANNIA  MARIE GOLD X 6 PACK 176GM', '324247', '61000104', '1619424600', '1620634200', '2', '3', '3', '1', NULL, NULL, '2', '28', '1', NULL, '3', NULL, NULL, '', '', '', '', 'D05287', '0', '6', '', '48799', '176', '2', '900', '1', '10', '9', '20', '6', '20', '40', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2', '', '40.70', '5', '3', '', '590', '480', '18', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '2', '', '1', '1', NULL, '3', '2,3,11', '1620278903', '19', NULL, 5),
(49, 8011, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SADIA 20 PCS CHICKEN BURGER POUCH 1000GM', '674537', '103462480', '1618128600', '1622621400', '1', '4', '2', '1', NULL, NULL, '1.2', '1', NULL, NULL, '1', NULL, NULL, '', '', '', '', 'D06685', '0', '6', '', '47574 - LWO No.', '1', '3', '150000', '3', '10', NULL, '12', '1', '80', '5', NULL, NULL, NULL, NULL, NULL, NULL, '1.8', NULL, NULL, NULL, '2', '', '95.40', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL, 7, NULL, 2, 2, NULL, NULL, NULL, 2, NULL, NULL, '{\"70\":\"220\",\"71\":\"300\",\"72\":\"5\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '6', '7', NULL, NULL, '3', '100', '15', '1', '2', '', '1', '5', NULL, '5', '2,3,11', '1620278915', '19', NULL, 5),
(50, 8000, '381', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KITCO BITES CHEDDAR CHEESE BALLS POLYBAG BLUE BG', '4960210040000007', '26-2231', '1618906200', '1622362200', '1,2', '11', '1', '1', NULL, NULL, '2.80', '27', NULL, NULL, '2', NULL, NULL, '25', '15', '', '', 'D04371', '0', '6', '0', '31593', '', '1', '1000', '1', '10', NULL, '65', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '67.20', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 6, '', '50', '', '{\"5\":\"565\",\"6\":\"450\",\"7\":\"120\"}', NULL, NULL, '2', '2', '3', '7', NULL, '4', '4', '', '', '1', '2', '1000', '1', '1', NULL, '3', '2,3,4,6,12', '1620281436', '19', NULL, 5),
(51, 8016, '421', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '1639296600', '1670832600', '1', '2', '1', '1', NULL, NULL, '', '27', NULL, NULL, '1', NULL, NULL, '', '', '', '', '', '0', '1', '', '', '', '1', '', '1', '', NULL, '1', '21', '1', '21', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, '2', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, '', '', '', '{\"1\":\"\",\"2\":\"\"}', NULL, NULL, '1', '1', '2', '1', NULL, '1', '3', '', '', '1', '1', '', '1', '1', NULL, '3', '4', '1620292794', '1', NULL, 1),
(52, 8001, '655', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Shrink Fil 680mm TSM DOVE SH-CD', '32713161', '4520453485', '1618387800', '1620807000', '1', '12', '3', '2', NULL, NULL, NULL, '27', '1', NULL, '2', NULL, NULL, '', '20', '', '', '', '0', '6', '', 'N/A', '500', '2', '2000', '1', '10', '9', '50', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '46', '5', '1', '600', '680', 'N/A', '', '', '', '2', '1', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2', '1', '1', NULL, '4', NULL, NULL, '4', '1', '400', '1', '5', NULL, '3', '2,3,4,11', '1620651524', '1', NULL, 4),
(53, 8005, '273', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Raja Vegetable 15gm', '', 'SF-PO-21-00050', '1610698200', '1621066200', '2', '8', '3', '1', NULL, NULL, '1.8', '28', '10', NULL, '2', NULL, NULL, '', '', '', '', '7777', '1', '6', '', '', '', '1', '1000', '1', '10', '9', '30', '6', '25', '14', NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2', '', '44.25', '', '3', '', '300', '180', '20', '', '', '2', '1', '2', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '3', '7', '1', NULL, '3', NULL, NULL, '1', '1', '', '1', '4', NULL, '3', '2,4,6', '1620733827', '1', NULL, 2),
(54, 8011, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SADIA 20 PCS CHICKEN BURGER POUCH 1000GM', '674537', '103462480', '1618128600', '1622621400', '1', '4', '2', '1', NULL, NULL, '1.2', '1', NULL, NULL, '1', NULL, NULL, '', '', '', '', 'D06685', '0', '6', '', '47574 - LWO No.', '1', '3', '150000', '3', '10', NULL, '12', '1', '80', '5', NULL, NULL, NULL, NULL, NULL, NULL, '1.8', NULL, NULL, NULL, '2', '', '95.40', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL, 7, NULL, 2, 2, NULL, NULL, NULL, 2, NULL, NULL, '{\"70\":\"220\",\"71\":\"300\",\"72\":\"5\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '6', '7', NULL, NULL, '3', '100', '15', '1', '2', '', '1', '5', NULL, '5', '2,3,11', '1620758903', '1', NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `master_work_order_main_identitiy`
--

DROP TABLE IF EXISTS `master_work_order_main_identitiy`;
CREATE TABLE IF NOT EXISTS `master_work_order_main_identitiy` (
  `mwoid_id` int(100) NOT NULL AUTO_INCREMENT,
  `mwoid_desc1` varchar(500) NOT NULL,
  `mwoid_desc2` varchar(500) NOT NULL,
  PRIMARY KEY (`mwoid_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_work_order_main_identitiy`
--

INSERT INTO `master_work_order_main_identitiy` (`mwoid_id`, `mwoid_desc1`, `mwoid_desc2`) VALUES
(1, 'Sales- Created/Edited', 'Sales Created the Document'),
(2, 'Sales - Requesting Verification', 'Awaiting Sales Verifier Approval'),
(3, 'Sales Verifier - Rejected', 'Verifier Returned the document. Rejected'),
(5, 'Accounts - Published', 'Pending Technical Data entry'),
(6, 'Accounts - Conditional Published', 'Pending Technical Data entry (Account Conditional Release)'),
(7, 'Technical - Requesting Verification', 'Awaiting Technical Verifier Approval'),
(4, 'Sales Verifier Approved the document.', 'Awaiting Accounts Approval'),
(8, 'Technical Verifier - Rejected', 'Technical Verifier Returned the document. Rejected'),
(9, 'Technical Verifier - Approved', 'Work Order Published '),
(10, 'Marked Complete', 'Marked Complete - Complete');

-- --------------------------------------------------------

--
-- Table structure for table `master_work_order_reference_number`
--

DROP TABLE IF EXISTS `master_work_order_reference_number`;
CREATE TABLE IF NOT EXISTS `master_work_order_reference_number` (
  `mwo_ref_id` int(255) NOT NULL AUTO_INCREMENT,
  `mwo_dnt` varchar(698) NOT NULL,
  `mwo_repeat_wo_id` int(255) DEFAULT NULL,
  `mwo_repeat_wo_type` varchar(25) DEFAULT NULL,
  `mwo_gen_on_behalf_lum_id` int(255) NOT NULL,
  `mwo_gen_lum_id` int(255) NOT NULL,
  `mwo_type` int(1) NOT NULL DEFAULT '1' COMMENT '1=New\r\n2=Rep\r\n3=RepChange',
  PRIMARY KEY (`mwo_ref_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8017 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_work_order_reference_number`
--

INSERT INTO `master_work_order_reference_number` (`mwo_ref_id`, `mwo_dnt`, `mwo_repeat_wo_id`, `mwo_repeat_wo_type`, `mwo_gen_on_behalf_lum_id`, `mwo_gen_lum_id`, `mwo_type`) VALUES
(8000, '1619438579', NULL, NULL, 11, 11, 1),
(8001, '1619438777', NULL, NULL, 12, 12, 1),
(8002, '1619438788', NULL, NULL, 13, 13, 1),
(8003, '1619439205', NULL, NULL, 10, 10, 1),
(8004, '1619439582', NULL, NULL, 3, 6, 1),
(8005, '1619510617', NULL, NULL, 8, 8, 1),
(8006, '1619518371', NULL, NULL, 5, 6, 1),
(8007, '1619520015', NULL, NULL, 5, 6, 1),
(8008, '1619521272', NULL, NULL, 3, 6, 1),
(8009, '1619522676', NULL, NULL, 11, 11, 1),
(8010, '1619591026', NULL, NULL, 11, 10, 1),
(8011, '1619694436', NULL, NULL, 4, 6, 1),
(8012, '1619952361', NULL, NULL, 16, 7, 1),
(8013, '1620032245', NULL, NULL, 14, 13, 1),
(8014, '1620215964', NULL, NULL, 2, 1, 1),
(8015, '1620221599', NULL, NULL, 18, 18, 1),
(8016, '1620292794', NULL, NULL, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `materials_main`
--

DROP TABLE IF EXISTS `materials_main`;
CREATE TABLE IF NOT EXISTS `materials_main` (
  `material_id` int(50) NOT NULL AUTO_INCREMENT,
  `material_value` varchar(698) NOT NULL,
  `material_density` varchar(10) NOT NULL DEFAULT '1',
  `material_show` int(1) NOT NULL DEFAULT '1',
  `material_position` int(3) DEFAULT '1',
  PRIMARY KEY (`material_id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials_main`
--

INSERT INTO `materials_main` (`material_id`, `material_value`, `material_density`, `material_show`, `material_position`) VALUES
(1, 'PET', '1.4', 1, 1),
(2, 'METTALIZED PET', '1.41', 1, 1),
(3, 'ALUMINUM FOIL', '2.71', 1, 1),
(4, 'TPE', '0.92', 1, 1),
(5, 'WPE', '0.94', 1, 1),
(6, 'TOPP', '0.91', 1, 1),
(7, 'MATTE OPP', '0.89', 1, 1),
(8, 'METTALIZED PEARLISED OPP', '0.73', 1, 1),
(9, 'PEARLISED BOPP', '0.72', 1, 1),
(10, 'PEARLISED BOPP LABEL GRADE', '0.62', 1, 1),
(11, 'MPOPP', '0.73', 1, 1),
(12, 'NYLON', '1.15', 1, 1),
(13, 'TCPP', '0.905', 1, 1),
(14, 'METALLIZED CPP', '0.91', 1, 1),
(15, 'PAPER', '1', 1, 1),
(16, 'PAPER FEEL POLY', '0.94', 1, 1),
(17, 'BUTTER FOIL', '1', 1, 1),
(18, 'RETORT PET', '1.4', 1, 1),
(20, 'CHEMICAL PET', '1.4', 1, 1),
(21, 'ACRYLIC PET', '1.4', 1, 1),
(22, 'UPF PET', '1.4', 1, 1),
(23, 'TWIST PET', '1.4', 1, 1),
(24, 'CORONA PET', '1.4', 1, 1),
(25, 'ALOX PET', '00000', 1, 1),
(26, 'SIOX PET', '000000', 1, 1),
(27, 'MATTE PET', '1.4', 1, 1),
(28, 'SOFT PET', '1.4', 1, 1),
(29, 'SOFT MATTE  PET', '1.4', 1, 1),
(30, 'HIGH GLOSS PET', '1.4', 1, 1),
(32, 'METALLIZED PET HIGH OD', '1.4', 1, 1),
(33, 'METALLIZED PET ULTRA HIGH OD', '1.4', 1, 1),
(36, 'COL PE', '0.94', 1, 1),
(40, 'HIGH OD MOPP', '0.91', 1, 1),
(41, 'WHITE OPP', '0.92', 1, 1),
(43, 'OPP LABEL GRADE', '0.92', 1, 1),
(45, 'KRAFT PAPER', '1', 1, 1),
(46, 'BLEACH PAPER', '1', 1, 1),
(47, 'GLASSINE PAPER', '1', 1, 1),
(48, 'BUTTER PAPER', '1', 1, 1),
(49, 'RELEASE PAPER', '1', 1, 1),
(50, 'POLYCOATED PAPER', '1', 1, 1),
(51, 'EXTRUDED NYLON PAPER', '1', 1, 1),
(52, 'RETORT FOIL', '2.71', 1, 1),
(53, 'RETORT CPP', '0.905', 1, 1),
(54, 'RETORT NYLON', '1.15', 1, 1),
(55, 'EVOH TPE', '0.950', 1, 1),
(56, 'MOPP', '0.910', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules_groups`
--

DROP TABLE IF EXISTS `modules_groups`;
CREATE TABLE IF NOT EXISTS `modules_groups` (
  `mg_id` int(255) NOT NULL AUTO_INCREMENT,
  `mg_name` varchar(698) NOT NULL,
  PRIMARY KEY (`mg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules_groups`
--

INSERT INTO `modules_groups` (`mg_id`, `mg_name`) VALUES
(1, 'Sales'),
(2, 'Dependencies'),
(3, 'Sales Attach'),
(4, 'Customer'),
(5, 'Main - WIP'),
(6, 'Logs'),
(7, 'Accounts'),
(8, 'Published'),
(9, 'Technical'),
(10, 'Master'),
(11, 'Amendment'),
(12, 'Planning');

-- --------------------------------------------------------

--
-- Table structure for table `modules_main`
--

DROP TABLE IF EXISTS `modules_main`;
CREATE TABLE IF NOT EXISTS `modules_main` (
  `mod_id` int(255) NOT NULL AUTO_INCREMENT,
  `mod_mg_id` int(255) NOT NULL,
  `mod_name` varchar(155) NOT NULL,
  `mod_href` varchar(155) NOT NULL,
  `mod_icon` varchar(155) NOT NULL,
  `mod_visible` int(2) NOT NULL DEFAULT '1',
  `mod_valid` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`mod_id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules_main`
--

INSERT INTO `modules_main` (`mod_id`, `mod_mg_id`, `mod_name`, `mod_href`, `mod_icon`, `mod_visible`, `mod_valid`) VALUES
(1, 5, 'Dashboard', 'home', 'fas fa-table', 1, 1),
(9, 1, 'Sales Order Make', 'work_order_sales_generate', 'fas fa-clipboard-list', 1, 1),
(2, 1, 'Sales Order', 'work_order_sales', 'fas fa-clipboard-list', 1, 1),
(10, 1, 'Sales Work Order Generate Controller', 'SalesWorkOrderSubmit', 'fa fa-home', 0, 1),
(11, 1, 'Sales Work Order Backend Viewer Getter', 'WorkOrderSalesViewGetter', 'fa fa-home', 0, 1),
(12, 2, 'Form Manager', 'form_manager', 'fas fa-clipboard-list', 1, 1),
(13, 2, 'Form Manager Controller', 'FormManagerController', 'fa fa-home', 0, 1),
(14, 1, 'Main Work Order Backend Generate', 'MainWorkOrderSubmit', 'fa fa-home', 0, 1),
(15, 1, 'Sales Order Verifier', 'work_order_sales_verify', 'fas fa-clipboard-list', 1, 1),
(16, 9, 'Work Order - Technical', 'work_order_technical', 'fas fa-clipboard-list', 1, 1),
(18, 7, ' Sales Order Accounts', 'work_order_accounts', 'fas fa-clipboard-list', 1, 1),
(45, 9, 'Work Order - Tech. Ver', 'work_order_technical_verify', 'fas fa-clipboard-list', 1, 1),
(21, 1, 'Main Work Order Backend Generate All', 'MainWorkOrderSubmitAll', 'fa fa-home', 0, 1),
(22, 1, 'Sales Work Order Controller', 'SalesWorkOrderController', 'fa fa-home', 0, 1),
(23, 1, 'Work Order View Print', 'work_order_view_print', 'fas fa-clipboard-list', 0, 1),
(25, 1, 'Work Order Controller Main Edit', 'WorkOrderControllerEdit', 'fa fa-home', 0, 1),
(26, 1, 'Work Order Main Edit', 'work_order_main_edit', 'fas fa-clipboard-list', 0, 1),
(27, 2, 'Work Order Version Control', 'work_order_tracker', 'fas fa-clipboard-list', 1, 1),
(28, 1, 'Accounts Controller', 'AccountsController', 'fa fa-home', 0, 1),
(30, 1, 'Conditional Release Controller', 'ConditionalController', 'fa fa-home', 0, 1),
(49, 10, 'Materials', 'master_materials', 'fas fa-clipboard-list', 1, 1),
(33, 2, 'Users', 'admin_users', 'fas fa-users', 1, 1),
(34, 2, 'Admin Controller', 'AdminController', 'fa fa-home', 0, 1),
(35, 5, 'Profile', 'profile', 'fas fa-user', 1, 1),
(36, 1, 'Pre Press Controller', 'PrePressController', 'fa fa-home', 0, 1),
(37, 6, 'Admin Logs', 'admin_logs', 'fas fa-clipboard-list', 1, 1),
(38, 1, 'Work Order Planning Edit', 'work_order_planning_edit', 'fas fa-clipboard-list', 0, 1),
(39, 1, 'Planning Controller', 'PlanningController', 'fa fa-home', 0, 1),
(40, 1, 'Work Order - S - REP', 'work_order_sales_repeat', 'fas fa-clipboard-list', 0, 1),
(41, 1, 'Work Order - S - rep change', 'work_order_sales_repeat_change', 'fas fa-clipboard-list', 0, 1),
(42, 1, 'Sales Work Order Generate Controller Repeat', 'SalesWorkOrderRepeat', 'fa fa-home', 0, 1),
(43, 1, 'Sales Work Order Generate Controller Repeat Change', 'SalesWorkOrderRepeatChange', 'fa fa-home', 0, 1),
(44, 8, 'Work Order - Approved', 'work_order_all', 'fas fa-clipboard-list', 1, 1),
(46, 7, 'Conditional Release', 'conditional_release', 'fas fa-clipboard-list', 1, 1),
(47, 1, 'All Work Order Controller', 'AllController', 'fa fa-home', 0, 1),
(48, 1, 'All Work Order Controller Table', 'AllControllerTable', 'fa fa-home', 0, 1),
(50, 10, 'Clients', 'master_clients', 'fas fa-clipboard-list', 1, 1),
(51, 10, 'MaterialsController', 'MaterialsController', 'fas fa-clipboard-list', 0, 1),
(52, 10, 'ClientsController', 'ClientsController', 'fas fa-clipboard-list', 0, 1),
(53, 1, 'Work Order Form Controller', 'FormController', 'fa fa-home', 0, 1),
(54, 1, 'Work Order Bag Pouch Form Dynamic Controller', 'FormAllDynController', 'fa fa-home', 0, 1),
(55, 1, 'Sales Groups', 'sales_groups', 'fa fa-users', 1, 1),
(56, 8, 'Work Order - Complete', 'work_order_all_complete', 'fas fa-clipboard-list', 1, 1),
(57, 11, 'Amendment Form', 'amendment_form', 'fas fa-clipboard-list', 1, 1),
(58, 11, 'Amendment Form Controller', 'AmendmentFormController', 'fas fa-clipboard-list', 0, 1),
(59, 1, 'Amendment Form New', 'amendment_form_new', 'fas fa-clipboard-list', 0, 1),
(60, 1, 'Amendments- Sales', 'amendment_form_sales', 'fas fa-clipboard-list', 1, 1),
(61, 1, 'Amendments- Sales Verify', 'amendment_form_sales_verify', 'fas fa-clipboard-list', 1, 1),
(62, 7, 'Amendments - Accounts', 'amendment_form_accounts', 'fas fa-clipboard-list', 1, 1),
(63, 9, 'Amendments - Technical', 'amendment_form_technical', 'fas fa-clipboard-list', 1, 1),
(64, 11, 'Amendments Sales Controller', 'AmendmentSalesController', 'fas fa-clipboard-list', 0, 1),
(65, 11, 'Amendment Sales Verify Controller', 'AmendmentSalesVerifyController', 'fas fa-clipboard-list', 0, 1),
(66, 11, 'Amendment Accounts Controller', 'AmendmentAccountsController', 'fas fa-clipboard-list', 0, 1),
(67, 11, 'Amendment Tech Verify Controller', 'AmendmentTechnicalController', 'fas fa-clipboard-list', 0, 1),
(68, 12, 'Amendments - Planning', 'amendment_form_planning', 'fas fa-clipboard-list', 1, 1),
(69, 11, 'Amendment Planning Controller', 'AmendmentPlanningController', 'fas fa-clipboard-list', 0, 1),
(70, 11, 'Amendment View Print', 'amendment_view_print', 'fas fa-clipboard-list', 0, 1),
(71, 11, 'Amendment Helper', 'AmendmentHelper', 'fas fa-clipboard-list', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pouch_digital_master`
--

DROP TABLE IF EXISTS `pouch_digital_master`;
CREATE TABLE IF NOT EXISTS `pouch_digital_master` (
  `pdm_id` int(11) NOT NULL AUTO_INCREMENT,
  `pdm_name` varchar(50) NOT NULL,
  `pdm_valid` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pdm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pouch_digital_master`
--

INSERT INTO `pouch_digital_master` (`pdm_id`, `pdm_name`, `pdm_valid`) VALUES
(1, 'CENTER SEAL POUCH', 1),
(2, 'SIDE GUSSET CENTER SEAL POUCHES', 1),
(3, 'QUADRO POUCH / SIDE GUSSET POUCHES', 1),
(4, '3 SIDE SEAL POUCH', 1),
(5, 'FLAT BOTTOM (3D POUCHES)', 1),
(6, 'STAND UP K SEAL', 1),
(7, 'STAND UP DOY Pouch (ARC SEAL)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pouch_digital_params`
--

DROP TABLE IF EXISTS `pouch_digital_params`;
CREATE TABLE IF NOT EXISTS `pouch_digital_params` (
  `pdp_id` int(25) NOT NULL AUTO_INCREMENT,
  `pdp_pds_id` int(25) NOT NULL,
  `pdp_title` varchar(80) NOT NULL,
  PRIMARY KEY (`pdp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pouch_digital_params`
--

INSERT INTO `pouch_digital_params` (`pdp_id`, `pdp_pds_id`, `pdp_title`) VALUES
(1, 1, 'L-Length'),
(2, 1, 'W-Width'),
(3, 1, 'A-Center Seal'),
(4, 1, 'B-Bottom Seal'),
(5, 2, 'L-Length'),
(6, 2, 'W-Width'),
(7, 2, 'A-Center Seal'),
(8, 2, 'B-Bottom Seal'),
(10, 3, 'L-Length'),
(11, 3, 'W-Width'),
(12, 3, 'A-Center Seal'),
(13, 3, 'B-Bottom Seal'),
(14, 3, 'C-Side Gusset'),
(15, 4, 'L-Length'),
(16, 4, 'W-Width'),
(17, 4, 'A-Center Seal'),
(18, 4, 'B-Top Seal'),
(19, 4, 'C-Side Gusset'),
(20, 5, 'L-Length'),
(21, 5, 'W-Width'),
(22, 5, 'A-Bottom Seal'),
(23, 5, 'B-Side Seal Width'),
(24, 5, 'C-Side Gusset'),
(25, 6, 'L-Length'),
(26, 6, 'W-Width'),
(27, 6, 'A-Top Seal'),
(28, 6, 'B-Side Seal Width'),
(29, 6, 'C-Side Gusset'),
(30, 7, 'L-Length'),
(31, 7, 'W-Width'),
(32, 7, 'A-Side Seal Width'),
(33, 7, 'B-Bottom Seal'),
(34, 8, 'L-Length'),
(35, 8, 'W-Width'),
(36, 8, 'A-Side Seal Width'),
(37, 8, 'B-Top Seal'),
(38, 9, 'L-Length'),
(39, 9, 'W-Width'),
(40, 9, 'A-Side Seal Width'),
(41, 9, 'B-Side Gusset'),
(42, 9, 'C-Bottom Gusset'),
(43, 9, 'D-Bottom Seal'),
(44, 9, 'E-Zipper Distance'),
(45, 10, 'L-Length'),
(46, 10, 'W-Width'),
(47, 10, 'A-Side Seal Width'),
(48, 10, 'B-Side Gusset'),
(49, 10, 'C-Bottom Gusset'),
(50, 10, 'D-Bottom Seal'),
(51, 10, 'E-Zipper Distance'),
(52, 10, 'F-Top Seal'),
(53, 11, 'L-Length'),
(54, 11, 'W-Width'),
(55, 11, 'A-Side Seal Width'),
(56, 11, 'B-Side Gusset'),
(57, 11, 'C-Bottom Seal'),
(58, 11, 'D-Bottom Seal'),
(59, 12, 'L-Length'),
(60, 12, 'W-Width'),
(61, 12, 'A-Side Seal Width'),
(62, 12, 'B-Side Gusset'),
(63, 12, 'C-Bottom Gusset'),
(64, 12, 'D-Bottom Seal'),
(65, 12, 'E-Top Seal'),
(66, 13, 'L-Length'),
(67, 13, 'W-Width'),
(68, 13, 'A-Side Seal Width'),
(69, 13, 'B-Bottom Seal'),
(70, 14, 'L-Length'),
(71, 14, 'W-Width'),
(72, 14, 'A-Side Seal Width'),
(73, 15, 'L-Length'),
(74, 15, 'W-Width'),
(75, 15, 'A-Side Seal Width'),
(76, 15, 'B-Bottom Seal'),
(77, 16, 'L-Length'),
(78, 16, 'W-Width'),
(79, 16, 'A-Side Seal Width'),
(80, 16, 'B-Bottom Seal');

-- --------------------------------------------------------

--
-- Table structure for table `pouch_digital_sub`
--

DROP TABLE IF EXISTS `pouch_digital_sub`;
CREATE TABLE IF NOT EXISTS `pouch_digital_sub` (
  `pds_id` int(25) NOT NULL AUTO_INCREMENT,
  `pds_pdm_id` int(25) NOT NULL,
  `pds_name` varchar(80) NOT NULL,
  `pds_url` varchar(80) NOT NULL,
  `pds_valid` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pds_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pouch_digital_sub`
--

INSERT INTO `pouch_digital_sub` (`pds_id`, `pds_pdm_id`, `pds_name`, `pds_url`, `pds_valid`) VALUES
(1, 1, 'Center Seal Pouch Top Open', 'assets/wo/pouch/1_1_1.jpg', 1),
(2, 1, 'Center Seal Pouch Bottom Open', 'assets/wo/pouch/1_1_2.jpg', 1),
(3, 2, 'SG Center Seal Pouch Top Open', 'assets/wo/pouch/1_2_3.jpg', 1),
(4, 2, 'SG Center Seal Pouch Bottom Open', 'assets/wo/pouch/1_2_4.jpg', 1),
(5, 3, 'Center Seal Pouch & With 4 Hole Punch (Top Open)', 'assets/wo/pouch/1_3_5.jpg', 1),
(6, 3, 'Center Seal Pouch & With Straight Handle (Top Open)\r\n', 'assets/wo/pouch/1_3_6.jpg', 1),
(7, 4, '3 Side Seal Pouch Top Open', 'assets/wo/pouch/1_4_7.jpg', 1),
(8, 4, '3 Side Seal Pouch Bottom Open', 'assets/wo/pouch/1_4_8.jpg', 1),
(9, 5, 'Flat Bottom Pouch with Zipper & Top Open\r\n', 'assets/wo/pouch/1_5_9.jpg', 1),
(10, 5, 'Flat Bottom Pouch with Zipper & Bottom Open\r\n', 'assets/wo/pouch/1_5_10.jpg', 1),
(11, 5, 'Flat Bottom Pouch Top Open\r\n', 'assets/wo/pouch/1_5_11.jpg', 1),
(12, 5, 'Flat Bottom Pouch Bottom Open', 'assets/wo/pouch/1_5_12.jpg', 1),
(13, 6, 'Standup K Seal Pouch Bottom Seal', 'assets/wo/pouch/1_6_13.jpg', 1),
(14, 6, 'Standup K Seal Pouch Bottom Fold', 'assets/wo/pouch/1_6_14.jpg', 1),
(15, 7, 'Standup Doy Pouch (Bottom Straight)\r\n', 'assets/wo/pouch/1_7_15.jpg', 1),
(16, 7, 'Standup Doy Pouch (Bottom Curved)\r\n', 'assets/wo/pouch/1_7_16.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `remarks_identity`
--

DROP TABLE IF EXISTS `remarks_identity`;
CREATE TABLE IF NOT EXISTS `remarks_identity` (
  `remarkiden_id` int(15) NOT NULL AUTO_INCREMENT,
  `remarkiden_vale` varchar(500) NOT NULL,
  PRIMARY KEY (`remarkiden_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remarks_identity`
--

INSERT INTO `remarks_identity` (`remarkiden_id`, `remarkiden_vale`) VALUES
(1, 'Overall'),
(2, 'Pouch'),
(3, 'Roll'),
(4, 'Bag');

-- --------------------------------------------------------

--
-- Table structure for table `remarks_wo`
--

DROP TABLE IF EXISTS `remarks_wo`;
CREATE TABLE IF NOT EXISTS `remarks_wo` (
  `remark_id` int(255) NOT NULL AUTO_INCREMENT,
  `remark_lum_id` int(255) NOT NULL,
  `remark_text` text NOT NULL,
  `remark_master_wo_id` int(255) NOT NULL,
  `remark_dnt` varchar(698) NOT NULL,
  `remark_type` int(5) NOT NULL,
  `remark_status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`remark_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_groups_master`
--

DROP TABLE IF EXISTS `sales_groups_master`;
CREATE TABLE IF NOT EXISTS `sales_groups_master` (
  `sgm_id` int(5) NOT NULL AUTO_INCREMENT,
  `sgm_name` varchar(25) NOT NULL,
  PRIMARY KEY (`sgm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_groups_master`
--

INSERT INTO `sales_groups_master` (`sgm_id`, `sgm_name`) VALUES
(1, 'Group 1'),
(2, 'Group 2'),
(3, 'Group 3'),
(4, 'Group 4'),
(5, 'Group 5');

-- --------------------------------------------------------

--
-- Table structure for table `sales_groups_people`
--

DROP TABLE IF EXISTS `sales_groups_people`;
CREATE TABLE IF NOT EXISTS `sales_groups_people` (
  `sgp_id` int(25) NOT NULL AUTO_INCREMENT,
  `sgp_sgm_id` int(25) NOT NULL,
  `sgp_lum_id` int(25) NOT NULL,
  PRIMARY KEY (`sgp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_groups_people`
--

INSERT INTO `sales_groups_people` (`sgp_id`, `sgp_sgm_id`, `sgp_lum_id`) VALUES
(1, 1, 1),
(6, 2, 1),
(3, 3, 1),
(4, 5, 1),
(5, 4, 1),
(7, 1, 6),
(8, 1, 4),
(9, 1, 5),
(10, 1, 3),
(11, 2, 7),
(12, 2, 8),
(13, 2, 16),
(14, 2, 9),
(15, 3, 10),
(16, 3, 11),
(17, 3, 12),
(18, 4, 13),
(19, 4, 14),
(20, 4, 15),
(21, 5, 18),
(22, 5, 17),
(23, 5, 2),
(24, 4, 2),
(25, 2, 2),
(28, 1, 2),
(27, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `session_tracker`
--

DROP TABLE IF EXISTS `session_tracker`;
CREATE TABLE IF NOT EXISTS `session_tracker` (
  `sess_id` int(255) NOT NULL AUTO_INCREMENT,
  `sess_lum_id` int(255) NOT NULL,
  `sess_hash` varchar(698) NOT NULL,
  `sess_dnt` varchar(698) NOT NULL,
  `sess_ip` varchar(698) NOT NULL,
  `sess_valid` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sess_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_tracker`
--

INSERT INTO `session_tracker` (`sess_id`, `sess_lum_id`, `sess_hash`, `sess_dnt`, `sess_ip`, `sess_valid`) VALUES
(1, 1, 'IPPSESSID609324b281f2e', '1620255922', '94.203.255.182', 0),
(2, 1, 'IPPSESSID6093b00536be3', '1620291589', '127.0.0.1', 0),
(3, 1, 'IPPSESSID6099182f57532', '1620645935', '127.0.0.1', 0),
(4, 1, 'IPPSESSID609af8b3ccbe2', '1620768947', '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_pending`
--

DROP TABLE IF EXISTS `users_pending`;
CREATE TABLE IF NOT EXISTS `users_pending` (
  `pending_id` int(255) NOT NULL AUTO_INCREMENT,
  `pending_name` varchar(698) NOT NULL,
  `pending_email` varchar(698) NOT NULL,
  `pending_hash` varchar(698) NOT NULL,
  `pending_code` varchar(50) NOT NULL,
  `pending_type` int(255) NOT NULL,
  `pending_dnt` varchar(698) NOT NULL,
  `pending_valid` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pending_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_main`
--

DROP TABLE IF EXISTS `user_main`;
CREATE TABLE IF NOT EXISTS `user_main` (
  `lum_id` int(255) NOT NULL AUTO_INCREMENT,
  `lum_user_type` int(25) NOT NULL,
  `lum_code` varchar(698) NOT NULL,
  `lum_email` varchar(698) NOT NULL,
  `lum_hash` varchar(698) NOT NULL,
  `lum_name` varchar(698) NOT NULL,
  `lum_dnt` varchar(698) NOT NULL,
  `lum_deact` varchar(698) DEFAULT NULL,
  `lum_valid` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lum_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_main`
--

INSERT INTO `user_main` (`lum_id`, `lum_user_type`, `lum_code`, `lum_email`, `lum_hash`, `lum_name`, `lum_dnt`, `lum_deact`, `lum_valid`) VALUES
(1, 1, 'SU-1', 'superuser.ipp@gmail.com', '40ab1d1cfed0e3c9f34190a1142b2d70', 'SUPERUSER', '1619861978', NULL, 1),
(2, 2, 'MD-1', 'intgpack@eim.ae', '03a7369f441c0914e84cb85375bc8b25', 'Ahmed S.', '1612080796', NULL, 1),
(3, 16, 'S-03', 'mohammed.nasrullah@ipp.ae', '1d0ca1ce447758073b972bda3dd358f9', 'Nasrullah', '1612080796', NULL, 1),
(4, 18, 'S-21', 'ritesh.tak@ipp.ae', 'c25dfca2b6adc76da56cba19ab48c822', 'Ritesh ', '1612080796', NULL, 1),
(5, 18, 'S-22', 'ankit.kumar@ipp.ae', 'bec120bb11ef0a0240fb9f2c89e8419a', 'Ankit', '1612080796', NULL, 1),
(6, 4, 'S-25', 'upashna.s@ipp.ae', 'c56a5ef62e82a86e9075c943e22407f8', 'Upashna', '1612080796', NULL, 1),
(7, 4, 'S-28', 'pulkit.jain@ipp.ae', 'f1a6e0d65d7677d8b202d166dc7f7b53', 'Pulkit', '1612080796', NULL, 1),
(8, 18, 'S-17', 'alihasan@ipp.ae', 'e1a1399a79373cd947932247ae37af67', 'Ali', '1612080796', NULL, 1),
(9, 16, 'S-02', 'malik.tauqeer@ipp.ae', 'd0b5b3ecfc3a0a14fa31b79687f4a828', 'Malik', '1612080796', NULL, 1),
(10, 4, 'S-26', 'Madina.ayazbayeva@ipp.ae', '0971e24864f586e62401bbc4311dee31', 'Madina', '1612080796', NULL, 1),
(11, 18, 'S-13', 'shivang.sharma@ipp.ae', 'a3ef6d5e9f6e5d7e16ed5455a230a2bd', 'Shivang', '1612080796', NULL, 1),
(12, 18, 'S-19 M', 'navneet.behl@ipp.ae', 'ed7cee7d5be7e545766030dcf4609220', 'Navneet', '1612080796', NULL, 1),
(13, 4, 'S-27', 'rahil.asif@ipp.ae', 'c78e91cc8919e7548ebebe7dbcfb03b1', 'Rahil', '1612080796', NULL, 1),
(14, 18, 'S-11 Abrey', 'abrey.page@ipp.ae', '2f33e89ba4b7473dffa8d56a2cc6cf55', 'Abrey ', '1612080796', NULL, 1),
(15, 18, 'S-11', 'arjun.chitra@ipp.ae', '9cc271b1acfcd11e6e6d82ed8ccebcda', 'Arjun', '1612080796', NULL, 1),
(16, 18, 'S-18', 'basel.meaari@ipp.ae', 'd55761f91d63dbf8b8a431d65d8562c8', 'Basel', '1612080796', NULL, 1),
(17, 18, 'S-19E', 'ian.crofts@ipp.ae', '27c2bad7efb2b2a580ec1a8ec22b8092', 'Ian', '1612080796', NULL, 1),
(18, 1, 'S-24', 'abid.r@ipp.ae', '359e2dffe8d35e602a1b8e63177fe642', 'Abid', '1612080796', NULL, 1),
(19, 15, 'NA', 'accounts.receivable@ipp.ae', 'adac8ce70e7c0a0986eafeea2c3d7b8d', 'Accounts R.', '1612080796', NULL, 1),
(20, 5, 'NA', 'jayachandran@ipp.ae', 'da1262cac838bbf67ceda1136f89d22d', 'JC', '1612080796', NULL, 1),
(21, 17, 'NA', 'qc.manager@ipp.ae', '79a176ae10608fa23e5204cef872281d', 'Bipin', '1612080796', NULL, 1),
(22, 17, 'NA', 'manoj.pandey@ipp.ae', '5ddee9fcfad5bf742999b4f768bdeef8', 'MP', '1612080796', NULL, 1),
(23, 3, 'NA', 'steven.baretto@ipp.ae', '9e3bb021bdb5a55ee92cfefba1578c4d', 'Steven', '1612080796', NULL, 1),
(24, 19, 'NA', 'ppc@ipp.ae', '7a8592a0dbd7f4051c12c640d1095c94', 'Shakil', '1612080796', NULL, 1),
(25, 2, 'MD-2', 'shahid@ipp.ae', 'fcfa4fd0a77d1d4eef40c1517598ce4c', 'Shahid S.', '1612080796', NULL, 1),
(26, 5, 'TECH1', 'technical@ipp.ae', '21863a5f121dc9529c4f2846a87273f8', 'BP Singh', '1615191879', NULL, 1),
(27, 5, 'TECH2', 'm.shahzad@ipp.ae', 'c9994eadf3b0b9d680577aafb285411f', 'Shahzad', '1615191907', NULL, 1),
(28, 20, 'NA-27', 'cylinders@ipp.ae', '99493e04d1536e4a49695738346aa4d4', 'Nitin', '1615192243', NULL, 1),
(29, 20, 'na-28', 'artworks@ipp.ae', '845c9fe3dc9e867d886b58df3a13c776', 'Surya', '1615192265', NULL, 1),
(30, 20, 'na-29', 'mrp@ipp.ae', '5984304acb95ade254de345699f0553a', 'Shadab', '1615192282', NULL, 1),
(31, 20, 'na-30', 'precosting@ipp.ae', 'cdc0ac20f13f00e9aafeb54f4a40550f', 'Fayyas', '1615192299', NULL, 1),
(32, 20, 'na-31', 'costing@ipp.ae', '308a652fb271fcb21956b9b4155904dc', 'Sameer', '1615192323', NULL, 1),
(33, 20, 'na-32', 'nilesh.vadnere@ipp.ae', 'f53d77646a6bb94ca1cf4ed6ad484a0c', 'Nilesh', '1615192340', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE IF NOT EXISTS `user_types` (
  `user_type_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(255) NOT NULL,
  `user_type_access` varchar(698) NOT NULL,
  `user_type_landing` varchar(698) NOT NULL,
  `user_type_mod_id` varchar(698) NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`user_type_id`, `user_type_name`, `user_type_access`, `user_type_landing`, `user_type_mod_id`) VALUES
(1, 'Master Admin', '-', 'home', '*'),
(2, 'Managing Director', '-', 'home', '*'),
(3, 'IT Admin', '-', 'home', '34,37,1,12,13,35,33,33,27,55'),
(4, 'Sales Co-Ordinator', '-', 'work_order_sales', '1,14,21,35,2,9,11,22,10,42,43,40,41,27,23,47,54'),
(5, 'Technical Team', '-', 'work_order_technical', '1,14,16,21,23,25,26,27,35,47'),
(7, 'ALL', '-', 'work_order_all', '1,23,27,44,47,48'),
(15, 'Accounts Agent', '-', 'work_order_accounts', '1,18,21,23,27,28,30,47,14'),
(16, 'Sales Manager', '-', 'work_order_sales_verify', '1,15,14,22,27,10,11,2,21,23,35,40,41,42,43,9,47,54'),
(17, 'Technical verify', '-', 'work_order_technical_verify', '1,14,45,21,23,25,26,27,35,47,22'),
(18, 'Assistant Sales Manager', '-', 'work_order_sales', '1,15,14,21,35,2,9,11,22,10,42,43,40,41,27,23,47,54'),
(19, 'ALL - Complete', '-', 'work_order_all', '1,23,27,44,47,48,56,14'),
(20, 'ALL - View Published', '-', 'work_order_all_published', '1,23,27,44,47,48');

-- --------------------------------------------------------

--
-- Table structure for table `work_order_applications`
--

DROP TABLE IF EXISTS `work_order_applications`;
CREATE TABLE IF NOT EXISTS `work_order_applications` (
  `application_id` int(255) NOT NULL AUTO_INCREMENT,
  `application_value` varchar(698) NOT NULL,
  `application_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`application_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_applications`
--

INSERT INTO `work_order_applications` (`application_id`, `application_value`, `application_show`) VALUES
(1, 'FROZEN MEAT\n', 1),
(2, 'TOMATO PASTE HOT FILL', 1),
(3, 'TOMATO PASTE COLD FILL', 1),
(4, 'EDIBLE OIL', 1),
(5, 'FATS', 1),
(6, 'MARGARINE', 1),
(7, 'BUTTER', 1),
(8, 'PET FOOD DRY - DOG', 1),
(9, 'PET FOOD DRY - CAT', 1),
(10, 'PET FOOD WET - DOG', 1),
(11, 'PET FOOD WET - CAT', 1),
(12, 'FERTILIZER', 1),
(13, 'BIRD SEEDS', 1),
(14, 'DRY FRUITS', 1),
(15, 'PULSES', 1),
(16, 'POWDER', 1),
(17, 'WHOLE LEAVES', 1),
(18, 'LIQUID JUICE DRINK', 1),
(19, 'INSTANT DRINK POWDER', 1),
(20, 'SPICES', 1),
(21, 'GRAINS', 1),
(22, 'DATES', 1),
(23, 'CONDIMENTS', 1),
(24, 'HARD BOILED CANDY', 1),
(25, 'WET WIPES', 1),
(26, 'HAND SANITIZERS', 1),
(27, 'BABY WIPES', 1),
(28, 'DRY SNACKS', 1),
(29, 'OUTER POLY BAG', 1),
(30, 'SHRINK PE', 1),
(31, 'CHEESE PACKING (SLICES & SHREDDED & BLOCK)', 1),
(32, 'CHIPS', 1),
(33, 'FROZEN VEGETABLES', 1),
(34, 'PASTRY DOUGH', 1),
(35, 'RICE', 1),
(36, 'BREAD & BAKERY', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_digital_master`
--

DROP TABLE IF EXISTS `work_order_digital_master`;
CREATE TABLE IF NOT EXISTS `work_order_digital_master` (
  `dm_id` int(20) NOT NULL AUTO_INCREMENT,
  `dm_type` varchar(5) NOT NULL COMMENT '1=pouch , 2=bag',
  `dm_img_url` varchar(100) NOT NULL,
  `dm_header` varchar(100) NOT NULL,
  `dm_vals` int(5) NOT NULL,
  PRIMARY KEY (`dm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_digital_master`
--

INSERT INTO `work_order_digital_master` (`dm_id`, `dm_type`, `dm_img_url`, `dm_header`, `dm_vals`) VALUES
(1, '1', 'assets/wo/pouch/1.jpg', 'Center Seal Pouch with Top Open', 8),
(2, '1', 'assets/wo/pouch/2.jpg', 'Center Seal Pouch with Bottom Open', 8),
(3, '1', 'assets/wo/pouch/3.jpg', 'Flat bottom Pouch with Zipper & without handle', 1),
(4, '1', 'assets/wo/pouch/4.jpg', 'Flat bottom Pouch without Zipper & with handle', 7),
(5, '1', 'assets/wo/pouch/5.jpg', 'SG Center Seal Pouch without Handle Punch (Top Open)', 7),
(6, '1', 'assets/wo/pouch/6.jpg', 'SG Center Seal Pouch without Handle Punch (Bottom Open)', 7),
(7, '1', 'assets/wo/pouch/7.jpg', 'SG Center Seal Pouch with Handle', 5),
(8, '1', 'assets/wo/pouch/8.jpg', '3 Side Seal Pouch without euro punch', 1),
(9, '1', 'assets/wo/pouch/9.jpg', '3 Side Seal Pouch with euro punch', 6),
(10, '1', 'assets/wo/pouch/10.jpg', 'Quadro pouch with rope handle', 7),
(11, '1', 'assets/wo/pouch/11.jpg', 'Quadro pouch with handle Punch', 7),
(12, '1', 'assets/wo/pouch/12.jpg', 'Standup K Seal pouch with handle Punch (Bottom Curved)', 5),
(13, '1', 'assets/wo/pouch/13.jpg', 'Standup K Seal pouch with handle Punch (Straight Curved)', 8),
(14, '1', 'assets/wo/pouch/14.jpg', 'Standup K Seal pouch with Euro Punch (Bottom Curved)', 7),
(15, '1', 'assets/wo/pouch/15.jpg', 'Standup K Seal pouch with Euro Punch (Straight Curved)', 7),
(16, '1', 'assets/wo/pouch/16.jpg', 'Standup Doy Pack with EURO Punch (Bottom Curved)', 8),
(17, '1', 'assets/wo/pouch/17.jpg', 'Standup Doy Pack with EURO Punch (Straight Curved)', 8),
(18, '1', 'assets/wo/pouch/18.jpg', 'Standup Doy Pack with Handle Punch (Bottom Curved)', 8),
(19, '1', 'assets/wo/pouch/19.jpg', 'Standup Doy Pack with Handle Punch (Straight Curved)', 8),
(20, '2', 'assets/wo/bag/2_1.jpg', 'Bag Single Weld & Bottom Fold', 4),
(21, '2', 'assets/wo/bag/2_2.jpg', 'Bag Double Weld & Bottom Fold', 5),
(22, '2', 'assets/wo/bag/2_3.jpg', 'Bag Single Weld & Bottom Gusset', 6),
(23, '2', 'assets/wo/bag/2_4.jpg', 'Bag Double Weld & Bottom Gusset', 6),
(24, '2', 'assets/wo/bag/2_5.jpg', 'Bag Side Gusset & Bottom Seal', 6);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_digital_params`
--

DROP TABLE IF EXISTS `work_order_digital_params`;
CREATE TABLE IF NOT EXISTS `work_order_digital_params` (
  `param_id` int(10) NOT NULL AUTO_INCREMENT,
  `param_head` varchar(50) NOT NULL,
  PRIMARY KEY (`param_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_digital_params`
--

INSERT INTO `work_order_digital_params` (`param_id`, `param_head`) VALUES
(1, 'Pouch Height'),
(2, 'Pouch Width'),
(3, 'Notch Distance'),
(4, 'Zipper Distance'),
(5, 'Side Seal Size'),
(6, 'Bottom Seal Size'),
(7, 'Bottom Gusset Size'),
(8, 'Euro Notch Size');

-- --------------------------------------------------------

--
-- Table structure for table `work_order_pack_size_unit`
--

DROP TABLE IF EXISTS `work_order_pack_size_unit`;
CREATE TABLE IF NOT EXISTS `work_order_pack_size_unit` (
  `psu_id` int(50) NOT NULL AUTO_INCREMENT,
  `psu_value` varchar(25) NOT NULL,
  `psu_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`psu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_pack_size_unit`
--

INSERT INTO `work_order_pack_size_unit` (`psu_id`, `psu_value`, `psu_show`) VALUES
(1, 'mg', 1),
(2, 'g', 1),
(3, 'kg', 1),
(4, 'Oz', 1),
(5, 'ml', 1),
(6, 'L', 1),
(7, 'pieces', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_product_type_printed`
--

DROP TABLE IF EXISTS `work_order_product_type_printed`;
CREATE TABLE IF NOT EXISTS `work_order_product_type_printed` (
  `ptp_id` int(50) NOT NULL AUTO_INCREMENT,
  `ptp_value` varchar(25) NOT NULL,
  `ptp_show` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ptp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_product_type_printed`
--

INSERT INTO `work_order_product_type_printed` (`ptp_id`, `ptp_value`, `ptp_show`) VALUES
(1, 'Printed', 1),
(2, 'Unprinted', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_qty_units`
--

DROP TABLE IF EXISTS `work_order_qty_units`;
CREATE TABLE IF NOT EXISTS `work_order_qty_units` (
  `unit_id` int(50) NOT NULL AUTO_INCREMENT,
  `unit_value` varchar(698) NOT NULL,
  `unit_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`unit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_qty_units`
--

INSERT INTO `work_order_qty_units` (`unit_id`, `unit_value`, `unit_show`) VALUES
(1, 'KGs', 1),
(2, 'KMs', 1),
(3, 'PCs', 1),
(4, 'IMPs', 1),
(5, 'MTR', 1),
(6, 'ROLLs', 1),
(7, 'LABELs', 1),
(8, 'L.MTR', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_bag_handle`
--

DROP TABLE IF EXISTS `work_order_ui_bag_handle`;
CREATE TABLE IF NOT EXISTS `work_order_ui_bag_handle` (
  `bag_handle_id` int(5) NOT NULL AUTO_INCREMENT,
  `bag_handle_value` varchar(25) NOT NULL,
  `bag_handle_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`bag_handle_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_bag_handle`
--

INSERT INTO `work_order_ui_bag_handle` (`bag_handle_id`, `bag_handle_value`, `bag_handle_show`) VALUES
(1, '1 Hole Punch', 1),
(2, '2 Hole Punch', 1),
(3, 'Straight Handle', 1),
(4, 'Half Cut Straight Handle', 1),
(5, 'Banana Handle', 1),
(6, 'Half Cut Banana Handle', 1),
(7, 'Kidney Handle', 1),
(8, 'Half Cut Kidney Handle', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_customer_location`
--

DROP TABLE IF EXISTS `work_order_ui_customer_location`;
CREATE TABLE IF NOT EXISTS `work_order_ui_customer_location` (
  `customer_location_id` int(5) NOT NULL AUTO_INCREMENT,
  `customer_location_value` varchar(100) NOT NULL,
  `customer_location_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`customer_location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_customer_location`
--

INSERT INTO `work_order_ui_customer_location` (`customer_location_id`, `customer_location_value`, `customer_location_show`) VALUES
(1, 'Local', 1),
(2, 'GCC', 1),
(3, 'Export', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_ext_cof`
--

DROP TABLE IF EXISTS `work_order_ui_ext_cof`;
CREATE TABLE IF NOT EXISTS `work_order_ui_ext_cof` (
  `cof_id` int(5) NOT NULL AUTO_INCREMENT,
  `cof_value` varchar(100) NOT NULL,
  `cof_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cof_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_ext_cof`
--

INSERT INTO `work_order_ui_ext_cof` (`cof_id`, `cof_value`, `cof_show`) VALUES
(1, 'L.Slip', 1),
(2, 'Normal', 1),
(3, 'H.Slip', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_filling_temp`
--

DROP TABLE IF EXISTS `work_order_ui_filling_temp`;
CREATE TABLE IF NOT EXISTS `work_order_ui_filling_temp` (
  `filling_temp_id` int(25) NOT NULL AUTO_INCREMENT,
  `filling_temp_value` varchar(25) NOT NULL,
  `filling_temp_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`filling_temp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_filling_temp`
--

INSERT INTO `work_order_ui_filling_temp` (`filling_temp_id`, `filling_temp_value`, `filling_temp_show`) VALUES
(1, 'Cold', 1),
(2, 'Room Temp', 1),
(3, 'Hot', 1),
(4, 'Pasturization', 1),
(5, 'RETORT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_foil_print_side`
--

DROP TABLE IF EXISTS `work_order_ui_foil_print_side`;
CREATE TABLE IF NOT EXISTS `work_order_ui_foil_print_side` (
  `foil_print_side_id` int(5) NOT NULL AUTO_INCREMENT,
  `foil_print_side_value` varchar(50) NOT NULL,
  `foil_print_side_show` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`foil_print_side_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_foil_print_side`
--

INSERT INTO `work_order_ui_foil_print_side` (`foil_print_side_id`, `foil_print_side_value`, `foil_print_side_show`) VALUES
(1, 'Print on Dull Side of Foil', 1),
(2, 'Print on Bright side of Foil', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_lam_options`
--

DROP TABLE IF EXISTS `work_order_ui_lam_options`;
CREATE TABLE IF NOT EXISTS `work_order_ui_lam_options` (
  `lamo_id` int(10) NOT NULL AUTO_INCREMENT,
  `lamo_value` varchar(25) NOT NULL,
  `lamo_show` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lamo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_lam_options`
--

INSERT INTO `work_order_ui_lam_options` (`lamo_id`, `lamo_value`, `lamo_show`) VALUES
(1, 'Cold Seal', 1),
(2, 'Heat Seal', 1),
(3, 'FC Matte Lacquer', 1),
(4, 'Registered Matte Lacquer', 1),
(5, 'OPV', 1),
(6, 'None', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_lsd_required`
--

DROP TABLE IF EXISTS `work_order_ui_lsd_required`;
CREATE TABLE IF NOT EXISTS `work_order_ui_lsd_required` (
  `lsd_required_id` int(10) NOT NULL AUTO_INCREMENT,
  `lsd_required_value` varchar(25) NOT NULL,
  `lsd_required_show` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lsd_required_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_lsd_required`
--

INSERT INTO `work_order_ui_lsd_required` (`lsd_required_id`, `lsd_required_value`, `lsd_required_show`) VALUES
(1, 'No', 1),
(2, 'Yes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pallet_size`
--

DROP TABLE IF EXISTS `work_order_ui_pallet_size`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pallet_size` (
  `pallet_size_id` int(5) NOT NULL AUTO_INCREMENT,
  `pallet_size_value` varchar(50) NOT NULL,
  `pallet_size_show` int(5) NOT NULL,
  PRIMARY KEY (`pallet_size_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pallet_size`
--

INSERT INTO `work_order_ui_pallet_size` (`pallet_size_id`, `pallet_size_value`, `pallet_size_show`) VALUES
(1, '100 x 120 cms', 1),
(2, '115 x 115 cms', 1),
(3, '110 x 110 cms', 1),
(4, '80 x 120 cms', 1),
(5, 'Custom Size', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_partial_del`
--

DROP TABLE IF EXISTS `work_order_ui_partial_del`;
CREATE TABLE IF NOT EXISTS `work_order_ui_partial_del` (
  `partial_del_id` int(10) NOT NULL AUTO_INCREMENT,
  `partial_del_value` varchar(25) NOT NULL,
  `partial_del_show` int(2) DEFAULT '1',
  PRIMARY KEY (`partial_del_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_partial_del`
--

INSERT INTO `work_order_ui_partial_del` (`partial_del_id`, `partial_del_value`, `partial_del_show`) VALUES
(1, 'No', 1),
(2, 'Yes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pe_film_feature`
--

DROP TABLE IF EXISTS `work_order_ui_pe_film_feature`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pe_film_feature` (
  `pe_film_feature_id` int(50) NOT NULL AUTO_INCREMENT,
  `pe_film_feature_value` varchar(100) NOT NULL,
  `pe_film_feature_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pe_film_feature_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pe_film_feature`
--

INSERT INTO `work_order_ui_pe_film_feature` (`pe_film_feature_id`, `pe_film_feature_value`, `pe_film_feature_show`) VALUES
(1, 'EASY TEAR', 1),
(2, 'PEEL-ABLE', 1),
(3, 'RE-SEAL-ABLE', 1),
(4, 'LINEAR DIRECTION', 1),
(5, 'SHRINK FILM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_bag_fill_opts`
--

DROP TABLE IF EXISTS `work_order_ui_pouch_bag_fill_opts`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pouch_bag_fill_opts` (
  `pbfo_id` int(25) NOT NULL AUTO_INCREMENT,
  `pbfo_value` varchar(50) NOT NULL,
  `pbfo_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pbfo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_bag_fill_opts`
--

INSERT INTO `work_order_ui_pouch_bag_fill_opts` (`pbfo_id`, `pbfo_value`, `pbfo_show`) VALUES
(1, 'Pick and Fill', 1),
(2, 'Vaccum Packing', 1),
(3, 'Manual Fill', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_euro_punch`
--

DROP TABLE IF EXISTS `work_order_ui_pouch_euro_punch`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pouch_euro_punch` (
  `euro_id` int(25) NOT NULL AUTO_INCREMENT,
  `euro_value` varchar(10) NOT NULL,
  `euro_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`euro_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_euro_punch`
--

INSERT INTO `work_order_ui_pouch_euro_punch` (`euro_id`, `euro_value`, `euro_show`) VALUES
(1, 'S', 1),
(2, 'M', 1),
(3, 'L', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_lap_fin`
--

DROP TABLE IF EXISTS `work_order_ui_pouch_lap_fin`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pouch_lap_fin` (
  `lap_fin_id` int(25) NOT NULL AUTO_INCREMENT,
  `lap_fin_value` varchar(25) NOT NULL,
  `lap_fin_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lap_fin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_lap_fin`
--

INSERT INTO `work_order_ui_pouch_lap_fin` (`lap_fin_id`, `lap_fin_value`, `lap_fin_show`) VALUES
(1, 'Lap Seal(In/Out)', 1),
(2, 'Fin Seal (In/Out)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_pack_ins`
--

DROP TABLE IF EXISTS `work_order_ui_pouch_pack_ins`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pouch_pack_ins` (
  `pouch_pack_ins_id` int(5) NOT NULL AUTO_INCREMENT,
  `pouch_pack_ins_value` varchar(50) NOT NULL,
  `pouch_pack_ins_show` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pouch_pack_ins_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_pack_ins`
--

INSERT INTO `work_order_ui_pouch_pack_ins` (`pouch_pack_ins_id`, `pouch_pack_ins_value`, `pouch_pack_ins_show`) VALUES
(1, 'Unprinted Carton without Polybag', 1),
(2, 'Unprinted Carton with Polybag ', 1),
(3, 'Printed Carton with Polybag ', 1),
(4, 'Printed Carton without Polybag ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_perforation`
--

DROP TABLE IF EXISTS `work_order_ui_pouch_perforation`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pouch_perforation` (
  `pouch_perforation_id` int(10) NOT NULL AUTO_INCREMENT,
  `pouch_perforation_value` varchar(25) NOT NULL,
  `pouch_perforation_show` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pouch_perforation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_perforation`
--

INSERT INTO `work_order_ui_pouch_perforation` (`pouch_perforation_id`, `pouch_perforation_value`, `pouch_perforation_show`) VALUES
(1, 'No', 1),
(2, 'Yes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_pe_strip`
--

DROP TABLE IF EXISTS `work_order_ui_pouch_pe_strip`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pouch_pe_strip` (
  `pestrip_id` int(25) NOT NULL AUTO_INCREMENT,
  `pestrip_value` varchar(50) NOT NULL,
  `pestrip_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pestrip_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_pe_strip`
--

INSERT INTO `work_order_ui_pouch_pe_strip` (`pestrip_id`, `pestrip_value`, `pestrip_show`) VALUES
(1, 'Yes', 1),
(2, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_punch_type`
--

DROP TABLE IF EXISTS `work_order_ui_pouch_punch_type`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pouch_punch_type` (
  `punch_id` int(25) NOT NULL AUTO_INCREMENT,
  `punch_value` varchar(80) NOT NULL,
  `punch_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`punch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_punch_type`
--

INSERT INTO `work_order_ui_pouch_punch_type` (`punch_id`, `punch_value`, `punch_show`) VALUES
(1, 'Straight Handle', 1),
(2, 'Half Cut Straight Handle', 1),
(3, 'Banana Handle', 1),
(4, 'Half Cut Banana Handle', 1),
(5, 'Kidney Handle', 1),
(6, 'Half Cut Kidney Handle', 1),
(7, '1 Hole Punch', 1),
(8, '3 Hole Punch', 1),
(9, '4 Hole Punch', 1),
(10, 'Euro Punch', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_round_corner`
--

DROP TABLE IF EXISTS `work_order_ui_pouch_round_corner`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pouch_round_corner` (
  `round_corner_id` int(25) NOT NULL AUTO_INCREMENT,
  `round_corner_value` varchar(10) NOT NULL,
  `round_corner_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`round_corner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_round_corner`
--

INSERT INTO `work_order_ui_pouch_round_corner` (`round_corner_id`, `round_corner_value`, `round_corner_show`) VALUES
(1, 'Yes', 1),
(2, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_tear_notch`
--

DROP TABLE IF EXISTS `work_order_ui_pouch_tear_notch`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pouch_tear_notch` (
  `tear_notch_id` int(25) NOT NULL AUTO_INCREMENT,
  `tear_notch_value` varchar(50) NOT NULL,
  `tear_notch_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tear_notch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_tear_notch`
--

INSERT INTO `work_order_ui_pouch_tear_notch` (`tear_notch_id`, `tear_notch_value`, `tear_notch_show`) VALUES
(1, 'Yes', 1),
(2, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_tear_notch_qty`
--

DROP TABLE IF EXISTS `work_order_ui_pouch_tear_notch_qty`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pouch_tear_notch_qty` (
  `tear_notch_qty_id` int(25) NOT NULL AUTO_INCREMENT,
  `tear_notch_qty_value` varchar(50) NOT NULL,
  `tear_notch_qty_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tear_notch_qty_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_tear_notch_qty`
--

INSERT INTO `work_order_ui_pouch_tear_notch_qty` (`tear_notch_qty_id`, `tear_notch_qty_value`, `tear_notch_qty_show`) VALUES
(1, '1 Side', 1),
(2, '2 Side', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_tear_notch_side`
--

DROP TABLE IF EXISTS `work_order_ui_pouch_tear_notch_side`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pouch_tear_notch_side` (
  `tear_notch_side_id` int(25) NOT NULL AUTO_INCREMENT,
  `tear_notch_side_value` varchar(50) NOT NULL,
  `tear_notch_side_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tear_notch_side_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_tear_notch_side`
--

INSERT INTO `work_order_ui_pouch_tear_notch_side` (`tear_notch_side_id`, `tear_notch_side_value`, `tear_notch_side_show`) VALUES
(1, 'Width', 1),
(2, 'Length', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_zipper`
--

DROP TABLE IF EXISTS `work_order_ui_pouch_zipper`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pouch_zipper` (
  `zipper_id` int(25) NOT NULL AUTO_INCREMENT,
  `zipper_value` varchar(50) NOT NULL,
  `zipper_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`zipper_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_zipper`
--

INSERT INTO `work_order_ui_pouch_zipper` (`zipper_id`, `zipper_value`, `zipper_show`) VALUES
(1, 'Yes', 1),
(2, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_zipper_opc`
--

DROP TABLE IF EXISTS `work_order_ui_pouch_zipper_opc`;
CREATE TABLE IF NOT EXISTS `work_order_ui_pouch_zipper_opc` (
  `zipopc_id` int(25) NOT NULL AUTO_INCREMENT,
  `zipopc_value` varchar(56) NOT NULL,
  `zipopc_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`zipopc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_zipper_opc`
--

INSERT INTO `work_order_ui_pouch_zipper_opc` (`zipopc_id`, `zipopc_value`, `zipopc_show`) VALUES
(1, 'Open', 1),
(2, 'Close', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_end_options`
--

DROP TABLE IF EXISTS `work_order_ui_print_end_options`;
CREATE TABLE IF NOT EXISTS `work_order_ui_print_end_options` (
  `print_end_opts_id` int(11) NOT NULL AUTO_INCREMENT,
  `print_end_opts_value` varchar(25) NOT NULL,
  `print_end_opts_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`print_end_opts_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_end_options`
--

INSERT INTO `work_order_ui_print_end_options` (`print_end_opts_id`, `print_end_opts_value`, `print_end_opts_show`) VALUES
(1, 'OP Varnish', 1),
(2, 'Matte Lacquer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_options`
--

DROP TABLE IF EXISTS `work_order_ui_print_options`;
CREATE TABLE IF NOT EXISTS `work_order_ui_print_options` (
  `print_options_id` int(5) NOT NULL AUTO_INCREMENT,
  `print_options_value` varchar(100) NOT NULL,
  `print_options_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`print_options_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_options`
--

INSERT INTO `work_order_ui_print_options` (`print_options_id`, `print_options_value`, `print_options_show`) VALUES
(1, 'Customer', 1),
(2, 'IPP-Sales', 1),
(7, 'IPP-QC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_shadecardreq`
--

DROP TABLE IF EXISTS `work_order_ui_print_shadecardreq`;
CREATE TABLE IF NOT EXISTS `work_order_ui_print_shadecardreq` (
  `shadecardreq_id` int(5) NOT NULL AUTO_INCREMENT,
  `shadecardreq_value` varchar(100) NOT NULL,
  `shadecardreq_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`shadecardreq_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `work_order_ui_print_shadecard_ref_type`;
CREATE TABLE IF NOT EXISTS `work_order_ui_print_shadecard_ref_type` (
  `shadecard_ref_type_id` int(5) NOT NULL AUTO_INCREMENT,
  `shadecard_ref_type_value` varchar(100) NOT NULL,
  `shadecard_ref_type_show` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`shadecard_ref_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_shadecard_ref_type`
--

INSERT INTO `work_order_ui_print_shadecard_ref_type` (`shadecard_ref_type_id`, `shadecard_ref_type_value`, `shadecard_ref_type_show`) VALUES
(2, 'GMG', 1),
(3, 'Cylinder Proof', 1),
(4, 'Customer Sample', 1),
(6, 'Shade as per last supply', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_surfrev`
--

DROP TABLE IF EXISTS `work_order_ui_print_surfrev`;
CREATE TABLE IF NOT EXISTS `work_order_ui_print_surfrev` (
  `surfrev_id` int(6) NOT NULL AUTO_INCREMENT,
  `surfrev_value` varchar(100) NOT NULL,
  `surfrev_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`surfrev_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_surfrev`
--

INSERT INTO `work_order_ui_print_surfrev` (`surfrev_id`, `surfrev_value`, `surfrev_show`) VALUES
(1, 'Surface', 1),
(2, 'Reverse', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_repeat_types`
--

DROP TABLE IF EXISTS `work_order_ui_repeat_types`;
CREATE TABLE IF NOT EXISTS `work_order_ui_repeat_types` (
  `rept_id` int(5) NOT NULL AUTO_INCREMENT,
  `rept_value` varchar(20) NOT NULL,
  `rept_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`rept_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_repeat_types`
--

INSERT INTO `work_order_ui_repeat_types` (`rept_id`, `rept_value`, `rept_show`) VALUES
(1, 'Text', 1),
(2, 'Color', 1),
(3, 'Structure', 1),
(4, 'B\'Code', 1),
(5, 'Other', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_roll_options`
--

DROP TABLE IF EXISTS `work_order_ui_roll_options`;
CREATE TABLE IF NOT EXISTS `work_order_ui_roll_options` (
  `rollopts_id` int(25) NOT NULL AUTO_INCREMENT,
  `rollopts_value` varchar(50) NOT NULL,
  `rollopts_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`rollopts_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_roll_options`
--

INSERT INTO `work_order_ui_roll_options` (`rollopts_id`, `rollopts_value`, `rollopts_show`) VALUES
(1, 'Horizontal Flow Wrap', 1),
(2, 'Vertical Form Fill', 1),
(3, 'Vertical Multi Trak Stick Pack', 1),
(4, 'Vertical Multii Track Sachet', 1),
(5, 'Horizontal Multi Track Sachet', 1),
(6, 'Teq Bag Wrapping Machine Envelope Pack', 1),
(7, 'Vaccum Packing', 1),
(8, 'Horizontal Doy Pack Filling Machine', 1),
(9, 'Thermo Foaming', 1),
(10, 'High Speed Label Machine', 1),
(11, 'Vertical Quadro Pouch Filling Machine', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_shipment`
--

DROP TABLE IF EXISTS `work_order_ui_shipment`;
CREATE TABLE IF NOT EXISTS `work_order_ui_shipment` (
  `shipment_id` int(5) NOT NULL AUTO_INCREMENT,
  `shipment_value` varchar(50) NOT NULL,
  `shipment_show` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`shipment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_shipment`
--

INSERT INTO `work_order_ui_shipment` (`shipment_id`, `shipment_value`, `shipment_show`) VALUES
(1, 'Delivery Documents', 0),
(2, 'COA', 1),
(3, 'Commercial Inv Delivery', 1),
(4, 'Health Certificate', 1),
(5, 'Commercial Packing List', 0),
(6, 'Certificate of Origin (COO)', 1),
(7, 'GCC Certification', 0),
(8, 'FDA', 0),
(9, 'ECAS', 1),
(10, 'TDS of Film Used', 1),
(11, 'Customer Item Code to be mentioned on Sticker ', 1),
(12, 'Customer Item Code NOT to be mentioned on Sticker ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_core_id_length`
--

DROP TABLE IF EXISTS `work_order_ui_slitting_core_id_length`;
CREATE TABLE IF NOT EXISTS `work_order_ui_slitting_core_id_length` (
  `slitting_core_id_length_id` int(5) NOT NULL AUTO_INCREMENT,
  `slitting_core_id_length_value` varchar(100) NOT NULL,
  `slitting_core_id_length_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`slitting_core_id_length_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_core_id_length`
--

INSERT INTO `work_order_ui_slitting_core_id_length` (`slitting_core_id_length_id`, `slitting_core_id_length_value`, `slitting_core_id_length_show`) VALUES
(1, '70mm', 1),
(2, '76mm', 1),
(3, '152mm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_core_id_type`
--

DROP TABLE IF EXISTS `work_order_ui_slitting_core_id_type`;
CREATE TABLE IF NOT EXISTS `work_order_ui_slitting_core_id_type` (
  `slitting_core_id_type_id` int(5) NOT NULL AUTO_INCREMENT,
  `slitting_core_id_type_value` varchar(100) NOT NULL,
  `slitting_core_id_type_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`slitting_core_id_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_core_id_type`
--

INSERT INTO `work_order_ui_slitting_core_id_type` (`slitting_core_id_type_id`, `slitting_core_id_type_value`, `slitting_core_id_type_show`) VALUES
(1, 'Paper', 1),
(2, 'PVC', 1),
(3, 'PVC - Returnable', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_core_plugs`
--

DROP TABLE IF EXISTS `work_order_ui_slitting_core_plugs`;
CREATE TABLE IF NOT EXISTS `work_order_ui_slitting_core_plugs` (
  `core_plugs_id` int(50) NOT NULL AUTO_INCREMENT,
  `core_plugs_value` varchar(10) NOT NULL,
  `core_plugs_show` int(1) DEFAULT '1',
  PRIMARY KEY (`core_plugs_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_core_plugs`
--

INSERT INTO `work_order_ui_slitting_core_plugs` (`core_plugs_id`, `core_plugs_value`, `core_plugs_show`) VALUES
(1, 'Yes', 1),
(2, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_freight_ins`
--

DROP TABLE IF EXISTS `work_order_ui_slitting_freight_ins`;
CREATE TABLE IF NOT EXISTS `work_order_ui_slitting_freight_ins` (
  `freight_id` int(5) NOT NULL AUTO_INCREMENT,
  `freight_value` varchar(100) NOT NULL,
  `freight_show` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`freight_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_freight_ins`
--

INSERT INTO `work_order_ui_slitting_freight_ins` (`freight_id`, `freight_value`, `freight_show`) VALUES
(1, 'CIF', 1),
(2, 'CNF', 0),
(3, 'FOB', 1),
(4, 'EXW', 1),
(5, 'Local Delivery', 1),
(6, 'DDP', 1),
(7, 'DDU', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_laser_config`
--

DROP TABLE IF EXISTS `work_order_ui_slitting_laser_config`;
CREATE TABLE IF NOT EXISTS `work_order_ui_slitting_laser_config` (
  `laser_id` int(5) NOT NULL AUTO_INCREMENT,
  `laser_value` varchar(50) NOT NULL,
  `laser_show` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`laser_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_laser_config`
--

INSERT INTO `work_order_ui_slitting_laser_config` (`laser_id`, `laser_value`, `laser_show`) VALUES
(1, 'NONE', 1),
(2, 'Cross Dir Scoring', 1),
(3, 'Etching', 1),
(4, 'Prescribing', 1),
(5, 'Perforation', 1),
(6, 'Web Micro Perforation', 1),
(7, 'Cross Micro Perforation', 1),
(8, 'Cross Dir Shape Scoring', 1),
(9, 'Web Direction Scoring', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_packing_opts`
--

DROP TABLE IF EXISTS `work_order_ui_slitting_packing_opts`;
CREATE TABLE IF NOT EXISTS `work_order_ui_slitting_packing_opts` (
  `slitting_packing_opts_id` int(5) NOT NULL AUTO_INCREMENT,
  `slitting_packing_opts_value` varchar(100) NOT NULL,
  `slitting_packing_opts_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`slitting_packing_opts_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_packing_opts`
--

INSERT INTO `work_order_ui_slitting_packing_opts` (`slitting_packing_opts_id`, `slitting_packing_opts_value`, `slitting_packing_opts_show`) VALUES
(1, 'KGS', 0),
(2, 'NOS', 0),
(3, 'Carton UNPTD', 1),
(10, 'Carton PTD', 1),
(5, 'L.MTR', 0),
(6, 'IMP', 0),
(7, 'Polybag', 1),
(8, 'POLYBAG + Carton', 1),
(9, 'Bundles', 1),
(11, 'A', 0),
(12, 'test 2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_pack_ins`
--

DROP TABLE IF EXISTS `work_order_ui_slitting_pack_ins`;
CREATE TABLE IF NOT EXISTS `work_order_ui_slitting_pack_ins` (
  `pack_ins_id` int(5) NOT NULL AUTO_INCREMENT,
  `pack_ins_value` varchar(50) NOT NULL,
  `pack_ins_show` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pack_ins_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_pack_ins`
--

INSERT INTO `work_order_ui_slitting_pack_ins` (`pack_ins_id`, `pack_ins_value`, `pack_ins_show`) VALUES
(1, 'Individual Polybags without Carton', 1),
(2, 'Individual Polybags with Printed Carton', 1),
(3, 'Individual Polybags with Un-printed Carton', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_pallet`
--

DROP TABLE IF EXISTS `work_order_ui_slitting_pallet`;
CREATE TABLE IF NOT EXISTS `work_order_ui_slitting_pallet` (
  `slitting_pallet_id` int(5) NOT NULL AUTO_INCREMENT,
  `slitting_pallet_value` varchar(100) NOT NULL,
  `slitting_pallet_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`slitting_pallet_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_pallet`
--

INSERT INTO `work_order_ui_slitting_pallet` (`slitting_pallet_id`, `slitting_pallet_value`, `slitting_pallet_show`) VALUES
(1, 'Wooden Pallet', 1),
(2, 'Wooden Fumigated', 1),
(3, 'Plastic Single Use', 1),
(4, 'Plastic Returnable', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_pallet_instructions`
--

DROP TABLE IF EXISTS `work_order_ui_slitting_pallet_instructions`;
CREATE TABLE IF NOT EXISTS `work_order_ui_slitting_pallet_instructions` (
  `pallet_instructions_id` int(5) NOT NULL AUTO_INCREMENT,
  `pallet_instructions_value` varchar(100) NOT NULL,
  `pallet_instructions_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pallet_instructions_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_pallet_instructions`
--

INSERT INTO `work_order_ui_slitting_pallet_instructions` (`pallet_instructions_id`, `pallet_instructions_value`, `pallet_instructions_show`) VALUES
(1, 'Collective', 0),
(2, 'Individual', 0),
(3, 'Marking - Pallet Sticker', 1),
(4, 'Marking -  Pallet Sticker with Design Sample Pasted on Pallet', 1),
(5, 'Marking - Mixed Variants', 0);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_qc_ins`
--

DROP TABLE IF EXISTS `work_order_ui_slitting_qc_ins`;
CREATE TABLE IF NOT EXISTS `work_order_ui_slitting_qc_ins` (
  `slitting_qc_ins_id` int(5) NOT NULL AUTO_INCREMENT,
  `slitting_qc_ins_value` varchar(100) NOT NULL,
  `slitting_qc_ins_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`slitting_qc_ins_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_qc_ins`
--

INSERT INTO `work_order_ui_slitting_qc_ins` (`slitting_qc_ins_id`, `slitting_qc_ins_value`, `slitting_qc_ins_show`) VALUES
(1, 'Red Tape on Joint', 1),
(6, 'Blue Tape on Joint', 1),
(7, 'White Tape on Joint', 1),
(8, 'Transparent Tape on Joint', 1),
(9, 'Brown Tape on Joint', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_shipping_dets`
--

DROP TABLE IF EXISTS `work_order_ui_slitting_shipping_dets`;
CREATE TABLE IF NOT EXISTS `work_order_ui_slitting_shipping_dets` (
  `shipping_dets_id` int(5) NOT NULL AUTO_INCREMENT,
  `shipping_dets_value` varchar(50) NOT NULL,
  `shipping_dets_show` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`shipping_dets_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_shipping_dets`
--

INSERT INTO `work_order_ui_slitting_shipping_dets` (`shipping_dets_id`, `shipping_dets_value`, `shipping_dets_show`) VALUES
(1, 'Loose Stuffing', 1),
(2, 'Pallet Stuffing', 1),
(3, 'Roll in Individual Box', 0);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_structure`
--

DROP TABLE IF EXISTS `work_order_ui_structure`;
CREATE TABLE IF NOT EXISTS `work_order_ui_structure` (
  `structure_id` int(50) NOT NULL AUTO_INCREMENT,
  `structure_value` varchar(698) NOT NULL,
  `structure_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`structure_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `work_order_wind_dir`;
CREATE TABLE IF NOT EXISTS `work_order_wind_dir` (
  `wind_id` int(50) NOT NULL AUTO_INCREMENT,
  `wind_value` varchar(255) NOT NULL,
  `wind_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`wind_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

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
(16, '8B', 1),
(17, '1AB', 1),
(18, '2AB', 1),
(19, '3AB', 1),
(20, '4AB', 1),
(21, '5AB', 1),
(22, '6AB', 1),
(23, '7AB', 1),
(24, '8AB', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
