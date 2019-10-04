<?php

namespace App\Models\Code;

use App\Models\Model;

class Field extends Model
{

    protected $organizationPerspective = false;

    protected $table = 'code_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    
}