<?php

namespace App\Models\Identity;

use App\Models\Model;

class Person extends Model
{
    protected $table = 'persons';  
    
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
        'code',
        'name',
        'cpf'
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
        'role_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
        
    /**
     * Get all of the owning personable models.
     */
    public function personable()
    {
        return $this->morphTo(); //, 'personable_type', 'personable_code'
    }


    /**
     * Aparece em videos
     */
    public function videos()
    {
        return $this->morphedByMany('App\Models\Midia\Video', 'personable');
    }

    /**
     * Aparece em fotos
     */
    public function images()
    {
        return $this->morphedByMany('App\Models\Midia\Image', 'personable');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'customer_id', 'id');
    }

    public function analysis()
    {
        return $this->hasMany('App\Models\Analysi', 'analysi_id', 'id');
    }

    /**
     * Get the tokens record associated with the user.
     */
    public function customerTokens()
    {
        return $this->hasMany('App\Models\CustomerToken', 'customer_id', 'id');
    }

    /**
     * Recupera os tokens de gateways desse usuário
     */
    public function gatewayCustomers()
    {
        return $this->hasMany('App\Models\GatewayCustomer', 'customer_id', 'id');
    }
}
