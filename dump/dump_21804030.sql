-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: mysql.info.unicaen.fr    Database: 21804030_bd
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.44-MariaDB-0+deb9u1

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
-- Current Database: `21804030_bd`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `21804030_bd` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `21804030_bd`;

--
-- Table structure for table `pandemics`
--

DROP TABLE IF EXISTS `pandemics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pandemics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `discoveryYear` int(11) NOT NULL,
  `description` text NOT NULL,
  `creator` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pandemics`
--

LOCK TABLES `pandemics` WRITE;
/*!40000 ALTER TABLE `pandemics` DISABLE KEYS */;
INSERT INTO `pandemics` VALUES (1,'Covid-19','Coronavirus',2019,'Pandémie mondiale','lecarpentier'),(2,'Test','virus de test',-10,'test et encore test','lecarpentier'),(3,'DROP TABLE `pandemics`;','<script>alert(\"code injecté\");</script>',-10,'<strong>pas <em>ok</em></strong><? php echo \"salut\" ?>','vanier'),(5,'Flemme','étudiante',0,'la flemme','XxX_DarkTesteurSasukedu50_XxX'),(6,'Grippe espagnole','virus',1916,'Une grippe qui aura été particulièrement mortelle durant le début du XXe siècle occasionnant des millions de morts.','Arthur');
/*!40000 ALTER TABLE `pandemics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'vanier','$2y$10$wLPLjSLykUARZgf8Sh8aDuBWVjxOVO77Tlvqpn.sBBBlAYV2kNbBG','user'),(2,'lecarpentier','$2y$10$ggOcETxC0L0VM4P6v5h7u.IAekBTFdrofBuu8gP8f/CLRHYOlPlwa','user'),(3,'Arthur','$2y$10$sVg1Spj5FaXZuS93bNZgk./m5mSSvKFLY/2LYrBJW5MCjVJDi61B2','user'),(4,'XxX_DarkTesteurSasukedu50_XxX','$2y$10$JauA.42kCeYer4iuhTHCMO2N68dvSrt3X4AvgbEbbDSIERZIR5QWy','user'),(5,'Team best','$2y$10$CFYJxDoPb8daBuse2mV0v.snf0pzJQ9fDgKUNkv6xkTmWl8zt52t2','user'),(6,'coco','$2y$10$5PLrhEsCx.MeYLQQSxw0Be3t/YzONrQz2I2/hL4ze.pYANH9OLROq','user'),(7,'admin','$2y$10$QlqDSdLOZq99IvwkugVh0epsEwHjdCgiNTssAJCOzwy15fuWkB1my','admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-07 15:58:06
