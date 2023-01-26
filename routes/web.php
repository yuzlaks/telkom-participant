<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\UserPicController;
use App\Http\Controllers\UserPosController;
use App\Http\Controllers\UserRegionalController;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

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

Route::middleware('CustomAccess')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
    Route::get('cetak-barcode/{type}/{id}', [DashboardController::class, 'printBarcode'])->name('printBarcode'); 
        // user regional
    Route::resource('user-regional', UserRegionalController::class);

    // user pic
    Route::resource('user-pic', UserPicController::class);

    // user pos
    Route::resource('user-pos', UserPosController::class);

    // pos
    Route::resource('pos', PosController::class);

    // ajax get regional from pic
    Route::get('pos/get_regional/{pos_id}', [PosController::class, 'getRegional']);

});

// dynamic QRCode
Route::get('create-user-pos-from-user-pic/{referal_pic}', [HomeController::class, 'createUserPos']);

Route::get('create-customer-from-user-pos/{referal_pos}', [HomeController::class, 'createUserCustomer']);
Route::post('store-customer', [HomeController::class, 'storeCustomer']);

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('register', [CustomAuthController::class, 'register'])->name('register-user');
Route::post('custom-register', [CustomAuthController::class, 'customRegister'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');