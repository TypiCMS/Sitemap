<?php
namespace TypiCMS\Modules\Sitemap\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Route;

class PublicController extends Controller
{
    private $modules = array();

    public function __construct()
    {
        $this->modules = config('sitemap.modules');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
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
        if (! $sitemap->isCached()) {

            foreach (config('translatable.locales') as $locale) {

                App::setLocale($locale);

                foreach ($this->modules as $module) {

                    if (! class_exists($module)) {
                        continue;
                    }

                    $items = $module::all();

                    foreach ($items as $item) {
                        if ($module == 'Pages') {
                            $url = url($item->uri);
                        } else {
                            if (Route::has($locale . '.' . $item->getTable() . '.categories.slug')) {
                                // Module with category
                                $url = route(
                                    $locale . '.' . $item->getTable() . '.categories.slug',
                                    [$item->category->slug, $item->slug]
                                );
                            } else {
                                 // Module without category
                                $url = route($locale . '.' . $item->getTable() . '.slug', $item->slug);
                            }
                        }
                        $sitemap->add($url, $item->updated_at);
                    }

                }

            }

        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');

    }
}
