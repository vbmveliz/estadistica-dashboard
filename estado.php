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
                    <div class="col-md-7">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Estado IE</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <select class="form-control" id="OSEstado">
                                                    <option>Emitido</option>
                                                    <option>Enviado Cliente</option>
                                                    <option>Con Resultados</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group text-center">
                                                <input type="submit" class="btn btn-info btn-block"  value="Consultar" id="btnConsultarEstado">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="chart" id="graficoEstado">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Detalle</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart" style="height: 610px; overflow:scroll;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Estado de OS</th>
                                                <th>Días</th>
                                                <th>IE</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaResumen">
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
        <strong>Copyright &copy; 2023 <a href="https://alab.com.pe/">Alab</a>.</strong>
        Reservados todos los derechos.
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
    $(function (){
        $('#graficoEstado').empty();
        $('#graficoEstado').append('<canvas id="donutChart" style="min-height: 555px; height: 555px; max-height: 555px; max-width: 100%;"></canvas>');
        $.ajax({
            url:'scripts/controlador_tabla.php',
            type: 'POST'
        }).done(function(respuesta){
            var titulo = [];
            var cantidad = [];
            var data = JSON.parse(respuesta);
            for(var i = 0; i < data.length; i++){
                titulo.push(data[i][0]);
                cantidad.push(data[i][3]);
            }
            var donutChartCanvas = $('#donutChart');
            var donutData        = {
            labels: titulo,
            datasets: [
                {
                data: cantidad,
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }
            ]
            }
            var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
            }
            new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
            })
        })
    })
    $('#btnConsultarEstado').click(function(){
        var estadoOs = document.getElementById('OSEstado');
        var valueEstadoOs = estadoOs.options[estadoOs.selectedIndex].value;
        $('#graficoEstado').empty();
        $('#graficoEstado').append('<canvas id="donutChart" style="min-height: 555px; height: 555px; max-height: 555px; max-width: 100%;"></canvas>');
        $.ajax({
            url : 'scripts/controlador_grafico_2.php',
            type : 'POST',
            data: {valueEstadoOs: valueEstadoOs}
        }).done(function(resp){
            var titulo = [];
            var cantidad = [];
            const datosResumen = JSON.parse(resp);
            for(var i = 0; i < datosResumen.length; i++){
                titulo.push(datosResumen[i][0]);
                cantidad.push(datosResumen[i][3]);
            }
            var donutChartCanvas = $('#donutChart');
            var donutData        = {
            labels: titulo,
            datasets: [
                {
                data: cantidad,
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }
            ]
            }
            var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
            }
            new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
            })
            let template = '';
            let total = 0;
            datosResumen.forEach(datos => {
            let numero = Number(datos[3]);
            //cuando quieres validar el tipo de dato de un valor se usa lo siguiente
            total += numero;
            });
            datosResumen.forEach(datosSuma => {
            let numero = Number(datosSuma[3]);
            var operacion = (numero*100)/total
            let porcentaje= Number(operacion.toFixed(2));
            template += `
                    <tr class="porcentaje">
                        <td>${datosSuma[0]}</td>
                        <td>${datosSuma[1]}</td>
                        <td>${porcentaje+" %"}</td>
                    </tr>
                    `
            });
            $('#tablaResumen').html(template);
        })
        return false;
    });

</script>
</body>
</html>
