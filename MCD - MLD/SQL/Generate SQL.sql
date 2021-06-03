-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.11 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------


-- Listage de la structure de la base pour tpi21cal_cam
CREATE DATABASE IF NOT EXISTS `tpi21cal_cam` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `tpi21cal_cam`;

-- Listage de la structure de la table tpi21cal_cam. event-recurrence
CREATE TABLE IF NOT EXISTS `event-recurrence` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '1000-01-01',
  `FKevents` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKevents` (`FKevents`),
  CONSTRAINT `FKevents` FOREIGN KEY (`FKevents`) REFERENCES `events` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table tpi21cal_cam. events
CREATE TABLE IF NOT EXISTS `events` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `place` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` date NOT NULL DEFAULT '1000-01-01',
  `start time` time NOT NULL DEFAULT '00:00:00',
  `end time` time NOT NULL DEFAULT '00:00:00',
  `type` int(10) NOT NULL DEFAULT '0',
  `recurrence` int(7) NOT NULL,
  `FKusers` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKusers` (`FKusers`),
  CONSTRAINT `FKusers` FOREIGN KEY (`FKusers`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table tpi21cal_cam. users
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(12) NOT NULL DEFAULT '0',
  `email` varchar(320) NOT NULL,
  `password` varchar(127) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
