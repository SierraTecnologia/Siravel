<?php

namespace Siravel\Features\Marketing;

class Base
{

    public $name = 'Marketing';
    public $code = 'marketing';

    /**
     * 
     * @var array
     */
    protected $modelAdmins = [
        \Siravel\Models\Marketing::class,
    ];

    public function getAdminMenu()
    {
        // Route::resource('marketings', 'Admin\MarketingsController');

    }

    public function getSiteMenu()
    {
        $s = 'marketing';
        Route::post('/marketing', ['as' => $s . 'marketing',   'uses' => 'MarketingsController@postTravel']);
        
    }
}
