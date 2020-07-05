<?php

namespace Siravel\Models;

use Illuminate\Support\Facades\Auth;
use Support\Models\Base as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use function key_exists;
use Lang;
use RicardoSierra\Translation\Traits\HasTranslations;
use App\Services\Normalizer;
use Siravel\Models\Traits\BusinessTrait;

class Page extends BaseModel
{
    use SoftDeletes, BusinessTrait;

    use HasTranslations;

    public $table = 'pages';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required',
        'url' => 'required',
    ];

    protected $fillable = [
        'title',
        'entry',
        'tags',
        'is_published',
        'seo_description',
        'seo_keywords',
        'url',
        'template',
        'published_at',
        'hero_image',
        'blocks',
    ];

    protected $dates = [
        'published_at' => 'Y-m-d H:i'
    ];

    protected $translatable = ['title', 'slug', 'body'];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }

    public function getEntryAttribute($value)
    {
        return new Normalizer($value);
    }

    public function getHeroImageUrlAttribute($value)
    {
        return url(str_replace('public/', 'storage/', $this->hero_image));
    }

    public function history()
    {
        return Archive::where('entity_type', get_class($this))->where('entity_id', $this->id)->get();
    }




    /**
     * From CMS Gpower
     */


    /**
     * Statuses.
     */
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';

    /**
     * List of statuses.
     *
     * @var array
     */
    public static $statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->author_id && Auth::user()) {
            $this->author_id = Auth::user()->getKey();
        }

        parent::save();
    }

    /**
     * Scope a query to only include active pages.
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }
}
