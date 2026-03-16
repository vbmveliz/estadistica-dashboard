<?php 

require 'modelo_tabla_detalletest.php';

    $anio = $_POST['ano'];
    $filtro = $_POST['filtros'];

    // if($anio == "" || $anio == "2023" || $anio == 2023){
    //     $anio = "YEAR(CURDATE()) AND mes <= MONTH(CURDATE())";
    //     $MG = new Modelo_Grafico();
    //     $consulta = $MG -> TraerGeneralEstadoTabla($anio,$filtro);
    //     echo json_encode($consulta);
    // }else{
        $MG = new Modelo_Grafico();
        $consulta = $MG -> TraerGeneralEstadoTabla($anio,$filtro);
        echo json_encode($consulta);
    // }

?>
