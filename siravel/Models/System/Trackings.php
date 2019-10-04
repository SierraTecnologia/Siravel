<?php

namespace Siravel\Models\System;

use Siravel\Models\Traits\ArchiveTrait;

use Siravel\Models\Traits\BusinessTrait;

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
