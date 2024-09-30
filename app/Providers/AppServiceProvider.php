<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
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

        if (Schema::hasTable('orders')) {
            // Cache daily sales
            $dailySales = cache()->remember('dailySales', 300, function () {
                return Order::query()
                    ->where('closed', 1)
                    ->whereDate('updated_at', Carbon::today())
                    ->sum('total');
            });
            View::share('dailySales', $dailySales);

            // Cache history sales
            $historySales = cache()->remember('historySales', 3600, function () {
                return Order::query()
                    ->select(DB::raw("SUM(total/100) sales"), DB::raw("DATE_FORMAT(updated_at, '%Y %m') as months"))
                    ->onlyClosed()
                    ->orderBy('months', 'desc')
                    ->groupBy('months')
                    ->take(5)
                    ->get()
                    ->pluck('sales', 'months');
            });
            View::share('historySales', $historySales);

            // Cache sales by product
            $top5products = cache()->remember('top5products', 3600, function () {
                return Product::query()
                    ->where('active', true)
                    ->orderBy('total_sales', 'desc')
                    ->limit(5)
                    ->get()
                    ->pluck('total_sales', 'name');
            });
            View::share('top5products', $top5products);
        }

    }
}
