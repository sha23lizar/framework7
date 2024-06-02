-- Respaldo de la base de datos login

-- Respaldo de la tabla respaldos
CREATE TABLE `respaldos` (
  `idr` int(11) NOT NULL,
  `contenido` varchar(255) NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO respaldos VALUES ('100','-- Respaldo de la base de datos feb\n\n-- Respaldo de la tabla acompanantes\nCREATE TABLE `acompanantes` (\n  `ida` int(11) NOT NULL AUTO_INCREMENT,\n  `acompanante` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `cedula` int(11) NOT NULL,\n  `edad','respaldos_2024-05-07_20-56-01.sql','2024-05-07 20:56:01');
INSERT INTO respaldos VALUES ('0','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha` datetime NOT ','respaldos_2024-05-08_16-17-09.sql','2024-05-08 16:17:09');
INSERT INTO respaldos VALUES ('0','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha` datetime NOT ','respaldos_2024-05-08_16-17-12.sql','2024-05-08 16:17:12');
INSERT INTO respaldos VALUES ('0','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha` datetime NOT ','respaldos_2024-05-08_16-17-24.sql','2024-05-08 16:17:24');
INSERT INTO respaldos VALUES ('0','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha` datetime NOT ','respaldos_2024-05-08_16-22-03.sql','2024-05-08 16:22:03');
INSERT INTO respaldos VALUES ('0','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha` datetime NOT ','respaldos_2024-05-08_16-22-58.sql','2024-05-08 16:22:58');

-- Respaldo de la tabla users
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` text NOT NULL,
  `pregunta_seguridad` varchar(255) DEFAULT NULL,
  `respuesta_seguridad` varchar(255) DEFAULT NULL,
  `role` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users VALUES ('5','vanessa','vanessacarvajal200@gmail.com','76a2f368e40953cb4946e3b0bffeead8','','mascota','perrito','usuario');
INSERT INTO users VALUES ('6','Fernando D Sangeorge Acuña Marrero','acunafernando592@gmail.com','76a2f368e40953cb4946e3b0bffeead8','','avion favorito','B1-lancer','administrador');

