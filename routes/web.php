<?php

use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [RouteController::class, 'index'])->name('view.index');

Route::prefix('auth')->group(function () {
    Route::get('/login', [RouteController::class, 'login'])->name('view.auth.login');
    Route::get('/register', [RouteController::class, 'register'])->name('view.auth.register');
});