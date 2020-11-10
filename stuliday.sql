-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour stuliday
CREATE DATABASE IF NOT EXISTS `stuliday` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `stuliday`;

-- Listage de la structure de la table stuliday. adverts
CREATE TABLE IF NOT EXISTS `adverts` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0',
  `content` text,
  `city` varchar(255) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `images` varchar(255) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `datedebut` varchar(50) NOT NULL,
  `datefin` varchar(50) NOT NULL,
  `places` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ad_id`),
  KEY `author` (`author`),
  CONSTRAINT `adverts_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table stuliday. reservations
CREATE TABLE IF NOT EXISTS `reservations` (
  `reserv_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `adverts_id` int(11) NOT NULL,
  PRIMARY KEY (`reserv_id`),
  KEY `FK_reservations_users` (`users_id`),
  KEY `FK_reservations_adverts` (`adverts_id`),
  CONSTRAINT `FK_reservations_adverts` FOREIGN KEY (`adverts_id`) REFERENCES `adverts` (`ad_id`),
  CONSTRAINT `FK_reservations_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table stuliday. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `profil_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
