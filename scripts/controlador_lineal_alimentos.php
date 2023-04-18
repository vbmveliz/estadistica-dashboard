<?php 

require 'modelo_grafico.php';

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosLinealAlimentos();
    echo json_encode($consulta);

?>