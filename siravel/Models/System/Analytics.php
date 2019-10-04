<?php

namespace Siravel\Models\System;

use Siravel\Support\Traits\Models\ArchiveTrait;

use Siravel\Support\Traits\Models\BusinessTrait;

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
