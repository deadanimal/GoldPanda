<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\EnhanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\StatikController;
 
Route::get('/', [StatikController::class, 'home']);
Route::get('/about', [StatikController::class, 'about']);
Route::get('/products', [StatikController::class, 'products']);
Route::get('/faq', [StatikController::class, 'faq']);


Route::middleware(['auth'])->group(function () {

    Route::get('/app', [StatikController::class, 'app']);

    Route::get('/app/trade', [TradeController::class, 'home']);
    Route::post('/app/trade', [TradeController::class, 'create']);
    Route::get('/app/bought/{id}', [TradeController::class, 'show_bought']);
    Route::get('/app/sold/{id}', [TradeController::class, 'show_sold']);
    
    Route::get('/app/advance', [AdvanceController::class, 'home']);
    Route::post('/app/advance', [AdvanceController::class, 'create']);
    Route::get('/app/advance/{id}', [AdvanceController::class, 'show']);
    
    Route::get('/app/enhance', [EnhanceController::class, 'home']);
    Route::post('/app/enhance', [EnhanceController::class, 'create']);
    Route::get('/app/enhance/{id}', [EnhanceController::class, 'show']);
    
    Route::get('/app/profile', [ProfileController::class, 'home']);    
    Route::put('/app/profile/promoter', [ProfileController::class, 'update_promoter']);
    Route::put('/app/profile/bank-account', [ProfileController::class, 'update_bank_account']);
    Route::put('/app/profile/kyc', [ProfileController::class, 'update_kyc']);
    
    
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
