-- MySQL dump 10.13  Distrib 8.0.16, for macos10.14 (x86_64)
--
-- Host: localhost    Database: greendr_db
-- ------------------------------------------------------
-- Server version	5.7.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `n_cientifico` varchar(100) DEFAULT NULL,
  `imagen1` varchar(100) DEFAULT NULL,
  `imagen2` varchar(100) DEFAULT NULL,
  `imagen3` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `disponible` varchar(25) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_punto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_categoria` (`id_categoria`),
  KEY `articulos_ibfk_4` (`id_punto`),
  CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `articulos_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
  CONSTRAINT `articulos_ibfk_4` FOREIGN KEY (`id_punto`) REFERENCES `puntos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (14,'DALIA \"CAFE AU LAIT\"','Dahlia','archivos/1_churrini_Dalia__Cafe_au_lait__1.jpg','null','null','La variedad \"Cafe au lait\" es muy pipipiripi. \r\nLa época de siembra es en pipipi.','si',8,3,NULL),(15,'FILADELFO','Philadelphus coronarius','archivos/15_churrini_filadelfo_1.jpg','archivos/15_churrini_filadelfo_2.jpg','null','Esqueje enraizado.\r\nPopular planta ornamental muy cultivada en jardines de las regiones templadas perteneciente a la familia Hydrangeaceae.','si',8,2,NULL),(16,'FLOR DE PAPEL','Zinnia elegans','archivos/16_churrini_Flor_de_papel_1.jpg','archivos/16_churrini_Flor_de_papel_2.jpg','archivos/16_churrini_Flor_de_papel_3.jpg','Planta de floración anual del género Zinnia, es una de las zinnias más conocidas.','si',8,3,NULL),(17,'EQUINáCEA PúRPURA','Echinacea purpurea','archivos/17_churrini_Equinácea_púrpura_1.jpg','null','null','- Resiste bien el calor del verano.\r\n\r\n- Suelos bien drenados.\r\n\r\n- No precisan cuidados especiales.','si',8,3,NULL),(18,'ACHIRA','Canna indica','archivos/18_fanita_Achira_1.jpg','archivos/18_fanita_Achira_2.jpg','archivos/18_fanita_Achira_3.jpg','Intercambio gajos enraizado de Achira.\r\nEsta planta es perenne y llega a medir hasta 3 metros de altura .','si',7,2,NULL),(19,'FAROLITO JAPONES','Abutilon x hybridum','archivos/19_fanita_Farolito_japones_1.jpg','null','null','Debe estar expuesta a pleno sol para una floración precoz. El resto del tiempo, se aconseja mantenerla en una zona sombreada y al abrigo del viento.','si',7,2,NULL),(20,'SALVIA','Salvia sp','archivos/20_fanita_SALVIA_1.jpg','null','archivos/20_fanita_SALVIA_3.jpg','','si',7,1,NULL);
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (2,'ESQUEJE'),(1,'PLANTA'),(4,'PRODUCTO'),(3,'SEMILLAS'),(5,'SERVICIO');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) DEFAULT NULL,
  `id_usuario_likeador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_articulo` (`id_articulo`),
  KEY `id_usuario_likeador` (`id_usuario_likeador`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`),
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_usuario_likeador`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matchs`
--

DROP TABLE IF EXISTS `matchs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `matchs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` varchar(45) NOT NULL,
  `calificacion1` decimal(1,1) NOT NULL,
  `calificacion2` decimal(1,1) NOT NULL,
  `id_articulo1` int(11) NOT NULL,
  `id_articulo2` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_articulo1` (`id_articulo1`),
  KEY `id_articulo2` (`id_articulo2`),
  CONSTRAINT `matchs_ibfk_1` FOREIGN KEY (`id_articulo1`) REFERENCES `articulos` (`id`),
  CONSTRAINT `matchs_ibfk_2` FOREIGN KEY (`id_articulo2`) REFERENCES `articulos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matchs`
--

LOCK TABLES `matchs` WRITE;
/*!40000 ALTER TABLE `matchs` DISABLE KEYS */;
/*!40000 ALTER TABLE `matchs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas`
--

DROP TABLE IF EXISTS `notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `contenido` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas`
--

LOCK TABLES `notas` WRITE;
/*!40000 ALTER TABLE `notas` DISABLE KEYS */;
/*!40000 ALTER TABLE `notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicidades`
--

DROP TABLE IF EXISTS `publicidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `publicidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anunciante` varchar(45) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicidades`
--

LOCK TABLES `publicidades` WRITE;
/*!40000 ALTER TABLE `publicidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `publicidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puntos`
--

DROP TABLE IF EXISTS `puntos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `puntos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `id_zona` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  KEY `id_zona` (`id_zona`),
  CONSTRAINT `puntos_ibfk_1` FOREIGN KEY (`id_zona`) REFERENCES `ubicaciones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puntos`
--

LOCK TABLES `puntos` WRITE;
/*!40000 ALTER TABLE `puntos` DISABLE KEYS */;
/*!40000 ALTER TABLE `puntos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubicaciones`
--

DROP TABLE IF EXISTS `ubicaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ubicaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zonas` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicaciones`
--

LOCK TABLES `ubicaciones` WRITE;
/*!40000 ALTER TABLE `ubicaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `ubicaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user` varchar(50) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `pass` varchar(200) NOT NULL,
  `calificacion` decimal(1,1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `nUsuario_UNIQUE` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (3,'colorete','colorete@gmail.com','colorete','archivos/colorete.png','12345',NULL),(4,'Martita O','martitaO@mail.com','martita','archivos/martita.png','$2y$10$jxf3zWVs5QNyj8WVk4q6I.LwIy6gMc3zjdDbCWUz/Rn05iffKkL.W',NULL),(5,'Coco Onna','coco@gmail.com','coco','archivos/coco.png','$2y$10$uvSmOtFSBAdiwvQF7xE8rO3RD57TtzgKkbDvaTo2cyuKCJIlbip/.',NULL),(6,'Ana Josefina Moreira','moreiraajosefina@gmail.com','josefina','archivos/josefina.png','$2y$10$ijpqnpXg0CX8Lt58aFgDdOGaM6CwsMCB3SNU5zEg8Mv2yzQSN3Rzm',NULL),(7,'fani','fani@gmail.com','fanita','archivos/fanita.jpg','$2y$10$KaJl32IkG7ZNZXGQmawvf.VoNmLn/Lang/8gxda3xqbzA0uneUP3O',NULL),(8,'churri','churri@gmail.com','churrini','archivos/churrini.png','$2y$10$TV5q.ndoDF2npx.UbQBpMOjWsM.U03ElI9Prqj1/CYFUMXTkP5A/a',NULL),(9,'coco coco','cocococo@gmail.com','cocococo','archivos/cocococo.png','$2y$10$cbL49ERIW.nccD1hqvXWUuECoyTWCOVW2c2fLbrNspmGcy5IlHO7a',NULL),(10,'coquino dos','coquino@gmail.com','coquino','archivos/coquino.png','$2y$10$0raS9Q3vZ8Bh5NCVxu9pqOsnjCcrzy3g0Mu5q9lT3HXQIMfORnfwm',NULL),(11,'kitty O','kitty@gmail.com','kitty','archivos/kitty.png','$2y$10$i3Aik0fLAo06jua19lIsoOyC5cS1GVzVONHWgMs2YGIwvjKeIaR9C',NULL),(12,'kitty dos','kitty2@gmail.com','kitty2','archivos/kitty2.png','$2y$10$uUjHoBG/7n6TMZ8MpjGRzuAjACGzg.gd/p9XmHW/UJa5wX/0.q8T6',NULL),(13,'','','','archivos/.','$2y$10$.l4sE0LhQfns7I2STSJvl.13BSLQgb/pqlYUDT4SZ3/PhJFL9HnMa',NULL);
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

-- Dump completed on 2019-06-09 18:52:20
