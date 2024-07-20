<?php

use App\Http\Controllers\Admin\BonuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ContactCompanyController;
use App\Http\Controllers\Admin\ContactContactController;
use App\Http\Controllers\Admin\ContentCategoryController;
use App\Http\Controllers\Admin\ContentPageController;
use App\Http\Controllers\Admin\ContentTagController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\FaqQuestionController;
use App\Http\Controllers\Admin\GovernmentController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PenaltyController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TicketCategoryController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\TrainingCategoryController;
use App\Http\Controllers\Admin\TrainingController;


use App\Http\Controllers\Admin\UserAlertController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Route::get('/payments/verify/{payment?}',[HomeController::class,'payment_verify'])->name('verify-payment');

Route::redirect('/', '/login');
Route::get('/test', [HomeController::class, 'test'])->name('test');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // Country
    Route::resource('countries', CountryController::class, ['except' => ['store', 'destroy']]);

    // Government
    Route::resource('governments', GovernmentController::class, ['except' => ['store', 'destroy']]);

    // Category
    Route::resource('categories', CategoryController::class, ['except' => ['store', 'destroy']]);

    // Color
    Route::resource('colors', ColorController::class, ['except' => ['store', 'update', 'destroy']]);

    // Training Category
    Route::resource('training-categories', TrainingCategoryController::class, ['except' => ['store', 'destroy']]);

    // Training
    Route::post('trainings/media', [TrainingController::class, 'storeMedia'])->name('trainings.storeMedia');
    Route::resource('trainings', TrainingController::class, ['except' => ['destroy']]);

    // Size
    Route::resource('sizes', SizeController::class, ['except' => ['store', 'update', 'destroy']]);

    // Product
    Route::resource('products', ProductController::class, ['except' => ['store', 'update', 'destroy']]);
    Route::post('products/media', [ProductController::class, 'storeMedia'])->name('products.storeMedia');

    // Merchant
    Route::resource('merchants', MerchantController::class, ['except' => ['store', 'update', 'destroy']]);

    // Penalty
    Route::resource('penalties', PenaltyController::class, ['except' => ['store', 'update', 'destroy']]);

    // Setting
    Route::post('settings/media', [SettingController::class, 'storeMedia'])->name('settings.storeMedia');
    Route::resource('settings', SettingController::class, ['except' => ['store', 'update', 'destroy']]);

    // Faq Category
    Route::resource('faq-categories', FaqCategoryController::class, ['except' => ['store', 'destroy']]);

    // Faq Question
    Route::resource('faq-questions', FaqQuestionController::class, ['except' => ['store', 'destroy']]);

    // Contact Company
    Route::resource('contact-companies', ContactCompanyController::class, ['except' => ['store', 'update', 'destroy']]);

    // Contact Contacts
    Route::resource('contact-contacts', ContactContactController::class, ['except' => ['store', 'update', 'destroy']]);

    // Content Category
    Route::resource('content-categories', ContentCategoryController::class, ['except' => ['store', 'update', 'destroy']]);

    // Content Tag
    Route::resource('content-tags', ContentTagController::class, ['except' => ['store', 'update', 'destroy']]);

    // Content Page
    Route::post('content-pages/media', [ContentPageController::class, 'storeMedia'])->name('content-pages.storeMedia');
    Route::resource('content-pages', ContentPageController::class, ['except' => ['store', 'update', 'destroy']]);

    // User Alert
    Route::get('user-alerts/seen', [UserAlertController::class, 'seen'])->name('user-alerts.seen');
    Route::resource('user-alerts', UserAlertController::class, ['except' => ['store', 'update', 'destroy']]);

    // Order
    Route::resource('orders', OrderController::class, ['except' => ['store', 'update', 'destroy']]);
    Route::post('orders/change-status/{order}', [OrderController::class, 'change_status'])->name('orders.change_status');

    
    // Bonus
    Route::resource('bonus', BonuController::class, ['except' => ['store', 'update', 'destroy']]);

    // Ticket Category
    Route::resource('ticket-categories', TicketCategoryController::class, ['except' => ['store', 'destroy']]);

    // Ticket
    Route::resource('tickets', TicketController::class, ['except' => ['store', 'update', 'destroy']]);

    // Supplier
    Route::resource('suppliers', SupplierController::class, ['except' => ['store', 'update', 'destroy']]);


    Route::get('chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('chats/live/{id}', [ChatController::class, 'livemessage'])->name('live.chats');
    Route::get('chats/{id}', [ChatController::class, 'single'])->name('chats.single');
    Route::get('chats/send', [ChatController::class, 'send'])->name('chats.send');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('testweb', function () {
    return view('welcome');
});
