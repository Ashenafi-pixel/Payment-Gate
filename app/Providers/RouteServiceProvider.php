<?php

namespace App\Providers;

use App\Helpers\IUserRole;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::group(['middleware' => ['try_catch']], function (){
                $this->_mapAdminRoutes();
                $this->_mapMerchantRoutes();
                $this->_mapCustomerRoutes();
            });
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * @return void
     */
    private function _mapAdminRoutes():void
    {
        Route::middleware(['web','auth',sprintf('role-authenticator:%s', IUserRole::ADMIN_ROLE)])
            ->prefix(IUserRole::ADMIN_ROLE)
            ->namespace($this->namespace)
            ->as(IUserRole::ADMIN_ROLE.'.')
            ->group(base_path('routes/admin-routes.php'));
    }

    /**
     * @return void
     */
    private function _mapMerchantRoutes():void
    {
        Route::middleware(['web','auth',sprintf('role-authenticator:%s', IUserRole::MERCHANT_ROLE),'document_verified'])
            ->prefix(IUserRole::MERCHANT_ROLE)
            ->namespace($this->namespace)
            ->group(base_path('routes/merchant-routes.php'));
    }

    /**
     * @return void
     */
    private function _mapCustomerRoutes():void
    {
        Route::middleware(['web','auth',sprintf('role-authenticator:%s', IUserRole::CUSTOMER_ROLE),'is_customer_verified','document_verified'])
            ->prefix(IUserRole::CUSTOMER_ROLE)
            ->namespace($this->namespace)
            ->group(base_path('routes/customer-routes.php'));
    }
}
