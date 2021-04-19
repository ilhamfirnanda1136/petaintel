<?php

namespace App\Http\Controllers\Parpol;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\{suaraparpol,parpol,kecamatan};

use Validator,DataTables,Auth;

class ParpolController extends Controller
{
   public function index()
    {
        $parpol = parpol::orderBy('nama_parpol')->get();
        $kota = kota::where('id',Auth::user()->kota_id)->get();
        return view('admin.parpol.suara.suara_view',compact('parpol','kota'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data,[
            'parpol_id' => 'required',
            'kecamatan_id' => 'required',
            'jml_suara' => 'required'
        ]);
    }

    public function simpan(Request $request)
    {
        $validator = $this->validator($request->all());
        if($validator->fails()) return response()->json(['errors'=>$validator->errors()]);
        $ceksuara = suaraparpol::where('kecamatan_id',$request->kecamatan_id)
                                ->where('parpol_id',$request->parpol_id)
                                ->where('periode_pemilu',$request->periode_pemilu)->first();
        if ($ceksuara) return response()->json(['errorMessage'=>'kecamatan,Parpol serta periode pemilu telah digunakan mohon ganti ']);
        $request->request->add(['satker_id'=>Auth::user()->satker_id]);
        $suara = suaraparpol::updateOrCreate(['id'=>$request->id],$request->all());
        $message = $request->id != null ? 'Anda Telah berhasil Mengubah Suara' : 'Anda telah berhasil Menambah Suara';
        return response()->json(['success'=>$request->all(),'message'=>$message]);
    }

    public function table()
    {
        $model=suaraparpol::with(['parpol','kecamatan'])->where('satker_id',Auth::user()->satker_id);
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.parpol.suara.action',[
                'model'=>$model,
            ]);
        })
        ->addColumn('namaparpol',function($model){
            return $model->parpol->nama_parpol;
        })
        ->addColumn('no_urut',function($model){
            return $model->parpol->no_urut;
        })
        ->addColumn('jumlah_suara',function($model){
            return $model->jml_suara." Suara";
        })
        ->addColumn('kecamatan',function($model){
            return $model->kecamatan->nama_kecamatan;
        })
        ->addColumn('foto_parpol',function($model){
            $url = asset("img/parpol/".$model->parpol->logo_parpol);
            return "<image src='{$url}' alt='{$model->parpol->nama_parpol}' style='border-radius:0px;width:100%;height:100px;'/>";
        })
        ->addIndexColumn()
        ->rawColumns(['action','namaparpol','foto_parpol','jumlah_suara','kecamatan','no_urut'])
        ->make(true);
    }

    public function ambil($id)
    {
        $suara = suaraparpol::where('id',$id)->with(['parpol'])->first();
        return response()->json($suara);
    }

    public function hapus($id)
    {
        $parpol = suaraparpol::findOrFail($id);
        $parpol->delete();
        return redirect()->back()->with('sukses','anda telah berhasil menghapus data suara untuk pasangan calon');
    } 

    public function muatPeta($satker,$tahun)
    {
        if ($satker == "semua") {
            $suaraparpol = suaraparpol::select('suaraparpol.jml_suara as jumlah','suaraparpol.periode_pemilu as periode','parpol.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang')->leftjoin('parpol','suaraparpol.parpol_id','parpol.id')->leftjoin('kecamatan','suaraparpol.kecamatan_id','kecamatan.id')->where('parpol.periode_pemilu',$tahun)->get();
        } elseif ($tahun == "kosong") {
            $suaraparpol = suaraparpol::select('suaraparpol.jml_suara as jumlah','suaraparpol.periode_pemilu as periode','parpol.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang')->leftjoin('parpol','suaraparpol.parpol_id','parpol.id')->leftjoin('kecamatan','suaraparpol.kecamatan_id','kecamatan.id')->where('parpol.satker_id',$satker)->get();
        } else {
            $suaraparpol = suaraparpol::select('suaraparpol.jml_suara as jumlah','suaraparpol.periode_pemilu as periode','parpol.*','kecamatan.nama_kecamatan','kecamatan.lat','kecamatan.lang')->leftjoin('parpol','suaraparpol.parpol_id','parpol.id')->leftjoin('kecamatan','suaraparpol.kecamatan_id','kecamatan.id')->where('parpol.satker_id',$satker)->where('suaraparpol.periode_pemilu',$tahun)->get();
        }
        return response()->json($suaraparpol);
    }

    public function muatGrafik($satker,$tahun)
    {
        $data = [];
        $dataParpol = [];
        $kecamatan = kecamatan::where('kota_id',1)->orderBy('nama_kecamatan','asc')->get();
        $parpol = parpol::all();
        foreach ($parpol as $p) {
            foreach ($kecamatan as $kec) {
                $suaraparpol = suaraparpol::with(['parpol'])->where('kecamatan_id',$kec->id)->where('periode_pemilu',$tahun)->where('parpol_id',$p->id)->where('satker_id',$satker)->first();
                array_push($data,$suaraparpol);
                array_push($dataParpol,$p->nama_parpol);
            }
            array_push($data,'split');
            
        }
        return response()->json([
            'kecamatan' => $kecamatan,
            'data' => $data,
            'dataparpol'=> $dataParpol 
        ], 200);
    }

    public function muatGrafikAll($satker,$tahun)
    {
        $data = [];
        $parpol = parpol::all();
        foreach($parpol as $p) {
            $suaraparpol = suaraparpol::where('periode_pemilu',$tahun)
                                        ->where('parpol_id',$p->id)
                                        ->sum('suaraparpol.jml_suara');
            array_push($data,$suaraparpol);
        }
        return response()->json(['parpol'=>$parpol,'data'=>$data]);  
    }
}
