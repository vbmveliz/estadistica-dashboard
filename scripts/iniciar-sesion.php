<?php
    require 'modelo_grafico.php';
    $usuario = $_POST['txtLogin'];
    $clave =$_POST['txtPassword'];
    $MG = new Modelo_Grafico();
    if ($consulta = $MG -> validarLogin($usuario, $clave)){
        header('Location: ../index.php');
    } else {
?>
    <script>
    alert('Credenciales incorrectas')
    location.href="../login.php"
    </script>
<?php
}
?>