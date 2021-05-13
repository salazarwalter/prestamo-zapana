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
  `id` int NOT NULL AUTO_INCREMENT,
  `accion_id` int NOT NULL,
  `perfil_id` int NOT NULL,
  `permitido` varchar(1) DEFAULT 'S' COMMENT 'Es  el acceso  principal o  no',
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_accion_perfil` (`accion_id`,`perfil_id`),
  KEY `fk_acceso_accion1_idx` (`accion_id`),
  KEY `fk_acceso_perfil1_idx` (`perfil_id`),
  CONSTRAINT `fk_acceso_accion1` FOREIGN KEY (`accion_id`) REFERENCES `accion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_acceso_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acceso`
--

LOCK TABLES `acceso` WRITE;
/*!40000 ALTER TABLE `acceso` DISABLE KEYS */;
INSERT INTO `acceso` VALUES (2,1,3,'S'),(3,4,3,'S'),(4,7,3,'N'),(5,6,3,'S'),(6,8,3,'S'),(7,9,3,'S'),(8,5,3,'S'),(9,19,3,'S'),(10,16,3,'S'),(11,11,3,'S'),(12,10,3,'S'),(13,12,3,'S'),(14,13,3,'S'),(15,17,3,'S'),(16,15,3,'S'),(17,14,3,'S'),(18,18,3,'S'),(19,20,3,'S'),(20,21,3,'S'),(21,22,3,'S'),(22,23,3,'S'),(23,24,3,'S'),(24,25,3,'S'),(25,26,3,'S'),(26,28,3,'S'),(27,27,3,'S'),(28,29,3,'S'),(29,30,3,'S'),(30,31,3,'S'),(31,32,3,'S'),(32,33,3,'S'),(33,34,3,'S'),(34,35,3,'S'),(35,41,4,'S');
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
) ENGINE=InnoDB AUTO_INCREMENT=42;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accion`
--

LOCK TABLES `accion` WRITE;
/*!40000 ALTER TABLE `accion` DISABLE KEYS */;
INSERT INTO `accion` VALUES (41,'salir',1),(26,'add',3),(28,'del',3),(27,'edit',3),(29,'index',3),(20,'add',4),(21,'ajax_combo',4),(22,'ajax_lista_controladores',4),(23,'del',4),(24,'edit',4),(25,'index',4),(30,'add',5),(31,'ajax_combo',5),(32,'ajax_lista',5),(33,'del',5),(34,'edit',5),(35,'index',5),(4,'add',6),(7,'ajax_combo',6),(6,'ajax_combo_norepeat',6),(8,'ajax_lista',6),(9,'del',6),(5,'edit',6),(19,'index',6),(1,'select',6),(16,'add',8),(11,'ajax_combo',8),(10,'ajax_combo_norepeat',8),(12,'ajax_lista',8),(13,'del',8),(17,'index',8),(15,'nopermitir',8),(14,'permitir',8),(18,'select',8),(38,'add',9),(40,'del',9),(39,'edit',9),(37,'index',9),(36,'select',9);
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
) ENGINE=InnoDB AUTO_INCREMENT=10;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controlador`
--

LOCK TABLES `controlador` WRITE;
/*!40000 ALTER TABLE `controlador` DISABLE KEYS */;
INSERT INTO `controlador` VALUES (8,'sysacceso',3),(6,'sysaccion',3),(4,'syscontrolador',3),(9,'sysmenu',3),(3,'sysmodulo',3),(5,'sysperfil',3),(1,'sysusuario',4),(7,'publicador',5);
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
) ENGINE=InnoDB AUTO_INCREMENT=12;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Módulos','fas fa-brain','text-success',3,1,29),(2,'Controladores','fas fa-gamepad','text-danger',3,2,25),(3,'Perfiles','fas fa-user-tag','text-info',3,0,35),(4,'Acciones','fas fa-radiation-alt','text-warning',3,3,1),(5,'Accesos','fas fa-low-vision','text-yellow',3,5,18),(6,'Menues','fab fa-elementor','text-lightblue',3,6,36);
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
) ENGINE=InnoDB AUTO_INCREMENT=4;
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
) ENGINE=InnoDB AUTO_INCREMENT=7;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (4,'Admin DP',2),(3,'Administrador Ingresos',1),(5,'Seguidor',3);
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
) ENGINE=InnoDB AUTO_INCREMENT=2;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'Salazar','Walter',NULL,NULL,NULL,NULL,'+54','2021-04-14',1,'salazarwalter@gmail.com');
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
) ENGINE=InnoDB AUTO_INCREMENT=4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (2,1,3,'S'),(3,1,4,'S');
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
) ENGINE=InnoDB AUTO_INCREMENT=2;
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

-- Dump completed on 2021-04-14 11:15:14
