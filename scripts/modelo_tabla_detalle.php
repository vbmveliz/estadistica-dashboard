<?php

class Modelo_Grafico
{
    private $conexion;
    function __construct()
    {
        require_once('conexion_HullasoftVisor.php');
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }

    function TraerDatosDetalle($dia, $estado)
    {
        $sql = "SELECT * FROM listado_0001_estados_de_las_os WHERE $estado = $dia ORDER BY $estado";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function TraerDatosGraficobar2($valueEstadoOs)
    {
        $sql = "SELECT * FROM cuadro_0001_estados_de_las_os";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                if ($consulta_VU[2] == $valueEstadoOs) {
                    $arreglo[] = $consulta_VU;
                }
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function TraerDatosGraficobar2_1($valueEstadoOs)
    {
        $sql = "SELECT $valueEstadoOs,informes_pendiente,informes_resultado FROM listado_0001_estados_de_las_os WHERE $valueEstadoOs";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    // function TraerGeneralEstado($ano,$filtro)
    // {
    //     $sql = "SELECT
    //                 mes,
    //                 c1_capacidad_atencion,
    //                 c1_ie_dias_capacidad_atencion,
    //                 ROUND(c1_ie_dias_capacidad_atencion / c1_capacidad_atencion) AS porcen_capacidad_atencion,
    //                 c2_dias_recepcionsolicitud,
    //                 c2_ie_dias_recepcionsolicitud,
    //                 ROUND(c2_ie_dias_recepcionsolicitud / c2_dias_recepcionsolicitud) AS porcen_recepcionsolicitud,
    //                 c3_Ie_dias_dias_solicitudLaboratorio,
    //                 c3_dias_solicitudLaboratorio,
    //                 ROUND(c3_Ie_dias_dias_solicitudLaboratorio / c3_dias_solicitudLaboratorio) AS porcen_solicitudLaboratorio,
    //                 c4_ie_dias_emision_ie,
    //                 c4_dias_emision_ie,
    //                 ROUND(c4_ie_dias_emision_ie / c4_dias_emision_ie, 2) AS porcen_dias_emision_ie,
    //                 c5_Ie_Dias_SolicitudRecepcion,
    //                 c5_Dias_SolicitudRecepcion,
    //                 ROUND(c5_Ie_Dias_SolicitudRecepcion / c5_Dias_SolicitudRecepcion, 2) AS porcen_Dias_SolicitudRecepcion,
    //                 anyo
    //             FROM
    //                 (
    //                     SELECT
    //                         mes,
    //                         anyo,
    //                         SUM(c1_capacidad_atencion) AS c1_capacidad_atencion,
    //                         SUM(c1_ie_dias_capacidad_atencion) AS c1_ie_dias_capacidad_atencion,
    //                         SUM(c2_dias_recepcionsolicitud) AS c2_dias_recepcionsolicitud,
    //                         SUM(c2_ie_dias_recepcionsolicitud) AS c2_ie_dias_recepcionsolicitud,
    //                         SUM(c3_dias_solicitudLaboratorio) AS c3_dias_solicitudLaboratorio,
    //                         SUM(c3_Ie_dias_dias_solicitudLaboratorio) AS c3_Ie_dias_dias_solicitudLaboratorio,
    //                         SUM(c4_dias_emision_ie) AS c4_dias_emision_ie,
    //                         SUM(c4_ie_dias_emision_ie) AS c4_ie_dias_emision_ie,
    //                         SUM(c5_Dias_SolicitudRecepcion) AS c5_Dias_SolicitudRecepcion,
    //                         SUM(c5_Ie_Dias_SolicitudRecepcion) AS c5_Ie_Dias_SolicitudRecepcion
    //                     FROM
    //                         cuadro_00002_seguimientoinformes
    //                     WHERE
    //                         anyo = $ano
                            
    //                     GROUP BY
    //                         mes, anyo
    //                 ) AS listado
    //             ORDER BY
    //                 CAST(mes AS INTEGER);
                
    //                     ";
    //     $arreglo = array();
    //     if ($consulta = $this->conexion->conexion->query($sql)) {
    //         while ($consulta_VU = mysqli_fetch_array($consulta)) {
    //             $arreglo[] = $consulta_VU;
    //         }
    //         return $arreglo;
    //         $this->conexion->cerrar();
    //     }
    // }

    function TraerGeneralEstado($ano,$filtro)
    {
/*
            $filtro[0],     //          sede
            $filtro[1],     //          area
            $filtro[2],     //          muestreo
            $filtro[3],     //          unidadNegocio
            $filtro[4]      //          cliente
*/
            $filtros = "";

            if($filtro[0] != 'all'){    //  sede
                $filtros .= "AND sede = '$filtro[0]' ";
            }
            if($filtro[1] != 'all'){    //  area
                $filtros .= "AND ( ";
                $nn = 0;
                foreach ($filtro[1] as $k => $v) {
                    if($nn > 0){
                        $filtros .= "OR ";
                    }
                    $filtros .= " AREA LIKE '%$v%' ";
                    $nn += 1;
                }
                $filtros .= " ) ";
            }
            if($filtro[2] != 'all'){    //  muestreo
                if($filtro[2] == "Realizado por Hullasoft (**)"){
                    $filtros .= "AND muestreo = 'Realizado por Hullasoft (**)' ";
                }else{
                    $filtros .= "AND muestreo != 'Realizado por Hullasoft (**)' ";
                }
            }
            if($filtro[3] != 'all'){    //  unidadNegocio
                $filtros .= "AND unidadNegocio LIKE '$filtro[3]%' ";
            }
            if($filtro[4] != 'all'){    //  cliente
                $filtros .= "AND cliente = '$filtro[4]' ";
            }
        
        // echo $filtros;
        // return $filtros;

        $sql = "SELECT 
                MES,
                round( Informe_Laboratorio + Pre_Informe_Laboratorio + Informe_Recep_Muestra ) Capacidad_De_Atencion_Del_Servicio,
                ROUND( Informe_Laboratorio ) Informe_Laboratorio,
                ROUND( Pre_Informe_Laboratorio ) Pre_Informe_Laboratorio,
                ROUND( Informe_Recep_Muestra ) Informe_Recep_Muestra,
                round( Recepcion_Muestra ) Recepcion_Muestra

                FROM (
                            
                            SELECT 
                                MES,
                                Capacidad_De_Atencion_Del_Servicio,
                                (Capacidad_De_Atencion_Del_Servicio / Informe_Laboratorio) Informe_Laboratorio,
                                (Capacidad_De_Atencion_Del_Servicio / Pre_Informe_Laboratorio) Pre_Informe_Laboratorio,
                                (Capacidad_De_Atencion_Del_Servicio / Informe_Recep_Muestra) Informe_Recep_Muestra,
                                (Capacidad_De_Atencion_Del_Servicio / Recepcion_Muestra) Recepcion_Muestra
                            FROM (
                            
                                            
                                            SELECT 
                                            ANIO, 
                                            MES,
                                            #DIA, 
                                            #COUNT(ncertificado) nc,
                                            SUM(IF(Capacidad_De_Atencion_Del_Servicio  = 0, 1, Capacidad_De_Atencion_Del_Servicio ) ) Capacidad_De_Atencion_Del_Servicio, 
                                            SUM(IF(Informe_Laboratorio  = 0, 1, Informe_Laboratorio ) ) Informe_Laboratorio, 
                                            SUM(IF( Pre_Informe_Laboratorio = 0, 1,Pre_Informe_Laboratorio  ) ) Pre_Informe_Laboratorio, 
                                            SUM(IF( Informe_Recep_Muestra = 0, 1, Informe_Recep_Muestra ) ) Informe_Recep_Muestra, 
                                            SUM(IF( Recepcion_Muestra = 0, 1,Recepcion_Muestra  ) ) Recepcion_Muestra
                                            FROM (
                                                        
														SELECT 
                                                        YEAR(main.fecha_rec) ANIO, 
                                                        MONTH(main.fecha_rec) MES, 
                                                        DAY(main.fecha_rec) DIA,
																		  main.fecha_rec,
                                                        main.fecha_reg_pdf,
                                                        main.FechActPed,
                                                        main.FechaHasta_ht,
                                                        main.Conforme_preinforme_fecha, 
--                                                        AREA,
		
																		(SELECT 
																			GROUP_CONCAT(DISTINCT a.CDesArea SEPARATOR ',') AS AREA
																		FROM 
																			db_Hullasoft.tpedidos p
																			LEFT JOIN db_Hullasoft.tcodigo_laboratorio_detalle cld ON p.IdPedidos = cld.idpedidos
																			LEFT JOIN db_Hullasoft.tmetodo m ON cld.id_metodo = m.CCodMetodo
																			LEFT JOIN db_Hullasoft.tarea a ON m.ccodarea = a.CCodArea
																		WHERE 
																			NCertificado =	 main.ncertificado
																			
																		--	NCertificado = 'IE-23-4098'
																		)	AS AREA,
																			
                                                        main.muestreo,
                                                        main.sede, 
                                                        main.cliente,
                                                        main.unidadNegocio, 
                                                        main.ncertificado, 
                                                        COALESCE(DATEDIFF(main.Conforme_preinforme_fecha, main.fecha_rec), 0) AS Capacidad_De_Atencion_Del_Servicio, 
                                                        COALESCE(DATEDIFF(main.FechaHasta_ht, main.FechActPed), 0) AS Informe_Laboratorio, 
                                                        COALESCE(DATEDIFF(main.Conforme_preinforme_fecha, main.FechaHasta_ht), 0) AS Pre_Informe_Laboratorio, 
                                                        COALESCE(DATEDIFF(main.FechActPed, main.fecha_rec), 0) AS Informe_Recep_Muestra, 
                                                        COALESCE(DATEDIFF(main.fecha_reg_pdf,main.fecha_rec),0) AS Recepcion_Muestra
                                                        FROM detalle_cuadro_00002final main
                                                        WHERE YEAR(main.fecha_rec) = $ano
                                                        --
                                                        
                                                        
                                                        $filtros

                                                        
                                                        --
                                                        --
                                                        AND main.fecha_rec IS NOT NULL 
                                                        AND main.Conforme_preinforme_fecha IS NOT NULL 
                                                        AND main.FechaHasta_ht IS NOT NULL 
                                                        AND main.fecha_reg_pdf IS NOT NULL 
                                                        AND main.FechActPed IS NOT NULL 
                                                        -- AND a.grupolaboratorio IN ('MAM','GEO','AGR','ALI');
                                                        AND (
                                                            DATE_FORMAT(main.Conforme_preinforme_fecha, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') 
                                                            OR DATE(main.Conforme_preinforme_fecha) != '0000-00-00') 
                                                            AND (DATE_FORMAT(main.FechaHasta_ht, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') 
                                                            OR DATE(main.FechaHasta_ht) != '0000-00-00') 
                                                            AND (DATE_FORMAT(main.fecha_reg_pdf, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') 
                                                            OR DATE(main.fecha_reg_pdf) != '0000-00-00') 
                                                            AND (DATE_FORMAT(main.FechActPed, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') 
                                                            OR DATE(main.FechActPed) != '0000-00-00') 
                                                            AND (DATE_FORMAT(main.fecha_rec, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') 
                                                            OR DATE(main.fecha_rec) != '0000-00-00')
                                                        ORDER BY mes 

                                            ) AS Count_CD
                                            GROUP BY 
                                            ANIO,MES
                                            ORDER BY ANIO, MES
                                            #, DIA
                            ) AS LIMITE 
                            GROUP BY MES
                ) AS FINAL
                GROUP BY MES";

        // var_dump($filtros);
        // var_dump($sql);

        // return 0;
        $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }else{
                return $sql;
            }
    }


    function tituloEstadoGrafico($year,$filtro)
    {

        $filtros = "";

        if($filtro[0] != 'all'){    //  sede
            $filtros .= "AND sede = '$filtro[0]' ";
        }
        if($filtro[1] != 'all'){    //  area
            $filtros .= "AND ( ";
            $nn = 0;
            foreach ($filtro[1] as $k => $v) {
                if($nn > 0){
                    $filtros .= "OR ";
                }
                $filtros .= " AREA LIKE '%$v%' ";
                $nn += 1;
            }
            $filtros .= " ) ";
        }
        if($filtro[2] != 'all'){    //  muestreo
            if($filtro[2] == "Realizado por Hullasoft (**)"){
                $filtros .= "AND muestreo = 'Realizado por Hullasoft (**)' ";
            }else{
                $filtros .= "AND muestreo != 'Realizado por Hullasoft (**)' ";
            }
        }
        if($filtro[3] != 'all'){    //  unidadNegocio
            $filtros .= "AND unidadNegocio = '$filtro[3]' ";
        }
        if($filtro[4] != 'all'){    //  cliente
            $filtros .= "AND cliente = '$filtro[4]' ";
        }

        $sql = "
        
SELECT 
MES,
round( Informe_Laboratorio + Pre_Informe_Laboratorio + Informe_Recep_Muestra ) Capacidad_De_Atencion_Del_Servicio,
ROUND( Informe_Laboratorio ) Informe_Laboratorio,
ROUND( Pre_Informe_Laboratorio ) Pre_Informe_Laboratorio,
ROUND( Informe_Recep_Muestra ) Informe_Recep_Muestra,
round( Recepcion_Muestra ) Recepcion_Muestra

FROM (
            
            SELECT 
                MES,
                Capacidad_De_Atencion_Del_Servicio,
                (Capacidad_De_Atencion_Del_Servicio / Informe_Laboratorio) Informe_Laboratorio,
                (Capacidad_De_Atencion_Del_Servicio / Pre_Informe_Laboratorio) Pre_Informe_Laboratorio,
                (Capacidad_De_Atencion_Del_Servicio / Informe_Recep_Muestra) Informe_Recep_Muestra,
                (Capacidad_De_Atencion_Del_Servicio / Recepcion_Muestra) Recepcion_Muestra
            FROM (
            
                            
                            SELECT 
                            ANIO, 
                            MES,
                            #DIA, 
                            #COUNT(ncertificado) nc,
                            SUM(IF(Capacidad_De_Atencion_Del_Servicio  = 0, 1, Capacidad_De_Atencion_Del_Servicio ) ) Capacidad_De_Atencion_Del_Servicio, 
                            SUM(IF(Informe_Laboratorio  = 0, 1, Informe_Laboratorio ) ) Informe_Laboratorio, 
                            SUM(IF( Pre_Informe_Laboratorio = 0, 1,Pre_Informe_Laboratorio  ) ) Pre_Informe_Laboratorio, 
                            SUM(IF( Informe_Recep_Muestra = 0, 1, Informe_Recep_Muestra ) ) Informe_Recep_Muestra, 
                            SUM(IF( Recepcion_Muestra = 0, 1,Recepcion_Muestra  ) ) Recepcion_Muestra
                            FROM (
                                        SELECT 
                                        YEAR(fecha_rec) 
                                        ANIO, 
                                        MONTH(fecha_rec) 
                                        MES, 
                                        DAY(fecha_rec) 
                                        DIA,fecha_rec,
                                        fecha_reg_pdf,
                                        FechActPed,
                                        FechaHasta_ht,
                                        Conforme_preinforme_fecha, 
                                        AREA,
                                        muestreo,
                                        sede, 
                                        cliente,
                                        unidadNegocio, 
                                        ncertificado, 
                                        COALESCE(DATEDIFF(Conforme_preinforme_fecha, fecha_rec), 0) AS Capacidad_De_Atencion_Del_Servicio, 
                                        COALESCE(DATEDIFF(FechaHasta_ht, FechActPed), 0) AS Informe_Laboratorio, 
                                        COALESCE(DATEDIFF(Conforme_preinforme_fecha, FechaHasta_ht), 0) AS Pre_Informe_Laboratorio, 
                                        COALESCE(DATEDIFF(FechActPed, fecha_rec), 0) AS Informe_Recep_Muestra, 
                                        COALESCE(DATEDIFF(fecha_reg_pdf,fecha_rec),0) AS Recepcion_Muestra
                                        FROM detalle_cuadro_00002final
                                        WHERE YEAR(fecha_rec) = $year
                                        $filtros
                                        AND fecha_rec IS NOT NULL AND Conforme_preinforme_fecha IS NOT NULL AND FechaHasta_ht IS NOT NULL AND fecha_reg_pdf IS NOT NULL AND FechActPed IS NOT NULL AND (DATE_FORMAT(Conforme_preinforme_fecha, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(Conforme_preinforme_fecha) != '0000-00-00') AND (DATE_FORMAT(FechaHasta_ht, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(FechaHasta_ht) != '0000-00-00') AND (DATE_FORMAT(fecha_reg_pdf, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(fecha_reg_pdf) != '0000-00-00') AND (DATE_FORMAT(FechActPed, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(FechActPed) != '0000-00-00') AND (DATE_FORMAT(fecha_rec, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(fecha_rec) != '0000-00-00')
                                        ORDER BY mes 
                            ) AS Count_CD
                            GROUP BY 
                            ANIO,MES
                            ORDER BY ANIO, MES
                            #, DIA
            ) AS LIMITE 
            GROUP BY MES
) AS FINAL
GROUP BY MES
";

        $sql1 = " SELECT      
        MES,
        c1_capacidad_atencion,
        c1_ie_dias_capacidad_atencion,
        (
           round(ccc1 / ccc2 ) + 
           round(ccc1 / ccc3) + 
           round(ccc1 / ccc4 )) porcen_capacidad_atencion,
        c2_dias_recepcionsolicitud,
        c2_ie_dias_recepcionsolicitud,
        (round( ccc1 / ccc2 ) ) porcen_recepcionsolicitud,
        c3_dias_solicitudLaboratorio,
        c3_Ie_dias_dias_solicitudLaboratorio,
        (round( ccc1 / ccc3 ) ) porcen_solicitudLaboratorio,
        c4_dias_emision_ie,
        c4_ie_dias_emision_ie,
        (round( ccc1 / ccc4 ) ) porcen_dias_emision_ie,
        c5_dias_emision_ie,
        c5_ie_dias_recepcion_muestras,
        (round( ccc1 / ccc5  ) ) porcen_Dias_SolicitudRecepcion
        FROM (
                        SELECT
                        MES,
                        SUM( Capacidad_De_Atencion_Del_Servicio) c1_capacidad_atencion,
                        SUM(cc1) c1_ie_dias_capacidad_atencion,
                        (SUM(Capacidad_De_Atencion_Del_Servicio) + SUM(cc1)) ccc1,
                        
                        SUM(Informe_Laboratorio) c2_dias_recepcionsolicitud,
                        SUM(cc2) c2_ie_dias_recepcionsolicitud,
                        (SUM(Informe_Laboratorio) + SUM(cc2)) ccc2,
                        
                        SUM(Pre_Informe_Laboratorio) c3_dias_solicitudLaboratorio,
                        SUM(cc3) c3_Ie_dias_dias_solicitudLaboratorio,
                        (SUM(Pre_Informe_Laboratorio) + SUM(cc3)) ccc3,
                        
                        SUM(Informe_Recep_Muestra) c4_dias_emision_ie,
                        SUM(cc4) c4_ie_dias_emision_ie,
                        (SUM(Informe_Recep_Muestra) + SUM(cc4)) ccc4,
                        
                        SUM(Recepcion_Muestra) c5_dias_emision_ie,
                        SUM(cc5) c5_ie_dias_recepcion_muestras,
                        (SUM(Recepcion_Muestra) + SUM(cc5)) ccc5
                        FROM (
                                    SELECT 
                                    ANIO, MES, DIA,Capacidad_De_Atencion_Del_Servicio, (Capacidad_De_Atencion_Del_Servicio * DIA) cc1,
                                    Informe_Laboratorio, (Informe_Laboratorio * DIA) cc2,
                                    Pre_Informe_Laboratorio, (Pre_Informe_Laboratorio * DIA) cc3,
                                    Informe_Recep_Muestra, (Informe_Recep_Muestra * DIA) cc4,
                                    Recepcion_Muestra, (Recepcion_Muestra * DIA) cc5
                                    FROM
                                    (
                                                    SELECT 
                                                    ANIO, 
                                                    MES,
                                                    DIA, 
                                                    SUM(IF(Capacidad_De_Atencion_Del_Servicio  = 0, 1, Capacidad_De_Atencion_Del_Servicio ) ) Capacidad_De_Atencion_Del_Servicio, 
                                                    SUM(IF(Informe_Laboratorio  = 0, 1, Informe_Laboratorio ) ) Informe_Laboratorio, 
                                                    SUM(IF( Pre_Informe_Laboratorio = 0, 1,Pre_Informe_Laboratorio  ) ) Pre_Informe_Laboratorio, 
                                                    SUM(IF( Informe_Recep_Muestra = 0, 1, Informe_Recep_Muestra ) ) Informe_Recep_Muestra, 
                                                    SUM(IF( Recepcion_Muestra = 0, 1,Recepcion_Muestra  ) ) Recepcion_Muestra
                                                    FROM (
                                                                SELECT 
                                                                YEAR(fecha_rec) 
                                                                ANIO, 
                                                                MONTH(fecha_rec) 
                                                                MES, 
                                                                DAY(fecha_rec) 
                                                                DIA,fecha_rec,
                                                                fecha_reg_pdf,
                                                                FechActPed,
                                                                FechaHasta_ht,
                                                                Conforme_preinforme_fecha, 
                                                                AREA,
                                                                muestreo,
                                                                sede, 
                                                                cliente,
                                                                unidadNegocio, 
                                                                ncertificado, 
                                                                COALESCE(DATEDIFF(Conforme_preinforme_fecha, fecha_rec), 0) AS Capacidad_De_Atencion_Del_Servicio, 
                                                                COALESCE(DATEDIFF(FechaHasta_ht, FechActPed), 0) AS Informe_Laboratorio, 
                                                                COALESCE(DATEDIFF(Conforme_preinforme_fecha, FechaHasta_ht), 0) AS Pre_Informe_Laboratorio, 
                                                                COALESCE(DATEDIFF(FechActPed, fecha_rec), 0) AS Informe_Recep_Muestra, 
                                                                COALESCE(DATEDIFF(fecha_reg_pdf,fecha_rec),0) AS Recepcion_Muestra
                                                                FROM detalle_cuadro_00002final
                                                                WHERE YEAR(fecha_rec) = $year
                                                                $filtros
                                                                AND fecha_rec IS NOT NULL AND Conforme_preinforme_fecha IS NOT NULL AND FechaHasta_ht IS NOT NULL AND fecha_reg_pdf IS NOT NULL AND FechActPed IS NOT NULL AND (DATE_FORMAT(Conforme_preinforme_fecha, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(Conforme_preinforme_fecha) != '0000-00-00') AND (DATE_FORMAT(FechaHasta_ht, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(FechaHasta_ht) != '0000-00-00') AND (DATE_FORMAT(fecha_reg_pdf, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(fecha_reg_pdf) != '0000-00-00') AND (DATE_FORMAT(FechActPed, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(FechActPed) != '0000-00-00') AND (DATE_FORMAT(fecha_rec, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(fecha_rec) != '0000-00-00')
                                                                ORDER BY mes 
                                                    ) AS Count_CD
                                                    GROUP BY 
                                                    Capacidad_De_Atencion_Del_Servicio,ANIO,MES
                                                    ORDER BY ANIO, MES, DIA
                                    ) AS Final
                                    GROUP BY ANIO, MES, DIA
                                    ORDER BY ANIO, MES, DIA
                        ) AS LIMITE
                        GROUP BY ANIO, MES
        ORDER BY ANIO, MES
        ) AS grafico
        
        ";

        // $sql2 = "
        // SELECT 
			
        // MAX(porcen_capacidad_atencion),
        // MAX(porcen_recepcionsolicitud),
        // MAX(porcen_solicitudLaboratorio),
        // MAX(porcen_dias_emision_ie),
        // MAX(porcen_Dias_SolicitudRecepcion),
        // MIN(porcen_capacidad_atencion),
        // MIN(porcen_recepcionsolicitud),
        // MIN(porcen_solicitudLaboratorio),
        // MIN(porcen_dias_emision_ie),
        // MIN(porcen_Dias_SolicitudRecepcion)
        
                
        // FROM
        //         (
        //             SELECT 
        //             MES,
        //         c1_capacidad_atencion,
        //         c1_ie_dias_capacidad_atencion,
        //         (
        //             round(ccc1 / ccc2 ) + 
        //             round(ccc1 / ccc3) + 
        //             round(ccc1 / ccc4, 2 )) porcen_capacidad_atencion,
        //         c2_dias_recepcionsolicitud,
        //         c2_ie_dias_recepcionsolicitud,
        //         (round( ccc1 / ccc2 ) ) porcen_recepcionsolicitud,
        //         c3_dias_solicitudLaboratorio,
        //         c3_Ie_dias_dias_solicitudLaboratorio,
        //         (round( ccc1 / ccc3 ) ) porcen_solicitudLaboratorio,
        //         c4_dias_emision_ie,
        //         c4_ie_dias_emision_ie,
        //         (round( ccc1 / ccc4, 2 ) ) porcen_dias_emision_ie,
        //         c5_dias_emision_ie,
        //         c5_ie_dias_recepcion_muestras,
        //         (round( ccc1 / ccc5 ,2 ) ) porcen_Dias_SolicitudRecepcion
        //         FROM (
        //             SELECT
        //             MES,
        //             SUM(Capacidad_De_Atencion_Del_Servicio) c1_capacidad_atencion,
        //             SUM(cc1) c1_ie_dias_capacidad_atencion,
        //             (SUM(Capacidad_De_Atencion_Del_Servicio) + SUM(cc1)) ccc1,
        //             SUM(Informe_Recep_Muestra) c2_dias_recepcionsolicitud,
        //             SUM(cc2) c2_ie_dias_recepcionsolicitud,
        //             (SUM(Informe_Recep_Muestra) + SUM(cc2)) ccc2,
        //             SUM(Informe_Laboratorio) c3_dias_solicitudLaboratorio,
        //             SUM(cc3) c3_Ie_dias_dias_solicitudLaboratorio,
        //             (SUM(Informe_Laboratorio) + SUM(cc3)) ccc3,
        //             SUM(Pre_Informe_Laboratorio) c4_dias_emision_ie,
        //             SUM(cc4) c4_ie_dias_emision_ie,
        //             (SUM(Pre_Informe_Laboratorio) + SUM(cc4)) ccc4,
        //             SUM(Recepcion_Muestra) c5_dias_emision_ie,
        //             SUM(cc5) c5_ie_dias_recepcion_muestras,
        //             (SUM(Recepcion_Muestra) + SUM(cc5)) ccc5
        //             FROM (
        //                           SELECT 
        //                           ANIO, MES, DIA,Capacidad_De_Atencion_Del_Servicio, (Capacidad_De_Atencion_Del_Servicio * DIA) cc1,
        //                           Informe_Recep_Muestra, (Informe_Recep_Muestra * DIA) cc2,
        //                           Informe_Laboratorio, (Informe_Laboratorio * DIA) cc3,
        //                           Pre_Informe_Laboratorio, (Pre_Informe_Laboratorio * DIA) cc4,
        //                           Recepcion_Muestra, (Recepcion_Muestra * DIA) cc5
        //                           FROM
        //                           (
        //                              SELECT 
        //                              ANIO, MES,
        //                              DIA, SUM(Capacidad_De_Atencion_Del_Servicio) Capacidad_De_Atencion_Del_Servicio, SUM(Informe_Laboratorio) Informe_Laboratorio, SUM(Pre_Informe_Laboratorio) Pre_Informe_Laboratorio, SUM(Informe_Recep_Muestra) Informe_Recep_Muestra, SUM(Recepcion_Muestra) Recepcion_Muestra
        //                              FROM (
        //                                 SELECT YEAR(fecha_rec) ANIO, MONTH(fecha_rec) MES, DAY(fecha_rec) DIA,fecha_rec,
        //                                 fecha_reg_pdf,FechActPed,FechaHasta_ht,Conforme_preinforme_fecha, AREA,
        //                                 muestreo,sede, cliente,unidadNegocio, ncertificado, COALESCE(DATEDIFF(Conforme_preinforme_fecha, fecha_rec), 0) AS Capacidad_De_Atencion_Del_Servicio, COALESCE(DATEDIFF(FechaHasta_ht, FechActPed), 0) AS Informe_Laboratorio, COALESCE(DATEDIFF(Conforme_preinforme_fecha, FechaHasta_ht), 0) AS Pre_Informe_Laboratorio, COALESCE(DATEDIFF(FechActPed, fecha_rec), 0) AS Informe_Recep_Muestra, COALESCE(DATEDIFF(fecha_reg_pdf,fecha_rec),0) AS Recepcion_Muestra
        //                                 FROM detalle_cuadro_00002final
        //                                 WHERE YEAR(fecha_rec) = $year 
        //                                 $filtros
        //                                 AND fecha_rec IS NOT NULL AND Conforme_preinforme_fecha IS NOT NULL AND FechaHasta_ht IS NOT NULL AND fecha_reg_pdf IS NOT NULL AND FechActPed IS NOT NULL AND (DATE_FORMAT(Conforme_preinforme_fecha, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(Conforme_preinforme_fecha) != '0000-00-00') AND (DATE_FORMAT(FechaHasta_ht, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(FechaHasta_ht) != '0000-00-00') AND (DATE_FORMAT(fecha_reg_pdf, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(fecha_reg_pdf) != '0000-00-00') AND (DATE_FORMAT(FechActPed, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(FechActPed) != '0000-00-00') AND (DATE_FORMAT(fecha_rec, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(fecha_rec) != '0000-00-00')
        //                                 ORDER BY mes 
        //                              ) AS Count_CD
        //                              GROUP BY 
        //                              Capacidad_De_Atencion_Del_Servicio,ANIO,MES
        //                              ORDER BY ANIO, MES, DIA
        //                      ) AS Final
        //                      GROUP BY ANIO, MES, DIA
        //                      ORDER BY ANIO, MES, DIA
        //                 ) AS LIMITE
        //         GROUP BY ANIO, MES
        //         ORDER BY ANIO, MES
        //         ) AS grafico
        //     ) AS MAXMIN
        //     ";
        
        // $sql1 = "		
        //     SELECT 
            
        //         MAX(porcen_capacidad_atencion) porcen_capacidad_atencion,
        //         MAX(porcen_recepcionsolicitud) porcen_recepcionsolicitud,
        //         MAX(porcen_solicitudLaboratorio) porcen_solicitudLaboratorio,
        //         MAX(porcen_dias_emision_ie) porcen_dias_emision_ie,
        //         MAX(porcen_Dias_SolicitudRecepcion) porcen_Dias_SolicitudRecepcion,
        //         MIN(porcen_capacidad_atencion) porcen_capacidad_atencion,
        //         MIN(porcen_recepcionsolicitud) porcen_recepcionsolicitud,
        //         MIN(porcen_solicitudLaboratorio) porcen_solicitudLaboratorio,
        //         MIN(porcen_dias_emision_ie) porcen_dias_emision_ie,
        //         MIN(porcen_Dias_SolicitudRecepcion) porcen_Dias_SolicitudRecepcion
                
            
        //     FROM
                        
                        
        //         (
                        
        
        // SELECT 
        //                 MES,
        //                 SUM(Capacidad_De_Atencion_Del_Servicio) c1_capacidad_atencion,
        //                 SUM(cc1) c1_ie_dias_capacidad_atencion,
        //                 ROUND(SUM(cc1)/SUM(Informe_Recep_Muestra),2) porcen_capacidad_atencion,
                        
        //                 SUM(Informe_Recep_Muestra) c2_dias_recepcionsolicitud,
        //                 SUM(cc2) c2_ie_dias_recepcionsolicitud,
        //                 ROUND(SUM(cc2)/SUM(Informe_Recep_Muestra),2) porcen_recepcionsolicitud,
                        
        //                 SUM(Informe_Laboratorio) c3_Ie_dias_dias_solicitudLaboratorio,
        //                 SUM(cc3) c3_dias_solicitudLaboratorio,
        //                 ROUND(SUM(cc3)/SUM(Informe_Laboratorio),2) porcen_solicitudLaboratorio,
                        
        //                 SUM(Pre_Informe_Laboratorio) c4_ie_dias_emision_ie,
        //                 SUM(cc4) c4_dias_emision_ie,
        //                 ROUND(SUM(cc4)/SUM(Pre_Informe_Laboratorio),2) porcen_dias_emision_ie ,
                        
        //                 SUM(Recepcion_Muestra) c5_ie_dias_recepcion_muestras,
        //                 SUM(cc5) c5_dias_emision_ie,
        //                 ROUND(SUM(cc5)/SUM(Recepcion_Muestra),2) porcen_Dias_SolicitudRecepcion 
                        
                        
        //                 FROM
        //                 (	
        //                     SELECT 
        //                             ANIO, MES, DIA,Capacidad_De_Atencion_Del_Servicio  , (Capacidad_De_Atencion_Del_Servicio * DIA) cc1,
        //                             Informe_Recep_Muestra  ,  (Informe_Recep_Muestra * DIA) cc2,
        //                             Informe_Laboratorio  , (Informe_Laboratorio * DIA) cc3,
        //                                 Pre_Informe_Laboratorio  , (Pre_Informe_Laboratorio * DIA) cc4 ,
        //                                 Recepcion_Muestra, (Recepcion_Muestra * DIA) cc5
        //                     FROM
        //                         (
        //                                             SELECT 
        //                                             ANIO, MES,
        //                                             DIA,
        //                                             SUM(Capacidad_De_Atencion_Del_Servicio) Capacidad_De_Atencion_Del_Servicio, 
        //                                             SUM(Informe_Laboratorio) Informe_Laboratorio, 
        //                                             SUM(Pre_Informe_Laboratorio) Pre_Informe_Laboratorio, 
        //                                             SUM(Informe_Recep_Muestra) Informe_Recep_Muestra,
        //                                             SUM(Recepcion_Muestra) Recepcion_Muestra
        //                                             FROM (
        //                                                     SELECT YEAR(fecha_rec) ANIO, MONTH(fecha_rec) MES, DAY(fecha_rec) DIA,fecha_rec,
        //                                                     fecha_reg_pdf,FechActPed,FechaHasta_ht,Conforme_preinforme_fecha, AREA,
        //                                                     muestreo,sede, cliente,unidadNegocio, ncertificado,
        //                                                     COALESCE(DATEDIFF(Conforme_preinforme_fecha, fecha_rec), 0) AS Capacidad_De_Atencion_Del_Servicio, 
        //                                                     COALESCE(DATEDIFF(FechaHasta_ht, FechActPed), 0) AS Informe_Laboratorio, 
        //                                                     COALESCE(DATEDIFF(Conforme_preinforme_fecha, FechaHasta_ht), 0) AS Pre_Informe_Laboratorio, 
        //                                                     COALESCE(DATEDIFF(FechActPed, fecha_rec), 0) AS Informe_Recep_Muestra ,
        //                                                     COALESCE(DATEDIFF(fecha_reg_pdf,fecha_rec),0) AS Recepcion_Muestra
                                                            
                                                            
        //                                                     FROM detalle_cuadro_00002final
        //                                                     WHERE 
        //                                                     YEAR(fecha_rec) = $year 
        //                                                     $filtros
        //                                                     and fecha_rec IS NOT NULL
        //                                                     AND Conforme_preinforme_fecha IS NOT NULL 
        //                                                     AND FechaHasta_ht IS NOT NULL 
        //                                                     AND fecha_reg_pdf IS NOT NULL 
        //                                                     AND FechActPed IS NOT NULL 
        //                                                     AND (DATE_FORMAT(Conforme_preinforme_fecha, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(Conforme_preinforme_fecha) != '0000-00-00') 
        //                                                     AND (DATE_FORMAT(FechaHasta_ht, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(FechaHasta_ht) != '0000-00-00') 
        //                                                     AND (DATE_FORMAT(fecha_reg_pdf, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(fecha_reg_pdf) != '0000-00-00') 
        //                                                     AND (DATE_FORMAT(FechActPed, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(FechActPed) != '0000-00-00')
        //                                                     AND (DATE_FORMAT(fecha_rec, '%H:%i:%s %m/%d/%Y') NOT IN ('00:00:00 00/00/0000', '00:00:00 00/00/00', '00:00:00 00/00/0000') OR DATE(fecha_rec) != '0000-00-00')
        //                                                     ORDER BY mes  
        //                                             )
        //                                             AS Count_CD
        //                                             GROUP BY 
        //                                             Capacidad_De_Atencion_Del_Servicio,ANIO,MES
        //                                             ORDER BY ANIO,  MES,  DIA
        //                                 )
        //                                 AS Final
        //                                 GROUP BY ANIO, MES, DIA
        //                                 ORDER BY ANIO, MES, DIA
                        
        //                     ) AS FINAL_2

        //                     GROUP BY MES
        //                     ORDER BY MES
                        
        //         ) AS TABLA";

        // return $sql;
        

        // $arreglo = array();
        $maxA = array(
            'abc'=>0,
            'Mesabc'=>0,
            'a'=>0,
            'Mesa'=>0,
            'b'=>0,
            'Mesb'=>0,
            'c'=>0,
            'Mesc'=>0,
            'extra'=>0,
            'Mesextra'=>0
        );
        $minA = array(
            'abc'=>0,
            'Mesabc'=>0,
            'a'=>0,
            'Mesa'=>0,
            'b'=>0,
            'Mesb'=>0,
            'c'=>0,
            'Mesc'=>0,
            'extra'=>0,
            'Mesextra'=>0
        );
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_title_state = mysqli_fetch_array($consulta)) {

                // var_dump($consulta_title_state);
                // echo "<br><br><br><br>\n\n\n\n\n";
                // echo "\n\n";
                // echo $consulta_title_state['MES'];
                // echo "\n\n";

                if($maxA['abc'] < $consulta_title_state['Capacidad_De_Atencion_Del_Servicio']){
                    $maxA['abc'] = $consulta_title_state['Capacidad_De_Atencion_Del_Servicio'];
                    $maxA['Mesabc'] = $consulta_title_state['MES'];
                }
                if($maxA['a'] < $consulta_title_state['Informe_Laboratorio']){
                    $maxA['a'] = $consulta_title_state['Informe_Laboratorio'];
                    $maxA['Mesa'] = $consulta_title_state['MES'];
                }
                if($maxA['b'] < $consulta_title_state['Pre_Informe_Laboratorio']){
                    $maxA['b'] = $consulta_title_state['Pre_Informe_Laboratorio'];
                    $maxA['Mesb'] = $consulta_title_state['MES'];
                }
                if($maxA['c'] < $consulta_title_state['Informe_Recep_Muestra']){
                    $maxA['c'] = $consulta_title_state['Informe_Recep_Muestra'];
                    $maxA['Mesc'] = $consulta_title_state['MES'];
                }
                if($maxA['extra'] < $consulta_title_state['Recepcion_Muestra']){
                    $maxA['extra'] = $consulta_title_state['Recepcion_Muestra'];
                    $maxA['Mesextra'] = $consulta_title_state['MES'];
                }

                if(
                    $minA['abc'] == 0 &&
                    $minA['Mesabc'] == 0 &&
                    $minA['a'] == 0 &&
                    $minA['Mesa'] == 0 &&
                    $minA['b'] == 0 &&
                    $minA['Mesb'] == 0 &&
                    $minA['c'] == 0 &&
                    $minA['Mesc'] == 0 &&
                    $minA['extra'] == 0 &&
                    $minA['Mesextra'] == 0
                ){
                    $minA['abc'] = $consulta_title_state['Capacidad_De_Atencion_Del_Servicio'];
                    $minA['Mesabc'] = $consulta_title_state['MES'];
                    $minA['a'] = $consulta_title_state['Informe_Laboratorio'];
                    $minA['Mesa'] = $consulta_title_state['MES'];
                    $minA['b'] = $consulta_title_state['Pre_Informe_Laboratorio'];
                    $minA['Mesb'] = $consulta_title_state['MES'];
                    $minA['c'] = $consulta_title_state['Informe_Recep_Muestra'];
                    $minA['Mesc'] = $consulta_title_state['MES'];
                    $minA['extra'] = $consulta_title_state['Recepcion_Muestra'];
                    $minA['Mesextra'] = $consulta_title_state['MES'];
                }else{
                    if($minA['abc'] > $consulta_title_state['Capacidad_De_Atencion_Del_Servicio']){
                        $minA['abc'] = $consulta_title_state['Capacidad_De_Atencion_Del_Servicio'];
                        $minA['Mesabc'] = $consulta_title_state['MES'];
                    }
                    if($minA['a'] > $consulta_title_state['Informe_Laboratorio']){
                        $minA['a'] = $consulta_title_state['Informe_Laboratorio'];
                        $minA['Mesa'] = $consulta_title_state['MES'];
                    }
                    if($minA['b'] > $consulta_title_state['Pre_Informe_Laboratorio']){
                        $minA['b'] = $consulta_title_state['Pre_Informe_Laboratorio'];
                        $minA['Mesb'] = $consulta_title_state['MES'];
                    }
                    if($minA['c'] > $consulta_title_state['Informe_Recep_Muestra']){
                        $minA['c'] = $consulta_title_state['Informe_Recep_Muestra'];
                        $minA['Mesc'] = $consulta_title_state['MES'];
                    }
                    if($minA['extra'] > $consulta_title_state['Recepcion_Muestra']){
                        $minA['extra'] = $consulta_title_state['Recepcion_Muestra'];
                        $minA['Mesextra'] = $consulta_title_state['MES'];
                    }
                }
                // $arreglo[] = $consulta_title_state;
            }
            return array(
                $maxA,$minA
            );
            $this->conexion->cerrar();
        }
    }

    // function TraerGeneralEstadoTablaOld($ano)
    // {
    //     $sql = "SELECT * FROM cuadro_00002_seguimientoinformes WHERE anyo = $ano";
    //     $arreglo = array();
    //     if ($consulta = $this->conexion->conexion->query($sql)) {
    //         while ($consulta_VU = mysqli_fetch_array($consulta)) {
    //             $arreglo[] = $consulta_VU;
    //         }
    //         return $arreglo;
    //         $this->conexion->cerrar();
    //     }
    // }

    function TraerGeneralEstadoTabla($ano,$filtro)
    {
        // var_dump($ano);
        // var_dump($filtro);
        $tablaUsar = 'cuadro_00002_seguimientoinformes';
        /*
                    $filtro[0],     //          sede
                    $filtro[1],     //          area
                    $filtro[2],     //          muestreo
                    $filtro[3],     //          unidadNegocio
                    $filtro[4]      //          cliente
        */
                    $filtros = "";
        
                    if($filtro[0] != 'all'){    //  sede
                        $filtros .= "AND sede = '$filtro[0]' ";
                    }
                    if($filtro[1] != 'all'){    //  area
                        $filtros .= "AND ( ";
                        $nn = 0;
                        foreach ($filtro[1] as $k => $v) {
                            if($nn > 0){
                                $filtros .= "OR ";
                            }
                            $filtros .= " AREA LIKE '%$v%' ";
                            $nn += 1;
                        }
                        $filtros .= " ) ";
                    }
                    if($filtro[2] != 'all'){    //  muestreo
                        if($filtro[2] == "Realizado por Hullasoft (**)"){
                            $filtros .= "AND muestreo = 'Realizado por Hullasoft (**)' ";
                        }else{
                            $filtros .= "AND muestreo != 'Realizado por Hullasoft (**)' ";
                        }
                    }
                    if($filtro[3] != 'all'){    //  unidadNegocio
                        $filtros .= "AND unidadNegocio = '$filtro[3]' ";
                    }
                    if($filtro[4] != 'all'){    //  cliente
                        $filtros .= "AND cliente = '$filtro[4]' ";
                    }


        $sql = "
            SELECT
            mes, dia, anyo,
            SUM( CASE WHEN c1_capacidad_atencion > 0 THEN c1_capacidad_atencion ELSE 0 END ) AS suma_c1,
            SUM( CASE WHEN c1_ie_dias_capacidad_atencion > 0 THEN c1_ie_dias_capacidad_atencion ELSE 0 END ) AS suma_c12,
            SUM( CASE WHEN c2_dias_recepcionsolicitud > 0 THEN c2_dias_recepcionsolicitud ELSE 0 END ) AS suma_c2,
            SUM( CASE WHEN c2_ie_dias_recepcionsolicitud > 0 THEN c2_ie_dias_recepcionsolicitud ELSE 0 END ) AS suma_c22,
            SUM( CASE WHEN c3_dias_solicitudLaboratorio > 0 THEN c3_dias_solicitudLaboratorio ELSE 0 END ) AS suma_c3,
            SUM( CASE WHEN c3_Ie_dias_dias_solicitudLaboratorio > 0 THEN c3_Ie_dias_dias_solicitudLaboratorio ELSE 0 END ) AS suma_c32,
            SUM( CASE WHEN c4_dias_emision_ie > 0 THEN c4_dias_emision_ie ELSE 0 END ) AS suma_c4,
            SUM( CASE WHEN c4_ie_dias_emision_ie > 0 THEN c4_ie_dias_emision_ie ELSE 0 END ) AS suma_c42,
            SUM( CASE WHEN c5_Dias_SolicitudRecepcion > 0 THEN c5_Dias_SolicitudRecepcion ELSE 0 END ) AS suma_c5,
            SUM( CASE WHEN c5_Ie_Dias_SolicitudRecepcion > 0 THEN c5_Ie_Dias_SolicitudRecepcion ELSE 0 END ) AS suma_c52
            FROM
            cuadro_00002_seguimientoinformes
            WHERE
            anyo = '$ano'
            AND 
            (dia REGEXP '^[0-9]{1,3}$' AND CAST(dia AS UNSIGNED) BETWEEN 0 AND 999)
            and STR_TO_DATE(CONCAT(anyo, '-', mes, '-', dia), '%Y-%m-%d') IS NOT NULL
            AND (dia BETWEEN '000' AND '999' OR dia = '999' AND (anyo MOD 4 = 0 AND (anyo MOD 100 <> 0 OR anyo MOD 400 = 0)))
            $filtros

            GROUP BY
            mes, dia, anyo
        ";

// dia IN (
            //     '000','001','002','003','004','005','006','007','008','009',
            //     '010','011','012','013','014','015','016','017','018','019',
            //     '020','021','022','023','024','025','026','027','028','029',
            //     '030','031'
            // )


            
        // $sql = "SELECT * FROM cuadro_00002_seguimientoinformes WHERE anyo = $ano $filtros";
        // var_dump($sql);
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }


    // function TraerGeneralEstadoTablaTest($ano)
    // {
    //     $sql = "SELECT * FROM cuadro_00002_seguimientoinformes WHERE anyo = $ano";
    //     $arreglo = array();
    //     if ($consulta = $this->conexion->conexion->query($sql)) {
    //         while ($consulta_VU = mysqli_fetch_array($consulta)) {
    //             $arreglo[] = $consulta_VU;
    //         }
    //         return $arreglo;
    //         $this->conexion->cerrar();
    //     }
    // }

    function TraerDatosbtnAnioMesDia($anio, $mes, $dia)
    {
        $sql = "    ";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function TraerDatosbtnAnioMesDiaResumido($anio, $mes, $dia)
    {
        $sql = "SELECT mes, anyo, dia,
                    s1_capacidad_atencion , s1_ie_dias_capacidad_atencion                , ROUND(s1_ie_dias_capacidad_atencion/s1_capacidad_atencion ) 	porcen_capacidad_atencion,
                    s2_dias_recepcionsolicitud ,    s2_ie_dias_recepcionsolicitud        , ROUND(s2_ie_dias_recepcionsolicitud/s2_dias_recepcionsolicitud) porcen_recepcionsolicitud ,
                    s3_Ie_dias_dias_solicitudLaboratorio , s3_dias_solicitudLaboratorio  , ROUND(s3_Ie_dias_dias_solicitudLaboratorio/s3_dias_solicitudLaboratorio) porcen_solicitudLaboratorio ,
                    s4_ie_dias_emision_ie , s4_dias_emision_ie, ROUND(s4_ie_dias_emision_ie/s4_dias_emision_ie,2) porcen_dias_emision_ie ,
                    s5_Ie_Dias_SolicitudRecepcion , s5_Dias_SolicitudRecepcion , ROUND(	s5_Ie_Dias_SolicitudRecepcion/s5_Dias_SolicitudRecepcion,2) porcen_Dias_SolicitudRecepcion
                FROM 
                (            
                SELECT 
                mes , anyo, dia,
                sum(c1_capacidad_atencion) s1_capacidad_atencion ,
                sum(c1_ie_dias_capacidad_atencion)s1_ie_dias_capacidad_atencion ,
                
                
                sum(c2_dias_recepcionsolicitud) s2_dias_recepcionsolicitud,
                sum(c2_ie_dias_recepcionsolicitud) s2_ie_dias_recepcionsolicitud,
                
                
                sum(c3_dias_solicitudLaboratorio) s3_dias_solicitudLaboratorio,
                sum(c3_Ie_dias_dias_solicitudLaboratorio) s3_Ie_dias_dias_solicitudLaboratorio,
                
                
                sum(c4_dias_emision_ie) s4_dias_emision_ie ,
                sum(c4_ie_dias_emision_ie) s4_ie_dias_emision_ie ,
                
                sum(c5_Dias_SolicitudRecepcion) s5_Dias_SolicitudRecepcion,
                sum(c5_Ie_Dias_SolicitudRecepcion) s5_Ie_Dias_SolicitudRecepcion  
                
                
                FROM cuadro_00002_seguimientoinformes WHERE anyo = $anio AND mes = $mes AND dia = $dia GROUP BY mes
                ) AS listado";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }
}
