<?php 

include 'header.php';

$MG = new Modelo_Grafico();
$consulta = $MG -> TraerDatosLinealIeTotalTabla();

$total = 0;
foreach ($consulta as $key => $value) {
    $total += $value[1];
}
?>
    <div class="content-wrapper">
        <!-- <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1>Estado OS - Status</h1>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Estado OS - Status</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section> -->
        <section class="content mt-2">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-5">
                        <div class="card">
                            <div class="card-header py-1" style="background: #00C262; color: white;">
                                <h3 class="card-title text-sm py-0">Estado IE General</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <form>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="text-white">
                                                        <div class="form-group">
                                                            <input type="date" class="form-control text-sm" id="fechaInicio"
                                                                <?php $ano = date("Y");?>
                                                            min="<?php echo '2023';?>-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo $ano;?>-01-01">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-white">
                                                        <div class="d-flex justify-content-center">
                                                        <input type="date" class="form-control text-sm" id="fechaFinal"
                                                        min="<?php echo $fecha;?>" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <select class="form-control text-sm" id="rangos">
                                                            <option>>=0</option>
                                                            <option><= 2</option>
                                                            <option><= 4</option>
                                                            <option><= 6</option>
                                                            <option><= 8</option>
                                                            <option><= 10</option>
                                                            <option>>10</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <button type="submit" class="btn btn-block text-sm" style="background: #92E19A;" id="btnConsultar">Consultar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-6" id="total"></div>
                                    <div class="col-6" id="resultado"></div>
                                    <div class="col-6" id="proceso"></div>
                                    <div class="col-6" id="enviado"></div>
                                </div>
                                <div class="chart" id="graficoEstado"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header py-1" style="background: #00C262; color: white;">
                                <h3 class="card-title text-sm">Estado IE Unidad de Negocio</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div style="overflow:scroll;">
                                    <div class="row" id="unidadDeNegocio">
                                    </div> 
                                </div>                                                   
                            </div>   
                        </div>                  
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-1" style="background: #00C262; color: white;">
                                <h3 class="card-title">Tabla General</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="text-sm">
                                                <div class="py-0" id="totalTabla">
                                                </div>
                                                <table id="tablaGeneral" class="table table-striped">
                                                    <thead class="thead thead-dark p-0">
                                                        <tr>
                                                            <th class="py-1" style="font-size: 0.7rem;">Estado</th>
                                                            <th class="py-1" style="font-size: 0.7rem;">Cantidad</th>
                                                            <th class="py-1" style="font-size: 0.7rem;">Porcentaje</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tablaResumen">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-8" id="tablaGeneralPie">
                                            <!-- <canvas  width="400" height="400"></canvas> -->
                                        </div>
                                    </div>
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
</div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- Page specific script -->
<script>

        var enlace = document.querySelector('a[href="pendientes_porcentaje.php"]');

    // Verificar si se encontró el enlace
        if (enlace) {
            // Añadir la clase "active"
            enlace.classList.add('active');
        } else {
            // Manejar el caso en el que no se encuentra el enlace
            console.error('No se encontró el enlace con el href especificado.');
        }

    $(function (){
        var fecha = new Date();
        var dia = fecha.getDate();
        var mes = fecha.getMonth() + 1;
        var anio = fecha.getFullYear();
        if(mes < 10){
            mes = "0"+mes;
        }else{
            mes = mes;
        }
        var fechaFinal = anio + '-' + mes + '-' + dia;

        let fechaInicio = anio+"-01-01";
        $('#graficoEstado').empty();
        $('#graficoEstado').append('<div id="line-chart" style="min-height: 400px; max-height: 555px; max-width: 100%;"></div>');
        $.ajax({
            url:'scripts/controlador_linea_porcentaje.php',
            type: 'POST'
        }).done(function(respuesta){
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            var data = JSON.parse(respuesta);
            data.forEach(datos => {
                let numeroResultado = Number(datos[1]);
                let numeroProceso = Number(datos[2]);
                let numeroEnviado = Number(datos[0]);
                totalResultado += numeroResultado;
                totalProceso += numeroProceso;
                totalEnviado += numeroEnviado;
            });
            let totalIE= <?php echo $total;?>;

            var operacionResultado = (totalResultado*100)/totalIE;
            let porcentajeTotalResultado= Number(operacionResultado.toFixed(2));

            var operacionProceso = (totalProceso*100)/totalIE;
            let porcentajeTotalProceso= Number(operacionProceso.toFixed(2));

            var operacionEnviado = (totalEnviado*100)/totalIE;
            let porcentajeTotalEnviado= Number(operacionEnviado.toFixed(2));

            Highcharts.chart('line-chart', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    },
                    events: {
                        load: function () {
                            var chart = this;
                            var points = chart.series[0].points;

                            // Recorrer los puntos del gráfico
                            points.forEach(function (point, index) {
                                var datHullasoftel = point.datHullasoftel; // Obtener la etiqueta de datos

                                // Modificar el color de la etiqueta de datos y el sector del gráfico
                                if (datHullasoftel) {
                                    var color = point.color; // Obtener el color del sector del gráfico
                                    datHullasoftel.css({
                                        color: color, // Establecer el color en la etiqueta de datos
                                        fontSize: '12px'
                                    });
                                    point.graphic.attr({
                                        fill: color // Establecer el color en el sector del gráfico
                                    });
                                }
                            });
                        }
                    }
                },
                title: null,
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        datHullasoftels: {
                            enabled: true,
                            format: '{point.y}%',
                            style: {
                                fontWeight: 'bold',
                                textOutline: 'none',
                                fontSize: '9px'
                            },
                            connectorShape: 'straight',
                            connectorWidth: 1,
                            connectorColor: 'gray',
                            distance: 20
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Datos',
                    data: [{
                        name: 'Con Resultado',
                        y: porcentajeTotalResultado,
                        color: '#0000ff' // Color personalizado para el primer punto de datos
                    }, {
                        name: 'En Proceso',
                        y: porcentajeTotalProceso,
                        color: '#ff0013' // Color personalizado para el segundo punto de datos
                    }, {
                        name: 'Enviado al Cliente',
                        y: porcentajeTotalEnviado,
                        color: '#26c336' // Color personalizado para el tercer punto de datos
                    }],
                    size: '80%',
                    innerSize: '0%',
                    datHullasoftels: {
                        connectorWidth: 1
                    }
                }],
                tooltip: {
                    pointFormat: '<b>{point.y}%</b>'
                }
            });
            let h3Total = `<h6 class="nav-link p-1 text-sm text-justify">Total de Informes: <br>${totalIE} -- 100 %</h6>`;
            let h3Resultado = `<h6 class="nav-link p-1 text-sm text-justify" style="color: rgb(0, 0, 255);">Total con Resultado: <br>${totalResultado} -- ${porcentajeTotalResultado} %</h6>`;
            let h3PRoceso = `<h6 class="nav-link p-1 text-sm text-justify" style="color: rgb(255, 0, 19);">Total con Proceso: <br>${totalProceso} -- ${porcentajeTotalProceso} %</h6>`;
            let h3Enviado = `<h6 class="nav-link p-1 text-sm text-justify" style="color: rgb(38, 195, 54);">Total Enviados al Cliente: <br>${totalEnviado} -- ${porcentajeTotalEnviado} %</h6>`;
            $('#total').html(h3Total);
            $('#resultado').html(h3Resultado);
            $('#proceso').html(h3PRoceso);
            $('#enviado').html(h3Enviado);
        })
        let totalInformeGlobal = <?php echo $total;?>;
        graficoMedioAmbiente(totalInformeGlobal,fechaInicio,fechaFinal,0);
        graficoAgronomia(totalInformeGlobal,fechaInicio,fechaFinal,0);
        graficoAlimentos(totalInformeGlobal,fechaInicio,fechaFinal,0);
        graficoGeoquimico(totalInformeGlobal,fechaInicio,fechaFinal,0);
        graficoCalibracion(totalInformeGlobal,fechaInicio,fechaFinal,0);
        var allValorTodo = [];
        console.log("tabla resumen 1");

        $.ajax({
            url:'scripts/controlador_tabla_resumen.php',
            type: 'POST'
        }).done(function(respuesta){
            console.log("tabla resumen 2");
            // console.log(respuesta);
            let totalIE= <?php echo $total;?>;
            var data = JSON.parse(respuesta);
            let template = "";
            data.forEach(datos => {
                numeroCantidad = Number(datos[1]);
                porcentaje = (numeroCantidad * 100) / totalIE;
                porcentaje =Number(porcentaje.toFixed(2));
                template += `
                            <tr>
                                <td class='py-1' style="font-size: 0.7rem;">${datos[0]}</td>
                                <td class='py-1' style="font-size: 0.7rem;">${datos[1]}</td>
                                <td class='py-1' style="font-size: 0.7rem;">${porcentaje} %</td>
                            </tr>
                            `;
                allValorTodo.push([datos[0],datos[1],porcentaje]);
            });


            var valoresPie = [];

            var datosMain = {
                name: 'Datos',
                data: []
            };
            // console.log("Valores de tabla");
            // console.log(allValorTodo);
            var coloresEmpresariales = {
                "Anulado":"#E30913",
                "Con Resultados":"#ffcc00",
                "Emitido":"#ef7d00",
                "En Proceso":"#006241",
                "Enviado Cliente":"#76C4D5",
                "Guardado por falta de pago":"#cc643d",
                "Inconsistencia":"#6C4175",
                "Inf. Modificado":"#0075C9",
                "Inf.Acumulados":"#263A54",
                "Inf.Trazabilidad":"#a55900",
                "Punto Seco":"#770F00"
            };
            var countColor = 0;
            allValorTodo.forEach(e => {
                var numberInt  = 0;
                try {
                    numberInt = parseInt(e[1]);
                } catch (error) {
                    try {
                        numberInt = parseFloat(e[1]);
                    } catch (error) {
                        console.error("No se puede convertir el número a entero o flotante.");
                    }
                }

                datosMain.data.push({
                    name: e[0],
                    y: numberInt,
                    porcent: e[2],
                    // y: 2,
                    // color: '#0000ff'
                    // color: coloresEmpresariales[countColor]
                    color: coloresEmpresariales[e[0]]
                });

                countColor++;
            });

            $('#tablaGeneralPie').empty();

            // console.log(datosMain);
            Highcharts.chart('tablaGeneralPie', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                    
                },
                title: null,

                plotOptions: {
                    pie: {
                        depth: 35,
                        datHullasoftels: {
                            enabled: true,
                            // Vista simple
                            format: '{point.name} - {point.porcent}%',
                            style: {
                                fontSize: '9px'
                            }
                        }
                    }
                },
                series: [datosMain],
                tooltip: {
                    // Seleccionar
                    pointFormat: '<b>{point.y} - {point.porcent}%</b>'
                }
            });

            // console.log("Tabla General Actualizado");
            totalHtml = `<h6 class="nav-link p-1">Total de Informes: ${totalIE}</h6>`;
            $('#totalTabla').html(totalHtml)
            $('#tablaResumen').html(template);
            console.log("TABLA RESPUESTA 2");

            $(document).ready(function() {
            console.log("TABLA RESPUESTA 1");
            $('#tablaGeneral').DataTable({
                    paging: false,
                    searching: false,
                    info: false
                });
            });
            // console.log("INFORMACIÓN");
            // console.log(data);
            
        })
    });
    $('#btnConsultar').click(function(){
        var rango = document.getElementById('rangos');
        var valueRango = rango.options[rango.selectedIndex].value;
        let fechaInicio = $('#fechaInicio').val();
        let fechaFinal = $('#fechaFinal').val();
        $('#graficoEstado').empty();
        $('#graficoEstado').append('<div id="line-chart" style="min-height: 400px; max-height: 555px; max-width: 100%;"></div>');

        var totalInformeGlobal;
        var allValorTodo = [];
        function procesarRespuesta(respuesta) {
            totalInformeGlobal = respuesta;
            $.ajax({
                url:'scripts/controlador_tabla_resumen_fecha.php',
                data:{fechaInicio:fechaInicio,fechaFinal:fechaFinal,valueRango:valueRango},
                type: 'POST'
            }).done(function(respuesta){;
                var data = JSON.parse(respuesta);
                totalInforme = 0;
                let template = "";
                let totalHtml = "";
                data.forEach(datos => {
                    numeroCantidad = Number(datos[1]);
                    totalInforme += numeroCantidad;
                });
                data.forEach(dato =>{
                    numeroCantidad = Number(dato[1]);
                    porcentaje = (numeroCantidad * 100) / totalInforme;
                    porcentaje = porcentaje.toFixed(2);
                    template += `
                                <tr>
                                    <td>${dato[0]}</td>
                                    <td>${dato[1]}</td>
                                    <td>${porcentaje} %</td>
                                </tr>
                                `;
                    allValorTodo.push([dato[0],dato[1],porcentaje]);

                });

            var valoresPie = [];

            var datosMain = {
                name: 'Datos',
                data: []
            };
            // console.log("Valores de tabla");
            // console.log(allValorTodo);
            var coloresEmpresariales = {
                "Anulado":"#E30913",
                "Con Resultados":"#ffcc00",
                "Emitido":"#ef7d00",
                "En Proceso":"#006241",
                "Enviado Cliente":"#76C4D5",
                "Guardado por falta de pago":"#cc643d",
                "Inconsistencia":"#6C4175",
                "Inf. Modificado":"#0075C9",
                "Inf.Acumulados":"#263A54",
                "Inf.Trazabilidad":"#a55900",
                "Punto Seco":"#770F00"
            };
            var countColor = 0;
            allValorTodo.forEach(e => {
                var numberInt  = 0;
                try {
                    numberInt = parseInt(e[1]);
                } catch (error) {
                    try {
                        numberInt = parseFloat(e[1]);
                    } catch (error) {
                        console.error("No se puede convertir el número a entero o flotante.");
                    }
                }

                datosMain.data.push({
                    name: e[0],
                    y: numberInt,
                    porcent: e[2],
                    // y: 2,
                    // color: '#0000ff'
                    // color: coloresEmpresariales[countColor]
                    color: coloresEmpresariales[e[0]]

                });

                countColor++;
            });

            $('#tablaGeneralPie').empty();

            // console.log(datosMain);
            Highcharts.chart('tablaGeneralPie', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                    
                },
                title: null,

                plotOptions: {
                    pie: {
                        depth: 35,
                        datHullasoftels: {
                            enabled: true,
                            // Vista simple
                            format: '{point.name} - {point.porcent}%',
                            style: {
                                fontSize: '9px'
                            }
                        }
                    }
                },
                series: [datosMain],
                tooltip: {
                    // Seleccionar
                    pointFormat: '<b>{point.y} - {point.porcent}%</b>'
                }
            });


                totalHtml = `<h6 class="nav-link p-1">Total de Informes: ${totalInforme}</h6>`;

                totalInformeGlobal = totalInforme;
                $('#totalTabla').empty();
                // console.log("LAST INFO");
                $('#tablaResumen').empty();
                $('#totalTabla').html(totalHtml);
                $('#tablaResumen').html(template);
            })

            $.ajax({
                url:'scripts/controlador_linea_rango.php',
                data:{valueRango:valueRango,fechaInicio:fechaInicio,fechaFinal:fechaFinal},
                type: 'POST'
            }).done(function(respuesta){
                let totalResultado = 0;
                let totalProceso = 0;
                let totalEnviado = 0;
                var data = JSON.parse(respuesta);
                data.forEach(datos => {
                    let numeroResultado = Number(datos[1]);
                    let numeroProceso = Number(datos[2]);
                    let numeroEnviado = Number(datos[0]);
                    totalResultado += numeroResultado;
                    totalProceso += numeroProceso;
                    totalEnviado += numeroEnviado;
                    
                });
                let totalIE= totalInformeGlobal;

                var operacionResultado = (totalResultado*100)/totalIE;
                let porcentajeTotalResultado= Number(operacionResultado.toFixed(2));

                var operacionProceso = (totalProceso*100)/totalIE;
                let porcentajeTotalProceso= Number(operacionProceso.toFixed(2));

                var operacionEnviado = (totalEnviado*100)/totalIE;
                let porcentajeTotalEnviado= Number(operacionEnviado.toFixed(2));
                const ctx = document.getElementById('line-chart');

                Highcharts.chart('line-chart', {
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0
                        },
                        events: {
                            load: function () {
                                var chart = this;
                                var points = chart.series[0].points;

                                // Recorrer los puntos del gráfico
                                points.forEach(function (point, index) {
                                    var datHullasoftel = point.datHullasoftel; // Obtener la etiqueta de datos

                                    // Modificar el color de la etiqueta de datos y el sector del gráfico
                                    if (datHullasoftel) {
                                        var color = point.color; // Obtener el color del sector del gráfico
                                        datHullasoftel.css({
                                            color: color, // Establecer el color en la etiqueta de datos
                                            fontSize: '12px'
                                        });
                                        point.graphic.attr({
                                            fill: color // Establecer el color en el sector del gráfico
                                        });
                                    }
                                });
                            }
                        }
                    },
                    title: null,
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            depth: 35,
                            datHullasoftels: {
                                enabled: true,
                                format: '{point.y}%',
                                style: {
                                    fontWeight: 'bold',
                                    textOutline: 'none',
                                    fontSize: '9px'
                                },
                                connectorShape: 'straight',
                                connectorWidth: 1,
                                connectorColor: 'gray',
                                distance: 20
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Datos',
                        data: [{
                            name: 'Con Resultado',
                            y: porcentajeTotalResultado,
                            color: '#0000ff' // Color personalizado para el primer punto de datos
                        }, {
                            name: 'En Proceso',
                            y: porcentajeTotalProceso,
                            color: '#ff0013' // Color personalizado para el segundo punto de datos
                        }, {
                            name: 'Enviado al Cliente',
                            y: porcentajeTotalEnviado,
                            color: '#26c336' // Color personalizado para el tercer punto de datos
                        }],
                        size: '80%',
                        innerSize: '0%',
                        datHullasoftels: {
                            connectorWidth: 1
                        }
                    }],
                    tooltip: {
                        pointFormat: '<b>{point.y}%</b>'
                    }
                });
                let h3Total = `<h6 class="nav-link p-1">Total de Informes: <br>${totalIE} -- 100 %</h6>`;
                let h3Resultado = `<h6 class="nav-link p-1" style="color: rgb(0, 0, 255);">Total con Resultado: <br>${totalResultado} -- ${porcentajeTotalResultado} %</h6>`;
                let h3PRoceso = `<h6 class="nav-link p-1" style="color: rgb(255, 0, 19);">Total con Proceso: <br>${totalProceso} -- ${porcentajeTotalProceso} %</h6>`;
                let h3Enviado = `<h6 class="nav-link p-1" style="color: rgb(38, 195, 54);">Total Enviados al Cliente: <br>${totalEnviado} -- ${porcentajeTotalEnviado} %</h6>`;
                $('#total').html(h3Total);
                $('#resultado').html(h3Resultado);
                $('#proceso').html(h3PRoceso);
                $('#enviado').html(h3Enviado);
            })

        graficoMedioAmbiente(totalInformeGlobal,fechaInicio, fechaFinal, valueRango);
        graficoAgronomia(totalInformeGlobal,fechaInicio, fechaFinal, valueRango);
        graficoAlimentos(totalInformeGlobal,fechaInicio, fechaFinal, valueRango);
        graficoGeoquimico(totalInformeGlobal,fechaInicio, fechaFinal, valueRango);
        graficoCalibracion(totalInformeGlobal,fechaInicio, fechaFinal, valueRango);


        }

        $.ajax({
            url: 'scripts/controlador_tabla_resumen_fecha_total.php',
            data:{fechaInicio:fechaInicio,fechaFinal:fechaFinal,valueRango:valueRango},
            type: 'POST',
            success: procesarRespuesta
        });

        return false;
    });

    function graficoMedioAmbiente(totalInformeGlobal, fechaInicio, fechaFinal, valueRango) {
        $('#unidadDeNegocio').empty();
        $('#unidadDeNegocio').append(`<div class="col-6" id="padreMedioAmbiente">
                                                <h6 class="text-center">Medio Ambiente</h6>
                                                <div id="medioAmbiente"></div>
                                                <div class="row">
                                                    <div class="col-6" id="medioAmbienteTotal"></div>
                                                    <div class="col-6" id="medioAmbienteResultado"></div>
                                                    <div class="col-6" id="medioAmbienteProceso"></div>
                                                    <div class="col-6" id="medioAmbienteEnviado"></div>
                                                </div>
                                            </div>`);

            // Agregar gráfico y datos
            $('#medioAmbiente').append('<div id="grafico_MedioAmbiente" style="min-height: 250px; height: 250px; max-height: 250px; width: 100%;"></div>');
        $.ajax({
            url: 'scripts/controlador_lineal_medio_ambiente.php',
            data: { valueRango: valueRango, fechaInicio: fechaInicio, fechaFinal: fechaFinal },
            type: 'POST'
        }).done(function (respuesta) {
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            var data = JSON.parse(respuesta);
            data.forEach(datos => {
            let numeroResultado = Number(datos[1]);
            let numeroProceso = Number(datos[2]);
            let numeroEnviado = Number(datos[0]);
            totalResultado += numeroResultado;
            totalProceso += numeroProceso;
            totalEnviado += numeroEnviado;
            });
            let totalIE = totalInformeGlobal;

            var operacionResultado = (totalResultado * 100) / totalIE;
            let porcentajeTotalResultado = Number(operacionResultado.toFixed(2));

            var operacionProceso = (totalProceso * 100) / totalIE;
            let porcentajeTotalProceso = Number(operacionProceso.toFixed(2));

            var operacionEnviado = (totalEnviado * 100) / totalIE;
            let porcentajeTotalEnviado = Number(operacionEnviado.toFixed(2));

            if (totalIE == 0) {
            porcentajeTotalResultado = "0";
            porcentajeTotalProceso = "0";
            porcentajeTotalEnviado = "0";
            }

            Highcharts.chart('grafico_MedioAmbiente', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    },
                    events: {
                        load: function () {
                            var chart = this;
                            var points = chart.series[0].points;

                            // Recorrer los puntos del gráfico
                            points.forEach(function (point, index) {
                                var datHullasoftel = point.datHullasoftel; // Obtener la etiqueta de datos

                                // Modificar el color de la etiqueta de datos y el sector del gráfico
                                if (datHullasoftel) {
                                    var color = point.color; // Obtener el color del sector del gráfico
                                    datHullasoftel.css({
                                        color: color, // Establecer el color en la etiqueta de datos
                                        fontSize: '12px' // Ajustar el tamaño de fuente de los porcentajes
                                    });
                                    point.graphic.attr({
                                        fill: color // Establecer el color en el sector del gráfico
                                    });
                                }
                            });
                        }
                    }
                },
                title: null,
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        datHullasoftels: {
                            enabled: true,
                            format: '{point.y}%',
                            style: {
                                fontWeight: 'bold',
                                textOutline: 'none',
                                fontSize: '9px'
                            },
                            connectorShape: 'straight',
                            connectorWidth: 1,
                            connectorColor: 'gray',
                            distance: 20
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Datos',
                    data: [{
                        name: 'Con Resultado',
                        y: porcentajeTotalResultado,
                        color: '#0000ff' // Color personalizado para el primer punto de datos
                    }, {
                        name: 'En Proceso',
                        y: porcentajeTotalProceso,
                        color: '#ff0013' // Color personalizado para el segundo punto de datos
                    }, {
                        name: 'Enviado al Cliente',
                        y: porcentajeTotalEnviado,
                        color: '#26c336' // Color personalizado para el tercer punto de datos
                    }],
                    size: '80%',
                    innerSize: '0%',
                    datHullasoftels: {
                        connectorWidth: 1
                    }
                }],
                tooltip: {
                    pointFormat: '<b>{point.y}%</b>'
                }
            });

            let medioAmbienteTotal = `<span class="nav-link p-1" style="font-size: 10px;">Total: <br>${totalIE} -- 100 %</span>`;
            let medioAmbienteResultado = `<span class="nav-link p-1" style="color: rgb(0, 0, 255); font-size: 10px;">Resultado: <br>${totalResultado} -- ${porcentajeTotalResultado} %</span>`;
            let medioAmbienteProceso = `<span class="nav-link p-1" style="color: rgb(255, 0, 19); font-size: 10px;">En Proceso: <br>${totalProceso} -- ${porcentajeTotalProceso} %</span>`;
            let medioAmbienteEnviado = `<span class="nav-link p-1" style="color: rgb(38, 195, 54); font-size: 10px;">Enviado Clie: <br>${totalEnviado} -- ${porcentajeTotalEnviado} %</span>`;
            $('#medioAmbienteTotal').html(medioAmbienteTotal);
            $('#medioAmbienteResultado').html(medioAmbienteResultado);
            $('#medioAmbienteProceso').html(medioAmbienteProceso);
            $('#medioAmbienteEnviado').html(medioAmbienteEnviado);

            if (data.length === 0) {
                $('#padreMedioAmbiente').addClass('d-none');
            }
        })
    }
    function graficoAgronomia(totalInformeGlobal, fechaInicio, fechaFinal, valueRango) {
         // Si hay datos, agregar el div col-6
        $('#unidadDeNegocio').append(`<div class="col-6" id="padreAgronomia">
                                                <h6 class="text-center">Agronomía</h6>
                                                <div id="agronomia"></div>
                                                <div class="row">
                                                    <div class="col-6" id="agronomiaTotal"></div>
                                                    <div class="col-6" id="agronomiaResultado"></div>
                                                    <div class="col-6" id="agronomiaProceso"></div>
                                                    <div class="col-6" id="agronomiaEnviado"></div>
                                                </div>
                                            </div> `);

            // Agregar gráfico y datos
        $('#agronomia').append('<div id="grafico_Agronomia" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></div>');
        $.ajax({
            url: 'scripts/controlador_lineal_agronomia.php',
            data: { valueRango: valueRango, fechaInicio: fechaInicio, fechaFinal: fechaFinal },
            type: 'POST'
        }).done(function (respuesta) {
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            var data = JSON.parse(respuesta);
            data.forEach(datos => {
            let numeroResultado = Number(datos[1]);
            let numeroProceso = Number(datos[2]);
            let numeroEnviado = Number(datos[0]);
            totalResultado += numeroResultado;
            totalProceso += numeroProceso;
            totalEnviado += numeroEnviado;
            });
            let totalIE = totalInformeGlobal;

            var operacionResultado = (totalResultado * 100) / totalIE;
            let porcentajeTotalResultado = Number(operacionResultado.toFixed(2));

            var operacionProceso = (totalProceso * 100) / totalIE;
            let porcentajeTotalProceso = Number(operacionProceso.toFixed(2));

            var operacionEnviado = (totalEnviado * 100) / totalIE;
            let porcentajeTotalEnviado = Number(operacionEnviado.toFixed(2));

            if (totalIE == 0) {
            porcentajeTotalResultado = "0";
            porcentajeTotalProceso = "0";
            porcentajeTotalEnviado = "0";
            }

            /*Highcharts.chart('grafico_Agronomia', {
                chart: {
                    type: 'pie',
                    options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                    },
                    events: {
                    load: function () {
                        var chart = this;
                        var points = chart.series[0].points;

                        // Recorrer los puntos del gráfico
                        points.forEach(function (point, index) {
                        var datHullasoftel = point.datHullasoftel; // Obtener la etiqueta de datos

                        // Modificar el color de la etiqueta de datos y el sector del gráfico
                        if (datHullasoftel) {
                            var color = point.color; // Obtener el color del sector del gráfico
                            datHullasoftel.css({
                            color: color // Establecer el color en la etiqueta de datos
                            });
                            point.graphic.attr({
                            fill: color // Establecer el color en el sector del gráfico
                            });
                        }
                        });
                    }
                    }
                },
                title: null,
                plotOptions: {
                    pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    datHullasoftels: {
                        enabled: true,
                        format: '{point.y}%',
                        style: {
                        fontWeight: 'bold',
                        textOutline: 'none',
                        fontSize: '9px'
                        },
                        connectorShape: 'straight',
                        connectorWidth: 1,
                        connectorColor: 'gray',
                        distance: 20
                    },
                    showInLegend: true
                    }
                },
                series: [{
                    name: 'Datos',
                    data: [
                    { name: 'Con Resultado', y: porcentajeTotalResultado, color: Highcharts.getOptions().colors[0] },
                    { name: 'En Proceso', y: porcentajeTotalProceso, color: Highcharts.getOptions().colors[1] },
                    { name: 'Enviado al Cliente', y: porcentajeTotalEnviado, color: Highcharts.getOptions().colors[2] }
                    ],
                    size: '80%',
                    innerSize: '0%',
                    datHullasoftels: {
                    connectorWidth: 1
                    }
                }],
                tooltip: {
                    pointFormat: '<b>{point.y}%</b>'
                }
            });*/
            Highcharts.chart('grafico_Agronomia', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    },
                    events: {
                        load: function () {
                            var chart = this;
                            var points = chart.series[0].points;

                            // Recorrer los puntos del gráfico
                            points.forEach(function (point, index) {
                                var datHullasoftel = point.datHullasoftel; // Obtener la etiqueta de datos

                                // Modificar el color de la etiqueta de datos y el sector del gráfico
                                if (datHullasoftel) {
                                    var color = point.color; // Obtener el color del sector del gráfico
                                    datHullasoftel.css({
                                        color: color, // Establecer el color en la etiqueta de datos
                                        fontSize: '12px' // Ajustar el tamaño de fuente de los porcentajes
                                    });
                                    point.graphic.attr({
                                        fill: color // Establecer el color en el sector del gráfico
                                    });
                                }
                            });
                        }
                    }
                },
                title: null,
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        datHullasoftels: {
                            enabled: true,
                            format: '{point.y}%',
                            style: {
                                fontWeight: 'bold',
                                textOutline: 'none',
                                fontSize: '12px' // Ajustar el tamaño de fuente de los porcentajes
                            },
                            connectorShape: 'straight',
                            connectorWidth: 1,
                            connectorColor: 'gray',
                            distance: 20
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Datos',
                    data: [
                        { name: 'Con Resultado', y: porcentajeTotalResultado, color: '#0000ff' }, // Color personalizado para el primer punto de datos
                        { name: 'En Proceso', y: porcentajeTotalProceso, color: '#ff0013' }, // Color personalizado para el segundo punto de datos
                        { name: 'Enviado al Cliente', y: porcentajeTotalEnviado, color: '#26c336' } // Color personalizado para el tercer punto de datos
                    ],
                    size: '80%',
                    innerSize: '0%',
                    datHullasoftels: {
                        connectorWidth: 1
                    }
                }],
                tooltip: {
                    pointFormat: '<b>{point.y}%</b>'
                }
            });

            let agronomiaTotal = `<span class="nav-link p-1" style="font-size: 10px;">Total: <br>${totalIE} -- 100 %</span>`;
            let agronomiaResultado = `<span class="nav-link p-1" style="color: rgb(0, 0, 255); font-size: 10px;">Resultado: <br>${totalResultado} -- ${porcentajeTotalResultado} %</span>`;
            let agronomiaProceso = `<span class="nav-link p-1" style="color: rgb(255, 0, 19); font-size: 10px;">En Proceso: <br>${totalProceso} -- ${porcentajeTotalProceso} %</span>`;
            let agronomiaEnviado = `<span class="nav-link p-1" style="color: rgb(38, 195, 54); font-size: 10px;">Enviado Clie: <br>${totalEnviado} -- ${porcentajeTotalEnviado} %</span>`;

            $('#agronomiaTotal').html(agronomiaTotal);
            $('#agronomiaResultado').html(agronomiaResultado);
            $('#agronomiaProceso').html(agronomiaProceso);
            $('#agronomiaEnviado').html(agronomiaEnviado);

            if (data.length === 0) {
                $('#padreAgronomia').addClass('d-none');
            }
        });
    }
    function graficoAlimentos(totalInformeGlobal, fechaInicio, fechaFinal, valueRango) {
        $('#unidadDeNegocio').append(`
            <div class="col-6" id="padreAlimentos">
                <h6 class="text-center">Alimentos</h6>
                <div id="alimentos"></div>
                <div class="row">
                    <div class="col-6" id="alimentosTotal"></div>
                    <div class="col-6" id="alimentosResultado"></div>
                    <div class="col-6" id="alimentosProceso"></div>
                    <div class="col-6" id="alimentosEnviado"></div>
                </div>
            </div>
        `);

        $('#alimentos').empty();
        $('#alimentos').append('<div id="grafico_Alimentos" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></div>');

        $.ajax({
            url: 'scripts/controlador_lineal_alimentos.php',
            data: { valueRango: valueRango, fechaInicio: fechaInicio, fechaFinal: fechaFinal },
            type: 'POST'
        }).done(function (respuesta) {
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            var data = JSON.parse(respuesta);

            data.forEach(datos => {
                let numeroResultado = Number(datos[1]);
                let numeroProceso = Number(datos[2]);
                let numeroEnviado = Number(datos[0]);
                totalResultado += numeroResultado;
                totalProceso += numeroProceso;
                totalEnviado += numeroEnviado;
            });

            let totalIE = totalInformeGlobal;

            var operacionResultado = (totalResultado * 100) / totalIE;
            let porcentajeTotalResultado = Number(operacionResultado.toFixed(2));

            var operacionProceso = (totalProceso * 100) / totalIE;
            let porcentajeTotalProceso = Number(operacionProceso.toFixed(2));

            var operacionEnviado = (totalEnviado * 100) / totalIE;
            let porcentajeTotalEnviado = Number(operacionEnviado.toFixed(2));

            if (totalIE == 0) {
                porcentajeTotalResultado = "0";
                porcentajeTotalProceso = "0";
                porcentajeTotalEnviado = "0";
            }

            Highcharts.chart('grafico_Alimentos', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    },
                    events: {
                        load: function () {
                            var chart = this;
                            var points = chart.series[0].points;

                            // Recorrer los puntos del gráfico
                            points.forEach(function (point, index) {
                                var datHullasoftel = point.datHullasoftel; // Obtener la etiqueta de datos

                                // Modificar el color de la etiqueta de datos y el sector del gráfico
                                if (datHullasoftel) {
                                    var color = point.color; // Obtener el color del sector del gráfico
                                    datHullasoftel.css({
                                        color: color, // Establecer el color en la etiqueta de datos
                                        fontSize: '12px' // Ajustar el tamaño de fuente de los porcentajes
                                    });
                                    point.graphic.attr({
                                        fill: color // Establecer el color en el sector del gráfico
                                    });
                                }
                            });
                        }
                    }
                },
                title: null,
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        datHullasoftels: {
                            enabled: true,
                            format: '{point.y}%',
                            style: {
                                fontWeight: 'bold',
                                textOutline: 'none',
                                fontSize: '12px' // Ajustar el tamaño de fuente de los porcentajes
                            },
                            connectorShape: 'straight',
                            connectorWidth: 1,
                            connectorColor: 'gray',
                            distance: 20
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Datos',
                    data: [
                        { name: 'Con Resultado', y: porcentajeTotalResultado, color: '#0000ff' }, // Color personalizado para el primer punto de datos
                        { name: 'En Proceso', y: porcentajeTotalProceso, color: '#ff0013' }, // Color personalizado para el segundo punto de datos
                        { name: 'Enviado al Cliente', y: porcentajeTotalEnviado, color: '#26c336' } // Color personalizado para el tercer punto de datos
                    ],
                    size: '80%',
                    innerSize: '0%',
                    datHullasoftels: {
                        connectorWidth: 1
                    }
                }],
                tooltip: {
                    pointFormat: '<b>{point.y}%</b>'
                }
            });

            let alimentosTotal = `<span class="nav-link p-1" style="font-size: 10px;">Total: <br>${totalIE} -- 100 %</span>`;
            let alimentosResultado = `<span class="nav-link p-1" style="color: rgb(0, 0, 255); font-size: 10px;">Resultado: <br>${totalResultado} -- ${porcentajeTotalResultado} %</span>`;
            let alimentosProceso = `<span class="nav-link p-1" style="color: rgb(255, 0, 19); font-size: 10px;">En Proceso: <br>${totalProceso} -- ${porcentajeTotalProceso} %</span>`;
            let alimentosEnviado = `<span class="nav-link p-1" style="color: rgb(38, 195, 54); font-size: 10px;">Enviado Clie: <br>${totalEnviado} -- ${porcentajeTotalEnviado} %</span>`;

            $('#alimentosTotal').html(alimentosTotal);
            $('#alimentosResultado').html(alimentosResultado);
            $('#alimentosProceso').html(alimentosProceso);
            $('#alimentosEnviado').html(alimentosEnviado);

            if (data.length === 0) {
                $('#padreAlimentos').addClass('d-none');
            }
        });
    }
    function graficoGeoquimico(totalInformeGlobal, fechaInicio, fechaFinal, valueRango) {
        $('#unidadDeNegocio').append(`
            <div class="col-6" id="padregeoquimica">
                <h6 class="text-center">Geoquímica</h6>
                <div id="geoquimica"></div>
                <div class="row">
                    <div class="col-6" id="geoquimicaTotal"></div>
                    <div class="col-6" id="geoquimicaResultado"></div>
                    <div class="col-6" id="geoquimicaProceso"></div>
                    <div class="col-6" id="geoquimicaEnviado"></div>
                </div>
            </div>
        `);

        $('#geoquimica').empty();
        $('#geoquimica').append('<div id="grafico_Geoquimica" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></div>');

        $.ajax({
            url: 'scripts/controlador_lineal_geoquimica.php',
            data: { valueRango: valueRango, fechaInicio: fechaInicio, fechaFinal: fechaFinal },
            type: 'POST'
        }).done(function (respuesta) {
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            var data = JSON.parse(respuesta);

            data.forEach(datos => {
                let numeroResultado = Number(datos[1]);
                let numeroProceso = Number(datos[2]);
                let numeroEnviado = Number(datos[0]);
                totalResultado += numeroResultado;
                totalProceso += numeroProceso;
                totalEnviado += numeroEnviado;
            });

            let totalIE = totalInformeGlobal;

            var operacionResultado = (totalResultado * 100) / totalIE;
            let porcentajeTotalResultado = Number(operacionResultado.toFixed(2));

            var operacionProceso = (totalProceso * 100) / totalIE;
            let porcentajeTotalProceso = Number(operacionProceso.toFixed(2));

            var operacionEnviado = (totalEnviado * 100) / totalIE;
            let porcentajeTotalEnviado = Number(operacionEnviado.toFixed(2));

            if (totalIE == 0) {
                porcentajeTotalResultado = "0";
                porcentajeTotalProceso = "0";
                porcentajeTotalEnviado = "0";
            }

            Highcharts.chart('grafico_Geoquimica', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    },
                    events: {
                        load: function () {
                            var chart = this;
                            var points = chart.series[0].points;

                            // Recorrer los puntos del gráfico
                            points.forEach(function (point, index) {
                                var datHullasoftel = point.datHullasoftel; // Obtener la etiqueta de datos

                                // Modificar el color de la etiqueta de datos y el sector del gráfico
                                if (datHullasoftel) {
                                    var color = point.color; // Obtener el color del sector del gráfico
                                    datHullasoftel.css({
                                        color: color, // Establecer el color en la etiqueta de datos
                                        fontSize: '12px' // Ajustar el tamaño de fuente de los porcentajes
                                    });
                                    point.graphic.attr({
                                        fill: color // Establecer el color en el sector del gráfico
                                    });
                                }
                            });
                        }
                    }
                },
                title: null,
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        datHullasoftels: {
                            enabled: true,
                            format: '{point.y}%',
                            style: {
                                fontWeight: 'bold',
                                textOutline: 'none',
                                fontSize: '12px' // Ajustar el tamaño de fuente de los porcentajes
                            },
                            connectorShape: 'straight',
                            connectorWidth: 1,
                            connectorColor: 'gray',
                            distance: 20
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Datos',
                    data: [
                        { name: 'Con Resultado', y: porcentajeTotalResultado, color: '#0000ff' }, // Color personalizado para el primer punto de datos
                        { name: 'En Proceso', y: porcentajeTotalProceso, color: '#ff0013' }, // Color personalizado para el segundo punto de datos
                        { name: 'Enviado al Cliente', y: porcentajeTotalEnviado, color: '#26c336' } // Color personalizado para el tercer punto de datos
                    ],
                    size: '80%',
                    innerSize: '0%',
                    datHullasoftels: {
                        connectorWidth: 1
                    }
                }],
                tooltip: {
                    pointFormat: '<b>{point.y}%</b>'
                }
            });

            let geoquimicaTotal = `<span class="nav-link p-1" style="font-size: 10px;">Total: <br>${totalIE} -- 100 %</span>`;
            let geoquimicaResultado = `<span class="nav-link p-1" style="color: rgb(0, 0, 255); font-size: 10px;">Resultado: <br>${totalResultado} -- ${porcentajeTotalResultado} %</span>`;
            let geoquimicaProceso = `<span class="nav-link p-1" style="color: rgb(255, 0, 19); font-size: 10px;">En Proceso: <br>${totalProceso} -- ${porcentajeTotalProceso} %</span>`;
            let geoquimicaEnviado = `<span class="nav-link p-1" style="color: rgb(38, 195, 54); font-size: 10px;">Enviado Clie: <br>${totalEnviado} -- ${porcentajeTotalEnviado} %</span>`;
            $('#geoquimicaTotal').html(geoquimicaTotal);
            $('#geoquimicaResultado').html(geoquimicaResultado);
            $('#geoquimicaProceso').html(geoquimicaProceso);
            $('#geoquimicaEnviado').html(geoquimicaEnviado);

            if (data.length === 0) {
                $('#padreGeoquimica').addClass('d-none');
            }
        });
    }
    function graficoCalibracion(totalInformeGlobal, fechaInicio, fechaFinal, valueRango) {
        $('#unidadDeNegocio').append(`
            <div class="col-6" id="padreCalibracion">
                <h6 class="text-center">Calibraciones</h6>
                <div id="calibracion"></div>
                <div class="row">
                    <div class="col-6" id="calibracionTotal"></div>
                    <div class="col-6" id="calibracionResultado"></div>
                    <div class="col-6" id="calibracionProceso"></div>
                    <div class="col-6" id="calibracionEnviado"></div>
                </div>
            </div>
        `);

        $('#calibracion').empty();
        $('#calibracion').append('<div id="grafico_Calibracion" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></div>');

        $.ajax({
            url: 'scripts/controlador_lineal_calibracion.php',
            data: { valueRango: valueRango, fechaInicio: fechaInicio, fechaFinal: fechaFinal },
            type: 'POST'
        }).done(function (respuesta) {
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            var data = JSON.parse(respuesta);
            data.forEach(datos => {
                let numeroResultado = Number(datos[1]);
                let numeroProceso = Number(datos[2]);
                let numeroEnviado = Number(datos[0]);
                totalResultado += numeroResultado;
                totalProceso += numeroProceso;
                totalEnviado += numeroEnviado;
            });

            let totalIE = totalInformeGlobal;

            var operacionResultado = (totalResultado * 100) / totalIE;
            let porcentajeTotalResultado = Number(operacionResultado.toFixed(2));

            var operacionProceso = (totalProceso * 100) / totalIE;
            let porcentajeTotalProceso = Number(operacionProceso.toFixed(2));

            var operacionEnviado = (totalEnviado * 100) / totalIE;
            let porcentajeTotalEnviado = Number(operacionEnviado.toFixed(2));

            if (totalIE == 0) {
                porcentajeTotalResultado = "0";
                porcentajeTotalProceso = "0";
                porcentajeTotalEnviado = "0";
            }

            Highcharts.chart('grafico_Calibracion', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    },
                    events: {
                        load: function () {
                            var chart = this;
                            var points = chart.series[0].points;

                            // Recorrer los puntos del gráfico
                            points.forEach(function (point, index) {
                                var datHullasoftel = point.datHullasoftel; // Obtener la etiqueta de datos

                                // Modificar el color de la etiqueta de datos y el sector del gráfico
                                if (datHullasoftel) {
                                    var color = point.color; // Obtener el color del sector del gráfico
                                    datHullasoftel.css({
                                        color: color, // Establecer el color en la etiqueta de datos
                                        fontSize: '12px' // Ajustar el tamaño de fuente de los porcentajes
                                    });
                                    point.graphic.attr({
                                        fill: color // Establecer el color en el sector del gráfico
                                    });
                                }
                            });
                        }
                    }
                },
                title: null,
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        datHullasoftels: {
                            enabled: true,
                            format: '{point.y}%',
                            style: {
                                fontWeight: 'bold',
                                textOutline: 'none',
                                fontSize: '12px' // Ajustar el tamaño de fuente de los porcentajes
                            },
                            connectorShape: 'straight',
                            connectorWidth: 1,
                            connectorColor: 'gray',
                            distance: 20
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Datos',
                    data: [
                        { name: 'Con Resultado', y: porcentajeTotalResultado, color: '#0000ff' }, // Color personalizado para el primer punto de datos
                        { name: 'En Proceso', y: porcentajeTotalProceso, color: '#ff0013' }, // Color personalizado para el segundo punto de datos
                        { name: 'Enviado al Cliente', y: porcentajeTotalEnviado, color: '#26c336' } // Color personalizado para el tercer punto de datos
                    ],
                    size: '80%',
                    innerSize: '0%',
                    datHullasoftels: {
                        connectorWidth: 1
                    }
                }],
                tooltip: {
                    pointFormat: '<b>{point.y}%</b>'
                }
            });

            let calibracionTotal = `<span class="nav-link p-1" style=" font-size: 10px;">Total: <br>${totalIE} -- 100 %</span>`;
            let calibracionResultado = `<span class="nav-link p-1" style="color: rgb(0, 0, 255); font-size: 10px;">Resultado: <br>${totalResultado} -- ${porcentajeTotalResultado} %</span>`;
            let calibracionProceso = `<span class="nav-link p-1" style="color: rgb(255, 0, 19); font-size: 10px;">En Proceso: <br>${totalProceso} -- ${porcentajeTotalProceso} %</span>`;
            let calibracionEnviado = `<span class="nav-link p-1" style="color: rgb(38, 195, 54); font-size: 10px;">Enviado Clie: <br>${totalEnviado} -- ${porcentajeTotalEnviado} %</span>`;

            $('#calibracionTotal').html(calibracionTotal);
            $('#calibracionResultado').html(calibracionResultado);
            $('#calibracionProceso').html(calibracionProceso);
            $('#calibracionEnviado').html(calibracionEnviado);

            if (data.length === 0) {
                $('#padreCalibracion').addClass('d-none');
            }
        });
    }

</script>
</body>
</html>
