<?php

namespace Siravel\Models\Entytys\Digital\Infra;

use Siravel\Models\Model;
use SiUtils\Tools\Ssh;

class Logger extends Model
{

    protected $organizationPerspective = true;

    protected $table = 'infra_loggers';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'type',
        'data',
        'customer_id',
        'user_id',
    ];


    protected $mappingProperties = array(

        'customer_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'user_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
    );

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function computer()
    {
        return $this->belongsTo('Siravel\Models\Entytys\Digital\Infra\Computer', 'computer_id', 'id');
    }
}