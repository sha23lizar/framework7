-- Respaldo de la base de datos login

-- Respaldo de la tabla respaldos
CREATE TABLE `respaldos` (
  `idr` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(255) NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idr`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO respaldos VALUES ('1','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha` datetime NOT ','respaldos_2024-05-08_16-29-09.sql','2024-05-08 16:29:09');
INSERT INTO respaldos VALUES ('2','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha','respaldos_2024-05-08_16-31-30.sql','2024-05-08 16:31:30');
INSERT INTO respaldos VALUES ('3','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha','respaldos_2024-05-13_14-22-22.sql','2024-05-13 14:22:22');
INSERT INTO respaldos VALUES ('7','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha','respaldos_2024-05-13_19-21-25.sql','2024-05-13 19:21:25');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users VALUES ('6','Fernando D Sangeorge Acuña Marrero','acunafernando592@gmail.com','76a2f368e40953cb4946e3b0bffeead8','','avion favorito','B1-lancer','administrador');
INSERT INTO users VALUES ('7','Fernando Acuña','fernandodesangeorge@gmail.com','76a2f368e40953cb4946e3b0bffeead8','','avion favorito','B2 spirit','usuario');

