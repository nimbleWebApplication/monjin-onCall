-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Sep 18, 2021 at 09:24 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monjin-call`
--

-- --------------------------------------------------------

--
-- Table structure for table `jinlms_campaign`
--

CREATE TABLE `jinlms_campaign` (
  `campaign_id` int(11) NOT NULL,
  `campaign_name` varchar(100) NOT NULL,
  `campaign_schedule` datetime DEFAULT NULL,
  `campaign_synchronise` int(2) DEFAULT 0 COMMENT '0=no 1=yes\r\n2=proessing\r\n3= complete\r\n',
  `campaign_co_ordinator` int(11) NOT NULL DEFAULT 0,
  `campaign_isDelete` int(2) NOT NULL DEFAULT 0,
  `campaign_createdon` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jinlms_campaign`
--

INSERT INTO `jinlms_campaign` (`campaign_id`, `campaign_name`, `campaign_schedule`, `campaign_synchronise`, `campaign_co_ordinator`, `campaign_isDelete`, `campaign_createdon`) VALUES
(1, 'test campaign', '2021-08-26 05:31:11', 1, 1, 0, '2021-09-07 05:21:21'),
(2, 'Tech Mahindra', '2021-08-26 05:31:11', 3, 9, 0, '2021-09-07 05:21:29'),
(3, 'Tech Mahindra 2', '2021-08-26 05:31:11', 0, 10, 0, '2021-09-07 05:21:35'),
(4, 'Nimble', '2021-08-26 05:31:11', 0, 1, 0, '2021-09-07 05:29:53'),
(9, 'Tech Mahindra', '2021-08-27 00:00:00', 0, 1, 0, '2021-09-07 05:29:58'),
(13, 'Infosys', '2021-08-29 00:00:00', 0, 10, 0, '2021-09-07 05:28:05'),
(15, 'Nimble new ', '2021-09-30 00:00:00', 0, 10, 0, '2021-09-07 11:18:24'),
(16, 'Infosys new', '2021-09-28 00:00:00', 0, 10, 0, '2021-09-07 11:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `jinlms_campaign_student`
--

CREATE TABLE `jinlms_campaign_student` (
  `student_id` int(11) NOT NULL,
  `student_campaign_id` int(11) NOT NULL,
  `student_ref_code` longtext DEFAULT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_contact` varchar(15) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `student_schedule_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `student_status` int(2) NOT NULL DEFAULT 0 COMMENT '0=Processing\r\n1=Interested and confirmed\r\n2=Not Interested and confirmed\r\n3=Rescheduling required\r\n4= interview complete',
  `student_action` varchar(100) DEFAULT NULL,
  `student_isDelete` int(2) NOT NULL,
  `student_createdon` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jinlms_campaign_student`
--

INSERT INTO `jinlms_campaign_student` (`student_id`, `student_campaign_id`, `student_ref_code`, `student_name`, `student_contact`, `student_email`, `student_schedule_date`, `student_status`, `student_action`, `student_isDelete`, `student_createdon`) VALUES
(1, 1, 'S-001-001', 'Ms. Swati Bilare', '9874563210', 'swati.bhilare@gmail.com', '2021-08-25 12:13:09', 1, NULL, 0, '2021-08-25 12:13:09'),
(2, 3, 'S-001-002', 'Ms. Swati Nilkanth	', '9874563210', 'swati.june3@gmail.com', '2021-08-25 13:21:42', 2, NULL, 0, '2021-08-25 13:21:42'),
(3, 4, 'Nimble-000-0001', 'Neeta Joshi', '9970180518', 'neetaj@nimble-esolutions.com', '2021-09-08 10:24:50', 0, NULL, 0, '2021-09-07 10:25:00'),
(4, 4, 'Nimble-000-0002', 'Pradnya Kulkarni', '8237627185', 'info@nimble-esolutions.com', '2021-09-08 10:25:02', 0, NULL, 0, '2021-09-07 10:25:05'),
(5, 4, 'Nimble-000-0003', 'Kunjika Dhapare', '7058686779', 'applicationdevelopment@nimble-esolutions.com', '2021-09-08 10:25:07', 0, NULL, 0, '2021-09-07 10:25:09'),
(6, 4, 'Nimble-000-0004', 'Sandip Dhaphal', '9890575638', 'webapps@nimble-esolutions.com', '2021-09-08 10:25:11', 0, NULL, 0, '2021-09-07 10:25:16'),
(7, 9, 'Nimble-000-0001', 'Neeta Joshi', '9970180518', 'neetaj@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-08-26 04:47:26'),
(8, 9, 'Nimble-000-0002', 'Pradnya Kulkarni', '8237627185', 'info@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-08-26 04:47:26'),
(9, 9, 'Nimble-000-0003', 'Kunjika Dhapare', '7058686779', 'applicationdevelopment@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-08-26 04:47:26'),
(10, 9, 'Nimble-000-0004', 'Sandip Dhaphal', '9890575638', 'webapps@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-08-26 04:47:26'),
(11, 2, 'Nimble-000-0001', 'Neeta Joshi', '9970180518', 'neetaj@nimble-esolutions.com', '2021-08-26 05:55:13', 1, NULL, 0, '2021-08-26 05:55:13'),
(12, 2, 'Nimble-000-0002', 'Pradnya Kulkarni', '8237627185', 'info@nimble-esolutions.com', '2021-08-26 05:55:18', 1, NULL, 0, '2021-08-26 05:55:18'),
(13, 2, 'Nimble-000-0003', 'Kunjika Dhapare', '7058686779', 'applicationdevelopment@nimble-esolutions.com', '2021-08-26 05:55:24', 2, NULL, 0, '2021-08-26 05:55:24'),
(14, 2, 'Nimble-000-0004', 'Sandip Dhaphal', '9890575638', 'webapps@nimble-esolutions.com', '2021-08-26 05:55:31', 2, NULL, 0, '2021-08-26 05:55:31'),
(15, 13, 'Nimble-000-0001', 'Neeta Joshi', '9970180518', 'neetaj@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-08-26 06:13:35'),
(16, 13, 'Nimble-000-0002', 'Pradnya Kulkarni', '8237627185', 'info@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-08-26 06:13:36'),
(17, 13, 'Nimble-000-0003', 'Kunjika Dhapare', '7058686779', 'applicationdevelopment@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-08-26 06:13:36'),
(18, 13, 'Nimble-000-0004', 'Sandip Dhaphal', '9890575638', 'webapps@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-08-26 06:13:36'),
(19, 15, 'Nimble-000-0001', 'Neeta Joshi', '9970180518', 'neetaj@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-09-07 11:18:59'),
(20, 15, 'Nimble-000-0002', 'Pradnya Kulkarni', '8237627185', 'info@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-09-07 11:18:59'),
(21, 15, 'Nimble-000-0003', 'Kunjika Dhapare', '7058686779', 'applicationdevelopment@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-09-07 11:19:00'),
(22, 15, 'Nimble-000-0004', 'Sandip Dhaphal', '9890575638', 'webapps@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-09-07 11:19:00'),
(23, 16, 'Nimble-000-0001', 'Neeta Joshi', '9970180518', 'neetaj@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-09-07 11:42:53'),
(24, 16, 'Nimble-000-0002', 'Pradnya Kulkarni', '8237627185', 'info@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-09-07 11:42:53'),
(25, 16, 'Nimble-000-0003', 'Kunjika Dhapare', '7058686779', 'applicationdevelopment@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-09-07 11:42:53'),
(26, 16, 'Nimble-000-0004', 'Sandip Dhaphal', '9890575638', 'webapps@nimble-esolutions.com', '0000-00-00 00:00:00', 0, NULL, 0, '2021-09-07 11:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `jinlms_student_call`
--

CREATE TABLE `jinlms_student_call` (
  `call_id` int(11) NOT NULL,
  `call_student_id` int(11) NOT NULL,
  `call_status` varchar(100) NOT NULL COMMENT 'CC	Candidate Confirm	\r\nCBL	Call Back Later	\r\nCNI	Candidate Not Interested	Eg - Accepted offer\r\nCNR	Candidate Not Responding	\r\nCNA	Candidate Not Available	Eg - Busy with work\r\nER	Erroneous Name / Mobile / Email	',
  `call_remark` longtext DEFAULT NULL,
  `call_createdBy` int(11) DEFAULT NULL,
  `call_isDelete` int(2) NOT NULL DEFAULT 0,
  `call_createdon` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jinlms_student_call`
--

INSERT INTO `jinlms_student_call` (`call_id`, `call_student_id`, `call_status`, `call_remark`, `call_createdBy`, `call_isDelete`, `call_createdon`) VALUES
(1, 2, '0', '1', 9, 0, '2021-08-25 08:04:24'),
(2, 1, '0', '1', 9, 0, '2021-08-25 08:04:57'),
(3, 1, '0', '1', 9, 0, '2021-08-25 08:05:51'),
(4, 1, '0', '4', 9, 0, '2021-08-25 08:05:59'),
(5, 2, '0', '2', 9, 0, '2021-08-25 08:07:13'),
(6, 2, '0', '3', 9, 0, '2021-08-25 08:07:38'),
(7, 2, '0', '4', 9, 0, '2021-08-25 08:11:00'),
(8, 2, '0', '5', 9, 0, '2021-08-25 09:16:06'),
(9, 2, '0', '6', 9, 0, '2021-08-25 09:16:46'),
(10, 2, '0', '7', 9, 0, '2021-08-25 09:17:22'),
(11, 2, '0', '8', 9, 0, '2021-08-25 09:17:49'),
(12, 1, '0', '444', 9, 0, '2021-08-25 09:18:14'),
(13, 18, '0', 'test call', 9, 0, '2021-08-26 06:19:39'),
(14, 1, '', 'ffgfgfg', 9, 0, '2021-08-26 07:09:50'),
(15, 3, 'CC', 'tesr', 9, 0, '2021-09-07 09:59:19'),
(16, 3, '', 'test', 9, 0, '2021-09-07 09:58:26'),
(17, 3, 'CNA', 'test', 9, 0, '2021-09-07 10:00:29'),
(18, 2, 'CNR', 'test', 9, 0, '2021-09-07 10:01:18'),
(19, 14, 'CNI', 'Not intersted', 9, 0, '2021-09-07 10:25:45'),
(20, 13, 'CC', 'on test', 9, 0, '2021-09-07 10:26:11'),
(21, 12, 'CNR', 'test', 9, 0, '2021-09-07 10:29:12'),
(22, 11, 'CNA', 'not available', 9, 0, '2021-09-07 10:29:44'),
(23, 6, 'CNR', 'test', 9, 0, '2021-09-07 10:32:27'),
(24, 5, 'CBL', 'test', 9, 0, '2021-09-07 10:32:41'),
(25, 5, 'CBL', 'test', 9, 0, '2021-09-07 10:32:42'),
(26, 4, 'ER', 'test', 9, 0, '2021-09-07 10:32:53'),
(27, 6, 'CNR', 'jhjvh', 9, 0, '2021-09-07 10:52:48'),
(28, 22, 'CC', 'yes', 9, 0, '2021-09-07 11:19:20'),
(29, 26, 'CBL', 'Test', 9, 0, '2021-09-07 11:44:27'),
(30, 26, 'CC', 'confirm today', 9, 0, '2021-09-07 11:45:33'),
(31, 26, 'CBL', '', 9, 0, '2021-09-07 11:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `jinlms_user`
--

CREATE TABLE `jinlms_user` (
  `user_id` int(11) NOT NULL,
  `user_firstName` varchar(50) NOT NULL,
  `user_middleName` varchar(50) DEFAULT NULL,
  `user_lastName` varchar(50) NOT NULL,
  `user_mobile` varchar(15) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_adhar_card` varchar(12) DEFAULT NULL,
  `user_pan_card` varchar(10) DEFAULT NULL,
  `user_passport` varchar(10) DEFAULT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `user_vendor_id` int(11) NOT NULL DEFAULT 0,
  `user_isDelete` int(2) NOT NULL DEFAULT 0,
  `user_createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_createdBy` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jinlms_user`
--

INSERT INTO `jinlms_user` (`user_id`, `user_firstName`, `user_middleName`, `user_lastName`, `user_mobile`, `user_email`, `user_adhar_card`, `user_pan_card`, `user_passport`, `user_password`, `user_role_id`, `user_vendor_id`, `user_isDelete`, `user_createdOn`, `user_createdBy`) VALUES
(1, 'Nimble', NULL, 'eSolutions', '8237627185', 'info@nimble-esolutions.com', NULL, NULL, NULL, '$2y$10$lciyAML/2jdhYoM5xr7xH.HB5CNEBVxUTPzoCG.xDR4ZPNRiRqB2.', 1, 0, 0, '2021-01-27 06:50:07', 1),
(9, 'Ashutosh', NULL, 'Monjin', '1234567890', 'ashutosh@monjin.com', NULL, NULL, NULL, '$2y$10$Ux1KQB86Vdf7/DL0dHUZzOhRe6KtFvBErD15ArBXIVL8GhPqsymQq', 2, 0, 0, '2021-07-27 13:47:22', 1),
(10, 'Co-ordinator', NULL, 'Nimble', '9874563210', 'co-ordinator@gmail.com', NULL, NULL, NULL, '$2y$10$bS9HgyzHaX9cK7KFAyR/5.PSQaHpNXtUPF8swHnsDToQMuh1QXvOa', 3, 0, 0, '2021-08-25 09:38:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jinlms_user_role`
--

CREATE TABLE `jinlms_user_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_isValid` int(2) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jinlms_user_role`
--

INSERT INTO `jinlms_user_role` (`role_id`, `role_name`, `role_isValid`) VALUES
(1, 'Super Admin', 0),
(2, 'Admin', 0),
(3, 'Co-ordinator', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jinlms_user_session`
--

CREATE TABLE `jinlms_user_session` (
  `id` int(20) NOT NULL,
  `user_id` int(10) NOT NULL,
  `hash` varchar(64) NOT NULL,
  `islogedinn` int(10) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout_time` timestamp NULL DEFAULT NULL,
  `ip_address` longtext DEFAULT NULL,
  `os` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jinlms_user_session`
--

INSERT INTO `jinlms_user_session` (`id`, `user_id`, `hash`, `islogedinn`, `login_time`, `logout_time`, `ip_address`, `os`) VALUES
(1, 1, '$2y$10$0/CvWsiuyuzyjtTufUK.Du8wqnHBtD23CLEzQiDwHBhX6CKpGW2ie', 1, '2021-01-28 09:16:38', NULL, '::1', 'Windows 7'),
(2, 1, '$2y$10$ZGAeklqfBm.eo4ChYdpOpOwtoRMcyVg3KiobsQq87WKKutk2YVsWK', 1, '2021-01-28 09:56:07', NULL, '::1', 'Windows 7'),
(3, 1, '$2y$10$vQGm5bwXf7y01xp9qwn4VePw552CTBNs361NZjkAc3RSVyn7Z5uDC', 1, '2021-01-28 12:36:04', NULL, '::1', 'Windows 7'),
(4, 1, '$2y$10$pnW/ryk8jPvngAYQoDrDNuKIcXprL3QJoIJ.TeRVrSHsxbzLDJGTq', 1, '2021-01-29 05:42:45', NULL, '::1', 'Windows 7'),
(5, 3, '$2y$10$uEcq8PLZDjQlVSv.SBcSeeeinAOpq28/Sr8hhKflIcKuxfFolgwgO', 1, '2021-01-29 06:38:56', NULL, '::1', 'Windows 7'),
(6, 3, '$2y$10$BDTK/Cvv22vousGayZSq9ep58DMHRdO4YAN3s..Dgi7cfF67CEW5m', 1, '2021-01-29 06:45:41', NULL, '::1', 'Windows 7'),
(7, 1, '$2y$10$w8Q5staPH3Uw7M.rDhQUi.xpOEtXvRpeiGfUiysnbQiJ0OeESJ1qi', 1, '2021-01-29 06:54:42', NULL, '::1', 'Windows 7'),
(8, 1, '$2y$10$zZ3OOPxBtfJBqkBkEpoT3e71SaZAxNCR.nSzygws/zQszY4mqYIwe', 1, '2021-02-01 12:16:02', NULL, '::1', 'Windows 7'),
(9, 1, '$2y$10$sb4n1QQRBl.9vVsuNTAaNesm7iUgE32kdNn6scJNCVvAoSjLWC4OW', 1, '2021-02-02 05:07:54', NULL, '::1', 'Windows 7'),
(10, 1, '$2y$10$1ipYs5BroOrXqoVhdgqCOu4AtRl7TfexnDv3P5s1KbnwfHWqiHzVu', 1, '2021-02-05 09:11:44', NULL, '::1', 'Windows 7'),
(11, 1, '$2y$10$2OfvigNTMitkc6k.ZIj6x.WGc2QtNmVB0nmSg4heAG650VhIVTDma', 1, '2021-02-08 04:19:15', NULL, '::1', 'Windows 7'),
(12, 1, '$2y$10$jzBU4mmZrVmBNm016nwNDetSp77YCYDWfjYovdNB0IVhXB4rNeFPq', 1, '2021-02-08 07:00:47', NULL, '::1', 'Windows 7'),
(13, 1, '$2y$10$hGUkRBPMsObcYJfA9VllEO5NQUwonZx4d.CgINmevMr2elyEm4/mS', 1, '2021-02-08 09:45:38', NULL, '::1', 'Windows 7'),
(14, 8, '$2y$10$KK80cldPGCPnXG00WBX0Oeve5WDFiLk9CIlYGXP24s8WWwUXQLvUa', 1, '2021-02-08 12:19:24', NULL, '::1', 'Windows 7'),
(15, 1, '$2y$10$V7gDGh.PRFUStgPMIuX08.JORAJ5fGogol6WHJXDriirj6AoH.h7i', 1, '2021-02-08 12:51:09', NULL, '::1', 'Windows 7'),
(16, 3, '$2y$10$T7mgTXq4rzUtjMk2qiLuse80vAQqXbQ9CfDquO6XPYof3UmbhN2s6', 1, '2021-02-08 12:51:44', NULL, '::1', 'Windows 7'),
(17, 1, '$2y$10$L9JwqPEiMT/.jaTD7XQ6QeRTBCSlSrbTPmTT6HU4SiHZ8LklUTABm', 1, '2021-02-12 07:01:35', NULL, '::1', 'Windows 7'),
(18, 1, '$2y$10$1vO/PGToHPEnzZkmK.TOD.nQdz/uHUPMpVHLjF2PhkoP20ZrbY68C', 1, '2021-02-12 07:03:58', NULL, '::1', 'Windows 7'),
(19, 1, '$2y$10$iQGr8ffOZtX3Z6cXiGmeYuUnkbQChf7/rpCF0c4TqRM5c9fV.zkxO', 1, '2021-02-12 11:01:35', NULL, '::1', 'Windows 7'),
(20, 1, '$2y$10$Z5YAppBRNu/I.a.TTCi7Iu1a.KeHQiDNNgdfMBZLnujQ/sOFoqCVq', 1, '2021-02-15 04:53:19', NULL, '::1', 'Windows 7'),
(21, 3, '$2y$10$zprKL3Fe1IjWHj0.o2FwtO4aF30rT/oHsRkeufFDvvuc8zQdqRyaC', 1, '2021-02-15 05:02:23', NULL, '::1', 'Windows 7'),
(22, 8, '$2y$10$IkUUrOP6HpfzTPpOEWKOqOWqA.dVShHwpiGP.VlutkPp5/IWJD5rW', 1, '2021-02-15 05:03:59', NULL, '::1', 'Windows 7'),
(23, 8, '$2y$10$s95NeNixWaKSrOCsm78A4OSO2lNC88/rUYF4UCXEqUKBYoi1OhazC', 1, '2021-02-15 12:57:55', NULL, '::1', 'Windows 7'),
(24, 8, '$2y$10$bhvooi3tjhM3uTjlfixrJeW5fCcZpTwpWlz6QMNe0PqvSx39626Ki', 1, '2021-02-16 03:54:56', NULL, '::1', 'Windows 7'),
(25, 8, '$2y$10$gKaUdSGOsur0Vn6iAgGOx.7zSQ9wShr9qXy62no7umIG2Wu0593rO', 1, '2021-02-17 12:10:27', NULL, '::1', 'Windows 7'),
(26, 8, '$2y$10$52aFDEnJDBA2yIf0XA3YL.fPaWxSOsvDj0PyJl/7ySr/LOU/syTS.', 1, '2021-02-18 04:28:14', NULL, '::1', 'Windows 7'),
(27, 8, '$2y$10$QewOJ90XP4x6FzUN46RlKu2k1041lNCEDl01LmCx58/FbNMB.TUXG', 1, '2021-02-19 11:02:05', NULL, '::1', 'Windows 7'),
(28, 8, '$2y$10$iKT9aop0QJpmejV4b3iUzOH86UkqUj/WtmdxT/GssVKlju8SQ3C9S', 1, '2021-02-22 08:58:18', NULL, '::1', 'Windows 7'),
(29, 8, '$2y$10$JcagePFJBLk.Nj0IWk.oMe1kHEu0XCsS0DDf1gZ/vQ8FtNPDC.7Uq', 1, '2021-02-23 05:19:48', NULL, '::1', 'Windows 7'),
(30, 3, '$2y$10$X6jxKLNuu2O8symofkSJ/uUtBrKtgnT5V9HOAGIB5LN7NCn8qbmSG', 1, '2021-02-23 05:20:56', NULL, '::1', 'Windows 7'),
(31, 1, '$2y$10$AyqyjwAQv06KiEFC1M8hGuUZq57vSkMObk8BnQIYW6.e7XklYSRea', 1, '2021-02-23 05:22:10', NULL, '::1', 'Windows 7'),
(32, 1, '$2y$10$DQIz/WeBQ/Ukxy0GL8nheOE96MR4pNXrZnTlUZuN.5gublwHiZF16', 1, '2021-02-23 05:24:09', NULL, '::1', 'Windows 7'),
(33, 8, '$2y$10$H7q0YIR0a39gNPjvCErkceUKSQJ07BhpBjNE4D9PlMbvavSKgu7Oa', 1, '2021-02-24 04:16:50', NULL, '::1', 'Windows 7'),
(34, 8, '$2y$10$6U0uSSXwZcsKWtlf9weXT.EvRQEVpERcPviIfzVKMCNYnn/HxY/Cy', 1, '2021-02-24 12:22:38', NULL, '::1', 'Windows 7'),
(35, 8, '$2y$10$fGRPDZxJyJuDzJlHJVhgNuVb/qIlJLp1K15bjwSc45dP4jW4C49Ka', 1, '2021-07-01 08:42:56', NULL, '::1', 'Windows 10'),
(36, 1, '$2y$10$dKWSeokzLX1TD3y2zVqdH.xAMp8tw8ZBKWhY1VWr6fm.0Cb6yZzrq', 1, '2021-07-01 09:58:59', NULL, '::1', 'Windows 10'),
(37, 1, '$2y$10$oTSVYIq8bpgaTqxrtFy.ieKlFAm5N7wwvc8qBvelfx2.uY2Z88/eG', 1, '2021-07-25 14:59:50', NULL, '::1', 'Windows 10'),
(38, 1, '$2y$10$gO88yclkwc9WfdXxPi9bme7fvFBtCN/6z7qzvY0zCBmfdZ5bp8gvO', 1, '2021-07-27 13:21:43', NULL, '::1', 'Windows 10'),
(39, 9, '$2y$10$0DsDSJXUlJfGJHsSv70EZO4bJQdlFwQRcDLS5CpByRswSBlVYJzDy', 1, '2021-07-27 13:48:36', NULL, '::1', 'Windows 10'),
(40, 9, '$2y$10$SEb0InOOQHv5G.qLIXhyyeOZjJ89JglGV1AeOY9US6gACfi/8SNxy', 1, '2021-08-02 07:15:12', NULL, '::1', 'Windows 8.1'),
(41, 9, '$2y$10$WZHir99d2r6VEce87ZJUk.S9gAGgH2HxouaMjWYq.l7Ei79GWmfWu', 1, '2021-08-04 06:05:46', NULL, '::1', 'Windows 8.1'),
(42, 9, '$2y$10$cXcWXoi54cW7uW5eJJXFxuhAZQ1s3IBBqNNSIe1A3bATmCkVhAMi.', 1, '2021-08-13 06:20:37', NULL, '::1', 'Windows 8.1'),
(43, 9, '$2y$10$dSZ1ltDfPXrh8haXAba.d.ysSAEc4vDSoZMWM.g/SVsILTZwEpbS6', 1, '2021-08-13 07:06:08', NULL, '::1', 'Windows 8.1'),
(44, 9, '$2y$10$Pg3nym2JgDrhdZUFklKaIOSVXXiB0qP/TZqeT5DNkdOgJIh7X357u', 1, '2021-08-24 05:35:06', NULL, '::1', 'Windows 8.1'),
(45, 9, '$2y$10$/VS3SsfGXgh/HdHAeN0Ss.pHAgaIy0FDby/jLbom3D5oSh7BEestW', 1, '2021-08-24 05:45:28', NULL, '::1', 'Windows 8.1'),
(46, 9, '$2y$10$rxCX1ZjpDnoftvQr9qFRZOBfgQ1j.5txWd8r0poue/2.vev38xfrm', 1, '2021-08-24 06:03:45', NULL, '127.0.0.1', 'Windows 8.1'),
(47, 9, '$2y$10$aTuO9oSnb7ILG.7yVtkRnOYALnw.5I9b6qi1Rb/r.Hh16AtgAHwAO', 1, '2021-08-24 07:34:44', NULL, '::1', 'Windows 8.1'),
(48, 9, '$2y$10$lv93e7rrrxnLFXbNBTr1vehXnz1yBvEnhFhUjeAM10vdhibGsAqJS', 1, '2021-08-25 06:26:46', NULL, '::1', 'Windows 8.1'),
(49, 9, '$2y$10$P6mD5QCHW7WpByWvUaANZuB06k60w8NQcgI3SNRZMqopTJMeGKgJi', 1, '2021-08-25 09:36:27', NULL, '::1', 'Windows 8.1'),
(50, 10, '$2y$10$B0r7EDtq1ASco05WnXMp4u4xE8MomyQbkZbr.Eg4qTNPOvblrpMva', 1, '2021-08-25 09:39:03', NULL, '::1', 'Windows 8.1'),
(51, 9, '$2y$10$MpKd/QMaRjz0NhaExD6IL.ZHIB39LjJpAMzp1RC.jrJxJB3DTkt8e', 1, '2021-08-25 09:39:32', NULL, '::1', 'Windows 8.1'),
(52, 9, '$2y$10$igPNYA.EtNghJqegJ7R/e.SvsqFclV99ktYrtqX.n3lds3GN3ls.y', 1, '2021-08-25 13:58:25', NULL, '::1', 'Windows 8.1'),
(53, 9, '$2y$10$/cF4rCOk6GWQ6N2TOrMNcesM4mJ.vwY6IKmOXaI6EBpWhGMUwL1xC', 1, '2021-08-25 14:00:51', NULL, '::1', 'Windows 8.1'),
(54, 9, '$2y$10$ew2lRfDrZ.M7IdIzh38BAuirWOubvMs2hu4XIvTanuxmOEegGDJ8y', 1, '2021-08-26 04:27:16', NULL, '::1', 'Windows 8.1'),
(55, 9, '$2y$10$XyC51u21k0IPDlhvRTs7Hu7FBqqYIOYDy6jHFKQmQ4J1bMU/.m0tu', 1, '2021-08-26 05:51:05', NULL, '::1', 'Windows 8.1'),
(56, 9, '$2y$10$/ZEqtIWxyUDACMv2isE.fODCz4ZitAYxpGhsUYceFfnnHdVRhMBRW', 1, '2021-08-26 06:04:27', NULL, '::1', 'Windows 8.1'),
(57, 9, '$2y$10$25a5hkXRVQMQrMC9G3RgNucpu9ml.JqhRTjR.00urTOsVVYCxkuT.', 1, '2021-08-26 10:25:10', NULL, '::1', 'Windows 8.1'),
(58, 9, '$2y$10$it2pGcv6BPG3qmDolXpVDuHoG.xkbaZRY0QQRXCfgWdc19XnE2riu', 1, '2021-09-06 10:21:08', NULL, '::1', 'Windows 8.1'),
(59, 9, '$2y$10$hvxFzdfNBAWx0x8UyYPc8eg7gv8HDxSUrQix9Gmb6u.e.Cnc.ZgZ2', 1, '2021-09-07 05:05:30', NULL, '::1', 'Windows 8.1'),
(60, 9, '$2y$10$FPuOUcSaOhc9yMqLKriU7O6iAbeQu9ecO6dyNoG9a4y2UemtKX1pK', 1, '2021-09-07 09:32:41', NULL, '::1', 'Windows 8.1'),
(61, 9, '$2y$10$wQY9oNl6cRRGWgFN/dou8u.KObJSSx9exeMhuYF5SHhMQuQDnfnZK', 1, '2021-09-07 11:34:02', NULL, '::1', 'Windows 8.1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jinlms_campaign`
--
ALTER TABLE `jinlms_campaign`
  ADD PRIMARY KEY (`campaign_id`);

--
-- Indexes for table `jinlms_campaign_student`
--
ALTER TABLE `jinlms_campaign_student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `jinlms_student_call`
--
ALTER TABLE `jinlms_student_call`
  ADD PRIMARY KEY (`call_id`);

--
-- Indexes for table `jinlms_user`
--
ALTER TABLE `jinlms_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `jinlms_user_role`
--
ALTER TABLE `jinlms_user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `jinlms_user_session`
--
ALTER TABLE `jinlms_user_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jinlms_campaign`
--
ALTER TABLE `jinlms_campaign`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jinlms_campaign_student`
--
ALTER TABLE `jinlms_campaign_student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `jinlms_student_call`
--
ALTER TABLE `jinlms_student_call`
  MODIFY `call_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `jinlms_user`
--
ALTER TABLE `jinlms_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jinlms_user_role`
--
ALTER TABLE `jinlms_user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jinlms_user_session`
--
ALTER TABLE `jinlms_user_session`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
