<?php
class vistasModelo
{
    /*--- Modelo para obtener las vistas-----*/
    protected static function obtener_vistas_modelo($vista)
    {
        /*lista blanca, donde podamos buscar desde el navegador */
        $listaBlanca = ["home", "client-list"];
        if (in_array($vista, $listaBlanca)) {
            if (is_file("/vista/contenidos/" . $vista . "-view.php")) {
                $contenido = "/vista/contenidos/" . $vista . "-view.php";
            } else {
                $contenido = "404";  
            }
        } elseif ($vista == "login" || $vista == "index") {
            $contenido = "login"; /*la vista que va a mostrar */
        } else {
            $contenido = "404";
        }
        return $contenido;
    }
}
