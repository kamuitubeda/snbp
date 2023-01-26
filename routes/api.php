<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\DayaTampungController;

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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
     
Route::middleware('auth:api')->group(function () {
    Route::resource('dayatampungs', DayaTampungController::class);

    Route::get('dayatampungs/jurusan/{kode}', [DayaTampungController::class, 'getAllByJurusan']);
    Route::get('dayatampungs/kampus/{kode}/tahun/{tahun}', [DayaTampungController::class, 'getAllByKampusAndTahun']);
    Route::get('dayatampungs/namajurusan/{nama}', [DayaTampungController::class, 'getAllByNamaJurusan']);
    Route::get('dayatampungs/namajurusan/{nama}/tahun/{tahun}', [DayaTampungController::class, 'getAllByNamaJurusanAndTahun']);
});
