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
                    <div class="col-md-5">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Estado IE General</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4" id="resultado"></div>
                                    <div class="col-4" id="proceso"></div>
                                    <div class="col-4" id="enviado"></div>
                                </div>
                                <div class="chart" id="graficoEstado"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Estado IE Unidad de Negocio</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div style="overflow:scroll;">
                                    <div class="row">
                                        <div class="col-6 ">
                                            <h6 class="text-center">Medio Ambiente</h6>
                                            <div id="medioAmbiente"></div>
                                            <div class="row">
                                                <div class="col-4" id="medioAmbienteResultado"></div>
                                                <div class="col-4" id="medioAmbienteProceso"></div>
                                                <div class="col-4" id="medioAmbienteEnviado"></div>
                                            </div>
                                        </div>
                                        <div class="col-6 ">
                                            <h6 class="text-center">Agronomía</h6>
                                            <div id="agronomia"></div>
                                            <div class="row">
                                                <div class="col-4" id="agronomiaResultado"></div>
                                                <div class="col-4" id="agronomiaProceso"></div>
                                                <div class="col-4" id="agronomiaEnviado"></div>
                                            </div>
                                        </div>       
                                        <div class="col-6 ">
                                            <h6 class="text-center">Alimentos</h6>
                                            <div id="alimentos"></div>
                                            <div class="row">
                                                <div class="col-4" id="alimentosResultado"></div>
                                                <div class="col-4" id="alimentosProceso"></div>
                                                <div class="col-4" id="alimentosEnviado"></div>
                                            </div>
                                        </div>            
                                        <div class="col-6 ">
                                            <h6 class="text-center">Geoquímica</h6>
                                            <div id="geoquimica"></div>
                                            <div class="row">
                                                <div class="col-4" id="geoquimicaResultado"></div>
                                                <div class="col-4" id="geoquimicaProceso"></div>
                                                <div class="col-4" id="geoquimicaEnviado"></div>
                                            </div>
                                        </div>              
                                        <div class="col-6 ">
                                            <h6 class="text-center">Calibraciones</h6>
                                            <div id="calibracion"></div>
                                            <div class="row">
                                                <div class="col-4" id="calibracionResultado"></div>
                                                <div class="col-4" id="calibracionProceso"></div>
                                                <div class="col-4" id="calibracionEnviado"></div>
                                            </div>
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
        <strong>Copyright &copy; 2023 <a href="https://alab.com.pe/">Alab</a>.</strong>
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
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            var data = JSON.parse(respuesta);
            data.forEach(datos => {
                let numeroResultado = Number(datos[2]);
                let numeroProceso = Number(datos[3]);
                let numeroEnviado = Number(datos[1]);
                totalResultado += numeroResultado;
                totalProceso += numeroProceso;
                totalEnviado += numeroEnviado;
            });
            let totalIE= totalResultado+totalProceso+totalEnviado;

            var operacionResultado = (totalResultado*100)/totalIE;
            let porcentajeTotalResultado= Number(operacionResultado.toFixed(2));

            var operacionProceso = (totalProceso*100)/totalIE;
            let porcentajeTotalProceso= Number(operacionProceso.toFixed(2));

            var operacionEnviado = (totalEnviado*100)/totalIE;
            let porcentajeTotalEnviado= Number(operacionEnviado.toFixed(2));
            const ctx = document.getElementById('line-chart');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Con Resultado','En Proceso','Enviado al Cliente'],
                    datasets: [{
                    data: [porcentajeTotalResultado,porcentajeTotalProceso,porcentajeTotalEnviado],
                    backgroundColor:['rgb(0, 0, 255)','rgb(255, 0, 19)','rgb(38, 195, 54)'],
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            let h3Resultado = `<h6 class="nav-link" style="color: rgb(0, 0, 255);">Total con Resultado: ${totalResultado}</h6><h6 class="nav-link" style="color: rgb(0, 0, 255);">Total con Resultado (%): ${porcentajeTotalResultado} %</h6>`;
            let h3PRoceso = `<h6 class="nav-link" style="color: rgb(255, 0, 19);">Total con Proceso: ${totalProceso}</h6><h6 class="nav-link" style="color: rgb(255, 0, 19);">Total con Proceso (%): ${porcentajeTotalProceso} %</h6>`;
            let h3Enviado = `<h6 class="nav-link" style="color: rgb(38, 195, 54);">Total Enviados: ${totalEnviado}</h6><h6 class="nav-link" style="color: rgb(38, 195, 54)">Total Enviados (%): ${porcentajeTotalEnviado} %</h6>`;
            $('#resultado').html(h3Resultado);
            $('#proceso').html(h3PRoceso);
            $('#enviado').html(h3Enviado);
        })
        graficoMedioAmbiente();
        graficoAgronomia();
        graficoAlimentos();
        graficoGeoquimico();
        graficoCalibracion();
    });
    function graficoMedioAmbiente(){
        $('#medioAmbiente').empty();
        $('#medioAmbiente').append('<canvas id="grafico_MedioAmbiente"  style="min-height: 250px; height: 250px; max-height: 250px; width: 100%;"></canvas>');
        $.ajax({
            url:'scripts/controlador_lineal_medio_ambiente.php',
            type: 'POST'
        }).done(function(respuesta){
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            var data = JSON.parse(respuesta);
            data.forEach(datos => {
                let numeroResultado = Number(datos[2]);
                let numeroProceso = Number(datos[3]);
                let numeroEnviado = Number(datos[1]);
                totalResultado += numeroResultado;
                totalProceso += numeroProceso;
                totalEnviado += numeroEnviado;
            });
            let totalIE= totalResultado+totalProceso+totalEnviado;

            var operacionResultado = (totalResultado*100)/totalIE;
            let porcentajeTotalResultado= Number(operacionResultado.toFixed(2));

            var operacionProceso = (totalProceso*100)/totalIE;
            let porcentajeTotalProceso= Number(operacionProceso.toFixed(2));

            var operacionEnviado = (totalEnviado*100)/totalIE;
            let porcentajeTotalEnviado= Number(operacionEnviado.toFixed(2));

            if(totalIE == 0){
                porcentajeTotalResultado = "0";
                porcentajeTotalProceso = "0";
                porcentajeTotalEnviado = "0";
            }
            const ctx = document.getElementById('grafico_MedioAmbiente');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Con Resultado','En Proceso','Enviado al Cliente'],
                    datasets: [{
                    data: [porcentajeTotalResultado,porcentajeTotalProceso,porcentajeTotalEnviado],
                    backgroundColor:['rgb(0, 0, 255)','rgb(255, 0, 19)','rgb(38, 195, 54)'],
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            let medioAmbienteResultado = `<span class="nav-link" style="color: rgb(0, 0, 255);">Result: ${totalResultado}</span><span class="nav-link" style="color: rgb(0, 0, 255);">Result : ${porcentajeTotalResultado} %</span>`;
            let medioAmbienteProceso = `<span class="nav-link" style="color: rgb(255, 0, 19);">Proc: ${totalProceso}</span><span class="nav-link" style="color: rgb(255, 0, 19);">Proc: ${porcentajeTotalProceso} %</span>`;
            let medioAmbienteEnviado = `<span class="nav-link" style="color: rgb(38, 195, 54);">Envi: ${totalEnviado}</span><span class="nav-link" style="color: rgb(38, 195, 54)">Envi: ${porcentajeTotalEnviado} %</span>`;
            $('#medioAmbienteResultado').html(medioAmbienteResultado);
            $('#medioAmbienteProceso').html(medioAmbienteProceso);
            $('#medioAmbienteEnviado').html(medioAmbienteEnviado);
        })
    }
    function graficoAgronomia(){
        $('#agronomia').empty();
        $('#agronomia').append('<canvas id="grafico_Agronomia" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>');
        $.ajax({
            url:'scripts/controlador_lineal_agronomia.php',
            type: 'POST'
        }).done(function(respuesta){
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            var data = JSON.parse(respuesta);
            data.forEach(datos => {
                let numeroResultado = Number(datos[2]);
                let numeroProceso = Number(datos[3]);
                let numeroEnviado = Number(datos[1]);
                totalResultado += numeroResultado;
                totalProceso += numeroProceso;
                totalEnviado += numeroEnviado;
            });
            let totalIE= totalResultado+totalProceso+totalEnviado;

            var operacionResultado = (totalResultado*100)/totalIE;
            let porcentajeTotalResultado= Number(operacionResultado.toFixed(2));

            var operacionProceso = (totalProceso*100)/totalIE;
            let porcentajeTotalProceso= Number(operacionProceso.toFixed(2));

            var operacionEnviado = (totalEnviado*100)/totalIE;
            let porcentajeTotalEnviado= Number(operacionEnviado.toFixed(2));

            if(totalIE == 0){
                porcentajeTotalResultado = "0";
                porcentajeTotalProceso = "0";
                porcentajeTotalEnviado = "0";
            }
            const ctx = document.getElementById('grafico_Agronomia');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Con Resultado','En Proceso','Enviado al Cliente'],
                    datasets: [{
                    data: [porcentajeTotalResultado,porcentajeTotalProceso,porcentajeTotalEnviado],
                    backgroundColor:['rgb(0, 0, 255)','rgb(255, 0, 19)','rgb(38, 195, 54)'],
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            let agronomiaResultado = `<span class="nav-link" style="color: rgb(0, 0, 255);">Result: ${totalResultado}</span><span class="nav-link" style="color: rgb(0, 0, 255);">Result : ${porcentajeTotalResultado} %</span>`;
            let agronomiaProceso = `<span class="nav-link" style="color: rgb(255, 0, 19);">Proc: ${totalProceso}</span><span class="nav-link" style="color: rgb(255, 0, 19);">Proc: ${porcentajeTotalProceso} %</span>`;
            let agronomiaEnviado = `<span class="nav-link" style="color: rgb(38, 195, 54);">Envi: ${totalEnviado}</span><span class="nav-link" style="color: rgb(38, 195, 54)">Envi: ${porcentajeTotalEnviado} %</span>`;
            $('#agronomiaResultado').html(agronomiaResultado);
            $('#agronomiaProceso').html(agronomiaProceso);
            $('#agronomiaEnviado').html(agronomiaEnviado);
        })
    }
    function graficoAlimentos(){
        $('#alimentos').empty();
        $('#alimentos').append('<canvas id="grafico_Alimentos" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>');
        $.ajax({
            url:'scripts/controlador_lineal_alimentos.php',
            type: 'POST'
        }).done(function(respuesta){
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            var data = JSON.parse(respuesta);
            data.forEach(datos => {
                let numeroResultado = Number(datos[2]);
                let numeroProceso = Number(datos[3]);
                let numeroEnviado = Number(datos[1]);
                totalResultado += numeroResultado;
                totalProceso += numeroProceso;
                totalEnviado += numeroEnviado;
            });
            let totalIE= totalResultado+totalProceso+totalEnviado;

            var operacionResultado = (totalResultado*100)/totalIE;
            let porcentajeTotalResultado= Number(operacionResultado.toFixed(2));

            var operacionProceso = (totalProceso*100)/totalIE;
            let porcentajeTotalProceso= Number(operacionProceso.toFixed(2));

            var operacionEnviado = (totalEnviado*100)/totalIE;
            let porcentajeTotalEnviado= Number(operacionEnviado.toFixed(2));

            if(totalIE == 0){
                porcentajeTotalResultado = "0";
                porcentajeTotalProceso = "0";
                porcentajeTotalEnviado = "0";
            }
            const ctx = document.getElementById('grafico_Alimentos');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Con Resultado','En Proceso','Enviado al Cliente'],
                    datasets: [{
                    data: [porcentajeTotalResultado,porcentajeTotalProceso,porcentajeTotalEnviado],
                    backgroundColor:['rgb(0, 0, 255)','rgb(255, 0, 19)','rgb(38, 195, 54)'],
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            let alimentosResultado = `<span class="nav-link" style="color: rgb(0, 0, 255);">Result: ${totalResultado}</span><span class="nav-link" style="color: rgb(0, 0, 255);">Result : ${porcentajeTotalResultado} %</span>`;
            let alimentosProceso = `<span class="nav-link" style="color: rgb(255, 0, 19);">Proc: ${totalProceso}</span><span class="nav-link" style="color: rgb(255, 0, 19);">Proc: ${porcentajeTotalProceso} %</span>`;
            let alimentosEnviado = `<span class="nav-link" style="color: rgb(38, 195, 54);">Envi: ${totalEnviado}</span><span class="nav-link" style="color: rgb(38, 195, 54)">Envi: ${porcentajeTotalEnviado} %</span>`;
            $('#alimentosResultado').html(alimentosResultado);
            $('#alimentosProceso').html(alimentosProceso);
            $('#alimentosEnviado').html(alimentosEnviado);
        })
    }
    function graficoGeoquimico(){
        $('#geoquimica').empty();
        $('#geoquimica').append('<canvas id="grafico_Geoquimica" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>');
        $.ajax({
            url:'scripts/controlador_lineal_geoquimica.php',
            type: 'POST'
        }).done(function(respuesta){
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            var data = JSON.parse(respuesta);
            data.forEach(datos => {
                let numeroResultado = Number(datos[2]);
                let numeroProceso = Number(datos[3]);
                let numeroEnviado = Number(datos[1]);
                totalResultado += numeroResultado;
                totalProceso += numeroProceso;
                totalEnviado += numeroEnviado;
            });
            let totalIE= totalResultado+totalProceso+totalEnviado;

            var operacionResultado = (totalResultado*100)/totalIE;
            let porcentajeTotalResultado= Number(operacionResultado.toFixed(2));

            var operacionProceso = (totalProceso*100)/totalIE;
            let porcentajeTotalProceso= Number(operacionProceso.toFixed(2));

            var operacionEnviado = (totalEnviado*100)/totalIE;
            let porcentajeTotalEnviado= Number(operacionEnviado.toFixed(2));

            if(totalIE == 0){
                porcentajeTotalResultado = "0";
                porcentajeTotalProceso = "0";
                porcentajeTotalEnviado = "0";
            }
            const ctx = document.getElementById('grafico_Geoquimica');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Con Resultado','En Proceso','Enviado al Cliente'],
                    datasets: [{
                    data: [porcentajeTotalResultado,porcentajeTotalProceso,porcentajeTotalEnviado],
                    backgroundColor:['rgb(0, 0, 255)','rgb(255, 0, 19)','rgb(38, 195, 54)'],
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            let geoquimicaResultado = `<span class="nav-link" style="color: rgb(0, 0, 255);">Result: ${totalResultado}</span><span class="nav-link" style="color: rgb(0, 0, 255);">Result : ${porcentajeTotalResultado} %</span>`;
            let geoquimicaProceso = `<span class="nav-link" style="color: rgb(255, 0, 19);">Proc: ${totalProceso}</span><span class="nav-link" style="color: rgb(255, 0, 19);">Proc: ${porcentajeTotalProceso} %</span>`;
            let geoquimicaEnviado = `<span class="nav-link" style="color: rgb(38, 195, 54);">Envi: ${totalEnviado}</span><span class="nav-link" style="color: rgb(38, 195, 54)">Envi: ${porcentajeTotalEnviado} %</span>`;
            $('#geoquimicaResultado').html(geoquimicaResultado);
            $('#geoquimicaProceso').html(geoquimicaProceso);
            $('#geoquimicaEnviado').html(geoquimicaEnviado);
        })
    }
    function graficoCalibracion(){
        $('#calibracion').empty();
        $('#calibracion').append('<canvas id="grafico_Calibracion" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>');
        $.ajax({
            url:'scripts/controlador_lineal_calibracion.php',
            type: 'POST'
        }).done(function(respuesta){
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            var data = JSON.parse(respuesta);
            data.forEach(datos => {
                let numeroResultado = Number(datos[2]);
                let numeroProceso = Number(datos[3]);
                let numeroEnviado = Number(datos[1]);
                totalResultado += numeroResultado;
                totalProceso += numeroProceso;
                totalEnviado += numeroEnviado;
            });
            let totalIE= totalResultado+totalProceso+totalEnviado;

            var operacionResultado = (totalResultado*100)/totalIE;
            let porcentajeTotalResultado= Number(operacionResultado.toFixed(2));

            var operacionProceso = (totalProceso*100)/totalIE;
            let porcentajeTotalProceso= Number(operacionProceso.toFixed(2));

            var operacionEnviado = (totalEnviado*100)/totalIE;
            let porcentajeTotalEnviado= Number(operacionEnviado.toFixed(2));

            if(totalIE == 0){
                porcentajeTotalResultado = "0";
                porcentajeTotalProceso = "0";
                porcentajeTotalEnviado = "0";
            }
            const ctx = document.getElementById('grafico_Calibracion');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Con Resultado','En Proceso','Enviado al Cliente'],
                    datasets: [{
                    data: [porcentajeTotalResultado,porcentajeTotalProceso,porcentajeTotalEnviado],
                    backgroundColor:['rgb(0, 0, 255)','rgb(255, 0, 19)','rgb(38, 195, 54)'],
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            let calibracionResultado = `<span class="nav-link" style="color: rgb(0, 0, 255);">Result: ${totalResultado}</span><span class="nav-link" style="color: rgb(0, 0, 255);">Result : ${porcentajeTotalResultado} %</span>`;
            let calibracionProceso = `<span class="nav-link" style="color: rgb(255, 0, 19);">Proc: ${totalProceso}</span><span class="nav-link" style="color: rgb(255, 0, 19);">Proc: ${porcentajeTotalProceso} %</span>`;
            let calibracionEnviado = `<span class="nav-link" style="color: rgb(38, 195, 54);">Envi: ${totalEnviado}</span><span class="nav-link" style="color: rgb(38, 195, 54)">Envi: ${porcentajeTotalEnviado} %</span>`;
            $('#calibracionResultado').html(calibracionResultado);
            $('#calibracionProceso').html(calibracionProceso);
            $('#calibracionEnviado').html(calibracionEnviado);
        })
    }
    $('#btnConsultar').click(function(){
        $('#graficoEstado').empty();
        $('#graficoEstado').append('<canvas id="line-chart" style="min-height: 555px; height: 555px; max-height: 555px; max-width: 100%;"></canvas>');
        let fechaInicio = $('#fechaInicio').val();
        let fechaFinal = $('#fechaFinal').val();
        var tipo = document.getElementById('tipo');
        var valueTipo = tipo.options[tipo.selectedIndex].value;
        var unidad = document.getElementById('unidadNegocio');
        var valueUnidad = unidad.options[unidad.selectedIndex].value;
        if(valueUnidad == "Medio Ambiente"){
            valueUnidad = "0000000001";
        }else if(valueUnidad == "Agronomía"){
            valueUnidad = "0000000002";
        }else if(valueUnidad == "Alimentos"){
            valueUnidad = "0000000003";
        }else if(valueUnidad == "Geoquímica"){
            valueUnidad = "0000000004";
        }else if(valueUnidad == "Metrologia (Calibraciones)"){
            valueUnidad = "0000000005";
        }
        let rango = $('#rango').val();
        rangoNumero = parseInt(rango);
        $.ajax({
            url:'scripts/controlador_linea_fecha.php',
            data:{fechaInicio:fechaInicio, fechaFinal: fechaFinal, valueUnidad:valueUnidad},
            type: 'POST'
        }).done(function(respuesta){
            var titulo = [];
            var cantidadResultado = [];
            var cantidadProceso = [];
            var cantidadEnviClie = [];
            var data = JSON.parse(respuesta);
            for(var i = 0; i < data.length; i++){
                if(rangoNumero > data[i][0]){
                    titulo.push(data[i][0]);
                    cantidadEnviClie.push(data[i][1]);
                    cantidadResultado.push(data[i][2]);
                    cantidadProceso.push(data[i][3]);
                }else{
                    titulo.push(data[i][0]);
                    cantidadEnviClie.push(data[i][1]);
                    cantidadResultado.push(data[i][2]);
                    cantidadProceso.push(data[i][3]);
                }
            }
            if(valueTipo == "Con Resultado"){
                const ctx = document.getElementById('line-chart');
                const mixedChart = new Chart(ctx, {
                    data: {
                        datasets: [{
                            type: 'bar',
                            label: 'Con Resultado',
                            data: cantidadResultado,
                            backgroundColor: 'rgb(0, 0, 255)'
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
            }else if(valueTipo == "En Proceso"){
                const ctx = document.getElementById('line-chart');
                const mixedChart = new Chart(ctx, {
                    data: {
                        datasets: [{
                            type: 'bar',
                            label: 'En Proceso',
                            data: cantidadProceso,
                            backgroundColor: 'rgb(255, 0, 19)'
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
            }else if(valueTipo == "Enviado al Cliente"){
                const ctx = document.getElementById('line-chart');
                const mixedChart = new Chart(ctx, {
                    data: {
                        datasets: [{
                            type: 'bar',
                            label: 'Enviado al cliente',
                            data: cantidadEnviClie,
                            backgroundColor: 'rgb(38, 195, 54)'
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
            }else if(valueTipo == "Sin filtro"){
                const ctx = document.getElementById('line-chart');
                const mixedChart = new Chart(ctx, {
                    data: {
                        datasets: [{
                            type: 'bar',
                            label: 'Con Resultado',
                            data: cantidadResultado,
                            backgroundColor: 'rgb(0, 0, 255)'
                        }, {
                            type: 'bar',
                            label: 'En Proceso',
                            data: cantidadProceso,
                            backgroundColor: 'rgb(255, 0, 19)'
                        }, {
                            type: 'bar',
                            label: 'Enviado al cliente',
                            data: cantidadEnviClie,
                            backgroundColor: 'rgb(38, 195, 54)'
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
            }
                
        let template = '';
        let totalResultado = 0;
        let totalProceso = 0;
        let totalEnviado = 0;
        data.forEach(datos => {
            let numeroResultado = Number(datos[2]);
            let numeroProceso = Number(datos[3]);
            let numeroEnviado = Number(datos[1]);
            let numeroDiaRango = Number(datos[0]);
            if(rangoNumero > numeroDiaRango){
                if(valueTipo == "Con Resultado"){
                    if(numeroResultado != 0){
                        totalResultado += numeroResultado;
                        template += `
                        <tr>
                            <td><button class="btn btn-outline-info" dia="${datos[0]}" unidad="${valueUnidad}" estado="${valueTipo}" onclick="mostrar(this)" data-toggle="modal" data-target="#myModal2">${datos[0]}</button></td>
                            <td>${numeroResultado}</td>
                        </tr>
                        `
                    }
                }else if(valueTipo == "En Proceso"){
                    if(numeroProceso != 0){
                        totalProceso += numeroProceso;
                        template += `
                        <tr>
                            <td><button class="btn btn-outline-info" dia="${datos[0]}" unidad="${valueUnidad}" estado="${valueTipo}" onclick="mostrar(this)" data-toggle="modal" data-target="#myModal2">${datos[0]}</button></td>
                            <td>${numeroProceso}</td>
                        </tr>
                        `
                    }
                }else if(valueTipo == "Enviado al Cliente"){
                    if(numeroEnviado != 0){
                        totalEnviado += numeroEnviado;
                        template += `
                        <tr>
                            <td><button class="btn btn-outline-info" dia="${datos[0]}" unidad="${valueUnidad}" estado="${valueTipo}" onclick="mostrar(this)" data-toggle="modal" data-target="#myModal2">${datos[0]}</button></td>
                            <td>${numeroEnviado}</td>
                        </tr>
                        `
                    }
                }else if(valueTipo == "Sin filtro"){
                    totalResultado += numeroResultado;
                    totalProceso += numeroProceso;
                    totalEnviado += numeroEnviado;
                    template += `
                    <tr>
                                <td><button class="btn btn-outline-info" dia="${datos[0]}" unidad="${valueUnidad}" estado="${valueTipo}" onclick="mostrar(this)" data-toggle="modal" data-target="#myModal2">${datos[0]}</button></td>
                                <td>${numeroEnviado}</td>
                                <td>${numeroResultado}</td>
                                <td>${numeroProceso}</td>
                            </tr>
                        `
                }
            }else{
                if(valueTipo == "Con Resultado"){
                    if(numeroResultado != 0){
                        totalResultado += numeroResultado;
                        template += `
                        <tr>
                            <td><button class="btn btn-outline-info" dia="${datos[0]}" unidad="${valueUnidad}" estado="${valueTipo}" onclick="mostrar(this)" data-toggle="modal" data-target="#myModal2">${datos[0]}</button></td>
                            <td>${numeroResultado}</td>
                        </tr>
                        `
                    }
                }else if(valueTipo == "En Proceso"){
                    if(numeroProceso != 0){
                        totalProceso += numeroProceso;
                        template += `
                        <tr>
                            <td><button class="btn btn-outline-info" dia="${datos[0]}" unidad="${valueUnidad}" estado="${valueTipo}" onclick="mostrar(this)" data-toggle="modal" data-target="#myModal2">${datos[0]}</button></td>
                            <td>${numeroProceso}</td>
                        </tr>
                        `
                    }
                }else if(valueTipo == "Enviado al Cliente"){
                    if(numeroEnviado != 0){
                        totalEnviado += numeroEnviado;
                        template += `
                        <tr>
                            <td><button class="btn btn-outline-info" dia="${datos[0]}" unidad="${valueUnidad}" estado="${valueTipo}" onclick="mostrar(this)" data-toggle="modal" data-target="#myModal2">${datos[0]}</button></td>
                            <td>${numeroEnviado}</td>
                        </tr>
                        `
                    }
                }else if(valueTipo == "Sin filtro"){
                    totalResultado += numeroResultado;
                    totalProceso += numeroProceso;
                    totalEnviado += numeroEnviado;
                    template += `
                    <tr>
                                <td><button class="btn btn-outline-info" dia="${datos[0]}" unidad="${valueUnidad}" estado="${valueTipo}" onclick="mostrar(this)" data-toggle="modal" data-target="#myModal2">${datos[0]}</button></td>
                                <td>${numeroEnviado}</td>
                                <td>${numeroResultado}</td>
                                <td>${numeroProceso}</td>
                            </tr>
                        `
                }
            }
        });
        if(valueTipo == "Con Resultado"){
            $('#general').addClass('d-none');
            $('#enviadoCliente').addClass('d-none');
            $('#enProceso').addClass('d-none');
            $('#conResultado').removeClass('d-none');
            $('#tablaResultado').html(template);
            let h3Resultado = `<h4>Total con Resultado: ${totalResultado}</h4>`;
            $('#resultado').html(h3Resultado);
            $('#proceso').empty();
            $('#enviado').empty();
        }else if(valueTipo == "En Proceso"){
            $('#tablaEnProceso').html(template);
            $('#general').addClass('d-none');
            $('#enviadoCliente').addClass('d-none');
            $('#conResultado').addClass('d-none');
            $('#enProceso').removeClass('d-none');
            let h3PRoceso = `<h4>Total con Proceso: ${totalProceso}</h4>`;
            $('#proceso').html(h3PRoceso);
            $('#resultado').empty();
            $('#enviado').empty();
        }else if(valueTipo == "Enviado al Cliente"){
            $('#tablaEnviado').html(template);
            $('#general').addClass('d-none');
            $('#enProceso').addClass('d-none');
            $('#conResultado').addClass('d-none');
            $('#enviadoCliente').removeClass('d-none');
            let h3Enviado = `<h4>Total Enviados: ${totalEnviado}</h4>`;
            $('#enviado').html(h3Enviado);
            $('#resultado').empty();
            $('#proceso').empty();
        }else if(valueTipo == "Sin filtro"){
            $('#tablaResumen').html(template);
            $('#enProceso').addClass('d-none');
            $('#enviadoCliente').addClass('d-none');
            $('#conResultado').addClass('d-none');
            $('#general').removeClass('d-none');
            let h3Resultado = `<h5>Total con Resultado: ${totalResultado}</h5>`;
            let h3PRoceso = `<h5>Total con Proceso: ${totalProceso}</h5>`;
            let h3Enviado = `<h5>Total Enviados: ${totalEnviado}</h5>`;
            $('#resultado').empty();
            $('#proceso').empty();
            $('#enviado').empty();
            $('#resultado').html(h3Resultado);
            $('#proceso').html(h3PRoceso);
            $('#enviado').html(h3Enviado);
        }

        })
        return false;
    });
    function mostrar(btn){
        let dia = $(btn).attr("dia");
        let unidad = $(btn).attr("unidad");
        let tipo = $(btn).attr("estado");
        if(unidad == "0000000001"){
            unidad = "MAM";
        }else if(unidad == "0000000002"){
            unidad = "AGR";
        }else if(unidad == "0000000003"){
            unidad = "ALIM";
        }else if(unidad == "0000000004"){
            unidad = "GEO";
        }else if(unidad == "0000000005"){
            unidad = "CAL"
        }
        $.ajax({
            url : 'scripts/controlador_lineal_dia_informe.php',
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
                    if(datos[3] == unidad){
                        if(tipo == "enProceso" || tipo == "En Proceso"){
                            if(datos[4] != "0"){
                                if(datos[8] == ""){
                                    template += `
                                    <tr>
                                        <td>${datos[8]}</td>
                                        <td>${datos[0]}</td>
                                        <td>${datos[1]}</td>
                                        <td>${datos[2]}</td>
                                        <td>${datos[3]}</td>
                                        <td>${datos[6]}</td>
                                        <td>${datos[5]}</td>
                                        <td>${datos[4]}</td>
                                        <td>${datos[9]}</td>
                                        <td>${datos[10]}</td>
                                        <td>${datos[7]}</td>
                                    </tr>
                                    `
                                }else{
                                    template += `
                                    <tr>
                                        <td><button class="btn btn-danger">Bloqueado</button></td>
                                        <td>${datos[0]}</td>
                                        <td>${datos[1]}</td>
                                        <td>${datos[2]}</td>
                                        <td>${datos[3]}</td>
                                        <td>${datos[6]}</td>
                                        <td>${datos[5]}</td>
                                        <td>${datos[4]}</td>
                                        <td>${datos[9]}</td>
                                        <td>${datos[10]}</td>
                                        <td>${datos[7]}</td>
                                    </tr>
                                    `
                                }
                            }
                        }else if(tipo == "Con Resultado"){
                            if(datos[5] != "0"){
                                if(datos[8] == ""){
                                template += `
                                <tr>
                                    <td>${datos[8]}</td>
                                    <td>${datos[0]}</td>
                                    <td>${datos[1]}</td>
                                    <td>${datos[2]}</td>
                                    <td>${datos[3]}</td>
                                    <td>${datos[5]}</td>
                                    <td>${datos[7]}</td>
                                </tr>
                                `
                            }else{
                                template += `
                                <tr>
                                    <td><button class="btn btn-danger">Bloqueado</button></td>
                                    <td>${datos[0]}</td>
                                    <td>${datos[1]}</td>
                                    <td>${datos[2]}</td>
                                    <td>${datos[3]}</td>
                                    <td>${datos[5]}</td>
                                    <td>${datos[7]}</td>
                                </tr>
                                `
                            }
                            }
                        }else if(tipo == "Enviado al Cliente"){
                            if(datos[6] != "0"){
                                if(datos[8] == ""){
                                    template += `
                                    <tr>
                                        <td>${datos[8]}</td>
                                        <td>${datos[0]}</td>
                                        <td>${datos[1]}</td>
                                        <td>${datos[2]}</td>
                                        <td>${datos[3]}</td>
                                        <td>${datos[6]}</td>
                                        <td>${datos[7]}</td>
                                    </tr>
                                    `
                                }else{
                                    template += `
                                    <tr>
                                        <td><button class="btn btn-danger">Bloqueado</button></td>
                                        <td>${datos[0]}</td>
                                        <td>${datos[1]}</td>
                                        <td>${datos[2]}</td>
                                        <td>${datos[3]}</td>
                                        <td>${datos[6]}</td>
                                        <td>${datos[7]}</td>
                                    </tr>
                                    `
                                }
                            }
                        }else{
                            if(datos[8] == ""){
                                    template += `
                                    <tr>
                                        <td>${datos[8]}</td>
                                        <td>${datos[0]}</td>
                                        <td>${datos[1]}</td>
                                        <td>${datos[2]}</td>
                                        <td>${datos[3]}</td>
                                        <td>${datos[6]}</td>
                                        <td>${datos[5]}</td>
                                        <td>${datos[4]}</td>
                                        <td>${datos[9]}</td>
                                        <td>${datos[10]}</td>
                                        <td>${datos[7]}</td>
                                    </tr>
                                    `
                                }else{
                                    template += `
                                    <tr>
                                        <td><button class="btn btn-danger">Bloqueado</button></td>
                                        <td>${datos[0]}</td>
                                        <td>${datos[1]}</td>
                                        <td>${datos[2]}</td>
                                        <td>${datos[3]}</td>
                                        <td>${datos[6]}</td>
                                        <td>${datos[5]}</td>
                                        <td>${datos[4]}</td>
                                        <td>${datos[9]}</td>
                                        <td>${datos[10]}</td>
                                        <td>${datos[7]}</td>
                                    </tr>
                                    `
                                }
                        }
                    }else{
                        if(datos[8] == ""){
                                template += `
                                <tr>
                                    <td>${datos[8]}</td>
                                    <td>${datos[0]}</td>
                                    <td>${datos[1]}</td>
                                    <td>${datos[2]}</td>
                                    <td>${datos[3]}</td>
                                    <td>${datos[6]}</td>
                                    <td>${datos[5]}</td>
                                    <td>${datos[4]}</td>
                                    <td>${datos[9]}</td>
                                    <td>${datos[10]}</td>
                                    <td>${datos[7]}</td>
                                </tr>
                                `
                        }else{
                            template += `
                            <tr>
                                <td><button class="btn btn-danger">Bloqueado</button></td>
                                <td>${datos[0]}</td>
                                <td>${datos[1]}</td>
                                <td>${datos[2]}</td>
                                <td>${datos[3]}</td>
                                <td>${datos[6]}</td>
                                <td>${datos[5]}</td>
                                <td>${datos[4]}</td>
                                <td>${datos[9]}</td>
                                <td>${datos[10]}</td>
                                <td>${datos[7]}</td>
                            </tr>
                            `
                        }
                    }
                });
                formDia = `<input type="hidden" value ="${dia}" id="txtDia">`;
                formTipo = `<input type="hidden" value ="${tipo}" id="txtTipo">`;
                formUnidad = `<input type="hidden" value ="${unidad}" id="txtUnidad">`;
                $('#capturarDia').html(formDia);
                $('#capturarEstado').html(formTipo);
                $('#capturarUnidad').html(formUnidad);

                if(tipo == "En Proceso"){
                    $('#generalDia').addClass('d-none');
                    $('#enviadoDia').addClass('d-none');
                    $('#resultadoDia').addClass('d-none');
                    $('#procesoDia').removeClass('d-none');
                    $('#tablaDetalleInformeProceso').html(template);
                }else if(tipo == "Con Resultado"){
                    $('#generalDia').addClass('d-none');
                    $('#enviadoDia').addClass('d-none');
                    $('#resultadoDia').removeClass('d-none');
                    $('#procesoDia').addClass('d-none');
                    $('#tablaDetalleInformeConResultado').html(template);
                }else if(tipo == "Enviado al Cliente"){
                    $('#generalDia').addClass('d-none');
                    $('#enviadoDia').removeClass('d-none');
                    $('#resultadoDia').addClass('d-none');
                    $('#procesoDia').addClass('d-none');
                    $('#tablaDetalleInformeEnviado').html(template);
                }else{
                    $('#generalDia').removeClass('d-none');
                    $('#enviadoDia').addClass('d-none');
                    $('#resultadoDia').addClass('d-none');
                    $('#procesoDia').addClass('d-none');
                    $('#tablaDetalleInforme').html(template);
                }
            };
        });
    };
    $('#consultarFiltrosInforme').click(function(){
        var tecnicas = document.getElementById('tecnicas');
        var valueTecnicas = tecnicas.options[tecnicas.selectedIndex].value;

        var laboratorio = document.getElementById('laboratorio');
        var valueLaboratorio = laboratorio.options[laboratorio.selectedIndex].value;

        let diaFiltro = $('#txtDia').val();
        let unidad = $('#txtUnidad').val();
        let tipo = $('#txtTipo').val();

        
        if(unidad == "0000000001"){
            unidad = "MAM";
        }else if(unidad == "0000000002"){
            unidad = "AGR";
        }else if(unidad == "0000000003"){
            unidad = "ALIM";
        }else if(unidad == "0000000004"){
            unidad = "GEO";
        }else if(unidad == "0000000005"){
            unidad = "CAL"
        }else{
            unidad = "sinFiltro";
        }
        $.ajax({
            url : 'scripts/controlador_linea_dia_informe_filtros.php',
            type : 'POST',
            data: {diaFiltro: diaFiltro,valueTecnicas:valueTecnicas,valueLaboratorio:valueLaboratorio}
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
                    if(datos[3] == unidad){
                        if(tipo == "enProceso" || tipo == "En Proceso"){
                            if(datos[4] != "0"){
                                if(datos[8] == ""){
                                    template += `
                                    <tr>
                                        <td>${datos[8]}</td>
                                        <td>${datos[0]}</td>
                                        <td>${datos[1]}</td>
                                        <td>${datos[2]}</td>
                                        <td>${datos[3]}</td>
                                        <td>${datos[6]}</td>
                                        <td>${datos[5]}</td>
                                        <td>${datos[4]}</td>
                                        <td>${datos[9]}</td>
                                        <td>${datos[10]}</td>
                                        <td>${datos[7]}</td>
                                    </tr>
                                    `
                                }else{
                                    template += `
                                    <tr>
                                        <td><button class="btn btn-danger">Bloqueado</button></td>
                                        <td>${datos[0]}</td>
                                        <td>${datos[1]}</td>
                                        <td>${datos[2]}</td>
                                        <td>${datos[3]}</td>
                                        <td>${datos[6]}</td>
                                        <td>${datos[5]}</td>
                                        <td>${datos[4]}</td>
                                        <td>${datos[9]}</td>
                                        <td>${datos[10]}</td>
                                        <td>${datos[7]}</td>
                                    </tr>
                                    `
                                }
                            }
                        }else if(tipo == "Con Resultado"){
                            if(datos[5] != "0"){
                                if(datos[8] == ""){
                                template += `
                                <tr>
                                    <td>${datos[8]}</td>
                                    <td>${datos[0]}</td>
                                    <td>${datos[1]}</td>
                                    <td>${datos[2]}</td>
                                    <td>${datos[3]}</td>
                                    <td>${datos[5]}</td>
                                    <td>${datos[7]}</td>
                                </tr>
                                `
                            }else{
                                template += `
                                <tr>
                                    <td><button class="btn btn-danger">Bloqueado</button></td>
                                    <td>${datos[0]}</td>
                                    <td>${datos[1]}</td>
                                    <td>${datos[2]}</td>
                                    <td>${datos[3]}</td>
                                    <td>${datos[5]}</td>
                                    <td>${datos[7]}</td>
                                </tr>
                                `
                            }
                            }
                        }else if(tipo == "Enviado al Cliente"){
                            if(datos[6] != "0"){
                                if(datos[8] == ""){
                                    template += `
                                    <tr>
                                        <td>${datos[8]}</td>
                                        <td>${datos[0]}</td>
                                        <td>${datos[1]}</td>
                                        <td>${datos[2]}</td>
                                        <td>${datos[3]}</td>
                                        <td>${datos[6]}</td>
                                        <td>${datos[7]}</td>
                                    </tr>
                                    `
                                }else{
                                    template += `
                                    <tr>
                                        <td><button class="btn btn-danger">Bloqueado</button></td>
                                        <td>${datos[0]}</td>
                                        <td>${datos[1]}</td>
                                        <td>${datos[2]}</td>
                                        <td>${datos[3]}</td>
                                        <td>${datos[6]}</td>
                                        <td>${datos[7]}</td>
                                    </tr>
                                    `
                                }
                            }
                        }else{
                            if(datos[8] == ""){
                                    template += `
                                    <tr>
                                        <td>${datos[8]}</td>
                                        <td>${datos[0]}</td>
                                        <td>${datos[1]}</td>
                                        <td>${datos[2]}</td>
                                        <td>${datos[3]}</td>
                                        <td>${datos[6]}</td>
                                        <td>${datos[5]}</td>
                                        <td>${datos[4]}</td>
                                        <td>${datos[9]}</td>
                                        <td>${datos[10]}</td>
                                        <td>${datos[7]}</td>
                                    </tr>
                                    `
                                }else{
                                    template += `
                                    <tr>
                                        <td><button class="btn btn-danger">Bloqueado</button></td>
                                        <td>${datos[0]}</td>
                                        <td>${datos[1]}</td>
                                        <td>${datos[2]}</td>
                                        <td>${datos[3]}</td>
                                        <td>${datos[6]}</td>
                                        <td>${datos[5]}</td>
                                        <td>${datos[4]}</td>
                                        <td>${datos[9]}</td>
                                        <td>${datos[10]}</td>
                                        <td>${datos[7]}</td>
                                    </tr>
                                    `
                                }
                        }
                    }else{
                        if(datos[8] == ""){
                                template += `
                                <tr>
                                    <td>${datos[8]}</td>
                                    <td>${datos[0]}</td>
                                    <td>${datos[1]}</td>
                                    <td>${datos[2]}</td>
                                    <td>${datos[3]}</td>
                                    <td>${datos[6]}</td>
                                    <td>${datos[5]}</td>
                                    <td>${datos[4]}</td>
                                    <td>${datos[9]}</td>
                                    <td>${datos[10]}</td>
                                    <td>${datos[7]}</td>
                                </tr>
                                `
                        }else{
                            template += `
                            <tr>
                                <td><button class="btn btn-danger">Bloqueado</button></td>
                                <td>${datos[0]}</td>
                                <td>${datos[1]}</td>
                                <td>${datos[2]}</td>
                                <td>${datos[3]}</td>
                                <td>${datos[6]}</td>
                                <td>${datos[5]}</td>
                                <td>${datos[4]}</td>
                                <td>${datos[9]}</td>
                                <td>${datos[10]}</td>
                                <td>${datos[7]}</td>
                            </tr>
                            `
                        }
                    }
                });
                formDia = `<input type="hidden" value ="${diaFiltro}" id="txtDia">`;
                formTipo = `<input type="hidden" value ="${tipo}" id="txtTipo">`;
                formUnidad = `<input type="hidden" value ="${unidad}" id="txtUnidad">`;
                $('#capturarDia').html(formDia);
                $('#capturarEstado').html(formTipo);
                $('#capturarUnidad').html(formUnidad);

                if(tipo == "En Proceso"){
                    $('#generalDia').addClass('d-none');
                    $('#enviadoDia').addClass('d-none');
                    $('#resultadoDia').addClass('d-none');
                    $('#procesoDia').removeClass('d-none');
                    $('#tablaDetalleInformeProceso').html(template);
                }else if(tipo == "Con Resultado"){
                    $('#generalDia').addClass('d-none');
                    $('#enviadoDia').addClass('d-none');
                    $('#resultadoDia').removeClass('d-none');
                    $('#procesoDia').addClass('d-none');
                    $('#tablaDetalleInformeConResultado').html(template);
                }else if(tipo == "Enviado al Cliente"){
                    $('#generalDia').addClass('d-none');
                    $('#enviadoDia').removeClass('d-none');
                    $('#resultadoDia').addClass('d-none');
                    $('#procesoDia').addClass('d-none');
                    $('#tablaDetalleInformeEnviado').html(template);
                }else{
                    $('#generalDia').removeClass('d-none');
                    $('#enviadoDia').addClass('d-none');
                    $('#resultadoDia').addClass('d-none');
                    $('#procesoDia').addClass('d-none');
                    $('#tablaDetalleInforme').html(template);
                }
            };
        });
        return false;
    });
    function porcentaje(){
        $('#graficoEstado').empty();
        $('#graficoEstado').append('<canvas id="line-chart" style="min-height: 555px; height: 555px; max-height: 555px; max-width: 100%;"></canvas>');
        $.ajax({
            url:'scripts/controlador_linea.php',
            type: 'POST'
        }).done(function(respuesta){
            let totalResultado = 0;
            let totalProceso = 0;
            let totalEnviado = 0;
            var data = JSON.parse(respuesta);
            data.forEach(datos => {
                let numeroResultado = Number(datos[2]);
                let numeroProceso = Number(datos[3]);
                let numeroEnviado = Number(datos[1]);
                totalResultado += numeroResultado;
                totalProceso += numeroProceso;
                totalEnviado += numeroEnviado;
            });
            const ctx = document.getElementById('line-chart');
            new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Con Resultado','En Proceso','Enviado al Cliente'],
                datasets: [{
                data: [totalResultado,totalProceso,totalEnviado],
                backgroundColor:['rgb(0, 0, 255)','rgb(255, 0, 19)','rgb(38, 195, 54)'],
                }]
            },
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
            });
        });
    };

</script>
</body>
</html>
