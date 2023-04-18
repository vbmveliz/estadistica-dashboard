<?php 

require 'modelo_grafico.php';

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosLinealGeoquimica();
    echo json_encode($consulta);

?>