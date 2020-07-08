<?php

namespace Siravel\Models\Negocios;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function key_exists;
use Lang;

use Siravel\Models\Traits\BusinessTrait;

/**
 * Class Menu
 * @package App\Models
 * @version December 18, 2016, 5:33 am UTC
 */
class Menu extends Model
{
    use SoftDeletes, BusinessTrait;

    public $table = 'menus';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public static $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    protected $fillable = [
        'name',
        'slug',
        'order',
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }

    public function getOrderAttribute($value)
    {
        if (is_null($value)) {
            return '[]';
        }

        return $value;
    }
}