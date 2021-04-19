@extends('layouts.template')
@section('header')
@stop
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 ">
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Form Suara Partai Politik</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" id="formSubmit" method="post">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="periode_pemilu">Periode Pemilu</label>
                                <select class="form-control " name="periode_pemilu" id="periode_pemilu">
                                    <?php
                                $thn_skr = date('Y');
                                for ($x = $thn_skr; $x >= 2017; $x--) {
                                ?>
                                    <option value="<?=$x?>" {{$x==date('Y') ? 'selected' : ''}}><?php echo $x ?>
                                    </option>
                                    <?php
                                }
                                ?>
                                </select>
                                <small class="text-danger periode_pemilu"></small>
                            </div>
                            <div class="form-group col-md-10">
                                <button type="button" class="btn btn-success btn-sm btn-tambah-parpol mb-3"><i
                                        class="fa fa-plus"></i> Pilih Parpol *</button>
                                <input type="text" name="parpol" class="form-control" id="parpol_id"
                                    placeholder="Pilih Parpol" readonly>
                                <input type="hidden" name="parpol_id" id="parpol">
                                <small class="text-danger parpol_id"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kota">kota</label>
                                <select name="kota" id="kota" class="form-control">
                                    <option value="">Pilih Kota</option>
                                    @foreach($kota as $k)
                                        <option value="{{$k->id}}" >{{$k->nama_kota}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger kota"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kecamatan">kecamatan</label>
                                <select name="kecamatan_id" id="kecamatan_id" class="form-control">
                                   <option value="">--Pilih Kota Terlebih Dahulu --</option>
                                </select>
                                <small class="text-danger kecamatan_id"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Jumlah Suara *</label>
                                <input type="number" name="jml_suara" id="jml_suara" class="form-control"
                                    placeholder="Masukkan Jumlah Suara">
                                <span class="text-danger jml_suara"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style="margin-top: -31px">
                        <button type="button" id="btn-tambah" class="btn btn-danger col-md-12"><i
                                class="fa fa-save"></i>
                            Simpan</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Suara parpol Calon Bupati</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%" id="table-suara" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Urut</th>
                                    <th>Kecamatan</th>
                                    <th>Nama Parpol</th>
                                    <th>Periode</th>
                                    <th>Logo parpol</th>
                                    <th>Jumlah Suara</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>No Urut</th>
                                    <th>Kecamatan</th>
                                    <th>Nama Parpol</th>
                                    <th>Periode</th>
                                    <th>Logo parpol</th>
                                    <th>Jumlah Suara</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade example-modal" id="modal-parpol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="max-width:1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih parpol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-hover table-striped data-tabless" id="table-parpol" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Urut</th>
                            <th>Nama Parpol</th>
                            <th>Logo Parpol</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($parpol as $p)
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$p->no_urut}}</td>
                            <td>{{$p->nama_parpol}}</td>
                            <td>
                                <image src='{{asset('img/parpol')}}/{{$p->logo_parpol}}' alt='{$p->nama_parpol}'
                                    style='border-radius:0px;width:30%;height:70px;' />
                            </td>
                            <td><button class="btn-pilih-parpol btn btn-primary" data-id="{{$p->id}}"
                                    data-nama="{{$p->nama_parpol}}"><i
                                        class="fa fa-plus"></i></button></td>
                        </tr>
                        <?php $no++; ?>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>No Urut</th>
                            <th>Nama Parpol</th>
                            <th>Logo Parpol</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-edit-suara" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="formEditSubmit" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-edit"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                   <div class="form-group">
                        <label for="periode_pemilu">Periode Pemilu</label>
                        <select class="form-control " name="periode_pemilu" id="edit_periode_pemilu">
                            <?php
                        $thn_skr = date('Y');
                        for ($x = $thn_skr; $x >= 2017; $x--) {
                        ?>
                            <option value="<?=$x?>" {{$x==date('Y') ? 'selected' : ''}}><?php echo $x ?>
                            </option>
                            <?php
                        }
                        ?>
                        </select>
                        <small class="text-danger edit_periode_pemilu"></small>
                    </div>
              
                    <div class="form-group ">
                        <label>Jumlah Suara *</label>
                        <input type="number" name="jml_suara" id="edit_jml_suara" class="form-control"
                            placeholder="Masukkan Jumlah Suara">
                        <span class="text-danger edit_jml_suara"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpanEdit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>


@stop
@section('footer')
<script>
    function simpan(edit = false) {
        let form = edit === true ? $('#formEditSubmit')[0] : $('#formSubmit')[0];
        let formdata = new FormData(form);
        $.ajax({
            method: 'POST',
            url: "{{url('simpan/suara/parpol')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formdata,
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loading();
            },
            success: function (data) {
                matikanLoading();
                if ($.isEmptyObject(data.errors)) {
                    $.each(data.success, function (key) {
                        hapusvalidasi(key, edit);
                    });
                    swal({
                        title: "Pesan!",
                        text: data.message,
                        icon: "success",
                    });
                    form.reset();
                    $('#modal-edit-suara').modal('hide');
                    $('#table-suara').DataTable().ajax.reload();
                } else {
                    $.each(data.errors, function (key, value) {
                        hapusvalidasi(key, edit);
                        let pesan = $(`#` + key);
                        let text = $('.' + key);
                        pesan.addClass('is-invalid');
                        text.text(value);
                    });
                    swal({
                        title: "Pesan!",
                        text: "dimohon untuk mengisi data dengan benar!",
                        icon: "error",
                    });
                }
            }
        })
    }

    $(document).ready(function () {

         $("#kota").change(function() {
          var kota = $("#kota").val();
          $.ajax({
              url: "{{url('api/data/kecamatan')}}",
              data: {
                  kota:kota
              },
              type: 'GET',
              cache: false,
              dataType: 'json',
              success: function(json) {
                  $("#kecamatan_id").html('');
                  if (json.code == 200) {
                      for (i = 0; i < Object.keys(json.data).length; i++) {
                          $('#kecamatan_id').append($('<option>').text(json.data[i].nama_kecamatan).attr('value', json.data[i].id));
                      }
                  } else {
                      $('#kecamatan_id').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                  }
              }
          });
      });

        $('#btn-tambah').click(simpan);

        $('#simpanEdit').click(function(){
            simpan(true);
        });

        $('#table-suara').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{route('table.suara.parpol')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id'
                },
                {
                    data: 'no_urut',
                    name: 'parpol.no_urut'
                },
                {
                    data: 'kecamatan',
                    name: 'kecamatan.nama_kecamatan'
                },
                {
                    data: 'namaparpol',
                    name: 'namaparpol'
                },
                {
                    data: 'periode_pemilu',
                    name: 'periode_pemilu'
                },
                {
                    data: 'foto_parpol',
                    name: 'foto_parpol'
                },
                {
                    data: 'jumlah_suara',
                    name: 'jml_suara'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
            "order": [
                [0, "desc"]
            ],
        });

        $('body').on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            const url = "{{url('suara/parpol/ambil')}}/" + id;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    for (const i in data) {
                        if (i !== null && i !== 'created_at' && i !== 'updated_at'&& i !== 'parpol' && i !== 'satker_id') {
                            document.getElementById(`edit_${i}`).value = data[i];
                        }
                    }
                    $('#modal-edit-suara').modal({
                        backdrop: 'static'
                    });
                    $('#title-edit').text(`Edit Suara parpol ${data.parpol.nama_parpol}`)
                })
                .catch(err => {
                    console.error(err);
                })
        });

        $('body').on('click', '.btn-delete', function () {
            let hapus = "{{url('suara/parpol/hapus')}}" + "/" + $(this).data('id');
            swal({
                    title: "Yakin?",
                    text: "anda yakin ingin menghapus data ini??",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = hapus;
                    } else {
                        swal("Anda membatalkan hapus data");
                    }
                });
        });

        $('.btn-tambah-parpol').click(function () {
            $('#modal-parpol').modal({
                backdrop: 'static'
            });
        });


        $('body').on('click', '.btn-pilih-parpol', function () {
            const namaparpol = $(this).data('nama');
            const idparpol = $(this).data('id');
            $('#parpol').val(idparpol);
            $('#parpol_id').val(namaparpol);
            $('#modal-parpol').modal('hide');
        });

        $('#table-parpol').DataTable();

    });

</script>
@endsection
