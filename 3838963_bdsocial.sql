-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: fdb18.awardspace.net
-- Tiempo de generación: 22-06-2021 a las 23:12:20
-- Versión del servidor: 5.7.20-log
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `3838963_bdsocial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_calificacion_productos`
--

CREATE TABLE `tbl_calificacion_productos` (
  `id_productos` bigint(20) NOT NULL,
  `calificacion` bigint(20) NOT NULL,
  `comentarios` varchar(300) DEFAULT NULL,
  `respuetas` varchar(300) DEFAULT NULL,
  `id_usuarios` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_calificacion_tienda`
--

CREATE TABLE `tbl_calificacion_tienda` (
  `calificacion` bigint(20) NOT NULL,
  `tienda_id_usuarios` bigint(20) NOT NULL,
  `comprador_id_usuarios` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carrito_deseos`
--

CREATE TABLE `tbl_carrito_deseos` (
  `id_usuarios` bigint(20) NOT NULL,
  `id_productos` bigint(20) NOT NULL,
  `tipo_producto` varchar(45) NOT NULL,
  `cantidad` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias`
--

CREATE TABLE `tbl_categorias` (
  `id_categorias` bigint(20) NOT NULL,
  `categorias` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_categorias`
--

INSERT INTO `tbl_categorias` (`id_categorias`, `categorias`) VALUES
(2, 'Comida'),
(3, 'Herramientas'),
(1, 'Ropa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compras`
--

CREATE TABLE `tbl_compras` (
  `id_compras` bigint(20) NOT NULL,
  `id_usuarios` bigint(20) NOT NULL,
  `id_formas_pago` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `precio_total` float NOT NULL,
  `id_direcciones` bigint(20) NOT NULL,
  `id_premios` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_denuncias`
--

CREATE TABLE `tbl_denuncias` (
  `tienda_id_usuarios` bigint(20) NOT NULL,
  `comprador_id_usuarios` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_direcciones`
--

CREATE TABLE `tbl_direcciones` (
  `id_direcciones` bigint(20) NOT NULL,
  `pais_direccion` varchar(200) NOT NULL,
  `provincia` varchar(200) NOT NULL,
  `numero_casillero` varchar(200) NOT NULL,
  `codigo_postal` varchar(100) NOT NULL,
  `observaciones` varchar(300) NOT NULL,
  `id_usuarios` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_formas_pago`
--

CREATE TABLE `tbl_formas_pago` (
  `id_formas_pago` bigint(20) NOT NULL,
  `nombre_dueno` varchar(200) NOT NULL,
  `numero_tarjeta` bigint(20) NOT NULL,
  `cvv` varchar(200) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `saldo` float NOT NULL,
  `id_usuarios` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_galeria`
--

CREATE TABLE `tbl_galeria` (
  `id_galeria` bigint(20) NOT NULL,
  `imagen_producto` varchar(200) NOT NULL,
  `id_productos` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_notificaciones`
--

CREATE TABLE `tbl_notificaciones` (
  `id_notificaciones` bigint(20) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `id_usuarios` bigint(20) NOT NULL,
  `estado` varchar(1) NOT NULL,
  `id_productos` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_premios`
--

CREATE TABLE `tbl_premios` (
  `id_premios` bigint(20) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `id_usuarios` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `id_productos` bigint(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `ubicacion_fisica` varchar(200) NOT NULL,
  `precio` float NOT NULL,
  `tiempo_promedio` varchar(45) NOT NULL,
  `costo_envio` float NOT NULL,
  `id_usuarios` bigint(20) NOT NULL,
  `id_categorias` bigint(20) NOT NULL,
  `cantidad` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`id_productos`, `descripcion`, `fecha_publicacion`, `ubicacion_fisica`, `precio`, `tiempo_promedio`, `costo_envio`, `id_usuarios`, `id_categorias`, `cantidad`) VALUES
(1, 'Camisa roja', '2021-06-22', 'San antonio PZ', 50, '23 minutos', 12, 1, 1, 10),
(2, 'Boxer grande', '2021-06-22', 'Cajon PZ', 20, '10 minutos', 2, 1, 1, 23),
(3, 'Hamburguesa', '2021-06-22', 'Perez Zeledon centro', 10, '40 minutos', 2, 3, 2, 5),
(4, 'Coca cola', '2021-06-22', 'Perez Zeledon centro', 4, '10 minutos', 1, 3, 2, 15),
(5, 'martillo', '2021-06-22', 'San antonio PZ', 10, '23 minutos', 2, 4, 3, 4),
(6, 'Pala truper', '2021-06-22', 'Cajon PZ', 15, '10 minutos', 2, 4, 3, 23),
(7, 'Clavos 2 pulgadas', '2021-06-22', 'San antonio PZ', 2, '10 minutos', 1, 4, 3, 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos_compras`
--

CREATE TABLE `tbl_productos_compras` (
  `id_productos` bigint(20) NOT NULL,
  `id_compras` bigint(20) NOT NULL,
  `cantidades` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_redes_sociales`
--

CREATE TABLE `tbl_redes_sociales` (
  `id_redes_sociales` bigint(20) NOT NULL,
  `red_social` varchar(64) NOT NULL,
  `nombre_usuario` varchar(150) NOT NULL,
  `id_usuarios` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_suscriptores`
--

CREATE TABLE `tbl_suscriptores` (
  `tienda_id_usuarios` bigint(20) NOT NULL,
  `comprador_id_usuarios` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id_usuarios` bigint(20) NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nombre_real` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `tipo_usuario` varchar(200) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `fecha_giros` date DEFAULT NULL,
  `cantidad_giros` bigint(20) DEFAULT NULL,
  `denuncias` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuarios`, `cedula`, `user`, `password`, `nombre_real`, `imagen`, `telefono`, `correo`, `tipo_usuario`, `pais`, `direccion`, `fecha_giros`, `cantidad_giros`, `denuncias`) VALUES
(1, '124635463', 'Adidas', '$2y$10$dXH8XpWSPwI6H5N1exZThewduJzV49KasJbZI5.U3dRZsbth8zgq6', 'AdidasCR', 'unknown.jpg', 1234345, 'cicidssdci233324cic@gmail.com', 'Tienda', 'Costa rica', 'Perez Zeledon', NULL, NULL, 0),
(2, '117150315', 'juan', '$2y$10$.DIA0b62Z69rU.ts5v6z0eLunA2vqRmM6N/8Dbvp1oq3IG5AplVum', 'Juan', 'unknown.jpg', 61837098, 'usuario@usuario', 'Comprador', 'costarica', '100mts sur de la veterinaria corral del sol', NULL, NULL, 0),
(3, '12321657675', 'Kukis', '$2y$10$IUtJghG6VyWAVAcctABIlOmVS1I5SaH/zEQO3zn4fL/ey47VgGpLG', 'Kukis', 'unknown.jpg', 1234345, 'cicidssdc2133324cic@gmai.com', 'Tienda', 'Costa rica', 'Perez Zeledon', NULL, NULL, 0),
(4, '998797867', 'ferreteria', '$2y$10$9m5MPE6VAXVq.GyBFAgvuesi//QrjIXlOAsCyDywHVyupIjQJdS1G', 'Ferreteria Don Bosco', 'unknown.jpg', 214234213412, 'cicicicic@gmai.com', 'Tienda', 'Costa rica', 'Perez Zeledon', NULL, NULL, 0);

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
  MODIFY `id_categorias` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  MODIFY `id_compras` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_direcciones`
--
ALTER TABLE `tbl_direcciones`
  MODIFY `id_direcciones` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_formas_pago`
--
ALTER TABLE `tbl_formas_pago`
  MODIFY `id_formas_pago` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_galeria`
--
ALTER TABLE `tbl_galeria`
  MODIFY `id_galeria` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_notificaciones`
--
ALTER TABLE `tbl_notificaciones`
  MODIFY `id_notificaciones` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_premios`
--
ALTER TABLE `tbl_premios`
  MODIFY `id_premios` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `id_productos` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tbl_redes_sociales`
--
ALTER TABLE `tbl_redes_sociales`
  MODIFY `id_redes_sociales` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_usuarios` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
