<?php
require_once("includes/config.php");
$titulo='Detalles';
$css="index.css";
$contenido=<<<EOS
        <div class="contenido">
            <p> UrbanKombat es una aplicación web para compartir tus gustos musicales,  
                dar apoyo a tus artistas favoritos, descubrir música nueva y ponerte al día 
                de las novedades y artistas emergentes. A parte, nuestro mayor objetivo es 
                la difusión de música de artistas emergentes, a base de proporcionar un servicio 
                en el que el cliente apoye a un artista y se comparta su música para crecer en 
                la industria musical. 
            </p>


            <h3> Funcionalidades en las que se basa nuestra aplicación</h3>
            <ul>
                <li>Foro sobre las últimas novedades en la música urbana. </li>
                <li> 
                    Sistema de votación para el público sobre una serie de categorías (canción 
                    de la semana, álbum del mes, artista del mes, mejor instrumental y muchas 
                    más) donde se dará a elegir entre una lista de nominados. </li>
                <li>
                    Disponibilidad de previsualización de canciones con pistas de audio, fotos de 
                    los directos, listas de reproducción y entrevistas a los artistas.
                </li>
                <li> 
                    Sorteos mensuales
                </li>
                <li>
                    Acceso al contenido multimedia con enlaces de Youtube, Spotify, Amazon 
                    Music, Apple Music y Soundcloud.
                </li>
                <li>
                    Compra de tarjetas de música, a la que cualquier usuario puede acceder
                </li>
            </ul>

            <h3> Tipos de usuario UrbanKombat </h3>
            <ul>
                <li> Administradores: Tendrán la posibilidad de actualizar, editar y cargar toda la información en la aplicación. Además de moderar el foro. </li>
                <li> Usuarios no registrados: Podrán tener acceso a todo el contenido de la página y comprar, pero no podrán ni valorar ni comentar. </li>
                <li> Usuarios registrados: acceso a ver todo el contenido de la página. Otorga una serie de ventajas como el acceso a sorteos, posibilidad
                    de votar en las encuestas, publicar en el foro y recibir correos sobre noticias o eventos.. En su perfil podrán compartir sus artistas, canciones 
                    y álbumes favoritos además de poder personalizarlo, añadiendo foto, descripción, etc.  
                </li>

            </ul>
        </div>
        <h1>PLANIFICACION</h1>
        <div class="contenido">
            <p>
                <strong>Etapa 1:</strong> Formación de los grupos y propuesta inicial del proyecto (sales pitch)
                en forma de documento PDF breve.
                <br/>
                <strong>Etapa 2:</strong> Descripción detallada del proyecto, en forma de página web simple
                con varios documentos descriptivos.
                <br/>
                <strong>Etapa 3:</strong> Diseño de la aplicación usando HTML (sin CSS), de la arquitectura
                del lado del servidor y prototipo funcional de parte de la aplicación. Versión
                mínima del proyecto (el alcance de la aplicación será acordado con el tutor del
                proyecto).
                <br/>
                <strong>Etapa 4:</strong> Diseño de la apariencia de la aplicación usando hojas de estilos sobre
                la entrega anterior e incremento de la funcionalidad.
                <br/>
                <strong>Etapa final:</strong> Aplicación Web completa y funcional.
            </p>
        </div>
        
        <div class="contenido">
            <table id="tablaPlan">
                <caption>Tabla de hitos</caption>
                <tr>
                    <th>Etapa</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>31/01</th>
                    <th>04/02</th>
                </tr>
                <tr>
                    <th>2</th>
                    <th>04/02</th>
                    <th>25/02</th>
                </tr>
                <tr>
                    <th>3</th>
                    <th>25/02</th>
                    <th>18/03</th>
                </tr>
                <tr>
                    <th>4</th>
                    <th>18/03</th>
                    <th> 08/04</th>
                </tr>
                <tr>
                    <th>Final</th>
                    <th> 08/04</th>
                    <th> 06/05</th>
                </tr>
            
            </table>
        </div>

            <h2>Diagram de Grantt </h2>
            <img alt="gantt" src="img/foto_diagramadegrantt.png"/> 

        
            <ol>
                <li> <a href="https://balsamiq.com/"> https://balsamiq.com/ </a>  </li>
                <li>  <a href="https://www.lucidchart.com/pages/examples/wireframe_software"> https://www.lucidchart.com/pages/examples/wireframe_software </a></li>
                <li>    <a href="https://www.figma.com/templates/wireframe-kits/"> https://www.figma.com/templates/wireframe-kits/ </a>  </li>
                <li> <a href=" https://www.figma.com/templates/wireframe-kits/">  https://www.figma.com/templates/wireframe-kits/ </a> </li>
                <li>    <a href="https://www.sketch.com"> https://www.sketch.com </a> </li>
                <li>  <a href="https://wireframe.cc/">  https://wireframe.cc/ </a>  </li>
            </ol>

        
 EOS;
 require 'includes/plantillas/plantilla.php';
?>