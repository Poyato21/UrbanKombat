<?php 
require_once("includes/config.php");

$titulo='Bocetos';
$css="index.css";
$contenido=<<<EOS
        <h1>Bocetos UrbanKombat</h1>
        <div class="contenido">
            <h3> General </h3>
            <p> En todas las páginas aparece el mismo header 
                1. Logo centrado, el cual te redirige a la página de inicio 
                2. Icono de mi cuenta, que dependiendo de si el usuario ha iniciado sesión o no aparecerá escrito al lado Iniciar Sesión o Mi Cuenta 
                3. Menú de navegación con las páginas principales de el sitio web (compra, vota, foro, contacto y sorteos)
            </p>
        </div>
        <div class="contenido">
            <h3> Página de inicio</h3>
            <img src="img/inicio.png" alt="pagina de inicio" width="50%" height="50%"/>
            <p> En la página de inicio aparecen tres iconos Vota (redirige a página vota), Novedades en la música urbana
                (redirige a páginas foro) y Contacto (redirige a página de contacto)
            </p>
        </div>

        <div class="contenido">
            <h3> Página de contacto</h3>
            <img src="img/contacto.png" alt="pagina de contacto" width="50%" height="50%"/>
            <p> En la página de contacto aparece el formulario para contactar con el grupo, en él se deben rellenar 
                los siguientes campos: nombre, correo electrónico, motivo de la consulta y consulta. Además es necesario
                aceptar los términos y condiciones del sitio web.
            </p>
        </div>

        <div class="contenido">
            <h3> Foro de novedades </h3>
            <img src="img/foro.png" alt="foro" width="50%" height="50%"/>
            <p> En el foro aparece arriba el cuadro con los mensajes de otros usuarios junto con el perfil del 
                usuario que ha publicado dicho comentario. Y debajo la opción de comentar y de comentar contenido
                de diferentes plataformas (YouTube, Spotify, Apple Music y SoundCloud). Para comentar puedes elegir la
                página de la cual vas a comentar y después escribir el comentario. Al darle al enter se sube el comentario.
                Con el perfil de administrador tendrás la opción de eliminar o bloquear comentarios.
            </p>
        </div>
        <div class="contenido">
            <h3> Página de votaciones</h3>
            <img src="img/vota.png" alt="pagina de votaciones" width="50%" height="50%"/>
            <p> En la página de votaciones aparecen tres botones: artista, álbum y canción. Si haces
                click sobre cualquiera de ellos te llevará a una nueva página donde votar lo que has escogido. En 
                la siguiente sección se explica como funciona la página de artista pero el funcionamiento y 
                aspecto de las otras dos sería igual. 
            </p>
        </div>
        <div class="contenido">
            <h3> Página de votaciones a artistas</h3>
            <img src="img/vota_artista.png" alt="página de votaciones de artistas" width="50%" height="50%"/>
            <p> En la página de votaciones a artistas aparecen primero los cinco artistas a votar, a los cuales 
                se registrará el voto si un usuario registrado hace click en su botón. Sólo hay un
                voto por usuario. Además abajo del todo aparecerá el artista elegido la semana anterior.
            </p>
        </div>
        <div class="contenido">
            <h3> Página de compra</h3>
            <img src="img/compra.png" alt="página de votaciones de artistas" width="50%" height="50%"/>
            <p> En la página de compra aparecen diferentes opciones de compra de tarjetas de música. Si cualquier usuario,
                registrado o no, hace click en la imagen se abrirá la página de compra de producto.
            </p>
        </div>

        <div class="contenido">
            <h3> Página de compra de producto </h3>
            <img src="img/producto.png" alt="página de votaciones de artistas" width="50%" height="50%"/>
            <p> En la página de producto aparece la imagen del producto junto al nombre, el precio y una pequeña descripción.
                Si cualquier usuario, registrado o no, hace click en "¡La quiero!" le llevará a una página de compra.
            </p>
        </div>
        <div class="contenido">
            <h3> Página de sorteos</h3>
            <img src="img/sorteos.png" alt="página de votaciones de artistas" width="50%" height="50%"/>
            <p> En la página de sorteos aparecerán los sorteos disponibles en ese momento. Si un usuario registrado hace click 
                en "Participar" automáticamente le registrará en el sorteo y aparecerá un mensaje de "Buena Suerte. Ya estás
                registrado en el sorteo.". En cambio, si un usuario sin registrar hace click en dicho botón lo llevará a la página
                de iniciar sesión.
            </p>
        </div>
    EOS;

    require 'includes/plantillas/plantilla.php';


?>
