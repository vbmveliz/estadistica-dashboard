<?php 

require 'modelo_grafico.php';

    $dia = $_POST['dia'];
    $unidad = $_POST['unidad'];
    $tipo = $_POST['tipo'];
    $rango = $_POST['rango'];

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosLinealDiaInforme($dia,$unidad,$tipo,$rango);
    echo json_encode($consulta);

?>
