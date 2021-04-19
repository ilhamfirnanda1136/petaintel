<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengawasan Kepercayaan Aliran Masyarakat</title>
    <style>
    table {
    border-left: 0.01em solid rgb(56, 54, 54);
    border-right: 0;
    border-top: 0.01em solid rgb(56, 54, 54);
    border-bottom: 0;
    border-collapse: collapse;
}
table td,
table th {
    border-left: 0;
    border-right: 0.01em solid rgb(56, 54, 54);
    border-top: 0;
    border-bottom: 0.01em solid rgb(56, 54, 54);
      word-wrap: break-word;
}
</style>
</head>
<body>
    <center style="margin-top:-10px">
           <h4 style="text-transform:uppercase">Uraian <br> Aliran Kepercayaan masyarakat <br> {{Auth::user()->satker->nama_satker}} <br> Bulan: Januari - desember Tahun {{$tahun}}</h4>
    </center>

    <?php
        $data = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
        $rowawiArray = array('','I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
    ?>

    <table border="1"  width="100%" style="table-layout:fixed;width:100%;font-size:10px">
        <tr>
            <th width="5%">No #</th>
            <th>Nama Aliran Kepercayaan</th>
            <th>Nama Pimpinan</th>
            <th>Alamat</th>
            <th>Jumlah Pengikut</th>
            <th>Bentuk Kegiatan </th>
            <th>Status Organisasi</th>
            <th>Nomor dan Tanggal Pendaftaran Kesbangpol</th>
            <th>Nomor dan Pendaftaran badan Hukum</th>
            <th>keterangan</th>
        </tr>
        <tr>
            <?php 
                for ($i=1; $i <=10 ; $i++) { ?>
                    <th align="center">{{$i}}</th>
            <?php } ?>
        </tr>
        @php
            $noromawi = 0;
        @endphp
        @foreach ($data as $key => $value)
            <tr>
                <td align="center" style="font-weight:bold">{{$rowawiArray[++$noromawi]}}</td>
                <td colspan="9" style="text-transform:uppercase;font-weight:bold">{{$value}}</td>
            </tr>
            <?php
                $satker = Auth::user()->satker_id;
                $pakem = \App\pakem::where('tahun',$tahun)->where('bulan',$key)->where('satker_id',$satker)->orderBy('id','desc');
                $no = 1;
            ?>  
            @if($pakem->count() > 0)
                @foreach ($pakem->get() as $pakem)
                    <tr align="center">
                        <td>{{$no++}}</td>
                        <td>{{$pakem->judul}}</td>
                        <td>{{$pakem->nama_pimpinan}}</td>
                        <td>{{$pakem->alamat}}</td>
                        <td>{{$pakem->jumlah_pengikut}}</td>
                        <td>{{$pakem->bentuk}}</td>
                        <td>{{$pakem->status_organisasi}}</td>
                        <td>{{$pakem->nomor_kesbangpol}}</td>
                        <td>{{$pakem->nomor_badanhukum}}</td>
                        <td>{{$pakem->keterangan}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <?php 
                        for ($i=1; $i <=10 ; $i++) { ?>
                            <th align="center"><span style="visibility: hidden">{{$i}}</span></th>
                    <?php } ?>
                </tr>
            @endif
        @endforeach
    </table>
</body>
</html>