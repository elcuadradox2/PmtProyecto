-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-08-2024 a las 00:00:31
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agresiones`
--

DROP TABLE IF EXISTS `agresiones`;
CREATE TABLE IF NOT EXISTS `agresiones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_boleta` varchar(255) NOT NULL,
  `nombre_chapa` varchar(255) NOT NULL,
  `lugar` varchar(255) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `no_licencia` varchar(255) NOT NULL,
  `no_placa` varchar(255) NOT NULL,
  `tipo_boleta` varchar(255) NOT NULL,
  `nombre_chapa_agente` varchar(255) NOT NULL,
  `estado_pago` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `agresiones`
--

INSERT INTO `agresiones` (`id`, `no_boleta`, `nombre_chapa`, `lugar`, `fecha_hora`, `nombre`, `no_licencia`, `no_placa`, `tipo_boleta`, `nombre_chapa_agente`, `estado_pago`) VALUES
(1, '0000001', 'prueba3', 'prueba3', '2024-07-09 19:50:00', 'prueba3', 'prueba4', 'prueba5', 'educativa', 'mario', 'No Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alcoholemia`
--

DROP TABLE IF EXISTS `alcoholemia`;
CREATE TABLE IF NOT EXISTS `alcoholemia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_boleta` varchar(255) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `lugar_prueba` varchar(255) NOT NULL,
  `nombre_conductor` varchar(255) NOT NULL,
  `domicilio_conductor` varchar(255) NOT NULL,
  `no_licencia` varchar(255) NOT NULL,
  `tarjeta_circulacion` varchar(255) NOT NULL,
  `no_placas` varchar(255) NOT NULL,
  `tipo_boleta` varchar(255) NOT NULL,
  `nombre_chapa_agente` varchar(255) NOT NULL,
  `estado_pago` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alcoholemia`
--

INSERT INTO `alcoholemia` (`id`, `no_boleta`, `fecha_hora`, `lugar_prueba`, `nombre_conductor`, `domicilio_conductor`, `no_licencia`, `tarjeta_circulacion`, `no_placas`, `tipo_boleta`, `nombre_chapa_agente`, `estado_pago`) VALUES
(1, '0000001', '2024-07-10 19:56:00', 'prueba1', 'prueba1', 'prueba1', 'prueba3', 'prueba1', 'prueba1', 'educativa', 'mario', 'No Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso_pago`
--

DROP TABLE IF EXISTS `aviso_pago`;
CREATE TABLE IF NOT EXISTS `aviso_pago` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_boleta` varchar(255) NOT NULL,
  `ubicacion_aviso_pago` varchar(255) NOT NULL,
  `dpi_aviso_pago` varchar(255) NOT NULL,
  `no_placas` varchar(255) NOT NULL,
  `fecha_hora_aviso_pago` datetime NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `descripcion_aviso_pago` varchar(255) NOT NULL,
  `tipo_boleta` varchar(255) NOT NULL,
  `nombre_chapa_agente` varchar(255) NOT NULL,
  `estado_pago` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `aviso_pago`
--

INSERT INTO `aviso_pago` (`id`, `no_boleta`, `ubicacion_aviso_pago`, `dpi_aviso_pago`, `no_placas`, `fecha_hora_aviso_pago`, `nombre_completo`, `descripcion_aviso_pago`, `tipo_boleta`, `nombre_chapa_agente`, `estado_pago`) VALUES
(3, '0000001', 'sanarate ', '012391230-', '891231230', '2024-07-18 18:31:00', 'prueba1', 'prueba', 'educativa', 'mario', 'No Pagado'),
(2, 'prueba1', '', 'prueba1', 'prueba3', '2024-06-26 20:39:00', 'prueba1', 'prueba1', 'educativa', 'mario', 'No Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_actividades`
--

DROP TABLE IF EXISTS `bitacora_actividades`;
CREATE TABLE IF NOT EXISTS `bitacora_actividades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha_hora` datetime NOT NULL,
  `nombre_agente` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `bitacora_actividades`
--

INSERT INTO `bitacora_actividades` (`id`, `fecha_hora`, `nombre_agente`, `status`) VALUES
(10, '2024-06-15 17:00:00', 'mario', 'Pagado'),
(9, '2024-06-14 10:16:00', 'mario', 'Pagado'),
(11, '2024-06-29 17:04:00', 'mario', 'No Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_operativos`
--

DROP TABLE IF EXISTS `bitacora_operativos`;
CREATE TABLE IF NOT EXISTS `bitacora_operativos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha_hora` datetime NOT NULL,
  `nombre_agente` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colisiones`
--

DROP TABLE IF EXISTS `colisiones`;
CREATE TABLE IF NOT EXISTS `colisiones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_boleta` varchar(255) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `licencias` varchar(255) NOT NULL,
  `tarjetas_circulacion` varchar(255) NOT NULL,
  `observaciones` text NOT NULL,
  `nombre_chapa_agente` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `colisiones`
--

INSERT INTO `colisiones` (`id`, `no_boleta`, `fecha_hora`, `licencias`, `tarjetas_circulacion`, `observaciones`, `nombre_chapa_agente`) VALUES
(1, '0000001', '2024-07-09 19:13:00', 'prueba12312,123123123', 'fafdfadsf', 'fasdfa', 'mario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consignaciones`
--

DROP TABLE IF EXISTS `consignaciones`;
CREATE TABLE IF NOT EXISTS `consignaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_boleta` varchar(255) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `ubicacion_consignacion` varchar(255) NOT NULL,
  `no_licencia` varchar(255) NOT NULL,
  `no_tarjeta_circulacion` varchar(255) NOT NULL,
  `no_peritaje` varchar(255) NOT NULL,
  `observaciones` text NOT NULL,
  `nombre_chapa_agente` varchar(255) NOT NULL,
  `estado_pago` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `consignaciones`
--

INSERT INTO `consignaciones` (`id`, `no_boleta`, `fecha_hora`, `ubicacion_consignacion`, `no_licencia`, `no_tarjeta_circulacion`, `no_peritaje`, `observaciones`, `nombre_chapa_agente`, `estado_pago`) VALUES
(1, '0000001', '2024-07-09 19:24:00', 'prueba1', 'prueba3', 'prueba1', 'prueba1', 'fadf', 'mario', 'No Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrevista`
--

DROP TABLE IF EXISTS `entrevista`;
CREATE TABLE IF NOT EXISTS `entrevista` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha_hora` datetime NOT NULL,
  `nombre_agente` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_actividades`
--

DROP TABLE IF EXISTS `fotos_actividades`;
CREATE TABLE IF NOT EXISTS `fotos_actividades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `fecha_actividades` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fotos_actividades`
--

INSERT INTO `fotos_actividades` (`id`, `foto`, `fecha_actividades`) VALUES
(7, '67abf8056953ea9.png', '2024-06-14 10:16:00'),
(8, 'ba1549ef56f04e0.jpg', '2024-06-22 16:56:00'),
(9, '5579b67cd814e64.jpg', '2024-06-22 16:56:00'),
(10, 'd28dbbf04e0d384.jpg', '2024-06-22 16:56:00'),
(11, '9f6b8b3a9561e63.jpg', '2024-06-22 16:56:00'),
(12, 'ef9660a3f171895.jpg', '2024-06-22 16:56:00'),
(13, '454f32ac3ef02f0.jpg', '2024-06-22 16:56:00'),
(14, '1c33ab4c6f95497.jpg', '2024-06-22 16:56:00'),
(15, '461f437446ef2d0.jpg', '2024-06-22 16:56:00'),
(16, '94eb39e343c0fa7.jpg', '2024-06-22 16:56:00'),
(17, '5c60c55b438fdef.jpg', '2024-06-22 16:56:00'),
(18, '0cae5a38b2a3eed.jpg', '2024-06-15 04:58:00'),
(19, '2480381f71a885e.jpg', '2024-06-15 04:58:00'),
(20, 'e7b771c1afb111a.jpg', '2024-06-15 04:58:00'),
(21, '0b700665a12282a.jpg', '2024-06-15 04:58:00'),
(22, '4cce96658d1f1d1.jpg', '2024-06-15 04:58:00'),
(23, '38d9ee2f437742b.jpg', '2024-06-15 04:58:00'),
(24, '22eab02970aa8ef.jpeg', '2024-06-15 17:00:00'),
(25, 'e25b5d20f88d314.jpg', '2024-06-15 17:00:00'),
(26, 'b192002f4a056d2.jpeg', '2024-06-15 17:00:00'),
(27, 'b6d06b5c4012b2a.jpg', '2024-06-15 17:00:00'),
(28, 'ee1021ddb16d21a.jpg', '2024-06-29 17:04:00'),
(29, 'fde5c4553f50115.jpg', '2024-06-29 17:04:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_agresiones`
--

DROP TABLE IF EXISTS `fotos_agresiones`;
CREATE TABLE IF NOT EXISTS `fotos_agresiones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `licencia_agresiones` varchar(255) NOT NULL,
  `fecha_agresion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fotos_agresiones`
--

INSERT INTO `fotos_agresiones` (`id`, `foto`, `licencia_agresiones`, `fecha_agresion`) VALUES
(10, '1182d8f4da98700.jpg', 'prueba4', '2024-07-09 19:50:00'),
(11, '553805637fa3114.png', 'prueba4', '2024-07-09 19:50:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_alcoholemia`
--

DROP TABLE IF EXISTS `fotos_alcoholemia`;
CREATE TABLE IF NOT EXISTS `fotos_alcoholemia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `licencias_alcoholemia` varchar(255) NOT NULL,
  `fecha_alcoholemia` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fotos_alcoholemia`
--

INSERT INTO `fotos_alcoholemia` (`id`, `foto`, `licencias_alcoholemia`, `fecha_alcoholemia`) VALUES
(11, 'cc5cf8eb94743f4.jpg', 'prueba3', '2024-07-10 19:56:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_aviso_pago`
--

DROP TABLE IF EXISTS `fotos_aviso_pago`;
CREATE TABLE IF NOT EXISTS `fotos_aviso_pago` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `placa_aviso_pago` varchar(255) NOT NULL,
  `fecha_aviso_pago` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fotos_aviso_pago`
--

INSERT INTO `fotos_aviso_pago` (`id`, `foto`, `placa_aviso_pago`, `fecha_aviso_pago`) VALUES
(12, 'f92c7926f705606.jpg', 'prueba3', '2024-06-26 20:39:00'),
(13, '0ffa1c137156052.jpeg', 'prueba3', '2024-06-26 20:39:00'),
(14, 'a9aac27134a89df.png', '891231230', '2024-07-18 18:31:00'),
(15, '3fdeb299b8980a1.jpg', '891231230', '2024-07-18 18:31:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_colisiones`
--

DROP TABLE IF EXISTS `fotos_colisiones`;
CREATE TABLE IF NOT EXISTS `fotos_colisiones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `licencias_colisiones` varchar(255) NOT NULL,
  `fecha_colisiones` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fotos_colisiones`
--

INSERT INTO `fotos_colisiones` (`id`, `foto`, `licencias_colisiones`, `fecha_colisiones`) VALUES
(5, 'ea04dd40288ca71.png', 'prueba12312,123123123', '2024-07-09 19:13:00'),
(6, 'fd852e65d65353c.jpg', 'prueba12312,123123123', '2024-07-09 19:13:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_consignaciones`
--

DROP TABLE IF EXISTS `fotos_consignaciones`;
CREATE TABLE IF NOT EXISTS `fotos_consignaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `ubicacion_consignaciones` varchar(255) NOT NULL,
  `fecha_consignacion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fotos_consignaciones`
--

INSERT INTO `fotos_consignaciones` (`id`, `foto`, `ubicacion_consignaciones`, `fecha_consignacion`) VALUES
(7, '4091f74cdc68e44.jpg', 'prueba1', '2024-07-09 19:24:00'),
(8, 'fa0db9f84550364.png', 'prueba1', '2024-07-09 19:24:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_entrevista`
--

DROP TABLE IF EXISTS `fotos_entrevista`;
CREATE TABLE IF NOT EXISTS `fotos_entrevista` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `fecha_entrevista` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_notificaciones`
--

DROP TABLE IF EXISTS `fotos_notificaciones`;
CREATE TABLE IF NOT EXISTS `fotos_notificaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `ubicaciones_notificaciones` varchar(255) NOT NULL,
  `fecha_notificacion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fotos_notificaciones`
--

INSERT INTO `fotos_notificaciones` (`id`, `foto`, `ubicaciones_notificaciones`, `fecha_notificacion`) VALUES
(12, '6e405974c498609.jpeg', 'Prueba2', '2024-07-09 19:45:00'),
(13, 'c310b8b58d8515a.jpg', 'Prueba2', '2024-07-09 19:45:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_operativos`
--

DROP TABLE IF EXISTS `fotos_operativos`;
CREATE TABLE IF NOT EXISTS `fotos_operativos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `fecha_operativos` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_peritaje`
--

DROP TABLE IF EXISTS `fotos_peritaje`;
CREATE TABLE IF NOT EXISTS `fotos_peritaje` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `placas_vehiculos` varchar(255) NOT NULL,
  `fecha_hora_vehicular` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fotos_peritaje`
--

INSERT INTO `fotos_peritaje` (`id`, `foto`, `placas_vehiculos`, `fecha_hora_vehicular`) VALUES
(5, '3aaa48f6cf6a242.jpg', 'Prueba1', '2024-07-10 20:09:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_peritaje_transportes`
--

DROP TABLE IF EXISTS `fotos_peritaje_transportes`;
CREATE TABLE IF NOT EXISTS `fotos_peritaje_transportes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `placas_peritajes` varchar(255) NOT NULL,
  `fecha_hora_transportes` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fotos_peritaje_transportes`
--

INSERT INTO `fotos_peritaje_transportes` (`id`, `foto`, `placas_peritajes`, `fecha_hora_transportes`) VALUES
(5, '263ea721b9270fa.jpeg', 'Prueba1', '2024-06-08 18:34:00'),
(6, 'd50f26e5708f2a7.jpg', 'Prueba1', '2024-06-08 18:34:00'),
(9, 'a644cb0d2fffa64.jpg', 'Prueba1', '2024-07-09 20:08:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_remociones`
--

DROP TABLE IF EXISTS `fotos_remociones`;
CREATE TABLE IF NOT EXISTS `fotos_remociones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `ubicaciones_remociones` varchar(255) NOT NULL,
  `fecha_remocion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fotos_remociones`
--

INSERT INTO `fotos_remociones` (`id`, `foto`, `ubicaciones_remociones`, `fecha_remocion`) VALUES
(6, '4abe7c6d422bed7.jpg', 'Prueba2', '2024-07-09 19:40:00'),
(7, 'a69caaabdf3808b.png', 'Prueba2', '2024-07-09 19:40:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_reporte`
--

DROP TABLE IF EXISTS `fotos_reporte`;
CREATE TABLE IF NOT EXISTS `fotos_reporte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `fecha_reporte` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_servicios`
--

DROP TABLE IF EXISTS `fotos_servicios`;
CREATE TABLE IF NOT EXISTS `fotos_servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `fecha_servicios` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_boleta` varchar(255) NOT NULL,
  `ubicacion_notificacion` varchar(255) NOT NULL,
  `fecha_hora_notificacion` datetime NOT NULL,
  `nombre_persona_comercio` varchar(255) NOT NULL,
  `descripcion_notificacion` varchar(255) NOT NULL,
  `tipo_boleta` varchar(255) NOT NULL,
  `nombre_chapa_agente` varchar(255) NOT NULL,
  `estado_pago` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `no_boleta`, `ubicacion_notificacion`, `fecha_hora_notificacion`, `nombre_persona_comercio`, `descripcion_notificacion`, `tipo_boleta`, `nombre_chapa_agente`, `estado_pago`) VALUES
(1, '0000001', 'Prueba2', '2024-07-09 19:45:00', 'Prueba2', 'sasdasd', 'educativa', 'mario', 'No Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `offence`
--

DROP TABLE IF EXISTS `offence`;
CREATE TABLE IF NOT EXISTS `offence` (
  `id` int NOT NULL,
  `offence` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peritaje_vehicular`
--

DROP TABLE IF EXISTS `peritaje_vehicular`;
CREATE TABLE IF NOT EXISTS `peritaje_vehicular` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_boleta` varchar(255) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `placa_peritaje_vehicular` varchar(255) NOT NULL,
  `nombre_agente` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `peritaje_vehicular`
--

INSERT INTO `peritaje_vehicular` (`id`, `no_boleta`, `fecha_hora`, `placa_peritaje_vehicular`, `nombre_agente`) VALUES
(1, '0000001', '2024-07-10 20:09:00', 'Prueba1', 'mario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peritaje_vehicular_transportes`
--

DROP TABLE IF EXISTS `peritaje_vehicular_transportes`;
CREATE TABLE IF NOT EXISTS `peritaje_vehicular_transportes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_boleta` varchar(255) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `placa_peritaje_transportes` varchar(255) NOT NULL,
  `nombre_agente` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `peritaje_vehicular_transportes`
--

INSERT INTO `peritaje_vehicular_transportes` (`id`, `no_boleta`, `fecha_hora`, `placa_peritaje_transportes`, `nombre_agente`) VALUES
(1, '0000001', '2024-07-09 20:08:00', 'Prueba1', 'mario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remociones`
--

DROP TABLE IF EXISTS `remociones`;
CREATE TABLE IF NOT EXISTS `remociones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_boleta` varchar(255) NOT NULL,
  `ubicacion_remocion` varchar(255) NOT NULL,
  `fecha_hora_remocion` datetime NOT NULL,
  `nombre_persona_comercio` varchar(255) NOT NULL,
  `descripcion_consignacion` varchar(255) NOT NULL,
  `tipo_boleta` varchar(255) NOT NULL,
  `nombre_chapa_agente` varchar(255) NOT NULL,
  `estado_pago` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `remociones`
--

INSERT INTO `remociones` (`id`, `no_boleta`, `ubicacion_remocion`, `fecha_hora_remocion`, `nombre_persona_comercio`, `descripcion_consignacion`, `tipo_boleta`, `nombre_chapa_agente`, `estado_pago`) VALUES
(1, '0000001', 'Prueba2', '2024-07-09 19:40:00', 'Prueba2', 'fadfa', 'educativa', 'mario', 'No Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reported_offence`
--

DROP TABLE IF EXISTS `reported_offence`;
CREATE TABLE IF NOT EXISTS `reported_offence` (
  `id` int NOT NULL AUTO_INCREMENT,
  `offence_id` varchar(200) NOT NULL,
  `vehicle_no` varchar(200) NOT NULL,
  `driver_license` varchar(300) NOT NULL,
  `name` varchar(500) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `gender` varchar(300) NOT NULL,
  `officer_reporting` varchar(500) NOT NULL,
  `offence` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reported_offence`
--

INSERT INTO `reported_offence` (`id`, `offence_id`, `vehicle_no`, `driver_license`, `name`, `address`, `gender`, `officer_reporting`, `offence`, `date`) VALUES
(1, '78771c', '08954345355', '467545635', 'Adisa Adetobi', 'Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09', 'Male', 'Trorrahclef', 'Driving Under Drug Influence', '2018-05-28'),
(2, 'a3eea4', '', '', '', '', 'Male', 'Torrahclef', 'colisiones', '2024-04-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_interno`
--

DROP TABLE IF EXISTS `reporte_interno`;
CREATE TABLE IF NOT EXISTS `reporte_interno` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha_hora` datetime NOT NULL,
  `nombre_agente` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_sociales`
--

DROP TABLE IF EXISTS `servicios_sociales`;
CREATE TABLE IF NOT EXISTS `servicios_sociales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha_hora` datetime NOT NULL,
  `nombre_agente` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_name` varchar(300) NOT NULL,
  `site_desc` varchar(2000) NOT NULL,
  `email` varchar(300) NOT NULL,
  `phone` varchar(300) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(300) NOT NULL,
  `country` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_desc`, `email`, `phone`, `address`, `city`, `country`) VALUES
(1, 'Sistema PMT Sanarate', 'Bienvenido al sistema de PMT Sanarate', 'admin@pmtsanarate.com', '+2348138652645', 'Sanarate', 'El Progreso', 'Guatemala');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(200) NOT NULL,
  `name` varchar(500) NOT NULL,
  `username` varchar(300) NOT NULL,
  `pass` varchar(300) NOT NULL,
  `chapa_agente` varchar(255) DEFAULT NULL,
  `position` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `user_id`, `name`, `username`, `pass`, `chapa_agente`, `position`) VALUES
(6, '78e8560c17', 'prueba1', 'demo', '$2y$10$TfohpOo0mpQ9ZdGfhU3bhuNFodz84xhCWs37RXH92V5CbJLjfJEci', 'prueba1', 'admin'),
(7, '3e315671e3', 'demo1', 'demo1', '$2y$10$zjUIxVb2KLIePOvVjDaqbOZi.gETajJIoNIi2KAZ4h0ffRqgsc7Bi', 'demo1', 'admin'),
(8, '8e291e5c11', 'mario', 'mario', '$2y$10$e8cZeIOaZouPnEJp/lUFlubzwNANBJ.bBACdDeAZOV/yyu48CGPFS', 'mario', 'agente'),
(10, '3fee2bdf59', 'tobi', 'tobi', '$2y$10$N1eUZn1SRNhZZUTyXj.pB.xsr0I74f14B75jiRua9irQpOR6n6PXK', 'tobi', 'digitalizador');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
