<?php

use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ShopController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::post('shop/create', [ShopController::class, 'createShop']);
Route::get('shop/read', [ShopController::class, 'readShop']);
Route::post('shop/update', [ShopController::class, 'updateShop']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('logout', [UserController::class, 'logout']);

    Route::post('transaction/create',[TransactionController::class,'createTransaction']);
    Route::get('transaction/read',[TransactionController::class,'readTransaction']);
    Route::post('transaction/update',[TransactionController::class,'updateTransaction']);
    Route::post('transaction/delete',[TransactionController::class,'deleteTransaction']);

    Route::post('product/create',[ProductController::class,'createProduct']);
    Route::get('product/read',[ProductController::class,'readProduct']);
    Route::post('product/update',[ProductController::class,'updateProduct']);
    Route::post('product/delete',[ProductController::class,'deleteProduct']);

});