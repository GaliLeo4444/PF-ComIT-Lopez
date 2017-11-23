-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 23-11-2017 a las 20:12:04
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_mayor` bigint(12) UNSIGNED NOT NULL,
  `id_minor` bigint(12) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_p_p`
--

CREATE TABLE `lista_p_p` (
  `id_pedido` int(10) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `cant_productos` smallint(5) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mayorista`
--

CREATE TABLE `mayorista` (
  `CUIT` bigint(12) UNSIGNED NOT NULL,
  `nombre` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mayorista`
--

INSERT INTO `mayorista` (`CUIT`, `nombre`, `email`, `pass`, `direccion`, `descripcion`) VALUES
(20322093463, 'Mayorista Comunidad IT', 'pipipipi@cualquiera.com', '1234', 'Argentina', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `minorista`
--

CREATE TABLE `minorista` (
  `CUIT_CUIL` bigint(12) UNSIGNED NOT NULL,
  `nombre` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `minorista`
--

INSERT INTO `minorista` (`CUIT_CUIL`, `nombre`, `email`, `pass`, `direccion`) VALUES
(20322093463, 'Supermercado Maka', 'maka@gmail.com', '1234', 'Bahia Blanca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_mayor` bigint(12) UNSIGNED NOT NULL,
  `id_minor` bigint(12) UNSIGNED NOT NULL,
  `cantidad` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('presentado','visto','aceptado','rechazado') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'presentado',
  `comentario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `id_mayor`, `id_minor`, `cantidad`, `fecha`, `estado`, `comentario`) VALUES
(1, 20322093463, 20322093463, 1, '2017-11-23 18:14:59', 'presentado', 'De Prueba'),
(2, 20322093463, 20322093463, 4, '2017-11-23 18:58:00', 'presentado', NULL),
(3, 20322093463, 20322093463, 2, '2017-11-23 20:03:16', 'presentado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `num` bigint(20) UNSIGNED NOT NULL,
  `id_mayor` bigint(12) UNSIGNED NOT NULL,
  `codigo` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio_unit` decimal(6,2) UNSIGNED NOT NULL,
  `min_unit` smallint(6) UNSIGNED NOT NULL DEFAULT '1',
  `stock` smallint(6) NOT NULL DEFAULT '-1',
  `descripcion` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dir_imagen` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`num`, `id_mayor`, `codigo`, `precio_unit`, `min_unit`, `stock`, `descripcion`, `dir_imagen`) VALUES
(1, 20322093463, 'Producto0000', '44.44', 1, 0, 'paquete....', NULL),
(2, 20322093463, 'Producto2222', '22.22', 1, 0, 'paquete....', NULL),
(4, 20322093463, 'Producto1111', '11.00', 1, 0, 'paquete....', NULL),
(7, 20322093463, 'Producto-1234', '44.44', 1, -1, '', NULL),
(8, 20322093463, 'OtroProducto', '1.00', 1, 400, '', NULL),
(10, 20322093463, 'Cajaxxxx', '123.45', 1, -1, 'Se vende por cajas', NULL),
(11, 20322093463, 'Articulo1234', '20.17', 40, 500, 'Por cantidad', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD KEY `usuario_fk_id_mayor` (`id_mayor`),
  ADD KEY `usuario_fk_id_minor` (`id_minor`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `num` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `usuario_fk_id_mayor` FOREIGN KEY (`id_mayor`) REFERENCES `mayorista` (`CUIT`),
  ADD CONSTRAINT `usuario_fk_id_minor` FOREIGN KEY (`id_minor`) REFERENCES `minorista` (`CUIT_CUIL`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
