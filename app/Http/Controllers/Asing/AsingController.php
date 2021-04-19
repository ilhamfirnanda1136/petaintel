<?php

namespace App\Http\Controllers\Asing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\kota;
use App\pengawasanasing;
use App\kecamatan;
use Validator,Auth,DataTables,Helpers;
class AsingController extends Controller
{
    public function tambah()
    {
       $kota = Auth::user()->kota_id == 0 ? kota::orderBy('nama_kota','asc')->get() : kota::findOrFail(Auth::user()->kota_id);
       return view('admin.asing.tambah',compact(['kota']));  
    }
    public function simpan(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'nama'=>'required','alamat'=>'required','kebangsaan'=>'required','tgl'=>'required','lama'=>'required','keterangan'=>'required','kecamatan'=>'required','kota'=>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $asing = new pengawasanasing();
        $asing->nama = $request->nama;
        $asing->kebangsaan = $request->kebangsaan;
        $asing->kelamin = $request->kelamin;
        $asing->maksud_tujuan = $request->maksud;
        $asing->alamat = $request->alamat;
        $asing->tgl_mulai = $request->tgl;
        $asing->lama = $request->lama;
        $asing->keterangan = $request->keterangan;
        $asing->bulan = $request->bulan;
        $asing->tahun = $request->tahun;
        $asing->satker_id = Auth::user()->satker_id;
        $asing->kecamatan_id = $request->kecamatan;
        $asing->save(); 
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil menambah data pengawasan orang asing'], 200);  
    }
    public function simpanEdit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama'=>'required','alamat'=>'required','kebangsaan'=>'required','tgl'=>'required','lama'=>'required','keterangan'=>'required','kecamatan'=>'required','kota'=>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $asing = pengawasanasing::findOrFail($request->id);
        $asing->nama = $request->nama;
        $asing->kebangsaan = $request->kebangsaan;
        $asing->kelamin = $request->kelamin;
        $asing->maksud_tujuan = $request->maksud;
        $asing->alamat = $request->alamat;
        $asing->tgl_mulai = $request->tgl;
        $asing->lama = $request->lama;
        $asing->keterangan = $request->keterangan;
        $asing->bulan = $request->bulan;
        $asing->tahun = $request->tahun;
        $asing->satker_id = Auth::user()->satker_id;
        $asing->kecamatan_id = $request->kecamatan;
        $asing->save(); 
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil mengubah data pengawasan orang asing'], 200);  
    }
    public function table()
    {
        $model=pengawasanasing::query()->where('satker_id',Auth::user()->satker_id);
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.asing.action',[
                'model'=>$model,
            ]);
        })
        ->addColumn('tgl',function($model){
            return Helpers::formatTanggal($model->tgl_mulai);
        })
        ->addColumn('bulantahun',function($model){
            return 'Bulan :  '. $model->bulan . '<br> Tahun : '.$model->tahun;
        })
        ->addColumn('wilayah',function($model){
            return 'Kota  : '. $model->kecamatan->kota->nama_kota. '<br> Kecamatan : '. $model->kecamatan->nama_kecamatan;
        })
        ->addIndexColumn()
        ->rawColumns(['action','bulantahun','wilayah','tgl'])
        ->make(true);
    }
    public function hapus($id)
    {
        $asing = pengawasanasing::findOrFail($id);
        $asing->delete();
        return response()->json(['success'=>'anda telah berhasil menghapus data pengawasan asing'], 200);
    }
    public function edit($id)
    {
        $pasing = pengawasanasing::findOrFail($id);
        $kota = kota::all();
        $pkecamatan = kecamatan::findOrFail($pasing->kecamatan_id);
        $kotakecamatan = $pkecamatan->kota_id;
        $kecamatan = kecamatan::where('kota_id','=',$pkecamatan->kota_id)->get();
        return view('admin.asing.edit',compact(['pasing','kota','kotakecamatan','kecamatan']));
    }
    public function muatPeta($satker,$tahun)
    {
        if ($satker == "semua") {
            $pengawasanasing = pengawasanasing::select('pengawasanasing.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','pengawasanasing.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('tahun',$tahun)->get();
        } elseif ($tahun == "kosong") {
            $pengawasanasing = pengawasanasing::select('pengawasanasing.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','pengawasanasing.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->get();
        } else {
            $pengawasanasing = pengawasanasing::select('pengawasanasing.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','pengawasanasing.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->where('tahun',$tahun)->get();
        }
        return response()->json($pengawasanasing);
    }
    public function muatGrafik($satker)
    {
        $tahun = date('Y');
        $data = [];
        for ($i=$tahun; $i >= 2012 ; $i--) { 
            if ($satker == "semua") {
              $pengawasanasing = pengawasanasing::select('pengawasanasing.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','pengawasanasing.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('tahun',$i)->count();
            } else {
                $pengawasanasing = pengawasanasing::select('pengawasanasing.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','pengawasanasing.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->where('tahun',$i)->count();
            }
            array_push($data,$pengawasanasing);
        }
        return response()->json($data);
    }
}
