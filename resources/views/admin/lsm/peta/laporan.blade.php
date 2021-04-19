@extends('layouts.template')
@section('content')
<div class="container">
    <div class="row profile-page">
        <div class="col-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Laporan LSM/ORMAS</h3>
                    <form action="{{url('/laporan/lsm/print')}}" method="get" target="_blank">
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control">
                                <?php
                                    $thn_skr = date('Y');
                                    for ($x = $thn_skr; $x >= 2012; $x--) {
                                    ?>
                                <option value="<?=$x?>"><?php echo $x ?>
                                </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="lapor" class="btn btn-primary btn-md"><i class="fa fa-download"></i> Download</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
