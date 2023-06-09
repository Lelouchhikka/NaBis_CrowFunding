<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Voyager;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/projects/{project}', 'App\Http\Controllers\HomeController@show')->name('projects.show');
Route::post('/donate', [App\Http\Controllers\ContributeController::class,'donate'])->name('donate');
Route::get('/types/{type}', 'App\Http\Controllers\HomeController@showByType')->name('projects.by_type');

// Регистрация пользователей
Route::get('/register', [App\Http\Controllers\UserController::class,'create'])->name('register');
Route::post('/register', [App\Http\Controllers\UserController::class,'store'])->name('register.store');

// Аутентификация пользователей
Route::get('/login', [App\Http\Controllers\UserController::class,'loginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\UserController::class,'login'])->name('login.authenticate');
Route::post('/logout', [App\Http\Controllers\UserController::class,'logout'])->name('logout');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
