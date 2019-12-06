<?php
/**
 * Servidor de Database
 */

namespace Informate\Models\Entytys\Digital\Infra;

use Informate\Models\Model;

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