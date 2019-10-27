<?php

namespace SiSeed\Abstrato\Tastes;

use Siravel\Models\Identity\Hability\Gosto;

class Tastes
{
    public function getTasteInstance()
    {
        return Gosto::find(static::$code);
    }
}