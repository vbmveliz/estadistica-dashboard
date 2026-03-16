<?php 

include 'header.php';

?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Listado de inconsistencia y revertidos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Listado de inconsistencia y revertidos</li>
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
                                <h3 class="card-title">Informes de Ensayo</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div class="text-white">
                                            <div class="form-group">
                                                <input type="date" class="form-control" id="fechaInicio"
                                                    <?php 
                                                        $ano = date("Y");
                                                        ?>
                                                min="<?php echo $ano;?>-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo $ano;?>-01-01">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="text-white">
                                            <div class="d-flex justify-content-center">
                                            <input type="date" class="form-control" id="fechaFinal"
                                            min="<?php echo $ano;?>-01-01"  max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="text-white">
                                            <div class="d-flex justify-content-center">
                                                <input type="submit" class="btn btn-block" style="background: #92E19A;" id="btnConsultar" value="Consultar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                                <div class="chart" style="font-size: 14px;">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="tablaInforme">
                                            <thead class="bg-dark">
                                            <tr>
                                                <th>N° Informe de Ensayo</th>
                                                <th>EStado OS</th>
                                                <th>N° Orden de Servicio</th>
                                                <th>Estado de orden de Servicio</th>
                                                <th>Fecha</th>
                                                <th>Fecha invertida</th>
                                            </tr>
                                            </thead>
                                            <tbody id="informes">
                                            </tbody>
                                        </table>
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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datHullasoftels@2.0.0"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="dist/idioma/espanol.js"></script>
<!-- Page specific script -->

<script>
    $(function (){
        $.ajax({
            url:'scripts/controlador_estado_informe.php',
            type: 'POST'
        }).done(function(respuesta){
            var data = JSON.parse(respuesta);
            let template = '';
            data.forEach(datos => {
                if(datos[5] == null){
                    template += `
                        <tr>
                            <td>${datos[0]}</td>
                            <td>${datos[1]}</td>
                            <td>${datos[2]}</td>
                            <td>${datos[3]}</td>
                            <td>${datos[4]}</td>
                            <td></td>
                        </tr>
                        `
                }else{
                    template += `
                        <tr>
                            <td>${datos[0]}</td>
                            <td>${datos[1]}</td>
                            <td>${datos[2]}</td>
                            <td>${datos[3]}</td>
                            <td>${datos[4]}</td>
                            <td>${datos[5]}</td>
                        </tr>
                        `
                }
            });
            $('#informes').empty();
            $('#informes').html(template);
            $('#tablaInforme').DataTable({
                language: idioma_espanol
            });
        });
    });
    $('#btnConsultar').click(function(){
        let fechaInicio = $('#fechaInicio').val();
        let fechaFinal = $('#fechaFinal').val();
        $.ajax({
            url:'scripts/controlador_estado_informe_fecha.php',
            data:{fechaInicio:fechaInicio, fechaFinal: fechaFinal},
            type: 'POST'
        }).done(function(respuesta){
            var data = JSON.parse(respuesta);
            let template = '';
            data.forEach(datos => {
                if(datos[5] == null){
                    template += `
                        <tr>
                            <td>${datos[0]}</td>
                            <td>${datos[1]}</td>
                            <td>${datos[2]}</td>
                            <td>${datos[3]}</td>
                            <td>${datos[4]}</td>
                            <td></td>
                        </tr>
                        `
                }else{
                    template += `
                        <tr>
                            <td>${datos[0]}</td>
                            <td>${datos[1]}</td>
                            <td>${datos[2]}</td>
                            <td>${datos[3]}</td>
                            <td>${datos[4]}</td>
                            <td>${datos[5]}</td>
                        </tr>
                        `
                }
            });
            $('#informes').empty();
            $('#informes').html(template);

            $('#tablaInforme').DataTable({
                language: idioma_espanol
            });
        });
        return false;
    });

</script>
</body>
</html>
