<?php

namespace App\Http\Controllers\Bencana;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\{kota,bencana,kecamatan};

use DataTables,Validator,Auth,DB;

class BencanaController extends Controller
{
    public function index()
    {
        return view('admin.bencana.bencana_view');
    }

    public function tambah()
    {
        $kota = Auth::user()->kota_id == 0 ? kota::orderBy('nama_kota','asc')->get() : kota::where('id',Auth::user()->kota_id)->get();
        return view('admin.bencana.tambah',compact(['kota']));
    }

    public function simpan(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'bencana'=>'required','tahun'=>'required','kecamatan_id'=>'required','kota_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $request->request->add(['satker_id' => Auth::user()->satker_id]);
        $bencana = bencana::create($request->all());
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil menambah data bencana'], 200);  
    }
    public function simpanEdit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'bencana'=>'required','tahun'=>'required','kecamatan_id'=>'required','kota_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $request->request->add(['satker_id' => Auth::user()->satker_id]);
        $bencana = bencana::updateOrCreate(['id'=>$request->id],$request->all());
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil mengubah data bencana'], 200);  
    }

    public function table()
    {
        $model=bencana::query()->where('satker_id',Auth::user()->satker_id);
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.bencana.action',[
                'model'=>$model,
            ]);
        })
        ->addColumn('total',function($model){
            return "Januari : {$model->januari}<br> Februari: {$model->februari}<br> Maret: {$model->maret}<br> April: {$model->april}<br> Mei: {$model->mei}<br> Juni: {$model->juni}<br> Juli:{$model->juli} <br> Agustus: {$model->agustus}<br> September: {$model->september}<br> Oktober: {$model->oktober}<br> November: {$model->november}<br> Desember: {$model->desember}  ";
        })
        ->addColumn('daerah',function($model){
            return 'Kota  : '. $model->kecamatan->kota->nama_kota. '<br> Kecamatan : '. $model->kecamatan->nama_kecamatan;
        })
        ->addIndexColumn()
        ->rawColumns(['action','total','daerah'])
        ->make(true);
    }

    public function edit($id)
    {
        $pbencana = bencana::findOrFail($id);
        $kota = kota::all();
        $pkecamatan = kecamatan::findOrFail($pbencana->kecamatan_id);
        $kotakecamatan = $pkecamatan->kota_id;
        $kecamatan = kecamatan::where('kota_id','=',$pkecamatan->kota_id)->get();
        return view('admin.bencana.edit',compact(['pbencana','kota','kotakecamatan','kecamatan']));
    }
    
    public function hapus($id)
    {
        $bencana = bencana::findOrFail($id);
        $bencana->delete();
        return response()->json(['message'=>'anda telah berhasil menghapus data peta bencana'], 200);
    }

    public function muatPeta($satker,$tahun)
    {
        if ($satker == "semua") {
            $bencana = bencana::select('bencana.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','bencana.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('tahun',$tahun)->get();
        } elseif ($tahun == "kosong") {
            $bencana = bencana::select('bencana.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','bencana.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->get();
        } else {
            $bencana = bencana::select('bencana.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','bencana.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->where('tahun',$tahun)->get();
        }
        return response()->json($bencana);
    }

    public function muatGrafik($satker,$tahun)
    {
        $bencanas = bencana::select([
            DB::raw("SUM(januari) as total_januari"),
            DB::raw("SUM(februari) as total_februari"),
            DB::raw("SUM(maret) as total_maret"),
            DB::raw("SUM(april) as total_april"),
            DB::raw("SUM(mei) as total_mei"),
            DB::raw("SUM(juni) as total_juni"),
            DB::raw("SUM(juli) as total_juli"),
            DB::raw("SUM(agustus) as total_agustus"),
            DB::raw("SUM(september) as total_september"),
            DB::raw("SUM(oktober) as total_oktober"),
            DB::raw("SUM(november) as total_november"),
            DB::raw("SUM(desember) as total_desember"),
        ]);
         if($satker != "semua") {
            $bencanas->where('satker_id',$satker);
        } 
        $bencana = $bencanas->where('tahun',$tahun)->get();
        return response()->json($bencana);  
    }

}
