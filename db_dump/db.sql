-- MySQL dump 10.13  Distrib 5.5.28, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: g44
-- ------------------------------------------------------
-- Server version	5.5.28-1

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
-- Table structure for table `bank_accounts`
--

DROP TABLE IF EXISTS `bank_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_accounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `type` enum('Credit','Deposit','Card','Account') DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `bank_id` int(10) DEFAULT NULL,
  `currency` char(3) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `created` int(10) DEFAULT NULL,
  `deleted` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_accounts`
--

LOCK TABLES `bank_accounts` WRITE;
/*!40000 ALTER TABLE `bank_accounts` DISABLE KEYS */;
INSERT INTO `bank_accounts` VALUES (43,'7702070b7e54e81d44163c6e055d2901','1111','Account','1111',43,'UAH',0,1359826803,NULL),(44,'7702070b7e54e81d44163c6e055d2901','Test Credit','Credit','Test Credit Description',44,'UAH',0,1359840243,NULL),(45,'7702070b7e54e81d44163c6e055d2901','Test Card Name','Card','Test Card Description',45,'UAH',0,1359843766,NULL),(46,'7702070b7e54e81d44163c6e055d2901','2222','Credit','2222',46,'UAH',0,1359913940,NULL),(47,'7702070b7e54e81d44163c6e055d2901','3333','Card','3333',47,'UAH',0,1359970930,NULL),(48,'7702070b7e54e81d44163c6e055d2901','4444','Credit','4444',48,'UAH',0,1359970965,NULL),(49,'7702070b7e54e81d44163c6e055d2901','5555','Card','5555',49,'UAH',0,1359970990,NULL),(50,'7702070b7e54e81d44163c6e055d2901','6666','Credit','6666',50,'UAH',0,1359971070,NULL),(51,'7702070b7e54e81d44163c6e055d2901','7777','Account','7777',51,'UAH',0,1359971101,NULL),(52,'7702070b7e54e81d44163c6e055d2901','8888','Credit','8888',52,'UAH',0,1359971191,NULL),(53,'7702070b7e54e81d44163c6e055d2901','8899','Credit','8899',53,'UAH',0,1359971291,NULL),(54,'7702070b7e54e81d44163c6e055d2901','9988','Card','9988',54,'UAH',0,1359971305,NULL),(56,'29820da55996a4907d3f60c42fe6557a','SuperCard','Card','тупокарточка',56,'UAH',0,1359976031,NULL),(57,'016ae8e9679c420a976a8ff90d60bacd','USD GOLD CARD','Card','10% per month',57,'USD',0,1360077557,NULL),(58,'7702070b7e54e81d44163c6e055d2901','1111','Credit','1111',58,'UAH',0,1360436166,NULL),(59,'7702070b7e54e81d44163c6e055d2901','2222','Deposit','2222',59,'UAH',0,1360436178,NULL),(60,'7702070b7e54e81d44163c6e055d2901','3333','Deposit','3333',60,'UAH',0,1360436189,NULL),(61,'7702070b7e54e81d44163c6e055d2901','4444','Account','4444',61,'UAH',0,1360436200,NULL),(62,'7702070b7e54e81d44163c6e055d2901','5555','Card','22222',62,'UAH',0,1360437040,NULL),(63,'7702070b7e54e81d44163c6e055d2901','8888','Credit','8888',63,'UAH',0,1360508426,NULL),(64,'7702070b7e54e81d44163c6e055d2901','test deposit','Deposit','test deposit',64,'UAH',0,1360508481,NULL),(65,'7702070b7e54e81d44163c6e055d2901','1111','Credit','1111',65,'UAH',0,1360509574,NULL),(66,'7702070b7e54e81d44163c6e055d2901','test','Credit','test',66,'UAH',0,1360509842,NULL),(67,'7702070b7e54e81d44163c6e055d2901','1111','Credit','1111',67,'UAH',0,1360510374,NULL),(68,'7702070b7e54e81d44163c6e055d2901','trololo','Account','qwe qweasd',68,'UAH',0,1360510892,NULL);
/*!40000 ALTER TABLE `bank_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_accounts_activity`
--

DROP TABLE IF EXISTS `bank_accounts_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_accounts_activity` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bank_account_id` int(10) DEFAULT NULL,
  `action` enum('In','Out','Dep_Perc') DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `date` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_account_id` (`bank_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_accounts_activity`
--

LOCK TABLES `bank_accounts_activity` WRITE;
/*!40000 ALTER TABLE `bank_accounts_activity` DISABLE KEYS */;
INSERT INTO `bank_accounts_activity` VALUES (1,54,'In','9988','9988',1360154819),(2,61,'In','100','qwewdas asda',1360436736),(3,64,'In','5000','first pay',1360508498),(4,65,'In','111','6546546',1360509583),(5,66,'In','111222','wqweasd asdas',1360509851),(6,62,'In','1234','123123',1360510077),(7,67,'In','1111','1111',1360510384),(8,68,'In','1234','descrtipt trolo',1360510908);
/*!40000 ALTER TABLE `bank_accounts_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_card_accounts`
--

DROP TABLE IF EXISTS `bank_card_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_card_accounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bank_account_id` int(10) DEFAULT NULL,
  `card_type` enum('Visa','MasterCard','Maestro') DEFAULT NULL,
  `card_trunk` int(4) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_card_accounts`
--

LOCK TABLES `bank_card_accounts` WRITE;
/*!40000 ALTER TABLE `bank_card_accounts` DISABLE KEYS */;
INSERT INTO `bank_card_accounts` VALUES (8,45,'Visa',1111,1359843766),(9,47,'',0,1359970930),(10,49,'',0,1359970990),(11,54,'MasterCard',1111,1359971305),(12,55,'MasterCard',3915,1359975669),(13,56,'MasterCard',3915,1359976031),(14,57,'Visa',1234,1360077557),(15,62,'Visa',5555,1360437040);
/*!40000 ALTER TABLE `bank_card_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_list`
--

DROP TABLE IF EXISTS `bank_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `deleted` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_list`
--

LOCK TABLES `bank_list` WRITE;
/*!40000 ALTER TABLE `bank_list` DISABLE KEYS */;
INSERT INTO `bank_list` VALUES (43,'7702070b7e54e81d44163c6e055d2901','1111',1359826803,NULL),(44,'7702070b7e54e81d44163c6e055d2901','Test Credit Bank',1359840243,NULL),(45,'7702070b7e54e81d44163c6e055d2901','Test Card Bank',1359843766,NULL),(46,'7702070b7e54e81d44163c6e055d2901','2222',1359913940,NULL),(47,'7702070b7e54e81d44163c6e055d2901','3333',1359970930,NULL),(48,'7702070b7e54e81d44163c6e055d2901','4444',1359970965,NULL),(49,'7702070b7e54e81d44163c6e055d2901','5555',1359970990,NULL),(50,'7702070b7e54e81d44163c6e055d2901','6666',1359971070,NULL),(51,'7702070b7e54e81d44163c6e055d2901','7777',1359971101,NULL),(52,'7702070b7e54e81d44163c6e055d2901','8888',1359971191,NULL),(53,'7702070b7e54e81d44163c6e055d2901','8899',1359971291,NULL),(54,'7702070b7e54e81d44163c6e055d2901','9988',1359971305,NULL),(56,'29820da55996a4907d3f60c42fe6557a','ПриватБанк',1359976031,NULL),(57,'016ae8e9679c420a976a8ff90d60bacd','Delta',1360077557,NULL),(58,'7702070b7e54e81d44163c6e055d2901','1111',1360436166,NULL),(59,'7702070b7e54e81d44163c6e055d2901','2222',1360436178,NULL),(60,'7702070b7e54e81d44163c6e055d2901','3333',1360436189,NULL),(61,'7702070b7e54e81d44163c6e055d2901','4444',1360436200,NULL),(62,'7702070b7e54e81d44163c6e055d2901','2222',1360437040,NULL),(63,'7702070b7e54e81d44163c6e055d2901','8888',1360508426,NULL),(64,'7702070b7e54e81d44163c6e055d2901','test bank',1360508481,NULL),(65,'7702070b7e54e81d44163c6e055d2901','1111',1360509574,NULL),(66,'7702070b7e54e81d44163c6e055d2901','test',1360509842,NULL),(67,'7702070b7e54e81d44163c6e055d2901','1111',1360510374,NULL),(68,'7702070b7e54e81d44163c6e055d2901','qwewe',1360510892,NULL);
/*!40000 ALTER TABLE `bank_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `currency` varchar(10) DEFAULT NULL,
  `short` char(3) DEFAULT NULL,
  `symbol` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exchanges`
--

DROP TABLE IF EXISTS `exchanges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exchanges` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) DEFAULT NULL,
  `revenue_id` int(10) DEFAULT NULL,
  `expense_id` int(10) DEFAULT NULL,
  `rate` varchar(10) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `date` int(10) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `modified` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `revenue_id` (`revenue_id`),
  KEY `expense_id` (`expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exchanges`
--

LOCK TABLES `exchanges` WRITE;
/*!40000 ALTER TABLE `exchanges` DISABLE KEYS */;
INSERT INTO `exchanges` VALUES (38,'7702070b7e54e81d44163c6e055d2901',51,32,'','Exchanged   to   with rate ',1358719200,1358767237,NULL),(39,'7702070b7e54e81d44163c6e055d2901',52,33,'','Exchanged   to   with rate ',1358719200,1358767271,NULL),(40,'7702070b7e54e81d44163c6e055d2901',53,34,'1.99502487','Exchanged 200500 UAH to 100500 USD with rate 1.9950248756219',1358719200,1358767354,NULL),(41,'7702070b7e54e81d44163c6e055d2901',54,35,'1.99502487','Exchanged 200500 UAH to 100500 USD with rate 1.9950248756219',1358719200,1358767441,NULL),(42,'7702070b7e54e81d44163c6e055d2901',55,36,'0.50124688','Exchanged 100500 UAH to 200500 USD with rate 0.50124688279302',1358719200,1358767494,NULL),(43,'7702070b7e54e81d44163c6e055d2901',56,37,'1.99502487','Exchanged 200500 UAH to 100500 USD with rate 1.9950248756219',1358719200,1358767539,NULL),(44,'7702070b7e54e81d44163c6e055d2901',57,38,'0.2','Exchanged 1 UAH to 5 USD with rate 0.2',1358719200,1358767885,NULL),(45,'7702070b7e54e81d44163c6e055d2901',58,39,'0.5','Exchanged 1 UAH to 2 USD with rate 0.5',1358719200,1358767935,NULL),(46,'7702070b7e54e81d44163c6e055d2901',59,40,'0.71428571','Exchanged 5 UAH to 7 USD with rate 0.71428571428571',1358719200,1358768122,NULL),(47,'7702070b7e54e81d44163c6e055d2901',60,41,'0.71428571','test description (Exchanged 5 UAH to 7 USD with rate 0.71428571428571)',1358719200,1358768134,NULL),(48,'016ae8e9679c420a976a8ff90d60bacd',61,42,'0.125','Обмін для придбання цукерок (Exchanged 10 USD to 80 UAH with rate 0.125)',1358719200,1358768256,NULL),(49,'016ae8e9679c420a976a8ff90d60bacd',62,43,'0.125','Exchanged 10 USD to 80 UAH with rate 0.125',1358719200,1358768305,NULL),(50,'7702070b7e54e81d44163c6e055d2901',63,44,'0.12285012','Exchanged 100 USD to 814 UAH with rate 0.12285012285012',1358719200,1358768694,NULL),(51,'7702070b7e54e81d44163c6e055d2901',70,50,'1.125','ololo trololo boohaha (Exchanged 999 UAH to 888 USD with rate 1.125)',1358892000,1358893454,NULL),(52,'7702070b7e54e81d44163c6e055d2901',71,51,'0.875','Exchanged 777 UAH to 888 USD with rate 0.875 UAH to 1 USD',1358892000,1358893621,NULL),(53,'7702070b7e54e81d44163c6e055d2901',72,52,'0.12210012','Exchanged 300 USD to 2457 UAH with rate 0.12210012210012 USD to 1 UAH',1358892000,1358893680,NULL),(54,'7702070b7e54e81d44163c6e055d2901',73,53,'50.4545454','hello world (Exchanged 555 UAH to 11 USD with rate 50.454545454545 UAH to 1 USD)',1358892000,1358893832,NULL),(55,'7702070b7e54e81d44163c6e055d2901',74,54,'0.50124688','sss wwwe rrrr (Exchanged 100500 USD to 200500 UAH with rate 0.50124688279302 USD to 1 UAH)',1358892000,1358934521,NULL),(56,'7702070b7e54e81d44163c6e055d2901',75,55,'7.5','Exchanged 30 UAH to 4 USD with rate 7.5 UAH to 1 USD',1359064800,1359104527,NULL),(57,'29820da55996a4907d3f60c42fe6557a',79,75,'0.12330456','to wallet (Exchanged 100 USD to 811 UAH with rate 0.1233045622688 USD to 1 UAH)',1359928800,1359991234,NULL),(58,'29820da55996a4907d3f60c42fe6557a',80,76,'0.12330456','to SuperCard (Exchanged 100 USD to 811 UAH with rate 0.1233045622688 USD to 1 UAH)',1359928800,1359991251,NULL);
/*!40000 ALTER TABLE `exchanges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `currency` enum('UAH','USD','EUR') DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `date` int(10) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `modified` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (37,'7702070b7e54e81d44163c6e055d2901','200500','UAH','Bought 100500 USD',1358719200,1358767539,NULL),(38,'7702070b7e54e81d44163c6e055d2901','1','UAH','Bought 5 USD',1358719200,1358767885,NULL),(39,'7702070b7e54e81d44163c6e055d2901','1','UAH','Bought 2 USD',1358719200,1358767935,NULL),(40,'7702070b7e54e81d44163c6e055d2901','5','UAH','Bought 7 USD',1358719200,1358768122,NULL),(41,'7702070b7e54e81d44163c6e055d2901','5','UAH','Bought 7 USD',1358719200,1358768134,NULL),(44,'7702070b7e54e81d44163c6e055d2901','100','USD','Exchanges: Bought 814 UAH',1358719200,1358768694,NULL),(45,'7702070b7e54e81d44163c6e055d2901','555','UAH','Exchanges: Bought 666 USD',1358892000,1358892913,NULL),(46,'7702070b7e54e81d44163c6e055d2901','111','UAH','Exchanges: Bought 2 USD',1358892000,1358892960,NULL),(47,'7702070b7e54e81d44163c6e055d2901','1','UAH','Exchanges: Bought 1 USD',1358892000,1358893068,NULL),(48,'7702070b7e54e81d44163c6e055d2901','1','UAH','Exchanges: Bought 1 USD',1358892000,1358893217,NULL),(49,'7702070b7e54e81d44163c6e055d2901','1','UAH','Exchanges: Bought 8 USD',1358892000,1358893247,NULL),(50,'7702070b7e54e81d44163c6e055d2901','999','UAH','Exchanges: Bought 888 USD',1358892000,1358893454,NULL),(51,'7702070b7e54e81d44163c6e055d2901','777','UAH','Exchanges: Bought 888 USD',1358892000,1358893621,NULL),(52,'7702070b7e54e81d44163c6e055d2901','300','USD','Exchanges: Bought 2457 UAH',1358892000,1358893680,NULL),(53,'7702070b7e54e81d44163c6e055d2901','555','UAH','Exchanges: Bought 11 USD',1358892000,1358893832,NULL),(54,'7702070b7e54e81d44163c6e055d2901','100500','USD','Exchanges: Bought 200500 UAH',1358892000,1358934521,NULL),(55,'7702070b7e54e81d44163c6e055d2901','30','UAH','Exchanges: Bought 4 USD',1359064800,1359104527,NULL),(56,'016ae8e9679c420a976a8ff90d60bacd','14.5','UAH','Мінералка, Мандаринки',1359756000,1359908950,NULL),(57,'016ae8e9679c420a976a8ff90d60bacd','27.3','UAH','Творог',1359756000,1359909002,NULL),(58,'016ae8e9679c420a976a8ff90d60bacd','16','UAH','Кава',1359756000,1359909023,NULL),(59,'016ae8e9679c420a976a8ff90d60bacd','45','UAH','Цукерки',1359756000,1359909046,NULL),(60,'016ae8e9679c420a976a8ff90d60bacd','85','UAH','Піцца',1359756000,1359909067,NULL),(61,'016ae8e9679c420a976a8ff90d60bacd','48.7','UAH','аптека для гіпса',1359842400,1359909150,NULL),(62,'016ae8e9679c420a976a8ff90d60bacd','25','UAH','рентген',1359842400,1359909174,NULL),(63,'016ae8e9679c420a976a8ff90d60bacd','35','UAH','таксі',1359842400,1359909198,NULL),(64,'016ae8e9679c420a976a8ff90d60bacd','9.25','UAH','Сметана',1359842400,1359909293,NULL),(65,'016ae8e9679c420a976a8ff90d60bacd','16','UAH','кава',1359669600,1359909627,NULL),(66,'016ae8e9679c420a976a8ff90d60bacd','19','UAH','булочки',1359842400,1359909707,NULL),(67,'016ae8e9679c420a976a8ff90d60bacd','2','UAH','пижик',1359842400,1359909726,NULL),(68,'016ae8e9679c420a976a8ff90d60bacd','50','UAH','мандарини банани і мінералка',1359842400,1359914366,NULL),(74,'29820da55996a4907d3f60c42fe6557a','300','USD','mother',1359928800,1359991177,NULL),(75,'29820da55996a4907d3f60c42fe6557a','100','USD','Exchanges: Bought 811 UAH',1359928800,1359991234,NULL),(76,'29820da55996a4907d3f60c42fe6557a','100','USD','Exchanges: Bought 811 UAH',1359928800,1359991251,NULL),(77,'29820da55996a4907d3f60c42fe6557a','635','UAH','ivan\'s birthday\r\n540+95',1359928800,1359991283,NULL),(78,'29820da55996a4907d3f60c42fe6557a','200','UAH','to mother',1359928800,1359991301,NULL),(79,'29820da55996a4907d3f60c42fe6557a','10','USD','to mother',1359928800,1359991479,NULL),(80,'7702070b7e54e81d44163c6e055d2901','75.51','UAH','1111222 654681 (Paid bill to Iñtërnâtiônàlizætiøn for utility Водопостачання. Amount 75.51 UAH)',1359928800,1359991784,NULL),(81,'7702070b7e54e81d44163c6e055d2901','84.00','UAH','Paid bill to Iñtërnâtiônàlizætiøn for utility Електроенергія. Amount 84.00 UAH',1359928800,1359991823,NULL),(82,'7702070b7e54e81d44163c6e055d2901','.00','UAH','Paid bill to Iñtërnâtiônàlizætiøn for utility Електроенергія. Amount .00 UAH',1360015200,1360059067,NULL),(83,'016ae8e9679c420a976a8ff90d60bacd','300','UAH','Банани мандарини мінералка за тиждень',1360360800,1360437013,NULL);
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) DEFAULT NULL,
  `reason` varchar(128) DEFAULT NULL,
  `old_value` varchar(128) DEFAULT NULL,
  `new_value` varchar(128) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(96) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `verified` int(1) NOT NULL DEFAULT '0',
  `blocked` int(1) NOT NULL DEFAULT '0',
  `created` int(10) DEFAULT NULL,
  `updated` int(10) DEFAULT NULL,
  `deleted` int(10) DEFAULT NULL,
  `isAdmin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES ('016ae8e9679c420a976a8ff90d60bacd','alex0germ@gmail.com','3fc0a7acf087f549ac2b266baf94b8b1','grubastik',1,0,1358607083,NULL,NULL,0),('29820da55996a4907d3f60c42fe6557a','zero.ukr@gmail.com','d634978603e253fe2eec9c731399cf25','ololosh petrovich',1,0,1359975364,NULL,NULL,0),('7702070b7e54e81d44163c6e055d2901','test@mydev.org.ua','d634978603e253fe2eec9c731399cf25','yurko',1,0,1358608332,NULL,NULL,0);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members_password_reset`
--

DROP TABLE IF EXISTS `members_password_reset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members_password_reset` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) NOT NULL,
  `password_reset` char(32) NOT NULL,
  `created` int(10) NOT NULL,
  `verified` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members_password_reset`
--

LOCK TABLES `members_password_reset` WRITE;
/*!40000 ALTER TABLE `members_password_reset` DISABLE KEYS */;
INSERT INTO `members_password_reset` VALUES (41,'5572f97002baf2b63822b1e5b9c2de42','fe0efdb16ffb89829c7e9fe1045517c8',1358692492,1);
/*!40000 ALTER TABLE `members_password_reset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members_verify`
--

DROP TABLE IF EXISTS `members_verify`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members_verify` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) NOT NULL,
  `verify_key` char(32) NOT NULL,
  `created` int(10) NOT NULL,
  `verified` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members_verify`
--

LOCK TABLES `members_verify` WRITE;
/*!40000 ALTER TABLE `members_verify` DISABLE KEYS */;
INSERT INTO `members_verify` VALUES (26,'13bebd27217140f163622d7c67cc7fc6','fe1eac89e841012035bfffe6deb9cee6',1358272391,NULL),(27,'cb289d626edc556a72722f5ab1d4d65c','26f743d307febc020184f3334dcd13b9',1358354210,NULL),(28,'7f2a1962d6e2b4293bbcddf942e111da','52a2be8f2b809c177aaeef3c36902a54',1358356418,1358356728),(29,'016ae8e9679c420a976a8ff90d60bacd','3930ac120e5db9ab078133ce4de7ea44',1358607083,1358607179),(30,'7702070b7e54e81d44163c6e055d2901','f5c3cfb05443e41f3b117586d85656b8',1358608332,1358608389),(31,'4791c4580f80a9fb2826dc965b5aa6fe','39ac1283ded3dbd27e03b8382fb9690a',1358691198,1358691285),(32,'0cf0d35d7d7c090a2007ff33f7d9297f','0e212820372ac8c707b2ed593512292c',1358691484,NULL),(33,'5572f97002baf2b63822b1e5b9c2de42','748f20687e744c76a8b119ac2d651ee3',1358691715,1358692165),(34,'29820da55996a4907d3f60c42fe6557a','acb4030373ab386b538c73aa95c8108a',1359975364,NULL);
/*!40000 ALTER TABLE `members_verify` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revenue`
--

DROP TABLE IF EXISTS `revenue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `revenue` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `currency` enum('UAH','USD','EUR') DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `date` int(10) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `modified` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revenue`
--

LOCK TABLES `revenue` WRITE;
/*!40000 ALTER TABLE `revenue` DISABLE KEYS */;
INSERT INTO `revenue` VALUES (56,'7702070b7e54e81d44163c6e055d2901','100500','USD','Sold 200500 UAH',1358719200,1358767539,NULL),(57,'7702070b7e54e81d44163c6e055d2901','5','USD','Sold 1 UAH',1358719200,1358767885,NULL),(58,'7702070b7e54e81d44163c6e055d2901','2','USD','Sold 1 UAH',1358719200,1358767935,NULL),(59,'7702070b7e54e81d44163c6e055d2901','7','USD','Sold 5 UAH',1358719200,1358768122,NULL),(60,'7702070b7e54e81d44163c6e055d2901','7','USD','Sold 5 UAH',1358719200,1358768134,NULL),(61,'016ae8e9679c420a976a8ff90d60bacd','80','UAH','Sold 10 USD',1358719200,1358768256,NULL),(62,'016ae8e9679c420a976a8ff90d60bacd','80','UAH','Sold 10 USD',1358719200,1358768305,NULL),(63,'7702070b7e54e81d44163c6e055d2901','814','UAH','Exchanges: Sold 100 USD',1358719200,1358768694,NULL),(64,'7702070b7e54e81d44163c6e055d2901','11','UAH','Iñtërnâtiônàlizætiøn',1358805600,1358891562,NULL),(65,'7702070b7e54e81d44163c6e055d2901','666','USD','Exchanges: Sold 555 UAH',1358892000,1358892913,NULL),(66,'7702070b7e54e81d44163c6e055d2901','2','USD','Exchanges: Sold 111 UAH',1358892000,1358892960,NULL),(67,'7702070b7e54e81d44163c6e055d2901','1','USD','Exchanges: Sold 1 UAH',1358892000,1358893068,NULL),(68,'7702070b7e54e81d44163c6e055d2901','1','USD','Exchanges: Sold 1 UAH',1358892000,1358893217,NULL),(69,'7702070b7e54e81d44163c6e055d2901','8','USD','Exchanges: Sold 1 UAH',1358892000,1358893247,NULL),(70,'7702070b7e54e81d44163c6e055d2901','888','USD','Exchanges: Sold 999 UAH',1358892000,1358893454,NULL),(71,'7702070b7e54e81d44163c6e055d2901','888','USD','Exchanges: Sold 777 UAH',1358892000,1358893621,NULL),(72,'7702070b7e54e81d44163c6e055d2901','2457','UAH','Exchanges: Sold 300 USD',1358892000,1358893680,NULL),(73,'7702070b7e54e81d44163c6e055d2901','11','USD','Exchanges: Sold 555 UAH',1358892000,1358893832,NULL),(74,'7702070b7e54e81d44163c6e055d2901','200500','UAH','Exchanges: Sold 100500 USD',1358892000,1358934521,NULL),(75,'7702070b7e54e81d44163c6e055d2901','4','USD','Exchanges: Sold 30 UAH',1359064800,1359104527,NULL),(76,'29820da55996a4907d3f60c42fe6557a','710','USD','my first revenue',1359928800,1359975513,NULL),(77,'29820da55996a4907d3f60c42fe6557a','40.5','UAH','my first revenue #2',1359928800,1359975549,NULL),(78,'29820da55996a4907d3f60c42fe6557a','28','UAH','wallet ))',1359928800,1359975598,NULL),(79,'29820da55996a4907d3f60c42fe6557a','811','UAH','Exchanges: Sold 100 USD',1359928800,1359991234,NULL),(80,'29820da55996a4907d3f60c42fe6557a','811','UAH','Exchanges: Sold 100 USD',1359928800,1359991251,NULL);
/*!40000 ALTER TABLE `revenue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilities`
--

DROP TABLE IF EXISTS `utilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `modified` int(10) DEFAULT NULL,
  `deleted` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilities`
--

LOCK TABLES `utilities` WRITE;
/*!40000 ALTER TABLE `utilities` DISABLE KEYS */;
INSERT INTO `utilities` VALUES (1,'Водопостачання','Водопостачання',2013,NULL,NULL),(2,'Підігрів води','Підігрів води',2013,NULL,NULL),(3,'Водовідведення','Водовідведення',2013,NULL,NULL),(4,'Опалення','Опалення',2013,NULL,NULL),(5,'Електроенергія','Електроенергія',2013,NULL,NULL),(6,'Газопостачання','Газопостачання',2013,NULL,NULL),(7,'Телефон','Телефон',2013,NULL,NULL),(8,'Вивіз сміття','Вивіз сміття',2013,NULL,NULL),(9,'Квартплата','Квартплата, прибирання території, світло в підїзді та підвалі',2013,NULL,NULL),(10,'Кабельне телебачення','Кабельне телебачення',2013,NULL,NULL),(11,'Інтернет','Інтернет',2013,NULL,NULL);
/*!40000 ALTER TABLE `utilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilities_to_utility_providers`
--

DROP TABLE IF EXISTS `utilities_to_utility_providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilities_to_utility_providers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `utility_id` int(10) NOT NULL,
  `utility_provider_id` int(10) NOT NULL,
  `active` char(1) NOT NULL DEFAULT '0',
  `deleted` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilities_to_utility_providers`
--

LOCK TABLES `utilities_to_utility_providers` WRITE;
/*!40000 ALTER TABLE `utilities_to_utility_providers` DISABLE KEYS */;
INSERT INTO `utilities_to_utility_providers` VALUES (1,1,16,'1',1359907117),(2,3,16,'1',NULL),(3,3,16,'1',1359907446),(4,1,16,'1',NULL),(5,2,18,'1',NULL),(6,4,18,'1',NULL),(7,5,19,'1',NULL),(8,6,20,'1',NULL),(9,1,21,'1',1359907781),(10,1,21,'1',1359993939),(11,7,22,'1',NULL),(12,8,23,'1',NULL),(13,9,24,'1',NULL),(14,11,25,'1',NULL),(15,10,26,'0',NULL),(16,10,26,'0',NULL),(17,5,21,'1',NULL),(18,10,26,'0',NULL),(19,10,26,'0',NULL),(20,10,26,'0',1360436849);
/*!40000 ALTER TABLE `utilities_to_utility_providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utility_meter_readings`
--

DROP TABLE IF EXISTS `utility_meter_readings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utility_meter_readings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `utility_meter_id` int(10) DEFAULT NULL,
  `meter_reading` varchar(16) DEFAULT NULL,
  `date` int(10) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `modified` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utility_meter_id` (`utility_meter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utility_meter_readings`
--

LOCK TABLES `utility_meter_readings` WRITE;
/*!40000 ALTER TABLE `utility_meter_readings` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_meter_readings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utility_meters`
--

DROP TABLE IF EXISTS `utility_meters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utility_meters` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `serial` varchar(16) DEFAULT NULL,
  `location` varchar(32) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `modified` int(10) DEFAULT NULL,
  `deleted` int(10) DEFAULT NULL,
  `member_id` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utility_meters`
--

LOCK TABLES `utility_meters` WRITE;
/*!40000 ALTER TABLE `utility_meters` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_meters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utility_meters_to_providers`
--

DROP TABLE IF EXISTS `utility_meters_to_providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utility_meters_to_providers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `utility_provider_id` int(10) DEFAULT NULL,
  `utility_meter_id` int(10) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `deleted` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utility_provider_id` (`utility_provider_id`),
  KEY `utility_meter_id` (`utility_meter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utility_meters_to_providers`
--

LOCK TABLES `utility_meters_to_providers` WRITE;
/*!40000 ALTER TABLE `utility_meters_to_providers` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_meters_to_providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utility_payments`
--

DROP TABLE IF EXISTS `utility_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utility_payments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `utility_meters_to_providers_id` int(10) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `utility_id_provider_id` int(10) DEFAULT NULL,
  `period_from` int(10) DEFAULT NULL,
  `period_to` int(10) DEFAULT NULL,
  `previous_utility_meter_reading_id` int(10) DEFAULT NULL,
  `last_utility_meter_reading_id` int(10) DEFAULT NULL,
  `rate` varchar(10) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `modified` int(10) DEFAULT NULL,
  `member_id` char(32) NOT NULL,
  `currency` enum('UAH','USD','EUR') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `utility_meters_to_providers_id` (`utility_meters_to_providers_id`),
  KEY `utility_provider_id` (`utility_id_provider_id`),
  KEY `previous_utility_meter_reading_id` (`previous_utility_meter_reading_id`),
  KEY `last_utility_meter_reading_id` (`last_utility_meter_reading_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utility_payments`
--

LOCK TABLES `utility_payments` WRITE;
/*!40000 ALTER TABLE `utility_payments` DISABLE KEYS */;
INSERT INTO `utility_payments` VALUES (1,NULL,'Paid bill to test for utility . Amount 30.25 UAH',16,1356991200,1359669600,NULL,NULL,'30.25','30.25',1359988170,NULL,'016ae8e9679c420a976a8ff90d60bacd','UAH'),(2,NULL,'Paid bill to test for utility Кабельне телебачення. Amount 250 UAH',18,1356991200,1359669600,NULL,NULL,'250','250',1359988243,NULL,'016ae8e9679c420a976a8ff90d60bacd','UAH'),(3,NULL,'Проплачено борг за грудень 2012 (Paid bill to test for utility Кабельне телебачення. Amount 24 UAH)',19,1356991200,1359669600,NULL,NULL,'24','24',1359988301,NULL,'016ae8e9679c420a976a8ff90d60bacd','UAH'),(4,NULL,'Paid bill to test for utility Кабельне телебачення. Amount 10 UAH',23,1356991200,1359669600,NULL,NULL,'10','10',1359988566,NULL,'016ae8e9679c420a976a8ff90d60bacd','UAH'),(5,NULL,'Paid bill to УкрТелеКом for utility Телефон. Amount 40 UAH',11,1356991200,1359669600,NULL,NULL,'40','40',1359988725,NULL,'016ae8e9679c420a976a8ff90d60bacd','UAH'),(6,NULL,'1111222 654681 (Paid bill to Iñtërnâtiônàlizætiøn for utility Водопостачання. Amount 75.51 UAH)',10,1356991200,1359669600,NULL,NULL,'75.51','75.51',1359991784,NULL,'7702070b7e54e81d44163c6e055d2901','UAH'),(7,NULL,'Paid bill to Iñtërnâtiônàlizætiøn for utility Електроенергія. Amount 84.00 UAH',17,1356991200,1359669600,NULL,NULL,'84','84',1359991823,NULL,'7702070b7e54e81d44163c6e055d2901','UAH'),(8,NULL,'Paid bill to Iñtërnâtiônàlizætiøn for utility Електроенергія. Amount .00 UAH',0,1356991200,1359669600,NULL,NULL,'','',1360059067,NULL,'7702070b7e54e81d44163c6e055d2901','UAH');
/*!40000 ALTER TABLE `utility_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utility_providers`
--

DROP TABLE IF EXISTS `utility_providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utility_providers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `modified` int(10) DEFAULT NULL,
  `deleted` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utility_providers`
--

LOCK TABLES `utility_providers` WRITE;
/*!40000 ALTER TABLE `utility_providers` DISABLE KEYS */;
INSERT INTO `utility_providers` VALUES (14,'016ae8e9679c420a976a8ff90d60bacd','1234\'','1234',1359843169,NULL,1),(15,'016ae8e9679c420a976a8ff90d60bacd','546456456456','456456',1359843858,NULL,1),(16,'016ae8e9679c420a976a8ff90d60bacd','ВодоЕкоТехПром','ВодоЕкоТехПром',1359843988,NULL,NULL),(17,'016ae8e9679c420a976a8ff90d60bacd','','',1359900818,NULL,1),(18,'016ae8e9679c420a976a8ff90d60bacd','ТеплоКомунЕнерго','ТеплоКомунЕнерго',1359907496,NULL,NULL),(19,'016ae8e9679c420a976a8ff90d60bacd','РЕМ','Ремонтне управління електромереж',1359907570,NULL,NULL),(20,'016ae8e9679c420a976a8ff90d60bacd','Ів-Фр упр. по експл. газ. госп.','Івано-Франківське управління по експлуатації газового господарства',1359907751,NULL,NULL),(21,'7702070b7e54e81d44163c6e055d2901','Iñtërnâtiônàlizætiøn','Iñtërnâtiônàlizætiøn Daniele Orr',1359907775,NULL,NULL),(22,'016ae8e9679c420a976a8ff90d60bacd','УкрТелеКом','УкрТелеКом',1359908403,NULL,NULL),(23,'016ae8e9679c420a976a8ff90d60bacd','АТП-0928','АТП-0928',1359908422,NULL,NULL),(24,'016ae8e9679c420a976a8ff90d60bacd','Єдиний розрахунковий центр','Єдиний розрахунковий центр',1359908443,NULL,NULL),(25,'016ae8e9679c420a976a8ff90d60bacd','Діскавері','Діскавері',1359908476,NULL,NULL),(26,'016ae8e9679c420a976a8ff90d60bacd','test','test',1359984184,NULL,1);
/*!40000 ALTER TABLE `utility_providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_bank_accounts`
--

DROP TABLE IF EXISTS `view_bank_accounts`;
/*!50001 DROP VIEW IF EXISTS `view_bank_accounts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_bank_accounts` (
  `id` tinyint NOT NULL,
  `member_id` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `type` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `bank_id` tinyint NOT NULL,
  `currency` tinyint NOT NULL,
  `active` tinyint NOT NULL,
  `created` tinyint NOT NULL,
  `deleted` tinyint NOT NULL,
  `bank_name` tinyint NOT NULL,
  `card_type` tinyint NOT NULL,
  `card_trunk` tinyint NOT NULL,
  `baa_action` tinyint NOT NULL,
  `baa_amount` tinyint NOT NULL,
  `baa_description` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_utility_payments`
--

DROP TABLE IF EXISTS `view_utility_payments`;
/*!50001 DROP VIEW IF EXISTS `view_utility_payments`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_utility_payments` (
  `id` tinyint NOT NULL,
  `utility_meters_to_providers_id` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `utility_id_provider_id` tinyint NOT NULL,
  `period_from` tinyint NOT NULL,
  `period_to` tinyint NOT NULL,
  `previous_utility_meter_reading_id` tinyint NOT NULL,
  `last_utility_meter_reading_id` tinyint NOT NULL,
  `rate` tinyint NOT NULL,
  `amount` tinyint NOT NULL,
  `created` tinyint NOT NULL,
  `modified` tinyint NOT NULL,
  `member_id` tinyint NOT NULL,
  `currency` tinyint NOT NULL,
  `provider_name` tinyint NOT NULL,
  `provider_description` tinyint NOT NULL,
  `active` tinyint NOT NULL,
  `utility_name` tinyint NOT NULL,
  `utility_description` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_utility_providers`
--

DROP TABLE IF EXISTS `view_utility_providers`;
/*!50001 DROP VIEW IF EXISTS `view_utility_providers`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_utility_providers` (
  `utility_name` tinyint NOT NULL,
  `utility_description` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `member_id` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `created` tinyint NOT NULL,
  `modified` tinyint NOT NULL,
  `deleted` tinyint NOT NULL,
  `active` tinyint NOT NULL,
  `reference_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `view_bank_accounts`
--

/*!50001 DROP TABLE IF EXISTS `view_bank_accounts`*/;
/*!50001 DROP VIEW IF EXISTS `view_bank_accounts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`yurko`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_bank_accounts` AS select `ba`.`id` AS `id`,`ba`.`member_id` AS `member_id`,`ba`.`name` AS `name`,`ba`.`type` AS `type`,`ba`.`description` AS `description`,`ba`.`bank_id` AS `bank_id`,`ba`.`currency` AS `currency`,`ba`.`active` AS `active`,`ba`.`created` AS `created`,`ba`.`deleted` AS `deleted`,`bl`.`name` AS `bank_name`,`bca`.`card_type` AS `card_type`,`bca`.`card_trunk` AS `card_trunk`,`baa`.`action` AS `baa_action`,`baa`.`amount` AS `baa_amount`,`baa`.`description` AS `baa_description` from (((`bank_accounts` `ba` join `bank_list` `bl` on((`ba`.`bank_id` = `bl`.`id`))) left join `bank_card_accounts` `bca` on((`ba`.`id` = `bca`.`bank_account_id`))) left join `bank_accounts_activity` `baa` on((`ba`.`id` = `baa`.`bank_account_id`))) where (isnull(`ba`.`deleted`) and isnull(`bl`.`deleted`) and (`ba`.`active` = 1)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_utility_payments`
--

/*!50001 DROP TABLE IF EXISTS `view_utility_payments`*/;
/*!50001 DROP VIEW IF EXISTS `view_utility_payments`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`g44`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_utility_payments` AS select `up`.`id` AS `id`,`up`.`utility_meters_to_providers_id` AS `utility_meters_to_providers_id`,`up`.`description` AS `description`,`up`.`utility_id_provider_id` AS `utility_id_provider_id`,`up`.`period_from` AS `period_from`,`up`.`period_to` AS `period_to`,`up`.`previous_utility_meter_reading_id` AS `previous_utility_meter_reading_id`,`up`.`last_utility_meter_reading_id` AS `last_utility_meter_reading_id`,`up`.`rate` AS `rate`,`up`.`amount` AS `amount`,`up`.`created` AS `created`,`up`.`modified` AS `modified`,`up`.`member_id` AS `member_id`,`up`.`currency` AS `currency`,`upr`.`name` AS `provider_name`,`upr`.`description` AS `provider_description`,`uup`.`active` AS `active`,`u`.`name` AS `utility_name`,`u`.`description` AS `utility_description` from (((`utility_payments` `up` join `utilities_to_utility_providers` `uup` on((`up`.`utility_id_provider_id` = `uup`.`id`))) join `utility_providers` `upr` on((`uup`.`utility_provider_id` = `upr`.`id`))) join `utilities` `u` on((`uup`.`utility_id` = `u`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_utility_providers`
--

/*!50001 DROP TABLE IF EXISTS `view_utility_providers`*/;
/*!50001 DROP VIEW IF EXISTS `view_utility_providers`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`g44`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_utility_providers` AS select `u`.`name` AS `utility_name`,`u`.`description` AS `utility_description`,`up`.`id` AS `id`,`up`.`member_id` AS `member_id`,`up`.`name` AS `name`,`up`.`description` AS `description`,`up`.`created` AS `created`,`up`.`modified` AS `modified`,`up`.`deleted` AS `deleted`,`uup`.`active` AS `active`,`uup`.`id` AS `reference_id` from ((`utilities` `u` join `utilities_to_utility_providers` `uup` on((`u`.`id` = `uup`.`utility_id`))) join `utility_providers` `up` on((`uup`.`utility_provider_id` = `up`.`id`))) where (isnull(`u`.`deleted`) and isnull(`up`.`deleted`) and isnull(`uup`.`deleted`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-10 17:51:52
