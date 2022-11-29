<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JamuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('user',UserController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('category',CategoryController::class);
    Route::resource('post',PostController::class);
    Route::resource('produk',ProdukController::class);
    Route::resource('dashboard',JamuController::class);
    Route::get('detail{$category_id}',[PostController::class,'detail']);
    Route::get('detail',[PostController::class,'detail']);
    Route::get('home',[PostController::class,'dash']);
});
