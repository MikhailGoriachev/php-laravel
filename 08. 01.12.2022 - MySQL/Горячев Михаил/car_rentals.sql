CREATE DATABASE  IF NOT EXISTS `car_rental` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `car_rental`;
-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: car_rental
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'BMW X6'),(2,'BMW E81'),(3,'BMW E90'),(4,'Mercedes-Benz W124AMG'),(5,'Mercedes-Benz W906'),(6,'Mercedes-Benz W221'),(7,'Mercedes-Benz W414'),(8,'Infiniti FX37'),(9,'Infiniti G37'),(10,'Infiniti JX35'),(11,'BMW X6'),(12,'BMW E81'),(13,'BMW E90'),(14,'Mercedes-Benz W124AMG'),(15,'Mercedes-Benz W906'),(16,'Mercedes-Benz W221'),(17,'Mercedes-Benz W414'),(18,'Infiniti FX37'),(19,'Infiniti G37'),(20,'Infiniti JX35');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_brand` int NOT NULL,
  `id_color` int NOT NULL,
  `plate` varchar(10) NOT NULL,
  `year_manufacture` int NOT NULL,
  `inshurance_pay` int NOT NULL,
  `rental` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cars_brands_idx` (`id_brand`),
  KEY `fk_cars_colors_idx` (`id_color`),
  CONSTRAINT `fk_cars_brands` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id`),
  CONSTRAINT `fk_cars_colors` FOREIGN KEY (`id_color`) REFERENCES `colors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (1,1,1,'АН4841ТС',2007,8000000,8000),(2,5,4,'НО7985ВТ',2010,5000000,1800),(3,4,9,'АС2194СН',2012,7000000,7000),(4,4,4,'СН9155ТС',2007,5000000,5000),(5,6,1,'АС9549ВТ',2007,1500000,9000),(6,2,9,'НО2315СН',2017,8000000,10000),(7,4,1,'АН9517ВТ',2007,3000000,1300),(8,2,6,'АС3214ТС',2006,3500000,1400),(9,9,1,'СН5187ВТ',2007,9000000,7000),(10,6,2,'АС3215ТС',2007,7000000,9000);
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `cars_view`
--

DROP TABLE IF EXISTS `cars_view`;
/*!50001 DROP VIEW IF EXISTS `cars_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `cars_view` AS SELECT 
 1 AS `id`,
 1 AS `brand_name`,
 1 AS `color_name`,
 1 AS `year_manufacture`,
 1 AS `inshurance_pay`,
 1 AS `rental`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `patronymic` varchar(45) NOT NULL,
  `passport` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `passport_UNIQUE` (`passport`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Дарья','Астафьева','Алексеевна','374719647'),(2,'София','Дмитриева','Кирилловна','285651426'),(3,'Вера','Григорьева','Владиславовна','246087147'),(4,'Ольга','Литвинова','Ярославовна','385000079'),(5,'Юрий','Козырев','Семёнович','234531047'),(6,'Михаил','Власов','Александрович','406621785'),(7,'Игорь','Григорьев','Андреевич','373665689'),(8,'Иван','Колесов','Александрович','454970861'),(9,'Алина','Черных','Ильинична','258926881'),(10,'София','Фадеева','Богдановна','336277985'),(11,'Елизавета','Калинина','Ивановна','215721408'),(12,'Амелия','Маркова','Ильинична','478832095'),(13,'Мария','Константинова','Матвеевна','404739530'),(14,'Вероника','Медведева','Артемьевна','305956721'),(15,'Михаил','Попов','Михайлович','317436688'),(16,'Михаил','Селезнев','Дмитриевич','371820160'),(17,'Дмитрий','Поляков','Николаевич','297122478'),(18,'Вера','Карпова','Данииловна','212308405'),(19,'Михаил','Иванов','Александрович','412492082'),(20,'Кирилл','Романов','Даниилович','277657699'),(21,'Алиса','Кузнецова','Тимофеевна','233504325'),(22,'Даниил','Лаврентьев','Максимович','440400630'),(23,'Сергей','Исааков','Кириллович','436955624'),(24,'Алиса','Булгакова','Алексеевна','351701717'),(25,'Елисей','Измайлов','Александрович','265544067'),(26,'Николай','Алешин','Андреевич','485735268');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `colors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
INSERT INTO `colors` VALUES (1,'Синий'),(2,'Красный'),(3,'Чёрный'),(4,'Фиолетовый'),(5,'Голубой'),(6,'Жёлтый'),(7,'Зелёный'),(8,'Серый'),(9,'Бирюзовый'),(10,'Розовый'),(11,'Синий'),(12,'Красный'),(13,'Чёрный'),(14,'Фиолетовый'),(15,'Голубой'),(16,'Жёлтый'),(17,'Зелёный'),(18,'Серый'),(19,'Бирюзовый'),(20,'Розовый');
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rentals`
--

DROP TABLE IF EXISTS `rentals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rentals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_client` int NOT NULL,
  `id_car` int NOT NULL,
  `date_start` date NOT NULL,
  `duration` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rentals_clients_idx` (`id_client`),
  KEY `fk_rentals_cars_idx` (`id_car`),
  CONSTRAINT `fk_rentals_cars` FOREIGN KEY (`id_car`) REFERENCES `cars` (`id`),
  CONSTRAINT `fk_rentals_clients` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rentals`
--

LOCK TABLES `rentals` WRITE;
/*!40000 ALTER TABLE `rentals` DISABLE KEYS */;
INSERT INTO `rentals` VALUES (1,1,8,'2021-11-03',10),(2,7,7,'2021-11-12',2),(3,5,5,'2021-11-17',7),(4,1,3,'2021-11-01',4),(5,7,7,'2021-11-13',7),(6,3,1,'2021-11-01',8),(7,4,8,'2021-11-07',9),(8,7,9,'2021-11-02',10),(9,6,2,'2021-11-08',7),(10,8,4,'2021-11-09',2),(11,1,1,'2021-11-01',3),(12,2,7,'2021-11-12',1),(13,3,2,'2021-11-07',1),(14,7,8,'2021-11-02',9),(15,4,5,'2021-11-05',3),(16,8,5,'2021-11-07',5),(17,6,9,'2021-11-01',7),(18,8,6,'2021-11-10',1),(19,1,3,'2021-11-02',10),(20,8,2,'2021-11-05',1);
/*!40000 ALTER TABLE `rentals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `rentals_view`
--

DROP TABLE IF EXISTS `rentals_view`;
/*!50001 DROP VIEW IF EXISTS `rentals_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `rentals_view` AS SELECT 
 1 AS `id`,
 1 AS `id_client`,
 1 AS `last_name`,
 1 AS `first_name`,
 1 AS `patronymic`,
 1 AS `passport`,
 1 AS `brand_name`,
 1 AS `color_name`,
 1 AS `plate`,
 1 AS `inshurance_pay`,
 1 AS `rental`,
 1 AS `date_start`,
 1 AS `duration`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `cars_view`
--

/*!50001 DROP VIEW IF EXISTS `cars_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cars_view` AS select `cars`.`id` AS `id`,`brands`.`name` AS `brand_name`,`colors`.`name` AS `color_name`,`cars`.`year_manufacture` AS `year_manufacture`,`cars`.`inshurance_pay` AS `inshurance_pay`,`cars`.`rental` AS `rental` from ((`cars` join `brands` on((`cars`.`id_brand` = `brands`.`id`))) join `colors` on((`cars`.`id_color` = `colors`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `rentals_view`
--

/*!50001 DROP VIEW IF EXISTS `rentals_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `rentals_view` AS select `rentals`.`id` AS `id`,`clients`.`id` AS `id_client`,`clients`.`last_name` AS `last_name`,`clients`.`first_name` AS `first_name`,`clients`.`patronymic` AS `patronymic`,`clients`.`passport` AS `passport`,`brands`.`name` AS `brand_name`,`colors`.`name` AS `color_name`,`cars`.`plate` AS `plate`,`cars`.`inshurance_pay` AS `inshurance_pay`,`cars`.`rental` AS `rental`,`rentals`.`date_start` AS `date_start`,`rentals`.`duration` AS `duration` from ((`rentals` join `clients` on((`rentals`.`id_client` = `clients`.`id`))) join ((`cars` join `brands` on((`cars`.`id_brand` = `brands`.`id`))) join `colors` on((`cars`.`id_color` = `colors`.`id`))) on((`rentals`.`id_car` = `cars`.`id`))) */;
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

-- Dump completed on 2022-12-02 23:52:08
