<?php

use App\Helpers\IUserRole;
use App\Http\Controllers\Admin\BanksController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\GatewayController;
use App\Http\Controllers\Admin\TransactionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LogsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Customer\LedgerController;
use Symfony\Component\VarDumper\VarDumper;


# Admin Dashboard Routes
Route::get('dashboard', [DashboardController::class, 'index'])->name('index');
# Profile Route's
Route::get('profile', [ProfileController::class, 'index'])->name('profile.view');
Route::post('update-profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('update-password', [ProfileController::class, 'updatePassword'])->name('profile.change.password');
Route::post('set-pin',[ProfileController::class,'setPin'])->name('profile.set.pin');
Route::post('reset-pin',[ProfileController::class,'resetPin'])->name('profile.reset.pin');

# Merchant Module
Route::get('merchants', [MerchantController::class, 'index'])->name('merchants.index');
Route::get('merchants/create-merchant', [MerchantController::class, 'create'])->name('merchants.create');
Route::post('store-merchant', [MerchantController::class, 'store'])->name('merchants.store');
Route::get('merchant-edit/{merchant_id}', [MerchantController::class, 'editMerchant'])->name('merchant.edit');
Route::post('merchant-edit/{merchant_id}', [MerchantController::class, 'updateMerchant'])->name('merchant.update');
Route::get('merchant-delete/{merchant_id}', [MerchantController::class, 'deleteMerchant'])->name('merchant.delete');


Route::get('getall', [MerchantController::class, 'display'])->name('display');
# Customer Module
Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('customers/create-customer', [CustomerController::class, 'create'])->name('customers.create');
Route::post('store-customer', [CustomerController::class, 'store'])->name('customers.store');

# Documents Approval routes
Route::get('pending-merchants', [DocumentController::class, 'pendingMerchants'])->name('merchant.documents.index');
Route::get('pending-customers', [DocumentController::class, 'pendingCustomers'])->name('customer.documents.index');
Route::get('pending-customer-documents/{id}', [DocumentController::class, 'customerDocumentView'])->name('customer.document.view');
Route::get('pending-merchant-documents/{id}', [DocumentController::class, 'merchantDocumentView'])->name('merchant.document.view');
Route::post('approve-documents', [DocumentController::class, 'approveDocuments'])->name('approve.document');

# Gateways Routes
Route::get('gateways', [GatewayController::class, 'index'])->name('gateways.index');
Route::get('update-gateway/{gateway_id}', [GatewayController::class, 'editGatewayForm'])->name('gateway.edit.form');
Route::put('update-gateway/{gateway_id}', [GatewayController::class, 'updateGatewayForm'])->name('gateway.update');

# Banks Routes
Route::get('banks', [BanksController::class, 'index'])->name('banks.index');

# Currency Routes
Route::get('currency', [CurrencyController::class, 'index'])->name('currency.index');

# Ledger Routes
Route::get('ledgers',[TransactionsController::class,'index'])->name('transactions.index');

# Customer Ledger Routes
Route::get('customer-ledgers',[TransactionsController::class,'customerLedgers'])->name('ledgers.customer');

# Logs Management Routes
Route::get('all', [LogsController::class, 'index'])->prefix('logs')->name('logs');


# Cache clear
Route::get('cache-clear', function () {
    Artisan::call('optimize:clear');
    VarDumper::dump('Optimised clear');
});
# DB-seeder
Route::get('db-seed', function () {
    Artisan::call('migrate:fresh --seed');
    Artisan::call('passport:install');
});
Route::get('migration',function (){
   $res = \Illuminate\Support\Facades\Artisan::call('migrate');
   VarDumper::dump("migrations run ".$res);
});
Route::get('call-seeder',function (){
   $call = \Illuminate\Support\Facades\Artisan::call('db:seed --class=TransactionTypeSeeder');
   dd($call);
});
