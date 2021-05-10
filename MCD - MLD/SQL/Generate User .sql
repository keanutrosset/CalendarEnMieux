-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.11 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

--Creation d'un utilisateur--
CREATE USER 'calenmieux21_cam'@'localhost' IDENTIFIED BY 'CalenMieux-21';
GRANT USAGE ON *.* TO 'calenmieux21_cam'@'localhost';
GRANT EXECUTE, SELECT, CREATE, DELETE, INSERT, UPDATE  ON `calenmieux21\_cam`.* TO 'calenmieux21_cam'@'localhost';