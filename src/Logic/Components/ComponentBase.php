<?php

namespace Siravel\Logic\Components;

class ComponentBase
{

    public static function getComponents()
    {
        return [
            Carrousel\Base::class,
            Enquete\Base::class,
            Form\Base::class,
        ];
    }
}
