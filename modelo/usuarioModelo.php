<?php
require_once "mainModelo.php";

class usuarioModelo extends mainModelo {

/*vamos a crear modelo agregar usuario */

protected static function agregar_usuario_modelo($datos) {
   $sql=mainModelo::conectar()->prepare("INSERT INTO usuario() VALUES()"); /*nombre de la tabla usuario */
   
}



}
