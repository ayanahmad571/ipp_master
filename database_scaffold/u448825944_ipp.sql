-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2020 at 05:23 PM
-- Server version: 10.3.23-MariaDB-cll-lve
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u448825944_ipp`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients_main`
--

CREATE TABLE `clients_main` (
  `client_id` int(80) NOT NULL,
  `client_code` varchar(80) NOT NULL,
  `client_name` varchar(80) NOT NULL,
  `client_dnt` varchar(80) NOT NULL,
  `client_lum_id` int(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients_main`
--

INSERT INTO `clients_main` (`client_id`, `client_code`, `client_name`, `client_dnt`, `client_lum_id`) VALUES
(1, 'EK', 'Emirates', '1445555555', 1),
(2, 'CARF', 'Carrefour', '123129841289', 1),
(3, 'STWL', 'StileWell', '1415184858', 1),
(10, 'AA', 'Architecture Assoc', '1598908551', 1),
(11, 'NY', 'New Yorkers', '1598910124', 1),
(12, 'P001', 'Purchase Star', '1599138980', 2),
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
  `complaint_status` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(1, 1, 'home.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602014900'),
(2, 1, 'work_order_sales_generate.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602014902'),
(3, 1, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602014908'),
(4, 1, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602014917'),
(5, 1, 'SalesWorkOrderSubmit.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'MD-1 added a new draft with ID: 1', '1602014917'),
(6, 1, 'work_order_quality.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602014919'),
(7, 1, 'work_order_sales.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602014919'),
(8, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602014922'),
(9, 1, 'MainWorkOrderSubmit.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'MD-1 has publised draft ID 1  to WO ID 1', '1602014922'),
(10, 1, 'work_order_sales.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602069204'),
(11, 1, 'work_order_sales.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602069211'),
(12, 1, 'work_order_sales_generate.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602069213'),
(13, 1, 'attach.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602069248'),
(14, 1, 'attach.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602069250'),
(15, 1, 'form_manager.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602069251'),
(16, 1, 'admin_users.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602069252'),
(17, 1, 'work_order_tracker.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602069253'),
(18, 1, 'admin_users.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602070667'),
(19, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602070700'),
(20, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'User : S-22 has been added by MD-1', '1602070700'),
(21, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602070733'),
(22, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'User : S-21 has been added by MD-1', '1602070733'),
(23, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602070758'),
(24, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'User : S-19M has been added by MD-1', '1602070758'),
(25, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602070859'),
(26, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'User : Q-1 has been added by MD-1', '1602070859'),
(27, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602070877'),
(28, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'User : FM-01 has been added by MD-1', '1602070877'),
(29, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602070898'),
(30, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'User : PC-01 has been added by MD-1', '1602070898'),
(31, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602070915'),
(32, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'User : PL-01 has been added by MD-1', '1602070915'),
(33, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602070930'),
(34, 1, 'AdminController.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'User : PP-01 has been added by MD-1', '1602070930'),
(35, 1, 'work_order_sales.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602070932'),
(36, 1, 'work_order_factory.php', 'IPPSESSID5f7cceb4c5ca5', '94.203.255.182', 'This login protected page has been accessed', '1602070933');

-- --------------------------------------------------------

--
-- Table structure for table `master_work_order_main`
--

CREATE TABLE `master_work_order_main` (
  `master_wo_id` int(100) NOT NULL,
  `master_wo_ref` int(100) NOT NULL,
  `master_wo_lum_id` int(100) NOT NULL,
  `master_wo_design_id` varchar(25) DEFAULT NULL,
  `master_wo_po` varchar(25) DEFAULT NULL,
  `master_wo_client_id` int(255) NOT NULL,
  `master_wo_delivery_date` varchar(25) DEFAULT NULL,
  `master_wo_customer_item_code` varchar(50) DEFAULT NULL,
  `master_wo_lwo` varchar(50) DEFAULT NULL,
  `master_wo_structure` varchar(50) NOT NULL,
  `master_wo_final_qty` varchar(50) DEFAULT NULL,
  `master_wo_qty_unit` varchar(50) DEFAULT NULL,
  `master_wo_tolerance_1` varchar(50) DEFAULT NULL,
  `master_wo_tolerance_2` varchar(50) DEFAULT NULL,
  `master_wo_ply` int(5) DEFAULT NULL,
  `master_wo_application_id` int(255) DEFAULT NULL,
  `master_wo_ncr_no` varchar(50) DEFAULT NULL,
  `master_wo_ccr_no` varchar(50) DEFAULT NULL,
  `master_wo_layer_1_micron` varchar(50) DEFAULT NULL,
  `master_wo_layer_1_structure` varchar(50) DEFAULT NULL,
  `master_wo_layer_2_micron` varchar(50) DEFAULT NULL,
  `master_wo_layer_2_structure` varchar(50) DEFAULT NULL,
  `master_wo_layer_3_micron` varchar(50) DEFAULT NULL,
  `master_wo_layer_3_structure` varchar(50) DEFAULT NULL,
  `master_wo_layer_4_micron` varchar(50) DEFAULT NULL,
  `master_wo_layer_4_structure` varchar(50) DEFAULT NULL,
  `master_wo_layer_5_micron` varchar(50) DEFAULT NULL,
  `master_wo_layer_5_structure` varchar(50) DEFAULT NULL,
  `master_wo_printed_question` int(2) NOT NULL,
  `master_wo_inhouse_pe_question` int(2) NOT NULL,
  `master_wo_customer_location` varchar(50) DEFAULT NULL,
  `master_wo_ex_pe_re` varchar(50) DEFAULT NULL,
  `master_wo_ex_antistatic` int(10) DEFAULT NULL,
  `master_wo_ex_layer` int(10) DEFAULT NULL,
  `master_wo_ex_pack_weight` varchar(50) DEFAULT NULL,
  `master_wo_ex_pkg_size` varchar(50) DEFAULT NULL,
  `master_wo_ex_qty_units` varchar(50) DEFAULT NULL,
  `master_wo_ex_options` varchar(70) DEFAULT NULL,
  `master_wo_ex_thickness` varchar(50) DEFAULT NULL,
  `master_wo_ex_treatment` int(5) DEFAULT NULL,
  `master_wo_ex_roll_od` varchar(50) DEFAULT NULL,
  `master_wo_ex_extrude_in` int(5) DEFAULT NULL,
  `master_wo_ex_film_color` varchar(50) DEFAULT NULL,
  `master_wo_ex_cof` int(5) DEFAULT NULL,
  `master_wo_ext_cof_i2i` varchar(10) DEFAULT NULL,
  `master_wo_ext_cof_o2o` varchar(10) DEFAULT NULL,
  `master_wo_ext_cof_o2m` varchar(10) DEFAULT NULL,
  `master_wo_ext_cof_i2m` varchar(10) DEFAULT NULL,
  `master_wo_ext_pe_film_feature` varchar(10) DEFAULT NULL,
  `master_wo_ext_dyne` varchar(10) DEFAULT NULL,
  `master_wo_ext_single_coil_w` varchar(10) DEFAULT NULL,
  `master_wo_ext_no_ups` varchar(10) DEFAULT NULL,
  `master_wo_ext_jumbo_f_w` varchar(10) DEFAULT NULL,
  `master_wo_ext_recycle_p` varchar(10) DEFAULT NULL,
  `master_wo_print_design` varchar(80) DEFAULT NULL,
  `master_wo_print_cylinder_supplier` int(80) DEFAULT NULL,
  `master_wo_print_surface_reverse` int(80) DEFAULT NULL,
  `master_wo_print_qty` varchar(80) DEFAULT NULL,
  `master_wo_print_units` int(80) DEFAULT NULL,
  `master_wo_print_substrate` varchar(80) DEFAULT NULL,
  `master_wo_print_single_coil_width` varchar(80) DEFAULT NULL,
  `master_wo_print_ups_val` varchar(80) DEFAULT NULL,
  `master_wo_print_trim_val` varchar(80) DEFAULT NULL,
  `master_wo_print_single_coil_circ` varchar(80) DEFAULT NULL,
  `master_wo_print_accross_val` varchar(80) DEFAULT NULL,
  `master_wo_print_bleed_val` varchar(80) DEFAULT NULL,
  `master_wo_print_shade_card_needed` int(80) DEFAULT NULL,
  `master_wo_print_color_ref_type` int(80) DEFAULT NULL,
  `master_wo_print_eyemark_color` varchar(80) DEFAULT NULL,
  `master_wo_print_size` varchar(80) DEFAULT NULL,
  `master_wo_print_eyemark_path` int(80) DEFAULT NULL,
  `master_wo_print_approvalby` int(80) DEFAULT NULL,
  `master_wo_print_plate_cyl_pr` varchar(80) DEFAULT NULL,
  `master_wo_print_ink_system` int(80) DEFAULT NULL,
  `master_wo_print_baseshel` int(80) DEFAULT NULL,
  `master_wo_print_ink_gsm` varchar(80) DEFAULT NULL,
  `master_wo_print_eyemark_side` varchar(80) DEFAULT NULL,
  `master_wo_print_pantone_1` varchar(80) DEFAULT NULL,
  `master_wo_print_pantone_2` varchar(80) DEFAULT NULL,
  `master_wo_print_pantone_3` varchar(80) DEFAULT NULL,
  `master_wo_print_pantone_4` varchar(80) DEFAULT NULL,
  `master_wo_print_pantone_5` varchar(80) DEFAULT NULL,
  `master_wo_print_pantone_6` varchar(80) DEFAULT NULL,
  `master_wo_print_pantone_7` varchar(80) DEFAULT NULL,
  `master_wo_print_pantone_8` varchar(80) DEFAULT NULL,
  `master_wo_print_end_options` varchar(80) DEFAULT NULL,
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
  `master_wo_bag_qty` varchar(80) DEFAULT NULL,
  `master_wo_bag_units` int(80) DEFAULT NULL,
  `master_wo_bag_width` varchar(80) DEFAULT NULL,
  `master_wo_bag_length` varchar(80) DEFAULT NULL,
  `master_wo_bag_gus_s_w` varchar(80) DEFAULT NULL,
  `master_wo_bag_gus_s_l` varchar(80) DEFAULT NULL,
  `master_wo_bag_gus_b_w` varchar(80) DEFAULT NULL,
  `master_wo_bag_gus_b_l` varchar(80) DEFAULT NULL,
  `master_wo_bag_handle_dist_top` varchar(80) DEFAULT NULL,
  `master_wo_bag_handle_w` varchar(80) DEFAULT NULL,
  `master_wo_bag_handle_l` varchar(80) DEFAULT NULL,
  `master_wo_bag_thick` varchar(80) DEFAULT NULL,
  `master_wo_bag_gusset_side_type` int(80) DEFAULT NULL,
  `master_wo_bag_gusset_bottom_type` int(80) DEFAULT NULL,
  `master_wo_bag_top_fold` varchar(80) DEFAULT NULL,
  `master_wo_bag_flap` varchar(80) DEFAULT NULL,
  `master_wo_bag_lip` varchar(80) DEFAULT NULL,
  `master_wo_bag_handle_type` int(80) DEFAULT NULL,
  `master_wo_bag_vest_hande_type` int(80) DEFAULT NULL,
  `master_wo_bag_sealing` varchar(80) DEFAULT NULL,
  `master_wo_bag_handle_punch` varchar(80) DEFAULT NULL,
  `master_wo_bag_spl_dia` varchar(80) DEFAULT NULL,
  `master_wo_pouch_qty` varchar(80) DEFAULT NULL,
  `master_wo_pouch_unit` int(80) DEFAULT NULL,
  `master_wo_pouch_width` varchar(80) DEFAULT NULL,
  `master_wo_pouch_length` varchar(80) DEFAULT NULL,
  `master_wo_pouch_gus_side` int(80) DEFAULT NULL,
  `master_wo_pouch_gus_bot` int(80) DEFAULT NULL,
  `master_wo_pouch_seal_width` varchar(80) DEFAULT NULL,
  `master_wo_pouch_side_gus_w` varchar(80) DEFAULT NULL,
  `master_wo_pouch_side_gus_l` varchar(80) DEFAULT NULL,
  `master_wo_pouch_bot_gus_w` varchar(80) DEFAULT NULL,
  `master_wo_pouch_bot_gus_l` varchar(80) DEFAULT NULL,
  `master_wo_pouch_type` varchar(80) DEFAULT NULL,
  `master_wo_pouch_euro_punch` int(80) DEFAULT NULL,
  `master_wo_pouch_open` int(80) DEFAULT NULL,
  `master_wo_pouch_corner_type` int(80) DEFAULT NULL,
  `master_wo_pouch_seal_type` int(80) DEFAULT NULL,
  `master_wo_pouch_zip_closure_type` varchar(80) DEFAULT NULL,
  `master_wo_pouch_zip_dist_top` varchar(80) DEFAULT NULL,
  `master_wo_pouch_notch_side` int(80) DEFAULT NULL,
  `master_wo_pouch_notch_dist_top` varchar(80) DEFAULT NULL,
  `master_wo_pouch_notch_dist_side` varchar(80) DEFAULT NULL,
  `master_wo_pouch_hole_punch` int(80) DEFAULT NULL,
  `master_wo_pouch_hole_punch_dia` varchar(80) DEFAULT NULL,
  `master_wo_pouch_special_tooling` int(80) DEFAULT NULL,
  `master_wo_slit_s_width` varchar(80) DEFAULT NULL,
  `master_wo_slit_wind_dir` int(80) DEFAULT NULL,
  `master_wo_slit_roll_od` varchar(80) DEFAULT NULL,
  `master_wo_slit_wt` varchar(80) DEFAULT NULL,
  `master_wo_slit_mtr` varchar(80) DEFAULT NULL,
  `master_wo_slit_pallet` int(80) DEFAULT NULL,
  `master_wo_slit_packing` varchar(80) DEFAULT NULL,
  `master_wo_slit_sticker` int(80) DEFAULT NULL,
  `master_wo_slit_pallet_pack_ins` varchar(80) DEFAULT NULL,
  `master_wo_slit_pallet_length` varchar(80) DEFAULT NULL,
  `master_wo_slit_pallet_width` varchar(80) DEFAULT NULL,
  `master_wo_slit_pallet_height` varchar(80) DEFAULT NULL,
  `master_wo_slit_core_id` int(80) DEFAULT NULL,
  `master_wo_slit_core_type` int(80) DEFAULT NULL,
  `master_wo_slit_core_plugs` int(80) DEFAULT NULL,
  `master_wo_slit_reel_flag_col` varchar(80) DEFAULT NULL,
  `master_wo_slit_qc_ins` varchar(80) DEFAULT NULL,
  `master_wo_slit_qc_max_jointrolls` varchar(80) DEFAULT NULL,
  `master_wo_remarks_overall` text DEFAULT NULL,
  `master_wo_remarks_ext` text DEFAULT NULL,
  `master_wo_remarks_print` text DEFAULT NULL,
  `master_wo_remarks_lam` text DEFAULT NULL,
  `master_wo_remarks_pouch` text DEFAULT NULL,
  `master_wo_remarks_bag` text DEFAULT NULL,
  `master_wo_remarks_slit` text DEFAULT NULL,
  `master_wo_gen_dnt` varchar(698) NOT NULL,
  `master_wo_gen_lum_id` int(255) NOT NULL,
  `master_wo_status` int(5) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_work_order_main`
--

INSERT INTO `master_work_order_main` (`master_wo_id`, `master_wo_ref`, `master_wo_lum_id`, `master_wo_design_id`, `master_wo_po`, `master_wo_client_id`, `master_wo_delivery_date`, `master_wo_customer_item_code`, `master_wo_lwo`, `master_wo_structure`, `master_wo_final_qty`, `master_wo_qty_unit`, `master_wo_tolerance_1`, `master_wo_tolerance_2`, `master_wo_ply`, `master_wo_application_id`, `master_wo_ncr_no`, `master_wo_ccr_no`, `master_wo_layer_1_micron`, `master_wo_layer_1_structure`, `master_wo_layer_2_micron`, `master_wo_layer_2_structure`, `master_wo_layer_3_micron`, `master_wo_layer_3_structure`, `master_wo_layer_4_micron`, `master_wo_layer_4_structure`, `master_wo_layer_5_micron`, `master_wo_layer_5_structure`, `master_wo_printed_question`, `master_wo_inhouse_pe_question`, `master_wo_customer_location`, `master_wo_ex_pe_re`, `master_wo_ex_antistatic`, `master_wo_ex_layer`, `master_wo_ex_pack_weight`, `master_wo_ex_pkg_size`, `master_wo_ex_qty_units`, `master_wo_ex_options`, `master_wo_ex_thickness`, `master_wo_ex_treatment`, `master_wo_ex_roll_od`, `master_wo_ex_extrude_in`, `master_wo_ex_film_color`, `master_wo_ex_cof`, `master_wo_ext_cof_i2i`, `master_wo_ext_cof_o2o`, `master_wo_ext_cof_o2m`, `master_wo_ext_cof_i2m`, `master_wo_ext_pe_film_feature`, `master_wo_ext_dyne`, `master_wo_ext_single_coil_w`, `master_wo_ext_no_ups`, `master_wo_ext_jumbo_f_w`, `master_wo_ext_recycle_p`, `master_wo_print_design`, `master_wo_print_cylinder_supplier`, `master_wo_print_surface_reverse`, `master_wo_print_qty`, `master_wo_print_units`, `master_wo_print_substrate`, `master_wo_print_single_coil_width`, `master_wo_print_ups_val`, `master_wo_print_trim_val`, `master_wo_print_single_coil_circ`, `master_wo_print_accross_val`, `master_wo_print_bleed_val`, `master_wo_print_shade_card_needed`, `master_wo_print_color_ref_type`, `master_wo_print_eyemark_color`, `master_wo_print_size`, `master_wo_print_eyemark_path`, `master_wo_print_approvalby`, `master_wo_print_plate_cyl_pr`, `master_wo_print_ink_system`, `master_wo_print_baseshel`, `master_wo_print_ink_gsm`, `master_wo_print_eyemark_side`, `master_wo_print_pantone_1`, `master_wo_print_pantone_2`, `master_wo_print_pantone_3`, `master_wo_print_pantone_4`, `master_wo_print_pantone_5`, `master_wo_print_pantone_6`, `master_wo_print_pantone_7`, `master_wo_print_pantone_8`, `master_wo_print_end_options`, `master_wo_lam_lam_sleeve`, `master_wo_lam_f1_width`, `master_wo_lam_f1_kgs`, `master_wo_lam_f1_mtr`, `master_wo_lam_p1_desc_1`, `master_wo_lam_p1_desc_2`, `master_wo_lam_f2_width`, `master_wo_lam_f2_kgs`, `master_wo_lam_f2_mtr`, `master_wo_lam_p2_desc_1`, `master_wo_lam_p2_desc_2`, `master_wo_lam_f3_width`, `master_wo_lam_f3_kgs`, `master_wo_lam_f3_mtr`, `master_wo_lam_p3_desc_1`, `master_wo_lam_p3_desc_2`, `master_wo_lam_f4_width`, `master_wo_lam_f4_kgs`, `master_wo_lam_f4_mtr`, `master_wo_lam_p4_desc_1`, `master_wo_lam_p4_desc_2`, `master_wo_lam_f5_width`, `master_wo_lam_f5_kgs`, `master_wo_lam_f5_mtr`, `master_wo_lam_options`, `master_wo_bag_qty`, `master_wo_bag_units`, `master_wo_bag_width`, `master_wo_bag_length`, `master_wo_bag_gus_s_w`, `master_wo_bag_gus_s_l`, `master_wo_bag_gus_b_w`, `master_wo_bag_gus_b_l`, `master_wo_bag_handle_dist_top`, `master_wo_bag_handle_w`, `master_wo_bag_handle_l`, `master_wo_bag_thick`, `master_wo_bag_gusset_side_type`, `master_wo_bag_gusset_bottom_type`, `master_wo_bag_top_fold`, `master_wo_bag_flap`, `master_wo_bag_lip`, `master_wo_bag_handle_type`, `master_wo_bag_vest_hande_type`, `master_wo_bag_sealing`, `master_wo_bag_handle_punch`, `master_wo_bag_spl_dia`, `master_wo_pouch_qty`, `master_wo_pouch_unit`, `master_wo_pouch_width`, `master_wo_pouch_length`, `master_wo_pouch_gus_side`, `master_wo_pouch_gus_bot`, `master_wo_pouch_seal_width`, `master_wo_pouch_side_gus_w`, `master_wo_pouch_side_gus_l`, `master_wo_pouch_bot_gus_w`, `master_wo_pouch_bot_gus_l`, `master_wo_pouch_type`, `master_wo_pouch_euro_punch`, `master_wo_pouch_open`, `master_wo_pouch_corner_type`, `master_wo_pouch_seal_type`, `master_wo_pouch_zip_closure_type`, `master_wo_pouch_zip_dist_top`, `master_wo_pouch_notch_side`, `master_wo_pouch_notch_dist_top`, `master_wo_pouch_notch_dist_side`, `master_wo_pouch_hole_punch`, `master_wo_pouch_hole_punch_dia`, `master_wo_pouch_special_tooling`, `master_wo_slit_s_width`, `master_wo_slit_wind_dir`, `master_wo_slit_roll_od`, `master_wo_slit_wt`, `master_wo_slit_mtr`, `master_wo_slit_pallet`, `master_wo_slit_packing`, `master_wo_slit_sticker`, `master_wo_slit_pallet_pack_ins`, `master_wo_slit_pallet_length`, `master_wo_slit_pallet_width`, `master_wo_slit_pallet_height`, `master_wo_slit_core_id`, `master_wo_slit_core_type`, `master_wo_slit_core_plugs`, `master_wo_slit_reel_flag_col`, `master_wo_slit_qc_ins`, `master_wo_slit_qc_max_jointrolls`, `master_wo_remarks_overall`, `master_wo_remarks_ext`, `master_wo_remarks_print`, `master_wo_remarks_lam`, `master_wo_remarks_pouch`, `master_wo_remarks_bag`, `master_wo_remarks_slit`, `master_wo_gen_dnt`, `master_wo_gen_lum_id`, `master_wo_status`) VALUES
(1, 1, 1, '12', '', 10, '1607773200', 'q3fr', '', '2', '123', '1', '1', '4', 2, 27, '', '', '1', '21', '3', '21', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '', 1, '1u, ACRYLIC PET', '0', '0', '0', '0', '0', '0', 1, 1, '', '0x0', 1, 1, '', 1, 1, '', '1', '', '', '', '', '', '', '', '', '1', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', 1, 1, '', '', '', '', '', '1', 1, 1, 1, 1, '1', '', 1, '', '', 1, '', 1, '', 1, '', '', '', 1, '1', 1, '1', '', '', '', 1, 1, 1, '', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '1602014922', 1, 1);

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
(1, '1602014922', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `materials_main`
--

CREATE TABLE `materials_main` (
  `material_id` int(50) NOT NULL,
  `material_value` varchar(698) NOT NULL,
  `material_show` int(1) NOT NULL DEFAULT 1
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
(17, 'BUTTER FOIL', 1),
(18, 'RETORT PET', 1),
(19, 'STANDARD PET', 1),
(20, 'CHEMICAL PET', 1),
(21, 'ACRYLIC PET', 1),
(22, 'UPF PET', 1),
(23, 'TWIST PET', 1),
(24, 'CORONA PET', 1),
(25, 'ALOX PET', 1),
(26, 'SIOX PET', 1),
(27, 'STANDARD MATTE PET', 1),
(28, 'SOFT PET', 1),
(29, 'SOFT MATTE  PET', 1),
(30, 'HIGH GLOSS PET', 1),
(31, 'MET PET', 1),
(32, 'MET PET HIGH OD', 1),
(33, 'MET PET ULTRA HIGH OD', 1),
(36, 'COL PE', 1),
(37, 'STANDARD TOPP', 1),
(38, 'MATTE OPP', 1),
(39, 'MET OPP', 1),
(40, 'HIGH OD MET OPP', 1),
(41, 'WHITE OPP', 1),
(42, 'PEARL OPP', 1),
(43, 'LABEL GRADE OPP', 1),
(44, 'MP OPP', 1),
(45, 'KRAFT PAPER', 1),
(46, 'BLEACH PAPER', 1),
(47, 'GLASSINE PAPER', 1),
(48, 'BUTTER PAPER', 1),
(49, 'RELEASE PAPER', 1),
(50, 'POLYCOATED PAPER', 1),
(51, 'EXTRUDED NYLON PAPER', 1),
(52, 'RETORT FOIL', 1),
(53, 'RETORT CPP', 1),
(54, 'RETORT NYLON', 1);

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
  `mod_visible` int(2) NOT NULL DEFAULT 1,
  `mod_valid` int(2) NOT NULL DEFAULT 1
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
(37, 6, 'Admin Logs', 'admin_logs', 'fas fa-clipboard-list', 1, 1),
(38, 1, 'Work Order Planning Edit', 'work_order_planning_edit', 'fas fa-clipboard-list', 0, 1),
(39, 1, 'Planning Controller', 'PlanningController', 'fa fa-home', 0, 1);

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
  `remark_status` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_work_order_main`
--

CREATE TABLE `sales_work_order_main` (
  `s_wo_id` int(100) NOT NULL,
  `s_wo_lum_id` int(100) NOT NULL,
  `s_wo_design_id` varchar(25) DEFAULT NULL,
  `s_wo_po` varchar(25) DEFAULT NULL,
  `s_wo_client_id` int(255) NOT NULL,
  `s_wo_delivery_date` varchar(25) DEFAULT NULL,
  `s_wo_customer_item_code` varchar(50) DEFAULT NULL,
  `s_wo_lwo` varchar(50) DEFAULT NULL,
  `s_wo_structure` varchar(50) NOT NULL,
  `s_wo_final_qty` varchar(50) DEFAULT NULL,
  `s_wo_qty_unit` varchar(50) DEFAULT NULL,
  `s_wo_tolerance_1` varchar(50) DEFAULT NULL,
  `s_wo_tolerance_2` varchar(50) DEFAULT NULL,
  `s_wo_ply` int(5) DEFAULT NULL,
  `s_wo_application_id` int(255) DEFAULT NULL,
  `s_wo_ncr_no` varchar(50) DEFAULT NULL,
  `s_wo_ccr_no` varchar(50) DEFAULT NULL,
  `s_wo_layer_1_micron` varchar(50) DEFAULT NULL,
  `s_wo_layer_1_structure` varchar(50) DEFAULT NULL,
  `s_wo_layer_2_micron` varchar(50) DEFAULT NULL,
  `s_wo_layer_2_structure` varchar(50) DEFAULT NULL,
  `s_wo_layer_3_micron` varchar(50) DEFAULT NULL,
  `s_wo_layer_3_structure` varchar(50) DEFAULT NULL,
  `s_wo_layer_4_micron` varchar(50) DEFAULT NULL,
  `s_wo_layer_4_structure` varchar(50) DEFAULT NULL,
  `s_wo_layer_5_micron` varchar(50) DEFAULT NULL,
  `s_wo_layer_5_structure` varchar(50) DEFAULT NULL,
  `s_wo_printed_question` int(2) NOT NULL,
  `s_wo_inhouse_pe_question` int(2) NOT NULL,
  `s_wo_customer_location` varchar(50) DEFAULT NULL,
  `s_wo_ex_pe_re` varchar(50) DEFAULT NULL,
  `s_wo_ex_antistatic` int(10) DEFAULT NULL,
  `s_wo_ex_layer` int(10) DEFAULT NULL,
  `s_wo_ex_pack_weight` varchar(50) DEFAULT NULL,
  `s_wo_ex_pkg_size` varchar(50) DEFAULT NULL,
  `s_wo_ex_qty_units` varchar(50) DEFAULT NULL,
  `s_wo_ex_options` varchar(70) DEFAULT NULL,
  `s_wo_ex_thickness` varchar(50) DEFAULT NULL,
  `s_wo_ex_treatment` int(5) DEFAULT NULL,
  `s_wo_ex_roll_od` varchar(50) DEFAULT NULL,
  `s_wo_ex_extrude_in` int(5) DEFAULT NULL,
  `s_wo_ex_film_color` varchar(50) DEFAULT NULL,
  `s_wo_ex_cof` int(5) DEFAULT NULL,
  `s_wo_ext_cof_i2i` varchar(10) DEFAULT NULL,
  `s_wo_ext_cof_o2o` varchar(10) DEFAULT NULL,
  `s_wo_ext_cof_o2m` varchar(10) DEFAULT NULL,
  `s_wo_ext_cof_i2m` varchar(10) DEFAULT NULL,
  `s_wo_ext_pe_film_feature` varchar(10) DEFAULT NULL,
  `s_wo_ext_dyne` varchar(10) DEFAULT NULL,
  `s_wo_ext_single_coil_w` varchar(10) DEFAULT NULL,
  `s_wo_ext_no_ups` varchar(10) DEFAULT NULL,
  `s_wo_ext_jumbo_f_w` varchar(10) DEFAULT NULL,
  `s_wo_ext_recycle_p` varchar(10) DEFAULT NULL,
  `s_wo_print_design` varchar(80) DEFAULT NULL,
  `s_wo_print_cylinder_supplier` int(80) DEFAULT NULL,
  `s_wo_print_surface_reverse` int(80) DEFAULT NULL,
  `s_wo_print_qty` varchar(80) DEFAULT NULL,
  `s_wo_print_units` int(80) DEFAULT NULL,
  `s_wo_print_substrate` varchar(80) DEFAULT NULL,
  `s_wo_print_single_coil_width` varchar(80) DEFAULT NULL,
  `s_wo_print_ups_val` varchar(80) DEFAULT NULL,
  `s_wo_print_trim_val` varchar(80) DEFAULT NULL,
  `s_wo_print_single_coil_circ` varchar(80) DEFAULT NULL,
  `s_wo_print_accross_val` varchar(80) DEFAULT NULL,
  `s_wo_print_bleed_val` varchar(80) DEFAULT NULL,
  `s_wo_print_shade_card_needed` int(80) DEFAULT NULL,
  `s_wo_print_color_ref_type` int(80) DEFAULT NULL,
  `s_wo_print_eyemark_color` varchar(80) DEFAULT NULL,
  `s_wo_print_size` varchar(80) DEFAULT NULL,
  `s_wo_print_eyemark_path` int(80) DEFAULT NULL,
  `s_wo_print_approvalby` int(80) DEFAULT NULL,
  `s_wo_print_plate_cyl_pr` varchar(80) DEFAULT NULL,
  `s_wo_print_ink_system` int(80) DEFAULT NULL,
  `s_wo_print_baseshel` int(80) DEFAULT NULL,
  `s_wo_print_ink_gsm` varchar(80) DEFAULT NULL,
  `s_wo_print_eyemark_side` varchar(80) DEFAULT NULL,
  `s_wo_print_pantone_1` varchar(80) DEFAULT NULL,
  `s_wo_print_pantone_2` varchar(80) DEFAULT NULL,
  `s_wo_print_pantone_3` varchar(80) DEFAULT NULL,
  `s_wo_print_pantone_4` varchar(80) DEFAULT NULL,
  `s_wo_print_pantone_5` varchar(80) DEFAULT NULL,
  `s_wo_print_pantone_6` varchar(80) DEFAULT NULL,
  `s_wo_print_pantone_7` varchar(80) DEFAULT NULL,
  `s_wo_print_pantone_8` varchar(80) DEFAULT NULL,
  `s_wo_print_end_options` varchar(80) DEFAULT NULL,
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
  `s_wo_bag_qty` varchar(80) DEFAULT NULL,
  `s_wo_bag_units` int(80) DEFAULT NULL,
  `s_wo_bag_width` varchar(80) DEFAULT NULL,
  `s_wo_bag_length` varchar(80) DEFAULT NULL,
  `s_wo_bag_gus_s_w` varchar(80) DEFAULT NULL,
  `s_wo_bag_gus_s_l` varchar(80) DEFAULT NULL,
  `s_wo_bag_gus_b_w` varchar(80) DEFAULT NULL,
  `s_wo_bag_gus_b_l` varchar(80) DEFAULT NULL,
  `s_wo_bag_handle_dist_top` varchar(80) DEFAULT NULL,
  `s_wo_bag_handle_w` varchar(80) DEFAULT NULL,
  `s_wo_bag_handle_l` varchar(80) DEFAULT NULL,
  `s_wo_bag_thick` varchar(80) DEFAULT NULL,
  `s_wo_bag_gusset_side_type` int(80) DEFAULT NULL,
  `s_wo_bag_gusset_bottom_type` int(80) DEFAULT NULL,
  `s_wo_bag_top_fold` varchar(80) DEFAULT NULL,
  `s_wo_bag_flap` varchar(80) DEFAULT NULL,
  `s_wo_bag_lip` varchar(80) DEFAULT NULL,
  `s_wo_bag_handle_type` int(80) DEFAULT NULL,
  `s_wo_bag_vest_hande_type` int(80) DEFAULT NULL,
  `s_wo_bag_sealing` varchar(80) DEFAULT NULL,
  `s_wo_bag_handle_punch` varchar(80) DEFAULT NULL,
  `s_wo_bag_spl_dia` varchar(80) DEFAULT NULL,
  `s_wo_pouch_qty` varchar(80) DEFAULT NULL,
  `s_wo_pouch_unit` int(80) DEFAULT NULL,
  `s_wo_pouch_width` varchar(80) DEFAULT NULL,
  `s_wo_pouch_length` varchar(80) DEFAULT NULL,
  `s_wo_pouch_gus_side` int(80) DEFAULT NULL,
  `s_wo_pouch_gus_bot` int(80) DEFAULT NULL,
  `s_wo_pouch_seal_width` varchar(80) DEFAULT NULL,
  `s_wo_pouch_side_gus_w` varchar(80) DEFAULT NULL,
  `s_wo_pouch_side_gus_l` varchar(80) DEFAULT NULL,
  `s_wo_pouch_bot_gus_w` varchar(80) DEFAULT NULL,
  `s_wo_pouch_bot_gus_l` varchar(80) DEFAULT NULL,
  `s_wo_pouch_type` varchar(80) DEFAULT NULL,
  `s_wo_pouch_euro_punch` int(80) DEFAULT NULL,
  `s_wo_pouch_open` int(80) DEFAULT NULL,
  `s_wo_pouch_corner_type` int(80) DEFAULT NULL,
  `s_wo_pouch_seal_type` int(80) DEFAULT NULL,
  `s_wo_pouch_zip_closure_type` varchar(80) DEFAULT NULL,
  `s_wo_pouch_zip_dist_top` varchar(80) DEFAULT NULL,
  `s_wo_pouch_notch_side` int(80) DEFAULT NULL,
  `s_wo_pouch_notch_dist_top` varchar(80) DEFAULT NULL,
  `s_wo_pouch_notch_dist_side` varchar(80) DEFAULT NULL,
  `s_wo_pouch_hole_punch` int(80) DEFAULT NULL,
  `s_wo_pouch_hole_punch_dia` varchar(80) DEFAULT NULL,
  `s_wo_pouch_special_tooling` int(80) DEFAULT NULL,
  `s_wo_slit_s_width` varchar(80) DEFAULT NULL,
  `s_wo_slit_wind_dir` int(80) DEFAULT NULL,
  `s_wo_slit_roll_od` varchar(80) DEFAULT NULL,
  `s_wo_slit_wt` varchar(80) DEFAULT NULL,
  `s_wo_slit_mtr` varchar(80) DEFAULT NULL,
  `s_wo_slit_pallet` int(80) DEFAULT NULL,
  `s_wo_slit_packing` varchar(80) DEFAULT NULL,
  `s_wo_slit_sticker` int(80) DEFAULT NULL,
  `s_wo_slit_pallet_pack_ins` varchar(80) DEFAULT NULL,
  `s_wo_slit_pallet_length` varchar(80) DEFAULT NULL,
  `s_wo_slit_pallet_width` varchar(80) DEFAULT NULL,
  `s_wo_slit_pallet_height` varchar(80) DEFAULT NULL,
  `s_wo_slit_core_id` int(80) DEFAULT NULL,
  `s_wo_slit_core_type` int(80) DEFAULT NULL,
  `s_wo_slit_core_plugs` int(80) DEFAULT NULL,
  `s_wo_slit_reel_flag_col` varchar(80) DEFAULT NULL,
  `s_wo_slit_qc_ins` varchar(80) DEFAULT NULL,
  `s_wo_slit_qc_max_jointrolls` varchar(80) DEFAULT NULL,
  `s_wo_remarks_overall` text DEFAULT NULL,
  `s_wo_remarks_ext` text DEFAULT NULL,
  `s_wo_remarks_print` text DEFAULT NULL,
  `s_wo_remarks_lam` text DEFAULT NULL,
  `s_wo_remarks_pouch` text DEFAULT NULL,
  `s_wo_remarks_bag` text DEFAULT NULL,
  `s_wo_remarks_slit` text DEFAULT NULL,
  `s_wo_gen_dnt` varchar(698) NOT NULL,
  `s_wo_gen_lum_id` int(255) NOT NULL,
  `s_wo_status` int(5) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_work_order_main`
--

INSERT INTO `sales_work_order_main` (`s_wo_id`, `s_wo_lum_id`, `s_wo_design_id`, `s_wo_po`, `s_wo_client_id`, `s_wo_delivery_date`, `s_wo_customer_item_code`, `s_wo_lwo`, `s_wo_structure`, `s_wo_final_qty`, `s_wo_qty_unit`, `s_wo_tolerance_1`, `s_wo_tolerance_2`, `s_wo_ply`, `s_wo_application_id`, `s_wo_ncr_no`, `s_wo_ccr_no`, `s_wo_layer_1_micron`, `s_wo_layer_1_structure`, `s_wo_layer_2_micron`, `s_wo_layer_2_structure`, `s_wo_layer_3_micron`, `s_wo_layer_3_structure`, `s_wo_layer_4_micron`, `s_wo_layer_4_structure`, `s_wo_layer_5_micron`, `s_wo_layer_5_structure`, `s_wo_printed_question`, `s_wo_inhouse_pe_question`, `s_wo_customer_location`, `s_wo_ex_pe_re`, `s_wo_ex_antistatic`, `s_wo_ex_layer`, `s_wo_ex_pack_weight`, `s_wo_ex_pkg_size`, `s_wo_ex_qty_units`, `s_wo_ex_options`, `s_wo_ex_thickness`, `s_wo_ex_treatment`, `s_wo_ex_roll_od`, `s_wo_ex_extrude_in`, `s_wo_ex_film_color`, `s_wo_ex_cof`, `s_wo_ext_cof_i2i`, `s_wo_ext_cof_o2o`, `s_wo_ext_cof_o2m`, `s_wo_ext_cof_i2m`, `s_wo_ext_pe_film_feature`, `s_wo_ext_dyne`, `s_wo_ext_single_coil_w`, `s_wo_ext_no_ups`, `s_wo_ext_jumbo_f_w`, `s_wo_ext_recycle_p`, `s_wo_print_design`, `s_wo_print_cylinder_supplier`, `s_wo_print_surface_reverse`, `s_wo_print_qty`, `s_wo_print_units`, `s_wo_print_substrate`, `s_wo_print_single_coil_width`, `s_wo_print_ups_val`, `s_wo_print_trim_val`, `s_wo_print_single_coil_circ`, `s_wo_print_accross_val`, `s_wo_print_bleed_val`, `s_wo_print_shade_card_needed`, `s_wo_print_color_ref_type`, `s_wo_print_eyemark_color`, `s_wo_print_size`, `s_wo_print_eyemark_path`, `s_wo_print_approvalby`, `s_wo_print_plate_cyl_pr`, `s_wo_print_ink_system`, `s_wo_print_baseshel`, `s_wo_print_ink_gsm`, `s_wo_print_eyemark_side`, `s_wo_print_pantone_1`, `s_wo_print_pantone_2`, `s_wo_print_pantone_3`, `s_wo_print_pantone_4`, `s_wo_print_pantone_5`, `s_wo_print_pantone_6`, `s_wo_print_pantone_7`, `s_wo_print_pantone_8`, `s_wo_print_end_options`, `s_wo_lam_lam_sleeve`, `s_wo_lam_f1_width`, `s_wo_lam_f1_kgs`, `s_wo_lam_f1_mtr`, `s_wo_lam_p1_desc_1`, `s_wo_lam_p1_desc_2`, `s_wo_lam_f2_width`, `s_wo_lam_f2_kgs`, `s_wo_lam_f2_mtr`, `s_wo_lam_p2_desc_1`, `s_wo_lam_p2_desc_2`, `s_wo_lam_f3_width`, `s_wo_lam_f3_kgs`, `s_wo_lam_f3_mtr`, `s_wo_lam_p3_desc_1`, `s_wo_lam_p3_desc_2`, `s_wo_lam_f4_width`, `s_wo_lam_f4_kgs`, `s_wo_lam_f4_mtr`, `s_wo_lam_p4_desc_1`, `s_wo_lam_p4_desc_2`, `s_wo_lam_f5_width`, `s_wo_lam_f5_kgs`, `s_wo_lam_f5_mtr`, `s_wo_lam_options`, `s_wo_bag_qty`, `s_wo_bag_units`, `s_wo_bag_width`, `s_wo_bag_length`, `s_wo_bag_gus_s_w`, `s_wo_bag_gus_s_l`, `s_wo_bag_gus_b_w`, `s_wo_bag_gus_b_l`, `s_wo_bag_handle_dist_top`, `s_wo_bag_handle_w`, `s_wo_bag_handle_l`, `s_wo_bag_thick`, `s_wo_bag_gusset_side_type`, `s_wo_bag_gusset_bottom_type`, `s_wo_bag_top_fold`, `s_wo_bag_flap`, `s_wo_bag_lip`, `s_wo_bag_handle_type`, `s_wo_bag_vest_hande_type`, `s_wo_bag_sealing`, `s_wo_bag_handle_punch`, `s_wo_bag_spl_dia`, `s_wo_pouch_qty`, `s_wo_pouch_unit`, `s_wo_pouch_width`, `s_wo_pouch_length`, `s_wo_pouch_gus_side`, `s_wo_pouch_gus_bot`, `s_wo_pouch_seal_width`, `s_wo_pouch_side_gus_w`, `s_wo_pouch_side_gus_l`, `s_wo_pouch_bot_gus_w`, `s_wo_pouch_bot_gus_l`, `s_wo_pouch_type`, `s_wo_pouch_euro_punch`, `s_wo_pouch_open`, `s_wo_pouch_corner_type`, `s_wo_pouch_seal_type`, `s_wo_pouch_zip_closure_type`, `s_wo_pouch_zip_dist_top`, `s_wo_pouch_notch_side`, `s_wo_pouch_notch_dist_top`, `s_wo_pouch_notch_dist_side`, `s_wo_pouch_hole_punch`, `s_wo_pouch_hole_punch_dia`, `s_wo_pouch_special_tooling`, `s_wo_slit_s_width`, `s_wo_slit_wind_dir`, `s_wo_slit_roll_od`, `s_wo_slit_wt`, `s_wo_slit_mtr`, `s_wo_slit_pallet`, `s_wo_slit_packing`, `s_wo_slit_sticker`, `s_wo_slit_pallet_pack_ins`, `s_wo_slit_pallet_length`, `s_wo_slit_pallet_width`, `s_wo_slit_pallet_height`, `s_wo_slit_core_id`, `s_wo_slit_core_type`, `s_wo_slit_core_plugs`, `s_wo_slit_reel_flag_col`, `s_wo_slit_qc_ins`, `s_wo_slit_qc_max_jointrolls`, `s_wo_remarks_overall`, `s_wo_remarks_ext`, `s_wo_remarks_print`, `s_wo_remarks_lam`, `s_wo_remarks_pouch`, `s_wo_remarks_bag`, `s_wo_remarks_slit`, `s_wo_gen_dnt`, `s_wo_gen_lum_id`, `s_wo_status`) VALUES
(1, 1, '12', '', 10, '1607773200', 'q3fr', '', '2', '123', '1', '1', '4', 2, 27, '', '', '1', '21', '3', '21', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '', 1, '1u, ACRYLIC PET', '0', '0', '0', '0', '0', '0', 1, 1, '', '0x0', 1, 1, '', 1, 1, '', '1', '', '', '', '', '', '', '', '', '1', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', 1, 1, '', '', '', '', '', '1', 1, 1, 1, 1, '1', '', 1, '', '', 1, '', 1, '', 1, '', '', '', 1, '1', 1, '1', '', '', '', 1, 1, 1, '', '1', '', '', NULL, '', '', '', NULL, '', '1602014917', 1, 3);

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
  `sess_valid` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_tracker`
--

INSERT INTO `session_tracker` (`sess_id`, `sess_lum_id`, `sess_hash`, `sess_dnt`, `sess_ip`, `sess_valid`) VALUES
(1, 1, 'IPPSESSID5f7cceb4c5ca5', '1602014900', '94.203.255.182', 1);

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
  `pending_valid` int(2) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_pending`
--

INSERT INTO `users_pending` (`pending_id`, `pending_name`, `pending_email`, `pending_hash`, `pending_code`, `pending_type`, `pending_dnt`, `pending_valid`) VALUES
(1, 'MD', 'md@gmail.com', '98a86ba82a5cdf4641a07641d2d68c4c', 'MD-1', 2, '1602014848', 1);

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
  `lum_valid` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_main`
--

INSERT INTO `user_main` (`lum_id`, `lum_user_type`, `lum_code`, `lum_email`, `lum_hash`, `lum_name`, `lum_dnt`, `lum_deact`, `lum_valid`) VALUES
(1, 2, 'MD-1', 'md@gmail.com', '98a86ba82a5cdf4641a07641d2d68c4c', 'MD-1', '1602014848', NULL, 1),
(2, 10, 'S-22', 'ankit@ipp.com', 'e168bda1c58847a63b9df495f8e47539', 'Ankit', '1602070700', NULL, 1),
(3, 10, 'S-21', 'ritesh@ipp.com', '8629fdf5ca498adc602701c567a8c6f1', 'Ritesh', '1602070733', NULL, 1),
(4, 15, 'S-19M', 'navneet@ipp.com', '8dbc1363da308904ba5e8c146cf25c9a', 'Navneet', '1602070758', NULL, 1),
(5, 12, 'Q-1', 'quality@gmail.com', '7e5fe60f758c6909c1e2d2a164db8eef', 'Quality', '1602070859', NULL, 1),
(6, 7, 'FM-01', 'factory@gmail.com', '6c53b5454c6ca36a3d6877bf903ef344', 'Factory', '1602070877', NULL, 1),
(7, 14, 'PC-01', 'precost@gmail.com', '21e672830cf52eac2afd0727b0372b0c', 'PreCost', '1602070898', NULL, 1),
(8, 17, 'PL-01', 'planning@gmail.com', 'b9fe6c7fed9d27b663cb5816454f1622', 'Planning', '1602070915', NULL, 1),
(9, 11, 'PP-01', 'prepress@gmail.com', 'e1209f4956fe69e9ac3d380f910527b0', 'Pre Press', '1602070930', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_sales_attach`
--

CREATE TABLE `user_sales_attach` (
  `attach_id` int(255) NOT NULL,
  `attach_parent_lum` int(255) NOT NULL,
  `attach_child_lum` int(255) NOT NULL,
  `attach_dnt` varchar(698) NOT NULL,
  `attach_valid` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(17, 'Planning Agent', '-', 'home', '1,35,29,30,21,27,23,20,38,39');

-- --------------------------------------------------------

--
-- Table structure for table `work_order_applications`
--

CREATE TABLE `work_order_applications` (
  `application_id` int(255) NOT NULL,
  `application_value` varchar(698) NOT NULL,
  `application_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(28, 'DRY SNACKS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_input_form_master_container`
--

CREATE TABLE `work_order_input_form_master_container` (
  `form_container_id` int(255) NOT NULL,
  `form_container_parent` int(2) NOT NULL,
  `form_container_type` int(255) NOT NULL,
  `form_container_title` varchar(100) NOT NULL,
  `form_container_name` varchar(100) NOT NULL,
  `form_container_placeholder` varchar(100) NOT NULL,
  `form_container_container_cols` varchar(100) NOT NULL,
  `form_container_s_row_name` varchar(100) NOT NULL,
  `form_container_m_row_name` varchar(100) NOT NULL,
  `form_container_options_values_table_name` varchar(100) DEFAULT NULL,
  `form_container_options_values_table_prefix` varchar(100) DEFAULT NULL,
  `form_container_valid` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_input_form_master_container`
--

INSERT INTO `work_order_input_form_master_container` (`form_container_id`, `form_container_parent`, `form_container_type`, `form_container_title`, `form_container_name`, `form_container_placeholder`, `form_container_container_cols`, `form_container_s_row_name`, `form_container_m_row_name`, `form_container_options_values_table_name`, `form_container_options_values_table_prefix`, `form_container_valid`) VALUES
(1, 1, 1, 'Design ID', 'work_order_design_id', 'Design ID', '12,12,12,6,3', 's_wo_design_id', 'master_wo_design_id', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_input_form_master_container_parent`
--

CREATE TABLE `work_order_input_form_master_container_parent` (
  `form_master_container_parent_id` int(25) NOT NULL,
  `form_master_container_parent_val` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_input_form_master_container_parent`
--

INSERT INTO `work_order_input_form_master_container_parent` (`form_master_container_parent_id`, `form_master_container_parent_val`) VALUES
(1, 'Header Essentials'),
(2, 'Extrusion'),
(3, 'Printing'),
(4, 'Pouch'),
(5, 'Bags'),
(6, 'Slitting');

-- --------------------------------------------------------

--
-- Table structure for table `work_order_input_form_master_container_types`
--

CREATE TABLE `work_order_input_form_master_container_types` (
  `form_master_container_types_id` int(50) NOT NULL,
  `form_master_container_types_val` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_input_form_master_container_types`
--

INSERT INTO `work_order_input_form_master_container_types` (`form_master_container_types_id`, `form_master_container_types_val`) VALUES
(1, 'Text Input'),
(2, 'Numeric Input'),
(3, 'Radio'),
(4, 'CheckBox'),
(5, 'Select'),
(6, 'Textarea');

-- --------------------------------------------------------

--
-- Table structure for table `work_order_qty_units`
--

CREATE TABLE `work_order_qty_units` (
  `unit_id` int(50) NOT NULL,
  `unit_value` varchar(698) NOT NULL,
  `unit_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Table structure for table `work_order_ui_bag_gusset_bottom`
--

CREATE TABLE `work_order_ui_bag_gusset_bottom` (
  `gusset_bottom_id` int(50) NOT NULL,
  `gusset_bottom_value` varchar(100) NOT NULL,
  `gusset_bottom_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_bag_gusset_bottom`
--

INSERT INTO `work_order_ui_bag_gusset_bottom` (`gusset_bottom_id`, `gusset_bottom_value`, `gusset_bottom_show`) VALUES
(1, 'GUSSET', 1),
(2, 'FOLD', 1),
(3, 'SEAL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_bag_gusset_side`
--

CREATE TABLE `work_order_ui_bag_gusset_side` (
  `gusset_side_id` int(50) NOT NULL,
  `gusset_side_value` varchar(100) NOT NULL,
  `gusset_side_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_bag_gusset_side`
--

INSERT INTO `work_order_ui_bag_gusset_side` (`gusset_side_id`, `gusset_side_value`, `gusset_side_show`) VALUES
(1, 'GUSSET', 1),
(2, 'SEAL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_bag_handle`
--

CREATE TABLE `work_order_ui_bag_handle` (
  `bag_handle_id` int(5) NOT NULL,
  `bag_handle_value` varchar(100) NOT NULL,
  `bag_handle_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_bag_handle`
--

INSERT INTO `work_order_ui_bag_handle` (`bag_handle_id`, `bag_handle_value`, `bag_handle_show`) VALUES
(1, 'Patch', 1),
(2, 'Loop', 1),
(3, 'Draw String', 1),
(4, 'No Handle', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_bag_punch_opts`
--

CREATE TABLE `work_order_ui_bag_punch_opts` (
  `bag_punch_opts_id` int(5) NOT NULL,
  `bag_punch_opts_value` varchar(100) NOT NULL,
  `bag_punch_opts_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_bag_punch_opts`
--

INSERT INTO `work_order_ui_bag_punch_opts` (`bag_punch_opts_id`, `bag_punch_opts_value`, `bag_punch_opts_show`) VALUES
(1, 'Straight', 1),
(2, 'Banana', 1),
(3, 'Half Cut', 1),
(4, 'Perforated', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_bag_sealing_opts`
--

CREATE TABLE `work_order_ui_bag_sealing_opts` (
  `bag_sealing_opts_id` int(5) NOT NULL,
  `bag_sealing_opts_value` varchar(100) NOT NULL,
  `bag_sealing_opts_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_bag_sealing_opts`
--

INSERT INTO `work_order_ui_bag_sealing_opts` (`bag_sealing_opts_id`, `bag_sealing_opts_value`, `bag_sealing_opts_show`) VALUES
(1, 'BOT.WELD', 1),
(2, 'Single Side Weld', 1),
(3, 'Double Side Weld', 1),
(4, 'SPL Hole.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_bag_vest_handle`
--

CREATE TABLE `work_order_ui_bag_vest_handle` (
  `bag_vest_handle_id` int(5) NOT NULL,
  `bag_vest_handle_value` varchar(100) NOT NULL,
  `bag_vest_handle_show` int(1) NOT NULL DEFAULT 1
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
-- Table structure for table `work_order_ui_customer_location`
--

CREATE TABLE `work_order_ui_customer_location` (
  `customer_location_id` int(5) NOT NULL,
  `customer_location_value` varchar(100) NOT NULL,
  `customer_location_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_customer_location`
--

INSERT INTO `work_order_ui_customer_location` (`customer_location_id`, `customer_location_value`, `customer_location_show`) VALUES
(1, 'Local', 1),
(2, 'GCC', 1),
(3, 'Export', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_ext_antistatic`
--

CREATE TABLE `work_order_ui_ext_antistatic` (
  `anti_id` int(5) NOT NULL,
  `anti_value` varchar(400) NOT NULL,
  `anti_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_ext_antistatic`
--

INSERT INTO `work_order_ui_ext_antistatic` (`anti_id`, `anti_value`, `anti_show`) VALUES
(1, 'Yes', 1),
(2, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_ext_cof`
--

CREATE TABLE `work_order_ui_ext_cof` (
  `cof_id` int(5) NOT NULL,
  `cof_value` varchar(100) NOT NULL,
  `cof_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_ext_cof`
--

INSERT INTO `work_order_ui_ext_cof` (`cof_id`, `cof_value`, `cof_show`) VALUES
(1, 'L.Slip', 1),
(2, 'Normal', 1),
(3, 'H.Slip', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_ext_extrude_in`
--

CREATE TABLE `work_order_ui_ext_extrude_in` (
  `extrude_in_id` int(5) NOT NULL,
  `extrude_in_value` varchar(100) NOT NULL,
  `extrude_in_show` int(1) NOT NULL DEFAULT 1
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
  `layer_type_show` int(1) NOT NULL DEFAULT 1
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
  `ext_options_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_ext_options`
--

INSERT INTO `work_order_ui_ext_options` (`ext_options_id`, `ext_options_value`, `ext_options_show`) VALUES
(1, 'Lap Seal (In/Out)', 1),
(2, 'Fin Seal (In/Out)', 1),
(3, 'High Clarity', 1),
(4, 'GLOSSY', 1),
(5, 'OPAQUE FILM COLOR', 1),
(6, 'OPAQUE WHITE', 1),
(7, 'OPAQUE OTHER', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_ext_treatment`
--

CREATE TABLE `work_order_ui_ext_treatment` (
  `treat_id` int(5) NOT NULL,
  `treat_value` varchar(100) NOT NULL,
  `treat_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_ext_treatment`
--

INSERT INTO `work_order_ui_ext_treatment` (`treat_id`, `treat_value`, `treat_show`) VALUES
(1, 'Yes', 1),
(2, 'No', 1),
(3, 'Registered', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_lam_end_options`
--

CREATE TABLE `work_order_ui_lam_end_options` (
  `lam_end_options_id` int(5) NOT NULL,
  `lam_end_options_value` varchar(100) NOT NULL,
  `lam_end_options_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_lam_end_options`
--

INSERT INTO `work_order_ui_lam_end_options` (`lam_end_options_id`, `lam_end_options_value`, `lam_end_options_show`) VALUES
(1, 'S.Less', 1),
(2, 'S.Base', 1),
(3, 'Combi', 1),
(4, 'High Perf', 1),
(5, 'Ultra High Perf', 1),
(6, 'RETORT', 1),
(7, 'Cold Seal', 1),
(8, 'White Adhesive', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pe_film_feature`
--

CREATE TABLE `work_order_ui_pe_film_feature` (
  `pe_film_feature_id` int(50) NOT NULL,
  `pe_film_feature_value` varchar(100) NOT NULL,
  `pe_film_feature_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Table structure for table `work_order_ui_pouch_closure_type`
--

CREATE TABLE `work_order_ui_pouch_closure_type` (
  `pouch_closure_type_id` int(5) NOT NULL,
  `pouch_closure_type_value` varchar(100) NOT NULL,
  `pouch_closure_type_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_closure_type`
--

INSERT INTO `work_order_ui_pouch_closure_type` (`pouch_closure_type_id`, `pouch_closure_type_value`, `pouch_closure_type_show`) VALUES
(1, 'Ziplock Open', 1),
(2, 'Ziplock Close', 1),
(3, 'Double Ziplock', 1),
(4, 'Velcro', 1),
(5, 'Easy Open', 1),
(6, 'Stiff Open', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_corner_type`
--

CREATE TABLE `work_order_ui_pouch_corner_type` (
  `pouch_corner_type_id` int(50) NOT NULL,
  `pouch_corner_type_value` varchar(100) NOT NULL,
  `pouch_corner_type_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_corner_type`
--

INSERT INTO `work_order_ui_pouch_corner_type` (`pouch_corner_type_id`, `pouch_corner_type_value`, `pouch_corner_type_show`) VALUES
(1, 'Round', 1),
(2, 'Square', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_euro_punch`
--

CREATE TABLE `work_order_ui_pouch_euro_punch` (
  `pouch_euro_punch_id` int(5) NOT NULL,
  `pouch_euro_punch_value` varchar(100) NOT NULL,
  `pouch_euro_punch_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_euro_punch`
--

INSERT INTO `work_order_ui_pouch_euro_punch` (`pouch_euro_punch_id`, `pouch_euro_punch_value`, `pouch_euro_punch_show`) VALUES
(1, 'S', 1),
(2, 'M', 1),
(3, 'L', 1),
(4, 'XL TEST', 0);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_gusset_bottom`
--

CREATE TABLE `work_order_ui_pouch_gusset_bottom` (
  `pouch_gusset_bottom_id` int(50) NOT NULL,
  `pouch_gusset_bottom_value` varchar(100) NOT NULL,
  `pouch_gusset_bottom_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_gusset_bottom`
--

INSERT INTO `work_order_ui_pouch_gusset_bottom` (`pouch_gusset_bottom_id`, `pouch_gusset_bottom_value`, `pouch_gusset_bottom_show`) VALUES
(1, 'Folded', 1),
(2, 'Sealed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_gusset_side`
--

CREATE TABLE `work_order_ui_pouch_gusset_side` (
  `pouch_gusset_side_id` int(50) NOT NULL,
  `pouch_gusset_side_value` varchar(100) NOT NULL,
  `pouch_gusset_side_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_gusset_side`
--

INSERT INTO `work_order_ui_pouch_gusset_side` (`pouch_gusset_side_id`, `pouch_gusset_side_value`, `pouch_gusset_side_show`) VALUES
(1, 'Folded', 1),
(2, 'Sealed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_hole_punch`
--

CREATE TABLE `work_order_ui_pouch_hole_punch` (
  `pouch_hole_punch_id` int(50) NOT NULL,
  `pouch_hole_punch_value` varchar(100) NOT NULL,
  `pouch_hole_punch_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_hole_punch`
--

INSERT INTO `work_order_ui_pouch_hole_punch` (`pouch_hole_punch_id`, `pouch_hole_punch_value`, `pouch_hole_punch_show`) VALUES
(1, 'Needle Punch', 1),
(2, 'Hole Punch', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_notch_side`
--

CREATE TABLE `work_order_ui_pouch_notch_side` (
  `pouch_notch_side_id` int(50) NOT NULL,
  `pouch_notch_side_value` varchar(100) NOT NULL,
  `pouch_notch_side_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_notch_side`
--

INSERT INTO `work_order_ui_pouch_notch_side` (`pouch_notch_side_id`, `pouch_notch_side_value`, `pouch_notch_side_show`) VALUES
(1, 'Left', 1),
(2, 'Right', 1),
(3, 'Both', 1),
(4, 'Top', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_pouch_open`
--

CREATE TABLE `work_order_ui_pouch_pouch_open` (
  `pouch_open_id` int(5) NOT NULL,
  `pouch_open_value` varchar(100) NOT NULL,
  `pouch_open_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_pouch_open`
--

INSERT INTO `work_order_ui_pouch_pouch_open` (`pouch_open_id`, `pouch_open_value`, `pouch_open_show`) VALUES
(1, 'Top', 1),
(2, 'Bottom', 1),
(3, 'Side', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_seal`
--

CREATE TABLE `work_order_ui_pouch_seal` (
  `pouch_seal_id` int(5) NOT NULL,
  `pouch_seal_value` varchar(100) NOT NULL,
  `pouch_seal_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_seal`
--

INSERT INTO `work_order_ui_pouch_seal` (`pouch_seal_id`, `pouch_seal_value`, `pouch_seal_show`) VALUES
(1, 'K Seal', 1),
(2, 'Arc Seal', 1),
(3, 'Custom Seal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_sealing`
--

CREATE TABLE `work_order_ui_pouch_sealing` (
  `pouch_sealing_id` int(5) NOT NULL,
  `pouch_sealing_value` varchar(100) NOT NULL,
  `pouch_sealing_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_sealing`
--

INSERT INTO `work_order_ui_pouch_sealing` (`pouch_sealing_id`, `pouch_sealing_value`, `pouch_sealing_show`) VALUES
(1, 'INCL', 1),
(2, 'EXCL.s', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_special_tooling`
--

CREATE TABLE `work_order_ui_pouch_special_tooling` (
  `pouch_special_tooling_id` int(50) NOT NULL,
  `pouch_special_tooling_value` varchar(100) NOT NULL,
  `pouch_special_tooling_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_special_tooling`
--

INSERT INTO `work_order_ui_pouch_special_tooling` (`pouch_special_tooling_id`, `pouch_special_tooling_value`, `pouch_special_tooling_show`) VALUES
(1, 'Yes', 1),
(2, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_pouch_type`
--

CREATE TABLE `work_order_ui_pouch_type` (
  `pouch_type_id` int(5) NOT NULL,
  `pouch_type_value` varchar(100) NOT NULL,
  `pouch_type_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_pouch_type`
--

INSERT INTO `work_order_ui_pouch_type` (`pouch_type_id`, `pouch_type_value`, `pouch_type_show`) VALUES
(1, '2 SIDE Seal', 1),
(2, '3 SIDE Seal', 1),
(3, 'OFF Center Seal', 1),
(4, 'Center Seal', 1),
(5, 'Stand UP Seal', 1),
(6, 'Pillow', 1),
(7, 'Flat Bottom (3d)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_baseshel`
--

CREATE TABLE `work_order_ui_print_baseshel` (
  `print_baseshel_id` int(50) NOT NULL,
  `print_baseshel_value` varchar(100) NOT NULL,
  `print_baseshel_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_baseshel`
--

INSERT INTO `work_order_ui_print_baseshel` (`print_baseshel_id`, `print_baseshel_value`, `print_baseshel_show`) VALUES
(1, 'New', 1),
(2, 'Existing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_cylinder_supplier`
--

CREATE TABLE `work_order_ui_print_cylinder_supplier` (
  `cylinder_supplier_id` int(50) NOT NULL,
  `cylinder_supplier_value` varchar(100) NOT NULL,
  `cylinder_supplier_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_cylinder_supplier`
--

INSERT INTO `work_order_ui_print_cylinder_supplier` (`cylinder_supplier_id`, `cylinder_supplier_value`, `cylinder_supplier_show`) VALUES
(1, 'Gulfscan ', 1),
(2, 'FME', 1),
(3, 'In House', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_end_options`
--

CREATE TABLE `work_order_ui_print_end_options` (
  `print_end_options_id` int(5) NOT NULL,
  `print_end_options_value` varchar(100) NOT NULL,
  `print_end_options_show` int(1) NOT NULL DEFAULT 1
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
(10, 'PREO', 0),
(11, 'Matt Lacquer Single Component ', 1),
(12, 'Matt Lacquer Double Component ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_eyemark_da`
--

CREATE TABLE `work_order_ui_print_eyemark_da` (
  `eyemark_da_id` int(5) NOT NULL,
  `eyemark_da_value` varchar(100) NOT NULL,
  `eyemark_da_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_eyemark_da`
--

INSERT INTO `work_order_ui_print_eyemark_da` (`eyemark_da_id`, `eyemark_da_value`, `eyemark_da_show`) VALUES
(1, 'Left', 1),
(2, 'Right', 1),
(3, 'Center', 1),
(4, 'Off-Center', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_eyemark_path`
--

CREATE TABLE `work_order_ui_print_eyemark_path` (
  `eyemark_path_id` int(50) NOT NULL,
  `eyemark_path_value` varchar(100) NOT NULL,
  `eyemark_path_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_eyemark_path`
--

INSERT INTO `work_order_ui_print_eyemark_path` (`eyemark_path_id`, `eyemark_path_value`, `eyemark_path_show`) VALUES
(1, 'Metallic', 1),
(2, 'Transparent', 1),
(3, 'Opaque', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_ink_sys`
--

CREATE TABLE `work_order_ui_print_ink_sys` (
  `ink_sys_id` int(50) NOT NULL,
  `ink_sys_value` varchar(100) NOT NULL,
  `ink_sys_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_ink_sys`
--

INSERT INTO `work_order_ui_print_ink_sys` (`ink_sys_id`, `ink_sys_value`, `ink_sys_show`) VALUES
(1, 'NC', 1),
(2, 'PU', 1),
(3, 'NC/PU', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_options`
--

CREATE TABLE `work_order_ui_print_options` (
  `print_options_id` int(5) NOT NULL,
  `print_options_value` varchar(100) NOT NULL,
  `print_options_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_options`
--

INSERT INTO `work_order_ui_print_options` (`print_options_id`, `print_options_value`, `print_options_show`) VALUES
(1, 'Customer OFFLINE', 1),
(2, 'Customer ONLINE', 1),
(3, 'QC Manager', 1),
(4, 'QC Supervisor', 1),
(5, 'Sales Manager', 1),
(6, 'Sales Coordinator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_shadecardreq`
--

CREATE TABLE `work_order_ui_print_shadecardreq` (
  `shadecardreq_id` int(5) NOT NULL,
  `shadecardreq_value` varchar(100) NOT NULL,
  `shadecardreq_show` int(1) NOT NULL DEFAULT 1
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
  `shadecard_ref_type_show` int(2) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_shadecard_ref_type`
--

INSERT INTO `work_order_ui_print_shadecard_ref_type` (`shadecard_ref_type_id`, `shadecard_ref_type_value`, `shadecard_ref_type_show`) VALUES
(1, 'Digital Artwork', 1),
(2, 'GMG', 1),
(3, 'Cylinder Proof', 1),
(4, 'Customer Sample', 1),
(5, 'Shade Card', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_print_surfrev`
--

CREATE TABLE `work_order_ui_print_surfrev` (
  `surfrev_id` int(6) NOT NULL,
  `surfrev_value` varchar(100) NOT NULL,
  `surfrev_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_print_surfrev`
--

INSERT INTO `work_order_ui_print_surfrev` (`surfrev_id`, `surfrev_value`, `surfrev_show`) VALUES
(1, 'Surface', 1),
(2, 'Reverse', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_core_id_length`
--

CREATE TABLE `work_order_ui_slitting_core_id_length` (
  `slitting_core_id_length_id` int(5) NOT NULL,
  `slitting_core_id_length_value` varchar(100) NOT NULL,
  `slitting_core_id_length_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `work_order_ui_slitting_core_id_type` (
  `slitting_core_id_type_id` int(5) NOT NULL,
  `slitting_core_id_type_value` varchar(100) NOT NULL,
  `slitting_core_id_type_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `work_order_ui_slitting_core_plugs` (
  `core_plugs_id` int(50) NOT NULL,
  `core_plugs_value` varchar(10) NOT NULL,
  `core_plugs_show` int(1) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_core_plugs`
--

INSERT INTO `work_order_ui_slitting_core_plugs` (`core_plugs_id`, `core_plugs_value`, `core_plugs_show`) VALUES
(1, 'Yes', 1),
(2, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_packing_opts`
--

CREATE TABLE `work_order_ui_slitting_packing_opts` (
  `slitting_packing_opts_id` int(5) NOT NULL,
  `slitting_packing_opts_value` varchar(100) NOT NULL,
  `slitting_packing_opts_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_packing_opts`
--

INSERT INTO `work_order_ui_slitting_packing_opts` (`slitting_packing_opts_id`, `slitting_packing_opts_value`, `slitting_packing_opts_show`) VALUES
(1, 'KGS', 1),
(2, 'NOS', 1),
(3, 'MTR', 1),
(10, 'Carton PTD', 1),
(5, 'L.MTR', 1),
(6, 'IMP', 1),
(7, 'Polybag', 1),
(8, 'POLYBAG + Carton', 1),
(9, 'Bundles', 1),
(11, 'Carton UNPTD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_pallet`
--

CREATE TABLE `work_order_ui_slitting_pallet` (
  `slitting_pallet_id` int(5) NOT NULL,
  `slitting_pallet_value` varchar(100) NOT NULL,
  `slitting_pallet_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `work_order_ui_slitting_pallet_instructions` (
  `pallet_instructions_id` int(5) NOT NULL,
  `pallet_instructions_value` varchar(100) NOT NULL,
  `pallet_instructions_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_pallet_instructions`
--

INSERT INTO `work_order_ui_slitting_pallet_instructions` (`pallet_instructions_id`, `pallet_instructions_value`, `pallet_instructions_show`) VALUES
(1, 'Collective', 1),
(2, 'Individual', 1),
(3, 'Marking - Label on Pallet', 1),
(4, 'Marking - Sample Pasted on Pallet', 1),
(5, 'Marking - Mixed Variants', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_qc_ins`
--

CREATE TABLE `work_order_ui_slitting_qc_ins` (
  `slitting_qc_ins_id` int(5) NOT NULL,
  `slitting_qc_ins_value` varchar(100) NOT NULL,
  `slitting_qc_ins_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_qc_ins`
--

INSERT INTO `work_order_ui_slitting_qc_ins` (`slitting_qc_ins_id`, `slitting_qc_ins_value`, `slitting_qc_ins_show`) VALUES
(1, 'Red Tape on Joint', 1),
(2, 'Flush/Smooth Winding', 1),
(3, 'Registered Joint', 1),
(4, 'Smooth Edges/ No Micro Cuts', 1),
(5, 'QA Certificate of Analysis', 1),
(6, 'Blue Tape on Joint', 1),
(7, 'White Tape on Joint', 1),
(8, 'Transparent Tape on Joint', 1),
(9, 'Brown Tape on Joint', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_slitting_sticker`
--

CREATE TABLE `work_order_ui_slitting_sticker` (
  `slitting_sticker_id` int(5) NOT NULL,
  `slitting_sticker_value` varchar(100) NOT NULL,
  `slitting_sticker_show` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order_ui_slitting_sticker`
--

INSERT INTO `work_order_ui_slitting_sticker` (`slitting_sticker_id`, `slitting_sticker_value`, `slitting_sticker_show`) VALUES
(1, 'Printed', 1),
(2, 'Unprinted', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_ui_structure`
--

CREATE TABLE `work_order_ui_structure` (
  `structure_id` int(50) NOT NULL,
  `structure_value` varchar(698) NOT NULL,
  `structure_show` int(1) NOT NULL DEFAULT 1
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
  `wind_show` int(1) NOT NULL DEFAULT 1
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
-- Indexes for table `work_order_input_form_master_container`
--
ALTER TABLE `work_order_input_form_master_container`
  ADD PRIMARY KEY (`form_container_id`);

--
-- Indexes for table `work_order_input_form_master_container_parent`
--
ALTER TABLE `work_order_input_form_master_container_parent`
  ADD PRIMARY KEY (`form_master_container_parent_id`);

--
-- Indexes for table `work_order_input_form_master_container_types`
--
ALTER TABLE `work_order_input_form_master_container_types`
  ADD PRIMARY KEY (`form_master_container_types_id`);

--
-- Indexes for table `work_order_qty_units`
--
ALTER TABLE `work_order_qty_units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `work_order_ui_bag_gusset_bottom`
--
ALTER TABLE `work_order_ui_bag_gusset_bottom`
  ADD PRIMARY KEY (`gusset_bottom_id`);

--
-- Indexes for table `work_order_ui_bag_gusset_side`
--
ALTER TABLE `work_order_ui_bag_gusset_side`
  ADD PRIMARY KEY (`gusset_side_id`);

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
-- Indexes for table `work_order_ui_customer_location`
--
ALTER TABLE `work_order_ui_customer_location`
  ADD PRIMARY KEY (`customer_location_id`);

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
-- Indexes for table `work_order_ui_pe_film_feature`
--
ALTER TABLE `work_order_ui_pe_film_feature`
  ADD PRIMARY KEY (`pe_film_feature_id`);

--
-- Indexes for table `work_order_ui_pouch_closure_type`
--
ALTER TABLE `work_order_ui_pouch_closure_type`
  ADD PRIMARY KEY (`pouch_closure_type_id`);

--
-- Indexes for table `work_order_ui_pouch_corner_type`
--
ALTER TABLE `work_order_ui_pouch_corner_type`
  ADD PRIMARY KEY (`pouch_corner_type_id`);

--
-- Indexes for table `work_order_ui_pouch_euro_punch`
--
ALTER TABLE `work_order_ui_pouch_euro_punch`
  ADD PRIMARY KEY (`pouch_euro_punch_id`);

--
-- Indexes for table `work_order_ui_pouch_gusset_bottom`
--
ALTER TABLE `work_order_ui_pouch_gusset_bottom`
  ADD PRIMARY KEY (`pouch_gusset_bottom_id`);

--
-- Indexes for table `work_order_ui_pouch_gusset_side`
--
ALTER TABLE `work_order_ui_pouch_gusset_side`
  ADD PRIMARY KEY (`pouch_gusset_side_id`);

--
-- Indexes for table `work_order_ui_pouch_hole_punch`
--
ALTER TABLE `work_order_ui_pouch_hole_punch`
  ADD PRIMARY KEY (`pouch_hole_punch_id`);

--
-- Indexes for table `work_order_ui_pouch_notch_side`
--
ALTER TABLE `work_order_ui_pouch_notch_side`
  ADD PRIMARY KEY (`pouch_notch_side_id`);

--
-- Indexes for table `work_order_ui_pouch_pouch_open`
--
ALTER TABLE `work_order_ui_pouch_pouch_open`
  ADD PRIMARY KEY (`pouch_open_id`);

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
-- Indexes for table `work_order_ui_pouch_special_tooling`
--
ALTER TABLE `work_order_ui_pouch_special_tooling`
  ADD PRIMARY KEY (`pouch_special_tooling_id`);

--
-- Indexes for table `work_order_ui_pouch_type`
--
ALTER TABLE `work_order_ui_pouch_type`
  ADD PRIMARY KEY (`pouch_type_id`);

--
-- Indexes for table `work_order_ui_print_baseshel`
--
ALTER TABLE `work_order_ui_print_baseshel`
  ADD PRIMARY KEY (`print_baseshel_id`);

--
-- Indexes for table `work_order_ui_print_cylinder_supplier`
--
ALTER TABLE `work_order_ui_print_cylinder_supplier`
  ADD PRIMARY KEY (`cylinder_supplier_id`);

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
-- Indexes for table `work_order_ui_print_eyemark_path`
--
ALTER TABLE `work_order_ui_print_eyemark_path`
  ADD PRIMARY KEY (`eyemark_path_id`);

--
-- Indexes for table `work_order_ui_print_ink_sys`
--
ALTER TABLE `work_order_ui_print_ink_sys`
  ADD PRIMARY KEY (`ink_sys_id`);

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
-- Indexes for table `work_order_ui_slitting_core_plugs`
--
ALTER TABLE `work_order_ui_slitting_core_plugs`
  ADD PRIMARY KEY (`core_plugs_id`);

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
-- Indexes for table `work_order_ui_slitting_pallet_instructions`
--
ALTER TABLE `work_order_ui_slitting_pallet_instructions`
  ADD PRIMARY KEY (`pallet_instructions_id`);

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
  MODIFY `client_id` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `complaints_main`
--
ALTER TABLE `complaints_main`
  MODIFY `complaint_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logcat_main`
--
ALTER TABLE `logcat_main`
  MODIFY `logcat_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `master_work_order_main`
--
ALTER TABLE `master_work_order_main`
  MODIFY `master_wo_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_work_order_main_identitiy`
--
ALTER TABLE `master_work_order_main_identitiy`
  MODIFY `mwoid_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `master_work_order_reference_number`
--
ALTER TABLE `master_work_order_reference_number`
  MODIFY `mwo_ref_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `materials_main`
--
ALTER TABLE `materials_main`
  MODIFY `material_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `modules_groups`
--
ALTER TABLE `modules_groups`
  MODIFY `mg_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `modules_main`
--
ALTER TABLE `modules_main`
  MODIFY `mod_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `remarks_identity`
--
ALTER TABLE `remarks_identity`
  MODIFY `remarkiden_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `remarks_wo`
--
ALTER TABLE `remarks_wo`
  MODIFY `remark_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_work_order_main`
--
ALTER TABLE `sales_work_order_main`
  MODIFY `s_wo_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_work_order_main_identitiy`
--
ALTER TABLE `sales_work_order_main_identitiy`
  MODIFY `woi_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `session_tracker`
--
ALTER TABLE `session_tracker`
  MODIFY `sess_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_pending`
--
ALTER TABLE `users_pending`
  MODIFY `pending_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_main`
--
ALTER TABLE `user_main`
  MODIFY `lum_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_sales_attach`
--
ALTER TABLE `user_sales_attach`
  MODIFY `attach_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `user_type_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `work_order_applications`
--
ALTER TABLE `work_order_applications`
  MODIFY `application_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `work_order_input_form_master_container`
--
ALTER TABLE `work_order_input_form_master_container`
  MODIFY `form_container_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_order_input_form_master_container_parent`
--
ALTER TABLE `work_order_input_form_master_container_parent`
  MODIFY `form_master_container_parent_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `work_order_input_form_master_container_types`
--
ALTER TABLE `work_order_input_form_master_container_types`
  MODIFY `form_master_container_types_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `work_order_qty_units`
--
ALTER TABLE `work_order_qty_units`
  MODIFY `unit_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `work_order_ui_bag_gusset_bottom`
--
ALTER TABLE `work_order_ui_bag_gusset_bottom`
  MODIFY `gusset_bottom_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_order_ui_bag_gusset_side`
--
ALTER TABLE `work_order_ui_bag_gusset_side`
  MODIFY `gusset_side_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_order_ui_bag_handle`
--
ALTER TABLE `work_order_ui_bag_handle`
  MODIFY `bag_handle_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `work_order_ui_customer_location`
--
ALTER TABLE `work_order_ui_customer_location`
  MODIFY `customer_location_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_order_ui_ext_antistatic`
--
ALTER TABLE `work_order_ui_ext_antistatic`
  MODIFY `anti_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_order_ui_ext_cof`
--
ALTER TABLE `work_order_ui_ext_cof`
  MODIFY `cof_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `ext_options_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `work_order_ui_ext_treatment`
--
ALTER TABLE `work_order_ui_ext_treatment`
  MODIFY `treat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_order_ui_lam_end_options`
--
ALTER TABLE `work_order_ui_lam_end_options`
  MODIFY `lam_end_options_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `work_order_ui_pe_film_feature`
--
ALTER TABLE `work_order_ui_pe_film_feature`
  MODIFY `pe_film_feature_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `work_order_ui_pouch_closure_type`
--
ALTER TABLE `work_order_ui_pouch_closure_type`
  MODIFY `pouch_closure_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `work_order_ui_pouch_corner_type`
--
ALTER TABLE `work_order_ui_pouch_corner_type`
  MODIFY `pouch_corner_type_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_order_ui_pouch_euro_punch`
--
ALTER TABLE `work_order_ui_pouch_euro_punch`
  MODIFY `pouch_euro_punch_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `work_order_ui_pouch_gusset_bottom`
--
ALTER TABLE `work_order_ui_pouch_gusset_bottom`
  MODIFY `pouch_gusset_bottom_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_order_ui_pouch_gusset_side`
--
ALTER TABLE `work_order_ui_pouch_gusset_side`
  MODIFY `pouch_gusset_side_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_order_ui_pouch_hole_punch`
--
ALTER TABLE `work_order_ui_pouch_hole_punch`
  MODIFY `pouch_hole_punch_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_order_ui_pouch_notch_side`
--
ALTER TABLE `work_order_ui_pouch_notch_side`
  MODIFY `pouch_notch_side_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `work_order_ui_pouch_pouch_open`
--
ALTER TABLE `work_order_ui_pouch_pouch_open`
  MODIFY `pouch_open_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_order_ui_pouch_seal`
--
ALTER TABLE `work_order_ui_pouch_seal`
  MODIFY `pouch_seal_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_order_ui_pouch_sealing`
--
ALTER TABLE `work_order_ui_pouch_sealing`
  MODIFY `pouch_sealing_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_order_ui_pouch_special_tooling`
--
ALTER TABLE `work_order_ui_pouch_special_tooling`
  MODIFY `pouch_special_tooling_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_order_ui_pouch_type`
--
ALTER TABLE `work_order_ui_pouch_type`
  MODIFY `pouch_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `work_order_ui_print_baseshel`
--
ALTER TABLE `work_order_ui_print_baseshel`
  MODIFY `print_baseshel_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_order_ui_print_cylinder_supplier`
--
ALTER TABLE `work_order_ui_print_cylinder_supplier`
  MODIFY `cylinder_supplier_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_order_ui_print_end_options`
--
ALTER TABLE `work_order_ui_print_end_options`
  MODIFY `print_end_options_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `work_order_ui_print_eyemark_da`
--
ALTER TABLE `work_order_ui_print_eyemark_da`
  MODIFY `eyemark_da_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `work_order_ui_print_eyemark_path`
--
ALTER TABLE `work_order_ui_print_eyemark_path`
  MODIFY `eyemark_path_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_order_ui_print_ink_sys`
--
ALTER TABLE `work_order_ui_print_ink_sys`
  MODIFY `ink_sys_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_order_ui_print_options`
--
ALTER TABLE `work_order_ui_print_options`
  MODIFY `print_options_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `work_order_ui_print_shadecardreq`
--
ALTER TABLE `work_order_ui_print_shadecardreq`
  MODIFY `shadecardreq_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_order_ui_print_shadecard_ref_type`
--
ALTER TABLE `work_order_ui_print_shadecard_ref_type`
  MODIFY `shadecard_ref_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `work_order_ui_print_surfrev`
--
ALTER TABLE `work_order_ui_print_surfrev`
  MODIFY `surfrev_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_order_ui_slitting_core_id_length`
--
ALTER TABLE `work_order_ui_slitting_core_id_length`
  MODIFY `slitting_core_id_length_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_order_ui_slitting_core_id_type`
--
ALTER TABLE `work_order_ui_slitting_core_id_type`
  MODIFY `slitting_core_id_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_order_ui_slitting_core_plugs`
--
ALTER TABLE `work_order_ui_slitting_core_plugs`
  MODIFY `core_plugs_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_order_ui_slitting_packing_opts`
--
ALTER TABLE `work_order_ui_slitting_packing_opts`
  MODIFY `slitting_packing_opts_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `work_order_ui_slitting_pallet`
--
ALTER TABLE `work_order_ui_slitting_pallet`
  MODIFY `slitting_pallet_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `work_order_ui_slitting_pallet_instructions`
--
ALTER TABLE `work_order_ui_slitting_pallet_instructions`
  MODIFY `pallet_instructions_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `work_order_ui_slitting_qc_ins`
--
ALTER TABLE `work_order_ui_slitting_qc_ins`
  MODIFY `slitting_qc_ins_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `work_order_ui_slitting_sticker`
--
ALTER TABLE `work_order_ui_slitting_sticker`
  MODIFY `slitting_sticker_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
