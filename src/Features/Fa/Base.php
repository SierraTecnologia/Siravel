<?php

namespace Siravel\Features\Fa;

class Base
{

    public $name = 'Fa';
    public $code = 'fa';

    /**
     * 
     * @var array
     */
    protected $modelAdmins = [
        \Siravel\Models\Fa::class,
    ];

    public function getAdminMenu()
    {
        // Route::resource('fa', 'Admin\FaController');
        
    }

    public function getSiteMenu()
    {
        Route::post('/fa', ['as' => $s . 'fa',   'uses' => 'FaController@postTravel']);
        
    }
}
