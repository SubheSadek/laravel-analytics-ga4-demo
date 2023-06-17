-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: samc
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'assets/images/profile_pic.png',
  `user_type` enum('SUPER_ADMIN','ADMIN','USER') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USER',
  `status` enum('ACTIVE','BANNED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_name_phone_email_index` (`name`,`phone`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Dr. Shanon Steuber','admin@gmail.com','$2y$10$hbxUhKBKWNOkcpCqwFDBPutlv8kxdjnaTLHgla9H33cHZSC77Wx6y',NULL,'assets/images/profile_pic.png','SUPER_ADMIN','BANNED',NULL,'2023-05-22 01:42:14','2023-05-24 06:30:11'),(3,'Estelle Brekke I','roberto36@example.org','$2y$10$UYZQNb8ldnRxBPtrJusHYOp./lAvglueNrF9mCERuSm6lQFtnRM5W',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(4,'Mr. Jasper Gutkowski Sr.','thiel.cleora@example.net','$2y$10$lPLWqsqPiNlm.aXbA.VnLejZ7S0zTp7UUAEtlt//pjbVmj6fTnd7W',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(5,'Ernestina Beier','adan.sauer@example.org','$2y$10$IeUQf/z/7N2BSQ5zYVmzE.1pvUgMD1lCY5uT01PKLIQjq0oxnUteO',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(6,'Miss Emily Gusikowski','tamia.haag@example.org','$2y$10$hDLIQHWFpnPL4yFbbachw.d9pocfbEPAg0Ibldvu1ch4pq2qyDmqS',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(7,'Billie Kub','zstamm@example.org','$2y$10$8g5mvwcx2BIu1LvXJCWg7.4sPv2eF1LiHvqvMXlg/.l67/0poj8QG',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(8,'Cristian Eichmann IV','kaylie81@example.org','$2y$10$RxFaN3zffnXikTJJAgCy8eq1TZSyuPAGH6P2/sqvPcHx/1v9grKyS',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(9,'Lexus Dietrich','raymundo18@example.org','$2y$10$cwqsWG1080pnLqusm9ttC.PQy8a7/HQchvIs4474C3lxbY4uqlJiC',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(10,'Prof. Laney Emmerich','ward.marielle@example.org','$2y$10$AJYzKWghsceM9IMXir/g0env1Lhg/DkZ1A7U4WQ3eKEh/Dgz7ai4i',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(11,'Prof. Abdiel Doyle','esmeralda.swaniawski@example.org','$2y$10$dIKRoEOwJNqUC3KqZquxJORJN0Q0klOMA3FBpQqftaGNGHGxdB5k.',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(12,'Dr. Jay Bashirian','mfay@example.org','$2y$10$DPEWZiG0.nP0Y.gV2iS4WeotPT0E60U/ioKC9nlsHumqHg8kU8PvS',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(13,'Carmen Howell','jpadberg@example.com','$2y$10$X1MQOQIxyZ340/yk/1gBGetI5tzkRHJxpDXEPZRvlKEJWN9qXWu/.',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(14,'Conrad Wolf','morar.johan@example.net','$2y$10$7gbbW56xA54NDpEGLeNUcuNdwQmHCsNoPUDidNlk/QYEYFGGKecFK',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(15,'Rafaela Wiza I','dach.willy@example.org','$2y$10$FkU5.hUZuy1oaEsoLtrRRumxcTYg4QNtR7q6wgMv34tUBpPYcD87.',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(16,'Mr. Lloyd Mitchell','runolfsdottir.genevieve@example.org','$2y$10$6MCLEqGDb7fyMhI8sjS9QuvpEalub3.JXd7frEak8stt95x1Sa3nu',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(17,'Juvenal Rolfson','clinton.nikolaus@example.net','$2y$10$ZH6IyV5J/fdjAwAUYlvCmuo.jG/NvJjqtaf6KDW0iEGWMMRBhtZdS',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(18,'Danyka Bauch DDS','dannie35@example.net','$2y$10$wFm7Qi5q9VfI94bPbgjkTef3pdDKdIvWqLxcAMTXLDiaBu7ANuhk.',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(19,'Karina Lang Sr.','kaylah.zemlak@example.org','$2y$10$rW1mc.Zp9c8rS8fxIivjWeHFSjpWToqu39ihxNAZ1IhjyAMmiDAxy',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(20,'Pearl Hoeger','timmy.pagac@example.com','$2y$10$Xr.UIU1LiXj5nRKDwUmzw.lOACG4/u1laAxLu7NK4yaOz/AYA0Hc6',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(21,'Kari Balistreri','nikita69@example.org','$2y$10$376H9U/tdI8dd9BRpj9aCe/qgnnsajlAe9kVx4Q224B5evFfN4nqC',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40'),(22,'Hadley Pfeffer','jennie.reichel@example.com','$2y$10$OraFVVl4P4P/C2PdvV.RSeszMaUmRha6nasr9Wl5d7Vi2S.6T214C',NULL,'assets/images/profile_pic.png','USER','ACTIVE',NULL,'2023-05-22 04:59:40','2023-05-22 04:59:40');
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

-- Dump completed on 2023-05-25 10:51:14
