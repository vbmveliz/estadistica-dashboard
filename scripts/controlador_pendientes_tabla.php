<?php

$conexion = new mysqli("localhost","root","","db_alab");

$sql = "SELECT 
id,
fecha_recepcion,
fecha_entrega,
cliente,
area,
tipo_muestreo,
unidad_negocio,
estado
FROM informes
WHERE estado='Pendiente'
ORDER BY fecha_recepcion DESC";

$result = $conexion->query($sql);

$data = [];

while($row = $result->fetch_assoc()){
$data[] = $row;
}

echo json_encode($data);