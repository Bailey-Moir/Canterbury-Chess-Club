-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: canterbury_chess_club
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `game_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `black_member_id` int(3) unsigned NOT NULL,
  `white_member_id` int(3) unsigned NOT NULL,
  `tournament_id` int(2) unsigned NOT NULL,
  `result` int(1) unsigned NOT NULL,
  `moves` varchar(500) NOT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (1,1,2,1,1,'e4 e5 Nf3 Nc6 Bb5 a6 Ba4 Nf6 O-O Be7 Re1 b5 Bb3 d6 c3 O-O h3 Bb7 d4 Na5 Bc2 Nc4 b3 Nb6 Nbd2 Nbd7 b4 exd4 cxd4 a5 bxa5 c5 e5 dxe5 dxe5 Nd5 Ne4 Nb4 Bb1 Rxa5 Qe2 Nb6 Nfg5 Bxe4 Qxe4 g6 Qh4 h5 Qg3 Nc4 Nf3 Kg7 Qf4 Rh8 e6 f5 Bxf5 Qf8 Be4 Qxf4 Bxf4 Re8 Rad1 Ra6 Rd7 Rxe6 Ng5 Rf6 Bf3 Rxf4 Ne6+ Kf6 Nxf4 Ne5 Rb7 Bd6 Kf1 Nc2 Re4 Nd4 Rb6 Rd8 Nd5+ Kf5 Ne3+ Ke6 Be2 Kd7 Bxb5+ Nxb5 Rxb5 Kc6 a4 Bc7 Ke2 g5 g3 Ra8 Rb2 Rf8 f4 gxf4 gxf4 Nf7 Re6+ Nd6 f5 Ra8 Rd2 Rxa4 f6'),(2,1,3,1,1,'e4 d6 d4 Nf6 Nc3 g6 f4 Bg7 a3 O-O Nf3 Bg4 h3 Bxf3 Qxf3 Nc6 Be3 e5 dxe5 dxe5 f5 Nd4 Qf2 Nd7 g4 c6 O-O-O b5 g5 f6 h4 a5 h5 fxg5 hxg6 h6 Ne2 c5 Nc3 b4 Bc4+ Kh8 Rxh6+ Bxh6 Qh2 Kg7 Qxh6+ Kxh6 Rh1+'),(3,4,2,3,1,'e4 e5 Nf3 Nc6 Bc4 Bc5 c3 Nf6 d3 d6 O-O Bg4 h3 Bh5 Nbd2 Qe7 Re1 O-O-O Nf1 Bb6 Ng3 h6 b4 Rdg8 Qe2 Nd8 Bd2 c6 a4 Bg6 Qf1 Ne6 Be3 Kb8 Red1 Bh7 Kh1 g5 Bb3 Rg7 c4 Rhg8 d4 exd4 Nxd4 Nf4 f3 Qd7 Bf2 h5 Qe1 a6 Nf1 Qe8 Ng3 Qd7 Nf1 Qe8 Ne3 h4 b5 cxb5 axb5 axb5 cxb5 Nxe4 fxe4 Bxe4 Qf1 Bd8 Nc4 Be7 Ra8+ Kxa8 Ra1+ Kb8 Ra8+ Kxa8 Qa1+ Kb8 Qa7+ Kxa7 Nc6+ Ka8 Nb6'),(4,3,1,2,0,'e4 e5 Nf3 Nc6 Bc4 Bc5 c3 Nf6 d3 d6 O-O Bg4 h3 Bh5 Nbd2 Qe7 Re1 O-O-O Nf1 Bb6 Ng3 h6 b4 Rdg8 Qe2 Nd8 Bd2 c6 a4 Bg6 Qf1 Ne6 Be3 Kb8 Red1 Bh7 Kh1 g5 Bb3 Rg7 c4 Rhg8 d4 exd4 Nxd4 Nf4 f3 Qd7 Bf2 h5 Qe1 a6 Nf1 Qe8 Ng3 Qd7 Nf1 Qe8 Ne3 h4 b5 cxb5 axb5 axb5 cxb5 Nxe4 fxe4 Bxe4 Qf1 Bd8 Nc4 Be7 Ra8+ Kxa8 Ra1+ Kb8 Ra8+ Kxa8 Qa1+ Kb8 Qa7+ Kxa7 Nc6+ Ka8 Nb6'),(5,1,2,1,0,'e4 e6 d4 d5 Nc3 Nf6 Bg5 Bb4 e5 h6 Bd2 Bxc3 bxc3 Ne4 Qg4 g6 Bd3 Nxd2 Kxd2 c5 Nf3 Nc6 Qf4 Qc7 h4 f5 g4 cxd4  cxd4 Ne7 gxf5 exf5 Bb5+ Kf8 Bd3 Be6 Ng1 Kf7 Nh3 Rac8  Rhg1 b6 h5 Qc3+ Ke2 Nc6 hxg6+ Kg7 Rad1 Nxd4+ Kf1 Rhe8  Rg3 Nc6 Qh4 Nxe5 Nf4 Ng4 Nxe6+ Rxe6 Bxf5 Qc4+ Kg1');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `member_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(4) unsigned DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `birth_year` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nzcf_code` int(7) NOT NULL,
  `fide_code` int(7) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,NULL,'Aaron','2023-09-24 10:21:37',1234567,1234567),(2,NULL,'Brock','2023-09-24 10:21:37',2234567,2234567),(3,NULL,'Caleb','2023-09-24 10:21:37',3234567,3234567),(4,NULL,'Dominic','2023-09-24 10:21:37',4234567,4234567);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `rating_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(3) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rating_standard` int(4) unsigned NOT NULL,
  `rating_rapid` int(4) unsigned NOT NULL,
  `rating_blitz` int(4) unsigned NOT NULL,
  PRIMARY KEY (`rating_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournaments`
--

DROP TABLE IF EXISTS `tournaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournaments` (
  `tournament_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `date_start` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_end` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `num_rounds` int(1) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`tournament_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournaments`
--

LOCK TABLES `tournaments` WRITE;
/*!40000 ALTER TABLE `tournaments` DISABLE KEYS */;
INSERT INTO `tournaments` VALUES (1,'0000-00-00 00:00:00','0000-00-00 00:00:00',6,'Arie Nijman Cup 2022'),(2,'0000-00-00 00:00:00','0000-00-00 00:00:00',6,'Chas L Hart Cup 2022'),(3,'0000-00-00 00:00:00','0000-00-00 00:00:00',6,'Eric Brown Shield 2022'),(4,'0000-00-00 00:00:00','0000-00-00 00:00:00',8,'Club Championships 2022 B Grad'),(5,'0000-00-00 00:00:00','0000-00-00 00:00:00',7,'Club Championships 2022 A Grad'),(6,'0000-00-00 00:00:00','0000-00-00 00:00:00',6,'Arie Nijman Memorial 2022'),(7,'0000-00-00 00:00:00','0000-00-00 00:00:00',6,'Colthart Cup 2022'),(8,'0000-00-00 00:00:00','0000-00-00 00:00:00',6,'Summer Rapid 2022');
/*!40000 ALTER TABLE `tournaments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(4) unsigned DEFAULT NULL,
  `email` varchar(48) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(60) NOT NULL,
  `security` tinyint(1) unsigned NOT NULL,
  `verified` tinyint(1) unsigned NOT NULL,
  `status` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,'admin@gmail.com','admin','$2y$10$5B46OYDob8Tyo3u1iugcGeKVjPdwO6AXl8vX9ch2wIpn8pefO6d/m',1,1,NULL);
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

-- Dump completed on 2023-09-24 23:21:49
