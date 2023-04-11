<?php 

    class Modelo_Grafico{
        private $conexion;
        function __construct()
        {
            require_once ('conexion.php');
            $this -> conexion = new conexion();
            $this -> conexion -> conectar();
        }

        function TraerDatosGraficoBar($sede, $estado, $unidad, $fechaInicio, $fechaFinal){
            $sql = "SELECT   dias , sede , estadoOs , unidadnegocio,  COUNT(1) cantidad, DATE_FORMAT(fecha_ini, '%Y-%m-%d') AS fecha_ini FROM 
            ( 
            SELECT oss.nos, oss.periodo_os, oss.version_os,  oss.fecha_ini   , oss.estado , NOW() ,
            DATEDIFF (   NOW() , oss.fecha_ini  )  dias , tuneg.descripcion  unidadnegocio ,
            ( SELECT tsucursales.descripcion FROM templeado , tsucursales  WHERE 
            templeado.cnroempleado=ejecutivo AND tsucursales.idtsucursales  = templeado.oficina)  sede ,
            tdominio.CDesDato estadoOs 
            FROM   t_orden_servicio oss    , tdominio , t_unidades_negocio tuneg
            WHERE   tdominio.CValor = oss.estado AND tuneg.idunidad_n=oss.idunidad_n and
            tdominio.CNomDominio = 'estado_os' AND oss.estado  IN('08','02','01','07','06','09') AND 
            oss.fecha_ini BETWEEN '$fechaInicio' AND '$fechaFinal' AND oss.idproforma IN ( 
            SELECT idproforma FROM  ccustodia_cab WHERE IFNULL(idproforma,'')<>'' )  AND 
            oss.idcliente NOT IN  ('0000001089','0000000372')
            ) AS aa
            GROUP BY   dias , sede , estadoOs ,unidadnegocio";
            $arreglo = array();
            if($consulta = $this -> conexion -> conexion -> query($sql)){
                while ($consulta_VU = mysqli_fetch_array($consulta)){
                    if($consulta_VU[1] == $sede && $consulta_VU[2] == $estado && $consulta_VU[3] == $unidad){
                        $arreglo[] = $consulta_VU;
                    }
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function validarLogin ($usuario, $clave){
                $sql = "SELECT clogin , cpass FROM tusuario WHERE clogin='".$usuario."' AND cpass='".$clave."'";

                if($consulta = $this -> conexion -> conexion -> query($sql)){
                    if($consulta_VU = mysqli_fetch_row($consulta)){
                        session_start();
                        $_SESSION['usuario'] = $usuario;
                        return true;
                    }
                    return false;
                    $this->conexion->cerrar();
                }
        }
        function TraerDatosGraficoPastel($valueEstadoOs,$fecha){
            $sql = "SELECT estado_os ,  dias , estadoinforme , COUNT(1) cantidad_informes FROM 
            (
                SELECT ncertificado, nestadoserv estadoinforme , fechad , fechah , dATEDIFF (fechah , fechad) +1 dias  , estadoos estado_os
                FROM   
                    (
                    SELECT   ncertificado , fechactped , testadooserv.NEstadOServ ,
                    (select  fecha_envio    FROM t_job_ma_cab WHERE estado<>'03' AND  
                    id_job IN( SELECT id_job FROM t_job_ma_det WHERE id_pedido=tpedidos.idpedidos) 
                    ORDER BY fecha_envio desc LIMIT 1)  fechah , 
                    (	SELECT    hc.fecha    	FROM t_job_ma_det dd , t_job_ma_cab hc WHERE 
                    hc.estado<>'03' and hc.id_job=dd.id_job AND id_pedido=tpedidos.idpedidos ORDER BY hc.fecha ASC LIMIT 1 ) fechad,
                    (SELECT CDesDato from t_orden_servicio ,  tdominio  where CNomDominio = 'estado_os' AND 
                    t_orden_servicio.estado=tdominio.CValor AND t_orden_servicio.idproforma=ccustodia_cab.idproforma LIMIT 1 ) estadoos
                    FROM tpedidos , ccustodia_cab , testadooserv  WHERE  tpedidos.nro_cadena = ccustodia_cab.idcustodia AND 
                    fechactped BETWEEN '2023-01-01' AND '$fecha' AND tpedidos.IdEstadOServ  IN ( '002','011','013') AND 
                    tpedidos.IdEstadOServ = testadooserv.IdEstadOServ
                    ) AS listado  WHERE IFNULL(fechad,'')<>'' AND    IFNULL(fechah,'')<>''   AND IFNULL(estadoos,'')<>''
            ) AS listafinal
            GROUP by   estado_os , dias , estadoinforme";
            $arreglo = array();
            if($consulta = $this -> conexion -> conexion -> query($sql)){
                while ($consulta_VU = mysqli_fetch_array($consulta)){
                    if($consulta_VU[2] == $valueEstadoOs){
                        $arreglo[] = $consulta_VU;
                    }
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function TraerDatosTabla($fecha){
            $sql = "SELECT estado_os ,  dias , estadoinforme , COUNT(1) cantidad_informes FROM 
            (
                SELECT ncertificado, nestadoserv estadoinforme , fechad , fechah , dATEDIFF (fechah , fechad) +1 dias  , estadoos estado_os
                FROM   
                    (
                    SELECT   ncertificado , fechactped , testadooserv.NEstadOServ ,
                    (select  fecha_envio    FROM t_job_ma_cab WHERE estado<>'03' AND  
                    id_job IN( SELECT id_job FROM t_job_ma_det WHERE id_pedido=tpedidos.idpedidos) 
                    ORDER BY fecha_envio desc LIMIT 1)  fechah , 
                    (	SELECT    hc.fecha    	FROM t_job_ma_det dd , t_job_ma_cab hc WHERE 
                    hc.estado<>'03' and hc.id_job=dd.id_job AND id_pedido=tpedidos.idpedidos ORDER BY hc.fecha ASC LIMIT 1 ) fechad,
                    (SELECT CDesDato from t_orden_servicio ,  tdominio  where CNomDominio = 'estado_os' AND 
                    t_orden_servicio.estado=tdominio.CValor AND t_orden_servicio.idproforma=ccustodia_cab.idproforma LIMIT 1 ) estadoos
                    FROM tpedidos , ccustodia_cab , testadooserv  WHERE  tpedidos.nro_cadena = ccustodia_cab.idcustodia AND 
                    fechactped BETWEEN '2023-01-01' AND '$fecha' AND tpedidos.IdEstadOServ  IN ( '002','011','013') AND 
                    tpedidos.IdEstadOServ = testadooserv.IdEstadOServ
                    ) AS listado  WHERE IFNULL(fechad,'')<>'' AND    IFNULL(fechah,'')<>''   AND IFNULL(estadoos,'')<>''
            ) AS listafinal
            GROUP by estadoinforme";
            $arreglo = array();
            if($consulta = $this -> conexion -> conexion -> query($sql)){
                while ($consulta_VU = mysqli_fetch_array($consulta)){
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function TraerDatosLineal(){
            $sql = "SELECT  dias_informe ,  SUM(informe_enviadocliente) Enviadocli , SUM(informe_conresultado) ConResultado , 
            SUM(informe_enproceso) EnProceso
             From
             (
                    SELECT oservicio ,   dias_informe, SUM(Conresultado) informe_conresultado , SUM(enproceso) informe_enproceso
                    , SUM(enviadocliente) informe_enviadocliente
                    FROM 
                    (
                    select 
                     ccustodia_cab.oservicio,ncertificado,
                    tpedidos.fechactped  ,
                    if( ccustodia_cab.IDUNIDAD_n='0000000001','MAM',
                    if( ccustodia_cab.IDUNIDAD_n='0000000002','AGRO',
                    if( ccustodia_cab.IDUNIDAD_n='0000000003','ALI',
                    if( ccustodia_cab.IDUNIDAD_n='0000000004','GEO','')))) UNIDANEGOCIO ,
                    if (tpedidos.IdEstadOServ ='001' OR tpedidos.IdEstadOServ='017',1,0) enproceso , 
                    if (tpedidos.IdEstadOServ = '002'   ,1,0) Conresultado , 
                    if (tpedidos.IdEstadOServ = '013'   ,1,0) enviadocliente , 
                    DATEDIFF( now() , tpedidos.fechactped)     Dias_informe 
                    
                    from 
                    Tpedidos
                    join ccustodia_cab on tpedidos.nro_cadena=ccustodia_cab.idcustodia
                    join t_orden_servicio oss on oss.idproforma = ccustodia_cab.idproforma 
                       WHERE 
                       oss.estado IN ('08') AND oss.idcliente <>'0000000372' AND 
                    fechactped >='2023-01-01' and fechactped<=Now() AND tpedidos.IdEstadOServ  IN ('001','002','013','017')   ORDER BY oservicio
                    ) AS aaaa
                    GROUP BY  oservicio, dias_informe ORDER BY  dias_informe
            )  AS listado 
            Group by dias_informe";
            $arreglo = array();
            if($consulta = $this -> conexion -> conexion -> query($sql)){
                while ($consulta_VU = mysqli_fetch_array($consulta)){
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function TraerDatosLinealFecha($fechaInicio, $fechaFinal){
            $sql = "SELECT  dias_informe ,  SUM(informe_enviadocliente) Enviadocli , SUM(informe_conresultado) ConResultado , 
            SUM(informe_enproceso) EnProceso
             From
             (
                    SELECT oservicio ,   dias_informe, SUM(Conresultado) informe_conresultado , SUM(enproceso) informe_enproceso
                    , SUM(enviadocliente) informe_enviadocliente
                    FROM 
                    (
                    select 
                     ccustodia_cab.oservicio,ncertificado,
                    tpedidos.fechactped  ,
                    if( ccustodia_cab.IDUNIDAD_n='0000000001','MAM',
                    if( ccustodia_cab.IDUNIDAD_n='0000000002','AGRO',
                    if( ccustodia_cab.IDUNIDAD_n='0000000003','ALI',
                    if( ccustodia_cab.IDUNIDAD_n='0000000004','GEO','')))) UNIDANEGOCIO ,
                    if (tpedidos.IdEstadOServ ='001' OR tpedidos.IdEstadOServ='017',1,0) enproceso , 
                    if (tpedidos.IdEstadOServ = '002'   ,1,0) Conresultado , 
                    if (tpedidos.IdEstadOServ = '013'   ,1,0) enviadocliente , 
                    DATEDIFF( now() , tpedidos.fechactped)     Dias_informe 
                    
                    from 
                    Tpedidos
                    join ccustodia_cab on tpedidos.nro_cadena=ccustodia_cab.idcustodia
                    join t_orden_servicio oss on oss.idproforma = ccustodia_cab.idproforma 
                       WHERE 
                       oss.estado IN ('08') AND oss.idcliente <>'0000000372' AND 
                    fechactped >='$fechaInicio' and fechactped<='$fechaFinal' AND tpedidos.IdEstadOServ  IN ('001','002','013','017')   ORDER BY oservicio
                    ) AS aaaa
                    GROUP BY  oservicio, dias_informe ORDER BY  dias_informe
            )  AS listado 
            Group by dias_informe
            ";
            $arreglo = array();
            if($consulta = $this -> conexion -> conexion -> query($sql)){
                while ($consulta_VU = mysqli_fetch_array($consulta)){
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function TraerDatosLinealDia($dia){
            $sql = "SELECT oservicio ,   dias_informe, SUM(Conresultado) informe_conresultado , SUM(enproceso) informe_enproceso
            , SUM(enviadocliente) informe_enviadocliente
            FROM 
            (
            select 
             ccustodia_cab.oservicio,ncertificado,
            tpedidos.fechactped  ,
            if( ccustodia_cab.IDUNIDAD_n='0000000001','MAM',
            if( ccustodia_cab.IDUNIDAD_n='0000000002','AGRO',
            if( ccustodia_cab.IDUNIDAD_n='0000000003','ALI',
            if( ccustodia_cab.IDUNIDAD_n='0000000004','GEO','')))) UNIDANEGOCIO ,
            if (tpedidos.IdEstadOServ ='001' OR tpedidos.IdEstadOServ='017',1,0) enproceso , 
            if (tpedidos.IdEstadOServ = '002'   ,1,0) Conresultado , 
            if (tpedidos.IdEstadOServ = '013'   ,1,0) enviadocliente , 
            DATEDIFF( now() , tpedidos.fechactped)     Dias_informe 
            
            from 
            Tpedidos
            join ccustodia_cab on tpedidos.nro_cadena=ccustodia_cab.idcustodia
            join t_orden_servicio oss on oss.idproforma = ccustodia_cab.idproforma 
               WHERE 
               oss.estado IN ('08') AND oss.idcliente <>'0000000372' AND 
            fechactped >='2023-01-01' and fechactped<=Now() AND tpedidos.IdEstadOServ  IN ('001','002','013','017')   ORDER BY oservicio
            ) AS aaaa
            GROUP BY  oservicio, dias_informe ORDER BY  dias_informe";
            $arreglo = array();
            if($consulta = $this -> conexion -> conexion -> query($sql)){
                while ($consulta_VU = mysqli_fetch_array($consulta)){
                    if($consulta_VU[1] == $dia){
                        $arreglo[] = $consulta_VU;
                    }
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function TraerDatosLinealDiaInforme($dia){
            $sql = "select 
            ccustodia_cab.oservicio,ncertificado,
           tpedidos.fechactped  ,
           if( ccustodia_cab.IDUNIDAD_n='0000000001','MAM',
           if( ccustodia_cab.IDUNIDAD_n='0000000002','AGRO',
           if( ccustodia_cab.IDUNIDAD_n='0000000003','ALI',
           if( ccustodia_cab.IDUNIDAD_n='0000000004','GEO','')))) UNIDANEGOCIO ,
           if (tpedidos.IdEstadOServ ='001' OR tpedidos.IdEstadOServ='017',1,0) enproceso , 
           if (tpedidos.IdEstadOServ = '002'   ,1,0) Conresultado , 
           if (tpedidos.IdEstadOServ = '013'   ,1,0) enviadocliente , 
           DATEDIFF( now() , tpedidos.fechactped)     Dias_informe 
            from 
           Tpedidos
           join ccustodia_cab on tpedidos.nro_cadena=ccustodia_cab.idcustodia
           join t_orden_servicio oss on oss.idproforma = ccustodia_cab.idproforma 
              WHERE 
              oss.estado IN ('08') AND oss.idcliente <>'0000000372' AND 
              fechactped >='2023-01-01' and fechactped<=Now() AND tpedidos.IdEstadOServ  IN ('001','002','013','017') 
               AND DATEDIFF( now() , tpedidos.fechactped)='$dia'
        
             ORDER BY oservicio";
            $arreglo = array();
            if($consulta = $this -> conexion -> conexion -> query($sql)){
                while ($consulta_VU = mysqli_fetch_array($consulta)){
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
    }

?>