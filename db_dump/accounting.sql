-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: g44
-- ------------------------------------------------------
-- Server version	5.5.31-1

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
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bank_accounts_activity`
--

DROP TABLE IF EXISTS `bank_accounts_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_accounts_activity` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bank_account_id` int(10) DEFAULT NULL,
  `finance_id` int(10) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `date` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_account_id` (`bank_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=434 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `budget_items`
--

DROP TABLE IF EXISTS `budget_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `budget_items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `budget_id` int(10) DEFAULT NULL,
  `goal_id` int(10) DEFAULT NULL,
  `bank_account_id` int(10) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `currency` enum('UAH','USD','EUR') DEFAULT NULL,
  `is_income` char(1) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `deleted` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `budgets`
--

DROP TABLE IF EXISTS `budgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `budgets` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `start_time` int(10) DEFAULT NULL,
  `end_time` int(10) DEFAULT NULL,
  `period` smallint(2) DEFAULT NULL,
  `period_type` enum('day','week','month','year') DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `deleted` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) DEFAULT NULL,
  `finance_id` int(10) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=266 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `expenses_old`
--

DROP TABLE IF EXISTS `expenses_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses_old` (
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
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `finances`
--

DROP TABLE IF EXISTS `finances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finances` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) DEFAULT NULL,
  `amount` char(10) DEFAULT NULL,
  `currency` enum('USD','GPB','EUR','UAH') DEFAULT NULL,
  `date` int(10) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=520 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `goal`
--

DROP TABLE IF EXISTS `goal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goal` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `currency` enum('USD','GPB','EUR','UAH') DEFAULT NULL,
  `isBankAccount` int(1) DEFAULT '0',
  `created` int(10) DEFAULT NULL,
  `end_date` int(10) DEFAULT NULL,
  `deleted` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `goals_to_bank_accounts`
--

DROP TABLE IF EXISTS `goals_to_bank_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goals_to_bank_accounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `goal_id` int(10) NOT NULL,
  `bank_account_id` int(10) NOT NULL,
  `deleted` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `goals_to_finances`
--

DROP TABLE IF EXISTS `goals_to_finances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goals_to_finances` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `goal_id` int(10) NOT NULL,
  `finance_id` int(10) NOT NULL,
  `deleted` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `revenue_old`
--

DROP TABLE IF EXISTS `revenue_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `revenue_old` (
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
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `revenues`
--

DROP TABLE IF EXISTS `revenues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `revenues` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) DEFAULT NULL,
  `finance_id` int(10) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `modified` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `utilities_to_utility_providers`
--

DROP TABLE IF EXISTS `utilities_to_utility_providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilities_to_utility_providers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) NOT NULL,
  `utility_id` int(10) NOT NULL,
  `utility_provider_id` int(10) NOT NULL,
  `active` char(1) NOT NULL DEFAULT '0',
  `deleted` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `utility_payments`
--

DROP TABLE IF EXISTS `utility_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utility_payments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` char(32) DEFAULT NULL,
  `finance_id` int(10) DEFAULT NULL,
  `utility_meters_to_providers_id` int(10) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `utility_id_provider_id` int(10) DEFAULT NULL,
  `period_from` int(10) DEFAULT NULL,
  `period_to` int(10) DEFAULT NULL,
  `previous_utility_meter_reading_id` int(10) DEFAULT NULL,
  `last_utility_meter_reading_id` int(10) DEFAULT NULL,
  `rate` varchar(10) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `modified` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utility_meters_to_providers_id` (`utility_meters_to_providers_id`),
  KEY `utility_provider_id` (`utility_id_provider_id`),
  KEY `previous_utility_meter_reading_id` (`previous_utility_meter_reading_id`),
  KEY `last_utility_meter_reading_id` (`last_utility_meter_reading_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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

-- Dump completed on 2013-08-25 14:06:57
