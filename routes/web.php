<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\CarSizeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ExpenseTypeController;
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
    Route::get('/',[HomeController::class,'index'])->name('home');
    
    Route::get('product/getProduct',[ProductController::class,'getProducts']);
    Route::get('product/search',[ProductController::class,'search'])->name('product.search');
    Route::resource('product',ProductController::class);
    Route::resource('unit',UnitController::class);
    Route::resource('purchase',PurchaseController::class);
    Route::post('stock/updatePrice/{stock}',[StockController::class,'updatePrice'])->name('stock.updatePrice');
    Route::get('stock/showChangPrice/{stock}',[StockController::class,'showChangPrice'])->name('stock.showChangPrice');
    Route::get('stock/getStock',[StockController::class,'getStock']);
    Route::resource('stock',StockController::class,['except' => ['edit','create','delete','update']]);
    Route::resource('order',OrderController::class);
    Route::get('service/getService',[ServiceController::class,'getService']);
    Route::resource('service',ServiceController::class);
    Route::resource('serviceType',ServiceTypeController::class);
    Route::get('client/getClients',[ClientController::class,'getClients']);

    //client ajax request
    Route::post('client/storeAjax',[ClientController::class,'storeAjax'])->name('client.storeAjax');
    //
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

    Route::resource('cars',CarSizeController::class)->only(['index','update','edit']);
    Route::resource('expense',ExpenseController::class,['except' => 'show']);
    Route::resource('expenseTypes',ExpenseTypeController::class,['except' => 'show']);

    Route::get('summary/search',[SummaryController::class,'search'])->name('summary.search');
    Route::get('summary',[SummaryController::class,'index'])->name('summary.index');
    
});

require __DIR__.'/auth.php';
