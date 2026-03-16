<?php 

    require 'modelo_grafico.php';

    $valueEstadoOs = $_POST['valueEstadoOs'];

    $dia = date("d");
    $mes =date("m");
    $ano = date("Y");
    if($mes < 12){
        $mes = $mes - 2;
        if($mes < 10){
            $mes = "0".$mes;
        }
    }
    if($mes <= 0){
        $mes = 12;
        $ano = $ano - 1;
    }
    $fecha = $ano."-".$mes."-".$dia;

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosGraficoPastel($valueEstadoOs,$fecha);
    echo json_encode($consulta);

?>
