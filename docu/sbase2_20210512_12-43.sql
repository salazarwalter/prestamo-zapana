-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-05-2021 a las 12:43:06
-- Versión del servidor: 8.0.23-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sbase2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `id` int NOT NULL,
  `accion_id` int NOT NULL,
  `perfil_id` int NOT NULL,
  `permitido` varchar(1) DEFAULT 'S' COMMENT 'Es  el acceso  principal o  no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`id`, `accion_id`, `perfil_id`, `permitido`) VALUES
(2, 1, 3, 'S'),
(3, 4, 3, 'S'),
(4, 7, 3, 'N'),
(5, 6, 3, 'S'),
(6, 8, 3, 'S'),
(7, 9, 3, 'S'),
(8, 5, 3, 'S'),
(9, 19, 3, 'S'),
(10, 16, 3, 'S'),
(11, 11, 3, 'S'),
(12, 10, 3, 'S'),
(13, 12, 3, 'S'),
(14, 13, 3, 'S'),
(15, 17, 3, 'S'),
(16, 15, 3, 'S'),
(17, 14, 3, 'S'),
(18, 18, 3, 'S'),
(19, 20, 3, 'S'),
(20, 21, 3, 'S'),
(21, 22, 3, 'S'),
(22, 23, 3, 'S'),
(23, 24, 3, 'S'),
(24, 25, 3, 'S'),
(25, 26, 3, 'S'),
(26, 28, 3, 'S'),
(27, 27, 3, 'S'),
(28, 29, 3, 'S'),
(29, 30, 3, 'S'),
(30, 31, 3, 'S'),
(31, 32, 3, 'S'),
(32, 33, 3, 'S'),
(33, 34, 3, 'S'),
(34, 35, 3, 'S'),
(35, 41, 4, 'S'),
(36, 36, 3, 'S'),
(37, 37, 3, 'S'),
(38, 38, 3, 'S'),
(39, 40, 3, 'S'),
(40, 39, 3, 'S'),
(41, 45, 4, 'S'),
(42, 44, 4, 'S'),
(44, 43, 4, 'S'),
(45, 47, 4, 'S'),
(46, 48, 4, 'S'),
(47, 46, 4, 'S'),
(48, 49, 4, 'S'),
(49, 50, 4, 'S'),
(50, 51, 4, 'S'),
(51, 53, 7, 'S'),
(52, 52, 7, 'S'),
(53, 54, 7, 'S'),
(55, 56, 7, 'S'),
(56, 57, 7, 'S'),
(57, 58, 7, 'S'),
(58, 59, 10, 'S'),
(60, 65, 4, 'S'),
(61, 66, 3, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion`
--

CREATE TABLE `accion` (
  `id` int NOT NULL,
  `accion` varchar(45) DEFAULT NULL,
  `controlador_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `accion`
--

INSERT INTO `accion` (`id`, `accion`, `controlador_id`) VALUES
(45, 'clave', 1),
(47, 'claveok', 1),
(44, 'datos', 1),
(48, 'datosok', 1),
(51, 'foto', 1),
(43, 'quitarfoto', 1),
(46, 'quitarfotook', 1),
(41, 'salir', 1),
(26, 'add', 3),
(28, 'del', 3),
(27, 'edit', 3),
(29, 'index', 3),
(20, 'add', 4),
(21, 'ajax_combo', 4),
(22, 'ajax_lista_controladores', 4),
(23, 'del', 4),
(24, 'edit', 4),
(25, 'index', 4),
(30, 'add', 5),
(31, 'ajax_combo', 5),
(32, 'ajax_lista', 5),
(33, 'del', 5),
(34, 'edit', 5),
(35, 'index', 5),
(4, 'add', 6),
(7, 'ajax_combo', 6),
(6, 'ajax_combo_norepeat', 6),
(8, 'ajax_lista', 6),
(9, 'del', 6),
(5, 'edit', 6),
(19, 'index', 6),
(1, 'select', 6),
(16, 'add', 8),
(11, 'ajax_combo', 8),
(10, 'ajax_combo_norepeat', 8),
(12, 'ajax_lista', 8),
(13, 'del', 8),
(17, 'index', 8),
(15, 'nopermitir', 8),
(14, 'permitir', 8),
(18, 'select', 8),
(38, 'add', 9),
(66, 'ajax_opcion_menu', 9),
(40, 'del', 9),
(39, 'edit', 9),
(37, 'index', 9),
(36, 'select', 9),
(49, 'ajax_combo', 10),
(50, 'ajax_opciones', 11),
(53, 'contratados', 12),
(52, 'disponibles', 12),
(54, 'principal', 12),
(57, 'ajax_modulo_add', 13),
(58, 'ajax_modulo_del', 13),
(56, 'ajax_perfiles_contratados', 13),
(59, 'generarpagos', 14),
(65, 'salir', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

CREATE TABLE `comprobante` (
  `id` int NOT NULL,
  `mes` varchar(4) DEFAULT NULL,
  `anio` varchar(4) DEFAULT NULL,
  `total` double(12,2) DEFAULT '0.00',
  `iva` double(12,2) DEFAULT '0.00',
  `descuento` double(12,2) DEFAULT '0.00',
  `gtotal` double(12,2) DEFAULT '0.00',
  `comprobantetipo` varchar(1) DEFAULT NULL,
  `pagado` varchar(1) DEFAULT 'N',
  `emision_at` datetime DEFAULT NULL,
  `pagado_in` datetime DEFAULT NULL,
  `generacomp_id` int NOT NULL,
  `usuario_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantelinea`
--

CREATE TABLE `comprobantelinea` (
  `id` int NOT NULL,
  `preciomes` double(12,2) DEFAULT '0.00',
  `rol_id` int NOT NULL,
  `comprobante_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controlador`
--

CREATE TABLE `controlador` (
  `id` int NOT NULL,
  `controlador` varchar(45) DEFAULT NULL,
  `perfil_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `controlador`
--

INSERT INTO `controlador` (`id`, `controlador`, `perfil_id`) VALUES
(8, 'sysacceso', 3),
(6, 'sysaccion', 3),
(4, 'syscontrolador', 3),
(9, 'sysmenu', 3),
(3, 'sysmodulo', 3),
(5, 'sysperfil', 3),
(10, 'sysaccion', 4),
(16, 'sysingreso', 4),
(11, 'sysmenu', 4),
(1, 'sysusuario', 4),
(7, 'publicador', 5),
(12, 'mismodulo', 7),
(13, 'sysperfil', 7),
(14, 'wliquidacion', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generacomp`
--

CREATE TABLE `generacomp` (
  `id` int NOT NULL,
  `generacomp_at` datetime DEFAULT NULL,
  `usuario_id` int NOT NULL,
  `periodo_mes` varchar(12) DEFAULT NULL,
  `periodo_anio` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `texto` varchar(45) DEFAULT NULL,
  `icono` varchar(60) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `perfil_id` int NOT NULL,
  `posicion` int DEFAULT NULL,
  `accion_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `texto`, `icono`, `color`, `perfil_id`, `posicion`, `accion_id`) VALUES
(1, 'Módulos', 'fas fa-brain', 'text-success', 3, 1, 29),
(2, 'Controladores', 'fas fa-brain', 'text-success', 3, 2, 25),
(3, 'Perfiles', 'fas fa-brain', 'text-success', 3, 0, 35),
(4, 'Acciones', 'fas fa-brain', 'text-success', 3, 3, 1),
(5, 'Accesos', 'fas fa-brain', 'text-success', 3, 5, 18),
(6, 'Menues', 'fas fa-brain', 'text-success', 3, 6, 36),
(13, 'Quitar Foto', 'fas fa-camera', 'text-danger', 4, 2, 43),
(15, 'Datos Personales', 'fas fa-server', 'text-green', 4, 3, 44),
(16, 'Cambiar Clave', 'far fas fa-key', 'text-green', 4, 4, 45),
(17, 'Foto Perfil', 'fas fa-camera', 'text-green', 4, 1, 51),
(18, 'Contratados', 'far fa-circle', 'text-danger', 7, 5, 53),
(19, 'Principal', 'far fa-circle', 'text-danger', 7, 1, 54),
(20, 'Disponibles', 'far fa-circle', 'text-danger', 7, 6, 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id` int NOT NULL,
  `modulo` varchar(30) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `logo` varchar(60) DEFAULT NULL,
  `privado` varchar(1) DEFAULT 'N',
  `modulo_at` datetime DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `inicial` varchar(1) DEFAULT 'N',
  `publicado` varchar(1) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id`, `modulo`, `descripcion`, `logo`, `privado`, `modulo_at`, `link`, `inicial`, `publicado`) VALUES
(1, 'Ingresos al sistema', 'Controla los accesos de los diferentes perfiles y usuarios', 'fas fa-door-open', 'S', '2021-03-12 21:34:06', 'https://www.youtube.com/watch?v=s-v4UZ-GKnk', 'N', 'S'),
(2, 'Datos Personales', 'Permite cambiar la contraseña, foto  de perfil, etc', 'fas fa-user', 'S', '2021-03-13 06:53:13', 'https://www.youtube.com/watch?v=X7zkdu1rDfo', 'S', 'S'),
(3, 'Publicador de Gastos', 'Publica los gastos mensuales y sus respectivos respaldos', 'fas fa-donate', 'N', '2021-03-13 06:55:03', 'https://www.youtube.com/watch?v=gvF3JmaUHiE', 'N', 'S'),
(4, 'Módulos Usados', 'Módulos disponibles, en uso, pagos, historial', 'fas fa-server', 'N', '2021-04-16 09:41:20', 'https://www.youtube.com/watch?v=PFmJ6vE5Z9k', 'S', 'S'),
(5, 'Liquidación Interna', 'Genera y controla los pagos mensuales por los módulos usados', 'fas fa-dollar-sign', 'S', '2021-04-29 20:17:24', 'https://www.youtube.com/watch?v=cQQeaNhsesI', 'N', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int NOT NULL,
  `perfil` varchar(45) DEFAULT NULL,
  `modulo_id` int NOT NULL,
  `precio` double(12,2) DEFAULT '0.00',
  `admin` varchar(1) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `perfil`, `modulo_id`, `precio`, `admin`) VALUES
(3, 'Administrador Ingresos', 1, 0.00, 'S'),
(4, 'Admin DP', 2, 0.00, 'S'),
(5, 'Seguidor', 3, 0.00, 'N'),
(7, 'Administrador de Mis Módulos', 4, 0.00, 'S'),
(9, 'Administrador', 3, 1080.00, 'S'),
(10, 'Administrador de Liquidaciones', 5, 0.00, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int NOT NULL,
  `ape` varchar(30) DEFAULT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `dni` int DEFAULT NULL,
  `cuil` varchar(15) DEFAULT NULL,
  `cel` varchar(30) DEFAULT NULL,
  `fijo` varchar(30) DEFAULT NULL,
  `pais` varchar(10) DEFAULT NULL,
  `nac` date DEFAULT NULL,
  `usuario_id` int NOT NULL,
  `mail` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `ape`, `nom`, `dni`, `cuil`, `cel`, `fijo`, `pais`, `nac`, `usuario_id`, `mail`) VALUES
(1, 'Salazar', 'Walter', 25335677, NULL, '3813584546', NULL, '+54', '2021-04-14', 1, 'salazarwalter@gmail.com'),
(4, 'Alvarez Ramirez', 'Jose Luis', NULL, NULL, '3813584546', NULL, '+54', NULL, 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `perfil_id` int NOT NULL,
  `activo` varchar(1) DEFAULT 'S',
  `contrata_at` datetime DEFAULT NULL,
  `finaliza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `usuario_id`, `perfil_id`, `activo`, `contrata_at`, `finaliza`) VALUES
(2, 1, 3, 'S', '2021-04-23 17:59:30', NULL),
(3, 1, 4, 'S', '2021-04-23 17:59:30', NULL),
(4, 1, 7, 'S', '2021-04-23 17:59:30', NULL),
(8, 1, 9, 'N', '2021-04-28 18:28:39', '2021-05-11 22:08:55'),
(9, 1, 10, 'N', '2021-04-29 20:48:34', '2021-05-11 23:31:56'),
(12, 4, 4, 'S', '2021-05-07 12:27:19', NULL),
(13, 4, 7, 'S', '2021-05-07 12:27:19', NULL),
(19, 1, 9, 'N', '2021-05-11 22:08:21', '2021-05-11 22:10:55'),
(20, 1, 9, 'N', '2021-05-11 22:11:02', '2021-05-11 22:11:17'),
(21, 1, 9, 'N', '2021-05-11 22:11:25', '2021-05-11 22:20:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `usu` varchar(60) NOT NULL,
  `cla` varchar(45) DEFAULT NULL,
  `usuario_at` datetime DEFAULT NULL,
  `foto` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usu`, `cla`, `usuario_at`, `foto`) VALUES
(1, 'salazarwalter@gmail.com1', 'MjAyMWFkbWlu', '2021-04-08 02:50:08', 'p2021-05-10-14-28-02_459300.jpg'),
(4, 'salazarwalter@gmail.com', 'MjAyMWFkbWlu', '2021-05-07 12:27:19', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_accion_perfil` (`accion_id`,`perfil_id`),
  ADD KEY `fk_acceso_accion1_idx` (`accion_id`),
  ADD KEY `fk_acceso_perfil1_idx` (`perfil_id`);

--
-- Indices de la tabla `accion`
--
ALTER TABLE `accion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_accion_controlador` (`controlador_id`,`accion`),
  ADD KEY `fk_accion_controlador1_idx` (`controlador_id`);

--
-- Indices de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comprobante_generacomp1_idx` (`generacomp_id`),
  ADD KEY `fk_comprobante_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `comprobantelinea`
--
ALTER TABLE `comprobantelinea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comprobantelinea_rol1_idx` (`rol_id`),
  ADD KEY `fk_comprobantelinea_comprobante1_idx` (`comprobante_id`);

--
-- Indices de la tabla `controlador`
--
ALTER TABLE `controlador`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_perfil_controlador` (`perfil_id`,`controlador`),
  ADD KEY `fk_controlador_perfil1_idx` (`perfil_id`);

--
-- Indices de la tabla `generacomp`
--
ALTER TABLE `generacomp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_generacomp_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_texto_perfil_id` (`texto`,`perfil_id`),
  ADD UNIQUE KEY `u_posicion_perfil_id` (`posicion`,`perfil_id`),
  ADD KEY `fk_menu_perfil1_idx` (`perfil_id`),
  ADD KEY `fk_menu_accion1_idx` (`accion_id`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_modulo` (`modulo`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_perfil_modulo` (`perfil`,`modulo_id`),
  ADD KEY `fk_perfil_modulo1_idx` (`modulo_id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_persona_usuario_idx` (`usuario_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rol_usuario1_idx` (`usuario_id`),
  ADD KEY `fk_rol_perfil1_idx` (`perfil_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso`
--
ALTER TABLE `acceso`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `accion`
--
ALTER TABLE `accion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comprobantelinea`
--
ALTER TABLE `comprobantelinea`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `controlador`
--
ALTER TABLE `controlador`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `generacomp`
--
ALTER TABLE `generacomp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD CONSTRAINT `fk_acceso_accion1` FOREIGN KEY (`accion_id`) REFERENCES `accion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_acceso_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `accion`
--
ALTER TABLE `accion`
  ADD CONSTRAINT `fk_accion_controlador1` FOREIGN KEY (`controlador_id`) REFERENCES `controlador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD CONSTRAINT `fk_comprobante_generacomp1` FOREIGN KEY (`generacomp_id`) REFERENCES `generacomp` (`id`),
  ADD CONSTRAINT `fk_comprobante_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `comprobantelinea`
--
ALTER TABLE `comprobantelinea`
  ADD CONSTRAINT `fk_comprobantelinea_comprobante1` FOREIGN KEY (`comprobante_id`) REFERENCES `comprobante` (`id`),
  ADD CONSTRAINT `fk_comprobantelinea_rol1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `controlador`
--
ALTER TABLE `controlador`
  ADD CONSTRAINT `fk_controlador_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`);

--
-- Filtros para la tabla `generacomp`
--
ALTER TABLE `generacomp`
  ADD CONSTRAINT `fk_generacomp_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_accion1` FOREIGN KEY (`accion_id`) REFERENCES `accion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_menu_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `fk_perfil_modulo1` FOREIGN KEY (`modulo_id`) REFERENCES `modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_persona_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol`
--
ALTER TABLE `rol`
  ADD CONSTRAINT `fk_rol_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rol_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
