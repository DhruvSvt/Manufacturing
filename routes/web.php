<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuppliersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-index', function () {
        return view('admin.index');
    })->name('admin-index');

    Route::get('/admin-page', [UsersController::class, 'index'])->name('admin-page');
    Route::get('/admin-create', [UsersController::class, 'create'])->name('admin-create');
    Route::post('/admin-store', [UsersController::class, 'store'])->name('admin-store');
    Route::get('/admin-edit/{id}', [UsersController::class, 'edit'])->name('admin-edit');
    Route::put('/admin-update/{id}', [UsersController::class, 'update'])->name('admin-update');

    Route::post('/status', [UsersController::class, 'status'])->name('status');

    Route::get('/supplier', [SuppliersController::class, 'index'])->name('supplier');
    Route::get('/supplier.create', [SuppliersController::class, 'create'])->name('supplier.create');
    Route::post('/supplier.store', [SuppliersController::class, 'store'])->name('supplier.store');
    Route::get('/supplier.edit/{id}', [SuppliersController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier.update/{id}', [SuppliersController::class, 'update'])->name('supplier.update');

    Route::post('/supplier.status', [SuppliersController::class, 'status'])->name('supplier.status');

    Route::get('/gift', [GiftController::class, 'index'])->name('gift');
    Route::get('/gift.create', [GiftController::class, 'create'])->name('gift.create');
    Route::post('/gift.store', [GiftController::class, 'store'])->name('gift.store');
    Route::get('/gift.edit/{id}', [GiftController::class, 'edit'])->name('gift.edit');
    Route::put('/gift.update/{id}', [GiftController::class, 'update'])->name('gift.update');

    Route::post('/gift.status', [GiftController::class, 'status'])->name('gift.status');


    Route::get('/signin', function () {
        return view('admin.signin');
    })->name('signin');


    Route::get('/signup', function () {
        return view('admin.signup');
    })->name('signup');

    Route::get('/table', function () {
        return view('admin.tables');
    })->name('table');
});



// Route::get('/gift', function () {
//     return view('admin.gift');
// })->name('gift');




Route::get('/home', [HomeController::class, 'index'])->name('home');
