$(document).ready(function(){
    $.ajax({
        url: 'scripts/controlador_grafico_2.php',
        type: 'POST',
    }).done(function(resp){
        var titulo = [];
        var cantidad = [];
        var data = JSON.parse(resp);
        for(var i = 0; i < data.length; i++){
            titulo.push(data[i][0]);
            cantidad.push(data[i][3]);
        }

        const os = {
            labels: titulo,
            datasets: [{
                label: 'My First Dataset',
                data: cantidad,
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
            };

        const ctx = document.getElementById('estadoPie');
            new Chart(ctx, {
                type: 'doughnut',
                data: os,
            });
        
    })
});