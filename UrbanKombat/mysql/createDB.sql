-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS `UrbanKombat` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

-- Crear el usuario
CREATE USER 'UrbanKombat'@'%' IDENTIFIED BY 'UrbanKombat';
GRANT ALL PRIVILEGES ON `UrbanKombat`.* TO 'UrbanKombat'@'%';

CREATE USER 'UrbanKombat'@'localhost' IDENTIFIED BY 'UrbanKombat';
GRANT ALL PRIVILEGES ON `UrbanKombat`.* TO 'UrbanKombat'@'localhost';

-- Configuracion
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Tabla productos
CREATE TABLE `Productos`(
    `id` int(11) NOT NULL,
    `nombre` varchar(25) NOT NULL,
	`precio` integer NOT NULL,
	`existencias` integer NOT NULL,
	`imagen` varchar(25),
	PRIMARY KEY(id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

-- Tabla respuestas
CREATE TABLE `respuestas`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `usuario` varchar(100) NOT NULL,
    `texto` varchar(1000) NOT NULL,
	`fecha` DATETIME,
    `id_tema` int(11) NOT NULL,
	PRIMARY KEY(id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

-- Tabla temas
CREATE TABLE `temas`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `titulo` varchar(100) NOT NULL,
    `fecha` DATETIME,
    `creador` varchar(25) NOT NULL,
    `comentario` varchar(100) NOT NULL,
    `respuestas` int(10) NOT NULL,
	PRIMARY KEY(id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

-- Tabla usuarios
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombreUsuario` varchar(15) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(10) NOT NULL,
  `votoCancion` boolean NOT NULL,
  `votoArtista` boolean NOT NULL,
  `votoAlbum` boolean NOT NULL,
  `tarjetaYT`varchar(255) NOT NULL,
  `tarjetaSpoti`varchar(255) NOT NULL,
  `tarjetaApple`varchar(255) NOT NULL,
  `concurso` boolean NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

-- Tablas de votaciones
CREATE TABLE `Artistas` (
  `id` integer NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `votos` integer NOT NULL,
  `esGanador` boolean NOT NULL,
  `comentario` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Albumes` (
  `id` integer NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `votos` integer NOT NULL, 
  `esGanador` boolean NOT NULL, 
  `comentario` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Canciones` (
  `id` integer NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `artista` varchar(100) NOT NULL,
  `votos` integer NOT NULL,
  `duracion` integer NOT NULL, 
  `esGanadora`boolean NOT NULL,
  `comentario`varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `Artistas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `Albumes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `Canciones`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `Artistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `Albumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `Canciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;





