-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: furrypetcamp
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `caninos`
--

DROP TABLE IF EXISTS `caninos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caninos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `raza` varchar(45) DEFAULT NULL,
  `edad` varchar(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id_idx` (`usuario_id`),
  CONSTRAINT `caninos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caninos`
--

LOCK TABLES `caninos` WRITE;
/*!40000 ALTER TABLE `caninos` DISABLE KEYS */;
INSERT INTO `caninos` VALUES (1,' negra','criollo','8','negrita',11),(2,' leia','husky','7','leia',11),(4,' canela','puddle','5','canelita',12),(5,' lola','westin','1','lolita',11),(6,' leia','husky','7','laia',13),(7,' sardi','criollo','4','este es sardi',14),(8,' sardinita','pez','2','Si',11),(9,' leo','labrador criollo','11','sufre de la columna',15);
/*!40000 ALTER TABLE `caninos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `canino` varchar(45) DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarioid_idx` (`usuario_id`),
  CONSTRAINT `usuarioid` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (32,'2022-04-24','12:12:00','leia',13),(33,'2022-04-25','12:24:00','canela',12),(35,'2022-04-27','08:26:00','leia',13),(36,'2022-04-27','09:16:00','canela',12),(38,'2022-05-06','09:31:00','sardinita',11),(39,'2022-04-28','10:00:00','leo',15),(40,'2022-05-11','09:14:00','canela',12),(41,'2022-05-11','10:15:00','lola',11),(42,'2022-05-11','09:16:00','negra',11);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citaservicio`
--

DROP TABLE IF EXISTS `citaservicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citaservicio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `citaid` int DEFAULT NULL,
  `servicioid` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `citaid_idx` (`citaid`),
  KEY `servicioid_idx` (`servicioid`),
  CONSTRAINT `citaservicio_ibfk_1` FOREIGN KEY (`citaid`) REFERENCES `citas` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `citaservicio_ibfk_2` FOREIGN KEY (`servicioid`) REFERENCES `servicios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citaservicio`
--

LOCK TABLES `citaservicio` WRITE;
/*!40000 ALTER TABLE `citaservicio` DISABLE KEYS */;
INSERT INTO `citaservicio` VALUES (10,NULL,3),(11,32,2),(12,33,3),(13,NULL,4),(14,35,1),(15,36,1),(16,NULL,2),(17,38,2),(18,39,1),(19,40,1),(20,41,1),(21,42,2);
/*!40000 ALTER TABLE `citaservicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador'),(2,'Instructor'),(3,'Veterinario'),(4,'Hotelero'),(5,'Peluquero'),(6,'Cliente');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `creado` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,' Veterinaria',50000.00,'39f6c2a3386e313de246c60ff5aee922.jpg','Esta es la veterinaria','2022-04-22'),(2,' Peluqueria',30000.00,'44bedf470bec7f0408076d15f71b20ea.jpg','Esta es la peluqueria','2022-04-22'),(3,' Hotel Canino',25000.00,'ff9e3e58b8ba5682c88c6c6d806a41b3.jpg','Este es el hotel','2022-04-22'),(4,' Escuela ',50000.00,'61e11e7394f967eb93603619cce273bd.jpg','Esta es la escuela','2022-04-22');
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL,
  `cedula` varchar(10) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `rol_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rol_id_idx` (`rol_id`),
  CONSTRAINT `rol_id` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (9,' Juan','Montoya','1006106284','99937ce00b58aa9e68d0acc6371f2f22.jpg','5555555555','juan@juan.com','$2y$10$h0zZRqDREqufTHHFAcCXEuKNxrw27o/GSSgdreHQKPTBjOFKTr7Xi',1),(11,' Esteban ','Sardi','55555555','586f3ffff2eda0c194239873defe4009.jpg','55555555','sardi@sardi.com','$2y$10$oq//zsuJZOomY01qSHrMn.bZuddRmF/X7XWVKshkakuubNURA.iFW',6),(12,' kevin','gallego','5555555555','5dfd8d6f3d808aa49881c46e83a77652.jpg','5555555555','kevin@kevin.com','$2y$10$acWhN/f4ut0vCd3UTk.1O.D.FVm4Zb/hMiJL5hpYfeeuCKNONLmpS',6),(13,' vero','franco','555555555','2009de86bcbe797d265777c64af48c41.jpg','55555555','vero@vero.com','$2y$10$l7k53.vmtp3OO4bxX5OureWYX7bt44YgmlG6hFH8f74AHFjiAlO4i',6),(14,' cristian','agredo','555555555','5e79e26136f556644e27c148894b970a.jpg','555555','cristian@cristian.com','$2y$10$A8emFH5vbJzHyriD5sZDoOSUMTD4rFvV6dQiIRfssEU7ajHU2f02i',6),(15,' sandra','guarañita','5555555','71210a29590b73b692ecbd9f2128b9b6.jpg','555555','sandra@sandra.com','$2y$10$bdCmmK02GmJkOywz/qWJOOXcbDFkz3Z1FWF4eWUNOpxR31TnpjSh2',6),(16,' martha','lores','5555555555','70f5bcaebb9d0f570ac2aa11f90b89cc.jpg','5555555555','martha@martha.com','$2y$10$V87QgvszTCfsrZXhlihCLuM34YOu8wYM8zcHcHayh51.qDdkun5r.',3),(17,' peluquero','peluquero','1111111111','e9b1e6de799a2f30a80c3f3294530545.jpg','5555555555','peluquero@peluquero.com','$2y$10$JcoO8nxsBzA.o1TjFqYLtuUH19rVY/ehUMgcnuY/vx/eyClOtnGou',5);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-10 11:43:39
