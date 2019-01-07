-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table datakraf_hr.academics
CREATE TABLE IF NOT EXISTS `academics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `study_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `course` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `academics_user_id_foreign` (`user_id`),
  CONSTRAINT `academics_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.academics: ~2 rows (approximately)
/*!40000 ALTER TABLE `academics` DISABLE KEYS */;
INSERT INTO `academics` (`id`, `user_id`, `institution`, `study_level`, `start_date`, `end_date`, `course`, `result`, `created_at`, `updated_at`) VALUES
	(3, 1, 'Malay College Kuala Kangsar', 'SPM', '2004-07-01', '2008-11-01', 'Science Stream', '3A1 2A2 3B3 2C5', '2018-12-27 07:12:19', '2018-12-28 09:36:28'),
	(4, 1, 'UiTM Puncak Perdana, Selangor', 'Bachelor\'s Degree', '2010-05-01', '2014-11-01', 'Information Management (Information System Management)', '3.28', '2018-12-27 07:16:19', '2018-12-27 07:16:19');
/*!40000 ALTER TABLE `academics` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.activity_log
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.activity_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.awards
CREATE TABLE IF NOT EXISTS `awards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_date` date NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `awards_user_id_foreign` (`user_id`),
  CONSTRAINT `awards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.awards: ~0 rows (approximately)
/*!40000 ALTER TABLE `awards` DISABLE KEYS */;
INSERT INTO `awards` (`id`, `user_id`, `name`, `received_date`, `notes`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Best Japanese Language Student of 2017', '2017-06-16', NULL, '2018-12-27 07:41:00', '2018-12-28 10:04:52');
/*!40000 ALTER TABLE `awards` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.banks
CREATE TABLE IF NOT EXISTS `banks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Dumping data for table datakraf_hr.banks: ~14 rows (approximately)
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
INSERT INTO `banks` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Maybank', NULL, NULL),
	(2, 'CIMB Bank', NULL, NULL),
	(3, 'Public Bank Berhad', NULL, NULL),
	(4, 'RHB Bank', NULL, NULL),
	(5, 'Hong Leong Bank', NULL, NULL),
	(6, 'AmBank', NULL, NULL),
	(7, 'UOB Malaysia Bank', NULL, NULL),
	(8, 'Bank Rakyat', NULL, NULL),
	(9, 'OCBC Bank Malaysia', NULL, NULL),
	(10, 'HSBC Bank Malaysia', NULL, NULL),
	(11, 'Affin Bank', NULL, NULL),
	(12, 'Bank Islam Malaysia', NULL, NULL),
	(13, 'Standard Chartered Bank Malaysia', NULL, NULL),
	(14, 'CitiBank Malaysia', NULL, NULL),
	(15, 'Bank Simpanan Nasional (BSN)', NULL, NULL),
	(16, 'Alliance Bank', NULL, NULL);
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.experiences
CREATE TABLE IF NOT EXISTS `experiences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `experiences_user_id_foreign` (`user_id`),
  CONSTRAINT `experiences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.experiences: ~3 rows (approximately)
/*!40000 ALTER TABLE `experiences` DISABLE KEYS */;
INSERT INTO `experiences` (`id`, `user_id`, `company`, `position`, `description`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
	(3, 1, 'GW Intech Sdn. Bhd.', 'Front End Developer', '<ul>\r\n<li>Designed and developed user interface of Sistem e-Pihak Berkuasa Tempatan, a J2EE-based system for Malaysia Ministry of Urban Wellbeing, Housing and Local Government.</li>\r\n<li> Designed and developed modular CSS/Sass(Cascading Stylesheet/Synthetically Awesome Stylesheet) of the system. Implementation of Sass is highly recommended in order to develop modular and maintainable stylesheets as multiple stylesheets were used.</li><li> Plot the user-experience and design usability of the system in both desktop and mobile views and designed the system in  a way that the users will only click twice to perform any operation in order to increase the efficiency of their workflow.</li>\r\n</ul>', '2013-12-01', '2015-06-17', '2018-12-27 07:27:48', '2018-12-28 09:18:30'),
	(4, 1, 'Icherry Technology Sdn. Bhd.', 'PHP Developer', '<ul>\r\n<li>Provide support and maintenance for Stock TPC and TN Fresh Warehouse System. The PHP web applications are responsible in recording daily amount of farm produce in the warehouse. </li>\r\n<li>Redesigned Asia Car Rental website and its backend system. Asia Car Rental is a company running car rental business. The system allows customers to rent cars online. </li>\r\n<li>Developed an event registration system and website for TMI Malaysia Sdn. Bhd. for their event ‘Search Inside Yourself ’. </li>\r\n<li>Designed and developed a website for Talent Kindergaten. \r\nWebsite URL: http://talento.com.my</li>\r\n<li>Redesigned and develop Icherry Technology Sdn. Bhd. in-house Content Management System</li>\r\n<li>Redesigned PMW-Industries Sdn. Bhd. website. \r\nWebsite URL: http://pmw-industries.com</li>\r\n<li>Developed an online store selling computer accessories for BMSTAR Technology. \r\nWebsite URL: http://bmstar.com.my</li>', '2015-09-16', '2017-11-17', '2018-12-27 07:32:49', '2018-12-27 07:32:49'),
	(5, 1, 'Brillante Insights Sdn. Bhd.', 'PHP/Laravel Developer', '<ul>\r\n<li>Developed a SAP ticketing and reporting system for Universiti Malaya. </li>\r\n<li>Developed a system for Universiti Malaya students to seek permission to travel overseas. (Student Permission To Travel System).</li>\r\n<li>Redesigned and developed a SAAS (Software As A Service) application named E-Khairat. The purpose of this application is to manage and collect funeral donations (khairat kematian) at kariah level.</li>\r\n</ul>', '2017-12-21', '2018-09-21', '2018-12-27 07:36:48', '2018-12-27 07:36:48');
/*!40000 ALTER TABLE `experiences` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.families
CREATE TABLE IF NOT EXISTS `families` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `relationship_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ic_number` bigint(20) NOT NULL,
  `mobile_number` bigint(20) NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `income_tax_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `families_user_id_foreign` (`user_id`),
  KEY `families_relationship_id_foreign` (`relationship_id`),
  CONSTRAINT `families_relationship_id_foreign` FOREIGN KEY (`relationship_id`) REFERENCES `familytypes` (`id`),
  CONSTRAINT `families_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.families: ~2 rows (approximately)
/*!40000 ALTER TABLE `families` DISABLE KEYS */;
INSERT INTO `families` (`id`, `user_id`, `relationship_id`, `name`, `ic_number`, `mobile_number`, `occupation`, `income_tax_number`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Baharudin Mohamad', 630101087915, 165963364, 'KTMB', NULL, '2018-12-27 07:07:36', '2018-12-28 07:37:53'),
	(2, 1, 2, 'Rokiah Hamzah', 630704085994, 143083909, 'N/A', NULL, '2018-12-27 07:07:36', '2018-12-27 07:07:36');
/*!40000 ALTER TABLE `families` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.familytypes
CREATE TABLE IF NOT EXISTS `familytypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.familytypes: ~6 rows (approximately)
/*!40000 ALTER TABLE `familytypes` DISABLE KEYS */;
INSERT INTO `familytypes` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Father', NULL, '2018-12-27 07:02:25', '2018-12-27 07:02:26'),
	(2, 'Mother', NULL, '2018-12-27 07:02:40', '2018-12-27 07:02:40'),
	(3, 'Spouse (Husband)', NULL, '2018-12-27 07:03:02', '2018-12-27 07:03:02'),
	(4, 'Spouse (Wife)', NULL, '2018-12-27 07:03:17', '2018-12-27 07:03:28'),
	(5, 'Siblings', NULL, '2018-12-27 07:03:39', '2018-12-27 07:03:39'),
	(6, 'Child', NULL, '2018-12-27 07:03:54', '2018-12-27 07:03:55');
/*!40000 ALTER TABLE `familytypes` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.holidays
CREATE TABLE IF NOT EXISTS `holidays` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.holidays: ~14 rows (approximately)
/*!40000 ALTER TABLE `holidays` DISABLE KEYS */;
INSERT INTO `holidays` (`id`, `name`, `date`, `created_at`, `updated_at`) VALUES
	(1, 'New Year', '2019-01-01', '2018-12-24 12:55:54', '2018-12-24 12:55:54'),
	(2, 'Federal Territory (PLI Staffs Only)', '2019-02-01', '2018-12-24 13:01:41', '2018-12-24 13:01:41'),
	(3, 'Chinese New Year', '2019-02-05', '2018-12-24 13:02:19', '2018-12-24 13:02:19'),
	(4, 'Chinese New Year', '2019-02-06', '2018-12-24 13:02:34', '2018-12-24 13:02:34'),
	(5, 'Labour Day', '2019-05-01', '2018-12-24 13:02:53', '2018-12-24 13:02:53'),
	(6, 'Hari Raya Aidil Fitri', '2019-06-05', '2018-12-24 13:03:17', '2018-12-24 13:04:26'),
	(7, 'Hari Raya Aidil Fitri', '2019-06-06', '2018-12-24 13:03:36', '2018-12-24 13:04:34'),
	(8, 'Hari Raya Aidil Adha', '2019-08-11', '2018-12-24 13:05:18', '2018-12-24 13:05:18'),
	(9, 'National Day', '2019-08-31', '2018-12-24 13:05:35', '2018-12-24 13:05:35'),
	(10, 'SPB YDPA Birthday', '2019-09-09', '2018-12-24 13:06:00', '2018-12-24 13:06:00'),
	(11, 'Malaysia Day', '2019-09-16', '2018-12-24 13:06:21', '2018-12-24 13:06:21'),
	(12, 'Maulidur Rasul', '2019-11-09', '2018-12-24 13:06:39', '2018-12-24 13:06:39'),
	(13, 'Sultan Of Selangor Birthday (Nexis Staffs Only)', '2019-12-11', '2018-12-24 13:07:18', '2018-12-24 13:07:18'),
	(14, 'Christmas', '2019-12-25', '2018-12-24 13:07:40', '2018-12-24 13:07:40');
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=793 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.jobs: ~1 rows (approximately)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
	(792, 'default', '{"displayName":"Datakraf\\\\Notifications\\\\UserCreatedNotification","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Notifications\\\\SendQueuedNotifications","command":"O:48:\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\":11:{s:11:\\"notifiables\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:13:\\"Datakraf\\\\User\\";s:2:\\"id\\";i:2;s:9:\\"relations\\";a:1:{i:0;s:5:\\"roles\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:46:\\"Datakraf\\\\Notifications\\\\UserCreatedNotification\\":8:{s:2:\\"id\\";s:36:\\"d7929965-2e8c-4a1f-96a9-b04add7b3a49\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:8:\\"channels\\";a:1:{i:0;s:4:\\"mail\\";}s:5:\\"tries\\";N;s:7:\\"timeout\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 5, 1546512621, 1546512620, 1546512620);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.leaveattachments
CREATE TABLE IF NOT EXISTS `leaveattachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `leave_id` int(10) unsigned NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filepath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leaveattachments_leave_id_foreign` (`leave_id`),
  CONSTRAINT `leaveattachments_leave_id_foreign` FOREIGN KEY (`leave_id`) REFERENCES `leaves` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.leaveattachments: ~0 rows (approximately)
/*!40000 ALTER TABLE `leaveattachments` DISABLE KEYS */;
INSERT INTO `leaveattachments` (`id`, `leave_id`, `filename`, `filepath`, `created_at`, `updated_at`) VALUES
	(1, 1, '15464821731545982229logo2.png', 'uploads/leaveattachments/15464821731545982229logo2.png', '2019-01-03 10:22:53', '2019-01-03 10:22:53');
/*!40000 ALTER TABLE `leaveattachments` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.leavebalances
CREATE TABLE IF NOT EXISTS `leavebalances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `leavetype_id` int(10) unsigned NOT NULL,
  `balance` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leaverecords_user_id_foreign` (`user_id`),
  KEY `leaverecords_leavetype_id_foreign` (`leavetype_id`),
  CONSTRAINT `leaverecords_leavetype_id_foreign` FOREIGN KEY (`leavetype_id`) REFERENCES `leavetypes` (`id`),
  CONSTRAINT `leaverecords_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.leavebalances: ~0 rows (approximately)
/*!40000 ALTER TABLE `leavebalances` DISABLE KEYS */;
INSERT INTO `leavebalances` (`id`, `user_id`, `leavetype_id`, `balance`, `created_at`, `updated_at`) VALUES
	(1, 1, 3, 13, '2019-01-03 10:37:20', '2019-01-03 10:37:20');
/*!40000 ALTER TABLE `leavebalances` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.leaves
CREATE TABLE IF NOT EXISTS `leaves` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `leavetype_id` int(10) unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `days_taken` int(11) NOT NULL,
  `status_code` int(11) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leaves_user_id_foreign` (`user_id`),
  KEY `leaves_leavetype_id_foreign` (`leavetype_id`),
  CONSTRAINT `leaves_leavetype_id_foreign` FOREIGN KEY (`leavetype_id`) REFERENCES `leavetypes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leaves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.leaves: ~0 rows (approximately)
/*!40000 ALTER TABLE `leaves` DISABLE KEYS */;
INSERT INTO `leaves` (`id`, `user_id`, `leavetype_id`, `start_date`, `end_date`, `notes`, `days_taken`, `status_code`, `created_at`, `updated_at`) VALUES
	(1, 1, 3, '2019-01-31', '2019-02-01', 'had a fever', 1, NULL, '2019-01-03 10:22:50', '2019-01-03 10:22:50');
/*!40000 ALTER TABLE `leaves` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.leavetypes
CREATE TABLE IF NOT EXISTS `leavetypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.leavetypes: ~9 rows (approximately)
/*!40000 ALTER TABLE `leavetypes` DISABLE KEYS */;
INSERT INTO `leavetypes` (`id`, `name`, `days`, `created_at`, `updated_at`) VALUES
	(3, 'Medical Leave', 14, '2018-12-21 15:37:45', '2018-12-24 18:04:02'),
	(4, 'Maternity Leave', 60, '2018-12-21 15:38:01', '2018-12-24 11:23:42'),
	(5, 'Hajj Leave', 30, '2018-12-21 15:38:30', '2018-12-24 11:25:11'),
	(6, 'Unpaid Leave', 30, '2018-12-24 11:20:32', '2018-12-24 18:04:11'),
	(7, 'Annual Leave', 14, '2018-12-24 11:20:46', '2018-12-24 18:04:46'),
	(8, 'Industrial Accident Leave', 180, '2018-12-24 11:23:30', '2018-12-24 11:23:30'),
	(9, 'Marriage Leave', 2, '2018-12-24 11:24:36', '2018-12-24 11:24:36'),
	(10, 'Compassionate Leave', 7, '2018-12-24 11:25:38', '2018-12-26 12:20:12'),
	(12, 'Replacement Leave', NULL, '2018-12-30 20:29:56', '2018-12-30 20:29:56');
/*!40000 ALTER TABLE `leavetypes` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.leave_entitlements
CREATE TABLE IF NOT EXISTS `leave_entitlements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `days` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_entitlements_user_id_foreign` (`user_id`),
  CONSTRAINT `leave_entitlements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.leave_entitlements: ~5 rows (approximately)
/*!40000 ALTER TABLE `leave_entitlements` DISABLE KEYS */;
INSERT INTO `leave_entitlements` (`id`, `user_id`, `days`, `created_at`, `updated_at`) VALUES
	(1, 1, 14, '2018-12-19 17:53:48', '2018-12-19 17:53:48'),
	(25, 25, 14, '2019-01-03 18:29:10', '2019-01-03 18:29:10'),
	(26, 26, 14, '2019-01-03 18:30:41', '2019-01-03 18:30:41'),
	(27, 2, 14, '2019-01-03 18:43:59', '2019-01-03 18:43:59'),
	(28, 25, 14, '2019-01-05 18:58:11', '2019-01-05 18:58:11');
/*!40000 ALTER TABLE `leave_entitlements` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.migrations: ~33 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_12_10_045810_create_personaldetails_table', 1),
	(6, '2018_12_11_014356_create_families_table', 2),
	(8, '2018_12_12_092103_create_experiences_table', 3),
	(9, '2018_12_12_104024_create_academics_table', 4),
	(10, '2018_12_13_060901_create_skills_table', 5),
	(11, '2018_12_13_081412_add_marital_columns_to_personaldetails', 6),
	(13, '2018_12_13_093933_create_awards_table', 7),
	(14, '2018_12_16_085356_create_family_types_table', 8),
	(15, '2018_12_17_065514_create_leave_entitlements_table', 9),
	(17, '2018_12_17_082340_create_jobs_table', 10),
	(18, '2018_12_17_095606_create_permission_tables', 11),
	(19, '2018_12_18_030031_add_avatar_column_to_profile', 12),
	(20, '2018_12_18_065442_create_leave_types', 13),
	(21, '2018_12_18_083301_create_leaves_table', 14),
	(25, '2018_12_18_133842_create_positions_table', 15),
	(26, '2018_12_18_231417_add_position_id', 16),
	(27, '2018_12_19_000518_create_statuses_table', 17),
	(28, '2018_12_19_011258_create_notifications_table', 18),
	(29, '2018_12_19_154614_create_relationship_id_in_families', 19),
	(30, '2018_12_24_122055_create_holidays_table', 20),
	(31, '2018_12_25_123910_add_description_in_experiences_table', 21),
	(33, '2018_12_26_085345_create_leaveattachments_table', 22),
	(34, '2018_12_26_111437_create_leaverecords_table', 23),
	(37, '2018_12_27_095249_create_payslips_table', 24),
	(38, '2018_12_27_203247_add_socso_epf_columns_in_personaldetails_table', 25),
	(39, '2018_12_28_103353_create_siteconfigs_table', 26),
	(40, '2019_01_01_105636_add_status_column_to_personaldetails_table', 27),
	(41, '2019_01_02_175200_create_jobs_table', 28),
	(43, '2019_01_05_100129_create_activity_log_table', 30),
	(47, '2019_01_04_095258_add_bank_account_number_column_to_personaldetails', 31),
	(48, '2019_01_06_150355_add_columns_in_personal_details', 31);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.model_has_roles: ~9 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'Datakraf\\User', 1),
	(1, 'Datakraf\\User', 2),
	(1, 'Datakraf\\User', 20),
	(2, 'Datakraf\\User', 20),
	(1, 'Datakraf\\User', 21),
	(1, 'Datakraf\\User', 22),
	(1, 'Datakraf\\User', 23),
	(2, 'Datakraf\\User', 24),
	(1, 'Datakraf\\User', 25),
	(1, 'Datakraf\\User', 26);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.notifications: ~0 rows (approximately)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.payslips
CREATE TABLE IF NOT EXISTS `payslips` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `month` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `basic_salary` decimal(13,2) DEFAULT NULL,
  `allowance` decimal(13,2) DEFAULT NULL,
  `epf_employer` decimal(13,2) DEFAULT NULL,
  `epf_employee` decimal(13,2) DEFAULT NULL,
  `socso_employer` decimal(13,2) DEFAULT NULL,
  `socso_employee` decimal(13,2) DEFAULT NULL,
  `socso_eis_employer` decimal(13,2) DEFAULT NULL,
  `socso_eis_employee` decimal(13,2) DEFAULT NULL,
  `income_tax` decimal(13,2) DEFAULT NULL,
  `total_earnings` decimal(13,2) DEFAULT NULL,
  `total_deductions` decimal(13,2) DEFAULT NULL,
  `net_wage` decimal(13,2) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payslips_user_id_foreign` (`user_id`),
  CONSTRAINT `payslips_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.payslips: ~0 rows (approximately)
/*!40000 ALTER TABLE `payslips` DISABLE KEYS */;
/*!40000 ALTER TABLE `payslips` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.permissions: ~11 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'view_users', 'web', '2018-12-19 17:53:36', '2018-12-19 17:53:36'),
	(2, 'add_users', 'web', '2018-12-19 17:53:36', '2018-12-19 17:53:36'),
	(3, 'edit_users', 'web', '2018-12-19 17:53:36', '2018-12-19 17:53:36'),
	(4, 'delete_users', 'web', '2018-12-19 17:53:36', '2018-12-19 17:53:36'),
	(5, 'view_roles', 'web', '2018-12-19 17:53:36', '2018-12-19 17:53:36'),
	(6, 'add_roles', 'web', '2018-12-19 17:53:36', '2018-12-19 17:53:36'),
	(7, 'edit_roles', 'web', '2018-12-19 17:53:36', '2018-12-19 17:53:36'),
	(8, 'delete_roles', 'web', '2018-12-19 17:53:36', '2018-12-19 17:53:36'),
	(9, 'view_payslips', 'web', '2019-01-03 09:22:45', '2019-01-03 09:22:45'),
	(10, 'add_payslips', 'web', '2019-01-03 09:22:45', '2019-01-03 09:22:45'),
	(11, 'edit_payslips', 'web', '2019-01-03 09:22:45', '2019-01-03 09:22:45'),
	(12, 'delete_payslips', 'web', '2019-01-03 09:22:45', '2019-01-03 09:22:45');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.personaldetails
CREATE TABLE IF NOT EXISTS `personaldetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ic_number` bigint(20) unsigned DEFAULT NULL,
  `staff_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `socso_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `epf_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_id` int(10) unsigned DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_marriage` date DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternative_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` smallint(5) unsigned DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motorcycle_reg_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_reg_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `position_id` int(10) unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personaldetails_user_id_foreign` (`user_id`),
  KEY `personaldetails_position_id_foreign` (`position_id`),
  KEY `personaldetails_bank_id_foreign` (`bank_id`),
  CONSTRAINT `personaldetails_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `personaldetails_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`),
  CONSTRAINT `personaldetails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.personaldetails: ~3 rows (approximately)
/*!40000 ALTER TABLE `personaldetails` DISABLE KEYS */;
INSERT INTO `personaldetails` (`id`, `user_id`, `avatar`, `name`, `ic_number`, `staff_number`, `socso_id`, `epf_id`, `bank_account_number`, `bank_id`, `gender`, `date_of_birth`, `marital_status`, `date_of_marriage`, `phone_number`, `mobile_number`, `alternative_email`, `address_one`, `address_two`, `postcode`, `city`, `state`, `country`, `motorcycle_reg_number`, `car_reg_number`, `created_at`, `updated_at`, `position_id`, `status`) VALUES
	(1, 1, 'uploads/avatars/1545812333PASSPORT-PHOTO.jpg', 'Muhammad Uzzair Bin Baharudin', 910213085769, 'DK00039', '91021308576901111', NULL, NULL, NULL, 'Male', '1991-02-13', 'Married', '2018-12-24', '052883293', '0133788484', 'uzzairwork@gmail.com', '58, Persiaran Sri Pengkalan 2', 'Bandar Sri Pengkalan', 31550, 'Pusing', 'Perak', 'Malaysia', NULL, 'AKA1079', '2018-12-19 18:33:50', '2019-01-05 19:22:20', 12, NULL),
	(27, 2, 'images/avatar.png', 'Mohamad Ridzuan Bin Abdullah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-03 18:43:59', '2019-01-06 11:12:02', NULL, NULL),
	(28, 25, 'images/avatar.png', 'Muhammad Uzzair Bin Baharudinsssss', 910101019, '01111', '910213085769sss', '1910919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-05 18:58:11', '2019-01-06 11:58:09', 5, 'internship');
/*!40000 ALTER TABLE `personaldetails` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.positions
CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.positions: ~14 rows (approximately)
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(2, 'Software Engineer', NULL, '2018-12-19 18:00:21', '2018-12-27 20:27:01'),
	(3, 'Software Tester', NULL, '2018-12-24 11:01:37', '2018-12-24 11:01:37'),
	(4, 'Human Resource Manager', NULL, '2018-12-24 11:01:49', '2018-12-24 11:01:49'),
	(5, 'System Analyst', NULL, '2018-12-27 20:17:36', '2018-12-27 20:17:36'),
	(6, 'Business Analyst', NULL, '2018-12-27 20:17:48', '2018-12-27 20:17:48'),
	(7, 'Technical Support', NULL, '2018-12-27 20:18:01', '2018-12-27 20:18:01'),
	(8, 'Network Engineer', NULL, '2018-12-27 20:18:20', '2018-12-27 20:18:20'),
	(9, 'Technical Consultant', NULL, '2018-12-27 20:18:33', '2018-12-27 20:18:33'),
	(10, 'Technical Sales', NULL, '2018-12-27 20:18:44', '2018-12-27 20:18:44'),
	(11, 'Project Manager', NULL, '2018-12-27 20:18:55', '2018-12-27 20:18:55'),
	(12, 'Web Developer', NULL, '2018-12-27 20:19:27', '2018-12-27 20:19:27'),
	(13, 'Backend Developer', NULL, '2019-01-03 19:03:39', '2019-01-03 19:03:39'),
	(14, 'Chief Executive Officer', NULL, '2019-01-03 19:04:01', '2019-01-03 19:04:01'),
	(15, 'Chief Technology Officer', NULL, '2019-01-03 19:04:11', '2019-01-03 19:04:11');
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'web', '2018-12-19 17:53:47', '2018-12-19 17:53:47'),
	(2, 'User', 'web', '2018-12-19 17:53:48', '2018-12-19 17:53:48');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.role_has_permissions: ~12 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.siteconfigs
CREATE TABLE IF NOT EXISTS `siteconfigs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.siteconfigs: ~1 rows (approximately)
/*!40000 ALTER TABLE `siteconfigs` DISABLE KEYS */;
INSERT INTO `siteconfigs` (`id`, `site_name`, `company_name`, `company_reg_no`, `mobile_number`, `phone_number`, `fax_number`, `email`, `logo`, `address_one`, `address_two`, `postcode`, `city`, `state`, `country`, `facebook`, `twitter`, `gmail`, `linkedin`, `created_at`, `updated_at`) VALUES
	(1, 'HRMS', 'Datakraf Solutions Sdn. Bhd.', NULL, NULL, '+60361518666', '+60361517666', 'hello@datakraf.com', 'sites/1545982287logo.png', 'Suite 7-1, Binjai 8', 'Lorong Binjai Off Jalan Binjai, KLCC', '50450', 'Kuala Lumpur', NULL, 'Malaysia', 'https://www.facebook.com/datakraf', NULL, 'https://google.com', NULL, '2018-12-28 11:13:20', '2018-12-28 15:31:27');
/*!40000 ALTER TABLE `siteconfigs` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.skills
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `skill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` tinyint(3) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `skills_user_id_foreign` (`user_id`),
  CONSTRAINT `skills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.skills: ~7 rows (approximately)
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` (`id`, `user_id`, `skill`, `period`, `created_at`, `updated_at`) VALUES
	(3, 1, 'PHP', 100, '2018-12-27 07:38:49', '2018-12-28 09:55:31'),
	(4, 1, 'HTML & CSS', 98, '2018-12-27 07:38:49', '2018-12-27 07:38:49'),
	(5, 1, 'Javascript', 70, '2018-12-27 07:38:49', '2018-12-27 07:38:49'),
	(6, 1, 'Adobe Photoshop', 80, '2018-12-27 07:38:49', '2018-12-27 07:38:49'),
	(7, 1, 'Adobe Illustrator', 80, '2018-12-27 07:38:49', '2018-12-27 07:38:49'),
	(8, 1, 'Affinity Designer', 80, '2018-12-27 07:38:49', '2018-12-27 07:38:49'),
	(9, 1, 'Affinity Photo', 80, '2018-12-27 07:38:49', '2018-12-27 07:38:49');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.statuses
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `statuses_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.statuses: ~2 rows (approximately)
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` (`id`, `name`, `reason`, `model_type`, `model_id`, `created_at`, `updated_at`) VALUES
	(1, 'submitted', 'Leave submitted for review', 'Modules\\Leave\\Entities\\Leave', 1, '2019-01-03 10:22:53', '2019-01-03 10:22:53'),
	(2, 'approveds', 'Leave approved by Muhammad Uzzair Bin Baharudin', 'Modules\\Leave\\Entities\\Leave', 1, '2019-01-03 10:37:20', '2019-01-03 10:37:20');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;

-- Dumping structure for table datakraf_hr.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table datakraf_hr.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Muhammad Uzzair Bin Baharudin', 'uzzair@datakraf.com', '2018-12-19 17:53:48', '$2y$10$XmUm3l7lhP5whWFjgvGLCOEvrRktHPTn1t2OPl65c0jgUeee2SHl.', 'gXX2JatWiGMoLThRu0wDVz2OmXwAMjCxW8XBgMuaAjKnjg8TyGcyWx0XK0I3', '2018-12-19 17:53:48', '2019-01-06 11:10:00'),
	(2, 'Mohamad Ridzuan Bin Abdullah', 'ridzuan@datakraf.com', NULL, '$2y$10$Ky9yfHofrpZd8f1uqG1n5eaiG3CYivYprPOakaJ0YHn9j7UyBPSnK', 'Z48uPB0RNuIUI93A6y6UDiuIPMgopcNu2zvKOSZNNKR6cItmUn0B3OfcnIjP', '2019-01-03 18:43:58', '2019-01-03 18:48:35'),
	(25, 'Muhammad Uzzair Bin Baharudinsssss', 'uzzairsssadawork@gmail.comssasa', NULL, '$2y$10$9VR5jD2EVzeq5iLWos5Bw.o4Dj6vdA1/pfIl6dfn4qnKuyb3hWM9e', NULL, '2019-01-05 18:58:11', '2019-01-06 11:58:09');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
