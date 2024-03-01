<?php


use App\Helpers\IUserRole;
use App\Http\Controllers\Customer\LedgerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\DocumentController;


#Customer Module Routes
Route::get('dashboard', [DashboardController::class, 'index'])->name(IUserRole::CUSTOMER_ROLE .'.index');
#Customer ledger
Route::get('ledger',[LedgerController::class,'index'])->name(IUserRole::CUSTOMER_ROLE.'.ledger.index');
#Verify Customer
Route::get('profile', [ProfileController::class, 'index'])->name(IUserRole::CUSTOMER_ROLE . '.profile.view');
Route::post('update-profile', [ProfileController::class,'updateProfile'])->name(IUserRole::CUSTOMER_ROLE. '.profile.update');
Route::post('update-password', [ProfileController::class,'updatePassword'])->name(IUserRole::CUSTOMER_ROLE. '.profile.change.password');
Route::post('set-pin',[ProfileController::class,'setPin'])->name(IUserRole::CUSTOMER_ROLE.'.profile.set.pin');
Route::post('reset-pin',[ProfileController::class,'resetPin'])->name(IUserRole::CUSTOMER_ROLE.'.profile.reset.pin');


