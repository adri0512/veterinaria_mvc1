<?php
$peticionAjax=true;
require_once "../config/app.php";

if(false){
/*INSTANCIA AL CONTROLADOR */
require_once "../controlador/usuarioControlador.php";
$ins_usuario = new usuarioControlador();


}else{
    session_start(['name'=>'veterinaria']);
    session_unset();
    session_destroy();
    header("Location: ".SERVERURL."login/");
exit();

}

