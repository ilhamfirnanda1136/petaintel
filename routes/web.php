<?php

use Illuminate\Support\Facades\Route;
//use DB;
use Faker\Factory as Faker;
//use DataTables;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test',function(){
    return view('test');
});

Route::get('/import',function(){
      $faker = Faker::create('id_ID');
 
        for($i = 1; $i <= 50; $i++){
 
              // insert data ke table pegawai menggunakan Faker
            DB::table('test')->insert([
                'nama' => $faker->name,
                'note' => $faker->address,
            ]);
 
        }
});


Route::get('/', function () {
    $satker = \App\Satker::all();
    return view('welcome',compact('satker'));
});
//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/map/test',function(){
    return view('maptest');
});

Route::group(['middleware' => ['auth']], function () {

    /* Master jenis Konflik */
    Route::get('/master/konflik','Konflik\MKonflikController@index');
    Route::post('/simpan/master/konflik','Konflik\MKonflikController@simpan');
    Route::get('/table/master/konflik',['as'=>'table.master.konflik','uses'=>'Konflik\MKonflikController@table']);
    Route::get('/hapus/master/konflik/{id}','Konflik\MKonflikController@hapus');

      /* Master jenis Radkalisme */
    Route::get('/master/radikalisme','Radikalisme\MRadikalismeController@index');
    Route::post('/simpan/master/radikalisme','Radikalisme\MRadikalismeController@simpan');
    Route::get('/table/master/radikalisme',['as'=>'table.master.radikalisme','uses'=>'Radikalisme\MRadikalismeController@table']);
    Route::get('/hapus/master/radikalisme/{id}','Radikalisme\MRadikalismeController@hapus');

    /* Master jenis LSM */
    Route::get('/master/lsm','Lsm\MLsmController@index');
    Route::post('/simpan/master/lsm','Lsm\MLsmController@simpan');
    Route::get('/table/master/lsm',['as'=>'table.master.lsm','uses'=>'Lsm\MLsmController@table']);
    Route::get('/hapus/master/lsm/{id}','Lsm\MLsmController@hapus');

     /* Pemilu Kepala Daerah */
    Route::get('master/paslon','Paslon\MPaslonController@index');
    Route::post('/simpan/master/paslon','Paslon\MPaslonController@simpan');
    Route::get('/table/master/paslon',['as'=>'table.master.paslon','uses'=>'Paslon\MPaslonController@table']);
    Route::get('master/paslon/ambil/{id}','Paslon\MPaslonController@ambil');
    Route::get('master/paslon/hapus/{id}','Paslon\MPaslonController@hapus');

    /* Pemilu Partai Politik */
    Route::get('master/parpol','Parpol\MParpolController@index');
    Route::post('/simpan/master/parpol','Parpol\MParpolController@simpan');
    Route::get('/table/master/parpol',['as'=>'table.master.parpol','uses'=>'Parpol\MParpolController@table']);
    Route::get('master/parpol/ambil/{id}','Parpol\MParpolController@ambil');
    Route::get('master/parpol/hapus/{id}','Parpol\MParpolController@hapus');

});

Route::group(['middleware' => ['auth','level:1']], function () {
    
    /* master User */
    Route::get('/user','userController@index');
    Route::get('/table/user','userController@table');
    Route::post('/simpan/user','userController@simpan');
    Route::post('/simpanEdit/user','userController@simpanEdit');
    Route::get('/hapus/user/{id}','userController@hapus');
    Route::get('/edit/user/{id}','userController@edit');

});

Route::group(['middleware' => ['auth','level:1,2,3']], function () {

    /* Peta Konflik */
    Route::get('/konflik', function () {
        return view('admin.konflik.peta.konflik');
    });
    Route::get('tambah/peta/konflik','Konflik\KonflikController@tambah');
    Route::post('simpan/konflik','Konflik\KonflikController@simpan');
    Route::post('simpan/edit/konflik','Konflik\KonflikController@simpanEdit');
    Route::get('table/konflik','Konflik\KonflikController@table');
    Route::get('hapus/konflik/{id}','Konflik\KonflikController@hapus');
    Route::get('edit/peta/konflik/{id}','Konflik\KonflikController@edit');


    /* Peta Radikalisme */
    Route::get('/radikalisme', function () {
        return view('admin.radikalisme.peta.radikalisme');
    });
    Route::get('tambah/peta/radikalisme','Radikalisme\RadikalismeController@tambah');
    Route::post('simpan/radikalisme','Radikalisme\RadikalismeController@simpan');
    Route::post('simpan/edit/radikalisme','Radikalisme\RadikalismeController@simpanEdit');
    Route::get('table/radikalisme','Radikalisme\RadikalismeController@table');
    Route::get('hapus/radikalisme/{id}','Radikalisme\RadikalismeController@hapus');
    Route::get('edit/peta/radikalisme/{id}','Radikalisme\RadikalismeController@edit');

    /*Peta LSM */
    Route::get('/lsm', function () {
        return view('admin.lsm.peta.lsm');
    });
    Route::get('tambah/peta/lsm','Lsm\LsmController@tambah');
    Route::post('simpan/lsm','Lsm\LsmController@simpan');
    Route::post('simpan/edit/lsm','Lsm\LsmController@simpanEdit');
    Route::get('table/lsm','Lsm\LsmController@table');
    Route::get('hapus/lsm/{id}','Lsm\LsmController@hapus');
    Route::get('edit/peta/lsm/{id}','Lsm\LsmController@edit');
    Route::get('laporan/peta/lsm','Lsm\LsmController@laporan');
    Route::get('laporan/lsm/print','Lsm\LsmController@pdf');

    /* pakem */
    Route::get('pakem', function () {
        return view('admin.pakem.pakem');
    });
    Route::get('tambah/peta/pakem','Pakem\PakemController@tambah');
    Route::get('table/pakem','Pakem\PakemController@table');
    Route::post('simpan/pakem','Pakem\PakemController@simpan');
    Route::post('simpan/edit/pakem','Pakem\PakemController@simpanEdit');
    Route::get('hapus/pakem/{id}','Pakem\PakemController@hapus');
    Route::get('edit/pakem/{id}','Pakem\PakemController@edit');
    Route::get('laporan/peta/pakem','Pakem\PakemController@laporan');
    Route::get('laporan/pakem/print','Pakem\PakemController@pdf');
    
    /* Pengawasan Orang Asing */
    Route::get('asing', function () {
        return view('admin.asing.asing');
    });
    Route::get('tambah/peta/asing','Asing\AsingController@tambah');
    Route::get('table/asing','Asing\AsingController@table');
    Route::post('simpan/asing','Asing\AsingController@simpan');
    Route::post('simpan/edit/asing','Asing\AsingController@simpanEdit');
    Route::get('hapus/asing/{id}','Asing\AsingController@hapus');
    Route::get('edit/peta/asing/{id}','Asing\AsingController@edit');


    /* Paslon Suara */
    Route::get('paslon/suara','Paslon\PaslonController@index');
    Route::post('simpan/suara/paslon','Paslon\PaslonController@simpan');
    Route::get('table/suara/paslon',['as'=>'table.suara.paslon','uses'=>'Paslon\PaslonController@table']);
    Route::get('suara/paslon/ambil/{id}','Paslon\PaslonController@ambil');
    Route::get('suara/paslon/hapus/{id}','Paslon\PaslonController@hapus');

    /* Parpol Suara */
    Route::get('parpol/suara','Parpol\ParpolController@index');
    Route::post('simpan/suara/parpol','Parpol\ParpolController@simpan');
    Route::get('table/suara/parpol',['as'=>'table.suara.parpol','uses'=>'parpol\ParpolController@table']);
    Route::get('suara/parpol/ambil/{id}','Parpol\ParpolController@ambil');
    Route::get('suara/parpol/hapus/{id}','Parpol\ParpolController@hapus');

    /* Vaksinasi */
    Route::get('vaksinasi','Vaksinasi\VaksinasiController@index');
    Route::get('tambah/peta/vaksinasi','Vaksinasi\VaksinasiController@tambah');
    Route::get('table/vaksinasi','Vaksinasi\VaksinasiController@table');
    Route::post('simpan/vaksinasi','Vaksinasi\VaksinasiController@simpan');
    Route::post('simpan/edit/vaksinasi','Vaksinasi\VaksinasiController@simpanEdit');
    Route::get('hapus/vaksinasi/{id}','Vaksinasi\VaksinasiController@hapus');
    Route::get('edit/vaksinasi/{id}','Vaksinasi\VaksinasiController@edit');


    /* Bencana */
    Route::get('bencana','Bencana\BencanaController@index');
    Route::get('tambah/peta/bencana','Bencana\BencanaController@tambah');
    Route::get('table/bencana','Bencana\BencanaController@table');
    Route::post('simpan/bencana','Bencana\BencanaController@simpan');
    Route::post('simpan/edit/bencana','Bencana\BencanaController@simpanEdit');
    Route::get('hapus/bencana/{id}','Bencana\BencanaController@hapus');
    Route::get('edit/bencana/{id}','Bencana\BencanaController@edit');

});

/* Peta Muat */
Route::get('peta/konflik/{satker}/{tahun}',function($satker,$tahun){
    return view('iframe.konfliksosial',['satker'=>$satker,'tahun'=>$tahun]);
});
Route::get('muat/konflik/{satker}/{tahun}','Konflik\KonflikController@muatPeta');

Route::get('peta/radikalisme/{satker}/{tahun}',function($satker,$tahun){
    return view('iframe.radikalisme',['satker'=>$satker,'tahun'=>$tahun]);
});
Route::get('muat/radikalisme/{satker}/{tahun}','Radikalisme\RadikalismeController@muatPeta');

Route::get('peta/pakem/{satker}/{tahun}',function($satker,$tahun){
    return view('iframe.pakem',['satker'=>$satker,'tahun'=>$tahun]);
});
Route::get('muat/pakem/{satker}/{tahun}','Pakem\PakemController@muatPeta');

Route::get('peta/orangasing/{satker}/{tahun}',function($satker,$tahun){
    return view('iframe.orangasing',['satker'=>$satker,'tahun'=>$tahun]);
});
Route::get('muat/orangasing/{satker}/{tahun}','Asing\AsingController@muatPeta');

Route::get('peta/lsm/{satker}/{tahun}',function($satker,$tahun){
    return view('iframe.lsm',['satker'=>$satker,'tahun'=>$tahun]);
});
Route::get('muat/lsm/{satker}/{tahun}','Lsm\LsmController@muatPeta');

Route::get('peta/paslon/{satker}/{tahun}',function($satker,$tahun){
    return view('iframe.paslon',['satker'=>$satker,'tahun'=>$tahun]);
});
Route::get('muat/paslon/{satker}/{tahun}','Paslon\PaslonController@muatPeta');

Route::get('peta/parpol/{satker}/{tahun}',function($satker,$tahun){
    return view('iframe.parpol',['satker'=>$satker,'tahun'=>$tahun]);
});
Route::get('muat/parpol/{satker}/{tahun}','Parpol\ParpolController@muatPeta');

Route::get('peta/vaksinasi/{satker}/{tahun}',function($satker,$tahun){
    return view('iframe.vaksinasi',['satker'=>$satker,'tahun'=>$tahun]);
});
Route::get('muat/vaksinasi/{satker}/{tahun}','Vaksinasi\VaksinasiController@muatPeta');

Route::get('peta/bencana/{satker}/{tahun}',function($satker,$tahun){
    return view('iframe.bencana',['satker'=>$satker,'tahun'=>$tahun]);
});
Route::get('muat/bencana/{satker}/{tahun}','Bencana\BencanaController@muatPeta');

/* Grafik Muat */
Route::group(['prefix' => 'grafik'], function () {

    /* Grafik Konflik Sosial */
    Route::get('konflik/{satker}',function($satker){
        return view('grafik.grafikkonfliksosial',['satker'=>$satker]);
    });
    Route::get('muat/konflik/{satker}','Konflik\KonflikController@muatGrafik');

    /* Grafik Radikalisme */
    Route::get('radikalisme/{satker}',function($satker){
        return view('grafik.grafikradikalisme',['satker'=>$satker]);
    });
    Route::get('muat/radikalisme/{satker}','Radikalisme\RadikalismeController@muatGrafik');

    /* Grafik Pakem */
    Route::get('pakem/{satker}',function($satker){
        return view('grafik.grafikpakem',['satker'=>$satker]);
    });
    Route::get('muat/pakem/{satker}','Pakem\PakemController@muatGrafik');

    /* Grafik orang asing */
    Route::get('orangasing/{satker}',function($satker){
        return view('grafik.grafikorangasing',['satker'=>$satker]);
    });
    Route::get('muat/orangasing/{satker}','Asing\AsingController@muatGrafik');

    /* Grafik lsm */
    Route::get('lsm/{satker}',function($satker){
        return view('grafik.grafiklsm',['satker'=>$satker]);
    });
    Route::get('muat/lsm/{satker}','Lsm\LsmController@muatGrafik');

    /* Grafik Paslon */
    Route::get('paslon/{satker}/{tahun}',function($satker,$tahun){
        return view('grafik.grafikpaslon',['satker'=>$satker,'tahun'=>$tahun]);
    });
    Route::get('muat/paslon/{satker}/{tahun}','Paslon\PaslonController@muatGrafik');

    Route::get('paslon/all/{satker}/{tahun}',function($satker,$tahun){
        return view('grafik.grafikpaslonall',['satker'=>$satker,'tahun'=>$tahun]);
    });
    Route::get('muat/paslon/all/{satker}/{tahun}','Paslon\PaslonController@muatGrafikAll');

    /* Grafik Parpol */
    Route::get('parpol/{satker}/{tahun}',function($satker,$tahun){
        return view('grafik.grafikparpol',['satker'=>$satker,'tahun'=>$tahun]);
    });
    Route::get('muat/parpol/{satker}/{tahun}','Parpol\ParpolController@muatGrafik');

    Route::get('parpol/all/{satker}/{tahun}',function($satker,$tahun){
        return view('grafik.grafikparpolall',['satker'=>$satker,'tahun'=>$tahun]);
    });
    Route::get('muat/parpol/all/{satker}/{tahun}','Parpol\ParpolController@muatGrafikAll');

     /* Grafik Pakem */
    Route::get('vaksinasi/{satker}/{tahun}',function($satker,$tahun){
        return view('grafik.grafikvaksinasi',['satker'=>$satker,'tahun'=>$tahun]);
    });
    Route::get('muat/vaksinasi/{satker}/{tahun}','Vaksinasi\VaksinasiController@muatGrafik');

    /* Grafik Bencana */
    Route::get('bencana/{satker}/{tahun}',function($satker,$tahun){
        return view('grafik.grafikbencana',['satker'=>$satker,'tahun'=>$tahun]);
    });
    Route::get('muat/bencana/{satker}/{tahun}','Bencana\BencanaController@muatGrafik');

});


/* profile */
Route::get('profile',function(){
    $satker = \App\Satker::all();
    return view('admin.user.profile',compact('satker'));
});
Route::post('change/profile','userController@change');
Route::get('change/password',function(){
    return view('admin.user.password');
});
Route::post('simpan/ubahPassword','userController@changePassword');