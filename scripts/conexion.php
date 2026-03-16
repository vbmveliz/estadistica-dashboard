<?php

$conexion = new mysqli("localhost","root","","db_alab");

if($conexion->connect_error){

die("Error de conexión");

}

?>