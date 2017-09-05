<?php

namespace TypiCMS\Modules\Sitemap\Http\Controllers;

use Illuminate\Routing\Controller;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Pages\Facades\Pages;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function generate()
    {
        // create new sitemap object
        $sitemap = app('sitemap');

        // set cache (key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean))
        // by default cache is disabled
        if (config('typicms.cache')) {
            $sitemap->setCache('laravel.sitemap', 3600);
        }

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {
            foreach (TypiCMS::enabledLocales() as $locale) {
                app()->setLocale($locale);

                $pages = Pages::allBy('private', 0);

                foreach ($pages as $page) {
                    $url = url($page->uri($locale));
                    $sitemap->add($url, $page->updated_at);

                    if (!$module = ucfirst($page->module)) {
                        continue;
                    }

                    if (!class_exists($module)) {
                        continue;
                    }

                    foreach ($module::all() as $item) {
                        $url = url($item->uri($locale));
                        $sitemap->add($url, $item->updated_at);
                    }
                }
            }
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }
}
