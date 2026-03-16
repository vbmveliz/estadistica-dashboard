<?php

class Modelo_Grafico{

private $conexion;

public function __construct(){

$this->conexion = new mysqli("localhost","root","","db_alab");

if($this->conexion->connect_error){
die("Error de conexion");
}

}

public function validarLogin($usuario,$password){

$sql = "SELECT * FROM usuarios WHERE usuario=? AND password=?";

$stmt = $this->conexion->prepare($sql);

$stmt->bind_param("ss",$usuario,$password);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){
    return $result->fetch_assoc();
}

return false;



}

}