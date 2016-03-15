CREATE DATABASE  IF NOT EXISTS `gaifaim` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gaifaim`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: gaifaim
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.9-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `jour_has_menu`
--

DROP TABLE IF EXISTS `jour_has_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jour_has_menu` (
  `jour` datetime NOT NULL,
  `id_menu` int(11) NOT NULL,
  PRIMARY KEY (`jour`,`id_menu`),
  KEY `fk_menu_jour_idx` (`id_menu`),
  CONSTRAINT `fk_menu_jour` FOREIGN KEY (`id_menu`) REFERENCES `plat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jour_has_menu`
--

LOCK TABLES `jour_has_menu` WRITE;
/*!40000 ALTER TABLE `jour_has_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `jour_has_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plat`
--

DROP TABLE IF EXISTS `plat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `titre` varchar(45) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plat`
--

LOCK TABLES `plat` WRITE;
/*!40000 ALTER TABLE `plat` DISABLE KEYS */;
INSERT INTO `plat` VALUES (1,'Plat_test aubergine','plat_Test','aubergine.jpg');
/*!40000 ALTER TABLE `plat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation` (
  `date` datetime NOT NULL,
  `id_menu` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`date`,`id_menu`),
  KEY `fk_id_menu_utilisateur_idx` (`id_menu`),
  CONSTRAINT `fk_id_menu_utilisateur` FOREIGN KEY (`id_menu`) REFERENCES `plat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES ('0000-00-00 00:00:00',1,1,NULL,'0612345678','admin@gaifaim.com','xxx'),('2016-03-09 14:43:12',1,1,'admin','0612345678','admin@gaifaim.com','ddd'),('2016-03-09 14:46:05',1,1,'admin','0612345678','admin@gaifaim.com',''),('2016-03-09 14:46:30',1,0,'admin','0612345678','admin@gaifaim.com',''),('2016-03-09 14:48:49',1,2,'admin','0612345678','abfdkljsdf@dsf.com',''),('2016-03-09 14:52:18',1,1,'admin','0612345678','admin@gaifaim.com',''),('2016-03-09 14:58:35',1,1,'test','012345678','utilisateur@gaifaim.com',''),('2016-03-09 15:01:23',1,1,'test','012345678','utilisateur@gaifaim.com',''),('2016-03-09 15:35:34',1,1,'Yang','1234567/8','yang@yang.com','');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `mdp` varchar(45) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(45) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (1,1,'admin','admin','email@mail.com','0612345678','1, rue aBC, 75001 Paris'),(2,1,'yang','thomas','yang@gaimfaim.com','0612345678','Adresse.Paris');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-16  0:18:01
