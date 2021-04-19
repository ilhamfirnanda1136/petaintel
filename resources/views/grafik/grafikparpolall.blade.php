<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="{{asset('js/input.js')}}"></script>
    <style>
    #grafik-parpol-all {
        width: 100%;
        height: 400px;
    }
    </style>
</head>
<body>
    <center>
        <div id="grafik-parpol-all"></div>
    </center>
    <script>
        am4core.ready(function() {
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("grafik-parpol-all", am4charts.PieChart);
        const url = "{{url('')}}";
        const satker = "{{$satker}}";
        const tahun = "{{$tahun}}";
        const dataChart = [];
        const color = [];
        fetch(`${url}/grafik/muat/parpol/all/${satker}/${tahun}`)
        .then(res => res.json())
        .then(datas => {
            const {parpol,data} = datas;
            parpol.map((item,index) => {
                dataChart.push({
                    "label": item.nama_parpol,
                    "data" : $.parseJSON(data[index]) 
                });
                color.push(randomColor());
            });
            chart.data = dataChart;
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "data";
            pieSeries.dataFields.category = "label";
            pieSeries.slices.template.stroke = am4core.color("#fff");
            pieSeries.slices.template.strokeWidth = 2;
            pieSeries.slices.template.strokeOpacity = 1;
            chart.legend = new am4charts.Legend();
            pieSeries.hiddenState.properties.opacity = 1;
            pieSeries.hiddenState.properties.endAngle = -90;
            pieSeries.hiddenState.properties.startAngle = -90;
          	pieSeries.colors.list = color.map(colour => am4core.color(colour));
        });
	});
    </script>
</body>
</html>