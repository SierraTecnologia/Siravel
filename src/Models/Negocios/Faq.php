<?php

namespace Siravel\Models\Negocios;

use Siravel\Models\CmsModel as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use function key_exists;

use Siravel\Models\Traits\BusinessTrait;

/**
 * Class Faq
 * @package App\Models
 * @version December 18, 2016, 5:33 am UTC
 */
class Faq extends BaseModel
{
    use SoftDeletes, BusinessTrait;

    public $table = 'faqs';

    public $primaryKey = 'id';

    protected $guarded = [];
    
    public static $rules = [
        'question' => 'required',
        'answer' => 'required',
    ];

    protected $fillable = [
        'question',
        'answer',
        'is_published',
        'published_at',
    ];

    protected $dates = [
        'published_at'
    ];

    public $translatable = [
        'question',
        'answer',
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }
}