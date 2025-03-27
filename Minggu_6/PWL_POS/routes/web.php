<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Router;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class,'index']);
// Route::get('/kategori', [KategoriController::class,'index']);
// Route::get('/user', [UserController::class,'index']);


// Route::get('/user/tambah',[UserController::class,'tambah']);
// Route::post('/user/tambah_simpan',[UserController::class,'tambah_simpan']);
// Route::get('/user/ubah/{id}',[UserController::class,'ubah']);
// Route::put('/user/ubah_simpan/{id}',[UserController::class,'ubah_simpan']);
// Route::get('/user/hapus/{id}',[UserController::class,'hapus']);

//Js 5 
//Praktikum 2
Route::get('/',[WelcomeController::class,'index']);
//Praktikum 3
Route::group(['prefix'=>'user'], function(){
    Route::get('/',[UserController::class,'index']);//menampilkan halaman awal
    Route::post('/list',[UserController::class,'list']);//menampilkan data user bentuk json / datatables
    Route::get('/create',[UserController::class,'create']);// meanmpilkan bentuk form untuk tambah user
    Route::post('/',[UserController::class,'store']);//menyimpan user data baru 
    Route::get('/create_ajax',[UserController::class,'create_ajax']);// meanmpilkan bentuk form untuk tambah user
    Route::post('/ajax',[UserController::class,'store_ajax']); //menyimpan user data baru ajax
    Route::get('/{id}',[UserController::class,'show']);        // menampilkan detil user ajax
    Route::get('/{id}/edit',[UserController::class,'edit']);// menampilkan halaman form edit user
    Route::put('/{id}',[UserController::class,'update']);// menyimpan perubahan data user 
    Route::get('/{id}/edit_ajax',[UserController::class,'edit_ajax']);// menampilkan halaman form edit user ajax
    Route::put('/{id}/update_ajax',[UserController::class,'update_ajax']);// menyimpan perubahan data user ajax
    Route::delete('/{id}',[UserController::class,'destroy']);// menghapus data user 
});

Route::group(['prefix'=>'level'], function(){
    Route::get('/',[LevelController::class,'index']);//menampilkan halaman awal
    Route::post('/list',[LevelController::class,'list']);//menampilkan data user bentuk json / datatables
    Route::get('/create',[LevelController::class,'create']);// meanmpilkan bentuk form untuk tambah user
    Route::post('/',[LevelController::class,'store']);//menyimpan user data baru 
    Route::get('/{id}',[LevelController::class,'show']); // menampilkan detil user
    Route::get('/{id}/edit',[LevelController::class,'edit']);// menampilkan halaman form edit user
    Route::put('/{id}',[LevelController::class,'update']);// menyimpan perubahan data user 
    Route::delete('/{id}',[LevelController::class,'destroy']);// menghapus data user 
});

Route::group(['prefix'=>'kategori'], function(){
    Route::get('/',[KategoriController::class,'index']);//menampilkan halaman awal
    Route::post('/list',[KategoriController::class,'list']);//menampilkan data user bentuk json / datatables
    Route::get('/create',[KategoriController::class,'create']);// meanmpilkan bentuk form untuk tambah user
    Route::post('/',[KategoriController::class,'store']);//menyimpan user data baru 
    Route::get('/{id}',[KategoriController::class,'show']); // menampilkan detil user
    Route::get('/{id}/edit',[KategoriController::class,'edit']);// menampilkan halaman form edit user
    Route::put('/{id}',[KategoriController::class,'update']);// menyimpan perubahan data user 
    Route::delete('/{id}',[KategoriController::class,'destroy']);// menghapus data user 
});

Route::group(['prefix'=>'barang'], function(){
    Route::get('/',[BarangController::class,'index']);//menampilkan halaman awal
    Route::post('/list',[BarangController::class,'list']);//menampilkan data user bentuk json / datatables
    Route::get('/create',[BarangController::class,'create']);// meanmpilkan bentuk form untuk tambah user
    Route::post('/',[BarangController::class,'store']);//menyimpan user data baru 
    Route::get('/{id}',[BarangController::class,'show']); // menampilkan detil user
    Route::get('/{id}/edit',[BarangController::class,'edit']);// menampilkan halaman form edit user
    Route::put('/{id}',[BarangController::class,'update']);// menyimpan perubahan data user 
    Route::delete('/{id}',[BarangController::class,'destroy']);// menghapus data user 
});

Route::group(['prefix'=>'supplier'], function(){
    Route::get('/',[SupplierController::class,'index']);//menampilkan halaman awal
    Route::post('/list',[SupplierController::class,'list']);//menampilkan data user bentuk json / datatables
    Route::get('/create',[SupplierController::class,'create']);// meanmpilkan bentuk form untuk tambah user
    Route::post('/',[SupplierController::class,'store']);//menyimpan user data baru 
    Route::get('/{id}',[SupplierController::class,'show']); // menampilkan detil user
    Route::get('/{id}/edit',[SupplierController::class,'edit']);// menampilkan halaman form edit user
    Route::put('/{id}',[SupplierController::class,'update']);// menyimpan perubahan data user 
    Route::delete('/{id}',[SupplierController::class,'destroy']);// menghapus data user 
});

