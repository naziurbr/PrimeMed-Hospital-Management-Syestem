-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2025 at 07:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'admin', 'Test@12345', '04-03-2024 11:42:05 AM'),
(2, 'meme@gmail.com', '12345@no', '12-1-2024 12:55:09 AM\r\n'),
(3, 'admin', '75d23af433e0cea4c0e45a56dba18b30', '18-12-2025');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doctorSpecialization` varchar(255) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `appointmentDate` varchar(255) DEFAULT NULL,
  `appointmentTime` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `doctorStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctorSpecialization`, `doctorId`, `userId`, `consultancyFees`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `doctorStatus`, `updationDate`) VALUES
(1, 'ENT', 1, 1, 500, '2024-05-30', '9:15 AM', '2024-05-15 03:42:11', 1, 1, NULL),
(2, 'Endocrinologists', 2, 2, 800, '2024-05-31', '2:45 PM', '2024-05-16 09:08:54', 1, 1, NULL),
(3, 'Radiology', 0, 1, 0, '2025-12-24', '12:30 PM', '2025-12-01 06:16:36', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `doctorName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `docEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specilization`, `doctorName`, `address`, `docFees`, `contactno`, `docEmail`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'ENT', 'Anuj kumar', 'A 123 XYZ Apartment Raj Nagar Ext Ghaziabad', '500', 142536250, 'anujk123@test.com', 'f925916e2754e5e03f75dd58a5733251', '2024-04-10 18:16:52', '2024-05-14 09:26:17'),
(2, 'Endocrinologists', 'Charu Dua', 'X 1212 ABC Apartment Laxmi Nagar New Delhi ', '800', 1231231230, 'charudua12@test.com', 'f925916e2754e5e03f75dd58a5733251', '2024-04-11 01:06:41', '2024-05-14 09:26:28'),
(4, 'Pediatrics', 'Priyanka Sinha', 'A 123 Xyz Aparmtnent Ghaziabad', '700', 74561235, 'p12@t.com', 'f925916e2754e5e03f75dd58a5733251', '2024-05-16 09:12:23', NULL),
(5, 'Orthopedics', 'Vipin Tayagi', 'Yasho Hospital New Delhi', '1200', 95214563210, 'vpint123@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-05-16 09:13:11', NULL),
(6, 'Internal Medicine', 'Dr Romil', 'Max Hospital Vaishali  GZB', '1500', 8563214751, 'drromil12@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-05-16 09:14:11', NULL),
(7, 'Obstetrics and Gynecology', 'Bhavya rathore', 'Shop 12 Indira Puram Ghaziabad', '800', 745621330, 'bhawya12@tt.com', 'f925916e2754e5e03f75dd58a5733251', '2024-05-16 09:15:18', NULL),
(8, 'Sexologist ', 'Sakiul Kawser', ' Bangladesh Awami League,Cumilla,', '69', 737394738398, 'sakkawser@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '2025-12-01 06:31:54', '2025-12-02 04:28:54'),
(10, 'nothing', 'mrdoctor', 'address,address', '4564334425', 8487467393, 'mrdoctor@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2025-12-18 03:23:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctorslog`
--

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorslog`
--

INSERT INTO `doctorslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 1, 'anujk123@test.com', 0x3a3a3100000000000000000000000000, '2024-05-16 05:19:33', NULL, 1),
(2, 1, 'anujk123@test.com', 0x3a3a3100000000000000000000000000, '2024-05-16 09:01:03', '16-05-2024 02:37:32 PM', 1),
(3, 8, 'sakkawser@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-02 04:29:26', NULL, 1),
(4, 8, 'sakkawser@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-02 05:16:44', NULL, 1),
(5, 8, 'sakkawser@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-17 03:39:45', '17-12-2025 09:11:35 AM', 1),
(6, NULL, 'sakkawser@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-18 03:10:42', NULL, 0),
(7, NULL, 'mrdoctor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-18 03:19:20', NULL, 0),
(8, NULL, 'mrdoctor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-18 03:20:59', NULL, 0),
(9, 10, 'mrdoctor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-18 03:23:20', '18-12-2025 08:53:42 AM', 1),
(10, 10, 'mrdoctor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-18 03:37:56', '18-12-2025 09:08:31 AM', 1),
(11, 10, 'mrdoctor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-18 03:38:47', NULL, 1),
(12, 10, 'mrdoctor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-18 03:51:45', NULL, 1),
(13, 10, 'mrdoctor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-18 04:28:12', '18-12-2025 09:58:30 AM', 1),
(14, NULL, 'mrdoctor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-18 06:23:02', NULL, 0),
(15, 10, 'mrdoctor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-18 06:23:10', NULL, 1),
(16, NULL, 'mrdoctor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-21 05:10:16', NULL, 0),
(17, 10, 'mrdoctor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-21 05:10:26', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specilization`, `creationDate`, `updationDate`) VALUES
(1, 'Orthopedics', '2024-04-09 18:09:46', '2024-05-14 09:26:47'),
(2, 'Internal Medicine', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(3, 'Obstetrics and Gynecology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(4, 'Dermatology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(5, 'Pediatrics', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(6, 'Radiology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(7, 'General Surgery', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(8, 'Ophthalmology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(9, 'Anesthesia', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(10, 'Pathology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(11, 'ENT', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(12, 'Dental Care', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(13, 'Dermatologists', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(14, 'Endocrinologists', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(15, 'Neurologists', '2024-04-09 18:09:46', '2024-05-14 09:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `payment_id` varchar(100) DEFAULT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `purpose` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_requests`
--

CREATE TABLE `payment_requests` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `status` enum('pending','completed','failed') DEFAULT 'pending',
  `bkash_payment_id` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_requests`
--

INSERT INTO `payment_requests` (`id`, `patient_id`, `doctor_id`, `amount`, `description`, `status`, `bkash_payment_id`, `transaction_id`, `payment_date`, `created_at`, `updated_at`) VALUES
(1, 9, 6, 900.00, 'fees for lab test ', '', NULL, NULL, NULL, '2025-12-21 03:37:50', '2025-12-21 03:52:01'),
(2, 9, 6, 900.00, 'fees for lab test ', '', NULL, NULL, NULL, '2025-12-21 03:40:32', '2025-12-21 03:52:31'),
(3, 9, 6, 900.00, 'fees for lab test ', '', NULL, NULL, NULL, '2025-12-21 03:51:27', '2025-12-21 03:52:21'),
(4, 9, 10, 1111.00, 'blood test', 'completed', 'BKASH_1766292991_4', 'TEST_1766292991_4', '2025-12-21 10:56:31', '2025-12-21 03:58:15', '2025-12-21 04:56:31'),
(5, 9, 10, 1111.00, 'blood test', '', NULL, NULL, NULL, '2025-12-21 03:59:00', '2025-12-21 04:31:04'),
(6, 9, 10, 1111.00, 'blood test', '', NULL, NULL, NULL, '2025-12-21 04:02:34', '2025-12-21 04:31:16'),
(7, 9, 10, 1111.00, 'blood test', '', NULL, NULL, NULL, '2025-12-21 04:02:37', '2025-12-21 04:30:58'),
(8, 9, 10, 1111.00, 'blood test', '', NULL, NULL, NULL, '2025-12-21 04:02:49', '2025-12-21 04:31:08'),
(9, 5, 7, 555.00, 'sugerrrrrr', 'pending', NULL, NULL, NULL, '2025-12-21 04:03:15', '2025-12-21 04:03:15'),
(10, 5, 7, 555.00, 'sugerrrrrr', 'pending', NULL, NULL, NULL, '2025-12-21 04:11:46', '2025-12-21 04:11:46'),
(11, 5, 7, 555.00, 'sugerrrrrr', 'pending', NULL, NULL, NULL, '2025-12-21 04:11:48', '2025-12-21 04:11:48'),
(12, 9, 2, 45674.00, 'ksdksfksf', '', NULL, NULL, NULL, '2025-12-21 04:12:15', '2025-12-21 04:30:52'),
(13, 9, 7, 54.00, 'injection', '', NULL, NULL, NULL, '2025-12-21 04:14:44', '2025-12-21 04:21:04'),
(14, 9, 7, 54.00, 'injection', '', NULL, NULL, NULL, '2025-12-21 04:14:50', '2025-12-21 04:15:21'),
(15, 9, 6, 3333.00, 'sdffwsfasdf', 'completed', 'BKASH_1766293778_15', 'TEST_1766293778_15', '2025-12-21 11:09:38', '2025-12-21 04:58:50', '2025-12-21 05:09:38'),
(16, 9, 7, 999.00, 'sdssssd', 'pending', NULL, NULL, NULL, '2025-12-21 05:03:19', '2025-12-21 05:03:19'),
(17, 6, 4, 911.00, 'idrjfdm', 'pending', NULL, NULL, NULL, '2025-12-21 05:06:53', '2025-12-21 05:06:53'),
(18, 6, 4, 911.00, 'idrjfdm', 'pending', NULL, NULL, NULL, '2025-12-21 05:13:13', '2025-12-21 05:13:13'),
(19, 6, 4, 911.00, 'idrjfdm', 'pending', NULL, NULL, NULL, '2025-12-21 05:13:32', '2025-12-21 05:13:32'),
(20, 5, 5, 567.00, 'fdfdfdfffdfd', 'pending', NULL, NULL, NULL, '2025-12-21 05:21:55', '2025-12-21 05:21:55'),
(21, 5, 5, 567.00, 'fdfdfdfffdfd', 'pending', NULL, NULL, NULL, '2025-12-21 05:29:33', '2025-12-21 05:29:33'),
(22, 9, 4, 222.00, 'mdfkjfjksdfjdsfjaddfasdfaf', 'pending', NULL, NULL, NULL, '2025-12-21 05:29:53', '2025-12-21 05:29:53'),
(23, 9, 7, 0.60, 'ggfgfgbfghfg', 'pending', NULL, NULL, NULL, '2025-12-21 05:30:23', '2025-12-21 05:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactus`
--

CREATE TABLE `tblcontactus` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(12) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `LastupdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsRead` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactus`
--

INSERT INTO `tblcontactus` (`id`, `fullname`, `email`, `contactno`, `message`, `PostingDate`, `AdminRemark`, `LastupdationDate`, `IsRead`) VALUES
(1, 'Anuj kumar', 'anujk30@test.com', 1425362514, 'This is for testing purposes.   This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.', '2024-04-20 16:52:03', NULL, '2024-05-14 09:27:15', NULL),
(2, 'Anuj kumar', 'ak@gmail.com', 1111122233, 'This is for testing', '2024-04-23 13:13:41', 'Contact the patient', '2024-04-27 13:13:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmedicalhistory`
--

CREATE TABLE `tblmedicalhistory` (
  `ID` int(10) NOT NULL,
  `PatientID` int(10) DEFAULT NULL,
  `BloodPressure` varchar(200) DEFAULT NULL,
  `BloodSugar` varchar(200) NOT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `Temperature` varchar(200) DEFAULT NULL,
  `MedicalPres` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblmedicalhistory`
--

INSERT INTO `tblmedicalhistory` (`ID`, `PatientID`, `BloodPressure`, `BloodSugar`, `Weight`, `Temperature`, `MedicalPres`, `CreationDate`) VALUES
(1, 2, '80/120', '110', '85', '97', 'Dolo,\r\nLevocit 5mg', '2024-05-16 09:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT current_timestamp(),
  `OpenningTime` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `OpenningTime`) VALUES
(1, 'aboutus', 'About Us', '<ul style=\"padding: 0px; margin-right: 0px; margin-bottom: 1.313em; margin-left: 1.655em;\" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" center;=\"\" background-color:=\"\" rgb(255,=\"\" 246,=\"\" 246);\"=\"\"><li style=\"text-align: left;\"><font color=\"#000000\">The Hospital Management System (HMS) is designed for Any Hospital to replace their existing manual, paper based system. The new system is to control the following information; patient information, room availability, staff and operating room schedules, and patient invoices. These services are to be provided in an efficient, cost effective manner, with the goal of reducing the time and resources currently required for such tasks.</font></li><li style=\"text-align: left;\"><font color=\"#000000\">A significant part of the operation of any hospital involves the acquisition, management and timely retrieval of great volumes of information. This information typically involves; patient personal information and medical history, staff information, room and ward scheduling, staff scheduling, operating theater scheduling and various facilities waiting lists. All of this information must be managed in an efficient and cost wise fashion so that an institution\'s resources may be effectively utilized HMS will automate the management of the hospital making it more efficient and error free. It aims at standardizing data, consolidating data ensuring data integrity and reducing inconsistencies.&nbsp;</font></li></ul>', NULL, NULL, '2020-05-20 07:21:52', NULL),
(2, 'contactus', 'Contact Details', 'Somewhere-110096,Bangladesh', 'info@gmail.com', 1122334455, '2020-05-20 07:24:07', '9 am To 8 Pm');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatient`
--

CREATE TABLE `tblpatient` (
  `ID` int(10) NOT NULL,
  `Docid` int(10) DEFAULT NULL,
  `PatientName` varchar(200) DEFAULT NULL,
  `PatientContno` bigint(10) DEFAULT NULL,
  `PatientEmail` varchar(200) DEFAULT NULL,
  `PatientGender` varchar(50) DEFAULT NULL,
  `PatientAdd` mediumtext DEFAULT NULL,
  `PatientAge` int(10) DEFAULT NULL,
  `PatientMedhis` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpatient`
--

INSERT INTO `tblpatient` (`ID`, `Docid`, `PatientName`, `PatientContno`, `PatientEmail`, `PatientGender`, `PatientAdd`, `PatientAge`, `PatientMedhis`, `CreationDate`, `UpdationDate`) VALUES
(1, 1, 'Rahul Singyh', 452463210, 'rahul12@gmail.com', 'male', 'NA', 32, 'Fever, Cold', '2024-05-16 05:23:35', NULL),
(2, 1, 'Amit', 4545454545, 'amitk@gmail.com', 'male', 'NA', 45, 'Fever', '2024-05-16 09:01:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 1, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-05-15 03:41:48', NULL, 1),
(2, 2, 'amitk@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-16 09:08:06', '16-05-2024 02:41:06 PM', 1),
(3, NULL, 'admin@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-01 06:10:17', NULL, 0),
(4, NULL, 'Test@12345', 0x3a3a3100000000000000000000000000, '2025-12-01 06:10:56', NULL, 0),
(5, NULL, 'meme@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-01 06:15:12', NULL, 0),
(6, 1, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2025-12-01 06:16:02', '01-12-2025 11:47:05 AM', 1),
(7, 3, 'thisis@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-02 04:52:34', '21-12-2025 09:08:13 AM', 1),
(8, NULL, 'meme@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-15 03:15:09', NULL, 0),
(9, 4, 'wilykivyle@mailinator.com', 0x3a3a3100000000000000000000000000, '2025-12-17 03:38:21', '17-12-2025 09:08:38 AM', 1),
(10, 5, 'capo@mailinator.com', 0x3a3a3100000000000000000000000000, '2025-12-18 03:05:55', '18-12-2025 08:36:00 AM', 1),
(11, 5, 'capo@mailinator.com', 0x3a3a3100000000000000000000000000, '2025-12-18 03:08:46', '18-12-2025 08:38:49 AM', 1),
(12, 6, 'rymazaqi@mailinator.com', 0x3a3a3100000000000000000000000000, '2025-12-18 04:27:25', '18-12-2025 09:58:01 AM', 1),
(13, 7, 'citolusyqo@mailinator.com', 0x3a3a3100000000000000000000000000, '2025-12-20 03:17:38', NULL, 1),
(14, 8, 'Cillum@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-20 03:56:34', '20-12-2025 09:27:13 AM', 1),
(15, 8, 'Cillum@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-20 04:38:48', '20-12-2025 10:09:23 AM', 1),
(16, 8, 'Cillum@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-20 04:48:16', '20-12-2025 11:32:57 AM', 1),
(17, 8, 'Cillum@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-20 06:40:34', NULL, 1),
(18, 8, 'Cillum@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-20 06:41:50', NULL, 1),
(19, 8, 'Cillum@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-20 06:43:13', '20-12-2025 12:17:07 PM', 1),
(20, 8, 'Cillum@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-20 06:47:19', NULL, 1),
(21, NULL, 'Cillum@gmail.com', 0x3a3a3100000000000000000000000000, '2025-12-21 03:17:06', NULL, 0),
(22, 9, 'zaxu@mailinator.com', 0x3a3a3100000000000000000000000000, '2025-12-21 03:17:36', NULL, 1),
(23, 9, 'zaxu@mailinator.com', 0x3a3a3100000000000000000000000000, '2025-12-21 03:38:32', NULL, 1),
(24, 9, 'zaxu@mailinator.com', 0x3a3a3100000000000000000000000000, '2025-12-21 04:43:56', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `address`, `city`, `gender`, `email`, `password`, `regDate`, `updationDate`) VALUES
(2, 'Amit kumar', 'new Delhi india', 'New Delhi', 'male', 'amitk@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-04-21 13:15:32', '2024-05-14 09:28:23'),
(3, 'momin', 'dhanmondi', 'dhaka', 'male', 'thisis@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '2025-12-02 04:52:11', NULL),
(4, 'Brendan Hoffman', 'Aliqua Sit sint qui', 'Dicta eum quod sit ', 'male', 'wilykivyle@mailinator.com', 'fcea920f7412b5da7be0cf42b8c93759', '2025-12-17 03:38:05', NULL),
(5, 'Christopher Bowers', 'Ad magni delectus e', 'Consequatur voluptat', 'male', 'capo@mailinator.com', 'fcea920f7412b5da7be0cf42b8c93759', '2025-12-18 03:05:41', NULL),
(6, 'Cameron Suarez', 'Est quasi quibusdam ', 'Facere eligendi lore', 'male', 'rymazaqi@mailinator.com', 'fcea920f7412b5da7be0cf42b8c93759', '2025-12-18 04:27:11', NULL),
(7, 'Dillon Larsen', 'Ipsum proident recu', 'Sit eveniet facere', 'male', 'citolusyqo@mailinator.com', 'e807f1fcf82d132f9bb018ca6738a19f', '2025-12-20 03:16:18', NULL),
(8, 'Hayden French', 'Excepteur incididunt', 'tjtthth', 'male', 'Cillum@gmail.com', 'ab3a48836f2b06a593b8bdeed996b749', '2025-12-20 03:55:55', NULL),
(9, 'Maile Witt', 'Rerum voluptatibus q', 'Sunt sunt aut in sim', 'male', 'zaxu@mailinator.com', 'bc9c4633af4fcc43764eb54ea1952626', '2025-12-21 03:17:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorslog`
--
ALTER TABLE `doctorslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_requests`
--
ALTER TABLE `payment_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD CONSTRAINT `payment_requests_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_requests_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
