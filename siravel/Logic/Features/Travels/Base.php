<?php

namespace Siravel\Logic\Features\Travels;

class Base
{

    public $name = 'Travels';
    public $code = 'travels';

    /**
     * 
     * @var array
     */
    protected $modelAdmins = [
        \App\Models\Hotel::class,
        \App\Models\Room::class,
        \App\Models\Travel::class,
    ];

    public function getAdminMenu()
    {
        // Route::resource('travels', 'Admin\TravelsController');
        // Route::resource('hotels', 'Admin\HotelsController');
        // Route::resource('rooms', 'Admin\RoomsController');
    }

    public function getSiteMenu()
    {
        $s = 'travels';
        Route::get('/',         ['as' => $s . 'home',   'uses' => 'PagesController@getHome']);
        Route::get('contato', array('as' => $s . 'contact', 'uses' =>'PagesController@contact'));
        Route::post('/contact', ['as' => $s . 'contact',   'uses' => 'PagesController@postContact']);
        Route::post('/travel', ['as' => $s . 'travel',   'uses' => 'TravelsController@postTravel']);
        Route::get('/booking/{name?}', ['as' => $s . 'travel',   'uses' => 'TravelsController@postTravel']);
    }
}
