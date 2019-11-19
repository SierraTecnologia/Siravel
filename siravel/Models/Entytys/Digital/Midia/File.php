<?php

namespace Siravel\Models\Entytys\Digital\Midia;

use SiObjects\Support\Traits\Models\ArchiveTrait;

class File extends ArchiveTrait
{
    public $table = 'files';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'location' => 'required',
    ];
}
