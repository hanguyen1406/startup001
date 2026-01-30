<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\OrderController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\TravelController::class, 'home'])->name('home');
Route::prefix('detail')->name('service.')->group(function () {
    Route::get('{type}', [App\Http\Controllers\ServiceController::class, 'index'])->name('all');
    Route::get('{type}/{id}', [App\Http\Controllers\ServiceController::class, 'detail'])->name('detail');
    // Route::post('{type}/{id}', [App\Http\Controllers\ServiceController::class, 'order'])->name('order');

});
Route::get('/ticket', [App\Http\Controllers\TravelController::class, 'detail'])->name('detail');
Route::get('/order', [App\Http\Controllers\TravelController::class, 'order'])->name('order');
Route::post('/order', [App\Http\Controllers\TravelController::class, 'storeOrder'])->name('order.store');

Route::get('/updateLogin', [App\Http\Controllers\TravelController::class, 'updateLogin'])->name('updateLogin');
Route::get('/forget', [App\Http\Controllers\TravelController::class, 'forget'])->name('forget');
Route::get('/reset', [App\Http\Controllers\TravelController::class, 'reset'])->name('reset');
Route::get('/history', [App\Http\Controllers\TravelController::class, 'history'])->name('history');
Route::get('/ticketbooked', [App\Http\Controllers\TravelController::class, 'ticketbooked'])->name('ticketbooked');




// Đăng nhập & đăng ký
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

//lien he
Route::get('kontak-kami', [App\Http\Controllers\TravelController::class, 'contact'])->name('contact');
Route::post('kontak-kami', [App\Http\Controllers\TravelController::class, 'getEmail'])->name('contact.email');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [App\Http\Controllers\TravelController::class, 'profile'])->name('profile');
    Route::get('/payment/{id}', [App\Http\Controllers\TravelController::class, 'payment'])->name('payment');

});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('usermanager', [App\Http\Controllers\Admin\DashboardController::class, 'usermanager'])->name('usermanager');
        Route::get('usermanager/{id}/edit', [App\Http\Controllers\Admin\DashboardController::class, 'editUser'])->name('usermanager.edit');
        Route::put('usermanager/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'updateUser'])->name('usermanager.update');
        Route::delete('usermanager/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'destroyUser'])->name('usermanager.destroy');

        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('travel-packages', \App\Http\Controllers\Admin\TravelPackageController::class);
        Route::resource('travel-packages.galleries', \App\Http\Controllers\Admin\GalleryController::class);
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/admin/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update_status');
    });

});