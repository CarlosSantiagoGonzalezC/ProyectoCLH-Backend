<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
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

//Route::middleware('auth:sanctum')->group(function () {
    // ----------- RUTAS CRUD USERS ----------------
    Route::controller(UserController::class)->group(function () {
        Route::delete('user/delete', 'delete');
        Route::get('user/read', 'read');
        Route::patch('user/update', 'update');
    });

    // ----------- RUTAS CRUD SELLERS ----------------
    Route::controller(SellerController::class)->group(function () {
        Route::delete('seller/delete', 'delete');
        Route::get('seller/read', 'read');
        Route::patch('seller/update', 'update');
    });

    // ----------- RUTAS CRUD COMPANIES ----------------
    Route::controller(CompanyController::class)->group(function () {
        Route::post('company/create', 'create');
        Route::delete('company/delete', 'delete');
        Route::get('company/read', 'read');
        Route::patch('company/update', 'update');
    });

    // ----------- RUTAS CRUD COMMENTS ----------------
    Route::controller(CommentController::class)->group(function () {
        Route::post('comment/create', 'create');
        Route::delete('comment/delete', 'delete');
        Route::get('comment/read', 'read');
        Route::patch('comment/update', 'update');
    });

    // ----------- RUTAS CRUD PRODUCTS ----------------
    Route::controller(ProductController::class)->group(function () {
        Route::post('product/create', 'create');
        Route::delete('product/delete', 'delete');
        Route::get('product/read', 'read');
        Route::patch('product/update', 'update');
    });

    // ----------- RUTAS CRUD CATEGORIES ----------------
    Route::controller(CategoryController::class)->group(function () {
        Route::get('category', 'getProductsOfCategory');
        Route::post('category/create', 'create');
        Route::delete('category/delete', 'delete');
        Route::get('category/read', 'read');
        Route::patch('category/update', 'update');
    });
//});

// ----------- RUTA LOGIN ----------------
Route::post('auth', [AuthController::class, 'login']);

// ----------- RUTAS CREATE Y READ USERS SIN INICIAR SESION  ----------------
Route::controller(UserController::class)->group(function () {
    Route::post('user/create', 'create');
    Route::get('user', 'read');
});

// ----------- RUTA READ PRODUCTS SIN INICIAR SESION ----------------
Route::get('/', ProductController::class);

// ----------- RUTA CREATE SELLERS SIN INICIAR SESION ----------------
Route::post('seller/create', [SellerController::class, 'create']);