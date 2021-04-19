@extends('layouts.template')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Profile User</h3>
                </div>
                <form action="{{url('change/profile')}}" method="post">
                 @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="{{Auth::user()->username}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" value="{{Auth::user()->email}}">
                        </div>
                        <div class="form-group">
                            <label for="satker">Satker</label>
                            <select name="satker" id="satker" class="form-control">
                                @foreach($satker as $s)
                                <option value="{{$s->id}}"{{$s->id==Auth::user()->satker->nama_satker ? 'selected' : ''}}>{{$s->nama_satker}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary col-md-12 mb-3" id="simpan"><i class="fa fa-plane"></i>Ubah Profile</button>
                        <a href="{{url('change/password')}}" class="btn btn-danger col-md-12" ><i class="fa fa-key"></i> Ganti Password</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection