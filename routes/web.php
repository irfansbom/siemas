<?php

use App\Http\Controllers\DsbsController;
use App\Http\Controllers\DsrtController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterWilayahController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);


    Route::get('users', [UserController::class, 'index']);
    Route::get('users/create', [UserController::class, 'create']);
    Route::post('users/store', [UserController::class, 'store']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('users/update', [UserController::class, 'update']);
    Route::post('users/delete', [UserController::class, 'delete']);
    Route::post('/users/roles', [UserController::class, 'user_roles']);
    Route::post('/users/pengawas', [UserController::class, 'user_pengawas']);
    Route::post('/users/ubahpassword', [UserController::class, 'ubahpassword']);
    Route::post('/users/import', [UserController::class, 'user_import']);

    Route::group(['middleware' => ['role:SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT']], function () {
        Route::resource('dsrt', DsrtController::class);
        Route::post('dsrt/generate', [DsrtController::class, 'dsrt_generate']);
        Route::post('dsrt/import', [DsrtController::class, 'dsrt_import']);

        Route::resource('dsbs', DsbsController::class);
        Route::post('dsbs/pencacah', [DsbsController::class, 'dsbs_pencacah']);
        Route::post('dsbs/import', [DsbsController::class, 'dsbs_import']);


        Route::get('kecamatan', [MasterWilayahController::class, 'kecamatan']);
        Route::get('desa', [MasterWilayahController::class, 'desa']);
    });

    Route::group(['middleware' => ['role:SUPER ADMIN']], function () {
        Route::get('roles', [UserController::class, 'roles']);
        Route::post('roles/add', [UserController::class, 'roles_add']);
        Route::post('roles/edit', [UserController::class, 'roles_edit']);
        Route::post('roles/delete', [UserController::class, 'roles_delete']);

        Route::get('permissions', [UserController::class, 'permissions']);
        Route::post('permissions/add', [UserController::class, 'permissions_add']);
        Route::post('permissions/delete', [UserController::class, 'permissions_delete']);
    });
});
