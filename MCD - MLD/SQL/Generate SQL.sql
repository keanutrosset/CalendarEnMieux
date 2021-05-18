-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.11 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

-- Listage de la structure de la base pour calenmieux21_cam
CREATE DATABASE IF NOT EXISTS `calenmieux21_cam` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `calenmieux21_cam`;

-- Listage de la structure de la table calenmieux21_cam. users
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(12) NOT NULL DEFAULT '0',
  `email` varchar(320) NOT NULL,
  `password` varchar(127) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- Listage de la structure de la table calenmieux21_cam. events
CREATE TABLE IF NOT EXISTS `events` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL DEFAULT '',
  `place` varchar(100) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '1000-01-01',
  `start time` time NOT NULL DEFAULT '00:00:00',
  `end time` time NOT NULL DEFAULT '00:00:00',
  `type` int(10) NOT NULL DEFAULT '0',
  `recurrence` int(5) NOT NULL,
  `FKusers` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKusers` (`FKusers`),
  CONSTRAINT `FKusers` FOREIGN KEY (`FKusers`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table calenmieux21_cam.events : ~0 rows (environ)
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;


-- Listage de la structure de la table calenmieux21_cam. event-recurrence
CREATE TABLE IF NOT EXISTS `event-recurrence` (
  `ID` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT '1000-01-01',
  `FKevents` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKevents` (`FKevents`),
  CONSTRAINT `FKevents` FOREIGN KEY (`FKevents`) REFERENCES `events` (`fkusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table calenmieux21_cam.event-recurrence : ~0 rows (environ)
/*!40000 ALTER TABLE `event-recurrence` DISABLE KEYS */;
/*!40000 ALTER TABLE `event-recurrence` ENABLE KEYS */;
