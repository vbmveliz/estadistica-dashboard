


<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$base = "http://localhost/estadistica/";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['usuario'])){
    header("Location: ".$base."login.php");
    exit();
}

$usuario = $_SESSION['usuario'];

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Sistema Estadístico</title>

<link rel="icon" href="<?php echo $base ?>dist/img/AdminLTELogo.png">

<link rel="stylesheet" href="<?php echo $base ?>plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?php echo $base ?>plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $base ?>dist/css/adminlte.min.css">
<link rel="stylesheet" href="<?php echo $base ?>css/estilos.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

<ul class="navbar-nav">

<li class="nav-item">
<a class="nav-link" data-widget="pushmenu" href="#">
<i class="fas fa-bars"></i>
</a>
</li>

<li class="nav-item d-none d-sm-inline-block">
<a href="<?php echo $base ?>index.php" class="nav-link">Estadísticas</a>
</li>

</ul>

<ul class="navbar-nav ml-auto">

<li class="nav-item">
<a class="nav-link" href="<?php echo $base ?>scripts/cerrar-sesion.php">
<i class="fas fa-sign-out-alt"></i>
</a>
</li>

</ul>

</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a href="<?php echo $base ?>index.php" class="brand-link">
<span class="brand-text font-weight-light">Hullasoft</span>
</a>

<div class="sidebar">

<div class="user-panel mt-3 pb-3 mb-3 d-flex">

<div class="info">
<a href="#" class="d-block"><?php echo $usuario ?></a>
</div>

</div>

<nav class="mt-2">

<ul class="nav nav-pills nav-sidebar flex-column">

<li class="nav-item">
<a href="<?php echo $base ?>pages/dashboard.php" class="nav-link">
<i class="nav-icon fas fa-chart-bar"></i>
<p>Dashboard</p>
</a>
</li>

<li class="nav-item">
<a href="<?php echo $base ?>estado.php" class="nav-link">
<i class="nav-icon fas fa-chart-line"></i>
<p>Estado OS</p>
</a>
</li>

<li class="nav-item">
<a href="<?php echo $base ?>pendientes.php" class="nav-link">
<i class="nav-icon fas fa-clock"></i>
<p>Informes pendientes</p>
</a>
</li>

</ul>

</nav>

</div>

</aside>