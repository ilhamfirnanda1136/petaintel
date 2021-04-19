@extends('layouts.template')
@section('content')
<link rel="stylesheet" href="{{asset('')}}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">FORM TAMBAH PETA PENGAWASAN ORANG ASING</h3>
                    <div class="float-right">
                        <a href="{{url('/asing')}}" class="btn btn-success"><i class="fa fa-backward"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="formSubmit" onclick="event.preventDefault()">
                        @csrf
                        <input type="hidden" name="id" value="{{$pasing->id}}">
                        <div class="row">
                             <div class="form-group col-md-6" >
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" id="nama" maxlength="100" placeholder="Masukkan nama" value="{{$pasing->nama}}"  >
                                <small class="text-danger nama"></small>
                            </div> 
                             <div class="form-group col-md-6">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat">{{$pasing->alamat}}</textarea>
                                <small class="text-danger alamat"></small>
                            </div> 
                            <div class="form-group col-md-6" >
                                <label for="kebangsaan">Kebangsaan</label>
                                <input type="text" class="form-control" name="kebangsaan" id="kebangsaan" maxlength="100" placeholder="Masukkan Kebangsaan" value="{{$pasing->kebangsaan}}"  >
                                <small class="text-danger kebangsaan"></small>
                            </div>   
                            <div class="form-group col-md-6">
                                <label for="kelamin">Jenis Kelamin</label>
                                <select name="kelamin" id="kelamin" class="form-control">
                                    <option value="Laki-Laki" {{$pasing->kelamin == 'Laki-Laki' ? 'selected' : ''}}>Laki-Laki</option>
                                    <option value="Perempuan" {{$pasing->kelamin == 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
                                </select>
                                <small class="text-danger kelamin"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="maksud">Maksud Tujuan</label>
                                <select name="maksud" id="maksud" class="form-control">
                                    <?php
                                        $data = ['Bekerja','Berwisata','Kunjungan Bisnis/Keluarga/Social','Pendidikan/Studi/Kuliah','Jurnalis','Penelitian','Lainnya'];
                                    ?>
                                    @foreach($data as $data)
                                        <option value="{{$data}}" {{$pasing->maksud_tujuan == $data ? 'selected' : ''}}>{{$data}}</option>
                                    @endforeach
                                  
                                </select>
                            </div>
                             <div class="form-group col-md-6" >
                                <label for="tgl">Tanggal Tinggal</label>
                                <input type="text" class="form-control" name="tgl" id="tgl" maxlength="100" readonly placeholder="Masukkan Tanggal Tinggal" value="{{$pasing->tgl_mulai}}"  >
                                <small class="text-danger tgl"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lama">Lama Tinggal</label>
                                <input type="text" name="lama" id="lama" class="form-control" placeholder="...Hari" value="{{$pasing->lama}}">
                                <small class="text-danger lama"></small>
                            </div> 
                            <div class="form-group col-md-6">
                                <label for="keterangan">keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan">{{$pasing->keterangan}}</textarea>
                                <small class="text-danger keterangan"></small>
                            </div>   
                            <div class="form-group col-md-6">
                                <label for="bulan">Pilih Bulan </label>
                                <?php $data = array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
                                ?>
                                <select class="form-control" name="bulan" id="bulan">
                                <?php  foreach ($data as $key => $value) { 
                                ?>
                                    <option value="<?= $key ?>" {{$key == $pasing->bulan ? 'selected' : ''}}><?=$value ?></option>
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
                                     <option value="<?=$x?>" {{$x == $pasing->tahun ? 'selected' : ''}}><?php echo $x ?></option>
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
                                        <option value="{{$k->id}}" {{$k->id == $pasing->kecamatan_id ? 'selected' : ''}}>{{$k->nama_kecamatan}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger kecamatan"></small>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-md col-md-12" id="btn-tambah"><i
                                class="fa fa-edit"></i> Edit Peta asing</button>
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
            const url = process_env_url+"/simpan/edit/asing";
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
                        window.location.href="{{url('asing')}}"
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
        $('#tgl').datepicker({
            enableOnReadonly: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    })
</script>
@endsection