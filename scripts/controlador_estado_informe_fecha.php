<?php 

require 'modelo_grafico.php';

    $fechaInicio = $_POST['fechaInicio'];
    $fechaFinal = $_POST['fechaFinal'];
    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerestadoInforme($fechaInicio, $fechaFinal);
    echo json_encode($consulta);

    
?>
