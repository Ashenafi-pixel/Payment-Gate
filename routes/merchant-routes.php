<?php

use App\Helpers\IUserRole;
use App\Http\Controllers\Merchant\CustomerController;
use App\Http\Controllers\Merchant\ImportCustomerController;
use App\Http\Controllers\Merchant\ImportStudentController;
use App\Http\Controllers\Merchant\InvoiceController;
use App\Http\Controllers\Merchant\MerchantGatewayController;
use App\Http\Controllers\Merchant\StudentController;
use App\Http\Controllers\Merchant\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant\ProfileController;
use App\Http\Controllers\Merchant\DashboardController;
use App\Http\Controllers\MerchantBanksController;

# Merchant Dashboard Routes
Route::get('dashboard', [DashboardController::class, 'index'])->name(IUserRole::MERCHANT_ROLE.'.index');

Route::get('epos', [DashboardController::class,'ePos'])->name(IUserRole::MERCHANT_ROLE.'.epos');
# Merchant Profile Route
Route::get('profile', [ProfileController::class,'index'])->name(IUserRole::MERCHANT_ROLE. '.profile.view');
Route::post('update-profile', [ProfileController::class,'updateProfile'])->name(IUserRole::MERCHANT_ROLE. '.profile.update');
Route::post('update-password', [ProfileController::class,'updatePassword'])->name(IUserRole::MERCHANT_ROLE. '.profile.change.password');
Route::post('set-pin',[ProfileController::class,'setPin'])->name(IUserRole::MERCHANT_ROLE.'.profile.set.pin');
Route::post('reset-pin',[ProfileController::class,'resetPin'])->name(IUserRole::MERCHANT_ROLE.'.profile.reset.pin');
# Merchant Invoice Route
Route::get('invoices',[InvoiceController::class,'index'])->name(IUserRole::MERCHANT_ROLE.'.invoices.index');
Route::get('invoices-create',[InvoiceController::class,'createInvoiceForm'])->middleware('check_gateways_status')->name(IUserRole::MERCHANT_ROLE.'.invoices.form');
Route::post('invoices-save',[InvoiceController::class,'saveInvoice'])->name(IUserRole::MERCHANT_ROLE.'.invoices.save');
Route::get('view-invoice/{invoice_id}',[InvoiceController::class,'viewInvoice'])->name(IUserRole::MERCHANT_ROLE.'.invoice.view');
Route::post('refund-invoice',[InvoiceController::class,'refundInvoice'])->name(IUserRole::MERCHANT_ROLE.'.invoice.refund');
Route::get('invoices/refund-request',[InvoiceController::class,'refundRequest'])->name(IUserRole::MERCHANT_ROLE.'.invoice.refund.request');

# Merchant Students Route
Route::get('students',[StudentController::class,'index'])->name(IUserRole::MERCHANT_ROLE.'.students.index');
Route::get('create-student',[StudentController::class,'createStudentForm'])->name(IUserRole::MERCHANT_ROLE.'.student.create.form');
Route::post('create-student',[StudentController::class,'saveStudent'])->name(IUserRole::MERCHANT_ROLE.'.student.create');
Route::get('update-student/{student_id}',[StudentController::class,'editStudentForm'])->name(IUserRole::MERCHANT_ROLE.'.student.edit.form');
Route::put('update-student/{student_id}',[StudentController::class,'updateStudentForm'])->name(IUserRole::MERCHANT_ROLE.'.student.update');

# Merchant Import Student Route's
Route::post('import-students',[StudentController::class,'importStudents'])->name(IUserRole::MERCHANT_ROLE.'.students.import');

# Merchant Customer Route's
Route::get('customers',[CustomerController::class,'index'])->name(IUserRole::MERCHANT_ROLE.'.customers.index');
Route::get('create-customer',[CustomerController::class,'createCustomerForm'])->name(IUserRole::MERCHANT_ROLE.'.customer.create.form');
Route::post('create-customer',[CustomerController::class,'saveCustomer'])->name(IUserRole::MERCHANT_ROLE.'.customer.create');
Route::get('edit-customer/{id}',[CustomerController::class,'editCustomerForm'])->name(IUserRole::MERCHANT_ROLE.'.customer.edit.form');
Route::post('update-customer',[CustomerController::class,'updateCustomer'])->name(IUserRole::MERCHANT_ROLE.'.customer.update');

# Merchant Import Customer Route's
Route::post('import-customers',[CustomerController::class,'importCustomers'])->name(IUserRole::MERCHANT_ROLE.'.customers.import');

# Merchant Gateway Controller
Route::get('gateways',[MerchantGatewayController::class,'index'])->name(IUserRole::MERCHANT_ROLE.'.gateway.index');
Route::get('gateway-install/{id}',[MerchantGatewayController::class,'installGatewayForm'])->name(IUserRole::MERCHANT_ROLE.'.gateway.install.form');
Route::post('gateway-install/{id}',[MerchantGatewayController::class,'installGateway'])->name(IUserRole::MERCHANT_ROLE.'.gateway.install');


# Transactions
Route::get('transactions',[TransactionController::class,'getMerchantsAllTransactions'])->name(IUserRole::MERCHANT_ROLE.'.transactions.index');

Route::get('banks',[MerchantBanksController::class,'index'])->name(IUserRole::MERCHANT_ROLE.'.bank');
Route::get('{bank}/banks/create',[MerchantBanksController::class,'create'])->name(IUserRole::MERCHANT_ROLE.'.bank.create');
Route::post('banks',[MerchantBanksController::class,'store'])->name(IUserRole::MERCHANT_ROLE.'.bank.store');