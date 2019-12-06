<?php

namespace Informate\Models\Entytys\Digital\Code;

use Informate\Models\Model;

class Stage extends Model
{

    protected $organizationPerspective = false;

    protected $table = 'code_stages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    
}