<?php

require_once "conexion.php";

$sql = "SELECT 
os,
unidad_negocio,
estado_os,
tipo_pago,
estado_factura
FROM informes
WHERE estado_factura = 'Pendiente'";

$result = $conexion->query($sql);

$data = [];

while($row = $result->fetch_assoc()){

$data[] = [
"os"=>$row['os'],
"unidad_negocio"=>$row['unidad_negocio'],
"estado_os"=>$row['estado_os'],
"tipo_pago"=>$row['tipo_pago'],
"estado_factura"=>$row['estado_factura']
];

}

echo json_encode($data);

?>