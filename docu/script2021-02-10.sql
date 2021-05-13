-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: sbase1
-- ------------------------------------------------------
-- Server version	8.0.23-0ubuntu0.20.04.1

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
-- Table structure for table `acceso`
--

DROP TABLE IF EXISTS `acceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acceso` (
  `id` int NOT NULL,
  `accion_id` int NOT NULL,
  `perfil_id` int NOT NULL,
  `principal` varchar(1) DEFAULT NULL COMMENT 'Es  el acceso  principal o  no',
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_accion_perfil` (`accion_id`,`perfil_id`),
  KEY `fk_acceso_accion1_idx` (`accion_id`),
  KEY `fk_acceso_perfil1_idx` (`perfil_id`),
  CONSTRAINT `fk_acceso_accion1` FOREIGN KEY (`accion_id`) REFERENCES `accion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_acceso_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acceso`
--

LOCK TABLES `acceso` WRITE;
/*!40000 ALTER TABLE `acceso` DISABLE KEYS */;
/*!40000 ALTER TABLE `acceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accion`
--

DROP TABLE IF EXISTS `accion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `accion` varchar(45) DEFAULT NULL,
  `controlador_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_accion_controlador` (`controlador_id`,`accion`),
  KEY `fk_accion_controlador1_idx` (`controlador_id`),
  CONSTRAINT `fk_accion_controlador1` FOREIGN KEY (`controlador_id`) REFERENCES `controlador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accion`
--

LOCK TABLES `accion` WRITE;
/*!40000 ALTER TABLE `accion` DISABLE KEYS */;
/*!40000 ALTER TABLE `accion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controlador`
--

DROP TABLE IF EXISTS `controlador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `controlador` (
  `id` int NOT NULL AUTO_INCREMENT,
  `controlador` varchar(45) DEFAULT NULL,
  `perfil_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_perfil_controlador` (`perfil_id`,`controlador`),
  KEY `fk_controlador_perfil1_idx` (`perfil_id`),
  CONSTRAINT `fk_controlador_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controlador`
--

LOCK TABLES `controlador` WRITE;
/*!40000 ALTER TABLE `controlador` DISABLE KEYS */;
INSERT INTO `controlador` VALUES (6,'sysaccion',3),(4,'syscontrolador',3),(3,'sysmodulo',3),(5,'sysperfil',3),(1,'sysusuario',4),(7,'publicadorxxxx',5);
/*!40000 ALTER TABLE `controlador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `texto` varchar(45) DEFAULT NULL,
  `icono` varchar(60) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `perfil_id` int NOT NULL,
  `posicion` int DEFAULT NULL,
  `accion_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_texto_perfil_id` (`texto`,`perfil_id`),
  UNIQUE KEY `u_posicion_perfil_id` (`posicion`,`perfil_id`),
  KEY `fk_menu_perfil1_idx` (`perfil_id`),
  KEY `fk_menu_accion1_idx` (`accion_id`),
  CONSTRAINT `fk_menu_accion1` FOREIGN KEY (`accion_id`) REFERENCES `accion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_menu_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modulo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `modulo` varchar(30) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `logo` varchar(60) DEFAULT NULL,
  `precio` double(12,2) DEFAULT '0.00',
  `privado` varchar(1) DEFAULT 'N',
  `modulo_at` datetime DEFAULT NULL,
  `menu` varchar(26) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_modulo` (`modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo`
--

LOCK TABLES `modulo` WRITE;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` VALUES (1,'Ingresos al sistema','Controla los accesos de los diferentes perfiles y usuarios','fas fa-door-open',0.00,'S','2021-03-12 21:34:06','Módulo Ingreso'),(2,'Datos Personales','Permite cambiar la contraseña, foto  de perfil, etc','fas fa-user',0.00,'S','2021-03-13 06:53:13','Datos Personales'),(3,'Publicador de Gastos','Publica los gastos mensuales y sus respectivos respaldos','fas fa-donate',1100.00,'N','2021-03-13 06:55:03','Publicador de Gastos');
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil` varchar(45) DEFAULT NULL,
  `modulo_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_perfil_modulo` (`perfil`,`modulo_id`),
  KEY `fk_perfil_modulo1_idx` (`modulo_id`),
  CONSTRAINT `fk_perfil_modulo1` FOREIGN KEY (`modulo_id`) REFERENCES `modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (4,'Admin DP',2),(2,'Administrador DP',2),(3,'Administrador Ingresos',1),(5,'Seguidor',3);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persona` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ape` varchar(30) DEFAULT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `dni` int DEFAULT NULL,
  `cuil` varchar(15) DEFAULT NULL,
  `cel` varchar(30) DEFAULT NULL,
  `fijo` varchar(30) DEFAULT NULL,
  `pais` varchar(10) DEFAULT NULL,
  `nac` date DEFAULT NULL,
  `usuario_id` int NOT NULL,
  `mail` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_persona_usuario_idx` (`usuario_id`),
  CONSTRAINT `fk_persona_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `perfil_id` int NOT NULL,
  `activo` varchar(1) DEFAULT 'S',
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_perfil_usuario` (`usuario_id`,`perfil_id`),
  KEY `fk_rol_usuario1_idx` (`usuario_id`),
  KEY `fk_rol_perfil1_idx` (`perfil_id`),
  CONSTRAINT `fk_rol_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rol_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usu` varchar(30) DEFAULT NULL,
  `cla` varchar(45) DEFAULT NULL,
  `usuario_at` datetime DEFAULT NULL,
  `foto` varchar(60) DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'YWRtaW4yMDIx','MjAyMWFkbWlu','2021-04-08 02:50:08',NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-10  8:46:59
