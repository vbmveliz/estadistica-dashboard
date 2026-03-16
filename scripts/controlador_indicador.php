<?php

    require 'modelo_indicador.php';

    if( isset($_POST['function']) ){
        
        if( $_POST['function'] == 'graficoPreparacionMetales' ){
            if( isset($_POST['fecha']) && isset($_POST['filtros']) ){
                $valor = new Modelo_Grafico();
                $resultado = $valor->modeloPreparacionMateriales([$_POST['fecha'], $_POST['filtros']]);
                echo json_encode($resultado);
            }
        }

    }
    
    
    
    ?>
