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

    // ------------------------------ statistics ------------------------------
    function TraerGeneralEstado($ano,$filtro)
    {
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
        
        // echo $filtros;
        // return $filtros;

        $sql = "SELECT
                mes,
                c1_capacidad_atencion,
                c1_ie_dias_capacidad_atencion,
                ROUND(c1_ie_dias_capacidad_atencion / c1_capacidad_atencion) AS porcen_capacidad_atencion,
                c2_dias_recepcionsolicitud,
                c2_ie_dias_recepcionsolicitud,
                ROUND(c2_ie_dias_recepcionsolicitud / c2_dias_recepcionsolicitud) AS porcen_recepcionsolicitud,
                c3_Ie_dias_dias_solicitudLaboratorio,
                c3_dias_solicitudLaboratorio,
                ROUND(c3_Ie_dias_dias_solicitudLaboratorio / c3_dias_solicitudLaboratorio) AS porcen_solicitudLaboratorio,
                c4_ie_dias_emision_ie,
                c4_dias_emision_ie,
                ROUND(c4_ie_dias_emision_ie / c4_dias_emision_ie, 2) AS porcen_dias_emision_ie,
                c5_Ie_Dias_SolicitudRecepcion,
                c5_Dias_SolicitudRecepcion,
                ROUND(c5_Ie_Dias_SolicitudRecepcion / c5_Dias_SolicitudRecepcion, 2) AS porcen_Dias_SolicitudRecepcion,
                anyo
                FROM
                    (
                        SELECT
                            mes,
                            anyo,
                            SUM( CASE WHEN c1_capacidad_atencion > 0 THEN c1_capacidad_atencion ELSE 0 END ) AS c1_capacidad_atencion,
                            SUM( CASE WHEN c1_ie_dias_capacidad_atencion > 0 THEN c1_ie_dias_capacidad_atencion ELSE 0 END ) AS c1_ie_dias_capacidad_atencion,
                            SUM( CASE WHEN c2_dias_recepcionsolicitud > 0 THEN c2_dias_recepcionsolicitud ELSE 0 END ) AS c2_dias_recepcionsolicitud,
                            SUM( CASE WHEN c2_ie_dias_recepcionsolicitud > 0 THEN c2_ie_dias_recepcionsolicitud ELSE 0 END ) AS c2_ie_dias_recepcionsolicitud,
                            SUM( CASE WHEN c3_dias_solicitudLaboratorio > 0 THEN c3_dias_solicitudLaboratorio ELSE 0 END ) AS c3_dias_solicitudLaboratorio,
                            SUM( CASE WHEN c3_Ie_dias_dias_solicitudLaboratorio > 0 THEN c3_Ie_dias_dias_solicitudLaboratorio ELSE 0 END ) AS c3_Ie_dias_dias_solicitudLaboratorio,
                            SUM( CASE WHEN c4_dias_emision_ie > 0 THEN c4_dias_emision_ie ELSE 0 END ) AS c4_dias_emision_ie,
                            SUM( CASE WHEN c4_ie_dias_emision_ie > 0 THEN c4_ie_dias_emision_ie ELSE 0 END ) AS c4_ie_dias_emision_ie,
                            SUM( CASE WHEN c5_Dias_SolicitudRecepcion > 0 THEN c5_Dias_SolicitudRecepcion ELSE 0 END ) AS c5_Dias_SolicitudRecepcion,
                            SUM( CASE WHEN c5_Ie_Dias_SolicitudRecepcion > 0 THEN c5_Ie_Dias_SolicitudRecepcion ELSE 0 END ) AS c5_Ie_Dias_SolicitudRecepcion
                        FROM
                            cuadro_00002_seguimientoinformes
                        WHERE
                            anyo = $ano
                            and STR_TO_DATE(CONCAT(anyo, '-', mes, '-', dia), '%Y-%m-%d') IS NOT NULL
	                        AND (dia BETWEEN '001' AND '031' OR dia = '029' AND mes = '02' AND (anyo MOD 4 = 0 AND (anyo MOD 100 <> 0 OR anyo MOD 400 = 0)))


                            $filtros



                        GROUP BY
                            mes, anyo
                    ) AS listado
                ORDER BY
                    CAST(mes AS INTEGER);
                ";

        // return json_decode($sql);
        // return $sql;
        // return [
        //     $filtros,
        //     $query1,
        //     $query2,
        //     $query3,
        //     $sql2
        // ];
        $arreglo = array();
        // if(
        //     $filtro[0] == 'all' &&
        //     $filtro[0] == 'all' &&
        //     $filtro[0] == 'all' &&
        //     $filtro[0] == 'all' &&
        //     $filtro[0] == 'all'
        // ){
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        // }else{
        //     if ($consulta = $this->conexion->conexion->query($sql2)) {
        //         while ($consulta_VU = mysqli_fetch_array($consulta)) {
        //             $arreglo[] = $consulta_VU;
        //         }
        //         return $arreglo;
        //         $this->conexion->cerrar();
        //     }
        // }
    }

    // ------------------------------ title ------------------------------
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

        $sql = "SELECT MAX(dca) MAX , MIN(dca) MIN , 'DIAS_ATENCION' grupo 
        FROM ( SELECT ( sum( CASE WHEN c1_ie_dias_capacidad_atencion > 0 THEN c1_ie_dias_capacidad_atencion ELSE 0 END) /SUM( CASE WHEN c1_capacidad_atencion > 0  THEN c1_capacidad_atencion ELSE 0 END) )  dca , mes 
        FROM  cuadro_00002_seguimientoinformes WHERE anyo=$year $filtros group by mes ) AS A1
        
        UNION ALL 
        
        SELECT MAX(dca) MAX , MIN(dca) MIN , 'SOLICITUD ENSAYO' grupo 
        FROM ( SELECT ( sum( CASE WHEN c2_ie_dias_recepcionsolicitud > 0 THEN c2_ie_dias_recepcionsolicitud ELSE 0 END) /SUM( CASE WHEN c2_dias_recepcionsolicitud > 0  THEN c2_dias_recepcionsolicitud ELSE 0 END) )  dca , mes 
        FROM  cuadro_00002_seguimientoinformes WHERE anyo=$year $filtros group by mes ) AS A1
        
        UNION ALL 
                
        SELECT MAX(dca) MAX , MIN(dca) MIN , 'LABORATORIO' grupo 
        FROM ( SELECT ( sum( CASE WHEN c3_ie_dias_dias_solicitudlaboratorio > 0 THEN c3_ie_dias_dias_solicitudlaboratorio ELSE 0 END) /SUM( CASE WHEN c3_dias_solicitudlaboratorio > 0  THEN c3_dias_solicitudlaboratorio ELSE 0 END) )  dca , mes 
        FROM  cuadro_00002_seguimientoinformes WHERE anyo=$year $filtros group by mes ) AS A1
        
        UNION ALL 
        
        SELECT MAX(dca) MAX , MIN(dca) MIN , 'EMISION IE ' grupo 
        FROM ( SELECT ( sum( CASE WHEN c4_ie_dias_emision_ie > 0 THEN c4_ie_dias_emision_ie ELSE 0 END) /SUM( CASE WHEN c4_dias_emision_ie > 0  THEN c4_dias_emision_ie ELSE 0 END) )  dca , mes 
        FROM  cuadro_00002_seguimientoinformes WHERE anyo=$year $filtros group by mes ) AS A1
                
        UNION ALL 
        
        SELECT MAX(dca) MAX , MIN(dca) MIN , 'SOLICT_RECEP. ' grupo 
        FROM ( SELECT ( sum( CASE WHEN c5_ie_dias_solicitudrecepcion > 0 THEN c5_ie_dias_solicitudrecepcion ELSE 0 END) /SUM( CASE WHEN c5_dias_solicitudrecepcion > 0  THEN c5_dias_solicitudrecepcion ELSE 0 END) )  dca , mes 
        FROM  cuadro_00002_seguimientoinformes WHERE anyo=$year $filtros group by mes) AS A1
                ";

        // return $sql;
        

        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_title_state = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_title_state;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function TraerGeneralEstadoTabla($ano)
    {
        $sql = "SELECT * FROM cuadro_00002_seguimientoinformes WHERE anyo = $ano";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function getClientesStatus(){
        $sql = "SELECT DISTINCT cliente FROM cuadro_00002_seguimientoinformes2 ORDER BY cliente ASC";

        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_title_state = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_title_state['cliente'];
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
