<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $asing = \App\pengawasanasing::all();
        $konflik = \App\petakonflik::all();
        $lsm = \App\petalsm::all();
        $pakem = \App\pakem::all();
        $radikalisme = \App\petaradikalisme::all();
        $vaksinasi = \App\vaksinasi::all();
        return view('home',compact(['asing','konflik','lsm','pakem','radikalisme','vaksinasi']));
    }
}