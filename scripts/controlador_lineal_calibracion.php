<?php 

require 'modelo_grafico.php';

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosLinealCalibracion();
    echo json_encode($consulta);

?>