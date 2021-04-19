<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- endinject -->
    <link rel="stylesheet" href="{{asset('')}}/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <title>Peta Intelijen</title>
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon">
    <style>
        .jumbotron {
            background-image:url("{{asset('img/ilustrasi-kejaksaan.jpg')}}");
            background-size: cover;
            border-radius: 0%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-success bg-success text-white">
        <img src="{{asset('img/favicon.png')}}" alt="logo Kejaksaan" class="mr-3">
        <a class="navbar-brand text-white" href="#">PETA INTELIJEN KEJAKSAAN TINGGI GORONTALO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mr-auto" id="navbarNavAltMarkup">
        </div>
    </nav>

    <div class="jumbotron">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 card">
                    <div class="card-body">
                        <h2 >Pilih Menu Peta</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="satker">Pilih Satker</label>
                                <select name="satker" id="satker" class="form-control">
                                    <option value="semua">Semua Satker</option>
                                    @foreach($satker as $satker)
                                    <option value="{{$satker->id}}">{{$satker->nama_satker}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="pelayanan">Kategori</label>
                                <select name="pelayanan" id="pelayanan" class="form-control">
                                    <option value="1">Peta Kerawanan Konflik Sosial</option>
                                    <option value="2">Peta Kerawanan Radikalisme</option>
                                    <option value="3">Peta Aliran Kepercayaan Masyarakat</option>
                                    <option value="4">Peta Pengawasan Orang Asing</option>
                                    <option value="5">Peta LSM/ORMAS</option>
                                    <option value="6">Peta Pemilihan Kepala Daerah</option>
                                    <option value="7">Peta Pemilihan Partai Politik</option>
                                    <option value="8">Peta Vaksinasi</option>
                                    <option value="9">Peta Rawan Bencana</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="tahun">Tahun</label>
                                <select class="form-control " name="tahun" id="tahun">
                                    <?php
                                 $thn_skr = date('Y');
                                 for ($x = $thn_skr; $x >= 2012; $x--) {
                                 ?>
                                    <option value="<?=$x?>" {{$x==date('Y') ? 'selected' : ''}}><?php echo $x ?>
                                    </option>
                                    <?php
                                 }
                                 ?>
                                </select>
                                 <!-- <input type="hidden" name="satker" value="1"> -->
                            </div>
                            <button class="btn btn-success col-md-12" id="cari"><i class="fa fa-search"></i>
                                Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card" id="peta">
                    <div class="card-body">
                        <div class="card-title">Peta Intellijen </div>
                        <img src="{{asset('img/loading.gif')}}" alt="loading" class="loading" style="display:none">
                        <iframe src="" frameborder="0" id="map" width="100%" height="500px" ></iframe>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4" id="pemilihan-total" style="display:none;">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title grafik">Grafik Peta Intellijen </div>
                        <img src="{{asset('img/loading.gif')}}" alt="loading" class="loading" style="display:none">
                        <iframe src="" frameborder="0" id="pemilihan" width="100%" height="600px" ></iframe>   
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title grafik">Grafik Peta Intellijen </div>
                        <img src="{{asset('img/loading.gif')}}" alt="loading" class="loading" style="display:none">
                        <iframe src="" frameborder="0" id="grafik" width="100%" height="600px" ></iframe>   
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        function petaScroll() {
            $('html, body').animate({
                scrollTop: $('#peta').offset().top
            }, 500);
        }
        document.addEventListener('DOMContentLoaded', function () {
            const url = "{{url('')}}";
            const cari = document.getElementById('cari');
            const tahunSekarang = new Date();
            $('#map').attr('src',`${url}/peta/konflik/1/${tahunSekarang.getFullYear()}`);
            $('#grafik').attr('src',`${url}/grafik/konflik/1`);
            $('.card-title').text(`PETA INTELIJEN KONFLIK SOSIAL GORONTALO di SEMUA SATKER TAHUN ${tahunSekarang.getFullYear()}`);
            $('.grafik').text('GRAFIK PETA INTELIJEN KONFLIK SOSIAL GORONTALO di SEMUA SATKER');
            /* Cari Peta */
            cari.addEventListener('click', function () {
                var markers = [];
                var pelayanan = $('#pelayanan').val();
                var satker = $('#satker').val();
                var tahun = $('#tahun').val();
                var satkerText = document.getElementById('satker');
                var satkerTextContent = satkerText.options[satkerText.selectedIndex].text;
                petaScroll();
                $('.loading').show();
                $('#map').hide();
                $('#pemilihan-total').hide();
                $('#grafik').hide();
                setTimeout(() => {
                    switch(pelayanan) {
                        case '1' : 
                            $('#map').attr('src',`${url}/peta/konflik/${satker}/${tahun}`);
                            $('#grafik').attr('src',`${url}/grafik/konflik/${satker}`);
                            $('.loading').hide();
                            $('#map').show();
                            $('#grafik').show();
                            $('.card-title').text(`PETA INTELIJEN KONFLIK SOSIAL GORONTALO di ${satkerTextContent.toUpperCase()} TAHUN ${tahun}`);
                            $('.grafik').text(`GRAFIK PETA INTELIJEN KONFLIK SOSIAL GORONTALO di ${satkerTextContent.toUpperCase()}`);
                        break;
                        case '2' :
                            $('#map').attr('src',`${url}/peta/radikalisme/${satker}/${tahun}`);
                            $('#grafik').attr('src',`${url}/grafik/radikalisme/${satker}`);
                            $('.loading').hide();
                            $('#map').show();
                            $('#grafik').show();
                            $('.card-title').text(`PETA INTELIJEN KERAWANAN RADIKALISME SOSIAL GORONTALO di ${satkerTextContent.toUpperCase()} TAHUN ${tahun}`);
                            $('.grafik').text(`GRAFIK  PETA INTELIJEN KERAWANAN RADIKALISME SOSIAL GORONTALO di ${satkerTextContent.toUpperCase()} `);
                        break;
                        case '3' : 
                            $('#map').attr('src',`${url}/peta/pakem/${satker}/${tahun}`);
                            $('#grafik').attr('src',`${url}/grafik/pakem/${satker}`);
                            $('.loading').hide();
                            $('#map').show();
                            $('#grafik').show();
                            $('.card-title').text(`PETA INTELIJEN PENGAWASAN KEPERCAYAAN MASYARAKAT SOSIAL GORONTALO di ${satkerTextContent.toUpperCase()} TAHUN ${tahun} `);
                            $('.grafik').text(`GRAFIK PETA INTELIJEN PENGAWASAN KEPERCAYAAN MASYARAKAT SOSIAL GORONTALO di ${satkerTextContent.toUpperCase()}`);
                        break;
                        case '4' : 
                            $('#map').attr('src',`${url}/peta/orangasing/${satker}/${tahun}`);
                            $('#grafik').attr('src',`${url}/grafik/orangasing/${satker}`);
                            $('.loading').hide();
                            $('#map').show();
                            $('#grafik').show();
                            $('.card-title').text(`PETA INTELIJEN PENGAWASAN ORANG ASING SOSIAL GORONTALO di ${satkerTextContent.toUpperCase()} TAHUN ${tahun}`);
                            $('.grafik').text(`GRAFIK PETA INTELIJEN PENGAWASAN ORANG ASING SOSIAL GORONTALO di ${satkerTextContent.toUpperCase()}`);
                        break;
                        case '5' :
                            $('#map').attr('src',`${url}/peta/lsm/${satker}/${tahun}`);
                            $('#grafik').attr('src',`${url}/grafik/lsm/${satker}`);
                            $('.loading').hide();
                            $('#map').show();
                            $('#grafik').show();
                            $('.card-title').text(`PETA INTELIJEN LSM/ORMAS SOSIAL GORONTALO di ${satkerTextContent.toUpperCase()} TAHUN ${tahun}`);
                            $('.grafik').text(`GRAFIK PETA INTELIJEN LSM/ORMAS SOSIAL GORONTALO di ${satkerTextContent.toUpperCase()} `);
                        break;
                        case '6' :
                            $('#map').attr('src',`${url}/peta/paslon/${satker}/${tahun}`);
                            $('#grafik').attr('src',`${url}/grafik/paslon/${satker}/${tahun}`);
                            $('#pemilihan').attr('src',`${url}/grafik/paslon/all/${satker}/${tahun}`)
                            $('.loading').hide();
                            $('#pemilihan-total').show();
                            $('#map').show();
                            $('#grafik').show();
                            $('.card-title').text(`PETA INTELIJEN PEMILIHAN KEPALA DAERAH GORONTALO di ${satkerTextContent.toUpperCase()} TAHUN ${tahun}`);
                            $('.grafik').text(`GRAFIK PETA INTELIJEN PEMILIHAN KEPALA DAERAH GORONTALO di ${satkerTextContent.toUpperCase()} TAHUN ${tahun}`);
                        break;
                        case '7' :
                            $('#map').attr('src',`${url}/peta/parpol/${satker}/${tahun}`);
                            $('#grafik').attr('src',`${url}/grafik/parpol/${satker}/${tahun}`);
                            $('#pemilihan').attr('src',`${url}/grafik/parpol/all/${satker}/${tahun}`)
                            $('.loading').hide();
                            $('#pemilihan-total').show();
                            $('#map').show();
                            $('#grafik').show();
                            $('.card-title').text(`PETA INTELIJEN PEMILIHAN PARTAI POLITIK GORONTALO di ${satkerTextContent.toUpperCase()} TAHUN ${tahun}`);
                            $('.grafik').text(`GRAFIK PETA INTELIJEN PEMILIHAN PARTAI POLITIK GORONTALO di ${satkerTextContent.toUpperCase()} TAHUN ${tahun}`);
                        break;
                        case '8' : 
                            $('#map').attr('src',`${url}/peta/vaksinasi/${satker}/${tahun}`);
                            $('#grafik').attr('src',`${url}/grafik/vaksinasi/${satker}/${tahun}`);
                            $('.loading').hide();
                            $('#map').show();
                            $('#grafik').show();
                            $('.card-title').text(`PETA INTELIJEN VAKSINASI GORONTALO di ${satkerTextContent.toUpperCase()} TAHUN ${tahun} `);
                            $('.grafik').text(`GRAFIK PETA INTELIJEN VAKSINASI GORONTALO di ${satkerTextContent.toUpperCase()} TAHUN ${tahun}`);
                        break;
                        case '9' : 
                            $('#map').attr('src',`${url}/peta/bencana/${satker}/${tahun}`);
                            $('#grafik').attr('src',`${url}/grafik/bencana/${satker}/${tahun}`);
                            $('.loading').hide();
                            $('#map').show();
                            $('#grafik').show();
                            $('.card-title').text(`PETA INTELIJEN RAWAN BENCANA GORONTALO di ${satkerTextContent.toUpperCase()} TAHUN ${tahun} `);
                            $('.grafik').text(`GRAFIK PETA INTELIJEN RAWAN BENCANA GORONTALO di ${satkerTextContent.toUpperCase()} TAHUN ${tahun}`);
                        break;
                        default:
                        alert('anda memilih pilihan salah')
                        break;
                    }
                }, 3000);
            });
        })

    </script>
</body>

</html>
