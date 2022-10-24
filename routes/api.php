<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\FacebookSocialiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('guest')->group(function () {
    Route::post('/register', [LoginController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
    //facebook socialite
    Route::get('/facebook', [FacebookSocialiteController::class, 'redirectToFB']);
    Route::get('/callback/facebook', [FacebookSocialiteController::class, 'handleCallback']);
});

Route::middleware('check.api.token')->group(function () {
    Route::get('/all_tags', [TagController::class, 'allTags']);
    Route::post('/create_post', [PostController::class, 'createPost']);
    Route::get('/user/info', [UserController::class, 'getAuthDetails']);
    Route::get('/checkAuth', [UserController::class, 'checkAuth']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});