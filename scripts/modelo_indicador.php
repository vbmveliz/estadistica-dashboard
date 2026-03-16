<?php

class Modelo_Grafico
{
    private $conexion;
    function __construct()
    {
        require_once('conexion_dbHullasoft.php');
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }

    function modeloPreparacionMateriales($p)
    {
        /**
        *
        *   TraerDatosDetalle($p)
        *
        *   @param 
        *   $p [ 
        *    'periodo',   
        *    'unidadNegocio',
        *    '',
        *    '',
        *    '',
        *    '',
        *    '',
        *    '',
        *    '',
        *   ]
        *
        */
        $sql = "	
        SELECT
        
                MES,
                CANTIDAD,
                (T1),
                (T2),
                (T3),
                (T4),
                ROUND((T1/ CANTIDAD)) AS R1,
                ROUND((T2/ CANTIDAD)) AS R2,
                ROUND((T3/ CANTIDAD)) AS R3,
                round( 
                    ROUND((T1/ CANTIDAD)) +
                    ROUND((T2/ CANTIDAD)) +
                    ROUND((T3/ CANTIDAD)) 
                ) AS R4 
        FROM
        (
                SELECT 
                        YEAR(fechaos) ANIO, 
                        MONTH(fechaos) MES, 
                        count(ordenservicio) CANTIDAD,
                        SUM( CASE WHEN F1 = 0 THEN 1 ELSE F1 END ) AS T1,
                        SUM( CASE WHEN F2 = 0 THEN 1 ELSE F2 END ) AS T2,
                        SUM( CASE WHEN F3 = 0 THEN 1 ELSE F3 END ) AS T3,
                        SUM( CASE WHEN F4 = 0 THEN 1 ELSE F4 END ) AS T4
                FROM
                (
                        SELECT 
                            CONCAT(t_orden_servicio.nos,'-',t_orden_servicio.periodo_os, '-',t_orden_servicio.version_os) ordenservicio,
                            t_orden_servicio.fecha fechaos, 																																					
                            STR_TO_DATE(CONCAT(fechasolicitud, ' ', horasolicitud), '%Y-%m-%d %H:%i:%s') fechaSolicitud_prepa, 
                            STR_TO_DATE(CONCAT(fechapreparacion, ' ', Horapreparacion), '%Y-%m-%d %H:%i:%s') fecha_programado_comercial,
                            Fecha_recepcion_solicitud fecha_recep_solic_preparacion, 																											
                            templeado.CNombre_Completo,
                            trecepcion_preparacion_cabe.Estado, 
                            cliente, 
                            Cliente_recojo_materiales Ejecutivo_Cliente_acerca_recoger_mat,
                            fecha_finpreparado, 																																								
                            STR_TO_DATE(CONCAT(fecha_recoger_materiales, ' ', hora_recoger_materiales), '%Y-%m-%d %H:%i:%s') Preparacicon_fecha_cliente_recoge_mat,		
                            (
                            SELECT 
                            IFNULL(COUNT(1),0)
                            FROM 
                            trecepcion_preparacion_deta dt
                            WHERE 
                            int_eliminar='1' 
                            AND dt.idpreparacion = trecepcion_preparacion_cabe.idpreparacion
                            ) cantmuestras,
                            tsucursales.descripcion, 
                            prioridad_atencion,
                            fecha_archivo_cargoentrega, 
                            t_unidades_negocio.descripcion unidadnegocio,
                            (
                            SELECT ttipoproducto.Cod_TipoProducto
                            FROM ttipoproducto, trecepcion_preparacion_grupo
                            WHERE ttipoproducto.CCodProd = trecepcion_preparacion_grupo.ccodprod AND 
                            trecepcion_preparacion_grupo.idpreparacion = trecepcion_preparacion_cabe.idpreparacion
                            LIMIT 1	
                            ) descripmatriz,	
                            if (tipo_servicio1='1','Monitoreo','Analisis') tiposervicio,
                            IF(cliente_asume_gastos_logistico='1','S','') clienteasumelosgastos, 
                            monitoreado_por, 
                            (
                            SELECT te.CNombre_Completo
                            FROM templeado te
                            WHERE 
                                CNroEmpleado = t_orden_servicio.ejecutivo
                            ) nomejecutivo,
                                
                                DATE(Fecha_recepcion_solicitud) C2_1,
                                DATE(t_orden_servicio.fecha) C1_1,
                                TIMESTAMPDIFF(DAY, DATE(t_orden_servicio.fecha) , DATE(Fecha_recepcion_solicitud) ) F1,
                                DATE(fecha_finpreparado) F2_C1,
                                DATE(Fecha_recepcion_solicitud) F2_C2,
                                TIMESTAMPDIFF(DAY, DATE(Fecha_recepcion_solicitud), DATE(fecha_finpreparado)  )  F2,
                                DATE(fecha_finpreparado) C2_3,
                                DATE(fecha_recoger_materiales) C1_3,
                                TIMESTAMPDIFF(DAY, DATE(fecha_finpreparado) , DATE(fecha_recoger_materiales))  F3,
                                DATE(fecha_finpreparado) C2_4,
                                DATE(fecha_recoger_materiales) C1_4,
                                TIMESTAMPDIFF(DAY, DATE(t_orden_servicio.fecha)  , DATE(fecha_recoger_materiales))  F4
                        FROM 
                            trecepcion_preparacion_cabe
                            LEFT JOIN t_orden_servicio ON trecepcion_preparacion_cabe.id_os = t_orden_servicio.id_os
                            LEFT JOIN tsucursales ON tsucursales.idtsucursales = t_orden_servicio.idsede
                            LEFT JOIN templeado ON CNroEmpleado = usuario_recepcion_solicitud
                            INNER JOIN t_unidades_negocio ON t_unidades_negocio.idunidad_n = t_orden_servicio.idunidad_n
                        WHERE 
                            IFNULL(trecepcion_preparacion_cabe.estado, '') <> '' 
                            AND t_orden_servicio.fecha IS NOT NULL
                            AND Fecha_recepcion_solicitud IS NOT NULL
                            AND STR_TO_DATE(CONCAT(fecha_recoger_materiales, ' ', hora_recoger_materiales), '%Y-%m-%d %H:%i:%s') IS NOT NULL
                            AND fecha_finpreparado IS NOT NULL
                            AND (Fecha_recepcion_solicitud - t_orden_servicio.fecha)  > 0
                            AND (fecha_finpreparado - Fecha_recepcion_solicitud)  > 0
                            AND (STR_TO_DATE(CONCAT(fecha_recoger_materiales, ' ', hora_recoger_materiales), '%Y-%m-%d %H:%i:%s') - fecha_finpreparado)  > 0
                            AND (STR_TO_DATE(CONCAT(fecha_recoger_materiales, ' ', hora_recoger_materiales), '%Y-%m-%d %H:%i:%s') - t_orden_servicio.fecha) > 0
                            AND tipo_servicio1 = 0
                            AND periodo_os = '$p[0]'
                            ORDER BY ordenservicio
                ) AS result
                GROUP BY ANIO, MES
                ORDER BY MES
				)
				AS PROMEDIO;";

        // return $sql;
        $arreglo = array();

        try {
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    $r = [];
                    $r[0] = $consulta_VU['MES'];
                    $r[1] = $consulta_VU['T1'];
                    $r[2] = $consulta_VU['T2'];
                    $r[3] = $consulta_VU['T3'];
                    $r[4] = $consulta_VU['T4'];

                    // $r[5] = ( (int) $r[1] - (int) $r[0] );
                    // $r[6] = ( (int) $r[2] - (int) $r[1] );
                    // $r[7] = ( (int) $r[3] - (int) $r[2] );
                    // $r[8] = ( (int) $r[4] - (int) $r[0] );

                    $r[5] = $consulta_VU['R1'];
                    $r[6] = $consulta_VU['R2'];
                    $r[7] = $consulta_VU['R3'];
                    $r[8] = $consulta_VU['R4'];
                    $r[9] = $consulta_VU['CANTIDAD'];

                    $arreglo[] = $r;
                }
                $this->conexion->cerrar();
                return $arreglo;
            }else{
                echo "Error de Conexion";
            }
        } catch (Exception $e) {
            echo "Error en la query: " . $e->getMessage();
            return 1;
        }

    }


}

// $valor = new Modelo_Grafico();

// $resultado = $valor->modeloPreparacionMateriales([2024]);

// var_dump($resultado);
