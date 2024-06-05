
-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2018 at 08:32 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tos`
--

-- --------------------------------------------------------

--
-- Table structure for table `offence`
--

CREATE TABLE IF NOT EXISTS `offence` (
  `id` int(11) NOT NULL,
  `offence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reported_offence`
--

CREATE TABLE IF NOT EXISTS `reported_offence` (
  `id` int(11) NOT NULL,
  `offence_id` varchar(200) NOT NULL,
  `vehicle_no` varchar(200) NOT NULL,
  `driver_license` varchar(300) NOT NULL,
  `name` varchar(500) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `gender` varchar(300) NOT NULL,
  `officer_reporting` varchar(500) NOT NULL,
  `offence` varchar(1000) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reported_offence`
--

INSERT INTO `reported_offence` (`id`, `offence_id`, `vehicle_no`, `driver_license`, `name`, `address`, `gender`, `officer_reporting`, `offence`, `date`) VALUES
(1, '78771c', '08954345355', '467545635', 'Adisa Adetobi', 'Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09', 'Male', 'Trorrahclef', 'Driving Under Drug Influence', '2018-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(300) NOT NULL,
  `site_desc` varchar(2000) NOT NULL,
  `email` varchar(300) NOT NULL,
  `phone` varchar(300) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(300) NOT NULL,
  `country` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_desc`, `email`, `phone`, `address`, `city`, `country`) VALUES
(1, 'Trafity', 'Welcome to Trafity Dashboard - a beautiful Traffic Offence System.', 'admin@we.com', '+2348138652645', 'Alagbaka GRA', 'Lagos', 'Nigeria');


INSERT INTO `site_settings` (`id`, `site_name`, `site_desc`, `email`, `phone`, `address`, `city`, `country`) VALUES
(1, 'Sistema PMT Sanarate', 'Bienvenido al sistema de PMT Sanarate', 'admin@pmtsanarate.com', '+2348138652645', 'Sanarate', 'El Progreso', 'Guatemala');
-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `name` varchar(500) NOT NULL,
  `username` varchar(300) NOT NULL,
  `pass` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `address` varchar(500) NOT NULL,
  `position` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_id`, `name`, `username`, `pass`, `email`, `address`, `position`) VALUES
(1, 'bcefa114ee', 'Adeyemi   Femipo', 'Torrahclef', 'yemiyemi', 'awolu_faith@live.com', 'Alagbaka, Akure, Ondo Nigeria', 'admin'),
(4, '0fd73c73c1', 'Full Name', 'Olapade', 'uhsfr', 'ayomi@we.com', 'Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09', 'admin'),
(5, '5dea1fd9c3', 'Awolu Faith', 'tobi', 'tobi', 'ayomi@we.com', 'Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09', 'officer');


INSERT INTO `user` (`id`, `user_id`, `name`, `username`, `pass`, `email`, `address`, `position`) VALUES
(1, 'bcefa114ee', 'Adeyemi   Femipo', 'Torrahclef', 'yemiyemi', 'awolu_faith@live.com', 'Alagbaka, Akure, Ondo Nigeria', 'admin'),
(4, '0fd73c73c1', 'Full Name', 'Olapade', 'uhsfr', 'ayomi@we.com', 'Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09', 'admin'),
(5, '5dea1fd9c3', 'Awolu Faith', 'tobi', 'tobi', 'ayomi@we.com', 'Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09', 'officer');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `reported_offence`
--
ALTER TABLE `reported_offence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reported_offence`
--
ALTER TABLE `reported_offence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE colisiones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_hora DATETIME NOT NULL,
    licencias VARCHAR(255) NOT NULL,
    tarjetas_circulacion VARCHAR(255) NOT NULL,
    observaciones TEXT NOT NULL,
    nombre_chapa_agente varchar(255) NOT NULL
);

CREATE TABLE fotos_cars (
  id int(11) NOT NULL,
  foto varchar(255) NOT NULL,
  licencias_colisiones varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE consignaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_hora DATETIME NOT NULL,
    ubicacion_consignacion VARCHAR(255) NOT NULL,
    no_licencia VARCHAR(255) NOT NULL,
    no_tarjeta_circulacion VARCHAR(255) NOT NULL,
    no_peritaje VARCHAR(255) NOT NULL,
    observaciones TEXT NOT NULL,
    nombre_chapa_agente VARCHAR(255) NOT NULL
);

CREATE TABLE fotos_consignaciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  foto varchar(255) NOT NULL,
  ubicacion_consignacion varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE remociones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ubicacion_remocion VARCHAR(255) NOT NULL,
    fecha_hora_remocion DATETIME NOT NULL,
    nombre_persona_comercio VARCHAR(255) NOT NULL,
    descripcion_consignacion VARCHAR(255) NOT NULL,
    tipo_boleta VARCHAR(255) NOT NULL,
    nombre_chapa_agente VARCHAR(255) NOT NULL
);

CREATE TABLE fotos_remociones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  foto varchar(255) NOT NULL,
  ubicaciones_remociones varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE notificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ubicacion_notificacion VARCHAR(255) NOT NULL,
    fecha_hora_notificacion DATETIME NOT NULL,
    nombre_persona_comercio VARCHAR(255) NOT NULL,
    descripcion_notificacion VARCHAR(255) NOT NULL,
    tipo_boleta VARCHAR(255) NOT NULL,
    nombre_chapa_agente VARCHAR(255) NOT NULL
);

CREATE TABLE fotos_notificaciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  foto varchar(255) NOT NULL,
  ubicaciones_notificaciones varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE agresiones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_chapa VARCHAR(255) NOT NULL,
    lugar VARCHAR(255) NOT NULL,
    fecha_hora DATETIME NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    no_licencia VARCHAR(255) NOT NULL,
    no_placa VARCHAR(255) NOT NULL,
    tipo_boleta VARCHAR(255) NOT NULL,
    nombre_chapa_agente VARCHAR(255) NOT NULL
);

CREATE TABLE fotos_agresiones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  foto varchar(255) NOT NULL,
  licencia_agresiones varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE alcoholemia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_hora DATETIME NOT NULL,
    lugar_prueba VARCHAR(255) NOT NULL,
    nombre_conductor VARCHAR(255) NOT NULL,
    domicilio_conductor VARCHAR(255) NOT NULL,
    no_licencia VARCHAR(255) NOT NULL,
    tarjeta_circulacion VARCHAR(255) NOT NULL,
    no_placas VARCHAR(255) NOT NULL,
    tipo_boleta VARCHAR(255) NOT NULL,
    nombre_chapa_agente VARCHAR(255) NOT NULL
);

CREATE TABLE fotos_alcoholemia (
  id INT AUTO_INCREMENT PRIMARY KEY,
  foto varchar(255) NOT NULL,
  licencias_alcoholemia varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE bitacora_actividades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_hora DATETIME NOT NULL,
    nombre_agente VARCHAR(255) NOT NULL
);

CREATE TABLE fotos_actividades (
  id INT AUTO_INCREMENT PRIMARY KEY,
  foto varchar(255) NOT NULL,
  fecha_actividades DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE bitacora_operativos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_hora DATETIME NOT NULL,
    nombre_agente VARCHAR(255) NOT NULL
);

CREATE TABLE fotos_operativos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  foto varchar(255) NOT NULL,
  fecha_operativos DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE entrevista (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_hora DATETIME NOT NULL,
    nombre_agente VARCHAR(255) NOT NULL
);

CREATE TABLE fotos_entrevista (
  id INT AUTO_INCREMENT PRIMARY KEY,
  foto varchar(255) NOT NULL,
  fecha_entrevista DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE peritaje_vehicular_transportes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_hora DATETIME NOT NULL,
    placa_peritaje_transportes VARCHAR(255) NOT NULL,
    nombre_agente VARCHAR(255) NOT NULL
);

CREATE TABLE fotos_peritaje_transportes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  foto varchar(255) NOT NULL,
  placas_peritajes VARCHAR(255) NOT NULL,
  fecha_hora_transportes DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE peritaje_vehicular (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_hora DATETIME NOT NULL,
    placa_peritaje_vehicular VARCHAR(255) NOT NULL,
    nombre_agente VARCHAR(255) NOT NULL
);

CREATE TABLE fotos_peritaje (
  id INT AUTO_INCREMENT PRIMARY KEY,
  foto varchar(255) NOT NULL,
  placas_vehiculos VARCHAR(255) NOT NULL,
  fecha_hora_vehicular DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE reporte_interno (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_hora DATETIME NOT NULL,
    nombre_agente VARCHAR(255) NOT NULL
);

CREATE TABLE fotos_reporte (
  id INT AUTO_INCREMENT PRIMARY KEY,
  foto varchar(255) NOT NULL,
  fecha_reporte DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE servicios_sociales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_hora DATETIME NOT NULL,
    nombre_agente VARCHAR(255) NOT NULL
);

CREATE TABLE fotos_servicios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  foto varchar(255) NOT NULL,
  fecha_servicios DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;