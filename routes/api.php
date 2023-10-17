<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // ----------- RUTAS CRUD USERS ----------------
    Route::controller(UserController::class)->group(function () {
        Route::delete('user/delete', 'delete');
        Route::get('user/read', 'read');
        Route::patch('user/update', 'update');
        Route::patch('user/editPassword', 'editPassword');
    });

    // ----------- RUTAS CRUD SELLERS ----------------
    Route::controller(SellerController::class)->group(function () {
        Route::delete('seller/delete', 'delete');
        Route::get('seller/read', 'read');
        Route::patch('seller/update', 'update');
        Route::get('seller', 'getSellerIdUser');
    });

    // ----------- RUTAS CRUD COMPANIES ----------------
    Route::controller(CompanyController::class)->group(function () {
        Route::post('company/create', 'create');
        Route::delete('company/delete', 'delete');
        Route::get('company/read', 'read');
        Route::patch('company/update', 'update');
        Route::get('company', 'getCompanyIdSeller');
    });

    // ----------- RUTAS CRUD COMMENTS ----------------
    Route::controller(CommentController::class)->group(function () {
        Route::post('comment/create', 'create');
        Route::delete('comment/delete', 'delete');
        Route::get('comment/read', 'read');
        Route::patch('comment/update', 'update');
        Route::get('comment', 'getCommentsProduct');
    });

    // ----------- RUTAS CRUD PRODUCTS ----------------
    Route::controller(ProductController::class)->group(function () {
        Route::post('product/create', 'create');
        Route::delete('product/delete', 'delete');
        Route::patch('product/update', 'update');
        Route::get('product', 'getProductsSeller');
    });

    // ----------- RUTAS CRUD CATEGORIES ----------------
    Route::controller(CategoryController::class)->group(function () {
        Route::post('category/create', 'create');
        Route::delete('category/delete', 'delete');
        Route::patch('category/update', 'update');
   });

   Route::controller(PurchaseController::class)->group(function () {
        Route::post('purchase/create', 'create');
        // Route::delete('purchase/delete', 'delete');
        // Route::get('purchase/read', 'read');
        // Route::patch('purchase/update', 'update');
   });

   Route::controller(OrderController::class)->group(function () {
    Route::post('order/create', 'create');
    Route::delete('order/delete', 'delete');
    Route::get('order/read', 'read');
    Route::patch('order/update', 'update');
});
});

// ----------- RUTA LOGIN ----------------
Route::post('auth', [AuthController::class, 'login']);

// ----------- RUTAS CREATE Y READ USERS SIN INICIAR SESION  ----------------
Route::controller(UserController::class)->group(function () {
    Route::post('user/create', 'create');
    Route::get('user', 'read');
    Route::patch('user/recoverPassword', 'recoverPassword');
});

// ----------- RUTA PRODUCTS SIN INICIAR SESION ----------------
Route::controller(ProductController::class)->group(function () {
    Route::get('product/read', 'read');
    Route::get('/');
});

// ----------- RUTAS CATEGORIES SIN INICIAR SESION ----------------
Route::controller(CategoryController::class)->group(function () {
    Route::get('category', 'getProductsOfCategory');
    Route::get('category/read', 'read');
});

// ----------- RUTA CREATE SELLERS SIN INICIAR SESION ----------------
Route::post('seller/create', [SellerController::class, 'create']);
