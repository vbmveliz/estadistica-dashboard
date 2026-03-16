<?php 
include 'header.php';
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">

<div class="col-sm-6">
<h1>Panel de Pendientes</h1>
</div>

</div>
</div>
</section>


<section class="content">
<div class="container-fluid">

<!-- KPI -->

<div class="row">

<div class="col-md-3">
<div class="small-box bg-danger">
<div class="inner">
<h3 id="kpiPendientes">0</h3>
<p>Total Pendientes</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="small-box bg-warning">
<div class="inner">
<h3 id="kpiProceso">0</h3>
<p>En Proceso</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="small-box bg-info">
<div class="inner">
<h3 id="kpiCliente">0</h3>
<p>Enviado Cliente</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="small-box bg-dark">
<div class="inner">
<h3 id="kpiRiesgo">0</h3>
<p>Riesgo >10 días</p>
</div>
</div>
</div>

</div>

<!-- GRAFICO -->

<div class="row">

<div class="col-md-12">

<div class="card">

<div class="card-header bg-success text-white">
Análisis de Antigüedad de Pendientes
</div>

<div class="card-body">

<canvas id="graficoPendientes" height="100"></canvas>

</div>

</div>

</div>

</div>

<!-- TABLA -->

<div class="row">

<div class="col-md-12">

<div class="card">

<div class="card-header bg-success text-white">
Detalle de Pendientes
</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-hover text-center">

<thead class="thead-dark">

<tr>
<th>OS</th>
<th>Unidad</th>
<th>Estado</th>
<th>Días</th>
<th>Pago</th>
<th>Factura</th>
</tr>

</thead>

<tbody id="tablaPendientes"></tbody>

</table>

</div>

</div>

</div>

</div>

</div>
</section>

</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

$(document).ready(function(){

cargarPendientes();

});


function cargarPendientes(){

fetch("scripts/controlador_pendientes_dashboard.php")

.then(res=>res.json())

.then(data=>{

let totalPendientes=0;
let proceso=0;
let enviado=0;
let riesgo=0;

let rango3=0;
let rango7=0;
let rango10=0;
let rangoMas10=0;

let tabla="";

data.forEach(r=>{

totalPendientes++;

if(r.estado_informe=="En Proceso") proceso++;
if(r.estado_informe=="Enviado Cliente") enviado++;

if(r.dias>10) riesgo++;

if(r.dias<=3) rango3++;
else if(r.dias<=7) rango7++;
else if(r.dias<=10) rango10++;
else rangoMas10++;

let color="";

if(r.dias<=3) color="table-success";
else if(r.dias<=7) color="table-warning";
else color="table-danger";

tabla+=`
<tr class="${color}">
<td>${r.os}</td>
<td>${r.unidad_negocio}</td>
<td>${r.estado_informe}</td>
<td>${r.dias}</td>
<td>${r.tipo_pago}</td>
<td>${r.estado_factura}</td>
</tr>
`;

});

document.getElementById("tablaPendientes").innerHTML=tabla;

document.getElementById("kpiPendientes").innerText=totalPendientes;
document.getElementById("kpiProceso").innerText=proceso;
document.getElementById("kpiCliente").innerText=enviado;
document.getElementById("kpiRiesgo").innerText=riesgo;

crearGrafico(rango3,rango7,rango10,rangoMas10);

});

}


function crearGrafico(a,b,c,d){

const ctx=document.getElementById("graficoPendientes");

new Chart(ctx,{

type:'bar',

data:{

labels:['0-3 días','4-7 días','8-10 días','+10 días'],

datasets:[{

label:'Pendientes',

data:[a,b,c,d],

backgroundColor:[
'green',
'orange',
'yellow',
'red'
]

}]

}

});

}

</script>

</body>
</html>