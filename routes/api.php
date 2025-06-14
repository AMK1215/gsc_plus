<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\BankController;
use App\Http\Controllers\Api\V1\BannerController;
use App\Http\Controllers\Api\V1\ContactController;
use App\Http\Controllers\Api\V1\Dashboard\AdminLoginController;
use App\Http\Controllers\Api\V1\DepositRequestController;
use App\Http\Controllers\Api\V1\Game\GSCPlusProviderController;
use App\Http\Controllers\Api\V1\Game\LaunchGameController;
use App\Http\Controllers\Api\V1\Game\ProviderTransactionCallbackController;
use App\Http\Controllers\Api\V1\Game\ShanLaunchGameController;
use App\Http\Controllers\Api\V1\Game\ShanTransactionController;
use App\Http\Controllers\Api\V1\gplus\Webhook\DepositController;
use App\Http\Controllers\Api\V1\gplus\Webhook\GameListController;
use App\Http\Controllers\Api\V1\gplus\Webhook\GetBalanceController;
use App\Http\Controllers\Api\V1\gplus\Webhook\ProductListController;
use App\Http\Controllers\Api\V1\gplus\Webhook\PushBetDataController;
use App\Http\Controllers\Api\V1\gplus\Webhook\WithdrawController;
use App\Http\Controllers\Api\V1\PromotionController;
use App\Http\Controllers\Api\V1\ShanGetBalanceController;
use App\Http\Controllers\Api\V1\WithDrawRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// admin login
Route::post('/admin/login', [AdminLoginController::class, 'login']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/player-change-password', [AuthController::class, 'playerChangePassword']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('product-list', [ProductListController::class, 'index']);
Route::get('operators/provider-games', [GameListController::class, 'index']);

Route::prefix('v1/api/seamless')->group(function () {
    Route::post('balance', [GetBalanceController::class, 'getBalance']);
    Route::post('withdraw', [WithdrawController::class, 'withdraw']);
    Route::post('deposit', [DepositController::class, 'deposit']);
    Route::post('pushbetdata', [PushBetDataController::class, 'pushBetData']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/seamless/launch-game', [LaunchGameController::class, 'launchGame']);
    // user api
    Route::get('user', [AuthController::class, 'getUser']);
    Route::get('/banks', [GSCPlusProviderController::class, 'banks']);
    Route::post('/transactions', [ShanTransactionController::class, 'store']);

    // fanicial api
    Route::get('agentfinicialPaymentType', [BankController::class, 'all']);
    Route::post('depositfinicial', [DepositRequestController::class, 'FinicialDeposit']);
    Route::get('depositlogfinicial', [DepositRequestController::class, 'log']);
    Route::get('paymentTypefinicial', [GSCPlusProviderController::class, 'paymentType']);
    Route::post('withdrawfinicial', [WithDrawRequestController::class, 'FinicalWithdraw']);
    Route::get('withdrawlogfinicial', [WithDrawRequestController::class, 'log']);

    Route::get('contact', [ContactController::class, 'get']);
    Route::get('promotion', [PromotionController::class, 'index']);
    Route::get('winnerText', [BannerController::class, 'winnerText']);
    Route::get('banner_Text', [BannerController::class, 'bannerText']);
    Route::get('popup-ads-banner', [BannerController::class, 'AdsBannerIndex']);
    Route::get('banner', [BannerController::class, 'index']);
    Route::get('videoads', [BannerController::class, 'ApiVideoads']);
    Route::get('toptenwithdraw', [BannerController::class, 'TopTen']);

});

// games
Route::get('/game_types', [GSCPlusProviderController::class, 'gameTypes']);
Route::get('/providers/{type}', [GSCPlusProviderController::class, 'providers']);
Route::get('/game_lists/{type}/{provider}', [GSCPlusProviderController::class, 'gameLists']);
Route::get('/hot_game_lists', [GSCPlusProviderController::class, 'hotGameLists']);

Route::group(['prefix' => 'shan'], function () {
    Route::post('balance', [ShanGetBalanceController::class, 'getBalance']);
    Route::post('launch-game', [ShanLaunchGameController::class, 'launch']);
});

Route::prefix('v1')->group(function () {
    Route::prefix('game')->group(function () {
        Route::post('transactions', [ProviderTransactionCallbackController::class, 'handle']);
    });
});
