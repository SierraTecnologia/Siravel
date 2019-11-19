<?php

namespace Siravel\Models\Market\Actors;

use App\Models\Model;

class Girl extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'user_id'
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'cpf' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'email' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],

        /**
         * Grupo de Usuário:
         * 
         * 3 -> Usuário de Produtora
         * Default: 3
         */
        'user_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
    
    public function infos()
    {
        return $this->morphMany('Siravel\Models\Entytys\Fisicos\Info', 'infoable');
    }

    /**
     * Get all of the skills for the post.
     */
    public function skills()
    {
        return $this->morphToMany('Siravel\Models\Entytys\Fisicos\Skill', 'skillable');
    }

}
