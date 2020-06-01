<?php

namespace App\Models;

use App\Models\Model;
use App\Models\Traits\ComplexRelationamentTrait;

class Feature extends Model
{
    public $incrementing = false;
    protected $casts = [
        'code' => 'string',
    ];
    protected $primaryKey = 'code';
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
    ];

    protected $mappingProperties = array(
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'code' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
        
    /**
     * Get all of the owning featureable models.
     */
    public function featureable()
    {
        return $this->morphTo();
    }

    /**
     * Get all of the business that are assigned this tag.
     */
    public function business()
    {
        return $this->morphedByMany('App\Models\Negocios\Business', 'featureable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'featureable');
    }
}
