<?php

namespace Siravel\Models\Market\Actors;

use Siravel\Models\Model;
use SiObjects\Support\Traits\Models\ComplexRelationamentTrait;

class Bank extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'bank',
        'code',
        // 'bank',
        // 'agencia',
        // 'conta',
    ];

    protected $mappingProperties = array(
        'description' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'bank' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'code' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'bank' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'agencia' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'conta' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
    
    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function slaves()
    {
        return $this->morphedByMany('Siravel\Models\Identity\Slave', 'bankable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'bankable');
    }
}
