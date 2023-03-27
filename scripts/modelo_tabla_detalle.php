<?php 

    class Modelo_Grafico{
        private $conexion;
        function __construct()
        {
            require_once ('conexion_alabVisor.php');
            $this -> conexion = new conexion();
            $this -> conexion -> conectar();
        }

        function TraerDatosDetalle($dia, $estado){
            $sql = "SELECT * FROM listado_0001_estados_de_las_os WHERE $estado = $dia ORDER BY $estado";
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