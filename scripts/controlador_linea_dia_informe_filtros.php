<?php 

require 'modelo_grafico.php';

    $dia = $_POST['diaFiltro'];
    $tecnica = $_POST['valueTecnicas'];
    $laboratorio = $_POST['valueLaboratorio'];

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosLinealDiaInformeFiltros($dia,$tecnica,$laboratorio);
    echo json_encode($consulta);

?>
