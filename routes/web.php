<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ServiceRequestController;

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



Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('product/getProduct',[ProductController::class,'getProducts']);
    Route::resource('product',ProductController::class);
    Route::resource('unit',UnitController::class);
    Route::resource('purchase',PurchaseController::class);
    Route::get('stock/getStock',[StockController::class,'getStock']);
    Route::resource('stock',StockController::class,['except' => ['edit','create','delete','update']]);
    Route::resource('order',OrderController::class);
    Route::get('service/getService',[ServiceController::class,'getService']);
    Route::resource('service',ServiceController::class);
    Route::resource('serviceType',ServiceTypeController::class);
    Route::get('client/getClients',[ClientController::class,'getClients']);
    Route::resource('client',ClientController::class);
    Route::get('addProduct/{serviceRequest}',[ServiceRequestController::class,'addProduct'])->name('serviceRequest.addProduct');
    Route::resource('service_request',ServiceRequestController::class);
    Route::resource('worker',WorkerController::class);
    Route::resource('payment',PaymentMethodController::class,['except' => 'show']);
    Route::resource('users',UserController::class,['except' => 'show']);

    Route::get('user/resetPasswordForm/{user}',[UserController::class,'resetPasswordForm'])->name('user.resetPasswordForm');

	Route::post('user/resetPassword/{user}',[UserController::class,'resetPassword'])->name('user.resetPassword');
    
    Route::get('showSetting',[SettingController::class,'showSetting'])->name('showSetting');
    Route::resource('setting',SettingController::class,['except'=>['show']]);
});

require __DIR__.'/auth.php';
