-- MySQL dump 10.16  Distrib 10.1.36-MariaDB, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: db
-- ------------------------------------------------------
-- Server version	10.1.36-MariaDB

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `unique_index` (`admin_email`),
  UNIQUE KEY `unique_index_username` (`admin_username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','tester.stf@gmail.com','admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `all_time_currency`
--

DROP TABLE IF EXISTS `all_time_currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `all_time_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exchange_office_id` int(11) DEFAULT NULL,
  `currency_name` varchar(45) DEFAULT NULL,
  `currency_label` varchar(45) DEFAULT NULL,
  `sell_rate` decimal(6,4) DEFAULT NULL,
  `avg_rate` decimal(6,4) DEFAULT NULL,
  `buy_rate` decimal(6,4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `all_time_currency`
--

LOCK TABLES `all_time_currency` WRITE;
/*!40000 ALTER TABLE `all_time_currency` DISABLE KEYS */;
/*!40000 ALTER TABLE `all_time_currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `currency_label` varchar(45) CHARACTER SET utf8 NOT NULL,
  `currency_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`currency_id`),
  UNIQUE KEY `currency_name_UNIQUE` (`currency_name`),
  UNIQUE KEY `currency_label_UNIQUE` (`currency_label`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` VALUES (1,'Evro','EUR','978'),(2,'Americki Dolar','USD','840'),(3,'Svajcarski Franak','CHF','756'),(4,'Australijski Dolar','AUD','36'),(5,'Kanadski Dolar','CAD','124'),(6,'Hrvatska Kuna','HRK','191'),(7,'Danska Kruna','DKK','208'),(8,'Madjarska Forinta','HUF','348'),(9,'Norveska Kruna','NOK','578'),(10,'Svedska Kruna','SEK','752'),(11,'Funta Sterlinga','GBP','826'),(12,'Konvertibilna Marka','BAM','977'),(13,'Ruska rublja','RUB','643'),(14,'Kineski Juan','CNY','156'),(15,'Japanski Jen','JPY','292'),(16,'Poljski Zlot','PLN','985'),(17,'Turska Lira','TRY','949'),(18,'Ceska Kruna','CZK','203'),(19,'Kuvajtski Dinar','KWD','414'),(20,'Rumunski Lej','RON','946'),(21,'Bugarski Lev','BGN','975');
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency_list`
--

DROP TABLE IF EXISTS `currency_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency_list` (
  `currency_list_id` int(11) NOT NULL AUTO_INCREMENT,
  `exchange_office_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `sell_rate` decimal(10,4) NOT NULL,
  `avg_rate` decimal(10,4) NOT NULL,
  `buy_rate` decimal(10,4) NOT NULL,
  `diff_24h` decimal(10,4) DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`currency_list_id`),
  UNIQUE KEY `unique_index_currency_list` (`currency_id`,`exchange_office_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency_list`
--

LOCK TABLES `currency_list` WRITE;
/*!40000 ALTER TABLE `currency_list` DISABLE KEYS */;
INSERT INTO `currency_list` VALUES (1,1000,1,118.0000,118.2728,118.4000,NULL,'2018-11-04'),(2,1000,4,73.6000,74.9511,75.5000,NULL,'2018-11-04'),(3,1000,5,78.1000,79.1811,80.0000,NULL,'2018-11-04'),(4,1000,14,14.3754,14.9792,15.0300,NULL,'2018-11-04'),(5,1000,6,15.5800,15.8999,15.9100,NULL,'2018-11-04'),(6,1000,18,4.3456,4.5780,4.5800,NULL,'2018-11-04'),(7,1000,7,15.6300,15.8502,15.8600,NULL,'2018-11-04'),(8,1000,8,35.9200,36.6612,36.7500,NULL,'2018-11-04'),(9,1000,15,88.8000,91.5920,92.5000,NULL,'2018-11-04'),(10,1000,9,12.2400,12.4261,12.4300,NULL,'2018-11-04'),(11,1000,13,1.4744,1.5782,1.6000,NULL,'2018-11-04'),(12,1000,10,11.3100,11.4749,11.4700,NULL,'2018-11-04'),(13,1000,3,103.0000,103.3401,103.9000,NULL,'2018-11-04'),(14,1000,11,133.0000,134.6304,135.5000,NULL,'2018-11-04'),(15,1000,2,103.3000,103.5211,104.3000,NULL,'2018-11-04'),(16,1000,12,60.0000,60.4719,60.8000,NULL,'2018-11-04'),(17,1000,16,26.0154,27.3805,27.3800,NULL,'2018-11-04'),(18,1000,17,16.9847,18.8297,20.1300,NULL,'2018-11-04'),(19,1002,1,115.3160,118.2728,119.8103,NULL,'2018-11-04'),(20,1002,2,99.8979,103.5211,105.5915,NULL,'2018-11-04'),(21,1002,3,98.1731,103.3401,104.6835,NULL,'2018-11-04'),(22,1002,11,129.9183,134.6304,137.3230,NULL,'2018-11-04'),(23,1002,4,72.3278,74.9511,76.4501,NULL,'2018-11-04'),(24,1002,13,1.4204,1.5782,1.7360,NULL,'2018-11-04'),(25,1002,10,11.0733,11.4749,11.7044,NULL,'2018-11-04'),(26,1002,5,76.4098,79.1811,80.7647,NULL,'2018-11-04'),(27,1002,7,15.2954,15.8502,16.1672,NULL,'2018-11-04'),(28,1002,15,88.3863,91.5920,93.4238,NULL,'2018-11-04'),(29,1002,9,11.9912,12.4261,12.6746,NULL,'2018-11-04'),(30,1003,1,118.0000,118.2700,118.7000,NULL,'2018-11-04'),(31,1003,4,73.4000,74.9500,75.9000,NULL,'2018-11-04'),(32,1003,5,77.5000,79.1800,80.1000,NULL,'2018-11-04'),(33,1003,7,15.4000,15.8800,16.1000,NULL,'2018-11-04'),(34,1003,9,12.0000,12.4200,12.7000,NULL,'2018-11-04'),(35,1003,10,11.1000,11.4700,11.7000,NULL,'2018-11-04'),(36,1003,3,102.0000,103.3400,105.0000,NULL,'2018-11-04'),(37,1003,11,132.0000,134.6300,136.0000,NULL,'2018-11-04'),(38,1003,2,102.0000,103.5200,105.5000,NULL,'2018-11-04'),(39,1003,12,59.5000,60.4700,60.6000,NULL,'2018-11-04'),(40,1003,13,1.4500,1.5700,1.6000,NULL,'2018-11-04'),(41,1003,6,15.0000,15.8900,16.2000,NULL,'2018-11-04'),(42,1001,1,118.0000,118.5000,118.5000,NULL,'2018-11-04'),(43,1001,2,103.0000,104.5000,104.5000,NULL,'2018-11-04'),(44,1001,3,102.5000,104.3000,104.3000,NULL,'2018-11-04'),(45,1001,11,133.0000,135.5000,135.5000,NULL,'2018-11-04'),(46,1001,4,73.1000,76.5000,76.5000,NULL,'2018-11-04'),(47,1001,12,59.5000,60.8000,60.8000,NULL,'2018-11-04'),(48,1001,7,15.4600,16.2500,16.2500,NULL,'2018-11-04'),(49,1001,5,77.3000,81.0000,81.0000,NULL,'2018-11-04'),(50,1001,9,12.1200,12.7000,12.7000,NULL,'2018-11-04'),(51,1001,13,1.4300,1.7000,1.7000,NULL,'2018-11-04'),(52,1001,10,11.1900,11.7000,11.7000,NULL,'2018-11-04'),(53,1004,4,72.4276,74.2847,76.1418,NULL,'2018-11-01'),(54,1004,12,58.9729,60.4850,61.9971,NULL,'2018-11-01'),(55,1004,7,15.4536,15.8498,16.2460,NULL,'2018-11-01'),(56,1004,1,115.9324,118.2984,120.6644,NULL,'2018-11-01'),(57,1004,15,90.0820,92.3918,94.7016,NULL,'2018-11-01'),(58,1004,5,77.3374,79.3204,81.3034,NULL,'2018-11-01'),(59,1004,14,14.1467,14.9701,15.7935,NULL,'2018-11-01'),(60,1004,9,12.0910,12.4010,12.7110,NULL,'2018-11-01'),(61,1004,13,1.4289,1.5877,1.7147,NULL,'2018-11-01'),(62,1004,2,101.7116,104.3196,106.9276,NULL,'2018-11-01'),(63,1004,3,97.9085,103.6069,109.3053,NULL,'2018-11-01'),(64,1004,10,11.1324,11.4178,11.7032,NULL,'2018-11-01'),(65,1004,11,130.5648,133.9126,137.2604,NULL,'2018-11-01'),(68,1005,3,99.0896,103.3401,107.5812,NULL,'2018-11-04'),(69,1005,11,127.8989,134.6304,141.3619,NULL,'2018-11-04'),(70,1005,2,100.2648,103.5211,106.7774,NULL,'2018-11-04'),(71,1005,1,115.3751,118.2728,120.5791,NULL,'2018-11-04'),(72,1,1,0.0000,118.2700,0.0000,NULL,'0000-00-00'),(73,1,2,0.0000,103.5200,0.0000,NULL,'0000-00-00'),(74,1,3,0.0000,103.3400,0.0000,NULL,'0000-00-00'),(75,1,4,0.0000,74.9500,0.0000,NULL,'0000-00-00'),(76,1,5,0.0000,79.1800,0.0000,NULL,'0000-00-00'),(77,1,6,0.0000,15.9000,0.0000,NULL,'0000-00-00'),(78,1,7,0.0000,15.8500,0.0000,NULL,'0000-00-00'),(79,1,8,0.0000,0.3700,0.0000,NULL,'0000-00-00'),(80,1,9,0.0000,12.4300,0.0000,NULL,'0000-00-00'),(81,1,10,0.0000,11.4700,0.0000,NULL,'0000-00-00'),(82,1,11,0.0000,134.6300,0.0000,NULL,'0000-00-00'),(83,1,12,0.0000,60.4700,0.0000,NULL,'0000-00-00'),(84,1,13,0.0000,1.5800,0.0000,NULL,'0000-00-00'),(85,1,14,0.0000,14.9800,0.0000,NULL,'0000-00-00'),(86,1,15,0.0000,0.9200,0.0000,NULL,'0000-00-00'),(87,1,16,0.0000,27.3800,0.0000,NULL,'0000-00-00'),(88,1,18,0.0000,4.5800,0.0000,NULL,'0000-00-00'),(89,2,1,123.2130,118.2728,123.1230,NULL,'2018-11-30'),(90,2,2,123.0000,103.5211,123.1230,NULL,'2018-11-30'),(91,2,3,0.0000,103.3401,0.0000,NULL,'2018-11-30'),(92,2,11,0.0000,134.6304,0.0000,NULL,'2018-11-30'),(93,2,4,0.0000,74.9511,0.0000,NULL,'2018-11-30'),(94,2,5,0.0000,79.1811,0.0000,NULL,'2018-11-30'),(95,2,7,0.0000,15.8502,0.0000,NULL,'2018-11-30'),(96,2,15,0.0000,91.5920,0.0000,NULL,'2018-11-30'),(97,2,9,0.0000,12.4261,0.0000,NULL,'2018-11-30'),(98,2,13,0.0000,1.5782,0.0000,NULL,'2018-11-30'),(99,2,10,0.0000,11.4749,0.0000,NULL,'2018-11-30');
/*!40000 ALTER TABLE `currency_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exchange_office`
--

DROP TABLE IF EXISTS `exchange_office`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exchange_office` (
  `exchange_office_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `exchange_office_name` varchar(45) NOT NULL,
  `exchange_office_phone` varchar(45) NOT NULL,
  `exchange_office_email` varchar(45) NOT NULL,
  `exchange_office_pib` varchar(45) NOT NULL,
  `exchange_office_jmb` varchar(45) NOT NULL,
  PRIMARY KEY (`exchange_office_id`),
  UNIQUE KEY `exchange_office_name_UNIQUE` (`exchange_office_name`),
  UNIQUE KEY `exchange_office_phone_UNIQUE` (`exchange_office_phone`),
  UNIQUE KEY `exchange_office_email_UNIQUE` (`exchange_office_email`)
) ENGINE=InnoDB AUTO_INCREMENT=1013 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exchange_office`
--

LOCK TABLES `exchange_office` WRITE;
/*!40000 ALTER TABLE `exchange_office` DISABLE KEYS */;
INSERT INTO `exchange_office` VALUES (1,3,'sdgsdgsd','+38136356','sdfsd@sdf.com','1','1'),(2,4,'Erste bank','+381 60 48 48 000','info@erstebank.rs','2','2'),(1000,5,'Trange Frange menjacnica','+381 11 244 44 48','trangefrangebeograd@gmail.com','3','3'),(1001,0,'Dok menjacnica','+381 63 222 936','dok.mak@sezampro.rs','4','4'),(1002,0,'Raiffeisen banka','+381 11 3202 100','info@raiffeisenbank.rs','5','5'),(1003,0,'Paris menjacnica','+381 63 236 386','studioexterni@gmail.com','6','6'),(1004,0,'Komercijalna banka','+381 11 20 18 600','kontakt.centar@kombank.rs','7','7'),(1005,0,'AIK banka','+381 11 785 9999','info@aikbank.rs','8','8'),(1006,0,'Nelli Menjacnica','112 1232','nelli@gmail.com','1231231231','1231231231231'),(1010,15,'La Pier','+38111 2500 122','pier@gmail.com','1234567890','1234567891231'),(1011,16,'sdfsd','+381346346','tamar@hotmail.com','444533333','45454888'),(1012,17,'sdgsdg','+3814645645','sdf@asf.asd','111111111','11111111');
/*!40000 ALTER TABLE `exchange_office` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exchange_office_location`
--

DROP TABLE IF EXISTS `exchange_office_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exchange_office_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `exchange_office_id` int(11) NOT NULL,
  `exchange_office_location` varchar(45) NOT NULL,
  `exchange_office_lat` varchar(45) NOT NULL,
  `exchange_office_lon` varchar(45) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=386 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exchange_office_location`
--

LOCK TABLES `exchange_office_location` WRITE;
/*!40000 ALTER TABLE `exchange_office_location` DISABLE KEYS */;
INSERT INTO `exchange_office_location` VALUES (1,2,'Resavska 2','',''),(2,2,'Dunavski kej 11','',''),(3,1000,'Bulevar Zorana Djindjica','',''),(4,1000,'Vojvode Stepe 61','',''),(5,1000,'Beogradski sajam','',''),(6,1001,'Save Maskovica 7','',''),(7,1001,'Jurija Gagarina 231/3','',''),(8,1001,'Bulevar despota Stefana 47','',''),(9,1001,'Rableova 1','',''),(10,1001,'Trg Branka Radicevica 3','',''),(11,1001,'Bulevar kralja Aleksandra 239','',''),(12,1001,'Vojislava Ilica 141j','',''),(13,1001,'Terazije 12','',''),(14,1003,'Brankova 9','',''),(15,1003,'Resavska 34','',''),(16,1003,'Glavna 10','',''),(17,1003,'Marsala Birjuzova 2-4','',''),(18,1003,'Glavna 18','',''),(19,1003,'Jurija Gagarina 87','',''),(20,1003,'Autoput e70','',''),(21,1001,'Makedonska 28','',''),(22,1000,'Hadzi Djerina 27','',''),(42,1002,'Crnotavska 7-9','',''),(43,1002,'Crnotavska 17','',''),(44,1002,'27. Marta 31','',''),(45,1002,'Aerodrom Nikola Tesla','',''),(46,1002,'Balkanska 1','',''),(47,1002,'Brace Srnic 3b','',''),(48,1002,'Bratstva jedinstva 73','',''),(49,1002,'Bulevar kralja Aleksandra 171','',''),(50,1002,'Bulevar kralja Aleksandra 328','',''),(51,1002,'Bulevar Mihajla Pupina 10k','',''),(52,1002,'Bulevar Mihajla Pupina 181','',''),(53,1002,'Bulevar Mihajla Pupina 4','',''),(54,1002,'Bulevar Oslobodjenja 56a','',''),(55,1002,'Bulevar Oslobodjenja 7-9','',''),(56,1002,'Bulevar Umetnosti 4','',''),(57,1002,'Bulevar vojvode Misica 37','',''),(58,1002,'Bulevar Zorana Djindjica 64a','',''),(59,1002,'Cara Dusana 78','',''),(60,1002,'Jurija Gagarina 151','',''),(61,1002,'Jurija Gagarina 16','',''),(62,1002,'Jurija Gagarina BB','',''),(63,1002,'Kneza Mihajla 6','',''),(64,1004,'Svetog Save 14','',''),(65,1004,'Petra Martinovica 37','',''),(66,1004,'Svetosavska 20','',''),(67,1004,'27. Marta 7','',''),(68,1004,'Andre Nikolica 3','',''),(69,1004,'Bircaninova 34','',''),(70,1004,'Blagoja Parovica','',''),(71,1004,'Brankova 34','',''),(72,1004,'Bulevar kralja Aleksandra 251','',''),(73,1004,'Bulevar kralja Aleksandra 328','',''),(74,1004,'Cara Dusana 62-64','',''),(75,1004,'Cvijiceva 93a','',''),(76,1004,'Knez Mihajlova 35','',''),(77,1004,'Kneza Milosa 4','',''),(78,1004,'Kneza Milosa 83','',''),(79,1004,'Kneza Viseslava 118','',''),(80,1004,'Kozacinskog 2','',''),(81,1004,'Kralja Petra 19','',''),(82,1004,'Ljermontova 12a','',''),(83,1004,'Luke Vojvodica 77a','',''),(84,1004,'Makedonska 29','',''),(85,1004,'Makedonska 32','',''),(86,1004,'Makenzijeva 43','',''),(87,1004,'Ruzveltova 41-45','',''),(88,1004,'Savska 35','',''),(89,1004,'Trg Nikole Pasica 2','',''),(90,1004,'Trg Nikole Pasica 7','',''),(91,1004,'Bulevar Oslobodjenja 9','',''),(92,1004,'Bulevar Mihajla Pupina 10a','',''),(93,1004,'Bulevar Zorana Djindjica 45a','',''),(94,1004,'Goce Delceva 36','',''),(95,1005,'Bulevar Mihajla Pupina 115','',''),(96,1005,'Bulevar kralja Aleksandra 334','',''),(97,1005,'Knez Mihajlova 10','',''),(98,1005,'Kralja Milana 43','',''),(99,1005,'Pozeska 93','',''),(100,1005,'Balkanska 20','',''),(101,1005,'Kraljice Marije 73','',''),(382,1011,'sdfsdf','',''),(383,1012,'sdfsd','',''),(384,1,'ascasc','',''),(385,1,'dsvsds','','');
/*!40000 ALTER TABLE `exchange_office_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exchange_office_package`
--

DROP TABLE IF EXISTS `exchange_office_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exchange_office_package` (
  `exchange_office_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `activation` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`exchange_office_id`,`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exchange_office_package`
--

LOCK TABLES `exchange_office_package` WRITE;
/*!40000 ALTER TABLE `exchange_office_package` DISABLE KEYS */;
/*!40000 ALTER TABLE `exchange_office_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exchange_office_work_hours`
--

DROP TABLE IF EXISTS `exchange_office_work_hours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exchange_office_work_hours` (
  `work_hours_id` int(11) NOT NULL AUTO_INCREMENT,
  `exchange_office_id` int(11) DEFAULT NULL,
  `exchange_office_location_id` int(11) DEFAULT NULL,
  `monday_to_friday` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `saturday` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sunday` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`work_hours_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exchange_office_work_hours`
--

LOCK TABLES `exchange_office_work_hours` WRITE;
/*!40000 ALTER TABLE `exchange_office_work_hours` DISABLE KEYS */;
/*!40000 ALTER TABLE `exchange_office_work_hours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `package_price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package`
--

LOCK TABLES `package` WRITE;
/*!40000 ALTER TABLE `package` DISABLE KEYS */;
INSERT INTO `package` VALUES (1,200),(2,350),(3,600),(4,80);
/*!40000 ALTER TABLE `package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Petar','Stefanovic','petar.stf@gmail.com','admin1','123123'),(2,'Tamara','Dragovic','tamara995dragovic@gmail.com','admin2','456456'),(3,'Milan','Savic','mulan@gmail.com','mulantex','111111'),(4,'Marija','Markovic','makica@hotmail.com','makica','123123'),(5,'Saska','Kostic','saskica@yahoo.com','saskica','333333'),(6,'Pipi','DugaCarapa','pipi@gmail.com','pipi','123123'),(7,'','','neli@gmail.com','Nelli','123123'),(15,'','','pier@gmail.com','La Pier','123123'),(16,'','','dfg@dfgdzfg.com','dfdfgdfg','123'),(17,'','','ssd@sdfs.com','dfgdsg','123');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-09  0:12:53
