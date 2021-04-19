@extends('layouts.template')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah User</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="formSubmit">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama User</label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                placeholder="Masukkan Nama User">
                            <small class="text-danger nama"></small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control"
                                placeholder="Masukkan Email User">
                            <small class="text-danger email"></small>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="Masukkan Username User">
                            <small class="text-danger username"></small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukkan Password User">
                            <small class="text-danger password"></small>
                        </div>
                        <div class="form-group">
                            <label for="satker">Satker</label>
                            <select name="satker" id="satker" class="form-control">
                                @foreach($satker as $s)
                                <option value="{{$s->id}}">{{$s->nama_satker}}</option>
                                @endforeach
                            </select>
                            <small class="text-danger satker"></small>
                        </div>
                         <div class="form-group">
                            <label for="kota">kota</label>
                            <select name="kota_id" id="kota_id" class="form-control">
                                @foreach($kota as $s)
                                <option value="{{$s->id}}">{{$s->nama_kota}}</option>
                                @endforeach
                            </select>
                            <small class="text-danger kota_id"></small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md col-md-12" id="btn-tambah"><i
                                class="fa fa-plus"></i> Tambah User</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data User</h4>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Table User</h4>
                    <div class="table-responsive">
                        <table id="table-user" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No #</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Level</th>
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
<div class="modal fade" id="modal-edit-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="formEditSubmit" method="post">
            @csrf
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
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama User</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" placeholder="Masukkan Nama User">
                        <small class="text-danger edit_nama"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="edit_email" class="form-control"
                            placeholder="Masukkan Email User">
                        <small class="text-danger edit_email"></small>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="edit_username" class="form-control"
                            placeholder="Masukkan Username User">
                        <small class="text-danger edit_username"></small>
                    </div>
                    <div class="form-group">
                        <label for="satker">Satker</label>
                        <select name="satker" id="edit_satker" class="form-control">
                            @foreach($satker as $s)
                            <option value="{{$s->id}}">{{$s->nama_satker}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger edit_satker"></small>
                    </div>
                     <div class="form-group">
                            <label for="kota">kota</label>
                            <select name="kota_id" id="edit_kota_id" class="form-control">
                                @foreach($kota as $s)
                                <option value="{{$s->id}}">{{$s->nama_kota}}</option>
                                @endforeach
                            </select>
                            <small class="text-danger edit_kota_id"></small>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="simpanEdit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
@section('footer')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{asset('js/admin/user/script.js')}}"></script>
@endsection
