<?php

use App\Models\People;
use App\Models\Product;
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

Route::get('/', function () {
    $products = Product::where('user_id', 1)->get();
    $peoples = People::where('user_id', 1)->get();

    return view('index', compact(['products', 'peoples']));
})->name('index');

Route::prefix('auth')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('auth.login.view');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('auth.register.view');
});