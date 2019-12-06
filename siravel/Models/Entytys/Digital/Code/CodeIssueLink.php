<?php

namespace Informate\Models\Entytys\Digital\Code;

use Informate\Models\Model;

class CodeIssueLink extends Model
{
    protected $organizationPerspective = false;

    protected $table = 'code_issue_links';      

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