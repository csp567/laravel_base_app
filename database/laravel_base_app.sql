-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for laravel_base_app
DROP DATABASE IF EXISTS `laravel_base_app`;
CREATE DATABASE IF NOT EXISTS `laravel_base_app` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `laravel_base_app`;


-- Dumping structure for table laravel_base_app.contacts
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_base_app.contacts: 20 rows
DELETE FROM `contacts`;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` (`id`, `first_name`, `middle_name`, `last_name`, `primary_number`, `secondary_number`, `email`, `contact_image`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(5, 'Salman', NULL, 'Khan', '9876543210', NULL, 'salman@khan.com', 'uploads/contact_image/salman_5.jpeg', 1, '2018-12-01 04:57:05', '2018-12-01 04:57:05', NULL),
	(6, 'Amitabh', NULL, 'bachchan', '9876543210', NULL, 'bachchan@bachchan.com', 'uploads/contact_image/amitabh.jpeg', 1, '2018-12-01 04:57:58', '2018-12-01 04:57:58', NULL),
	(7, 'Akshay', NULL, 'Kumar', '9876543210', NULL, 'akshay@kumar.com', 'uploads/contact_image/90028_v9_ba.jpg', 1, '2018-12-01 04:58:58', '2018-12-01 04:58:58', NULL),
	(8, 'Priyanka', NULL, 'Chopra', '9876543210', NULL, 'priyanka@chopra.com', 'uploads/contact_image/316589_v9_ba.jpg', 1, '2018-12-01 04:59:45', '2018-12-01 04:59:45', NULL),
	(9, 'Deepika', NULL, 'Padukon', '9876543210', NULL, 'deepika@ranveer.com', 'uploads/contact_image/509523_v9_bc.jpg', 1, '2018-12-01 05:00:56', '2018-12-01 05:00:56', NULL);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;


-- Dumping structure for table laravel_base_app.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_base_app.migrations: 5 rows
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_04_02_145129_user_types', 1),
	(4, '2018_11_30_041632_contacts', 2),
	(6, '2018_12_02_044924_shared_contacts', 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table laravel_base_app.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_base_app.password_resets: 0 rows
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


-- Dumping structure for table laravel_base_app.shared_contacts
DROP TABLE IF EXISTS `shared_contacts`;
CREATE TABLE IF NOT EXISTS `shared_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `shared_by` int(11) NOT NULL,
  `shared_with` int(11) NOT NULL,
  `referance_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_base_app.shared_contacts: 8 rows
DELETE FROM `shared_contacts`;
/*!40000 ALTER TABLE `shared_contacts` DISABLE KEYS */;
INSERT INTO `shared_contacts` (`id`, `contact_id`, `shared_by`, `shared_with`, `referance_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 15, 6, 1, 23, '2018-12-02 09:23:14', '2018-12-02 09:24:21', '2018-12-02 09:24:21'),
	(2, 15, 6, 2, 24, '2018-12-02 09:23:14', '2018-12-02 09:27:20', '2018-12-02 09:27:20'),
	(3, 15, 6, 3, 25, '2018-12-02 09:24:21', '2018-12-02 09:29:55', '2018-12-02 09:29:55'),
	(4, 15, 6, 4, 26, '2018-12-02 09:24:21', '2018-12-02 09:29:55', '2018-12-02 09:29:55'),
	(5, 15, 6, 1, 27, '2018-12-02 09:27:20', '2018-12-02 09:29:55', '2018-12-02 09:29:55'),
	(6, 15, 6, 7, 28, '2018-12-02 09:29:55', '2018-12-02 09:29:55', NULL),
	(7, 29, 6, 1, 30, '2018-12-02 14:45:59', '2018-12-02 14:45:59', NULL),
	(8, 29, 6, 7, 31, '2018-12-02 14:45:59', '2018-12-02 14:45:59', NULL);
/*!40000 ALTER TABLE `shared_contacts` ENABLE KEYS */;


-- Dumping structure for table laravel_base_app.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '4',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_user_type_foreign` (`user_type`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_base_app.users: 11 rows
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Chetan Patil', 'cp@gmail.com', '$2y$10$FYdEU1gqL0PcjeEr6NoQ6uIgrFedyhPivXLs140Zdj..8Ql9/9u7.', 2, 'GhKqvtYuopwjK2dKyOrOE9TCvhQgOduzc50fFjzaAQpZLN8D8bWF88Pb8Pmq', '2018-04-02 15:43:20', '2018-04-02 15:43:20'),
	(8, 'Raj', 'rj@gm.com', '$2y$10$oAXhom9M/xShFoBUfoRZdOfWLLm8Luvr2zUq3yngrKFpg1ncGuR.K', 4, NULL, '2018-12-02 14:55:02', '2018-12-02 14:55:02'),
	(9, 'Tommy', 'tm@hm.com', '$2y$10$RaZKNBdwZbWpXPgYQIqH7uumx39aXoqtsYlQZe6CoSsxl5dC2HXde', 4, NULL, '2018-12-02 14:59:31', '2018-12-02 14:59:31'),
	(10, 'Ram', 'rm@fg.com', '$2y$10$wlPqwijyWdcXP/sd4DkRD.GjG6khHEk.5vFVEt7TzO3bO7fVLTfiy', 4, NULL, '2018-12-02 15:00:37', '2018-12-02 15:00:37'),
	(11, 'Vivek', 'vr@fgh.com', '$2y$10$goC5r4Vc4BeJUKkTUhoPhOel1AxcwfFeHy0ylS.gQ8DSqe0IwLKyi', 4, NULL, '2018-12-02 15:01:46', '2018-12-02 15:01:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table laravel_base_app.user_types
DROP TABLE IF EXISTS `user_types`;
CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_base_app.user_types: 16 rows
DELETE FROM `user_types`;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` (`id`, `type`, `created_by`, `created_at`, `updated_at`, `deleted_at`, `deleted_by`) VALUES
	(1, 'System', 1, '2018-04-02 15:42:36', NULL, NULL, NULL),
	(2, 'Superadmin', 1, '2018-04-02 15:42:36', NULL, NULL, NULL),
	(3, 'Admin', 1, '2018-04-02 15:42:36', NULL, NULL, NULL),
	(4, 'Subscriber', 1, '2018-04-02 15:42:36', NULL, NULL, NULL),
	(16, 'Guest', 1, '2018-04-24 20:53:07', NULL, NULL, NULL);
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
