<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use App\Repositories\LocalizationModelRepo;
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
        view()->composer('front.layouts._main_nav', function ($view) {
            $view->with('sections', Section::confirmed(6));
        });
        view()->composer('front.layouts._welcome_upper_section', function ($view) {
            $view->with('recommended_categories', Category::recommendationCategories());
        });
        view()->composer('front.welcome', function ($view) {
            $recommendation = Product::recommendationProducts();
            $popular = Product::popularProducts();
            $top = Product::topProducts();
            $homeCategories=Category::homeCategories();
            $view->with(compact('recommendation', 'popular', 'top','homeCategories'));
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
        $this->app->singleton('localization.model', function ($app) {

            return new LocalizationModelRepo($app->make('request'));
        });
    }
}
