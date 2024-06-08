<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ScheduleUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
| Route::get();
| Route::post();
| Route::put();
| Route::delete();
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about-us', [HomeController::class, 'about'])->name('home.about');
Route::get('/category/{cat}', [HomeController::class, 'category'])->name('home.category');
Route::get('/product/{product}', [HomeController::class, 'product'])->name('home.product');
Route::get('/favorite/{product}', [HomeController::class, 'favorite'])->name('home.favorite');


Route::group(['prefix' => 'account'], function() {

    Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
    Route::get('/verify-account/{email}', [AccountController::class, 'verify'])->name('account.verify');
    Route::post('/login', [AccountController::class, 'check_login']);

    Route::get('/register', [AccountController::class, 'register'])->name('account.register');
    Route::get('/favorite', [AccountController::class, 'favorite'])->name('account.favorite');
    Route::post('/register', [AccountController::class, 'check_register']);

    Route::group(['middleware' => 'customer'], function() {
        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::post('/profile', [AccountController::class, 'check_profile']);

        Route::get('/change-password', [AccountController::class, 'change_password'])->name('account.change_password');
        Route::post('/change-password', [AccountController::class, 'check_change_password']);

        Route::get('/schedule', [AccountController::class, 'schedule'])->name('account.schedule');
        Route::get('/schedule/user/{id}', [AccountController::class, 'scheduleUser'])->name('account.schedule.user');
        Route::get('/schedule/user/detail/{id}', [AccountController::class, 'scheduleUserDetail'])->name('account.schedule.user.detail');

        Route::get('/register/schedule/{id}', [AccountController::class, 'registerSchedule'])->name('register.schedule');
    });

    Route::get('/forgot-password', [AccountController::class, 'forgot_password'])->name('account.forgot_password');
    Route::post('/forgot-password', [AccountController::class, 'check_forgot_password']);

    Route::get('/reset-password/{token}', [AccountController::class, 'reset_password'])->name('account.reset_password');
    Route::post('/reset-password/{token}', [AccountController::class, 'check_reset_password']);

});

Route::group(['prefix' => 'cart','middleware' => 'customer'], function() {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/delete/{product}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/clear', [CartController::class, 'clear'])->name('cart.clear');
});


Route::group(['prefix' => 'order','middleware' => 'customer'], function() {

    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('order.checkout');
    Route::get('/history', [CheckoutController::class, 'history'])->name('order.history');
    Route::get('/detail/{order}', [CheckoutController::class, 'detail'])->name('order.detail');
    Route::post('/checkout', [CheckoutController::class, 'post_checkout']);

    Route::get('/verify/{token}', [CheckoutController::class, 'verify'])->name('order.verify');

});


Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'check_login']);

Route::group(['prefix' => 'admin','middleware'=>'auth'], function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/detail/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order/update-status/{order}', [OrderController::class, 'update'])->name('order.update');

    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::get('product-delete-image/{image}', [ProductController::class,'destroyImage'])->name('product.destroyImage');

    Route::group(['prefix' => 'schedule'], function(){
        Route::get('/', [ScheduleController::class, 'index'])->name('schedule.index');
        Route::get('/create', [ScheduleController::class, 'create'])->name('schedule.create');
        Route::post('/create',[ScheduleController::class, 'store']);

        Route::get('/update/{id}',[ScheduleController::class, 'edit'])->name('schedule.update');
        Route::post('/update/{id}',[ScheduleController::class, 'update']);

        Route::delete('/delete/{id}',[ScheduleController::class, 'delete'])->name('schedule.delete');
    });

    Route::group(['prefix' => 'schedule-user'], function(){
        Route::get('/', [ScheduleUserController::class, 'index'])->name('schedule.user.index');

        Route::get('/update/{id}',[ScheduleUserController::class, 'edit'])->name('schedule.user.update');
        Route::post('/update/{id}',[ScheduleUserController::class, 'update']);

        Route::delete('/delete/{id}',[ScheduleUserController::class, 'delete'])->name('schedule.user.delete');
    });
});


