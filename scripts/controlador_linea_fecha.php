<?php 

require 'modelo_grafico.php';

    $fechaInicio = $_POST['fechaInicio'];
    $fechaFinal = $_POST['fechaFinal'];
    $valueUnidad = $_POST['valueUnidad'];

    if($valueUnidad != "Sin filtro" && $fechaInicio == ""){
        $fechaInicio = '2023-01-01';
        $fechaFinal = date("Y-m-d");
        $MG = new Modelo_Grafico();
        $consulta = $MG -> TraerDatosLinealFecha($fechaInicio, $fechaFinal,$valueUnidad);
        echo json_encode($consulta);
    }elseif($valueUnidad == "Sin filtro" && $fechaInicio == ""){
        $fechaInicio = '2023-01-01';
        $fechaFinal = date("Y-m-d");
        $MG = new Modelo_Grafico();
        $consulta = $MG -> TraerDatosLineal();
        echo json_encode($consulta);
    }elseif($valueUnidad != "Sin filtro" && $fechaInicio != ""){
        $MG = new Modelo_Grafico();
        $consulta = $MG -> TraerDatosLinealFecha($fechaInicio, $fechaFinal,$valueUnidad);
        echo json_encode($consulta);
    }
?>