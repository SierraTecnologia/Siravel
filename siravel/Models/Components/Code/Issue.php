<?php

namespace Siravel\Models\Components\Code;

use Siravel\Models\Model;

class Issue extends Model
{

    protected $organizationPerspective = true;

    protected $table = 'code_issues';

    protected $action = false;

    protected $target = false;

    protected $worker = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'key_name',
        'slug',
        'url',
    ];


    public function project()
    {
        return $this->belongsTo('Siravel\Models\Components\Code\Project', 'code_project_id', 'id');
    }

    
}