<?php

namespace ReferralPanda\OpenCoupon;

use Illuminate\Support\ServiceProvider;

class OpenCouponServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/open_coupon.php', 'open_coupon'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/Routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
        $this->publishes([
            __DIR__.'/config/open_coupon.php' => config_path('open_coupon.php')
        ]);
    }
}
