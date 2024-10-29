<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use \App\Http\Controllers\API\AidTypeController;
use \App\Http\Controllers\API\ProductCategoryController;
use \App\Http\Controllers\API\AidCategoryController;
use App\Http\Controllers\API\VoivodeshipController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['api'])->group(function () {
    # User
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [RegisterController::class, 'login']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    # Product
    Route::get('/products', [ProductController::class, 'getProducts']);
    Route::get('/products/{id}', [ProductController::class, 'getProductById']);
    Route::post('/products/create', [ProductController::class, 'createProduct']);
    Route::patch('/products/{id}/update', [ProductController::class, 'updateProductById']);
    Route::delete('/products/{id}/delete', [ProductController::class, 'deleteProductById']);

    # Aid type
    Route::get('/aid-types', [AidTypeController::class, 'getAidTypes']);
    Route::get('/aid-types/{id}', [AidTypeController::class, 'getAidTypeById']);
    Route::post('/aid-types/create', [AidTypeController::class, 'createAidType']);
    Route::patch('/aid-types/{id}/update', [AidTypeController::class, 'updateAidTypeById']);
    Route::delete('/aid-types/{id}/delete', [AidTypeController::class, 'deleteAidTypeById']);

    # Product category
    Route::get('/product-categories', [ProductCategoryController::class, 'getProductCategories']);
    Route::get('/product-categories/{id}', [ProductCategoryController::class, 'getProductCategoryById']);
    Route::post('/product-categories/create', [ProductCategoryController::class, 'createProductCategory']);
    Route::patch('/product-categories/{id}/update', [ProductCategoryController::class, 'updateProductCategoryById']);
    Route::delete('/product-categories/{id}/delete', [ProductCategoryController::class, 'deleteProductCategoryById']);

    # Aid category
    Route::get('/aid-categories', [AidCategoryController::class, 'getAidCategories']);
    Route::get('/aid-categories/{id}', [AidCategoryController::class, 'getAidCategoryById']);
    Route::post('/aid-categories/create', [AidCategoryController::class, 'createAidCategory']);
    Route::patch('/aid-categories/{id}/update', [AidCategoryController::class, 'updateAidCategoryById']);
    Route::delete('/aid-categories/{id}/delete', [AidCategoryController::class, 'deleteAidCategoryById']);
});
