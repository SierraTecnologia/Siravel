<?php

namespace Informate\Models\Entytys\Category;

use Informate\Models\Model;

class BibliotecaType extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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

    public function bibliotecas()
    {
        return $this->hasMany('Population\Models\Market\Informacao\Biblioteca', 'biblioteca_type_id', 'id');
    }
}
