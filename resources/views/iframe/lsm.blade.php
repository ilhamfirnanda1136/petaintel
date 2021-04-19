<!DOCTYPE html>
<html>
<head>
    <title>DPRD </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
    
<style>

body {
  margin: 0;
}
html, body, #map {
  height: 100%;
}
    </style>
</head>
<body>
    <div id="map"></div>
<script type="text/javascript" src="{{asset('js/jawatengahkota.js')}}"></script>
<script type="text/javascript" src="{{asset('js/gorontalo.js')}}"></script>
<script src="{{asset('js/input.js')}}"></script>
<script type="text/javascript">
var map = L.map('map').setView([0.5641212,123.0896777], 9);

  L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '<a href>Kejati gorontalo</a>',
    id: 'mapbox.light'
  }).addTo(map);

  var geojson;
 
  geojson = L.geoJson(gorontalo, {
    style: function (feature) {
              return {
                fillColor: getColor(feature.properties.NAME_2),
                fillOpacity: 0.5,
                color: "white",
                dashArray: '3',
                weight: 1,
                opacity: 0.7
              }
          }
  }).addTo(map);

var kosong =L.icon({
    iconUrl:"{{asset('img/lsm.png')}}",
    iconSize:[25,25]
})

  fetch("{{url('muat/lsm')}}/{{$satker}}/{{$tahun}}")
  .then(res => res.json())
  .then((data) => {
    data.forEach(element => { 
        const latArray = [...element.lat];
        const langArray = [...element.lang];
        const randomNumber = Math.floor(Math.random() * 9);
        latArray[5] = randomNumber;
        langArray[6] = randomNumber;
        L.marker([latArray.join(''),langArray.join('')],{icon:kosong}).addTo(map)
        .bindPopup(`<b>Kategori LSM: ${element.deskripsi_lsm}</b><br><b>Alamat : ${element.alamat}</b><br><b>Kedudukan : ${element.kedudukan}</b><br><b>Tanggal Berdiri : ${element.tgl_berdiri}</b><br><b>Keterangan : ${element.keterangan}</b></br>
        <b>Kecamatan : ${element.nama_kecamatan}</b><br><b>Nama Kota : ${element.nama_kota}</b>`, {autoClose:false});
    });
  })
  .catch((err) => console.log(err))

</script>

  </body>
</html>
