-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: rivulet
-- ------------------------------------------------------
-- Server version	5.6.10

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
-- Table structure for table `budget`
--

DROP TABLE IF EXISTS `budget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `budget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `code` varchar(8) NOT NULL,
  `cate_name` varchar(45) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `period` int(11) NOT NULL COMMENT '0-monthly; 1-yearly; 2-weekly',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budget`
--

LOCK TABLES `budget` WRITE;
/*!40000 ALTER TABLE `budget` DISABLE KEYS */;
INSERT INTO `budget` VALUES (6,2,'1000','CLOTHES',0.00,0),(7,2,'2000','FOOD',100.00,2),(8,2,'3000','HOUSE',1900.00,0),(9,2,'4000','TRAFFIC',1300.00,0),(10,2,'5000','CANADA RETURN',0.00,0),(11,2,'6000','SALARY',0.00,0),(12,2,'7000','EDUCATION',0.00,0),(13,2,'8000','ENTERTAINMENT',0.00,0),(14,2,'9900','OTHER',100.00,0);
/*!40000 ALTER TABLE `budget` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(8) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'1000','CLOTHES'),(2,'2000','FOOD'),(3,'3000','HOUSE'),(4,'4000','TRAFFIC'),(5,'9900','OTHER'),(10,'5000','CANADA RETURN'),(11,'3001','MORTGAGE'),(12,'4001','CAR LEASE'),(13,'4002','CAR GAS'),(14,'2001','RESTAURANT'),(15,'6000','SALARY'),(16,'3002','PROPERTY TAX'),(17,'3003','MANAGEMENT FEE'),(18,'7000','EDUCATION'),(19,'7001','DAYCARE'),(20,'8000','ENTERTAINMENT'),(21,'8001','MOBILE'),(22,'8002','CABLE'),(23,'2002','SUPERMARKET'),(24,'8003','TOY'),(25,'8004','TRAVEL'),(26,'8100','MAKEUP');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fixedexpends`
--

DROP TABLE IF EXISTS `fixedexpends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fixedexpends` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `occur_time` int(11) NOT NULL,
  `cate_code` varchar(8) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `remark` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fixedexpends`
--

LOCK TABLES `fixedexpends` WRITE;
/*!40000 ALTER TABLE `fixedexpends` DISABLE KEYS */;
INSERT INTO `fixedexpends` VALUES (35,2,1,'3001',505.08,'Mortgage bi-weekly'),(36,2,1,'3003',531.63,'MANAGEMENT FEE'),(37,2,2,'3002',260.00,'PROPERTY TAX'),(38,2,15,'3001',505.08,'Mortgage bi-weekly');
/*!40000 ALTER TABLE `fixedexpends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `occur_time` date NOT NULL,
  `cate_code` varchar(8) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `direction` int(11) NOT NULL,
  `remark` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,1,'2016-10-20','9900',1.00,1,'test'),(2,1,'2016-10-25','1000',135.00,-1,'something'),(3,1,'2016-10-26','1000',56.00,-1,'buy t-shirt'),(4,1,'2016-10-26','9900',123.00,1,'return tax'),(5,1,'2016-10-27','2000',12.50,-1,'Lunch'),(6,1,'2016-10-27','4000',40.00,-1,'Gas'),(7,2,'2016-10-05','5000',174.25,1,'CANADA GST/TPS'),(8,2,'2016-10-07','5000',72.75,1,'CANADA PRO/PRO'),(9,2,'2016-10-07','3001',505.08,-1,'Mortgage bi-weekly'),(10,2,'2016-10-21','3001',505.08,-1,'Mortgage bi-weekly'),(11,2,'2016-10-26','4001',374.26,-1,'VW lease monthly'),(12,2,'2016-10-28','4001',649.26,-1,'Ford lease monthly'),(13,2,'2016-10-28','9900',35.00,-1,'Renew David\'s passport'),(14,2,'2016-10-01','4002',39.41,-1,'ESSO Toronto'),(15,2,'2016-10-02','2001',77.19,-1,'Dinner congee wong'),(16,2,'2016-10-04','4002',40.00,-1,'ESSO Willowdale'),(17,2,'2016-10-08','4002',40.00,-1,'ESSO Toronto'),(18,2,'2016-10-09','4002',42.30,-1,'Oxtongue lake'),(19,2,'2016-10-16','4002',40.00,-1,'Petrocan Toronto'),(20,2,'2016-10-18','4002',40.00,-1,'ESSO Toronto'),(21,2,'2016-10-30','2000',10.98,-1,'shoppers drug mart'),(22,2,'2016-10-31','6000',3728.93,1,'Derek\'s salary'),(23,2,'2016-10-14','6000',1531.34,1,'Natalie\'s salary'),(24,2,'2016-10-31','6000',1531.34,1,'Natalie\'s salary'),(25,2,'2016-10-01','3003',531.63,-1,'MANAGEMENT FEE'),(26,2,'2016-10-01','7001',150.00,-1,'David\'s daycare'),(27,2,'2016-10-10','8001',180.00,-1,'Fido'),(28,2,'2016-10-03','8000',9.99,-1,'Netfiex'),(29,2,'2016-10-01','3002',260.00,-1,'property tax'),(30,2,'2016-11-04','3001',505.08,-1,'Mortgage bi-weekly'),(31,2,'2016-11-05','2001',113.96,-1,'Fishman Lobster'),(32,2,'2016-10-01','2002',70.07,-1,'TnT'),(33,2,'2016-10-01','9900',32.48,-1,'Best buy radio box'),(34,2,'2016-10-01','8003',48.58,-1,'Lego'),(35,2,'2016-10-01','2000',16.95,-1,'LCBO#20'),(36,2,'2016-10-01','2002',53.71,-1,'Loblaws'),(37,2,'2016-10-02','2002',44.04,-1,'Sunny supermarket'),(38,2,'2016-10-02','3000',19.23,-1,'Home depot'),(39,2,'2016-10-04','2002',22.02,-1,'shoppers drug mart'),(40,2,'2016-10-07','8004',81.09,-1,'CN Tower food'),(41,2,'2016-10-07','8004',44.07,-1,'CN Tower store'),(42,2,'2016-10-07','8004',35.00,-1,'CN Tower photo'),(43,2,'2016-10-13','2002',22.10,-1,'H-Mart'),(44,2,'2016-10-14','2001',27.16,-1,'Chicken Beers'),(45,2,'2016-10-15','2002',131.12,-1,'TnT'),(46,2,'2016-10-15','2002',52.57,-1,'Dianas Seafood'),(47,2,'2016-10-15','2002',12.07,-1,'Freshco'),(48,2,'2016-10-15','1000',74.46,-1,'Gymboree store'),(49,2,'2016-10-15','2000',51.85,-1,'LCBO'),(50,2,'2016-10-18','1000',75.69,-1,'Winners'),(51,2,'2016-10-19','1000',87.47,-1,'AF'),(52,2,'2016-10-20','2002',20.87,-1,'H-Mart'),(53,2,'2016-10-21','8004',34.98,-1,'Wonderland'),(54,2,'2016-10-21','2001',25.97,-1,'Chicken Beers'),(55,2,'2016-10-22','2000',11.75,-1,'Lunch Lady'),(56,2,'2016-10-22','8000',79.69,-1,'Chapters 940'),(57,2,'2016-10-22','2000',7.74,-1,'Starbucks'),(58,2,'2016-10-23','2001',16.53,-1,'Pizza Pizza'),(59,2,'2016-10-23','2002',18.03,-1,'shoppers drug mart'),(60,2,'2016-10-24','2002',34.93,-1,'Costco'),(61,2,'2016-10-25','2002',71.55,-1,'Sunny Supermarket'),(62,2,'2016-10-25','8000',39.55,-1,'Chapters 940'),(63,2,'2016-10-26','8100',361.60,-1,'LCI Beauty'),(64,2,'2016-10-27','2002',24.90,-1,'Walmart'),(65,2,'2016-10-28','2002',117.37,-1,'Costco'),(66,2,'2016-10-28','1000',69.92,1,'AF'),(67,2,'2016-10-28','8100',35.60,-1,'Body shop'),(68,2,'2016-10-28','8100',40.68,-1,'Burberry'),(69,2,'2016-10-28','8100',24.86,-1,'Kiehls'),(70,2,'2016-10-28','8004',40.00,-1,'Casa Loma'),(71,2,'2016-10-29','2002',109.63,-1,'Walmart'),(72,2,'2016-10-30','2002',40.00,-1,'Paypal Cindylai'),(73,2,'2016-10-30','3000',159.32,-1,'Ikea'),(74,2,'2016-10-30','2002',34.74,-1,'shoppers drug mart'),(75,2,'2016-10-31','2000',49.50,-1,'Lunch lady'),(76,2,'2016-10-31','8000',169.50,-1,'Indigo'),(77,2,'2016-11-02','8001',98.54,-1,'Fido mobile'),(78,2,'2016-11-02','4002',37.93,-1,'Costco gas'),(79,2,'2016-11-03','8000',9.99,-1,'Netflix'),(80,2,'2016-11-03','2002',142.66,-1,'TnT'),(81,2,'2016-11-05','2002',97.72,-1,'Walmart'),(82,2,'2016-11-06','8100',47.29,-1,'Lush Fairview Mall'),(83,2,'2016-11-06','2002',136.03,-1,'Costco'),(84,2,'2016-11-06','8100',28.25,-1,'Body Shop'),(85,2,'2016-11-06','8100',151.87,-1,'Sephora Fairview Mall'),(86,2,'2016-11-06','1000',41.56,-1,'Gymboree'),(87,2,'2016-11-09','8000',169.50,-1,'Indigo'),(88,2,'2016-11-09','2002',47.48,-1,'Walmart'),(89,2,'2016-11-10','4002',33.65,-1,'Costco gas'),(90,2,'2016-11-11','1000',85.70,-1,'Gap'),(91,2,'2016-11-11','2002',73.45,-1,'shoppers drug mart'),(92,2,'2016-11-12','2002',75.76,-1,'Galleria'),(93,2,'2016-11-12','8100',24.00,-1,'Bakery Gateau'),(94,2,'2016-11-12','2002',54.99,-1,'Walmart'),(95,2,'2016-11-15','8100',31.64,-1,'Sephora'),(96,2,'2016-11-15','8100',47.91,1,'Sephora'),(97,2,'2016-11-15','2002',16.35,-1,'shoppers drug mart'),(98,2,'2016-10-28','4002',40.00,-1,'Esso Willowdale'),(99,2,'2016-10-30','2002',10.98,-1,'shoppers drug mart'),(100,2,'2016-11-08','4002',40.00,-1,'Esso Willowdale'),(101,2,'2016-11-01','3003',531.63,-1,'MANAGEMENT FEE'),(102,2,'2016-11-02','3002',260.00,-1,'PROPERTY TAX'),(103,2,'2016-10-14','1000',33.89,-1,'Hudson\'s bay'),(104,2,'2016-10-31','9900',30.00,-1,'Edge imaging'),(105,2,'2016-10-31','1000',288.37,-1,'Tommy'),(106,2,'2016-11-04','1000',37.24,-1,'Gymboree'),(107,2,'2016-11-04','8100',208.82,-1,'sephora'),(108,2,'2016-11-05','2002',41.00,-1,'shoppers drug mart'),(109,2,'2016-11-12','1000',129.67,-1,'Hudson\'s bay'),(110,2,'2016-11-13','2002',38.77,-1,'sunny supermarket');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` int(11) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0' COMMENT '0 - default init\n1 - actived\n2 - expired',
  `group` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','123456',1,1,0,'127.0.0.1'),(2,'derek','123456',1,1,0,'127.0.0.1'),(3,'natalie','123456',2,1,0,'127.0.0.1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_signup`
--

DROP TABLE IF EXISTS `user_signup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_signup` (
  `signup_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0' COMMENT '0 - default init\n1 - actived\n2 - expired',
  `activate_url` varchar(255) NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`signup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_signup`
--

LOCK TABLES `user_signup` WRITE;
/*!40000 ALTER TABLE `user_signup` DISABLE KEYS */;
INSERT INTO `user_signup` VALUES (1,'derek','123456',1,'http://localhost/?/user/activate/abcd1234','127.0.0.1'),(2,'testuser1','123456',0,'http://localhost/?/user/activate/abcd1234','127.0.0.1');
/*!40000 ALTER TABLE `user_signup` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-28 23:27:42
