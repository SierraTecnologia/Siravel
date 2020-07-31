<?php

namespace Siravel\Features\Productions;

class Base
{

    public $name = 'Productions';
    public $code = 'productions';

    /**
     * 
     * @var array
     */
    protected $modelAdmins = [
        \Siravel\Models\Production::class,
    ];

    public function getAdminMenu()
    {
        // Route::resource('productions', 'Admin\ProductionsController');
    }

    public function getSiteMenu()
    {
        $s = 'production';
        Route::post('/production', ['as' => $s . 'production',   'uses' => 'ProductionsController@postProduction']);
    }
}
