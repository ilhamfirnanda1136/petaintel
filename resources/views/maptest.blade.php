<!DOCTYPE html>
<html>
<head>
    <title>PENYULUHAN DAN PENERANGAN HUKUM</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
    <!-- CSS only -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
<style>
body {
  margin: 0;
}
html, body, #map {
  height: 70%;
}
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}


#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
    </style>
</head>
<body>
  <div class="card">
        <div class="card-body">
            <div class="card-title">Custom Icons Map</div>
            <div id="map" class="maps-leaflet-container"></div>
        </div>
  </div>


<script type="text/javascript" src="{{asset('js/bantenkota.js')}}"></script>
<script type="text/javascript">
  document.querySelector('.maps-leaflet-container').style.height = '450px';
  var map = L.map('map').setView([-6.1721646,106.151813], 9);
  L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '<a href>Kejati Banten</a>',
    id: 'mapbox.light'
  }).addTo(map);

  function getColor(d) {
    return d == 'Cilegon' ? '#6a00b0' :
           d == 'Kota Serang' ? '#D597F9' :
           d == 'Kota Tangerang' ? '#00c954' :
           d == 'Lebak' ? '#EC9949' :
           d == 'Pandeglang' ? '#4C51EF' :
           d == 'Serang' ? '#EF4242' :
           d == 'Tangerang' ? '#EEF72E' : '#00d0ff' ;
  }
  var geojson;
//   var kosong =L.icon({
//     iconUrl:"{{asset('icon/pinmap.png')}}",
//     iconSize:[25,25]
// })
  geojson = L.geoJson(banten, {
    style: function (feature) {
              kota = feature.properties.NAME_2;
              return {
                fillColor: getColor(kota),
                fillOpacity: 0.5,
                color: "white",
                dashArray: '3',
                weight: 1,
                opacity: 0.7
              }
          }
  }).addTo(map);

  var popup = L.popup();
  var marker; 
  var markers = [];
  function onMapClick(e) {
    markerDelAgain();
        popup
            .setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(map);
         marker = L.marker(e.latlng).addTo(map);
         markers.push(marker);
         console.log(markers);
         document.getElementById('latli').value = e.latlng.lat +','+e.latlng.lng;
    }
    function markerDelAgain() {
      for(i=0;i<markers.length;i++) {
          map.removeLayer(markers[i]);
        }
      markers = [];  
      }
    map.on('click', onMapClick);
</script>
</body>
</html>

