<?php

namespace Siravel\Logic\Features;

class FeatureBase
{

    public static function getFeatures()
    {
        return [
            Blog\Base::class,
            Commerce\Base::class,
            Gamification\Base::class,
            Fa\Base::class,
            Marketing\Base::class,
            Midias\Base::class,
            Writelabel\Base::class,
            Productions\Base::class,
            Travels\Base::class,
        ];
    }
}
