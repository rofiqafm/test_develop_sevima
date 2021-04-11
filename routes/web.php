<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StorageFileController;
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

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::group(['middleware' => 'auth'], function () {
    Route::post('/addpost',[HomeController::class, 'addPost'])->name('addpost');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/post/{id}', [HomeController::class, 'post'])->name('home.post_detail');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/home/post/{id}', [HomeController::class, 'post'])->name('home.post_detail');
    Route::post('/addlike', [HomeController::class, 'addLike'])->name('addlike');
    Route::post('/addcomment', [HomeController::class, 'addComment'])->name('addcomment');
    Route::get('/deletecomment/{id}', [HomeController::class, 'deleteComment'])->name('deletecomment');
});