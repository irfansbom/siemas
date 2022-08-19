<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DsbsController;
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
    Route::POST('/get_dsbs_pcl', [DsbsController::class, 'get_dsbs_pcl']);
    Route::POST('/get_dsbs_pml', [DsbsController::class, 'get_dsbs_pml']);
    Route::POST('/get_dsrt_pcl', [DsrtController::class, 'get_dsrt_pcl']);
    Route::POST('/get_dsrt_pml', [DsrtController::class, 'get_dsrt_pml']);

});