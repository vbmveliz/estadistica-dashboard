<?php 

    require 'modelo_grafico.php';

    $fecha = date("Y-m-d");

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosTabla($fecha);
    echo json_encode($consulta);

?>
