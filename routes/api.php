<?php

use App\Http\Controllers\AtmController;
use App\Http\Controllers\AdvertisingController;
use App\Http\Controllers\SubscriptionPlanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckDriverStatus;
use App\Http\Controllers\AtmCategoryController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1/')->group(function () {

    //ATMs
    Route::apiResource('atms', AtmController::class);
    Route::apiResource('atm_categories', AtmCategoryController::class);
    Route::post('atms/cash-in-address', [AtmController::class, 'getAtmsWithCashInRadius']);
    Route::get('atms/ByStreet/{id_street}', [AtmController::class, 'getAtmByStreet']);
    Route::get('atms/ByCash/', [AtmController::class, 'getAtmByCash']);
    Route::get('atms/AtmByMoney', [AtmController::class, 'getAtmByMoney']);
    Route::post('/atmUpdate/{id}/{has_cash}/{has_paper}', [\App\Http\Controllers\AtmController::class, 'updateStatus']);
    Route::post('agentLogin', [\App\Http\Controllers\atmSettingsController::class, 'login']);
    Route::post('agentRegister', [\App\Http\Controllers\atmSettingsController::class, 'register']);
    Route::post('agentAtm', [\App\Http\Controllers\AgentAtmsController::class, 'register']);
    Route::get('closest', [AtmController::class, 'getClosestAtms']);

    //Carteira
    Route::get('/wallets/{id}', [\App\Http\Controllers\WalletController::class, 'show']);
    Route::patch('/wallets/{id}', [\App\Http\Controllers\WalletController::class, 'update']);

    //Subscricao
    Route::apiResource('subscription_plans', SubscriptionPlanController::class);



    //Street
    Route::get('/street', [\App\Http\Controllers\streetController::class, 'getStreet']);
    Route::get('/streetById/{id}', [\App\Http\Controllers\streetController::class, 'getStreetById']);
    Route::get('/streetByMunicipe/{id}', [\App\Http\Controllers\streetController::class, 'getStreetByMunicipe']);
    Route::get('/createstreet', [\App\Http\Controllers\streetController::class, 'createstreet']);

    //Municipe
    Route::get('municipe/', [\App\Http\Controllers\municipeController::class, 'getMunicipe']);
    Route::get('municipeById/{id}', [\App\Http\Controllers\municipeController::class, 'getMunicipeById']);

    //Provincia
    Route::get('municipeByProvince/{id_province}', [\App\Http\Controllers\municipeController::class, 'getMunicipeByProvince']);
    Route::get('province', [\App\Http\Controllers\provinceController::class, 'getProvince']);
    Route::get('provinceByProvince/{id_province}', [\App\Http\Controllers\provinceController::class, 'getProvinceById']);


    Route::post('newHistory', [\App\Http\Controllers\HistorieController::class, 'newHistory']);
    Route::get('getHistoriesAll', [\App\Http\Controllers\HistorieController::class, 'getHistoriesAll']);
    Route::get('getHistoryByAgent/{agent_id}', [\App\Http\Controllers\HistorieController::class, 'getHistoryByAgent_id']);
    Route::get('user/getByNumber/{phone}', [\App\Http\Controllers\TypeOfUserController::class, 'getTYpeOfUser']);
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::get('getAtmAgent/{user_id}', [\App\Http\Controllers\AgentAtmsController::class, 'getAtmById']);

    //User
   // Route::post('logout', [\App\Http\Controllers\atmSettingsController::class, 'logout']);
    Route::post('user/send-otp', [\App\Http\Controllers\OtpController::class, 'sendOtp']);
    Route::post('user/verify-otp', [\App\Http\Controllers\OtpController::class, 'verifyOtp']);
    Route::post('user/change_password', [\App\Http\Controllers\AuthController::class, 'change_password'])->middleware('auth:sanctum');
    Route::post('new-password/{telefone}', [\App\Http\Controllers\ClienteController::class, 'newPassword']);
    Route::post('register', [\App\Http\Controllers\UserController::class, 'register']);
    Route::get('me', [\App\Http\Controllers\AuthController::class, 'me'])->middleware('auth:sanctum');
    Route::get('user/{user}/info', [\App\Http\Controllers\ClienteController::class, 'clienteByIdOrPhone'])->middleware('auth:sanctum');
    Route::post('user/{user}/info', [\App\Http\Controllers\ClienteController::class, 'updateUserInfo'])->middleware('auth:sanctum');
    Route::post('user/{user}/credentials', [\App\Http\Controllers\ClienteController::class, 'updateUserCredentials'])->middleware('auth:sanctum');
    Route::put('user/updateUserInfo/{user}', [\App\Http\Controllers\ClienteController::class, 'updateUserInfo'])->middleware('auth:sanctum');
    Route::delete('user/{user}/delete', [\App\Http\Controllers\ClienteController::class, 'deleteUser'])->middleware('auth:sanctum');
    Route::get('user/all', [\App\Http\Controllers\ClienteController::class, 'getAll'])->middleware('auth:sanctum');


    // Facebook login
    Route::get('login/facebook', [\App\Http\Controllers\OAuthController::class, 'redirectToFacebookProvider']);
    Route::get('login/facebook/callback', [\App\Http\Controllers\OAuthController::class, 'handleFacebookProviderCallback']);

    // Google login
    Route::get('login/google', [\App\Http\Controllers\OAuthController::class, 'redirectToGoogleProvider']);
    Route::get('login/google/callback', [\App\Http\Controllers\OAuthController::class, 'handleGoogleProviderCallback']);
    Route::get('social/login', [\App\Http\Controllers\OAuthController::class, 'socialLogin']);

    //Advertising
    Route::get('/advertising', [AdvertisingController::class, 'index']);
    Route::post('/advertising', [AdvertisingController::class, 'register']);
    Route::get('/advertising/{id}', [AdvertisingController::class, 'show']);
    Route::put('/advertising/{id}', [AdvertisingController::class, 'update']);
    Route::delete('/advertising/{id}', [AdvertisingController::class, 'destroy']);
});

Route::get('/imagem/{nomeDaImagem}', function ($nomeDaImagem) {
    $caminhoCompleto = "storage/app/admin/images/{$nomeDaImagem}";

    if (file_exists($caminhoCompleto)) {
        return response()->file($caminhoCompleto);
    } else {
        abort(404);
    }
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('v1/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});
