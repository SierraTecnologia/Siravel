<?php

namespace App\Models\Identity\Financeiro;

use App\Models\Model;
use App\Models\Traits\ComplexRelationamentTrait;

class Gasto extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descriptions',
        'value',
    ];

    protected $mappingProperties = array(
        'descriptions' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'value' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
    
    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function slaves()
    {
        return $this->morphedByMany('App\Models\Identity\Slave', 'gastoable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'gastoable');
    }
}
