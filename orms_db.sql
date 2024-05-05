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


-- Dumping database structure for orms_db
CREATE DATABASE IF NOT EXISTS `orms_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `orms_db`;

-- Dumping structure for table orms_db.amenities
CREATE TABLE IF NOT EXISTS `amenities` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `amenities` varchar(255) NOT NULL DEFAULT '',
  `icons` varchar(50) DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table orms_db.amenities: ~7 rows (approximately)
INSERT INTO `amenities` (`id`, `amenities`, `icons`, `active`) VALUES
	(1, 'Wifi', 'wifi', 1),
	(2, 'Study Area', NULL, 1),
	(3, 'Alarm System', NULL, 1),
	(4, 'Built-in wardrobes', NULL, 1),
	(5, 'Pay TV access', NULL, 1),
	(6, 'Air conditioning', NULL, 1),
	(7, 'Lounge', 'couch', 1);

-- Dumping structure for table orms_db.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `user_id` int DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table orms_db.clients: ~1 rows (approximately)
INSERT INTO `clients` (`id`, `client_name`, `email`, `address`, `contact_number`, `user_id`, `active`) VALUES
	(1, 'Matthew Blancada', 'matthewblancada25@gmail.com', 'test address', '09091788512', 2, 1),
	(2, 'test client', 'test@gmail.com', 'test address', '09091788512', 3, 1);

-- Dumping structure for table orms_db.reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference` text NOT NULL,
  `tdate` text NOT NULL,
  `client_id` int NOT NULL,
  `room_id` int NOT NULL,
  `start_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `time` time DEFAULT NULL,
  `totalPay` decimal(20,6) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `mop` varchar(50) DEFAULT NULL,
  `paid` int DEFAULT '0',
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table orms_db.reservation: ~2 rows (approximately)
INSERT INTO `reservation` (`id`, `reference`, `tdate`, `client_id`, `room_id`, `start_date`, `checkout_date`, `time`, `totalPay`, `status`, `mop`, `paid`, `user_id`) VALUES
	(1, '8891101', '05/04/2024', 1, 2, '2024-05-04', '2024-05-08', '12:00:00', 400.000000, 0, 'cash', 1, 1),
	(2, '4086142', '05/04/2024', 2, 1, '2024-05-04', '2024-05-08', '10:00:00', 200.000000, 0, 'paypal', 1, NULL);

-- Dumping structure for table orms_db.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) NOT NULL,
  `good_for` int NOT NULL DEFAULT '0',
  `Image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Bedroom` int NOT NULL DEFAULT '0',
  `Baths` int NOT NULL DEFAULT '0',
  `floor_area` int NOT NULL DEFAULT '0',
  `Rate` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `active` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table orms_db.rooms: ~2 rows (approximately)
INSERT INTO `rooms` (`id`, `room_name`, `good_for`, `Image`, `details`, `Bedroom`, `Baths`, `floor_area`, `Rate`, `active`) VALUES
	(1, 'Room 1', 4, 'kangaroo1.jpg', 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2, 1, 50, 50.000000, 1),
	(2, 'Room 2', 3, 'kangaroo2.jpg', 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, 1, 70, 100.000000, 1);

-- Dumping structure for table orms_db.setuprooms
CREATE TABLE IF NOT EXISTS `setuprooms` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL DEFAULT '0',
  `amenities_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table orms_db.setuprooms: ~8 rows (approximately)
INSERT INTO `setuprooms` (`id`, `room_id`, `amenities_id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 1, 5),
	(4, 2, 1),
	(5, 2, 2),
	(6, 2, 4),
	(7, 1, 6),
	(8, 2, 6),
	(9, 2, 5);

-- Dumping structure for table orms_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint NOT NULL DEFAULT '0',
  `active` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table orms_db.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `role`, `active`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
	(2, 'matthew', 'e10adc3949ba59abbe56e057f20f883e', 2, 1),
	(3, 'testclient', 'e10adc3949ba59abbe56e057f20f883e', 2, 1),
	(4, 'testadmin', 'e10adc3949ba59abbe56e057f20f883e', 1, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
