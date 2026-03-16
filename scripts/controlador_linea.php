<?php

require_once __DIR__ . '/../conexion.php';

$sql="SELECT 
MONTH(fecha_inicio_muestra) mes,
SUM(CASE WHEN estado_informe='Con Resultados' THEN 1 ELSE 0 END),
SUM(CASE WHEN estado_informe='En Proceso' THEN 1 ELSE 0 END),
SUM(CASE WHEN estado_informe='Enviado Cliente' THEN 1 ELSE 0 END)
FROM informes
GROUP BY mes
ORDER BY mes";

$result=$conexion->query($sql);

$data=[];

while($row=$result->fetch_row()){
$data[]=$row;
}

echo json_encode($data);