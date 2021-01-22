-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2021 at 08:56 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vinculacion`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id_alumno` int(255) NOT NULL AUTO_INCREMENT,
  `nombre_alumno` text COLLATE latin1_general_ci NOT NULL,
  `genero_alumno` text COLLATE latin1_general_ci NOT NULL,
  `carrera_alumno` text COLLATE latin1_general_ci NOT NULL,
  `matricula_alumno` int(11) NOT NULL,
  `semestres_alumno` text COLLATE latin1_general_ci NOT NULL,
  `discapacidad_alumno` text COLLATE latin1_general_ci NOT NULL,
  `maya_alumno` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_alumno`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `nombre_alumno`, `genero_alumno`, `carrera_alumno`, `matricula_alumno`, `semestres_alumno`, `discapacidad_alumno`, `maya_alumno`) VALUES
(1, 'Jesus Alberto Medina Dzib', 'Masculino', 'Ingenieria Civil', 16070014, '9Â° \'A\'', 'Discapacidad visual', 'No'),
(2, 'Karina Chiguil Euan', 'Femenino', 'Ingenieria en Sistemas Computacionales', 16070014, '9Â° \'A\'', 'Ninguna', 'No'),
(4, 'Omar Alejandro Ake Bellos', 'Femenino', 'Ingenieria Ambiental', 16070024, '9Â° \'A\'', 'Ninguna', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
CREATE TABLE IF NOT EXISTS `ciudades` (
  `id_ciudades` int(255) NOT NULL AUTO_INCREMENT,
  `nombre_ciudad` text COLLATE latin1_general_ci NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_ciudades`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `ciudades`
--

INSERT INTO `ciudades` (`id_ciudades`, `nombre_ciudad`, `id_estado`) VALUES
(1, 'Cozumel', 7),
(2, 'Valladolid', 7),
(5, 'Chichimila', 6),
(7, 'Champoton', 8);

-- --------------------------------------------------------

--
-- Table structure for table `convenios`
--

DROP TABLE IF EXISTS `convenios`;
CREATE TABLE IF NOT EXISTS `convenios` (
  `id_convenio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_convenio` text COLLATE latin1_general_ci NOT NULL,
  `dependencia_convenio` text COLLATE latin1_general_ci NOT NULL,
  `fecha_registro` text COLLATE latin1_general_ci NOT NULL,
  `fechaInicio_convenio` text COLLATE latin1_general_ci NOT NULL,
  `fechafinal_convenio` text COLLATE latin1_general_ci NOT NULL,
  `documento_convenio` text COLLATE latin1_general_ci NOT NULL,
  `concepto` text COLLATE latin1_general_ci NOT NULL,
  `uso_convenios` int(11) DEFAULT '0',
  PRIMARY KEY (`id_convenio`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `convenios`
--

INSERT INTO `convenios` (`id_convenio`, `nombre_convenio`, `dependencia_convenio`, `fecha_registro`, `fechaInicio_convenio`, `fechafinal_convenio`, `documento_convenio`, `concepto`, `uso_convenios`) VALUES
(3, 'Modelo EducaciÃ³n Dual con el Hotel Mahekal', '8', '2021-01-22', '2021-01-13', '2021-03-30', '639393.pdf', '1', 0),
(4, 'Residencia para el Ã¡rea de informÃ¡tica ', '7', '2021-01-22', '2021-01-15', '2021-04-15', '1142458.pdf', '6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `convenio_alumno`
--

DROP TABLE IF EXISTS `convenio_alumno`;
CREATE TABLE IF NOT EXISTS `convenio_alumno` (
  `id_convenio_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `id_convenio` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  PRIMARY KEY (`id_convenio_alumno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dependencias`
--

DROP TABLE IF EXISTS `dependencias`;
CREATE TABLE IF NOT EXISTS `dependencias` (
  `id_dependencia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_indepedencia` text COLLATE latin1_general_ci NOT NULL,
  `correo_dependencia` text COLLATE latin1_general_ci,
  `telefono_dependencia` text COLLATE latin1_general_ci,
  `tamano_dependencia` text COLLATE latin1_general_ci,
  `ciudad_dependencia` text COLLATE latin1_general_ci,
  `numero_convenios` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_dependencia`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `dependencias`
--

INSERT INTO `dependencias` (`id_dependencia`, `nombre_indepedencia`, `correo_dependencia`, `telefono_dependencia`, `tamano_dependencia`, `ciudad_dependencia`, `numero_convenios`) VALUES
(9, 'Allegro Cozumel', 'contacto@allegro.com', '9847565252', 'Macro', '1', NULL),
(6, 'CONALEP', 'contacto@conalep.com', '9851001010', 'Macro', '2', NULL),
(7, 'Universidad de Valladolid YucatÃ¡n', 'contacto@uvy.com', '9851001010', 'Mediana', '2', NULL),
(8, 'Hotel Mahekal', 'contacto@mahekal.com', '9841665050', 'Mediana', '7', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `id_estado` int(100) NOT NULL AUTO_INCREMENT,
  `nombre_estado` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `estados`
--

INSERT INTO `estados` (`id_estado`, `nombre_estado`) VALUES
(7, 'Quintana Roo'),
(6, 'YucatÃ¡n '),
(8, 'Campeche');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(2) NOT NULL AUTO_INCREMENT,
  `correo_user` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password_user` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `correo_user`, `password_user`) VALUES
(1, 'vinculacion', '$2y$15$ZV4afxlHy9nxiod/aqaxCuSxxVDjr4uGzQBejil4lu63aze6vl796');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
