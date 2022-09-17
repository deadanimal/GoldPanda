<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\EnhanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\StatikController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\BlockchainMintController;
use App\Http\Controllers\PhysicalMintController;
 
Route::get('/', [StatikController::class, 'home']);
Route::get('/about', [StatikController::class, 'about']);
Route::get('/products', [StatikController::class, 'products']);
Route::get('/faq', [StatikController::class, 'faq']);
Route::get('/privacy', [StatikController::class, 'privacy']);
Route::get('/terms', [StatikController::class, 'terms']);


Route::middleware(['auth'])->group(function () {

    Route::get('/app', [StatikController::class, 'app']);

    Route::get('/app/trade', [TradeController::class, 'home']);
    Route::get('/app/trade/calculate', [TradeController::class, 'calculate']);
    Route::post('/app/trade', [TradeController::class, 'create']);
    Route::get('/app/bought/{id}', [TradeController::class, 'show_bought']);
    Route::get('/app/sold/{id}', [TradeController::class, 'show_sold']);
    
    Route::get('/app/advance', [AdvanceController::class, 'home']);
    Route::get('/app/advance/calculate', [AdvanceController::class, 'calculate']);
    Route::post('/app/advance', [AdvanceController::class, 'create']);
    Route::get('/app/advance/{id}', [AdvanceController::class, 'show']);
    Route::put('/app/advance/{id}/redeem', [AdvanceController::class, 'redeem']);
    Route::get('/app/advance/{id}/calculate', [AdvanceController::class, 'calculate_specific']);
    
    Route::get('/app/enhance', [EnhanceController::class, 'home']);
    Route::get('/app/enhance/calculate', [EnhanceController::class, 'calculate']);
    Route::post('/app/enhance', [EnhanceController::class, 'create']);
    Route::get('/app/enhance/{id}', [EnhanceController::class, 'show']);
    Route::put('/app/enhance/{id}/redeem', [EnhanceController::class, 'redeem']);
    Route::put('/app/enhance/{id}/cancel', [EnhanceController::class, 'cancel']);
    Route::get('/app/enhance/{id}/calculate', [EnhanceController::class, 'calculate_specific']);
    
    Route::get('/app/profile', [ProfileController::class, 'home']);    
    Route::put('/app/profile/promoter', [ProfileController::class, 'update_promoter']);
    Route::put('/app/profile/bank-account', [ProfileController::class, 'update_bank_account']);
    Route::put('/app/profile/kyc', [ProfileController::class, 'update_kyc']);

    Route::get('/app/reward', [RewardController::class, 'home']);    
    Route::get('/app/reward/{id}', [RewardController::class, 'show']);
    Route::post('/app/reward/redeem', [RewardController::class, 'redeem_reward']);    
    Route::get('/app/reward/redeem/{id}', [RewardController::class, 'show_redeem']);    

    Route::get('/app/blockchain', [BlockchainMintController::class, 'home']);    
    Route::post('/app/blockchain/mint', [BlockchainMintController::class, 'mint']);
    Route::get('/app/blockchain/mint/{id}', [BlockchainMintController::class, 'show']);

    Route::get('/app/physical', [PhysicalMintController::class, 'home']);    
    Route::post('/app/physical/mint', [PhysicalMintController::class, 'mint']);
    Route::get('/app/physical/mint/{id}', [PhysicalMintController::class, 'show']);    

    Route::get('/app/support', [SupportController::class, 'home']);
    Route::post('/app/support', [SupportController::class, 'create_support']);
    Route::get('/app/support/{id}', [SupportController::class, 'show']);
    Route::put('/app/support/{id}/message', [SupportController::class, 'send_message']);
    
    
});


Route::middleware(['auth', 'role:super-admin'])->group(function () {

    Route::get('/admin', [StatikController::class, 'admin']);

    Route::get('/admin/trade', [TradeController::class, 'admin_home']);
    Route::get('/admin/bought/{id}', [TradeController::class, 'admin_show_bought']);
    Route::get('/admin/sold/{id}', [TradeController::class, 'admin_show_sold']);
    
    Route::get('/admin/advance', [AdvanceController::class, 'admin_home']);
    Route::get('/admin/advance/{id}', [AdvanceController::class, 'admin_show']);
    Route::put('/admin/advance/{id}/foreclose', [AdvanceController::class, 'admin_foreclose']);
    
    Route::get('/admin/enhance', [EnhanceController::class, 'admin_home']);
    Route::get('/admin/enhance/{id}', [EnhanceController::class, 'admin_show']);
    
    Route::get('/admin/profile', [ProfileController::class, 'admin_home']);    
    Route::get('/admin/profile/{id}', [ProfileController::class, 'admin_show']);    
    Route::put('/admin/profile/{id}/promoter', [ProfileController::class, 'admin_update_promoter']);
    Route::put('/admin/profile/{id}/bank-account', [ProfileController::class, 'admin_update_bank_account']);
    Route::put('/admin/profile/{id}/kyc', [ProfileController::class, 'admin_update_kyc']);

    Route::get('/admin/reward', [RewardController::class, 'admin_home']);    
    Route::get('/admin/reward/{id}', [RewardController::class, 'admin_show']);
    Route::get('/admin/reward/redeem/{id}', [RewardController::class, 'admin_show_redeem']);
    
    Route::get('/admin/blockchain', [BlockchainMintController::class, 'admin_home']);    
    Route::post('/admin/blockchain/mint', [BlockchainMintController::class, 'admin_mint']);
    Route::get('/admin/blockchain/mint/{id}', [BlockchainMintController::class, 'admin_show']);

    Route::get('/admin/physical', [PhysicalMintController::class, 'admin_home']);    
    Route::post('/admin/physical/mint', [PhysicalMintController::class, 'admin_mint']);
    Route::get('/admin/physical/mint/{id}', [PhysicalMintController::class, 'admin_show']); 
    
    Route::get('/admin/cash', [TradeController::class, 'admin_cash']);
    Route::post('/admin/cash', [TradeController::class, 'admin_manual_entry']);
    Route::get('/admin/cash/payin/{id}', [TradeController::class, 'admin_payin']);
    Route::get('/admin/cash/payout/{id}', [TradeController::class, 'admin_payout']);

    Route::get('/admin/support', [SupportController::class, 'admin_home']);
    Route::get('/admin/support/{id}', [SupportController::class, 'admin_show']);
    Route::put('/admin/support/{id}/message', [SupportController::class, 'admin_send_message']);
    
    
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
