<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\FlowController;
use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\EnhanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\StatikController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\BlockchainMintController;
use App\Http\Controllers\PhysicalMintController;

use App\Models\User;
 
Route::get('', [StatikController::class, 'home']);
Route::get('about', [StatikController::class, 'about']);
Route::get('products', [StatikController::class, 'products']);
Route::get('faq', [StatikController::class, 'faq']);
Route::get('privacy', [StatikController::class, 'privacy']);
Route::get('terms', [StatikController::class, 'terms']);


Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', [StatikController::class, 'app']);
    Route::get('pro', [StatikController::class, 'pro']);
  

    Route::get('trade', [TradeController::class, 'senarai']);
    Route::post('trade', [TradeController::class, 'cipta']);
    Route::get('trade/{id}', [TradeController::class, 'satu']);
    
    Route::get('advance', [AdvanceController::class, 'home']);
    Route::get('advance/calculate', [AdvanceController::class, 'calculate']);
    Route::post('advance', [AdvanceController::class, 'cipta_advance']);
    Route::get('advance/{id}', [AdvanceController::class, 'show']);
    Route::put('advance/{id}/redeem', [AdvanceController::class, 'redeem']);
    Route::get('advance/{id}/calculate', [AdvanceController::class, 'calculate_specific']);
    
    Route::get('enhance', [EnhanceController::class, 'home']);
    Route::get('enhance/calculate', [EnhanceController::class, 'calculate']);
    Route::post('enhance', [EnhanceController::class, 'create']);
    Route::get('enhance/{id}', [EnhanceController::class, 'show']);
    Route::post('enhance/{id}/redeem', [EnhanceController::class, 'redeem']);
    Route::post('enhance/{id}/cancel', [EnhanceController::class, 'cancel']);
    Route::get('enhance/{id}/calculate', [EnhanceController::class, 'calculate_specific']);
    
    Route::get('profile', [ProfileController::class, 'home']);
    Route::post('profile/password', [ProfileController::class, 'change_password']);    
    Route::put('profile/promoter', [ProfileController::class, 'update_promoter']);
    Route::put('profile/bank-account', [ProfileController::class, 'update_bank_account']);
    Route::put('profile/kyc', [ProfileController::class, 'update_kyc']);

    Route::get('user/{id}', [ProfileController::class, 'satu_user']);    

    Route::get('reward', [RewardController::class, 'home']);    
    Route::get('reward/{id}', [RewardController::class, 'show']);
    Route::post('reward/register', [RewardController::class, 'add_new_user']);    
    Route::post('reward/redeem', [RewardController::class, 'redeem_reward']);    
    Route::get('reward/redeem/{id}', [RewardController::class, 'show_redeem']);       

    Route::get('support', [SupportTicketController::class, 'home']);
    Route::post('support', [SupportTicketController::class, 'create_support']);
    Route::get('support/{id}', [SupportTicketController::class, 'show']);
    Route::post('support/{id}/message', [SupportTicketController::class, 'send_message']);
    
    
});


Route::middleware(['auth', 'role:super-admin'])->prefix('admin')->group(function () {

    Route::get('', [StatikController::class, 'admin']);

    Route::get('trade', [TradeController::class, 'admin_home']);
    Route::get('bought/{id}', [TradeController::class, 'admin_show_bought']);
    Route::get('sold/{id}', [TradeController::class, 'admin_show_sold']);
    
    Route::get('advance', [AdvanceController::class, 'admin_home']);
    Route::get('advance/{id}', [AdvanceController::class, 'admin_show']);
    Route::put('advance/{id}/foreclose', [AdvanceController::class, 'admin_foreclose']);
    
    Route::get('enhance', [EnhanceController::class, 'admin_home']);
    Route::get('enhance/{id}', [EnhanceController::class, 'admin_show']);
    
    Route::get('profile', [ProfileController::class, 'admin_home']);    
    Route::get('profile/{id}', [ProfileController::class, 'admin_show']);    
    Route::put('profile/{id}/promoter', [ProfileController::class, 'admin_update_promoter']);
    Route::put('profile/{id}/bank-account', [ProfileController::class, 'admin_update_bank_account']);
    Route::put('profile/{id}/kyc', [ProfileController::class, 'admin_update_kyc']);

    Route::get('reward', [RewardController::class, 'admin_home']);    
    Route::get('reward/{id}', [RewardController::class, 'admin_show']);
    Route::get('reward/redeem/{id}', [RewardController::class, 'admin_show_redeem']);
    
    Route::get('blockchain', [BlockchainMintController::class, 'admin_home']);    
    Route::post('blockchain/mint', [BlockchainMintController::class, 'admin_mint']);
    Route::get('blockchain/mint/{id}', [BlockchainMintController::class, 'admin_show']);

    Route::get('physical', [PhysicalMintController::class, 'admin_home']);    
    Route::post('physical/mint', [PhysicalMintController::class, 'admin_mint']);
    Route::get('physical/mint/{id}', [PhysicalMintController::class, 'admin_show']); 
    
    Route::get('cash', [TradeController::class, 'admin_cash']);
    Route::post('cash', [TradeController::class, 'admin_manual_entry']);
    Route::get('cash/payin/{id}', [TradeController::class, 'admin_payin']);
    Route::get('cash/payout/{id}', [TradeController::class, 'admin_payout']);

    Route::get('support', [SupportController::class, 'admin_home']);
    Route::get('support/{id}', [SupportController::class, 'admin_show']);
    Route::put('support/{id}/message', [SupportController::class, 'admin_send_message']);
    
    
});

// Route::post('token', function (Request $request) {
//     if (!Auth::attempt($request->only('email', 'password'))) 

//      return response()->json([
//         'message' => 'Invalid login details'
//      ], 401);

//     $user = User::where('email',  $request->email)->firstOrFail();
//     auth()->user()->tokens()->delete();
//     $token = $user->createToken('auth_token')->plainTextToken;

//     return response()->json([
//         'user' => $user,
//         'token' => $token
//     ], 200);
// });

// Route::middleware(['auth:sanctum'])->prefix('api')->group(function () {

//     Route::get('trade', [TradeController::class, 'api_home']);
//     Route::get('trade/calculate', [TradeController::class, 'api_calculate']);
//     Route::post('trade', [TradeController::class, 'api_create']);
//     Route::get('bought/{id}', [TradeController::class, 'api_show_bought']);
//     Route::get('sold/{id}', [TradeController::class, 'api_show_sold']);

//     Route::get('advance', [AdvanceController::class, 'api_home']);
//     Route::get('advance/calculate', [AdvanceController::class, 'api_calculate']);
//     Route::post('advance', [AdvanceController::class, 'api_create']);
//     Route::get('advance/{id}', [AdvanceController::class, 'api_show']);
//     Route::put('advance/{id}/redeem', [AdvanceController::class, 'api_redeem']);
//     Route::get('advance/{id}/calculate', [AdvanceController::class, 'api_calculate_specific']);
    
//     Route::get('enhance', [EnhanceController::class, 'api_home']);
//     Route::get('enhance/calculate', [EnhanceController::class, 'api_calculate']);
//     Route::post('enhance', [EnhanceController::class, 'api_create']);
//     Route::get('enhance/{id}', [EnhanceController::class, 'api_show']);
//     Route::put('enhance/{id}/redeem', [EnhanceController::class, 'api_redeem']);
//     Route::put('enhance/{id}/cancel', [EnhanceController::class, 'api_cancel']);
//     Route::get('enhance/{id}/calculate', [EnhanceController::class, 'api_calculate_specific']);
    
//     Route::get('profile', [ProfileController::class, 'api_home']);    
//     Route::put('profile/promoter', [ProfileController::class, 'api_update_promoter']);
//     Route::put('profile/bank-account', [ProfileController::class, 'api_update_bank_account']);
//     Route::put('profile/kyc', [ProfileController::class, 'api_update_kyc']);

//     Route::get('reward', [RewardController::class, 'api_home']);    
//     Route::get('reward/{id}', [RewardController::class, 'api_show']);
//     Route::post('reward/redeem', [RewardController::class, 'api_redeem_reward']);    
//     Route::get('reward/redeem/{id}', [RewardController::class, 'api_show_redeem']);    

//     Route::get('blockchain', [BlockchainMintController::class, 'api_home']);    
//     Route::post('blockchain/mint', [BlockchainMintController::class, 'api_mint']);
//     Route::get('blockchain/mint/{id}', [BlockchainMintController::class, 'api_show']);

//     Route::get('physical', [PhysicalMintController::class, 'api_home']);    
//     Route::post('physical/mint', [PhysicalMintController::class, 'api_mint']);
//     Route::get('physical/mint/{id}', [PhysicalMintController::class, 'api_show']);    

//     Route::get('support', [SupportController::class, 'api_home']);
//     Route::post('support', [SupportController::class, 'api_create_support']);
//     Route::get('support/{id}', [SupportController::class, 'api_show']);
//     Route::put('support/{id}/message', [SupportController::class, 'api_send_message']);    

// });

// Route::get('dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
