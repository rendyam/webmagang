-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for magang
CREATE DATABASE IF NOT EXISTS `magang` /*!40100 DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `magang`;

-- Dumping structure for table magang.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table magang.m_status_tabs
CREATE TABLE IF NOT EXISTS `m_status_tabs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE armscii8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Data exporting was unselected.

-- Dumping structure for table magang.sso_access
CREATE TABLE IF NOT EXISTS `sso_access` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint unsigned NOT NULL,
  `users_position_id` bigint unsigned NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Data exporting was unselected.

-- Dumping structure for table magang.t_request_approve_tabs
CREATE TABLE IF NOT EXISTS `t_request_approve_tabs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `t_request_tabs_id` bigint unsigned NOT NULL,
  `sso_access_id` bigint unsigned NOT NULL,
  `m_status_tabs_id` int unsigned NOT NULL,
  `notes` text COLLATE armscii8_bin NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Index 2` (`t_request_tabs_id`),
  KEY `Index 3` (`m_status_tabs_id`),
  KEY `Index 4` (`sso_access_id`),
  CONSTRAINT `FK_t_request_approve_tabs_sso_access` FOREIGN KEY (`sso_access_id`) REFERENCES `sso_access` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_t_request_approve_tabs_t_request_tabs` FOREIGN KEY (`t_request_tabs_id`) REFERENCES `t_request_tabs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Data exporting was unselected.

-- Dumping structure for table magang.t_request_tabs
CREATE TABLE IF NOT EXISTS `t_request_tabs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `users_tabs_id` bigint unsigned NOT NULL,
  `nim` varchar(50) COLLATE armscii8_bin NOT NULL,
  `phone` varchar(14) COLLATE armscii8_bin NOT NULL,
  `spesialitation` varchar(255) COLLATE armscii8_bin NOT NULL,
  `levels` tinyint NOT NULL COMMENT '0 = SMA, 1 = S1, 2 = S2',
  `school` varchar(255) COLLATE armscii8_bin NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `path_submission_letter` varchar(255) COLLATE armscii8_bin NOT NULL,
  `path_cv` varchar(255) COLLATE armscii8_bin NOT NULL,
  `path_photo` varchar(255) COLLATE armscii8_bin NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_t_request_tabs_users_tabs` (`users_tabs_id`),
  CONSTRAINT `FK_t_request_tabs_users_tabs` FOREIGN KEY (`users_tabs_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Data exporting was unselected.

-- Dumping structure for table magang.t_response_document_tabs
CREATE TABLE IF NOT EXISTS `t_response_document_tabs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `t_request_approve_tabs` bigint unsigned NOT NULL,
  `path_document` varchar(255) COLLATE armscii8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Index 2` (`t_request_approve_tabs`),
  CONSTRAINT `FK__t_request_approve_tabs` FOREIGN KEY (`t_request_approve_tabs`) REFERENCES `t_request_approve_tabs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Data exporting was unselected.

-- Dumping structure for table magang.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Index 2` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
