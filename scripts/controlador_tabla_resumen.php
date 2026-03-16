<?php 

require 'modelo_grafico.php';

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosLinealIeTotalTabla();
    echo json_encode($consulta);
?>
