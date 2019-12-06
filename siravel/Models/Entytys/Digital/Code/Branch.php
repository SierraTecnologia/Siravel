<?php

namespace Informate\Models\Entytys\Digital\Code;

use Informate\Models\Model;

class Branch extends Model
{

    protected $organizationPerspective = true;

    protected $table = 'code_project_branchs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code_project_id',
        'code_project_commit_id',
    ];

    public function getApresentationName()
    {
        return 'Branch '.$this->name;
    }

    public function project()
    {
        return $this->belongsTo('Informate\Models\Entytys\Digital\Code\Project', 'code_project_id', 'id');
    }

}