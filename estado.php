<?php 
include 'header.php';
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">

<div class="col-sm-6">
<h1>Estado OS - Status</h1>
</div>

<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item active">Estado OS - Status</li>
</ol>
</div>

</div>
</div>
</section>


<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-md-8">

<div class="card">

<div class="card-header bg-success text-white">
<h3 class="card-title">Estado IE</h3>
</div>

<div class="card-body">

<form>

<div class="row">

<div class="col-6">
<label>Fecha Inicio (Fecha Pre-Informe)</label>
<input type="date" class="form-control" id="fechaInicio">
</div>

<div class="col-6">
<label>Fecha Final (Fecha Informe)</label>
<input type="date" class="form-control" id="fechaFinal">
</div>

<div class="col-6">
<label>Tipo</label>

<select class="form-control" id="tipo">
<option value="Sin filtro">Sin filtro</option>
<option value="Con Resultados">Con Resultados</option>
<option value="En Proceso">En Proceso</option>
<option value="Enviado Cliente">Enviado Cliente</option>
</select>

</div>

<div class="col-6">

<label>Unidad De Negocio</label>

<select class="form-control" id="unidadNegocio">

<option value="Sin filtro">Sin filtro</option>
<option value="0000000001">Medio Ambiente</option>
<option value="0000000002">Agronomía</option>
<option value="0000000003">Alimentos</option>
<option value="0000000004">Geoquímica</option>
<option value="0000000005">Metrología</option>

</select>

</div>

<div class="col-12 mt-2">
<input type="button" class="btn btn-success btn-block" id="btnConsultar" value="Consultar">
</div>

</div>

</form>

<div class="mt-4">
<canvas id="grafico"></canvas>
</div>

</div>
</div>
</div>


<div class="col-md-4">

<div class="card">

<div class="card-header bg-success text-white">
<h3 class="card-title">Pendientes</h3>
</div>

<div class="card-body p-2">

<div class="table-responsive">

<table class="table table-sm table-bordered text-center">

<thead class="thead-dark">

<tr>
<th>OS</th>
<th>Unidad</th>
<th>Estado</th>
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


<div class="col-md-12">

<div class="card">

<div class="card-header bg-success text-white">
<h3 class="card-title">Detalle IE</h3>
</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-striped">

<thead class="thead-dark">

<tr>

<th>N°</th>
<th>Orden</th>
<th>Unidad</th>
<th>Estado OS</th>
<th>Tipo Pago</th>
<th>Estado Factura</th>
<th>Nro Informe</th>
<th>F Informe</th>
<th>F Muestra</th>
<th>Estado Informe</th>
<th>F Pre Informe</th>
<th>F Cliente</th>
<th>Trabajo Pendiente</th>

</tr>

</thead>

<tbody id="tablaDetalleInformeInicio"></tbody>

</table>

</div>

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

/* =========================
INICIO
========================= */

$(document).ready(function(){

cargarTabla();
cargarPendientes();
cargarGrafico();

});


/* =========================
BOTON CONSULTAR
========================= */

$("#btnConsultar").click(function(){

cargarTabla();
cargarGrafico();

});


/* =========================
TABLA DETALLE
========================= */

function cargarTabla(){

let fechaInicio = $("#fechaInicio").val();
let fechaFinal = $("#fechaFinal").val();
let tipo = $("#tipo").val();
let unidad = $("#unidadNegocio").val();

$.ajax({

url:"scripts/controlador_datos_tabla_general.php",
type:"POST",

data:{
fechaInicio:fechaInicio,
fechaFinal:fechaFinal,
tipo:tipo,
unidad:unidad
},

success:function(res){

let data=JSON.parse(res);

let html="";
let c=1;

data.forEach(d=>{

html+=`
<tr>
<td>${c++}</td>
<td>${d.os}</td>
<td>${d.unidad_negocio}</td>
<td>${d.estado_os}</td>
<td>${d.tipo_pago}</td>
<td>${d.estado_factura}</td>
<td>${d.numero_informe}</td>
<td>${d.fecha_informe}</td>
<td>${d.fecha_inicio_muestra}</td>
<td>${d.estado_informe}</td>
<td>${d.fecha_preinforme}</td>
<td>${d.fecha_envio_cliente}</td>
<td>${d.trabajo_pendiente}</td>
</tr>
`;

});

$("#tablaDetalleInformeInicio").html(html);

}

});

}


/* =========================
PENDIENTES
========================= */

function cargarPendientes(){

fetch("scripts/controlador_pendientes.php")

.then(res=>res.json())

.then(data=>{

let html="";

data.forEach(r=>{

html+=`
<tr>
<td>${r.os}</td>
<td>${r.unidad_negocio}</td>
<td>${r.estado_os}</td>
<td>${r.tipo_pago}</td>
<td>${r.estado_factura}</td>
</tr>
`;

});

$("#tablaPendientes").html(html);

});

}


/* =========================
GRAFICO
========================= */

function cargarGrafico(){

let fechaInicio = $("#fechaInicio").val();
let fechaFinal = $("#fechaFinal").val();

$.ajax({

url:"scripts/controlador_linea.php",
type:"POST",

data:{
fechaInicio:fechaInicio,
fechaFinal:fechaFinal
},

success:function(res){

let data=JSON.parse(res);

let labels=[];
let resultado=[];
let proceso=[];
let enviado=[];

data.forEach(d=>{

labels.push(d.fecha);
resultado.push(d.resultado);
proceso.push(d.proceso);
enviado.push(d.enviado);

});

new Chart(document.getElementById('grafico'),{

type:'bar',

data:{

labels:labels,

datasets:[

{
label:'Con Resultados',
data:resultado,
backgroundColor:'blue'
},

{
label:'En Proceso',
data:proceso,
backgroundColor:'orange'
},

{
label:'Enviado Cliente',
data:enviado,
backgroundColor:'green'
}

]

}

});

}

});

}

</script>

</body>
</html>