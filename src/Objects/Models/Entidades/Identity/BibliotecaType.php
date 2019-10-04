<?php

namespace App\Models\Identity;

use App\Models\Model;

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
        return $this->hasMany('App\Models\Identity\Biblioteca', 'biblioteca_type_id', 'id');
    }
}
