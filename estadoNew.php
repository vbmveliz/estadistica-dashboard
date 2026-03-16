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
                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="background: #00C262; color: white;">
                                    <h3 class="card-title">Estado IE</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <form>
                                            <div class="row">
                                                <div class="col-6">
                                                    <select class="form-control" id="anio" name="anio">
                                                        <option value="2023">2023</option>
                                                        <option value="2022">2022</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <input type="submit" class="btn btn-block" style="background: #92E19A;" id="btnConsultar" value="Consultar">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <br>
                                    <!-- <div class="col-12 text-center">
                                        <h4 id="text1">Status Solicitudes de Ensayo en días <span id="frame"></span></h4>
                                        <h4 id="text2"></h4>
                                    </div> -->
                                    <div id="graficoEstado" class="max-w-100" style="max-height: 600px; height:90vh;">
                                        
                                        <canvas id="chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <table class="table table-bordered m-0 mt-2">
                                    <thead style="background: #00C262; color: white;">
                                        <tr class="h4">
                                        <th></th>
                                        <th>Min</th>
                                        <th>Max</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="color:#0A6E00; background-color:#D9FFC780" class="h4" id="row-1">
                                        <td>Capacidad de Atención del Servicio</td>
                                        <td id="DAMin"></td>
                                        <td id="DAMax"></td>
                                        </tr>
                                        <tr style="color:#113A5B; background-color:#D3EBFF80" class="h4" id="row-2">
                                        <td>Recepción de Muestra</td>
                                        <td id="SEMin"></td>
                                        <td id="SEMax"></td>
                                        </tr>
                                        <tr style="color:#5B115A; background-color:#E9D8FF80" class="h4" id="row-3">
                                        <td>Informe - Laboratorio</td>
                                        <td id="LabMin"></td>
                                        <td id="LabMax"></td>
                                        </tr>
                                        <tr style="color:#AE0C0C; background-color:#FFD8D880" class="h4" id="row-4">
                                        <td>Pre Informe - Laboratorio</td>
                                        <td id="IEMin"></td>
                                        <td id="IEMax"></td>
                                        </tr>
                                        <tr style="color:#A48E00; background-color:#FFF7D880" class="h4" id="row-5">
                                        <td>Informe - Recep.Muestra</td>
                                        <td id="SRMin"></td>
                                        <td id="SRMax"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="background: #00C262; color: white;">
                                    <h3 class="card-title">Tabla Resumen</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="font-size: 14px;">
                                    <div style="overflow-x: auto;">
                                        <table class="table text-center table-bordered table-striped" id="tablaMes">
                                            <thead class="bg-dark">
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th colspan="2">Capacidad de Atención del Servicio</th>
                                                    <th colspan="2">Recepción de Muestra</th>
                                                    <th colspan="2">Informe - Laboratorio</th>
                                                    <th colspan="2">Pre Informe - Laboratorio</th>
                                                    <th colspan="2">Informe - Recep.Muestra</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th>Mes</th>
                                                    <th>Día</th>
                                                    <th>Año</th>
                                                    <th>N° IE</th>
                                                    <th>N° IE * Días</th>
                                                    <th>N° IE</th>
                                                    <th>N° IE * Días</th>
                                                    <th>N° IE</th>
                                                    <th>N° IE * Días</th>
                                                    <th>N° IE</th>
                                                    <th>N° IE * Días</th>
                                                    <th>N° IE</th>
                                                    <th>N° IE * Días</th>
                                                    <th>D. General</th>
                                                    <th>D. Resumida</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbMes">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <footer class="main-footer">
        <strong>Copyright &copy; 2023 <a href="https://Hullasoft.com.pe/">Hullasoft</a>.</strong>
        Reservados todos los derechos.
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>
<!-- The Modal -->
<div class="modal" id="myModal1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 1500px;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body" style="overflow:scroll; width: 100%; height: 800px;">
                <div class="table-responsive" style="font-size: 14px;">
                    <table class="table table-striped" style="width: 100%;" id="padreTablaDetalleGeneral">
                        <thead class="thead thead-dark">
                            <tr>
                                <th>Fecha Hasta HT</th>
                                <th>Fecha Rec</th>
                                <th>Fecha Act Ped</th>
                                <th>Día</th>
                                <th>Mes</th>
                                <th>Año</th>
                                <th>N# Certificado</th>
                            </tr>
                        </thead>
                        <tbody id="tablaDetalleGeneral">
                        </tbody>
                        </table>
                    </div>
            </div>    
        </div> 
    </div>
</div>
<div class="modal" id="myModal2">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 1500px;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body" style="overflow:scroll; width: 100%; height: 800px;">
                <div class="table-responsive" style="font-size: 14px;">
                    <table class="table table-striped" style="width: 100%;" id="padreTablaDetalleResumido">
                        <thead class="bg-dark">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th colspan="2">Capacidad de Atención del Servicio</th>
                                <th colspan="2">Recepción de Muestra</th>
                                <th colspan="2">Informe - Laboratorio</th>
                                <th colspan="2">Pre Informe - Laboratorio</th>
                                <th colspan="2">Informe - Recep.Muestra</th>
                            </tr>
                            <tr>
                                <th>Mes</th>
                                <th>Día</th>
                                <th>Año</th>
                                <th>N° IE</th>
                                <th>N° IE * Días</th>
                                <th>N° IE</th>
                                <th>N° IE * Días</th>
                                <th>N° IE</th>
                                <th>N° IE * Días</th>
                                <th>N° IE</th>
                                <th>N° IE * Días</th>
                                <th>N° IE</th>
                                <th>N° IE * Días</th>
                            </tr>
                        </thead>
                        <tbody id="tablaDetalleResumido">
                        </tbody>
                    </table>
                </div>
            </div>    
        </div> 
    </div>
</div>

</div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- <script src="plugins/chart.js/Chart.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datHullasoftels@2.0.0"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>


<script src="dist/idioma/espanol.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- Page specific script -->
<!-- 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

Chart -->

<!-- High Charts -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/cylinder.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script>

    // Valores Globales
    var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    function makeChart(){

        $('#graficoEstado').empty();
        $('#graficoEstado').append('<canvas id="chart"></canvas>');
        var gfx = document.getElementById('chart');
        var ctx = gfx.getContext('2d');
        var year = $('#anio').val();

        // GRAFICOS
        $.ajax({
            url:'scripts/controlador_general_estado.php',
            data: {ano:year},
            type: 'POST'
        }).then(function(respuesta){

        // FIX ME
        // console.log(respuesta);
        // console.log("--------------------------------------------------")
        var numerosDiferentes = new Set();
        var grupoMesDias_capacidad_atencion = [];
        var grupoMesDias_recepcion_de_muestra = [];
        var grupoMesDias_informe_laboratorio = [];
        var grupoMesDias_preInforme_laboratorio = [];
        var grupoMesDias_informe_recep_muestra  = [];
        var data = JSON.parse(respuesta);
        // console.log(data);
        for (var mes = 1; mes <= 12; mes++) {
            var month_number = String(mes).padStart(2, '0');
            var cantidadDias_capacidad_atencion = 0;
            var cantidadDias_recepcion_de_muestra = 0;
            var cantidadDias_informe_laboratorio = 0;
            var cantidadDias_preInforme_laboratorio = 0;
            var cantidadDias_informe_recep_muestra  = 0;
            data['statistics'].forEach(datos => {
                numerosDiferentes.add(datos[0]);
                if (datos[0] === month_number) {
                    var numeroDias_capacidad_atencion = datos[3];
                    var numeroDias_recepcion_de_muestra = datos[6];
                    var numeroDias_informe_laboratorio = datos[9];
                    var numeroDias_preInforme_laboratorio = datos[12];
                    var numeroDias_informe_recep_muestra = datos[15];
                    cantidadDias_capacidad_atencion += numeroDias_capacidad_atencion;
                    cantidadDias_recepcion_de_muestra += numeroDias_recepcion_de_muestra;
                    cantidadDias_informe_laboratorio += numeroDias_informe_laboratorio;
                    cantidadDias_preInforme_laboratorio += numeroDias_preInforme_laboratorio;
                    cantidadDias_informe_recep_muestra += numeroDias_informe_recep_muestra;
                }
            });
            grupoMesDias_capacidad_atencion.push(cantidadDias_capacidad_atencion);
            grupoMesDias_recepcion_de_muestra.push(cantidadDias_recepcion_de_muestra);
            grupoMesDias_informe_laboratorio.push(cantidadDias_informe_laboratorio);
            grupoMesDias_preInforme_laboratorio.push(cantidadDias_preInforme_laboratorio);
            grupoMesDias_informe_recep_muestra.push(cantidadDias_informe_recep_muestra);
        }
        grupoMesDias_capacidad_atencion = grupoMesDias_capacidad_atencion.filter(valor => valor !== 0 && valor !== "");
        grupoMesDias_recepcion_de_muestra = grupoMesDias_recepcion_de_muestra.filter(valor => valor !== 0 && valor !== "");
        grupoMesDias_informe_laboratorio = grupoMesDias_informe_laboratorio.filter(valor => valor !== 0 && valor !== "");
        grupoMesDias_preInforme_laboratorio = grupoMesDias_preInforme_laboratorio.filter(valor => valor !== 0 && valor !== "");
        grupoMesDias_informe_recep_muestra = grupoMesDias_informe_recep_muestra.filter(valor => valor !== 0 && valor !== "");

        var nombresMeses = Array.from(numerosDiferentes).map(numero => {
            var indiceMes = parseInt(numero) - 1;
            return meses[indiceMes];
        }).filter(nombreMes => nombreMes !== undefined);

            // me code
        var frame =nombresMeses[0]+" a "+nombresMeses[nombresMeses.length-1]+" "+year;
            // me code
        var numeroCapacidadAtencion = [];
        var numeroRecepcionSolicitud = [];
        var numeroSolicitudLaboratorio = [];
        var numeroEmisionIe = [];
        var numeroSolicitudRecepcion = [];

        const datosTitulo =  data['title'];

        let atttibrutes = {
            byAttentionCapacity: [datosTitulo[0]['MAX'], datosTitulo[0]['MIN']].map(parseFloat),
            byRequestReception:  [datosTitulo[1]['MAX'], datosTitulo[1]['MIN']].map(parseFloat),
            byRequestLaboratory:  [datosTitulo[2]['MAX'], datosTitulo[2]['MIN']].map(parseFloat),
            byEmisionIe:  [datosTitulo[3]['MAX'], datosTitulo[3]['MIN']].map(parseFloat),
            receptionRequest:  [datosTitulo[4]['MAX'], datosTitulo[4]['MIN']].map(parseFloat),
        }

        numeroCapacidadAtencion.push(atttibrutes.byAttentionCapacity);
        numeroRecepcionSolicitud.push(atttibrutes.byRequestReception);
        numeroSolicitudLaboratorio.push(atttibrutes.byRequestLaboratory);
        numeroEmisionIe.push(atttibrutes.byEmisionIe);
        numeroSolicitudRecepcion.push(atttibrutes.receptionRequest);

        let minimoCapacidadAtencion = Math.min.apply(null, ...numeroCapacidadAtencion).toFixed(1);
        let minimoRecepcionSolicitud = Math.min.apply(null, ...numeroRecepcionSolicitud).toFixed(1);
        let minimoSolicitudLaboratorio = Math.min.apply(null, ...numeroSolicitudLaboratorio).toFixed(1);
        let minimoEmisionIe = Math.min.apply(null, ...numeroEmisionIe).toFixed(1);
        let minimoSolicitudRecepcion = Math.min.apply(null, ...numeroSolicitudRecepcion).toFixed(1);
        let maximoCapacidadAtencion = Math.max.apply(null, ...numeroCapacidadAtencion).toFixed(1);
        let maximoRecepcionSolicitud = Math.max.apply(null, ...numeroRecepcionSolicitud).toFixed(1);
        let maximoSolicitudLaboratorio = Math.max.apply(null, ...numeroSolicitudLaboratorio).toFixed(1);
        let maximoEmisionIe = Math.max.apply(null, ...numeroEmisionIe).toFixed(1);
        let maximoSolicitudRecepcion = Math.max.apply(null, ...numeroSolicitudRecepcion).toFixed(1);
        
        let statusS = [
            minimoCapacidadAtencion,
            minimoRecepcionSolicitud,
            minimoSolicitudLaboratorio,
            minimoEmisionIe,
            minimoSolicitudRecepcion,
            maximoCapacidadAtencion,
            maximoRecepcionSolicitud,
            maximoSolicitudLaboratorio,
            maximoEmisionIe,
            maximoSolicitudRecepcion,
        ];
        
        document.getElementById("DAMin").textContent = statusS[0];
        document.getElementById("SEMin").textContent = statusS[1];
        document.getElementById("LabMin").textContent = statusS[2];
        document.getElementById("IEMin").textContent = statusS[3];
        document.getElementById("SRMin").textContent = statusS[4];
        document.getElementById("DAMax").textContent = statusS[5];
        document.getElementById("SEMax").textContent = statusS[6];
        document.getElementById("LabMax").textContent = statusS[7];
        document.getElementById("IEMax").textContent = statusS[8];
        document.getElementById("SRMax").textContent = statusS[9];
        
        // document.getElementById("text2").innerHTML =
        // "Capacidad de Atención del Servicio: Mínimo: "+statusS[0]+" Días - Máximo: "+(statusS[5])+" Días";
        // FIX ME

        Highcharts.chart('graficoEstado', {
            plotOptions: {
                line:{
                    lineWidth:0.5
                },
                series: {
                    marker: {
                        symbol: 'circle',
                    },
                    events: {
                        legendItemClick: function (event) {
                            event.preventDefault(); // Desactiva el comportamiento predeterminado de Highcharts
                            var chart = this.chart;
                            var series = this;
                            var act = 0;
                            for (let f = 0; f < 5; f++) {
                                if(chart.series[f].visible){
                                    ++act;
                                }
                            }
                            // console.log(act);
                            if(series.index == 0 && !series.visible){
                                //  console.log("Mostrar Todos");
                                this.chart.subtitle.update ({
                                    text: "Capacidad de Atención del Servicio: Mínimo: "+ statusS[0]+" Días - Máximo: "+(statusS[5])+" Días",
                                })
                                for (let i = 0; i < 5; i++) {
                                    chart.series[i].setVisible(true, false);
                                    chart.series[(i+5)].setVisible(false, false);
                                }
                                chart.series[(5)].setVisible(true, false);
                            }else{
                                if( (act > 1 && series.visible) ){
                                    // console.log("Mostrar solo 1");
                                    // console.log(this.chart.series[series.index].name);
                                    this.chart.subtitle.update ({
                                        text: this.chart.series[series.index].name+": Mínimo: "+ statusS[0]+" Días - Máximo: "+(statusS[5])+" Días",
                                    })
                                    for (let i = 0; i < 5; i++) {
                                        // console.log(chart.series[i]);
                                        chart.series[i].setVisible(false, false);
                                        chart.series[(i+5)].setVisible(false, false);
                                        if (i === series.index) {
                                            series.setVisible(true, false);
                                            chart.series[(i+5)].setVisible(true, false);
                                        }
                                    }
                                }else{
                                    // console.log("Mostrar Otro 1");
                                    // console.log(this.chart.series[series.index].name);
                                    if (!series.visible) {
                                        this.chart.subtitle.update ({
                                            text: this.chart.series[series.index].name+": Mínimo: "+ statusS[series.index]+" Días - Máximo: "+(statusS[series.index+5])+" Días",
                                        })
                                        for (let i = 0; i < 5; i++) {
                                            // console.log(chart.series[i]);
                                            chart.series[i].setVisible(false, false);
                                            chart.series[(i+5)].setVisible(false, false);
                                            if (i === series.index) {
                                                series.setVisible(true, false);
                                                chart.series[(i+5)].setVisible(true, false);
                                            }
                                        }
                                    }else{
                                        // console.log("Quitar seleccion y Desocultar todos");
                                        this.chart.subtitle.update ({
                                            text: "Capacidad de Atención del Servicio: Mínimo: "+ statusS[0]+" Días - Máximo: "+(statusS[5])+" Días",
                                        })
                                        for (let i = 0; i < 5; i++) {
                                            chart.series[i].setVisible(true, false);
                                            chart.series[(i+5)].setVisible(false, false);
                                        }

                                        
                                        this.chart.series[(5)].data.forEach(function(e,n){
                                            // console.log(e);
                                            // console.log(n);
                                            e.plotX = e.plotX + 10;
                                            e.plotY = e.plotX + 30;
                                            // e.color= "rgba(255,255,255)";
                                            
                                            // e.plotX = 1;
                                            // e.plotY = 1;
                                            // e.series[n] = {};
                                            // console.log(e.series.data[0].plotX );
                                            // console.log(e.plotX );
                                            // e.series.data[0].plotX = 1;
                                            // e.series.data[0].plotY = 1;
                                        });
                                        chart.series[(5)].setVisible(true, false);
                                        // console.log(this.chart.series[(5)]);
                                    }
                                }
                            }
                            chart.redraw(); 
                        }
                    },
                    // datHullasoftels: {
                    //     enabled: true,
                    //     style: {
                    //         fontWeight: 'normal' // Cambia el estilo del texto a normal (sin negrita)
                    //     }
                    // }
                }
            },
            chart: {
                options3d: {
                    enabled: false,
                    // alpha: 30,
                    // beta: 10,
                    alpha: 20,
                    beta: 0,
                    depth: 50,
                    viewDistance: 0
                },
                events: {
                    load: function () {
                        var chart = this;
                        var legend = chart.legend;
                        function updateLegendAlignment() {
                        // Verificar el tamaño del gráfico y ajustar la alineación de la leyenda
                        if (chart.chartWidth <= 800) {
                            legend.update({ 
                                verticalAlign: 'bottom',
                                align: 'center',
                            });
                        } else {
                            legend.update({ 
                                verticalAlign: 'middle',
                                align: 'right',
                            });
                        }
                        // Redibujar el gráfico con la alineación de la leyenda actualizada
                        chart.reflow();
                        }
                        // Actualizar la alineación de la leyenda al cargar el gráfico
                        updateLegendAlignment();
                        // Actualizar la alineación de la leyenda al cambiar el tamaño de la ventana
                        window.onresize = updateLegendAlignment;
                        // Máximo 
                        var chart = this;
                        var dataMax = Math.max(...chart.series[0].data.map(function (point) {
                            return point.y;
                        })); 
                        var maxWithIncrease = dataMax * 1.1;
                        chart.yAxis[0].update({ max: Math.ceil(maxWithIncrease) });
                    },
                }
            },
            title: {
                text: "Status Solicitudes de Ensayo en días "+ frame+"",
            },
            subtitle: {
                text: "Capacidad de Atención del Servicio: Mínimo: "+ statusS[0]+" Días - Máximo: "+(statusS[5])+" Días",
                style: {
                    fontWeight: 'bold'
                }
            },
            xAxis: {
                categories: meses,
                title: {
                    text: ''
                },
            
            },
            yAxis: {
                title: {
                    text: ''
                },
                // max: 30
            },
            // tooltip: {
            //     headerFormat: '<b>Age: {point.x}</b><br>'
            // },
            legend:{
                enabled: true,
                itemStyle: {
                    fontSize: '0.8rem',
                },
                layout: 'vertical',
                itemWidth: "230",
                align: 'right', // Alinación horizontal (left, center, right)
                verticalAlign: 'middle' // Alinación vertical (top, middle, bottom)
            },
            // VALORES
            series: [
                {
                    data: grupoMesDias_capacidad_atencion.map(valor => parseFloat(valor)),
                    // data: [20,20,20,20,20],
                    name: 'Capacidad de Atención del Servicio',
                    showInLegend: true,
                    type: 'cylinder',
                    color: 'rgba(100, 221, 96, 0.5)',
                },
                {
                    data: grupoMesDias_recepcion_de_muestra.map(valor => parseFloat(valor)),
                    name: 'Recepción de Muestra',
                    showInLegend: true,
                    type: 'cylinder',
                    color: 'rgba(112, 157, 255,0.5)',
                },
                {
                    data: grupoMesDias_informe_laboratorio.map(valor => parseFloat(valor)),
                    name: 'Informe - Laboratorio',
                    showInLegend: true,
                    type: 'cylinder',
                    color: 'rgba(164, 33, 255,0.5)',
                },
                {
                    data: grupoMesDias_preInforme_laboratorio.map(valor => parseFloat(valor)),
                    name: 'Pre - Informe - Laboratorio',
                    showInLegend: true,
                    type: 'cylinder',
                    color: 'rgba(255, 105, 130,0.5)',
                },
                {
                    data: grupoMesDias_informe_recep_muestra.map(valor => parseFloat(valor)),
                    name: 'Informe - Recep. Muestra',
                    showInLegend: true,
                    type: 'cylinder',
                    color: 'rgba(255, 221, 105,0.6)',
                },
                //Lineas
                {
                    data: grupoMesDias_capacidad_atencion.map(valor => parseFloat(valor)),
                    name: 'Capacidad de Atención del Servicio',
                    showInLegend: false,
                    visible: true,
                    type:"line",
                    color: 'rgba(10, 148, 0)',
                    events: {
                        render: function () {
                            max = 0;
                            for (let i = 0; i <= this.chart.series.length; i++) {
                                if(max < this.data[i].y){
                                    max = this.data[i].y;
                                }
                            }
                            for (let i = 0; i <= this.chart.series.length; i++) {
                                // console.log(this);
                                this.data[i].plotX = this.chart.series[0].data[i].barX + (this.chart.series[0].data[i].shapeArgs.width / 2);
                                this.data[i].plotY += (this.data[i].y - (max - this.data[i].y));
                            }    
                        }
                    }
                },
                {
                    data: grupoMesDias_recepcion_de_muestra.map(valor => parseFloat(valor)),
                    name: 'Recepción de Muestra',
                    showInLegend: false,
                    visible: false,
                    type:"line",
                    color: 'rgba(62, 107, 205)',
                    events: {
                        render: function () {
                            max = 0;
                            for (let i = 0; i <= this.chart.series.length; i++) {
                                if(max < this.data[i].y){
                                    max = this.data[i].y;
                                }
                            }
                            for (let i = 0; i <= this.chart.series.length; i++) {
                                // console.log(this);
                                // this.data[i].plotX = this.chart.series[0].data[i].barX + (this.chart.series[0].data[i].shapeArgs.width / 2);
                                this.data[i].plotY += (this.data[i].y - (max - this.data[i].y));
                            }      
                        }
                    }
                },
                {
                    data: grupoMesDias_informe_laboratorio.map(valor => parseFloat(valor)),
                    name: 'Informe - Laboratorio',
                    showInLegend: false,
                    visible: false,
                    type:"line",
                    color: 'rgba(114, 33, 205)',
                    events: {
                        render: function () {
                            max = 0;
                            for (let i = 0; i <= this.chart.series.length; i++) {
                                if(max < this.data[i].y){
                                    max = this.data[i].y;
                                }
                            }
                            for (let i = 0; i <= this.chart.series.length; i++) {
                                // console.log(this);
                                // this.data[i].plotX = this.chart.series[0].data[i].barX + (this.chart.series[0].data[i].shapeArgs.width / 2);
                                this.data[i].plotY += (this.data[i].y - (max - this.data[i].y));
                            }       
                        }
                    }
                },
                {
                    data: grupoMesDias_preInforme_laboratorio.map(valor => parseFloat(valor)),
                    name: 'Pre - Informe - Laboratorio',
                    showInLegend: false,
                    visible: false,
                    type:"line",
                    color: 'rgba(205, 55, 80)',
                    events: {
                        render: function () {
                            max = 0;
                            for (let i = 0; i <= this.chart.series.length; i++) {
                                if(max < this.data[i].y){
                                    max = this.data[i].y;
                                }
                            }
                            for (let i = 0; i <= this.chart.series.length; i++) {
                                // console.log(this);
                                // this.data[i].plotX = this.chart.series[0].data[i].barX + (this.chart.series[0].data[i].shapeArgs.width / 2);
                                this.data[i].plotY += (this.data[i].y - (max - this.data[i].y));
                            }        
                        }
                    }
                },
                {
                    data: grupoMesDias_informe_recep_muestra.map(valor => parseFloat(valor)),
                    name: 'Informe - Recep. Muestra',
                    showInLegend: false,
                    visible: false,
                    type:"line",
                    color: 'rgba(155, 121, 5)',
                    events: {
                        render: function () {
                            max = 0;
                            for (let i = 0; i <= this.chart.series.length; i++) {
                                if(max < this.data[i].y){
                                    max = this.data[i].y;
                                }
                            }
                            for (let i = 0; i <= this.chart.series.length; i++) {
                                // console.log(this);
                                // this.data[i].plotX = this.chart.series[0].data[i].barX + (this.chart.series[0].data[i].shapeArgs.width / 2);
                                this.data[i].plotY += (this.data[i].y - (max - this.data[i].y));
                            }       
                        }
                    }
                },
            ],
        });
    });
        // TABLA
    $.ajax({
        // Dirección
        url:'scripts/controlador_general_estado_grafico.php',
        // Parámetro
        data: {ano:year},
        // Método
        type: 'POST'
        // Respuesta
    }).done(function(respuesta){
        let template = '';
        var data = JSON.parse(respuesta);
        data.forEach(datosSuma => {
            
            var numeroMes = datosSuma[0];
            var nombreMes = meses[numeroMes - 1];
            template += `   
                        <tr>
                            <td>${nombreMes}</td>
                            <td>${datosSuma[1]}</td>
                            <td>${datosSuma[2]}</td>
                            <td>${datosSuma[3]}</td>
                            <td>${datosSuma[4]}</td>
                            <td>${datosSuma[5]}</td>
                            <td>${datosSuma[6]}</td>
                            <td>${datosSuma[7]}</td>
                            <td>${datosSuma[8]}</td>
                            <td>${datosSuma[9]}</td>
                            <td>${datosSuma[10]}</td>
                            <td>${datosSuma[11]}</td>
                            <td>${datosSuma[12]}</td>
                            <td><button class="btn btn-warning" style="font-size: 14px;" mes="${datosSuma[0]}" dia="${datosSuma[1]}" anio="${datosSuma[2]}" onclick="mostrar(this)" data-toggle="modal" data-target="#myModal1"><i class="fa-solid fa-database"></i></button></td>
                            <td><button class="btn btn-success" style="font-size: 14px;" mesResumen="${datosSuma[0]}" diaResumen="${datosSuma[1]}" anioResumen="${datosSuma[2]}" onclick="mostrarResumen(this)" data-toggle="modal" data-target="#myModal2"><i class="fa-solid fa-server"></i></button></td>
                        </tr>
                        `;
        });
        $('#tbMes').empty();
        $('#tablaMes').DataTable().destroy();
        $('#tbMes').html(template);
        $('#tablaMes').DataTable({
            language: idioma_espanol,
            ordering: false
        });
    });
}


    makeChart();

    $('#btnConsultar').click(function(){
        event.preventDefault();
        makeChart();
    });

</script>
</body>
</html>








<!-- 

Highcharts.chart('graficoEstado', {
            chart: {
                options3d: {
                    enabled: false,
                    // alpha: 30,
                    // beta: 10,
                    alpha: 20,
                    beta: 0,
                    depth: 50,
                    viewDistance: 0
                }
            },
            events: {
                load: function() {
                    alert("evento render");
                }
            },
            title: {
                text: 'Number of confirmed COVID-19'
            },
            subtitle: {
                text: 'Source: ' +
                    '<p href="https://www.fhi.no/en/id/infectious-diseases/coronavirus/daily-reports/daily-reports-COVID19/"' +
                    'target="_blank">FHI</p>'
            },
            xAxis: {
                // MESES
                categories: ['0-9', '10-19', '20-29', '30-39', '40-49', '50-59', '60-69', '70-79', '80-89', '90+'],
                title: {
                    text: 'Age groups'
                }
            },
            yAxis: {
                title: {
                    margin: 20,
                    text: 'Reported cases'
                }
            },
            tooltip: {
                headerFormat: '<b>Age: {point.x}</b><br>'
            },
            // VALORES
            series: [
                {
                    data: [2,4,7,9,6],
                    name: 'Serie 1',
                    showInLegend: false,
                    type: 'cylinder',
                    color: "orange",
                },
                {
                    data: [6,4,8,2,9],
                    name: 'Serie 1',
                    showInLegend: false,
                    type: 'cylinder',
                    color: "orange",
                },
                {
                    data:[1,9,2,7,3],
                    name: 'Serie 1',
                    showInLegend: false,
                    type: 'cylinder',
                    color: "orange",
                },
                {
                    data:  [9,2,4,7,9],
                    name: 'Serie 1',
                    showInLegend: false,
                    type: 'cylinder',
                    color: "orange",
                },
                {
                    data: [5,7,3,8,5],
                    name: 'Serie 1',
                    showInLegend: false,
                    type: 'cylinder',
                    color: "orange",
                },
                //Lineas
                {
                    data: [2,4,7,9,6]
                    name: 'Serie 2',
                    showInLegend: false,
                    type:"line",
                    color: "blue",
                },
                {
                    data:  [6,4,8,2,9],
                    name: 'Serie 2',
                    showInLegend: false,
                    type:"line",
                    color: "blue",
                },
                {
                    data: [1,9,2,7,3],
                    name: 'Serie 2',
                    showInLegend: false,
                    type:"line",
                    color: "blue",
                },
                {
                    data: [9,2,4,7,9],
                    name: 'Serie 2',
                    showInLegend: false,
                    type:"line",
                    color: "blue",
                },
                {
                    data: [5,7,3,8,5],
                    name: 'Serie 2',
                    showInLegend: false,
                    type:"line",
                    color: "blue",
                },
                
            ],
        });
    }); -->




