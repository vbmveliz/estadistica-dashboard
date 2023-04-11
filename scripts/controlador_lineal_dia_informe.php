<?php 

require 'modelo_grafico.php';

    $dia = $_POST['dia'];

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosLinealDiaInforme($dia);
    echo json_encode($consulta);

?>