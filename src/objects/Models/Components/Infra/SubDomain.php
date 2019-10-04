<?php

namespace App\Models\Infra;

use App\Models\Model;

class SubDomain extends Model
{

    protected $organizationPerspective = true;

    protected $table = 'infra_subdomains';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'infra_domain_id',
        'user_id',
    ];


    protected $mappingProperties = array(

        'infra_domain_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'user_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'docker_compose_file' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );


    public function getDockerComposer()
    {
        return $this->belongsTo('App\Models\Gateway', 'gateway_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
}