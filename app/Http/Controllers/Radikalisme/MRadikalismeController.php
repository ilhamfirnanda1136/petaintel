<?php

namespace App\Http\Controllers\Radikalisme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,DataTables;
use App\radikalisme as radikalisme;
class MRadikalismeController extends Controller
{
    public function index()
    {
        return view('admin.radikalisme.master.radikalisme_data');
    }
    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(),['deskripsi'=>'required']);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors() , 'message'=>'mohon mengisi data dengan benar'],200);
        }
        if ($request->id == '') {
            $message = 'anda telah berhasil menambah data master jenis radikalisme';
            $radikalisme = new radikalisme();
        } else {
            $message = 'anda telah berhasil mengubah data master jenis radikalisme';
            $radikalisme = radikalisme::findOrFail($request->id);
        }
        $radikalisme->deskripsi_radikalisme = $request->deskripsi;
        $radikalisme->save();
        return response()->json(['success'=> $request->all(),'message'=>$message], 200);
    }
    public function table()
    {
        $model=radikalisme::query();
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.radikalisme.master.action',[
                'model'=>$model,
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }
    public function hapus($id)
    {
        $radikalisme = radikalisme::findOrFail($id);
        $radikalisme->delete();
        return response()->json(['message'=>'anda telah berhasil menghapus data master radikalisme'], 200);
    }
}
