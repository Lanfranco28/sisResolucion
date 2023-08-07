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

INSERT INTO `resolucion` (`cod_resol`, `num_resol`, `fecha`, `titulo`, `id_tipo`, `urls`, `id_usuario`, `hora`) VALUES
(52, '082-2023-GM/MDH', '2023-07-09', 'PLAN DE TRABAJO PUBLICITARIAS INSTITUCIONAL', 1, 'archivos/082-2023-gmmdh.pdf', 1, NULL),
(53, '0011', '2023-07-09', 'Practicas', 2, 'archivos/0011.pdf', 5, NULL),
(54, '083-2023-GM/MDH', '2023-07-09', 'Provincia', 2, 'archivos/083-2023-gmmdh.pdf', 1, '02:53:22'),
(55, '0998877', '2023-07-13', 'PLAN DE TRABAJO PUBLICITARIAS INSTITUCIONAL', 1, 'archivos/0998877.pdf', 1, '18:29:28'),
(61, '11', '2023-07-21', 'Practicas', 6, 'archivos/11.pdf', 50, '07:25:57'),
(71, '112322', '2023-07-21', 'Practicas', 7, 'archivos/112322.pdf', 50, '07:46:51'),
(81, '33', '2023-07-22', 'Practicas', 1, 'archivos/33.pdf', 50, '14:48:34'),
(82, '44', '2023-07-22', 'Nueva obra civil', 4, 'archivos/44.pdf', 1, '14:52:55'),
(84, '55', '2023-07-22', 'Provincia', 3, 'archivos/55.pdf', 1, '14:54:06'),
(85, '0546378', '2023-07-22', 'PLAN DE TRABAJO PUBLICITARIAS INSTITUCIONAL', 5, 'archivos/0546378.pdf', 1, '15:20:01'),
(89, '11222', '2023-07-22', 'Practicas', 11, 'archivos/11222.pdf', 50, '15:33:15'),
(90, '987676', '2023-07-22', 'Practicas', 9, 'archivos/987676.pdf', 50, '15:37:07'),
(92, '99998', '2023-07-22', 'Practicas', 11, 'archivos/99998.pdf', 50, '15:56:38'),
(94, 'wdasfasd', '2023-07-26', 'Aprovar el contrato CAS 2023', 1, 'archivos/wdasfasd.pdf', 53, '03:00:08'),
(95, '084-2023-GM/MDH', '2023-08-01', 'PLAN DE TRABAJO PUBLICITARIAS INSTITUCIONAL', 1, 'archivos/084-2023-gmmdh.pdf', 52, '16:08:03');

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
(50, 'Loan', 'ochoocho', 2),
(51, 'Walter', '12345678', 1),
(52, 'Cesar', '87654321', 1),
(53, 'Daniel', '12345678', 2),
(54, 'Gato', '88888888', 2);

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
