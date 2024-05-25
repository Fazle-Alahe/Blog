<?php

use App\Http\Controllers\API\CategoryApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/get/category', [CategoryApiController::class, 'get_category']);
Route::get('/get/product', [CategoryApiController::class, 'get_product']);

Route::post('/registration', [CategoryApiController::class, 'registration']);
Route::post('/viewer/login', [CategoryApiController::class, 'login']);
Route::post('/viewer/logout', [CategoryApiController::class, 'logout']);
