<?php

namespace App\Http\Controllers\lsm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,DataTables;
use App\lsm as lsm;
class MLsmController extends Controller
{
     public function index()
    {
        return view('admin.lsm.master.lsm_data');
    }
    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(),['deskripsi'=>'required']);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        if ($request->id == '') {
            $message = 'anda telah berhasil menambah data master jenis LSM/ORMAS';
            $lsm = new lsm();
        } else {
            $message = 'anda telah berhasil mengubah data master jenis LSM/ORMAS';
            $lsm = lsm::findOrFail($request->id);
        }
        $lsm->deskripsi_lsm = $request->deskripsi;
        $lsm->save();
        return response()->json(['success'=> $request->all(),'message'=>$message], 200);
    }
    public function table()
    {
        $model=lsm::query();
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.lsm.master.action',[
                'model'=>$model,
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }
    public function hapus($id)
    {
        $lsm = lsm::findOrFail($id);
        $lsm->delete();
        return response()->json(['message'=>'anda telah berhasil menghapus data master lsm'], 200);
    }
}
