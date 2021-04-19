<?php

namespace App\Http\Controllers\Radikalisme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\petaradikalisme;
use App\radikalisme;
use App\kota;
use App\kecamatan;
use Auth,DataTables,Validator;
class RadikalismeController extends Controller
{
    public function tambah()
    {
        $radikalisme = radikalisme::all();
        $kota = Auth::user()->kota_id == 0 ? kota::orderBy('nama_kota','asc')->get() :kota::where('id',Auth::user()->kota_id)->get();
        return view('admin.radikalisme.peta.tambah',compact(['kota','radikalisme'])); 
    }
    public function table() 
    {
        $model=petaradikalisme::query()->where('satker_id',Auth::user()->satker_id);
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.radikalisme.peta.action',[
                'model'=>$model,
            ]);
        })
        ->addColumn('bulantahun',function($model){
            return 'Bulan :  '. $model->bulan . '<br> Tahun : '.$model->tahun;
        })
        ->addColumn('jenisradikalisme',function($model){
            return $model->radikalisme->deskripsi_radikalisme;
        })
        ->addColumn('wilayah',function($model){
            return 'Kota  : '. $model->kecamatan->kota->nama_kota. '<br> Kecamatan : '. $model->kecamatan->nama_kecamatan;
        })
        ->addIndexColumn()
        ->rawColumns(['action','bulantahun','jenisradikalisme','wilayah'])
        ->make(true);
    }
    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'judul'=>'required','keterangan'=>'required','kecamatan'=>'required','kota'=>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $radikalisme = new petaradikalisme();
        $radikalisme->judul = $request->judul;
        $radikalisme->keterangan = $request->keterangan;
        $radikalisme->bulan = $request->bulan;
        $radikalisme->tahun = $request->tahun;
        $radikalisme->radikalisme_id = $request->radikalisme;
        $radikalisme->satker_id = Auth::user()->satker_id;
        $radikalisme->kecamatan_id = $request->kecamatan;
        $radikalisme->save(); 
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil mengubah data radikalisme'], 200);
    }

    public function simpanEdit(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'judul'=>'required','keterangan'=>'required','kecamatan'=>'required','kota'=>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $radikalisme = petaradikalisme::findOrFail($request->id);
        $radikalisme->judul = $request->judul;
        $radikalisme->keterangan = $request->keterangan;
        $radikalisme->bulan = $request->bulan;
        $radikalisme->tahun = $request->tahun;
        $radikalisme->radikalisme_id = $request->radikalisme;
        $radikalisme->satker_id = Auth::user()->satker_id;
        $radikalisme->kecamatan_id = $request->kecamatan;
        $radikalisme->save(); 
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil menambah data radikalisme'], 200);
    }

    public function hapus($id)
    {
        $radikalisme = petaradikalisme::findOrFail($id);
        $radikalisme->delete();
        return response()->json(['message'=>'anda telah berhasil menghapus data peta radikalisme'], 200);
    }

    public function edit($id)
    {
        $pradikalisme = petaradikalisme::findOrFail($id);
        $radikalisme = radikalisme::all();
        $kota = kota::all();
        $pkecamatan = kecamatan::findOrFail($pradikalisme->kecamatan_id);
        $kotakecamatan = $pkecamatan->kota_id;
        $kecamatan = kecamatan::where('kota_id','=',$pkecamatan->kota_id)->get();
        return view('admin.radikalisme.peta.edit',compact(['pradikalisme','radikalisme','kota','kotakecamatan','kecamatan']));
    }

    public function muatPeta($satker,$tahun)
    {
         if ($satker == "semua") {
            $radikalisme = petaradikalisme::select('petaradikalisme.*','radikalisme.deskripsi_radikalisme','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('radikalisme','petaradikalisme.radikalisme_id','radikalisme.id')->leftjoin('kecamatan','petaradikalisme.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('tahun',$tahun)->get();
        } elseif ($tahun == "kosong") {
            $radikalisme = petaradikalisme::select('petaradikalisme.*','radikalisme.deskripsi_radikalisme','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('radikalisme','petaradikalisme.radikalisme_id','radikalisme.id')->leftjoin('kecamatan','petaradikalisme.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->get();
        } else {
            $radikalisme = petaradikalisme::select('petaradikalisme.*','radikalisme.deskripsi_radikalisme','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('radikalisme','petaradikalisme.radikalisme_id','radikalisme.id')->leftjoin('kecamatan','petaradikalisme.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->where('tahun',$tahun)->get();
        }
        return response()->json($radikalisme);
    }
    public function muatGrafik($satker)
    {
       $tahun = date('Y');
       $data = [];
        for ($i=$tahun; $i >= 2012 ; $i--) { 
            if ($satker == "semua") {
               $radikalisme = petaradikalisme::select('petaradikalisme.*','radikalisme.deskripsi_radikalisme','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('radikalisme','petaradikalisme.radikalisme_id','radikalisme.id')->leftjoin('kecamatan','petaradikalisme.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('tahun',$i)->count();
            } else {
                  $radikalisme = petaradikalisme::select('petaradikalisme.*','radikalisme.deskripsi_radikalisme','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('radikalisme','petaradikalisme.radikalisme_id','radikalisme.id')->leftjoin('kecamatan','petaradikalisme.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->where('tahun',$i)->count();
            }
            array_push($data,$radikalisme);
        }
        return response()->json($data); 
    }
}
