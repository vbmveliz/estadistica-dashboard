<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
    exit();
}

require_once "../scripts/conexion.php";

/* =============================
CONSULTAS
=============================*/

$total = $conexion->query("
SELECT COUNT(*) total FROM informes
")->fetch_assoc()['total'];

$pendientes = $conexion->query("
SELECT COUNT(*) total
FROM informes
WHERE estado_factura='Pendiente'
")->fetch_assoc()['total'];

$proceso = $conexion->query("
SELECT COUNT(*) total
FROM informes
WHERE estado_informe='En Proceso'
")->fetch_assoc()['total'];

$resultados = $conexion->query("
SELECT COUNT(*) total
FROM informes
WHERE estado_informe='Con Resultados'
")->fetch_assoc()['total'];

$enviado = $conexion->query("
SELECT COUNT(*) total
FROM informes
WHERE estado_informe='Enviado Cliente'
")->fetch_assoc()['total'];

include "../header.php";

?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Sistema Estadística</h1>
<p>Bienvenido: <b><?php echo $_SESSION['usuario']; ?></b></p>
</div>
</section>

<section class="content">

<div class="container-fluid">


<!-- =====================
FILA 1 INDICADORES
===================== -->

<div class="row">

<div class="col-lg-3 col-6">

<div class="small-box bg-info">

<div class="inner">
<h3><?php echo $total ?></h3>
<p>Total Informes</p>
</div>

<div class="icon">
<i class="fas fa-chart-bar"></i>
</div>

</div>

</div>



<div class="col-lg-3 col-6">

<div class="small-box bg-warning">

<div class="inner">
<h3><?php echo $proceso ?></h3>
<p>Informes en Proceso</p>
</div>

<div class="icon">
<i class="fas fa-clock"></i>
</div>

</div>

</div>



<div class="col-lg-3 col-6">

<div class="small-box bg-success">

<div class="inner">
<h3><?php echo $resultados ?></h3>
<p>Informes con Resultado</p>
</div>

<div class="icon">
<i class="fas fa-check"></i>
</div>

</div>

</div>



<div class="col-lg-3 col-6">

<div class="small-box bg-primary">

<div class="inner">
<h3><?php echo $enviado ?></h3>
<p>Enviado Cliente</p>
</div>

<div class="icon">
<i class="fas fa-paper-plane"></i>
</div>

</div>

</div>

</div>


<!-- =====================
FILA 2 FACTURAS
===================== -->

<div class="row">

<div class="col-12">

<div class="small-box bg-danger">

<div class="inner">
<h3><?php echo $pendientes ?></h3>
<p>Facturas Pendientes</p>
</div>

<div class="icon">
<i class="fas fa-exclamation-triangle"></i>
</div>

</div>

</div>

</div>



<!-- =====================
GRAFICO
===================== -->

<div class="card">

<div class="card-header bg-success">

<h3 class="card-title">Estadística de Informes</h3>

</div>

<div class="card-body">

<canvas id="graficoInformes"></canvas>

</div>

</div>



</div>

</section>

</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('graficoInformes');

new Chart(ctx,{

type:'bar',

data:{

labels:[
'En Proceso',
'Con Resultados',
'Enviado Cliente'
],

datasets:[{

label:'Cantidad de Informes',

data:[
<?php echo $proceso ?>,
<?php echo $resultados ?>,
<?php echo $enviado ?>
],

backgroundColor:[
'#f39c12',
'#28a745',
'#007bff'
]

}]

},

options:{
responsive:true,
scales:{
y:{
beginAtZero:true
}
}
}

});

</script>

<?php include "../footer.php"; ?>