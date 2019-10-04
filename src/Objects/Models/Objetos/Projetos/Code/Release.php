<?php

namespace App\Models\Code;

use App\Models\Model;

class Release extends Model
{

    protected $organizationPerspective = true;

    protected $table = 'code_releases';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'status',
        'start',
        'release',
        'code_project_id',
    ];
    

}