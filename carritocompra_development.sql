-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: carritocompra_development
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.13.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la categoría',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre para mostrar de la categoría',
  `url_nombre` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Productos de prueba','productos-de-prueba','2014-04-26 18:15:02','2014-04-26 18:44:36');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la asignación de carrito',
  `usuario_id` int(11) NOT NULL COMMENT 'Id del dueño del carrito',
  `producto_id` int(11) NOT NULL COMMENT 'Id del producto asignado',
  `variante_id` int(11) NOT NULL COMMENT 'Id de variante de producto',
  `cantidad` int(11) NOT NULL COMMENT 'Cantidad de producto asignado',
  `precio_unitario` float NOT NULL,
  `precio_bruto` int(11) NOT NULL COMMENT 'Resultado de multiplicar cantidad * de producto',
  `created_at` datetime NOT NULL COMMENT 'Hora y fecha de asignación',
  `concretada` tinyint(1) NOT NULL DEFAULT '0' COMMENT '¿Este compra ya fue confirmada?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (22,1,66,4,1,45.55,45,'2014-04-26 17:14:34',1),(23,1,66,5,1,45.55,45,'2014-04-26 17:14:38',1),(24,1,68,8,3,335,1005,'2014-04-28 13:04:19',1),(25,1,68,7,5,335,1675,'2014-04-28 13:04:26',1),(26,1,68,7,5,335,1675,'2014-04-28 13:04:53',1),(27,1,69,9,3,44,132,'2014-04-28 16:24:55',1),(28,1,69,10,5,44,220,'2014-04-28 16:25:04',1),(29,1,69,9,5,44,220,'2014-04-28 16:25:24',1),(30,1,66,4,6,45.55,273,'2014-05-02 15:15:57',1),(32,118,66,5,1,45.55,45,'2014-05-02 15:53:35',1),(33,118,65,1,10,34.33,343,'2014-05-02 15:53:54',1),(34,118,61,0,2,12.33,24,'2014-05-02 15:54:54',1),(35,118,82,0,1,5,5,'2014-05-02 16:01:57',1),(36,1,82,0,1,5,5,'2014-05-02 16:10:47',1),(37,1,80,0,1,23,23,'2014-05-02 16:17:07',1),(38,1,66,4,1,45.55,45,'2014-05-02 16:24:45',1),(39,1,63,0,6,292,1752,'2014-05-02 16:33:21',1),(40,1,68,8,3,335,1005,'2014-05-02 16:54:16',1),(41,1,68,7,6,335,2010,'2014-05-02 16:54:19',1),(42,1,66,4,1,45.55,45,'2014-05-03 01:46:45',1),(43,1,80,0,4,23,92,'2014-05-03 13:04:09',1),(44,1,66,4,3,45.55,136,'2014-05-05 00:59:07',1),(45,1,61,0,1,12.33,12,'2014-05-08 14:41:39',1),(46,1,63,0,4,292,1168,'2014-05-08 14:48:01',1),(47,1,65,1,1,34.33,34,'2014-05-08 14:48:08',1),(48,139,66,4,1,45.55,45,'2014-05-08 15:59:36',1),(49,139,80,0,1,23,23,'2014-05-08 15:59:47',1),(50,139,68,7,3,335,1005,'2014-05-08 15:59:53',1);
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medidas`
--

DROP TABLE IF EXISTS `medidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medidas`
--

LOCK TABLES `medidas` WRITE;
/*!40000 ALTER TABLE `medidas` DISABLE KEYS */;
INSERT INTO `medidas` VALUES (1,'kilogramo','2014-05-02 00:00:00','2014-05-02 00:00:00'),(2,'litro','2014-05-02 00:00:00','2014-05-02 00:00:00'),(3,'docena','2014-05-02 00:00:00','2014-05-02 00:00:00'),(5,'caja con 100 piezas','2014-05-02 00:00:00','2014-05-02 15:14:18');
/*!40000 ALTER TABLE `medidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `observaciones` text NOT NULL,
  `procesado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `procesado_en` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (2,118,'Este pedido, ¡lo quiero ya! ¡Kono yaro!',0,'2014-04-19 23:02:36','0000-00-00 00:00:00'),(4,118,'',0,'2014-04-22 20:53:07','0000-00-00 00:00:00'),(5,118,'Esta es una observación\n',0,'2014-04-22 20:56:29','0000-00-00 00:00:00'),(6,1,'Este es un pedido de prueba de variantes. Debe listar dos productos iguales con variantes diferentes.',0,'2014-04-26 17:40:59','0000-00-00 00:00:00'),(9,1,'Esta es una observación de este nuevo producto.',0,'2014-04-28 16:29:02','0000-00-00 00:00:00'),(10,1,'',0,'2014-05-02 15:42:01','0000-00-00 00:00:00'),(11,118,'esta bien',1,'2014-05-02 15:55:40','0000-00-00 00:00:00'),(12,1,'',0,'2014-05-02 16:11:32','0000-00-00 00:00:00'),(13,118,'',0,'2014-05-02 16:15:10','0000-00-00 00:00:00'),(14,1,'',0,'2014-05-02 16:17:21','0000-00-00 00:00:00'),(15,1,'',0,'2014-05-02 16:24:49','0000-00-00 00:00:00'),(16,1,'',0,'2014-05-02 16:33:24','0000-00-00 00:00:00'),(17,1,'',0,'2014-05-02 16:54:23','0000-00-00 00:00:00'),(18,1,'',0,'2014-05-03 01:46:50','0000-00-00 00:00:00'),(19,1,'',0,'2014-05-03 13:04:13','0000-00-00 00:00:00'),(20,1,'',0,'2014-05-05 00:59:10','0000-00-00 00:00:00'),(21,1,'',0,'2014-05-08 14:41:43','0000-00-00 00:00:00'),(22,1,'',0,'2014-05-08 14:43:42','0000-00-00 00:00:00'),(23,1,'',0,'2014-05-08 14:48:12','0000-00-00 00:00:00'),(24,139,'',0,'2014-05-08 15:59:59','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos_compras`
--

DROP TABLE IF EXISTS `pedidos_compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos_compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) DEFAULT NULL,
  `compra_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos_compras`
--

LOCK TABLES `pedidos_compras` WRITE;
/*!40000 ALTER TABLE `pedidos_compras` DISABLE KEYS */;
INSERT INTO `pedidos_compras` VALUES (1,2,6),(2,2,7),(3,1,3),(4,4,8),(5,4,9),(6,5,11),(7,5,12),(8,5,13),(9,6,22),(10,7,22),(11,7,23),(12,8,24),(13,8,25),(14,8,26),(15,9,27),(16,9,28),(17,9,29),(18,10,30),(19,11,32),(20,11,33),(21,11,34),(22,12,36),(23,13,35),(24,14,37),(25,15,38),(26,16,39),(27,17,40),(28,17,41),(29,18,42),(30,19,43),(31,20,44),(32,21,45),(33,23,46),(34,23,47),(35,24,48),(36,24,49),(37,24,50);
/*!40000 ALTER TABLE `pedidos_compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del producto',
  `codigo` varchar(50) NOT NULL COMMENT 'Código que se usa para identificar al producto en otro inventario',
  `descripcion` varchar(255) NOT NULL COMMENT 'Nombre o descripción del producto',
  `imagen` varchar(255) NOT NULL COMMENT 'Nombre de archivo de la imagen de este producto',
  `stock_unitario` int(11) NOT NULL COMMENT 'Cantidad de la que se dispone',
  `precio_unitario` float NOT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT '0' COMMENT '¿Este producto es visible para los clientes?',
  `categoria_id` int(11) NOT NULL COMMENT 'Id de la categoría a la que este producto pertenece',
  `medida_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (48,'23443','Miku Dedo','public/img/productos/Miku_dedo.jpg',23432,23423,0,1,1,'0000-00-00 00:00:00','2014-05-05 00:52:14'),(61,'2321313u1203808','Naught Miku','public/img/productos/naughty_miku_avatar_by_lilviscious-d2y2l8m.jpg',20,12.33,1,1,3,'0000-00-00 00:00:00','2014-05-02 15:09:45'),(62,'23091823018','Sacapuntas','public/img/productos/Oh_god_what_have_i_done.jpg',3,9.88,1,1,1,'0000-00-00 00:00:00','2014-04-20 19:59:17'),(63,'12381739','Facebook','public/img/productos/doxygen_icon.png',28,292,1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(65,'324324324324','Naranja Fry','public/img/productos/Naranja_Fry2.jpg',34324,34.33,1,1,1,'2014-04-25 13:46:10','2014-04-25 13:46:42'),(66,'324324324324','Abuso pokémon','public/img/productos/Abuso_animal.jpg',54,45.55,1,1,1,'2014-04-26 16:00:38','2014-04-26 16:00:53'),(67,'233232432','Papelerías','public/img/productos/images.jpg',3434,343.23,1,2,1,'2014-04-28 00:14:23','2014-04-28 00:14:30'),(68,'2424234324','Horario de UTeM','public/img/productos/Adobe_Photoshop_CS6_icon.png',335,335,1,1,1,'2014-04-28 13:02:50','2014-04-28 13:03:03'),(69,'324324424','Producto de pruebas','public/img/productos/desu.gif',4,44,1,2,1,'2014-04-28 16:24:32','2014-04-28 16:24:36'),(79,'324324324324','Naranja Fry','public/img/productos/Naranja_Fry2.jpg',34324,34.33,1,1,1,'2014-04-25 13:46:10','2014-04-25 13:46:42'),(80,'2234234324','Figurini','public/img/productos/135539234450da10b283b83.jpg',5,23,1,2,2,'2014-05-02 14:46:43','2014-05-02 14:47:55'),(81,'123456','Sala de reposo','public/img/productos/45659_569725193049680_914757724_n.jpg',12,1200,1,1,6,'2014-05-02 15:59:11','2014-05-02 16:00:36'),(82,'528794613','poster','public/img/productos/484678_590356467653219_1077621613_n.jpg',15,5,1,2,7,'2014-05-02 16:01:11','2014-05-02 16:01:15');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `string` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokens`
--

LOCK TABLES `tokens` WRITE;
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
INSERT INTO `tokens` VALUES (5,1,'530c55b439eb14b6f3b8a66bb71e61dca2991067'),(10,1,'684856e4ddde32adf5c585141f11b9209aa96ec4'),(11,1,'c0029eb589522a385fa0b9474d533856aaa26e48'),(14,1,'e9060391eb22c3283f944bd6b60f79253094634e'),(16,118,'d7cbe3fa2253503538235a49ce0a49698cb8af56'),(17,118,'c1f1e6bd2502343a39b3fcd1a21034002e41c305'),(18,118,'1c15e097455c96a3b5059afca5be77f5921a448f'),(19,118,'8213ddd95a655fc8e3398b37ad35db07d9a2e501'),(23,1,'4c3d61661f3c64c626b3142fedd83816458707aa'),(25,1,'e45b6255cafa95f19ca8111d9c60ab7461d558dc'),(27,1,'45bb0ac84f4c10abf29ed3b5617276cdf40d4c5f'),(28,1,'b3272f2c73055c81eec3ede9c895b0ea9e83b92f'),(31,118,'a40fd04ca49ee65cbcb6aec6d26f4528a820a334'),(32,118,'65c28aea7ed4793f43699587e6d1b4e7277bd941'),(33,118,'b10726d457f0d1d33a7754096975c3b4dfdc5333'),(34,118,'0b415dd47a2df43a38cba53e50ed3d8ddac4e818'),(38,1,'68707d7541ad5298e056962acae6c607b457ee36'),(39,118,'f1d933c0e3f22c1142e5ddefc55ceb0e03953dec'),(40,1,'4e48046c1342706a65b6495227e9852ff8facd7b'),(41,118,'947fd502046f1d243b12a9bb923a9a09d41ccf73'),(44,1,'b38f49befe37eb37a42c306da758ea76d599f8c3'),(46,1,'c55dd65b59d2bb756a46ee466c2222799a3d95c3'),(47,1,'bcac352cee82e40a591c2dcc9bcb1770f27074b5'),(51,1,'28f9b18f091f85b9f0abe36eab36d73773b7d206'),(52,118,'cf3f3df82427a2be903da9d6e88cfe5007ffcb08'),(54,1,'77f0e18b3cdfe0dbe89f72324524c3365304f912'),(57,1,'9fdc34021b67cd0022cb6376259cba0ee84c4fc4'),(58,118,'ea63d6df7b682aa3cbc171a40245a17d8b96a50e'),(60,118,'be111c1ea90e012649c188fa0697b49af05a7734'),(61,1,'bdeba2d51ddcbd1413e9c5d3ae5dd9acbc8bc328'),(62,118,'2aa0b9dd7dc2ddf41af88b8318706ea78e78ed0f'),(63,1,'5dbdf9264002cfd1f6ddb9affd4c673e7d2ef85a'),(64,1,'5b859a1128445b717aecb18b41d370d9d2955144'),(76,1,'38066ffd938c0da3accc6bad8e5793abcea2166a'),(77,1,'1fecfa34e67772528232792856dcb828d9f1b019'),(78,1,'58d16aecba837ffaca16279b18223d66f079caf9'),(79,1,'12a4dc4b43882e94b6c2c03daae11adb4968179e'),(80,1,'62487af05be629878bcfcd97008299cd44be9de5'),(81,1,'08e958257d23936ed5122253db54aac013fdc1be'),(85,139,'59732eeddea707318da16d6b361ff0aa527f64f6'),(86,1,'03998a6f8c6daa1c59d6f3bc9d132759abee146f');
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del usuario',
  `rol` int(11) NOT NULL COMMENT 'Id del rol',
  `nombre_usuario` varchar(20) NOT NULL COMMENT 'Nombre de usuario',
  `contrasena` text NOT NULL COMMENT 'Contraseña (cifrada con SHA1)',
  `nombres` varchar(100) NOT NULL COMMENT 'Nombre o nombres de la persona',
  `apellido_paterno` varchar(50) NOT NULL COMMENT 'Apellido paterno de la persona',
  `apellido_materno` varchar(50) NOT NULL COMMENT 'Apellido materno de la persona',
  `cargo` varchar(100) NOT NULL COMMENT 'Puesto en TIMSA',
  `departamento` varchar(100) NOT NULL COMMENT 'Departamento en TIMSA',
  `encargado_departamento` varchar(150) NOT NULL,
  `activado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '¿El usuario puede iniciar sesión en el sitio?',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','Administrador','','','','','',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(139,2,'kevin','ffb4761cba839470133bee36aeb139f58d7dbaa9','Kevin','Perez','Maulión','erersd','Taller','',1,'2014-05-08 15:13:33','2014-05-08 15:16:52'),(140,2,'daniel','','Daniel Ángel','sd','ada','erersd','ads','',1,'2014-05-08 15:15:11','2014-05-08 15:15:11');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variantes`
--

DROP TABLE IF EXISTS `variantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de variante de producto',
  `tipo_variante_id` int(11) NOT NULL COMMENT 'Id del tipo de variante',
  `producto_id` int(11) NOT NULL,
  `valor` varchar(20) NOT NULL COMMENT 'Valor que varía con respecto al producto original',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variantes`
--

LOCK TABLES `variantes` WRITE;
/*!40000 ALTER TABLE `variantes` DISABLE KEYS */;
INSERT INTO `variantes` VALUES (1,1,65,'#2c9456'),(2,1,65,'#2e22d6'),(3,1,65,'#1ac91d'),(4,1,66,'#213a9e'),(5,1,66,'#17e80c'),(6,1,66,'#8ead1d'),(7,1,68,'#21ad41'),(8,1,68,'#2f16f0'),(9,1,69,'#db7629'),(10,1,69,'#15bd20');
/*!40000 ALTER TABLE `variantes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-11 19:44:08
