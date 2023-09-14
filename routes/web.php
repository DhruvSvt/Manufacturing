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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin');

Route::get('/signin', function () {
    return view('admin.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('admin.signup');
})->name('signup');

Route::get('/table', function () {
    return view('admin.tables');
})->name('table');

Route::get('/admin-page', function () {
    return view('admin.admin-page');
})->name('admin-page');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
