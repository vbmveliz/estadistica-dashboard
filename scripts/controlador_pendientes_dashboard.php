<?php

require_once "conexion.php";

$sql = "
SELECT
os,
unidad_negocio,
estado_os,
tipo_pago,
estado_factura,
estado_informe,
DATEDIFF(CURDATE(),fecha_inicio_muestra) AS dias
FROM informes
WHERE estado_factura='Pendiente'
ORDER BY dias DESC
";

$result = $conexion->query($sql);

$data = [];

while($row = $result->fetch_assoc()){
$data[] = $row;
}

echo json_encode($data);

?>