<?php
/**
 *  //@todo Fazer isso aqui.. Ta dificil
 */

namespace Siravel\Models\System;

use Siravel\Models\Model;

class Access extends Model
{
    // use BusinessTrait;

    /**
     * o proprio modelo terá o tipo de acesso:
     * access_type = 
     */

    
    public $table = 'accesses';

    public $primaryKey = 'id';

    public $fillable = [
        'name',
        'description',
        'access_type',
    ];

    public static $rules = [];
}
