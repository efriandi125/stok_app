<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
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
Route::resource('Homes', HomeController::class)->middleware('auth');

Route::get('/customer/search',[CustomerController::class,'search'])->name('customer.search')->middleware('auth');
Route::get('/customer/get/{id}', [CustomerController::class, 'get_id'])->middleware('auth');
Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store')->middleware('auth');
Route::get('/customer', [CustomerController::class, 'show'])->name('customer')->middleware('auth');
Route::patch('/customer/update/{id}', [CustomerController::class, 'update'])->middleware('auth');
Route::delete('/customer/delete/{id}', [CustomerController::class, 'drop'])->middleware('auth');


Route::get('/user/search',[UserController::class,'search'])->name('user.search')->middleware('auth');
Route::get('/user/get/{id}',[UserController::class,'get_id'])->middleware('auth');
Route::get('/user',[UserController::class,'show'])->name('user')->middleware('auth');
Route::post('/user',[UserController::class,'store'])->name('user.store')->middleware('auth');
Route::patch('/user/update/{id}',[UserController::class,'update'])->middleware('auth');
Route::delete('/user/delete/{id}',[UserController::class,'drop'])->middleware('auth');



Route::get('/category/search',[CategoryController::class,'search'])->name('category.search')->middleware('auth');
Route::get('/category/get/{id}',[CategoryController::class,'get_id'])->middleware('auth');
Route::get('/category',[CategoryController::class,'show'])->name('category')->middleware('auth');
Route::post('/category',[CategoryController::class,'store'])->name('category.store')->middleware('auth');
Route::patch('/category/update/{id}',[CategoryController::class,'update'])->middleware('auth');
Route::delete('/category/delete/{id}',[CategoryController::class,'drop'])->middleware('auth');

Route::get('/produk/search',[ProdukController::class,'search'])->name('produk.search')->middleware('auth');
Route::get('/produk/get/{id}',[ProdukController::class,'get_id'])->middleware('auth');
Route::get('/produk',[ProdukController::class,'show'])->name('produk')->middleware('auth');
Route::post('/produk',[ProdukController::class,'store'])->name('produk.store')->middleware('auth');
Route::patch('/produk/update/{id}',[ProdukController::class,'update'])->middleware('auth');
Route::delete('/produk/delete/{id}',[ProdukController::class,'drop'])->middleware('auth');


Route::get('/transaksi',[TransaksiController::class,'show'])->name('transaksi')->middleware('auth');
Route::get('/transaksi/get/{id}',[TransaksiController::class,'get_id'])->middleware('auth');
Route::post('/transaksi',[TransaksiController::class,'store'])->name('transaksi.store')->middleware('auth');
Route::get('/transaksi/filter',[TransaksiController::class,'filter'])->name('transaksi.filter')->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.proses')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');