<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Sale\SaleController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Category\CategoryController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// }

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/auth/logout', [AuthController::class,'logout']);



    Route::get('/categories', [CategoryController::class,'index']);

    Route::post('/categories', [CategoryController::class,'store']);
    Route::get('/categories/{term}', [CategoryController::class,'show']);
    Route::put('/categories/{term}', [CategoryController::class,'update']);
    Route::delete('/categories/{term}', [CategoryController::class,'destroy']);


    Route::apiResource('/products', ProductController::class);

    Route::apiResource('/sales', SaleController::class)
        ->only(['index','store','show']);


});

Route::post('/auth/register', [AuthController::class,'register']);
Route::post('/auth/login', [AuthController::class,'login']);
