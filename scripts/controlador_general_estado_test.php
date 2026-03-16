<?php 

require 'modelo_tabla_detalle_test.php';

    $anio = $_POST['ano'];
    $filtro = $_POST['filtro'];

    if($anio == "" || $anio == "2023" || $anio == 2023){
        $anio = "2023";
        $MG = new Modelo_Grafico();
        $response = array();
        //$consulta = $MG -> TraerGeneralEstado($anio);
        $response = array();
        $response["statistics"] = $MG -> TraerGeneralEstado($anio,$filtro);
        $response['title'] = $MG -> tituloEstadoGrafico($anio,$filtro);
        echo json_encode($response);
    }else{
        $MG = new Modelo_Grafico();
        $response = array();
        $response["statistics"] = $MG -> TraerGeneralEstado($anio,$filtro);
        $response['title'] = $MG -> tituloEstadoGrafico($anio,$filtro);
        echo json_encode($response);
    }

?>
