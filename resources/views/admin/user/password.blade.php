@extends('layouts.template')
@section('content')
<div class="container-fluid">
  @if(Session::has('errorMSG'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error &nbsp</strong>{{session('errorMSG')}}.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
	<div class="row">
		<div class="col-md-12">
			<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ubah Password</h3><small>(Jika Anda Mengubah Profile Anda Akan otomatis logout)</small>
              </div>
              <form role="form" action="{{url('simpan/ubahPassword')}}" method="post">
                <div class="card-body">
                  <div class="form-group">
                  	@csrf
                    <label for="oldpassword">Password Lama</label>
                    <input type="password" class="form-control @if($errors->has('oldpassword')) is-invalid @endif" name="oldpassword" id="oldpassword" placeholder="Masukkan password lama" value="{{old('oldpassword')}}" autofocus>
                    @if($errors->has('oldpassword'))
                    <span class="text-danger">{{$errors->first('oldpassword')}}</span>
                    @endif
                  </div>
                   <div class="form-group">
                    <label for="password">Password baru</label>
                    <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif " name="password" id="password" value="{{old('password')}}" placeholder="Masukkan Password Baru">
                     @if($errors->has('password'))
                    <span class="text-danger">{{$errors->first('password')}}</span>
                    @endif
                  </div>
                  <div class="form-group">
                      <label for="password-confirm" >{{ __('Confirm Password') }}</label>
                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password">
                  </div>
                </div>
                <div class="card-footer">
                	<div class="col-md-12">
                		  <button  style="width: 100%" type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Ubah Password</button>
                	</div>

                </div>
              </form>
            </div>
		</div>
	</div>
</div>
@endsection