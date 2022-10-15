<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use\App\Http\Controllers\CategoryController;
use\App\Http\Controllers\ProductController;
use\App\Http\Controllers\CourseController;
use\App\Http\Controllers\CartController;
use\App\Http\Controllers\CheckoutController;
use\App\Http\Controllers\OrderController;
use\App\Http\Controllers\SearchController;
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
Route::get('slug/{slug}', [ProductController::class, 'slug']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('view-cart', [CartController::class, 'index']);


Route::middleware(['auth:sanctum', 'isapiadmin'])->group(function () {
  
    Route::get('/checkingAuth', function () {
        return response()-> json([
            'status' => 200,
            'mes'  =>'success'
        ]);
});

Route::get('view-category', [CategoryController::class, 'index']);
Route::post('add-category', [CategoryController::class, 'create']);
Route::get('edit-category/{id}', [CategoryController::class, 'edit']);
Route::post('edit-category/{id}', [CategoryController::class, 'update']);
Route::post('delete-category/{id}', [CategoryController::class, 'delete']);

//Route::post('add-course', [CourseController::class, 'store']);

Route::get('view-product', [ProductController::class, 'index']);
Route::post('add-product', [ProductController::class, 'store']);
Route::get('edit-product/{id}', [ProductController::class, 'edit']);
Route::post('edit-product/{id}', [ProductController::class, 'update']);
Route::post('delete-product/{id}', [ProductController::class, 'delete']);
Route::get('product-qty', [ProductController::class, 'productQty']);

Route::get('view-orders', [OrderController::class, 'index']);
Route::get('detail/{id}', [OrderController::class, 'detail']);
Route::put('updatestatus/{id}', [OrderController::class, 'update']);
Route::post('view-orders-history/{date}', [OrderController::class, 'history']);
});



Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('add-to-cart', [CartController::class, 'create']);
    Route::post('delete-item/{id}', [CartController::class, 'delete']);
    
    Route::put('cart-updatequantity/{card_id}/{scope}', [CartController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('checkout', [CheckoutController::class, 'placeorder']);
    Route::post('search', [SearchController::class, 'search']);

 
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});