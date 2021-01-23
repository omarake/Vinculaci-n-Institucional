-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 23-01-2021 a las 16:18:18
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
-- Base de datos: `vinculacion`
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
  `semestres_alumno` text COLLATE latin1_general_ci NOT NULL,
  `discapacidad_alumno` text COLLATE latin1_general_ci NOT NULL,
  `maya_alumno` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_alumno`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `nombre_alumno`, `genero_alumno`, `carrera_alumno`, `matricula_alumno`, `semestres_alumno`, `discapacidad_alumno`, `maya_alumno`) VALUES
(1, 'Jesus Alberto Medina Dzib', 'Masculino', 'Ingenieria Civil', 16070014, '9Â° \'A\'', 'Discapacidad fÃ­sica', 'No'),
(2, 'Karina Chiguil Euan', 'Femenino', 'Ingenieria en Sistemas Computacionales', 16070014, '9Â° \'A\'', 'Discapacidad sensorial', 'Si'),
(4, 'Omar Alejandro Ake Bellos', 'Femenino', 'Ingenieria Ambiental', 16070024, '9Â° \'A\'', 'Discapacidad auditiva', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
CREATE TABLE IF NOT EXISTS `ciudades` (
  `id_ciudades` int(255) NOT NULL AUTO_INCREMENT,
  `nombre_ciudad` text COLLATE latin1_general_ci NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_ciudades`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id_ciudades`, `nombre_ciudad`, `id_estado`) VALUES
(1, 'Cozumel', 7),
(2, 'Valladolid', 7),
(5, 'Chichimila', 6),
(7, 'Champoton', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenios`
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
  `tipo` text COLLATE latin1_general_ci NOT NULL,
  `uso_convenios` int(11) DEFAULT '0',
  PRIMARY KEY (`id_convenio`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `convenios`
--

INSERT INTO `convenios` (`id_convenio`, `nombre_convenio`, `dependencia_convenio`, `fecha_registro`, `fechaInicio_convenio`, `fechafinal_convenio`, `documento_convenio`, `concepto`, `tipo`, `uso_convenios`) VALUES
(3, 'Modelo EducaciÃ³n Dual con el Hotel Mahekal', '8', '2021-01-22', '2021-01-01', '2021-12-31', '639393.pdf', '1', '1', 0),
(4, 'Residencia para el Ã¡rea de informÃ¡tica ', '7', '2021-01-22', '2021-01-01', '2021-07-31', '1142458.pdf', '6', '1', 0),
(6, 'Modelo EducaciÃ³n Dual con el Hotel Mahekal', '6', '2021-01-22', '2021-01-01', '2021-07-31', '1711447.pdf', '5', '2', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenio_alumno`
--

DROP TABLE IF EXISTS `convenio_alumno`;
CREATE TABLE IF NOT EXISTS `convenio_alumno` (
  `id_convenio_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `id_convenio` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `fecha_inicio` text NOT NULL,
  `fecha_final` text NOT NULL,
  `producto` text NOT NULL,
  `evidencia` text NOT NULL,
  PRIMARY KEY (`id_convenio_alumno`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `convenio_alumno`
--

INSERT INTO `convenio_alumno` (`id_convenio_alumno`, `id_convenio`, `id_alumno`, `fecha_inicio`, `fecha_final`, `producto`, `evidencia`) VALUES
(1, 3, 1, '2021-01-28', '2021-02-01', 'a', 'a'),
(2, 3, 4, '2021-01-29', '2021-01-30', 'producto', 'evidencia'),
(3, 6, 2, '2021-02-05', '2021-02-02', 'a', 'a'),
(4, 3, 1, '2021-01-27', '2021-01-28', 'el alumno entregara un reporte con la finalidad de ', 'el alumno entregara un reporte con la finalidad de '),
(5, 6, 1, '2021-01-30', '2021-02-06', 'as', 'as'),
(6, 6, 4, '2021-01-30', '2021-02-28', 'a', 'a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencias`
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `dependencias`
--

INSERT INTO `dependencias` (`id_dependencia`, `nombre_indepedencia`, `correo_dependencia`, `telefono_dependencia`, `tamano_dependencia`, `ciudad_dependencia`, `numero_convenios`) VALUES
(9, 'Allegro Cozumel', 'contacto@allegro.com', '9847565252', '1', '1', NULL),
(6, 'CONALEP', 'contacto@conalep.com', '9851001010', '2', '2', NULL),
(7, 'Universidad de Valladolid YucatÃ¡n', 'contacto@uvy.com', '9851001010', '3', '2', NULL),
(8, 'Hotel Mahekal', 'contacto@mahekal.com', '9841665050', '4', '7', NULL),
(10, 'UVY', 'contacto@uvy.com', '98510101020', '4', '2', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `id_estado` int(100) NOT NULL AUTO_INCREMENT,
  `nombre_estado` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `nombre_estado`) VALUES
(7, 'Quintana Roo'),
(6, 'YucatÃ¡n '),
(8, 'Campeche');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `correo_user`, `password_user`) VALUES
(1, 'vinculacion', '$2y$15$ZV4afxlHy9nxiod/aqaxCuSxxVDjr4uGzQBejil4lu63aze6vl796');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
