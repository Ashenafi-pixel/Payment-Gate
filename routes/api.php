<?php

use App\Helpers\IUserRole;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Http;
use App\Http\Controllers\Api\OtpController;
use App\Http\Controllers\Api\TransportController;
use App\Http\Controllers\Api\SendMoneyController;
use App\Http\Controllers\Api\MobileTopUpController;
use App\Http\Controllers\Customer\LedgerController;
use App\Http\Controllers\Api\Customer\BusController;
use App\Http\Controllers\Api\Customer\BankController;
use App\Http\Controllers\Api\Customer\LoginController;
use App\Http\Controllers\Api\Customer\ProfileController;
use App\Http\Controllers\Api\Customer\RegisterController;
use App\Http\Controllers\Api\Customer\DocumentController;
use App\Http\Controllers\Api\Customer\UtilityPaymentController;


use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LockScreenController;
use App\Http\Controllers\FormDataController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\UserController;
use App\Http\Controllers\merchant\MerchantController;
Route::post('/register-bank-account', [MerchantController::class, 'merchantBankLink'])->withoutMiddleware(['auth']);
Route::post('/mPOSUser', [UserController::class, 'registerUser'])->withoutMiddleware(['auth']);
Route::post('/consumer-app', [UserController::class, 'registerCustomer'])->withoutMiddleware(['auth']);
Route::post('/consumer-verify', [UserController::class, 'approveCustomer'])->withoutMiddleware(['auth']);
Route::post('/consumer-resend', [UserController::class, 'resendOTP'])->withoutMiddleware(['auth']);
Route::post('/receive-data', [FormDataController::class, 'receiveData'])->withoutMiddleware(['auth']);
Route::post('/consumer-app', [UserController::class, 'registerCustomer'])->withoutMiddleware(['auth']);
Route::post('/consumer-verify', [UserController::class, 'approveCustomer'])->withoutMiddleware(['auth']);
Route::post('/consumer-resend', [UserController::class, 'resendOTP'])->withoutMiddleware(['auth']);
// Route::post('receive-data', [FormDataController::class, 'receiveData'])->name('data.receive');

Route::get('/show-status/{merchant_id}', [UserController::class, 'showStatus'])->withoutMiddleware(['auth']);
Route::group(['middleware' => []], function () {
    Route::post('/your-route', [UserController::class, 'registerUser']);
});
Route::group(['prefix' => 'customer'],function (){
    # Customer Register Route
    Route::post('register',[RegisterController::class,'register']);
    # Customer Login Route
    Route::post('login',[LoginController::class,'login']);

    Route::get('seat-plans',[TransportController::class,'getSeatPlans']);

    Route::get('get-trip',[TransportController::class,'getTrips']);


    #forget Password
    Route::post('forgot-password',[LoginController::class,'forgotPassword']);
    # Get Transport Service
    Route::get('getTransportService',[BusController::class,'getTransportService']);

    # Customer Authenticated Routes
    Route::group(['middleware' => ['auth:api']],function (){
        # Customer Logout Route
        Route::post('logout',[LoginController::class,'logout']);
        # Customer Resend Otp Route
        Route::post('resend-otp',[LoginController::class,'resendVerifyOtp']);
        # Customer Upload Documents
        Route::post('upload-documents',[DocumentController::class,'uploadDocuments']);
        # Dummy Accounts
        Route::get('dummy-accounts',[DocumentController::class,'dummyData']);
        # Verify Otp
        Route::post('verify-otp',[LoginController::class,'verifyOtp']);
        # Resset Password
        Route::post('reset-password',[LoginController::class,'resetPassword']);
        # Utility Payment Get Bill Data
        Route::post('get-bill',[UtilityPaymentController::class,'getBillData']);
        # Utility Payment Pay Bill Data
        Route::post('pay-bill',[UtilityPaymentController::class,'payBillData']);
    });
    Route::group(['middleware' => ['auth:api',sprintf('role-authenticator:%s', IUserRole::CUSTOMER_ROLE),'is_customer_verified']],function (){
       # Customer get All Banks
       Route::get('all-banks',[BankController::class,'index']);
       # Customer Send Money Api
       Route::post('send-money',[SendMoneyController::class,'sendMoney']);
       # Route Get Mobile Top Up Companies List
       Route::get('telecom-companies',[MobileTopUpController::class,'index']);
       # Route Mobile Top Up Api
       Route::post('top-up',[MobileTopUpController::class,'mobileTopUp']);
       # Send Otp For Any Transaction
       Route::post('send-transaction-otp',[OtpController::class,'sendTransactionsOtp']);
       # Verify Otp
       Route::post('verify-transaction-otp',[OtpController::class,'verifyVerificationOtp']);
       # Get Transaction
        Route::get('get-transactions',[LedgerController::class,'getTransactions']);
        #Set and Change Pin
        Route::post('set-pin',[ProfileController::class,'setPin']);
        Route::post('reset-pin',[ProfileController::class,'resetPin']);
    });

    Route::get('migrate',function (){
        Artisan::call('migrate');
    });
});



