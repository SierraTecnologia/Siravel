<?php

namespace SiravelFacades;

use Illuminate\Support\Facades\Facade;

class Features extends Facade
{
    /**
     * Create the Facade
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'FeatureService'; }
}