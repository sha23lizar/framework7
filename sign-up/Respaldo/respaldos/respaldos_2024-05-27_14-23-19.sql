-- Respaldo de la base de datos login

-- Respaldo de la tabla imagenes
CREATE TABLE `imagenes` (
  `id_img` int(11) NOT NULL,
  `urlImg` varchar(100) NOT NULL,
  `nameImg` varchar(80) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `statusImg` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO imagenes VALUES ('0','../users/7/img/1501884764.jpg','husky-en-la-nieve_3840x2400_xtrafondos.com.jpg','7','active');
INSERT INTO imagenes VALUES ('0','../users/7/img/1133619944.jpg','husky-en-la-nieve_3840x2400_xtrafondos.com (1).jpg','7','active');
INSERT INTO imagenes VALUES ('0','../users/7/img/1510359050.jpg','6 (1).png','7','active');

-- Respaldo de la tabla orders
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genero` varchar(10) NOT NULL,
  `xs` int(11) NOT NULL DEFAULT 0,
  `s` int(11) NOT NULL DEFAULT 0,
  `m` int(11) NOT NULL DEFAULT 0,
  `l` int(11) NOT NULL DEFAULT 0,
  `xl` int(11) NOT NULL DEFAULT 0,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'pendiente',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO orders VALUES ('28','M','2','0','0','0','0','2024-05-19 15:39:56','Fernando Acuña','fernandodesangeorge@gmail.com','Aprobado');
INSERT INTO orders VALUES ('30','M','2','0','0','0','0','2024-05-19 15:39:56','Fernando Acuña','fernandodesangeorge@gmail.com','Aprobado');
INSERT INTO orders VALUES ('36','M','2','6','0','0','0','2024-05-19 15:39:56','Fernando Acuña','fernandodesangeorge@gmail.com','Aprobado');

-- Respaldo de la tabla respaldos
CREATE TABLE `respaldos` (
  `idr` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(255) NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idr`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO respaldos VALUES ('10','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla imagenes\nCREATE TABLE `imagenes` (\n  `id_img` int(11) NOT NULL,\n  `urlImg` varchar(100) NOT NULL,\n  `nameImg` varchar(80) NOT NULL,\n  `id_user` int(11) DEFAULT NULL,\n  `statusImg` varchar(10) ','respaldos_2024-05-22_08-42-23.sql','2024-05-22 08:42:23');
INSERT INTO respaldos VALUES ('11','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla imagenes\nCREATE TABLE `imagenes` (\n  `id_img` int(11) NOT NULL,\n  `urlImg` varchar(100) NOT NULL,\n  `nameImg` varchar(80) NOT NULL,\n  `id_user` int(11) DEFAULT NULL,\n  `statusImg` varchar(10) ','respaldos_2024-05-27_14-22-46.sql','2024-05-27 14:22:46');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users VALUES ('6','Fernando Acuña','acunafernando592@gmail.com','76a2f368e40953cb4946e3b0bffeead8','','avion favorito','B1-lancer','administrador');
INSERT INTO users VALUES ('7','Fernando Acuña','fernandodesangeorge@gmail.com','76a2f368e40953cb4946e3b0bffeead8','','avion favorito','B2 spirit','usuario');
INSERT INTO users VALUES ('9','Fernando Acuña','piensasyhablas@gmail.com','76a2f368e40953cb4946e3b0bffeead8','','mascota','perro','usuario');

