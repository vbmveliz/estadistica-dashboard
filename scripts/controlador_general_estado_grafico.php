<?php

header('Content-Type: application/json');

$conexion = new mysqli("localhost","root","","db_alab");

$ano = $_POST['ano'] ?? 2024;

$data=[];

$sql="SELECT 
mes,
COUNT(*) as dia,
anio,
SUM(capacidad),
SUM(capacidad),
SUM(recepcion),
SUM(recepcion),
SUM(laboratorio),
SUM(laboratorio),
SUM(preinforme),
SUM(preinforme),
SUM(informe),
SUM(informe)
FROM estadisticas
WHERE anio='$ano'
GROUP BY mes";

$res=$conexion->query($sql);

while($row=$res->fetch_row()){
$data[]=$row;
}

echo json_encode($data);