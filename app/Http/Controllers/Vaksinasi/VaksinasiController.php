<?php

namespace App\Http\Controllers\Vaksinasi;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\{kota,vaksinasi,kecamatan};

use DataTables,Validator,Auth,DB;

class VaksinasiController extends Controller
{
    public function index()
    {
        return view('admin.vaksinasi.vaksinasi_view');
    }

    public function tambah()
    {
        $kota = Auth::user()->kota_id == 0 ? kota::orderBy('nama_kota','asc')->get() : kota::where('id',Auth::user()->kota_id)->get();
        return view('admin.vaksinasi.tambah',compact(['kota']));
    }

    public function simpan(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'vaksinasi'=>'required','tahun'=>'required','kecamatan_id'=>'required','kota_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $request->request->add(['satker_id' => Auth::user()->satker_id]);
        $vaksinasi = vaksinasi::create($request->all());
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil menambah data vaksinasi'], 200);  
    }
    public function simpanEdit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'vaksinasi'=>'required','tahun'=>'required','kecamatan_id'=>'required','kota_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        $request->request->add(['satker_id' => Auth::user()->satker_id]);
        $vaksinasi = vaksinasi::updateOrCreate(['id'=>$request->id],$request->all());
        return response()->json(['success'=> $request->all(),'message'=>'anda telah berhasil mengubah data vaksinasi'], 200);  
    }

    public function table()
    {
        $model=vaksinasi::query()->where('satker_id',Auth::user()->satker_id);
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.vaksinasi.action',[
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
        $pvaksinasi = vaksinasi::findOrFail($id);
        $kota = kota::all();
        $pkecamatan = kecamatan::findOrFail($pvaksinasi->kecamatan_id);
        $kotakecamatan = $pkecamatan->kota_id;
        $kecamatan = kecamatan::where('kota_id','=',$pkecamatan->kota_id)->get();
        return view('admin.vaksinasi.edit',compact(['pvaksinasi','kota','kotakecamatan','kecamatan']));
    }
    
    public function hapus($id)
    {
        $vaksinasi = vaksinasi::findOrFail($id);
        $vaksinasi->delete();
        return response()->json(['message'=>'anda telah berhasil menghapus data peta vaksinasi'], 200);
    }

    public function muatPeta($satker,$tahun)
    {
        if ($satker == "semua") {
            $vaksinasi = vaksinasi::select('vaksinasi.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','vaksinasi.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('tahun',$tahun)->get();
        } elseif ($tahun == "kosong") {
            $vaksinasi = vaksinasi::select('vaksinasi.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','vaksinasi.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->get();
        } else {
            $vaksinasi = vaksinasi::select('vaksinasi.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang','kota.nama_kota')->leftjoin('kecamatan','vaksinasi.kecamatan_id','kecamatan.id')->leftjoin('kota','kecamatan.kota_id','kota.id')->where('satker_id',$satker)->where('tahun',$tahun)->get();
        }
        return response()->json($vaksinasi);
    }

    public function muatGrafik($satker,$tahun)
    {
        $vaksinasis = vaksinasi::select([
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
            $vaksinasis->where('satker_id',$satker);
        } 
        $vaksinasi = $vaksinasis->where('tahun',$tahun)->get();
        return response()->json($vaksinasi);  
    }

}
