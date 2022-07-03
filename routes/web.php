<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function(){
    Route::view('login', 'auth.login')->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::view('register', 'auth.register')->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('book.section', SectionController::class);
    Route::resource('book', BookController::class);

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update']);

    Route::view('logout', 'auth.logout')->name('logout');
    Route::post('logout', [AuthController::class, 'logout']);
});
