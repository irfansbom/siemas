<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DsbsApiController;
use App\Http\Controllers\API\DsbsController;
use App\Http\Controllers\API\DsrtApiController;
use App\Http\Controllers\API\DsrtController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login_android', [AuthController::class, 'login_android']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout_android', [AuthController::class, 'logout_android']);
    Route::POST('/get_alokasi_dsbs_pcl', [DsbsApiController::class, 'get_alokasi_dsbs_pcl']);
    Route::POST('/get_alokasi_dsbs_pml', [DsbsApiController::class, 'get_alokasi_dsbs_pml']);
    Route::POST('/get_alokasi_dsrt_pcl', [DsrtApiController::class, 'get_alokasi_dsrt_pcl']);
    Route::POST('/get_alokasi_dsrt_pml', [DsrtApiController::class, 'get_alokasi_dsrt_pml']);
    Route::POST('/update_dsrt', [DsrtApiController::class, 'update_dsrt']);
    Route::POST('/upload_foto', [DsrtApiController::class, 'upload_foto']);
    Route::POST('/upload_data', [DsrtApiController::class, 'upload_data']);
    Route::POST('/get_jadwal', [DsrtApiController::class, 'get_jadwal']);
    Route::POST('/insert_laporan', [DsrtApiController::class, 'insert_laporan']);
    Route::POST('/get_laporan', [DsrtApiController::class, 'get_laporan']);
});
