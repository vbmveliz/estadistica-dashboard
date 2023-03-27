<?php 

    require 'modelo_tabla_detalle.php';

    $estado=$_POST['estado'];
    if($estado == "Generado a solicitud de Preparación"){
        $estado = "dias_generado_a_solicitudpreparacion";
    }else if($estado == "Solicitud de preparación a recepción de Solicitud"){
        $estado = "dias_recepcionado";
    }else if($estado == "Recepción de solicitud a preparación de Materiales"){
        $estado = "dias_preparado";
    }else if($estado == "Preparación de Material a Entrega Cliente"){
        $estado = "ENTCLIENTE";
    }else if($estado == "Entrega Cliente a Finalizado"){
        $estado = "dias_finalizado";
    }

    $dia = $_POST['dia'];

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosDetalle($dia, $estado);
    if(empty($consulta)){
        echo "error";
    }else{
        echo json_encode($consulta);
    }

?>