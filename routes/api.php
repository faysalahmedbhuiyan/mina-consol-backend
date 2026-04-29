<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Frontend)
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'login']);

Route::get('/', function () {
    return response()->json(['status' => 'API working']);
});
Route::apiResource('courses', CourseController::class);
Route::apiResource('products', ProductController::class);

// edit & delete Course
Route::put('courses/{id}', [CourseController::class, 'update']);
Route::delete('courses/{id}', [CourseController::class, 'destroy']);
// edit & Delete Product
Route::put('products/{id}', [ProductController::class, 'update']);
Route::delete('products/{id}', [ProductController::class, 'destroy']);