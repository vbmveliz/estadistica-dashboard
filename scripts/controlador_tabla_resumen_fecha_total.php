<?php 

require 'modelo_grafico.php';

    $fechaInicio = $_POST['fechaInicio'];
    $fechaFinal = $_POST['fechaFinal'];
    $valueRango = $_POST['valueRango'];

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosLinealIeTotalTablaFecha($fechaInicio,$fechaFinal,$valueRango);
    $total = 0;
    foreach ($consulta as $key => $value) {
        $total += $value[1];
    }
    echo $total;
?>
