begin;
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
  `id` integer  primary key  ,
  `nombre` varchar(100)  ,
  `url_nombre` varchar(50) ,
  `created_at` datetime ,
  `updated_at` datetime
)  ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Productos de prueba','productos-de-prueba','2014-04-26 18:15:02','2014-04-26 18:44:36');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `id` integer  primary key  ,
  `usuario_id` integer  ,
  `producto_id` integer  ,
  `variante_id` integer  ,
  `cantidad` integer  ,
  `precio_unitario` float ,
  `precio_bruto` integer  ,
  `created_at` datetime  ,
  `concretada` integer  DEFAULT '0'
)  ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (22,1,66,4,1,45.55,45,'2014-04-26 17:14:34',1);
INSERT INTO `compras` VALUES (23,1,66,5,1,45.55,45,'2014-04-26 17:14:38',1);
INSERT INTO `compras` VALUES (24,1,68,8,3,335,1005,'2014-04-28 13:04:19',1);
INSERT INTO `compras` VALUES (25,1,68,7,5,335,1675,'2014-04-28 13:04:26',1);
INSERT INTO `compras` VALUES (26,1,68,7,5,335,1675,'2014-04-28 13:04:53',1);
INSERT INTO `compras` VALUES (27,1,69,9,3,44,132,'2014-04-28 16:24:55',1);
INSERT INTO `compras` VALUES (28,1,69,10,5,44,220,'2014-04-28 16:25:04',1);
INSERT INTO `compras` VALUES (29,1,69,9,5,44,220,'2014-04-28 16:25:24',1);
INSERT INTO `compras` VALUES (30,1,66,4,6,45.55,273,'2014-05-02 15:15:57',1);
INSERT INTO `compras` VALUES (32,118,66,5,1,45.55,45,'2014-05-02 15:53:35',1);
INSERT INTO `compras` VALUES (33,118,65,1,10,34.33,343,'2014-05-02 15:53:54',1);
INSERT INTO `compras` VALUES (34,118,61,0,2,12.33,24,'2014-05-02 15:54:54',1);
INSERT INTO `compras` VALUES (35,118,82,0,1,5,5,'2014-05-02 16:01:57',1);
INSERT INTO `compras` VALUES (36,1,82,0,1,5,5,'2014-05-02 16:10:47',1);
INSERT INTO `compras` VALUES (37,1,80,0,1,23,23,'2014-05-02 16:17:07',1);
INSERT INTO `compras` VALUES (38,1,66,4,1,45.55,45,'2014-05-02 16:24:45',1);
INSERT INTO `compras` VALUES (39,1,63,0,6,292,1752,'2014-05-02 16:33:21',1);
INSERT INTO `compras` VALUES (40,1,68,8,3,335,1005,'2014-05-02 16:54:16',1);
INSERT INTO `compras` VALUES (41,1,68,7,6,335,2010,'2014-05-02 16:54:19',1);
INSERT INTO `compras` VALUES (42,1,66,4,1,45.55,45,'2014-05-03 01:46:45',1);
INSERT INTO `compras` VALUES (43,1,80,0,4,23,92,'2014-05-03 13:04:09',1);
INSERT INTO `compras` VALUES (44,1,66,4,3,45.55,136,'2014-05-05 00:59:07',1);
INSERT INTO `compras` VALUES (45,1,61,0,1,12.33,12,'2014-05-08 14:41:39',1);
INSERT INTO `compras` VALUES (46,1,63,0,4,292,1168,'2014-05-08 14:48:01',1);
INSERT INTO `compras` VALUES (47,1,65,1,1,34.33,34,'2014-05-08 14:48:08',1);
INSERT INTO `compras` VALUES (48,139,66,4,1,45.55,45,'2014-05-08 15:59:36',1);
INSERT INTO `compras` VALUES (49,139,80,0,1,23,23,'2014-05-08 15:59:47',1);
INSERT INTO `compras` VALUES (50,139,68,7,3,335,1005,'2014-05-08 15:59:53',1);
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;

--
-- Table structure for table `medidas`
--

DROP TABLE IF EXISTS `medidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medidas` (
  `id` integer  primary key ,
  `nombre` varchar(100) ,
  `created_at` datetime ,
  `updated_at` datetime
)  ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medidas`
--

/*!40000 ALTER TABLE `medidas` DISABLE KEYS */;
INSERT INTO `medidas` VALUES (1,'kilogramo','2014-05-02 00:00:00','2014-05-02 00:00:00');
INSERT INTO `medidas` VALUES (2,'litro','2014-05-02 00:00:00','2014-05-02 00:00:00');
INSERT INTO `medidas` VALUES (3,'docena','2014-05-02 00:00:00','2014-05-02 00:00:00');
INSERT INTO `medidas` VALUES (5,'caja con 100 piezas','2014-05-02 00:00:00','2014-05-02 15:14:18');
/*!40000 ALTER TABLE `medidas` ENABLE KEYS */;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id` integer  primary key ,
  `usuario_id` integer DEFAULT NULL,
  `observaciones` text ,
  `procesado` integer  DEFAULT '0',
  `created_at` datetime ,
  `procesado_en` datetime
)  ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (2,118,'Este pedido, ¡lo quiero ya! ¡Kono yaro!',0,'2014-04-19 23:02:36','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (4,118,'',0,'2014-04-22 20:53:07','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (5,118,'Esta es una observación
',0,'2014-04-22 20:56:29','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (6,1,'Este es un pedido de prueba de variantes. Debe listar dos productos iguales con variantes diferentes.',0,'2014-04-26 17:40:59','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (9,1,'Esta es una observación de este nuevo producto.',0,'2014-04-28 16:29:02','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (10,1,'',0,'2014-05-02 15:42:01','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (11,118,'esta bien',1,'2014-05-02 15:55:40','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (12,1,'',0,'2014-05-02 16:11:32','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (13,118,'',0,'2014-05-02 16:15:10','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (14,1,'',0,'2014-05-02 16:17:21','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (15,1,'',0,'2014-05-02 16:24:49','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (16,1,'',0,'2014-05-02 16:33:24','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (17,1,'',0,'2014-05-02 16:54:23','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (18,1,'',0,'2014-05-03 01:46:50','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (19,1,'',0,'2014-05-03 13:04:13','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (20,1,'',0,'2014-05-05 00:59:10','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (21,1,'',0,'2014-05-08 14:41:43','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (22,1,'',0,'2014-05-08 14:43:42','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (23,1,'',0,'2014-05-08 14:48:12','0000-00-00 00:00:00');
INSERT INTO `pedidos` VALUES (24,139,'',0,'2014-05-08 15:59:59','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

--
-- Table structure for table `pedidos_compras`
--

DROP TABLE IF EXISTS `pedidos_compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos_compras` (
  `id` integer  primary key ,
  `pedido_id` integer DEFAULT NULL,
  `compra_id` integer DEFAULT NULL
)  ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos_compras`
--

/*!40000 ALTER TABLE `pedidos_compras` DISABLE KEYS */;
INSERT INTO `pedidos_compras` VALUES (1,2,6);
INSERT INTO `pedidos_compras` VALUES (2,2,7);
INSERT INTO `pedidos_compras` VALUES (3,1,3);
INSERT INTO `pedidos_compras` VALUES (4,4,8);
INSERT INTO `pedidos_compras` VALUES (5,4,9);
INSERT INTO `pedidos_compras` VALUES (6,5,11);
INSERT INTO `pedidos_compras` VALUES (7,5,12);
INSERT INTO `pedidos_compras` VALUES (8,5,13);
INSERT INTO `pedidos_compras` VALUES (9,6,22);
INSERT INTO `pedidos_compras` VALUES (10,7,22);
INSERT INTO `pedidos_compras` VALUES (11,7,23);
INSERT INTO `pedidos_compras` VALUES (12,8,24);
INSERT INTO `pedidos_compras` VALUES (13,8,25);
INSERT INTO `pedidos_compras` VALUES (14,8,26);
INSERT INTO `pedidos_compras` VALUES (15,9,27);
INSERT INTO `pedidos_compras` VALUES (16,9,28);
INSERT INTO `pedidos_compras` VALUES (17,9,29);
INSERT INTO `pedidos_compras` VALUES (18,10,30);
INSERT INTO `pedidos_compras` VALUES (19,11,32);
INSERT INTO `pedidos_compras` VALUES (20,11,33);
INSERT INTO `pedidos_compras` VALUES (21,11,34);
INSERT INTO `pedidos_compras` VALUES (22,12,36);
INSERT INTO `pedidos_compras` VALUES (23,13,35);
INSERT INTO `pedidos_compras` VALUES (24,14,37);
INSERT INTO `pedidos_compras` VALUES (25,15,38);
INSERT INTO `pedidos_compras` VALUES (26,16,39);
INSERT INTO `pedidos_compras` VALUES (27,17,40);
INSERT INTO `pedidos_compras` VALUES (28,17,41);
INSERT INTO `pedidos_compras` VALUES (29,18,42);
INSERT INTO `pedidos_compras` VALUES (30,19,43);
INSERT INTO `pedidos_compras` VALUES (31,20,44);
INSERT INTO `pedidos_compras` VALUES (32,21,45);
INSERT INTO `pedidos_compras` VALUES (33,23,46);
INSERT INTO `pedidos_compras` VALUES (34,23,47);
INSERT INTO `pedidos_compras` VALUES (35,24,48);
INSERT INTO `pedidos_compras` VALUES (36,24,49);
INSERT INTO `pedidos_compras` VALUES (37,24,50);
/*!40000 ALTER TABLE `pedidos_compras` ENABLE KEYS */;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` integer  primary key  ,
  `codigo` varchar(50)  ,
  `descripcion` varchar(255)  ,
  `imagen` varchar(255)  ,
  `stock_unitario` integer  ,
  `precio_unitario` float ,
  `publicado` integer  DEFAULT '0' ,
  `categoria_id` integer  ,
  `medida_id` integer ,
  `created_at` datetime ,
  `updated_at` datetime
)  ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (48,'23443','Miku Dedo','public/img/productos/Miku_dedo.jpg',23432,23423,0,1,1,'0000-00-00 00:00:00','2014-05-05 00:52:14');
INSERT INTO `productos` VALUES (61,'2321313u1203808','Naught Miku','public/img/productos/naughty_miku_avatar_by_lilviscious-d2y2l8m.jpg',20,12.33,1,1,3,'0000-00-00 00:00:00','2014-05-02 15:09:45');
INSERT INTO `productos` VALUES (62,'23091823018','Sacapuntas','public/img/productos/Oh_god_what_have_i_done.jpg',3,9.88,1,1,1,'0000-00-00 00:00:00','2014-04-20 19:59:17');
INSERT INTO `productos` VALUES (63,'12381739','Facebook','public/img/productos/doxygen_icon.png',28,292,1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `productos` VALUES (65,'324324324324','Naranja Fry','public/img/productos/Naranja_Fry2.jpg',34324,34.33,1,1,1,'2014-04-25 13:46:10','2014-04-25 13:46:42');
INSERT INTO `productos` VALUES (66,'324324324324','Abuso pokémon','public/img/productos/Abuso_animal.jpg',54,45.55,1,1,1,'2014-04-26 16:00:38','2014-04-26 16:00:53');
INSERT INTO `productos` VALUES (67,'233232432','Papelerías','public/img/productos/images.jpg',3434,343.23,1,2,1,'2014-04-28 00:14:23','2014-04-28 00:14:30');
INSERT INTO `productos` VALUES (68,'2424234324','Horario de UTeM','public/img/productos/Adobe_Photoshop_CS6_icon.png',335,335,1,1,1,'2014-04-28 13:02:50','2014-04-28 13:03:03');
INSERT INTO `productos` VALUES (69,'324324424','Producto de pruebas','public/img/productos/desu.gif',4,44,1,2,1,'2014-04-28 16:24:32','2014-04-28 16:24:36');
INSERT INTO `productos` VALUES (79,'324324324324','Naranja Fry','public/img/productos/Naranja_Fry2.jpg',34324,34.33,1,1,1,'2014-04-25 13:46:10','2014-04-25 13:46:42');
INSERT INTO `productos` VALUES (80,'2234234324','Figurini','public/img/productos/135539234450da10b283b83.jpg',5,23,1,2,2,'2014-05-02 14:46:43','2014-05-02 14:47:55');
INSERT INTO `productos` VALUES (81,'123456','Sala de reposo','public/img/productos/45659_569725193049680_914757724_n.jpg',12,1200,1,1,6,'2014-05-02 15:59:11','2014-05-02 16:00:36');
INSERT INTO `productos` VALUES (82,'528794613','poster','public/img/productos/484678_590356467653219_1077621613_n.jpg',15,5,1,2,7,'2014-05-02 16:01:11','2014-05-02 16:01:15');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokens` (
  `id` integer  primary key ,
  `usuario_id` integer ,
  `string` varchar(40)
)  ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokens`
--

/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
INSERT INTO `tokens` VALUES (5,1,'530c55b439eb14b6f3b8a66bb71e61dca2991067');
INSERT INTO `tokens` VALUES (10,1,'684856e4ddde32adf5c585141f11b9209aa96ec4');
INSERT INTO `tokens` VALUES (11,1,'c0029eb589522a385fa0b9474d533856aaa26e48');
INSERT INTO `tokens` VALUES (14,1,'e9060391eb22c3283f944bd6b60f79253094634e');
INSERT INTO `tokens` VALUES (16,118,'d7cbe3fa2253503538235a49ce0a49698cb8af56');
INSERT INTO `tokens` VALUES (17,118,'c1f1e6bd2502343a39b3fcd1a21034002e41c305');
INSERT INTO `tokens` VALUES (18,118,'1c15e097455c96a3b5059afca5be77f5921a448f');
INSERT INTO `tokens` VALUES (19,118,'8213ddd95a655fc8e3398b37ad35db07d9a2e501');
INSERT INTO `tokens` VALUES (23,1,'4c3d61661f3c64c626b3142fedd83816458707aa');
INSERT INTO `tokens` VALUES (25,1,'e45b6255cafa95f19ca8111d9c60ab7461d558dc');
INSERT INTO `tokens` VALUES (27,1,'45bb0ac84f4c10abf29ed3b5617276cdf40d4c5f');
INSERT INTO `tokens` VALUES (28,1,'b3272f2c73055c81eec3ede9c895b0ea9e83b92f');
INSERT INTO `tokens` VALUES (31,118,'a40fd04ca49ee65cbcb6aec6d26f4528a820a334');
INSERT INTO `tokens` VALUES (32,118,'65c28aea7ed4793f43699587e6d1b4e7277bd941');
INSERT INTO `tokens` VALUES (33,118,'b10726d457f0d1d33a7754096975c3b4dfdc5333');
INSERT INTO `tokens` VALUES (34,118,'0b415dd47a2df43a38cba53e50ed3d8ddac4e818');
INSERT INTO `tokens` VALUES (38,1,'68707d7541ad5298e056962acae6c607b457ee36');
INSERT INTO `tokens` VALUES (39,118,'f1d933c0e3f22c1142e5ddefc55ceb0e03953dec');
INSERT INTO `tokens` VALUES (40,1,'4e48046c1342706a65b6495227e9852ff8facd7b');
INSERT INTO `tokens` VALUES (41,118,'947fd502046f1d243b12a9bb923a9a09d41ccf73');
INSERT INTO `tokens` VALUES (44,1,'b38f49befe37eb37a42c306da758ea76d599f8c3');
INSERT INTO `tokens` VALUES (46,1,'c55dd65b59d2bb756a46ee466c2222799a3d95c3');
INSERT INTO `tokens` VALUES (47,1,'bcac352cee82e40a591c2dcc9bcb1770f27074b5');
INSERT INTO `tokens` VALUES (51,1,'28f9b18f091f85b9f0abe36eab36d73773b7d206');
INSERT INTO `tokens` VALUES (52,118,'cf3f3df82427a2be903da9d6e88cfe5007ffcb08');
INSERT INTO `tokens` VALUES (54,1,'77f0e18b3cdfe0dbe89f72324524c3365304f912');
INSERT INTO `tokens` VALUES (57,1,'9fdc34021b67cd0022cb6376259cba0ee84c4fc4');
INSERT INTO `tokens` VALUES (58,118,'ea63d6df7b682aa3cbc171a40245a17d8b96a50e');
INSERT INTO `tokens` VALUES (60,118,'be111c1ea90e012649c188fa0697b49af05a7734');
INSERT INTO `tokens` VALUES (61,1,'bdeba2d51ddcbd1413e9c5d3ae5dd9acbc8bc328');
INSERT INTO `tokens` VALUES (62,118,'2aa0b9dd7dc2ddf41af88b8318706ea78e78ed0f');
INSERT INTO `tokens` VALUES (63,1,'5dbdf9264002cfd1f6ddb9affd4c673e7d2ef85a');
INSERT INTO `tokens` VALUES (64,1,'5b859a1128445b717aecb18b41d370d9d2955144');
INSERT INTO `tokens` VALUES (76,1,'38066ffd938c0da3accc6bad8e5793abcea2166a');
INSERT INTO `tokens` VALUES (77,1,'1fecfa34e67772528232792856dcb828d9f1b019');
INSERT INTO `tokens` VALUES (78,1,'58d16aecba837ffaca16279b18223d66f079caf9');
INSERT INTO `tokens` VALUES (79,1,'12a4dc4b43882e94b6c2c03daae11adb4968179e');
INSERT INTO `tokens` VALUES (80,1,'62487af05be629878bcfcd97008299cd44be9de5');
INSERT INTO `tokens` VALUES (81,1,'08e958257d23936ed5122253db54aac013fdc1be');
INSERT INTO `tokens` VALUES (85,139,'59732eeddea707318da16d6b361ff0aa527f64f6');
INSERT INTO `tokens` VALUES (86,1,'03998a6f8c6daa1c59d6f3bc9d132759abee146f');
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` integer  primary key  ,
  `rol` integer  ,
  `nombre_usuario` varchar(20)  ,
  `contrasena` text  ,
  `nombres` varchar(100)  ,
  `apellido_paterno` varchar(50)  ,
  `apellido_materno` varchar(50)  ,
  `cargo` varchar(100)  ,
  `departamento` varchar(100)  ,
  `encargado_departamento` varchar(150) ,
  `activado` integer  DEFAULT '1' ,
  `created_at` datetime ,
  `updated_at` datetime
)  ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','Administrador','','','','','',1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `usuarios` VALUES (139,2,'kevin','ffb4761cba839470133bee36aeb139f58d7dbaa9','Kevin','Perez','Maulión','erersd','Taller','',1,'2014-05-08 15:13:33','2014-05-08 15:16:52');
INSERT INTO `usuarios` VALUES (140,2,'daniel','','Daniel Ángel','sd','ada','erersd','ads','',1,'2014-05-08 15:15:11','2014-05-08 15:15:11');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

--
-- Table structure for table `variantes`
--

DROP TABLE IF EXISTS `variantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variantes` (
  `id` integer  primary key  ,
  `tipo_variante_id` integer  ,
  `producto_id` integer ,
  `valor` varchar(20)
)  ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variantes`
--

/*!40000 ALTER TABLE `variantes` DISABLE KEYS */;
INSERT INTO `variantes` VALUES (1,1,65,'#2c9456');
INSERT INTO `variantes` VALUES (2,1,65,'#2e22d6');
INSERT INTO `variantes` VALUES (3,1,65,'#1ac91d');
INSERT INTO `variantes` VALUES (4,1,66,'#213a9e');
INSERT INTO `variantes` VALUES (5,1,66,'#17e80c');
INSERT INTO `variantes` VALUES (6,1,66,'#8ead1d');
INSERT INTO `variantes` VALUES (7,1,68,'#21ad41');
INSERT INTO `variantes` VALUES (8,1,68,'#2f16f0');
INSERT INTO `variantes` VALUES (9,1,69,'#db7629');
INSERT INTO `variantes` VALUES (10,1,69,'#15bd20');
/*!40000 ALTER TABLE `variantes` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-11 19:44:08
commit;
