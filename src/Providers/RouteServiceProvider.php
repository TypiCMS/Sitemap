<?php

namespace TypiCMS\Modules\Sitemap\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Sitemap\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the application.
     */
    public function map()
    {
        /*
         * Front office routes
         */
        Route::get('sitemap.xml', [PublicController::class, 'generate'])->name('sitemap');
    }
}
