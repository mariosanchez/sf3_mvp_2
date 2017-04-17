-- MySQL dump 10.13  Distrib 5.7.13, for linux-glibc2.5 (x86_64)
--
-- Host: 172.17.0.1    Database: symfony
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `beer`
--

DROP TABLE IF EXISTS `beer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brewery` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `style` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `score` decimal(7,5) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `photo` longtext COLLATE utf8_unicode_ci NOT NULL,
  `abv` decimal(4,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beer`
--

LOCK TABLES `beer` WRITE;
/*!40000 ALTER TABLE `beer` DISABLE KEYS */;
INSERT INTO `beer` VALUES (1,'Punk IPA','BrewDog','Indian Pale Ale','UK',7.06250,'2017-02-27 19:47:56','2017-02-27 19:47:56','http://www.cervezus.com/image/cache/data/botellas/escocesa%20/cerveza-brewdog%20punk%20ipa-botella.jpg-900x900.jpg',5.60),(2,'Ruination 2.0','Stone','Double IPA','US',9.50000,'2017-03-01 18:12:26','2017-03-01 18:12:26','http://www.labirratorium.com/3067-large_default/stone-ruination.jpg',8.50),(3,'Black Rock','Naparbier','Imperial Porter','ES',9.00000,'2017-03-01 18:14:34','2017-03-01 18:14:34','https://www.beergium.com/3407-thickbox_default/naparbier-black-rock-33cl.jpg',9.00),(4,'Even more Jesus','Evil Twin','Imperial Stout','US',9.50000,'2017-03-05 17:32:28','2017-03-05 17:32:28','https://www.beergium.com/4858-thickbox_default/evil-twin-even-more-jesus-65cl.jpg',12.00),(6,'Gamma Ray','Beavertown','American Pale Ale','UK',7.75000,'2017-04-15 18:15:21','2017-04-15 18:15:21','http://cdn.shopify.com/s/files/1/0397/3509/products/70ad35a3974fea4675fc4cb8846cdd34f8568ce6_1024x1024.jpg',5.40),(7,'Jai Alai India Pale Ale','Cigar City','Indian Pale Ale','US',8.75000,'2017-04-15 20:14:18','2017-04-15 20:14:18','https://static.shoplightspeed.com/shops/609604/files/003429592/cigar-city-jai-alai-ipa-12oz-sgl.jpg',7.50),(9,'Citra Ass Down','Against the Grain','Duoble IPA','US',10.00000,'2017-04-17 19:11:21','2017-04-17 19:11:21','http://www.handfamilycompanies.com/filebin/images/product_images/citraass.jpg',8.20);
/*!40000 ALTER TABLE `beer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-17 21:30:32
