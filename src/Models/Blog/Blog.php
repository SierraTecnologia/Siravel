<?php

namespace Siravel\Models\Blog;

use Siravel\Models\SiravelModel;
use Facilitador\Services\Normalizer;
use Translation\Traits\HasTranslations;
use Informate\Models\System\Archive;
use Muleta\Traits\Models\ArchiveTrait;

use Siravel\Contracts\Business\BusinessTrait;

class Blog extends SiravelModel
{
    use BusinessTrait;

    public $table = 'blogs';

    public $primaryKey = 'id';

    protected $translatable = ['title'];

    protected $guarded = [];

    public $rules = [
        'title' => 'required|string',
        'url' => 'required|string',
    ];

    public function getEntryAttribute($value)
    {
        return new Normalizer($value);
    }
}
