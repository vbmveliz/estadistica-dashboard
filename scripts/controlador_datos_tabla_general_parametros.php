<?php 

require 'modelo_grafico.php';

        $fechaInicio = $_POST['fechaInicio'];
        $fechaFinal = $_POST['fechaFinal'];
        $valueRango = $_POST['valueRango'];
        $valueTipo = $_POST['valueTipo'];

        if($valueTipo == "Enviado al Cliente"){
            $valueTipo = "Enviado Cliente";
        }

        if($valueTipo == "Sin filtro" && $fechaInicio == "" && $fechaFinal == ""){
            $ano = date("Y");
            $fechaInicio = $ano."-01-01";
            $fechaFinal = date("Y-m-d");
            $MG = new Modelo_Grafico();
            $consulta = $MG -> TraerDatosTablaGeneral($fechaInicio, $fechaFinal,$valueRango);
            echo json_encode($consulta);
        }elseif($valueTipo != "Sin filtro" && $fechaInicio == "" && $fechaFinal == ""){
            $ano = date("Y");
            $fechaInicio = $ano."-01-01";
            $fechaFinal = date("Y-m-d");
            $MG = new Modelo_Grafico();
            $consulta = $MG -> TraerDatosTablaGeneralParametros($fechaInicio, $fechaFinal, $valueTipo, $valueRango);
            echo json_encode($consulta);
        }elseif($valueTipo == "Sin filtro" && $fechaInicio != "" && $fechaFinal != ""){
            $MG = new Modelo_Grafico();
            $consulta = $MG -> TraerDatosTablaGeneral($fechaInicio, $fechaFinal,$valueRango);
            echo json_encode($consulta);
        }elseif($valueTipo != "Sin filtro" && $fechaInicio != "" && $fechaFinal != ""){
            $MG = new Modelo_Grafico();
            $consulta = $MG -> TraerDatosTablaGeneralParametros($fechaInicio, $fechaFinal, $valueTipo, $valueRango);
            echo json_encode($consulta);
        }
    

?>
