-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: testDB
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.20.04.1

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
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `goods` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_good` varchar(100) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES (1,'Умный браслет Xiaomi Mi Smart Band 6','Mi Smart Band 6 стирает границы!\nНевероятно широкий функционал Mi Smart Band 6 и внушительная диагональ экрана 1,56 дюйма позволяют гаджету шагнуть за черту привычного фитнес-трекера',1232,6,1),(2,'ТВ-приставка Xiaomi Mi Box S','ТВ-приставка Xiaomi Mi Box S создана на базе Amlogic S905X и имеет 4 ядра Cortex-A53. В качестве ускорителя используется Mali-450. Оперативной памяти на 2 Гб вполне хватает на выполнение всех задач. ',7196,14,1);
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods1`
--

DROP TABLE IF EXISTS `goods1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `goods1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_good` varchar(100) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods1`
--

LOCK TABLES `goods1` WRITE;
/*!40000 ALTER TABLE `goods1` DISABLE KEYS */;
/*!40000 ALTER TABLE `goods1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_img` varchar(50) DEFAULT NULL,
  `alt` varchar(30) DEFAULT NULL,
  `count` int DEFAULT NULL,
  `size` int DEFAULT NULL,
  `good_id` int NOT NULL,
  `preview` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `good_id` (`good_id`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'9hq.webp','img',13,3471,1,1),(2,'mujc3.jpeg','img',40,3078,2,NULL),(3,'13hq.webp','img',33,212999,1,NULL),(4,'retetee.webp','img',2,60702,2,1),(5,'13htq.webp','img',1,3242,1,NULL),(6,'rthht.png','img',4,4353,2,NULL);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `goods_id` int NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `reviews_ibfk_1` (`goods_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,'ertert','ertert',1,'2021-12-08 16:09:41',NULL),(2,'3','3',2,'2021-12-08 16:13:52',4),(3,'Jakarta','sdfsdfsdfsdfsdf',2,'2021-12-09 08:45:21',NULL),(4,'TEST','1234',2,'2021-12-09 09:14:06',NULL),(5,'sdfsdf','67567567567',2,'2021-12-09 09:17:51',NULL),(6,'gyjk','tryrty',2,'2021-12-09 09:20:10',NULL),(7,'ertghh','INSERT INTO reviews (name, text, goods_id) VALUES (?, ?, ?)',2,'2021-12-09 09:25:09',NULL),(8,'Евген','&lt;h1 class=&quot;Uo8X3b OhScic zsYMMe&quot;&gt;Режимы поиска&lt;/h1&gt;',2,'2021-12-09 09:30:18',NULL);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-09 12:37:07
