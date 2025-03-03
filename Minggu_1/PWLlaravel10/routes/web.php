<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\WelcomeController;
use Faker\Guesser\Name;

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

Route::get('/', function () { // Menampilkan halaman 'welcome' saat pengguna mengakses root URL 
    return view('welcome');
});

Route::resource('items', ItemController::class);// Menyediakan rute restful untuk resource 'items, dengan itemcontroller

// Route::get('/hello', function(){
//     return 'Hello world';
// });

// Route::get('/world', function(){
//     return 'World';
// });

// Route::get('/welcome', function(){
//     return 'Selamat Datang';
// });

// Route::get('/about', function(){
//     return 'Nama : Daffa NIM : 2341760079';
// });

// Route::get('/user/{name}', function($name){
//     return 'Nama Saya '.$name;
// });

// Route::get('/post/{post}/comments/{comment}', function($postId,$commentId){
//     return 'post ke-'.$postId.' Komentar ke-'.$commentId; 
// });

// Route::get('articles/{id}', function($id){
//     return 'Halaman Artikel dengan ID '.$id;
// });

// route::get('/user/{name?}', function($name=null){
//     return 'Nama saya '.$name;
// });

// route::get('/user/{name?}', function($name='jonh'){
//     return 'Nama saya '. $name;
// });

// route::get('/hello', [WelcomeController::class,'hello']);

// route::get('/',[PageController::class,'index']);
// route::get('/about',[PageController::class,'about']);
// route::get('/articles/{id}',[PageController::class,'articles']);

route::get('/',HomeController::class);
route::get('/about',AboutController::class);
route::get('/articles/{id}',ArticleController::class);

route::resource('photos',PhotoController::class);

route::resource('photos',PhotoController::class)->only([
    'index','show'
]);

route::resource('photos',PhotoController::class)->Except([
    'create','store','update','destroy'
]);

route::get('/greeting', [WelcomeController::class,'greeting']);