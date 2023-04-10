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
                                    <div class="col-6 text-center">
                                        <div class="text-white">
                                            <div class="form-group">
                                                <input type="date" class="form-control" id="fechaInicio"
                                                    <?php 
                                                        $dia = date("d");
                                                        $mes =date("m");
                                                        $ano = date("Y");
                                                        if($mes < 12){
                                                        $mes = $mes - 2;
                                                        if($mes < 10){
                                                            $mes = "0".$mes;
                                                        }
                                                        }
                                                        if($mes <= 0){
                                                        $mes = 12;
                                                        $ano = $ano - 1;
                                                        }
                                                        $fecha = $ano."-".$mes."-".$dia; 
                                                        ?>
                                                min="<?php echo $fecha;?>" max="<?php echo date("Y-m-d");?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                    <div class="text-white">
                                        <div class="d-flex justify-content-center">
                                        <input type="date" class="form-control" id="fechaFinal"
                                        min="<?php echo $fecha;?>" max="<?php echo date("Y-m-d");?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="text-white">
                                            <div class="d-flex justify-content-center">
                                                <input type="submit" class="btn btn-info btn-block" id="btnConsultar" value="Consultar">
                                            </div>
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
                                    <table class="table table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>Días</th>
                                                <th>Enviado al Cliente</th>
                                                <th>Con Resultado</th>
                                                <th>En Proceso</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaResumen">
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-4" id="resultado"></div>
                                        <div class="col-4" id="proceso"></div>
                                        <div class="col-4" id="enviado"></div>
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
        <strong>Copyright &copy; 2023 <a href="https://alab.com.pe/">Alab</a>.</strong>
        Reservados todos los derechos.
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">
        <div class="modal-dialog" style="max-width: 1000px;">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div style="overflow:scroll;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>OS</th>
                                    <th>Días de Informe</th>
                                    <th>Informe Enviado al Cliente</th>
                                    <th>Informe Con Resultado</th>
                                    <th>Informe En Proceso</th>
                                </tr>
                            </thead>
                            <tbody id="tablaDetalle">
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-4" id="informeResultado"></div>
                            <div class="col-4" id="informeProceso"></div>
                            <div class="col-4" id="informeEnviado"></div>
                        </div>
                    </div>
                </div>    
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
        </div>
        </div>
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
        $('#graficoEstado').append('<canvas id="line-chart" style="min-height: 555px; height: 555px; max-height: 555px; max-width: 100%;"></canvas>');
        $.ajax({
            url:'scripts/controlador_linea.php',
            type: 'POST'
        }).done(function(respuesta){
            var titulo = [];
            var cantidadResultado = [];
            var cantidadProceso = [];
            var cantidadEnviClie = [];
            var data = JSON.parse(respuesta);
            for(var i = 0; i < data.length; i++){
                titulo.push(data[i][0]);
                cantidadEnviClie.push(data[i][1]);
                cantidadResultado.push(data[i][2]);
                cantidadProceso.push(data[i][3]);
            }
            const ctx = document.getElementById('line-chart');
            const mixedChart = new Chart(ctx, {
            data: {
                datasets: [{
                    type: 'line',
                    label: 'Con Resultado',
                    data: cantidadResultado
                }, {
                    type: 'line',
                    label: 'En Proceso',
                    data: cantidadProceso,
                }, {
                    type: 'line',
                    label: 'Enviado al cliente',
                    data: cantidadEnviClie,
                }],
                labels: titulo
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        let template = '';
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            data.forEach(datos => {
            let numeroResultado = Number(datos[2]);
            let numeroProceso = Number(datos[3]);
            let numeroEnviado = Number(datos[1]);
            totalResultado += numeroResultado;
            totalProceso += numeroProceso;
            totalEnviado += numeroEnviado;
            template += `
                    <tr>
                        <td><button class="btn btn-outline-info" dia="${datos[0]}" onclick="mostrar(this)" data-toggle="modal" data-target="#myModal">${datos[0]}</button></td>
                        <td>${numeroEnviado}</td>
                        <td>${numeroResultado}</td>
                        <td>${numeroProceso}</td>
                    </tr>
                    `
            });
            $('#tablaResumen').html(template);
            let h3Resultado = `<h4>Total con Resultado: ${totalResultado}</h4>`;
            let h3PRoceso = `<h4>Total con Proceso: ${totalProceso}</h4>`;
            let h3Enviado = `<h4>Total Enviados: ${totalEnviado}</h4>`;
            $('#resultado').html(h3Resultado);
            $('#proceso').html(h3PRoceso);
            $('#enviado').html(h3Enviado);

        })
    })
    $('#btnConsultar').click(function(){
            $('#graficoEstado').empty();
            $('#graficoEstado').append('<canvas id="line-chart" style="min-height: 555px; height: 555px; max-height: 555px; max-width: 100%;"></canvas>');
            let fechaInicio = $('#fechaInicio').val();
            let fechaFinal = $('#fechaFinal').val();
            $.ajax({
                url:'scripts/controlador_linea_fecha.php',
                data:{fechaInicio:fechaInicio, fechaFinal: fechaFinal},
                type: 'POST'
            }).done(function(respuesta){
                var titulo = [];
                var cantidadResultado = [];
                var cantidadProceso = [];
                var data = JSON.parse(respuesta);
                for(var i = 0; i < data.length; i++){
                    titulo.push(data[i][0]);
                    cantidadResultado.push(data[i][1]);
                    cantidadProceso.push(data[i][2]);
                }
                const ctx = document.getElementById('line-chart');
                const mixedChart = new Chart(ctx, {
                data: {
                    datasets: [{
                        type: 'line',
                        label: 'Con Resultado',
                        data: cantidadResultado
                    }, {
                        type: 'line',
                        label: 'En Proceso',
                        data: cantidadProceso,
                    }],
                    labels: titulo
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            let template = '';
                let totalResultado = 0;
                let totalProceso = 0;
                data.forEach(datos => {
                let numeroResultado = Number(datos[1]);
                let numeroProceso = Number(datos[2]);
                totalResultado += numeroResultado;
                totalProceso += numeroProceso;
                template += `
                        <tr>
                            <td><button class="btn btn-outline-info" dia="${datos[0]}" onclick="mostrar(this)" data-toggle="modal" data-target="#myModal">${datos[0]}</button></td>
                            <td>${numeroResultado}</td>
                            <td>${numeroProceso}</td>
                        </tr>
                        `
                });
                $('#tablaResumen').html(template);
                let h3Resultado = `<h3>Total con Resultado: ${totalResultado}</h3>`;
                let h3PRoceso = `<h3>Total con con Proceso: ${totalProceso}</h3>`;
                $('#resultado').html(h3Resultado);
                $('#proceso').html(h3PRoceso);

            })
            return false;
        });
        function mostrar(btn){
            let dia = $(btn).attr("dia");
            $.ajax({
            url : 'scripts/controlador_lineal_dia.php',
            type : 'POST',
            data: {dia: dia}
            }).done(function(resp){
            if(resp == "error"){
                alert("No se encontró registros.");
            }else{
                let template = '';
                let informeResultado = 0;
                let informeProceso = 0;
                let informeEnviado = 0;
                var data = JSON.parse(resp);
                data.forEach(datos => {
                    template += `
                            <tr>
                                <td>${datos[0]}</td>
                                <td>${datos[1]}</td>s
                                <td>${datos[2]}</td>s
                                <td>${datos[3]}</td>
                                <td>${datos[4]}</td>
                            </tr>
                            `
                    let numeroResultado = Number(datos[2]);
                    let numeroProceso = Number(datos[3]);
                    let numeroEnviado = Number(datos[4]);
                    informeResultado += numeroResultado;
                    informeProceso += numeroProceso;
                    informeEnviado += numeroEnviado;
                });
                let informeH3Resultado = `<h4>Total con Resultado: ${informeResultado}</h4>`;
                let informeH3Proceso = `<h4>Total con Proceso: ${informeProceso}</h4>`;
                let informeH3Enviado = `<h4>Total con Enviado: ${informeEnviado}</h4>`;
                $('#tablaDetalle').html(template);
                $('#informeResultado').html(informeH3Resultado);
                $('#informeProceso').html(informeH3Proceso);
                $('#informeEnviado').html(informeH3Enviado);
                
            }
            })
        }
</script>
</body>
</html>
