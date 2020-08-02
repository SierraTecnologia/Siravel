<?php

namespace Siravel\Models\Negocios;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function key_exists;

use Siravel\Models\Traits\BusinessTrait;

/**
 * Class Link
 * @package App\Models
 * @version December 18, 2016, 5:33 am UTC
 */
class Link extends Model
{
    use SoftDeletes, BusinessTrait;

    public $table = 'links';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'slug',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function links()
    {
        return $this->belongsTo(\Siravel\Models\Negocios\Link::class);
    }
}
