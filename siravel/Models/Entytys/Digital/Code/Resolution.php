<?php

namespace Siravel\Models\Entytys\Digital\Code;

use Siravel\Models\Model;

class Resolution extends Model
{

    protected $organizationPerspective = false;

    protected $table = 'code_resolutions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    
}