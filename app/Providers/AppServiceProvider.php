<?php

namespace App\Providers;

use App\Models\ServiceHighlight;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.service-highlights', function ($view) {
            $view->with(
                'serviceHighlights',
                ServiceHighlight::active()->ordered()->get()
            );
        });

        View::composer([
            'partials.footer',
            'partials.home-awards-header',
            'partials.home-contact',
            'contact',
            'testimonials.videos',
        ], function ($view) {
            $view->with('siteSettings', SiteSetting::allCached());
        });
    }
}
