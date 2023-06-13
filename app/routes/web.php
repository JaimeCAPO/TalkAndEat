<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\mainController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login',[AuthController::class,'showLoginForm'])->name('login');
Route::get('/register',[RegisterController::class,'showRegisterForm'])->name('register');

Route::post('/',[AuthController::class,'login']);
Route::post('/login',[RegisterController::class,'register']);
Route::post('/logout',[AuthController::class,'logout']);


Route::get('/',[mainController::class,'index'])->middleware('auth')->name('home');
Route::get('/explore',[mainController::class,'explore'])->middleware('auth')->name('explore');
Route::get('/explore/{id}',[PostController::class,'post'])->middleware('auth');
Route::get('/notifications',[mainController::class,'notifications'])->middleware('auth')->name('notifications');
Route::get('/account',[mainController::class,'account'])->middleware('auth')->name('account');
Route::get('/config',[ConfigController::class,'showConfigForm'])->middleware('auth')->name('settings');
Route::get('/addpost',[PostController::class,'newpost'])->middleware('auth')->name('newpost');
Route::get('/admin',[mainController::class,'admin'])->middleware('auth.admin')->name('admin');

Route::get('/post',[mainController::class,'explore'])->middleware('auth');
Route::get('/post/{id}',[PostController::class,'post'])->middleware('auth')->name('post');

Route::get('/404',[mainController::class,'error404'])->middleware('auth')->name('404');
Route::get('/400',[mainController::class,'error400'])->middleware('auth')->name('400');

Route::get('/user/{id}',[mainController::class,'user'])->name('user');

Route::delete('/user', [FollowController::class, 'deletefollow'])->name('deleteFollow');
Route::post('/user', [FollowController::class, 'follow'])->name('follow');
Route::put('/account',[ConfigController::class,'updateUser'])->name('updateUser');
Route::delete('/login',[ConfigController::class,'deleteUser'])->name('deleteUser');
Route::post('/post/{id}',[PostController::class,'comment'])->name('comment');