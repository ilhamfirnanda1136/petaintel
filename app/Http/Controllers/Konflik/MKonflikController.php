<?php

namespace App\Http\Controllers\Konflik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,DataTables;
use App\konflik as konflik;
class MKonflikController extends Controller
{
    public function index()
    {
        return view('admin.konflik.master.konflik_data');
    }
    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(),['deskripsi'=>'required']);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        if ($request->id == '') {
            $message = 'anda telah berhasil menambah data master jenis konflik';
            $konflik = new konflik();
        } else {
            $message = 'anda telah berhasil mengubah data master jenis konflik';
            $konflik = konflik::findOrFail($request->id);
        }
        $konflik->deskripsi_konflik = $request->deskripsi;
        $konflik->save();
        return response()->json(['success'=> $request->all(),'message'=>$message], 200);
    }
    public function table()
    {
        $model=konflik::query();
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.konflik.master.action',[
                'model'=>$model,
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }
    public function hapus($id)
    {
        $konflik = konflik::findOrFail($id);
        $konflik->delete();
        return response()->json(['message'=>'anda telah berhasil menghapus data master konflik'], 200);
    }

    
}
