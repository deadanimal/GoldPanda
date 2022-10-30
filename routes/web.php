<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\EnhanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\StatikController;

use App\Models\User;
 
Route::get('', [StatikController::class, 'home']);
Route::get('about', [StatikController::class, 'about']);
Route::get('faq', [StatikController::class, 'faq']);
Route::get('privacy', [StatikController::class, 'privacy']);
Route::get('terms', [StatikController::class, 'terms']);
Route::get('register/{code}', [ProfileController::class, 'daftar']);
Route::post('register/{code}', [ProfileController::class, 'cipta']);

Route::get('billplz-redirect', [InvoiceController::class, 'billplz_redirect']);
Route::post('billplz-callback', [InvoiceController::class, 'billplz_callback']);


Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', [StatikController::class, 'app']);
    Route::get('pro', [StatikController::class, 'pro']);
  

    Route::get('trade', [TradeController::class, 'senarai']);
    Route::post('trade', [TradeController::class, 'cipta']);
    Route::get('trade/{id}', [TradeController::class, 'satu']);
    
    Route::get('advance', [AdvanceController::class, 'home']);
    Route::post('advance', [AdvanceController::class, 'cipta']);
    Route::get('advance/{id}', [AdvanceController::class, 'satu']);
    Route::put('advance/{id}/kemaskini', [AdvanceController::class, 'kemaskini']);
    
    Route::get('enhance', [EnhanceController::class, 'home']);
    Route::post('enhance', [EnhanceController::class, 'cipta']);
    Route::get('enhance/{id}', [EnhanceController::class, 'satu']);
    Route::get('enhance/{id}/kemaskini', [EnhanceController::class, 'kemaskini']);
    
    Route::get('profile', [ProfileController::class, 'satu']);
    Route::put('profile/password', [ProfileController::class, 'change_password']);    

    Route::get('user/{id}', [ProfileController::class, 'satu_user']);    

    Route::get('reward', [RewardController::class, 'home']);    
    Route::post('reward/redeem', [RewardController::class, 'redeem']);    
    
    
});


Route::middleware(['auth', 'role:super-admin'])->prefix('admin')->group(function () {

    Route::get('dashboard', [StatikController::class, 'admin']);

    Route::get('trade', [TradeController::class, 'admin']);
    Route::get('advance', [AdvanceController::class, 'admin']);
    Route::get('enhance', [EnhanceController::class, 'admin']);    
    Route::get('user', [ProfileController::class, 'admin']);    
    Route::get('user/{id}', [ProfileController::class, 'satu']);    
    Route::put('user/{id}/kemaskini', [ProfileController::class, 'kemaskini']);
    Route::put('user/{id}/password', [ProfileController::class, 'kemaskini_password']);
    Route::get('reward', [RewardController::class, 'admin']);    
    Route::get('invoice', [InvoiceController::class, 'admin']);    
    Route::get('invoice/{id}', [InvoiceController::class, 'satu']);    
    Route::put('invoice/{id}/kemaskini', [InvoiceController::class, 'kemaskini']);    
    Route::get('payment', [PaymentController::class, 'admin']);    
    Route::get('payment/{id}', [PaymentController::class, 'satu']);     
    Route::put('payment/{id}/kemaskini', [PaymentController::class, 'kemaskini']);     
    
    
});


require __DIR__.'/auth.php';
