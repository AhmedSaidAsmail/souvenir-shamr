<?php

namespace App\Providers;

use App\Models\Section;
use App\Repositories\LocalizationRepo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('front.layouts._side_nav', function ($view) {
            $view->with('sideSections', Section::confirmed());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('localization.repo', function ($app) {

            return new LocalizationRepo($app->make('request'));
        });
    }
}
