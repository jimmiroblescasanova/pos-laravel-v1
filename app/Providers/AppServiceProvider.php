<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(125);
        Carbon::setLocale($this->app->getLocale());
        setlocale(LC_TIME, $this->app->getLocale());

        // Cache daily sales
        $dailySales = cache()->remember('dailySales', 300, function () {
            return Order::query()
                ->where('closed', 1)
                ->whereDate('updated_at', Carbon::today())
                ->sum('total');
        });

        View::share('dailySales', $dailySales);
    }
}
