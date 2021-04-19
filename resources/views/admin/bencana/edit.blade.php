@extends('layouts.template')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">FORM EDIT PETA KEPERCAYAAN ALIRAN MASYARAKAT</h3>
                    <div class="float-right">
                        <a href="{{url('/bencana')}}" class="btn btn-success"><i class="fa fa-backward"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="formSubmit" onclick="event.preventDefault()">
                        @csrf
                        <input type="hidden" name="id" value="{{$pbencana->id}}">
                        <div class="row">
                           <div class="form-group col-md-6" >
                                <label for="bencana">bencana</label>
                                <input type="text" class="form-control" name="bencana" id="bencana" maxlength="100" placeholder="Masukkan nama bencana" value="{{$pbencana->bencana}}" >
                                <small class="text-danger bencana"></small>
                            </div> 
                            <div class="form-group col-md-6">
                                <label for="tahun">tahun</label>
                                <select class="form-control " name="tahun" id="tahun">
                                    <?php
                                 $thn_skr = date('Y');
                                 for ($x = $thn_skr; $x >= 2012; $x--) {
                                 ?>
                                     <option value="<?=$x?>" {{$x == $pbencana->tahun ? 'selected' : ''}}><?php echo $x ?></option>
                                 <?php
                                 }
                                 ?>
                                    </select>
                            </div>
                              <?php
                                $bulan = ['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
                                foreach ($bulan as $b) {
                                   ?>
                                    <div class="form-group col-md-3" >
                                        <label for="{{$b}}">{{$b}}</label>
                                        <input type="number" class="form-control" name="{{$b}}" id="{{$b}}" maxlength="100" placeholder="Masukkan total bencana bulan {{$b}}" value="{{$pbencana[$b]}}"  >
                                        <small class="text-danger {{$b}}"></small>
                                    </div>  
                                   <?php
                                }
                            ?>        
                            <div class="form-group col-md-6">
                                <label for="kota">kota</label>
                                <select name="kota_id" id="kota_id" class="form-control">
                                    <option value="">Pilih Kota</option>
                                    @foreach($kota as $k)
                                        <option value="{{$k->id}}" {{$k->id == $kotakecamatan ? 'selected' : ''}}>{{$k->nama_kota}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger kota_id"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kecamatan">kecamatan</label>
                                <select name="kecamatan_id" id="kecamatan_id" class="form-control">
                                   @foreach($kecamatan as $k)
                                        <option value="{{$k->id}}" {{$k->id == $pbencana->kecamatan_id ? 'selected' : ''}}>{{$k->nama_kecamatan}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger kecamatan_id"></small>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-md col-md-12" id="btn-tambah"><i
                                class="fa fa-edit"></i> Edit Peta bencana</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('footer')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function(){
        $("#kota_id").change(function() {
          var kota = $("#kota_id").val();
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
    });

    document.addEventListener('DOMContentLoaded', async function() {
        $('#btn-tambah').click( async function() { 
            loading();
            const form = document.querySelector('#formSubmit');
            const formData = new FormData(form);
            const url = process_env_url+"/simpan/edit/bencana";
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
                        window.location.href="{{url('bencana')}}"
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
    })
</script>
@endsection