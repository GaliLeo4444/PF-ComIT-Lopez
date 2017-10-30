-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-10-2017 a las 02:22:44
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
CREATE DATABASE IF NOT EXISTS `preventa` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `preventa`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_p_p`
--

DROP TABLE IF EXISTS `lista_p_p`;
CREATE TABLE `lista_p_p` (
  `id_pedido` int(10) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `cant_productos` smallint(5) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mayorista`
--

DROP TABLE IF EXISTS `mayorista`;
CREATE TABLE `mayorista` (
  `CUIT` bigint(12) UNSIGNED NOT NULL,
  `nombre` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `minorista`
--

DROP TABLE IF EXISTS `minorista`;
CREATE TABLE `minorista` (
  `CUIT_CUIL` bigint(12) UNSIGNED NOT NULL,
  `nombre` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE `pedido` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_mayor` bigint(12) UNSIGNED NOT NULL,
  `id_minor` bigint(12) UNSIGNED NOT NULL,
  `cantidad` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('presentado','visto','aceptado','rechazado') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'presentado',
  `comentario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `num` bigint(20) UNSIGNED NOT NULL,
  `id_mayor` bigint(12) UNSIGNED NOT NULL,
  `codigo` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio_unit` decimal(6,2) UNSIGNED NOT NULL,
  `min_unit` smallint(6) UNSIGNED NOT NULL DEFAULT '1',
  `descipcion` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_mayor` bigint(12) UNSIGNED NOT NULL,
  `id_minor` bigint(12) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lista_p_p`
--
ALTER TABLE `lista_p_p`
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `mayorista`
--
ALTER TABLE `mayorista`
  ADD PRIMARY KEY (`CUIT`);

--
-- Indices de la tabla `minorista`
--
ALTER TABLE `minorista`
  ADD PRIMARY KEY (`CUIT_CUIL`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_fk_id_mayor` (`id_mayor`),
  ADD KEY `pedido_fk_id_minor` (`id_minor`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`num`),
  ADD KEY `producto_fk_1` (`id_mayor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD KEY `usuario_fk_id_mayor` (`id_mayor`),
  ADD KEY `usuario_fk_id_minor` (`id_minor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `num` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `pedido_fk_id_mayor` FOREIGN KEY (`id_mayor`) REFERENCES `mayorista` (`CUIT`),
  ADD CONSTRAINT `pedido_fk_id_minor` FOREIGN KEY (`id_minor`) REFERENCES `minorista` (`CUIT_CUIL`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_fk_1` FOREIGN KEY (`id_mayor`) REFERENCES `mayorista` (`CUIT`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_fk_id_mayor` FOREIGN KEY (`id_mayor`) REFERENCES `mayorista` (`CUIT`),
  ADD CONSTRAINT `usuario_fk_id_minor` FOREIGN KEY (`id_minor`) REFERENCES `minorista` (`CUIT_CUIL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
