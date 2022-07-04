<?php
if($peticionAjax){
    require_once "../modelo/usuarioModelo.php";
}else{
    require_once ".modelo/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo{

/*controlador para agregar usuario */
public  function agregar_usuario_controlador() {

    
}

}