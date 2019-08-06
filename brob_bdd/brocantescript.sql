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


-- Listage de la structure de la base pour brocante
DROP DATABASE IF EXISTS `brocante`;
CREATE DATABASE IF NOT EXISTS `brocante` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `brocante`;

-- Listage de la structure de la table brocante. administrateurs
DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE IF NOT EXISTS `administrateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `mdp` varchar(45) NOT NULL,
  `clients_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_administrateurs_clients_idx` (`clients_id`),
  CONSTRAINT `fk_administrateurs_clients` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table brocante.administrateurs : ~0 rows (environ)
/*!40000 ALTER TABLE `administrateurs` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrateurs` ENABLE KEYS */;

-- Listage de la structure de la table brocante. clients
DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `telephone` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `codepostal` int(11) DEFAULT NULL,
  `ville` varchar(45) DEFAULT NULL,
  `emplacements_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`emplacements_id`),
  KEY `fk_clients_emplacements1_idx` (`emplacements_id`),
  CONSTRAINT `fk_clients_emplacements1` FOREIGN KEY (`emplacements_id`) REFERENCES `emplacements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table brocante.clients : ~0 rows (environ)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Listage de la structure de la table brocante. emplacements
DROP TABLE IF EXISTS `emplacements`;
CREATE TABLE IF NOT EXISTS `emplacements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `taille` varchar(45) NOT NULL,
  `prix` int(11) NOT NULL,
  `paye` tinyint(4) NOT NULL,
  `occupe` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Listage des données de la table brocante.emplacements : ~0 rows (environ)
/*!40000 ALTER TABLE `emplacements` DISABLE KEYS */;
INSERT INTO `emplacements` (`id`, `numero`, `taille`, `prix`, `paye`, `occupe`) VALUES
	(1, 1, 'petit', 10, 0, 0),
	(2, 2, 'moyen', 20, 0, 0),
	(3, 3, 'grand', 30, 0, 0),
	(4, 4, 'petit', 10, 0, 0),
	(5, 5, 'moyen', 20, 0, 0),
	(6, 6, 'grand', 30, 0, 0),
	(7, 7, 'petit', 10, 0, 0),
	(8, 8, 'moyen', 20, 0, 0),
	(9, 9, 'grand', 30, 0, 0),
	(10, 10, 'petit', 10, 0, 0),
	(11, 11, 'moyen', 20, 0, 0),
	(12, 12, 'grand', 30, 0, 0),
	(13, 13, 'petit', 10, 0, 0),
	(14, 14, 'moyen', 20, 0, 0),
	(15, 15, 'grand', 30, 0, 0),
	(16, 16, 'petit', 10, 0, 0),
	(17, 17, 'moyen', 20, 0, 0),
	(18, 18, 'grand', 30, 0, 0),
	(19, 19, 'petit', 10, 0, 0),
	(20, 20, 'moyen', 20, 0, 0),
	(21, 21, 'grand', 30, 0, 0);
/*!40000 ALTER TABLE `emplacements` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
