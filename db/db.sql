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
CREATE DATABASE IF NOT EXISTS `tm` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `tm`;

-- Dumping structure for table tm.users
CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(320) NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0,
  `first_name` varchar(1000) NOT NULL,
  `last_name` varchar(1000) NOT NULL,
  `user_image` varchar(1000) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`email`),
  KEY `score` (`score`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tm.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`email`, `score`, `first_name`, `last_name`, `user_image`, `date`) VALUES
	('hasan.albd@eduge.ch', 0, 'HASAN', 'HASAN.ALBD', 'https://lh3.googleusercontent.com/a/AATXAJzMbti0-enQrPyzjJeaQjs58o92qw_CE0xJ-_Ii=s96-c', '2021-07-26 19:48:38'),
	('hassonyalobaidy01@gmail.com', 0, 'Hassan', 'Al Obaidi', 'https://lh3.googleusercontent.com/a-/AOh14GhWc7mFJHGEnhyhOgBO0HsS0ugO33ldcExpLkIB1A=s96-c', '2021-07-26 19:24:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
