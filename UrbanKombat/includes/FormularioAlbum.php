<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Album.php';

class FormularioAlbum extends form{

    public function __construct() {
        parent::__construct('formAlbum');
    }

    protected function generaCamposFormulario($datos, $errores = array()){

        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $html=<<<EOS
                $htmlErroresGlobales
                <fieldset>
                <div class="grupo-control">
                    <select name ="albumes">
                        <option value="1" selected> YHLQMDLG </option>
                        <option value="2"> Motomami </option>
                        <option value="3">  Levantaremos al sol </option>
                        <option value="4" > Multitude</option>
                        <option value="5"> Pa'lla Voy </option></div>
                    </select>
                </br>
                <div class="grupo-control">
                    <button type="submit" name="vota" value="Vota"> Vota </button> </div>   
            </fieldset>
        EOS;

        return $html;
    }

    protected function procesaFormulario($datos) {
        
       
            if($votado == "1") {
                $result=Album::registraVoto('Album1');
            }
            else if ($votado == "2") {
                $result=Album::registraVoto('Album2');
            }
            else if ($votado == "3") {
                $result=Album::registraVoto('Album3');
            }
            else if ($votado == "4") {
                $result=Album::registraVoto('Album4');
            }
            else {
                $result=Album::registraVoto('Album5');
            }
        
        return $result;
    }
}