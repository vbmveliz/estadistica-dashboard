<?php

    class conexion{
        private $servidor;
        private $usuario;
        private $contrasena;
        private $basedatos;
        public $conexion;
        public function __construct()
        {
            $this -> servidor = "192.168.2.26";
            $this -> usuario = "gchalaca";
            $this -> contrasena = "a1a0PfizeR";
            $this -> basedatos = "alabvisor";
        }
        function conectar(){
            $this -> conexion = new mysqli($this -> servidor, $this -> usuario, $this -> contrasena, $this-> basedatos);
            $this -> conexion -> set_charset("utf8");
        }
        function cerrar(){
            $this -> conexion -> close();
        }
    }
?>