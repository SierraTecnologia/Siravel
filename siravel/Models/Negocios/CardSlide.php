<?php

namespace Siravel\Models\Negocios;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function key_exists;
use Lang;

use Siravel\Models\Traits\BusinessTrait;

/**
 * Class Card
 * @package App\Models
 * @version December 18, 2016, 5:33 am UTC
 */
class CardSlide extends Model
{
    use SoftDeletes, BusinessTrait;

    public $table = 'cards';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'card_id',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'card_id' => 'integer',
        'image' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
