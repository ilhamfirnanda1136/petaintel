@extends('layouts.template')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin="" />
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Peta LSM/ORMAS</div>
                    <div id="map" class="maps-leaflet-container"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin">
            <div class="card">
            <div class="card-header">
                <div class="float-right">
                <a href="{{url('laporan/peta/lsm')}}" class="btn btn-success" id="tambah-jenis"><i class="fa fa-download"></i> Laporan Data lsm</a>
                <a href="{{url('tambah/peta/lsm')}}" class="btn btn-primary" id="tambah-jenis"><i class="fa fa-plus"></i> Tambah Data Peta lsm</a>
                
                </div>
            </div>
                <div class="card-body">
                    <h4 class="card-title">Data Peta lsm/Ormas</h4>
                    <div class="table-responsive">
                        <table id="lsm" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No #</th>
                                    <th>Wilayah</th>
                                    <th>Nama Lsm Ormas</th>
                                    <th>Alamat</th>
                                    <th>Kedudukan</th>
                                    <th>Tgl Berdiri</th>
                                    <th>Pengurus</th>
                                    <th>ruang lingkup</th>
                                    <th>keterangan</th>
                                    <th>Bulan dan Tahun</th>
                                    <th>Kategori LSM  </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('footer')
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
    integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
    crossorigin=""></script>
<script type="text/javascript" src="{{asset('js/bengkulu.js')}}"></script>

<script type="text/javascript">

document.querySelector('.maps-leaflet-container').style.height = '450px';
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
    iconUrl:"{{asset('img/pinmap.png')}}",
    iconSize:[25,25]
})

  fetch("{{url('muat/lsm')}}/{{Auth::user()->satker_id}}/kosong")
  .then(res => res.json())
  .then((data) => {
    data.forEach(element => {
        L.marker([element.lat,element.lang],{icon:kosong}).addTo(map)
        .bindPopup(`<b>Kategori LSM: ${element.deskripsi_lsm}</b><br><b>Alamat : ${element.alamat}</b><br><b>Kedudukan : ${element.kedudukan}</b><br><b>Tanggal Berdiri : ${element.tgl_berdiri}</b><br><b>Keterangan : ${element.keterangan}</b></br>
        <b>Kecamatan : ${element.nama_kecamatan}</b><br><b>Nama Kota : ${element.nama_kota}</b>`, {autoClose:false});
    });
  })
  .catch((err) => console.log(err))

    $(document).ready(function(){
        $('#lsm').DataTable({
            processing: true,
            serverSide: true,
            responsive:true,
            ajax: process_env_url + "/table/lsm",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id'
                },
                {
                    data: 'wilayah',
                    name: 'wilayah'
                },
                 {
                     data: 'nama_lsm',
                     name: 'nama_lsm'
                 },
                  {
                     data: 'alamat',
                     name: 'alamat',
                    "render": function ( data, type, row, meta ) {
                        return wordWrap(data,40);
                    }
                 },
                  {
                     data: 'kedudukan',
                     name: 'kedudukan'
                 },
                  {
                     data: 'tgl_berdiri',
                     name: 'tgl_berdiri'
                 },
                  {
                     data: 'pengurus',
                     name: 'pengurus'
                 },
                  {
                     data: 'ruanglingkup',
                     name: 'ruanglingkup'
                 },
                {
                    data: 'keterangan',
                    name: 'keterangan',
                    "render": function ( data, type, row, meta ) {
                        return wordWrap(data,40);
                    }
                },
                {
                    data: 'bulantahun',
                    name: 'bulantahun'
                },
                {
                    data: 'jenislsm',
                    name: 'jenislsm'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            "order": [
                [0, "desc"]
            ],
        });

        $('body').on('click','.btn-delete',function(){
        const url = process_env_url + '/hapus/lsm/' + $(this).data('id');
          swal({
                  title: "Are you sure?",
                  text: "Ingin Menghapus? , anda akan kehilangan data Peta lsm!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willDelete) => {
                  if (willDelete) {
                    loading();
                    fetch(url, {
                            method: "GET",
                            headers: {
                                'Content-type': 'application/json'
                            },
                        })
                        .then(res => res.json())
                        .then((data) => {
                            matikanLoading();
                            $('#lsm').DataTable().ajax.reload();
                            swal({
                                title: "Pesan!",
                                text: data.message,
                                icon: "success",
                            });
                        });
                } else {
                    swal({
                        title: "Pesan!",
                        text: "anda telah membatalkan menghapus jenis lsm ",
                        icon: "success",
                    });
                 }
            })
        })
    })
</script>
@endsection
