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

Route::middleware('auth:sanctum')->group(function() {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('logout', [UserController::class, 'logout']);
    
    Route::post('transactions/create',[TransactionController::class,'createTransaction']);
    Route::post('transactions/update',[TransactionController::class,'updateTransaction']);
    Route::get('transactions/read',[TransactionController::class,'readTransaction']);
    Route::post('transactions/delete',[TransactionController::class,'deleteTransaction']);
    
    Route::post('products/create',[ProductController::class,'createProduct']);
    Route::get('products/read',[ProductController::class,'readProduct']);
    Route::post('products/update',[ProductController::class,'updateProduct']);
    Route::post('products/delete',[ProductController::class,'deleteProduct']);
    
    Route::post('shops/create', [ShopController::class, 'createShop']);
    Route::get('shops/read', [ShopController::class, 'readShop']);
    Route::post('shops/update', [ShopController::class, 'updateShop']);

});