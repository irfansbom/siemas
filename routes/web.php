<?php

use App\Http\Controllers\AlokasiController;
use App\Http\Controllers\DsbsController;
use App\Http\Controllers\DsrtController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterWilayahController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PclController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RekapController;
use App\Models\Periode;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index']);
Route::get('/privacy', [HomeController::class, 'privacy']);

// Route::get('/', function () {
//     return "Maintenance";
// });
Route::get('mon_users', [MonitoringController::class, 'users']);
Route::get('mon_users/{id}', [MonitoringController::class, 'users_show']);
Route::get('mon_dsrt', [MonitoringController::class, 'dsrt']);
Route::get('mon_dsrt_export_webmon', [MonitoringController::class, 'dsrt_export_webmon']);
Route::get('mon_dsrt/{id}', [MonitoringController::class, 'dsrt_show']);
Route::get('mon_212', [MonitoringController::class, 'mon_212']);

Route::get('list_kec', [MasterWilayahController::class, 'list_kec']);
Route::get('list_desa', [MasterWilayahController::class, 'list_desa']);

Route::middleware(['auth'])->group(function () {
    Route::get('mon_users_export', [MonitoringController::class, 'users_export']);
    Route::get('mon_dsrt_export', [MonitoringController::class, 'dsrt_export']);
    Route::get('mon_dsart_export', [MonitoringController::class, 'dsart_export']);
    Route::get('rekap_pengolahan_per_kab', [RekapController::class, 'index']);

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

    Route::group(['middleware' => ['role:SUPER ADMIN|ADMIN PROVINSI']], function () {
        Route::resource('dsbs', DsbsController::class);
        Route::post('dsbs/import', [DsbsController::class, 'dsbs_import']);
        Route::get('kecamatan', [MasterWilayahController::class, 'kecamatan']);
        Route::get('desa', [MasterWilayahController::class, 'desa']);
        Route::post('webmon_import', [HomeController::class, 'webmon_import']);
    });

    Route::group(['middleware' => ['role:SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT']], function () {
        Route::resource('users', UserController::class);
        Route::post('users/import', [UserController::class, 'user_import']);
        Route::resource('alokasi', AlokasiController::class);
        Route::get('alokasi_export', [AlokasiController::class, 'export']);
        Route::post('alokasi_import', [AlokasiController::class, 'import']);

        Route::resource('dsrt', DsrtController::class);
        Route::post('dsrt_generate', [DsrtController::class, 'dsrt_generate']);
        Route::post('dsrt_import', [DsrtController::class, 'dsrt_import']);
        Route::post('dsrt_swap', [DsrtController::class, 'dsrt_swap']);
        Route::post('dsart_swap', [DsrtController::class, 'dsart_swap']);
    });



    // Route::group(['middleware' => ['role:SUPER ADMIN|PENCACAH']], function () {
    Route::group(['middleware' => ['role:SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT']], function () {
        Route::get('pcl_dashboard', [PclController::class, 'dashboard']);
        Route::get('pcl_pencacahan_dsbs', [PclController::class, 'pcl_pencacahan_dsbs']);
        Route::get('pcl_pencacahan_dsrt/{id}', [PclController::class, 'pcl_pencacahan_dsrt']);
        Route::get('pcl_pencacahan_ruta/{id}', [PclController::class, 'pcl_pencacahan_ruta']);
        Route::post('pcl_pencacahan_ruta/{id}', [PclController::class, 'pcl_pencacahan_ruta_update']);

        // Route::get('pcl_pemeriksaan_dsbs', [PclController::class, 'pcl_pemeriksaan_dsbs']);
        // Route::get('pcl_pemeriksaan_dsrt/{id}', [PclController::class, 'pcl_pemeriksaan_dsrt']);
        // Route::get('pcl_pemeriksaan_ruta/{id}', [PclController::class, 'pcl_pemeriksaan_ruta']);
        // Route::post('pcl_pemeriksaan_ruta/{id}', [PclController::class, 'pcl_pemeriksaan_ruta_update']);
        // Route::post('pcl_pemeriksaan_dsart', [PclController::class, 'pcl_pemeriksaan_dsart_update']);
    });
    // Route::group(['middleware' => ['role:SUPER ADMIN|PENGAWAS']], function () {
    //     Route::get('pml_dashboard', [PclController::class, 'dashboard']);
    // });
});
