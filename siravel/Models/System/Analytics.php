<?php

namespace Siravel\Models\System;

use Siravel\Models\Traits\ArchiveTrait;

use Siravel\Models\Traits\BusinessTrait;

class Analytics extends ArchiveTrait
{
    use BusinessTrait;
    
    public $table = 'analytics';

    public $primaryKey = 'id';

    public $fillable = [
        'token',
        'data',
    ];

    public static $rules = [];
}
