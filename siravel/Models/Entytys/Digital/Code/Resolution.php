<?php

namespace Informate\Models\Entytys\Digital\Code;

use Informate\Models\Model;

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