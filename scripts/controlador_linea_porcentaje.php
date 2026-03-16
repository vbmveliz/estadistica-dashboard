<?php 

require 'modelo_grafico.php';

    $ano = date("Y");

    $fechaInicio = $ano."-01-01";

    $fechaFinal = date("Y-m-d");

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosLinealPorcentaje($fechaInicio,$fechaFinal);
    echo json_encode($consulta);

?>
