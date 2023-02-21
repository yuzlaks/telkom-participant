<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MateriPromosiController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\UserPicController;
use App\Http\Controllers\UserPosController;
use App\Http\Controllers\UserRegionalController;
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
    return redirect('dashboard');
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

    // materi promosi
    Route::resource('materi-promosi', MateriPromosiController::class);

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
Route::get('reload-captcha', [CustomAuthController::class, 'reloadCaptcha']);

// get witel
Route::get('get-datel/{id_witel}', [UserPicController::class, 'getDatel']);

// api
Route::get('provinces', [PosController::class, 'provinces']);
Route::get('regencies/{provinces_id}', [PosController::class, 'regencies']);
Route::get('districts/{regencies_id}', [PosController::class, 'districts']);
Route::get('villages/{districts_id}', [PosController::class, 'villages']);

Route::post('update-status-pos/{id}', [PosController::class, 'updateStatusPos']);
Route::post('update-no-sc/{id}', [PosController::class, 'updateNoSc']);