<?php
require_once("includes/config.php");
$titulo='Miembros Urban Kombat';
$css="miembros.css";
$contenido=<<<EOS
        <h1>  MIEMBROS FUNDADORES URBAN-KOMBAT  </h1>
        
        <div class="mCard">
            <img alt="foto" src="img/foto_javi.jpg"/>
            <h2 id="Javier">
                JAVIER GOMEZ ARRIBAS
            </h2>
            <p>Contacto: <a href="mailto:jagome11@ucm.es">jagome11@ucm.es</a>
            </p>
            <p>Soy estudiante de Ingeniería Informática en la UCM.  
                La mayor parte de mi tiempo la paso con mis amigos, soy muy sociable, 
                y sino cuando estoy en casa me gusta ver peliculas y series de todos los estilos. 
                La música también ocupa una gran parte de mi vida, por eso la idea de crear esta plataforma.    
            </p>
        </div>

        <div class="mCard">
        <img alt="foto" src="img/foto_pablo.jpg"/>
            <h2 id="Pablo">
                PABLO LAVANDEIRA POYATO
            </h2>
            <p>Contacto: <a href="mailto:pablavan@ucm.es">pablavan@ucm.es</a> 
            </p>
            <p>Soy estudiante de Ingeniería Informática en la UCM.  
                Soy jugador profesional de Baloncesto de Silla de Ruedas, y para poder desconectar 
                entre competiciones y entrenamientos utilizo la música, es mi via de escape, 
                de ahi que cuando me dijeron de poder colaborar con este proyecto ni me lo pensé.        
            </p>
        </div>


        <div class="mCard">
        <img alt="foto" src="img/foto_ori.jpg"/>
            <h2 id="Oriana">
                ORIANA AVELEDO GALLEGO
            </h2>
            <p> Contacto: <a href="mailto:oriavele@ucm.es">oriavele@ucm.es</a> </p>
            <p> Soy estudiante de informática en la UCM.  
                Me encanta salir a bailar, cantar karaoke y conocer muchos estilos de música  
                para conectar con otras personas a través de ella. Siento que este proyecto  
                es muy interesante ya que expande el conocimiento de otros artistas y estilos musicales.
            </p>
        </div>

        <div class="mCard">
        <img alt="foto" src="img/foto_bea.jpg"/>
            <h2 id="Beatriz">
                BEATRIZ AEDO DIAZ 
            </h2>
            <p>Contacto: <a href="mailto:beaaedo@ucm.es">beaaedo@ucm.es</a>
            </p>
            <p> Estudio Ingeniería Informática en la UCM.   
                La música es una parte muy importante en mi vida porque he estado años entrenando  
                artes marciales y siempre era una parte importante en el entrenamiento, además de  
                en otros aspectos de mi vida a la hora de socializar, estudiar o incluso estando yo sola.  
                Por eso  este proyecto me ha parecido tan interesante.   
            </p>
        </div>


        <div class="mCard">
        <img alt="foto" src="img/foto_maria.jpg"/>
            <h2 id="Maria">
                MARIA BARCENILLA HINCHADO
            </h2>
            <p>Contacto: <a href="mailto:mbarce03@ucm.es">mbarce03@ucm.es</a> 
            </p>
            <p>Soy estudiante de Ingeniería Informática en la UCM. 
                La música me acompaña en gran parte de mi día a día, ya sea de camino en clase,  
                en casa, haciendo ejercicio, estudiando, … Es por este motivo que este proyecto me  
                parece una idea tan atractiva.
            </p>
        </div>

        <div class="mCard">
        <img alt="foto" src="img/foto_carlos.jpg"/>
            <h2 id="Carlos">
                CARLOS ALBA ISASI 
            </h2>
            <p>Contacto:  <a href="mailto:caralb01@ucm.es">caralb01@ucm.es</a>
            </p>
            <p>Soy estudiante de Ingeniería Informática en la UCM. 
                Me enamoré de la música cuando era pequeño y me volví adicto. Siempre que puedo  
                aprovecho para disfrutar de ella porque para mí es algo imprescindible en mi día a día. 
                Por esta razón estoy agradecido de formar parte de este proyecto.       
            </p>
        </div>
EOS;
require 'includes/plantillas/plantilla.php';
?>