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
class Card extends Model
{
    use SoftDeletes, BusinessTrait;

    public $table = 'cards';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'description',
        'subTitle',
        'price',
        'subDescription',
        'image',
        'imagesTitle',
        'text1',
        'text2',
        'text3',
        'text4',
        'buttonName',
        'buttonNewPage',
        'buttonLink'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'subTitle' => 'string',
        'price' => 'float',
        'image' => 'string',
        'imagesTitle' => 'string',
        'subTitle' => 'string',
        'text1' => 'string',
        'text2' => 'string',
        'text3' => 'string',
        'text4' => 'string',
        'buttonName' => 'string',
        'buttonNewPage' => 'bollean',
        'buttonLink' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function slides()
    {
        return $this->belongsTo(\App\Models\ServiceSlide::class);
    }
}
