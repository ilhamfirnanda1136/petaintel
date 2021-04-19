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
        const tahun = "{{$tahun}}";
        var color = [];
        for (var i = 0; i < 12; i++) color.push(randomColor());
        fetch(`${url}/grafik/muat/vaksinasi/${satker}/${tahun}`)
        .then(res => res.json())
        .then(data => {
            const array =new Array(data[0].total_januari,data[0].total_februari,data[0].total_maret,data[0].total_april,data[0].total_mei,data[0].total_juni,data[0].total_juli,data[0].total_agustus,data[0].total_september,data[0].total_oktober,data[0].total_november,data[0].total_desember);
            var ctx = document.getElementById('grafik').getContext('2d');
            var chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels:["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
                            datasets: [{
                                label: `Grafik vaksinasi `,
                                backgroundColor: color,
                                borderColor: color,
                                data: array
                            }]
                        },
                        options: {
                            responsive: true,
                             maintainAspectRatio :false,
                        title: {
                            display: true,
                            text: 'Grafik vaksinasi'
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