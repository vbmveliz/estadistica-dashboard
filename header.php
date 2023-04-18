<?php 

$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Laboratorio acreditado bajo la ISO 17025:2017, avalada por las certificadoras Internacionales IAS (International Accreditation Service) y A2LA (American Association for Laboratory Accreditation), a nivel Nacional por INACAL (Instituto Nacional de Calidad) NTP-ISO/IEC 17025:2017, ambos firmantes del acuerdo internacional de Reconimiento Mutuo ILAC-MRA.">
	<meta name="author" content="Alab Analitycal Laboratory">
    <title>ALAB EIRL</title>
    <link rel="shortcut icon" href="https://alab.com.pe/img/apple-touch-icon-57x57-precomposed.png" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="css/estilos.css">

    <script src="https://kit.fontawesome.com/60213d354c.js" crossorigin="anonymous"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="https://alab.com.pe/img/apple-touch-icon-57x57-precomposed.png" alt="AdminLTELogo" height="60" width="60">
    </div>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index.php" class="nav-link">Estadísticas</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="mailto:esuarez@alab.com.pe" class="nav-link">Soporte Técnico</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="scripts/cerrar_session.php">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index.php" class="brand-link">
            <img src="https://alab.com.pe/img/apple-touch-icon-57x57-precomposed.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">ALAB</span>
        </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/username.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Ronald Mera</a>
            </div>
        </div>
        <div class="form-inline"></div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Estadísticas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if($url == "localhost/Estadistica/index.php" || $url == "localhost/Estadistica/"): ?>
                            <li class="nav-item">
                                <a href="index.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ordenes de Servicio - Finalizar</p>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a href="index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ordenes de Servicio - Finalizar</p>
                                </a>
                            </li>
                        <?php endif ?>
                        <?php if($url == "localhost/Estadistica/estado.php"): ?>
                            <li class="nav-item">
                                <a href="estado.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Estado OS - Estatus</p>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a href="estado.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Estado OS - Estatus</p>
                                </a>
                            </li>
                        <?php endif ?>
                        <?php if($url == "localhost/Estadistica/pendientes.php"): ?>
                            <li class="nav-item">
                                <a href="pendientes.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Informes pendientes</p>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a href="pendientes.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Informes pendientes</p>
                                </a>
                            </li>
                        <?php endif ?>
                        <?php if($url == "localhost/Estadistica/pendientes_porcentaje.php"): ?>
                            <li class="nav-item">
                                <a href="pendientes_porcentaje.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Informes pendientes Porcentaje</p>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a href="pendientes_porcentaje.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Informes pendientes Porcentaje</p>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </li>
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Charts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/charts/chartjs.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ChartJS</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </nav>
    </div>
</aside>