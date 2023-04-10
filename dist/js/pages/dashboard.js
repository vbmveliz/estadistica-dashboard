$(function () {
  'use strict'
  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder: 'sort-highlight',
    connectWith: '.connectedSortable',
    handle: '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex: 999999
  })
  $('.connectedSortable .card-header').css('cursor', 'move')

  // jQuery UI sortable for the todo list
  $('.todo-list').sortable({
    placeholder: 'sort-highlight',
    handle: '.handle',
    forcePlaceholderSize: true,
    zIndex: 999999
  })

  // bootstrap WYSIHTML5 - text editor
  $('.textarea').summernote()

  $('.daterange').daterangepicker({
    ranges: {
      Today: [moment(), moment()],
      Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate: moment()
  }, function (start, end) {
    // eslint-disable-next-line no-alert
    alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
  })

  /* jQueryKnob */
  $('.knob').knob()
  $('#world-map').vectorMap({
    map: 'peru',
    zoomOnScrollSpeed: 5,
    regionStyle: {
      initial: {
        fill: 'rgba(255, 255, 255, 1)',
        'fill-opacity': 1,
        stroke: 'rgba(0,0,0,.5)',
        'stroke-width': 1,
        'stroke-opacity': 1
      }
    },onRegionClick: function (e, code) {
      $("#btnConsultar").click(function(e){
        if(code == "are"){
          var sede = "Oficina Administrativa Arequipa";
        }else if(code == "piu"){
          var sede = "Oficina Administrativa Piura";
        }else if(code == "cal"){
          var sede = "Sede Guardia Chalaca";
        }else if(code == "lim"){
          var sede = "Sede Guardia Chalaca";
        }else{
          alert("Solamente departamentos donde tiene sede ALAB");
        }
        $('#sales-chart').empty();
        const myTimeout1 = setTimeout(myGreeting1, 100);
        function myGreeting1() {
          $('#sales-chart').append('<div class="spinner" id="spinner"></div>');
        }
        const myTimeout2 = setTimeout(myGreeting2, 2000);
        function myGreeting2() {
            document.getElementById("spinner").classList.add('d-none');
        }
        $('#sales-chart').append('<canvas id="sales-chart-canvas" height="500" style="height: 500px;"></canvas>');
        var estado = document.getElementById('estado');
        var valueEstado = estado.options[estado.selectedIndex].value;
        var unidad = document.getElementById('unidad');
        var valueUnidad = unidad.options[unidad.selectedIndex].value;
        var fechaInicio = $('#fechaInicio').val();
        var fechaFinal = $('#fechaFinal').val();
        $.ajax({
          url:'scripts/controlador_grafico_1.php',
          type: 'POST',
          data: { sede: sede ,valueEstado: valueEstado, valueUnidad: valueUnidad,fechaInicio: fechaInicio,  fechaFinal: fechaFinal}
        }).done(function(resp){
          if(resp == "error"){
            alert("No se encontró registros.");
          }else{
            var titulo = [];
            var cantidad = [];
            var data = JSON.parse(resp);
            for(var i = 0; i < data.length; i++){
                titulo.push(data[i][0]);
                cantidad.push(data[i][4]);
            }
            var salesChart = new Chart(salesChartCanvas, {
              type: 'pie',
              data: {
                labels: titulo,
                datasets: [{
                label: 'Día que tiene mayor',
                data: cantidad,
                backgroundColor:[
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ]
                }]
              },
              options: pieOptions
            })
            var pieChartCanvas = $('#sales-chart-canvas');
            var pieData = {
              labels: titulo,
              datasets: [
                {
                  data: cantidad,
                  backgroundColor:[
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                  ]
                }
              ]
            }
            var pieOptions = {
              legend: {
                display: false
              },
              maintainAspectRatio: false,
              responsive: true
            }
            var pieChart = new Chart(pieChartCanvas, {
              type: 'pie',
              data: pieData,
              options: pieOptions
            })
          }
        })
        return false;
      })
      
    }
  })

/* Consultar Estado de OS */

$('#btnConsultarEstado').click(function(){
  var estadoOs = document.getElementById('OSEstado');
  var valueEstadoOs = estadoOs.options[estadoOs.selectedIndex].value;
  $('#sales-chart').empty();
  const myTimeout1 = setTimeout(myGreeting1, 100);
  function myGreeting1() {
    $('#sales-chart').append('<div class="spinner" id="spinner"></div>');
  }
  const myTimeout2 = setTimeout(myGreeting2, 150);
  function myGreeting2() {
      document.getElementById("spinner").classList.add('d-none');
  }
  $('#sales-chart').append('<canvas id="sales-chart-canvas" height="500" style="height: 500px;"></canvas>');
  $.ajax({
      url : 'scripts/controlador_grafico_1_2.php',
      type : 'POST',
      data: {valueEstadoOs: valueEstadoOs}
  }).done(function(resp){
    if(resp == "error"){
      alert("No se encontró registros.");
    }else{
      var titulo = [];
      var cantidad = [];
      var data = JSON.parse(resp);
      for(var i = 0; i < data.length; i++){
          titulo.push(data[i][0]);
          cantidad.push(data[i][1]);
      }
      var donutChartCanvas = $('#sales-chart-canvas');
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
      type: 'pie',
      data: donutData,
      options: donutOptions
      })
      let templatetotal = ''; 
      let template = '';
      let total = 0;
      data.forEach(datos => {
      let numero = Number(datos[1]);
      //cuando quieres validar el tipo de dato de un valor se usa lo siguiente
      total += numero;
      });
      data.forEach(datosSuma => {
      let numero = Number(datosSuma[1]);
      var operacion = (numero*100)/total
      let porcentaje= Number(operacion.toFixed(2));
      template += `
              <tr class="porcentaje">
                  <td>${datosSuma[2]}</td>
                  <td><button class="btn btn-outline-info" dia="${datosSuma[0]}" estado="${valueEstadoOs}"  onclick="mostrar(this)" data-toggle="modal" data-target="#myModal">${datosSuma[0]}</button></td>
                  <td>${numero}</td>
                  <td>${porcentaje+" %"}</td>
              </tr>
              `
      });
      templatetotal = `
      <div class="row">
        <div class="col-4"><h3>${"Total de Os: "+total}</h3></div>
        <div class="col-4" id="iePendiente"></div>
        <div class="col-4" id="ieResultado"></div>
      </div>
      `
      $('#tablaResumen').html(template);
      $('#total').html(templatetotal);
    }
  })
  $.ajax({
    url : 'scripts/controlador_grafico_1_2_total.php',
    type : 'POST',
    data: {valueEstadoOs: valueEstadoOs}
  }).done(function(respuesta){
    if(respuesta == "error"){
      alert("No se encontró registros.");
    }else{
      let totalPediente = 0;
      let totalResultado = 0;
      var h3Pendiente = "";
      var h3Resultado = "";
      var data = JSON.parse(respuesta);
      data.forEach(datos => {
        let numeroPendiente = Number(datos[1]);
        let numeroResultado = Number(datos[2]);
        totalPediente += numeroPendiente;
        totalResultado += numeroResultado;
        h3Pendiente = `<h3>${"Total de IE - Pendiente: "+totalPediente}</h3>`;
        h3Resultado = `<h3>${"Total de IE - Resultado : "+totalResultado}</h3>`;
      });
      $('#iePendiente').html(h3Pendiente);
      $('#ieResultado').html(h3Resultado);
      
    }
  })
  return false;
});

  // The Calender
  $('#calendar').datetimepicker({
    format: 'L',
    inline: true
  })

  // SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').overlayScrollbars({
    height: '250px'
  })

  /* Chart.js Charts */
  // Sales chart
  var salesChartCanvas = document.getElementById('revenue-chart-canvas');
  // $('#revenue-chart').get(0).getContext('2d');
  });

  function mostrar(btn){

    let dia = $(btn).attr("dia");
    let estado = $(btn).attr("estado");
    $.ajax({
      url : 'scripts/controlador_tabla_1.php',
      type : 'POST',
      data: {dia: dia, estado: estado}
    }).done(function(resp){
      if(resp == "error"){
        alert("No se encontró registros.");
      }else{
        let template = '';
        var data = JSON.parse(resp);
        data.forEach(datos => {
        template += `
                <tr>
                    <td>${datos[0]}</td>
                    <td>${datos[1]}</td>s
                    <td>${datos[2]}</td>
                    <td>${datos[10]}</td>
                    <td class="text-center">${datos[11]}</td>
                    <td class="text-center">${datos[12]}</td>
                </tr>
                `
        });
        $('#tablaDetalle').html(template);
        
      }
    })
  
  }
