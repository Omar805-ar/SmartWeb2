<?php


use App\Http\Controllers\Api\V1\Merchant\StoreApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Api\V1\Admin\BonuApiController;
use App\Http\Controllers\Api\V1\Admin\SizeApiController;
use App\Http\Controllers\Api\V1\Merchant\CartController;
use App\Http\Controllers\Api\V1\Admin\ColorApiController;
use App\Http\Controllers\Api\V1\Admin\OrderApiController;
use App\Http\Controllers\Api\V1\Admin\SettingApiController;
use App\Http\Controllers\Api\V1\Merchant\ChatApiController;
use App\Http\Controllers\Api\V1\Merchant\OderApiController;
use App\Http\Controllers\Api\V1\Admin\MerchantApiController;
use App\Http\Controllers\Api\V1\Merchant\FavoriteController;
use App\Http\Controllers\Api\V1\Merchant\ShippingController;
use App\Http\Controllers\Api\V1\Merchant\WalletApiController;
use App\Http\Controllers\Api\V1\Admin\GovernmentApiController;
use App\Http\Controllers\Api\V1\Merchant\CountryApiController;
use App\Http\Controllers\Api\V1\Merchant\PenaltyApiController;
use App\Http\Controllers\Api\V1\Merchant\ProductApiController;
use App\Http\Controllers\Api\V1\Merchant\CategoryApiController;
use App\Http\Controllers\Api\V1\Merchant\QuestionApiController;
use App\Http\Controllers\Api\V1\Merchant\VerifyPhoneController;
use App\Http\Controllers\Api\V1\Merchant\AuthenticationController;
use App\Http\Controllers\Api\V1\Merchant\DashboardMerchantApiController;

Route::group(['prefix' => 'v1/merchant/', 'as' => 'api.'], function () {
    Route::post('login', [AuthenticationController::class, 'login']);

    Route::post('test', [AuthenticationController::class, 'test']);

    Route::post('forget-password', [AuthenticationController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::post('reset-password', [AuthenticationController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    Route::post('register', [AuthenticationController::class, 'register']);
    Route::post('oauth/login', [AuthenticationController::class, 'oauth']);


});
Route::group(['prefix' => 'v1/merchant', 'as' => 'api.merchant.', 'middleware' => ['auth:sanctum', 'abilities:merchant']], function () {
    Route::post('logout', [AuthenticationController::class, 'logout']);

    Route::group(['prefix' => 'verify'], function () {
        Route::post('phone/otp', [VerifyPhoneController::class, 'verify_otp']);
        Route::post('phone/resend', [VerifyPhoneController::class, 'resend_otp']);
    });
    Route::group(['prefix' => 'countries'], function () {
        Route::get('/', [CountryApiController::class, 'index']);
    });
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryApiController::class, 'index']);
        Route::get('/{slug}', [CategoryApiController::class, 'single']);
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductApiController::class, 'index']);
        Route::get('/{slug}', [ProductApiController::class, 'single']);
    });
    Route::group(['prefix' => 'penalties'], function () {
        Route::get('/', [PenaltyApiController::class, 'index']);
        Route::get('/{slug}', [PenaltyApiController::class, 'single']);
    });
    Route::group(['prefix' => 'cart'], function () {
        Route::post('/add', [CartController::class, 'add_to_cart']);
        Route::get('/', [CartController::class, 'get_cart']);
        Route::delete('/delete/{id}', [CartController::class, 'delete']);
    });
    Route::group(['prefix' => 'favorite'], function () {
        Route::post('/add', [FavoriteController::class, 'add_to_favorite']);
        Route::get('/get_favorite_count', [FavoriteController::class, 'get_favorite_count']);
        Route::get('/', [FavoriteController::class, 'get_favorite']);
        Route::delete('/delete/{id}', [FavoriteController::class, 'delete']);
    });
    Route::group(['prefix' => 'governments'], function () {
        Route::get('/', [ShippingController::class, 'get_governments']);
        Route::get('/get-shipping/{id}', [ShippingController::class, 'get_shipping']);
    });
    Route::group(['prefix' => 'orders'], function () {
        Route::post('/create-order', [OderApiController::class, 'create_order']);
        Route::get('/my-orders', [OderApiController::class, 'my_orders']);

    });
    Route::group(['prefix' => 'chat'], function () {
        Route::get('/read_messages', [ChatApiController::class, 'read_messages']);
        Route::get('/send_message', [ChatApiController::class, 'send_message']);
        Route::get('/send_message_by_admin', [ChatApiController::class, 'send_messagebyadmin']);
        Route::get('/get_messages', [ChatApiController::class, 'getmessage']);
        Route::get('/check', [ChatApiController::class, 'check_if_merchant_has_opened_room'])->name('chats.check');
        Route::post('/open', [ChatApiController::class, 'start_chat_room'])->name('chats.open');
        Route::patch('/end/{id}', [ChatApiController::class, 'end_chat_room'])->name('chats.end');


    });
    Route::group(['prefix' => 'questions'], function () {
        Route::get('/faq', [QuestionApiController::class, 'get_question']);
    });
    Route::group(['prefix' => 'wallet'], function () {
        Route::get('/balance', [WalletApiController::class, 'get_balance']);
        Route::get('/exchange', [WalletApiController::class, 'request_exchange']);
    });
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/statistics', [DashboardMerchantApiController::class, 'statistics']);
    });
    Route::get('/store', [StoreApiController::class, 'list_products']);

    Route::group(['prefix' => 'store'], function () {
   //     Route::get('/', [StoreApiController::class, 'list_products']);
        Route::post('/create', [StoreApiController::class, 'create_store']);
        Route::post('/add-product', [StoreApiController::class, 'add_product']);
        Route::patch('/edit-product', [StoreApiController::class, 'edit_product']);
        Route::delete('/delete-product', [StoreApiController::class, 'remove_product']);


    });
});

Route::group(['prefix' => 'v1/merchant'], function () {
    Route::get('/payments/verify/{payment?}',[OderApiController::class,'payment_verify'])->name('verify-payment');
    Route::post('/payments/result',[OderApiController::class,'payment_result'])->name('result-payment');
    Route::post('store/verify', [StoreApiController::class, 'verify']);
    Route::get('/store-list', [StoreApiController::class, 'list_products']);
    Route::get('store-countries', [CountryApiController::class, 'index']);
    Route::get('store-product/', [StoreApiController::class, 'store_product']);


});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    // Country
    Route::apiResource('countries', CountryApiController::class);

    // Government
    Route::apiResource('governments', GovernmentApiController::class);

    // Category
    Route::apiResource('categories', CategoryApiController::class);

    // Color
    Route::apiResource('colors', ColorApiController::class);

    // Size
    Route::apiResource('sizes', SizeApiController::class);

    // Product
    Route::apiResource('products', ProductApiController::class);

    // Merchant
    Route::apiResource('merchants', MerchantApiController::class);

    // Penalty
    Route::apiResource('penalties', PenaltyApiController::class);

    // Setting
    Route::post('settings/media', [SettingApiController::class, 'storeMedia'])->name('settings.store_media');
    Route::apiResource('settings', SettingApiController::class);

    // Order
    Route::apiResource('orders', OrderApiController::class);

    // Bonus
    Route::apiResource('bonus', BonuApiController::class);
});
