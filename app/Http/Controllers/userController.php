<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User as user; 
use App\Satker as Satker;

use App\kota;

use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rule;

use DataTables,Validator,Auth;
class userController extends Controller
{
    public function index()
    {
        $satker = Satker::orderBy('nama_satker','asc')->get();
        $kota = kota::orderBy('nama_kota','asc')->get();
        return view('admin.user.user_data',compact('satker','kota'));
    }

    public function table()
    {
        $model = user::query()->where('users.id','!=',Auth::user()->id);
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.user.action',[
                'model'=>$model,
            ]);
        })
        ->addColumn('level_satker',function($model){
          $level=array('','Super Admin','Kajati','Kajari');
          return $level[$model->level];
        })
        ->addIndexColumn()
        ->rawColumns(['action','level_satker'])
        ->make(true);
    }
    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama'=>'required',
            'email'=>'required|email|unique:users',
            'username'=>'required|unique:users',
            'password'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors(),'message'=>'Masukkan data dengan benar'], 200);
        }
        $satker=satker::find($request->satker);
        $level=$satker->level_satker==0 ? 2 : 3;
        $user = new user();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->name = $request->nama;
        $user->password = Hash::make($request->password);
        $user->satker_id = $request->satker;
        $user->kota_id = $request->kota_id;
        $user->level = $level;
        $user->save();
        return response()->json(['success'=>$request->all(),'message'=>'Anda Telah berhasil menambahkan User'], 200);
    }

     public function simpanEdit(Request $request)
    {
        $user = user::findOrFail($request->id);
        $validator = Validator::make($request->all(),[
            'nama'=>'required',
            'email'=>['required','email','max:191',Rule::unique('users')->ignore($user->email,'email')],
            'username'=>['required','max:191',Rule::unique('users')->ignore($user->username,'username')],
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors(),'message'=>'Masukkan data dengan benar'], 200);
        }
        $satker=satker::find($request->satker);
        $level=$satker->level_satker==0 ? 2 : 3;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->name = $request->nama;
        $user->satker_id = $request->satker;
        $user->kota_id = $request->kota_id;
        $user->level = $level;
        $user->save();
        return response()->json(['success'=>$request->all(),'message'=>'Anda Telah berhasil Mengubah User'], 200);
    }

    public function hapus($id)
    {
        $user = user::findOrFail($id);
        $user->delete();
        return response()->json(['success'=>'anda telah berhasil menghapus data user'], 200);
    }
    public function edit($id)
    {
        $user = user::findOrFail($id);
        return response()->json($user, 200);
    }
    public function change(Request $request)
    {
        $user = user::findOrFail(Auth::user()->id);
        $validator = Validator::make($request->all(),[
            'nama'=>'required',
            'email'=>['required','email','max:191',Rule::unique('users')->ignore($user->email,'email')],
            'username'=>['required','max:191',Rule::unique('users')->ignore($user->username,'username')],
        ]);
         if ($validator->fails()) {
             return Redirect()->back()->withErrors($validator->errors())->withInput();
        } 
        $satker=satker::find($request->satker);
        $level=$satker->level_satker==0 ? 2 : 3;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->name = $request->nama;
        $user->satker_id = $request->satker;
        $user->level = $level;
        $user->save();
        return redirect()->back()->with('sukses','anda telah berhasil mengubah profile anda');
    }
    public function changePassword(Request $request)
    {
        $this->validate($request,[
        'oldpassword'=>'required',
        'password'=>'required|confirmed|min:5'
         ],['required'=>'Form ini harus diisi','confirmed'=>'konfirmasi password harus sama dengan password baru']);
        $hashedPassword=Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedPassword)) {
            $user=user::find(Auth::user()->id);
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('successMSG','Password Telah diubah');
        }
        else{
            return redirect()->back()->with('errorMSG','Password tidak sama dengan password lama');
        }
    }
}
