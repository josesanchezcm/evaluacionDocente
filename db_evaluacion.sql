-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-01-2018 a las 17:24:18
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_evaluacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE IF NOT EXISTS `alumno` (
  `cveAlu` int(11) NOT NULL,
  `nomAlu` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `aPaAlu` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `aMaAlu` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pasAlu` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `cveGru` int(11) NOT NULL,
  PRIMARY KEY (`cveAlu`),
  KEY `fk_AluGru_cveGru` (`cveGru`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`cveAlu`, `nomAlu`, `aPaAlu`, `aMaAlu`, `pasAlu`, `cveGru`) VALUES
(1216100877, 'Nahum', 'Ramirez', 'Rodriguez', '123', 2),
(1216100878, 'Jose Maria', 'Rosales', 'Gloria', '123', 2),
(1216100879, 'Miguel Angel', 'Camacho', 'Rosales', '123', 2),
(1216100880, 'Carolina', 'Gonzales', 'Robles', '123', 2),
(1216100881, 'Alondra', 'Rodriguez', 'Gloria', '123', 2),
(1216100882, 'Ramon', 'Lopez', 'Torres', '123', 1),
(1216100883, 'David', 'Robles', 'Barcenas', '123', 1),
(1216100884, 'Cristobal', 'Rangel', 'Martinez', '123', 1),
(1216100885, 'Nani', 'Lopez', 'Suarez', '123', 1),
(1216100886, 'Diana', 'Rangel', 'Ponce', '123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
CREATE TABLE IF NOT EXISTS `evaluacion` (
  `cveEva` int(11) NOT NULL AUTO_INCREMENT,
  `fecEva` date NOT NULL,
  `comEva` text COLLATE utf8_spanish_ci NOT NULL,
  `cveImp` int(11) NOT NULL,
  `cveAlu` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`cveEva`),
  KEY `fk_EvaImp_cveImp` (`cveImp`),
  KEY `fk_EvaAlu_cveAlu` (`cveAlu`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`cveEva`, `fecEva`, `comEva`, `cveImp`, `cveAlu`, `status`) VALUES
(1, '2018-01-05', '877', 1, 1216100877, 1),
(2, '2018-01-05', '878', 1, 1216100878, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacionpregunta`
--

DROP TABLE IF EXISTS `evaluacionpregunta`;
CREATE TABLE IF NOT EXISTS `evaluacionpregunta` (
  `cveEvaPre` int(11) NOT NULL AUTO_INCREMENT,
  `cveEva` int(11) NOT NULL,
  `cvePre` int(11) NOT NULL,
  `calPre` tinyint(4) NOT NULL,
  PRIMARY KEY (`cveEvaPre`),
  KEY `fk_EvaPre_cveEva` (`cveEva`),
  KEY `fk_EvaPre_cvePre` (`cvePre`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `evaluacionpregunta`
--

INSERT INTO `evaluacionpregunta` (`cveEvaPre`, `cveEva`, `cvePre`, `calPre`) VALUES
(1, 1, 1, 10),
(2, 1, 2, 9),
(3, 1, 3, 8),
(4, 1, 4, 7),
(5, 1, 5, 6),
(6, 1, 6, 10),
(7, 1, 7, 9),
(8, 1, 8, 8),
(9, 1, 9, 7),
(10, 1, 10, 6),
(11, 1, 11, 10),
(12, 1, 12, 9),
(13, 2, 1, 5),
(14, 2, 2, 6),
(15, 2, 3, 7),
(16, 2, 4, 8),
(17, 2, 5, 9),
(18, 2, 6, 10),
(19, 2, 7, 10),
(20, 2, 8, 9),
(21, 2, 9, 8),
(22, 2, 10, 7),
(23, 2, 11, 6),
(24, 2, 12, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `cveGru` int(11) NOT NULL AUTO_INCREMENT,
  `nomGru` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `cvePer` int(11) NOT NULL,
  PRIMARY KEY (`cveGru`),
  KEY `fk_GruPer_cvePer` (`cvePer`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`cveGru`, `nomGru`, `cvePer`) VALUES
(1, 'GSI1341', 3),
(2, 'GSI1342', 3),
(3, 'GSI1343', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imparte`
--

DROP TABLE IF EXISTS `imparte`;
CREATE TABLE IF NOT EXISTS `imparte` (
  `cveImp` int(11) NOT NULL AUTO_INCREMENT,
  `cvePro` int(11) NOT NULL,
  `cveGru` int(11) NOT NULL,
  `cveMat` int(11) NOT NULL,
  `cvePer` int(11) NOT NULL,
  PRIMARY KEY (`cveImp`),
  KEY `fk_Imparte_cvePro` (`cvePro`),
  KEY `fk_Imparte_cveGru` (`cveGru`),
  KEY `fk_Imparte_cveMat` (`cveMat`),
  KEY `fk_Imparte_cvePer` (`cvePer`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `imparte`
--

INSERT INTO `imparte` (`cveImp`, `cvePro`, `cveGru`, `cveMat`, `cvePer`) VALUES
(1, 1001, 2, 3, 3),
(2, 1001, 1, 6, 3),
(3, 1002, 1, 1, 3),
(4, 1002, 2, 1, 3),
(5, 1003, 1, 2, 3),
(6, 1003, 2, 2, 3),
(7, 1004, 1, 4, 3),
(8, 1004, 2, 4, 3),
(9, 1005, 1, 5, 3),
(10, 1005, 2, 5, 3),
(11, 1006, 2, 6, 3),
(12, 1007, 1, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE IF NOT EXISTS `materia` (
  `cveMat` int(11) NOT NULL AUTO_INCREMENT,
  `nomMat` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cveMat`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`cveMat`, `nomMat`) VALUES
(1, 'Formación Sociocultural IV'),
(2, 'Inglés IV'),
(3, 'Estructura de Datos'),
(4, 'Administración de Base de Datos'),
(5, 'Ingeniería de Software I'),
(6, 'Desarrollo de Aplicaciones II');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

DROP TABLE IF EXISTS `periodo`;
CREATE TABLE IF NOT EXISTS `periodo` (
  `cvePer` int(11) NOT NULL AUTO_INCREMENT,
  `nomPer` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`cvePer`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`cvePer`, `nomPer`, `year`) VALUES
(1, 'Enero-Abril', 2017),
(2, 'Mayo-Agosto', 2017),
(3, 'Septiembre-Diciembre', 2017);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
CREATE TABLE IF NOT EXISTS `pregunta` (
  `cvePre` int(11) NOT NULL AUTO_INCREMENT,
  `desPre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cvePre`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`cvePre`, `desPre`) VALUES
(1, 'El profesor expone los contenidos y prácticas de su asignatura de manera clara, gradual y congruente.'),
(2, 'El profesor proporciona orientación y apoyo a los alumnos con problemas de aprendizaje.'),
(3, 'Proporciona un ambiente de confianza y de participación durante la clase.'),
(4, 'Estableció controles de evaluación del aprendizaje considerando: exámenes parciales, participación, trabajos, practicas, etc.'),
(5, 'El profesor da seguimiento al programa, considerando los propósitos y contenidos, a fin de lograr el saber, el saber hacer, y el saber ser.'),
(6, 'El profesor emplea métodos didácticos (gráficas, folletos, acetatos, ilustraciones, dinámicas de grupo o trabajos en equipo) para facilitar la comprensión de los temas.'),
(7, 'El profesor proporciona mayores referencias sobre los temas que se les dificulta a los alumnos.'),
(8, 'El profesor responde todas las preguntas formuladas por los alumnos.'),
(9, 'El profesor muestra disposición para atender a los alumnos dentro y fuera de clase para resolver y aclarar preguntas o dudas en temas que te interesen.	'),
(10, 'El nivel de dificultad de los ejemplos de clase es congruente con el de los exámenes.'),
(11, 'El profesor entra a tiempo a clase.'),
(12, 'El profesor fomenta el auto-aprendizaje o actividades de lectura.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

DROP TABLE IF EXISTS `profesor`;
CREATE TABLE IF NOT EXISTS `profesor` (
  `cvePro` int(11) NOT NULL,
  `nomPro` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `aPaPro` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `aMaPro` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pasPro` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cvePro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`cvePro`, `nomPro`, `aPaPro`, `aMaPro`, `pasPro`) VALUES
(1001, 'Apolinar', 'Trejo', 'Cuevas', '123'),
(1002, 'Ma Guadalupe', 'Godinez', 'Almaguer', '123'),
(1003, 'Noé Rodrigo', 'Ponce', 'Camacho', '123'),
(1004, 'Ricardo', 'Muro', 'Gomez', '123'),
(1005, 'Javier Jesus', 'Torres', 'Yañes', '123'),
(1006, 'Anastacio', 'Rodriguez', 'Garcia', '123'),
(1007, 'Maria Teresa', 'Diaz', 'Robledo', '123');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `fk_AluGru_cveGru` FOREIGN KEY (`cveGru`) REFERENCES `grupo` (`cveGru`);

--
-- Filtros para la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `fk_EvaAlu_cveAlu` FOREIGN KEY (`cveAlu`) REFERENCES `alumno` (`cveAlu`),
  ADD CONSTRAINT `fk_EvaImp_cveImp` FOREIGN KEY (`cveImp`) REFERENCES `imparte` (`cveImp`);

--
-- Filtros para la tabla `evaluacionpregunta`
--
ALTER TABLE `evaluacionpregunta`
  ADD CONSTRAINT `fk_EvaPre_cveEva` FOREIGN KEY (`cveEva`) REFERENCES `evaluacion` (`cveEva`),
  ADD CONSTRAINT `fk_EvaPre_cvePre` FOREIGN KEY (`cvePre`) REFERENCES `pregunta` (`cvePre`);

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `fk_GruPer_cvePer` FOREIGN KEY (`cvePer`) REFERENCES `periodo` (`cvePer`);

--
-- Filtros para la tabla `imparte`
--
ALTER TABLE `imparte`
  ADD CONSTRAINT `fk_Imparte_cveGru` FOREIGN KEY (`cveGru`) REFERENCES `grupo` (`cveGru`),
  ADD CONSTRAINT `fk_Imparte_cveMat` FOREIGN KEY (`cveMat`) REFERENCES `materia` (`cveMat`),
  ADD CONSTRAINT `fk_Imparte_cvePer` FOREIGN KEY (`cvePer`) REFERENCES `periodo` (`cvePer`),
  ADD CONSTRAINT `fk_Imparte_cvePro` FOREIGN KEY (`cvePro`) REFERENCES `profesor` (`cvePro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
