<?php 

include 'header.php';

?>
<style>
    .multiselect {
    /* width: 200px; */
    }

    .selectBox {
        position: relative;
    }

    .selectBox select {
        height: 2.3rem;
        border-color: #d1d1d1;
        width: 100%;
        /* font-weight: bold; */
    }

    #cbTitle{
        margin-left: 3rem;
    }

    .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    #checkboxes {
        display: none;
        border: 1px #dadada solid;
    }

    #checkboxes label {
        display: block;
    }

    #checkboxes label:hover {
        background-color: #1e90ff;
    }

    .sSeccion{
        margin-left: 1rem;
    }

    #mensaje {
        display: none;
        position: absolute;
        z-index: 1;
        background-color: #f1f1f1;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    }

</style>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Estado de Gestion de Preparación de Materiales</h1>
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
                        <div class="">   
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
                                            <!-- FILTRO -->
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="submit" class="btn btn-block" style="background: #92E19A;" id="btnConsultar" value="Consultar">
                                                </div>
                                                <div class="col-3">
                                                    <select class="form-control" id="anio" name="anio">
                                                        <option value="2024">2024</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2022">2022</option>
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <select class="form-control" id="sede" name="sede">
                                                        <option value="all">Todas las Sedes</option>
                                                        <option value="Sede Guardia Chalaca">Sede Guardia Chalaca</option>
                                                        <option value="Oficina Administrativa Arequipa">Oficina Administrativa Arequipa</option>
                                                        <option value="Oficina Administrativa Piura">Oficina Administrativa Piura</option>
                                                        <option value="Sede Zarumilla">Sede Zarumilla</option>
                                                    </select>
                                                </div>
                                                <div class="col-6 col-md-3 pt-3">

                                                    <form>
                                                        <div class="multiselect">
                                                            <div class="selectBox" onclick="showCheckboxes()">
                                                            <select style='padding-left:15px'>
                                                                <option value='Todas las Áreas' id="cbTitle">Todas las Áreas</option>
                                                            </select>
                                                            <div class="overSelect" onmouseover="mostrarMensaje()" onmouseout="ocultarMensaje()"></div>
                                                            </div>
                                                            <div id="mensaje">Todas las Áreas</div>
                                                            <div id="checkboxes" style="position:absolute; z-index: 1;background-color:white; padding-left:1rem;">
                                                                <label for="cbAll">
                                                                    <input checked type="checkbox" id="cbAll"  value="all"> Todas las Áreas</label> 
                                                                <label for="Responsable1">
                                                                    <input checked type="checkbox" id="Responsable1" value="Responsable1"> Responsable 1</label>
                                                                    <div class="sSeccion" id='Responsable1div'>
                                                                        <label for="cb1">
                                                                            <input checked type="checkbox" id="cb1" onchange="{responsable(1,1)}" value="Agronomía"> Agronomía</label>
                                                                        <label for="cb2">
                                                                            <input checked type="checkbox" id="cb2" onchange="{responsable(1,2)}" value="Geoquímica"> Geoquímica</label>
                                                                        <label for="cb3">
                                                                            <input checked type="checkbox" id="cb3" onchange="{responsable(1,3)}" value="Laboratorio de Agronomía"> Laboratorio de Agronomía</label>
                                                                        <label for="cb4">
                                                                            <input checked type="checkbox" id="cb4" onchange="{responsable(1,4)}" value="Laboratorio Geoquímica"> Laboratorio Geoquímica</label>
                                                                    </div>
                                                                <label for="Responsable2">
                                                                    <input checked type="checkbox" id="Responsable2" value="Responsable2"> Responsable 2</label>
                                                                    <div class="sSeccion" id='Responsable2div'>
                                                                        <label for="cb5">
                                                                            <input checked type="checkbox" id="cb5" onchange="{responsable(2,5)}" value="Laboratorio de Cromatografia"> Laboratorio de Cromatografia</label>
                                                                    </div>
                                                                    <label for="Responsable3">
                                                                    <input checked type="checkbox" id="Responsable3" value="Responsable3"> Responsable 3</label>
                                                                    <div class="sSeccion" id='Responsable3div'>
                                                                        <label for="cb6">
                                                                            <input checked type="checkbox" id="cb6" onchange="{responsable(3,6)}" value="Laboratorio de Fisicoquímica"> Laboratorio de Fisicoquímica</label>
                                                                        <label for="cb7">
                                                                            <input checked type="checkbox" id="cb7" onchange="{responsable(3,7)}" value="Laboratorio FIQ (Agua y Suelo)"> Laboratorio FIQ (Agua y Suelo)</label>
                                                                        <label for="cb8">
                                                                            <input checked type="checkbox" id="cb8" onchange="{responsable(3,8)}" value="Laboratorio FIQ (Aire,Emisiones)"> Laboratorio FIQ (Aire,Emisiones)</label>
                                                                    </div>
                                                                    <label for="Responsable4">
                                                                    <input checked type="checkbox" id="Responsable4" value="Responsable4"> Responsable 4</label>
                                                                    <div class="sSeccion" id='Responsable4div'>
                                                                        <label for="cb9">
                                                                            <input checked type="checkbox" id="cb9" onchange="{responsable(4,9)}" value="Laboratorio de Metales"> Laboratorio de Metales</label>
                                                                    </div>
                                                                    <label for="Responsable5">
                                                                    <input checked type="checkbox" id="Responsable5" value="Responsable5"> Responsable 5</label>
                                                                    <div class="sSeccion" id='Responsable5div'>
                                                                        <label for="cb10">
                                                                            <input checked type="checkbox" id="cb10" onchange="{responsable(5,10)}" value="Laboratorio de Hidrobiología"> Laboratorio de Hidrobiología</label>
                                                                        <label for="cb11">
                                                                            <input checked type="checkbox" id="cb11" onchange="{responsable(5,11)}" value="Laboratorio Microbiología y Parasitología"> Laboratorio Microbiología y Parasitología</label>
                                                                    </div>
                                                                    <label for="Responsable6">
                                                                        <input checked type="checkbox" id="Responsable6" value="Responsable6"> Responsable 6</label>
                                                                    <div class="sSeccion" id='Responsable6div'>
                                                                        <label for="cb12">
                                                                            <input checked type="checkbox" id="cb12" onchange="{responsable(6,12)}" value="Operaciones"> Operaciones</label>
                                                                    </div>  
                                                                    <label for="Responsable7">
                                                                        <input checked type="checkbox" id="Responsable7" value="Responsable7"> Responsable 7</label>
                                                                    <div class="sSeccion" id='Responsable7div'>
                                                                        <label for="cb13">
                                                                            <input checked type="checkbox" id="cb13" onchange="{responsable(7,13)}" value="Laboratorio de Cromatografica  Alimentos"> Laboratorio de Cromatografica  Alimentos</label>
                                                                        <label for="cb14">
                                                                            <input checked type="checkbox" id="cb14" onchange="{responsable(7,14)}" value="Laboratorio Fisicoquímica - Alimentos"> Laboratorio Fisicoquímica - Alimentos</label>
                                                                        <label for="cb15">
                                                                            <input checked type="checkbox" id="cb15" onchange="{responsable(7,15)}" value="Laboratorio de Fisicoquímica - Calibra"> Laboratorio de Fisicoquímica - Calibra</label>
                                                                    </div>
                                                                    <label for="Responsable8">
                                                                    <input checked type="checkbox" id="Responsable8" value="Responsable8"> Responsable 8</label>
                                                                    <div class="sSeccion" id='Responsable8div'>
                                                                        <label for="cb16">
                                                                            <input checked type="checkbox" id="cb16" onchange="{responsable(8,16)}" value="Laboratorio de Radiometría"> Laboratorio de Radiometría</label>
                                                                    </div>
                                                                    <input checked type="checkbox" id="cbOperaciones"  value="Operaciones"> Operaciones</label>
                                                                <label for="cbMetales">
                                                                    <input checked type="checkbox" id="cbMetales"  value="Metales"> Laboratorio de Metales</label>
                                                                <label for="cbFisicoquímica">
                                                                    <input checked type="checkbox" id="cbFisicoquímica"  value="Fisicoquímica"> Laboratorio de Fisicoquímica</label>
                                                                <label for="cbAgronomía">
                                                                    <input checked type="checkbox" id="cbAgronomía"  value="Agronomía"> Laboratorio de Agronomía</label>
                                                                <label for="cbCromatografia">
                                                                    <input checked type="checkbox" id="cbCromatografia"  value="Cromatografia"> Laboratorio de Cromatografia</label>
                                                                <label for="cbMicrobiología">
                                                                    <input checked type="checkbox" id="cbMicrobiología"  value="Microbiología"> Laboratorio de Microbiología y Parasitología</label>
                                                                <label for="cbHidrobiología">
                                                                    <input checked type="checkbox" id="cbHidrobiología"  value="Hidrobiología"> Laboratorio de Hidrobiología</label>
                                                                <label for="cbRadiometría">
                                                                    <input checked type="checkbox" id="cbRadiometría"  value="Radiometría"> Laboratorio de Radiometría</label>
                                                                <label for="cbGeoquímica">
                                                                    <input checked type="checkbox" id="cbGeoquímica"  value="Geoquímica"> Laboratorio de Geoquímica</label>
                                                                <label for="cbCromatografica">
                                                                    <input checked type="checkbox" id="cbCromatografica"  value="Cromatografica"> Laboratorio de Cromatografica</label>
                                                                <label for="cbFisicosensorial">
                                                                    <input checked type="checkbox" id="cbFisicosensorial"  value="Fisicosensorial"> Laboratorio de Fisicosensorial</label>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-6 col-md-3 pt-3">
                                                    <select class="form-control" id="muestreo" name="muestreo">
                                                        <option value="all">Muestreo: Todas</option>
                                                        <option value="Realizado por el Cliente">Realizado por el Cliente</option>
                                                        <option value="Realizado por Hullasoft (**)">Realizado por Hullasoft</option>
                                                    
                                                    </select>
                                                </div>
                                                <div class="col-6 col-md-3 pt-3">
                                                    <select class="form-control" id="unidadNegocio" name="unidadNegocio">
                                                        <option value="all">Todas las Unidades de Negocio</option>
                                                        <option value="MAM">Medio Ambiente</option>
                                                        <option value="ALIM">Alimentos</option>
                                                        <option value="AGR">Agronomía</option>
                                                        <option value="GEO">Geoquímica</option>
                                                    </select>
                                                </div>
                                                <div class="col-6 col-md-3 pt-3">
                                                    <select class="form-control" id="cliente" name="cliente">
                                                        <option value="all">Todos los Clientes</option>
                                                <?php 
                                                // echo "<!--";
                                                    // require 'controlador_general_clientes.php';
                                                // echo " -->";
                                                ?>
                                                    </select>
                                                </div>
                                            </div> 
                                            <!-- FILTRO -->
                                        </form>
                                    </div>
                                    <br>
                                    <!-- <div class="col-12 text-center">
                                        <h4 id="text1">Status Solicitudes de Ensayo en días <span id="frame"></span></h4>
                                        <h4 id="text2"></h4>
                                    </div> -->
                                    <div id="graficoEstado" class="max-w-100" style="max-height: 600px; height:90vh;">
                                        
                                        <canvas id="graficoPrincipal" style="width:100%; max-height: 600px; height:90vh;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="card">
                                <table class="table table-bordered m-0 mt-2">
                                    <thead style="background: #00C262; color: white;">
                                        <tr class="h4">
                                            <th></th>
                                            <th class="col-1">Promedio</th>
                                            <th class="col-2">Min</th>
                                            <th class="col-2">Max</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="color:#0A6E00; background-color:#D9FFC780" class="h4" id="row-1">
                                        <td>Solicitud de Envio</td>
                                        <td id="SolicitudPro"></td>
                                        <td id="SolicitudMin"></td>
                                        <td id="SolicitudMax"></td>
                                        </tr>
                                        <tr style="color:#113A5B; background-color:#D3EBFF80" class="h4" id="row-2">
                                        <td>Preparación de Materiales</td>
                                        <td id="PreparacionPro"></td>
                                        <td id="PreparacionMin"></td>
                                        <td id="PreparacionMax"></td>
                                        </tr>
                                        <tr style="color:#5B115A; background-color:#E9D8FF80" class="h4" id="row-3">
                                        <td>Entrega</td>
                                        <td id="EntPro"></td>
                                        <td id="EntMin"></td>
                                        <td id="EntMax"></td>
                                        </tr>
                                        <tr style="color:#AE0C0C; background-color:#FFD8D880" class="h4" id="row-4">
                                        <td>Total</td>
                                        <td id="TotalPro"></td>
                                        <td id="TotalMin"></td>
                                        <td id="TotalMax"></td>
                                        </tr>
                                    </tbody>
                                </table>
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
<!-- 
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/cylinder.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>


<script>

    // Valores Globales
    var mesesTotales = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    var filtros = [];
    function makeChart(){

        $('#graficoEstado').empty();
        
        $('#graficoEstado').append('<canvas id="graficoPrincipal" style="width:100%; max-height: 600px; height:90vh;"></canvas>');

        var year = $('#anio').val();

        var areas = [];

        filtros = [
            $('#sede').val(),
            areas,
            // $('#area').val(),
            $('#muestreo').val(),
            $('#unidadNegocio').val(),
            $('#cliente').val()
        ];
        // var sede = "all";
        // GRAFICOS
        $.ajax({
            url:'scripts/controlador_indicador.php',
            data: {
                fecha:year,
                filtros:filtros,
                function:'graficoPreparacionMetales'
            },
            type: 'POST'
        }).then(function(respuesta){
            console.log(respuesta);
            valores = JSON.parse(respuesta);
            resultados = [];
            var solicitud = 0;
            var preparacion = 0;
            var entrega = 0;
            var total = 0;
            var solicitudProm = 0;
            var preparacionProm = 0;
            var entregaProm = 0;
            var totalProm = 0;
            var cantidad = 0;
            var contador = 0;
            var meses = [];

            var arraySolicitud = [];
            var arrayPreparacion = [];
            var arrayEntrega = [];
            var arrayTotal = [];

            var arraySolicitudProm = [];
            var arrayPreparacionProm = [];
            var arrayEntregaProm = [];
            var arrayTotalProm = [];

            var arrayCantidad = [];

            valores.forEach(v => {
                solicitud += v[1];
                preparacion += v[2];
                entrega += v[3];
                total += v[4];
                solicitudProm += v[5];
                preparacionProm += v[6];
                entregaProm += v[7];
                totalProm += v[8];
                cantidad += v[9];

                arraySolicitud.push(v[1]);
                arrayPreparacion.push(v[2]);
                arrayEntrega.push(v[3]);
                arrayTotal.push(v[4]);
                arraySolicitudProm.push(v[5]);
                arrayPreparacionProm.push(v[6]);
                arrayEntregaProm.push(v[7]);
                arrayTotalProm.push(v[8]);

                arrayCantidad.push(v[9]);

                meses.push(mesesTotales[contador]);
                contador += 1;
                // console.log([v[0],v[1],v[2],v[3],v[4],v[5],v[6],v[7],v[8],v[9]]);
                // resultados.push(v[5],v[6],v[7],v[8]);
            });

            const todosLosNumeros = [...arraySolicitudProm, ...arrayPreparacionProm, ...arrayEntregaProm, ...arrayTotalProm];
            const valorMayor = Math.max(...todosLosNumeros);
            const maxValueWithMargin =  Math.round((valorMayor * 1.25));
            
            const ctx = document.getElementById('graficoPrincipal').getContext('2d');
            const indices = ['SOLICITUD DE ENVIO','PREPARACIÓN DE MATERIALES','ENTREGA','TOTAL'];

            const data = {
                labels: meses,
                datasets: [
                    {
                        label: 'SOLICITUD DE ENVIO',
                        data: arraySolicitudProm,
                        borderColor: '#0A6E00',
                        backgroundColor: '#D9FFC780',
                        order: 1,
                        borderWidth:0.3
                    },
                    {
                        label: 'PREPARACIÓN DE MATERIALES',
                        data: arrayPreparacionProm,
                        borderColor: '#113A5B',
                        backgroundColor: '#D3EBFF80',
                        order: 1,
                        borderWidth:0.3
                    },
                    {
                        label: 'ENTREGA',
                        data: arrayEntregaProm,
                        borderColor: '#5B115A',
                        backgroundColor: '#E9D8FF80',
                        order: 1,
                        borderWidth:0.3
                    },
                    {
                        label: 'TOTAL',
                        data: arrayTotalProm,
                        borderColor: '#AE0C0C',
                        backgroundColor: '#FFD8D880',
                        order: 1,
                        borderWidth:0.3
                    },
                    {
                        label: 'Total',
                        data: arrayTotalProm,
                        borderColor: 'rgb(255, 99, 132)',
                        backgroundColor: 'rgb(255, 99, 132, 0.5)',
                        type: 'line',
                        order: 2
                    }
// color:#0A6E00; background-color:#D9FFC780
// color:#113A5B; background-color:#D3EBFF80
// color:#5B115A; background-color:#E9D8FF80
// color:#AE0C0C; background-color:#FFD8D880
                ]
            };

            const stackedBar = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        x: {
                            stacked: false
                        },
                        y: {
                            stacked: false,
                            beginAtZero: true,
                            max: maxValueWithMargin
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    let lineX = context.label || '';
                                    let valor = 0;
                                    if ( indices.indexOf(label) == 0) {
                                        valor = arraySolicitud[meses.indexOf(lineX)];
                                    } else if ( indices.indexOf(label) == 1) {
                                        valor = arrayPreparacion[meses.indexOf(lineX)];
                                    } else if ( indices.indexOf(label) == 2) {
                                        valor = arrayEntrega[meses.indexOf(lineX)];
                                    } else if ( indices.indexOf(label) == 3) {
                                        valor = arrayTotal[meses.indexOf(lineX)];
                                    } else {
                                        console.log( indices.indexOf(label));
                                        valor = 0
                                    }
                                    if (label) {
                                        label += '- Promedio ';
                                    }
                                    label += context.raw;
                                    label += ' - ' + valor + ' Horas';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        

        // tablaCompleta = [arraySolicitudProm,arrayPreparacionProm,arrayEntregaProm,arrayTotalProm];

        minSolicitudProm = Math.min(...arraySolicitudProm);
        minPreparacionProm = Math.min(...arrayPreparacionProm);
        minEntregaProm = Math.min(...arrayEntregaProm);
        minTotalProm = Math.min(...arrayTotalProm);

        maxSolicitudProm = Math.max(...arraySolicitudProm);
        maxPreparacionProm = Math.max(...arrayPreparacionProm);
        maxEntregaProm = Math.max(...arrayEntregaProm);
        maxTotalProm = Math.max(...arrayTotalProm);

        console.log(arraySolicitudProm);
        console.log(arrayPreparacionProm);
        console.log(arrayEntregaProm);
        console.log(arrayTotalProm);

        SumSolicitudProm = 0;
        arraySolicitudProm.forEach(e => {
            SumSolicitudProm += parseInt(e);
        });
        console.log(SumSolicitudProm);

        SumPreparacionProm = 0;
        arrayPreparacionProm.forEach(e => {
            SumPreparacionProm += parseInt(e);
        });
        console.log(SumPreparacionProm);

        SumEntregaProm = 0;
        arrayEntregaProm.forEach(e => {
            SumEntregaProm += parseInt(e);
        });
        console.log(SumEntregaProm);

        SumTotalProm = 0;
        arrayTotalProm.forEach(e => {
            SumTotalProm += parseInt(e);
        });
        console.log(SumTotalProm);

        var SolicitudProm = (SumSolicitudProm / arraySolicitudProm.length).toFixed(0);
        var PreparacionProm = (SumPreparacionProm / arrayPreparacionProm.length).toFixed(0);
        var EntregaProm = (SumEntregaProm / arrayEntregaProm.length).toFixed(0);
        var TotalProm = (SumTotalProm / arrayTotalProm.length).toFixed(0);

    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });

        // mesesTotales

        var minProm1 = "";
        var minCont1 = 0;
        var minTitle1 = "";
        arraySolicitudProm.forEach(function(v,n){
            if(v == minSolicitudProm){
                if(minCont1 >= 1){
                    minTitle1 = minTitle1+" "+mesesTotales[n];
                    minCont1++;
                }
                if(minCont1 == 0){
                    minProm1 = mesesTotales[n];
                    minCont1++;
                }
            }
        });
        minProm1 = minSolicitudProm + " <span title='"+minTitle1+"' class='h6 mt-auto mb-0' data-bs-toggle='tooltip'>" + (minCont1 > 1 ? minProm1+" "+" (*)" : minProm1 ) + " </span>";

        var minProm2 = "";
        var minCont2 = 0;
        var minTitle2 = "";
        console.log("PREPARACION MINIMA");
        arrayPreparacionProm.forEach(function(v,n){
            if(v == minPreparacionProm){
                if(minCont2 >= 1){
                    minTitle2 = minTitle2+" "+mesesTotales[n];
                    minCont2++;
                }
                if(minCont2 == 0){
                    minProm2 = mesesTotales[n];
                    minCont2++;
                }
                console.log("CONTADOR : "+ minCont2);
            }
        });
        minProm2 = minPreparacionProm + " <span title='"+minTitle2+"' class='h6 mt-auto mb-0' data-bs-toggle='tooltip'>" + (minCont2 > 1 ? minProm2+" "+" (*)" : minProm2 ) + " </span>";

        var minProm3 = "";
        var minCont3 = 0;
        var minTitle3 = "";
        arrayEntregaProm.forEach(function(v,n){
            if(v == minEntregaProm){
                if(minCont3 >= 1){
                    minTitle3 = minTitle3+" "+mesesTotales[n];
                    minCont3++;
                }
                if(minCont3 == 0){
                    minProm3 = mesesTotales[n];
                    minCont3++;
                }
            }
        });
        minProm3 = minEntregaProm + " <span title='"+minTitle3+"' class='h6 mt-auto mb-0' data-bs-toggle='tooltip'>" + (minCont3 > 1 ? minProm3+" "+" (*)" : minProm3 ) + " </span>";

        var minProm4 = "";
        var minCont4 = 0;
        var minTitle4 = "";
        arrayTotalProm.forEach(function(v,n){
            if(v == minTotalProm){
                if(minCont4 >= 1){
                    minTitle4 = minTitle4+" "+mesesTotales[n];
                    minCont4++;
                }
                if(minCont4 == 0){
                    minProm4 = mesesTotales[n];
                    minCont4++;
                }
            }
        });
        minProm4 = minTotalProm + " <span title='"+minTitle4+"' class='h6 mt-auto mb-0' data-bs-toggle='tooltip'>" + (minCont4 > 1 ? minProm4+" "+" (*)" : minProm4 ) + " </span>";





        // <p><span class="text-danger" data-toggle="tooltip" title="This is a tooltip">*</span> Required field</p>
        // document.getElementById("SolicitudMin").innerText = minSolicitudProm;
        document.getElementById("SolicitudMin").innerHTML = minProm1;
        document.getElementById("PreparacionMin").innerHTML = minProm2;
        document.getElementById("EntMin").innerHTML = minProm3;
        document.getElementById("TotalMin").innerHTML = minProm4;


        
        var maxProm1 = "";
        var maxCont1 = 0;
        var maxTitle1 = "";

        arraySolicitudProm.forEach(function(v,n){
            if(v == maxSolicitudProm){
                if(maxCont1 >= 1){
                    maxTitle1 = maxTitle1+" "+mesesTotales[n];
                    // maxProm1 += ", "+mesesTotales[n];
                    maxCont1++;
                }
                if(maxCont1 == 0){
                    maxProm1 = mesesTotales[n];
                    maxCont1++;
                }
            }
        });
        maxProm1 = maxSolicitudProm + " <span title='"+maxTitle1+"' class='h6 mt-auto mb-0' data-bs-toggle='tooltip'>" + (maxCont1 > 1 ? maxProm1+" "+" (*)" : maxProm1 ) + " </span>";

        var maxProm2 = "";
        var maxCont2 = 0;
        var maxTitle2 = "";

        arrayPreparacionProm.forEach(function(v,n){
            if(v == maxPreparacionProm){
                if(maxCont2 >= 1){
                    maxTitle2 = maxTitle2+" "+mesesTotales[n];
                    // maxProm2 += ", "+mesesTotales[n];
                    maxCont2++;
                }
                if(maxCont2 == 0){
                    maxProm2 = mesesTotales[n];
                    maxCont2++;
                }
            }
        });
        maxProm2 = maxPreparacionProm + " <span title='"+maxTitle2+"' class='h6 mt-auto mb-0' data-bs-toggle='tooltip'>" + (maxCont2 > 1 ? maxProm2+" "+" (*)" : maxProm2 ) + " </span>";

        var maxProm3 = "";
        var maxCont3 = 0;
        var maxTitle3 = "";

        arrayEntregaProm.forEach(function(v,n){
            if(v == maxEntregaProm){
                if(maxCont3 >= 1){
                    maxTitle3 = maxTitle3+" "+mesesTotales[n];
                    // maxProm3 += ", "+mesesTotales[n];
                    maxCont3++;
                }
                if(maxCont3 == 0){
                    maxProm3 = mesesTotales[n];
                    maxCont3++;
                }
            }
        });
        maxProm3 = maxEntregaProm + " <span title='"+maxTitle3+"' class='h6 mt-auto mb-0' data-bs-toggle='tooltip'>" + (maxCont3 > 1 ? maxProm3+" "+" (*)" : maxProm3 ) + " </span>";

        var maxProm4 = "";
        var maxCont4 = 0;
        var maxTitle4 = "";

        arrayTotalProm.forEach(function(v,n){
            if(v == maxTotalProm){
                if(maxCont4 >= 1){
                    maxTitle4 = maxTitle4+" "+mesesTotales[n];
                    // maxProm4 += ", "+mesesTotales[n];
                    maxCont4++;
                }
                if(maxCont4 == 0){
                    maxProm4 = mesesTotales[n];
                    maxCont4++;
                }
            }
        });
        maxProm4 = maxTotalProm + " <span title='"+maxTitle4+"' class='h6 mt-auto mb-0' data-bs-toggle='tooltip'>" + (maxCont4 > 1 ? maxProm4+" "+" (*)" : maxProm4 ) + " </span>";

        document.getElementById("SolicitudMax").innerHTML = maxProm1;
        document.getElementById("PreparacionMax").innerHTML = maxProm2;
        document.getElementById("EntMax").innerHTML = maxProm3;
        document.getElementById("TotalMax").innerHTML = maxProm4;

        document.getElementById("SolicitudPro").innerHTML = SolicitudProm;
        document.getElementById("PreparacionPro").innerHTML = PreparacionProm;
        document.getElementById("EntPro").innerHTML = EntregaProm;
        document.getElementById("TotalPro").innerHTML = TotalProm;

        });

}


    makeChart();

    $('#btnConsultar').click(function(){
        event.preventDefault();
        makeChart();
    });

    function loadClient(){
        var sel = document.getElementById('cliente');

        sel.innerHTML = "";


        let load = document.createElement('option');
        load.value = "...";
        load.innerText = "...";
        sel.appendChild(load);

        $.ajax({
            url:'scripts/controlador_general_clientes.php',
            data: {
                
            },
            type: 'POST'
        }).then(function(respuesta){
            var cliente = JSON.parse(respuesta);
            // console.log(respuesta);
            sel.innerHTML = "";
            let main = document.createElement('option');
            main.value = "all";
            main.innerText = "Todos los Clientes";
            sel.appendChild(main);

            cliente.forEach(e => {
                let option = document.createElement('option');
                option.value = e;
                option.innerText = e;
                sel.appendChild(option);
            });
        }).fail(function(r){
            alert('No se pudo cargar la lista de clientes');
        });
    }

    setTimeout(() => {loadClient()},2000);
    // document.onload(function(){alert("cargado")});

// SELECT CHECKBOX

var expanded = false;

function showCheckboxes() {
    var checkboxes = document.getElementById("checkboxes");
    if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
    } else {
        checkboxes.style.display = "none";
        expanded = false;
    }
}

// checkboxes

var checkboxes = document.getElementById('checkboxes').querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function(){
            if(checkbox.id.match("Responsable") ){
                cambios(this.id);
            }
        });

        checkbox.addEventListener('change', function(){
            cambio(this.id);
        });
    });


    function cambio(v){
        if(v == "cbAll"){
            var valAll = false;
            if(document.getElementById(v).checked){
                document.getElementById('cbTitle').innerHTML = 'Todas las Áreas';
                document.getElementById('cbTitle').value = 'Todas las Áreas';
                valAll = true;
            }

            checkboxes.forEach(function(e) {
                document.getElementById(e.id).checked = valAll;
            });
        }else{
            var todoOk = allChecked();
            if(todoOk){
                document.getElementById('cbTitle').innerHTML = 'Todas las Áreas';
                document.getElementById('cbTitle').value = 'Todas las Áreas';
                document.getElementById('cbAll').checked = true;
            }else{
                // 1111111111
                // whiterArea();
                document.getElementById("mensaje").innerHTML = whiterArea(0);
                document.getElementById('cbTitle').innerHTML = whiterArea(1);
                // document.getElementById('cbTitle').innerHTML = 'Algunas Áreas';
                document.getElementById('cbTitle').value = 'Algunas Áreas';
                document.getElementById('cbAll').checked = false;
            }
        }
    }

    var rp = {
        "Responsable1":[1,2,3,4],
        "Responsable2":[5],
        "Responsable3":[6,7,8],
        "Responsable4":[9],
        "Responsable5":[10,11],
        "Responsable6":[12],
        "Responsable7":[13,14,15],
        "Responsable8":[16]
    };

    function cambios(v){
        rp[v].forEach(e => {
            document.getElementById('cb'+e).checked = document.getElementById(v).checked;
        }); 
    }

    function mostrarMensaje() {
        document.getElementById("mensaje").style.display = "block";
    }

    function ocultarMensaje() {
        document.getElementById("mensaje").style.display = "none";
    }

    function whiterArea(n){
        if(n == 1){
            sArea = [];
        }else{
            sArea = "";
        }

        checkboxes.forEach(e => {

            if(e.checked && e.id != 'cbAll' ){
            // if(e.checked && e.id != 'cbAll' && !e.id.match('Responsable') ){
                if(n == 1){
                    sArea.push(e.value);
                }else{
                    if(e.value.match("Responsable")){

                        var isEmpty = document.getElementById(e.id+"div").querySelectorAll('input[type="checkbox"]');
                        // sArea += "<strong>"+e.value+"</strong><br>";
                        if( isEmpty.length > 0 ){
                            sArea += "<strong>"+e.value+"</strong><br>";
                        }

                    }else{
                        sArea += e.value+"<br>";
                    }
                }
            }

        });

        return sArea;
    }

function responsable(r,n){
    console.log("------------------");
    console.log(r);
    console.log(n);
    console.log("------------------");
    var nameRespo = 'Responsable'+r;
    var res = document.getElementById(nameRespo+'div').querySelectorAll('input[type="checkbox"]');
    
    var allTrue = true;
    var allFalse = false;
    console.log("PRE CHECK");
    console.log(res);
    res.forEach(e => {
        if(e.checked){
            allFalse = false;
        }else{
            allTrue = false;
        }
        console.log(e.id);
        console.log(e.checked);
    });
    console.log("PRO CHECK");
    if(allFalse){
        rp[nameRespo].forEach(e => {
            document.getElementById('cb'+e).checked = false;
        });
    }else{
        document.getElementById(nameRespo).checked = false;
    }

    if(allTrue){
        document.getElementById(nameRespo).checked = true;
        rp[nameRespo].forEach(e => {
            document.getElementById('cb'+e).checked = true;
        });
    }
}

function allChecked(){
    var result = true;
    checkboxes.forEach(function(c) {
        if(!c.checked && c.id != 'cbAll'){
            result = false;
        }
    });
    return result;
}
// cbAll
// cbOperaciones
// cbMetales
// cbFisicoquímica
// cbAgronomía
// cbCromatografia
// cbMicrobiología
// cbHidrobiología
// cbRadiometría
// cbGeoquímica
// cbCromatografica
// cbFisicosensorial

function mostrar(btn){
        let anio = $(btn).attr("anio");
        let mes = $(btn).attr("mes");
        let dia = $(btn).attr("dia");
        console.log("-----------------------------");
        console.log(">------ DATOS ENVIADOS -----<");
        console.log("-----------------------------");
        console.log(anio);
        console.log(mes);
        console.log(dia);
        $('#tablaDetalleGeneral').html('Cargando...');
        $.ajax({
            url : 'scripts/controlador_btn_general.php',
            type : 'POST',
            data: {anio: anio, mes: mes, dia:dia}
        }).done(function(resp){
            console.log("RESPUESTA DE PRIMER BOTÓN");
            console.log(resp);
            $('#tablaDetalleGeneral').html('');
            if(resp == "error"){
                alert("No se encontró registros.");
            }else{
                let template = '';
                var data = JSON.parse(resp);
                data.forEach(datos => {
                    var nombresMeses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                    var numeroMes = datos[4];
                    var nombreMes = nombresMeses[numeroMes - 1];
                    template += `
                                <tr>
                                    <td>${datos[0]}</td>
                                    <td>${datos[1]}</td>
                                    <td>${datos[2]}</td>
                                    <td>${datos[3]}</td>
                                    <td>${nombreMes}</td>
                                    <td>${datos[5]}</td>
                                    <td>${datos[6]}</td>
                                </tr>
                                `
                });
                    $('#padreTablaDetalleGeneral').DataTable().destroy();
                    $('#tablaDetalleGeneral').html(template);
                    $('#padreTablaDetalleGeneral').DataTable({
                        language: idioma_espanol
                    });
            };
        });
    };
    function mostrarResumen(btn){
        let anio = $(btn).attr("anioResumen");
        let mes = $(btn).attr("mesResumen");
        let dia = $(btn).attr("diaResumen");
        console.log("-----------------------------");
        console.log(">------ DATOS ENVIADOS -----<");
        console.log("-----------------------------");
        console.log(anio);
        console.log(mes);
        console.log(dia);
        $.ajax({
            url : 'scripts/controlador_btn_resumido.php',
            type : 'POST',
            data: {anio: anio, mes: mes, dia:dia}
        }).done(function(resp){
            console.log("RESPUESTA DE SEGUNDO BOTÓN");
            console.log(resp);
            if(resp == "error"){
                alert("No se encontró registros.");
            }else{
                let template = '';
                var data = JSON.parse(resp);
                data.forEach(datos => {
                    var nombresMeses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                    var numeroMes = datos[0];
                    var nombreMes = nombresMeses[numeroMes - 1];
                    template += `
                                <tr>
                                    <td>${nombreMes}</td>
                                    <td>${datos[1]}</td>
                                    <td>${datos[2]}</td>
                                    <td>${datos[3]}</td>
                                    <td>${datos[4]}</td>
                                    <td>${datos[5]}</td>
                                    <td>${datos[6]}</td>
                                    <td>${datos[7]}</td>
                                    <td>${datos[8]}</td>
                                    <td>${datos[9]}</td>
                                    <td>${datos[10]}</td>
                                    <td>${datos[11]}</td>
                                    <td>${datos[12]}</td>
                                </tr>
                                `
                });
                    $('#padreTablaDetalleResumido').DataTable().destroy();
                    $('#tablaDetalleResumido').html(template);
                    $('#padreTablaDetalleResumido').DataTable({
                        language: idioma_espanol
                    });
            };
        });
    };
</script>
</body>
</html>

