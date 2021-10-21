-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.31-MariaDB-cll-lve - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for swisicfc_tm
CREATE DATABASE IF NOT EXISTS `swisicfc_tm` /*!40100 DEFAULT CHARACTER SET utf32 COLLATE utf32_unicode_ci */;
USE `swisicfc_tm`;

-- Dumping structure for table swisicfc_tm.activity
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) unsigned NOT NULL,
  `last_activity` datetime NOT NULL,
  `page` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table swisicfc_tm.activity: ~73 rows (approximately)
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` (`id`, `last_activity`, `page`) VALUES
	(1, '2021-10-21 17:45:17', 'profile.php?u=1'),
	(2, '2021-10-21 17:41:07', 'profile.php?u=2'),
	(3, '2021-10-20 09:23:54', 'index.php'),
	(4, '2021-10-18 08:49:47', 'avis.php'),
	(5, '2021-08-14 12:51:52', 'allemand.php'),
	(6, '2021-08-30 14:25:30', 'index.php'),
	(7, '2021-08-23 21:53:54', 'profile.php?u=7'),
	(8, '2021-08-16 19:37:18', 'profile.php?u=8'),
	(9, '2021-08-16 19:10:14', 'online.php'),
	(10, '2021-08-18 09:14:14', 'profile.php?u=10'),
	(11, '2021-08-19 10:10:47', 'index.php'),
	(12, '2021-08-21 12:29:30', 'index.php'),
	(13, '2021-10-09 12:21:53', 'profile.php?u=2'),
	(14, '2021-10-21 10:13:48', 'profile.php?u=14'),
	(15, '2021-08-24 14:09:47', 'allemand.php'),
	(16, '2021-10-21 14:44:59', 'index.php'),
	(17, '2021-10-18 08:50:00', 'avis.php'),
	(18, '2021-08-28 15:31:56', 'index.php'),
	(19, '2021-08-30 08:17:22', 'profile.php?u=1'),
	(20, '2021-09-21 15:07:03', 'profile.php?u=20'),
	(21, '2021-09-22 19:06:20', 'online.php'),
	(22, '2021-09-03 07:38:00', 'allemand.php'),
	(23, '2021-09-05 09:35:11', 'carte.php'),
	(24, '2021-10-04 20:30:18', 'allemand.php'),
	(25, '2021-09-10 16:51:44', 'profile.php?u=25'),
	(26, '2021-09-15 06:47:40', 'profile.php?u=26'),
	(27, '2021-09-10 20:46:32', 'allemand.php'),
	(28, '2021-09-26 15:08:55', 'allemand.php'),
	(29, '2021-09-10 21:10:52', 'index.php'),
	(30, '2021-09-10 21:55:56', 'allemand.php'),
	(31, '2021-09-12 15:48:19', 'index.php'),
	(32, '2021-09-10 22:54:23', 'italien.php'),
	(33, '2021-10-19 19:44:33', 'allemand.php'),
	(34, '2021-09-14 10:05:29', 'index.php'),
	(35, '2021-10-15 10:30:16', 'allemand.php'),
	(36, '2021-09-14 14:40:39', 'profile.php?u=36'),
	(37, '2021-09-14 19:26:31', 'index.php'),
	(38, '2021-09-14 19:58:27', 'drapeaux.php'),
	(39, '2021-09-14 19:50:32', 'allemand.php'),
	(40, '2021-09-14 20:18:59', 'allemand.php'),
	(41, '2021-09-15 16:51:42', 'allemand.php'),
	(42, '2021-09-14 20:22:08', 'allemand.php'),
	(43, '2021-09-14 20:51:45', 'allemand.php'),
	(44, '2021-09-15 01:56:26', 'allemand.php'),
	(45, '2021-09-15 06:05:40', 'index.php'),
	(46, '2021-09-15 14:19:04', 'allemand.php'),
	(47, '2021-09-15 15:33:59', 'anglais.php'),
	(48, '2021-09-15 17:36:47', 'index.php'),
	(49, '2021-09-15 18:08:38', 'drapeaux.php'),
	(50, '2021-09-15 19:13:34', 'allemand.php'),
	(51, '2021-09-15 19:37:57', 'anglais.php'),
	(52, '2021-09-15 20:21:37', 'index.php'),
	(53, '2021-09-15 20:27:39', 'italien.php'),
	(54, '2021-10-12 20:04:01', 'index.php'),
	(55, '2021-09-17 06:15:39', 'allemand.php'),
	(56, '2021-09-16 17:45:08', 'allemand.php'),
	(57, '2021-10-12 09:54:00', 'allemand.php'),
	(58, '2021-09-21 17:12:43', 'index.php'),
	(59, '2021-09-21 19:30:57', 'profile.php?u=59'),
	(60, '2021-09-22 10:37:39', 'index.php'),
	(61, '2021-09-23 11:03:38', 'profile.php?u=61'),
	(62, '2021-09-24 13:17:15', 'allemand.php'),
	(63, '2021-09-30 17:54:48', 'index.php'),
	(64, '2021-10-01 12:52:49', 'index.php'),
	(65, '2021-10-01 12:59:57', 'allemand.php'),
	(66, '2021-10-02 14:52:49', 'allemand.php'),
	(67, '2021-10-04 19:50:51', 'allemand.php'),
	(68, '2021-10-03 19:30:19', 'allemand.php'),
	(69, '2021-10-03 18:32:17', 'index.php'),
	(70, '2021-10-05 07:20:47', 'italien.php'),
	(71, '2021-10-04 07:55:36', 'anglais.php'),
	(72, '2021-10-04 13:11:04', 'index.php'),
	(73, '2021-10-04 18:56:06', 'allemand.php'),
	(74, '2021-10-04 23:41:04', 'allemand.php'),
	(75, '2021-10-05 10:21:00', 'carte.php'),
	(76, '2021-10-07 08:56:28', 'anglais.php'),
	(77, '2021-10-09 16:42:01', 'index.php'),
	(78, '2021-10-11 09:09:14', 'index.php'),
	(79, '2021-10-14 05:58:46', 'allemand.php'),
	(80, '2021-10-17 21:39:27', 'allemand.php'),
	(81, '2021-10-19 13:00:21', 'index.php');
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;

-- Dumping structure for table swisicfc_tm.badges
CREATE TABLE IF NOT EXISTS `badges` (
  `id` int(11) NOT NULL,
  `badge` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table swisicfc_tm.badges: ~3 rows (approximately)
/*!40000 ALTER TABLE `badges` DISABLE KEYS */;
INSERT INTO `badges` (`id`, `badge`) VALUES
	(1, 'verified'),
	(2, 'verified'),
	(14, 'verified'),
	(16, 'verified'),
	(28, 'verified'),
	(33, 'verified'),
	(68, 'verified');
/*!40000 ALTER TABLE `badges` ENABLE KEYS */;

-- Dumping structure for table swisicfc_tm.friends
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_1` int(10) unsigned NOT NULL,
  `user_2` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

-- Dumping data for table swisicfc_tm.friends: ~31 rows (approximately)
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` (`id`, `user_1`, `user_2`) VALUES
	(26, 2, 1),
	(27, 1, 2),
	(29, 3, 1),
	(30, 2, 3),
	(31, 4, 1),
	(32, 2, 4),
	(34, 5, 1),
	(35, 6, 1),
	(36, 1, 8),
	(37, 8, 1),
	(38, 16, 1),
	(39, 1, 16),
	(40, 18, 1),
	(41, 2, 16),
	(42, 19, 1),
	(43, 1, 19),
	(44, 3, 2),
	(45, 3, 4),
	(46, 4, 3),
	(47, 1, 28),
	(48, 4, 2),
	(49, 1, 33),
	(50, 13, 2),
	(51, 2, 13),
	(52, 1, 4),
	(53, 1, 68),
	(54, 67, 21),
	(55, 54, 77),
	(56, 54, 26),
	(57, 4, 17),
	(59, 17, 4),
	(62, 3, 33);
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;

-- Dumping structure for table swisicfc_tm.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(10) unsigned NOT NULL,
  `receiver_id` int(10) unsigned NOT NULL,
  `message` varchar(240) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;

-- Dumping data for table swisicfc_tm.messages: ~17 rows (approximately)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `date`) VALUES
	(179, 4, 1, 'mec', '2021-10-18 04:30:27'),
	(180, 4, 1, 'tu vas jamais lire ce message', '2021-10-18 04:30:37'),
	(181, 4, 1, 'Alessandro connaÃ®t personnelement le comitÃ©', '2021-10-18 04:30:54'),
	(182, 4, 1, 'je vais utiliser michaÃ«l', '2021-10-18 04:31:04'),
	(183, 4, 17, 'yo', '2021-10-18 04:40:44'),
	(184, 17, 4, 'holy shit', '2021-10-18 04:41:06'),
	(185, 17, 4, 'lklakdf', '2021-10-18 04:41:09'),
	(186, 4, 17, 'c\'est mon site', '2021-10-18 04:41:14'),
	(187, 4, 17, 'coder intÃ©gralement par', '2021-10-18 04:41:20'),
	(188, 17, 4, 'pq le chat se roule de bas en haut?', '2021-10-18 04:41:24'),
	(189, 4, 17, 'hassan', '2021-10-18 04:41:25'),
	(190, 4, 17, 'pour pas avoir Ã  scroll', '2021-10-18 04:41:33'),
	(191, 17, 4, 'bruh', '2021-10-18 04:41:41'),
	(192, 17, 4, 'comment Ã§a pas avoir Ã  scroll down', '2021-10-18 04:41:55'),
	(193, 4, 17, 'si message en bas', '2021-10-18 04:42:02'),
	(194, 4, 17, 'toi aller en bas', '2021-10-18 04:42:07'),
	(195, 4, 17, 'bon', '2021-10-18 04:42:25'),
	(196, 4, 17, 'du coup, on n\'a utilisÃ© aucune library', '2021-10-18 04:42:36'),
	(197, 4, 17, 'tout coder Ã  la main', '2021-10-18 04:42:48'),
	(198, 4, 17, 'sauf la carte e la liste de pays', '2021-10-18 04:42:56'),
	(199, 3, 33, 'hey', '2021-10-19 08:46:10'),
	(200, 16, 1, 'Bonjour Hassan, je viens de tester le vocabulaire d\'italien et lorsque je regarde mon classement Ã§a me dit que je suis 4e au classement. Or, si je regarde le classement gÃ©nÃ©ral, je n\'apparaÃ®t pas. Est-ce-normal?', '2021-10-21 07:57:05');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Dumping structure for table swisicfc_tm.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL,
  `message` varchar(1000) COLLATE utf32_unicode_ci DEFAULT NULL,
  `stars` tinyint(5) DEFAULT NULL,
  `displayed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- Dumping data for table swisicfc_tm.reviews: ~3 rows (approximately)
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` (`id`, `message`, `stars`, `displayed`) VALUES
	(14, '', 5, 0),
	(17, 'Star/5: 5/5. Weeb/10: 0/10 (No anime reference). Technique/10: 9/10. Asian/10: 5/10. Interface/10: 10/10. Chat/10: 7/10. Jordan,Hassan/10: bruh/10. Useful/10: 9,9999999/10', 5, 0),
	(24, 'Ce site est INCROYABLE!!! C\'est beaucoup plus facile Ã  rÃ©viser pour les voc d\'allemand. A l\'attention pour toutes les demoiselles, Ã‰POUSER MOI CE HASSAN !!!!!', 5, 1),
	(26, 'Je ne mets pas quatre Ã©toiles seulement parce que dans le test des pays il y a certains qui ne figurent pas sur la carte ðŸ—¿', 5, 1),
	(54, 'Il devrait avoir une option pour choisir des mots en concret, mais si non j\'ai beaucoup aimÃ© !!!', 4, 1);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;

-- Dumping structure for table swisicfc_tm.titles
CREATE TABLE IF NOT EXISTS `titles` (
  `id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table swisicfc_tm.titles: ~4 rows (approximately)
/*!40000 ALTER TABLE `titles` DISABLE KEYS */;
INSERT INTO `titles` (`id`, `title`) VALUES
	(1, 'Founder & CEO'),
	(2, 'Founder & CEO'),
	(14, 'Chasseur de bugs'),
	(16, 'Maitre accompagnant'),
	(28, 'Marketing'),
	(33, 'Contributrice'),
	(68, 'Chungus');
/*!40000 ALTER TABLE `titles` ENABLE KEYS */;

-- Dumping structure for table swisicfc_tm.users
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
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table swisicfc_tm.users: ~81 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `scoreAllemand`, `scoreAnglais`, `scoreItalien`, `scoreCarte`, `scoreDrapeaux`, `first_name`, `last_name`, `user_image`, `date`) VALUES
	(1, 'hassonyalobaidy01@gmail.com', 2, 2, 4, 165, 78, 'Hassan', 'Al Obaidi', 'https://lh3.googleusercontent.com/a-/AOh14GgZxjmXaeybO_AeDwF4uc38ePNqEq0KFizDcH08DQ=s96-c', '2021-08-02 10:15:41'),
	(2, 'scarpettajordan@gmail.com', 389, 1, 0, 1052, 129, 'hultraman', '563', 'https://lh3.googleusercontent.com/a-/AOh14GiyvweXyPyMgoudbJsHeeK8SOMAcbikmgk3Aw5R5w=s96-c', '2021-08-02 10:44:36'),
	(3, 'hasan.albd@eduge.ch', 1, 0, 0, 10, 4, 'HASAN', 'HASAN.ALBD', 'https://lh3.googleusercontent.com/a/AATXAJzMbti0-enQrPyzjJeaQjs58o92qw_CE0xJ-_Ii=s96-c', '2021-08-08 19:34:03'),
	(4, 'jordan.scrpt@eduge.ch', 1, 0, 0, 177, 4, 'JORDAN', 'JORDAN.SCRPT', 'https://lh3.googleusercontent.com/a/AATXAJy6zRFnzddNNCNtlO_K76gimpTSKTUHXZIHTnkSPQ=s96-c', '2021-08-09 06:03:56'),
	(5, 'balsamsaad2012@gmail.com', 4, 0, 0, 0, 0, 'Balsam', 'Saad', 'https://lh3.googleusercontent.com/a-/AOh14GhXyp0aPjOoNMFavD5fH7cU0dzld5LozElKcvg0rA=s96-c', '2021-08-14 08:46:25'),
	(6, 'banalobaidi59@gmail.com', 34, 0, 0, 0, 0, 'Ban', 'Alobaidi', 'https://lh3.googleusercontent.com/a-/AOh14Ggq6LKdOqvjnCG1EAX8Zk9TWOz5RYygrNs6QTthvQ=s96-c', '2021-08-14 08:48:41'),
	(7, 'jeanlouisdelafistiniere@gmail.com', 0, 0, 0, 0, 0, 'Jean-louis De la fistiniÃ¨re', '', 'https://lh3.googleusercontent.com/a/AATXAJydb9E9pnbWT2bKs9EUuUSkqV10IHE80hOlwBE4=s96-c', '2021-08-24 07:28:07'),
	(8, 'abid.samir@hotmail.com', 41, 0, 0, 100, 160, 'Samir', 'Abid', 'https://lh3.googleusercontent.com/a/AATXAJx68qGKUsObonSwo7xnTF11NSYW9F5uJr71rKSX=s96-c', '2021-08-16 15:07:46'),
	(9, 'hassan.alobaidi2000@gmail.com', 0, 0, 0, 0, 0, 'Hasan', 'Al Obaidi', 'https://lh3.googleusercontent.com/a-/AOh14Gj84mh6bMglC7VDkqoaDqwi7U3DTUbekKij0cyC=s96-c', '2021-08-16 15:09:17'),
	(10, 'elmontsaffooo@gmail.com', 0, 0, 0, 0, 0, 'elmontsafo', 'meko', 'https://lh3.googleusercontent.com/a/AATXAJyDL8ToBFY4UL5zZuilKoQ1uE5BHOZrSc_IC5s=s96-c', '2021-08-18 05:12:49'),
	(11, 'zahraa.alfaham200993@gmail.com', 8, 0, 0, 0, 0, 'Zahraa', 'Alfaham', 'https://lh3.googleusercontent.com/a/AATXAJygARTMgjKQdZei_kQiDwYXbkardO8dDIrEVOcO=s96-c', '2021-08-19 05:58:59'),
	(12, 'carole.deiana@gmail.com', 0, 0, 0, 0, 0, 'Carole', 'Deiana', 'https://lh3.googleusercontent.com/a/AATXAJy9iWGNciEF8DKnXyfLQJJVSUkQJkwZyfkMrmHi=s96-c', '2021-08-21 08:28:34'),
	(13, 'michael.drnt@eduge.ch', 0, 0, 0, 0, 0, 'MICHAEL', 'MICHAEL.DRNT', 'https://lh3.googleusercontent.com/a/AATXAJxfIVHSmyeI18gX4hPgSukJirvPwLwHM4UTQva4=s96-c', '2021-08-22 13:15:25'),
	(14, 'bullitspeed1@gmail.com', 63, 41, 666, 381, 3475, 'chris', '', 'https://lh3.googleusercontent.com/a/AATXAJzvmGz2QAupvNjBjVRW-vWJtK09-tqeRCD7TAa8=s96-c', '2021-08-23 18:29:49'),
	(15, 'ilham0711@hotmail.fr', 0, 0, 0, 0, 0, 'Ilham', 'Barji', 'https://lh3.googleusercontent.com/a/AATXAJxaR-LXDUoyPTHszrSR-W-aIX1lnM9nwXCH27sg=s96-c', '2021-08-24 10:09:07'),
	(16, 'edu-mettrals@eduge.ch', 8, 0, 18, 60, 5, 'SÃ©bastien', 'EDU-METTRALS', 'https://lh3.googleusercontent.com/a/AATXAJzgzY9knR_gyvMyvul9C7ZaJjCB9TTlZW2G4RyP=s96-c', '2021-08-25 06:07:22'),
	(17, 'hellopopo2006ssjj4399@gmail.com', 0, 0, 0, 0, 8, 'Hello', 'popo', 'https://lh3.googleusercontent.com/a/AATXAJzTrj64Zz6UmYoMt_IqBe_8urSikSXZaURAwi2I=s96-c', '2021-08-28 10:01:36'),
	(18, 'rm05.lenny@gmail.com', 0, 0, 0, 0, 15, 'XO', '', 'https://lh3.googleusercontent.com/a-/AOh14GggCTMC64BIZLjIFWZeZcOL1VaBFWhpoxi9jEq6_g=s96-c', '2021-08-28 11:23:59'),
	(19, 'mitshell20002000@gmail.com', 0, 0, 0, 0, 0, 'Mitshell', 'Hidalgo Fazio', 'https://lh3.googleusercontent.com/a-/AOh14GghPTSVR6mAxV-bYOS8DSb1yEcGtZu93dWqbuQUzw=s96-c', '2021-08-30 04:15:45'),
	(20, 'julio.mchdm@eduge.ch', 0, 0, 0, 0, 0, 'JULIO', 'JULIO.MCHDM', 'https://lh3.googleusercontent.com/a/AATXAJza7zfokh6UL4FupJ7hG4Iv35EeS1sxZPBLmG7e=s96-c', '2021-08-30 07:15:23'),
	(21, 'irsalan.ahmd@eduge.ch', 0, 39, 0, 0, 0, 'IRSALAN', 'IRSALAN.AHMD', 'https://lh3.googleusercontent.com/a/AATXAJxMTEkpB2_a21v-HbenkpcZ3q4O8XqRiFAZXjNw=s96-c', '2021-08-31 06:18:31'),
	(22, 'edu-perrouds@eduge.ch', 2, 0, 0, 0, 0, 'Sebastien', 'EDU-PERROUDS', 'https://lh3.googleusercontent.com/a/AATXAJwKEY0fqd3XoQCZFSNHUdQrR2SjBVa3nmDuv-ge=s96-c', '2021-09-03 03:35:03'),
	(23, 'diyarovashakhlo@gmail.com', 0, 0, 0, 0, 0, 'Shakhlo', 'Diyarova', 'https://lh3.googleusercontent.com/a/AATXAJw70gSKfgwXULDrTxQfNM49tNv_jca3CSlwnwr_=s96-c', '2021-09-05 05:24:44'),
	(24, 'irsalanahmed2003@gmail.com', 45, 0, 0, 0, 6, 'Irsalan', 'Ahmed', 'https://lh3.googleusercontent.com/a/AATXAJyJkkKn1k02nxqul4wXAMPifuiMBta0WGdu_zBz=s96-c', '2021-09-08 14:53:46'),
	(25, 'tiburonperechaud@gmail.com', 0, 0, 0, 0, 0, 'Neofertiti', '', 'https://lh3.googleusercontent.com/a-/AOh14GhYf-pzp-2g9koz953Cz_4EAuug3MT6IDOBaYv8=s96-c', '2021-09-10 12:51:25'),
	(26, 'julio.michaud@harknessinstitute.com', 0, 0, 0, 501, 435, 'Julio Benny', 'Michaud Montes de Oca', 'https://lh3.googleusercontent.com/a-/AOh14GiFjAAqOD4EWW52Ia41Zfdbw2_JHFemEatGHokv=s96-c', '2021-09-10 12:52:04'),
	(27, 'cshannah.hrmsl@eduge.ch', 0, 0, 0, 0, 0, 'CSHANNAH MARIE', 'CSHANNAH.HRMSL', 'https://lh3.googleusercontent.com/a/AATXAJzCEI82Upe_DHGcYFQubr7sp5c2zqMaJVasvvLi=s96-c', '2021-09-10 16:44:24'),
	(28, 'cristina.hj@eduge.ch', 0, 0, 0, 0, 0, 'CRISTINA', 'CRISTINA.HJ', 'https://lh3.googleusercontent.com/a/AATXAJznCJMMz5jCk9eIrXPe4GKtbUeWo7ReosXMdHxF=s96-c', '2021-09-10 16:48:42'),
	(29, 'lara.sd@eduge.ch', 0, 0, 0, 0, 0, 'LARA', 'LARA.SD', 'https://lh3.googleusercontent.com/a/AATXAJyB_w2hzdWRSezfKEM5NBhEJV0Ib_MD23HJY4EH=s96-c', '2021-09-10 17:03:35'),
	(30, 'islem.ad@eduge.ch', 0, 0, 0, 0, 0, 'ISLEM', 'ISLEM.AD', 'https://lh3.googleusercontent.com/a/AATXAJw79c2nkwDkR-LrZkEYu0LPM57hs1I5NF6p6Q3V=s96-c', '2021-09-10 17:23:51'),
	(31, 'dalya.mtl@eduge.ch', 0, 0, 0, 0, 0, 'DALYA', 'DALYA.MTL', 'https://lh3.googleusercontent.com/a/AATXAJzfVXAMwmCMtVm9g_K0CfBftExKacJoNMWMRxSN=s96-c', '2021-09-10 18:36:52'),
	(32, 'r.leyla2003@gmail.com', 0, 0, 0, 0, 0, 'Leyla', '', 'https://lh3.googleusercontent.com/a-/AOh14GjXj0DClADYQ-p3w4-MJ7NgK1CnhrBiw2W_kHxaJg=s96-c', '2021-09-10 18:43:53'),
	(33, 'ysabellacarandang@gmail.com', 0, 0, 0, 0, 0, 'Ysabella', 'Carandang', 'https://lh3.googleusercontent.com/a/AATXAJxnVF8vfhIFapu15_JShC7orcCygxWiL9_MJDl6=s96-c', '2021-09-13 09:57:49'),
	(34, 'julio123mtjm@gmail.com', 0, 0, 0, 0, 0, 'MTIJ', 'M', 'https://lh3.googleusercontent.com/a/AATXAJz0fyH_-pqzcr_eX2SVCY9kzjcOQcyT9YQDV47F5A=s96-c', '2021-09-14 06:04:23'),
	(35, 'manueltrejosfranco@gmail.com', 5, 0, 0, 0, 0, 'j', 'j', 'https://lh3.googleusercontent.com/a/AATXAJxg7zJBl0P2EdxWasgOyS1kYKZx7SEJ2rf7k3YaKw=s96-c', '2021-09-14 08:07:12'),
	(36, 'anja.wbr@eduge.ch', 0, 0, 0, 0, 13, 'ANJA', 'ANJA.WBR', 'https://lh3.googleusercontent.com/a/AATXAJxncsJ49Vm5Spiqt3C2PyzhhLa7qKPZy4ywZqxp=s96-c', '2021-09-14 09:45:50'),
	(37, 'julie.vl@eduge.ch', 0, 0, 0, 0, 0, 'JULIE', 'JULIE.VL', 'https://lh3.googleusercontent.com/a/AATXAJy6l-yX3mshP5x_RZAPsWTQPJbB3rsat0QTKutH=s96-c', '2021-09-14 15:26:12'),
	(38, 'tessa.zffr@eduge.ch', 0, 0, 165, 0, 2, 'TESSA', 'TESSA.ZFFR', 'https://lh3.googleusercontent.com/a/AATXAJzSSkZnGm_ZT4KatKMNPjp2oXwhPLbBCOpvsbNC=s96-c', '2021-09-14 15:39:34'),
	(39, 'lya.spr@eduge.ch', 0, 0, 0, 0, 0, 'LYA AURELIE', 'LYA.SPR', 'https://lh3.googleusercontent.com/a/AATXAJyRSlQ-TZqj7zFN625hW-96SlzojkS5NnD-UaOD=s96-c', '2021-09-14 15:49:01'),
	(40, 'kinda.amoune@gmail.com', 0, 0, 0, 0, 0, 'Kinda', 'Amoune', 'https://lh3.googleusercontent.com/a-/AOh14GhkuZvjxhwpgowbLpcGXvHHuSEpuyjpgeiSl6QTRqY=s96-c', '2021-09-14 16:08:58'),
	(41, 'carla.prrcr@eduge.ch', 0, 0, 0, 0, 0, 'CARLA', 'CARLA.PRRCR', 'https://lh3.googleusercontent.com/a/AATXAJzQS93P3l87bl6LVJoeva1KE3DajkvJtAlxbTls=s96-c', '2021-09-14 16:18:14'),
	(42, 'matteo.rhnr@eduge.ch', 0, 0, 0, 0, 0, 'MATTEO', 'MATTEO.RHNR', 'https://lh3.googleusercontent.com/a/AATXAJz7PfdSO6GXLQbPWGbmhvcGqIREk0C6vIokzGIq=s96-c', '2021-09-14 16:20:13'),
	(43, 'loic.vllrg@eduge.ch', 0, 0, 0, 0, 0, 'LOIC', 'LOIC.VLLRG', 'https://lh3.googleusercontent.com/a/AATXAJwzRSpZimO1UPdibuMR1c41cVm6dm4zIEMgF9Ef=s96-c', '2021-09-14 16:24:28'),
	(44, 'wikiiblaki@gmail.com', 0, 0, 0, 0, 0, 'wtshsiro', '', 'https://lh3.googleusercontent.com/a-/AOh14GjBmpUdk0P3kyII5WhH-U5qMDSkMS1AUKItNOYo2Q=s96-c', '2021-09-14 21:55:39'),
	(45, 'zoe.vds@eduge.ch', 0, 0, 0, 0, 0, 'ZOE', 'ZOE.VDS', 'https://lh3.googleusercontent.com/a/AATXAJwxFHuZWkp_u9I-d06FzkUt0cL_BwRck4u_4Nvv=s96-c', '2021-09-15 01:44:12'),
	(46, 'josefletes245@gmail.com', 0, 0, 0, 0, 0, 'wixtiz0245', 'cachofin', 'https://lh3.googleusercontent.com/a-/AOh14Gg8pFKYsMCftftZoccJfVoAELZ2ZbtYQ8wCy7BcNQ=s96-c', '2021-09-15 10:17:49'),
	(47, 'salma.tll@eduge.ch', 0, 0, 0, 0, 0, 'SALMA NICOLLE', 'SALMA.TLL', 'https://lh3.googleusercontent.com/a/AATXAJwTMz2S1OJ-gTe8RROVKxrCoUAUa_0RJBw07kvc=s96-c', '2021-09-15 11:33:19'),
	(48, 'justin.dcrvt@eduge.ch', 0, 0, 0, 0, 0, 'JUSTIN', 'JUSTIN.DCRVT', 'https://lh3.googleusercontent.com/a/AATXAJxc8Aye2xXSRdigoajEJxH9EP6sgeCfi4H0Y8t2=s96-c', '2021-09-15 13:35:04'),
	(49, 'samirabid.pareto@gmail.com', 0, 0, 0, 0, 16, 'Prince', 'dâ€™Orient', 'https://lh3.googleusercontent.com/a-/AOh14GjWBCIALp1obpC_nO5yecWVa3SiQWKBTBBeCXIS0g=s96-c', '2021-09-15 14:05:51'),
	(50, 'laetitia.ptx@eduge.ch', 0, 0, 0, 0, 0, 'LAETITIA', 'LAETITIA.PTX', 'https://lh3.googleusercontent.com/a/AATXAJwl2A6BqXH0rV6JPvVPxh9whIlygAS3dU7YCh4=s96-c', '2021-09-15 15:13:06'),
	(51, 'vanessa.cdfrn@eduge.ch', 0, 0, 0, 0, 0, 'VANESSA', 'VANESSA.CDFRN', 'https://lh3.googleusercontent.com/a/AATXAJzKDka7OF7zhIQYK1ZanXKMdabuOnn7OxodIeIq=s96-c', '2021-09-15 15:37:34'),
	(52, 'yyun2104@gmail.com', 0, 0, 0, 0, 0, 'run', 'hunterun', 'https://lh3.googleusercontent.com/a-/AOh14GhLRxj1ADlXprvtQlvoC_NoMFdEWFxeU2IbiUc-=s96-c', '2021-09-15 16:20:29'),
	(53, 'elisa.trcl@eduge.ch', 0, 0, 2, 0, 0, 'ELISA', 'ELISA.TRCL', 'https://lh3.googleusercontent.com/a/AATXAJyKKfg5JEDChBR8LkzaebJ5r75JVQAHM_9W3T8w=s96-c', '2021-09-15 16:23:13'),
	(54, 'jony.pmnch@eduge.ch', 23, 0, 0, 0, 0, 'JONY ZENIFF', 'JONY.PMNCH', 'https://lh3.googleusercontent.com/a/AATXAJzITD3WwAmEdAqUWkSYw3PWlT_QBHudjK2sXYqY=s96-c', '2021-09-16 10:51:53'),
	(55, 'abdulrahimabid512@gmail.com', 0, 0, 0, 0, 0, 'Abdulrahim', 'Abid', 'https://lh3.googleusercontent.com/a/AATXAJzPGIpa3gGwie9DhNjx7qB_BFqv6DW-kqZncPz_=s96-c', '2021-09-16 11:39:48'),
	(56, 'baptiste.crc@eduge.ch', 0, 0, 0, 0, 0, 'BAPTISTE', 'BAPTISTE.CRC', 'https://lh3.googleusercontent.com/a/AATXAJwgi07DA88Z1jXPkxhksxAHoGgYUf6hPmGZf_V5=s96-c', '2021-09-16 13:30:03'),
	(57, 'nerea.frggn@eduge.ch', 0, 0, 0, 0, 0, 'NEREA', 'NEREA.FRGGN', 'https://lh3.googleusercontent.com/a/AATXAJwKezDz1ADQYZQi7W-cR8DNs6eWZQ1eXOKSHItR=s96-c', '2021-09-17 01:27:35'),
	(58, 'hachimalmadani@gmail.com', 0, 0, 0, 10, 0, 'Hashim', 'Almadani', 'https://lh3.googleusercontent.com/a/AATXAJwzQCeiwDeWInb_OvvnGXtm3sPq0pgm_GVk00ev=s96-c', '2021-09-21 13:10:16'),
	(59, 'rebeca.grctc@eduge.ch', 4, 0, 0, 116, 0, 'REBECA', 'REBECA.GRCTC', 'https://lh3.googleusercontent.com/a/AATXAJybxmPKHMQLWG4K0NVACdruw1dwXKOMUV5_uBbf=s96-c', '2021-09-21 15:08:11'),
	(60, 'camilleflo06@gmail.com', 0, 0, 0, 0, 0, 'Camille', 'Florey', 'https://lh3.googleusercontent.com/a/AATXAJx5wacjBoV4IkanOkU5cnbr4u_RdiFcqy0xNUWD=s96-c', '2021-09-22 06:36:22'),
	(61, 'mask.fire308@gmail.com', 0, 10, 0, 0, 0, 'Enkh-Orgil', 'Batkhuu', 'https://lh3.googleusercontent.com/a/AATXAJxvuOzN6G4d-5-iQCwT-OiSkntJ0X9V5zRVbfeo=s96-c', '2021-09-23 06:54:48'),
	(62, 'annette.fvz@eduge.ch', 0, 0, 0, 0, 0, 'ANNETTE', 'ANNETTE.FVZ', 'https://lh3.googleusercontent.com/a/AATXAJy88wW_I01nFblo6E_a1Cqz8mNZDq9o5-2DUcad=s96-c', '2021-09-24 09:14:51'),
	(63, 'dilaraaa.ozcnnn@gmail.com', 0, 0, 0, 0, 0, 'Dilara', 'Ozcan', 'https://lh3.googleusercontent.com/a/AATXAJzHXaDxHaOAkV_9EmWLje5FElCCtpgPX3nmes6j=s96-c', '2021-09-30 13:53:19'),
	(64, 'mael.brauchli@gmail.com', 0, 0, 0, 0, 0, 'Mael', 'Brauchli', 'https://lh3.googleusercontent.com/a/AATXAJw1EFa2jtRgJa7kfoI97NChb4cuVToksxJaDdvq=s96-c', '2021-10-01 08:52:42'),
	(65, 'mael.brchl@eduge.ch', 0, 0, 0, 0, 0, 'MAEL', 'MAEL.BRCHL', 'https://lh3.googleusercontent.com/a/AATXAJx1JkgOwUe3mNk4P8dyNdilHUN7Tdw3SdOOG1JFsQ=s96-c', '2021-10-01 08:54:10'),
	(66, 'eron.adm@eduge.ch', 22, 0, 0, 0, 0, 'ERON', 'ERON.ADM', 'https://lh3.googleusercontent.com/a/AATXAJw2LmbG97pnZ7zRfCf8LAF9cCR-3UhxqZt1XQJw=s96-c', '2021-10-02 10:41:14'),
	(67, 'anjazoni76@gmail.com', 1, 7, 0, 0, 0, 'Anja', 'Weber', 'https://lh3.googleusercontent.com/a-/AOh14GjEEXI-80WxtQvSsAnfYEHS6GTJ_tsgRB7qZwhPbg=s96-c', '2021-10-03 04:44:39'),
	(68, 'carynel.cstll@eduge.ch', 0, 0, 0, 0, 0, 'CARYNEL', 'CARYNEL.CSTLL', 'https://lh3.googleusercontent.com/a/AATXAJy63idIk-qEmBZiBJO2G0d7jMQRV-U16Fy1DeWi=s96-c', '2021-10-03 07:15:45'),
	(69, 'hafsa.ehrch@eduge.ch', 0, 0, 0, 0, 0, 'HAFSA', 'HAFSA.EHRCH', 'https://lh3.googleusercontent.com/a/AATXAJwJo0z1lWpJ_sFaZEN7LDnR1h2j199Yv0hEVUjB=s96-c', '2021-10-03 14:30:24'),
	(70, 'simoesmario1217@gmail.com', 0, 0, 0, 0, 0, 'ZETIX', '', 'https://lh3.googleusercontent.com/a/AATXAJwBjlN9TJqx3f4Sbo-RheT_nirX2hN71sQtCary5Q=s96-c', '2021-10-04 03:52:33'),
	(71, 'jonathan.rccrd@eduge.ch', 0, 0, 0, 0, 0, 'JONATHAN', 'JONATHAN.RCCRD', 'https://lh3.googleusercontent.com/a/AATXAJxO-H6cchqZSZUpeA-YJAbSoWEkFtBLa1YYNmpA=s96-c', '2021-10-04 03:54:45'),
	(72, 'lorenzo.dzn@eduge.ch', 0, 0, 0, 0, 0, 'LORENZO', 'LORENZO.DZN', 'https://lh3.googleusercontent.com/a/AATXAJy6RWyvB7kpLdMg4qi8jp4Kogiz2sSmj-bB-lVN=s96-c', '2021-10-04 09:10:06'),
	(73, 'dilara.ozcn@eduge.ch', 0, 0, 0, 0, 0, 'DILARA', 'DILARA.OZCN', 'https://lh3.googleusercontent.com/a/AATXAJzjKhvzc3Urus7HpycpF2zojgH8nkbKl2mQJl6S=s96-c', '2021-10-04 13:24:07'),
	(74, 'alexandre.hk@eduge.ch', 4, 0, 0, 0, 0, 'ALEXANDRE', 'ALEXANDRE.HK', 'https://lh3.googleusercontent.com/a/AATXAJwjjLOPib6TY2x9JlQziXoEkFbdgJmX7zxow8Wi=s96-c', '2021-10-04 19:26:16'),
	(75, 'nathan.mrchn@eduge.ch', 0, 0, 0, 42, 325, 'NATHAN', 'NATHAN.MRCHN', 'https://lh3.googleusercontent.com/a/AATXAJwtNpT0Ta_czKxSPxtX0ligPC_gJT5HNAtzlbz9=s96-c', '2021-10-05 05:41:25'),
	(76, 'tiago.crx@eduge.ch', 0, 0, 0, 0, 0, 'TIAGO', 'TIAGO.CRX', 'https://lh3.googleusercontent.com/a/AATXAJwtshwH9NS21C9Jib9tVc67wiqEB3eNqP_nIhVU=s96-c', '2021-10-07 04:56:10'),
	(77, 'joshuanhp@gmail.com', 0, 0, 19, 0, 0, 'Jake7896', '', 'https://lh3.googleusercontent.com/a-/AOh14GgCZbInEdi_a5N6EUbiJ40zfk3ZPojRvletBRwy=s96-c', '2021-10-09 12:33:39'),
	(78, 'morellocristiano60@gmail.com', 0, 0, 6, 0, 11, 'Cristiano', 'Morello', 'https://lh3.googleusercontent.com/a/AATXAJxS7fV3rRHorwhrG4aUCNXZ1puI9-T-Mla2Gqpq=s96-c', '2021-10-11 05:03:53'),
	(79, 'mnltrejos@gmail.com', 0, 0, 0, 0, 0, 'manuel', 'trejos', 'https://lh3.googleusercontent.com/a/AATXAJxWa0x3M1CVzID2iCcEorzEeLbnO8Tz_5jnvjXh=s96-c', '2021-10-14 01:45:12'),
	(80, 'selin.ozcn@eduge.ch', 0, 0, 0, 0, 0, 'SELIN', 'SELIN.OZCN', 'https://lh3.googleusercontent.com/a/AATXAJyFQIU5gH-euuISHPCtQ2ENemhB6JMixU58nIOF=s96-c', '2021-10-17 08:18:35'),
	(81, 'rodrigo.cnstn@eduge.ch', 0, 0, 0, 0, 0, 'RODRIGO VINCENT', 'RODRIGO.CNSTN', 'https://lh3.googleusercontent.com/a/AATXAJygOk7K6IA4ephJ8UFSSJqVfII6LC3RkGTJzxD_=s96-c', '2021-10-19 08:42:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
