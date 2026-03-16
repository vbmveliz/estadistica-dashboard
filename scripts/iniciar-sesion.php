<?php

require_once 'modelo_grafico.php';

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

$MG = new Modelo_Grafico();

$resultado = $MG->validarLogin($usuario,$password);

if($resultado){

session_start();
$_SESSION['usuario'] = $resultado['usuario'];

header("Location: ../pages/dashboard.php");

}else{

header("Location: ../login.php?error=1");

}

?>