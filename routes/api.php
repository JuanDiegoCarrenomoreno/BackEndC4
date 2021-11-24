<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EstudianteApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\CursoApiController;
use App\Http\Controllers\Api\ResidentesApiController;
use App\Http\Controllers\Api\TrabajadorApiController;
use App\Http\Controllers\Api\EventoApiController;


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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//Route::apiResource('estudiante',EstudianteApiController::class)->middleware('auth:api');

Route::post('/registro', [UserApiController::class,'registro']);
Route::post('/login', [UserApiController::class,'login']);

Route::apiResource('curso',CursoApiController::class);

Route::apiResource('residentes',ResidentesApiController::class);
Route::apiResource('trabajador',TrabajadorApiController::class);
Route::apiResource('evento',EventoApiController::class);

Route::middleware('auth:api')->group(function () { 
    Route::apiResource('estudiante',EstudianteApiController::class);
    //Route::apiResource('curso',EstudianteApiController::class);
});


