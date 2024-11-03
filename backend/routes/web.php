<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AidTypeController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AidCategoryController;
use App\Http\Controllers\API\ProductCategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sanctum/csrf-cookie', function (Request $request) {
    return response()->json(['message' => 'CSRF cookie set']);
});
