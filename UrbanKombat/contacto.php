<?php 
require_once("includes/config.php");
  $titulo='Contacto';
  $contenido=<<<EOS
  <h1> Contacto </h1>
    
    <form  method="post"  action="mailto:example@ucm.es" enctype="text/plain">
        <ul>
        <li>
           <label for="name">Nombre:</label>
           <input type="text" id="name" name="user_name">
        </li>
        <li>
           <label for="mail">Email:</label>
           <input type="email" id="mail" name="user_mail">
         </li>
         <li>
         <p>Motivo de consulta:</p>
         <input type="radio" id="html" name="fav_language" value="HTML">
         <label for="html">Evaluación</label><br>
         <input type="radio" id="css" name="fav_language" value="CSS">
         <label for="css">Sugerencias</label><br>
         <input type="radio" id="javascript" name="fav_language" value="JavaScript">
         <label for="javascript">Críticas</label>
         </li>
         <li>
         <label><input type="checkbox" id="cbox1" value="first_checkbox"> 
            Marque esta casilla para verificar que ha leído nuestros términos y condiciones del servicio</label>
        </li>
        <li>
           <label for="msg">Consulta:</label>
           <p><textarea id="msg" name="user_message"rows="10" cols="40"></textarea></p>
         </li>
        </ul>
        <div> <input type="submit" value="Submit"/> </div>
       </form>
EOS;
require 'includes/plantillas/plantilla.php';
?>