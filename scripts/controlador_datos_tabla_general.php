<?php

require_once "conexion.php";

$fechaInicio = $_POST['fechaInicio'] ?? "";
$fechaFinal = $_POST['fechaFinal'] ?? "";
$tipo = $_POST['tipo'] ?? "Sin filtro";
$unidad = $_POST['unidad'] ?? "Sin filtro";

$sql = "SELECT * FROM informes WHERE 1=1";

if($fechaInicio != "" && $fechaFinal != ""){
$sql .= " AND fecha_informe BETWEEN '$fechaInicio' AND '$fechaFinal'";
}

if($tipo != "Sin filtro"){
$sql .= " AND estado_informe='$tipo'";
}

if($unidad != "Sin filtro"){
$sql .= " AND unidad_negocio='$unidad'";
}

$result = $conexion->query($sql);

$data=[];

while($row=$result->fetch_assoc()){
$data[]=$row;
}

echo json_encode($data);