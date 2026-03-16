<?php 

require 'modelo_grafico.php';

    $fechaInicio = $_POST['fechaInicio'];
    $fechaFinal = $_POST['fechaFinal'];
    $valueUnidad = $_POST['valueUnidad'];
    $valueRango = $_POST['valueRango'];
    $valueTipo = $_POST['valueTipo'];



    $ano = date("Y");
    $MG = new Modelo_Grafico();
    $consulta = $MG -> getDatosLineal($fechaInicio,$fechaFinal,$valueUnidad,$valueRango,$valueTipo);
    echo json_encode($consulta);

    // if($valueUnidad != "Sin filtro" && $fechaInicio != "" && $fechaFinal != ""){
    //     $MG = new Modelo_Grafico();
    //     // $consulta = $MG -> TraerDatosLinealFechaUnidad($fechaInicio, $fechaFinal, $valueUnidad,$valueRango);
    //     $consulta = $MG -> TraerDatosLinealFechaUnidad($fechaInicio, $fechaFinal,$valueUnidad,$valueRango,$valueTipo);
    //     // echo "TraerDatosLinealFechaUnidad 1";
    //     echo json_encode($consulta);
    // }elseif($valueUnidad == "Sin filtro" && $fechaInicio != "" && $fechaFinal != ""){
    //     $MG = new Modelo_Grafico();
    //     $consulta = $MG -> TraerDatosLinealFecha($fechaInicio, $fechaFinal,$valueRango);
    //     echo json_encode($consulta);
    // }elseif($valueUnidad != "Sin filtro" && $fechaInicio == "" && $fechaFinal == ""){
    //     $fechaInicio = $ano."-01-01";
    //     $fechaFinal = date("Y-m-d");
    //     $MG = new Modelo_Grafico();
    //     // $consulta = $MG -> TraerDatosLinealFechaUnidad($fechaInicio, $fechaFinal, $valueUnidad,$valueRango);
    //     $consulta = $MG -> TraerDatosLinealFechaUnidad($fechaInicio, $fechaFinal,$valueRango,$valueUnidad,$valueTipo);
    //     echo "TraerDatosLinealFechaUnidad 2";
    //     echo json_encode($consulta);
    // }elseif($valueUnidad == "Sin filtro" && $fechaInicio == "" && $fechaFinal == ""){
    //     $fechaInicio = $ano."-01-01";
    //     $fechaFinal = date("Y-m-d");
    //     $MG = new Modelo_Grafico();
    //     // $consulta = $MG -> TraerDatosLinealFechaSinFiltro($fechaInicio);
    //     $consulta = $MG -> TraerDatosLinealFechaSinFiltro($fechaInicio,$valueRango,$valueUnidad,$valueTipo);
    //     echo "TraerDatosLinealFechaSinFiltro";
    //     echo json_encode($consulta);
    // }
?>
