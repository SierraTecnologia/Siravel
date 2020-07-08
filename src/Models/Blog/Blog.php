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
    use BusinessTrait;

    public $table = 'blogs';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required|string',
        'url' => 'required|string',
    ];

    public function getEntryAttribute($value)
    {
        return new Normalizer($value);
    }
}
