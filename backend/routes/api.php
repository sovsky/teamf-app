<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuthToken;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RatingController;
use App\Http\Middleware\VerifyTokenMiddleware;
use App\Http\Controllers\API\AidTypeController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AdminStatsController;
use App\Http\Controllers\API\AidCategoryController;
use App\Http\Controllers\API\VoivodeshipController;
use App\Http\Controllers\API\ProductCategoryController;

// Pathways that do not require authorization
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Pathways that do require authorization - admin + logout
Route::middleware(['auth:sanctum'])->group(function () {
  Route::post('/logout', [UserController::class, 'logout']);
  //admin routes
  Route::middleware('admin')->group(function () {
    Route::get('/admin/users-by-age', [AdminStatsController::class, 'getUsersByAge']);
    Route::get('/admin/volunteer-count', [AdminStatsController::class, 'getVolunteerCount']);
    Route::get('/admin/deprived-person-count', [AdminStatsController::class, 'getDeprivedPersonCount']);
    Route::get('/admin/deprived-person-count', [AdminStatsController::class, 'getDeprivedPersonCount']);
    Route::post('/admin/create', [AdminStatsController::class, 'createAdmin']);
    Route::delete('/admin/delete-user/{id}', [AdminStatsController::class, 'deleteUser']);
    Route::delete('/admin/delete-comment/{id}', [AdminStatsController::class, 'deleteComment']);
  });
});


Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');


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

  #Ratings
  Route::apiResource('ratings', RatingController::class);
});
