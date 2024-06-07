-- Respaldo de la base de datos login

-- Respaldo de la tabla diseños
CREATE TABLE `diseños` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `color` varchar(10) NOT NULL,
  `personalizaciones` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`personalizaciones`)),
  `user_id` int(11) NOT NULL,
  `preview` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO diseños VALUES ('18','','SionTV','#607d8b','[{\"id\":\"decal-1717694950942\",\"type\":\"image\",\"name\":\"Logo SionTV_B2.png\",\"urlImg\":\"../users/7/img/1800280943.jpg\",\"size\":0.31,\"position\":[0,0.06415809768637531],\"hidden\":false}]','7','../users/7/preview/690324325.png');
INSERT INTO diseños VALUES ('19','','Angostura','#2196f3','[{\"id\":\"decal-1717614334281\",\"type\":\"image\",\"name\":\"164944559.jpg\",\"urlImg\":\"../users/7/img/498972666.jpg\",\"size\":0.73,\"position\":[0.0008343749999999983,0.05803984575835475],\"hidden\":false}]','7','../users/7/preview/1892276696.png');
INSERT INTO diseños VALUES ('20','','Oveja','#fff','[{\"id\":\"decal-1717614399612\",\"type\":\"image\",\"name\":\"1787748968.jpg\",\"urlImg\":\"../users/7/img/1604568447.jpg\",\"size\":1.5,\"position\":[-0.002503124999999995,0.05727506426735213],\"hidden\":false}]','7','../users/7/preview/993683194.png');
INSERT INTO diseños VALUES ('21','','Shalom Creative','#fff','[{\"id\":\"decal-1717691911554\",\"type\":\"image\",\"name\":\"rect10825.png\",\"urlImg\":\"../users/7/img/538255805.jpg\",\"size\":1.5,\"position\":[-0.0041718749999999916,0.08939588688946015],\"hidden\":false}]','7','../users/7/preview/226689626.png');
INSERT INTO diseños VALUES ('22','','Genesis','#673ab7','[{\"id\":\"decal-1717692396935\",\"type\":\"image\",\"name\":\"a-captivating-3d-logo-illustration-for-genesis-tha-J7_RjO26R4--vfzFgnjVMA-m8h-I94LS4yIJo1oHzVhQw.png\",\"urlImg\":\"../users/7/img/1725472695.jpg\",\"size\":1.5,\"position\":[0.0016687499999999966,0.04350899742930597],\"hidden\":false}]','7','../users/7/preview/1183279667.png');
INSERT INTO diseños VALUES ('39','','Nuevo Diseño','#fff','[{\"id\":\"decal-1717719701729\",\"type\":\"image\",\"name\":\"TU NOMBRE (1920 x 522 px).png\",\"urlImg\":\"../users/7/img/1038698563.jpg\",\"size\":0.5,\"position\":[-0.07676250000000001,0.11539845758354755],\"hidden\":false}]','10','../users/10/preview/1360204170.png');
INSERT INTO diseños VALUES ('40','','Nuevo Diseño 2','#ffeb3b','[]','10','../users/10/preview/1100843681.png');
INSERT INTO diseños VALUES ('41','','Nuevo Diseño','#fff','[]','10','../users/10/preview/1597730204.png');
INSERT INTO diseños VALUES ('42','','Nuevo Diseño','#fff','[]','10','../users/10/preview/1129793077.png');
INSERT INTO diseños VALUES ('43','','Nuevo Diseño','#fff','[]','10','../users/10/preview/785911227.png');
INSERT INTO diseños VALUES ('44','','Nuevo Diseño','#fff','[]','10','../users/10/preview/282686073.png');
INSERT INTO diseños VALUES ('45','','Nuevo Diseño','#fff','[]','10','../users/10/preview/117825894.png');

-- Respaldo de la tabla imagenes
CREATE TABLE `imagenes` (
  `id_img` int(11) NOT NULL AUTO_INCREMENT,
  `urlImg` varchar(100) NOT NULL,
  `nameImg` varchar(80) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `statusImg` varchar(10) NOT NULL,
  PRIMARY KEY (`id_img`),
  KEY `FKImagen` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO imagenes VALUES ('1','../users/7/img/538255805.jpg','rect10825.png','7','active');
INSERT INTO imagenes VALUES ('2','../users/7/img/498972666.jpg','164944559.jpg','7','active');
INSERT INTO imagenes VALUES ('3','../users/7/img/1604568447.jpg','1787748968.jpg','7','active');
INSERT INTO imagenes VALUES ('4','../users/7/img/1273418733.jpg','Logo SionTV_N1.png','7','active');
INSERT INTO imagenes VALUES ('5','../users/7/img/1800280943.jpg','Logo SionTV_B2.png','7','active');
INSERT INTO imagenes VALUES ('6','../users/7/img/1725472695.jpg','a-captivating-3d-logo-illustration-for-genesis-tha-J7_RjO26R4--vfzFgnjVMA-m8h-I9','7','active');
INSERT INTO imagenes VALUES ('7','../users/7/img/1835789849.jpg','LOGO HDC SION - PNG8.png','7','active');
INSERT INTO imagenes VALUES ('8','../users/7/img/642105629.jpg','LOGO HDC SION - PNG6.png','7','active');
INSERT INTO imagenes VALUES ('9','../users/7/img/727541770.jpg','LOGO HDC SION - PNG1.png','7','active');
INSERT INTO imagenes VALUES ('10','../users/7/img/1038698563.jpg','TU NOMBRE (1920 x 522 px).png','7','active');
INSERT INTO imagenes VALUES ('11','../users/7/img/443606644.jpg','Captura de pantalla 2024-05-17 103546.png','7','active');
INSERT INTO imagenes VALUES ('12','../users/10/img/1923782535.jpg','Captura de pantalla 2024-05-17 105522.png','10','active');

-- Respaldo de la tabla modelos
CREATE TABLE `modelos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `configuracion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`configuracion`)),
  `preview` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO modelos VALUES ('1','Franela ','{\r\n            \"model\":{\r\n                \"gltf\": \"../assets/models/shirt-optimize.glb\",\r\n                \"position\": [0, 0, 0],\r\n                \"rotation\": [0, 0, 0],\r\n                \"scale\": [1, 1, 1]\r\n            },\r\n            \"colors\": [\"#fff\", \"#000\", \"#f44336\", \"#e91e63\", \"#9c27b0\", \"#673ab7\",\r\n            \"#3f51b5\", \"#2196f3\", \"#03a9f4\", \"#00bcd4\", \"#009688\", \"#4caf50\", \"#8bc34a\",\r\n            \"#cddc39\", \"#ffeb3b\", \"#ffc107\", \"#ff9800\", \"#ff5722\", \"#795548\", \"#607d8b\"],\r\n            \"imgPreview\": \"../assets/models/shirt-optimize.png\",\r\n            \"camera\": {\r\n                \"position\": [0, 0.08, 0.55],\r\n                \"maxPositionCamera\": [0, 0.15, 0.3],\r\n                \"minPositionCamera\": [0, 0.15, 0.3],\r\n                \"rotation\": [-0.17, 0, 0]\r\n            },\r\n            \"decal\":{\r\n                \"position\": [0, 0, 0.003],\r\n                \"sizeZ\": [1]\r\n            },\r\n            \"environment\":{\r\n                \"hdr\": \"../assets/hdr/potsdamer_platz_1k-city.hdr\",\r\n                \"exposure\": 0.7,\r\n                \"ambienLightIntensity\": 0.5,\r\n                \"ambienLightColor\": \"[0xFFFFFF]\"\r\n            }\r\n        }','\\assets\\models\\preview\\frontal-shirt.png');

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
  `id_user` varchar(20) NOT NULL,
  `id_disign` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'pendiente',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO orders VALUES ('42','F','0','0','0','1','0','2024-06-06 19:19:18','7','18','pendiente');
INSERT INTO orders VALUES ('43','F','2','0','0','0','0','2024-06-06 19:24:33','7','18','pendiente');
INSERT INTO orders VALUES ('46','F','0','0','1','2','0','2024-06-06 19:33:39','7','38','pendiente');
INSERT INTO orders VALUES ('47','F','0','0','0','1','0','2024-06-06 19:42:24','7','38','pendiente');
INSERT INTO orders VALUES ('48','F','2','0','0','0','0','2024-06-06 20:21:55','10','39','pendiente');
INSERT INTO orders VALUES ('49','F','0','0','1','0','0','2024-06-06 21:38:14','7','22','pendiente');
INSERT INTO orders VALUES ('50','F','0','0','0','1','0','2024-06-06 21:44:12','7','46','pendiente');
INSERT INTO orders VALUES ('51','F','0','0','0','1','0','2024-06-06 21:46:08','7','47','pendiente');

-- Respaldo de la tabla respaldos
CREATE TABLE `respaldos` (
  `idr` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(255) NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idr`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO respaldos VALUES ('2','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha','respaldos_2024-05-08_16-31-30.sql','2024-05-08 16:31:30');
INSERT INTO respaldos VALUES ('3','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha','respaldos_2024-05-13_14-22-22.sql','2024-05-13 14:22:22');
INSERT INTO respaldos VALUES ('7','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha','respaldos_2024-05-13_19-21-25.sql','2024-05-13 19:21:25');
INSERT INTO respaldos VALUES ('8','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha','respaldos_2024-05-13_23-27-19.sql','2024-05-13 23:27:19');
INSERT INTO respaldos VALUES ('9','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla respaldos\nCREATE TABLE `respaldos` (\n  `idr` int(11) NOT NULL AUTO_INCREMENT,\n  `contenido` varchar(255) NOT NULL,\n  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,\n  `fecha','respaldos_2024-05-13_23-27-24.sql','2024-05-13 23:27:24');
INSERT INTO respaldos VALUES ('10','-- Respaldo de la base de datos login\n\n-- Respaldo de la tabla imagenes\nCREATE TABLE `imagenes` (\n  `id_img` int(11) NOT NULL,\n  `urlImg` varchar(100) NOT NULL,\n  `nameImg` varchar(80) NOT NULL,\n  `id_user` int(11) DEFAULT NULL,\n  `statusImg` varchar(10) ','respaldos_2024-05-22_08-42-23.sql','2024-05-22 08:42:23');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users VALUES ('6','Fernando Acuña','acunafernando592@gmail.com','76a2f368e40953cb4946e3b0bffeead8','','avion favorito','B1-lancer','administrador');
INSERT INTO users VALUES ('7','Fernando Acuña','fernandodesangeorge@gmail.com','76a2f368e40953cb4946e3b0bffeead8','','avion favorito','B2 spirit','usuario');
INSERT INTO users VALUES ('9','Fernando Acuña','piensasyhablas@gmail.com','76a2f368e40953cb4946e3b0bffeead8','','mascota','perro','usuario');
INSERT INTO users VALUES ('10','Shalom','sha23lizar@gmail.com','ab57c8840d57c2caaa8979bec38a6dd9','','primer perro','boby','usuario');

