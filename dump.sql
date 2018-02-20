-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 192.168.100.107    Database: BeeJee
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `todoList`
--

DROP TABLE IF EXISTS `todoList`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `todoList` (
  `todoID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `todoText` varchar(255) NOT NULL,
  `todoImg` varchar(255) DEFAULT NULL,
  `todoStatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`todoID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `todoList`
--

LOCK TABLES `todoList` WRITE;
/*!40000 ALTER TABLE `todoList` DISABLE KEYS */;
INSERT INTO `todoList` VALUES (1,'789789','98798798@gmail.com','987987897','img_5a81e569df1986.79113321.png',1),(2,'taras','taras@gmail.com','\"\'\'hh7y7y7','img_5a81e657ea2a65.32325524.png',1),(3,'0000','0000@gmail.com','000000','img_5a81e68b739106.81784581.png',0),(4,'Lllll','ttt@gmail.com','my task 1','img_5a820d03548503.16665028.jpg',0),(5,'767676','767676@gmail.com','kjghjkhgjhjkhkjhkjhkjhjkhjk\r\nsgdsdg','img_5a820d7a84c899.27958449.png',0),(7,'jijijij','_____@gmail.com','768698','img_5a8226986e8221.55447140.png',0),(12,'iuu','iuiui@gmauk.fbn','uiuiu','img_5a8248dfeb6554.70125901.png',0),(13,'456789','435678@ghvmm.fdf','2er5tgbbhj','img_5a8248fe8ec839.28771598.jpg',0),(14,'098098','09890890@gmail.com','8908908','img_5a827819814504.58441342.png',0);
/*!40000 ALTER TABLE `todoList` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','202cb962ac59075b964b07152d234b70');
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

-- Dump completed on 2018-02-13  8:12:30
