<?php

namespace SiObject\Http\Resources\Entitys;

use SiObjects\Manipule\Entities\ThumbnailEntity;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;
use function SiUtil\Helper\html_purify;
use function SiUtil\Helper\to_int;
use function SiUtil\Helper\to_string;
use function SiUtil\Helper\url_storage;

/**
 * Class ThumbnailPlainResource.
 *
 * @package SiObject\Http\Resources\Entitys
 */
class ThumbnailPlainResource extends Resource
{
    /**
     * @var ThumbnailEntity
     */
    public $resource;

    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return [
            'url' => to_string(html_purify(function () {
                return url_storage(Storage::url($this->resource->getPath()));
            })),
            'width' => to_int(html_purify($this->resource->getWidth())),
            'height' => to_int(html_purify($this->resource->getHeight())),
        ];
    }
}
