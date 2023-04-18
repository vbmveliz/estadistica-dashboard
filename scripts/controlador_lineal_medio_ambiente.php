<?php 

require 'modelo_grafico.php';

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosLinealMedioAmbiente();
    echo json_encode($consulta);

?>