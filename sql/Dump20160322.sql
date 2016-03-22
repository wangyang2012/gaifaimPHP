-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           10.1.10-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la base pour gaifaim
CREATE DATABASE IF NOT EXISTS `gaifaim` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gaifaim`;


-- Export de la structure de table gaifaim. jour_has_menu
CREATE TABLE IF NOT EXISTS `jour_has_menu` (
  `jour` datetime NOT NULL,
  `id_menu` int(11) NOT NULL,
  PRIMARY KEY (`jour`,`id_menu`),
  KEY `fk_menu_jour_idx` (`id_menu`),
  CONSTRAINT `fk_menu_jour` FOREIGN KEY (`id_menu`) REFERENCES `plat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table gaifaim.jour_has_menu : ~0 rows (environ)
DELETE FROM `jour_has_menu`;
/*!40000 ALTER TABLE `jour_has_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `jour_has_menu` ENABLE KEYS */;


-- Export de la structure de table gaifaim. menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plat1` int(11) NOT NULL,
  `plat2` int(11) NOT NULL,
  `plat3` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_plat1_idx` (`plat1`),
  KEY `fk_plat2_idx` (`plat2`),
  KEY `fk_plat3_idx` (`plat3`),
  CONSTRAINT `fk_plat1` FOREIGN KEY (`plat1`) REFERENCES `plat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_plat2` FOREIGN KEY (`plat2`) REFERENCES `plat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_plat3` FOREIGN KEY (`plat3`) REFERENCES `plat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table gaifaim.menu : ~0 rows (environ)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Export de la structure de table gaifaim. plat
CREATE TABLE IF NOT EXISTS `plat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `titre` varchar(45) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Export de données de la table gaifaim.plat : ~6 rows (environ)
DELETE FROM `plat`;
/*!40000 ALTER TABLE `plat` DISABLE KEYS */;
INSERT INTO `plat` (`id`, `description`, `titre`, `image`) VALUES
	(10, 'tomate', 'Tomate aux oeufs', 'tomate.jpg'),
	(11, 'Salade', 'Salade', 'salade.jpg'),
	(13, 'entrÃ©e', 'Nem', 'nem.jpg'),
	(14, 'Dessert', 'CrÃªpe', 'crepe.jpg'),
	(15, 'Marquereau', 'Poisson', 'marquereau.jpg'),
	(16, 'Dessert', 'GÃ¢teau', 'gateau.JPG');
/*!40000 ALTER TABLE `plat` ENABLE KEYS */;


-- Export de la structure de table gaifaim. reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `date` datetime NOT NULL,
  `id_menu` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`date`,`id_menu`),
  KEY `fk_id_menu_utilisateur_idx` (`id_menu`),
  CONSTRAINT `fk_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table gaifaim.reservation : ~0 rows (environ)
DELETE FROM `reservation`;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;


-- Export de la structure de table gaifaim. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `mdp` varchar(45) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(45) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Export de données de la table gaifaim.utilisateur : ~2 rows (environ)
DELETE FROM `utilisateur`;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` (`id`, `role`, `login`, `mdp`, `email`, `telephone`, `adresse`) VALUES
	(1, 1, 'admin', 'admin', 'email@mail.com', '0612345678', '1, rue aBC, 75001 Paris'),
	(2, 1, 'yang', 'thomas', 'yang@gaimfaim.com', '0612345678', 'Adresse.Paris');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
