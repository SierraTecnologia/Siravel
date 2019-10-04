<?php

namespace App\Logic\RegrasDeNegocios\Fluxo\Actions;

use App\Logic\Info\Steps\BasicRegister;
use App\Logic\Info\Steps\BottomInfos;

class Mimar
{

    public static function Actions()
    {
        return env('APP_FRONT', 'snowevo');
    }

    public static function steps()
    {
        return [
            'myProfile' => [
                BasicRegister::class,
                BottomInfos::class
            ]
        ];
    }


    public static function minhasOBrigacoes()
    {
        $events = [];
        $metas = [];
    }

    public static function agradarMajestade()
    {
        return [
            'Oferecer Mimo'
        ];
    }

    public function mimos()
    {
        // Type: Financeiro:


        // Type: Financeiro:
    }

    
}