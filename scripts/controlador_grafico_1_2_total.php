<?php 

    require 'modelo_tabla_detalle.php';

    $valueEstadoOs=$_POST['valueEstadoOs'];
    if($valueEstadoOs == "Generado"){
        $valueEstadoOs = "Dias_OS_a_solicitudpreparacion";
    }else if($valueEstadoOs == "Solicitud de preparación de Material"){
        $valueEstadoOs = "Dias_solicitud_a_recepcionado";
    }else if($valueEstadoOs == "Recepción de preparación del Material"){
        $valueEstadoOs = "Dias_solicitudpreparacion_a_preparado";
    }else if($valueEstadoOs == "Cliente recibé los Materiales"){
        $valueEstadoOs = "Dias_recepcion_cliente";
    }else if($valueEstadoOs == "Finalizado / Atentido"){
        $valueEstadoOs = "Dias_finalizado";
    }

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosGraficobar2_1($valueEstadoOs);
    if(empty($consulta)){
        echo "error";
    }else{
        echo json_encode($consulta);
    }

?>