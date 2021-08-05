<?php

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


Route::group(['middleware' => ['auth', 'Role:admin']], function(){

Route::get('/dashboard/admin', [App\Http\Controllers\UserController::class, 'index'])->name('dashboard.admin');

});


Route::group(['middleware' => ['auth', 'Role:user']], function(){

Route::get('/dashboard/user', [App\Http\Controllers\UserController::class, 'index'])->name('dashboard.user');

});