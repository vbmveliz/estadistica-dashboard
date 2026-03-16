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

    function TraerGeneralEstadotest($ano){
        $sql = "
            SELECT
                mes,
                anyo,
                SUM(c1_capacidad_atencion) AS c1_capacidad_atencion,
                SUM(c1_ie_dias_capacidad_atencion) AS c1_ie_dias_capacidad_atencion,
                SUM(c2_dias_recepcionsolicitud) AS c2_dias_recepcionsolicitud,
                SUM(c2_ie_dias_recepcionsolicitud) AS c2_ie_dias_recepcionsolicitud,
                SUM(c3_dias_solicitudLaboratorio) AS c3_dias_solicitudLaboratorio,
                SUM(c3_Ie_dias_dias_solicitudLaboratorio) AS c3_Ie_dias_dias_solicitudLaboratorio,
                SUM(c4_dias_emision_ie) AS c4_dias_emision_ie,
                SUM(c4_ie_dias_emision_ie) AS c4_ie_dias_emision_ie,
                SUM(c5_Dias_SolicitudRecepcion) AS c5_Dias_SolicitudRecepcion,
                SUM(c5_Ie_Dias_SolicitudRecepcion) AS c5_Ie_Dias_SolicitudRecepcion
            FROM
                cuadro_00002_seguimientoinformes
            WHERE
                anyo = $ano
            GROUP BY
                mes, anyo
            ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
    }

    function TraerGeneralEstado($ano)
    {
        $sql = "SELECT 
                MES,
                SUM(c1) c1_capacidad_atencion,
                SUM(cc1) c1_ie_dias_capacidad_atencion,
                ROUND(SUM(cc1) / SUM(c1)) porcen_capacidad_atencion,
                SUM(c2) c2_dias_recepcionsolicitud,
                SUM(cc2) c2_ie_dias_recepcionsolicitud,
                ROUND(SUM(cc2) / SUM(c2)) porcen_recepcionsolicitud,
                SUM(c3) c3_Ie_dias_dias_solicitudLaboratorio,
                SUM(cc3) c3_dias_solicitudLaboratorio,
                ROUND(SUM(cc3) / SUM(c3)) porcen_solicitudLaboratorio,
                SUM(c4) c4_ie_dias_emision_ie,
                SUM(cc4) c4_dias_emision_ie,
                ROUND(SUM(cc4) / SUM(c4), 2) porcen_dias_emision_ie,
                SUM(c5) c5_Ie_Dias_SolicitudRecepcion,
                SUM(cc5) c5_Dias_SolicitudRecepcion,
                ROUND(SUM(cc5) / SUM(c5), 2) porcen_Dias_SolicitudRecepcion
                FROM
                (
                        SELECT 
                        ANIO,
                        MES,
                        DIA,
                        SUM(Capacidad_De_Atencion_Del_Servicio) c1,
                        (	SUM(Capacidad_De_Atencion_Del_Servicio) * DIA) cc1,
                        SUM(Recepcion_Muestra) c2,
                        (  SUM(Recepcion_Muestra) * DIA) cc2,
                        SUM(Pre_Informe_Laboratorio) c3,
                        ( 	SUM(Pre_Informe_Laboratorio) * DIA) cc3,
                        SUM(Informe_Recep_Muestra) c4,
                        (	SUM(Informe_Recep_Muestra) * DIA) cc4,
                        SUM(Informe_Laboratorio) c5,
                        (	SUM(Informe_Laboratorio) * DIA) cc5
                        FROM (
                                ##########	
                                #-----
                                SELECT
                                YEAR(fecha_rec) ANIO,
                                MONTH(fecha_rec) MES,
                                DAY(fecha_rec) DIA,
                                Capacidad_De_Atencion_Del_Servicio,
                                Informe_Laboratorio,
                                Recepcion_Muestra,
                                Pre_Informe_Laboratorio,
                                Informe_Recep_Muestra
                                FROM
                                (
                                        ##########
                                        SELECT
                                        fecha_rec,
                                        #
                                        fecha_reg_pdf,
                                        FechActPed,
                                        FechaHasta_ht,
                                        Conforme_preinforme_fecha,
                                        #
                                        #
                                        AREA,
                                        muestreo,
                                        sede,
                                        cliente,
                                        unidadNegocio,
                                        #
                                        ncertificado,
                                        COALESCE(DATEDIFF(Conforme_preinforme_fecha, fecha_rec), 0) AS Capacidad_De_Atencion_Del_Servicio,
                                        COALESCE(DATEDIFF(FechaHasta_ht, FechActPed), 0) AS Informe_Laboratorio,
                                        COALESCE(DATEDIFF(Conforme_preinforme_fecha, FechaHasta_ht), 0) AS Pre_Informe_Laboratorio,
                                        COALESCE(DATEDIFF(FechActPed, fecha_rec), 0) AS Informe_Recep_Muestra,
                                        COALESCE(DATEDIFF(fecha_reg_pdf, fecha_rec), 0) AS Recepcion_Muestra
                                        FROM detalle_cuadro_00002final
                                        WHERE 
                                        YEAR(fecha_rec) = 2023 AND 
                                        fecha_rec IS NOT NULL
                                        AND Conforme_preinforme_fecha IS NOT NULL
                                        AND FechaHasta_ht IS NOT NULL
                                        AND fecha_reg_pdf IS NOT NULL
                                        AND FechActPed IS NOT NULL
                        
                                        ORDER BY fecha_rec
                                        ##########
                                ) AS subconsulta
                                ORDER BY ANIO, MES, DIA
                                #
                                ##########
                        ) AS FINAL
                        GROUP BY ANIO,
                        MES,
                        DIA
                        ORDER BY ANIO,
                        MES,
                        DIA
                ) AS lont
                GROUP BY MES
                ORDER BY MES
                        ";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function tituloEstadoGrafico($year)
    {
        $sql = "
        SELECT MAX(dca) MAX , MIN(dca) MIN , 'DIAS_ATENCION' grupo 
        FROM ( SELECT ( sum(c1_ie_dias_capacidad_atencion) /SUM(c1_capacidad_atencion) )  dca , mes 
        FROM  cuadro_00002_seguimientoinformes WHERE anyo=$year AND c1_capacidad_atencion>0 group by mes ) AS A1
        
        UNION ALL 
        
        SELECT MAX(dca) MAX , MIN(dca) MIN , 'SOLICITUD ENSAYO' grupo 
        FROM ( SELECT ( sum(c2_ie_dias_recepcionsolicitud) /SUM(c2_dias_recepcionsolicitud) )  dca , mes 
        FROM  cuadro_00002_seguimientoinformes WHERE anyo=$year AND c2_dias_recepcionsolicitud>0 group by mes ) AS A1
        
        UNION ALL 
                
        SELECT MAX(dca) MAX , MIN(dca) MIN , 'LABORATORIO' grupo 
        FROM ( SELECT ( sum(c3_ie_dias_dias_solicitudlaboratorio) /SUM(c3_dias_solicitudlaboratorio) )  dca , mes 
        FROM  cuadro_00002_seguimientoinformes WHERE anyo=$year AND c3_dias_solicitudlaboratorio>0 group by mes ) AS A1
        
        UNION ALL 
        
        SELECT MAX(dca) MAX , MIN(dca) MIN , 'EMISION IE ' grupo 
        FROM ( SELECT ( sum(c4_ie_dias_emision_ie) /SUM(c4_dias_emision_ie) )  dca , mes 
        FROM  cuadro_00002_seguimientoinformes WHERE anyo=$year AND c4_dias_emision_ie>0 group by mes ) AS A1
                
        UNION ALL 
        
        SELECT MAX(dca) MAX , MIN(dca) MIN , 'SOLICT_RECEP. ' grupo 
        FROM ( SELECT ( sum(c5_ie_dias_solicitudrecepcion) /SUM(c5_dias_solicitudrecepcion) )  dca , mes 
        FROM  cuadro_00002_seguimientoinformes WHERE anyo=$year AND c5_dias_solicitudrecepcion>0 group by mes) AS A1
        ";

        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_title_state = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_title_state;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

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
            

            $filtros

            GROUP BY
            mes, dia, anyo;
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

    function TraerDatosbtnAnioMesDia($anio, $mes, $dia)
    {
        $sql = "SELECT * from cuadro_00002_seguimientoinformes_sustento WHERE anyo = $anio AND mes = $mes AND dia = $dia;";
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
                sum(1_capacidad_atencion) s1_capacidad_atencion ,
                sum(1_ie_dias_capacidad_atencion)s1_ie_dias_capacidad_atencion ,
                
                
                sum(2_dias_recepcionsolicitud) s2_dias_recepcionsolicitud,
                sum(2_ie_dias_recepcionsolicitud) s2_ie_dias_recepcionsolicitud,
                
                
                sum(3_dias_solicitudLaboratorio) s3_dias_solicitudLaboratorio,
                sum(3_Ie_dias_dias_solicitudLaboratorio) s3_Ie_dias_dias_solicitudLaboratorio,
                
                
                sum(4_dias_emision_ie) s4_dias_emision_ie ,
                sum(4_ie_dias_emision_ie) s4_ie_dias_emision_ie ,
                
                sum(5_Dias_SolicitudRecepcion) s5_Dias_SolicitudRecepcion,
                sum(5_Ie_Dias_SolicitudRecepcion) s5_Ie_Dias_SolicitudRecepcion  
                
                
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
