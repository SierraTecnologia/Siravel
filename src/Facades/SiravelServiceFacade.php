<?php

namespace Siravel\Facades;

use Illuminate\Support\Facades\Facade;

class RiCaServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RiCaService';
    }
}
