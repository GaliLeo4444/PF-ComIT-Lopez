-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-10-2017 a las 19:46:50
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `preventa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_p_p`
--

DROP TABLE IF EXISTS `lista_p_p`;
CREATE TABLE IF NOT EXISTS `lista_p_p` (
  `id_pedido` int(10) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  KEY `id_producto` (`id_producto`),
  KEY `id_pedido` (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mayorista`
--

DROP TABLE IF EXISTS `mayorista`;
CREATE TABLE IF NOT EXISTS `mayorista` (
  `CUIT` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`CUIT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `minorista`
--

DROP TABLE IF EXISTS `minorista`;
CREATE TABLE IF NOT EXISTS `minorista` (
  `CUIT_CUIL` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CUIT_CUIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_mayor` int(11) UNSIGNED NOT NULL,
  `id_minor` int(11) UNSIGNED NOT NULL,
  `cantidad` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comentario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mayor` (`id_mayor`),
  KEY `id_minor` (`id_minor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `num` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_mayor` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio_unit` decimal(6,2) UNSIGNED NOT NULL,
  `min_unit` smallint(6) UNSIGNED NOT NULL DEFAULT '1',
  `descipcion` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`num`),
  KEY `fk_mayor` (`id_mayor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_mayor` int(11) UNSIGNED NOT NULL,
  `id_minor` int(11) UNSIGNED NOT NULL,
  KEY `id_mayor` (`id_mayor`),
  KEY `id_minor` (`id_minor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lista_p_p`
--
ALTER TABLE `lista_p_p`
  ADD CONSTRAINT `lista_p_p_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`num`),
  ADD CONSTRAINT `lista_p_p_ibfk_2` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_mayor`) REFERENCES `mayorista` (`CUIT`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_minor`) REFERENCES `minorista` (`CUIT_CUIL`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_mayor` FOREIGN KEY (`id_mayor`) REFERENCES `mayorista` (`CUIT`),
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_mayor`) REFERENCES `mayorista` (`CUIT`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_mayor`) REFERENCES `mayorista` (`CUIT`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_mayor`) REFERENCES `mayorista` (`CUIT`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`id_mayor`) REFERENCES `mayorista` (`CUIT`),
  ADD CONSTRAINT `usuario_ibfk_4` FOREIGN KEY (`id_minor`) REFERENCES `minorista` (`CUIT_CUIL`),
  ADD CONSTRAINT `usuario_ibfk_5` FOREIGN KEY (`id_minor`) REFERENCES `minorista` (`CUIT_CUIL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
