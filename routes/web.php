<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RewardController;
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
Route::get('/popular-projects', 'ProjectController@loadPopularProjects')->name('popular-projects');

Route::get('/profile', [App\Http\Controllers\ProjectController::class, 'userProjects'])->name('profile');
Route::get('/profile/add_project', [App\Http\Controllers\ProjectController::class, 'create'])->name('add_project');
Route::get('/projects/{project}', 'App\Http\Controllers\HomeController@show')->name('projects.show');
Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

Route::get('/projects/{project}/rewards/create', [RewardController::class, 'create'])->name('rewards.create');
Route::post('/projects/{project}/rewards', [RewardController::class, 'store'])->name('rewards.store');
Route::get('/projects/{project}/rewards/{reward}/edit', [RewardController::class, 'edit'])->name('rewards.edit');
Route::put('/projects/{project}/rewards/{reward}', [RewardController::class, 'update'])->name('rewards.update');
Route::delete('/projects/{project}/rewards/{reward}', [RewardController::class, 'destroy'])->name('rewards.destroy');


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
    (new TCG\Voyager\Voyager)->routes();
});
