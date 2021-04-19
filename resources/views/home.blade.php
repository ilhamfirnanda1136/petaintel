@extends('layouts.template')

@section('content')
<style>
    .red-price-card .card{
        background:#ba0c00 !important;
    }
    .yellow-price-card .card{
        background:#bfac00 !important;
    }
    .green-price-card .card{
        background:#008031 !important;
    }
     .purple-price-card .card{
        background:#710080 !important;
    }
     .pink-price-card .card{
        background:#fc007a !important;
    }
</style>
<div class="container">
    <div class="row">
       <div class="col-md-6 grid-margin stretch-card average-price-card">
        <div class="card text-white">
            <div class="card-body">
            <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0">{{$konflik->count()}}</h2>
                <div class="icon-holder">
                     <i class="fa fa-bell"></i>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0">Kerawanan Konflik Sosial</h5>
            </div>
            </div>
        </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card red-price-card">
            <div class="card text-white">
                <div class="card-body">
                <div class="d-flex justify-content-between pb-2 align-items-center">
                    <h2 class="font-weight-semibold mb-0">{{$radikalisme->count()}}</h2>
                    <div class="icon-holder">
                        <i class="fa fa-shield"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 class="font-weight-semibold mb-0">Kerawanan Radikalisme</h5>
                </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card yellow-price-card">
        <div class="card text-white">
            <div class="card-body">
            <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0">{{$pakem->count()}}</h2>
                <div class="icon-holder">
                     <i class="fa fa-eye"></i>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0">Peta Aliran Kepercayaan Masyarakat</h5>
            </div>
            </div>
        </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card green-price-card">
            <div class="card text-white">
                <div class="card-body">
                <div class="d-flex justify-content-between pb-2 align-items-center">
                    <h2 class="font-weight-semibold mb-0">{{$asing->count()}}</h2>
                    <div class="icon-holder">
                        <i class="fa fa-child"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 class="font-weight-semibold mb-0">Peta Pengawasan Orang Asing</h5>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row ">
         <div class="col-md-6 grid-margin stretch-card purple-price-card">
            <div class="card text-white">
                <div class="card-body">
                <div class="d-flex justify-content-between pb-2 align-items-center">
                    <h2 class="font-weight-semibold mb-0">{{$lsm->count()}}</h2>
                    <div class="icon-holder">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 class="font-weight-semibold mb-0">Peta LSM/ORMAS</h5>
                </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 grid-margin stretch-card pink-price-card">
            <div class="card text-white">
                <div class="card-body">
                <div class="d-flex justify-content-between pb-2 align-items-center">
                    <h2 class="font-weight-semibold mb-0">{{$vaksinasi->count()}}</h2>
                    <div class="icon-holder">
                        <i class="fa fa-disease"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 class="font-weight-semibold mb-0">Peta Vaksinasi</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection