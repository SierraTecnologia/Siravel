<?php

namespace Siravel\Features\Travels;

class Base
{

    public $name = 'Travels';
    public $code = 'travels';

    /**
     * 
     * @var array
     */
    protected $modelAdmins = [
        \Siravel\Models\Hotel::class,
        \Siravel\Models\Room::class,
        \Siravel\Models\Travel::class,
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
