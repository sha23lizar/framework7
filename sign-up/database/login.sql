-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2024 a las 20:06:48
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
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_img` int(11) NOT NULL,
  `urlImg` varchar(100) NOT NULL,
  `nameImg` varchar(80) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `statusImg` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id_img`, `urlImg`, `nameImg`, `id_user`, `statusImg`) VALUES
(0, '../users/7/img/1501884764.jpg', 'husky-en-la-nieve_3840x2400_xtrafondos.com.jpg', 7, 'active'),
(0, '../users/7/img/1133619944.jpg', 'husky-en-la-nieve_3840x2400_xtrafondos.com (1).jpg', 7, 'active'),
(0, '../users/7/img/1510359050.jpg', '6 (1).png', 7, 'active');

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
  `email` varchar(100) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `genero`, `xs`, `s`, `m`, `l`, `xl`, `order_date`, `name`, `email`, `estado`) VALUES
(28, 'M', 2, 0, 0, 0, 0, '2024-05-19 19:39:56', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'pendiente'),
(30, 'M', 2, 0, 0, 0, 0, '2024-05-19 19:39:56', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'Aprobado'),
(36, 'M', 2, 6, 0, 0, 0, '2024-05-19 19:39:56', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'Aprobado');

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
(2, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha', 'respaldos_2024-05-08_16-31-30.sql', '2024-05-08 16:31:30'),
(3, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha', 'respaldos_2024-05-13_14-22-22.sql', '2024-05-13 14:22:22'),
(7, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha', 'respaldos_2024-05-13_19-21-25.sql', '2024-05-13 19:21:25'),
(8, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha', 'respaldos_2024-05-13_23-27-19.sql', '2024-05-13 23:27:19'),
(9, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha', 'respaldos_2024-05-13_23-27-24.sql', '2024-05-13 23:27:24'),
(10, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla imagenes\nCREATE TABLE `imagenes` (\n  `id_img` int(11) NOT NULL,\n  `urlImg` varchar(100) NOT NULL,\n  `nameImg` varchar(80) NOT NULL,\n  `id_user` int(11) DEFAULT NULL,\n  `statusImg` varchar(10) ', 'respaldos_2024-05-22_08-42-23.sql', '2024-05-22 08:42:23');

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
(6, 'Fernando Acuña', 'acunafernando592@gmail.com', '76a2f368e40953cb4946e3b0bffeead8', '', 'avion favorito', 'B1-lancer', 'administrador'),
(7, 'Fernando Acuña', 'fernandodesangeorge@gmail.com', '76a2f368e40953cb4946e3b0bffeead8', '', 'avion favorito', 'B2 spirit', 'usuario'),
(9, 'Fernando Acuña', 'piensasyhablas@gmail.com', '76a2f368e40953cb4946e3b0bffeead8', '', 'mascota', 'perro', 'usuario');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `respaldos`
--
ALTER TABLE `respaldos`
  MODIFY `idr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
