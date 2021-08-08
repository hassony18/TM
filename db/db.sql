-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for tm
CREATE DATABASE IF NOT EXISTS `swisicfc_tm` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `swisicfc_tm`;

-- Dumping structure for table tm.activity
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) unsigned NOT NULL,
  `last_activity` datetime NOT NULL,
  `page` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table tm.activity: ~0 rows (approximately)
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;

-- Dumping structure for table tm.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(320) NOT NULL,
  `scoreAllemand` int(11) unsigned NOT NULL DEFAULT 0,
  `scoreAnglais` int(11) unsigned NOT NULL DEFAULT 0,
  `scoreItalien` int(11) unsigned NOT NULL DEFAULT 0,
  `scoreCarte` int(11) unsigned NOT NULL DEFAULT 0,
  `scoreDrapeaux` int(11) unsigned NOT NULL DEFAULT 0,
  `first_name` varchar(1000) NOT NULL,
  `last_name` varchar(1000) NOT NULL,
  `user_image` varchar(1000) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `scoreAllemand` (`scoreAllemand`),
  KEY `scoreAnglais` (`scoreAnglais`),
  KEY `scoreItalien` (`scoreItalien`),
  KEY `scoreCarte` (`scoreCarte`),
  KEY `scoreDrapeaux` (`scoreDrapeaux`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tm.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
