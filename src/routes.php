<?php
/**
 * Sitemap
 */
Route::get(
    'sitemap.xml',
    array(
        'as'   => 'sitemap',
        'uses' => 'TypiCMS\Modules\Sitemap\Http\Controllers\PublicController@generate'
    )
);
