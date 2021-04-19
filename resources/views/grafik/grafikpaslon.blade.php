<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Paslon</title>
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
        fetch(`${url}/grafik/muat/paslon/${satker}/${tahun}`)
        .then(res => res.json())
        .then(data => {
            const labels = data.kecamatan.map( item => item.nama_kecamatan);
            const arr = [];
            const objectData = [];
            data.data.map(item => {
                if(item === null) {
                    arr.push(0);
                } else if (item === 'split') {
                    arr.push('|');
                } else {
                    arr.push(item.jml_suara);
                }
            });
            const toString = arr.join();
            const arrayData = toString.split(",|,");
            const label = data.datapaslon.map(item => item)
            .filter((value, index, self) => self.indexOf(value) === index);
            var no = 0;
            for (const i of label) {
                objectData.push({
                    label: i,
                    backgroundColor: randomColor(),
                    borderColor: randomColor(),
                    data: arrayData[no++].split(",")
                })
            }
            const ctx = document.getElementById('grafik').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels:labels,
                    datasets: objectData
                },
                options: {
                    responsive: true,
                     maintainAspectRatio :false,
                title: {
                    display: true,
                    text: 'Grafik Pilkada'
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