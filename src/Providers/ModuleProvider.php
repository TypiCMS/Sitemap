<?php
namespace TypiCMS\Modules\Sitemap\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{

    public function register()
    {

        $app = $this->app;

        /**
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Sitemap\Providers\RouteServiceProvider');
    }
}
