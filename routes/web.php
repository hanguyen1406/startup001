<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\PageController::class, 'home'])->name('home');
Route::get('paket-travel', [App\Http\Controllers\PageController::class, 'package'])->name('package');
Route::get('detail/{travelPackage:slug}', [App\Http\Controllers\PageController::class, 'detail'])->name('detail');
Route::post('detail/{travelPackage:slug}', [App\Http\Controllers\PageController::class, 'order'])->name('order');


Route::get('kontak-kami', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::post('kontak-kami', [App\Http\Controllers\PageController::class, 'getEmail'])->name('contact.email');

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('travel-packages', \App\Http\Controllers\Admin\TravelPackageController::class);
        Route::resource('travel-packages.galleries', \App\Http\Controllers\Admin\GalleryController::class);
    });
    
});