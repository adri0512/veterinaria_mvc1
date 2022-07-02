<?php
require_once "./config/app.php";
require_once "./controlador/vistasControlador.php";

$plantilla = new vistasControlador();
$plantilla-> obtener_plantilla_controlador();

