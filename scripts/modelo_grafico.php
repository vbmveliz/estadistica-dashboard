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
    }

?>