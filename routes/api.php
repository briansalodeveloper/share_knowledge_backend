<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiAddressController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FacebookSocialiteController;
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

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});