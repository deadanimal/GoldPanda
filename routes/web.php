<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TradeController;
use App\Http\Controllers\StatikController;
 
Route::get('/', [StatikController::class, 'home']);
Route::get('/about', [StatikController::class, 'about']);
Route::get('/products', [StatikController::class, 'products']);
Route::get('/faq', [StatikController::class, 'faq']);

Route::get('/app', [StatikController::class, 'app']);
Route::get('/app/trade', [TradeController::class, 'home']);
Route::get('/app/advance', [TradeController::class, 'home']);
Route::get('/app/enhance', [TradeController::class, 'home']);
Route::get('/app/profile', [TradeController::class, 'home']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
