<?php 

require 'modelo_grafico.php';

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerGeneralEstadoTabla();
    /*echo "<pre>";
    var_dump($consulta);
    echo "</pre>";*/
    echo json_encode($consulta);

?>
