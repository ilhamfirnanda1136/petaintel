<?php

namespace App\Http\Controllers\Lsm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\lsm;
use App\kota;
use App\kecamatan;
use DataTables,Validator,Auth,PDF;
use App\petalsm;
class LsmController extends Controller
{
    public function tambah()
    {
        $lsm = lsm::all();
        $kota = Auth::user()->kota_id == 0 ? kota::orderBy('nama_kota','asc')->get() :kota::where('id',Auth::user()->kota_id)->get();
        return view('admin.lsm.peta.tambah',compact(['kota','lsm'])); 
    }
    public function table()
    {
        $model=petalsm::query()->where('satker_id',Auth::user()->satker_id);
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.lsm.peta.action',[
                'model'=>$model,
            ]);
        })
        ->addColumn('bulantahun',function($model){
            return 'Bulan :  '. $model->bulan . '<br> Tahun : '.$model->tahun;
        })
        ->addColumn('jenislsm',function($model){
            return $model->lsm->deskripsi_lsm;
        })
        ->addColumn('wilayah',function($model){
            return 'Kota  : '. $model->kecamatan->kota->nama_kota. '<br> Kecamatan : '. $model->kecamatan->nama_kecamatan;
        })
        ->addIndexColumn()
        ->rawColumns(['action','bulantahun','jenislsm','wilayah'])
        ->make(true);
    }
    public function simpan(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'alamat'=>'required','keterangan'=>'required','kecamatan'=>'required','kota'=>'required','nama'=>'required','kedudukan'=>'required','tgl_berdiri'=>'required', 'pengurus'=>'required','ruanglingkup' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $lsm = new petalsm();
        $lsm->nama_lsm = $request->nama;
        $lsm->alamat = $request->alamat;
        $lsm->kedudukan = $request->kedudukan;
        $lsm->tgl_berdiri = $request->tgl_berdiri;
        $lsm->pengurus = $request->pengurus;
        $lsm->ruanglingkup = $request->ruanglingkup;
        $lsm->keterangan = $request->keterangan;
        $lsm->bulan = $request->bulan;
        $lsm->tahun = $request->tahun;
        $lsm->lsm_id = $request->lsm;
        $lsm->satker_id = Auth::user()->satker_id;
        $lsm->kecamatan_id = $request->kecamatan;
        $lsm->save(); 
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil menambah data lsm Ormas'], 200);
    }
    public function simpanEdit(Request $request)
    {
          $validator = Validator::make($request->all(),[
            'alamat'=>'required','keterangan'=>'required','kecamatan'=>'required','kota'=>'required','nama'=>'required','kedudukan'=>'required','tgl_berdiri'=>'required', 'pengurus'=>'required','ruanglingkup' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $lsm = petalsm::findOrFail($request->id);
        $lsm->nama_lsm = $request->nama;
        $lsm->alamat = $request->alamat;
        $lsm->kedudukan = $request->kedudukan;
        $lsm->tgl_berdiri = $request->tgl_berdiri;
        $lsm->pengurus = $request->pengurus;
        $lsm->ruanglingkup = $request->ruanglingkup;

        $lsm->keterangan = $request->keterangan;
        $lsm->bulan = $request->bulan;
        $lsm->tahun = $request->tahun;
        $lsm->lsm_id = $request->lsm;
        $lsm->satker_id = Auth::user()->satker_id;
        $lsm->kecamatan_id = $request->kecamatan;
        $lsm->save(); 
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil mengubah data lsm Ormas'], 200);
    }
    public function hapus($id)
    {
        $lsm = petalsm::findOrFail($id);
        $lsm->delete();
        return response()->json(['message'=>'anda telah berhasil menghapus data peta LSM / ORMAS'], 200);
    }
    public function edit($id)
    {
        $plsm = petalsm::findOrFail($id);
        $lsm = lsm::all();
        $kota = kota::all();
        $pkecamatan = kecamatan::findOrFail($plsm->kecamatan_id);
        $kotakecamatan = $pkecamatan->kota_id;
        $kecamatan = kecamatan::where('kota_id','=',$pkecamatan->kota_id)->get();
        return view('admin.lsm.peta.edit',compact(['plsm','lsm','kota','kotakecamatan','kecamatan']));
    }
    public function muatPeta($satker,$tahun)
    {
        if ($satker == "semua") {
            $lsm = petalsm::select('petalsm.*','lsm.deskripsi_lsm','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('lsm','petalsm.lsm_id','lsm.id')->leftjoin('kecamatan','petalsm.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('tahun',$tahun)->get();
        } elseif ($tahun == "kosong") {
           $lsm = petalsm::select('petalsm.*','lsm.deskripsi_lsm','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('lsm','petalsm.lsm_id','lsm.id')->leftjoin('kecamatan','petalsm.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->get();
        } else {
            $lsm = petalsm::select('petalsm.*','lsm.deskripsi_lsm','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('lsm','petalsm.lsm_id','lsm.id')->leftjoin('kecamatan','petalsm.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->where('tahun',$tahun)->get();
        }
        return response()->json($lsm); 
    }
    public function muatGrafik($satker)
    {
        $tahun = date('Y');
        $data = [];
        for ($i=$tahun; $i >= 2012 ; $i--) { 
            if ($satker == "semua") {
                 $lsm = petalsm::select('petalsm.*','lsm.deskripsi_lsm','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('lsm','petalsm.lsm_id','lsm.id')->leftjoin('kecamatan','petalsm.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('tahun',$i)->count();
            } else {
                 $lsm = petalsm::select('petalsm.*','lsm.deskripsi_lsm','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('lsm','petalsm.lsm_id','lsm.id')->leftjoin('kecamatan','petalsm.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->where('tahun',$i)->count();
            }
            array_push($data,$lsm);
        }
        return response()->json($data);
    }

    public function laporan()
    {
        return view('admin.lsm.peta.laporan');
    }

    public function pdf(Request $request)
    {
        $tahun = $request->tahun;
        $pdf = PDF::loadView('admin.lsm.peta.pdf',compact(['tahun']))->setPaper('a4', 'landscape');
        return $pdf->stream('lsm.pdf');    
    }
}
