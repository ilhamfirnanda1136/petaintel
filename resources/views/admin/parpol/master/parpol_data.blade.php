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
                    <h3 class="card-title">Form Suara Paslon Calon Bupati</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" id="formSubmit" method="post">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="form-group ">
                            <label>No Urut Parpol *</label>
                            <input type="text" name="no_urut" id="no_urut" class="form-control" placeholder="Masukkan No Urut Parpol">
                            <span class="help-block no_urut"></span>
                        </div>
                         <div class="form-group ">
                            <label>Nama Parpol *</label>
                            <input type="text" name="nama_parpol" id="nama_parpol" class="form-control" placeholder="Masukkan Nama Parpol">
                            <span class="help-block nama_parpol"></span>
                        </div>
                      <div class="form-group ">
                            <label>Logo Parpol</label>
                            <input type="file" name="logo_parpol" class="form-control" id="logo_parpol" accept=".jpg,jpeg,.png">
                            <span class="help-block logo_parpol"></span>
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
                    <h3 class="card-title">Data Master Parpol</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%" id="table-parpol" class="table table-bordered table-striped">
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
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-edit-parpol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="formEditSubmit" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Paslon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                      <div class="form-group ">
                            <label>No Urut Parpol *</label>
                            <input type="text" name="no_urut" id="edit_no_urut" class="form-control" placeholder="Masukkan No Urut Parpol">
                            <span class="help-block edit_no_urut"></span>
                        </div>
                         <div class="form-group ">
                            <label>Nama Parpol *</label>
                            <input type="text" name="nama_parpol" id="edit_nama_parpol" class="form-control" placeholder="Masukkan Nama Parpol">
                            <span class="help-block edit_nama_parpol"></span>
                        </div>
                      <div class="form-group ">
                            <label>Logo Parpol</label>
                            <input type="file" name="logo_parpol" class="form-control" id="edit_logo_parpol" accept=".jpg,jpeg,.png">
                            <span class="help-block edit_logo_parpol"></span>
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
            url: "{{url('simpan/master/parpol')}}",
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
                    $('#modal-edit-parpol').modal('hide');
                    $('#table-parpol').DataTable().ajax.reload();
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

        $('#btn-tambah').click(simpan);

        $('#simpanEdit').click(function(){
            simpan(true);
        });

        $('#table-parpol').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{route('table.master.parpol')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id'
                },
                {
                    data: 'no_urut',
                    name: 'no_urut'
                },
                {
                    data: 'nama_parpol',
                    name: 'nama_parpol'
                },
                {
                    data: 'foto_partai',
                    name: 'foto_partai'
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
            const url = "{{url('master/parpol/ambil')}}/" + id;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    for (const i in data) {
                        if (i !== null && i !== 'created_at' && i !== 'updated_at'&& i !== 'logo_parpol') {
                            document.getElementById(`edit_${i}`).value = data[i];
                        }
                    }
                    $('#modal-edit-parpol').modal({
                        backdrop: 'static'
                    });
                })
                .catch(err => {
                    console.error(err);
                })
        });

        $('body').on('click', '.btn-delete', function () {
            let hapus = "{{url('master/parpol/hapus')}}" + "/" + $(this).data('id');
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

        $('.btn-tambah-paslon').click(function () {
            $('#modal-paslon').modal({
                backdrop: 'static'
            });
        });


        $('body').on('click', '.btn-pilih-paslon', function () {
            const namaPaslon = $(this).data('nama');
            const idPaslon = $(this).data('id');
            $('#paslon').val(idPaslon);
            $('#paslon_id').val(namaPaslon);
            $('#modal-paslon').modal('hide');
        });

        $('#table-paslon').DataTable();

    });

</script>
@endsection