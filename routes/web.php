<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PresensiController;
use SebastianBergmann\CodeCoverage\Node\CrapIndex;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class,'halamanlogin'])->name('login');
Route::get('/registrasi', [LoginController::class,'registrasi'])->name('registrasi');
Route::post('/simpanregistrasi', [LoginController::class,'simpanregistrasi'])->name('simpanregistrasi');
Route::post('/login', [LoginController::class,'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'ceklevel:admin,karyawan']], function(){ 
Route::get('/home', [HomeController::class,'index'])->name('home');
});

Route::group(['middleware' => ['auth', 'ceklevel:karyawan']], function(){ 
    Route::post('/simpan-masuk', [PresensiController::class,'store'])->name('simpan-masuk');
    Route::get('/presensi-masuk', [PresensiController::class,'index'])->name('presensi-masuk');
   
    });
    