<?php

require_once "conexion.php";

$db = new Conexion();
$conn = $db->conectar();

$sql = "SELECT id,nombre FROM clientes";

$result = $conn->query($sql);

$clientes = [];

while($row = $result->fetch_assoc()){
    $clientes[] = $row;
}

echo json_encode($clientes);

?>