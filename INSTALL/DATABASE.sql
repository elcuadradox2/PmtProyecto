
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


CREATE TABLE IF NOT EXISTS `consignaciones` (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    fecha_hora_consignacion DATETIME NOT NULL,
    ubicacion_consignacion VARCHAR(255) NOT NULL,
    documentos_consignacion TINYINT(1) NOT NULL,
    vehiculo_consignacion TINYINT(1) NOT NULL,
    motivo_consignacion VARCHAR(255) NOT NULL,
    tipo_vehiculo VARCHAR(255) NOT NULL,
    clase_licencia VARCHAR(255) NOT NULL,
    no_licencia VARCHAR(255) NOT NULL,
    nombre_licencia VARCHAR(255) NOT NULL,
    vigencia_licencia VARCHAR(255) NOT NULL,
    fecha_vencimiento DATE NOT NULL,
    tipo_placa VARCHAR(255) NOT NULL,
    no_placa VARCHAR(255) NOT NULL,
    no_tarjeta_circulacion VARCHAR(255) NOT NULL,
    nombre_tarjeta_circulacion VARCHAR(255) NOT NULL,
    copia_autenticada VARCHAR(255) NOT NULL,
    no_peritaje VARCHAR(255) NOT NULL,
    observaciones TEXT NOT NULL,
    nombre_chapa_jefe VARCHAR(255) NOT NULL,
    nombre_chapa_agente VARCHAR(255) NOT NULL
);


CREATE TABLE IF NOT EXISTS `remociones` (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    ubicacion_remocion VARCHAR(255) NOT NULL,
    fecha_hora_remocion DATETIME NOT NULL,
    no_notificacion VARCHAR(255) NOT NULL,
    nombre_persona_comercio VARCHAR(255) NOT NULL,
    descripcion_consignacion TEXT NOT NULL,
    nombre_chapa_agente VARCHAR(255) NOT NULL,
    reglamento_remocion TEXT NOT NULL
);