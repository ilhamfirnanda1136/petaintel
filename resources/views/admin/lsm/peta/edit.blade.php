@extends('layouts.template')
@section('content')
<link rel="stylesheet" href="{{asset('')}}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">FORM EDIT PETA LSM ORMAS SOSIAL</h3>
                    <div class="float-right">
                        <a href="{{url('/lsm')}}" class="btn btn-success"><i class="fa fa-backward"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="formSubmit" onclick="event.preventDefault()">
                        @csrf
                        <input type="hidden" name="id" value="{{$plsm->id}}">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="lsm">Jenis lsm</label>
                                <select name="lsm" id="lsm" class="form-control" >
                                    @foreach($lsm as $k)
                                        <option value="{{$k->id}}" {{$k->id == $plsm->lsm_id ? 'selected' : ''}}>{{$k->deskripsi_lsm}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger lsm"></small>
                            </div>
                          <div class="form-group col-md-6" >
                                <label for="nama">Nama LSM/ORMAS</label>
                                <input type="text" class="form-control" name="nama" id="nama" maxlength="100" placeholder="Masukkan nama" value="{{$plsm->nama_lsm}}"  >
                                <small class="text-danger nama"></small>
                            </div> 
                             <div class="form-group col-md-6">
                                <label for="Alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat">{{$plsm->alamat}}</textarea>
                                <small class="text-danger Alamat"></small>
                            </div> 
                            <div class="form-group col-md-6" >
                                <label for="skt">No SKT</label>
                                <input type="text" class="form-control" name="skt" id="skt" maxlength="100" placeholder="Masukkan skt" value="{{$plsm->no_skt}}"  >
                                <small class="text-danger skt"></small>
                            </div>   
                             <div class="form-group col-md-6" >
                                <label for="tgl_skt">TGL SKT</label>
                                <input type="text" class="form-control" name="tgl_skt" id="tgl_skt" maxlength="100" readonly placeholder="Masukkan Tanggal SKT" value="{{$plsm->tgl_skt}}" >
                                <small class="text-danger tgl_skt"></small>
                            </div>  
                            <div class="form-group col-md-6">
                                <label for="keterangan">keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan">{{$plsm->keterangan}}</textarea>
                                <small class="text-danger keterangan"></small>
                            </div>   
                            <div class="form-group col-md-6">
                                <label for="bulan">Pilih Bulan </label>
                                <?php $data = array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
                                ?>
                                <select class="form-control" name="bulan" id="bulan">
                                <?php  foreach ($data as $key => $value) { 
                                ?>
                                    <option value="<?= $key ?>" {{$key == $plsm->bulan ? 'selected' : ''}}><?=$value ?></option>
                                <?php
                                } ?>
                                </select>
                            </div>  
                            <div class="form-group col-md-6">
                                <label for="tahun">tahun</label>
                                <select class="form-control " name="tahun" id="tahun">
                                    <?php
                                 $thn_skr = date('Y');
                                 for ($x = $thn_skr; $x >= 2012; $x--) {
                                 ?>
                                     <option value="<?=$x?>" {{$x == $plsm->tahun ? 'selected' : ''}}><?php echo $x ?></option>
                                 <?php
                                 }
                                 ?>
                                    </select>
                            </div>    
                            <div class="form-group col-md-6">
                                <label for="kota">kota</label>
                                <select name="kota" id="kota" class="form-control">
                                    <option value="">Pilih Kota</option>
                                    @foreach($kota as $k)
                                        <option value="{{$k->id}}" {{$k->id == $kotakecamatan ? 'selected' : ''}}>{{$k->nama_kota}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger kota"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kecamatan">kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-control">
                                   @foreach($kecamatan as $k)
                                        <option value="{{$k->id}}" {{$k->id == $plsm->kecamatan_id ? 'selected' : ''}}>{{$k->nama_kecamatan}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger kecamatan"></small>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-md col-md-12" id="btn-tambah"><i
                                class="fa fa-edit"></i> Edit Peta lsm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('footer')
<script src="{{asset('')}}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function(){
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
                  $("#kecamatan").html('');
                  if (json.code == 200) {
                      for (i = 0; i < Object.keys(json.data).length; i++) {
                          $('#kecamatan').append($('<option>').text(json.data[i].nama_kecamatan).attr('value', json.data[i].id));
                      }
                  } else {
                      $('#kecamatan').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                  }
              }
          });
      });
    });

    document.addEventListener('DOMContentLoaded', async function() {
        $('#btn-tambah').click( async function() { 
            loading();
            const form = document.querySelector('#formSubmit');
            const formData = new FormData(form);
            const url = process_env_url+"/simpan/edit/lsm";
            try {
                const response = await axios({
                    method: "post",
                    data: formData,
                    url: url,
                });
                matikanLoading();
                let icon = '';
                const data = await response.data;
                if(data.error ===  undefined) {
                    const success = Object.entries(data.success);
                    success.map(([key, value]) => {
                        hapusvalidasi(key);
                    })
                    icon = 'success';
                    swal({
                        title: "Pesan!",
                        text: data.message,
                        icon: icon
                    }).then(function(){
                        window.location.href="{{url('lsm')}}"
                    });
                } else {
                    const error = Object.entries(data.error);
                    error.map(([key,value]) => {
                        hapusvalidasi(key);
                        console.log(key);
                        const pesan = document.getElementById(key);
                        const text = document.querySelector(`.${key}`);
                        pesan.parentElement.classList.add('has-danger');
                        text.textContent = value;
                        icon ='error';
                    })
                    swal({
                        title: "Pesan!",
                        text: data.message,
                        icon: icon
                    });
                }
            } catch (error) {
                matikanLoading();
                alert('Maaf ada kesalahan diserver');
                console.log(error);
            }
        })
         $('#tgl_skt').datepicker({
            enableOnReadonly: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    })
</script>
@endsection