<?php


use App\Http\Controllers;
use App\Helpers\IUserRole;
use App\Http\Controllers\Merchant\DashboardController;
use App\Http\Controllers\Merchant\DocumentController as MerchantDocumentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserVerifyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

# Customer Support
Route::get('customer-support', function () {
    return view('frontend.customer-support');
})->name('customer.support');
Route::post('save/refund-request',[Controllers\RefundRequestController::class,'saveRefundRequest'])->name('save.refund.request');
Route::get('otp/refund-request',[Controllers\RefundRequestController::class,'otpView'])->name('refund.request.otp.view');
Route::post('verify-otp/refund-request',[Controllers\RefundRequestController::class,'verifyOtp'])->name('verify.refund.request.otp');

# Invoice View
Route::get('invoices-pay/{invoice_id}',[Controllers\Web\InvoiceController::class,'payInvoiceView'])->name(IUserRole::MERCHANT_ROLE.'.invoices.pay');
Route::post('pay-invoice/{id}',[Controllers\Web\InvoiceController::class,'payInvoice'])->name('pay-invoice');

# PayTabs
Route::get('payment-pay-tabs',[Controllers\Web\InvoiceController::class,'payTabsCreate'])->name('pay-tabs-create');
Route::post('store-pay-tabs-payment',[Controllers\Web\InvoiceController::class,'storePayTabs'])->name('store-pay-tabs-payment');
Route::get('paytabs-callback',[Controllers\Web\InvoiceController::class,'callBackPayTabs'])->name('paytabs-callback');
Route::get('thankyou', [Controllers\Web\InvoiceController::class,'thankyou'])->name('thankyou');

# qr code
Route::get('create-invoice-qr', [Controllers\Merchant\EposController::class,'eposForm'])->name('eposForm');
Route::post('create-invoice-qr', [Controllers\Merchant\EposController::class,'storeInvoiceFromQr'])->name('epos.invoice');

Auth::routes();
# Merchant signup flow
Route::get('merchant-register', [Controllers\Auth\RegisterController::class,'merchantCreate'])->name(IUserRole::MERCHANT_ROLE.'.register.form');
Route::post('merchant-register', [Controllers\Auth\RegisterController::class,'merchantRegister'])->name(IUserRole::MERCHANT_ROLE.'.register');
# Forgot Password Routes
Route::get('forgot-password', [Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('user.forgot.password');
Route::post('send/forgot-password/link', [Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('user.forgot.password.link');
# Reset password Routes
Route::post('/reset-password', [Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('user.reset.password');
Route::get('/reset-password-form/{token}', [Controllers\Auth\ResetPasswordController::class, 'index'])->name('user.reset.password.form');
# Verify Merchant email Routes
Route::get('email-otp-verify/{token}', [Controllers\Auth\EmailVerifyController::class, 'index'])->name('user.email.token.form');
# Verify Customer using Phone with OTP Routes
Route::get('verify-user', [UserVerifyController::class,'showCustomerVerifyForm'])->name(IUserRole::CUSTOMER_ROLE.'.profile.verify.otp.form');
Route::post('resend-verify-otp',[UserVerifyController::class,'resendVerifyOtp'])->name(IUserRole::CUSTOMER_ROLE.'.profile.resend.otp');
Route::post('verify-user-otp', [UserVerifyController::class,'verifyCustomerOtp'])->name(IUserRole::CUSTOMER_ROLE.'.profile.verify.otp');

# Lock Screen Routes
Route::get('lock-screen', [Controllers\Auth\LockScreenController::class, 'lockScreen'])->middleware('auth')->name('user.lock.screen');
Route::post('unlock-screen', [Controllers\Auth\LockScreenController::class, 'unLockScreen'])->name('user.unlock.screen');
Route::get('login-unlock', [Controllers\Auth\LockScreenController::class, 'loginInsteadUnlock'])->name('user.login-instead-unlock');
Route::get('/checkout', [Controllers\Auth\LockScreenController::class, 'showCheckout'])->name('showCheckout');
Route::post('/process-payment', [Controllers\Auth\LockScreenController::class, 'processPayment'])->name('processPayment');



# Document Approval Routes
Route::get('merchant/document-upload', [Controllers\Merchant\DocumentController::class, 'index'])->name(IUserRole::MERCHANT_ROLE.'.approval.documents');
Route::get('customer/document-upload', [Controllers\Customer\DocumentController::class, 'index'])->name(IUserRole::CUSTOMER_ROLE.'.approval.documents');
Route::post('merchant/store-document-upload',[MerchantDocumentController::class,'store'])->name(IUserRole::MERCHANT_ROLE.'.store.approval.documents');
Route::post('customer/store-document',[Controllers\Customer\DocumentController::class,'store'])->name(IUserRole::CUSTOMER_ROLE.'.store.document');


Route::get('dashboard', function () {
    return view('backend.admin.dashboard');
});
Route::get('profile',function(){
    return view('backend.admin.profile.edit-profile');
});
Route::get('merchant',function(){
    return view('backend.admin.merchant.all-merchant.index');
});

Route::get('add-invoices',function(){
    return view('backend.merchant.invoice.invoice');
});
Route::get('invoice',function(){
    return view('frontend.invoice.index');
});

Route::get('/app', function () {
    return view('backend.layouts.app');

});
