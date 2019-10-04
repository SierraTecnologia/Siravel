<?php

namespace App\Logic\Info\Actions;

use App\Logic\Info\Actions\Fisico;

use App\Logic\Info\Steps\BasicRegister;
use App\Logic\Info\Steps\BottomInfos;

class Ensinar
{

    public static function options()
    {

        // Usar roupa escrito:
        return [
            'A unica diferença entre eu e o mosquito '.
            'é que ele para de chupar quando leva tapa!',
            'cadela'
        ];
    }
}