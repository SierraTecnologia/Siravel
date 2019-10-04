<?php

namespace App\Models\System;

use App\Models\Traits\ArchiveTrait;

use App\Models\Traits\BusinessTrait;

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
