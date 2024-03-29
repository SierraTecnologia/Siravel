<?php

namespace Siravel\Models\Negocios;

use Telefonica\Models\Actors\Person;

class Assinante extends Person
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cpf',
        'time_init',
        'time_payed',
        'role_id'
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

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Order', 'customer_id', 'id');
    }

    public function analysis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Analysi', 'analysi_id', 'id');
    }

    /**
     * Get the tokens record associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customerTokens(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\CustomerToken', 'customer_id', 'id');
    }

    /**
     * Recupera os tokens de gateways desse usuário
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gatewayCustomers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\GatewayCustomer', 'customer_id', 'id');
    }
}
