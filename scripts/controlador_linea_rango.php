<?php 

require 'modelo_grafico.php';

    $ano = date("Y");

    $fechaInicio = $_POST['fechaInicio'];
    $fechaFinal = $_POST['fechaFinal'];
    $valueRango = $_POST['valueRango'];

    if($fechaInicio == "" && $fechaFinal == ""){
        $fechaInicio = $ano."-01-01";
        $fechaFinal = date("Y-m-d");
        $MG = new Modelo_Grafico();
        $consulta = $MG -> TraerDatosLinealRango($fechaInicio,$fechaFinal,$valueRango);
        echo json_encode($consulta);
    }else if($fechaInicio != "" && $fechaFinal != ""){
        $MG = new Modelo_Grafico();
        $consulta = $MG -> TraerDatosLinealRango($fechaInicio,$fechaFinal,$valueRango);
        echo json_encode($consulta);
    }

?>
