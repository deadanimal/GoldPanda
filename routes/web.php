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
    Route::get('/app/trade/{id}', [TradeController::class, 'show']);
    
    Route::get('/app/advance', [AdvanceController::class, 'home']);
    Route::post('/app/advance', [AdvanceController::class, 'create']);
    Route::get('/app/advance/{id}', [AdvanceController::class, 'show']);
    
    Route::get('/app/enhance', [EnhanceController::class, 'home']);
    Route::post('/app/enhance', [EnhanceController::class, 'create']);
    Route::get('/app/enhance/{id}', [EnhanceController::class, 'show']);
    
    Route::get('/app/profile', [ProfileController::class, 'home']);
    Route::post('/app/profile/promoter', [ProfileController::class, 'add_promoter']);
    
    
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
