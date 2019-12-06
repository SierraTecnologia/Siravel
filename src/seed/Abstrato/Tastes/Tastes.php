<?php

namespace SiSeed\Abstrato\Tastes;

use Informate\Models\Entytys\Fisicos\Gosto;

class Tastes
{
    public function getTasteInstance()
    {
        return Gosto::find(static::$code);
    }
}