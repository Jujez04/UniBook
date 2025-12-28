-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: unibook
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `book`
--
use `unibook`;
DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book` (
  `codebook` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `publicationyear` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `idcatalogue` int(11) NOT NULL,
  PRIMARY KEY (`codebook`),
  KEY `FKbelongs` (`idcatalogue`),
  CONSTRAINT `FKbelongs` FOREIGN KEY (`idcatalogue`) REFERENCES `catalogue` (`idcatalogue`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (1,'Fondamenti di Informatica','Pearson',2022,'fond_inf.jpg','Introduzione ai fondamenti dell’informatica','Silberschatz',1),(2,'Progettazione Architettonica','Hoepli',2021,'architettura.jpg','Manuale di progettazione per studenti di architettura','Gregotti',2),(3,'Biomeccanica Umana','Springer',2019,'biomeccanica.jpg','Principi di biomeccanica applicati al corpo umano','Winter',3),(4,'Sistemi Elettrici Industriali','McGraw-Hill',2020,'elettrica.jpg','Manuale sui sistemi elettrici e impiantistica','Chapman',4),(5,'Machine Learning per Ingegneri','O\'Reilly',2023,'ml_engineer.jpg','Applicazioni ingegneristiche del machine learning','Goodfellow',1);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_copy`
--

DROP TABLE IF EXISTS `book_copy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book_copy` (
  `codebook` int(11) NOT NULL,
  `codecopy` int(11) NOT NULL,
  `state` varchar(50) NOT NULL,
  PRIMARY KEY (`codebook`,`codecopy`),
  CONSTRAINT `FKhas` FOREIGN KEY (`codebook`) REFERENCES `book` (`codebook`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_copy`
--

LOCK TABLES `book_copy` WRITE;
/*!40000 ALTER TABLE `book_copy` DISABLE KEYS */;
INSERT INTO `book_copy` VALUES (1,1,'Disponibile'),(1,2,'Disponibile'),(2,1,'Disponibile'),(3,1,'Usurato'),(4,1,'Disponibile'),(5,1,'Disponibile'),(5,2,'Disponibile');
/*!40000 ALTER TABLE `book_copy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking` (
  `idstudent` int(11) NOT NULL,
  `codebook` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`idstudent`,`codebook`),
  KEY `FKrelated` (`codebook`),
  CONSTRAINT `FKexecute` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`),
  CONSTRAINT `FKrelated` FOREIGN KEY (`codebook`) REFERENCES `book` (`codebook`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,1,'2025-01-10'),(2,2,'2025-02-01'),(3,5,'2025-02-05');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catalogue`
--

DROP TABLE IF EXISTS `catalogue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `catalogue` (
  `idcatalogue` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`idcatalogue`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalogue`
--

LOCK TABLES `catalogue` WRITE;
/*!40000 ALTER TABLE `catalogue` DISABLE KEYS */;
INSERT INTO `catalogue` VALUES (1,'Ingegneria e scienze informatiche'),(2,'Architettura'),(3,'Ingegneria biomedica'),(4,'Ingegneria elettrica');
/*!40000 ALTER TABLE `catalogue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan`
--

DROP TABLE IF EXISTS `loan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loan` (
  `idstudent` int(11) NOT NULL,
  `codebook` int(11) NOT NULL,
  `codecopy` int(11) NOT NULL,
  `idreview` int(11) DEFAULT NULL,
  `refunddata` date DEFAULT NULL,
  `subscriptiondate` date NOT NULL,
  `state` varchar(50) NOT NULL,
  PRIMARY KEY (`idstudent`,`codebook`,`codecopy`,`subscriptiondate`),
  UNIQUE KEY `FKvalutation_ID` (`idreview`),
  KEY `FKconcern` (`codebook`,`codecopy`),
  CONSTRAINT `FKassignedto` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`),
  CONSTRAINT `FKconcern` FOREIGN KEY (`codebook`, `codecopy`) REFERENCES `book_copy` (`codebook`, `codecopy`),
  CONSTRAINT `FKrating_FK` FOREIGN KEY (`idreview`) REFERENCES `review` (`idreview`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan`
--

LOCK TABLES `loan` WRITE;
/*!40000 ALTER TABLE `loan` DISABLE KEYS */;
INSERT INTO `loan` VALUES (1,1,1,1,'2025-02-01','2025-01-10','Restituito'),(2,2,1,NULL,'2025-03-01','2025-02-01','In Prestito'),(3,5,1,NULL,'2025-03-01','2025-02-05','In Restituzione');
/*!40000 ALTER TABLE `loan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review` (
  `idreview` int(11) NOT NULL AUTO_INCREMENT,
  `rating` decimal(2,1) NOT NULL,
  `description` varchar(300) NOT NULL,
  PRIMARY KEY (`idreview`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (1,4.5,'bel libro'),(2,5.0,'fa schifo'),(3,3.5,'più o meno');
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `idstudent` int(11) NOT NULL AUTO_INCREMENT,
  `profileimage` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`idstudent`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES ('3331112222','pwd123','mario.rossi@example.com','Rossi',1,'3331112222.png','Mario'),('3331113333','pwd123','anna.bianchi@example.com','Bianchi',2,'3331113333.png','Anna'),('3331114444','pwd123','luca.verdi@example.com','Verdi',3,'3331114444.png','Luca');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag` (
  `idtag` varchar(50) NOT NULL,
  PRIMARY KEY (`idtag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES ('architettura'),('biomedica'),('elettrica'),('informatica'),('machine learning'),('sistemi');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_in_book`
--

DROP TABLE IF EXISTS `tag_in_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag_in_book` (
  `codebook` int(11) NOT NULL,
  `idtag` varchar(20) NOT NULL,
  PRIMARY KEY (`codebook`,`idtag`),
  KEY `FKbook` (`idtag`),
  CONSTRAINT `FK` FOREIGN KEY (`codebook`) REFERENCES `book` (`codebook`),
  CONSTRAINT `FKbook` FOREIGN KEY (`idtag`) REFERENCES `tag` (`idtag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_in_book`
--

LOCK TABLES `tag_in_book` WRITE;
/*!40000 ALTER TABLE `tag_in_book` DISABLE KEYS */;
INSERT INTO `tag_in_book` VALUES (1,'informatica'),(1,'sistemi'),(2,'architettura'),(3,'biomedica'),(4,'elettrica'),(5,'informatica'),(5,'machine learning');
/*!40000 ALTER TABLE `tag_in_book` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-12 17:10:24
