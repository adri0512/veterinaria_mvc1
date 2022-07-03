<?php
if ($peticionAjax) {
    require_once "../config/server.php";
} else {
    require_once "./config/server.php";
}

class mainModelo
{
    /*------ FUNCION PARA CONECTAR A BD */
    protected static function conectar()
    {
        $conexion = new PDO(SGBD, USER, PASS);
        $conexion->exec("SET CHARACTER SET utf8"); /* aqui solo se puso esta parte, porque en el SERVER.PHP
        lleva parte de la conexion*/
        return $conexion;
    }

    /*FUNCION EJECUTAR CONUSLTAS SIMPLES*/
    protected static function ejecutar_consulta_simple($consulta)
    {
        $sql = self::conectar()->prepare($consulta); /*self hace referencia al metodo que es conecatr */
        $sql->execute();
        return $sql;
    }
    /*ENCRIPTA CADENAS  */
    public function encryption($string)
    {
        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    /*DESENCRIPTAR CADENAS  */
    protected static function decryption($string)
    {
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }

    /*FUNCION PARA GENERAR CODIGOS ALEATORIOS */
    protected static function generar_codigo_aleatorio($letra, $longitud, $numero)
    {
        for ($i = 1; $i <= $longitud; $i++) {
            $aleatorio = rand(0, 9);
            $letra .= $aleatorio;
        }
        return $letra . "-" . $numero;
    }

    /*FUNCION PARA LIMPIAR CADENAS  */

    protected static function limpiar_cadenas($cadena)
    {
        $cadena = trim($cadena);
        /*el trim elima espacios que este antes o despues del texto */
        $cadena = stripslashes($cadena);
        $cadena = str_ireplace("<script>", "", $cadena); /* */
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src", "", $cadena);
        $cadena = str_ireplace("<script type=", "", $cadena);
        $cadena = str_ireplace("SELECT * FROM", "", $cadena);
        $cadena = str_ireplace("DELETE FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("DROP TABLE", "", $cadena);
        $cadena = str_ireplace("DROP DATABASE", "", $cadena);
        $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
        $cadena = str_ireplace("SHOW TABLES", "", $cadena);
        $cadena = str_ireplace("SHOW DATABASES", "", $cadena);
        $cadena = str_ireplace("<?php", "", $cadena);
        $cadena = str_ireplace("?>", "", $cadena);
        $cadena = str_ireplace("--", "", $cadena);
        $cadena = str_ireplace(">", "", $cadena);
        $cadena = str_ireplace("<", "", $cadena);
        $cadena = str_ireplace("[", "", $cadena);
        $cadena = str_ireplace("]", "", $cadena);
        $cadena = str_ireplace("^", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        $cadena = str_ireplace(";", "", $cadena);
        $cadena = str_ireplace("::", "", $cadena);

        $cadena = stripslashes($cadena);
        $cadena = trim($cadena); /*el trim elima espacios que este antes o despues del texto */
        return $cadena;
    }
    /*VERIFICAR DATOS */
    protected static function verificar_datos($filtro, $cadena)
    {
        /*preg_match — Realiza una comparación con una expresión regular */
        if (preg_match("/^" . $filtro . "$/", $cadena)) { /*para el dni */
            return false;
        } else {
            return true;
        }
    }
    /*verificar fechas y checkdate=para fecha*/
    protected static function verificar_fecha($fecha)
    {
        $valores = explode('-', $fecha);
        if (count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])) {
            return false; /*si es verdadero da la fecha */
        } else {
            return true; /*si no es verdadera mostrara error */
        }
    }

    /*FUNCION PAGINADOR DE TABLAS */
    protected static function paginador_tablas($pagina, $Npaginas, $url, $botones)
    {
        $tabla = ' <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">';
        if ($pagina == 1) {
            $tabla .= ' <li class="page-item disabled"><a class="page-link"><i class=="fas fa-angle-double-left"></i></a></li>';
        } else {
            $tabla .= '
             <li class="page-item"><a class="page-link" href="' . $url . '1/"><i class=="fas fa-angle-double-left"></i></a></li>
            <li class="page-item"><a class="page-link" href="' . $url . ($pagina - 1) . '/">Anterior</a></li>';
        }
        $ci = 0;
        for ($i = $pagina; $i <= $Npaginas; $i++) {
            if ($ci >= $botones) { /*botones que se vaya a generar */
                break; /*para detener el ciclo */
            }

            if ($pagina == $i) {
                $tabla .= ' <li class="page-item"><a class="page-link active" 
                href="' . $url .$i. '/">'.$i.'</i></a></li>';
            } else {
                $tabla .= ' <li class="page-item"><a class="page-link" 
                href="' . $url .$i. '/">'.$i.'</i></a></li>';
            }
            $ci++;
        }
        if ($pagina == $Npaginas) {
            $tabla .= ' <li class="page-item disabled"><a class="page-link"><i class=="fas fa-angle-double-right"></i></a></li>';
        } else {
            $tabla .= '
            <li class="page-item"><a class="page-link" href="' . $url . ($pagina + 1) . '/">Siguiente</a></li>
             <li class="page-item"><a class="page-link" href="' . $url . $Npaginas . '/"><i class=="fas fa-angle-double-right"></i></a></li>';
        }

        $tabla .= '   </ul></nav>';
        return $tabla;
    }
}
