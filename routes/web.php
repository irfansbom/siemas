<?php

use App\Http\Controllers\AlokasiController;
use App\Http\Controllers\DsbsController;
use App\Http\Controllers\DsrtController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterWilayahController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\UserController;
use App\Models\Periode;
use Illuminate\Support\Facades\Route;



Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('mon_users', [MonitoringController::class, 'users']);
    Route::get('mon_users/{id}', [MonitoringController::class, 'users_show']);
    Route::get('mon_dsrt', [MonitoringController::class, 'dsrt']);
    Route::get('mon_dsrt_export', [MonitoringController::class, 'dsrt_export']);

    Route::get('mon_dsrt_export_webmon', [MonitoringController::class, 'dsrt_export_webmon']);
    Route::get('mon_dsrt/{id}', [MonitoringController::class, 'dsrt_show']);

    Route::get('mon_212', [MonitoringController::class, 'mon_212']);


    Route::group(['middleware' => ['role:SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT']], function () {
        Route::resource('alokasi', AlokasiController::class);

        Route::post('dsbs/pencacah', [DsbsController::class, 'dsbs_pencacah']);
        Route::get('export_alokasi_dsbs_user', [AlokasiController::class, 'export']);
        Route::post('import_alokasi_dsbs_user', [AlokasiController::class, 'import']);

        Route::resource('dsrt', DsrtController::class);
        Route::post('dsrt_generate', [DsrtController::class, 'dsrt_generate']);
        Route::post('dsrt_import', [DsrtController::class, 'dsrt_import']);
        Route::post('dsrt_swap', [DsrtController::class, 'dsrt_swap']);


        Route::get('users', [UserController::class, 'index']);
        Route::get('users/create', [UserController::class, 'create']);
        Route::post('users/store', [UserController::class, 'store']);
        Route::get('users/{id}', [UserController::class, 'show']);
        Route::post('users/update', [UserController::class, 'update']);
        Route::post('users/delete', [UserController::class, 'delete']);
        Route::post('users/roles', [UserController::class, 'user_roles']);
        Route::post('users/pengawas', [UserController::class, 'user_pengawas']);
        Route::post('users/ubahpassword', [UserController::class, 'ubahpassword']);
        Route::post('users/import', [UserController::class, 'user_import']);
    });

    Route::group(['middleware' => ['role:SUPER ADMIN|ADMIN PROVINSI']], function () {
        Route::resource('dsbs', DsbsController::class);

        Route::post('dsbs/import', [DsbsController::class, 'dsbs_import']);

        Route::get('kecamatan', [MasterWilayahController::class, 'kecamatan']);
        Route::get('desa', [MasterWilayahController::class, 'desa']);
    });

    Route::group(['middleware' => ['role:SUPER ADMIN']], function () {

        Route::get('periode', [Periode::class, 'index']);


        Route::get('roles', [UserController::class, 'roles']);
        Route::post('roles/add', [UserController::class, 'roles_add']);
        Route::post('roles/edit', [UserController::class, 'roles_edit']);
        Route::post('roles/delete', [UserController::class, 'roles_delete']);

        Route::get('permissions', [UserController::class, 'permissions']);
        Route::post('permissions/add', [UserController::class, 'permissions_add']);
        Route::post('permissions/delete', [UserController::class, 'permissions_delete']);
    });
});
