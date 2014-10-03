-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-10-2014 a las 17:26:13
-- Versión del servidor: 5.5.37-0ubuntu0.13.10.1
-- Versión de PHP: 5.5.3-1ubuntu2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `fulbito`
--
CREATE DATABASE IF NOT EXISTS `fulbito` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fulbito`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adhesion_partido`
--

CREATE TABLE IF NOT EXISTS `adhesion_partido` (
  `stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_partido` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_estado` int(10) unsigned NOT NULL,
  `id_tipo_adhesion` int(10) unsigned NOT NULL,
  `fecha_adhesion` date DEFAULT NULL,
  PRIMARY KEY (`id_partido`,`id_usuario`),
  KEY `fk_adhesion_partido_usuario_idx` (`id_usuario`),
  KEY `fk_adhesion_partido_estado_idx` (`id_estado`),
  KEY `fk_adhesion_partido_tipoadhesion_idx` (`id_tipo_adhesion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigo`
--

CREATE TABLE IF NOT EXISTS `amigo` (
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_usuario_amigo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_usuario_amigo`),
  KEY `fk_amigo_usuarioamigo_idx` (`id_usuario_amigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancha`
--

CREATE TABLE IF NOT EXISTS `cancha` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `latitud` varchar(50) DEFAULT NULL,
  `longitud` varchar(50) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_alerta_usuario`
--

CREATE TABLE IF NOT EXISTS `config_alerta_usuario` (
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_alerta` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `config_alerta_usuariocol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_alerta`,`id_usuario`),
  KEY `fk_config_alerta_usuario_idx` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_opc_usuario`
--

CREATE TABLE IF NOT EXISTS `datos_opc_usuario` (
  `id_usuario` int(10) unsigned NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `ubicacion` varchar(50) DEFAULT NULL,
  `latitud` varchar(50) DEFAULT NULL,
  `longitud` varchar(50) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `telefono` int(10) unsigned DEFAULT NULL,
  `radio_busqueda_partido` int(10) unsigned DEFAULT NULL,
  `stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos_opc_usuario`
--

INSERT INTO `datos_opc_usuario` (`id_usuario`, `fecha_nacimiento`, `ubicacion`, `latitud`, `longitud`, `sexo`, `telefono`, `radio_busqueda_partido`, `stamp`) VALUES
(1, '2014-09-03', 'Ciudadela, Buenos Aires, Argentina', '-34.6352975', '-58.54329510000002', 'm', 2222, 89, '2014-09-26 19:49:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE IF NOT EXISTS `equipo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_partido` int(10) unsigned NOT NULL,
  `goles` int(10) unsigned DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`,`id_partido`),
  KEY `fk_equipo_partido_idx` (`id_partido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_adhesion`
--

CREATE TABLE IF NOT EXISTS `estado_adhesion` (
  `ID_ESTADO` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DESCRIPCION` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ID_ESTADO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_partido`
--

CREATE TABLE IF NOT EXISTS `estado_partido` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `estado_partido`
--

INSERT INTO `estado_partido` (`id`, `stamp`, `descripcion`) VALUES
(1, '2014-09-30 18:50:56', 'Nuevo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre_grupo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE IF NOT EXISTS `jugador` (
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_jugador` int(10) unsigned NOT NULL,
  `id_partido` int(10) unsigned NOT NULL,
  `id_equipo` int(10) unsigned NOT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `goles` int(10) unsigned DEFAULT NULL,
  `id_usuario` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_jugador`,`id_partido`),
  KEY `fk_jugador_partido_idx` (`id_partido`),
  KEY `fk_jugador_equipo_idx` (`id_equipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE IF NOT EXISTS `partido` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cancha` int(10) unsigned DEFAULT NULL,
  `id_tipo_partido` int(10) unsigned NOT NULL,
  `id_tipo_periodicidad` int(10) unsigned DEFAULT NULL,
  `id_estado_partido` int(10) unsigned NOT NULL,
  `id_usuario_adm` int(10) unsigned NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `duracion` int(10) unsigned DEFAULT NULL,
  `cant_jugadores` int(10) unsigned DEFAULT NULL,
  `cant_suplentes` int(10) unsigned DEFAULT NULL,
  `stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk1_idx` (`id_cancha`),
  KEY `fk_partido_tipo_partido_idx` (`id_tipo_partido`),
  KEY `fk_partido_tipo_periodicidad_idx` (`id_tipo_periodicidad`),
  KEY `fk_partido_usuario_idx` (`id_usuario_adm`),
  KEY `fk_partido_estado_idx` (`id_estado_partido`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`id`, `id_cancha`, `id_tipo_partido`, `id_tipo_periodicidad`, `id_estado_partido`, `id_usuario_adm`, `nombre`, `fecha`, `hora`, `duracion`, `cant_jugadores`, `cant_suplentes`, `stamp`) VALUES
(1, NULL, 1, NULL, 1, 1, NULL, '2014-09-21', '02:01:00', NULL, 12, NULL, '2014-09-30 19:11:14'),
(2, NULL, 1, NULL, 1, 1, NULL, '2014-02-15', '19:00:00', NULL, 21, NULL, '2014-09-30 19:54:58'),
(3, NULL, 1, NULL, 1, 1, NULL, '2014-02-15', '19:00:00', NULL, 21, NULL, '2014-09-30 19:57:07'),
(4, NULL, 1, NULL, 1, 1, NULL, '2014-02-15', '19:00:00', NULL, 21, NULL, '2014-09-30 20:03:43'),
(5, NULL, 1, NULL, 1, 1, NULL, '2014-02-15', '19:00:00', NULL, 21, NULL, '2014-09-30 20:14:14'),
(6, NULL, 1, NULL, 1, 1, NULL, '2014-02-15', '19:00:00', NULL, 21, NULL, '2014-09-30 20:14:37'),
(7, NULL, 1, NULL, 1, 1, NULL, '2014-10-25', '19:00:00', NULL, 10, NULL, '2014-10-01 18:47:52'),
(8, NULL, 1, NULL, 1, 1, NULL, '2014-10-25', '19:00:00', NULL, 10, NULL, '2014-10-01 18:48:37'),
(9, NULL, 1, NULL, 1, 1, NULL, '2014-10-25', '19:00:00', NULL, 10, NULL, '2014-10-01 18:56:43'),
(10, NULL, 1, NULL, 1, 1, NULL, '2014-10-09', '01:00:00', NULL, 12, NULL, '2014-10-01 18:57:13'),
(11, NULL, 1, NULL, 1, 1, NULL, '2014-10-04', '19:59:00', NULL, 12, NULL, '2014-10-01 19:55:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rela_usuario_grupo`
--

CREATE TABLE IF NOT EXISTS `rela_usuario_grupo` (
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(10) NOT NULL,
  `id_grupo` int(10) NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_adhesion`
--

CREATE TABLE IF NOT EXISTS `tipo_adhesion` (
  `id` int(10) unsigned NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_alerta`
--

CREATE TABLE IF NOT EXISTS `tipo_alerta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion` varchar(50) NOT NULL,
  `tipo_alertacol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_partido`
--

CREATE TABLE IF NOT EXISTS `tipo_partido` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipo_partido`
--

INSERT INTO `tipo_partido` (`id`, `stamp`, `descripcion`) VALUES
(1, '2014-09-30 17:20:48', 'Público'),
(2, '2014-09-30 17:20:48', 'Privado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_periodicidad`
--

CREATE TABLE IF NOT EXISTS `tipo_periodicidad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `alias` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `foto` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `EMAIL_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `stamp`, `alias`, `email`, `password`, `foto`) VALUES
(1, '2014-09-25 18:22:10', 'kbza123', 'adrian.magliola@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'default.jpg'),
(2, '2014-09-25 19:38:47', '1111111', 'adrian@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 'default.jpg'),
(3, '2014-09-25 19:40:37', '1111111', 'adrian.maglio22la@gm2ail.com', 'a8f5f167f44f4964e6c998dee827110c', 'default.jpg'),
(4, '2014-09-26 20:22:05', 'amaglio', 'ammagliola@ucema.edu.ar', 'a8f5f167f44f4964e6c998dee827110c', 'default.jpg'),
(5, '2014-09-26 20:24:54', '1111111', 'aadrian.magliola@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 'default.jpg'),
(6, '2014-09-26 20:26:02', 'amaglio', 'adrian.magliol2a@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 'default.jpg');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adhesion_partido`
--
ALTER TABLE `adhesion_partido`
  ADD CONSTRAINT `fk_adhesion_partido_tipoadhesion` FOREIGN KEY (`id_tipo_adhesion`) REFERENCES `tipo_adhesion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adhesion_partido_estado` FOREIGN KEY (`id_estado`) REFERENCES `estado_adhesion` (`ID_ESTADO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adhesion_partido_partido` FOREIGN KEY (`id_partido`) REFERENCES `partido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adhesion_partido_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `amigo`
--
ALTER TABLE `amigo`
  ADD CONSTRAINT `fk_amigo_usuarioamigo` FOREIGN KEY (`id_usuario_amigo`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_amigo_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `config_alerta_usuario`
--
ALTER TABLE `config_alerta_usuario`
  ADD CONSTRAINT `fk_config_alerta_tipoalerta` FOREIGN KEY (`id_alerta`) REFERENCES `tipo_alerta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_config_alerta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `datos_opc_usuario`
--
ALTER TABLE `datos_opc_usuario`
  ADD CONSTRAINT `fk_datos_opc_usuario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `fk_equipo_partido` FOREIGN KEY (`id_partido`) REFERENCES `partido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD CONSTRAINT `fk_jugador_partido` FOREIGN KEY (`id_partido`) REFERENCES `partido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jugador_equipo` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `partido`
--
ALTER TABLE `partido`
  ADD CONSTRAINT `fk_partido_cancha` FOREIGN KEY (`id_cancha`) REFERENCES `cancha` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_partido_estado` FOREIGN KEY (`id_estado_partido`) REFERENCES `estado_partido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_partido_tipo_partido` FOREIGN KEY (`id_tipo_partido`) REFERENCES `tipo_partido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_partido_tipo_periodicidad` FOREIGN KEY (`id_tipo_periodicidad`) REFERENCES `tipo_periodicidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_partido_usuario` FOREIGN KEY (`id_usuario_adm`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
