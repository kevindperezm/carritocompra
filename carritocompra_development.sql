-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-04-2014 a las 17:33:09
-- Versión del servidor: 5.5.37-0ubuntu0.13.10.1
-- Versión de PHP: 5.5.3-1ubuntu2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `carritocompra_development`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la categoría',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre para mostrar de la categoría',
  `url_nombre` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `url_nombre`, `created_at`, `updated_at`) VALUES
(1, 'Productos de prueba', 'productos-de-prueba', '2014-04-26 18:15:02', '2014-04-26 18:44:36'),
(2, 'Papelería', 'papelera', '2014-04-28 16:22:56', '2014-04-28 16:22:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE IF NOT EXISTS `compras` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `usuario_id`, `producto_id`, `variante_id`, `cantidad`, `precio_unitario`, `precio_bruto`, `created_at`, `concretada`) VALUES
(22, 1, 66, 4, 1, 45.55, 45, '2014-04-26 17:14:34', 1),
(23, 1, 66, 5, 1, 45.55, 45, '2014-04-26 17:14:38', 1),
(24, 1, 68, 8, 3, 335, 1005, '2014-04-28 13:04:19', 1),
(25, 1, 68, 7, 5, 335, 1675, '2014-04-28 13:04:26', 1),
(26, 1, 68, 7, 5, 335, 1675, '2014-04-28 13:04:53', 1),
(27, 1, 69, 9, 3, 44, 132, '2014-04-28 16:24:55', 1),
(28, 1, 69, 10, 5, 44, 220, '2014-04-28 16:25:04', 1),
(29, 1, 69, 9, 5, 44, 220, '2014-04-28 16:25:24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `observaciones` text NOT NULL,
  `procesado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `procesado_en` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `observaciones`, `procesado`, `created_at`, `procesado_en`) VALUES
(2, 118, 'Este pedido, ¡lo quiero ya! ¡Kono yaro!', 0, '2014-04-19 23:02:36', '0000-00-00 00:00:00'),
(4, 118, '', 0, '2014-04-22 20:53:07', '0000-00-00 00:00:00'),
(5, 118, 'Esta es una observación\n', 0, '2014-04-22 20:56:29', '0000-00-00 00:00:00'),
(6, 1, 'Este es un pedido de prueba de variantes. Debe listar dos productos iguales con variantes diferentes.', 0, '2014-04-26 17:40:59', '0000-00-00 00:00:00'),
(9, 1, 'Esta es una observación de este nuevo producto.', 0, '2014-04-28 16:29:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_compras`
--

CREATE TABLE IF NOT EXISTS `pedidos_compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) DEFAULT NULL,
  `compra_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `pedidos_compras`
--

INSERT INTO `pedidos_compras` (`id`, `pedido_id`, `compra_id`) VALUES
(1, 2, 6),
(2, 2, 7),
(3, 1, 3),
(4, 4, 8),
(5, 4, 9),
(6, 5, 11),
(7, 5, 12),
(8, 5, 13),
(9, 6, 22),
(10, 7, 22),
(11, 7, 23),
(12, 8, 24),
(13, 8, 25),
(14, 8, 26),
(15, 9, 27),
(16, 9, 28),
(17, 9, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del producto',
  `codigo` varchar(50) NOT NULL COMMENT 'Código que se usa para identificar al producto en otro inventario',
  `descripcion` varchar(255) NOT NULL COMMENT 'Nombre o descripción del producto',
  `imagen` varchar(255) NOT NULL COMMENT 'Nombre de archivo de la imagen de este producto',
  `stock_unitario` int(11) NOT NULL COMMENT 'Cantidad de la que se dispone',
  `precio_unitario` float NOT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT '0' COMMENT '¿Este producto es visible para los clientes?',
  `categoria_id` int(11) NOT NULL COMMENT 'Id de la categoría a la que este producto pertenece',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `descripcion`, `imagen`, `stock_unitario`, `precio_unitario`, `publicado`, `categoria_id`, `created_at`, `updated_at`) VALUES
(48, '23424', 'Miku Dedo', 'public/img/productos/Miku_dedo.jpg', 23432, 23423, 1, 1, '0000-00-00 00:00:00', '2014-04-20 19:59:36'),
(61, '2321313u1203808', 'Naught Miku', 'public/img/productos/naughty_miku_avatar_by_lilviscious-d2y2l8m.jpg', 20, 12.33, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, '23091823018', 'Sacapuntas', 'public/img/productos/Oh_god_what_have_i_done.jpg', 3, 9.88, 1, 1, '0000-00-00 00:00:00', '2014-04-20 19:59:17'),
(63, '12381739', 'Facebook', 'public/img/productos/doxygen_icon.png', 28, 292, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, '324324324324', 'Naranja Fry', 'public/img/productos/Naranja_Fry2.jpg', 34324, 34.33, 1, 1, '2014-04-25 13:46:10', '2014-04-25 13:46:42'),
(66, '324324324324', 'Abuso pokémon', 'public/img/productos/Abuso_animal.jpg', 54, 45.55, 1, 1, '2014-04-26 16:00:38', '2014-04-26 16:00:53'),
(67, '233232432', 'Papelerías', 'public/img/productos/images.jpg', 3434, 343.23, 1, 2, '2014-04-28 00:14:23', '2014-04-28 00:14:30'),
(68, '2424234324', 'Horario de UTeM', 'public/img/productos/Adobe_Photoshop_CS6_icon.png', 335, 335, 1, 1, '2014-04-28 13:02:50', '2014-04-28 13:03:03'),
(69, '324324424', 'Producto de pruebas', 'public/img/productos/desu.gif', 4, 44, 1, 2, '2014-04-28 16:24:32', '2014-04-28 16:24:36'),
(70, '324324324324', 'Naranja Fry', 'public/img/productos/Naranja_Fry2.jpg', 34324, 34.33, 1, 1, '2014-04-25 13:46:10', '2014-04-25 13:46:42'),
(71, '324324324324', 'Naranja Fry', 'public/img/productos/Naranja_Fry2.jpg', 34324, 34.33, 1, 1, '2014-04-25 13:46:10', '2014-04-25 13:46:42'),
(72, '324324324324', 'Naranja Fry', 'public/img/productos/Naranja_Fry2.jpg', 34324, 34.33, 1, 1, '2014-04-25 13:46:10', '2014-04-25 13:46:42'),
(73, '324324324324', 'Naranja Fry', 'public/img/productos/Naranja_Fry2.jpg', 34324, 34.33, 1, 1, '2014-04-25 13:46:10', '2014-04-25 13:46:42'),
(74, '324324324324', 'Naranja Fry', 'public/img/productos/Naranja_Fry2.jpg', 34324, 34.33, 1, 1, '2014-04-25 13:46:10', '2014-04-25 13:46:42'),
(75, '324324324324', 'Naranja Fry', 'public/img/productos/Naranja_Fry2.jpg', 34324, 34.33, 1, 1, '2014-04-25 13:46:10', '2014-04-25 13:46:42'),
(76, '324324324324', 'Naranja Fry', 'public/img/productos/Naranja_Fry2.jpg', 34324, 34.33, 1, 1, '2014-04-25 13:46:10', '2014-04-25 13:46:42'),
(77, '324324324324', 'Naranja Fry', 'public/img/productos/Naranja_Fry2.jpg', 34324, 34.33, 1, 1, '2014-04-25 13:46:10', '2014-04-25 13:46:42'),
(78, '324324324324', 'Naranja Fry', 'public/img/productos/Naranja_Fry2.jpg', 34324, 34.33, 1, 1, '2014-04-25 13:46:10', '2014-04-25 13:46:42'),
(79, '324324324324', 'Naranja Fry', 'public/img/productos/Naranja_Fry2.jpg', 34324, 34.33, 1, 1, '2014-04-25 13:46:10', '2014-04-25 13:46:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `string` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Volcado de datos para la tabla `tokens`
--

INSERT INTO `tokens` (`id`, `usuario_id`, `string`) VALUES
(5, 1, '530c55b439eb14b6f3b8a66bb71e61dca2991067'),
(10, 1, '684856e4ddde32adf5c585141f11b9209aa96ec4'),
(11, 1, 'c0029eb589522a385fa0b9474d533856aaa26e48'),
(14, 1, 'e9060391eb22c3283f944bd6b60f79253094634e'),
(16, 118, 'd7cbe3fa2253503538235a49ce0a49698cb8af56'),
(17, 118, 'c1f1e6bd2502343a39b3fcd1a21034002e41c305'),
(18, 118, '1c15e097455c96a3b5059afca5be77f5921a448f'),
(19, 118, '8213ddd95a655fc8e3398b37ad35db07d9a2e501'),
(23, 1, '4c3d61661f3c64c626b3142fedd83816458707aa'),
(25, 1, 'e45b6255cafa95f19ca8111d9c60ab7461d558dc'),
(27, 1, '45bb0ac84f4c10abf29ed3b5617276cdf40d4c5f'),
(28, 1, 'b3272f2c73055c81eec3ede9c895b0ea9e83b92f'),
(31, 118, 'a40fd04ca49ee65cbcb6aec6d26f4528a820a334'),
(32, 118, '65c28aea7ed4793f43699587e6d1b4e7277bd941'),
(33, 118, 'b10726d457f0d1d33a7754096975c3b4dfdc5333'),
(34, 118, '0b415dd47a2df43a38cba53e50ed3d8ddac4e818'),
(38, 1, '68707d7541ad5298e056962acae6c607b457ee36'),
(39, 118, 'f1d933c0e3f22c1142e5ddefc55ceb0e03953dec'),
(40, 1, '4e48046c1342706a65b6495227e9852ff8facd7b'),
(41, 118, '947fd502046f1d243b12a9bb923a9a09d41ccf73'),
(44, 1, 'b38f49befe37eb37a42c306da758ea76d599f8c3'),
(46, 1, 'c55dd65b59d2bb756a46ee466c2222799a3d95c3'),
(47, 1, 'bcac352cee82e40a591c2dcc9bcb1770f27074b5'),
(51, 1, '28f9b18f091f85b9f0abe36eab36d73773b7d206'),
(52, 118, 'cf3f3df82427a2be903da9d6e88cfe5007ffcb08'),
(54, 1, '77f0e18b3cdfe0dbe89f72324524c3365304f912'),
(57, 1, '9fdc34021b67cd0022cb6376259cba0ee84c4fc4'),
(58, 118, 'ea63d6df7b682aa3cbc171a40245a17d8b96a50e'),
(60, 118, 'be111c1ea90e012649c188fa0697b49af05a7734'),
(61, 1, 'bdeba2d51ddcbd1413e9c5d3ae5dd9acbc8bc328'),
(62, 118, '2aa0b9dd7dc2ddf41af88b8318706ea78e78ed0f');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `rol`, `nombre_usuario`, `contrasena`, `nombres`, `apellido_paterno`, `apellido_materno`, `cargo`, `departamento`, `encargado_departamento`, `activado`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrador', '', '', '', '', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 2, 'kevin', 'ffb4761cba839470133bee36aeb139f58d7dbaa9', 'Kevin', 'Perez', 'Maulión', 'Empleado', 'Tienda', 'Sr. Encargado', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 2, 'daniel', '3d0f3b9ddcacec30c4008c5e030e6c13a478cb4f', 'Daniel Ángel', 'Dolores', 'Cardenas', 'Vendedor', 'Ventas', '', 1, '0000-00-00 00:00:00', '2014-04-20 19:53:25'),
(137, 2, 'casandra', 'a9841a43924d5c23db530252913d829cf254538f', 'Casandra', 'Dolores', 'Cardenas', 'Entrenadora', 'Pokémon', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 2, 'sayra', '6e21dffb8cb81d2404920527c1b6beea75e52c91', 'Sayra Nereida', 'Contreras', 'Bueno', 'Gerente', 'Ventas', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variantes`
--

CREATE TABLE IF NOT EXISTS `variantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de variante de producto',
  `tipo_variante_id` int(11) NOT NULL COMMENT 'Id del tipo de variante',
  `producto_id` int(11) NOT NULL,
  `valor` varchar(20) NOT NULL COMMENT 'Valor que varía con respecto al producto original',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `variantes`
--

INSERT INTO `variantes` (`id`, `tipo_variante_id`, `producto_id`, `valor`) VALUES
(1, 1, 65, '#2c9456'),
(2, 1, 65, '#2e22d6'),
(3, 1, 65, '#1ac91d'),
(4, 1, 66, '#213a9e'),
(5, 1, 66, '#17e80c'),
(6, 1, 66, '#8ead1d'),
(7, 1, 68, '#21ad41'),
(8, 1, 68, '#2f16f0'),
(9, 1, 69, '#db7629'),
(10, 1, 69, '#15bd20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
