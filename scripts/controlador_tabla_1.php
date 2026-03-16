<?php 

    require 'modelo_tabla_detalle.php';

    $estado=$_POST['estado'];
    if($estado == "Generado"){
        $estado = "dias_generado_a_solicitudpreparacion";
    }else if($estado == "Solicitud de preparación de Material"){
        $estado = "dias_recepcionado";
    }else if($estado == "Recepción de preparación del Material"){
        $estado = "dias_preparado";
    }else if($estado == "Cliente recibé los Materiales"){
        $estado = "ENTCLIENTE";
    }else if($estado == "Finalizado / Atentido"){
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
