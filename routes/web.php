<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CetakController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard',[
        "title"=>"Dashboard"
    ]);
})->middleware('auth');


Route::resource('kategori',CategoryController::class)->except('show','destroy','create');
Route::resource('pelanggan',CustomerController::class)->except('destroy');
Route::resource('produk',ProductController::class);
Route::resource('pengguna',UserController::class)->except('destroy','create','show','update','edit');
Route::get('login',[loginController::class,'loginView'])->name('login');
Route::post('login',[loginController::class,'authenticate']);
Route::post('logout',[LoginController::class,'logout'])->middleware('auth');
Route::get('penjualan',function(){
    return view('penjualan.index',[
        "title"=>"penjualan"
    ]);
})->middleware('auth');
Route::get('order',function(){
    return view('penjualan.orders',[
        "title"=>"Order"
    ]);
})->Middleware('auth');
Route::get('cetakReceipt',[Cetakcontroller::class,'receipt'])->name('cetakReceipt')->middleware('auth');
