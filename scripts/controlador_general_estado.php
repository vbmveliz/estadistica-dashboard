<?php

header('Content-Type: application/json');

$conexion = new mysqli("localhost","root","","db_alab");

$ano = $_POST['ano'] ?? date("Y");

$statistics = [];

for($mes=1;$mes<=12;$mes++){

$sql = "SELECT 
SUM(capacidad) as capacidad,
SUM(recepcion) as recepcion,
SUM(laboratorio) as laboratorio,
SUM(preinforme) as preinforme,
SUM(informe) as informe
FROM estadisticas
WHERE anio='$ano' AND mes='$mes'";

$res = $conexion->query($sql);
$row = $res->fetch_assoc();

$statistics[]=[
"$mes",
intval($row['capacidad']),
intval($row['recepcion']),
intval($row['laboratorio']),
intval($row['preinforme']),
intval($row['informe'])
];

}

echo json_encode([
"statistics"=>$statistics
]);