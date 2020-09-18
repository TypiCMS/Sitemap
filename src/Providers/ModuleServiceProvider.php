<?php

namespace TypiCMS\Modules\Sitemap\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        /*
         * Register route service provider
         */
        $this->app->register(RouteServiceProvider::class);
    }
}
