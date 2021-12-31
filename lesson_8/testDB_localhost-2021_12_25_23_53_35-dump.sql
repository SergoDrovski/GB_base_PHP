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
-- Table structure for table `basket`
--

DROP TABLE IF EXISTS `basket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `basket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `basket`
--

LOCK TABLES `basket` WRITE;
/*!40000 ALTER TABLE `basket` DISABLE KEYS */;
INSERT INTO `basket` (`id`, `date`) VALUES (1,'2021-12-15 16:21:06'),(2,'2021-12-15 16:30:07'),(3,'2021-12-19 18:16:25'),(4,'2021-12-19 18:25:56'),(5,'2021-12-19 20:36:27'),(6,'2021-12-19 20:38:05'),(7,'2021-12-19 20:39:24'),(8,'2021-12-19 20:40:15'),(9,'2021-12-19 20:40:34'),(10,'2021-12-19 20:42:08'),(11,'2021-12-19 20:43:27'),(12,'2021-12-20 18:35:27'),(13,'2021-12-21 09:37:13');
/*!40000 ALTER TABLE `basket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `basket_goods`
--

DROP TABLE IF EXISTS `basket_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `basket_goods` (
  `id` int NOT NULL AUTO_INCREMENT,
  `basket_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` smallint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `relation_row_unique` (`basket_id`,`product_id`),
  KEY `basket_id` (`basket_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `FK_Basket` FOREIGN KEY (`basket_id`) REFERENCES `basket` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_Goods` FOREIGN KEY (`product_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `basket_goods`
--

LOCK TABLES `basket_goods` WRITE;
/*!40000 ALTER TABLE `basket_goods` DISABLE KEYS */;
INSERT INTO `basket_goods` (`id`, `basket_id`, `product_id`, `quantity`) VALUES (1,1,2,2),(2,1,1,6),(5,2,1,1),(6,4,2,2),(7,11,1,5),(8,11,2,1),(9,12,1,18),(10,12,2,1);
/*!40000 ALTER TABLE `basket_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `goods` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_good` varchar(100) DEFAULT NULL,
  `description` text,
  `price` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` (`id`, `title_good`, `description`, `price`, `quantity`, `category_id`) VALUES (1,'Деталь 1','Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами.',1232,6,1),(2,'Деталь 2','Великий Оксмокс предупреждал ее о злых запятых, диких знаках вопроса и коварных точках с запятой, но текст не дал сбить себя с толку. Он собрал семь своих заглавных букв, подпоясал инициал за пояс и пустился в дорогу.',7196,14,1),(7,'Деталь 3','Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель',4550,2,1);
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
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
  `good_id` int NOT NULL,
  `preview` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `good_id` (`good_id`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`id`, `title_img`, `alt`, `count`, `good_id`, `preview`) VALUES (1,'64e2307529ad4275ca69f9e6400f254b.jpg','img',13,1,1),(2,'d2c7c8851802eeb45d15bcf3d26f33d5.jpg','img',40,2,1),(3,'f8b38e1916e0a2b057adc09fc5e7d644.jpg','img',33,7,1);
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
  `rating` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `reviews_ibfk_1` (`goods_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` (`id`, `name`, `text`, `goods_id`, `date`, `parent_id`, `rating`) VALUES (1,'sergei','Однажды одна маленькая строчка рыбного текста по имени Lorem ipsum решила выйти в большой мир грамматики',1,'2021-12-08 13:09:41',NULL,3),(2,'roma','Задача организации, в особенности же постоянный количественный рост и сфера нашей активности позволяет выполнять важные задания по разработке системы обучения кадров, соответствует насущным потребностям.',1,'2021-12-08 13:13:52',NULL,2),(3,'evgen','Повседневная практика показывает, что рамки и место обучения кадров позволяет оценить значение позиций,',1,'2021-12-09 05:45:21',NULL,5),(4,'lia','Не следует, однако забывать, что укрепление и развитие структуры обеспечивает широкому кругу (специалистов) участие в формировании соответствующий условий активизации. ',2,'2021-12-09 06:14:06',NULL,2),(5,'rita','Задача организации, в особенности же дальнейшее развитие различных форм деятельности позволяет оценить значение соответствующий условий активизации.',2,'2021-12-09 06:17:51',NULL,2),(6,'sasha','Значимость этих проблем настолько очевидна, что постоянный количественный рост и сфера нашей активности требуют от нас анализа форм развития.',2,'2021-12-09 06:20:10',NULL,5),(7,'dima','INSERT INTO reviews (name, text, goods_id) VALUES (?, ?, ?)',7,'2021-12-09 06:25:09',NULL,1),(8,'вася','Повседневная практика показывает, что начало повседневной работы по формированию позиции позволяет выполнять важные задания по разработке модели развития. ',7,'2021-12-09 06:30:18',NULL,5),(10,'Ирина','Товарищи! начало повседневной работы по формированию позиции позволяет выполнять важные задания по разработке дальнейших направлений развития.',1,'2021-12-13 13:32:04',NULL,3),(11,'Евген','соответствует насущным потребностям. Значимость этих проблем настолько очевидна, что постоянный количественный рост и сфера нашей активности требуют от нас анализа форм развития.',1,'2021-12-13 13:43:48',NULL,3),(12,'1234','123123',1,'2021-12-13 13:59:30',NULL,5),(13,'123123213123','fghfsdghsdfghdsfghdfghdfgh',1,'2021-12-13 13:59:42',NULL,5),(14,'сергей','Товар не очень!!!!!',2,'2021-12-15 09:20:03',NULL,1),(15,'маша','товар так себе',1,'2021-12-20 18:34:20',NULL,1);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES (1,'Сергей','sergiodrovski@gmail.com','$2y$10$tv9jCiYUhUtQJTeuDIVVD.IB42dcKs3bWsIz/r3rOiGYLLHBl56Yu'),(2,'Roma','chleniks@yandex.ru','$2y$10$AOp8iKkeF4myPltt5w.TrehBuCauchFMqlZ7342vPDt5gEr/G5.Ie');
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

-- Dump completed on 2021-12-25 23:53:36
