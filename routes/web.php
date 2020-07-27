<?php

use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/beranda', 'HomeController@index')->name('beranda');
Route::get('/sejarah', 'SejarahController@sejarah')->name('sejarah');
Route::get('/buat-surat/{id}/{slug}', 'SuratController@buat')->name('buat-surat');
Route::post('/buat-surat/{id}', 'SuratController@show')->name('buat-surat.download');

Route::group(['middleware' => ['web', 'guest']], function () {

    Route::get('/panduan', 'HomeController@panduan')->name('panduan');
    Route::get('/masuk', 'AuthController@index')->name('masuk');
    Route::post('/masuk', 'AuthController@masuk');

});

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::post('/keluar', 'AuthController@keluar')->name('keluar');
    Route::get('/pengaturan', 'UserController@pengaturan')->name('pengaturan');
    Route::get('/profil', 'UserController@profil')->name('profil');
    Route::patch('/update-pengaturan/{user}', 'UserController@updatePengaturan')->name('update-pengaturan');
    Route::patch('/update-profil/{user}', 'UserController@updateProfil')->name('update-profil');

    Route::get('/profil-desa', 'DesaController@index')->name('profil-desa');
    Route::patch('/update-desa/{desa}', 'DesaController@update')->name('update-desa');

    Route::get('/tambah-surat', 'SuratController@create')->name('surat.create');
    Route::resource('/surat', 'SuratController')->except('create');

    Route::get('/admin/sejarah', 'SejarahController@index')->name('sejarah.index');
    Route::get('/tambah-sejarah', 'SejarahController@create')->name('sejarah.create');
    Route::resource('/sejarah', 'SejarahController')->except('create','show','index');
    Route::get('/sejarah/{sejarah}/{slug}', 'SejarahController@show')->name('sejarah.show');

    Route::resource('/isiSurat', 'IsiSuratController')->except('index', 'create', 'edit', 'show');

    Route::get('/tambah-gallery', 'GalleryController@create')->name('gallery.create');
    Route::resource('/gallery', 'GalleryController')->except('show', 'edit', 'update', 'create');

});
