<?php

namespace App\Http\Controllers\Pakem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables,Validator,Auth,PDF;
use App\pakem;
use App\kecamatan;
use App\kota;
class PakemController extends Controller
{
    public function tambah()
    {
        $kota = Auth::user()->kota_id == 0 ? kota::orderBy('nama_kota','asc')->get() : kota::where('id',Auth::user()->kota_id)->get();
        return view('admin.pakem.tambah',compact(['kota']));
    }
    public function simpan(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'judul'=>'required','keterangan'=>'required','kecamatan'=>'required','kota'=>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $pakem = new pakem();
        $pakem->judul = $request->judul;
        $pakem->keterangan = $request->keterangan;
        $pakem->bulan = $request->bulan;
        $pakem->tahun = $request->tahun;
        $pakem->satker_id = Auth::user()->satker_id;
        $pakem->kecamatan_id = $request->kecamatan;
        $pakem->nama_pimpinan = $request->nama_pimpinan;
        $pakem->alamat = $request->alamat;
        $pakem->jumlah_pengikut = $request->jumlah_pengikut;
        $pakem->bentuk = $request->bentuk;
        $pakem->status_organisasi = $request->status_organisasi;
        $pakem->nomor_kesbangpol = $request->nomor_kesbangpol;
        $pakem->nomor_badanhukum = $request->nomor_badanhukum;
        $pakem->save(); 
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil menambah data pakem'], 200);  
    }
    public function simpanEdit(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'judul'=>'required','keterangan'=>'required','kecamatan'=>'required','kota'=>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $pakem = pakem::findOrFail($request->id);
        $pakem->judul = $request->judul;
        $pakem->keterangan = $request->keterangan;
        $pakem->bulan = $request->bulan;
        $pakem->tahun = $request->tahun;
        $pakem->satker_id = Auth::user()->satker_id;
        $pakem->kecamatan_id = $request->kecamatan;
        $pakem->nama_pimpinan = $request->nama_pimpinan;
        $pakem->alamat = $request->alamat;
        $pakem->jumlah_pengikut = $request->jumlah_pengikut;
        $pakem->bentuk = $request->bentuk;
        $pakem->status_organisasi = $request->status_organisasi;
        $pakem->nomor_kesbangpol = $request->nomor_kesbangpol;
        $pakem->nomor_badanhukum = $request->nomor_badanhukum;
        $pakem->save(); 
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil mengubah data pakem'], 200);  
    }
    public function table()
    {
        $model=pakem::query()->where('satker_id',Auth::user()->satker_id);
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.pakem.action',[
                'model'=>$model,
            ]);
        })
        ->addColumn('bulantahun',function($model){
            return 'Bulan :  '. $model->bulan . '<br> Tahun : '.$model->tahun;
        })
        ->addColumn('wilayah',function($model){
            return 'Kota  : '. $model->kecamatan->kota->nama_kota. '<br> Kecamatan : '. $model->kecamatan->nama_kecamatan;
        })
        ->addIndexColumn()
        ->rawColumns(['action','bulantahun','wilayah'])
        ->make(true);
    }
    public function hapus($id)
    {
        $pakem = pakem::findOrFail($id);
        $pakem->delete();
        return response()->json(['message'=>'anda telah berhasil menghapus data peta pakem'], 200);
    }
     public function edit($id)
    {
        $ppakem = pakem::findOrFail($id);
        $kota = kota::all();
        $pkecamatan = kecamatan::findOrFail($ppakem->kecamatan_id);
        $kotakecamatan = $pkecamatan->kota_id;
        $kecamatan = kecamatan::where('kota_id','=',$pkecamatan->kota_id)->get();
        return view('admin.pakem.edit',compact(['ppakem','kota','kotakecamatan','kecamatan']));
    }
    public function muatPeta($satker,$tahun)
    {
        if ($satker == "semua") {
            $pakem = pakem::select('pakem.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','pakem.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('tahun',$tahun)->get();
        } elseif ($tahun == "kosong") {
            $pakem = pakem::select('pakem.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','pakem.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->get();
        } else {
            $pakem = pakem::select('pakem.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','pakem.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->where('tahun',$tahun)->get();
        }
        return response()->json($pakem);
    }
    public function muatGrafik($satker)
    {
       $tahun = date('Y');
       $data = [];
        for ($i=$tahun; $i >= 2012 ; $i--) { 
            if ($satker == "semua") {
              $pakem = pakem::select('pakem.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','pakem.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('tahun',$i)->count();
            } else {
                   $pakem = pakem::select('pakem.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','pakem.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->where('tahun',$i)->count();
            }
            array_push($data,$pakem);
        }
        return response()->json($data);   
    }

    public function laporan()
    {
        return view('admin.pakem.laporan');
    }

    public function pdf(Request $request)
    {
        $tahun = $request->tahun;
        $pdf = PDF::loadView('admin.pakem.pdf_view',compact(['tahun']))->setPaper('a4', 'landscape');
        return $pdf->stream('pakem.pdf');    
    }
}
