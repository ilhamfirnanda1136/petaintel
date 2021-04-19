@extends('layouts.template')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 grid-margin">
            <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <button class="btn btn-primary" id="tambah-jenis"><i class="fa fa-plus"></i> Tambah Jenis radikalisme</button>
                </div>
            </div>
                <div class="card-body">
                    <h4 class="card-title">Data Jenis radikalisme</h4>
                    <div class="table-responsive">
                        <table id="radikalisme" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No #</th>
                                    <th>Dekripsi radikalisme</th>
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
<!-- Modal -->
<div class="modal fade" id="modal-radikalisme" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group">
          <input type="hidden" name="id" id="id">
          <label for="deskripsi">Deskripsi radikalisme</label>
          <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Masukkan Deskripsi radikalisme">
          <small class="text-danger deskripsi"></small>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="simpan" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
@stop
@section('footer')
<script src="{{asset('js/admin/radikalisme/master/script.js')}}"></script>
@endsection
