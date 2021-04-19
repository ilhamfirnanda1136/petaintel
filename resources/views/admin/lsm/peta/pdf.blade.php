<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan LSM Organisasi Kemasyarakatan</title>
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
           <h4 style="text-transform:uppercase">Uraian <br> Organisasi Kemasyarakatan <br> {{Auth::user()->satker->nama_satker}} <br> Bulan: Januari - desember Tahun {{$tahun}}</h4>
    </center>
    <?php
        $data = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
        $rowawiArray = array('','I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
    ?>
    <table border="1"  width="100%" style="table-layout:fixed;width:100%;font-size:10px">
        <tr>
            <th width="5%">No #</th>
            <th>Nama Organisasi Kemasyarakatan</th>
            <th>Kedudukan/Status</th>
            <th>Berdiri Sejak/Akta Pendirian</th>
            <th>Domisili/Alamat</th>
            <th>Pengurus </th>
            <th>Ruang Lingkup</th>
            <th>keterangan</th>
        </tr>
        <tr>
            <?php 
                for ($i=1; $i <=8 ; $i++) { ?>
                    <th align="center">{{$i}}</th>
            <?php } ?>
        </tr>
        @php
            $noromawi = 0;  
        @endphp
        @foreach ($data as $key => $value)
            <tr>
                <td align="center" style="font-weight:bold">{{$rowawiArray[++$noromawi]}}</td>
                <td colspan="7" style="text-transform:uppercase;font-weight:bold">{{$value}}</td>
            </tr>
            <?php
                $satker = Auth::user()->satker_id;
                $lsm = \App\petalsm::where('tahun',$tahun)->where('bulan',$key)->where('satker_id',$satker)->orderBy('id','desc');
                $no = 1;
            ?>  
            @if($lsm->count() > 0)
                @foreach ($lsm->get() as $lsm)
                    <tr align="center">
                        <td>{{$no++}}</td>
                        <td>{{$lsm->nama_lsm}}</td>
                        <td>{{$lsm->kedudukan}}</td>
                        <td>{{\Carbon\Carbon::parse($lsm->tgl_berdiri)->format('d-m-Y')}}</td>
                        <td>{{$lsm->alamat}}</td>
                        <td>{{$lsm->pengurus}}</td>
                        <td>{{$lsm->ruanglingkup}}</td>
                        <td>{{$lsm->keterangan}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <?php 
                        for ($i=1; $i <=8 ; $i++) { ?>
                            <th align="center"><span style="visibility: hidden">{{$i}}</span></th>
                    <?php } ?>
                </tr>
            @endif
        @endforeach
    </table>
</body>
</html>      