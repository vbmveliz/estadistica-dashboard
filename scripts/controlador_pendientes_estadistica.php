<?php

require_once "conexion.php";

$sql="SELECT
os,
unidad_negocio,
estado_os,
tipo_pago,
estado_factura,
estado_informe,
fecha_inicio_muestra,
fecha_envio_cliente,
DATEDIFF