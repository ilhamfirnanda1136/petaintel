<?php

namespace App\Http\Controllers\Parpol;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Validator,DataTables,Auth;

use App\parpol as parpol;

class MParpolController extends Controller
{
    public function index()
    {
        return view('admin.parpol.master.parpol_data');
    }

    protected function validator(array $data)
    {
        return Validator::make($data,[
            'no_urut' => 'required',
            'nama_parpol' => 'required',
            'logo_parpol' => 'mimes:jpg,jpeg,png'
        ]);
    }

    public function simpan(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) return response()->json(['errors'=>$request->all()], 200);
        $request->request->add(['satker_id'=>Auth::user()->satker_id]);
        $parpol = parpol::updateOrCreate(['id'=>$request->id],$request->all());
          if ($request->hasFile('logo_parpol')) {
            $file=$request->file('logo_parpol');
            $nama_file='parpol-'.date('Y').'-'.substr(md5(rand()),0,6).$file->getClientOriginalName();
            $parpol->logo_parpol=$nama_file;
            $file->move('img/parpol/',$nama_file);
            $parpol->save();
        }
        $message =  $request->id != null ? 'Anda Telah berhasil Mengubah Parpol' : 'Anda telah berhasil Menambah Parpol';
        return response()->json(['success'=>$request->all(),'message'=>$message], 200);
    }

    public function table()
    {
        $model=parpol::query()->where('satker_id',Auth::user()->satker_id);
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.parpol.master.action',[
                'model'=>$model,
            ]);
        })
        ->addColumn('foto_partai',function($model){
            $url = asset("img/parpol/".$model->logo_parpol);
            return "<image src='{$url}' alt='{$model->nama_parpol}' style='border-radius:0px;width:100%;height:100px;'/>";
        })
        ->addIndexColumn()
        ->rawColumns(['action','foto_partai'])
        ->make(true); 
    }

    public function ambil($id)
    {
        $parpol = parpol::findOrFail($id);
        return response()->json($parpol);
    }

    public function hapus($id)
    {
        $parpol = parpol::findOrFail($id);
        $parpol->delete();
        return redirect()->back()->with('sukses','anda telah berhasil menghapus data parpol');
    }
}
