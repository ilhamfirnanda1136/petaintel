<?php

namespace App\Http\Controllers\Paslon;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Validator,DataTables,Auth;

use App\paslon as paslon;

class MPaslonController extends Controller
{
    public function index()
    {
        return view('admin.paslon.master.paslon_data');
    }

    protected function validator(array $data)
    {
        return Validator::make($data,[
            'periode_pemilu' => 'required',
            'no_urut' => 'required',
            'nama_paslon' => 'required',
            'wakil_paslon' => 'required',
            'partai'=>'required',
            'foto_paslon' => 'mimes:jpg,jpeg,png'
        ]);
    }

    public function simpan(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()]);
        $request->request->add(['satker_id' => Auth::user()->satker_id]);
        $paslon = paslon::updateOrCreate(['id'=>$request->id],$request->all());
        if ($request->hasFile('foto_paslon')) {
            $file=$request->file('foto_paslon');
            $nama_file='paslon-'.date('Y').'-'.substr(md5(rand()),0,6).$file->getClientOriginalName();
            $paslon->foto_paslon=$nama_file;
            $file->move('img/paslon/',$nama_file);
            $paslon->save();
        }
        return response()->json(['success'=>$request->all()], 200);
    }

    public function table()
    {
        $model=paslon::query()->where('satker_id',Auth::user()->satker_id);
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.paslon.master.action',[
                'model'=>$model,
            ]);
        })
        ->addColumn('namapaslonwakil',function($model){
            return $model->nama_paslon."/".$model->wakil_paslon;
        })
        ->addColumn('foto_paslon',function($model){
            $url = asset("img/paslon/".$model->foto_paslon);
            return "<image src='{$url}' alt='{$model->nama_paslon}' style='border-radius:0px;width:100%;height:100px;'/>";
        })
        ->addIndexColumn()
        ->rawColumns(['action','namapaslonwakil','foto_paslon'])
        ->make(true);
    }

    public function ambil($id)
    {
        $paslon = paslon::findOrFail($id);
        return response()->json($paslon);
    }

    public function hapus($id)
    {
        $paslon = paslon::findOrFail($id);
        $paslon->delete();
        return redirect()->back()->with('sukses','anda telah berhasil menghapus data paslon');
    }
}
