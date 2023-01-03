<?php

use App\Http\Controllers\Users\BusinessInfoController;
use App\Http\Controllers\Users\CoaController;
use App\Http\Controllers\Users\CustomerController;
use App\Http\Controllers\Users\ForgotPasswordController;
use App\Http\Controllers\Users\RegisterController;
use App\Http\Controllers\Users\DashboardController;
use App\Http\Controllers\Users\EmployeeController;
use App\Http\Controllers\Users\LoginController;
use App\Http\Controllers\Users\ProductCategoryController;
use App\Http\Controllers\Users\ProductController;
use App\Http\Controllers\Users\PurchaseController;
use App\Http\Controllers\Users\SaleController;
use App\Http\Controllers\Users\SupplierController;
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
Route::post('auth',LoginController::class.'@auth')->name('users.auth');
Route::get('register',RegisterController::class.'@index')->name('users.register');
Route::post('register',RegisterController::class.'@store')->name('users.register.store');
Route::get('verify',RegisterController::class.'@verify')->name('users.register.verify');
Route::get('forgot-password',ForgotPasswordController::class.'@index')->name('users.forgot-password');
Route::post('forgot-password/store',ForgotPasswordController::class.'@store')->name('users.forgot-password.store');
Route::get('forgot-password/new-password',ForgotPasswordController::class.'@newPassword')->name('users.forgot-password.newPassword');
Route::post('forgot-password/store-new-password',ForgotPasswordController::class.'@storeNewPassword')->name('users.forgot-password.storeNewPassword');

Route::group(['middleware'=>'users.auth','prefix'=>'users'],function(){
    Route::get('logout',LoginController::class.'@logout')->name('users.logout');
    Route::get('dashboard',DashboardController::class.'@index')->name('users.dashboard');
    Route::get('business-info',BusinessInfoController::class.'@index')->name('users.business-info');
    Route::post('business-info',BusinessInfoController::class.'@store')->name('users.business-info.store');
    Route::resource('employee',EmployeeController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('product', ProductController::class);
    Route::resource('product-category', ProductCategoryController::class);
    Route::resource('coa',CoaController::class);
    Route::resource('purchase',PurchaseController::class);
    Route::resource('sale',SaleController::class);
});