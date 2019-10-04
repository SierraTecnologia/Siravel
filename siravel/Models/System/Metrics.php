<?php

namespace Siravel\Models\System;

use Siravel\Models\Traits\ArchiveTrait;

class Metrics extends ArchiveTrait
{
    public $table = 'metrics';

    public $primaryKey = 'id';

    public $fillable = [
        'token',
        'data',
    ];

    public static $rules = [];
}
