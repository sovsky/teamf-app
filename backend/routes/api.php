<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuthToken;
use App\Http\Controllers\API\AidController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\MatchController;
use App\Http\Controllers\API\RatingController;
use App\Http\Middleware\VerifyTokenMiddleware;
use App\Http\Controllers\API\AidTypeController;
use App\Http\Controllers\API\CommuneController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\DistrictController;
use App\Http\Controllers\API\AdminStatsController;
use App\Http\Controllers\API\AidCategoryController;
use App\Http\Controllers\API\UserProductController;
use App\Http\Controllers\API\VoivodeshipController;
use App\Http\Controllers\API\ProductCategoryController;

// Pathways that do not require authorization
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/products', [ProductController::class, 'getProducts']);
Route::get('/aid-types', [AidTypeController::class, 'getAidTypes']);
Route::get('/product-categories', [ProductCategoryController::class, 'getProductCategories']);
Route::get('/aid-categories', [AidCategoryController::class, 'getAidCategories']);
Route::post('/aid', [AidController::class, 'store']);
Route::get('/user/{id}/aid-info', [AidController::class, 'getAidInfoByUserId']);

Route::get('/voivodeships', [VoivodeshipController::class, 'getVoivodeships']);
Route::get('/voivodeships/{id}', [VoivodeshipController::class, 'getVoivodeshipById']);
Route::get('/voivodeships/{id}/districts', [DistrictController::class, 'getDistrictsByVoivodeship']);

Route::get('/districts', [CommuneController::class, 'getDistricts']);
Route::get('/districts/{id}', [DistrictController::class, 'getDistrictById']);
Route::get('/districts/{id}/communes', [CommuneController::class, 'getCommunesByDistrict']);

Route::get('/communes', [CommuneController::class, 'getCommunes']);
Route::get('/communes/{id}', [CommuneController::class, 'getCommuneById']);
Route::get('/communes/{id}/cities', [CityController::class, 'getCitiesByCommune']);

Route::get('/cities', [CityController::class, 'getCities']);
Route::get('/cities/{id}', [CityController::class, 'getCityById']);
Route::get('/all-cities/{cityName}', [CityController::class, 'search']);

// Pathways that require authorization
Route::middleware(['auth:sanctum'])->group(function () {
  Route::get('/user', function (Request $request) {
    return $request->user();
  });
  Route::post('/logout', [UserController::class, 'logout']);

  Route::middleware('admin')->group(function () {
    Route::get('/admin/users-by-age', [AdminStatsController::class, 'getUsersByAge']);
    Route::get('/admin/volunteer-count', [AdminStatsController::class, 'getVolunteerCount']);
    Route::get('/admin/deprived-person-count', [AdminStatsController::class, 'getDeprivedPersonCount']);
    Route::get('/admin/deprived-person-count', [AdminStatsController::class, 'getDeprivedPersonCount']);
    Route::post('/admin/create', [AdminStatsController::class, 'createAdmin']);
    Route::delete('/admin/delete-user/{id}', [AdminStatsController::class, 'deleteUser']);
    Route::delete('/admin/delete-comment/{id}', [AdminStatsController::class, 'deleteComment']);
    Route::get('/admin/role/{roleName}', [AdminStatsController::class, 'getUsersByRole']);
  });
  
  Route::get('/matching-users', [MatchController::class, 'findMatchingUsers']);

  Route::get('/products/{id}', [ProductController::class, 'getProductById']);
  Route::post('/products/create', [ProductController::class, 'createProduct']);
  Route::patch('/products/{id}/update', [ProductController::class, 'updateProductById']);
  Route::delete('/products/{id}/delete', [ProductController::class, 'deleteProductById']);

  Route::get('/aid-types/{id}', [AidTypeController::class, 'getAidTypeById']);
  Route::post('/aid-types/create', [AidTypeController::class, 'createAidType']);
  Route::patch('/aid-types/{id}/update', [AidTypeController::class, 'updateAidTypeById']);
  Route::delete('/aid-types/{id}/delete', [AidTypeController::class, 'deleteAidTypeById']);

  Route::get('/product-categories/{id}', [ProductCategoryController::class, 'getProductCategoryById']);
  Route::post('/product-categories/create', [ProductCategoryController::class, 'createProductCategory']);
  Route::patch('/product-categories/{id}/update', [ProductCategoryController::class, 'updateProductCategoryById']);
  Route::delete('/product-categories/{id}/delete', [ProductCategoryController::class, 'deleteProductCategoryById']);

  Route::get('/aid-categories/{id}', [AidCategoryController::class, 'getAidCategoryById']);
  Route::post('/aid-categories/create', [AidCategoryController::class, 'createAidCategory']);
  Route::patch('/aid-categories/{id}/update', [AidCategoryController::class, 'updateAidCategoryById']);
  Route::delete('/aid-categories/{id}/delete', [AidCategoryController::class, 'deleteAidCategoryById']);

  Route::apiResource('ratings', RatingController::class);
});

Route::middleware('verify.token')->group(function () {
  Route::get('/verifiedToken', [UserController::class, 'verifiedToken']);
  Route::get('/verifiedAdminToken', [AdminStatsController::class, 'verifiedToken']);
});

