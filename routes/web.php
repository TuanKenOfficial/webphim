<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Index;
// admin 
use App\Http\Controllers\theloaiController;
use App\Http\Controllers\tapController;
use App\Http\Controllers\quocgiaController;
use App\Http\Controllers\phimController;
use App\Http\Controllers\danhmucController;



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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [Index::class, 'index']);

Route::get('/chi-tiet/{slug}', [Index::class, 'chitiet'])->name('chitiet');
Route::get('/danh-muc/{slug}', [Index::class, 'danhmuc'])->name('danhmuc');
Route::get('/the-loai/{slug}', [Index::class, 'theloai'])->name('theloai');
Route::get('/quoc-gia/{slug}', [Index::class, 'quocgia'])->name('quocgia');
Route::get('/xem-phim/{slug}', [Index::class, 'xemphim'])->name('xemphim');




Route::get('/nam/{year}', [Index::class, 'nam']);
Route::get('/tag/{value}', [Index::class, 'tag']);
Route::get('/update-year', [phimController::class, 'update_year']);
Route::get('/update-view', [phimController::class, 'update_view']);
Route::get('/update-session', [phimController::class, 'update_session']);
Route::post('/filter-sidebar', [Index::class, 'filter_sidebar']);
Route::get('/filter-sidebar-default', [Index::class, 'filter_sidebar_default']);
Route::get('/tim-kiem', [Index::class, 'tim_kiem'])->name('timkiem');
Route::get('/select-movie', [Index::class, 'select_movie']);
Route::get('/filter', [Index::class, 'filter'])->name('filter');
Route::post('/add-rating', [Index::class, 'add_rating'])->name('add-rating');




Route::get('/tap', [Index::class, 'tap'])->name('tap');

// route admin
Route::resource('category', danhmucController::class);
Route::resource('genre', theloaiController::class);
Route::resource('country', quocgiaController::class);
Route::resource('movie', phimController::class);
Route::resource('episode', tapController::class);