-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2024 a las 18:31:48
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
-- Base de datos: `crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `Rif` varchar(20) NOT NULL,
  `Razonsocial` varchar(100) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Seudonimo` varchar(50) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `Rif`, `Razonsocial`, `Direccion`, `Seudonimo`, `imagen`) VALUES
(1, 'fernando', 'vvvvvvvvvv', 'vvvvvvvvvvvA@gmail.com', 'aaaaaaaaa@gmail.com', './img/1519400759.png'),
(2, 'fernando', 'vvvvvvvvvv', 'vvvvvvvvvvvA@gmail.com', 'eeee@gmail.com', './img/1091119008.jpg'),
(3, 'fernando', 'vvvvvvvvvv', 'vvvvvvvvvvvA@gmail.com', 'wwww@gmail.com', './img/2007612641.png'),
(4, 'j-12343376', 'vvvvvvvvvv', 'vvvvvvvvvvvA@gmail.com', 'eerww@gmail.com', './img/120378742.png'),
(5, 'j-12343376', 'vvvvvvvvvv', 'vvvvvvvvvvvA@gmail.com', 'eerwwqq@gmail.com', './img/409446936.png'),
(7, 'fernando', 'vvvvvvvvvv', 'vvvvvvvvvvvA@gmail.com', 'eerwwqq@gmail.com', './img/517576507.jpeg'),
(8, 'fernando', 'vvvvvvvvvv', 'vvvvvvvvvvvA@gmail.com', 'qqqqqqq@gmail.com', './img/1661767880.jpg'),
(9, 'fernando', 'vvvvvvvvvv', 'vvvvvvvvvvvA@gmail.com', 'qqqqqqq@gmail.com', './img/932233441.jpg'),
(10, 'fernando', 'vvvvvvvvvv', 'vvvvvvvvvvvA@gmail.com', 'qqwqwq@gmail.com', './img/264031605.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
