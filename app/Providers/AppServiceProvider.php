<?php

namespace App\Providers;

use App\Helpers\IEnvironment;
use App\Http\Contracts\IBankContract;
use App\Http\Contracts\IBusinessServiceContract;
use App\Http\Contracts\IChildServiceContract;
use App\Http\Contracts\ICustomerServiceContract;
use App\Http\Contracts\IGatewayServiceContract;
use App\Http\Contracts\IInvoiceContract;
use App\Http\Contracts\IInvoiceServiceContract;
use App\Http\Contracts\IMerchantDetailServiceContract;
use App\Http\Contracts\ITransactionServiceContract;
use App\Http\Contracts\IUserServiceContract;
use App\Http\Repositories\BusinessRepo;
use App\Http\Services\BankService;
use App\Http\Services\BusinessService;
use App\Http\Services\ChildService;
use App\Http\Services\CustomerService;
use App\Http\Services\GatewayService;
use App\Http\Services\InvoiceService;
use App\Http\Services\MerchantDetailService;
use App\Http\Services\TransactionService;
use App\Http\Services\UserService;
use App\Models\Gateway;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        # User Service
        $this->app->singleton(IUserServiceContract::class, function ($app) {
            return $app->make(UserService::class);
        });
        # Bank Service
        $this->app->singleton(IBankContract::class,function ($app){
            return $app->make(BankService::class);
        });

        # Invoice Service
        $this->app->singleton(IInvoiceServiceContract::class,function ($app){
            return $app->make(InvoiceService::class);
        });

        # Customer Service
        $this->app->singleton(ICustomerServiceContract::class,function ($app){
            return $app->make(CustomerService::class);
        });

        # Gateway Service
        $this->app->singleton(IGatewayServiceContract::class,function ($app){
            return $app->make(GatewayService::class);
        });

        #Transaction
        $this->app->singleton(ITransactionServiceContract::class,function ($app){
            return $app->make(TransactionService::class);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
