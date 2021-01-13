-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-01-2021 a las 05:07:39
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_convenios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id_alumno` int(255) NOT NULL AUTO_INCREMENT,
  `nombre_alumno` text COLLATE latin1_general_ci NOT NULL,
  `genero_alumno` text COLLATE latin1_general_ci NOT NULL,
  `carrera_alumno` text COLLATE latin1_general_ci NOT NULL,
  `matricula_alumno` int(11) NOT NULL,
  `semestres_alumno` int(2) NOT NULL,
  `status_alumno` text COLLATE latin1_general_ci NOT NULL,
  `discapacidad_alumno` int(3) NOT NULL,
  `maya_alumno` int(2) NOT NULL,
  `convenio_alumno` int(255) NOT NULL,
  PRIMARY KEY (`id_alumno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
CREATE TABLE IF NOT EXISTS `ciudades` (
  `id_ciudades` int(255) NOT NULL AUTO_INCREMENT,
  `nombre_ciudades` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_ciudades`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenios`
--

DROP TABLE IF EXISTS `convenios`;
CREATE TABLE IF NOT EXISTS `convenios` (
  `id_convenio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_convenio` text COLLATE latin1_general_ci NOT NULL,
  `dependencia_convenio` text COLLATE latin1_general_ci NOT NULL,
  `fechaInicio_convenio` text COLLATE latin1_general_ci NOT NULL,
  `fechafinal_convenio` text COLLATE latin1_general_ci NOT NULL,
  `Estatus_convenio` text COLLATE latin1_general_ci NOT NULL,
  `Uso_convenios` int(11) NOT NULL,
  PRIMARY KEY (`id_convenio`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencias`
--

DROP TABLE IF EXISTS `dependencias`;
CREATE TABLE IF NOT EXISTS `dependencias` (
  `id_dependencia` int(11) NOT NULL AUTO_INCREMENT,
  `correo_dependencia` text COLLATE latin1_general_ci NOT NULL,
  `telefono_dependencia` text COLLATE latin1_general_ci NOT NULL,
  `tamaño_dependencia` text COLLATE latin1_general_ci NOT NULL,
  `ciudad_dependencia` text COLLATE latin1_general_ci NOT NULL,
  `estado_dependencia` text COLLATE latin1_general_ci NOT NULL,
  `numero_convenios` int(11) NOT NULL,
  PRIMARY KEY (`id_dependencia`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `id_estado` int(100) NOT NULL AUTO_INCREMENT,
  `nombre_estado` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(2) NOT NULL AUTO_INCREMENT,
  `correo_user` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password_user` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
