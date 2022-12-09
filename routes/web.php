<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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
Route::get('/blank', function () {
    return view('users.blank');
});

Route::get('login',LoginController::class.'@index')->name('users.login');
Route::get('register',RegisterController::class.'@index')->name('users.register');
Route::get('forgot-password',ForgotPasswordController::class.'@index')->name('users.forgot-password');
Route::get('new-password',ForgotPasswordController::class.'@newPassword')->name('users.new-password');
