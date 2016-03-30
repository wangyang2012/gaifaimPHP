-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 30 Mars 2016 à 18:18
-- Version du serveur :  10.1.10-MariaDB
-- Version de PHP :  7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gaifaim`
--
CREATE DATABASE IF NOT EXISTS `gaifaim` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gaifaim`;

-- --------------------------------------------------------

--
-- Structure de la table `jour_has_menu`
--

DROP TABLE IF EXISTS `jour_has_menu`;
CREATE TABLE IF NOT EXISTS `jour_has_menu` (
  `jour` date NOT NULL,
  `id_menu` int(11) NOT NULL,
  PRIMARY KEY (`jour`,`id_menu`),
  UNIQUE KEY `jour` (`jour`),
  KEY `fk_menu_jour_idx` (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `jour_has_menu`
--

INSERT INTO `jour_has_menu` (`jour`, `id_menu`) VALUES
('2016-03-01', 1),
('2016-03-30', 2),
('2016-03-31', 2);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entree` int(11) NOT NULL,
  `plat` int(11) NOT NULL,
  `dessert` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_plat1_idx` (`entree`),
  KEY `fk_plat2_idx` (`plat`),
  KEY `fk_plat3_idx` (`dessert`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `menu`
--

INSERT INTO `menu` (`id`, `entree`, `plat`, `dessert`, `titre`) VALUES
(1, 2, 1, 4, 'Menu 1'),
(2, 3, 5, 6, 'Menu 2');

-- --------------------------------------------------------

--
-- Structure de la table `plat`
--

DROP TABLE IF EXISTS `plat`;
CREATE TABLE IF NOT EXISTS `plat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `titre` varchar(45) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `plat`
--

INSERT INTO `plat` (`id`, `description`, `titre`, `image`) VALUES
(1, 'tomate', 'Tomate aux oeufs', 'tomate.jpg'),
(2, 'Salade', 'Salade', 'salade.jpg'),
(3, 'entrÃ©e', 'Nem', 'nem.jpg'),
(4, 'Dessert', 'CrÃªpe', 'crepe.jpg'),
(5, 'Marquereau', 'Poisson', 'marquereau.jpg'),
(6, 'Dessert', 'GÃ¢teau', 'gateau.JPG');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `jour` date NOT NULL,
  `id_menu` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`jour`,`id_menu`),
  KEY `fk_id_menu_utilisateur_idx` (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`jour`, `id_menu`, `quantite`, `login`, `telephone`, `email`, `note`) VALUES
('2016-03-30', 1, 1, 'admin', '0612345678', 'email@mail.com', '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
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

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `role`, `login`, `mdp`, `email`, `telephone`, `adresse`) VALUES
(1, 1, 'admin', 'admin', 'email@mail.com', '0612345678', '1, rue aBC, 75001 Paris'),
(2, 1, 'yang', 'thomas', 'yang@gaimfaim.com', '0612345678', 'Adresse.Paris');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `jour_has_menu`
--
ALTER TABLE `jour_has_menu`
  ADD CONSTRAINT `fk_menu_jour` FOREIGN KEY (`id_menu`) REFERENCES `plat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_plat1` FOREIGN KEY (`entree`) REFERENCES `plat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_plat2` FOREIGN KEY (`plat`) REFERENCES `plat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_plat3` FOREIGN KEY (`dessert`) REFERENCES `plat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
