<?php 

    require 'modelo_grafico.php';

    $valueEstadoOs=$_POST['valueEstadoOs'];
    if($valueEstadoOs == "Generado a solicitud de Preparación"){
        $valueEstadoOs = "Dias_OS_a_solicitudpreparacion";
    }else if($valueEstadoOs == "Solicitud de preparación a recepción de Solicitud"){
        $valueEstadoOs = "Dias_solicitud_a_recepcionado";
    }else if($valueEstadoOs == "Recepción de solicitud a preparación de Materiales"){
        $valueEstadoOs = "Dias_solicitudpreparacion_a_preparado";
    }else if($valueEstadoOs == "Preparación de Material a Entrega Cliente"){
        $valueEstadoOs = "Dias_recepcion_cliente";
    }else if($valueEstadoOs == "Entrega Cliente a Finalizado"){
        $valueEstadoOs = "Dias_finalizado";
    }

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosGraficobar2($valueEstadoOs);
    if(empty($consulta)){
        echo "error";
    }else{
        echo json_encode($consulta);
    }

?>