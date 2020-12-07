-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: mysql.info.unicaen.fr    Database: 21806332_bd
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
-- Current Database: `21806332_bd`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `21806332_bd` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `21806332_bd`;

--
-- Table structure for table `CLIENT`
--

DROP TABLE IF EXISTS `CLIENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CLIENT` (
  `RefC` int(11) NOT NULL,
  `NomC` varchar(20) NOT NULL,
  `Ville` varchar(20) NOT NULL,
  `CAT` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`RefC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CLIENT`
--

LOCK TABLES `CLIENT` WRITE;
/*!40000 ALTER TABLE `CLIENT` DISABLE KEYS */;
INSERT INTO `CLIENT` VALUES (1,'GOFFIN','Namur','B2'),(2,'HANSENNE','Poitiers','C1'),(3,'MONTI','Geneve','B2'),(4,'GILLET','Toulouse','B1'),(5,'AVRON','Toulouse','B1'),(6,'FERARD','Poitiers','B2'),(7,'MERCIER','Toulouse',''),(8,'TOUSSAINT','Poitiers','C1'),(9,'PONCELET','Toulouse','B2'),(10,'JACOB','Bruxelles','C2'),(11,'VANBIST','Lille','B1'),(12,'NEUMAN','Toulouse',''),(13,'FRANCK','Namur','C1'),(14,'VANDERKA','Namur','C1'),(15,'GUILLAUME','Paris','B1');
/*!40000 ALTER TABLE `CLIENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COMMANDE`
--

DROP TABLE IF EXISTS `COMMANDE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COMMANDE` (
  `RefCom` int(11) NOT NULL,
  `RefC` int(11) NOT NULL,
  `DateCom` date NOT NULL,
  PRIMARY KEY (`RefCom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COMMANDE`
--

LOCK TABLES `COMMANDE` WRITE;
/*!40000 ALTER TABLE `COMMANDE` DISABLE KEYS */;
INSERT INTO `COMMANDE` VALUES (1,14,'2005-12-21'),(2,9,'2005-12-22'),(3,14,'2005-12-23'),(4,9,'2005-12-23'),(5,12,'2006-01-02'),(6,9,'2006-01-02'),(7,7,'2006-01-03');
/*!40000 ALTER TABLE `COMMANDE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COMMUNE`
--

DROP TABLE IF EXISTS `COMMUNE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COMMUNE` (
  `RefC` int(11) NOT NULL,
  `Commune` varchar(30) NOT NULL,
  `Pays` varchar(30) NOT NULL,
  `Departement` int(11) NOT NULL,
  PRIMARY KEY (`RefC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COMMUNE`
--

LOCK TABLES `COMMUNE` WRITE;
/*!40000 ALTER TABLE `COMMUNE` DISABLE KEYS */;
INSERT INTO `COMMUNE` VALUES (10,'Bruxelles','Belgique',99),(11,'Anvers','Belgique',99),(12,'Namur','Belgique',99),(20,'Paris','France',75),(21,'Toulouse','France',31),(22,'Poitiers','France',86),(23,'Lille','France',59),(25,'Lyon','France',69),(30,'Londres','Grande-Bretagne',99),(40,'Rome','Italie',99),(50,'Geneve','Suisse',99);
/*!40000 ALTER TABLE `COMMUNE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DETAIL`
--

DROP TABLE IF EXISTS `DETAIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DETAIL` (
  `RefCOM` int(11) NOT NULL,
  `RefP` varchar(5) NOT NULL,
  `Quantite` int(11) NOT NULL,
  PRIMARY KEY (`RefCOM`,`RefP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DETAIL`
--

LOCK TABLES `DETAIL` WRITE;
/*!40000 ALTER TABLE `DETAIL` DISABLE KEYS */;
INSERT INTO `DETAIL` VALUES (1,'CH464',25),(2,'CH262',60),(2,'CL60',20),(3,'CL60',30),(4,'CH464',120),(4,'CL45',20),(5,'CH464',260),(5,'CL60',15),(5,'PL224',600),(6,'CL45',3),(7,'CH264',180),(7,'CL45',22),(7,'CL60',70),(7,'PL224',92);
/*!40000 ALTER TABLE `DETAIL` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LOCALITE`
--

DROP TABLE IF EXISTS `LOCALITE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LOCALITE` (
  `Ville` varchar(20) NOT NULL,
  `Pays` varchar(20) NOT NULL,
  `Departement` int(11) NOT NULL,
  PRIMARY KEY (`Ville`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LOCALITE`
--

LOCK TABLES `LOCALITE` WRITE;
/*!40000 ALTER TABLE `LOCALITE` DISABLE KEYS */;
INSERT INTO `LOCALITE` VALUES ('Bruxelles','Belgique',99),('Caen','France',14),('Geneve','Suisse',99),('Lille','France',59),('Londres','Grande-Bretagne',99),('Lyon','France',69),('Namur','Belgique',99),('Paris','France',75),('Poitiers','France',86),('Rome','Italie',99),('Toulouse','France',31);
/*!40000 ALTER TABLE `LOCALITE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PRODUIT`
--

DROP TABLE IF EXISTS `PRODUIT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PRODUIT` (
  `RefP` varchar(5) NOT NULL,
  `TypeP` varchar(20) NOT NULL,
  `Prix` float(6,2) NOT NULL,
  `QStock` int(11) DEFAULT NULL,
  PRIMARY KEY (`RefP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PRODUIT`
--

LOCK TABLES `PRODUIT` WRITE;
/*!40000 ALTER TABLE `PRODUIT` DISABLE KEYS */;
INSERT INTO `PRODUIT` VALUES ('CH262','Cheville',75.00,45),('CH264','Cheville',120.00,2690),('CH464','Cheville',220.00,450),('CL45','Clou',0.00,105),('CL60','Clou',0.00,95),('PL222','Planche',0.00,230),('PL224','Planche',0.00,185);
/*!40000 ALTER TABLE `PRODUIT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REDUCTION`
--

DROP TABLE IF EXISTS `REDUCTION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REDUCTION` (
  `Code` varchar(30) NOT NULL,
  `Quantite` int(11) NOT NULL,
  `Reduction` float NOT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REDUCTION`
--

LOCK TABLES `REDUCTION` WRITE;
/*!40000 ALTER TABLE `REDUCTION` DISABLE KEYS */;
INSERT INTO `REDUCTION` VALUES ('',0,0),('CH262',0,0),('CH264',200,7),('CH464',100,12.2),('CL45',50,9.5),('CL60',10,6.5),('PL222',120,7.1),('PL224',100,7.12);
/*!40000 ALTER TABLE `REDUCTION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `thumb_url` varchar(255) DEFAULT NULL,
  `image_page_url` varchar(255) DEFAULT NULL,
  `author_name` varchar(255) DEFAULT NULL,
  `author_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'Painting the Sky','2006-08-08 12:56:17','http://farm1.static.flickr.com/61/366959006_94023bb220_s.jpg','http://www.flickr.com/photos/stuckincustoms/366959006/','Trey Ratcliff','http://www.flickr.com/photos/95572727@N00'),(2,'Off with her head! The decapitation of Paris. (La Tour Eiffel)','2006-02-04 10:23:07','http://farm1.static.flickr.com/23/97204589_f70f4f6e25_s.jpg','http://www.flickr.com/photos/stewiedewie/97204589/','Stewart Leiwakabessy','http://www.flickr.com/photos/19883947@N00'),(3,'Eiffel Tower','2008-09-22 13:47:41','http://farm3.static.flickr.com/2662/3770476050_7bc8d27fb2_s.jpg','http://www.flickr.com/photos/pedropac72/3770476050/','Pedro J Pacheco','http://www.flickr.com/photos/23610567@N05'),(4,'Torre Eiffel - Monumento a la Paz','2008-09-19 20:22:24','http://farm4.static.flickr.com/3094/2885920176_72262a6713_s.jpg','http://www.flickr.com/photos/pedropac72/2885920176/','Pedro J Pacheco','http://www.flickr.com/photos/23610567@N05'),(5,'Green Eiffel (400th Wee Planet)','2009-08-16 12:57:36','http://farm3.static.flickr.com/2518/3907891398_039f666171_s.jpg','http://www.flickr.com/photos/gadl/3907891398/','Alexandre Duret-Lutz','http://www.flickr.com/photos/24183489@N00'),(6,'La Tour Eiffel','2008-03-14 20:18:47','http://farm3.static.flickr.com/2076/2346732045_0cbd08956c_s.jpg','http://www.flickr.com/photos/mromega/2346732045/','Javier Cáceres','http://www.flickr.com/photos/8820476@N04'),(7,'Evening at the Park','2006-08-08 00:24:09','http://farm1.static.flickr.com/58/210118173_c8ec555760_s.jpg','http://www.flickr.com/photos/stuckincustoms/210118173/','Trey Ratcliff','http://www.flickr.com/photos/95572727@N00'),(8,'Paris Skyline Eiffel Tower','2006-07-09 06:08:31','http://farm2.static.flickr.com/1185/1047043772_cb85c10ec9_s.jpg','http://www.flickr.com/photos/taylormiles/1047043772/','Taylor Miles','http://www.flickr.com/photos/40068218@N00'),(9,'Eiffel','2008-09-22 13:41:09','http://farm4.static.flickr.com/3498/3780768870_db57e1b9a7_s.jpg','http://www.flickr.com/photos/pedropac72/3780768870/','Pedro J Pacheco','http://www.flickr.com/photos/23610567@N05'),(10,'Paris from Eiffel Tower','2005-10-12 14:42:21','http://farm1.static.flickr.com/48/143951285_62c206fe1a_s.jpg','http://www.flickr.com/photos/pedroqtc/143951285/','Pedro Lopez','http://www.flickr.com/photos/68924180@N00'),(11,'La maison rose de la Butte Montmartre','2004-09-28 14:31:20','http://farm1.static.flickr.com/4/4429672_1e50ce8aaa_s.jpg','http://www.flickr.com/photos/joyoflife/4429672/','Julie Kertesz','http://www.flickr.com/photos/32323502@N00'),(12,'Basilique du Sacré Cœur','2009-02-15 14:46:44','http://farm4.static.flickr.com/3333/3295760816_4ee1b050cd_s.jpg','http://www.flickr.com/photos/solea20/3295760816/','Marie','http://www.flickr.com/photos/15188444@N08'),(13,'Butte Montmartre dans le brume-15','2007-10-02 09:24:23','http://farm2.static.flickr.com/1402/1472421624_872ac8fc76_s.jpg','http://www.flickr.com/photos/joyoflife/1472421624/','Julie Kertesz','http://www.flickr.com/photos/32323502@N00'),(14,'Stairs of Butte Montmartre','2004-09-15 11:15:01','http://farm1.static.flickr.com/4/6610444_d91a29ec4a_s.jpg','http://www.flickr.com/photos/joyoflife/6610444/','Julie Kertesz','http://www.flickr.com/photos/32323502@N00'),(15,'Place du Tertre','2009-02-15 14:19:50','http://farm4.static.flickr.com/3310/3287652402_a02746854c_s.jpg','http://www.flickr.com/photos/solea20/3287652402/','Marie','http://www.flickr.com/photos/15188444@N08'),(16,'Martenmount','2008-02-04 15:10:25','http://farm3.static.flickr.com/2188/2243137760_17993ec0b3_s.jpg','http://www.flickr.com/photos/eole/2243137760/','Éole Wind','http://www.flickr.com/photos/73491156@N00'),(17,'Paris, 18e arrondissement','2008-11-09 12:57:46','http://farm1.static.flickr.com/4/8182500_08b3915766_s.jpg','http://www.flickr.com/photos/erwan/8182500/','Erwan F','http://www.flickr.com/photos/59988389@N00'),(18,'Paris by a snowy morning - Le Sacré cœur','2009-02-02 07:25:52','http://farm4.static.flickr.com/3117/3246239153_5d40f7187a_s.jpg','http://www.flickr.com/photos/ilhangendron/3246239153/','ILhan Gendron','http://www.flickr.com/photos/8362644@N02'),(19,'Au vieux livres - 3','2008-04-05 14:40:21','http://farm3.static.flickr.com/2191/2390294810_d8816a6902_s.jpg','http://www.flickr.com/photos/joyoflife/2390294810/','Julie Kertesz','http://www.flickr.com/photos/32323502@N00'),(20,'Le parapluie bleu','2006-02-19 15:43:50','http://farm1.static.flickr.com/42/105042701_114167d9ae_s.jpg','http://www.flickr.com/photos/groov3/105042701/','Jean-Hugues (Hugo) Roy','http://www.flickr.com/photos/14397812@N00'),(21,'barcode','2006-12-31 17:40:24','http://farm1.static.flickr.com/163/340565398_885ea7d13b_s.jpg','http://www.flickr.com/photos/estherase/340565398/','Esther Simpson','http://www.flickr.com/photos/78364563@N00'),(22,'death comes on silent wings','2007-12-23 15:33:39','http://farm3.static.flickr.com/2157/2137382661_7f43df918a_s.jpg','http://www.flickr.com/photos/estherase/2137382661/','Esther Simpson','http://www.flickr.com/photos/78364563@N00'),(23,'hole','2005-11-07 16:24:12','http://farm1.static.flickr.com/25/60898068_2072ff915c_s.jpg','http://www.flickr.com/photos/estherase/60898068/','Esther Simpson','http://www.flickr.com/photos/78364563@N00'),(24,'layers','2005-04-03 08:00:51','http://farm1.static.flickr.com/7/8309628_b59731c6e0_s.jpg','http://www.flickr.com/photos/estherase/8309628/','Esther Simpson','http://www.flickr.com/photos/78364563@N00'),(25,'not looking well','2007-01-28 16:16:33','http://farm1.static.flickr.com/141/372139357_51f66d5671_s.jpg','http://www.flickr.com/photos/estherase/372139357/','Esther Simpson','http://www.flickr.com/photos/78364563@N00'),(26,'Natural History Museum HDR','2006-11-26 16:55:58','http://farm1.static.flickr.com/148/348916676_551f3ef390_s.jpg','http://www.flickr.com/photos/chough/348916676/','Tom Goskar','http://www.flickr.com/photos/58685748@N00'),(27,'miniature tate modern','2006-01-01 14:00:44','http://farm1.static.flickr.com/36/124977130_98c7af16aa_s.jpg','http://www.flickr.com/photos/jeangenie/124977130/','Jean Burgess','http://www.flickr.com/photos/87984541@N00'),(28,'hand','2005-07-12 20:17:26','http://farm1.static.flickr.com/21/25513758_5c0f55023c_s.jpg','http://www.flickr.com/photos/estherase/25513758/','Esther Simpson','http://www.flickr.com/photos/78364563@N00'),(29,'The Great Court','2007-11-14 12:41:20','http://farm3.static.flickr.com/2235/2059758614_cdd4a3b6d4_s.jpg','http://www.flickr.com/photos/night86mare/2059758614/','night86mare','http://www.flickr.com/photos/38073239@N00'),(30,'stripes','2008-08-27 11:55:39','http://farm3.static.flickr.com/2323/2528745262_f84b2b3ea3_s.jpg','http://www.flickr.com/photos/estherase/2528745262/','Esther Simpson','http://www.flickr.com/photos/78364563@N00'),(31,'A private reception entrance','2006-11-08 00:30:46','http://farm1.static.flickr.com/113/292917043_32f325372f_s.jpg','http://www.flickr.com/photos/eole/292917043/','Éole Wind','http://www.flickr.com/photos/73491156@N00'),(32,'Pyramide ','2008-12-06 10:30:30','http://farm4.static.flickr.com/3069/3090002620_fca88b5b11_s.jpg','http://www.flickr.com/photos/kimdokhac/3090002620/','Kim','http://www.flickr.com/photos/29634818@N08'),(33,'en promenade (new) [DSCF5717]','2009-06-14 20:01:36','http://farm4.static.flickr.com/3606/3635144383_541365fe5c_s.jpg','http://www.flickr.com/photos/inistea/3635144383/','iulian nistea','http://www.flickr.com/photos/33911904@N08'),(34,'','2004-09-13 17:45:26','http://farm4.static.flickr.com/3631/3501865198_26a05c507c_s.jpg','http://www.flickr.com/photos/tozofoto/3501865198/','Zoltán Tóth','http://www.flickr.com/photos/25804543@N05'),(35,'Apol·lo de Màntua (amb la cítara)','2003-01-02 03:40:55','http://farm1.static.flickr.com/190/509970018_b688486ca8_s.jpg','http://www.flickr.com/photos/sebastiagiralt/509970018/','Sebastià Giralt','http://www.flickr.com/photos/14485539@N00'),(36,'kAos','2008-02-08 12:59:51','http://farm3.static.flickr.com/2056/2334207797_c7aefb2d2f_s.jpg','http://www.flickr.com/photos/jazzalnero/2334207797/','rosario gambera','http://www.flickr.com/photos/7659701@N06'),(37,'Love circled','2008-02-08 12:28:42','http://farm3.static.flickr.com/2074/2314810987_8be8f4c39d_s.jpg','http://www.flickr.com/photos/jazzalnero/2314810987/','rosario gambera','http://www.flickr.com/photos/7659701@N06'),(38,'Le Louvre','2008-12-27 23:06:38','http://farm4.static.flickr.com/3238/3146250547_ac4086d202_s.jpg','http://www.flickr.com/photos/bertrande/3146250547/','arnaud bertrande','http://www.flickr.com/photos/22580325@N07'),(39,'Musée du Louvre','2007-02-25 20:34:44','http://farm1.static.flickr.com/146/406108919_930760910d_s.jpg','http://www.flickr.com/photos/gadl/406108919/','Alexandre Duret-Lutz','http://www.flickr.com/photos/24183489@N00'),(40,'10,000 visitas!!','2006-09-25 21:39:02','http://farm1.static.flickr.com/100/252901014_eab1c67fe7_s.jpg','http://www.flickr.com/photos/cakecosas/252901014/','CaKe D','http://www.flickr.com/photos/68217672@N00'),(41,'Autumn waffle','2009-10-11 14:03:57','http://farm3.static.flickr.com/2629/4094336502_f90b9c0c02_s.jpg','http://www.flickr.com/photos/eole/4094336502/','Éole Wind','http://www.flickr.com/photos/73491156@N00'),(42,'Slashes','2009-10-10 22:48:43','http://farm3.static.flickr.com/2759/4091331610_b842425241_s.jpg','http://www.flickr.com/photos/eole/4091331610/','Éole Wind','http://www.flickr.com/photos/73491156@N00'),(43,'Caen - Abbaye aux Hommes','2009-05-18 10:12:36','http://farm3.static.flickr.com/2513/3726223166_4882a3f3fc_s.jpg','http://www.flickr.com/photos/g-alain/3726223166/','Alain Guichard','http://www.flickr.com/photos/23747661@N07'),(44,'CAEN - l\'escalier d\'honneur','2009-05-18 10:09:48','http://farm3.static.flickr.com/2581/3728233743_493f2058e7_s.jpg','http://www.flickr.com/photos/g-alain/3728233743/','Alain Guichard','http://www.flickr.com/photos/23747661@N07'),(45,'[Demi] portrait d\'un homme','2009-10-11 13:10:29','http://farm3.static.flickr.com/2682/4110872136_e40c0e5659_s.jpg','http://www.flickr.com/photos/eole/4110872136/','Éole Wind','http://www.flickr.com/photos/73491156@N00'),(46,'Nuité à Caen','2008-05-05 21:49:33','http://farm4.static.flickr.com/3224/2715135339_be18014ce1_s.jpg','http://www.flickr.com/photos/djof/2715135339/','Etienne Boucher','http://www.flickr.com/photos/10787942@N00'),(47,'Caen - Abbaye aux Hommes','2009-05-18 10:04:23','http://farm4.static.flickr.com/3656/3726222504_5205435fd5_s.jpg','http://www.flickr.com/photos/g-alain/3726222504/','Alain Guichard','http://www.flickr.com/photos/23747661@N07'),(48,'Caen - le cloitre','2009-07-17 09:47:14','http://farm3.static.flickr.com/2546/3729109212_88524c8079_s.jpg','http://www.flickr.com/photos/g-alain/3729109212/','Alain Guichard','http://www.flickr.com/photos/23747661@N07'),(49,'~~~~','2007-11-18 23:00:00','http://farm3.static.flickr.com/2276/1855266237_b3c0f12198_s.jpg','http://www.flickr.com/photos/paco_calvino/1855266237/','Paco CT','http://www.flickr.com/photos/71088059@N00'),(50,'Today menu: Colorful fruit','2007-05-22 13:07:38','http://farm1.static.flickr.com/191/510980270_39ebf725a2_s.jpg','http://www.flickr.com/photos/paco_calvino/510980270/','Paco CT','http://www.flickr.com/photos/71088059@N00'),(51,'Coleguilla - Little fella','2007-05-13 12:46:19','http://farm1.static.flickr.com/191/498197848_78091d56d0_s.jpg','http://www.flickr.com/photos/paco_calvino/498197848/','Paco CT','http://www.flickr.com/photos/71088059@N00'),(52,'Pecado venial','2007-05-22 13:06:32','http://farm1.static.flickr.com/220/509970213_11da1ce303_s.jpg','http://www.flickr.com/photos/paco_calvino/509970213/','Paco CT','http://www.flickr.com/photos/71088059@N00'),(53,'Barcelona Mercè \'07','2007-09-26 11:30:19','http://farm2.static.flickr.com/1372/1442318124_fc1b56fdbd_s.jpg','http://www.flickr.com/photos/letrusco/1442318124/','Piero','http://www.flickr.com/photos/63699055@N00'),(54,'Santa María del Mar II','2007-06-04 23:40:20','http://farm2.static.flickr.com/1254/530552355_b147494036_s.jpg','http://www.flickr.com/photos/paco_calvino/530552355/','Paco CT','http://www.flickr.com/photos/71088059@N00'),(55,'Masia Freixa (1896)','2007-04-26 19:16:54','http://farm1.static.flickr.com/176/474813176_f03072f53c_s.jpg','http://www.flickr.com/photos/paco_calvino/474813176/','Paco CT','http://www.flickr.com/photos/71088059@N00'),(56,'Oì','2008-02-24 13:21:05','http://farm4.static.flickr.com/3033/2289122224_8b96a7a416_s.jpg','http://www.flickr.com/photos/paco_calvino/2289122224/','Paco CT','http://www.flickr.com/photos/71088059@N00'),(57,'Sunny and warm day - Día soleado y suave','2007-03-01 00:00:00','http://farm1.static.flickr.com/159/426542900_d5bf1144f5_s.jpg','http://www.flickr.com/photos/paco_calvino/426542900/','Paco CT','http://www.flickr.com/photos/71088059@N00'),(58,'Vatican Museum Spiral Stairs','2006-06-27 12:24:34','http://farm1.static.flickr.com/74/202549889_5ac726093b_s.jpg','http://www.flickr.com/photos/nathangibbs/202549889/','Nathan Gibbs','http://www.flickr.com/photos/57954193@N00'),(59,'DNA','2004-08-23 15:17:04','http://farm1.static.flickr.com/206/479968659_9eb7e2509b_s.jpg','http://www.flickr.com/photos/theklan/479968659/','Mr. Theklan','http://www.flickr.com/photos/99843959@N00'),(60,'Spiral Staircase','2009-02-16 12:18:49','http://farm4.static.flickr.com/3338/3487502203_8c22c4d1a5_s.jpg','http://www.flickr.com/photos/adebond1/3487502203/','Aidan McManus','http://www.flickr.com/photos/27927417@N03'),(61,'«Eravamo percorsi da impulsi opposti, caldo e gelo e distacco e frenesia; ci sembrava di essere in ritardo su tutto e di essere ancora in tempo per qualsiasi cosa, di andare molto veloci e di restare incollati all\'asfalto.»','2008-06-29 23:08:12','http://farm4.static.flickr.com/3186/2634517514_cc1f6640e0_s.jpg','http://www.flickr.com/photos/tearsandrain/2634517514/','Valentina','http://www.flickr.com/photos/8418112@N04'),(62,'Il colonnato di piazza s. pietro','2009-07-27 21:16:06','http://farm3.static.flickr.com/2497/3791972587_5c591550ca_s.jpg','http://www.flickr.com/photos/pinomoscato/3791972587/','Pyno Moscato','http://www.flickr.com/photos/86989558@N00'),(63,'Vatican Skylight','2006-06-26 11:18:52','http://farm1.static.flickr.com/61/202549642_c5f9607ade_s.jpg','http://www.flickr.com/photos/nathangibbs/202549642/','Nathan Gibbs','http://www.flickr.com/photos/57954193@N00'),(64,'twirltastic','2009-04-24 06:49:24','http://farm3.static.flickr.com/2363/3527331705_635b5a6eea_s.jpg','http://www.flickr.com/photos/swiv/3527331705/','Hannah Swithinbank','http://www.flickr.com/photos/90146022@N00'),(65,'lightening','2009-07-12 16:58:09','http://farm3.static.flickr.com/2663/3889377789_6302f8488d_s.jpg','http://www.flickr.com/photos/latigi/3889377789/','latigi','http://www.flickr.com/photos/12609701@N05'),(66,'piazza san pietro','2009-05-14 20:22:35','http://farm3.static.flickr.com/2122/3531809078_cacf92db05_s.jpg','http://www.flickr.com/photos/pinomoscato/3531809078/','Pyno Moscato','http://www.flickr.com/photos/86989558@N00'),(67,'ship and bridge','2004-12-11 04:11:01','http://farm1.static.flickr.com/2/2130422_a004ac8c71_s.jpg','http://www.flickr.com/photos/jay_que/2130422/','john curley','http://www.flickr.com/photos/33118749@N00'),(68,'San Francisco Bay and The Golden Gate','2007-03-04 17:25:13','http://farm1.static.flickr.com/201/489862235_b869e72aeb_s.jpg','http://www.flickr.com/photos/stuckincustoms/489862235/','Trey Ratcliff','http://www.flickr.com/photos/95572727@N00'),(69,'Golden Sunset','2008-07-05 19:12:30','http://farm4.static.flickr.com/3039/2669948773_472f12f3d7_s.jpg','http://www.flickr.com/photos/romainguy/2669948773/','Romain Guy','http://www.flickr.com/photos/24046097@N00'),(70,'Bay Bridge Sunrise','2007-06-11 06:04:41','http://farm2.static.flickr.com/1335/539049065_0bd9e4fee5_s.jpg','http://www.flickr.com/photos/andy_morris/539049065/','Andy Morris','http://www.flickr.com/photos/63196706@N00'),(71,'Paper Cranes [30/07/09]','2009-07-30 20:16:30','http://farm4.static.flickr.com/3580/3774341860_480e5793f1_s.jpg','http://www.flickr.com/photos/kayveeinc/3774341860/','KayVee.INC','http://www.flickr.com/photos/25678284@N03'),(72,'Monsters','2008-09-03 20:16:38','http://farm4.static.flickr.com/3190/2827072892_12d1e7d98e_s.jpg','http://www.flickr.com/photos/ratio/2827072892/','Adam Lisagor','http://www.flickr.com/photos/51035767733@N01'),(73,'APEX','2006-09-25 08:52:56','http://farm1.static.flickr.com/114/252468877_b7da8d4502_s.jpg','http://www.flickr.com/photos/cassidy/252468877/','Cassidy Curtis','http://www.flickr.com/photos/18619970@N00'),(74,'Concrete Jungle','2007-09-07 00:10:50','http://farm3.static.flickr.com/2148/2354150204_04943282d8_s.jpg','http://www.flickr.com/photos/frankhg/2354150204/','frank','http://www.flickr.com/photos/8087836@N05'),(75,'Flight over Manhattan, New York City','2008-05-25 18:20:06','http://farm3.static.flickr.com/2162/2544722477_f1f88e0a5e_s.jpg','http://www.flickr.com/photos/meironke/2544722477/','Ingo Meironke','http://www.flickr.com/photos/8110030@N05'),(76,'Central Park HDR Pano','2007-05-22 16:29:11','http://farm4.static.flickr.com/3024/2490106389_e291bdff49_s.jpg','http://www.flickr.com/photos/thirtyfootscrew/2490106389/','thirtyfootscrew','http://www.flickr.com/photos/8519457@N04'),(77,'spying on the gates','2005-02-20 16:46:41','http://farm1.static.flickr.com/4/7952327_42eb35a642_s.jpg','http://www.flickr.com/photos/thomwatson/7952327/','Thom Watson','http://www.flickr.com/photos/73621375@N00'),(78,'The Scale of Central Park','2006-05-26 16:52:17','http://farm1.static.flickr.com/46/153977440_3b4c6d916e_s.jpg','http://www.flickr.com/photos/denmar/153977440/','Dennis Marciniak','http://www.flickr.com/photos/74481989@N00'),(79,'Central Park  as dusk falls from the top of Rockefeller Center','2007-03-27 07:33:28','http://farm4.static.flickr.com/3316/3296963388_f850aa254a_s.jpg','http://www.flickr.com/photos/stuckincustoms/3296963388/','Trey Ratcliff','http://www.flickr.com/photos/95572727@N00'),(80,'Upper Lake in New York Central Park','2009-11-28 12:09:08','http://farm3.static.flickr.com/2731/4244282532_449d197676_s.jpg','http://www.flickr.com/photos/werkunz/4244282532/','Werner Kunz','http://www.flickr.com/photos/35375520@N07'),(81,'Wall Street','2007-04-09 20:12:05','http://farm1.static.flickr.com/188/456398100_c151a4b1e8_s.jpg','http://www.flickr.com/photos/stuckincustoms/456398100/','Trey Ratcliff','http://www.flickr.com/photos/95572727@N00'),(82,'Lunch atop a skyscraper','2007-10-11 10:54:13','http://farm3.static.flickr.com/2181/1541256366_3d2771ad1a_s.jpg','http://www.flickr.com/photos/pepe50/1541256366/','Paolo','http://www.flickr.com/photos/12215612@N06'),(83,'gorilla bones','2005-05-19 12:02:06','http://farm1.static.flickr.com/13/14705232_d8dc5c9ae2_s.jpg','http://www.flickr.com/photos/limonada/14705232/','Emilie Eagan','http://www.flickr.com/photos/44124412272@N01'),(84,'Lower Manhattan, New York','2007-07-17 22:11:41','http://farm2.static.flickr.com/1071/870534078_ef3d4bfe2a_s.jpg','http://www.flickr.com/photos/frankhg/870534078/','frank','http://www.flickr.com/photos/8087836@N05'),(85,'bobst library','2005-03-03 13:42:18','http://farm1.static.flickr.com/4/6270210_89b15fb56e_s.jpg','http://www.flickr.com/photos/limonada/6270210/','Emilie Eagan','http://www.flickr.com/photos/44124412272@N01'),(86,'blue moon over manhattan','2007-10-03 18:53:14','http://farm2.static.flickr.com/1126/1480668640_729c576a5e_s.jpg','http://www.flickr.com/photos/atomicshark/1480668640/','Dino Abatzidis','http://www.flickr.com/photos/94507863@N00'),(87,'WTC With Clouds','1986-06-09 16:06:24','http://farm2.static.flickr.com/1308/728752517_3f8afebc5d_s.jpg','http://www.flickr.com/photos/swisscan/728752517/','Reto Fetz','http://www.flickr.com/photos/7578081@N07'),(88,'Flatiron Building','2007-05-30 07:27:26','http://farm3.static.flickr.com/2244/2349786862_fa479d105b_s.jpg','http://www.flickr.com/photos/sunsurfr/2349786862/','sunsurfr','http://www.flickr.com/photos/53139634@N00'),(89,'Another kind of panorama of construction on Fulton Street.','2008-03-18 19:05:07','http://farm4.static.flickr.com/3282/2344617721_6b528b106a_s.jpg','http://www.flickr.com/photos/p0ps/2344617721/','Stephen L Harlow','http://www.flickr.com/photos/23642817@N00'),(90,'The picture in the wall','2008-09-09 16:24:00','http://farm4.static.flickr.com/3246/2845887309_2812397194_s.jpg','http://www.flickr.com/photos/snapsi42/2845887309/','Fabian','http://www.flickr.com/photos/27515494@N02'),(91,'Brandenburg Gate in Berlin','2009-07-16 16:08:24','http://farm4.static.flickr.com/3510/3848863160_d8866c3565_s.jpg','http://www.flickr.com/photos/werkunz/3848863160/','Werner Kunz','http://www.flickr.com/photos/35375520@N07'),(92,'Brandenburg Gate in Berlin','2009-07-16 16:22:24','http://farm3.static.flickr.com/2521/3848859254_84488f6b88_s.jpg','http://www.flickr.com/photos/werkunz/3848859254/','Werner Kunz','http://www.flickr.com/photos/35375520@N07'),(93,'out of the dark','2008-03-23 13:01:59','http://farm4.static.flickr.com/3184/2361095864_ac7672a3b2_s.jpg','http://www.flickr.com/photos/yives/2361095864/','Yves Schiepek','http://www.flickr.com/photos/53756375@N00'),(94,'The Neo Monoliths of Chicago','2006-08-10 01:31:56','http://farm1.static.flickr.com/60/211566219_db7c20f69b_s.jpg','http://www.flickr.com/photos/stuckincustoms/211566219/','Trey Ratcliff','http://www.flickr.com/photos/95572727@N00'),(95,'rot licht (red light)','2007-03-26 16:01:45','http://farm1.static.flickr.com/200/447590901_32de5926c9_s.jpg','http://www.flickr.com/photos/jonask/447590901/','Jonas K.','http://www.flickr.com/photos/67715696@N00'),(96,'Nice\'s lamp','2008-09-01 04:07:11','http://farm4.static.flickr.com/3240/2816343398_d73a15305a_s.jpg','http://www.flickr.com/photos/nataliaromay/2816343398/','Natalia Romay','http://www.flickr.com/photos/9172731@N03'),(97,'it is a green wall','2006-05-21 13:47:30','http://farm1.static.flickr.com/74/153706167_11516befe1_s.jpg','http://www.flickr.com/photos/bright/153706167/','Tal Bright','http://www.flickr.com/photos/48553010@N00'),(98,'go sit in the corner','2006-05-14 16:01:30','http://farm1.static.flickr.com/51/148298674_a95ecbafc6_s.jpg','http://www.flickr.com/photos/bright/148298674/','Tal Bright','http://www.flickr.com/photos/48553010@N00'),(99,'Red Square','2004-10-26 15:00:11','http://farm1.static.flickr.com/43/84459994_f054d26bc2_s.jpg','http://www.flickr.com/photos/mcbadger/84459994/','Dom McIntyre','http://www.flickr.com/photos/49479234@N00'),(100,'Tango Sepia','2007-10-14 14:58:01','http://farm4.static.flickr.com/3170/2298405660_a0e713920e_s.jpg','http://www.flickr.com/photos/pedropac72/2298405660/','Pedro J Pacheco','http://www.flickr.com/photos/23610567@N05'),(101,'Catedral de San Basilio','2007-10-12 12:31:05','http://farm3.static.flickr.com/2214/2369332045_bc0f17f56b_s.jpg','http://www.flickr.com/photos/pedropac72/2369332045/','Pedro J Pacheco','http://www.flickr.com/photos/23610567@N05'),(102,'Russian metro','2007-08-30 22:35:33','http://farm2.static.flickr.com/1338/1278721453_c7c9b07f4e_s.jpg','http://www.flickr.com/photos/eole/1278721453/','Éole Wind','http://www.flickr.com/photos/73491156@N00'),(103,'Hummingbird Moth','2004-07-28 20:27:58','http://farm1.static.flickr.com/43/83142195_79ab5314a6_s.jpg','http://www.flickr.com/photos/rogerlynn/83142195/','Roger Lynn','http://www.flickr.com/photos/17366766@N00'),(104,'Mayakovskaya metro station','2007-08-27 23:54:34','http://farm2.static.flickr.com/1353/1316145314_6e050ef82b_s.jpg','http://www.flickr.com/photos/eole/1316145314/','Éole Wind','http://www.flickr.com/photos/73491156@N00'),(105,'Sunflower Greets the Morning (2)','2006-07-12 07:14:34','http://farm1.static.flickr.com/67/188069794_b42d879b82_s.jpg','http://www.flickr.com/photos/rogerlynn/188069794/','Roger Lynn','http://www.flickr.com/photos/17366766@N00'),(106,'Fluid Reality','2007-01-14 15:28:27','http://farm1.static.flickr.com/187/438041923_edd1675897_s.jpg','http://www.flickr.com/photos/rogerlynn/438041923/','Roger Lynn','http://www.flickr.com/photos/17366766@N00'),(107,'Moscow Red Square','2005-12-07 22:36:03','http://farm1.static.flickr.com/20/72006874_4574f35716_s.jpg','http://www.flickr.com/photos/alexminza/72006874/','Alexander Minza','http://www.flickr.com/photos/60746425@N00'),(108,'Delicate (2)','2007-04-23 13:03:40','http://farm1.static.flickr.com/177/470765168_2b54e8cb38_s.jpg','http://www.flickr.com/photos/rogerlynn/470765168/','Roger Lynn','http://www.flickr.com/photos/17366766@N00');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pandemics`
--

LOCK TABLES `pandemics` WRITE;
/*!40000 ALTER TABLE `pandemics` DISABLE KEYS */;
INSERT INTO `pandemics` VALUES (1,'test','test',-1,'c\'est un test','21806332');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'21806332','$2y$10$qTcYKSUS4wXWQ8OO2Vqt/OXrTErrm.WFvLbvL/DCVyB7qzYPtjFii','user');
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

-- Dump completed on 2020-12-07 16:12:50
