<?php
/**
 * Servidor de Database
 */

namespace Siravel\Models\Entytys\Digital\Infra;

use Siravel\Models\Model;

class Container extends Model
{

    protected $organizationPerspective = true;

    protected $table = 'containers';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
    ];


    protected $mappingProperties = array(

        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'image' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
}