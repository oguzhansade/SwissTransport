<?php

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

Route::post('/schnellanform', [App\Http\Controllers\front\customerForms\indexController::class, 'handleSchnellanForm'])->name('handleSchnellanForm');
Route::post('/firmenform', [App\Http\Controllers\front\customerForms\indexController::class, 'handleFirmenForm'])->name('handleFirmenForm');
Route::post('/privatform', [App\Http\Controllers\front\customerForms\indexController::class, 'handlePrivatForm'])->name('handlePrivatForm');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
