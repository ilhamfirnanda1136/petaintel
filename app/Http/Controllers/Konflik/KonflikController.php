<?php

namespace App\Http\Controllers\Konflik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\kota;
use App\konflik;
use App\kecamatan;
use Validator,DataTables,Auth;
use App\petakonflik;
class KonflikController extends Controller
{
    public function tambah()
    {
        $konflik = konflik::all();
        $kota = Auth::user()->kota_id == 0 ? kota::orderBy('nama_kota','asc')->get() : kota::where('id',Auth::user()->kota_id)->get();
        return view('admin.konflik.peta.tambah',compact(['kota','konflik']));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'judul'=>'required','keterangan'=>'required','kecamatan'=>'required','kota'=>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $konflik = new petakonflik();
        $konflik->judul = $request->judul;
        $konflik->keterangan = $request->keterangan;
        $konflik->bulan = $request->bulan;
        $konflik->tahun = $request->tahun;
        $konflik->konflik_id = $request->konflik;
        $konflik->satker_id = Auth::user()->satker_id;
        $konflik->kecamatan_id = $request->kecamatan;
        $konflik->save(); 
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil menambah data konflik'], 200);
    }
    public function simpanEdit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'judul'=>'required','keterangan'=>'required','kecamatan'=>'required','kota'=>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $konflik = petakonflik::findOrFail($request->id);
        $konflik->judul = $request->judul;
        $konflik->keterangan = $request->keterangan;
        $konflik->satker_id = Auth::user()->satker_id;
        $konflik->bulan = $request->bulan;
        $konflik->tahun = $request->tahun;
        $konflik->konflik_id = $request->konflik;
        $konflik->kecamatan_id = $request->kecamatan;
        $konflik->save(); 
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil mengubah data konflik'], 200);
    }

    public function table()
    {
        $model=petakonflik::query()->where('satker_id',Auth::user()->satker_id);
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.konflik.peta.action',[
                'model'=>$model,
            ]);
        })
        ->addColumn('bulantahun',function($model){
            return 'Bulan :  '. $model->bulan . '<br> Tahun : '.$model->tahun;
        })
        ->addColumn('jeniskonflik',function($model){
            return $model->konflik->deskripsi_konflik;
        })
        ->addColumn('wilayah',function($model){
            return 'Kota  : '. $model->kecamatan->kota->nama_kota. '<br> Kecamatan : '. $model->kecamatan->nama_kecamatan;
        })
        ->addIndexColumn()
        ->rawColumns(['action','bulantahun','jeniskonflik','wilayah'])
        ->make(true);
    }

    public function hapus($id)
    {
        $konflik = petakonflik::findOrFail($id);
        $konflik->delete();
        return response()->json(['message'=>'anda telah berhasil menghapus data peta konflik'], 200);
    }

    public function edit($id)
    {
        $pkonflik = petakonflik::findOrFail($id);
        $konflik = konflik::all();
        $kota = kota::all();
        $pkecamatan = kecamatan::findOrFail($pkonflik->kecamatan_id);
        $kotakecamatan = $pkecamatan->kota_id;
        $kecamatan = kecamatan::where('kota_id','=',$pkecamatan->kota_id)->get();
        return view('admin.konflik.peta.edit',compact(['pkonflik','konflik','kota','kotakecamatan','kecamatan']));
    }

    public function muatPeta($satker,$tahun)
    {
        if ($satker == "semua") {
            $konflik = petakonflik::select('petakonflik.*','konflik.deskripsi_konflik','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('konflik','petakonflik.konflik_id','konflik.id')->leftjoin('kecamatan','petakonflik.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('tahun',$tahun)->get();
        } elseif($tahun == "kosong") {
             $konflik = petakonflik::select('petakonflik.*','konflik.deskripsi_konflik','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('konflik','petakonflik.konflik_id','konflik.id')->leftjoin('kecamatan','petakonflik.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->get();
        }
         else {
            $konflik = petakonflik::select('petakonflik.*','konflik.deskripsi_konflik','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('konflik','petakonflik.konflik_id','konflik.id')->leftjoin('kecamatan','petakonflik.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->where('tahun',$tahun)->get();
        }
        return response()->json($konflik);
    }
    public function muatGrafik($satker)
    {
        $tahun = date('Y');
        $data = [];
        for ($i=$tahun; $i >= 2012 ; $i--) { 
            if ($satker == "semua") {
                 $konflik = petakonflik::select('petakonflik.*','konflik.deskripsi_konflik','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('konflik','petakonflik.konflik_id','konflik.id')->leftjoin('kecamatan','petakonflik.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('tahun',$i)->count();
            } else {
                 $konflik = petakonflik::select('petakonflik.*','konflik.deskripsi_konflik','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('konflik','petakonflik.konflik_id','konflik.id')->leftjoin('kecamatan','petakonflik.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->where('tahun',$i)->count();
            }
            array_push($data,$konflik);
        }
        return response()->json($data);
    }
}
