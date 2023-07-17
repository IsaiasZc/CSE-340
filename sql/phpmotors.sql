-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.33 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para phpmotors
DROP DATABASE IF EXISTS `phpmotors`;
CREATE DATABASE IF NOT EXISTS `phpmotors` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `phpmotors`;

-- Volcando estructura para tabla phpmotors.carclassification
DROP TABLE IF EXISTS `carclassification`;
CREATE TABLE IF NOT EXISTS `carclassification` (
  `classificationId` int NOT NULL AUTO_INCREMENT,
  `classificationName` varchar(30) NOT NULL,
  PRIMARY KEY (`classificationId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla phpmotors.carclassification: ~5 rows (aproximadamente)
INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
	(1, 'SUV'),
	(2, 'Classic'),
	(3, 'Sports'),
	(4, 'Trucks'),
	(5, 'Used');

-- Volcando estructura para tabla phpmotors.clients
DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `clientId` int NOT NULL AUTO_INCREMENT,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text,
  PRIMARY KEY (`clientId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla phpmotors.clients: ~4 rows (aproximadamente)
INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
	(1, 'asdsad', 'asdqwe222', 'test@test.com', '$2y$10$JX5q42M8C3k1p311.g.9/OhT9Bx/bSTzaGVnhZriQdMRnQpJUbZzW', '1', NULL),
	(2, 'Pedr', 'Navaja', 'cameo@gmail.com', '$2y$10$fo.NBI7NNybUzLKn5.D/qeHiZ3PfRajBtbQxqfouFjDZmj/f48Dwa', '1', NULL),
	(3, 'Isaias', 'Ramirez', 'Antioquita@gmail.com', '$2y$10$nlnwYc8RON1P.E.luEimf.ObszVVvVlWRO2PrDQTFxhEyoFJvI3hq', '1', NULL),
	(4, 'Admin', 'User', 'admin@cse340.net', '$2y$10$sUJBLcTjooITo6.6aalz6OIeZMRGZf/LqXPfLoWroSFXDXLuPC1qy', '3', NULL);

-- Volcando estructura para tabla phpmotors.images
DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `imgId` int NOT NULL AUTO_INCREMENT,
  `invId` int NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT (now()),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT (0),
  PRIMARY KEY (`imgId`),
  KEY `invId` (`invId`),
  CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla phpmotors.images: ~39 rows (aproximadamente)
INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
	(1, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2023-07-01 23:59:08', 1),
	(2, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2023-07-01 23:59:08', 1),
	(3, 2, 'ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt.jpg', '2023-07-02 00:01:06', 1),
	(4, 2, 'ford-modelt-tn.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '2023-07-02 00:01:06', 1),
	(5, 3, 'lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve.jpg', '2023-07-02 00:09:39', 1),
	(6, 3, 'lambo-Adve-tn.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '2023-07-02 00:09:39', 1),
	(7, 4, 'monster.jpg', '/phpmotors/images/vehicles/monster.jpg', '2023-07-02 00:09:53', 1),
	(8, 4, 'monster-tn.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '2023-07-02 00:09:53', 1),
	(9, 5, 'ms.jpg', '/phpmotors/images/vehicles/ms.jpg', '2023-07-02 00:10:37', 1),
	(10, 5, 'ms-tn.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '2023-07-02 00:10:37', 1),
	(11, 6, 'bat.jpg', '/phpmotors/images/vehicles/bat.jpg', '2023-07-02 00:11:03', 1),
	(12, 6, 'bat-tn.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '2023-07-02 00:11:03', 1),
	(13, 7, 'mm.jpg', '/phpmotors/images/vehicles/mm.jpg', '2023-07-02 00:11:20', 1),
	(14, 7, 'mm-tn.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '2023-07-02 00:11:20', 1),
	(15, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2023-07-02 00:11:31', 1),
	(16, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2023-07-02 00:11:31', 1),
	(17, 9, 'crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic.jpg', '2023-07-02 00:12:06', 1),
	(18, 9, 'crown-vic-tn.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '2023-07-02 00:12:06', 1),
	(19, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2023-07-02 00:12:43', 1),
	(20, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2023-07-02 00:12:43', 1),
	(21, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2023-07-02 00:12:54', 1),
	(22, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2023-07-02 00:12:54', 1),
	(23, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2023-07-02 00:13:09', 1),
	(24, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2023-07-02 00:13:09', 1),
	(25, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2023-07-02 00:13:28', 1),
	(26, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2023-07-02 00:13:28', 1),
	(27, 14, 'fbi.jpg', '/phpmotors/images/vehicles/fbi.jpg', '2023-07-02 00:13:49', 1),
	(28, 14, 'fbi-tn.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '2023-07-02 00:13:49', 1),
	(29, 15, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2023-07-02 00:14:31', 1),
	(30, 15, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2023-07-02 00:14:31', 1),
	(31, 18, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2023-07-02 00:30:31', 1),
	(32, 18, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2023-07-02 00:30:31', 1),
	(33, 2, 'modelT_no.jpg', '/phpmotors/images/vehicles/modelT_no.jpg', '2023-07-02 00:41:29', 0),
	(34, 2, 'modelT_no-tn.jpg', '/phpmotors/images/vehicles/modelT_no-tn.jpg', '2023-07-02 00:41:29', 0),
	(35, 18, 'DeLorean_no.jpg', '/phpmotors/images/vehicles/DeLorean_no.jpg', '2023-07-02 00:42:01', 0),
	(36, 18, 'DeLorean_no-tn.jpg', '/phpmotors/images/vehicles/DeLorean_no-tn.jpg', '2023-07-02 00:42:01', 0),
	(37, 1, 'wrangler_no.jpg', '/phpmotors/images/vehicles/wrangler_no.jpg', '2023-07-02 00:42:22', 0),
	(38, 1, 'wrangler_no-tn.jpg', '/phpmotors/images/vehicles/wrangler_no-tn.jpg', '2023-07-02 00:42:22', 0);

-- Volcando estructura para tabla phpmotors.inventory
DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `invId` int NOT NULL AUTO_INCREMENT,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,2) NOT NULL,
  `invStock` smallint NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int NOT NULL,
  PRIMARY KEY (`invId`),
  KEY `classificationId` (`classificationId`),
  CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla phpmotors.inventory: ~15 rows (aproximadamente)
INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
	(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/phpmotors/images/wrangler.jpg', '/phpmotors/images/wrangler-tn.jpg', 28045.00, 4, 'Orange', 1),
	(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/phpmotors/images/ford-modelt.jpg', '/phpmotors/images/ford-modelt-tn.jpg', 30000.00, 2, 'Black', 2),
	(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/lambo-Adve.jpg', '/phpmotors/images/lambo-Adve-tn.jpg', 417650.00, 1, 'Blue', 3),
	(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/phpmotors/images/monster.jpg', '/phpmotors/images/monster-tn.jpg', 150000.00, 3, 'purple', 4),
	(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/phpmotors/images/ms.jpg', '/phpmotors/images/ms-tn.jpg', 100.00, 1, 'Rust', 5),
	(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/phpmotors/images/bat.jpg', '/phpmotors/images/bat-tn.jpg', 65000.00, 1, 'Black', 3),
	(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/mm.jpg', '/phpmotors/images/mm-tn.jpg', 10000.00, 12, 'Green', 1),
	(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/phpmotors/images/fire-truck.jpg', '/phpmotors/images/fire-truck-tn.jpg', 50000.00, 1, 'Red', 4),
	(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/phpmotors/images/crown-vic.jpg', '/phpmotors/images/crown-vic-tn.jpg', 10000.00, 5, 'White', 5),
	(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/camaro.jpg', '/phpmotors/images/camaro-tn.jpg', 25000.00, 10, 'Silver', 3),
	(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/escalade.jpg', '/phpmotors/images/escalade-tn.jpg', 75195.00, 4, 'Black', 1),
	(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/hummer.jpg', '/phpmotors/images/hummer-tn.jpg', 58800.00, 5, 'Yellow', 5),
	(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/phpmotors/images/aerocar.jpg', '/phpmotors/images/aerocar-tn.jpg', 1000000.00, 1, 'Red', 2),
	(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month. ', '/phpmotors/images/fbi.jpg', '/phpmotors/images/fbi-tn.jpg', 20000.00, 1, 'Green', 1),
	(15, 'Dog ', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/phpmotors/images/no-image.png', '/phpmotors/images/no-image.png', 35000.00, 1, 'Brown', 2),
	(18, 'DMC', 'DeLorean', 'a classic vehicle', '/phpmotors/images/no-image.png', '/phpmotors/images/no-image.png', 165000.00, 3, 'Red', 2);

-- Volcando estructura para tabla phpmotors.reviews
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `reviewId` int NOT NULL AUTO_INCREMENT,
  `reviewText` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT (now()),
  `invId` int NOT NULL,
  `clientId` int NOT NULL,
  PRIMARY KEY (`reviewId`),
  KEY `clientId` (`clientId`),
  KEY `invId` (`invId`),
  CONSTRAINT `FK_revews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla phpmotors.reviews: ~7 rows (aproximadamente)
INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
	(1, 'Ahora si Funciona!!! Roguemos', '2023-07-10 07:09:51', 2, 4),
	(2, 'Una review M&aacute;s', '2023-07-12 04:18:44', 2, 4),
	(3, '2da Prueba\r\n', '2023-07-12 04:20:57', 2, 4),
	(4, 'AnotER!!', '2023-07-12 04:21:11', 2, 4),
	(5, 'ultimooo', '2023-07-12 04:22:21', 2, 4),
	(6, 'Fly Review', '2023-07-12 04:31:51', 13, 4),
	(8, 'asdasd', '2023-07-12 04:38:25', 13, 4),
	(9, 'mAKE A REVIERW erditied!!', '2023-07-15 02:21:40', 2, 4),
	(10, 'Added', '2023-07-15 03:03:50', 2, 4);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
