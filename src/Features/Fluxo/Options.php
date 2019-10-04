<?php

namespace App\Logic\Fluxo;

class Options
{

    public static function returnSiteLocale()
    {
        return env('APP_FRONT', 'snowevo');
    }
}