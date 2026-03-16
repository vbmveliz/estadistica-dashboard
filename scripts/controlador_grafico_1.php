<?php 

    require 'modelo_grafico.php';

    $sede=$_POST['sede'];
    $estado=$_POST['valueEstado'];
    $unidad=$_POST['valueUnidad'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFinal = $_POST['fechaFinal'];

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosGraficoBar($sede, $estado, $unidad, $fechaInicio, $fechaFinal);
    if(empty($consulta)){
        echo "error";
    }else{
        echo json_encode($consulta);
    }

?>
