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
                    <div class="card-title">Peta Pengawasan Aliran Kepercayaan Masyarakat</div>
                    <div id="map" class="maps-leaflet-container"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin">
            <div class="card">
            <div class="card-header">
                <div class="float-right">
                <a href="{{url('laporan/peta/pakem')}}" class="btn btn-success" id="tambah-jenis"><i class="fa fa-download"></i> Laporan Data pakem</a>
                <a href="{{url('tambah/peta/pakem')}}" class="btn btn-primary" id="tambah-jenis"><i class="fa fa-plus"></i> Tambah Data Peta pakem</a>
                </div>
            </div>
                <div class="card-body">
                    <h4 class="card-title">Data Pengawasan Aliran Kepercayaan Masyarakat </h4>
                    <div class="table-responsive">
                        <table id="pakem" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No #</th>
                                    <th>Wilayah</th>
                                    <th>Nama Aliran Kepercayaan</th>
                                    <th>Nama Pimpinan</th>
                                    <th>Alamat</th>
                                    <th>Jumlah Pengikut</th>
                                    <th>Bentuk Kegiatan </th>
                                    <th>Status Organisasi</th>
                                    <th>Nomor dan Tanggal Pendaftaran Kesbangpol</th>
                                    <th>Nomor dan Pendaftaran badan Hukum</th>
                                    <th>keterangan</th>
                                    <th>Bulan dan Tahun</th>
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

  fetch("{{url('muat/pakem')}}/{{Auth::user()->satker_id}}/kosong")
  .then(res => res.json())
  .then((data) => {
      data.forEach((element,index) => {
        var kosong = new L.AwesomeNumberMarkers({
                        number: ++index, 
                        markerColor: "orange"
                    });
        L.marker([element.lat,element.lang],{icon:kosong}).addTo(map)
        .bindPopup(`<b>Judul Peta : ${element.judul}</b><br><b>Keterangan : ${element.keterangan}</b></br>
        <b>Kecamatan : ${element.nama_kecamatan}</b><br><b>Nama Kota : ${element.nama_kota}</b>`, {autoClose:false}).openPopup();
    });
  })
  .catch((err) => console.log(err))

  $(document).ready(function(){
    $('#pakem').DataTable({
        processing: true,
        serverSide: true,
        responsive:true,
        ajax: process_env_url + "/table/pakem",
        columns: [{
                data: 'DT_RowIndex',
                name: 'id'
            },
            {
                data: 'wilayah',
                name: 'wilayah'
            },
            {
                    data: 'judul',
                    name: 'judul'
            },
            {
                    data: 'nama_pimpinan',
                    name: 'nama_pimpinan'
            },
            {
                    data: 'alamat',
                    name: 'alamat',   
                    "render": function ( data, type, row, meta ) {
                    return wordWrap(data,40);
                }
            },
            {
                    data: 'jumlah_pengikut',
                    name: 'jumlah_pengikut'
            },
            {
                    data: 'bentuk',
                    name: 'bentuk'
            },
            {
                    data: 'status_organisasi',
                    name: 'status_organisasi',
                "render": function ( data, type, row, meta ) {
                    return wordWrap(data,40);
                }
            },
            {
                    data: 'nomor_kesbangpol',
                    name: 'nomor_kesbangpol',
                "render": function ( data, type, row, meta ) {
                    return wordWrap(data,40);
                }
            },

            {
                    data: 'nomor_badanhukum',
                    name: 'nomor_badanhukum',
                "render": function ( data, type, row, meta ) {
                    return wordWrap(data,40);
                }
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
                data: 'action',
                name: 'action'
            },
        ],
        "order": [
            [0, "desc"]
        ],
    });

        $('body').on('click','.btn-delete',function(){
        const url = process_env_url + '/hapus/pakem/' + $(this).data('id');
          swal({
                  title: "Are you sure?",
                  text: "Ingin Menghapus? , anda akan kehilangan data Peta pakem!",
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
                            $('#pakem').DataTable().ajax.reload();
                            swal({
                                title: "Pesan!",
                                text: data.message,
                                icon: "success",
                            });
                        });
                } else {
                    swal({
                        title: "Pesan!",
                        text: "anda telah membatalkan menghapus jenis pakem ",
                        icon: "success",
                    });
                 }
            })
        })
    })
</script>
@endsection
