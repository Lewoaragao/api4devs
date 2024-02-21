<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RouteController;
use App\Http\Middleware\ExceptionHandlerMiddleware;
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

// HELLO WORLD
Route::get('/hello', [RouteController::class, 'helloWorld']);

// TEST
// Route::prefix('test')->group(function () {
//     Route::get('/{id}', [ProductController::class, 'show']);
// });

// AUTH
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
});

// PUBLIC
Route::get('/products', [ProductController::class, 'index']);

// PRODUCT
Route::middleware(['auth:api'])->group(function () {
    Route::resource('product', ProductController::class);
    Route::resource('people', PeopleController::class);
});