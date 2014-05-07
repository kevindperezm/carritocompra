-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-04-2014 a las 21:47:53
-- Versión del servidor: 5.5.33-MariaDB
-- Versión de PHP: 5.4.20

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
  `activado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '¿El usuario puede iniciar sesión en el sitio?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `rol`, `nombre_usuario`, `contrasena`, `nombres`, `apellido_paterno`, `apellido_materno`, `cargo`, `departamento`, `activado`) VALUES
(6, 2, 'kevin', 'ffb4761cba839470133bee36aeb139f58d7dbaa9', 'Kevin', 'Perez', 'Maulión', 'Empleado', 'Tienda', 1),
(8, 2, 'sayra', '6e21dffb8cb81d2404920527c1b6beea75e52c91', 'Sayra Nereida', 'Contreras', 'Bueno', 'Empleada', 'Ventas', 1),
(10, 2, 'daniel', '3d0f3b9ddcacec30c4008c5e030e6c13a478cb4f', 'Daniel', 'Dolores', 'Cárdenas', 'Director', 'Ventas', 1),
(13, 2, 'sayra', '6e21dffb8cb81d2404920527c1b6beea75e52c91', 'Sayra Nereida', 'Contreras', 'Bueno', 'Empleada', 'Ventas', 1),
(14, 2, 'sayra', '6e21dffb8cb81d2404920527c1b6beea75e52c91', 'Sayra Nereida', 'Contreras', 'Bueno', 'Empleada', 'Ventas', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
