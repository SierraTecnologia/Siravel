<?php

namespace App\Models\Code;

use App\Models\Model;

class Language extends Model
{
    protected $organizationPerspective = false;

    protected $table = 'code_languages';      

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'code_language_id',
        'status',
    ];
}