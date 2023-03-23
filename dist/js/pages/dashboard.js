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
            console.log(resp);
          }
        })
        return false;
      })
      
    }
  })
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

