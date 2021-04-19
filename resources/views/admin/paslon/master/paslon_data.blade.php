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
                    <h3 class="card-title">Form Paslon Calon Bupati</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" id="formSubmit" method="post">
                    {{csrf_field()}}
                    <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="periode_pemilu">Periode Pemilu *</label>                         
                                <input type="text" class="form-control" name="periode_pemilu" id="periode_pemilu"
                                    placeholder="Masukkan Periode Pemilu (2014-2019)">
                                <span class="help-block periode_pemilu"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>No Urut Paslon *</label>
                            <input type="text" name="no_urut" id="no_urut" class="form-control" placeholder="Masukkan No Urut Paslon">
                            <span class="help-block no_urut"></span>
                        </div>
                     
                        <div class="form-group col-md-6">
                            <label>Nama Calon *</label>
                            <input type="text" name="nama_paslon" id="nama_paslon" class="form-control" placeholder="Masukkan Nama Calon">
                            <span class="help-block nama_paslon"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nama Wakil Calon *</label>
                            <input type="text" name="wakil_paslon" id="wakil_paslon" class="form-control" placeholder="Masukkan Nama Wakil Calon">
                            <span class="help-block wakil_paslon"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Partai</label>
                            <input type="text" name="partai" class="form-control" id="partai" placeholder="Masukkan Partai Pengusung">
                            <span class="help-block partai"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Foto Paslon</label>
                            <input type="file" name="foto_paslon" class="form-control" id="foto_paslon" >
                            <span class="help-block foto_paslon"></span>
                        </div>
                    </div>
                 </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style="margin-top: -31px">
                        <button type="button" id="btn-tambah" class="btn btn-danger col-md-12"><i class="fa fa-save"></i>
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
                    <h3 class="card-title">Data Paslon Calon Bupati</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%" id="table-paslon" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Urut</th>
                                    <th>Nama Calon/Wakil Calon</th>
                                    <th>Periode</th>
                                    <th>Partai</th>
                                    <th>Foto Paslon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>No Urut</th>
                                    <th>Nama Calon/Wakil Calon</th>
                                    <th>Periode</th>
                                    <th>Partai</th>
                                    <th>Foto Paslon</th>
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
<div class="modal fade" id="modal-edit-paslon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <div class="modal-body row">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="form-group col-md-6">
                            <label for="periode_pemilu">Periode Pemilu *</label>                         
                                <input type="text" class="form-control" name="periode_pemilu" id="edit_periode_pemilu"
                                    placeholder="Masukkan Periode Pemilu (2014-2019)">
                                <span class="help-block edit_periode_pemilu"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>No Urut Paslon *</label>
                            <input type="text" name="no_urut" id="edit_no_urut" class="form-control" placeholder="Masukkan No Urut Paslon">
                            <span class="help-block edit_no_urut"></span>
                        </div>
                     
                        <div class="form-group col-md-6">
                            <label>Nama Calon *</label>
                            <input type="text" name="nama_paslon" id="edit_nama_paslon" class="form-control" placeholder="Masukkan Nama Calon">
                            <span class="help-block edit_nama_paslon"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nama Wakil Calon *</label>
                            <input type="text" name="wakil_paslon" id="edit_wakil_paslon" class="form-control" placeholder="Masukkan Nama Wakil Calon">
                            <span class="help-block edit_wakil_paslon"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Partai</label>
                            <input type="text" name="partai" class="form-control" id="edit_partai" placeholder="Masukkan Partai Pengusung">
                            <span class="help-block edit_partai"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Foto Paslon</label>
                            <input type="file" name="foto_paslon" class="form-control" id="foto_paslon" >
                            <span class="help-block foto_paslon"></span>
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

function simpanEdit() {
    let form = $('#formEditSubmit')[0];
    let formdata = new FormData(form);
    	$.ajax({
  		method :'POST',
  		url : "{{url('simpan/master/paslon')}}",
  		headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
  		data: formdata,
  		dataType:'JSON',
  		cache: false,
	    contentType: false,
	    processData: false,
	    beforeSend:function() {
	    	loading();
	    },
	    success:function(data){
	    	matikanLoading();
	    	if ($.isEmptyObject(data.errors)) 
        	{
        	   $.each(data.success,function(key){
                 hapusvalidasi(key,true);
               });
                swal({
                    title: "Pesan!",
                    text: "Anda Telah Berhasil Mengubah Pasangan Calon",
                    icon: "success",
                });
                form.reset();
                $('#modal-edit-paslon').modal('hide');
                $('#table-paslon').DataTable().ajax.reload();
        	}
	        else{
	           $.each(data.errors, function (key, value) {
	            hapusvalidasi(key,true);
	            let pesan = $(`#edit_`+key);
	            let text= $('.edit_'+key);
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

function simpan() {
  	let form=$('#formSubmit')[0];
  	let formdata=new FormData(form);
  	$.ajax({
  		method :'POST',
  		url : "{{url('simpan/master/paslon')}}",
  		headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
  		data: formdata,
  		dataType:'JSON',
  		cache: false,
	    contentType: false,
	    processData: false,
	    beforeSend:function() {
	    	loading();
	    },
	    success:function(data){
	    	matikanLoading();
	    	if ($.isEmptyObject(data.errors)) 
        	{
        	   $.each(data.success,function(key){
                 hapusvalidasi(key);
               });
                swal({
                    title: "Pesan!",
                    text: "Anda Telah Berhasil Menambahkan Pasangan Calon",
                    icon: "success",
                });
                form.reset();
                $('#table-paslon').DataTable().ajax.reload();
        	}
	        else{
	           $.each(data.errors, function (key, value) {
	            hapusvalidasi(key);
	            let pesan = $(`#`+key);
	            let text= $('.'+key);
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

    $(document).ready(function(){

        $('#btn-tambah').click(simpan);

        $('#table-paslon').DataTable({
            responsive:true,
            processing:true,
            serverSide:true,
            ajax:"{{route('table.master.paslon')}}",
            columns:[
                {data:'DT_RowIndex',name:'id'},
                {data:'no_urut',name:'no_urut'},
                {data:'namapaslonwakil',name:'namapaslonwakil'},
                {data:'periode_pemilu',name:'periode_pemilu'},
                {data:'partai',name:'partai'},
                {data:'foto_paslon',name:'foto_paslon'},
                {data:'action',name:'action'}
            ],
             "order": [[0, "desc"]],
        });

        $('body').on('click','.btn-edit',function(){
            const id = $(this).data('id');
            const url = "{{url('master/paslon/ambil')}}/"+id;
            fetch(url)
            .then(res => res.json())
            .then(data => {
                for (const i in data) {
                      if (i !== null && i !== 'created_at' && i !== 'updated_at' && i !== 'foto_paslon' && i !== 'satker_id' ) {
                        document.getElementById(`edit_${i}`).value = data[i];
                    }
                }
                $('#modal-edit-paslon').modal({backdrop:'static'});
            })
            .catch(err => {
                console.error(err);
            })
        });
        
        $('#simpanEdit').click(simpanEdit);

        $('body').on('click', '.btn-delete', function () {
            let hapus = "{{url('master/paslon/hapus')}}"+"/"+$(this).data('id');
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

    });

</script>
@endsection