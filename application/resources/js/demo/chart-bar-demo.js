// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

$.ajax({
  type:'POST',
  url:'../application/ajax/recaudacion_ajax.php',
  data:'año=2018',
  success:function(data){
    var valores = JSON.parse(data);
    
    var e  = isNaN(valores[1]) ? 0 : valores[1];
    var f  = isNaN(valores[2]) ? 0 : valores[2];
    var m  = isNaN(valores[3]) ? 0 : valores[3];
    var a  = isNaN(valores[4]) ? 0 : valores[4];
    var ma = isNaN(valores[5]) ? 0 : valores[5];
    var j  = isNaN(valores[6]) ? 0 : valores[6];
    var ju = isNaN(valores[7]) ? 0 : valores[7];
    var ag = isNaN(valores[8]) ? 0 : valores[8];
    var s  = isNaN(valores[9]) ? 0 : valores[9];
    var o  = isNaN(valores[10]) ? 0 : valores[10];
    var n  = isNaN(valores[11]) ? 0 : valores[11];
    var d  = isNaN(valores[12]) ? 0 : valores[12];

    var maximo = Math.max(e, f, m, a, ma, j, ju, ag, s, o, n, d);

    var ctx = document.getElementById("myBarChart");
    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        datasets: [{
          label: "Recaudacion",
          backgroundColor: "rgba(2,117,216,1)",
          borderColor: "rgba(2,117,216,1)",
          data: [e, f, m, a, ma, j, ju, ag, s, o, n, d],
        }],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 6
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: maximo,
              maxTicksLimit: 5
            },
            gridLines: {
              display: true
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });


  }
});


///////////////GANANCIA PARA LE SISTEMA///////////////////////


$.ajax({
  type:'POST',
  url:'../application/ajax/recaudacion_ajax.php',
  data:'año=2018',
  success:function(data){
    var valores = JSON.parse(data);
    
    var e  = isNaN(valores[1]) ? 0 : valores[1]*0.05;
    var f  = isNaN(valores[2]) ? 0 : valores[2]*0.05;
    var m  = isNaN(valores[3]) ? 0 : valores[3]*0.05;
    var a  = isNaN(valores[4]) ? 0 : valores[4]*0.05;
    var ma = isNaN(valores[5]) ? 0 : valores[5]*0.05;
    var j  = isNaN(valores[6]) ? 0 : valores[6]*0.05;
    var ju = isNaN(valores[7]) ? 0 : valores[7]*0.05;
    var ag = isNaN(valores[8]) ? 0 : valores[8]*0.05;
    var s  = isNaN(valores[9]) ? 0 : valores[9]*0.05;
    var o  = isNaN(valores[10]) ? 0 : valores[10]*0.05;
    var n  = isNaN(valores[11]) ? 0 : valores[11]*0.05;
    var d  = isNaN(valores[12]) ? 0 : valores[12]*0.05;

    var maximo = Math.max(e, f, m, a, ma, j, ju, ag, s, o, n, d);

    var ctx = document.getElementById("myBarChartGananciaAdmin");
    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        datasets: [{
          label: "Recaudacion",
          backgroundColor: "rgba(2,216,117,1)",
          borderColor: "rgba(2,117,216,1)",
          data: [e, f, m, a, ma, j, ju, ag, s, o, n, d],
        }],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 6
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: maximo,
              maxTicksLimit: 5
            },
            gridLines: {
              display: true
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });


  }
});

