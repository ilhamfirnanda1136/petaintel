@extends('layouts.template')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">FORM TAMBAH VAKSINASI</h3>
                    <div class="float-right">
                        <a href="{{url('/vaksinasi')}}" class="btn btn-success"><i class="fa fa-backward"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="formSubmit" onclick="event.preventDefault()">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6" >
                                <label for="vaksinasi">vaksinasi</label>
                                <input type="text" class="form-control" name="vaksinasi" id="vaksinasi" maxlength="100" placeholder="Masukkan nama vaksinasi"  >
                                <small class="text-danger vaksinasi"></small>
                            </div>  
                            <div class="form-group col-md-6">
                                <label for="tahun">tahun</label>
                                <select class="form-control " name="tahun" id="tahun">
                                    <?php
                                    $thn_skr = date('Y');
                                    for ($x = $thn_skr; $x >= 2017; $x--) {
                                    ?>
                                        <option value="<?=$x?>" {{$x==date('Y') ? 'selected' : ''}}><?php echo $x ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kota">kota</label>
                                <select name="kota_id" id="kota_id" class="form-control">
                                    <option value="">Pilih Kota</option>
                                    @foreach($kota as $k)
                                        <option value="{{$k->id}}" >{{$k->nama_kota}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger kota_id"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kecamatan">kecamatan</label>
                                <select name="kecamatan_id" id="kecamatan_id" class="form-control">
                                   <option value="">--Pilih Kota Terlebih Dahulu --</option>
                                </select>
                                <small class="text-danger kecamatan_id"></small>
                            </div>
                            <?php
                                $bulan = ['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
                                foreach ($bulan as $b) {
                                   ?>
                                    <div class="form-group col-md-2" >
                                        <label for="{{$b}}">{{strtoupper($b)}}</label>
                                        <input type="number" class="form-control" name="{{$b}}" id="{{$b}}" maxlength="100" placeholder="Masukkan total vaksinasi bulan {{$b}}"  >
                                        <small class="text-danger {{$b}}"></small>
                                    </div>  
                                   <?php
                                }
                            ?>    
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-md col-md-12" id="btn-tambah"><i
                                class="fa fa-plus"></i> Tambah Peta Vaksinasi</button>
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
            const url = process_env_url+"/simpan/vaksinasi";
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
                        window.location.href="{{url('vaksinasi')}}"
                    });
                } else {
                    const error = Object.entries(data.error);
                    error.map(([key,value]) => {
                        hapusvalidasi(key);
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