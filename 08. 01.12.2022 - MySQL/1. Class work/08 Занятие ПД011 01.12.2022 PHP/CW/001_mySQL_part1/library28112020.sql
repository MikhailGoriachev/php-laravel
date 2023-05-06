CREATE DATABASE  IF NOT EXISTS `library` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `library`;
-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: library
-- ------------------------------------------------------
-- Server version	8.0.22

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
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `authors` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='Таблица авторов';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,'Шилдт Г.'),(2,'Кент Дж.'),(3,'Абрамян М.Э.'),(4,'Дейтел П.'),(5,'Кузнецов И.А.'),(6,'Егоренко В.Н.'),(7,'Кравец С.А.'),(8,'Шарп Дж.'),(9,'Васильев А.Н.'),(10,'Ицик Бен-Ган'),(11,'Олифер Д.');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idAuthor` int unsigned DEFAULT NULL,
  `idCategory` int unsigned DEFAULT NULL,
  `title` varchar(190) NOT NULL,
  `year` int NOT NULL,
  `price` double NOT NULL,
  `amount` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_to_categories_idx` (`idCategory`),
  KEY `fk_to_authors_idx` (`idAuthor`),
  CONSTRAINT `fk_to_authors` FOREIGN KEY (`idAuthor`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_to_categories` FOREIGN KEY (`idCategory`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='Таблица книг';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,2,1,'Экстремальное программирование',2001,150,3),(2,3,2,'Задачник по программированию',2005,264.6502835538752,2),(3,4,3,'Как программировать на Android',2011,520,4),(4,5,3,'Мои походы за бугор',1988,15,2),(5,4,1,'Как программировать на C++',1995,590,5),(6,6,1,'WPF - введение в технологию',2007,890,3),(7,7,1,'Android для профессионалов',2016,510,4),(8,4,1,'Как программировать в C#.NET',2009,480,2),(9,3,2,'Сборник задач по LINQ',2012,294.89603024574683,6),(10,5,3,'С хоббитом туда и обратно',2011,890,5),(11,1,1,'Базовый курс C++',2010,280,2),(12,6,1,'WCF - технология распреденных приложений',2012,360,3),(13,1,1,'Полное руководство по Java SE 8',2014,490,3),(14,4,1,'Руководство по разработке под Android',2016,680,2),(15,6,2,'Типичные задачи по LINQ в оперативном учете',2012,350,1),(16,4,1,'Взгляд на Android для профессионалов',2016,580,2),(17,3,2,'C++ и все, все, все...',2017,90.73724007561437,5),(18,10,1,'SQL для простых сметных',2002,350,3);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Таблица категорий книг';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'учебник'),(2,'задачник'),(3,'монография'),(4,'практикум'),(5,'рабочая тетрадь');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-28 10:43:27
