<?php 

require 'modelo_grafico.php';

    $valueRango = $_POST['valueRango'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFinal = $_POST['fechaFinal'];

    if($fechaInicio == "" && $fechaFinal == ""){
        if($valueRango == 0){
            $ano = date("Y");
            $fechaInicio = $ano."-01-01";
            $fechaFinal = date("Y-m-d");
            $MG = new Modelo_Grafico();
            $consulta = $MG -> TraerDatosLinealGeoquimica($fechaInicio, $fechaFinal);
            echo json_encode($consulta);
        }else if($valueRango != 0){
            $ano = date("Y");
            $fechaInicio = $ano."-01-01";
            $fechaFinal = date("Y-m-d");
            $MG = new Modelo_Grafico();
            $consulta = $MG -> TraerDatosLinealGeoquimicaRango($fechaInicio, $fechaFinal,$valueRango);
            echo json_encode($consulta);
        }
    }else if($fechaInicio != "" && $fechaFinal != ""){
        if($valueRango == 0){
            $MG = new Modelo_Grafico();
            $consulta = $MG -> TraerDatosLinealGeoquimica($fechaInicio, $fechaFinal);
            echo json_encode($consulta);
        }else if($valueRango != 0){
            $MG = new Modelo_Grafico();
            $consulta = $MG -> TraerDatosLinealGeoquimicaRango($fechaInicio, $fechaFinal,$valueRango);
            echo json_encode($consulta);
        }
    }

?>
