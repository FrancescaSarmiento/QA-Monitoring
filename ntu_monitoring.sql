-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: ntu_monitoring
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `agentinfo`
--

DROP TABLE IF EXISTS `agentinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agentinfo` (
  `idCA` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `team` varchar(45) NOT NULL,
  `area` enum('OPS1','OPS2','OPS3','OPS4','OPS5') NOT NULL,
  `score` int(11) NOT NULL,
  `evaluator` varchar(45) DEFAULT NULL,
  `dateCompleted` date NOT NULL,
  PRIMARY KEY (`idCA`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agentinfo`
--

LOCK TABLES `agentinfo` WRITE;
/*!40000 ALTER TABLE `agentinfo` DISABLE KEYS */;
INSERT INTO `agentinfo` VALUES (1,'X44','Agent','Team Ba','OPS1',29,'Rody Duterte','0000-00-00'),(2,'O7','Double','Pata Team','OPS2',20,'Ninoy Aquino','2017-07-07'),(3,'Sarmiento','Rances','BeauTeam','OPS1',100,'Prince Williams','2017-07-07'),(4,'Marcos','Ferdinand','Some Team','OPS3',25,'Kris Aquino','2015-02-02'),(5,'Pantasya','Ana','Team Yap','OPS4',12,'Boy Abunda','2014-04-04'),(6,'Boom','Boom','Boom Team','OPS3',18,'Angelina Jolie','2016-03-03'),(7,'Real','Real na','Pata Team','OPS2',15,'Brad Pitt','2017-01-05'),(8,'Waldorf','Blaire','Some Team','OPS3',10,'Ryan Reynolds','2010-10-10'),(9,'Bass','Chuck','BeauTeam','OPS1',9,'Emma Stone','2012-12-12'),(10,'der Woodsen','Serena Van','Yehey Team','OPS5',7,'Emma Watson','2016-04-07'),(11,'Archibald','Emma','Yo Team','OPS5',5,'Jim Carrey','2012-01-07'),(12,'Escudero','Chiz','Team A','OPS5',20,'Robin WIlliams','2013-04-01'),(13,'Evangelista','Heart','Team B','OPS4',10,'Robbie DOmingo','2012-12-12');
/*!40000 ALTER TABLE `agentinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `idCat` int(11) NOT NULL AUTO_INCREMENT,
  `catNum` int(11) NOT NULL,
  `txtCat` varchar(1000) NOT NULL,
  PRIMARY KEY (`idCat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,1,'Introduction'),(2,2,'Presentation/Sales/Customer Service Skills'),(3,3,'Answers and Responses');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contentform`
--

DROP TABLE IF EXISTS `contentform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contentform` (
  `idCF` int(11) NOT NULL AUTO_INCREMENT,
  `subCat` int(11) NOT NULL,
  `violation` int(11) NOT NULL,
  `formId` int(11) NOT NULL,
  `posiblePoint` int(11) NOT NULL,
  `receivedPoint` int(11) NOT NULL,
  PRIMARY KEY (`idCF`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contentform`
--

LOCK TABLES `contentform` WRITE;
/*!40000 ALTER TABLE `contentform` DISABLE KEYS */;
/*!40000 ALTER TABLE `contentform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form` (
  `formId` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `infoId` int(11) NOT NULL,
  PRIMARY KEY (`formId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form`
--

LOCK TABLES `form` WRITE;
/*!40000 ALTER TABLE `form` DISABLE KEYS */;
/*!40000 ALTER TABLE `form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forminfo`
--

DROP TABLE IF EXISTS `forminfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forminfo` (
  `infoId` int(11) NOT NULL AUTO_INCREMENT,
  `caId` int(11) NOT NULL,
  `evaluator` int(11) NOT NULL,
  `dateOfCall` datetime NOT NULL,
  `phoneNum` varchar(45) NOT NULL,
  `account` varchar(45) NOT NULL,
  `caStatus` varchar(45) NOT NULL,
  `strength` varchar(1000) DEFAULT NULL,
  `weakness` varchar(1000) DEFAULT NULL,
  `immediateS` int(11) NOT NULL,
  `dateReviewed` datetime NOT NULL,
  PRIMARY KEY (`infoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forminfo`
--

LOCK TABLES `forminfo` WRITE;
/*!40000 ALTER TABLE `forminfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `forminfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategory` (
  `idSub` int(11) NOT NULL AUTO_INCREMENT,
  `subCatNum` int(11) NOT NULL,
  `txtSub` varchar(1000) NOT NULL,
  `idCat` int(11) NOT NULL,
  PRIMARY KEY (`idSub`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategory`
--

LOCK TABLES `subcategory` WRITE;
/*!40000 ALTER TABLE `subcategory` DISABLE KEYS */;
INSERT INTO `subcategory` VALUES (1,1,'Prepared for call.',1),(2,2,'Gave proper greeting.',1),(4,1,'Followed script, call flow and escalation procedures.',2),(5,2,'Provided complete and accurate information.',2);
/*!40000 ALTER TABLE `subcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `empNum` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `type` enum('Regular','Admin','Super Admin') NOT NULL DEFAULT 'Regular',
  `position` enum('QA','Coach') NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'2151857','Villacentino','Catherine Mae','Super Admin','QA','kawaii','cmmv1126@gmail.com','CathMae'),(2,'NTU-2017-1','Neko','Nya','Regular','Coach','neko','meowmeow@gmail.com','MeowMeow'),(3,'NTU-2017-2','Person','Another','Admin','QA','meow','anotherP@gmail.com','AnotherP'),(4,'NTU-2017-3','Caniba','Benj','Super Admin','QA','panget','benjcaniba@gmail.com','Benj'),(5,'NTU-2017-4','Bully','Big','Admin','QA','bullyb','bigbully@gmail.com','Bully'),(6,'NTU-2017-24','Sarmiento','Rances','Super Admin','QA','admin','admin@gmail.com','Rances'),(7,'NTU-2017-07','Sarmiento','Rances','Admin','QA','admin','admin2@gmail.com','Rances'),(8,'NTU-2017-17','Sarmiento','Ranes','Regular','Coach','regular','regular@gmail.com','Rances');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `violation`
--

DROP TABLE IF EXISTS `violation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `violation` (
  `idViolation` int(11) NOT NULL AUTO_INCREMENT,
  `txtViolation` varchar(1000) NOT NULL,
  `intensity` enum('Minor','Major','Extreme') NOT NULL DEFAULT 'Minor',
  `idSub` int(11) NOT NULL,
  PRIMARY KEY (`idViolation`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `violation`
--

LOCK TABLES `violation` WRITE;
/*!40000 ALTER TABLE `violation` DISABLE KEYS */;
INSERT INTO `violation` VALUES (1,'CA failed to answer call immediately.','Minor',1),(2,'CA sounded distracted at the onset of the call.','Minor',1),(3,'CA failed to give the appropriate greeting for the type of call received.','Minor',2),(4,'CA failed to identify self, company and product.','Minor',2),(5,'CA did not react at all and disposed call immediately.','Minor',2);
/*!40000 ALTER TABLE `violation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-24 17:10:13
