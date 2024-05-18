<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;


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

Route::get('/', [HomeController::class,'index'])->name('home.index');
Route::get('/about-us', [HomeController::class,'about'])->name('home.about');

Route::GROUP(['prefix' =>'account'], function() {
    Route::get('/login', [AccountController::class,'login'])->name('account.login');
    Route::get('/verify-account/{email}', [AccountController::class, 'verify'])->name('account.verify');
    Route::post('/login', [AccountController::class,'check_login']);

    Route::get('/register', [AccountController::class,'register'])->name('account.register');
    Route::post('/register', [AccountController::class,'check_register']);

    Route::get('/profile', [AccountController::class,'profile'])->name('account.profile');
    Route::post('/register', [AccountController::class, 'check_register']);

    Route::get('/change-password', [AccountController::class,'change-password'])->name('account.change-password');
    Route::post('/change-password', [AccountController::class,'check_change-password']);

    Route::get('/forgot-password', [AccountController::class,'change-password'])->name('account.change-password');
    Route::post('/forgot-password', [AccountController::class,'check_change-password']);

    Route::get('/reset-password', [AccountController::class,'check_reset-password'])->name('account.reset-password');
    Route::post('/reset-password', [AccountController::class,'check_reset-password']);
});

