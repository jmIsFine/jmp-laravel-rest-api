<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('person', [PersonController::class, 'index']);
Route::post('person', [PersonController::class, 'store']);
Route::get('person/{id}', [PersonController::class, 'show']);
Route::get('person/{id}/edit', [PersonController::class, 'edit']);
Route::put('person/{id}/edit', [PersonController::class, 'update']);
Route::delete('person/{id}/delete', [PersonController::class, 'destroy']);
