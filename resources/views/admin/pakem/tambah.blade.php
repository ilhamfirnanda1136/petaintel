@extends('layouts.template')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">FORM TAMBAH PETA ALIRAN KEPERCAYAAN MASYARAKAT</h3>
                    <div class="float-right">
                        <a href="{{url('/pakem')}}" class="btn btn-success"><i class="fa fa-backward"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="formSubmit" onclick="event.preventDefault()">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6" >
                                <label for="judul">Nama aliran Kepercayaan</label>
                                <input type="text" class="form-control" name="judul" id="judul" maxlength="100" placeholder="Masukkan nama aliran"  >
                                <small class="text-danger judul"></small>
                            </div> 
                            <div class="form-group col-md-6" >
                               <label for="nama_pimpinan">Nama Pimpinan </label>
                               <input type="text" class="form-control" name="nama_pimpinan" id="nama_pimpinan" maxlength="100" placeholder="Masukkan Nama Pimpinan"  >
                               <small class="text-danger nama_pimpinan"></small>
                           </div> 
                             <div class="form-group col-md-6" >
                                <label for="judul">Alamat</label>
                                <textarea type="text" class="form-control" name="alamat" id="alamat" maxlength="100" placeholder="Masukkan Alamat"  ></textarea>
                                <small class="text-danger alamat"></small>
                            </div> 
                             <div class="form-group col-md-6" >
                                <label for="jumlah_pengikut">Jumlah Pengikut</label>
                                <input type="text" class="form-control" name="jumlah_pengikut" id="jumlah_pengikut" maxlength="100" placeholder="Masukkan jumlah pengikut"  >
                                <small class="text-danger jumlah_pengikut"></small>
                            </div> 
                             <div class="form-group col-md-6" >
                                <label for="bentuk">Bentuk Kegiatan</label>
                                <input type="text" class="form-control" name="bentuk" id="bentuk" maxlength="100" placeholder="Masukkan Bentuk Kegiatan"  >
                                <small class="text-danger bentuk"></small>
                            </div>  
                            <div class="form-group col-md-6" >
                               <label for="status_organisasi"> Status Organisasi</label>
                               <select name="status_organisasi" id="status_organisasi" class="form-control">
                                   <option value="Pusat">Pusat</option>
                                   <option value="Cabang">Cabang</option>
                               </select>
                               <small class="text-danger status_organisasi"></small>
                           </div> 
                           <div class="form-group col-md-6" >
                               <label for="nama_pimpinan">Nomor dan Tanggal Pendaftaran Pada Kantor Kesbangpol </label>
                               <input type="text" class="form-control" name="nomor_kesbangpol" id="nomor_kesbangpol" maxlength="100" placeholder="Masukkan Nomor Pendaftaran "  >
                               <small class="text-danger nomor_kesbangpol"></small>
                           </div> 
                           <div class="form-group col-md-6" >
                               <label for="nomor_badanhukum">Nomor dan Pendaftaran badan Hukum </label>
                               <input type="text" class="form-control" name="nomor_badanhukum" id="nomor_badanhukum" maxlength="100" placeholder="Masukkan Nomor Pendaftaran"  >
                               <small class="text-danger nomor_badanhukum"></small>
                           </div> 
                            <div class="form-group col-md-6">
                                <label for="keterangan">keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan"></textarea>
                                <small class="text-danger keterangan"></small>
                            </div>   
                            <div class="form-group col-md-6">
                                <label for="bulan">Pilih Bulan </label>
                                <?php $data = array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
                                ?>
                                <select class="form-control" name="bulan" id="bulan">
                                <?php  foreach ($data as $key => $value) { 
                                ?>
                                    <option value="<?= $key ?>" {{$key==date('m') ? 'selected' : ''}}><?=$value ?></option>
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
                                     <option value="<?=$x?>" {{$x==date('Y') ? 'selected' : ''}}><?php echo $x ?></option>
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
                                        <option value="{{$k->id}}" >{{$k->nama_kota}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger kota"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kecamatan">kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-control">
                                   <option value="">--Pilih Kota Terlebih Dahulu --</option>
                                </select>
                                <small class="text-danger kecamatan"></small>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-md col-md-12" id="btn-tambah"><i
                                class="fa fa-plus"></i> Tambah Peta pakem</button>
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
            const url = process_env_url+"/simpan/pakem";
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
                        window.location.href="{{url('pakem')}}"
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