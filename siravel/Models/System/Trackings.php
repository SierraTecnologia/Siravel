<?php

namespace Siravel\Models\System;

use Siravel\Support\Traits\Models\ArchiveTrait;

use Siravel\Support\Traits\Models\BusinessTrait;

class Trackings extends ArchiveTrait
{
    use BusinessTrait;
    
    public $table = 'trackings';

    public $primaryKey = 'id';

    public $fillable = [
        'token',
        'data',
    ];

    public static $rules = [];
}
