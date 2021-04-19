<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="{{asset('js/input.js')}}"></script>
    <style>
    .wrapper {
      height: 500px !important;
      }
    </style>
</head>
<body>
    <div style=" height:100vh; width:100%">
      <canvas  id="grafik"></canvas>
    </div>
    <script>
        const url = "{{url('')}}";
        const satker = "{{$satker}}";
        var date = new Date();
        var getTahun = [];
        var color = [];
        var tahun = date.getFullYear();
        for (let index = tahun; index >= 2012; index--) {
            getTahun.push(index);
            color.push(randomColor());
        }
        fetch(`${url}/grafik/muat/radikalisme/${satker}`)
        .then(res => res.json())
        .then(data => {
            var ctx = document.getElementById('grafik').getContext('2d');
            var chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels:getTahun,
                            datasets: [{
                                label: `Grafik Radikalisme `,
                                backgroundColor: color,
                                borderColor: color,
                                data: data
                            }]
                        },
                        options: {
                            responsive: true,
                             maintainAspectRatio :false,
                        title: {
                            display: true,
                            text: 'Grafik Radikalisme'
                        },
                         scales: {
                          xAxes: [{
                            ticks: {
                              maxRotation: 90,
                              minRotation: 80
                            }
                          }],
                          yAxes: [{
                            ticks: {
                              beginAtZero: true
                            }
                          }]
                        },
                        layout: {
                        padding: {
                            left: 50,
                            right: 0,
                            top: 0,
                            bottom: 0
                        },
                      } 
                        }
                    });
        })
        .catch(err => console.log(err))
    </script>
</body>
</html>