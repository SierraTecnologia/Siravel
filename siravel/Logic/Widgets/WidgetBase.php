<?php

namespace Siravel\Logic\Widgets;

class WidgetBase
{

    public static function getWidgets()
    {
        return [
            Autoatendimento\Base::class,
            TrackingVisitant\Base::class,
        ];
    }
}
