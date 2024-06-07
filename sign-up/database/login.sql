-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2024 a las 16:06:49
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
-- Estructura de tabla para la tabla `diseños`
--

CREATE TABLE `diseños` (
  `id` int(11) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `color` varchar(10) NOT NULL,
  `personalizaciones` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`personalizaciones`)),
  `user_id` int(11) NOT NULL,
  `preview` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `diseños`
--

INSERT INTO `diseños` (`id`, `modelo`, `nombre`, `color`, `personalizaciones`, `user_id`, `preview`) VALUES
(1, '1', 'Shalom', '#fff', '[{\"id\":\"decal-1717369181305\",\"type\":\"image\",\"name\":\"rect10825.png\",\"urlImg\":\"../users/7/img/1972484012.jpg\",\"size\":1.5,\"position\":[-0.005024193548387124,0.09466814159292036],\"hidden\":false}]', 7, 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAxgAAAKcCAYAAABrKxweAAAAAXNSR0IArs4c6QAAIABJREFUeF7svQuPZedxJHjurUe3RMr2jB+AbVE2rdEYskez8C5mZ22thy0b87ua/cvYNhbw2Bpb9moNwUsIhCB4xsB6PKYk9qNed5kZEfnl+eo22aQv2cWqKIGqrqp7zyPOd87NyIzI3Cz+MgJGwAgYASNgBIyAETACRsAIH');

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
(0, '../users/7/img/1510359050.jpg', '6 (1).png', 7, 'active'),
(73, '../users/7/img/2030091669.jpg', '_ffca66c4-1e33-4415-9261-2800dba04f5f.jpg', 7, 'active'),
(74, '../users/7/img/1625445154.jpg', '330756290_747837056555314_5882970926597342512_n (1) (1).jpg', 7, 'active'),
(75, '../users/7/img/1982687344.jpg', 'Scooters Template - Hecho con PosterMyWall (1).jpg', 7, 'active'),
(76, '../users/7/img/532072296.jpg', '_ffca66c4-1e33-4415-9261-2800dba04f5f.jpg', 7, 'active'),
(77, '../users/7/img/843515539.jpg', 'predica Sion 7.png', 7, 'active'),
(78, '../users/7/img/509618635.jpg', 'image1-9.png', 7, 'active'),
(79, '../users/7/img/37863337.jpg', '_76a24fc7-2bd1-4bbc-9cbf-8837386756a4.jpg', 7, 'active'),
(80, '../users/7/img/1332618481.jpg', '_20b9abf8-3eb8-49a1-838d-c992bdc2d59d.jpeg', 7, 'active'),
(81, '../users/7/img/938883197.jpg', '_7b24c391-1d40-42fa-a0e9-5ef506c5cbe9.jpg', 7, 'active'),
(82, '../users/7/img/1419449413.jpg', '_bf039956-8979-46c4-a3d2-0f869b0ca1e4.jpg', 7, 'active'),
(83, '../users/7/img/1696580026.jpg', 'uvas.jpeg', 7, 'active'),
(84, '../users/7/img/2073194259.jpg', 'cuadricula.png', 7, 'active'),
(85, '../users/7/img/373496695.jpg', '2024 x 2024.jpg', 7, 'active'),
(86, '../users/7/img/1961126115.jpg', '1024 x 1024.jpg', 7, 'active'),
(87, '../users/7/img/1091042469.jpg', 'IMG-20221215-WA0014.jpg', 7, 'active'),
(88, '../users/7/img/1395063590.jpg', 'IMG-20221215-WA0015.jpg', 7, 'active'),
(89, '../users/7/img/826879917.jpg', 'rect10825.png', 7, 'active'),
(90, '../users/7/img/1972484012.jpg', 'rect10825.png', 7, 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `configuracion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`configuracion`)),
  `preview` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id`, `nombre`, `configuracion`, `preview`) VALUES
(1, 'Franela ', '{\r\n            \"model\":{\r\n                \"gltf\": \"../assets/models/shirt-optimize.glb\",\r\n                \"position\": [0, 0, 0],\r\n                \"rotation\": [0, 0, 0],\r\n                \"scale\": [1, 1, 1]\r\n            },\r\n            \"colors\": [\"#fff\", \"#000\", \"#f44336\", \"#e91e63\", \"#9c27b0\", \"#673ab7\",\r\n            \"#3f51b5\", \"#2196f3\", \"#03a9f4\", \"#00bcd4\", \"#009688\", \"#4caf50\", \"#8bc34a\",\r\n            \"#cddc39\", \"#ffeb3b\", \"#ffc107\", \"#ff9800\", \"#ff5722\", \"#795548\", \"#607d8b\"],\r\n            \"imgPreview\": \"../assets/models/shirt-optimize.png\",\r\n            \"camera\": {\r\n                \"position\": [0, 0.08, 0.55],\r\n                \"maxPositionCamera\": [0, 0.15, 0.3],\r\n                \"minPositionCamera\": [0, 0.15, 0.3],\r\n                \"rotation\": [-0.17, 0, 0]\r\n            },\r\n            \"decal\":{\r\n                \"position\": [0, 0, 0.003],\r\n                \"sizeZ\": [1]\r\n            },\r\n            \"environment\":{\r\n                \"hdr\": \"../assets/hdr/potsdamer_platz_1k-city.hdr\",\r\n                \"exposure\": 0.7,\r\n                \"ambienLightIntensity\": 0.5,\r\n                \"ambienLightColor\": \"[0xFFFFFF]\"\r\n            }\r\n        }', '\\assets\\models\\preview\\frontal-shirt.png');

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
  `image_path` varchar(255) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `genero`, `xs`, `s`, `m`, `l`, `xl`, `image_path`, `order_date`, `name`, `email`, `estado`) VALUES
(61, 'M', 6, 0, 0, 0, 0, 'uploads/1452330793-uncharted.jpeg', '2024-06-03 06:21:16', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'pendiente'),
(62, 'M', 2, 0, 0, 0, 0, 'uploads/563719c5c46188c4188b45e3.jpg', '2024-06-03 06:22:25', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'pendiente'),
(63, 'M', 2, 0, 0, 0, 0, 'uploads/avión-de-combate.jpg', '2024-06-03 06:22:38', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'pendiente'),
(64, 'M', 2, 2, 0, 0, 0, 'uploads/EMB-312-Tucano-FAdeA-2-chica3.jpg', '2024-06-03 07:00:07', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'pendiente'),
(65, 'F', 11, 0, 0, 0, 0, NULL, '2024-06-03 13:07:20', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'pendiente'),
(66, 'F', 10, 0, 0, 0, 0, NULL, '2024-06-03 13:07:27', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'Aprobado'),
(67, 'M', 10, 6, 0, 0, 0, NULL, '2024-06-03 13:07:39', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'Aprobado'),
(68, 'M', 2, 0, 0, 0, 0, NULL, '2024-06-03 13:13:12', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'Aprobado'),
(69, 'M', 1, 0, 0, 0, 0, NULL, '2024-06-03 13:14:46', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'Aprobado'),
(70, 'F', 1, 0, 0, 0, 0, NULL, '2024-06-03 13:15:38', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'Aprobado'),
(71, 'M', 10, 0, 0, 0, 0, NULL, '2024-06-03 13:32:50', 'Fernando Acuña', 'fernandodesangeorge@gmail.com', 'pendiente');

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
(10, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla imagenes\nCREATE TABLE `imagenes` (\n  `id_img` int(11) NOT NULL,\n  `urlImg` varchar(100) NOT NULL,\n  `nameImg` varchar(80) NOT NULL,\n  `id_user` int(11) DEFAULT NULL,\n  `statusImg` varchar(10) ', 'respaldos_2024-05-22_08-42-23.sql', '2024-05-22 08:42:23'),
(11, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla imagenes\nCREATE TABLE `imagenes` (\n  `id_img` int(11) NOT NULL,\n  `urlImg` varchar(100) NOT NULL,\n  `nameImg` varchar(80) NOT NULL,\n  `id_user` int(11) DEFAULT NULL,\n  `statusImg` varchar(10) ', 'respaldos_2024-05-27_14-22-46.sql', '2024-05-27 14:22:46'),
(12, '-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla imagenes\nCREATE TABLE `imagenes` (\n  `id_img` int(11) NOT NULL,\n  `urlImg` varchar(100) NOT NULL,\n  `nameImg` varchar(80) NOT NULL,\n  `id_user` int(11) DEFAULT NULL,\n  `statusImg` varchar(10) ', 'respaldos_2024-05-27_14-23-19.sql', '2024-05-27 14:23:19');

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
(6, 'fernando acuña', 'acunafernando592@gmail.com', '76a2f368e40953cb4946e3b0bffeead8', '', 'avion favorito', 'B1-lancer', 'administrador'),
(7, 'Fernando Acuña', 'fernandodesangeorge@gmail.com', '87b0f7f887b63a478a6193b635b54a46', '', 'avion favorito', 'B1-lancer', 'usuario'),
(9, 'Fernando Acuña', 'piensasyhablas@gmail.com', '76a2f368e40953cb4946e3b0bffeead8', '', 'mas', 'perro', 'usuario');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `respaldos`
--
ALTER TABLE `respaldos`
  MODIFY `idr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
