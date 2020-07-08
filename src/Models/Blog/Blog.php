<?php

namespace Siravel\Models\Blog;

use Siravel\Models\CmsModel;
use Facilitador\Services\Normalizer;
use Translation\Traits\HasTranslations;
use Informate\Models\System\Archive;
use Informate\Traits\ArchiveTrait;

use Siravel\Contracts\Business\BusinessTrait;

class Blog extends CmsModel
{
    use HasTranslations, BusinessTrait;

    public $table = 'blogs';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required|string',
        'url' => 'required|string',
    ];

    // @todo add translation
    protected $appends = [
        'translations',
    ];

    public function getEntryAttribute($value)
    {
        return new Normalizer($value);
    }

    public function history()
    {
        return Archive::where('entity_type', get_class($this))->where('entity_id', $this->id)->get();
    }
}
