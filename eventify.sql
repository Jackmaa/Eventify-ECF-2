-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 27 jan. 2025 à 15:01
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `eventify`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_category`),
  UNIQUE KEY `CATEGORY` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `name`) VALUES
(3, 'Appointment'),
(1, 'Birthday'),
(2, 'Meeting'),
(4, 'Task');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id_event` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `hour_start` time NOT NULL,
  `hour_end` time NOT NULL,
  `id_user` int NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_event`),
  KEY `USER` (`id_user`),
  KEY `CATEGORY` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id_event`, `title`, `location`, `description`, `date_start`, `date_end`, `hour_start`, `hour_end`, `id_user`, `category_name`) VALUES
(2, 'Birthday', '', 'Let\'s party', '2025-08-24', '2025-08-24', '00:00:00', '23:30:00', 3, 'Birthday'),
(8, 'RDV doc', 'Montluel', 'Ye', '2025-08-24', '2025-08-24', '09:30:00', '10:30:00', 3, 'Appointment');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `sign_in_date` date NOT NULL,
  `email` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `password` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `auto_delete_past_events` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `name`, `sign_in_date`, `email`, `password`, `auto_delete_past_events`) VALUES
(1, 'Valentin', '2025-01-21', 'valentingillot@gmail.com', '$2y$13$sgIW2fUvXcuLVau9Nhj8f.4iWPCyJzzT8oez/Pcl/Jt2vQGDFDZ9.', 1),
(2, 'nefer', '2025-01-21', 'nefer@nefer.com', '$2y$13$EPDpiBi97fbxu7Qpfy1b0uydqB8WGwHx89T1klZ28mCPV2RDGRfbu', 0),
(3, 'Mel00w', '2025-01-21', 'mel00w.tv@gmail.com', '$2y$13$sKAy//slZbR4DaipKMC/Iu0Uldf/qAK7suzb9Lio.I0GIDcpcn4Ki', 0),
(4, 'patrice', '2025-01-21', 'patrice@patrice.fr', '$2y$13$Pyf1x/TArDcJjA2BjFnKUuJGGDmTQTjDBIbb9CSpjXdjGNc9vDnv6', 1),
(5, 'Test', '2025-01-21', 'test@hotmail.com', '$2y$13$PSW5VjUlbKTtGyBFkl1sf.E/vu/TtO1ffo.DPcnKnCeXmn2RAhWEC', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`category_name`) REFERENCES `category` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
