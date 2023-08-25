<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;

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

/*------------------------------------------All Normal Users Routes List--------------------------------------------*/
Route::group(['middleware' => ['auth','user-access:user'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/editprofile', [RegisterController::class, 'editprofile'])->name('editprofile');
    Route::post('/updateprofile', [RegisterController::class, 'updateprofile'])->name('updateprofile');
});  
/*------------------------------------------All Super Admin Routes List--------------------------------------------*/

Route::group(['middleware' => ['auth','user-access:superadmin'], 'prefix' => 'superadmin', 'as' => 'superadmin.'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/editprofile', [RegisterController::class, 'editprofile'])->name('editprofile');
    Route::post('/updateprofile', [RegisterController::class, 'updateprofile'])->name('updateprofile');
});
  
/*------------------------------------------All Admin Routes List--------------------------------------------*/
Route::group(['middleware' => ['auth','user-access:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/editprofile', [RegisterController::class, 'editprofile'])->name('editprofile');
    Route::post('/updateprofile', [RegisterController::class, 'updateprofile'])->name('updateprofile');
});
