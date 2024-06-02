-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2024 a las 06:58:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `xs` int(11) NOT NULL DEFAULT 0,
  `s` int(11) NOT NULL DEFAULT 0,
  `m` int(11) NOT NULL DEFAULT 0,
  `l` int(11) NOT NULL DEFAULT 0,
  `xl` int(11) NOT NULL DEFAULT 0,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `genero`, `xs`, `s`, `m`, `l`, `xl`, `order_date`, `name`, `email`) VALUES
(22, 'M', 2, 0, 0, 0, 0, '2024-05-18 02:52:45', 'Fernando D Sangeorge Acuña Marrero', 'piensasyhablas@gmail.com'),
(23, 'F', 4, 4, 0, 0, 0, '2024-05-18 02:53:10', 'Fernando D Sangeorge Acuña Marrero', 'piensasyhablas@gmail.com'),
(24, 'M', 5, 0, 0, 0, 0, '2024-05-18 02:53:23', 'Fernando D Sangeorge Acuña Marrero', 'piensasyhablas@gmail.com'),
(25, 'M', 5, 5, 0, 0, 0, '2024-05-18 19:59:24', 'Fernando D Sangeorge Acuña Marrero', 'piensasyhablas@gmail.com'),
(26, 'M', 1, 0, 0, 0, 0, '2024-05-18 20:36:11', 'Fernando D Sangeorge Acuña Marrero', 'piensasyhablas@gmail.com'),
(27, 'M', 4, 3, 3, 3, 3, '2024-05-18 20:37:15', 'Fernando D Sangeorge Acuña Marrero', 'piensasyhablas@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respaldos`
--

CREATE TABLE `respaldos` (
  `idr` int(11) NOT NULL,
  `contenido` varchar(255) NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `respaldos`
--

INSERT INTO `respaldos` (`idr`, `contenido`, `nombre`, `fecha`) VALUES
(1, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha` datetime NOT ', 'respaldos_2024-05-08_16-29-09.sql', '2024-05-08 16:29:09'),
(2, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha', 'respaldos_2024-05-08_16-31-30.sql', '2024-05-08 16:31:30'),
(3, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha', 'respaldos_2024-05-13_14-22-22.sql', '2024-05-13 14:22:22'),
(7, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha', 'respaldos_2024-05-13_19-21-25.sql', '2024-05-13 19:21:25'),
(8, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha', 'respaldos_2024-05-13_23-27-19.sql', '2024-05-13 23:27:19'),
(9, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha', 'respaldos_2024-05-13_23-27-24.sql', '2024-05-13 23:27:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` text NOT NULL,
  `pregunta_seguridad` varchar(255) DEFAULT NULL,
  `respuesta_seguridad` varchar(255) DEFAULT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `code`, `pregunta_seguridad`, `respuesta_seguridad`, `role`) VALUES
(6, 'Fernando D Sangeorge Acuña Marrero', 'acunafernando592@gmail.com', '76a2f368e40953cb4946e3b0bffeead8', '', 'avion favorito', 'B1-spirit', 'administrador'),
(53, 'Fernando D Sangeorge Acuña Marrero', 'piensasyhablas@gmail.com', '76a2f368e40953cb4946e3b0bffeead8', '', 'avion favorito', 'B1-lancer', 'usuario'),
(54, 'Fernando Acuña', 'fernandodesangeorge@gmail.com', '76a2f368e40953cb4946e3b0bffeead8', '', 'avion favorito', 'B2 spirit', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respaldos`
--
ALTER TABLE `respaldos`
  ADD PRIMARY KEY (`idr`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `respaldos`
--
ALTER TABLE `respaldos`
  MODIFY `idr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
