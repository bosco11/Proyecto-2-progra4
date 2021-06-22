-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2021 a las 00:47:58
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_marketplace`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_calificacion_productos`
--

CREATE TABLE `tbl_calificacion_productos` (
  `id_productos` bigint NOT NULL,
  `calificacion` bigint NOT NULL,
  `comentarios` varchar(300) DEFAULT NULL,
  `respuetas` varchar(300) DEFAULT NULL,
  `id_usuarios` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_calificacion_tienda`
--

CREATE TABLE `tbl_calificacion_tienda` (
  `calificacion` bigint NOT NULL,
  `tienda_id_usuarios` bigint NOT NULL,
  `comprador_id_usuarios` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carrito_deseos`
--

CREATE TABLE `tbl_carrito_deseos` (
  `id_usuarios` bigint NOT NULL,
  `id_productos` bigint NOT NULL,
  `tipo_producto` varchar(45) NOT NULL,
  `cantidad` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias`
--

CREATE TABLE `tbl_categorias` (
  `id_categorias` bigint NOT NULL,
  `categorias` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compras`
--

CREATE TABLE `tbl_compras` (
  `id_compras` bigint NOT NULL,
  `id_usuarios` bigint NOT NULL,
  `id_formas_pago` bigint NOT NULL,
  `fecha` date NOT NULL,
  `precio_total` float NOT NULL,
  `id_direcciones` bigint NOT NULL,
  `id_premios` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_denuncias`
--

CREATE TABLE `tbl_denuncias` (
  `tienda_id_usuarios` bigint NOT NULL,
  `comprador_id_usuarios` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_direcciones`
--

CREATE TABLE `tbl_direcciones` (
  `id_direcciones` bigint NOT NULL,
  `pais_direccion` varchar(200) NOT NULL,
  `provincia` varchar(200) NOT NULL,
  `numero_casillero` varchar(200) NOT NULL,
  `codigo_postal` varchar(100) NOT NULL,
  `observaciones` varchar(300) NOT NULL,
  `id_usuarios` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_formas_pago`
--

CREATE TABLE `tbl_formas_pago` (
  `id_formas_pago` bigint NOT NULL,
  `nombre_dueno` varchar(200) NOT NULL,
  `numero_tarjeta` bigint NOT NULL,
  `cvv` varchar(200) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `saldo` float NOT NULL,
  `id_usuarios` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_galeria`
--

CREATE TABLE `tbl_galeria` (
  `id_galeria` bigint NOT NULL,
  `imagen_producto` varchar(200) NOT NULL,
  `id_productos` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_notificaciones`
--

CREATE TABLE `tbl_notificaciones` (
  `id_notificaciones` bigint NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `id_usuarios` bigint NOT NULL,
  `estado` varchar(1) NOT NULL,
  `id_productos` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_premios`
--

CREATE TABLE `tbl_premios` (
  `id_premios` bigint NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `id_usuarios` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `id_productos` bigint NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `ubicacion_fisica` varchar(200) NOT NULL,
  `precio` float NOT NULL,
  `tiempo_promedio` varchar(45) NOT NULL,
  `costo_envio` float NOT NULL,
  `id_usuarios` bigint NOT NULL,
  `id_categorias` bigint NOT NULL,
  `cantidad` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos_compras`
--

CREATE TABLE `tbl_productos_compras` (
  `id_productos` bigint NOT NULL,
  `id_compras` bigint NOT NULL,
  `cantidades` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_redes_sociales`
--

CREATE TABLE `tbl_redes_sociales` (
  `id_redes_sociales` bigint NOT NULL,
  `red_social` varchar(64) NOT NULL,
  `nombre_usuario` varchar(150) NOT NULL,
  `id_usuarios` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_suscriptores`
--

CREATE TABLE `tbl_suscriptores` (
  `tienda_id_usuarios` bigint NOT NULL,
  `comprador_id_usuarios` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id_usuarios` bigint NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nombre_real` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `telefono` bigint NOT NULL,
  `correo` varchar(45) NOT NULL,
  `tipo_usuario` varchar(200) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `fecha_giros` date DEFAULT NULL,
  `cantidad_giros` bigint DEFAULT NULL,
  `denuncias` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_calificacion_productos`
--
ALTER TABLE `tbl_calificacion_productos`
  ADD PRIMARY KEY (`id_usuarios`,`id_productos`),
  ADD KEY `fk_tbl_calificacion_productos_tbl_productos1_idx` (`id_productos`);

--
-- Indices de la tabla `tbl_calificacion_tienda`
--
ALTER TABLE `tbl_calificacion_tienda`
  ADD PRIMARY KEY (`tienda_id_usuarios`,`comprador_id_usuarios`),
  ADD KEY `fk_tbl_calificacion_tienda_tbl_usuarios2_idx` (`comprador_id_usuarios`);

--
-- Indices de la tabla `tbl_carrito_deseos`
--
ALTER TABLE `tbl_carrito_deseos`
  ADD KEY `fk_tbl_carrito_deseos_tbl_usuarios1_idx` (`id_usuarios`),
  ADD KEY `fk_tbl_carrito_deseos_tbl_productos1_idx` (`id_productos`);

--
-- Indices de la tabla `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  ADD PRIMARY KEY (`id_categorias`),
  ADD UNIQUE KEY `categorias_UNIQUE` (`categorias`);

--
-- Indices de la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD PRIMARY KEY (`id_compras`),
  ADD KEY `fk_tbl_compras_tbl_usuarios1_idx` (`id_usuarios`),
  ADD KEY `fk_tbl_compras_tbl_formas_pago1_idx` (`id_formas_pago`),
  ADD KEY `fk_tbl_compras_tbl_direcciones1_idx` (`id_direcciones`),
  ADD KEY `fk_tbl_compras_tbl_premios1_idx` (`id_premios`);

--
-- Indices de la tabla `tbl_denuncias`
--
ALTER TABLE `tbl_denuncias`
  ADD KEY `fk_tbl_denuncias_tbl_usuarios1_idx` (`tienda_id_usuarios`),
  ADD KEY `fk_tbl_denuncias_tbl_usuarios2_idx` (`comprador_id_usuarios`);

--
-- Indices de la tabla `tbl_direcciones`
--
ALTER TABLE `tbl_direcciones`
  ADD PRIMARY KEY (`id_direcciones`),
  ADD KEY `fk_tbl_direcciones_tbl_usuarios1_idx` (`id_usuarios`);

--
-- Indices de la tabla `tbl_formas_pago`
--
ALTER TABLE `tbl_formas_pago`
  ADD PRIMARY KEY (`id_formas_pago`),
  ADD KEY `fk_tbl_formas_pago_tbl_usuarios1_idx` (`id_usuarios`);

--
-- Indices de la tabla `tbl_galeria`
--
ALTER TABLE `tbl_galeria`
  ADD PRIMARY KEY (`id_galeria`),
  ADD KEY `fk_tbl_galeria_tbl_productos1_idx` (`id_productos`);

--
-- Indices de la tabla `tbl_notificaciones`
--
ALTER TABLE `tbl_notificaciones`
  ADD PRIMARY KEY (`id_notificaciones`),
  ADD KEY `fk_tbl_notificaciones_tbl_usuarios1_idx` (`id_usuarios`),
  ADD KEY `fk_tbl_notificaciones_tbl_productos1_idx` (`id_productos`);

--
-- Indices de la tabla `tbl_premios`
--
ALTER TABLE `tbl_premios`
  ADD PRIMARY KEY (`id_premios`),
  ADD KEY `fk_tbl_premios_tbl_usuarios1_idx` (`id_usuarios`);

--
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`id_productos`),
  ADD KEY `fk_tbl_productos_tbl_usuarios1_idx` (`id_usuarios`),
  ADD KEY `fk_tbl_productos_tbl_categorias1_idx` (`id_categorias`);

--
-- Indices de la tabla `tbl_productos_compras`
--
ALTER TABLE `tbl_productos_compras`
  ADD KEY `fk_tbl_productos_compras_tbl_productos1_idx` (`id_productos`),
  ADD KEY `fk_tbl_productos_compras_tbl_compras1_idx` (`id_compras`);

--
-- Indices de la tabla `tbl_redes_sociales`
--
ALTER TABLE `tbl_redes_sociales`
  ADD PRIMARY KEY (`id_redes_sociales`),
  ADD KEY `fk_tbl_redes_sociales_tbl_usuarios1_idx` (`id_usuarios`);

--
-- Indices de la tabla `tbl_suscriptores`
--
ALTER TABLE `tbl_suscriptores`
  ADD PRIMARY KEY (`tienda_id_usuarios`,`comprador_id_usuarios`),
  ADD KEY `fk_tbl_suscriptores_tbl_usuarios2_idx` (`comprador_id_usuarios`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id_usuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  MODIFY `id_categorias` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  MODIFY `id_compras` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_direcciones`
--
ALTER TABLE `tbl_direcciones`
  MODIFY `id_direcciones` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_formas_pago`
--
ALTER TABLE `tbl_formas_pago`
  MODIFY `id_formas_pago` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_galeria`
--
ALTER TABLE `tbl_galeria`
  MODIFY `id_galeria` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_notificaciones`
--
ALTER TABLE `tbl_notificaciones`
  MODIFY `id_notificaciones` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_premios`
--
ALTER TABLE `tbl_premios`
  MODIFY `id_premios` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `id_productos` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_redes_sociales`
--
ALTER TABLE `tbl_redes_sociales`
  MODIFY `id_redes_sociales` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_usuarios` bigint NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_calificacion_productos`
--
ALTER TABLE `tbl_calificacion_productos`
  ADD CONSTRAINT `fk_tbl_calificacion_productos_tbl_productos1` FOREIGN KEY (`id_productos`) REFERENCES `tbl_productos` (`id_productos`),
  ADD CONSTRAINT `fk_tbl_calificacion_productos_tbl_usuarios1` FOREIGN KEY (`id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `tbl_calificacion_tienda`
--
ALTER TABLE `tbl_calificacion_tienda`
  ADD CONSTRAINT `fk_tbl_calificacion_tienda_tbl_usuarios1` FOREIGN KEY (`tienda_id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`),
  ADD CONSTRAINT `fk_tbl_calificacion_tienda_tbl_usuarios2` FOREIGN KEY (`comprador_id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `tbl_carrito_deseos`
--
ALTER TABLE `tbl_carrito_deseos`
  ADD CONSTRAINT `fk_tbl_carrito_deseos_tbl_productos1` FOREIGN KEY (`id_productos`) REFERENCES `tbl_productos` (`id_productos`),
  ADD CONSTRAINT `fk_tbl_carrito_deseos_tbl_usuarios1` FOREIGN KEY (`id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD CONSTRAINT `fk_tbl_compras_tbl_direcciones1` FOREIGN KEY (`id_direcciones`) REFERENCES `tbl_direcciones` (`id_direcciones`),
  ADD CONSTRAINT `fk_tbl_compras_tbl_formas_pago1` FOREIGN KEY (`id_formas_pago`) REFERENCES `tbl_formas_pago` (`id_formas_pago`),
  ADD CONSTRAINT `fk_tbl_compras_tbl_premios1` FOREIGN KEY (`id_premios`) REFERENCES `tbl_premios` (`id_premios`),
  ADD CONSTRAINT `fk_tbl_compras_tbl_usuarios1` FOREIGN KEY (`id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `tbl_denuncias`
--
ALTER TABLE `tbl_denuncias`
  ADD CONSTRAINT `fk_tbl_denuncias_tbl_usuarios1` FOREIGN KEY (`tienda_id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`),
  ADD CONSTRAINT `fk_tbl_denuncias_tbl_usuarios2` FOREIGN KEY (`comprador_id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `tbl_direcciones`
--
ALTER TABLE `tbl_direcciones`
  ADD CONSTRAINT `fk_tbl_direcciones_tbl_usuarios1` FOREIGN KEY (`id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `tbl_formas_pago`
--
ALTER TABLE `tbl_formas_pago`
  ADD CONSTRAINT `fk_tbl_formas_pago_tbl_usuarios1` FOREIGN KEY (`id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `tbl_galeria`
--
ALTER TABLE `tbl_galeria`
  ADD CONSTRAINT `fk_tbl_galeria_tbl_productos1` FOREIGN KEY (`id_productos`) REFERENCES `tbl_productos` (`id_productos`);

--
-- Filtros para la tabla `tbl_notificaciones`
--
ALTER TABLE `tbl_notificaciones`
  ADD CONSTRAINT `fk_tbl_notificaciones_tbl_productos1` FOREIGN KEY (`id_productos`) REFERENCES `tbl_productos` (`id_productos`),
  ADD CONSTRAINT `fk_tbl_notificaciones_tbl_usuarios1` FOREIGN KEY (`id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `tbl_premios`
--
ALTER TABLE `tbl_premios`
  ADD CONSTRAINT `fk_tbl_premios_tbl_usuarios1` FOREIGN KEY (`id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `fk_tbl_productos_tbl_categorias1` FOREIGN KEY (`id_categorias`) REFERENCES `tbl_categorias` (`id_categorias`),
  ADD CONSTRAINT `fk_tbl_productos_tbl_usuarios1` FOREIGN KEY (`id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `tbl_productos_compras`
--
ALTER TABLE `tbl_productos_compras`
  ADD CONSTRAINT `fk_tbl_productos_compras_tbl_compras1` FOREIGN KEY (`id_compras`) REFERENCES `tbl_compras` (`id_compras`),
  ADD CONSTRAINT `fk_tbl_productos_compras_tbl_productos1` FOREIGN KEY (`id_productos`) REFERENCES `tbl_productos` (`id_productos`);

--
-- Filtros para la tabla `tbl_redes_sociales`
--
ALTER TABLE `tbl_redes_sociales`
  ADD CONSTRAINT `fk_tbl_redes_sociales_tbl_usuarios1` FOREIGN KEY (`id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `tbl_suscriptores`
--
ALTER TABLE `tbl_suscriptores`
  ADD CONSTRAINT `fk_tbl_suscriptores_tbl_usuarios1` FOREIGN KEY (`tienda_id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`),
  ADD CONSTRAINT `fk_tbl_suscriptores_tbl_usuarios2` FOREIGN KEY (`comprador_id_usuarios`) REFERENCES `tbl_usuarios` (`id_usuarios`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
