<?php

namespace App\Http\Controllers\Paslon;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\{suarapilkada,paslon,kecamatan,kota};

use Validator,DataTables,Auth;

class PaslonController extends Controller
{
    public function index()
    {
        $paslon = paslon::orderBy('nama_paslon')->get();
       $kota = kota::where('id',Auth::user()->kota_id)->get();
        return view('admin.paslon.suara.suara_view',compact('paslon','kota'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data,[
            'paslon_id' => 'required',
            'kecamatan_id' => 'required',
            'jml_suara' => 'required'
        ]);
    }

    public function simpan(Request $request)
    {
        $validator = $this->validator($request->all());
        if($validator->fails()) return response()->json(['errors'=>$validator->errors()]);
        $ceksuara = suarapilkada::where('kecamatan_id',$request->kecamatan_id)
                        ->where('paslon_id',$request->paslon_id)
                        ->where('periode_pemilu',$request->periode_pemilu)->first();
        if ($ceksuara) return response()->json(['errorMessage'=>'kecamatan,paslon serta periode pemilu telah digunakan mohon ganti ']);
        $request->request->add(['satker_id'=>Auth::user()->satker_id]);
        $suara = suarapilkada::updateOrCreate(['id'=>$request->id],$request->all());
        $message = $request->id != null ? 'Anda Telah berhasil Mengubah Suara' : 'Anda telah berhasil Menambah Suara';
        return response()->json(['success'=>$request->all(),'message'=>$message]);
    }

    public function table()
    {
        $model=suarapilkada::with(['paslon','kecamatan'])->where('satker_id',Auth::user()->satker_id);
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.paslon.suara.action',[
                'model'=>$model,
            ]);
        })
        ->addColumn('namapaslonwakil',function($model){
            return $model->paslon->nama_paslon."/".$model->paslon->wakil_paslon;
        })
        ->addColumn('no_urut',function($model){
            return $model->paslon->no_urut;
        })
        ->addColumn('jumlah_suara',function($model){
            return $model->jml_suara." Suara";
        })
         ->addColumn('partai',function($model){
            return $model->paslon->partai;
        })
        ->addColumn('kecamatan',function($model){
            return $model->kecamatan->nama_kecamatan;
        })
        ->addColumn('foto_paslon',function($model){
            $url = asset("img/paslon/".$model->paslon->foto_paslon);
            return "<image src='{$url}' alt='{$model->paslon->nama_paslon}' style='border-radius:0px;width:100%;height:100px;'/>";
        })
        ->addIndexColumn()
        ->rawColumns(['action','namapaslonwakil','foto_paslon','jumlah_suara','kecamatan','no_urut','partai'])
        ->make(true);
    }

    public function ambil($id)
    {
        $suara = suarapilkada::where('id',$id)->with(['paslon'])->first();
        return response()->json($suara);
    }

    public function hapus($id)
    {
        $paslon = suarapilkada::findOrFail($id);
        $paslon->delete();
        return redirect()->back()->with('sukses','anda telah berhasil menghapus data suara untuk pasangan calon');
    }

    public function muatPeta($satker,$tahun)
    {
        if ($satker == "semua") {
            $suarapilkada = suarapilkada::select('suarapilkada.jml_suara as jumlah','suarapilkada.periode_pemilu as periode','paslon.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang')->leftjoin('paslon','suarapilkada.paslon_id','paslon.id')->leftjoin('kecamatan','suarapilkada.kecamatan_id','kecamatan.id')->where('paslon.periode_pemilu',$tahun)->get();
        } elseif ($tahun == "kosong") {
            $suarapilkada = suarapilkada::select('suarapilkada.jml_suara as jumlah','suarapilkada.periode_pemilu as periode','paslon.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang')->leftjoin('paslon','suarapilkada.paslon_id','paslon.id')->leftjoin('kecamatan','suarapilkada.kecamatan_id','kecamatan.id')->where('paslon.satker_id',$satker)->get();
        } else {
            $suarapilkada = suarapilkada::select('suarapilkada.jml_suara as jumlah','suarapilkada.periode_pemilu as periode','paslon.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang')->leftjoin('paslon','suarapilkada.paslon_id','paslon.id')->leftjoin('kecamatan','suarapilkada.kecamatan_id','kecamatan.id')->where('paslon.satker_id',$satker)->where('suarapilkada.periode_pemilu',$tahun)->get();
        }
        return response()->json($suarapilkada);
    }
    public function muatGrafik($satker,$tahun)
    {
        $data = [];
        $dataPaslon = [];
        $kecamatan = kecamatan::where('kota_id',1)->orderBy('nama_kecamatan','asc')->get();
        $paslon = paslon::all();
        foreach ($paslon as $p) {
            foreach ($kecamatan as $kec) {
                $suarapilkada = suarapilkada::with(['paslon'])->where('kecamatan_id',$kec->id)->where('periode_pemilu',$tahun)->where('paslon_id',$p->id)->where('satker_id',$satker)->first();
                array_push($data,$suarapilkada);
                array_push($dataPaslon,$p->nama_paslon."/".$p->wakil_paslon);
            }
            array_push($data,'split');
        }
        return response()->json([
            'kecamatan' => $kecamatan,
            'data' => $data,
            'datapaslon'=> $dataPaslon
        ], 200);
    }

    public function muatGrafikAll($satker,$tahun)
    {
        $data = [];
        $paslon = paslon::all();
        foreach($paslon as $p) {
            $suarapilkada = suarapilkada::where('periode_pemilu',$tahun)
                                        ->where('paslon_id',$p->id)
                                        ->sum('suarapilkada.jml_suara');
            array_push($data,$suarapilkada);
        }
        return response()->json(['paslon'=>$paslon,'data'=>$data]);
    }
}
