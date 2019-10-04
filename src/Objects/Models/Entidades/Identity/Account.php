<?php

namespace App\Models\Identity;

use App\Models\Model;
use App\Models\Traits\ComplexRelationamentTrait;

class Account extends Model
{
    use ComplexRelationamentTrait;
    
    protected static $COMPLEX_RELATIONAMENT_MODELS = [
        \App\Models\Photo::class,
        \App\Models\Video::class
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'account', // im segundos
        'type',
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'url' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'account' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'type' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
    /**
     * Get all of the business that are assigned this tag.
     */
    public function business()
    {
        return $this->morphedByMany('App\Models\Identity\Business', 'skillable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'skillable');
    }
}
