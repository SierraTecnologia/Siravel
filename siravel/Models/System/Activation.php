<?php

namespace Informate\Models\System;

use Siravel\Modela\Model;

class Activation extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}