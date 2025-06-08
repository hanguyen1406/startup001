<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::get('paket-travel', [App\Http\Controllers\TravelController::class, 'package'])->name('package');
Route::get('detail/{travelPackage:slug}', [App\Http\Controllers\TravelController::class, 'detail'])->name('detail');
Route::post('detail/{travelPackage:slug}', [App\Http\Controllers\TravelController::class, 'order'])->name('order');

// Đăng nhập & đăng ký
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

//lien he
Route::get('kontak-kami', [App\Http\Controllers\TravelController::class, 'contact'])->name('contact');
Route::post('kontak-kami', [App\Http\Controllers\TravelController::class, 'getEmail'])->name('contact.email');
Route::group(['middleware' => 'auth'], function() {
    Route::get('/my-tickets', [App\Http\Controllers\TravelController::class, 'myTickets'])->name('my_tickets');
    Route::get('/payment/{id}', [App\Http\Controllers\TravelController::class, 'payment'])->name('payment');

});

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('travel-packages', \App\Http\Controllers\Admin\TravelPackageController::class);
        Route::resource('travel-packages.galleries', \App\Http\Controllers\Admin\GalleryController::class);
        Route::post('/admin/orders/{id}/update-status', [OrderController::class, 'updateStatus']);
        
    });
    
});