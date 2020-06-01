<?php

namespace App\Models\Blog;

use App\Models\CmsModel;
use App\Services\Normalizer;
use App\Models\Traits\Translatable;
use Informate\Models\System\Archive;
use App\Models\Traits\ArchiveTrait;

use App\Models\Traits\BusinessTrait;

class Blog extends CmsModel
{
    use Translatable, BusinessTrait;

    public $table = 'blogs';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required|string',
        'url' => 'required|string',
    ];

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
