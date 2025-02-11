-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: quizDB
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `leaderboard`
--

DROP TABLE IF EXISTS `leaderboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leaderboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leaderboard`
--

LOCK TABLES `leaderboard` WRITE;
/*!40000 ALTER TABLE `leaderboard` DISABLE KEYS */;
INSERT INTO `leaderboard` VALUES (12,8,200,'2025-01-19 04:01:52'),(13,10,0,'2025-01-19 04:20:48');
/*!40000 ALTER TABLE `leaderboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_type` enum('login','logout','db_modification') NOT NULL,
  `event_description` text DEFAULT NULL,
  `event_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,9,'logout','User logged out','2024-01-02 04:58:21'),(2,9,'login','User logged in','2025-01-22 04:58:26'),(3,9,'logout','User logged out','2025-01-24 05:28:52'),(4,9,'login','User logged in','2025-01-24 05:31:47'),(5,9,'logout','User logged out','2025-01-24 05:35:52'),(6,9,'login','User logged in','2025-01-24 05:36:05'),(7,9,'logout','User logged out','2025-01-24 05:37:26'),(8,9,'login','User logged in','2025-01-24 06:11:10'),(9,9,'logout','User logged out','2025-01-24 06:13:27'),(10,9,'login','User logged in','2025-01-24 06:17:22'),(11,9,'logout','User logged out','2025-01-24 06:21:35'),(12,9,'login','User logged in','2025-01-24 06:27:30'),(13,9,'login','User logged in','2025-01-24 06:27:47'),(14,9,'login','User logged in','2025-01-24 06:28:09'),(15,9,'login','User logged in','2025-01-24 06:29:12'),(16,9,'login','User logged in','2025-01-24 06:31:30'),(17,9,'login','User logged in','2025-01-24 06:34:41'),(18,9,'logout','User logged out','2025-01-24 06:40:18'),(19,9,'login','User logged in','2025-01-24 06:40:22'),(20,9,'logout','User logged out','2025-01-24 06:40:25'),(21,9,'login','User logged in','2025-01-24 06:48:01'),(22,9,'login','User logged in','2025-01-24 06:48:54'),(23,9,'login','User logged in','2025-01-24 06:48:56'),(24,9,'login','User logged in','2025-01-24 06:49:18'),(25,9,'logout','User logged out','2025-01-24 06:49:54'),(26,9,'login','User logged in','2025-01-24 06:49:57'),(27,9,'logout','User logged out','2025-01-24 06:51:01'),(28,9,'login','User logged in','2025-01-24 06:51:03'),(29,9,'logout','User logged out','2025-01-24 06:51:10'),(30,9,'login','User logged in','2025-01-24 06:51:16'),(31,9,'logout','User logged out','2025-01-24 06:51:59'),(32,9,'login','User logged in','2025-01-24 06:52:09'),(33,9,'logout','User logged out','2025-01-24 06:52:11'),(34,8,'login','User logged in','2025-01-24 06:53:57'),(35,8,'logout','User logged out','2025-01-24 06:58:57'),(36,8,'login','User logged in','2025-01-24 07:01:24'),(37,8,'logout','User logged out','2025-01-24 07:01:41'),(38,8,'login','User logged in','2025-01-24 07:02:38'),(39,8,'logout','User logged out','2025-01-24 07:07:41'),(40,9,'login','User logged in','2025-01-24 07:07:44'),(41,9,'logout','User logged out','2025-01-24 07:17:05'),(42,9,'login','User logged in','2025-01-24 07:19:26'),(43,9,'logout','User logged out','2025-01-24 07:41:25'),(44,9,'login','User logged in','2025-01-24 07:46:47'),(45,9,'logout','User logged out','2025-01-24 07:55:21'),(46,9,'login','User logged in','2025-01-24 08:18:53'),(47,9,'logout','User logged out','2025-01-24 08:18:56'),(48,8,'login','User logged in','2025-01-24 08:19:28'),(49,8,'logout','User logged out','2025-01-24 08:19:36'),(50,9,'login','User logged in','2025-01-24 08:20:20'),(51,9,'logout','User logged out','2025-01-24 08:21:29'),(52,9,'login','User logged in','2025-01-24 08:22:16'),(53,9,'logout','User logged out','2025-01-24 08:23:54'),(54,8,'login','User logged in','2025-01-24 08:23:59'),(55,8,'logout','User logged out','2025-01-24 08:28:25'),(56,9,'login','User logged in','2025-01-24 15:48:03'),(57,9,'logout','User logged out','2025-01-24 15:50:25'),(58,9,'login','User logged in','2025-01-24 15:50:27'),(59,9,'logout','User logged out','2025-01-24 15:51:36'),(60,9,'login','User logged in','2025-01-24 15:51:42'),(61,9,'logout','User logged out','2025-01-24 15:52:59'),(62,9,'login','User logged in','2025-01-24 15:53:00'),(63,9,'logout','User logged out','2025-01-24 15:53:16'),(64,9,'login','User logged in','2025-01-24 15:54:06'),(65,9,'logout','User logged out','2025-01-24 15:54:08'),(66,9,'login','User logged in','2025-01-24 15:54:15'),(67,9,'logout','User logged out','2025-01-24 15:54:18'),(68,9,'login','User logged in','2025-01-24 15:54:43'),(69,9,'logout','User logged out','2025-01-24 15:54:54'),(70,9,'login','User logged in','2025-01-24 15:55:43');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `option1` text NOT NULL,
  `option2` text NOT NULL,
  `option3` text NOT NULL,
  `option4` text NOT NULL,
  `correct_option` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `question` (`question`,`option1`,`option2`,`option3`,`option4`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'Who was the first Roman Emperor?','Julius Caesar','Aurelian','Hannibal Barka','Octavius Augustus',4),(2,'What century is considered to be the end of the Ancient period?','1 BC','5 AD','8 BC','1 AD',2),(3,'What meaning of \"Od komarca napraviti magarca\" proverb?','A small enemy can be as dangerous as a big one','To exaggerate a small issue and turn it into a big problem','A tiny nuisance can grow into a massive problem','Even the smallest effort can achieve something big',2),(4,'What language is this: \"Ја уопште не разумем овај језик\"?','Bulgarian','Belarusian','Russian','Serbian',4),(5,'What language is this: \"Я вообще не понимаю этот язык\"?','Ukrainian','Polish','Russian','Tatar',3),(6,'The capital of Pakistan is Islamabad. But what is the literal meaning of the name of this city?','City of Islam','Birthplace of Islam','Islam\'s Eternal Garden','Power of Islam',1),(7,'The end of the French Revolution connected to THIS event...','The Battle of Waterloo','The Coronation of Napoleon as Emperor','The Execution of King Louis XVI','The Coup of 18 Brumaire',4),(10,'What is the largest country in history?','Soviet Union','Mongolian Empire','Russian Empire','British Empire',4),(11,'Which event marked the unification of Croatian lands under a single ruler for the first time in history?','The Coronation of King Tomislav (925)','The Illyrian Movement (19th Century)','The Congress of Vienna (1815)','The Battle of Mohács (1526)',1),(12,'What was the key outcome of the Treaty of Zadar (1358) in Croatian history?..','It ended the reign of King Tomislav','It led to the division of Croatia between Venice and Hungary.','It marked the official transfer of Dalmatian cities to Venetian rule','It established Croatia as a protectorate of the Byzantine Empire',3);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'elements_per_page','3'),(2,'max_failed_login_attempts','7');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','player') NOT NULL DEFAULT 'player',
  `status` enum('active','inactive','blocked') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `failed_login_attempts` int(11) DEFAULT 0,
  `last_failed_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `username` (`username`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (8,'Andrew123','$2y$10$Crn9bC9BqypZxP6yVpFmx.AONgJAyfvwgQ312jbcILpu/PQqTP/L2','andrew.tate@aspira.hr','player','active','2025-01-14 21:53:08',0,NULL),(9,'TemporaMores','$2y$10$5LwYBtMmCoXyDLMrcP8oWeHTKs.TH/p73WTr.2tYqXWOm9qUvqi3K','bogdanvadimovichpanasenko@gmail.com','admin','active','2025-01-14 22:53:38',0,NULL),(10,'Nikola Tesla','$2y$10$yWD0wKTica5b7b1JYmfr2.fnaIePFDMECUYJUINt9reERdBQsi6dO','nikola.tesla@gmail.com','player','active','2025-01-15 19:54:11',0,NULL),(14,'Vladimir','$2y$10$47NmPJRVwJirQ.OVFpaW2elNQw8SMDxA5G7UmkhMulECbHRE2SrmW','aaa@gmail.com','player','blocked','2025-01-23 21:14:49',5,'2025-01-24 01:11:05'),(15,'Misha','$2y$10$8iJ9DEO2giZIRc6x4Begie5mH2kI43I9J1F.DaUNr2DNauBZrfIw6','misha.dobr@gmail.com','player','active','2025-01-23 21:16:16',0,NULL),(21,'Velika Hrvatska','$2y$10$mzTJlhK7/VdC0931pk.kFebEJGIoKzv76wUwPHTIqvBKTquffpDJi','hrvatskipatriot@mail.ru','player','inactive','2025-01-23 21:57:50',0,NULL),(22,'Test1234','$2y$10$GEekT/ZsvCGqDOiE/boBQOlYhISTdk6oqHTwfRrKHmKdVWQ2ATng6','test@gmail.com','player','active','2025-01-23 22:30:18',0,NULL),(23,'danila','$2y$10$j7oWEFMGtDgi20fTDp/HneMAO2E1XTEKXya4n4TIXcbXolCQqisD6','danila.polovnkov@mail.ru','player','inactive','2025-01-24 02:52:23',0,NULL),(24,'arseniykap','$2y$10$dvuNL8/Hk1/t2jd4s5uuLuoJgjb7sJzsy4XfdmotwCMbBbjAsIVxi','arseniykapustin@ukr.net','player','inactive','2025-01-24 02:52:57',0,NULL),(25,'Aizha123','$2y$10$O3VLSY6E71OnBbf6ENgpwu54D1/uLr8NVFOFp8P/1Hnh.GpIdZczy','azhankina@aspira.hr','player','inactive','2025-01-24 02:53:19',0,NULL),(26,'AnyaRenyami','$2y$10$GutxjFuw7A/rC1tcaWZSkeXEvCut2ebko7tcqbB1PnP5lH1h0rCda','anja@gmail.com','player','inactive','2025-01-24 02:55:16',0,NULL),(27,'123Mikola','$2y$10$Ql2GbzcMtMqj1KBm.MFEfu.JuMk/cxqE8K3d.shpxKf6hOKprtihK','1231414@gmail.com','player','inactive','2025-01-24 07:44:01',0,NULL);
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

-- Dump completed on 2025-01-24 16:55:47
