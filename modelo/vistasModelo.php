<?php
class vistasModelo
{
    /*--- Modelo para obtener las vistas-----*/
    protected static function obtener_vistas_modelo($vista)
    {
        /*lista blanca, donde podamos buscar desde el navegador */
        $listaBlanca = [
            "home", "client-list", "client-new", "client-search",
            "client-update", "company", "item-list", "item-new",
             "item-search", "item-update", "reservation-list", 
             "reservation-new", "reservation-pending", "reservation-search",
              "reservation-update", "user-list", "reservation-reservation",
               "user-new", "user-search", "user-update"
        ];
        if (in_array($vista, $listaBlanca)) {
            if (is_file("./vista/contenidos/" . $vista . "-view.php")) {
                $contenido = "./vista/contenidos/" . $vista . "-view.php";
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
