-- MySQL dump 10.14  Distrib 5.5.56-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: gamestore
-- ------------------------------------------------------
-- Server version	5.5.56-MariaDB

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
-- Temporary table structure for view `chart_bar`
--

DROP TABLE IF EXISTS `chart_bar`;
/*!50001 DROP VIEW IF EXISTS `chart_bar`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `chart_bar` (
  `games` tinyint NOT NULL,
  `count` tinyint NOT NULL,
  `year` tinyint NOT NULL,
  `month` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `chart_line`
--

DROP TABLE IF EXISTS `chart_line`;
/*!50001 DROP VIEW IF EXISTS `chart_line`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `chart_line` (
  `count` tinyint NOT NULL,
  `year` tinyint NOT NULL,
  `month` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `chart_pie`
--

DROP TABLE IF EXISTS `chart_pie`;
/*!50001 DROP VIEW IF EXISTS `chart_pie`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `chart_pie` (
  `games` tinyint NOT NULL,
  `count` tinyint NOT NULL,
  `rate` tinyint NOT NULL,
  `year` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('drikdoank@gmail.com','58bf3e637e28abec06625ce44c760315adb4ff169bb650ab350567c476111290','2017-10-10 14:06:46');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_games`
--

DROP TABLE IF EXISTS `t_games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `desc` varchar(512) NOT NULL,
  `category` varchar(256) NOT NULL,
  `img` varchar(256) NOT NULL,
  `banner` varchar(250) NOT NULL,
  `img_slider` varchar(256) NOT NULL,
  `count_play` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `coint` int(10) NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_games`
--

LOCK TABLES `t_games` WRITE;
/*!40000 ALTER TABLE `t_games` DISABLE KEYS */;
INSERT INTO `t_games` VALUES (16,'Jelly Friend','Burst all the similar jellies in a sequence without breaking it. Minimum 3 matches required','Casual','/img_game/game_iconjelly friend icon.png','/img_game/game_iconJelly friend 1024-500.jpg','',0,'2017-11-08 03:21:34','2017-11-08 03:21:34',1,'http://jellyfriend.idgms.net'),(17,'Jelly ','Burst all the similar jellies in a sequence without breaking it. Minimum 3 matches required','Casual','/img_game/game_iconjelly matche iconr.png','/img_game/game_iconJellyMatch3 1024-500.jpg','',2,'2018-06-28 05:50:22','2018-06-28 05:50:22',1,'http://jellymatch3.idgms.net'),(18,'Jewels Match','Burst all the similar Jewels in a sequence without breaking it. Minimum 3 matches required','Casual','/img_game/game_iconjewels match icon.png','/img_game/game_iconJewels Match3 1024-500.jpg','',2,'2017-11-08 03:21:40','2017-11-08 03:21:40',1,'http://jewelsmatch.idgms.net'),(19,'Jigsaw','Make a complete picture with the broken pieces by arranging them in a sequence.','Puzzle','/img_game/game_iconjigsaw puzzle icon.png','/img_game/game_iconJigsaw Puzzle 1024-500.jpg','',0,'2017-11-08 03:21:47','2017-11-08 03:21:47',1,'http://jigsaw.idgms.net'),(20,'Kids Colouring Book','Colour the objects of your choice with colours of your choice','Education','/img_game/game_iconcoloring_book_icon_512.png','/img_game/game_iconKids_coloring 1024-500.png','',0,'2017-11-08 08:46:32','2017-11-08 08:46:32',1,'http://kidscolouringbook.idgms.net'),(21,'Kids Puzzle','Complete the picture by joining the broken pieces of image','Puzzle','/img_game/game_iconKids_Puzzle icon.png','/img_game/game_iconkids_puzzle_1024-500 1024-500.jpg','',4,'2018-07-03 08:26:06','2018-07-03 08:26:06',1,'http://kidspuzzle.idgms.net'),(22,'Knight in Love','Knight is in love with the princess, but princess lives in the castle guarded by dragon, help him reach to her princess.','Action','/img_game/game_iconknight in love icon.png','/img_game/game_iconKnight in Love 1024-500.jpg','',0,'2017-11-08 03:22:17','2017-11-08 03:22:17',1,'http://knightinlove.idgms.net'),(23,'Legend of Samurai','Samurai is being followed by the dark enemy and help our little samurai evade the dark enemy.','Action','/img_game/game_iconlegend of samurai icon.png','/img_game/game_iconlegend of samuri 1024-500.jpg','',0,'2017-11-08 03:22:25','2017-11-08 03:22:25',1,'http://legendofsamurai.idgms.net'),(24,'Let\'s Park','Park your car to perfection without colliding to objects in the way, you lose a star on colliding with objects.','Casual','/img_game/game_iconlets park icon.png','/img_game/game_iconLets_park 1024-500.png','',0,'2017-11-08 03:22:32','2017-11-08 03:22:32',1,'http://letspark.idgms.net'),(25,'Lost Space','You are wandering in space trying to find route to Mars, help your spaceship to reach its destinations by avoiding dangers and obstacles in its way','Action','/img_game/game_iconlost_space icon.png','/img_game/game_iconLostSpace 1024-500.jpg','',0,'2017-11-08 03:22:39','2017-11-08 03:22:39',1,'http://lostspace.idgms.net'),(26,'Magic Run','Boy has entered into the world full of witches performing black magic, help him reach his world. There are many dangers on his way, he is also followed by a witch.','Adventure','/img_game/game_iconMagic_run icon.png','/img_game/game_iconMagic_run 1024-500.png','',0,'2017-11-08 03:24:07','2017-11-08 03:24:07',1,'http://magicrun.idgms.net'),(27,'Math Game for Kids','Test your math skills with this Math Game','Education','/img_game/game_iconmatch game for kids icon.png','/img_game/game_iconMath Game For Kids 1024-500.jpg','',0,'2017-11-08 08:46:17','2017-11-08 08:46:17',1,'http://mathgameforkids.idgms.net'),(28,'Mathematics','Test your math skills with this Math Game','Education','/img_game/game_iconmathematic icon.png','/img_game/game_iconMathematic 1024-500.jpg','',0,'2017-11-08 08:45:51','2017-11-08 08:45:51',1,'http://mathematics.idgms.net'),(29,'Monster','Burst all the similar faced Monsters in a sequence without breaking it. Minimum 3 matches required','Puzzle','/img_game/game_iconmonster match 3 icon.png','/img_game/game_iconMonstersMatch3 1024-500.jpg','',1,'2018-04-25 08:44:20','2018-04-25 08:44:20',1,'http://monstermatch3.idgms.net'),(30,'Ninja Clan','We have heard Ninjas are quick, well actually they are, but their star weapons is much quicker that them, help them collect food for their village by avoiding stars','Action','/img_game/game_iconninja clan icon.png','/img_game/game_iconninja clan 1024-500.jpg','',0,'2017-11-08 03:24:38','2017-11-08 03:24:38',1,'http://ninjaclan.idgms.net'),(31,'Ninja Run','Ninja is on his way home, from an unknown place, help him reach home.','Adventure','/img_game/game_iconninja run icon.png','/img_game/game_iconNinja Run 1024-500.jpg','',3,'2018-04-25 08:39:13','2018-04-25 08:39:13',1,'http://ninjarun.idgms.net'),(32,'Piggy Roll','Piggy is hungry and has smelled chocolates, help it reach chocolate basket and do not forget to collect stars','Adventure','/img_game/game_iconpiggy_roll icon.png','/img_game/game_iconPiggyRoll 1024-500.jpg','',0,'2017-11-08 08:44:41','2017-11-08 08:44:41',1,'http://piggyroll.idgms.net	'),(33,'Pixel Castle Runner','You have lost your way into old dark castle, there is only one way to get out is move forward, help yourself to the exit by avoiding obstacles in your way','Adventure','/img_game/game_iconpixel_castle_runner icon.png','/img_game/game_iconPixelCastleRunner 1024-500.jpg','',0,'2017-11-08 08:44:27','2017-11-08 08:44:27',1,'http://pixelcastlerunner.idgms.net'),(34,'Pops Billiards','Pot all the balls on Pool Table in minimum time','Casual','/img_game/game_iconpops billiards icon.png','/img_game/game_iconPopsBilliards 1024-500.jpg','',9,'2018-06-28 05:48:07','2018-06-28 05:48:07',1,'http://popsbilliards.idgms.net'),(35,'Princess Goldblade and Dangerous Waters','Princess is on a mission to rescue her father from enemies. Help her in this cause to find and rescue her father','Adventure','/img_game/game_iconprincess_goldblade_and_the_dangerous_water icon.png','/img_game/game_iconPrincess Goldblade and the Dangerous Waters 1024-500.jpg','',9,'2018-06-28 05:57:02','2018-06-28 05:57:02',1,'http://princessgoldbladeanddangerouswaters.idgms.net'),(36,'Puzzle','Make a complete picture with the broken pieces by arranging them in a sequence.','Puzzle','/img_game/game_iconPuz_icon.png','/img_game/game_icon1024-500_puzzle.jpg','',2,'2017-11-08 08:47:02','2017-11-08 08:47:02',1,'http://puzzle.idgms.net'),(37,'Random Runner','You are on adventurous journey, go as far as you can. Avoid the obstacles on your way and you are through','Adventure','/img_game/game_iconrandom_runner icon.png','/img_game/game_iconRandomRunner 1024-500.jpg','',7,'2018-07-03 08:20:32','2018-07-03 08:20:32',1,'http://randomrunner.idgms.net');
/*!40000 ALTER TABLE `t_games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `t_games_rate`
--

DROP TABLE IF EXISTS `t_games_rate`;
/*!50001 DROP VIEW IF EXISTS `t_games_rate`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `t_games_rate` (
  `id_game` tinyint NOT NULL,
  `avg_rate` tinyint NOT NULL,
  `user_rate` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `t_play_games`
--

DROP TABLE IF EXISTS `t_play_games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_play_games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idplayer` int(11) NOT NULL,
  `idgames` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `score` int(11) NOT NULL,
  `subscription` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_play_games`
--

LOCK TABLES `t_play_games` WRITE;
/*!40000 ALTER TABLE `t_play_games` DISABLE KEYS */;
INSERT INTO `t_play_games` VALUES (1,21,37,'2018-06-28 05:55:59','2018-06-28 05:55:59',0,5),(2,21,35,'2018-06-28 05:56:46','2018-06-28 05:56:46',0,5),(3,21,21,'2018-07-03 08:21:40','2018-07-03 08:21:40',0,5);
/*!40000 ALTER TABLE `t_play_games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_rate`
--

DROP TABLE IF EXISTS `t_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_game` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `rate` varchar(128) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `comment` varchar(512) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_rate`
--

LOCK TABLES `t_rate` WRITE;
/*!40000 ALTER TABLE `t_rate` DISABLE KEYS */;
INSERT INTO `t_rate` VALUES (1,37,21,'4','Didok','','mantaap','2018-06-28 05:56:20','2018-06-28 05:56:20'),(2,35,21,'3','Didok','','dd','2018-06-28 05:56:58','2018-06-28 05:56:58');
/*!40000 ALTER TABLE `t_rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_activations`
--

DROP TABLE IF EXISTS `user_activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_activations` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `activated` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_activations`
--

LOCK TABLES `user_activations` WRITE;
/*!40000 ALTER TABLE `user_activations` DISABLE KEYS */;
INSERT INTO `user_activations` VALUES (5,1,'1d077bb8900a01f5445e6c6f93f00470ce63ce868cc20436927956077a0a653d','2017-06-10 21:30:13',NULL),(6,2,'8a3ab48a7b8caae8e509c858409daf183cf6b36ee21ce961a2a0965d46a61271','2017-06-11 01:53:56',NULL),(7,6,'f7c80b8068ebefed64aa9e4a7c6b055ee5f4664a0089164dcc67972fe36d6d29','2017-06-17 05:28:52',NULL),(8,7,'95615c0200c301b903332584d7ff323b5433e8a3e0aaf4031de5b06db6447921','2017-07-05 21:39:12',NULL),(9,8,'026cc1b26b2b45912cf391a4b0380845b14dc90ee74d78eb96414e7afa0ef5aa','2017-08-21 07:34:37',NULL),(10,9,'9789d4ad0b78344cc4ffa1c9ff91a46a9e520c469d1886d400b317ffa84f8137','2017-08-21 07:37:33',NULL);
/*!40000 ALTER TABLE `user_activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(225) NOT NULL,
  `img` varchar(225) NOT NULL,
  `role` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `remember_token` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activated` varchar(128) NOT NULL,
  `coint` int(11) NOT NULL DEFAULT '299',
  `birthdate` date NOT NULL,
  `sex` varchar(150) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `subdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Indiyani','indri.cs49@gmail.com','/img_profil/indri.jpg','1','$2a$04$rDJT81iyK13CoYpxadkIAus.TRCGOoO6fIRhIBtPhWuIB.VAuIxjC','0tjP6zvM0b74mHcVrYj7VPDfcvgcmNZPDLxSS5U8shKT9vhfIQOJVqTvf76B','2017-08-21 14:36:39','2017-06-11 04:31:55','1',299,'2014-05-01','Female','082318567471','','0000-00-00 00:00:00'),(2,'dda','indriyani.cs49@gmail.com','/img_profil/Screen Shot 2017-06-17 at 5.43.15 PM.png','2','$2y$10$1c/5xcNjiUUqOvoLuKjEsOMLgijBnSNkgOcnfHpcSQkx5.xvJdAfC','GaWhr6fZIfns0HVav9MJNVyHc3w5ojr8qBhq6q1XyL9uR72w23FKlkkt1rvt','2017-08-21 14:36:42','2017-06-11 04:33:00','1',299,'2017-02-06','Male','082318567472','','0000-00-00 00:00:00'),(11,'Hendrik','drikdoank@gmail.com','/img_profil/npwp.jpg','1','$2y$10$h9BO0mg.c967bZreikI8eObRG8NXsHi7CnFLIY42BBCzMXWfH00Xa','hsQcYMky6wAh9hx8auYWXoSqiEVM7fPhBmLOhow9nFMArIVStiIAOkQGEYfi','2018-06-28 05:42:13','2018-06-28 05:42:13','1',242,'1991-09-05','Male','082318567475','','2018-06-28 05:41:40'),(12,'Bondrax','bondrak@gmail.com','','2','$2y$10$qs3XSYdUSAfQz18/HrZFieGtyTIPgPZnreTTQw.THVMipCtmDSPH.','','2017-09-06 19:30:31','2017-09-06 19:30:31','1',299,'1991-01-20','man','0820182912','Pamanukan','0000-00-00 00:00:00'),(13,'Indosat','indosat@gmail.com','/img_profil/download.jpeg','2','$2y$10$wCv0c3Fy43HUdvgs.jjzhey8JffxqbQYc6xlW8et4j0x6S/KrQ4SW','','2017-11-28 06:54:15','2017-11-28 06:54:15','1',278,'2017-11-06','Male','001','Jakarta','0000-00-00 00:00:00'),(14,'','','','2','$2y$10$tadt650Tih6tvvEAz/ZDt.YzMsuHA.vE9d097oKIde0g1Kf3KisdW','','2017-11-22 08:12:38','2017-11-22 08:12:38','1',299,'0000-00-00','','1757653529212','','0000-00-00 00:00:00'),(15,'','','','2','$2y$10$/fUowCa7odoQEvQvl69MFONbilkRiuEVF85jE90s3ZbiGg1I1z6CG','','2017-11-27 10:03:09','2017-11-27 10:03:09','1',299,'0000-00-00','','12819283','','0000-00-00 00:00:00'),(16,'Guess','guess@gmail.com','/img_profil/3E3B74CB-4EB7-426A-9150-B3C82CFF3DB2.png','2','$2y$10$r5E7.P66blDEIEwidxNTrOpHwBy7GAyhPtLOHzedpVD14G32n1ppK','Zl0hN1qQqDuQZkXe3pP95BiSQGXjJXiIVc1D9Xg5VTeHQ1se3FPqMuME91E8','2018-04-05 06:26:17','2018-04-05 06:26:17','1',299,'2018-04-05','Male','081222333444','Bogor','0000-00-00 00:00:00'),(17,'','','','2','$2y$10$kBcCw0hkWVTXM6FmQcQxQO3TqF/PD4XrZChhVN.LaxUC6x8Et1m9y','3W71g74811CSxoZ7eOTEBmqsvp5nFpCuQEJc3K4G5BxXqIKPc25wkM1TYLML','2018-04-25 09:55:28','2018-04-25 09:55:28','1',297,'0000-00-00','','1757653528','','0000-00-00 00:00:00'),(18,'','','','2','$2y$10$rKExJKxz6iLxzUS0ENb5XOs6FjYO3ZHgCi12p1Vv/ZJuGprMv5IzS','','2018-04-25 08:44:20','2018-04-25 08:44:20','1',298,'0000-00-00','','6281212007526','','0000-00-00 00:00:00'),(19,'','','','2','$2y$10$KANhnLuLu1BHxAjdF7kYYOtSWxnm0f9nhzZvcyNCMFunLXGZ7iNGe','','2018-05-08 06:22:10','2018-05-08 06:22:10','1',299,'0000-00-00','','081939303515','','2018-05-08 06:22:10'),(20,'','','','2','$2y$10$tUPc.MQaP00UKj6lJaDK/.OAvxcCVtWDP/QbwYqtrCHfGmcS/rEQG','','2018-06-28 05:40:28','2018-06-28 05:40:28','1',299,'0000-00-00','',' 082318567475','','2018-06-28 05:40:28'),(21,'Didok','','/upload/images/wilmar.jpg','2','$2y$10$7DCrCvuT8XJR9huktlC1eOCW6JADEnzJemTNBb74hK02H4N4Bdzo2','JuyJcCyKpns10WhTILdIOg2npETeyOIHZH0y1f0NNmLSdyWP5IDQJMuPLlY4','2018-07-03 08:26:06','2018-07-03 08:26:06','1',286,'2018-06-28','Male','082318567474','','2018-06-28 05:41:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `chart_bar`
--

/*!50001 DROP TABLE IF EXISTS `chart_bar`*/;
/*!50001 DROP VIEW IF EXISTS `chart_bar`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `chart_bar` AS select `t_games`.`name` AS `games`,count(`t_play_games`.`id`) AS `count`,year(`t_play_games`.`created_at`) AS `year`,monthname(`t_play_games`.`created_at`) AS `month` from (`t_play_games` join `t_games` on((`t_games`.`id` = `t_play_games`.`idgames`))) group by `t_play_games`.`idgames`,year(`t_play_games`.`created_at`),monthname(`t_play_games`.`created_at`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `chart_line`
--

/*!50001 DROP TABLE IF EXISTS `chart_line`*/;
/*!50001 DROP VIEW IF EXISTS `chart_line`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `chart_line` AS select count(`t_play_games`.`id`) AS `count`,year(`t_play_games`.`created_at`) AS `year`,monthname(`t_play_games`.`created_at`) AS `month` from `t_play_games` group by monthname(`t_play_games`.`created_at`),year(`t_play_games`.`created_at`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `chart_pie`
--

/*!50001 DROP TABLE IF EXISTS `chart_pie`*/;
/*!50001 DROP VIEW IF EXISTS `chart_pie`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `chart_pie` AS select `t_games`.`name` AS `games`,count(`t_rate`.`rate`) AS `count`,`t_rate`.`rate` AS `rate`,year(`t_rate`.`created_at`) AS `year` from (`t_rate` join `t_games` on((`t_games`.`id` = `t_rate`.`id_game`))) group by `t_rate`.`rate`,year(`t_rate`.`created_at`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `t_games_rate`
--

/*!50001 DROP TABLE IF EXISTS `t_games_rate`*/;
/*!50001 DROP VIEW IF EXISTS `t_games_rate`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `t_games_rate` AS select `t_rate`.`id_game` AS `id_game`,round(avg(`t_rate`.`rate`),2) AS `avg_rate`,count(`t_rate`.`email`) AS `user_rate` from `t_rate` group by `t_rate`.`id_game` */;
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

-- Dump completed on 2018-07-06  3:27:13
