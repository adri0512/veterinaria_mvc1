<?php
/*configuracion del servidor, GLOBAL, SISTEMA */
const SERVER="localhost";
const DB="dbveterinaria";
const USER="root"; /*AQUI IRA EL USUARIO*/
const PASS="";

/*CONEXION PARA LA BASE DE DATOS*/

const SGBD="mysql:host=".SERVER.";dbname=".DB; /*EL SDBD ES LA CONSTATE PARA MANDAR A LLAMAR LOS PARARMETROS AL MODELO QUE SE VA A CONECTAR A LA BD */
/*para incriptar la contraseña */
const METHOD="AES-256-CBC"; 
const SECRET_KEY='$veterinaria@2022';
const SECRET_IV='12345'; /*identificador unico */




?>