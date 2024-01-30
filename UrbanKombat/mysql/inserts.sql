TRUNCATE TABLE `usuarios`;
/*
  USUARIO: CONTRASEÑA 
  admin: adminpass
  user:userpass
  beaaedo:12345
  orianav:12345
  mariaba:12345
  javier:12345
  pablo:12345
  carlos:12345
*/
INSERT INTO `usuarios` (`id`, `nombreUsuario`, `nombre`, `password`, `rol`,`votoCancion`, `votoArtista`,`votoAlbum`, `tarjetaYT`,`tarjetaSpoti`,`tarjetaApple`, `concurso`) VALUES
(1, 'admin', 'Administrador', '$2y$10$j3gDDnUmICg/rvP0lmz8Duv2FcE1Ufi0tDQpIqx5cKcbqtkBOxhfS', 'admin',false, false, false, '', '', '', false),
(2, 'user', 'Usuario', '$2y$10$ImLgzNnDkWlI7LBB5a1mk.vNu8Fb8z79syAsoOXqM7jy5hrTaZKnG','user', false, false, false, '', '', '', false),
(3, 'beaaedo', 'Beatriz', '$2y$10$Sa4B7oNaDaTJCzucdpMoZuL/MF2mmHSgOTI2Ts7ZrBfz07G3osHhS','user', false, false, false, '', '', '', false),
(4, 'oriana', 'oriana', '$2y$10$9U.V7Eze0UBvP9YeRbINJ.gkAirHQ7CWeRZ2DVWTCSww4l.LfUkB6','user', false, false, false, '', '', '', false),
(5, 'maria', 'maria', '$2y$10$VR.Phxr/lS7XqswIZxXnreK0XOY1w.uK66bBzRRYDvnx5tq2GXFF2','user', false, false, false, '', '', '', false),
(6, 'carlos', 'carlos', '$2y$10$9a6ePqNcA31Pac.icoW5WOEV6FHVvPe.eb82lfotaM4LMmpXdex.q','user', false, false, false, '', '', '', false),
(7, 'javier', 'javier', '$2y$10$Z2OkF/Y2ak89nDDyzqCdbeCa9ybSm48j/MBd32kxjp/DsUQilge1a','user', false, false, false, '', '', '', false),
(8, 'pablo', 'pablo', '$2y$10$fgKtVfVR9B0M313aGhC8rOn4swuc0ZQ5lAwkQBgNv8nVg0iyXKC0y','user', false, false, false, '', '', '', false);


TRUNCATE TABLE `temas`;

INSERT INTO `temas` (`id`, `titulo`, `fecha`, `creador`, `comentario`, `respuestas`) VALUES
(1, "Nuevo album de Rosalía: Motomami", "2022-04-19 10:40:32", 'user', "Comentad aquí qué os ha parecido el album!!!", 1),
(2, "Nueva EP de Morad y Beny JR", "2022-04-17 11:20:08", 'user', "Comentad aquí qué os ha parecido el EP!!!", 3),
(3, "Que representa el género urbano para ti?", "2022-04-16 20:20:20", 'admin', "Comparte con nostros tu opinión", 1);

TRUNCATE TABLE `respuestas`;

INSERT INTO `respuestas` (`id`, `usuario`, `texto`, `fecha`, `id_tema`)
VALUES (2, "javier", "Me encanta!!", "2022/3/16 13:45:00", 2), 
(4, "maria", "Yo lo odio", "2022/4/16 7:23:00", 2), 
(3, "carlos", "A tope", "2022/4/01 21:09:00",2),
(5, "pablo", '<iframe class="spotifySong" src=https://open.spotify.com/embed/track/28GCbKgjlVD9eDmasGbe0T?si=76992b5378674b4dutm_source=generator  frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"></iframe>', "2022/4/19 21:14:00",3),
(1, "Beatriz", '<iframe src=https://www.youtube.com/embed/XlNtBPvPUTM/ title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>', "2022/3/15 01:09:00",1);

TRUNCATE TABLE `Productos`;

INSERT INTO `Productos`(`id`, `nombre`,`precio`, `existencias`, `imagen`) VALUES
(1,'Tarjeta Spotify', 11, 10, 'compra_spotify.png'),
(2, 'Tarjeta Apple Music', 12, 10, 'compra_appleMusic.jpg'),
(3, 'Tarjeta YouTube', 15, 10, 'compra_youtube.png');

TRUNCATE TABLE `Artistas`;

INSERT INTO `Artistas` (`id`, `nombre`, `votos`,`esGanador`, `comentario`) VALUES
(1,'Soto Asa', 0, 0,''), (2,'Recycled J', 0, 0,''), (3, 'Rauw Alejandro', 0,0,''),
(4,'Dellafuente', 0,0,''), (5,'Rosalía', 0,0,'');

TRUNCATE TABLE `Albumes`;

INSERT INTO `Albumes` (`id`,`nombre`, `votos`,`esGanador`, `comentario`) VALUES
(1,'YHLQMDLG', 0, 0, ''), (2,'Motomami', 0,0,''), (3,'Levantaremos al sol', 0, 0,''), 
(4, 'Multitude', 0,0,''), (5, 'Pa lla Voy', 0,0,'');

TRUNCATE TABLE `Canciones`;

INSERT INTO `Canciones` (`id`,`nombre`,`artista`, `votos`, `duracion`, `esGanadora`, `comentario`) VALUES
(1, 'Cayó La Noche', 'La Pantera', 0, 132, 0, ''), (2, 'MAMIII', 'Becky G', 0, 134, 0, ''),
(3, 'Desesperados', 'Rauw Alejandro', 0, 135, 0, ''), (4, 'Una Noche En Medellín', 'Cris Mj', 0, 136, 0, ''), 
(5, 'Lo Mío', 'Cocco Lexa', 0, 137, 0, '');