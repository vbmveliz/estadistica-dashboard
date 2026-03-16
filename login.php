<?php
session_start();

if(isset($_SESSION['usuario'])){
    header("Location: pages/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Hullasoft - Acceso</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

</head>

<body class="hold-transition login-page">

<div class="login-box">

<div class="card card-outline card-primary">

<div class="card-header text-center">

<h3><b>Hullasoft</b> Login</h3>

</div>

<div class="card-body">

<p class="login-box-msg">Iniciar sesión</p>

<?php if(isset($_GET['error'])){ ?>

<div class="alert alert-danger">

Usuario o contraseña incorrectos

</div>

<?php } ?>

<form action="scripts/iniciar-sesion.php" method="POST">

<div class="input-group mb-3">

<input type="text" name="usuario" class="form-control" placeholder="Usuario" required>

<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-user"></span>
</div>
</div>

</div>

<div class="input-group mb-3">

<input type="password" name="password" class="form-control" placeholder="Contraseña" required>

<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-lock"></span>
</div>
</div>

</div>

<button type="submit" class="btn btn-primary btn-block">
Ingresar
</button>

</form>

</div>

</div>

</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

</body>

</html>