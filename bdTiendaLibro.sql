CREATE DATABASE  IF NOT EXISTS `bookshop` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bookshop`;
-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: bookshop
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pos_book`
--

DROP TABLE IF EXISTS `pos_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pos_book` (
  `book_id` int NOT NULL AUTO_INCREMENT,
  `isbn` varchar(13) NOT NULL,
  `name` varchar(100) NOT NULL,
  `stock` int NOT NULL,
  `current_price` decimal(10,2) NOT NULL,
  `image` longtext,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pos_book`
--

LOCK TABLES `pos_book` WRITE;
/*!40000 ALTER TABLE `pos_book` DISABLE KEYS */;
INSERT INTO `pos_book` VALUES (1,'9781400334780','Las crónicas de Narnia',50,104.25,'https://www.crisol.com.pe/media/catalog/product/cache/cf84e6047db2ba7f2d5c381080c69ffe/9/7/9781400334780_idqowfcbemvm48yz.jpg'),(2,'9786123197452','Romper el círculo',50,99.00,'https://www.crisol.com.pe/media/catalog/product/cache/cf84e6047db2ba7f2d5c381080c69ffe/9/7/9786123197452_lwzbcy1rkaw365bb.jpg'),(3,'9786123199371','La sociedad de la nieve',40,69.90,'https://www.crisol.com.pe/media/catalog/product/cache/cf84e6047db2ba7f2d5c381080c69ffe/9/7/9786123199371_sflyja7ypcnsl4vl.jpg'),(4,'9786123199692','El arte de ser nosotros',65,74.93,'https://www.crisol.com.pe/media/catalog/product/cache/cf84e6047db2ba7f2d5c381080c69ffe/9/7/9786123199692_7hcbmekjwgzx1ck1.jpg'),(5,'9786123199951','El buen morir',25,59.90,'https://www.crisol.com.pe/media/catalog/product/cache/cf84e6047db2ba7f2d5c381080c69ffe/9/7/9786123199951_s27ktqcrf7tlkbog.jpg'),(6,'9786125027313','Diario',100,39.90,'https://www.crisol.com.pe/media/catalog/product/cache/cf84e6047db2ba7f2d5c381080c69ffe/9/7/9786125027313_rslylz3gbqhvkhiq.jpg'),(7,'9786125027412','Cómo ser un estoico',25,44.93,'https://www.crisol.com.pe/media/catalog/product/cache/cf84e6047db2ba7f2d5c381080c69ffe/9/7/9786125027412_zhdslyyehkuh7llt.jpg'),(8,'9788419822123','No es amor',37,99.00,'https://www.crisol.com.pe/media/catalog/product/cache/cf84e6047db2ba7f2d5c381080c69ffe/9/7/9788419822123_qbkqstrtqqgojyh3.jpg'),(9,'9789801837237','De: Mí Para: Mí',58,99.00,'https://www.crisol.com.pe/media/catalog/product/cache/cf84e6047db2ba7f2d5c381080c69ffe/9/7/9789801837237_vr6auvdlulptej49.jpg'),(10,'9786124468247','Maldita Roma.',150,99.00,'https://www.crisol.com.pe/media/catalog/product/cache/cf84e6047db2ba7f2d5c381080c69ffe/9/7/9786124468247_6aymfuv3hcko6z1d.jpg');
/*!40000 ALTER TABLE `pos_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pos_client`
--

DROP TABLE IF EXISTS `pos_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pos_client` (
  `client_id` int NOT NULL AUTO_INCREMENT,
  `doc_type` tinyint NOT NULL,
  `doc_number` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pos_client`
--

LOCK TABLES `pos_client` WRITE;
/*!40000 ALTER TABLE `pos_client` DISABLE KEYS */;
/*!40000 ALTER TABLE `pos_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pos_order`
--

DROP TABLE IF EXISTS `pos_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pos_order` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `doc_type` tinyint NOT NULL,
  `doc_number` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `fk_client_id_idx` (`client_id`),
  CONSTRAINT `fk_client_id` FOREIGN KEY (`client_id`) REFERENCES `pos_client` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pos_order`
--

LOCK TABLES `pos_order` WRITE;
/*!40000 ALTER TABLE `pos_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `pos_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pos_order_detail`
--

DROP TABLE IF EXISTS `pos_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pos_order_detail` (
  `order_detail_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `book_id` int NOT NULL,
  `detail_price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`order_detail_id`),
  KEY `order_id_idx` (`order_id`),
  KEY `fk_book_id_idx` (`book_id`),
  CONSTRAINT `fk_book_id` FOREIGN KEY (`book_id`) REFERENCES `pos_book` (`book_id`),
  CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `pos_order` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pos_order_detail`
--

LOCK TABLES `pos_order_detail` WRITE;
/*!40000 ALTER TABLE `pos_order_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `pos_order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bookshop'
--

--
-- Dumping routines for database 'bookshop'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-20 20:43:45
