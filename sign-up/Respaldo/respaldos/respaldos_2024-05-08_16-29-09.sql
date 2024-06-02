-- Respaldo de la base de datos login

-- Respaldo de la tabla respaldos
CREATE TABLE `respaldos` (
  `idr` int(11) NOT NULL,
  `contenido` varchar(255) NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


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

