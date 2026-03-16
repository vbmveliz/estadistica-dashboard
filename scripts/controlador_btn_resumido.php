<?php 

require 'modelo_tabla_detalle.php';

    $anio = $_POST['anio'];
    $mes = $_POST['mes'];
    $dia = $_POST['dia'];

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosbtnAnioMesDiaResumido($anio, $mes, $dia);
    echo json_encode($consulta);
    

?>
