<?php

namespace TypiCMS\Modules\Sitemap\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Sitemap\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        /*
         * Front office routes
         */
        Route::get('sitemap.xml', [PublicController::class, 'generate'])->name('sitemap');
    }
}
