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

Auth::routes();

Route::get('/user', [App\Http\Controllers\HomeController::class, 'index'])->name('user');
Route::get('/home', [\App\Http\Controllers\Auth\PermCheck::class, 'index']);

Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminCRM\HomeController::class, 'index'])->name('admin');

    Route::resource('employees', \App\Http\Controllers\AdminCRM\EmployeesController::class);
    Route::resource('positions', \App\Http\Controllers\AdminCRM\PositionController::class);

    Route::get('logout', 'Auth\LoginController@logout');
    Route::post('/search', 'SearchController@filter');
});
