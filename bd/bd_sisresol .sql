-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 07-08-2023 a las 07:38:00
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_sisresol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Colaborador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resolucion`
--

CREATE TABLE `resolucion` (
  `cod_resol` int(250) NOT NULL,
  `num_resol` varchar(250) NOT NULL,
  `fecha` date NOT NULL,
  `titulo` text NOT NULL,
  `id_tipo` int(250) NOT NULL,
  `urls` varchar(250) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resolucion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_resol`
--

CREATE TABLE `tipo_resol` (
  `id_tipo` int(250) NOT NULL,
  `nom_resol` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_resol`
--

INSERT INTO `tipo_resol` (`id_tipo`, `nom_resol`) VALUES
(1, 'ACTA DE SESIÓN EXTRAORDINARIA'),
(2, 'ACTA DE SESIÓN ORDINARIA'),
(3, 'ACUERDO DE COSEJO'),
(4, 'ORDENANZAS MUNICIPALES'),
(5, 'DECRETO DE ALCALDÍA'),
(6, 'RESOLUCIÓN DE ALCALDÍA'),
(7, 'RESOLUCIÓN EXTRAORDINARIA'),
(8, 'RESOLUCIÓN GERENCIAL'),
(9, 'RESOLUCIÓN SUBGERENCIAL'),
(10, 'FE DE ERRATAS'),
(11, 'RESOLUCIÓN JEFATURAL'),
(14, 'RESOLUCION ADMINISTRATIVA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nom_usuario` varchar(45) NOT NULL,
  `contraseña` varchar(8) NOT NULL,
  `id_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nom_usuario`, `contraseña`, `id_cargo`) VALUES
(1, 'Lanfranco', '12345678', 1),

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `resolucion`
--
ALTER TABLE `resolucion`
  ADD PRIMARY KEY (`cod_resol`),
  ADD UNIQUE KEY `u_n_resol` (`num_resol`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tipo_resol`
--
ALTER TABLE `tipo_resol`
  ADD PRIMARY KEY (`id_tipo`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_usuario_2` (`id_usuario`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `resolucion`
--
ALTER TABLE `resolucion`
  MODIFY `cod_resol` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `tipo_resol`
--
ALTER TABLE `tipo_resol`
  MODIFY `id_tipo` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `resolucion`
--
ALTER TABLE `resolucion`
  ADD CONSTRAINT `resolucion_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_resol` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
