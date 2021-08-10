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

    Route::get('/admin',                    [App\Http\Controllers\UserController::class, 'index'])
            ->name('dashboard.admin');
    Route::get('/admin/create-user/',       [App\Http\Controllers\UserController::class, 'create'])
            ->name('create.user');
    Route::post('/admin/create-user/',      [App\Http\Controllers\UserController::class, 'store'])
            ->name('store.user');
    Route::get('/admin/show-user/{user}',   [App\Http\Controllers\UserController::class, 'show'])
            ->name('show.user');
    Route::get('/admin/edit-user/{user}',   [App\Http\Controllers\UserController::class, 'edit'])
            ->name('edit.user');
    Route::put('/admin/edit-user/{user}',   [App\Http\Controllers\UserController::class, 'update'])
            ->name('update.user');
    Route::get('/admin/delete-user/{user}', [App\Http\Controllers\UserController::class, 'destroy'])
            ->name('user.delete');


    Route::resource('/admin/departments',   App\Http\Controllers\DepartmentController::class);

    Route::resource('/admin/companies',     App\Http\Controllers\CompanyController::class);

});


Route::group(['middleware' => ['auth', 'Role:user']], function(){

    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])
            ->name('dashboard.user');

});