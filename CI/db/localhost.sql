-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-02-2017 a las 01:58:47
-- Versión del servidor: 5.7.17-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.13-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: blessdb
--
CREATE DATABASE IF NOT EXISTS blessdb DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE blessdb;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla horas_permitidas
--

CREATE TABLE horas_permitidas (
  `id` int(11) NOT NULL,
  `dur_valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla horas_permitidas
--

INSERT INTO horas_permitidas (id, dur_valor) VALUES
(30, 30),
(45, 45),
(60, 60),
(90, 90),
(120, 120);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla terapeutas
--

CREATE TABLE terapeutas (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla terapeutas
--

INSERT INTO terapeutas (id, nombre) VALUES
(1, 'Alita Parra'),
(2, 'Colette Benoit'),
(3, 'Yenia Baeza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla terapias
--

CREATE TABLE terapias (
  `idt` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(512) COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(11) NOT NULL,
  `duracion` int(11) NOT NULL,
  `link` varchar(1024) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla terapias
--

INSERT INTO terapias (idt, nombre, valor, duracion, link) VALUES
(1, 'Reiki', 25000, 45, 'https://www.centrobless.cl/reiki'),
(2, 'Registros Akashicos', 35000, 60, 'https://www.centrobless.cl/registros-akashicos'),
(3, 'Sanación Kármica', 40000, 60, 'https://www.centrobless.cl/sanacion-karmica');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla horas_permitidas
--
ALTER TABLE horas_permitidas
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla terapeutas
--
ALTER TABLE terapeutas
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla terapias
--
ALTER TABLE terapias
  ADD PRIMARY KEY (`idt`),
  ADD UNIQUE KEY `idt` (`idt`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla terapeutas
--
ALTER TABLE terapeutas
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla terapias
--
ALTER TABLE terapias
  MODIFY `idt` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
