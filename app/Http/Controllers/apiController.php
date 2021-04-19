<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\kecamatan;
class apiController extends Controller
{
    public function kecamatan(Request $request)
    {
        $kecamatan = kecamatan::where('kota_id','=',$request->kota)->get();
        return response()->json(['code'=>200,'data'=>$kecamatan], 200);
    }
}
