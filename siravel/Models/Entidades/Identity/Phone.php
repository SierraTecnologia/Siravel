<?php

namespace Siravel\Models\Identity;

use Siravel\Models\Model;
use Siravel\Models\Traits\ComplexRelationamentTrait;

class Phone extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'number' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
    
    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function slaves()
    {
        return $this->morphedByMany('App\Models\Identity\Slave', 'skillable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'skillable');
    }
}
