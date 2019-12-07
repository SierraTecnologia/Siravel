<?php

namespace Informate\Models\Entytys\Digital\Midia;

use Informate\Models\Model;

class Video extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'actors',
        'language',
        'url',
        'time',
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    public function links()
    {
        return $this->sitios();
    }

    public function sitios()
    {
        return $this->morphToMany('Population\Models\Identity\Digital\Sitio', 'sitioable');
    }
        
    // /**
    //  * Get all of the owning videoable models.
    //  */
    // @todo Verificar Depois
    // public function videoable()
    // {
    //     // @todo Verificar depois //return $this->morphTo(); //, 'videoable_type', 'videoable_code'
    // }
}
