<?php

require_once "conexion.php";

$db = new Conexion();
$conn = $db->conectar();

$sql = "SELECT id,nombre FROM clientes";

$result = $conn->query($sql);

$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);