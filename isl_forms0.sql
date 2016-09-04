-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: isl
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.10-MariaDB

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
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `desc` text,
  `created` datetime NOT NULL,
  `lang` varchar(2) DEFAULT 'EN',
  `user_id` int(11) NOT NULL,
  `downloads` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `i_forms_title` (`title`),
  KEY `i_forms_created` (`created`),
  KEY `i_forms_downloads` (`downloads`),
  KEY `fk_forms_users_idx` (`user_id`),
  CONSTRAINT `fk_forms_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms`
--

LOCK TABLES `forms` WRITE;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` VALUES (1,'Causative Grammar Casino','I made this ws to practice the causative. This is a classic game where students bet with play money on whether sentences are grammatical or not. Game is to multiply their original capital of 100 dollars. Great game, tried it today, it gets adults engaged just as much as teens.','2009-09-29 09:31:00','EN',1,1474),(2,'Would You Rather ...? Quiz 2.','A second set of thought provoking quiz questions in Conditional 2.','2009-09-29 15:00:00','EN',1,1587),(3,'Would You Rather ...? Quiz','\"This worksheet features questions about hypothetical choices your students have to make, e.g. \"\"If you had to give up one of your senses, which one would it be: sight, hearing, touch, taste, smell?\"\" \"','2009-09-29 14:56:00','EN',1,991),(4,'Columbus at the Court','A historical role play (a persuasion task). Columbus wants to get funding for his voyage to India in 1492, so he pays a visit to the Spanish Queen, Isabella. In this game your students will act out what the explorer�s hearing at the Court might have looked like.','2009-09-30 00:34:00','EN',3,400),(5,'Who has the better job? Comparisons','\"Here we are going to compare jobs, and decide which one is \"\"better.\"\" Quite a subjective word, isn�t it? Well, yes, and that�s good because differing opinions can generate a lot of lively discussion in class about what really makes a job good.\"','2009-09-30 01:10:00','EN',3,3780),(6,'Stadt vs Land. Nachteile/Vorteile','Stadt vs Land. Nachteile/Vorteile','2010-07-08 16:44:00','DE',3,1607);
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-04 19:04:49
