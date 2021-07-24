<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\datacovidController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\rumahsakitController;
use App\Http\Controllers\daftarvaksinController;

Route::post('login', [LoginController::class,'login']);
Route::post('register', [LoginController::class,'register']);

Route::group(['middleware' => ['jwt.verify:admin']], function () { //untuk hak akses admin
    //akses datacovid
    Route::get('admin/datacovid',  [datacovidController::class, 'index']);
	Route::post('admin/datacovid', [datacovidController::class, 'insert']); 
	Route::delete('admin/datacovid/detail/{id}', [datacovidController::class, 'delete']); 
	Route::put('admin/datacovid/detail/{id}', [datacovidController::class, 'update']); 
    
    //akses rumahsakit
    Route::get('admin/rumahsakit',  [rumahsakitController::class, 'index']);
	Route::post('admin/rumahsakit', [rumahsakitController::class, 'insert']); 
	Route::delete('admin/rumahsakit/detail/{id}', [rumahsakitController::class, 'delete']); 
	Route::put('admin/rumahsakit/detail/{id}', [rumahsakitController::class, 'update']); 
    
});

Route::group(['middleware' => ['jwt.verify:masyarakat']], function () { //untuk hak akses admin

    //akses daftar
    Route::get('masyarakat/daftarvaksin',  [daftarvaksinController::class, 'index']);
	Route::post('masyarakat/daftarvaksin', [daftarvaksinController::class, 'insert']); 
	Route::delete('masyarakat/daftarvaksin/detail/{id}', [daftarvaksinController::class, 'delete']); 
	Route::put('masyarakat/daftarvaksin/detail/{id}', [daftarvaksinController::class, 'update']); 

});