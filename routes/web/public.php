<?php



// @todo
// Route::get('midia-preview/{encFileName}', 'MidiaController@asPreview');
// Route::get('midia-full/{encFileName}', 'MidiaController@asFull');
// Route::get('midia-download/{encFileName}/{encRealFileName}', 'MidiaController@asDownload');

/*
|--------------------------------------------------------------------------
| Basic WriteLabels Pages
|--------------------------------------------------------------------------
*/
Route::get('{module}/rss', 'RssController@index');
Route::get('site-map', 'SiteMapController@index');



/*
|--------------------------------------------------------------------------
| Features Routes
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'Features'/*, 'as' => 'public.'*/], function () {

    
    /**
     * Writelabel
     */
    Route::group(['namespace' => 'Writelabel', 'as' => 'writelabel.'], function () {
        Route::get('/', 'PagesController@home');
        Route::get('home', 'PagesController@home');
        Route::get('pages', 'PagesController@all');
        Route::get('page/{url}', 'PagesController@show');
        Route::get('p/{url}', 'PagesController@show');

        Route::get('faqs', 'FaqController@all');
    });

    // /**
    //  * Midia @todo
    //  */
    // Route::group(['namespace' => 'Midia', 'as' => 'midia.'], function () {
    //     Route::get('gallery', 'GalleryController@all');
    //     Route::get('gallery/{tag}', 'GalleryController@show');
        
    //     Route::get('midia-preview/{midiaId}', 'MidiaController@asPreview');
    //     Route::get('midia-full/{midiaId}', 'MidiaController@asFull');
    //     Route::get('midia-download/{midiaId}/{encRealFileName}', 'MidiaController@asDownload');
    // });

    /**
     * Blog
     */
    Route::group(['namespace' => 'Blog', 'as' => 'blog.'], function () {
        Route::get('blog', 'BlogController@all');
        Route::get('blog/{url}', 'BlogController@show');
        Route::get('blog/tags/{tag}', 'BlogController@tag');
    });

    /**
     * Calendar
     */
    Route::group(['namespace' => 'Calendar', 'as' => 'calendar.'], function () {
        Route::get('events', 'EventsController@calendar');
        Route::get('events/{month}', 'EventsController@calendar');
        Route::get('events/all', 'EventsController@all');
        Route::get('events/date/{date}', 'EventsController@date');
        Route::get('events/event/{id}', 'EventsController@show');
    });

    /**
     * Commerce
     */
    Route::group(['namespace' => 'Commerce', 'as' => 'commerce.'], function () {
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . "public". DIRECTORY_SEPARATOR . "commerce.php";
    });
});
