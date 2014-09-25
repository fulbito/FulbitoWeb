CREATE DATABASE  IF NOT EXISTS `fulbito` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `fulbito`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: fulbito
-- ------------------------------------------------------
-- Server version	5.0.51b-community-nt-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Not dumping tablespaces as no INFORMATION_SCHEMA.FILES table on this server
--

--
-- Table structure for table `adhesion_partido`
--

DROP TABLE IF EXISTS `adhesion_partido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adhesion_partido` (
  `stamp` timestamp NULL default CURRENT_TIMESTAMP,
  `id_partido` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_estado` int(10) unsigned NOT NULL,
  `id_tipo_adhesion` int(10) unsigned NOT NULL,
  `fecha_adhesion` date default NULL,
  PRIMARY KEY  (`id_partido`,`id_usuario`),
  KEY `fk_adhesion_partido_usuario_idx` (`id_usuario`),
  KEY `fk_adhesion_partido_estado_idx` (`id_estado`),
  KEY `fk_adhesion_partido_tipoadhesion_idx` (`id_tipo_adhesion`),
  CONSTRAINT `fk_adhesion_partido_tipoadhesion` FOREIGN KEY (`id_tipo_adhesion`) REFERENCES `tipo_adhesion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_adhesion_partido_estado` FOREIGN KEY (`id_estado`) REFERENCES `estado_adhesion` (`ID_ESTADO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_adhesion_partido_partido` FOREIGN KEY (`id_partido`) REFERENCES `partido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_adhesion_partido_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adhesion_partido`
--

LOCK TABLES `adhesion_partido` WRITE;
/*!40000 ALTER TABLE `adhesion_partido` DISABLE KEYS */;
/*!40000 ALTER TABLE `adhesion_partido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amigo`
--

DROP TABLE IF EXISTS `amigo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amigo` (
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_usuario_amigo` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id_usuario`,`id_usuario_amigo`),
  KEY `fk_amigo_usuarioamigo_idx` (`id_usuario_amigo`),
  CONSTRAINT `fk_amigo_usuarioamigo` FOREIGN KEY (`id_usuario_amigo`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_amigo_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amigo`
--

LOCK TABLES `amigo` WRITE;
/*!40000 ALTER TABLE `amigo` DISABLE KEYS */;
/*!40000 ALTER TABLE `amigo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cancha`
--

DROP TABLE IF EXISTS `cancha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cancha` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) default NULL,
  `latitud` varchar(50) default NULL,
  `longitud` varchar(50) default NULL,
  `localidad` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cancha`
--

LOCK TABLES `cancha` WRITE;
/*!40000 ALTER TABLE `cancha` DISABLE KEYS */;
/*!40000 ALTER TABLE `cancha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_alerta_usuario`
--

DROP TABLE IF EXISTS `config_alerta_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config_alerta_usuario` (
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `id_alerta` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `config_alerta_usuariocol` varchar(45) default NULL,
  PRIMARY KEY  (`id_alerta`,`id_usuario`),
  KEY `fk_config_alerta_usuario_idx` (`id_usuario`),
  CONSTRAINT `fk_config_alerta_tipoalerta` FOREIGN KEY (`id_alerta`) REFERENCES `tipo_alerta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_config_alerta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_alerta_usuario`
--

LOCK TABLES `config_alerta_usuario` WRITE;
/*!40000 ALTER TABLE `config_alerta_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `config_alerta_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datos_opc_usuario`
--

DROP TABLE IF EXISTS `datos_opc_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datos_opc_usuario` (
  `id_usuario` int(10) unsigned NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `ubicacion` varchar(50) default NULL,
  `latitud` varchar(50) default NULL,
  `longitud` varchar(50) default NULL,
  `sexo` char(1) default NULL,
  `telefono` int(10) unsigned default NULL,
  `RADIO_BUSQ_PARTIDO` int(10) unsigned default NULL,
  `stamp` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id_usuario`),
  CONSTRAINT `fk_datos_opc_usuario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datos_opc_usuario`
--

LOCK TABLES `datos_opc_usuario` WRITE;
/*!40000 ALTER TABLE `datos_opc_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `datos_opc_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipo`
--

DROP TABLE IF EXISTS `equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipo` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `id_partido` int(10) unsigned NOT NULL,
  `goles` int(10) unsigned default NULL,
  `nombre` varchar(50) default NULL,
  PRIMARY KEY  (`id`,`id_partido`),
  KEY `fk_equipo_partido_idx` (`id_partido`),
  CONSTRAINT `fk_equipo_partido` FOREIGN KEY (`id_partido`) REFERENCES `partido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipo`
--

LOCK TABLES `equipo` WRITE;
/*!40000 ALTER TABLE `equipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_adhesion`
--

DROP TABLE IF EXISTS `estado_adhesion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_adhesion` (
  `ID_ESTADO` int(10) unsigned NOT NULL auto_increment,
  `DESCRIPCION` int(10) unsigned default NULL,
  PRIMARY KEY  (`ID_ESTADO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_adhesion`
--

LOCK TABLES `estado_adhesion` WRITE;
/*!40000 ALTER TABLE `estado_adhesion` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado_adhesion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_partido`
--

DROP TABLE IF EXISTS `estado_partido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_partido` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `DESCRIPCION` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_partido`
--

LOCK TABLES `estado_partido` WRITE;
/*!40000 ALTER TABLE `estado_partido` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado_partido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `nombre_grupo` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo`
--

LOCK TABLES `grupo` WRITE;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jugador`
--

DROP TABLE IF EXISTS `jugador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jugador` (
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `id_jugador` int(10) unsigned NOT NULL,
  `id_partido` int(10) unsigned NOT NULL,
  `id_equipo` int(10) unsigned NOT NULL,
  `alias` varchar(50) default NULL,
  `goles` int(10) unsigned default NULL,
  `id_usuario` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_jugador`,`id_partido`),
  KEY `fk_jugador_partido_idx` (`id_partido`),
  KEY `fk_jugador_equipo_idx` (`id_equipo`),
  CONSTRAINT `fk_jugador_partido` FOREIGN KEY (`id_partido`) REFERENCES `partido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_jugador_equipo` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jugador`
--

LOCK TABLES `jugador` WRITE;
/*!40000 ALTER TABLE `jugador` DISABLE KEYS */;
/*!40000 ALTER TABLE `jugador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partido`
--

DROP TABLE IF EXISTS `partido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partido` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_cancha` int(10) unsigned NOT NULL,
  `id_tipo_partido` int(10) unsigned NOT NULL,
  `id_tipo_periodicidad` int(10) unsigned NOT NULL,
  `id_estado_partido` int(10) unsigned NOT NULL,
  `id_usuario_adm` int(10) unsigned NOT NULL,
  `nombre` varchar(50) default NULL,
  `fecha` date default NULL,
  `hora` time default NULL,
  `duracion` int(10) unsigned default NULL,
  `cant_jugadores` int(10) unsigned default NULL,
  `cant_suplentes` int(10) unsigned default NULL,
  `stamp` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `fk1_idx` (`id_cancha`),
  KEY `fk_partido_tipo_partido_idx` (`id_tipo_partido`),
  KEY `fk_partido_tipo_periodicidad_idx` (`id_tipo_periodicidad`),
  KEY `fk_partido_usuario_idx` (`id_usuario_adm`),
  KEY `fk_partido_estado_idx` (`id_estado_partido`),
  CONSTRAINT `fk_partido_estado` FOREIGN KEY (`id_estado_partido`) REFERENCES `estado_partido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partido_cancha` FOREIGN KEY (`id_cancha`) REFERENCES `cancha` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partido_tipo_partido` FOREIGN KEY (`id_tipo_partido`) REFERENCES `tipo_partido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partido_tipo_periodicidad` FOREIGN KEY (`id_tipo_periodicidad`) REFERENCES `tipo_periodicidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partido_usuario` FOREIGN KEY (`id_usuario_adm`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partido`
--

LOCK TABLES `partido` WRITE;
/*!40000 ALTER TABLE `partido` DISABLE KEYS */;
/*!40000 ALTER TABLE `partido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rela_usuario_grupo`
--

DROP TABLE IF EXISTS `rela_usuario_grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rela_usuario_grupo` (
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `id_usuario` int(10) NOT NULL,
  `id_grupo` int(10) NOT NULL,
  PRIMARY KEY  (`id_usuario`,`id_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rela_usuario_grupo`
--

LOCK TABLES `rela_usuario_grupo` WRITE;
/*!40000 ALTER TABLE `rela_usuario_grupo` DISABLE KEYS */;
/*!40000 ALTER TABLE `rela_usuario_grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_adhesion`
--

DROP TABLE IF EXISTS `tipo_adhesion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_adhesion` (
  `id` int(10) unsigned NOT NULL,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_adhesion`
--

LOCK TABLES `tipo_adhesion` WRITE;
/*!40000 ALTER TABLE `tipo_adhesion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_adhesion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_alerta`
--

DROP TABLE IF EXISTS `tipo_alerta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_alerta` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `descripcion` varchar(50) NOT NULL,
  `tipo_alertacol` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_alerta`
--

LOCK TABLES `tipo_alerta` WRITE;
/*!40000 ALTER TABLE `tipo_alerta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_alerta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_partido`
--

DROP TABLE IF EXISTS `tipo_partido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_partido` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_partido`
--

LOCK TABLES `tipo_partido` WRITE;
/*!40000 ALTER TABLE `tipo_partido` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_partido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_periodicidad`
--

DROP TABLE IF EXISTS `tipo_periodicidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_periodicidad` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `stamp` timestamp NULL default CURRENT_TIMESTAMP,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_periodicidad`
--

LOCK TABLES `tipo_periodicidad` WRITE;
/*!40000 ALTER TABLE `tipo_periodicidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_periodicidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(10) unsigned NOT NULL,
  `stamp` timestamp NULL default CURRENT_TIMESTAMP,
  `alias` varchar(50) default NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) default NULL,
  `foto` varchar(512) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `EMAIL_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-14 23:07:16
