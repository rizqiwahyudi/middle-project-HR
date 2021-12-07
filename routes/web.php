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

Route::group(['middleware' => ['auth']], function() {
        Route::get('/checkRole', [App\Http\Controllers\HomeController::class, 'checkRole'])
                ->name('checkRole');
});

Route::group(['middleware' => ['auth', 'Role:admin']], function(){

    Route::get('/admin',                    [App\Http\Controllers\UserController::class, 'index'])
            ->name('dashboard.admin');
    Route::get('/admin/create-user/',       [App\Http\Controllers\UserController::class, 'create'])
            ->name('create.user');
    Route::post('/admin/create-user/',      [App\Http\Controllers\UserController::class, 'store'])
            ->name('store.user');
    Route::get('/admin/deleted-users/',     [App\Http\Controllers\UserController::class, 'getDeletedUsers'])
            ->name('getDeletedUsers');
    Route::get('/admin/deleted-users/delete-all/', 
                                            [App\Http\Controllers\UserController::class, 'deleteAll'])
            ->name('deleteAll.users');
    Route::get('/admin/deleted-users/restore-all/', 
                                            [App\Http\Controllers\UserController::class, 'restoreAll'])
            ->name('restoreAll.users');
    Route::get('/admin/show-user/{user}',   [App\Http\Controllers\UserController::class, 'show'])
            ->name('show.user');
    Route::get('/admin/edit-user/{user}',   [App\Http\Controllers\UserController::class, 'edit'])
            ->name('edit.user');
    Route::put('/admin/edit-user/{user}',   [App\Http\Controllers\UserController::class, 'update'])
            ->name('update.user');
    Route::delete('/admin/delete-user/{user}', [App\Http\Controllers\UserController::class, 'destroy'])
            ->name('user.delete');
    Route::get('/admin/deleted-users/delete/{id}', 
                                            [App\Http\Controllers\UserController::class, 'deletePermanent'])
            ->name('deletePermanent.user');
    Route::get('/admin/deleted-users/restore/{id}', 
                                            [App\Http\Controllers\UserController::class, 'restore'])
            ->name('restore.user');


    Route::get('/admin/departments/deleted-departments/', 
                                    [App\Http\Controllers\DepartmentController::class, 'getDeletedDepartments'])
            ->name('getDeletedDepartments');
    Route::get('/admin/departments/deleted-departments/delete-all/', 
                                    [App\Http\Controllers\DepartmentController::class, 'deleteAll'])
            ->name('deleteAll.departments');
    Route::get('/admin/departments/deleted-departments/restore-all/', 
                                    [App\Http\Controllers\DepartmentController::class, 'restoreAll'])
            ->name('restoreAll.departments');

    Route::resource('/admin/departments',   App\Http\Controllers\DepartmentController::class);

    Route::get('/admin/departments/deleted-departments/delete/{id}', 
                                    [App\Http\Controllers\DepartmentController::class, 'deletePermanent'])
            ->name('deletePermanent.department');
    Route::get('/admin/departments/deleted-departments/restore/{id}', 
                                    [App\Http\Controllers\DepartmentController::class, 'restore'])
            ->name('restore.department');


    Route::get('/admin/companies/deleted-companies/', 
                                    [App\Http\Controllers\CompanyController::class, 'getDeletedCompanies'])
            ->name('getDeletedCompanies');
    Route::get('/admin/companies/deleted-companies/delete-all/', 
                                    [App\Http\Controllers\CompanyController::class, 'deleteAll'])
            ->name('deleteAll.companies');
    Route::get('/admin/companies/deleted-companies/restore-all/', 
                                    [App\Http\Controllers\CompanyController::class, 'restoreAll'])
            ->name('restoreAll.companies');

    Route::resource('/admin/companies',     App\Http\Controllers\CompanyController::class);

    Route::get('/admin/companies/deleted-companies/delete/{id}', 
                                    [App\Http\Controllers\CompanyController::class, 'deletePermanent'])
            ->name('deletePermanent.company');
    Route::get('/admin/companies/deleted-companies/restore/{id}', 
                                    [App\Http\Controllers\CompanyController::class, 'restore'])
            ->name('restore.company');

});


Route::group(['middleware' => ['auth', 'Role:user']], function(){

    Route::get('/user', function() {
            return view('user.index');
    })->name('dashboard.user');

});