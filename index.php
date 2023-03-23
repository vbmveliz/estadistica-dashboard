<?php 

include 'header.php';

?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Ordenes de Servicio - Finalizar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Ordenes de Servicio - Finalizar</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <section class="col-lg-12 connectedSortable">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Mapa del Perú
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="world-map" style="height: 400px; width: 100%;"></div>
              </div>
              <div class="card-footer bg-transparent">
                <form>
                  <div class="row">
                    <div class="col-6 text-center">
                      <div class="text-white">
                        <div class="form-group">
                          <select class="form-control" id="estado">
                              <option>Cliente recibió los materiales</option>
                              <option>Generado</option>
                              <option>Solicita preparación de Materiales</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 text-center">
                      <div class="text-white">
                        <div class="form-group">
                          <select class="form-control" id="unidad">
                              <option>Alimentos</option>
                              <option>Agronomía</option>
                              <option>Medio Ambiente</option>
                          </select>
                        </div>
                      </div>
                    </div>
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
                      <div id="sparkline-2"></div>
                      <div class="text-white">
                        <div class="d-flex justify-content-center">
                        <input type="date" class="form-control" id="fechaFinal"
                          min="<?php echo $fecha;?>" max="<?php echo date("Y-m-d");?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-6 text-center">
                      <div id="sparkline-2"></div>
                      <div class="text-white">
                        <div class="d-flex justify-content-center">
                          <input type="submit" class="btn btn-info btn-block" id="btnConsultar" value="Consultar">
                        </div>
                      </div>
                    </div>
                    <div class="col-6 text-center">
                      <div id="sparkline-2"></div>
                      <div class="text-white">
                        <div class="d-flex justify-content-center">
                          <a href="index.php" class="btn btn-warning btn-block">Nueva consulta</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </section>
          <section class="col-lg-6 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Estadísticas
                </h3>
              </div>
              <div class="card-body">
                <div class="tab-content p-0">
                  <form>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="form-control" id="OSEstado">
                                    <option>Generado</option>
                                    <option>Solicitud Preparación Materiales</option>
                                    <option>Recepción Preparando Materiales</option>
                                    <option>Cliente Recibé los Materiales</option>
                                    <option>Finalizado / Atendido</option>
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
                  <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 500px;">
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section class="col-lg-6 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Datos Resumen
                </h3>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body">
                <div class="chart" style="height: 500px; overflow:scroll;">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>EOS</th>
                        <th># Días</th>
                        <th>% OS</th>
                      </tr>
                    </thead>
                    <tbody id="tablaResumen">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>

        </div>
      </div>
    </section>
  </div>
<?php 

include 'footer.php'

?>
