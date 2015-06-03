<?php
namespace TypiCMS\Modules\Sitemap\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{

    public function register()
    {

        /**
         * Register sitemap package
         */
        $this->app->register('Roumen\Sitemap\SitemapServiceProvider');

        /**
         * Register route service provider
         */
        $this->app->register('TypiCMS\Modules\Sitemap\Providers\RouteServiceProvider');
    }
}
